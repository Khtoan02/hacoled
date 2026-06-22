<?php
namespace App\Core;

/**
 * Base Model class for WordPress queries
 */
class Model {
    /**
     * Helper to clean up arrays or format results
     */
    protected static function format_posts($query) {
        $formatted = [];
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $formatted[] = [
                    'id'        => get_the_ID(),
                    'title'     => get_the_title(),
                    'excerpt'   => get_the_excerpt(),
                    'content'   => get_the_content(),
                    'permalink' => get_permalink(),
                    'date'      => get_the_date(),
                    'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'large') ?: '',
                    'author'    => get_the_author(),
                ];
            }
            wp_reset_postdata();
        }
        return $formatted;
    }
}
