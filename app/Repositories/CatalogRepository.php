<?php
namespace HacoLED\Theme\Repositories;

use WP_Query;
use WP_Term;

/**
 * Read-only catalog queries shared by shop and product-category pages.
 */
class CatalogRepository {
    public function topLevelCategories() {
        return $this->normalizeTerms(get_terms([
            'taxonomy' => 'product_cat', 'parent' => 0, 'hide_empty' => false,
        ]));
    }

    public function categoryNavigation($term) {
        if (!$term instanceof WP_Term) {
            return [];
        }

        $children = get_terms([
            'taxonomy' => 'product_cat', 'parent' => $term->term_id, 'hide_empty' => false,
        ]);
        $terms = !empty($children) && !is_wp_error($children) ? $children : get_terms([
            'taxonomy' => 'product_cat', 'parent' => $term->parent,
            'hide_empty' => false, 'exclude' => [$term->term_id],
        ]);

        return $this->normalizeTerms($terms);
    }

    public function breadcrumbs($term) {
        if (!$term instanceof WP_Term) {
            return [];
        }

        $items = [];
        foreach (array_reverse(get_ancestors($term->term_id, 'product_cat')) as $ancestorId) {
            $ancestor = get_term($ancestorId, 'product_cat');
            if ($ancestor instanceof WP_Term) {
                $items[] = ['name' => $ancestor->name, 'url' => get_term_link($ancestor)];
            }
        }
        return $items;
    }

    public function featuredProjects($limit = 3) {
        return $this->posts([
            'post_type' => ['post', 'page'], 'posts_per_page' => absint($limit),
            'category_name' => 'du-an', 'post_status' => 'publish',
        ], 'thumbnail');
    }

    public function latestArticles($limit = 3) {
        $items = $this->posts([
            'post_type' => 'post', 'posts_per_page' => absint($limit),
            'category_name' => 'blog,tin-tuc,news', 'post_status' => 'publish',
            'ignore_sticky_posts' => true,
        ], 'large');

        return $items ?: $this->posts([
            'post_type' => 'post', 'posts_per_page' => absint($limit),
            'post_status' => 'publish', 'ignore_sticky_posts' => true,
        ], 'large');
    }

    public function shopDescription() {
        $shopId = wc_get_page_id('shop');
        $shop = $shopId > 0 ? get_post($shopId) : null;
        return $shop ? $shop->post_content : '';
    }

    private function normalizeTerms($terms) {
        if (empty($terms) || is_wp_error($terms)) {
            return [];
        }

        return array_map(function ($term) {
            $thumbnailId = get_term_meta($term->term_id, 'thumbnail_id', true);
            return [
                'id' => $term->term_id,
                'name' => $term->name,
                'url' => get_term_link($term),
                'image' => wp_get_attachment_image_url($thumbnailId, 'thumbnail')
                    ?: get_template_directory_uri() . '/assets/images/services-hero.png',
            ];
        }, $terms);
    }

    private function posts($args, $imageSize) {
        $query = new WP_Query($args);
        $items = [];
        while ($query->have_posts()) {
            $query->the_post();
            $items[] = [
                'id' => get_the_ID(), 'title' => get_the_title(), 'url' => get_permalink(),
                'date' => get_the_date('d/m/Y'),
                'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), $imageSize) ?: '',
            ];
        }
        wp_reset_postdata();
        return $items;
    }
}
