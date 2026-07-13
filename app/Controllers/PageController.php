<?php
namespace HacoLED\Theme\Controllers;

use HacoLED\Theme\Core\Controller;

/**
 * Presents a regular WordPress page selected through the native hierarchy.
 */
class PageController extends Controller {
    public function show() {
        $page = [
            'id'        => 0,
            'title'     => __('Trang chi tiết', 'hacoled'),
            'content'   => '',
            'thumbnail' => '',
        ];

        while (have_posts()) {
            the_post();
            $page = [
                'id'        => get_the_ID(),
                'title'     => get_the_title(),
                'content'   => get_the_content(),
                'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'full') ?: '',
            ];
        }

        $this->render('common/page', [
            'page'        => $page,
            'header_type' => 'default',
            'footer_type' => 'default',
        ]);
    }
}
