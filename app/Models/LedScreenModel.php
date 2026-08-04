<?php
namespace HacoLED\Theme\Models;

use HacoLED\Theme\Core\Model;
use WP_Query;

/**
 * Read-only adapter that normalizes WooCommerce products for theme views.
 */
class LedScreenModel extends Model {
    /**
     * @param int $limit Maximum number of products.
     * @return array<int, array<string, mixed>>
     */
    public static function get_products($limit = 8) {
        // 1. Get featured products ordered by menu_order ASC, then modified date DESC
        $featured_ids = get_posts([
            'post_type'      => 'product',
            'posts_per_page' => absint($limit),
            'post_status'    => 'publish',
            'orderby'        => [
                'menu_order' => 'ASC',
                'modified'   => 'DESC',
            ],
            'fields'         => 'ids',
            'tax_query'      => [
                [
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                    'operator' => 'IN',
                ],
            ],
        ]);

        // 2. Get remaining regular products ordered by menu_order ASC, then modified date DESC
        $needed = absint($limit) - count($featured_ids);
        $regular_ids = [];
        if ($needed > 0) {
            $regular_ids = get_posts([
                'post_type'      => 'product',
                'posts_per_page' => $needed,
                'post_status'    => 'publish',
                'post__not_in'   => $featured_ids,
                'orderby'        => [
                    'menu_order' => 'ASC',
                    'modified'   => 'DESC',
                ],
                'fields'         => 'ids',
            ]);
        }

        $all_ids = array_merge($featured_ids, $regular_ids);

        $query = !empty($all_ids)
            ? new WP_Query([
                'post_type'      => 'product',
                'post__in'       => $all_ids,
                'orderby'        => 'post__in',
                'posts_per_page' => count($all_ids),
                'post_status'    => 'publish',
            ])
            : new WP_Query([
                'post_type'      => 'product',
                'posts_per_page' => absint($limit),
                'post_status'    => 'publish',
                'orderby'        => 'modified',
                'order'          => 'DESC',
            ]);

        $products = [];

        while ($query->have_posts()) {
            $query->the_post();
            $p_id = get_the_ID();

            $terms = get_the_terms($p_id, 'product_cat');
            $category = (!empty($terms) && !is_wp_error($terms))
                ? $terms[0]->name
                : __('Sản phẩm', 'hacoled');

            if (function_exists('wc_get_product')) {
                $product = wc_get_product($p_id);
                if (!$product) {
                    continue;
                }
                $products[] = [
                    'id'           => $product->get_id(),
                    'title'        => $product->get_name(),
                    'permalink'    => $product->get_permalink(),
                    'description'  => $product->get_short_description(),
                    'pitch'        => $product->get_meta('_led_pitch') ?: '',
                    'brightness'   => $product->get_meta('_led_brightness') ?: '',
                    'refresh_rate' => $product->get_meta('_led_refresh') ?: '',
                    'category'     => $category,
                    'price'        => $product->get_price_html() ?: __('Liên hệ', 'hacoled'),
                    'thumbnail'    => get_the_post_thumbnail_url($product->get_id(), 'large') ?: '',
                ];
            } else {
                $products[] = [
                    'id'           => $p_id,
                    'title'        => get_the_title(),
                    'permalink'    => get_permalink(),
                    'description'  => get_the_excerpt(),
                    'pitch'        => get_post_meta($p_id, '_led_pitch', true) ?: (get_post_meta($p_id, '_product_pitch', true) ?: ''),
                    'brightness'   => get_post_meta($p_id, '_led_brightness', true) ?: (get_post_meta($p_id, '_product_brightness', true) ?: ''),
                    'refresh_rate' => get_post_meta($p_id, '_led_refresh', true) ?: (get_post_meta($p_id, '_product_refresh', true) ?: ''),
                    'category'     => $category,
                    'price'        => __('Liên hệ', 'hacoled'),
                    'thumbnail'    => get_the_post_thumbnail_url($p_id, 'large') ?: '',
                ];
            }
        }

        wp_reset_postdata();

        return $products;
    }
}
