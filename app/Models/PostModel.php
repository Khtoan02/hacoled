<?php
namespace App\Models;

use App\Core\Model;
use WP_Query;

/**
 * Model handling standard WordPress blog articles
 */
class PostModel extends Model {
    /**
     * Get recent published posts
     * 
     * @param int $limit Number of posts to retrieve
     * @return array Formatted post items
     */
    public static function get_latest_posts($limit = 6) {
        $args = [
            'post_type'      => 'post',
            'posts_per_page' => $limit,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC'
        ];
        
        $query = new WP_Query($args);
        $posts = self::format_posts($query);
        
        // Return mock data fallback if database is empty (fresh WP install)
        if (empty($posts)) {
            return self::get_mock_posts();
        }
        
        return $posts;
    }

    /**
     * Fallback mock posts for rich user experience on fresh install
     */
    private static function get_mock_posts() {
        return [
            [
                'id'        => 101,
                'title'     => 'Haco LED thi công màn hình LED P2.5 tại Hà Nội',
                'excerpt'   => 'Dự án thi công lắp đặt hệ thống màn hình LED phòng họp P2.5 trong nhà độ phân giải cao tại trung tâm hội nghị quốc gia...',
                'content'   => 'Nội dung chi tiết dự án thi công lắp đặt màn hình LED.',
                'permalink' => '#',
                'date'      => '04/06/2026',
                'thumbnail' => '',
                'author'    => 'Khánh Toàn',
                'category'  => 'Dự án'
            ],
            [
                'id'        => 102,
                'title'     => 'Xu hướng lắp đặt màn hình LED quảng cáo ngoài trời 2026',
                'excerpt'   => 'Tìm hiểu tại sao màn hình LED ngoài trời cabinet đúc chống chịu thời tiết IP65 là lựa chọn quảng cáo hàng đầu của doanh nghiệp...',
                'content'   => 'Nội dung chi tiết xu hướng thị trường màn hình led quảng cáo.',
                'permalink' => '#',
                'date'      => '02/06/2026',
                'thumbnail' => '',
                'author'    => 'Khánh Toàn',
                'category'  => 'Tin tức'
            ],
            [
                'id'        => 103,
                'title'     => 'Ưu nhược điểm của màn hình LED trong suốt (Transparent LED)',
                'excerpt'   => 'Giải pháp đột phá cho mặt tiền kính tòa nhà, showroom thời trang cao cấp với độ xuyên sáng hơn 80% mà vẫn hiển thị rực rỡ...',
                'content'   => 'Nội dung chi tiết so sánh các loại màn hình trong suốt.',
                'permalink' => '#',
                'date'      => '30/05/2026',
                'thumbnail' => '',
                'author'    => 'Khánh Toàn',
                'category'  => 'Công nghệ'
            ]
        ];
    }
}
