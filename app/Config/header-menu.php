<?php
/**
 * Default editable configuration for the desktop HacoLED header menus.
 */

defined('ABSPATH') || exit;

$assets = get_template_directory_uri() . '/assets/images/';
$category_url = static function ($slug) {
    $category = get_category_by_slug($slug);
    return $category ? get_category_link($category->term_id) : home_url('/' . trim($slug, '/') . '/');
};

return [
    'home' => [
        'label' => 'Trang Chủ',
        'enabled' => true,
        'kind' => 'link',
        'url' => home_url('/'),
    ],
    'about' => [
        'label' => 'Về HacoLED',
        'enabled' => true,
        'kind' => 'dropdown',
        'url' => home_url('/gioi-thieu/'),
        'items' => [
            ['label' => 'Giới thiệu chung', 'url' => hacoled_managed_page_url('about'), 'icon' => 'info', 'tone' => 'red'],
            ['label' => 'Cam kết chất lượng', 'url' => hacoled_managed_page_url('commitment'), 'icon' => 'shield', 'tone' => 'gold'],
            ['label' => 'Tuyển dụng', 'url' => hacoled_managed_page_url('careers'), 'icon' => 'user', 'tone' => 'slate'],
            ['label' => 'Sự kiện', 'url' => home_url('/su-kien/'), 'icon' => 'calendar', 'tone' => 'red'],
        ],
    ],
    'led' => [
        'label' => 'Màn Hình LED',
        'enabled' => true,
        'kind' => 'mega',
        'url' => home_url('/man-hinh-led/'),
        'columns' => [
            [
                'title' => 'LED Trong Nhà',
                'icon' => 'monitor',
                'tone' => 'red',
                'item_columns' => 1,
                'items' => [
                    ['label' => 'Màn hình LED P0.9', 'url' => home_url('/man-hinh-led-p0-9-trong-nha/')],
                    ['label' => 'Màn hình LED P1.25', 'url' => home_url('/man-hinh-led-p1-25-trong-nha/')],
                    ['label' => 'Màn hình LED P1.53', 'url' => home_url('/man-hinh-led-p1-53-trong-nha/')],
                    ['label' => 'Màn hình LED P1.8', 'url' => home_url('/man-hinh-led-p1-8-trong-nha/')],
                    ['label' => 'Màn hình LED P2', 'url' => home_url('/man-hinh-led-p2-trong-nha/'), 'badge' => ['label' => 'HOT', 'tone' => 'red']],
                    ['label' => 'Màn hình LED P2.5', 'url' => home_url('/man-hinh-led-p2-5-trong-nha/')],
                    ['label' => 'Màn hình LED P3', 'url' => home_url('/man-hinh-led-p3-trong-nha/')],
                    ['label' => 'Màn hình LED P3.0', 'url' => home_url('/man-hinh-led-p3-0-trong-nha/')],
                ]
            ],
            [
                'title' => 'LED Ngoài Trời',
                'icon' => 'sun',
                'tone' => 'gold',
                'item_columns' => 1,
                'items' => [
                    ['label' => 'Màn hình LED P2.5', 'url' => home_url('/man-hinh-led-p2-5-ngoai-troi/')],
                    ['label' => 'Màn hình LED P3', 'url' => home_url('/man-hinh-led-p3-ngoai-troi/')],
                    ['label' => 'Màn hình LED P4', 'url' => home_url('/man-hinh-led-p4-ngoai-troi/'), 'badge' => ['label' => 'PRO', 'tone' => 'gold']],
                    ['label' => 'Màn hình LED P5', 'url' => home_url('/man-hinh-led-p5-ngoai-troi/')],
                    ['label' => 'Màn hình LED P10', 'url' => home_url('/man-hinh-led-p10-ngoai-troi/')],
                ]
            ],
        ],
        'visual' => ['image' => $assets . 'showcase-led.webp', 'fallback' => $assets . 'services-hero.webp', 'alt' => 'Giải pháp Màn hình LED P1.53 Phòng Khánh Tiết EVN', 'badge' => 'Dự án nổi bật', 'title' => 'Giải pháp Màn hình LED P1.53 Phòng Khánh Tiết EVN', 'cta' => 'Xem dự án ngay', 'url' => hacoled_managed_page_url('projects')],
    ],
    'videowall' => [
        'label' => 'Màn Hình Ghép',
        'enabled' => true,
        'kind' => 'mega',
        'url' => home_url('/man-hinh-ghep/'),
        'columns' => [
            [
                'title' => 'Màn Hình Ghép Videowall',
                'icon' => 'grid',
                'tone' => 'red',
                'item_columns' => 1,
                'items' => [
                    ['label' => 'Màn hình ghép BOE', 'url' => home_url('/man-hinh-ghep-boe/')],
                    ['label' => 'Màn hình ghép Orion', 'url' => home_url('/man-hinh-ghep-orion/')],
                    ['label' => 'Màn hình ghép Vestel', 'url' => home_url('/man-hinh-ghep-vestel/')],
                ],
            ]
        ],
        'visual' => ['image' => $assets . 'showcase-led.webp', 'fallback' => '', 'alt' => 'Viền ghép siêu mỏng, không giới hạn không gian', 'badge' => 'Videowall', 'title' => 'Viền ghép siêu mỏng, không giới hạn không gian', 'cta' => 'Tìm hiểu thêm', 'url' => home_url('/man-hinh-ghep/')],
    ],
    'led_trang_tri' => [
        'label' => 'LED Trang Trí Tòa Nhà',
        'enabled' => true,
        'kind' => 'link',
        'url' => home_url('/led-trang-tri-toa-nha/'),
    ],
    'solutions' => [
        'label' => 'Giải Pháp',
        'enabled' => true,
        'kind' => 'mega',
        'url' => home_url('/giai-phap/'),
        'columns' => [
            [
                'title' => 'Giải Pháp Màn Hình LED',
                'icon' => 'sparkles',
                'tone' => 'red',
                'item_columns' => 2,
                'items' => [
                    ['label' => 'Màn hình LED Hội trường', 'url' => home_url('/man-hinh-led-hoi-truong/')],
                    ['label' => 'Màn hình LED Phòng họp', 'url' => home_url('/man-hinh-led-phong-hop-hoi-truong/')],
                    ['label' => 'Màn hình LED Sân khấu', 'url' => home_url('/man-hinh-led-san-khau/')],
                    ['label' => 'Màn hình LED Trường học', 'url' => home_url('/man-hinh-led-truong-hoc/')],
                    ['label' => 'Màn hình LED Tiệc, đám cưới', 'url' => home_url('/man-hinh-led-tiec-cuoi-nha-hang/')],
                    ['label' => 'Màn hình LED Studio', 'url' => home_url('/man-hinh-led-studio/')],
                    ['label' => 'Màn hình LED 100, 200, 300 inch', 'url' => home_url('/man-hinh-led-100-200-300-inch/')],
                    ['label' => 'Màn hình LED Trong suốt', 'url' => home_url('/man-hinh-led-trong-suot/')],
                    ['label' => 'Màn hình LED Film dán kính', 'url' => home_url('/man-hinh-led-film-dan-kinh/')],
                ],
            ]
        ],
        'visual' => ['image' => $assets . 'services-hero.webp', 'fallback' => '', 'alt' => 'Giải pháp hiển thị chuyên nghiệp cho Hội trường và Phòng họp', 'badge' => 'Giải pháp toàn diện', 'title' => 'Giải pháp hiển thị chuyên nghiệp cho Hội trường & Phòng họp', 'cta' => 'Xem chi tiết', 'url' => home_url('/giai-phap/')],
    ],
    'audio' => [
        'label' => 'Âm Thanh',
        'enabled' => true,
        'kind' => 'mega',
        'url' => home_url('/am-thanh/'),
        'columns' => [
            [
                'title' => 'DBAcoustic',
                'icon' => 'speaker',
                'tone' => 'red',
                'item_columns' => 1,
                'items' => [
                    ['label' => 'Loa DBAcoustic', 'url' => home_url('/dbacoustic-loa/')],
                    ['label' => 'Amply DBAcoustic', 'url' => home_url('/dbacoustic-amply/')],
                    ['label' => 'Micro DBAcoustic', 'url' => home_url('/dbacoustic-micro/')],
                    ['label' => 'Loa siêu trầm - Sub', 'url' => home_url('/loa-sieu-tram-sub/')],
                    ['label' => 'Đẩy công suất', 'url' => home_url('/day-cong-suat-dbacoustic/')],
                    ['label' => 'Vang số, Mixer, Crossover', 'url' => home_url('/vangso-mixer-crossover-dbacoustic/')],
                    ['label' => 'Quản lý nguồn', 'url' => home_url('/quan-ly-nguon-dbacoustic/')],
                ]
            ],
            [
                'title' => 'TD Classic',
                'icon' => 'speaker',
                'tone' => 'slate',
                'item_columns' => 1,
                'items' => [
                    ['label' => 'Loa TD Classic', 'url' => home_url('/loa-tdclassic/')],
                    ['label' => 'Micro TD Classic', 'url' => home_url('/micro-tdclassic/')],
                    ['label' => 'Amply TD Classic', 'url' => home_url('/amply-tdclassic/')],
                    ['label' => 'Vang số TD Classic', 'url' => home_url('/vang-so-tdclassic/')],
                    ['label' => 'Phụ kiện âm thanh', 'url' => home_url('/phu-kien-am-thanh-tdclassic/')],
                ]
            ],
            [
                'title' => 'CF Audio & Peavey',
                'icon' => 'speaker',
                'tone' => 'gold',
                'item_columns' => 1,
                'items' => [
                    ['label' => 'Loa CF Audio', 'url' => home_url('/cfaudio-loa/')],
                    ['label' => 'Loa Peavey', 'url' => home_url('/peavey-loa/')],
                ]
            ],
        ],
        'visual' => ['image' => $assets . 'showcase-audio.webp', 'fallback' => $assets . 'services-audio.webp', 'alt' => 'Thiết bị âm thanh sân khấu và sự kiện', 'badge' => 'Âm thanh Pro', 'title' => 'Thiết bị âm thanh Sân khấu & Sự kiện đỉnh cao', 'cta' => 'Tìm hiểu ngay', 'url' => home_url('/am-thanh/')],
    ],
    'projects' => [
        'label' => 'Dự án đã thực hiện',
        'enabled' => true,
        'kind' => 'mega',
        'url' => hacoled_managed_page_url('projects'),
        'columns' => [
            [
                'title' => 'Hồ Sơ Năng Lực',
                'icon' => 'document',
                'tone' => 'red',
                'item_columns' => 2,
                'items' => [
                    ['label' => 'Dự án trong nhà', 'url' => $category_url('du-an-trong-nha')],
                    ['label' => 'Dự án ngoài trời', 'url' => $category_url('du-an-ngoai-troi')],
                    ['label' => 'Dự án trường học', 'url' => $category_url('du-an-truong-hoc')],
                    ['label' => 'Dự án màn hình ghép', 'url' => $category_url('du-an-man-hinh-ghep')],
                    ['label' => 'Dự án âm thanh', 'url' => $category_url('du-an-am-thanh')],
                ],
            ]
        ],
        'visual' => ['image' => $assets . 'showcase-audio.webp', 'fallback' => $assets . 'services-audio.webp', 'alt' => 'Tổ hợp hiển thị và âm thanh tại Cung Điền Kinh Quốc Gia', 'badge' => 'Âm thanh & LED sự kiện', 'title' => 'Tổ hợp Hiển thị và Âm thanh tại Cung Điền Kinh Quốc Gia', 'cta' => 'Khám phá ngay', 'url' => $category_url('du-an-am-thanh')],
    ],
    'services' => [
        'label' => 'Dịch Vụ',
        'enabled' => true,
        'kind' => 'link',
        'url' => hacoled_managed_page_url('services'),
    ],
    'news' => [
        'label' => 'Tin Tức & Blog',
        'enabled' => true,
        'kind' => 'dropdown',
        'url' => home_url('/tin-tuc-su-kien/'),
        'items' => [
            ['label' => 'Blog về màn hình LED', 'url' => $category_url('blog-man-hinh-led'), 'icon' => 'monitor', 'tone' => 'red'],
            ['label' => 'Blog về âm thanh', 'url' => $category_url('blog-am-thanh'), 'icon' => 'speaker', 'tone' => 'gold'],
            ['label' => 'Hướng dẫn kỹ thuật', 'url' => $category_url('huong-dan-ky-thuat'), 'icon' => 'book', 'tone' => 'slate'],
            ['label' => 'Tin Tức', 'url' => $category_url('tin-tuc'), 'icon' => 'newspaper', 'tone' => 'red'],
        ],
    ],
    'contact' => [
        'label' => 'Liên Hệ',
        'enabled' => true,
        'kind' => 'link',
        'url' => hacoled_managed_page_url('contact'),
    ],
];
