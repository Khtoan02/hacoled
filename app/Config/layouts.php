<?php
/**
 * Universal HacoLED layout catalog.
 *
 * Each layout has one stable key and can be assigned to exactly one content
 * item globally. A controller action or per-type view provides its rendering.
 */

defined('ABSPATH') || exit;

return [
    'post_types' => ['page', 'post', 'product', 'job'],
    'layouts' => [
        'about' => [
            'label'       => 'Giới thiệu HacoLED',
            'description' => 'Giao diện giới thiệu doanh nghiệp, năng lực và giá trị cốt lõi.',
            'controller_action' => 'about',
            'implementations' => [
                'page' => ['type' => 'page_template', 'template' => 'page-templates/about.php'],
            ],
        ],
        'building_led' => [
            'label'       => 'LED trang trí toà nhà',
            'description' => 'Giao diện chuyên biệt cho ngành hàng LED trang trí toà nhà.',
            'controller_action' => 'buildingLed',
            'implementations' => [
                'page' => ['type' => 'page_template', 'template' => 'page-templates/building-led.php'],
            ],
        ],
        'services' => [
            'label'       => 'Dịch vụ HacoLED',
            'description' => 'Giao diện trình bày danh sách và quy trình dịch vụ.',
            'controller_action' => 'services',
            'implementations' => [
                'page' => ['type' => 'page_template', 'template' => 'page-templates/services.php'],
            ],
        ],
        'projects' => [
            'label'       => 'Dự án HacoLED',
            'description' => 'Giao diện hồ sơ năng lực và danh sách dự án.',
            'controller_action' => 'projects',
            'implementations' => [
                'page' => ['type' => 'page_template', 'template' => 'page-templates/projects.php'],
            ],
        ],
        'blog' => [
            'label'       => 'Tin tức & Blog HacoLED',
            'description' => 'Giao diện tạp chí và nhóm nội dung theo chuyên mục.',
            'controller_action' => 'blog',
            'implementations' => [
                'page' => ['type' => 'page_template', 'template' => 'page-templates/blog.php'],
            ],
        ],
        'commitment' => [
            'label'       => 'Cam kết chất lượng dịch vụ',
            'description' => 'Giao diện trình bày cam kết, tiêu chuẩn và chính sách dịch vụ.',
            'controller_action' => 'commitment',
            'implementations' => [
                'page' => ['type' => 'page_template', 'template' => 'page-templates/commitment.php'],
            ],
        ],
        'careers' => [
            'label'       => 'Tuyển dụng HacoLED',
            'description' => 'Giao diện danh sách cơ hội nghề nghiệp.',
            'controller_action' => 'careers',
            'implementations' => [
                'page' => ['type' => 'page_template', 'template' => 'page-templates/careers.php'],
            ],
        ],
        'job_detail' => [
            'label'       => 'Chi tiết tuyển dụng',
            'description' => 'Giao diện nội dung chi tiết cho vị trí tuyển dụng.',
            'controller_action' => 'jobDetail',
            'implementations' => [
                'page' => ['type' => 'page_template', 'template' => 'page-templates/job-detail.php'],
                'job'  => ['type' => 'view', 'view' => 'pages/job-detail'],
            ],
        ],
        'contact' => [
            'label'       => 'Liên hệ HacoLED',
            'description' => 'Giao diện thông tin liên hệ và lời kêu gọi hành động.',
            'controller_action' => 'contact',
            'implementations' => [
                'page' => ['type' => 'page_template', 'template' => 'page-templates/contact.php'],
            ],
        ],
        'full_width' => [
            'label'       => 'Nội dung toàn chiều rộng',
            'description' => 'Bố cục rộng dành cho nội dung trình bày tự do.',
            'implementations' => [
                'page' => ['type' => 'view', 'view' => 'common/page-full-width'],
                'post' => ['type' => 'view', 'view' => 'common/single-editorial'],
                'product' => ['type' => 'view', 'view' => 'catalog/product-spotlight'],
                'job' => ['type' => 'view', 'view' => 'pages/job-detail'],
            ],
        ],
        'editorial' => [
            'label'       => 'Editorial',
            'description' => 'Hero ảnh lớn và vùng đọc tập trung, không sử dụng sidebar.',
            'implementations' => [
                'page' => ['type' => 'view', 'view' => 'common/page-full-width'],
                'post' => ['type' => 'view', 'view' => 'common/single-editorial'],
                'product' => ['type' => 'view', 'view' => 'catalog/product-spotlight'],
                'job' => ['type' => 'view', 'view' => 'pages/job-detail'],
            ],
        ],
        'spotlight' => [
            'label'       => 'Spotlight / Nội dung nổi bật',
            'description' => 'Thiết kế hero nổi bật được triển khai riêng theo từng loại nội dung.',
            'implementations' => [
                'page'    => ['type' => 'view', 'view' => 'common/page-full-width'],
                'post'    => ['type' => 'view', 'view' => 'common/single-editorial'],
                'product' => ['type' => 'view', 'view' => 'catalog/product-spotlight'],
                'job'     => ['type' => 'view', 'view' => 'pages/job-detail'],
            ],
        ],
    ],
];
