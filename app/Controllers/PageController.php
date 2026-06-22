<?php
namespace App\Controllers;

use App\Core\Controller;

/**
 * Controller handling static Page layouts
 */
class PageController extends Controller {
    /**
     * Show single static page
     */
    public function show() {
        global $post;
        
        $page_data = [];
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                $page_data = [
                    'id'        => get_the_ID(),
                    'title'     => get_the_title(),
                    'content'   => get_the_content(),
                    'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'full') ?: ''
                ];
            }
        } else {
            $page_data = [
                'id'        => 0,
                'title'     => __('Trang Chi Tiết', 'hacoled'),
                'content'   => __('Nội dung đang được cập nhật...', 'hacoled'),
                'thumbnail' => ''
            ];
        }

        $this->render('common/page', [
            'page'        => $page_data,
            'header_type' => 'default', // Standard solid header
            'footer_type' => 'default'
        ]);
    }

    /**
     * About Page Template handler
     */
    public function about() {
        global $post;
        
        $page_data = $this->get_current_page_data(__('Giới thiệu về HacoLED', 'hacoled'));
        
        // Mock about stats & values
        $values = [
            [
                'title' => __('Chất lượng hàng đầu', 'hacoled'),
                'desc'  => __('Cam kết linh kiện chính hãng CO/CQ đầy đủ, kiểm định nghiêm ngặt.', 'hacoled')
            ],
            [
                'title' => __('Giải pháp tối ưu', 'hacoled'),
                'desc'  => __('Tư vấn thiết kế bản vẽ kỹ thuật chi tiết phù hợp với ngân sách của bạn.', 'hacoled')
            ],
            [
                'title' => __('Dịch vụ tận tâm', 'hacoled'),
                'desc'  => __('Hỗ trợ kỹ thuật 24/7, xử lý sự cố nhanh chóng, bảo hành vàng lên tới 3 năm.', 'hacoled')
            ]
        ];

        $this->render('pages/about', [
            'page'        => $page_data,
            'values'      => $values,
            'header_type' => 'default',
            'footer_type' => 'default'
        ]);
    }

    /**
     * Services Page Template handler
     */
    public function services() {
        $page_data = $this->get_current_page_data(__('Dịch vụ chuyên nghiệp', 'hacoled'));

        $this->render('pages/services', [
            'page'        => $page_data,
            'header_type' => 'default',
            'footer_type' => 'default'
        ]);
    }

    /**
     * Contact Page Template handler
     */
    public function contact() {
        $page_data = $this->get_current_page_data(__('Liên hệ HacoLED', 'hacoled'));

        $this->render('pages/contact', [
            'page'        => $page_data,
            'header_type' => 'default',
            'footer_type' => 'default'
        ]);
    }

    /**
     * Service Quality Commitment Page Template handler
     */
    public function commitment() {
        $page_data = $this->get_current_page_data(__('Cam kết chất lượng', 'hacoled'));

        $this->render('pages/commitment', [
            'page'        => $page_data,
            'header_type' => 'default',
            'footer_type' => 'default'
        ]);
    }

    /**
     * Careers Page Template handler
     */
    public function careers() {
        $page_data = $this->get_current_page_data(__('Tuyển dụng HacoLED', 'hacoled'));

        $this->render('pages/careers', [
            'page'        => $page_data,
            'header_type' => 'default',
            'footer_type' => 'default'
        ]);
    }

    /**
     * Job Detail Page Template handler
     */
    public function jobDetail() {
        $page_data = $this->get_current_page_data(__('Chi tiết tuyển dụng', 'hacoled'));

        $this->render('pages/job-detail', [
            'page'        => $page_data,
            'header_type' => 'default',
            'footer_type' => 'default'
        ]);
    }

    /**
     * Helper to query posts by category slug
     */
    private function get_posts_by_category($slug, $count = 4) {
        $args = [
            'post_type'      => 'post',
            'posts_per_page' => $count,
            'category_name'  => $slug,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC'
        ];
        
        $query = new \WP_Query($args);
        $posts = [];
        
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $categories = get_the_category();
                $cat_names = [];
                if (!empty($categories)) {
                    foreach ($categories as $cat) {
                        $cat_names[] = $cat->name;
                    }
                }
                $posts[] = [
                    'id'        => get_the_ID(),
                    'title'     => get_the_title(),
                    'excerpt'   => get_the_excerpt(),
                    'permalink' => get_permalink(),
                    'date'      => get_the_date(),
                    'author'    => get_the_author(),
                    'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'large') ?: '',
                    'category'  => implode(', ', $cat_names) ?: __('Tin tức', 'hacoled')
                ];
            }
            wp_reset_postdata();
        }
        return $posts;
    }

    /**
     * News & Blog Page Template handler
     */
    public function blog() {
        $page_data = $this->get_current_page_data(__('Tin tức & Blog HacoLED', 'hacoled'));
        
        $categories_slugs = [
            'press'   => 'bao-chi-noi-ve-hacoled',
            'audio'   => 'blog-am-thanh',
            'led'     => 'blog-man-hinh-led',
            'tech'    => 'huong-dan-ky-thuat',
            'events'  => 'su-kien-hacoled',
            'news'    => 'tin-tuc',
            'jobs'    => 'tuyen-dung'
        ];
        
        $sections = [];
        foreach ($categories_slugs as $key => $slug) {
            $sections[$key] = $this->get_posts_by_category($slug, 12);
        }

        // Check if all sections are empty
        $is_all_empty = true;
        foreach ($sections as $sec_posts) {
            if (!empty($sec_posts)) {
                $is_all_empty = false;
                break;
            }
        }

        // If no posts exist locally, fall back to high-quality categorized mock data
        if ($is_all_empty) {
            $sections = [
                'press' => [
                    [
                        'id' => 301,
                        'title' => __('Lắp đặt màn hình LED ngoài trời - Giải pháp quảng cáo thu lợi tiền tỷ', 'hacoled'),
                        'excerpt' => __('Báo Thái Nguyên đánh giá cao năng lực thi công màn hình LED quảng cáo ngoài trời của HacoLED, mang lại hiệu quả truyền thông tối ưu và độ bền thách thức thời tiết.', 'hacoled'),
                        'permalink' => '#', 'date' => '05/06/2026', 'author' => 'Báo Thái Nguyên', 'category' => __('Báo chí nói về HacoLED', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 302,
                        'title' => __('HACOLED - Đơn vị cung cấp màn hình LED quảng cáo hàng đầu Việt Nam', 'hacoled'),
                        'excerpt' => __('Trang tin công nghệ TechZ đưa tin về các giải pháp hiển thị và hệ thống điều khiển màn hình LED thông minh do HacoLED cung cấp với công nghệ quét 3840Hz siêu mịn.', 'hacoled'),
                        'permalink' => '#', 'date' => '01/06/2026', 'author' => 'Tech Z', 'category' => __('Báo chí nói về HacoLED', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3021,
                        'title' => __('Màn hình LED hội trường - Công nghệ đột phá trong trải nghiệm sự kiện hội nghị', 'hacoled'),
                        'excerpt' => __('Báo Tuyên Quang nhận định giải pháp LED hội trường của HacoLED giúp hiện đại hóa công sở, nâng cao hiệu quả làm việc và hội thảo đa phương tiện.', 'hacoled'),
                        'permalink' => '#', 'date' => '28/05/2026', 'author' => 'Báo Tuyên Quang', 'category' => __('Báo chí nói về HacoLED', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3022,
                        'title' => __('HACOLED - Đơn vị thi công màn hình LED uy tín, hỗ trợ bảo hành vàng 24 tháng', 'hacoled'),
                        'excerpt' => __('Việt Stock nhận định sự chuyên nghiệp trong khâu lắp đặt và hỗ trợ phản tốc trong 2h là lý do HacoLED được các doanh nghiệp tài chính tin chọn.', 'hacoled'),
                        'permalink' => '#', 'date' => '24/05/2026', 'author' => 'Việt Stock', 'category' => __('Báo chí nói về HacoLED', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3023,
                        'title' => __('HACOLED được vinh danh Thương hiệu AV Pro Xuất sắc nhất năm 2025', 'hacoled'),
                        'excerpt' => __('VnExpress đưa tin về lễ trao giải thương hiệu AV Pro hàng đầu Việt Nam, khẳng định vị thế dẫn đầu của HacoLED trong lĩnh vực hiển thị thông minh.', 'hacoled'),
                        'permalink' => '#', 'date' => '19/05/2026', 'author' => 'VnExpress', 'category' => __('Báo chí nói về HacoLED', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3024,
                        'title' => __('Đánh giá dịch vụ bảo hành vàng 24 tháng tại HacoLED từ góc nhìn khách hàng', 'hacoled'),
                        'excerpt' => __('Báo điện tử Dân Trí thực hiện khảo sát độc lập về dịch vụ hậu mãi, bảo trì định kỳ 6 tháng 1 lần của HacoLED và nhận được phản hồi tích cực.', 'hacoled'),
                        'permalink' => '#', 'date' => '12/05/2026', 'author' => 'Dân Trí', 'category' => __('Báo chí nói về HacoLED', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=800&auto=format&fit=crop'
                    ]
                ],
                'audio' => [
                    [
                        'id' => 303,
                        'title' => __('Cách chọn công suất loa Line Array phù hợp cho hội trường từ 200 - 500 khách', 'hacoled'),
                        'excerpt' => __('Hướng dẫn tính toán công suất RMS, độ nhạy loa và số lượng loa Line Array cần thiết để âm thanh bao phủ đều toàn bộ không gian hội trường lớn.', 'hacoled'),
                        'permalink' => '#', 'date' => '04/06/2026', 'author' => 'Khánh Toàn', 'category' => __('Blog âm thanh', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1470229722913-7c090bf8c04c?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 304,
                        'title' => __('Vang số và Mixer chuyên dụng: Thiết bị nào tốt hơn cho phòng họp cao cấp?', 'hacoled'),
                        'excerpt' => __('So sánh chi tiết khả năng xử lý feedback, căn chỉnh EQ tự động của vang số thông minh so với sự linh hoạt của mixer analog truyền thống.', 'hacoled'),
                        'permalink' => '#', 'date' => '29/05/2026', 'author' => 'Khánh Toàn', 'category' => __('Blog âm thanh', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3041,
                        'title' => __('Căn chỉnh pha (Phase Alignment) hệ thống loa Subwoofer và loa Full-range', 'hacoled'),
                        'excerpt' => __('Bí quyết triệt tiêu sự lệch pha tần số thấp tại điểm giao thoa (Crossover) để mang lại âm bass lực, rõ ràng và uy lực.', 'hacoled'),
                        'permalink' => '#', 'date' => '22/05/2026', 'author' => 'Khánh Toàn', 'category' => __('Blog âm thanh', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3042,
                        'title' => __('Giải pháp Micro cổ ngỗng không dây UHF tích hợp hệ thống họp trực tuyến', 'hacoled'),
                        'excerpt' => __('Tìm hiểu về công nghệ tự động quét tần số sạch, chống trùng kênh và mã hóa bảo mật tín hiệu họp tối tân của HacoLED.', 'hacoled'),
                        'permalink' => '#', 'date' => '15/05/2026', 'author' => 'Khánh Toàn', 'category' => __('Blog âm thanh', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3043,
                        'title' => __('Kinh nghiệm bố trí hệ thống loa âm trần cho văn phòng thông minh chuẩn thẩm mỹ', 'hacoled'),
                        'excerpt' => __('Hướng dẫn đi dây, tính toán khoảng cách lắp loa âm trần để âm thanh phủ đều không gây ù tai hay chồng chéo pha giữa các khu vực.', 'hacoled'),
                        'permalink' => '#', 'date' => '08/05/2026', 'author' => 'Khánh Toàn', 'category' => __('Blog âm thanh', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1484755560693-a4074577af3a?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3044,
                        'title' => __('Lựa chọn amply công suất hay cục đẩy công suất lớn cho hội trường: Phân tích kỹ thuật', 'hacoled'),
                        'excerpt' => __('Khảo sát sự khác biệt về mạch lọc âm, độ méo tiếng THD và khả năng kéo loa trở kháng thấp của cục đẩy so với amply tích hợp.', 'hacoled'),
                        'permalink' => '#', 'date' => '02/05/2026', 'author' => 'Khánh Toàn', 'category' => __('Blog âm thanh', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3045,
                        'title' => __('Phương pháp tối ưu hệ thống micro không dây chống nhiễu sóng trong tòa nhà văn phòng', 'hacoled'),
                        'excerpt' => __('Bí quyết định hướng anten thu phát sóng và thiết lập dải tần UHF phù hợp tránh xa các nguồn nhiễu wifi và sóng vô tuyến nội bộ.', 'hacoled'),
                        'permalink' => '#', 'date' => '25/04/2026', 'author' => 'Khánh Toàn', 'category' => __('Blog âm thanh', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1516280440614-37939bbacd6a?q=80&w=800&auto=format&fit=crop'
                    ]
                ],
                'led' => [
                    [
                        'id' => 305,
                        'title' => __('Màn hình LED COB là gì? Tại sao đây là tương lai của hiển thị độ nét cao?', 'hacoled'),
                        'excerpt' => __('Công nghệ đóng gói trực tiếp Chip-on-Board (COB) giúp tăng khả năng bảo vệ bóng LED gấp 10 lần, tăng độ tương phản và chống lóa mắt vượt trội.', 'hacoled'),
                        'permalink' => '#', 'date' => '06/06/2026', 'author' => 'Khánh Toàn', 'category' => __('Blog màn hình LED', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 306,
                        'title' => __('LED viền mỏng 0.9mm: Giải pháp tối ưu thay thế màn hình ghép LCD', 'hacoled'),
                        'excerpt' => __('Màn hình LED Pitch siêu nhỏ (Fine Pitch) P0.9 mang lại trải nghiệm không viền ghép tuyệt đối, loại bỏ sọc đen cho phòng điều hành.', 'hacoled'),
                        'permalink' => '#', 'date' => '03/06/2026', 'author' => 'Khánh Toàn', 'category' => __('Blog màn hình LED', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3061,
                        'title' => __('Màn hình LED trong suốt (Transparent LED) - Xu hướng cho showroom và mặt kính lớn', 'hacoled'),
                        'excerpt' => __('Với độ xuyên thấu ánh sáng lên đến 80%, màn hình LED dán kính giúp cửa hàng trưng bày thu hút sự chú ý mà không che khuất không gian bên trong.', 'hacoled'),
                        'permalink' => '#', 'date' => '27/05/2026', 'author' => 'Khánh Toàn', 'category' => __('Blog màn hình LED', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3062,
                        'title' => __('Công nghệ màn hình LED tương tác sàn (Interactive LED Floor) trong quảng cáo', 'hacoled'),
                        'excerpt' => __('Màn hình LED sàn chịu lực cao tích hợp cảm biến chuyển động mang lại trải nghiệm trò chơi, sự kiện độc đáo và sống động cho người dùng.', 'hacoled'),
                        'permalink' => '#', 'date' => '21/05/2026', 'author' => 'Khánh Toàn', 'category' => __('Blog màn hình LED', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1492619375914-88005aa9e8fb?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3063,
                        'title' => __('So sánh chip LED SMD và chip LED GOB: Đâu là giải pháp tối ưu cho ngoài trời?', 'hacoled'),
                        'excerpt' => __('Phân tích chuyên sâu về tính chống nước, chống va đập vật lý và hiệu suất phát quang của hai dòng đóng gói chip LED phổ biến nhất hiện nay.', 'hacoled'),
                        'permalink' => '#', 'date' => '14/05/2026', 'author' => 'Khánh Toàn', 'category' => __('Blog màn hình LED', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3064,
                        'title' => __('Màn hình LED cong (Curved LED screen): Giải pháp thẩm mỹ đỉnh cao cho góc tòa nhà', 'hacoled'),
                        'excerpt' => __('Cách ghép nối các cabinet LED uốn cong linh hoạt tạo góc bo tròn 90 độ mượt mà, tạo góc nhìn 3D ấn tượng không vết ghép nối.', 'hacoled'),
                        'permalink' => '#', 'date' => '07/05/2026', 'author' => 'Khánh Toàn', 'category' => __('Blog màn hình LED', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1527689368864-3a821dbccc34?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3065,
                        'title' => __('Tìm hiểu về công nghệ hiển thị HDR trên hệ thống module LED cao cấp', 'hacoled'),
                        'excerpt' => __('Lợi ích từ việc tăng dải tương phản động rộng (HDR) giúp các mảng màu đen sâu thẳm, màu sáng rực rỡ, chân thực tuyệt đối.', 'hacoled'),
                        'permalink' => '#', 'date' => '29/04/2026', 'author' => 'Khánh Toàn', 'category' => __('Blog màn hình LED', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3066,
                        'title' => __('Quy trình thiết kế hệ thống khung giàn thép lực treo màn hình LED tải trọng nặng', 'hacoled'),
                        'excerpt' => __('Tính toán hệ số an toàn lực kéo, tải trọng tĩnh và động khi treo hệ thống cabin LED nhôm đúc nặng hàng tấn lên trần hội trường.', 'hacoled'),
                        'permalink' => '#', 'date' => '22/04/2026', 'author' => 'Khánh Toàn', 'category' => __('Blog màn hình LED', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?q=80&w=800&auto=format&fit=crop'
                    ]
                ],
                'tech' => [
                    [
                        'id' => 307,
                        'title' => __('Hướng dẫn cấu hình card nhận NovaStar MRV300 chi tiết từ A-Z', 'hacoled'),
                        'excerpt' => __('Từng bước hướng dẫn đấu nối cáp tín hiệu mạng Cat6, thiết lập sơ đồ kết nối (Screen Connection) và nạp file cấu hình .rcfgx qua NovaLCT.', 'hacoled'),
                        'permalink' => '#', 'date' => '05/06/2026', 'author' => 'Kỹ thuật HacoLED', 'category' => __('Hướng dẫn kỹ thuật', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 308,
                        'title' => __('Cách khắc phục lỗi màn hình LED bị nháy hình hoặc sọc ngang đỏ', 'hacoled'),
                        'excerpt' => __('Chẩn đoán nguyên nhân nhanh chóng: từ lỏng cáp dẹt 16-pin, hỏng IC điều khiển cho đến sự cố sụt áp nguồn 5V tổ ong.', 'hacoled'),
                        'permalink' => '#', 'date' => '30/05/2026', 'author' => 'Kỹ thuật HacoLED', 'category' => __('Hướng dẫn kỹ thuật', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3081,
                        'title' => __('Tính toán phụ tải nguồn điện và thiết kế tủ điện điều khiển màn hình LED', 'hacoled'),
                        'excerpt' => __('Công thức tính toán dòng khởi động, chọn Aptomat (MCB), khởi động từ và thiết bị bảo vệ quá áp chống sét cho màn hình công suất lớn.', 'hacoled'),
                        'permalink' => '#', 'date' => '25/05/2026', 'author' => 'Kỹ thuật HacoLED', 'category' => __('Hướng dẫn kỹ thuật', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1470229722913-7c090bf8c04c?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3082,
                        'title' => __('Hướng dẫn bảo dưỡng định kỳ và vệ sinh tấm Module LED bằng máy xịt cồn chuyên dụng', 'hacoled'),
                        'excerpt' => __('Bảo dưỡng an toàn: cách khử tĩnh điện, xịt rửa bụi bẩn bám trên linh kiện và làm khô bo mạch tránh cháy chập chéo.', 'hacoled'),
                        'permalink' => '#', 'date' => '19/05/2026', 'author' => 'Kỹ thuật HacoLED', 'category' => __('Hướng dẫn kỹ thuật', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3083,
                        'title' => __('Hướng dẫn cấu hình thiết bị xử lý hình ảnh (Video Processor) LVP615 chuyên hội trường', 'hacoled'),
                        'excerpt' => __('Cách chuyển đổi các cổng tín hiệu đầu vào HDMI, DVI, VGA, cấu hình tỉ lệ scaling hình ảnh không bị méo tỉ lệ màn hình.', 'hacoled'),
                        'permalink' => '#', 'date' => '10/05/2026', 'author' => 'Kỹ thuật HacoLED', 'category' => __('Hướng dẫn kỹ thuật', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3084,
                        'title' => __('Cách khắc phục hiện tượng mất đồng bộ hình ảnh giữa các card nhận NovaStar', 'hacoled'),
                        'excerpt' => __('Phương pháp thiết lập tần số quét dọc (Vertical Sync) và khóa đồng bộ pha tần số giúp các module LED sáng đều tăm tắp.', 'hacoled'),
                        'permalink' => '#', 'date' => '03/05/2026', 'author' => 'Kỹ thuật HacoLED', 'category' => __('Hướng dẫn kỹ thuật', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1581092335397-9583fe92d232?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3085,
                        'title' => __('Các thông số quan trọng cần lưu ý khi setup cấu hình phần mềm điều khiển LedStudio', 'hacoled'),
                        'excerpt' => __('Hướng dẫn điều chỉnh độ xám (Gray Scale), thiết lập tần số quét dòng (Scan Rate) để quay phim qua điện thoại không bị sọc nhiễu.', 'hacoled'),
                        'permalink' => '#', 'date' => '24/04/2026', 'author' => 'Kỹ thuật HacoLED', 'category' => __('Hướng dẫn kỹ thuật', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=800&auto=format&fit=crop'
                    ]
                ],
                'events' => [
                    [
                        'id' => 309,
                        'title' => __('HacoLED ra mắt dòng sản phẩm LED dán kính siêu mỏng tại Triển lãm Vietbuild 2026', 'hacoled'),
                        'excerpt' => __('Sự kiện thu hút hàng trăm chủ đầu tư showroom, nhà hàng tiệc cưới quan tâm đến giải pháp màn hình trong suốt thẩm mỹ cao.', 'hacoled'),
                        'permalink' => '#', 'date' => '02/06/2026', 'author' => 'Sự kiện HacoLED', 'category' => __('Sự kiện HacoLED', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3091,
                        'title' => __('Hội thảo đào tạo kỹ thuật cân chỉnh màu màn hình LED cùng chuyên gia NovaStar', 'hacoled'),
                        'excerpt' => __('Chương trình nâng cao tay nghề cho đội ngũ kỹ sư HacoLED, cập nhật phần mềm hiệu chỉnh điểm ảnh thế hệ mới nhất.', 'hacoled'),
                        'permalink' => '#', 'date' => '26/05/2026', 'author' => 'Sự kiện HacoLED', 'category' => __('Sự kiện HacoLED', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3092,
                        'title' => __('HacoLED đồng hành tài trợ hệ thống hiển thị sân khấu tại Giải thể thao Sinh viên toàn quốc', 'hacoled'),
                        'excerpt' => __('Đồng hành cùng giới trẻ, HacoLED tài trợ 100m² màn hình LED P3.91 ngoài trời siêu sáng phục vụ lễ khai mạc hoành tráng.', 'hacoled'),
                        'permalink' => '#', 'date' => '18/05/2026', 'author' => 'Sự kiện HacoLED', 'category' => __('Sự kiện HacoLED', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3093,
                        'title' => __('HacoLED tổ chức chương trình dã ngoại thường niên thắt chặt tình đoàn kết', 'hacoled'),
                        'excerpt' => __('Hoạt động thường niên xây dựng văn hóa doanh nghiệp lành mạnh, năng động, mang lại động lực bứt phá kế hoạch kinh doanh 2026.', 'hacoled'),
                        'permalink' => '#', 'date' => '11/05/2026', 'author' => 'Sự kiện HacoLED', 'category' => __('Sự kiện HacoLED', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3094,
                        'title' => __('Ký kết thỏa thuận hợp tác nghiên cứu và chuyển giao công nghệ cùng ĐH Bách Khoa', 'hacoled'),
                        'excerpt' => __('Lễ ký kết mở ra cơ hội nghiên cứu phát triển các giải pháp phần mềm quản lý và giám sát lỗi bóng LED tự động thông minh.', 'hacoled'),
                        'permalink' => '#', 'date' => '04/05/2026', 'author' => 'Sự kiện HacoLED', 'category' => __('Sự kiện HacoLED', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1515187029135-18ee286d815b?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3095,
                        'title' => __('HacoLED chính thức cán mốc dự án lắp đặt thứ 500 thành công trên toàn quốc', 'hacoled'),
                        'excerpt' => __('Cột mốc đáng tự hào đánh dấu sự tin tưởng tuyệt đối của hàng trăm cơ quan nhà nước, doanh nghiệp lớn dành cho HacoLED.', 'hacoled'),
                        'permalink' => '#', 'date' => '27/04/2026', 'author' => 'Sự kiện HacoLED', 'category' => __('Sự kiện HacoLED', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1529070538774-1843cb3265df?q=80&w=800&auto=format&fit=crop'
                    ]
                ],
                'news' => [
                    [
                        'id' => 310,
                        'title' => __('Chia sẻ kinh nghiệm vàng để tính khoảng cách nhìn tối ưu của màn hình LED hội trường', 'hacoled'),
                        'excerpt' => __('Công thức đơn giản và chính xác dựa trên pixel pitch: Khoảng cách tối thiểu = Pixel Pitch x 1000 (mm) giúp tránh mỏi mắt người họp.', 'hacoled'),
                        'permalink' => '#', 'date' => '06/06/2026', 'author' => 'Ban chuyên gia', 'category' => __('Chia sẻ kinh nghiệm', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3101,
                        'title' => __('Lựa chọn bóng LED SMD hay bóng LED COB cho phòng điều khiển giám sát 24/7?', 'hacoled'),
                        'excerpt' => __('Phân tích chuyên sâu từ các chuyên gia HacoLED giúp doanh nghiệp tối ưu chi phí đầu tư ban đầu và giảm thiểu tối đa tỷ lệ bóng hỏng.', 'hacoled'),
                        'permalink' => '#', 'date' => '02/06/2026', 'author' => 'Ban chuyên gia', 'category' => __('Chia sẻ kinh nghiệm', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3102,
                        'title' => __('Kinh nghiệm thực tế lắp đặt màn hình LED ngoài trời chống chói dưới ánh nắng gắt', 'hacoled'),
                        'excerpt' => __('Các biện pháp kỹ thuật thiết yếu: Chọn bóng LED độ sáng trên 5500 nits, dán kính lọc sắc và tích hợp cảm biến ánh sáng tự động.', 'hacoled'),
                        'permalink' => '#', 'date' => '28/05/2026', 'author' => 'Ban chuyên gia', 'category' => __('Chia sẻ kinh nghiệm', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3103,
                        'title' => __('Bảo quản màn hình LED hội trường vào mùa nồm ẩm tránh chập bo mạch điều khiển', 'hacoled'),
                        'excerpt' => __('Bật màn hình LED chạy test sấy khô ít nhất 30 phút mỗi ngày và duy trì độ ẩm phòng họp dưới 60% bằng máy hút ẩm chuyên dụng.', 'hacoled'),
                        'permalink' => '#', 'date' => '20/05/2026', 'author' => 'Ban chuyên gia', 'category' => __('Chia sẻ kinh nghiệm', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3104,
                        'title' => __('Chia sẻ kinh nghiệm chọn mua màn hình LED cũ: Làm sao để không bị lừa?', 'hacoled'),
                        'excerpt' => __('Các bước kiểm tra số giờ hoạt động trong card nhận, độ suy hao ánh sáng của bóng và nguồn cấp điện cũ tránh tiền mất tật mang.', 'hacoled'),
                        'permalink' => '#', 'date' => '13/05/2026', 'author' => 'Ban chuyên gia', 'category' => __('Chia sẻ kinh nghiệm', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1531297484001-80022131f5a1?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3105,
                        'title' => __('Doanh nghiệp nên thuê hay mua đứt màn hình LED cho các chiến dịch sự kiện ngắn ngày?', 'hacoled'),
                        'excerpt' => __('Bài toán chi phí khấu hao thiết bị chi tiết giúp bộ phận Marketing đưa ra quyết định thông thái và tiết kiệm ngân sách nhất.', 'hacoled'),
                        'permalink' => '#', 'date' => '05/05/2026', 'author' => 'Ban chuyên gia', 'category' => __('Chia sẻ kinh nghiệm', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3106,
                        'title' => __('Kinh nghiệm thương lượng giá lắp đặt và tối ưu hồ sơ thầu màn hình LED dự án lớn', 'hacoled'),
                        'excerpt' => __('Bí quyết chuẩn bị hồ sơ năng lực thi công, các chứng chỉ chất lượng CO/CQ chính hãng và cam kết bảo hành thuyết phục chủ đầu tư.', 'hacoled'),
                        'permalink' => '#', 'date' => '28/04/2026', 'author' => 'Ban chuyên gia', 'category' => __('Chia sẻ kinh nghiệm', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1450133064473-71024230f91b?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3107,
                        'title' => __('Xu hướng tích hợp âm thanh hội thảo thông minh và màn hình ghép trong năm 2026', 'hacoled'),
                        'excerpt' => __('Tìm hiểu giải pháp phòng họp không giấy tờ hiện đại, tương thích hoàn hảo các nền tảng họp trực tuyến Zoom, Microsoft Teams.', 'hacoled'),
                        'permalink' => '#', 'date' => '21/04/2026', 'author' => 'Ban chuyên gia', 'category' => __('Chia sẻ kinh nghiệm', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=800&auto=format&fit=crop'
                    ]
                ],
                'jobs' => [
                    [
                        'id' => 311,
                        'title' => __('Tuyển dụng Kỹ sư lắp đặt màn hình LED & Âm thanh ánh sáng làm việc tại HN & HCM', 'hacoled'),
                        'excerpt' => __('HacoLED tuyển dụng 5 vị trí kỹ sư hiện trường, lắp đặt cấu hình card NovaStar, vận hành âm thanh sự kiện hội trường lớn.', 'hacoled'),
                        'permalink' => '#', 'date' => '06/06/2026', 'author' => 'Phòng Nhân Sự', 'category' => __('Tuyển dụng', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3111,
                        'title' => __('Tuyển dụng Nhân viên Kinh doanh giải pháp AV Pro - Thu nhập up to 30 triệu đồng', 'hacoled'),
                        'excerpt' => __('Tìm kiếm chiến binh mở rộng thị trường màn hình ghép LCD, màn hình quảng cáo, âm thanh hội nghị cơ quan doanh nghiệp.', 'hacoled'),
                        'permalink' => '#', 'date' => '01/06/2026', 'author' => 'Phòng Nhân Sự', 'category' => __('Tuyển dụng', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3112,
                        'title' => __('Tuyển dụng Nhân viên Kỹ thuật sửa chữa phần cứng điện tử bo mạch LED', 'hacoled'),
                        'excerpt' => __('Tuyển kỹ thuật viên có khả năng hàn chip LED, sửa bo mạch nguồn, card nhận NovaStar làm việc tại trung tâm bảo hành HN.', 'hacoled'),
                        'permalink' => '#', 'date' => '25/05/2026', 'author' => 'Phòng Nhân Sự', 'category' => __('Tuyển dụng', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3113,
                        'title' => __('Tuyển dụng Chuyên viên Content Marketing mảng công nghệ LED & AV Pro', 'hacoled'),
                        'excerpt' => __('Chịu trách nhiệm biên tập các cẩm nang hướng dẫn kỹ thuật, viết bài chia sẻ kinh nghiệm lắp đặt màn hình LED trên HacoLED Journal.', 'hacoled'),
                        'permalink' => '#', 'date' => '18/05/2026', 'author' => 'Phòng Nhân Sự', 'category' => __('Tuyển dụng', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1432821596592-e2c18b78144f?q=80&w=800&auto=format&fit=crop'
                    ],
                    [
                        'id' => 3114,
                        'title' => __('Tuyển dụng Thực tập sinh Kỹ thuật Điện - Điện tử (Có hỗ trợ phụ cấp và đào tạo)', 'hacoled'),
                        'excerpt' => __('Chương trình đào tạo thực tế 3 tháng cấu hình phần mềm NovaLCT, đấu nối cáp tín hiệu mạng và bảo trì tấm module LED.', 'hacoled'),
                        'permalink' => '#', 'date' => '10/05/2026', 'author' => 'Phòng Nhân Sự', 'category' => __('Tuyển dụng', 'hacoled'),
                        'thumbnail' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=800&auto=format&fit=crop'
                    ]
                ]
            ];
        }

        $this->render('pages/blog', [
            'page'        => $page_data,
            'sections'    => $sections,
            'header_type' => 'default',
            'footer_type' => 'default'
        ]);
    }

    /**
     * Projects List Page Template handler
     */
    public function projects() {
        $page_data = $this->get_current_page_data(__('Dự án tiêu biểu HacoLED', 'hacoled'));

        // Query standard WP posts belonging to project category or custom query
        $args = [
            'post_type'      => 'post',
            'posts_per_page' => -1, // get all projects
            'category_name'  => 'du-an',
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC'
        ];

        $query = new \WP_Query($args);
        
        // If category 'du-an' doesn't exist, search generally or fall back
        if (!$query->have_posts()) {
            $args['category_name'] = 'projects';
            $query = new \WP_Query($args);
        }

        $projects = [];
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $categories = get_the_category();
                $cat_name = !empty($categories) ? $categories[0]->name : __('Dự án', 'hacoled');
                
                $tech_specs = get_post_meta(get_the_ID(), '_project_tech_specs', true);
                if (empty($tech_specs)) {
                    $tech_specs = 'LED P3.0 | 4K UHD';
                }

                $projects[] = [
                    'id'         => get_the_ID(),
                    'title'      => get_the_title(),
                    'category'   => $cat_name,
                    'excerpt'    => get_the_excerpt(),
                    'permalink'  => get_permalink(),
                    'thumbnail'  => get_the_post_thumbnail_url(get_the_ID(), 'large') ?: '',
                    'tech_specs' => $tech_specs,
                    'year'       => get_the_date('Y'),
                    'client'     => get_post_meta(get_the_ID(), '_project_client', true) ?: __('Chủ đầu tư HacoLED', 'hacoled')
                ];
            }
            wp_reset_postdata();
        }

        // If no projects exist in the database, fall back to the premium mock projects list
        if (empty($projects)) {
            $projects = [
                [
                    'id'         => 201,
                    'title'      => __('Lắp đặt màn hình LED P3 trong nhà tại Phố Xanh Building', 'hacoled'),
                    'category'   => __('Dự án trong nhà', 'hacoled'),
                    'excerpt'    => __('Thi công lắp đặt màn hình LED P3 trong nhà độ sắc nét cao phục vụ hội thảo và trình chiếu nội dung truyền thông cho Phố Xanh Building.', 'hacoled'),
                    'permalink'  => '#',
                    'thumbnail'  => 'https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?q=80&w=800&auto=format&fit=crop',
                    'tech_specs' => 'LED P3.0 | 1800Hz | 35m²',
                    'year'       => '2026',
                    'client'     => 'Phố Xanh Building'
                ],
                [
                    'id'         => 202,
                    'title'      => __('Lắp đặt màn hình LED P1.5 trong nhà tại CT Cổ Phần Đầu Tư FORTUNE', 'hacoled'),
                    'category'   => __('Dự án trong nhà', 'hacoled'),
                    'excerpt'    => __('Giải pháp hiển thị cực nét với pixel pitch siêu nhỏ P1.5, phục vụ họp trực tuyến và trưng bày sản phẩm sang trọng tại văn phòng Fortune.', 'hacoled'),
                    'permalink'  => '#',
                    'thumbnail'  => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=800&auto=format&fit=crop',
                    'tech_specs' => 'LED P1.53 | COB | 18m²',
                    'year'       => '2026',
                    'client'     => 'CT Cổ Phần Đầu Tư FORTUNE'
                ],
                [
                    'id'         => 203,
                    'title'      => __('Lắp đặt màn hình LED P3.91 cho Trường THPT FPT Tây Hà Nội', 'hacoled'),
                    'category'   => __('Dự án ngoài trời', 'hacoled'),
                    'excerpt'    => __('Màn hình LED ngoài trời chịu nước bụi IP65, độ sáng >5500 nits, phục vụ các hoạt động chào cờ, thể thao ngoài trời của nhà trường.', 'hacoled'),
                    'permalink'  => '#',
                    'thumbnail'  => 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?q=80&w=800&auto=format&fit=crop',
                    'tech_specs' => 'LED P3.91 Outdoor | IP65 | 50m²',
                    'year'       => '2026',
                    'client'     => 'Trường THPT FPT Tây Hà Nội'
                ],
                [
                    'id'         => 204,
                    'title'      => __('Lắp đặt màn hình LED P3 trong nhà tại thôn Ngọc – Hưng Yên', 'hacoled'),
                    'category'   => __('Dự án trong nhà', 'hacoled'),
                    'excerpt'    => __('Lắp đặt màn hình LED P3 phục vụ các sự kiện, đại hội chính trị xã hội và văn nghệ quần chúng tại Nhà văn hóa thôn Ngọc.', 'hacoled'),
                    'permalink'  => '#',
                    'thumbnail'  => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?q=80&w=800&auto=format&fit=crop',
                    'tech_specs' => 'LED P3.0 | 3840Hz | 24m²',
                    'year'       => '2026',
                    'client'     => 'Nhà văn hóa thôn Ngọc – Hưng Yên'
                ],
                [
                    'id'         => 205,
                    'title'      => __('Lắp đặt màn hình LED P2 trong nhà tại Học Viện Kỹ Thuật Mật Mã', 'hacoled'),
                    'category'   => __('Dự án trong nhà', 'hacoled'),
                    'excerpt'    => __('Hệ thống màn hình LED phòng họp trực tuyến độ nét cao, tương thích trực tiếp các thiết bị truyền hình hội nghị chuyên dụng.', 'hacoled'),
                    'permalink'  => '#',
                    'thumbnail'  => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=800&auto=format&fit=crop',
                    'tech_specs' => 'LED P2.0 | High Refresh | 15m²',
                    'year'       => '2026',
                    'client'     => 'Học Viện Kỹ Thuật Mật Mã'
                ],
                [
                    'id'         => 206,
                    'title'      => __('Lắp đặt màn hình LED P2 trong nhà tại Công Ty TNHH MTV Cao Su 75', 'hacoled'),
                    'category'   => __('Dự án trong nhà', 'hacoled'),
                    'excerpt'    => __('Trang bị màn hình LED P2 cho hội trường lớn phục vụ hội nghị tổng kết, giao ban định kỳ của ban lãnh đạo và đối tác.', 'hacoled'),
                    'permalink'  => '#',
                    'thumbnail'  => 'https://images.unsplash.com/photo-1492619375914-88005aa9e8fb?q=80&w=800&auto=format&fit=crop',
                    'tech_specs' => 'LED P2.0 | Ultra Flat | 28m²',
                    'year'       => '2026',
                    'client'     => 'Công Ty TNHH MTV Cao Su 75'
                ],
                [
                    'id'         => 207,
                    'title'      => __('Hệ thống âm thanh hội trường & Ánh sáng sân khấu tại Trung tâm Hội nghị Quốc gia', 'hacoled'),
                    'category'   => __('Âm thanh & Ánh sáng', 'hacoled'),
                    'excerpt'    => __('Đồng bộ toàn diện hệ thống âm thanh loa Array từ các hãng danh tiếng châu Âu phối hợp với đèn Moving Head, đèn Par LED cao cấp.', 'hacoled'),
                    'permalink'  => '#',
                    'thumbnail'  => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?q=80&w=800&auto=format&fit=crop',
                    'tech_specs' => 'Loa Array | Mixer Midas | 24 Cặp',
                    'year'       => '2025',
                    'client'     => 'Trung tâm Hội nghị Quốc gia'
                ],
                [
                    'id'         => 208,
                    'title'      => __('Lắp đặt màn hình ghép LCD 3x2 tại Tổng Cục Kỹ Thuật – Bộ Quốc Phòng', 'hacoled'),
                    'category'   => __('Màn hình Ghép', 'hacoled'),
                    'excerpt'    => __('Hệ thống màn hình ghép Video Wall LG viền ghép siêu mỏng 0.88mm hoạt động 24/7 phục vụ giám sát và chỉ huy tác chiến.', 'hacoled'),
                    'permalink'  => '#',
                    'thumbnail'  => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=800&auto=format&fit=crop',
                    'tech_specs' => 'LCD 55" | Bezel 0.88mm | 3x2 Matrix',
                    'year'       => '2025',
                    'client'     => 'Tổng Cục Kỹ Thuật – Bộ Quốc Phòng'
                ]
            ];
        }

        $this->render('pages/projects', [
            'page'        => $page_data,
            'projects'    => $projects,
            'header_type' => 'default',
            'footer_type' => 'default'
        ]);
    }

    /**
     * Private helper to fetch active page content or return fallback
     */
    private function get_current_page_data($fallback_title) {
        $page_data = [];
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                $page_data = [
                    'id'        => get_the_ID(),
                    'title'     => get_the_title(),
                    'content'   => get_the_content(),
                    'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'full') ?: ''
                ];
            }
        } else {
            $page_data = [
                'id'        => 0,
                'title'     => $fallback_title,
                'content'   => __('Nội dung đang được soạn thảo...', 'hacoled'),
                'thumbnail' => ''
            ];
        }
        return $page_data;
    }
}
