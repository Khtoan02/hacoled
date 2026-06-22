<?php
namespace App\Controllers;

use App\Core\Controller;

/**
 * Controller handling Blog Archives and Categories listings (standard WP Posts)
 */
class ArchiveController extends Controller {
    /**
     * General Archive list action
     */
    public function index() {
        $posts = [];
        if (have_posts()) {
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
                    'category'  => get_the_category_list(', ')
                ];
            }
        }

        $this->render('common/archive', [
            'posts'       => $posts,
            'title'       => get_the_archive_title(),
            'header_type' => 'default',
            'footer_type' => 'default'
        ]);
    }

    /**
     * Blog Category list action
     */
    public function category() {
        $posts = [];
        if (have_posts()) {
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
                    'category'  => get_the_category_list(', ')
                ];
            }
        }

        $current_cat = get_queried_object();

        $this->render('common/category', [
            'posts'         => $posts,
            'category_name' => $current_cat ? $current_cat->name : __('Danh mục', 'hacoled'),
            'description'   => $current_cat ? $current_cat->description : '',
            'header_type'   => 'default',
            'footer_type'   => 'default'
        ]);
    }
}
