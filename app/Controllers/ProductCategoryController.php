<?php
namespace HacoLED\Theme\Controllers;

use HacoLED\Theme\Core\Controller;
use HacoLED\Theme\Core\LayoutRegistry;
use HacoLED\Theme\Repositories\CatalogRepository;
use WP_Query;
use WP_Term;

/**
 * Presents WooCommerce product-category taxonomy archives.
 */
class ProductCategoryController extends Controller {
    public function index() {
        $term = get_queried_object();
        $term = $term instanceof WP_Term ? $term : null;
        $catalog = new CatalogRepository();

        $term_id = $term ? $term->term_id : 0;
        $view = $term_id ? LayoutRegistry::resolveCategoryView($term_id, 'catalog/category') : 'catalog/category';

        // Load products belonging to this category or its subcategories
        $products = [];
        if ($term_id) {
            $p_query = new WP_Query([
                'post_type'      => 'product',
                'posts_per_page' => 24,
                'post_status'    => 'publish',
                'tax_query'      => [
                    [
                        'taxonomy'         => 'product_cat',
                        'field'            => 'term_id',
                        'terms'            => $term_id,
                        'include_children' => true,
                    ],
                ],
            ]);

            while ($p_query->have_posts()) {
                $p_query->the_post();
                $product = function_exists('wc_get_product') ? wc_get_product(get_the_ID()) : null;
                $products[] = [
                    'id'          => get_the_ID(),
                    'title'       => get_the_title(),
                    'link'        => get_permalink(),
                    'price_html'  => $product ? ($product->get_price_html() ?: __('Liên hệ', 'hacoled')) : __('Liên hệ', 'hacoled'),
                    'thumbnail'   => get_the_post_thumbnail_url(get_the_ID(), 'medium_large') ?: '',
                    'short_desc'  => get_the_excerpt() ?: '',
                ];
            }
            wp_reset_postdata();
        }

        // Load the 7 specialized subcategory sections for Landing Page
        $subcat_sections = [];
        $target_subcats = [
            'man-hinh-led-trong-nha'     => [
                'badge' => 'Bán Chạy Nhất &bull; Hội Trường & Phòng Họp',
                'icon'  => 'ph-monitor',
            ],
            'man-hinh-led-ngoai-troi'    => [
                'badge' => 'Chống Nước IP65 &bull; Độ Sáng 8000 nits',
                'icon'  => 'ph-sun',
            ],
            'man-hinh-led-quang-cao'     => [
                'badge' => 'Quảng Cáo Tấm Lớn &bull; Billboard & TTTM',
                'icon'  => 'ph-megaphone',
            ],
            'ung-dung-man-hinh-led'      => [
                'badge' => 'Giải Pháp Trọn Gói Theo Ngành Nghề',
                'icon'  => 'ph-app-window',
            ],
            'man-hinh-led-studio'        => [
                'badge' => 'Trường Quay Ảo xR &bull; Virtual Production',
                'icon'  => 'ph-video-camera',
            ],
            'man-hinh-led-cong'          => [
                'badge' => 'Mặt Cong Nghệ Thuật &bull; Hiệu Ứng 3D',
                'icon'  => 'ph-arrows-horizontal',
            ],
            'man-hinh-led-film-dan-kinh' => [
                'badge' => 'Độ Trong Suốt 85% &bull; Dán Trực Tiếp Lên Kính',
                'icon'  => 'ph-diamonds-four',
            ],
        ];

        foreach ($target_subcats as $slug => $meta) {
            $sub_term = get_term_by('slug', $slug, 'product_cat');
            if (!$sub_term) {
                continue;
            }

            $p_query = new WP_Query([
                'post_type'      => 'product',
                'posts_per_page' => 16,
                'post_status'    => 'publish',
                'tax_query'      => [
                    [
                        'taxonomy'         => 'product_cat',
                        'field'            => 'term_id',
                        'terms'            => $sub_term->term_id,
                        'include_children' => true,
                    ],
                ],
            ]);

            $sub_products = [];
            while ($p_query->have_posts()) {
                $p_query->the_post();
                $prod = function_exists('wc_get_product') ? wc_get_product(get_the_ID()) : null;
                $sub_products[] = [
                    'id'          => get_the_ID(),
                    'title'       => get_the_title(),
                    'link'        => get_permalink(),
                    'price_html'  => $prod ? ($prod->get_price_html() ?: __('Liên hệ', 'hacoled')) : __('Liên hệ', 'hacoled'),
                    'thumbnail'   => get_the_post_thumbnail_url(get_the_ID(), 'medium_large') ?: '',
                    'short_desc'  => get_post_meta(get_the_ID(), '_led_tech_specs', true) ?: (get_the_excerpt() ?: ''),
                ];
            }
            wp_reset_postdata();

            $subcat_sections[] = [
                'term'        => $sub_term,
                'name'        => $sub_term->name,
                'slug'        => $sub_term->slug,
                'description' => $sub_term->description,
                'link'        => get_term_link($sub_term),
                'badge'       => $meta['badge'],
                'icon'        => $meta['icon'],
                'count'       => count($sub_products),
                'products'    => $sub_products,
            ];
        }

        $this->render($view, [
            'current_term'          => $term,
            'category_name'         => $term ? $term->name : __('Danh mục sản phẩm', 'hacoled'),
            'description'           => $term ? $term->description : '',
            'navigation_categories' => $catalog->categoryNavigation($term),
            'breadcrumbs'           => $catalog->breadcrumbs($term),
            'featured_projects'     => $catalog->featuredProjects(8),
            'latest_articles'       => $catalog->latestArticles(4),
            'faq'                   => $catalog->categoryFaq($term),
            'products'              => $products,
            'subcat_sections'       => $subcat_sections,
            'header_type'           => 'default',
            'footer_type'           => 'default',
        ]);

    }
}

