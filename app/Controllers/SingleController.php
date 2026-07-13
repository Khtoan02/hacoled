<?php
namespace HacoLED\Theme\Controllers;

use HacoLED\Theme\Core\Controller;

/**
 * Controller handling Detail layouts for posts and products
 */
class SingleController extends Controller {
    /**
     * Show single details page
     */
    public function show() {
        $post_data = [];
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                
                $categories = get_the_category();
                $cats = [];
                if (!empty($categories)) {
                    foreach ($categories as $cat) {
                        $cats[] = [
                            'name' => $cat->name,
                            'link' => get_category_link($cat->term_id)
                        ];
                    }
                }

                $post_data = [
                    'id'        => get_the_ID(),
                    'title'     => get_the_title(),
                    'content'   => get_the_content(),
                    'excerpt'   => get_the_excerpt(),
                    'date'      => get_the_date(),
                    'author'    => get_the_author(),
                    'categories'=> $cats,
                    'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'full') ?: ''
                ];
            }
        } else {
            $post_data = [
                'id'        => 0,
                'title'     => __('Chi tiết sản phẩm / Dự án', 'hacoled'),
                'excerpt'   => '',
                'content'   => __('Chi tiết đang được cập nhật...', 'hacoled'),
                'date'      => date('d/m/Y'),
                'author'    => 'Khánh Toàn',
                'categories'=> [
                    ['name' => 'Giải pháp LED', 'link' => '#']
                ],
                'thumbnail' => ''
            ];
        }

        $this->render('common/single', [
            'post'        => $post_data,
            'header_type' => 'default',
            'footer_type' => 'default'
        ]);
    }
}
