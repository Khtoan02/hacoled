<?php
namespace HacoLED\Theme\Controllers;

use HacoLED\Theme\Core\Controller;

/**
 * Presents the native WordPress search query without replacing the main query.
 */
class SearchController extends Controller {
    public function index() {
        $posts = [];

        while (have_posts()) {
            the_post();
            $posts[] = [
                'id'        => get_the_ID(),
                'title'     => get_the_title(),
                'excerpt'   => get_the_excerpt(),
                'permalink' => get_permalink(),
                'date'      => get_the_date(),
                'author'    => get_the_author(),
                'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'large') ?: '',
                'category'  => get_the_category_list(', '),
            ];
        }

        $this->render('common/archive', [
            'posts'       => $posts,
            'title'       => sprintf(__('Kết quả tìm kiếm cho: %s', 'hacoled'), get_search_query()),
            'header_type' => 'default',
            'footer_type' => 'default',
        ]);
    }
}
