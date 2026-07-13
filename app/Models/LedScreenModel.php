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
        $query = new WP_Query([
            'post_type'      => 'product',
            'posts_per_page' => absint($limit),
            'post_status'    => 'publish',
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ]);

        $products = [];

        while ($query->have_posts()) {
            $query->the_post();
            $product = wc_get_product(get_the_ID());

            if (!$product) {
                continue;
            }

            $terms = get_the_terms($product->get_id(), 'product_cat');
            $category = (!empty($terms) && !is_wp_error($terms))
                ? $terms[0]->name
                : __('Sản phẩm', 'hacoled');

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
        }

        wp_reset_postdata();

        return $products;
    }
}
