<?php
namespace App\Models;

use App\Core\Model;
use WP_Query;

/**
 * Model handling LED screen products and projects
 */
class LedScreenModel extends Model {
    /**
     * Get list of LED screen products
     * 
     * @param int $limit Max items to return
     * @return array Custom post items or mock list
     */
    public static function get_products($limit = 8) {
        $args = [
            'post_type'      => 'led_product',
            'posts_per_page' => $limit,
            'post_status'    => 'publish',
            'orderby'        => 'menu_order',
            'order'          => 'ASC'
        ];

        $query = new WP_Query($args);
        $products = [];

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $products[] = [
                    'id'            => get_the_ID(),
                    'title'         => get_the_title(),
                    'permalink'     => get_permalink(),
                    'description'   => get_the_excerpt(),
                    'pitch'         => get_post_meta(get_the_ID(), '_led_pitch', true) ?: 'P2.5',
                    'brightness'    => get_post_meta(get_the_ID(), '_led_brightness', true) ?: '800 nits',
                    'refresh_rate'  => get_post_meta(get_the_ID(), '_led_refresh', true) ?: '3840Hz',
                    'category'      => get_post_meta(get_the_ID(), '_led_category', true) ?: 'Trong nhà',
                    'price'         => get_post_meta(get_the_ID(), '_led_price', true) ?: 'Liên hệ',
                    'thumbnail'     => get_the_post_thumbnail_url(get_the_ID(), 'large') ?: ''
                ];
            }
            wp_reset_postdata();
        }

        // Default mock data when no products are in the DB
        if (empty($products)) {
            return self::get_mock_products();
        }

        return $products;
    }

    /**
     * Mock data showing detailed product specs of Haco LED solutions
     */
    private static function get_mock_products() {
        return [
            [
                'id'            => 201,
                'title'         => 'Màn hình LED P1.56 Ultra Fine',
                'permalink'     => '#',
                'description'   => 'Hệ cabinet nhôm đúc đúc nguyên khối siêu nhẹ, hiển thị HDR10+ cho phòng họp VIP, phòng điều hành.',
                'pitch'         => 'Pixel Pitch: 1.56mm',
                'brightness'    => 'Độ sáng: 600 - 800 cd/m²',
                'refresh_rate'  => 'Tần số quét: 3840Hz',
                'category'      => 'Màn hình Trong nhà',
                'price'         => '18.500.000 đ / m²',
                'thumbnail'     => ''
            ],
            [
                'id'            => 202,
                'title'         => 'Màn hình LED P2.5 Cabinet Slim',
                'permalink'     => '#',
                'description'   => 'Lựa chọn phổ biến nhất cho hội trường doanh nghiệp lớn và trung tâm hội nghị tiệc cưới tiệc tùng sang trọng.',
                'pitch'         => 'Pixel Pitch: 2.50mm',
                'brightness'    => 'Độ sáng: 1000 cd/m²',
                'refresh_rate'  => 'Tần số quét: 3840Hz',
                'category'      => 'Màn hình Trong nhà',
                'price'         => '11.200.000 đ / m²',
                'thumbnail'     => ''
            ],
            [
                'id'            => 203,
                'title'         => 'Màn hình LED P3.91 Outdoor IP65',
                'permalink'     => '#',
                'description'   => 'Chống bụi nước hoàn toàn, độ sáng siêu cao chống loá dưới ánh nắng mặt trời trực diện gay gắt.',
                'pitch'         => 'Pixel Pitch: 3.91mm',
                'brightness'    => 'Độ sáng: 5500 - 6000 cd/m²',
                'refresh_rate'  => 'Tần số quét: 1920Hz',
                'category'      => 'Màn hình Ngoài trời',
                'price'         => '14.800.000 đ / m²',
                'thumbnail'     => ''
            ],
            [
                'id'            => 204,
                'title'         => 'Màn hình LED Trong Suốt Crystal G3.9',
                'permalink'     => '#',
                'description'   => 'Độ xuyên thấu ánh sáng lên tới 85%, siêu nhẹ, lắp đặt tinh tế thẩm mỹ sau vách kính cửa hàng flagship.',
                'pitch'         => 'Pixel Pitch: 3.91 - 7.82mm',
                'brightness'    => 'Độ sáng: 4500 cd/m²',
                'refresh_rate'  => 'Tần số quét: 3840Hz',
                'category'      => 'Màn hình Trong suốt',
                'price'         => 'Liên hệ báo giá',
                'thumbnail'     => ''
            ]
        ];
    }
}
