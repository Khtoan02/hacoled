<?php
/**
 * SEO and social metadata fallbacks owned by the HacoLED theme.
 *
 * Rank Math remains the primary SEO UI. These callbacks only provide complete,
 * production-safe homepage defaults when its fields have not been configured.
 */

defined('ABSPATH') || exit;

function hacoled_home_seo_title() {
    return 'HacoLED – Màn hình LED, màn hình ghép & âm thanh cao cấp';
}

function hacoled_home_seo_description() {
    return 'HacoLED cung cấp, thi công màn hình LED, màn hình ghép, âm thanh và ánh sáng chuyên nghiệp; giải pháp đồng bộ, bảo hành rõ ràng trên toàn quốc.';
}

function hacoled_home_social_image() {
    return get_template_directory_uri() . '/assets/images/home-solution-led.webp';
}

function hacoled_filter_home_document_title($title) {
    return is_front_page() ? hacoled_home_seo_title() : $title;
}
add_filter('pre_get_document_title', 'hacoled_filter_home_document_title', 20);
add_filter('rank_math/frontend/title', 'hacoled_filter_home_document_title', 20);

function hacoled_filter_home_description($description) {
    if (!is_front_page()) {
        return $description;
    }

    return trim((string) $description) !== ''
        ? $description
        : hacoled_home_seo_description();
}
add_filter('rank_math/frontend/description', 'hacoled_filter_home_description', 20);
add_filter('rank_math/opengraph/facebook/og_description', 'hacoled_filter_home_description', 20);
add_filter('rank_math/opengraph/twitter/twitter_description', 'hacoled_filter_home_description', 20);

function hacoled_filter_home_social_title($title) {
    return is_front_page() ? hacoled_home_seo_title() : $title;
}
add_filter('rank_math/opengraph/facebook/og_title', 'hacoled_filter_home_social_title', 20);
add_filter('rank_math/opengraph/twitter/twitter_title', 'hacoled_filter_home_social_title', 20);

function hacoled_filter_home_social_image($image) {
    if (!is_front_page() || trim((string) $image) !== '') {
        return $image;
    }

    return hacoled_home_social_image();
}
add_filter('rank_math/opengraph/facebook/image', 'hacoled_filter_home_social_image', 20);
add_filter('rank_math/opengraph/twitter/image', 'hacoled_filter_home_social_image', 20);

function hacoled_filter_twitter_card_type($type) {
    return is_front_page() ? 'summary_large_image' : $type;
}
add_filter('rank_math/opengraph/twitter/card_type', 'hacoled_filter_twitter_card_type', 20);

function hacoled_output_head_basics() {
    echo '<meta name="referrer" content="strict-origin-when-cross-origin">' . "\n";

    if (!has_site_icon()) {
        $icon = get_template_directory_uri() . '/assets/images/hacoled-logo-square.jpg';
        echo '<link rel="icon" href="' . esc_url($icon) . '" sizes="500x500">' . "\n";
        echo '<link rel="apple-touch-icon" href="' . esc_url($icon) . '">' . "\n";
    }

    if (defined('RANK_MATH_VERSION') || !is_front_page()) {
        return;
    }

    $title = hacoled_home_seo_title();
    $description = hacoled_home_seo_description();
    $image = hacoled_home_social_image();
    $url = home_url('/');
    $site_name = get_bloginfo('name');

    echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '">' . "\n";
    echo '<meta property="og:locale" content="vi_VN">' . "\n";
    echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url($image) . '">' . "\n";
}
add_action('wp_head', 'hacoled_output_head_basics', 1);

function hacoled_output_home_structured_data() {
    if (!is_front_page()) {
        return;
    }

    $schemas = [
        [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Trang chủ HacoLED',
                    'item' => home_url('/'),
                ],
            ],
        ],
        [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => [
                [
                    '@type' => 'Question',
                    'name' => 'Quy trình khảo sát và thi công màn hình LED diễn ra như thế nào?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'HacoLED thực hiện 5 bước: tiếp nhận và tư vấn, khảo sát mặt bằng, thiết kế và báo giá, thi công lắp đặt, sau đó bàn giao, hướng dẫn vận hành và kích hoạt bảo hành.',
                    ],
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Nguồn gốc linh kiện màn hình LED của HacoLED từ đâu?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Module, card điều khiển và bộ nguồn được nhập khẩu chính ngạch từ các thương hiệu như Novastar, Colorlight và Qiangli, kèm chứng nhận xuất xứ CO và chất lượng CQ theo dự án.',
                    ],
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Chính sách bảo hành và bảo trì hệ thống ra sao?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'HacoLED áp dụng bảo hành tại nơi lắp đặt từ 24 đến 36 tháng, hỗ trợ kỹ thuật trực tuyến 24/7 và bố trí xử lý tại hiện trường khi cần thiết.',
                    ],
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Tuổi thọ trung bình của hệ thống màn hình LED là bao lâu?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Với linh kiện phù hợp và hệ thống tản nhiệt được thi công đúng kỹ thuật, màn hình LED có tuổi thọ thiết kế lên tới 100.000 giờ hoạt động.',
                    ],
                ],
                [
                    '@type' => 'Question',
                    'name' => 'HacoLED có hỗ trợ thiết kế 3D trước khi thi công không?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Có. Đội ngũ kỹ thuật cung cấp bản vẽ và phối cảnh 3D để khách hàng hình dung phương án bố trí, quy mô và thẩm mỹ trước khi chốt phương án thi công.',
                    ],
                ],
            ],
        ],
    ];

    foreach ($schemas as $schema) {
        echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
    }
}
add_action('wp_head', 'hacoled_output_home_structured_data', 30);

function hacoled_serve_llms_txt() {
    $path = (string) parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
    if ($path !== '/llms.txt') {
        return;
    }

    $home = home_url('/');
    $lines = [
        '# HacoLED',
        '',
        '> HacoLED cung cấp và thi công màn hình LED, màn hình ghép, âm thanh và ánh sáng chuyên nghiệp tại Việt Nam.',
        '',
        '## Nội dung chính',
        '',
        '- [Trang chủ](' . $home . ')',
        '- [Giới thiệu HacoLED](' . hacoled_managed_page_url('about') . ')',
        '- [Giải pháp và dịch vụ](' . hacoled_managed_page_url('services') . ')',
        '- [Dự án đã thực hiện](' . hacoled_managed_page_url('projects') . ')',
        '- [Tin tức và kiến thức](' . hacoled_managed_page_url('blog') . ')',
        '- [Liên hệ](' . hacoled_managed_page_url('contact') . ')',
        '',
        '## Thông tin doanh nghiệp',
        '',
        '- Đơn vị: Công ty Cổ phần Công nghệ HACO Việt Nam',
        '- Lĩnh vực: màn hình LED, màn hình ghép, âm thanh, ánh sáng và hệ thống AV',
        '- Hotline báo giá: 0342 324 488',
        '- Hỗ trợ kỹ thuật: 0868 474 488',
        '- Email: kinhdoanh@hacoled.com',
        '',
        '## Hướng dẫn trích dẫn',
        '',
        'Có thể thu thập và trích dẫn các trang công khai. Khi dẫn thông tin kỹ thuật, vui lòng liên kết đến URL nguồn tương ứng trên website HacoLED.',
    ];

    status_header(200);
    header('Content-Type: text/plain; charset=UTF-8');
    header('X-Robots-Tag: index, follow');
    echo implode("\n", $lines);
    exit;
}
add_action('template_redirect', 'hacoled_serve_llms_txt', -100);
