<?php
namespace HacoLED\Theme\Models;

use HacoLED\Theme\Core\Model;
use WP_Query;

/**
 * Read access for standard WordPress posts.
 */
class PostModel extends Model {
    /**
     * @param int $limit Maximum number of posts.
     * @return array<int, array<string, mixed>>
     */
    public static function get_latest_posts($limit = 6) {
        $query = new WP_Query([
            'post_type'           => 'post',
            'posts_per_page'      => absint($limit),
            'post_status'         => 'publish',
            'orderby'             => 'date',
            'order'               => 'DESC',
            'ignore_sticky_posts' => true,
        ]);

        return self::format_posts($query);
    }
}
