<?php
/**
 * Category Ad Landing Page View - Ultra-Premium Flagship Aceternity UI Edition
 * 
 * Styled in 100% exact alignment with the flagship "LED Trang Trí Tòa Nhà" (building-led.php)
 * Featuring:
 * - Section 1: Cinematic Full 100vh Viewport Hero + 4K Background + Ultra-Transparent Glassmorphism
 * - Section 2: Aceternity Bento Feature Grid ("Tại Sao Chọn HacoLED")
 * - Section 3: 7 Dedicated Subcategory Sections with 1-Row Horizontal Slider (Trình bày 1 hàng ngang duy nhất)
 * - Section 4: Real Projects Staggered Masonry Gallery + Lightbox
 * - Section 5: High-Impact B2B Solution Packages
 * - Section 6: Executive Brand Statement & Engineering Team
 * - Section 7: Client Testimonial Reviews
 * - Section 8: FAQ Accordion & Direct Engineering Support Box
 * - Interactive Quick Quote Modal & Mobile Sticky Action Bar
 *
 * @var WP_Term|null $current_term
 * @var string       $category_name
 * @var string       $description
 * @var array        $products
 * @var array        $subcat_sections
 * @var string       $header_type
 * @var string       $footer_type
 */

$this->renderHeader($header_type ?? 'default');

$hotline = get_theme_mod('hacoled_hotline', '0988.591.119');
$hotline_clean = preg_replace('/[^0-9]/', '', $hotline);
$zalo_url = 'https://zalo.me/' . $hotline_clean;
$theme_uri = get_template_directory_uri();
$hero_bg_url = $theme_uri . '/assets/images/hero-led-outdoor-building.png';

// Curated 7 subcategory metadata mapping with rich fallbacks (5-6 products each for 1-row horizontal testing)
$subcat_definitions = [
    'man-hinh-led-trong-nha' => [
        'name'        => 'Màn Hình LED Trong Nhà',
        'watermark'   => 'INDOOR',
        'badge'       => 'DANH MỤC 01 · BÁN CHẠY NHẤT',
        'subtitle'    => 'Hội Trường, Phòng Họp Trực Tuyến & Tiệc Cưới',
        'desc'        => 'Dòng sản phẩm LED siêu nét P0.9, P1.25, P1.53, P2.0, P2.5, P3.0 chuyên dụng cho hội trường, phòng hội nghị và trung tâm tiệc cưới. Tần số quét 3840Hz, góc nhìn 160° bảo vệ mắt.',
        'highlight'   => 'Công nghệ COB & SMD cao cấp · Tần số quét 3840Hz · Chống lóa mắt góc rộng 160°',
        'fallback_products' => [
            [
                'name'        => 'Màn Hình LED P0.9 Trong Nhà COB MicroLED Siêu Cao Cấp',
                'desc'        => 'Công nghệ MicroLED COB tân tiến bậc nhất, điểm ảnh siêu nhỏ P0.93, độ tương phản tuyệt đối 10.000:1, chuẩn hiển thị rạp chiếu phim tại gia và phòng khánh tiết.',
                'image'       => $theme_uri . '/assets/images/services-indoor-640.webp',
                'price_html'  => 'Từ 45.000.000đ/m²',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED P1.25 Trong Nhà Độ Nét 4K/8K Hội Nghị',
                'desc'        => 'Module P1.25 siêu mịn, xem cận cảnh từ 1.2 mét không lộ điểm ảnh, tần số quét 3840Hz hiển thị tài liệu Excel, biểu đồ tài chính sắc nét.',
                'image'       => $theme_uri . '/assets/images/home-solution-led-640.webp',
                'price_html'  => 'Từ 28.500.000đ/m²',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED P1.53 Trong Nhà COB Siêu Nét',
                'desc'        => 'Module LED siêu nét công nghệ COB mới nhất 2026, chống ẩm chống bụi bề mặt, góc nhìn siêu rộng 160 độ, không gây mỏi mắt trong phòng họp.',
                'image'       => $theme_uri . '/assets/images/services-indoor-640.webp',
                'price_html'  => 'Từ 18.500.000đ/m²',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED P2.0 Trong Nhà Hội Trường Cao Cấp',
                'desc'        => 'Dòng màn hình LED hội trường tiêu chuẩn vàng, màu sắc rực rỡ, độ phân giải sắc nét ở cự ly xem từ 2 mét, tương thích mọi thiết bị chia hình.',
                'image'       => $theme_uri . '/assets/images/home-solution-led-640.webp',
                'price_html'  => 'Từ 14.200.000đ/m²',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED P2.5 Trong Nhà Phòng Họp Trực Tuyến',
                'desc'        => 'Giải pháp thay thế máy chiếu truyền thống, độ sáng cao gấp 3 lần, không bóng mờ, tuổi thọ 100.000 giờ, cabin nhôm đúc định hình mỏng nhẹ.',
                'image'       => $theme_uri . '/assets/images/product-led-module-640.webp',
                'price_html'  => 'Từ 10.800.000đ/m²',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED P3.0 Trong Nhà Sân Khấu Tiệc Cưới',
                'desc'        => 'Kích thước hiển thị lớn, màu sắc sống động, độ tương phản 5000:1, tối ưu chi phí cho nhà hàng tiệc cưới và trung tâm tổ chức sự kiện.',
                'image'       => $theme_uri . '/assets/images/showcase-led-640.webp',
                'price_html'  => 'Từ 8.900.000đ/m²',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
        ],
    ],
    'man-hinh-led-ngoai-troi' => [
        'name'        => 'Màn Hình LED Ngoài Trời',
        'watermark'   => 'OUTDOOR',
        'badge'       => 'DANH MỤC 02 · KHÁNG NƯỚC IP65',
        'subtitle'    => 'Chống Chói Nắng, Độ Sáng 8000 Nits & Bền Bỉ Thời Tiết',
        'desc'        => 'Dòng màn hình LED ngoài trời P2.5, P3.0, P4.0, P5.0, P10 chuyên dụng cho sự kiện quảng trường, sân vận động và biển hiệu mặt tiền tòa nhà cao tầng.',
        'highlight'   => 'Kháng nước chuẩn IP65 · Độ sáng vượt trội 6000-8000 nits · Chịu nhiệt từ -20°C đến +65°C',
        'fallback_products' => [
            [
                'name'        => 'Màn Hình LED P2.5 Ngoài Trời Siêu Sắc Nét 6000 nits',
                'desc'        => 'Màn hình LED ngoài trời cự ly quan sát gần, độ phân giải cực cao, chuyên dùng cho cổng chào trung tâm thương mại và lối vào khách sạn 5 sao.',
                'image'       => $theme_uri . '/assets/images/services-outdoor-640.webp',
                'price_html'  => 'Từ 28.000.000đ/m²',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED P3.0 Ngoài Trời Kháng Nước IP65 Nationstar',
                'desc'        => 'Độ sáng 6500 nits hiển thị rõ nét dưới ánh nắng trực tiếp, chuẩn IP65 kháng mưa bão, sử dụng chip LED Nationstar chính hãng tuổi thọ cao.',
                'image'       => $theme_uri . '/assets/images/services-outdoor-640.webp',
                'price_html'  => 'Từ 22.000.000đ/m²',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED P4.0 Ngoài Trời Sự Kiện Quảng Trường',
                'desc'        => 'Cabinet thép sơn tĩnh điện chống ăn mòn muối biển, kết cấu chịu tải gió bão cấp 12, màu sắc rực rỡ thu hút mọi góc nhìn công cộng.',
                'image'       => $theme_uri . '/assets/images/Building_with_LED_lighting_4K_202608031635.jpeg',
                'price_html'  => 'Từ 16.500.000đ/m²',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED P5.0 Ngoài Trời Biển Quảng Cáo Cao Tốc',
                'desc'        => 'Tầm nhìn xa trên 20 mét, tiết kiệm 30% điện năng so với công nghệ cũ, cảm biến tự động điều chỉnh độ sáng ngày và đêm thông minh.',
                'image'       => $theme_uri . '/assets/images/Modern_building_LED_decoration_4K_202608031454.jpeg',
                'price_html'  => 'Từ 13.500.000đ/m²',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED P6.0 Ngoài Trời Sân Vận Động Thể Thao',
                'desc'        => 'Tốc độ phản hồi cao hiển thị bảng tỷ số, pha phát lại bóng đá trực tiếp, khung cabinet chống rung giật cơ học mạnh mẽ.',
                'image'       => $theme_uri . '/assets/images/services-outdoor-640.webp',
                'price_html'  => 'Từ 11.500.000đ/m²',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED P10 Ngoài Trời Biển Bảng DOOH Tấm Lớn',
                'desc'        => 'Kích thước hàng trăm mét vuông lắp đặt trên cao, độ sáng 8000 nits siêu bền bỉ, tối ưu chi phí vận hành lâu năm.',
                'image'       => $theme_uri . '/assets/images/Building_with_LED_lighting_4K_202608031635.jpeg',
                'price_html'  => 'Từ 9.500.000đ/m²',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
        ],
    ],
    'man-hinh-led-quang-cao' => [
        'name'        => 'Màn Hình LED Quảng Cáo',
        'watermark'   => 'BILLBOARD',
        'badge'       => 'DANH MỤC 03 · DOOH QUẢNG CÁO TẤM LỚN',
        'subtitle'    => 'Mặt Tiền Tòa Nhà, TTTM & Poster Điện Tử Di Động',
        'desc'        => 'Giải pháp quảng cáo kỹ thuật số ngoài trời (DOOH), poster LED di động showroom và biển bảng màn hình LED trung tâm thương mại điều khiển từ xa qua Cloud.',
        'highlight'   => 'Điều khiển nội dung từ xa qua Cloud IoT · Tiết kiệm điện năng 35% · Khung thép kết cấu chịu bão',
        'fallback_products' => [
            [
                'name'        => 'Màn Hình LED Billboard Mặt Tiền Trung Tâm Thương Mại',
                'desc'        => 'Kích thước hàng trăm mét vuông, độ sáng 8000 nits, lập trình quản lý phát video theo lịch trình linh hoạt từ xa qua máy tính hoặc điện thoại.',
                'image'       => $theme_uri . '/assets/images/Modern_building_LED_decoration_4K_202608031454.jpeg',
                'price_html'  => 'Báo giá theo dự án',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Poster LED Điện Tử Đứng Di Động Showroom P2.0',
                'desc'        => 'Thiết kế chân đứng siêu mỏng sang trọng, tích hợp bánh xe di chuyển, kết nối WiFi/4G/USB cắm chạy ngay, thay thế hoàn toàn standee giấy.',
                'image'       => $theme_uri . '/assets/images/product-videowall-640.webp',
                'price_html'  => 'Từ 25.000.000đ/bộ',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED Quảng Cáo Cột Trụ Độc Lập Cao Tốc',
                'desc'        => 'Kết cấu trụ thép mạ kẽm đơn hoặc đôi chịu bão cấp 13, hệ thống thang leo bảo trì an toàn phía sau, vận hành 24/7/365 bền bỉ.',
                'image'       => $theme_uri . '/assets/images/Building_with_LED_lighting_4K_202608031635.jpeg',
                'price_html'  => 'Báo giá theo dự án',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED Quảng Cáo Trong Thang Máy & Sảnh Chờ',
                'desc'        => 'Kích thước nhỏ gọn, độ phân giải full HD, quản lý tập trung hàng trăm màn hình qua Cloud CMS, phát sóng banner & TVC liên tục.',
                'image'       => $theme_uri . '/assets/images/home-solution-led-640.webp',
                'price_html'  => 'Từ 15.000.000đ/bộ',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED Cột Banner Đèn Đường Smart City',
                'desc'        => 'Đồng bộ phát tin tức, thông báo thời tiết và quảng cáo đô thị thông minh hai mặt, kháng nước chống bụi IP65.',
                'image'       => $theme_uri . '/assets/images/services-outdoor-640.webp',
                'price_html'  => 'Báo giá theo dự án',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
        ],
    ],
    'ung-dung-man-hinh-led' => [
        'name'        => 'Ứng Dụng Màn Hình LED',
        'watermark'   => 'SOLUTIONS',
        'badge'       => 'DANH MỤC 04 · GIẢI PHÁP TRỌN GÓI',
        'subtitle'    => 'Tối Ưu Hóa Theo Ngành Nghề & Mục Đích Sử Dụng',
        'desc'        => 'Các gói giải pháp màn hình LED trọn gói cho Trung tâm điều hành thông minh (NOC/SOC), Giáo dục trường học, Bệnh viện y tế và Nhà hàng khách sạn.',
        'highlight'   => 'Tích hợp phần mềm điều khiển đa nhiệm · Hỗ trợ chia nhiều khung hình 4K song song',
        'fallback_products' => [
            [
                'name'        => 'Giải Pháp Màn Hình LED Trung Tâm Điều Hành Thông Minh NOC/SOC',
                'desc'        => 'Hiển thị dữ liệu camera giám sát, bản đồ GIS và biểu đồ số liệu thời gian thực, không viền ghép, vận hành liên tục 24/7 không gián đoạn.',
                'image'       => $theme_uri . '/assets/images/services-blueprint-640.webp',
                'price_html'  => 'Khảo sát báo giá',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Giải Pháp Màn Hình LED Giảng Đường & Hội Thảo Giáo Dục',
                'desc'        => 'Tương thích mọi phần mềm bài giảng trực tuyến, góc nhìn rộng cho sinh viên mọi vị trí phòng học, công nghệ lọc ánh sáng xanh bảo vệ mắt.',
                'image'       => $theme_uri . '/assets/images/showcase-led-640.webp',
                'price_html'  => 'Khảo sát báo giá',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Giải Pháp Màn Hình LED Hội Nghị Truyền Hình Đa Điểm Cầu',
                'desc'        => 'Đồng bộ hình ảnh và âm thanh chất lượng phòng thu, hỗ trợ kết nối đa chi nhánh trực tiếp không độ trễ cho các tập đoàn lớn.',
                'image'       => $theme_uri . '/assets/images/home-solution-led-640.webp',
                'price_html'  => 'Khảo sát báo giá',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Giải Pháp Màn Hình LED Trung Tâm Tiệc Cưới & Trung Tâm Sự Kiện',
                'desc'        => 'Tích hợp hệ khung trượt tự động cánh gà, phối cảnh sân khấu 3D ảo lộng lẫy nâng tầm đẳng cấp dịch vụ tiệc cưới sang trọng.',
                'image'       => $theme_uri . '/assets/images/services-hero-640.webp',
                'price_html'  => 'Khảo sát báo giá',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Giải Pháp Màn Hình LED Bệnh Viện & Y Tế Thông Minh',
                'desc'        => 'Hiển thị sơ đồ phân luồng khám bệnh, kết quả chụp X-Quang, MRI với độ tương phản cao, hỗ trợ bác sĩ chẩn đoán hội chẩn từ xa.',
                'image'       => $theme_uri . '/assets/images/home-solution-videowall-640.webp',
                'price_html'  => 'Khảo sát báo giá',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
        ],
    ],
    'man-hinh-led-studio' => [
        'name'        => 'Màn Hình LED Studio',
        'watermark'   => 'STUDIO xR',
        'badge'       => 'DANH MỤC 05 · TRƯỜNG QUAY ẢO',
        'subtitle'    => 'Virtual Production, Phim Trường Điện Ảnh & Đài Truyền Hình',
        'desc'        => 'Màn hình LED trường quay ảo đỉnh cao với tần số quét 7680Hz, tái tạo màu HDR10, phục vụ ghi hình trực tiếp không sọc nhiễu (anti-moire).',
        'highlight'   => 'Tần số quét 7680Hz siêu mượt · Hỗ trợ Genlock chống quét sọc · Sàn LED chịu lực 2 tấn/m²',
        'fallback_products' => [
            [
                'name'        => 'Màn Hình LED Studio Virtual Production P1.56 xR',
                'desc'        => 'Tần số quét 7680Hz cực đại chống hiện tượng sọc quét khi quay bằng máy quay truyền hình, dải màu DCI-P3 99% tái hiện bối cảnh điện ảnh.',
                'image'       => $theme_uri . '/assets/images/showcase-led-640.webp',
                'price_html'  => 'Báo giá dự án',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Sàn Màn Hình LED Studio Chịu Lực 2 Tấn/m² P2.6',
                'desc'        => 'Bề mặt kính cường lực chống trầy xước chống chói đèn quay, chịu tải trọng diễn viên, xe hơi và thiết bị trường quay di chuyển an toàn.',
                'image'       => $theme_uri . '/assets/images/home-solution-videowall-640.webp',
                'price_html'  => 'Báo giá dự án',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Trần Màn Hình LED Studio Tạo Nguồn Sáng Môi Trường',
                'desc'        => 'Chiếu sáng phản xạ thực tế đồng bộ với bối cảnh Unreal Engine thời gian thực, loại bỏ hoàn toàn phông xanh truyền thống.',
                'image'       => $theme_uri . '/assets/images/services-indoor-640.webp',
                'price_html'  => 'Báo giá dự án',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED Đài Truyền Hình & Studio Bản Tin Thời Sự',
                'desc'        => 'Góc nhìn siêu rộng, màu da nhân vật trung thực, kết nối hệ thống điều khiển dự phòng kép nguồn và tín hiệu 1+1 an toàn tuyệt đối.',
                'image'       => $theme_uri . '/assets/images/services-hero-640.webp',
                'price_html'  => 'Báo giá dự án',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED Phông Nền Phim Trường Điện Ảnh P1.95',
                'desc'        => 'Lớp phủ bề mặt đen nhung chống phản chiếu ánh sáng đèn quay phim, góc nhìn rộng 170 độ không lệch sắc độ khi máy quay panning.',
                'image'       => $theme_uri . '/assets/images/Building_with_LED_lighting_4K_202608031635.jpeg',
                'price_html'  => 'Báo giá dự án',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
        ],
    ],
    'man-hinh-led-cong' => [
        'name'        => 'Màn Hình LED Cong',
        'watermark'   => 'CURVED 3D',
        'badge'       => 'DANH MỤC 06 · MẶT CONG NGHỆ THUẬT',
        'subtitle'    => 'Uốn Lượn 360° Kiến Trúc & Hiệu Ứng 3D Không Cần Kính',
        'desc'        => 'Module dẻo linh hoạt uốn cong theo mọi kết cấu kiến trúc cột tròn, mặt dựng lượn sóng hoặc màn hình góc vuông 90 độ hiệu ứng 3D sống động.',
        'highlight'   => 'Khung CNC uốn cong chuẩn xác từng mm · Góc nối liền mạch không tì vết · Hiệu ứng 3D sống động',
        'fallback_products' => [
            [
                'name'        => 'Màn Hình LED Góc Vuông 90 Độ Hiệu Ứng 3D Naked-Eye',
                'desc'        => 'Ghép góc vát mượt không khe hở, trình chiếu video hiệu ứng 3D lao ra khỏi màn hình như thật, trở thành tâm điểm check-in tại các ngã tư lớn.',
                'image'       => $theme_uri . '/assets/images/Building_with_LED_lighting_4K_202608031635.jpeg',
                'price_html'  => 'Báo giá dự án',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED Uốn Cong Cột Tròn Showroom P1.86',
                'desc'        => 'Module cao su dẻo từ tính uốn tròn theo chu vi cột bê tông có sẵn, biến cột chịu lực thô cứng thành kiệt tác truyền thông chuyển động.',
                'image'       => $theme_uri . '/assets/images/product-led-module-640.webp',
                'price_html'  => 'Báo giá dự án',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED Mặt Sóng Lượn Kiến Trúc Nghệ Thuật P2.5',
                'desc'        => 'Gia công hệ xương sắt CNC lượn sóng phức tạp theo ý tưởng kiến trúc sư, tạo điểm nhấn thị giác đẳng cấp cho sảnh khách sạn 5 sao.',
                'image'       => $theme_uri . '/assets/images/services-indoor-640.webp',
                'price_html'  => 'Báo giá dự án',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED Vòm Cầu Hành Lang Không Gian Trải Nghiệm',
                'desc'        => 'Màn hình vòm cong 180 độ bao trùm toàn bộ trần hành lang, tạo không gian ảo tương tác đưa khách tham quan vào thế giới siêu thực.',
                'image'       => $theme_uri . '/assets/images/Modern_building_LED_decoration_4K_202608031454.jpeg',
                'price_html'  => 'Báo giá dự án',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED Uốn Lượn Trần Sảnh Trung Tâm Tiệc Cưới',
                'desc'        => 'Thiết kế dải lụa phát sáng trên trần nhà, trình chiếu bầu trời sao và hiệu ứng vũ trụ chuyển động đưa tiệc cưới lên tầm nghệ thuật.',
                'image'       => $theme_uri . '/assets/images/services-hero-640.webp',
                'price_html'  => 'Báo giá dự án',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
        ],
    ],
    'man-hinh-led-film-dan-kinh' => [
        'name'        => 'Màn Hình LED Film Dán Kính',
        'watermark'   => 'FILM GLASS',
        'badge'       => 'DANH MỤC 07 · CÔNG NGHỆ ĐỘT PHÁ',
        'subtitle'    => 'Độ Trong Suốt > 85% Dán Trực Tiếp Vách Kính Tòa Nhà',
        'desc'        => 'Công nghệ LED Film mỏng nhẹ dán trực tiếp lên vách kính showroom và tòa nhà, biến mặt kính trong suốt thành màn hình video phát sáng rực rỡ.',
        'highlight'   => 'Độ truyền sáng 85% giữ trọn ánh sáng tự nhiên · Siêu mỏng 2.5mm · Trọng lượng nhẹ chỉ 3kg/m²',
        'fallback_products' => [
            [
                'name'        => 'Màn Hình LED Film Dán Kính Trong Suốt P6-10',
                'desc'        => 'Độ truyền sáng trên 85% không cản trở ánh sáng ban ngày vào phòng, lớp keo dán chuyên dụng chịu nhiệt chống ố vàng theo năm tháng.',
                'image'       => $theme_uri . '/assets/images/home-solution-videowall-640.webp',
                'price_html'  => 'Từ 29.000.000đ/m²',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED Film Dán Kính Showroom Ô Tô P8',
                'desc'        => 'Trọng lượng siêu nhẹ chỉ 3kg/m² dán trực tiếp lên kính showroom mặt đường, phát video xe hơi ấn tượng mà người ngoài vẫn thấy bên trong.',
                'image'       => $theme_uri . '/assets/images/Modern_building_LED_decoration_4K_202608031454.jpeg',
                'price_html'  => 'Từ 24.500.000đ/m²',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED Lưới Thủy Tinh Vách Ngăn Văn Phòng P3.91',
                'desc'        => 'Độ nét cao cự ly gần, biến vách ngăn kính phòng họp thành màn hình chiếu video sắc nét, khi tắt đi vách kính hoàn toàn trong suốt.',
                'image'       => $theme_uri . '/assets/images/showcase-led-640.webp',
                'price_html'  => 'Báo giá dự án',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED Film Lan Can Kính Trung Tâm Thương Mại',
                'desc'        => 'Uốn cong dán dọc theo toàn bộ hệ lan can kính các tầng TTTM, trình chiếu hiệu ứng ánh sáng dòng thác và thông điệp chào mừng sống động.',
                'image'       => $theme_uri . '/assets/images/services-blueprint-640.webp',
                'price_html'  => 'Báo giá dự án',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
            [
                'name'        => 'Màn Hình LED Film Dán Mặt Dựng Kính Tòa Nhà Trụ Sở P10',
                'desc'        => 'Biến vách kính mặt tiền tòa nhà thành bảng quảng cáo khổng lồ vào ban đêm mà ban ngày không làm tối không gian văn phòng bên trong.',
                'image'       => $theme_uri . '/assets/images/Building_with_LED_lighting_4K_202608031635.jpeg',
                'price_html'  => 'Báo giá dự án',
                'permalink'   => hacoled_managed_page_url('contact'),
            ],
        ],
    ],
];

// Query real projects from WordPress category 'du-an' (Danh mục dự án)
$projects_cat_slug = get_theme_mod('hacoled_projects_cat_slug', 'du-an') ?: 'du-an';
$raw_project_posts = get_posts([
    'post_type'      => ['post', 'page'],
    'category_name'  => $projects_cat_slug . ',du-an,projects,du-an-tieu-bieu-moi',
    'posts_per_page' => 24,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

$display_projects = [];
$diverse_aspects = [
    'aspect-[16/10]',
    'aspect-[4/3]',
    'aspect-[3/4]',
    'aspect-[1/1]',
    'aspect-[4/5]',
    'aspect-[16/10]',
    'aspect-[3/4]',
    'aspect-[4/3]',
    'aspect-[4/5]',
    'aspect-[1/1]',
    'aspect-[3/4]',
    'aspect-[16/10]',
];

if (!empty($raw_project_posts)) {
    foreach ($raw_project_posts as $idx => $p) {
        $custom_img = get_post_meta($p->ID, '_project_custom_image', true);
        $thumb_url = get_the_post_thumbnail_url($p->ID, 'large');
        $img_src = $custom_img ?: ($thumb_url ?: ($theme_uri . '/assets/images/services-hero-640.webp'));
        
        $client = get_post_meta($p->ID, '_project_client', true) ?: 'Chủ đầu tư HacoLED';
        $specs = get_post_meta($p->ID, '_project_tech_specs', true) ?: ('Thi công trọn gói · HacoLED ' . get_the_date('Y', $p));
        $year = get_post_meta($p->ID, '_project_year', true) ?: get_the_date('Y', $p);
        $aspect = get_post_meta($p->ID, '_project_aspect_ratio', true) ?: $diverse_aspects[$idx % count($diverse_aspects)];

        $display_projects[] = [
            'id'           => $p->ID,
            'title'        => get_the_title($p),
            'client'       => $client,
            'tech_specs'   => $specs,
            'year'         => (string)$year,
            'aspect_ratio' => $aspect,
            'image'        => $img_src,
            'permalink'    => get_permalink($p),
        ];
    }
}

// Fallback safety if database returned fewer than 6
if (count($display_projects) < 6) {
    $fallback_projects = [
        [
            'title'        => 'Màn Hình LED P2.5 Hội Trường Bộ Tư Lệnh Thủ Đô',
            'client'       => 'Hà Nội · Quy mô 65m²',
            'tech_specs'   => 'LED P2.5 Trong Nhà · Tần số quét 3840Hz',
            'year'         => '2026',
            'aspect_ratio' => 'aspect-[16/10]',
            'image'        => $theme_uri . '/assets/images/services-hero-640.webp',
        ],
        [
            'title'        => 'Màn Hình LED Ngoài Trời P4.0 Quảng Trường Thành Phố',
            'client'       => 'Đà Nẵng · Quy mô 120m²',
            'tech_specs'   => 'LED P4.0 Ngoài Trời · Chuẩn IP65 · 7500 nits',
            'year'         => '2026',
            'aspect_ratio' => 'aspect-[4/3]',
            'image'        => $theme_uri . '/assets/images/services-outdoor-640.webp',
        ],
        [
            'title'        => 'Màn Hình LED Góc Vuông 3D Naked-Eye TTTM Bitexco',
            'client'       => 'Quận 1, TP.HCM · Quy mô 210m²',
            'tech_specs'   => 'LED Cong 90° Ngoài Trời · 8000 nits 3D',
            'year'         => '2025',
            'aspect_ratio' => 'aspect-[3/4]',
            'image'        => $theme_uri . '/assets/images/Building_with_LED_lighting_4K_202608031635.jpeg',
        ],
        [
            'title'        => 'Màn Hình LED Phòng Họp Trực Tuyến Tập Đoàn Sun Group',
            'client'       => 'Hà Nội · Quy mô 25m²',
            'tech_specs'   => 'LED COB P1.25 Siêu Nét · Bộ xử lý 4K',
            'year'         => '2026',
            'aspect_ratio' => 'aspect-[1/1]',
            'image'        => $theme_uri . '/assets/images/home-solution-led-640.webp',
        ],
        [
            'title'        => 'Màn Hình LED Film Dán Kính Showroom Mercedes-Benz',
            'client'       => 'TP.HCM · Quy mô 45m²',
            'tech_specs'   => 'LED Film Trong Suốt 85% · Siêu nhẹ 3kg/m²',
            'year'         => '2025',
            'aspect_ratio' => 'aspect-[4/5]',
            'image'        => $theme_uri . '/assets/images/Modern_building_LED_decoration_4K_202608031454.jpeg',
        ],
        [
            'title'        => 'Phim Trường Ảo Virtual Production VTV Đài Truyền Hình',
            'client'       => 'Hà Nội · Quy mô 180m²',
            'tech_specs'   => 'LED Studio P1.56 xR · 7680Hz · Genlock',
            'year'         => '2025',
            'aspect_ratio' => 'aspect-[16/10]',
            'image'        => $theme_uri . '/assets/images/showcase-led-640.webp',
        ],
    ];
    foreach ($fallback_projects as $fb) {
        $display_projects[] = $fb;
    }
}

// Group into 2-row Masonry Columns for Horizontal Loop
$project_columns = [];
$staggered_height_configs = [
    ['top' => 'h-[230px]', 'bottom' => 'h-[290px]'],
    ['top' => 'h-[310px]', 'bottom' => 'h-[210px]'],
    ['top' => 'h-[210px]', 'bottom' => 'h-[310px]'],
    ['top' => 'h-[290px]', 'bottom' => 'h-[230px]'],
    ['top' => 'h-[240px]', 'bottom' => 'h-[280px]'],
    ['top' => 'h-[280px]', 'bottom' => 'h-[240px]'],
];

$total_proj = count($display_projects);
for ($i = 0; $i < $total_proj; $i += 2) {
    $col_idx = count($project_columns);
    $cfg = $staggered_height_configs[$col_idx % count($staggered_height_configs)];
    $top_proj = $display_projects[$i];
    $bottom_proj = isset($display_projects[$i + 1]) ? $display_projects[$i + 1] : $display_projects[0];
    
    $project_columns[] = [
        'top'    => array_merge($top_proj, ['height_class' => $cfg['top'], 'idx' => $i]),
        'bottom' => array_merge($bottom_proj, ['height_class' => $cfg['bottom'], 'idx' => ($i + 1 < $total_proj ? $i + 1 : 0)]),
    ];
}

// 5 Complete Turnkey Application Solutions based on HacoLED Official 2026 Profile
$solutions_data = [
    'hoi-truong' => [
        'id'        => 'hoi-truong',
        'title'     => 'Giải Pháp Không Gian Hội Trường',
        'tag'       => 'HỘI TRƯỜNG ĐA NĂNG · 100 - 500 CHỖ',
        'subtitle'  => 'Tổ hợp hiển thị LED siêu nét và âm thanh hội trường phủ đều, truyền tải rõ ràng tới mọi vị trí trong khán phòng đa năng.',
        'icon'      => 'ph-buildings',
        'full_img'  => $theme_uri . '/assets/images/solutions/solution-hoi-truong.png',
        'scene_img' => $theme_uri . '/assets/images/solutions/space-hoi-truong.png',
        'items'     => [
            ['number' => '01', 'name' => 'Màn Hình LED', 'specs' => 'LED P1.5 – P2.5 trong nhà', 'icon' => 'ph-monitor'],
            ['number' => '02', 'name' => 'Loa Hội Trường', 'specs' => 'Phủ âm đều, chống dội âm', 'icon' => 'ph-speaker-hifi'],
            ['number' => '03', 'name' => 'Màn Hình Phụ', 'specs' => 'Đồng bộ cho hàng ghế xa', 'icon' => 'ph-television'],
            ['number' => '04', 'name' => 'Micro', 'specs' => 'Micro chủ tọa & đại biểu', 'icon' => 'ph-microphone'],
            ['number' => '05', 'name' => 'Bộ Xử Lý Trung Tâm', 'specs' => 'Video 4K & quản lý nguồn', 'icon' => 'ph-hard-drives'],
            ['number' => '06', 'name' => 'Ánh Sáng', 'specs' => 'Đèn Moving Head, Par LED', 'icon' => 'ph-lightbulb'],
        ]
    ],
    'phong-hop' => [
        'id'        => 'phong-hop',
        'title'     => 'Giải Pháp Không Gian Phòng Họp',
        'tag'       => 'PHÒNG HỌP DOANH NGHIỆP · 15 - 50 NGƯỜI',
        'subtitle'  => 'Hội nghị truyền hình 4K đa điểm cầu, hiển thị biểu đồ sắc nét và âm thanh hội nghị thu phát tự nhiên, vận hành 1 chạm.',
        'icon'      => 'ph-users',
        'full_img'  => $theme_uri . '/assets/images/solutions/solution-phong-hop.png',
        'scene_img' => $theme_uri . '/assets/images/solutions/space-phong-hop.png',
        'items'     => [
            ['number' => '01', 'name' => 'Màn Hình LED', 'specs' => 'Fine Pitch P1.25 – P1.86', 'icon' => 'ph-monitor'],
            ['number' => '02', 'name' => 'Loa Hội Trường', 'specs' => 'Khử tiếng vọng, rõ tiếng', 'icon' => 'ph-speaker-hifi'],
            ['number' => '03', 'name' => 'Màn Hình Phụ', 'specs' => 'Góc nhìn 2 bên phòng họp', 'icon' => 'ph-television'],
            ['number' => '04', 'name' => 'Micro', 'specs' => 'Micro cổ ngỗng từng vị trí', 'icon' => 'ph-microphone'],
            ['number' => '05', 'name' => 'Bộ Xử Lý Trung Tâm', 'specs' => 'DSP & giải mã Zoom/Teams', 'icon' => 'ph-cpu'],
        ]
    ],
    'truong-hoc' => [
        'id'        => 'truong-hoc',
        'title'     => 'Giải Pháp Giảng Đường - Trường Học',
        'tag'       => 'GIẢNG ĐƯỜNG ĐẠI HỌC · 100 - 300 CHỖ',
        'subtitle'  => 'Nâng cao hiệu quả giảng dạy trực quan với màn hình LED cỡ lớn bảo vệ thị lực và hệ thống trợ giảng âm thanh phủ đều.',
        'icon'      => 'ph-graduation-cap',
        'full_img'  => $theme_uri . '/assets/images/solutions/solution-truong-hoc.jpg',
        'scene_img' => $theme_uri . '/assets/images/solutions/space-truong-hoc.png',
        'items'     => [
            ['number' => '01', 'name' => 'Màn Hình LED', 'specs' => 'Hiển thị bài giảng rõ nét', 'icon' => 'ph-monitor'],
            ['number' => '02', 'name' => 'Loa Hội Trường', 'specs' => 'Rõ tiếng, chống dội âm', 'icon' => 'ph-speaker-hifi'],
            ['number' => '03', 'name' => 'Màn Hình Phụ', 'specs' => 'Hỗ trợ sinh viên vị trí xa', 'icon' => 'ph-television'],
            ['number' => '04', 'name' => 'Micro', 'specs' => 'Micro trợ giảng không dây', 'icon' => 'ph-microphone'],
            ['number' => '05', 'name' => 'Bộ Xử Lý Trung Tâm', 'specs' => 'Mixer & chia tín hiệu', 'icon' => 'ph-hard-drives'],
        ]
    ],
    'san-khau' => [
        'id'        => 'san-khau',
        'title'     => 'Giải Pháp Sân Khấu & Sự Kiện',
        'tag'       => 'SÂN KHẤU & BIỂU DIỄN NGHỆ THUẬT',
        'subtitle'  => 'Tổ hợp biểu diễn hoành tráng kết hợp backdrop LED 3840Hz, dàn âm thanh Line Array uy lực và ánh sáng moving head chuyên nghiệp.',
        'icon'      => 'ph-confetti',
        'full_img'  => $theme_uri . '/assets/images/solutions/solution-san-khau.png',
        'scene_img' => $theme_uri . '/assets/images/solutions/space-san-khau.png',
        'items'     => [
            ['number' => '01', 'name' => 'Màn Hình LED', 'specs' => 'Quét 3840Hz chống sọc', 'icon' => 'ph-monitor'],
            ['number' => '02', 'name' => 'Loa Sự Kiện', 'specs' => 'Dàn treo Line Array khủng', 'icon' => 'ph-speaker-hifi'],
            ['number' => '03', 'name' => 'Micro', 'specs' => 'Bắt sóng xa, chống hú rít', 'icon' => 'ph-microphone'],
            ['number' => '04', 'name' => 'Bàn Mixer & DSP', 'specs' => 'Cân chỉnh âm thanh chi tiết', 'icon' => 'ph-sliders-horizontal'],
            ['number' => '05', 'name' => 'Bộ Xử Lý Trung Tâm', 'specs' => 'Amply & chia tín hiệu', 'icon' => 'ph-hard-drives'],
            ['number' => '06', 'name' => 'Ánh Sáng', 'specs' => 'Moving head, Par LED, Beam', 'icon' => 'ph-lightbulb'],
        ]
    ],
    'ngoai-troi' => [
        'id'        => 'ngoai-troi',
        'title'     => 'Giải Pháp Quảng Cáo Ngoài Trời',
        'tag'       => 'QUẢNG CÁO NGOÀI TRỜI (DOOH)',
        'subtitle'  => 'Màn hình LED biển hiệu & Billboard độ sáng cực cao 7500 nits, chuẩn kháng nước IP68, quản trị phát video từ xa qua Cloud IoT liên tục 24/7.',
        'icon'      => 'ph-megaphone',
        'full_img'  => $theme_uri . '/assets/images/solutions/solution-ngoai-troi.png',
        'scene_img' => $theme_uri . '/assets/images/solutions/space-ngoai-troi.png',
        'items'     => [
            ['number' => '01', 'name' => 'Màn Hình LED', 'specs' => 'Outdoor IP68, 7500 nits', 'icon' => 'ph-monitor'],
            ['number' => '02', 'name' => 'Bộ Xử Lý Trung Tâm', 'specs' => 'Processor & card phát đồng bộ', 'icon' => 'ph-cpu'],
            ['number' => '03', 'name' => 'Hệ Thống Cloud CMS', 'specs' => 'Lập lịch phát video từ xa', 'icon' => 'ph-cloud-arrow-up'],
            ['number' => '04', 'name' => 'Nguồn & Chống Sét', 'specs' => 'Tủ điện an toàn, lọc sét', 'icon' => 'ph-lightning'],
            ['number' => '05', 'name' => 'Khung Kết Cấu', 'specs' => 'Khung thép chịu bão cấp 12', 'icon' => 'ph-frame-corners'],
        ]
    ],
];
?>

<!-- ACETERNITY UI STYLE LANDING PAGE FOR HACOLED LED SCREENS -->
<main class="relative bg-[#FAFAFA] text-slate-900 min-h-screen overflow-hidden selection:bg-[#B31217] selection:text-white font-sans">

  <!-- ==========================================
       SECTION 1: HERO SECTION (Full 100vh Screen + Raw 4K Image + Ultra-Transparent Glassmorphism)
       Exact 1:1 Match with building-led.php
  =========================================== -->
  <section id="sec-hero" data-track-section="sec-hero" data-section-name="Hero Banner Đầu Trang" class="relative min-h-screen pt-36 lg:pt-44 pb-16 lg:pb-24 px-4 lg:px-8 border-b border-slate-200/60 overflow-hidden flex flex-col justify-center">
    <!-- Raw 100% Opacity Custom Background Image (Flipped horizontally so LED screen sits on the right) -->
    <div class="absolute inset-0 z-0 overflow-hidden">
      <img src="<?php echo esc_url($hero_bg_url); ?>" alt="HacoLED Màn Hình LED" class="w-full h-full object-cover opacity-100 -scale-x-100 [transform:scaleX(-1)]" style="transform: scaleX(-1);">
    </div>

    <div class="max-w-[1440px] mx-auto w-full relative z-10 space-y-6 my-auto flex flex-col items-start">
      
      <!-- Left-Aligned Hero Content Block (Natural Reading Flow) -->
      <div class="max-w-xl lg:max-w-2xl space-y-6 w-full text-left">
        <!-- Top Badge (Ultra Transparent Glass + Yellow Dot) -->
        <div class="flex justify-start">
          <div class="inline-flex items-center gap-2.5 bg-black/40 lg:bg-white/20 border border-white/40 px-4 py-2 rounded-full text-xs font-mono font-bold text-white shadow-xl backdrop-blur-xl">
            <span class="w-2.5 h-2.5 rounded-full bg-[#FBBF24] animate-pulse"></span>
            <span>HACOLED PRO · Đơn vị cung cấp giải pháp uy tín cho các công trình lớn</span>
          </div>
        </div>

        <!-- Headline: From White to Premium Gold Yellow -->
        <h1 class="text-3xl sm:text-5xl lg:text-[52px] font-black tracking-tight leading-[1.1] text-transparent bg-clip-text bg-gradient-to-r from-white via-[#FDE047] to-[#FBBF24] drop-shadow-md">
          Màn Hình LED Đỉnh Cao<br/>
          Chính Hãng Tận Xưởng 2026.
        </h1>

        <!-- Ultra-Transparent Glass Description Box -->
        <p class="text-slate-100 text-sm sm:text-base leading-relaxed font-medium bg-black/45 p-6 rounded-2xl border border-white/20 shadow-2xl backdrop-blur-xl">
          Tổng kho phân phối và thi công trọn gói màn hình LED trong nhà, ngoài trời, hội trường, phòng họp, sân khấu, studio từ <strong class="text-[#FBBF24] font-bold">P0.9 đến P10</strong>. Đầy đủ chứng chỉ CO/CQ chính hãng, khảo sát & mô phỏng 3D miễn phí, bảo hành vàng 36 tháng tận nơi.
        </p>

        <div class="flex flex-wrap items-center gap-4 pt-2">
          <!-- Primary CTA Button (Yellow Hero Accent) -->
          <button type="button" onclick="openQuoteModal('Tất cả màn hình LED')" data-track-cta="btn-quote-hero" data-track-label="Hero: Khảo Sát & Báo Giá Ngay" class="inline-flex items-center gap-2.5 bg-[#FBBF24] hover:bg-amber-400 text-slate-950 font-black text-xs uppercase px-7 py-4 rounded-xl transition-all duration-300 shadow-2xl shadow-amber-500/30 border border-amber-300 cursor-pointer">
            <i class="ph-bold ph-chats-circle text-base"></i>
            <span>Khảo Sát & Báo Giá Ngay</span>
          </button>
          <!-- Secondary Ultra-Glass Button -->
          <a href="#solutions-studio-section" data-track-cta="btn-scroll-solutions" data-track-label="Hero: Cuộn Xem 5 Giải Pháp Không Gian" class="inline-flex items-center gap-2.5 bg-black/40 lg:bg-white/20 backdrop-blur-xl border border-white/40 text-white hover:bg-white/30 font-bold text-xs uppercase px-6 py-4 rounded-xl transition-all duration-300 shadow-lg">
            <span>5 Giải Pháp Không Gian</span>
            <i class="ph-bold ph-arrow-down text-xs text-[#FBBF24]"></i>
          </a>
        </div>
      </div>

    </div>
  </section>

  <!-- ==========================================
       SECTION 2: 1-SCREEN PANORAMIC SOLUTION SLIDER (5 KHÔNG GIAN GIẢI PHÁP ĐỒNG BỘ)
       - Ảnh nằm ngang ở giữa có sẵn chú thích chuẩn HacoLED
       - Bên dưới là danh sách thiết bị có trong giải pháp
       - Chuyển không gian theo dạng Arrow Slide (Prev/Next) & Tabs
       - Chiều cao thiết kế vừa vặn trong 1 màn hình
  =========================================== -->
  <section id="solutions-studio-section" data-track-section="sec-solutions-studio" data-section-name="Studio 5 Giải Pháp Không Gian" class="py-8 sm:py-10 lg:py-12 px-4 lg:px-8 bg-gradient-to-b from-[#FAFAFA] via-white to-[#FAFAFA] relative overflow-hidden border-b border-slate-200/80 scroll-mt-36 lg:scroll-mt-40">
    
    <!-- Giant Watermark Typography -->
    <div class="absolute top-2 left-1/2 -translate-x-1/2 pointer-events-none select-none">
      <span class="text-[16vw] font-black text-slate-100/90 leading-none tracking-tighter uppercase font-mono">
        SOLUTIONS
      </span>
    </div>

    <div class="max-w-[1440px] mx-auto relative z-10 space-y-4 sm:space-y-5">
      
      <!-- Section Header (Heading & Description Stretched Horizontally - Clean, Wide & Space-Optimized) -->
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-3 md:gap-8 pb-1">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black uppercase tracking-tight text-slate-900 shrink-0 leading-tight">
          Hệ Thống Giải Pháp <span class="text-[#B31217]">Không Gian Đồng Bộ.</span>
        </h2>
      </div>

      <!-- Arrow Slide Stage (Main Showcase) -->
      <div class="relative group/stage">
        
        <!-- Navigation Arrows (Left & Right) -->
        <button type="button" id="sol-slide-prev" aria-label="Không gian trước" data-track-cta="btn-sol-prev" data-track-label="Studio: Nút Lướt Trái Không Gian" class="absolute -left-2 sm:-left-4 lg:-left-5 top-1/2 -translate-y-1/2 z-30 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white text-slate-800 shadow-xl border border-slate-200/90 hover:bg-[#B31217] hover:text-white hover:border-[#B31217] hover:scale-110 transition-all duration-300 flex items-center justify-center cursor-pointer">
          <i class="ph-bold ph-caret-left text-lg sm:text-xl"></i>
        </button>
        <button type="button" id="sol-slide-next" aria-label="Không gian kế tiếp" data-track-cta="btn-sol-next" data-track-label="Studio: Nút Lướt Phải Không Gian" class="absolute -right-2 sm:-right-4 lg:-right-5 top-1/2 -translate-y-1/2 z-30 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-white text-slate-800 shadow-xl border border-slate-200/90 hover:bg-[#B31217] hover:text-white hover:border-[#B31217] hover:scale-110 transition-all duration-300 flex items-center justify-center cursor-pointer">
          <i class="ph-bold ph-caret-right text-lg sm:text-xl"></i>
        </button>

        <!-- Main Showcase Card Shell -->
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xl p-4 sm:p-5 lg:p-6 space-y-3.5 relative overflow-hidden">

          <!-- Top Row: Space Switcher Tabs (Left) Level with Xem Hồ Sơ A4 (Right) -->
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-2.5 border-b border-slate-100">
            
            <!-- Space Navigation Switcher Pills (Replaces previous title text) -->
            <div class="bg-slate-100/90 p-1.5 rounded-2xl border border-slate-200/90 inline-flex items-center gap-1.5 overflow-x-auto max-w-full scrollbar-none shadow-inner shrink min-w-0">
              <?php 
              $tab_idx = 0;
              foreach ($solutions_data as $slug => $sol): 
                $is_first = ($tab_idx === 0);
                $tab_idx++;
                $num_str = str_pad($tab_idx, 2, '0', STR_PAD_LEFT);
                $short_name = str_replace('Giải Pháp Không Gian ', '', str_replace('Giải Pháp ', '', $sol['title']));
                $pill_classes = $is_first
                  ? 'bg-[#B31217] text-white shadow-md shadow-red-600/30 border-[#B31217] font-extrabold'
                  : 'bg-transparent text-slate-600 hover:text-slate-950 hover:bg-white/90 border-transparent font-bold';
              ?>
                <button type="button" 
                        data-slide-index="<?php echo $tab_idx - 1; ?>"
                        data-track-cta="tab-sol-<?php echo esc_attr($slug); ?>"
                        data-track-label="Studio: Chọn Tab <?php echo esc_attr($sol['title']); ?>"
                        class="solution-pill-btn shrink-0 inline-flex items-center gap-2 px-3 sm:px-3.5 py-1.5 sm:py-2 rounded-xl border font-mono text-xs uppercase tracking-wide transition-all duration-300 cursor-pointer select-none <?php echo $pill_classes; ?>">
                  <span class="w-4 h-4 rounded flex items-center justify-center text-[10px] font-mono <?php echo $is_first ? 'bg-white/20 text-white' : 'bg-slate-200 text-slate-600'; ?>"><?php echo esc_html($num_str); ?></span>
                  <span class="whitespace-nowrap"><?php echo esc_html($short_name); ?></span>
                </button>
              <?php endforeach; ?>
            </div>

            <!-- Single Xem Hồ Sơ A4 Action Button (Level with tabs) -->
            <div class="flex items-center gap-2 shrink-0 self-start sm:self-auto">
              <button type="button" 
                      id="sol-active-a4-btn"
                      onclick="openActiveSolutionA4()" 
                      data-track-cta="btn-sol-a4"
                      data-track-label="Studio: Xem Hồ Sơ Bản Vẽ A4"
                      class="inline-flex items-center gap-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 hover:text-slate-950 font-mono font-bold text-xs uppercase px-3.5 py-2 sm:px-4 sm:py-2.5 rounded-xl border border-slate-200/90 transition-all cursor-pointer shadow-xs">
                <i class="ph-bold ph-file-text text-sm text-[#B31217]"></i>
                <span>Xem Hồ Sơ A4</span>
              </button>
            </div>

          </div>

          <!-- Slides Wrapper -->
          <div id="solution-slides-container" class="relative">
            <?php 
            $s_idx = 0;
            foreach ($solutions_data as $slug => $sol): 
              $is_active_slide = ($s_idx === 0);
              $s_idx++;
              $slide_display_class = $is_active_slide ? 'block opacity-100' : 'hidden opacity-0';
            ?>
              <div id="sol-slide-<?php echo esc_attr($slug); ?>" 
                   data-index="<?php echo $s_idx - 1; ?>"
                   class="solution-slide transition-opacity duration-300 space-y-3.5 <?php echo $slide_display_class; ?>">

                <!-- Center Horizontal Panoramic Image with Red Annotation Pins (Exact 2481:1222 Ratio - Full Uncut Display) -->
                <div class="relative w-full aspect-[2481/1222] max-h-[420px] lg:max-h-[460px] rounded-2xl overflow-hidden border border-slate-200/90 shadow-md group cursor-pointer bg-slate-950"
                     onclick="openImageLightbox('<?php echo esc_url($sol['scene_img']); ?>', '<?php echo esc_js($sol['title']); ?>', 'Ảnh phối cảnh và sơ đồ thiết bị đồng bộ HacoLED')">
                  
                  <img src="<?php echo esc_url($sol['scene_img']); ?>" 
                       alt="<?php echo esc_attr($sol['title']); ?>" 
                       class="w-full h-full object-contain mx-auto group-hover:scale-[1.008] transition-transform duration-500" />

                  <!-- Hover Zoom Hint -->
                  <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2 text-white font-mono text-xs font-bold pointer-events-none">
                    <div class="px-4 py-2 rounded-xl bg-black/80 border border-white/30 flex items-center gap-2 shadow-2xl backdrop-blur-sm">
                      <i class="ph-bold ph-magnifying-glass-plus text-base text-[#FBBF24]"></i>
                      <span>Click Phóng To Chi Tiết Ảnh Gốc</span>
                    </div>
                  </div>
                </div>

                <!-- Bottom Equipment List (underneath the image) -->
                <div class="pt-0.5">
                  <?php 
                  $grid_cols_class = (count($sol['items']) === 6) ? 'lg:grid-cols-6' : 'lg:grid-cols-5';
                  ?>
                  <div class="grid grid-cols-2 sm:grid-cols-3 <?php echo $grid_cols_class; ?> gap-2 sm:gap-2.5">
                    <?php foreach ($sol['items'] as $it): ?>
                      <div class="bg-slate-50/90 hover:bg-red-50/40 p-2.5 sm:p-3 rounded-xl border border-slate-200/80 hover:border-[#B31217]/40 transition-all duration-300 space-y-1">
                        <div class="flex items-center justify-between">
                          <span class="font-mono font-black text-[11px] text-[#B31217] bg-white px-1.5 py-0.5 rounded border border-red-200/80 shadow-xs"><?php echo esc_html($it['number']); ?></span>
                          <i class="ph-bold <?php echo esc_attr($it['icon']); ?> text-slate-500 text-sm"></i>
                        </div>
                        <div class="font-extrabold text-xs text-slate-900 truncate">
                          <?php echo esc_html($it['name']); ?>
                        </div>
                        <div class="text-[11px] text-slate-500 truncate font-light">
                          <?php echo esc_html($it['specs']); ?>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>

              </div>
            <?php endforeach; ?>
          </div>

        </div>

      </div>

    </div>
  </section>

  <!-- ==========================================
       SECTION 3: 7 DEDICATED SUB-CATEGORY PRODUCT SECTIONS
       Trình bày TOÀN BỘ sản phẩm thành 1 HÀNG NGANG DUY NHẤT (Single Horizontal Row)
       Sử dụng component product-card chuẩn của toàn Website HacoLED
  =========================================== -->
  <div id="subcategories-section">

    <!-- Render Each of the 7 Subcategory Sections -->
    <?php 
    $sec_count = 0;
    foreach ($subcat_definitions as $slug => $def): 
        $sec_count++;
        $is_even = ($sec_count % 2 === 0);
        $section_bg = $is_even ? 'bg-[#FAFAFA]' : 'bg-white';

        // Check if WooCommerce has real products for this category slug
        $matched_products = [];
        if (!empty($subcat_sections)) {
            foreach ($subcat_sections as $sec) {
                if ($sec['slug'] === $slug && !empty($sec['products'])) {
                    foreach ($sec['products'] as $p) {
                        $matched_products[] = [
                            'name'        => $p['title'],
                            'desc'        => $p['short_desc'],
                            'image'       => $p['thumbnail'],
                            'price_html'  => $p['price_html'],
                            'permalink'   => $p['link'],
                        ];
                    }
                    break;
                }
            }
        }

        // Use curated fallback products if database has 0 products
        $final_products = !empty($matched_products) ? $matched_products : $def['fallback_products'];
    ?>
      <section id="sec-<?php echo esc_attr($slug); ?>" data-track-section="sec-<?php echo esc_attr($slug); ?>" data-section-name="<?php echo esc_attr($def['name']); ?>" class="py-24 lg:py-28 px-4 lg:px-8 <?php echo $section_bg; ?> border-b border-slate-200/80 relative overflow-hidden scroll-mt-20">
        
        <!-- Giant Watermark Typography -->
        <div class="absolute top-4 left-1/2 -translate-x-1/2 pointer-events-none select-none">
          <span class="text-[18vw] font-black text-slate-100/90 leading-none tracking-tighter uppercase font-mono">
            <?php echo esc_html($def['watermark']); ?>
          </span>
        </div>

        <div class="max-w-[1440px] mx-auto relative z-10 space-y-12">
          
          <!-- Section Header: Only Heading & Description -->
          <div class="space-y-3 max-w-3xl">
            <h2 class="text-3xl sm:text-5xl font-black uppercase tracking-tight text-slate-900 leading-tight">
              <?php echo esc_html($def['name']); ?> <span class="text-[#B31217]">HacoLED.</span>
            </h2>
            <p class="text-slate-500 text-xs sm:text-sm font-normal leading-relaxed">
              <?php echo esc_html($def['desc']); ?>
            </p>
          </div>

          <!-- Product Slider Carousel: TOÀN BỘ SẢN PHẨM NẰM TRÊN 1 HÀNG NGANG DUY NHẤT -->
          <div class="product-slider-wrapper relative group/slider mt-6 md:mt-8">
            <style>
              .product-slider-wrapper {
                  position: relative;
                  overflow: visible !important;
              }
              .product-swiper {
                  display: block !important;
                  overflow-x: auto !important;
                  overflow-y: hidden !important;
                  scroll-behavior: smooth !important;
                  scroll-snap-type: x mandatory !important;
                  scrollbar-width: none !important;
                  -ms-overflow-style: none !important;
                  padding-top: 12px !important;
                  padding-bottom: 16px !important;
                  margin-top: 0 !important;
                  margin-bottom: 0 !important;
              }
              .product-swiper::-webkit-scrollbar {
                  display: none !important;
                  width: 0 !important;
                  height: 0 !important;
              }
              .product-swiper .swiper-wrapper {
                  display: flex !important;
                  flex-direction: row !important;
                  flex-wrap: nowrap !important;
                  align-items: stretch !important;
                  gap: 1.25rem !important;
                  width: max-content !important;
                  min-width: 100% !important;
                  padding-top: 0.5rem !important;
                  padding-bottom: 0.5rem !important;
              }
              .product-swiper .swiper-slide {
                  flex: 0 0 auto !important;
                  width: 82vw !important;
                  max-width: 320px !important;
                  scroll-snap-align: start !important;
              }
              @media (min-width: 640px) {
                  .product-swiper .swiper-slide {
                      width: calc(50% - 0.65rem) !important;
                      max-width: 360px !important;
                  }
              }
              @media (min-width: 1024px) {
                  .product-swiper .swiper-slide {
                      width: calc(25% - 0.95rem) !important;
                      max-width: 350px !important;
                  }
              }
              .custom-swiper-prev:disabled,
              .custom-swiper-next:disabled {
                  opacity: 0 !important;
                  visibility: hidden !important;
                  pointer-events: none !important;
              }
            </style>
            
            <div class="swiper product-swiper py-3 !overflow-visible">
              <div class="swiper-wrapper">
                <?php foreach ($final_products as $prod): 
                  $product_url = !empty($prod['permalink']) ? $prod['permalink'] : hacoled_managed_page_url('contact');
                  $product_img = !empty($prod['image']) ? $prod['image'] : ($theme_uri . '/assets/images/product-led-module-640.webp');
                ?>
                  <div class="swiper-slide h-auto">
                    <?php 
                    $this->renderComponent('product-card', [
                        'title'       => $prod['name'],
                        'description' => $prod['desc'],
                        'permalink'   => $product_url,
                        'thumbnail'   => $product_img,
                        'price'       => !empty($prod['price_html']) ? $prod['price_html'] : __('Liên hệ', 'hacoled'),
                        'category'    => $def['name'],
                    ]);
                    ?>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- Visible Navigation Buttons for 1-Row Horizontal Slider -->
            <button class="custom-swiper-prev absolute top-1/2 -translate-y-1/2 -left-3 md:-left-6 w-11 h-11 md:w-12 md:h-12 bg-white text-gray-800 rounded-full shadow-2xl border border-gray-200 flex items-center justify-center hover:bg-[#B31217] hover:text-white hover:border-[#B31217] hover:scale-110 hover:shadow-[0_8px_25px_rgba(204,0,0,0.3)] transition-all duration-300 z-30 opacity-100 cursor-pointer" aria-label="Lướt sang trái">
                <i class="ph-bold ph-caret-left text-lg md:text-xl"></i>
            </button>
            <button class="custom-swiper-next absolute top-1/2 -translate-y-1/2 -right-3 md:-right-6 w-11 h-11 md:w-12 md:h-12 bg-white text-gray-800 rounded-full shadow-2xl border border-gray-200 flex items-center justify-center hover:bg-[#B31217] hover:text-white hover:border-[#B31217] hover:scale-110 hover:shadow-[0_8px_25px_rgba(204,0,0,0.3)] transition-all duration-300 z-30 opacity-100 cursor-pointer" aria-label="Lướt sang phải">
                <i class="ph-bold ph-caret-right text-lg md:text-xl"></i>
            </button>
          </div>

        </div>
      </section>
    <?php endforeach; ?>
  </div>

  <!-- ==========================================
       SECTION 4: REAL PROJECTS STAGGERED MASONRY GALLERY WITH HOVER OVERLAY
       Exact 1:1 Match with building-led.php
  =========================================== -->
  <!-- ==========================================
       SECTION 4: REAL PROJECTS GALLERY - HORIZONTAL MASONRY LOOP RIBBON
       Trình bày danh mục dự án theo dạng Grid Masonry & Loop Ngang
  =========================================== -->
  <section id="projects-section" data-track-section="sec-projects" data-section-name="Dự Án Trọng Điểm & Công Trình Tiêu Biểu" class="py-20 lg:py-28 bg-[#FAFAFA] relative overflow-hidden border-b border-slate-200/80">
    
    <!-- Giant Watermark Typography -->
    <div class="absolute top-4 left-1/2 -translate-x-1/2 pointer-events-none select-none">
      <span class="text-[18vw] font-black text-slate-200/80 leading-none tracking-tighter uppercase font-mono">
        PROJECTS
      </span>
    </div>

    <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10 space-y-8 mb-10">
      
      <!-- Section Title & Intro (With Arrow Navigation Controls) -->
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-3 max-w-xl">
          <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-red-50 border border-red-200/60 text-[#B31217] text-xs font-mono font-bold tracking-wider uppercase shadow-sm">
            <span class="w-2 h-2 rounded-full bg-[#B31217] animate-pulse"></span>
            <span>HỒ SƠ DỰ ÁN THỰC TẾ · HACOLED</span>
          </div>
          <h2 class="text-3xl sm:text-5xl font-black tracking-tight uppercase text-slate-900 leading-tight">
            Công Trình Thực Tế <span class="text-[#B31217]">Đã Thi Công.</span>
          </h2>
        </div>
        
        <div class="flex flex-col sm:flex-row sm:items-center gap-5">
          <p class="text-slate-500 text-xs sm:text-sm max-w-md font-normal leading-relaxed">
            Dưới đây là một số dự án màn hình LED tiêu biểu trong danh mục dự án được HacoLED thiết kế và lắp đặt trọn gói. Rê chuột để dừng hoặc nhấp để phóng to ảnh.
          </p>
          <!-- Navigation Arrow Buttons -->
          <div class="flex items-center gap-2.5 self-start sm:self-auto shrink-0">
            <button id="projects-loop-prev" type="button" class="w-12 h-12 rounded-full bg-white border border-slate-200 text-slate-700 hover:bg-[#B31217] hover:text-white hover:border-[#B31217] flex items-center justify-center transition-all duration-300 shadow-sm cursor-pointer active:scale-95" aria-label="Dự án trước">
              <i class="ph-bold ph-caret-left text-lg"></i>
            </button>
            <button id="projects-loop-next" type="button" class="w-12 h-12 rounded-full bg-white border border-slate-200 text-slate-700 hover:bg-[#B31217] hover:text-white hover:border-[#B31217] flex items-center justify-center transition-all duration-300 shadow-sm cursor-pointer active:scale-95" aria-label="Dự án tiếp theo">
              <i class="ph-bold ph-caret-right text-lg"></i>
            </button>
          </div>
        </div>
      </div>

    </div>

    <!-- Horizontal Masonry Loop Ribbon Container (Full Width Bleed) -->
    <div class="relative w-full overflow-hidden select-none">
      
      <!-- Left & Right Vignette Shadows for Smooth Horizon Fade -->
      <div class="absolute left-0 top-0 bottom-0 w-8 sm:w-20 bg-gradient-to-r from-[#FAFAFA] via-[#FAFAFA]/80 to-transparent z-20 pointer-events-none"></div>
      <div class="absolute right-0 top-0 bottom-0 w-8 sm:w-20 bg-gradient-to-l from-[#FAFAFA] via-[#FAFAFA]/80 to-transparent z-20 pointer-events-none"></div>

      <!-- Scrollable Drag Container -->
      <div id="projects-masonry-wrapper" class="overflow-x-auto no-scrollbar scroll-smooth cursor-grab active:cursor-grabbing py-2 px-4" style="-webkit-overflow-scrolling: touch; scrollbar-width: none;">
        
        <!-- Infinite Track (Contains Set 1 + Set 2) -->
        <div id="projects-masonry-track" class="flex gap-6 w-max">
          
          <!-- SET 1 (Masonry Columns) -->
          <?php foreach ($project_columns as $col): ?>
            <div class="w-[300px] sm:w-[360px] lg:w-[410px] flex-shrink-0 flex flex-col gap-5">
              <?php foreach (['top', 'bottom'] as $pos): 
                $card = $col[$pos];
              ?>
                <div class="project-card-item relative rounded-2xl sm:rounded-3xl overflow-hidden bg-slate-950 border border-slate-200/80 shadow-md hover:shadow-2xl hover:border-[#B31217] transition-all duration-500 cursor-pointer group <?php echo $card['height_class']; ?>" data-project-index="<?php echo $card['idx']; ?>">
                  <img src="<?php echo esc_url($card['image']); ?>" alt="<?php echo esc_attr($card['title']); ?>" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                  
                  <!-- Smooth Fade-In Glass Overlay on Hover ONLY -->
                  <div class="absolute inset-0 bg-gradient-to-t from-slate-950/95 via-slate-950/50 to-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-between p-5 sm:p-6 z-10">
                    
                    <!-- Top Badges on Hover -->
                    <div class="flex items-center justify-between w-full">
                      <span class="px-3 py-1 rounded-full bg-[#FBBF24] text-slate-950 text-[10px] font-mono font-bold shadow-md">
                        Năm <?php echo esc_html($card['year']); ?>
                      </span>
                      <div class="w-9 h-9 rounded-full bg-black/40 backdrop-blur-md text-white flex items-center justify-center border border-white/20">
                        <i class="ph-bold ph-arrows-out-simple text-sm"></i>
                      </div>
                    </div>

                    <!-- Bottom Text Info on Hover -->
                    <div class="space-y-1 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                      <span class="block text-[10px] font-mono text-amber-300 font-bold uppercase tracking-widest drop-shadow"><?php echo esc_html($card['client']); ?></span>
                      <h3 class="text-sm sm:text-base font-extrabold text-white group-hover:text-[#FBBF24] transition-colors leading-snug drop-shadow-md line-clamp-2"><?php echo esc_html($card['title']); ?></h3>
                      <p class="text-[11px] font-mono text-slate-300 drop-shadow line-clamp-1"><?php echo esc_html($card['tech_specs']); ?></p>
                    </div>

                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endforeach; ?>

          <!-- SET 2 (Duplicated for seamless infinite horizontal looping) -->
          <?php foreach ($project_columns as $col): ?>
            <div class="w-[300px] sm:w-[360px] lg:w-[410px] flex-shrink-0 flex flex-col gap-5" aria-hidden="true">
              <?php foreach (['top', 'bottom'] as $pos): 
                $card = $col[$pos];
              ?>
                <div class="project-card-item relative rounded-2xl sm:rounded-3xl overflow-hidden bg-slate-950 border border-slate-200/80 shadow-md hover:shadow-2xl hover:border-[#B31217] transition-all duration-500 cursor-pointer group <?php echo $card['height_class']; ?>" data-project-index="<?php echo $card['idx']; ?>">
                  <img src="<?php echo esc_url($card['image']); ?>" alt="<?php echo esc_attr($card['title']); ?>" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                  
                  <!-- Smooth Fade-In Glass Overlay on Hover ONLY -->
                  <div class="absolute inset-0 bg-gradient-to-t from-slate-950/95 via-slate-950/50 to-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-between p-5 sm:p-6 z-10">
                    
                    <!-- Top Badges on Hover -->
                    <div class="flex items-center justify-between w-full">
                      <span class="px-3 py-1 rounded-full bg-[#FBBF24] text-slate-950 text-[10px] font-mono font-bold shadow-md">
                        Năm <?php echo esc_html($card['year']); ?>
                      </span>
                      <div class="w-9 h-9 rounded-full bg-black/40 backdrop-blur-md text-white flex items-center justify-center border border-white/20">
                        <i class="ph-bold ph-arrows-out-simple text-sm"></i>
                      </div>
                    </div>

                    <!-- Bottom Text Info on Hover -->
                    <div class="space-y-1 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                      <span class="block text-[10px] font-mono text-amber-300 font-bold uppercase tracking-widest drop-shadow"><?php echo esc_html($card['client']); ?></span>
                      <h3 class="text-sm sm:text-base font-extrabold text-white group-hover:text-[#FBBF24] transition-colors leading-snug drop-shadow-md line-clamp-2"><?php echo esc_html($card['title']); ?></h3>
                      <p class="text-[11px] font-mono text-slate-300 drop-shadow line-clamp-1"><?php echo esc_html($card['tech_specs']); ?></p>
                    </div>

                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endforeach; ?>

        </div>
      </div>
    </div>

  </section>



  <!-- ==========================================
       SECTION 7: CLIENT TESTIMONIAL REVIEWS
       Exact 1:1 Match with building-led.php
  =========================================== -->
  <section id="sec-reviews" data-track-section="sec-reviews" data-section-name="Đánh Giá Khách Hàng (Reviews)" class="py-28 px-4 lg:px-8 bg-white border-b border-slate-200/80 relative overflow-hidden">
    
    <!-- Giant Watermark Typography -->
    <div class="absolute top-4 left-1/2 -translate-x-1/2 pointer-events-none select-none">
      <span class="text-[18vw] font-black text-slate-100/90 leading-none tracking-tighter uppercase font-mono">
        REVIEWS
      </span>
    </div>

    <div class="max-w-[1240px] mx-auto relative z-10 space-y-16">
      
      <!-- Section Header -->
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-3 max-w-xl">
          <h2 class="text-3xl sm:text-5xl font-black uppercase tracking-tight text-slate-900 leading-tight">
            Khách Hàng Nói Gì <span class="text-[#B31217]">Về HacoLED.</span>
          </h2>
        </div>
        <p class="text-slate-500 text-xs sm:text-sm max-w-md font-normal leading-relaxed">
          Ý kiến đánh giá và sự hài lòng thực tế từ các đơn vị đã lắp đặt màn hình LED HacoLED trên toàn quốc.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <!-- Review 1 -->
        <div class="bg-[#FAFAFA] p-7 rounded-3xl border border-slate-200/90 shadow-lg space-y-5 flex flex-col justify-between">
          <div class="space-y-3">
            <div class="flex text-amber-400 text-sm gap-1">
              <i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i>
            </div>
            <p class="text-xs text-slate-600 font-normal leading-relaxed">
              "Màn hình LED P2.0 hội trường lắp đặt rất sắc nét, màu sắc tươi sáng. Kỹ thuật viên thi công trong đêm để sáng hôm sau chúng tôi kịp tổ chức đại hội cổ đông."
            </p>
          </div>
          <div class="pt-4 border-t border-slate-200/60 flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-[#B31217] text-white font-bold flex items-center justify-center text-xs shadow-md">V</div>
            <div>
              <h5 class="text-xs font-bold text-slate-900">Ban Quản Lý Dự Án</h5>
              <span class="text-[10px] text-slate-500 font-mono">Vietcombank Tower</span>
            </div>
          </div>
        </div>

        <!-- Review 2 -->
        <div class="bg-[#FAFAFA] p-7 rounded-3xl border border-slate-200/90 shadow-lg space-y-5 flex flex-col justify-between">
          <div class="space-y-3">
            <div class="flex text-amber-400 text-sm gap-1">
              <i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i>
            </div>
            <p class="text-xs text-slate-600 font-normal leading-relaxed">
              "Hệ thống màn hình LED ngoài trời P4.0 hoạt động rất ổn định dưới mưa nắng miền Trung. Rất hài lòng với dịch vụ bảo hành vàng định kỳ của HacoLED."
            </p>
          </div>
          <div class="pt-4 border-t border-slate-200/60 flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-[#B31217] text-white font-bold flex items-center justify-center text-xs shadow-md">G</div>
            <div>
              <h5 class="text-xs font-bold text-slate-900">Giám đốc Vận Hành</h5>
              <span class="text-[10px] text-slate-500 font-mono">Geleximco Building</span>
            </div>
          </div>
        </div>

        <!-- Review 3 -->
        <div class="bg-[#FAFAFA] p-7 rounded-3xl border border-slate-200/90 shadow-lg space-y-5 flex flex-col justify-between">
          <div class="space-y-3">
            <div class="flex text-amber-400 text-sm gap-1">
              <i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i>
            </div>
            <p class="text-xs text-slate-600 font-normal leading-relaxed">
              "Màn hình cong góc 90 độ hiệu ứng 3D Naked-Eye tại tòa nhà của chúng tôi thu hút lượng tương tác cực lớn trên mạng xã hội. Một khoản đầu tư truyền thông tuyệt vời!"
            </p>
          </div>
          <div class="pt-4 border-t border-slate-200/60 flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-[#B31217] text-white font-bold flex items-center justify-center text-xs shadow-md">S</div>
            <div>
              <h5 class="text-xs font-bold text-slate-900">Phòng Marketing Dự Án</h5>
              <span class="text-[10px] text-slate-500 font-mono">Sun Group Landmark</span>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- ==========================================
       SECTION 8: FAQ ACCORDION & DIRECT ENGINEERING CALLOUT
       Exact 1:1 Match with building-led.php
  =========================================== -->
  <section id="sec-faq" data-track-section="sec-faq" data-section-name="Câu Hỏi FAQ & Form Khảo Sát Kỹ Sư" class="py-28 px-4 lg:px-8 bg-[#FAFAFA] relative overflow-hidden">
    
    <!-- Giant Watermark Typography -->
    <div class="absolute top-4 left-1/2 -translate-x-1/2 pointer-events-none select-none">
      <span class="text-[18vw] font-black text-slate-200/60 leading-none tracking-tighter uppercase font-mono">
        QUESTIONS
      </span>
    </div>

    <div class="max-w-[1240px] mx-auto relative z-10 space-y-16">
      
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        
        <!-- Left Callout Box -->
        <div class="lg:col-span-5 bg-white p-8 lg:p-9 rounded-3xl border border-slate-200/90 shadow-lg space-y-6">
          <h3 class="text-2xl lg:text-3xl font-extrabold text-slate-900">Bạn Cần Kỹ Sư Đến Khảo Sát Tận Nơi?</h3>
          <p class="text-xs text-slate-600 font-normal leading-relaxed">
            Đăng ký thông tin công trình của bạn ngay hôm nay. Đội ngũ kỹ sư HacoLED sẽ cử cán bộ kỹ thuật tới khảo sát đo đạc thực địa trong vòng 2 giờ tại Hà Nội & TP.HCM.
          </p>
          <button type="button" onclick="openQuoteModal('Yêu cầu kỹ sư khảo sát thực địa')" data-track-cta="btn-faq-survey" data-track-label="FAQ: Bấm Yêu Cầu Khảo Sát Tận Nơi 2H" class="w-full inline-flex items-center justify-center gap-2 bg-[#FBBF24] hover:bg-amber-400 text-slate-950 font-black text-xs uppercase py-4 rounded-xl transition-colors shadow-md cursor-pointer">
            <i class="ph-bold ph-phone-call text-base"></i>
            <span>Yêu cầu khảo sát ngay</span>
          </button>
        </div>

        <!-- Right FAQ Accordion List -->
        <div class="lg:col-span-7 space-y-4">
          <h3 class="text-2xl font-black text-slate-900 mb-6">Câu Hỏi Thường Gặp (FAQ)</h3>

          <!-- FAQ Item 1 -->
          <div class="faq-item bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-sm">
            <button class="faq-toggle w-full p-5 text-left font-bold text-sm text-slate-900 hover:text-[#B31217] flex justify-between items-center cursor-pointer transition-colors">
              <span>HacoLED có hỗ trợ dựng bản vẽ và mô phỏng 3D miễn phí không?</span>
              <i class="ph-bold ph-caret-down text-[#B31217] faq-icon transition-transform"></i>
            </button>
            <div class="faq-content hidden px-5 pb-5 text-xs text-slate-600 font-normal leading-relaxed border-t border-slate-200/60 pt-3">
              Có. 100% khách hàng khi liên hệ HacoLED đều được kỹ sư đến khảo sát thực địa và dựng bản vẽ phối cảnh 3D góc nhìn mô phỏng miễn phí để duyệt trước khi ký hợp đồng.
            </div>
          </div>

          <!-- FAQ Item 2 -->
          <div class="faq-item bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-sm">
            <button class="faq-toggle w-full p-5 text-left font-bold text-sm text-slate-900 hover:text-[#B31217] flex justify-between items-center cursor-pointer transition-colors">
              <span>Nên chọn màn hình LED P1.5, P2.0 hay P2.5 cho phòng họp?</span>
              <i class="ph-bold ph-caret-down text-[#B31217] faq-icon transition-transform"></i>
            </button>
            <div class="faq-content hidden px-5 pb-5 text-xs text-slate-600 font-normal leading-relaxed border-t border-slate-200/60 pt-3">
              Phụ thuộc vào khoảng cách người ngồi gần nhất đến màn hình. Nếu cự ly từ 1.5m - 2m nên chọn P1.5 hoặc P1.8. Cự ly từ 2.5m trở lên thì P2.0 hoặc P2.5 là lựa chọn tối ưu chi phí và cực kỳ sắc nét.
            </div>
          </div>

          <!-- FAQ Item 3 -->
          <div class="faq-item bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-sm">
            <button class="faq-toggle w-full p-5 text-left font-bold text-sm text-slate-900 hover:text-[#B31217] flex justify-between items-center cursor-pointer transition-colors">
              <span>Thời gian giao hàng và lắp đặt hoàn thiện mất bao lâu?</span>
              <i class="ph-bold ph-caret-down text-[#B31217] faq-icon transition-transform"></i>
            </button>
            <div class="faq-content hidden px-5 pb-5 text-xs text-slate-600 font-normal leading-relaxed border-t border-slate-200/60 pt-3">
              Kho HacoLED luôn có sẵn vật tư module từ P0.9 đến P10. Các dự án quy mô dưới 30m² được thi công hoàn thiện bàn giao trong vòng 24 - 48 giờ làm việc.
            </div>
          </div>

          <!-- FAQ Item 4 -->
          <div class="faq-item bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-sm">
            <button class="faq-toggle w-full p-5 text-left font-bold text-sm text-slate-900 hover:text-[#B31217] flex justify-between items-center cursor-pointer transition-colors">
              <span>Chính sách bảo hành và sửa chữa sự cố như thế nào?</span>
              <i class="ph-bold ph-caret-down text-[#B31217] faq-icon transition-transform"></i>
            </button>
            <div class="faq-content hidden px-5 pb-5 text-xs text-slate-600 font-normal leading-relaxed border-t border-slate-200/60 pt-3">
              HacoLED áp dụng gói Bảo Hành Vàng 36 tháng. Khi phát sinh sự cố, kỹ sư thường trực tại Hà Nội và TP.HCM có mặt tại công trình trong vòng 2 giờ để xử lý và đổi mới vật tư linh kiện.
            </div>
          </div>

        </div>

      </div>
    </div>
  </section>

</main>

<!-- ==========================================
     LIGHTBOX OVERLAY (Exact 1:1 Match with building-led.php)
=========================================== -->
<div id="project-lightbox" class="fixed inset-0 bg-black/95 z-[9999] hidden flex flex-col items-center justify-center p-4 select-none opacity-0 transition-opacity duration-300 backdrop-blur-md">
  <button id="lightbox-close" class="absolute top-6 right-6 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-all cursor-pointer border border-white/10">
    <i class="ph-bold ph-x text-xl"></i>
  </button>
  
  <div class="relative max-w-5xl max-h-[75vh] w-full flex items-center justify-center">
    <button id="lightbox-prev" class="absolute left-4 z-20 w-12 h-12 rounded-full bg-black/40 hover:bg-[#B31217] text-white flex items-center justify-center transition-all cursor-pointer border border-white/10 hover:scale-105">
      <i class="ph-bold ph-caret-left text-xl"></i>
    </button>
    
    <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[75vh] object-contain rounded-lg shadow-2xl transition-all duration-300 transform scale-95 opacity-0">
    
    <button id="lightbox-next" class="absolute right-4 z-20 w-12 h-12 rounded-full bg-black/40 hover:bg-[#B31217] text-white flex items-center justify-center transition-all cursor-pointer border border-white/10 hover:scale-105">
      <i class="ph-bold ph-caret-right text-xl"></i>
    </button>
  </div>

  <div class="mt-6 text-center space-y-1 px-4 max-w-xl">
    <h4 id="lightbox-title" class="text-white text-lg font-bold"></h4>
    <p id="lightbox-meta" class="text-slate-400 text-xs font-mono uppercase tracking-wider"></p>
  </div>
</div>

<!-- ==========================================
     QUICK QUOTE CONSULTATION MODAL
=========================================== -->
<div id="quote-modal" class="fixed inset-0 bg-black/80 z-[9998] hidden flex items-center justify-center p-4 select-none opacity-0 transition-opacity duration-300 backdrop-blur-md">
  <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-lg w-full relative shadow-2xl border border-slate-200 transform scale-95 transition-transform duration-300" id="quote-modal-box">
    
    <!-- Close Button -->
    <button type="button" onclick="closeQuoteModal()" class="absolute top-5 right-5 w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition-colors cursor-pointer">
      <i class="ph-bold ph-x text-lg"></i>
    </button>

    <div class="space-y-4">
      <h3 class="text-xl sm:text-2xl font-black text-slate-900 leading-tight">
        Nhận Báo Giá Màn Hình LED Tận Xưởng
      </h3>
      
      <p class="text-xs text-slate-600 leading-relaxed">
        Kỹ sư HacoLED sẽ liên hệ tư vấn kích thước tối ưu, gửi báo giá chi tiết và lên lịch khảo sát thực địa miễn phí trong 2 giờ.
      </p>

      <form id="landing-lead-form" onsubmit="handleLeadSubmit(event)" class="space-y-3.5 pt-2">
        <input type="hidden" id="modal-interest-field" name="product_interest" value="Màn hình LED">
        <!-- Anti-spam Honeypot -->
        <input type="text" name="website_hp" value="" style="display:none !important;" tabindex="-1" autocomplete="off">

        <div>
          <label class="block text-[11px] font-mono font-bold text-slate-700 uppercase mb-1">Dòng sản phẩm quan tâm:</label>
          <input type="text" id="modal-interest-display" readonly class="w-full px-4 py-3 rounded-xl bg-slate-100 border border-slate-200 text-xs font-bold text-[#B31217] outline-none">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
          <div>
            <label class="block text-[11px] font-mono font-bold text-slate-700 uppercase mb-1">Số điện thoại / Zalo (*):</label>
            <input type="tel" required name="phone" placeholder="VD: 0988.xxx.xxx" class="w-full px-4 py-3 rounded-xl bg-white border border-slate-300 focus:border-[#B31217] text-xs outline-none transition-colors">
          </div>
          <div>
            <label class="block text-[11px] font-mono font-bold text-slate-700 uppercase mb-1">Họ tên của bạn:</label>
            <input type="text" name="name" placeholder="Anh / Chị..." class="w-full px-4 py-3 rounded-xl bg-white border border-slate-300 focus:border-[#B31217] text-xs outline-none transition-colors">
          </div>
        </div>

        <div>
          <label class="block text-[11px] font-mono font-bold text-slate-700 uppercase mb-1">Địa điểm lắp đặt & Yêu cầu kích thước:</label>
          <input type="text" name="location" placeholder="VD: Hội trường 50m2 tại Hà Nội..." class="w-full px-4 py-3 rounded-xl bg-white border border-slate-300 focus:border-[#B31217] text-xs outline-none transition-colors">
        </div>

        <div id="lead-error-msg" class="hidden p-3 rounded-xl bg-red-50 border border-red-200 text-xs text-red-700 text-center font-medium"></div>

        <button type="submit" id="lead-submit-btn" class="w-full py-4 rounded-xl bg-[#FBBF24] hover:bg-amber-400 text-slate-950 font-black text-xs uppercase transition-all shadow-lg shadow-amber-500/30 flex items-center justify-center gap-2 cursor-pointer mt-4">
          <i class="ph-bold ph-paper-plane-tilt text-base"></i>
          <span>Gửi Yêu Cầu Báo Giá Nhanh</span>
        </button>

        <p class="text-[10px] text-center text-slate-400 font-mono">
          🔒 Thông tin của bạn được cam kết bảo mật 100% · Phản hồi trong 5 phút
        </p>
      </form>

      <div id="lead-success-msg" class="hidden p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-center space-y-2">
        <i class="ph-fill ph-check-circle text-emerald-600 text-3xl"></i>
        <h4 class="text-sm font-bold text-emerald-900">Gửi Yêu Cầu Thành Công!</h4>
        <p class="text-xs text-emerald-700" id="lead-success-text">Kỹ sư HacoLED sẽ gọi điện tư vấn và gửi file báo giá chi tiết qua Zalo cho bạn ngay lập tức.</p>
      </div>

    </div>
  </div>
</div>

<!-- ==========================================
     MOBILE STICKY ACTION BAR (High Conversion for Mobile Ads)
=========================================== -->
<div class="lg:hidden fixed bottom-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-xl border-t border-slate-200 p-2.5 shadow-[0_-5px_20px_rgba(0,0,0,0.1)]">
  <div class="grid grid-cols-3 gap-2">
    <a href="tel:<?php echo esc_attr($hotline_clean); ?>" data-track-cta="btn-mobile-call" data-track-label="Thanh Mobile: Gọi Hotline" class="flex flex-col items-center justify-center py-2 px-1 bg-red-50 text-[#B31217] rounded-xl border border-red-200/80 font-bold text-[10px] text-center transition-colors">
      <i class="ph-bold ph-phone-call text-base mb-0.5"></i>
      <span>Gọi Hotline</span>
    </a>
    <a href="<?php echo esc_url($zalo_url); ?>" target="_blank" rel="noopener" data-track-cta="btn-mobile-zalo" data-track-label="Thanh Mobile: Chat Zalo" class="flex flex-col items-center justify-center py-2 px-1 bg-blue-50 text-blue-600 rounded-xl border border-blue-200/80 font-bold text-[10px] text-center transition-colors">
      <i class="ph-bold ph-chat-circle-dots text-base mb-0.5"></i>
      <span>Chat Zalo</span>
    </a>
    <button type="button" onclick="openQuoteModal('Tư vấn Mobile')" data-track-cta="btn-mobile-quote" data-track-label="Thanh Mobile: Báo Giá Nhanh" class="flex flex-col items-center justify-center py-2 px-1 bg-[#FBBF24] text-slate-950 rounded-xl font-black text-[10px] text-center shadow-md cursor-pointer">
      <i class="ph-bold ph-receipt text-base mb-0.5"></i>
      <span>Báo Giá Nhanh</span>
    </button>
  </div>
</div>

<!-- ==========================================
     SCRIPTS: FAQ ACCORDION, SLIDER, LIGHTBOX, MODAL
     Exact 1:1 Match with building-led.php
=========================================== -->
<script>
  document.addEventListener('DOMContentLoaded', () => {

    // 1. FAQ ACCORDION SCRIPT
    const faqToggles = document.querySelectorAll('.faq-toggle');
    faqToggles.forEach(toggle => {
      toggle.addEventListener('click', () => {
        const content = toggle.nextElementSibling;
        const icon = toggle.querySelector('.faq-icon');
        const isHidden = content.classList.contains('hidden');

        // Close all other FAQs
        document.querySelectorAll('.faq-content').forEach(c => c.classList.add('hidden'));
        document.querySelectorAll('.faq-icon').forEach(i => i.classList.remove('rotate-180'));

        // Toggle current
        if (isHidden) {
          content.classList.remove('hidden');
          icon.classList.add('rotate-180');
        }
      });
    });

    // 2. LIGHTBOX GALLERY SLIDER SCRIPT
    const projectsData = <?php echo json_encode($display_projects); ?>;
    const projectCards = document.querySelectorAll('.project-card-item');
    const lightbox = document.getElementById('project-lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxClose = document.getElementById('lightbox-close');
    const lightboxPrev = document.getElementById('lightbox-prev');
    const lightboxNext = document.getElementById('lightbox-next');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxMeta = document.getElementById('lightbox-meta');

    let currentIdx = 0;

    const openLightbox = (index) => {
      currentIdx = parseInt(index);
      const proj = projectsData[currentIdx];
      if (!proj) return;

      const imgUrl = proj.image || proj.thumbnail;
      if (!imgUrl) return;

      lightbox.classList.remove('hidden');
      if (lightboxPrev) lightboxPrev.style.display = '';
      if (lightboxNext) lightboxNext.style.display = '';
      setTimeout(() => {
        lightbox.classList.remove('opacity-0');
        lightbox.classList.add('opacity-100', 'flex');
      }, 10);
      document.body.style.overflow = 'hidden';

      loadLightboxImage(imgUrl, proj.title, proj.client || '', proj.tech_specs || '', proj.year || '');
    };

    const loadLightboxImage = (url, title, client, specs, year) => {
      lightboxImg.classList.add('opacity-0', 'scale-95');
      lightboxImg.classList.remove('opacity-100', 'scale-100');

      setTimeout(() => {
        lightboxImg.src = url;
        lightboxTitle.innerText = title;
        
        let metaParts = [];
        if (client) metaParts.push(client);
        if (specs) metaParts.push(specs);
        if (year) metaParts.push('Năm: ' + year);
        lightboxMeta.innerText = metaParts.join(' | ');

        lightboxImg.onload = () => {
          lightboxImg.classList.remove('opacity-0', 'scale-95');
          lightboxImg.classList.add('opacity-100', 'scale-100');
        };
      }, 150);
    };

    const closeLightbox = () => {
      lightbox.classList.remove('opacity-100');
      lightbox.classList.add('opacity-0');
      setTimeout(() => {
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
        lightboxImg.src = '';
      }, 300);
      document.body.style.overflow = '';
    };

    const nextImage = () => {
      let nextIdx = currentIdx + 1;
      if (nextIdx >= projectsData.length) nextIdx = 0;
      openLightbox(nextIdx);
    };

    const prevImage = () => {
      let prevIdx = currentIdx - 1;
      if (prevIdx < 0) prevIdx = projectsData.length - 1;
      openLightbox(prevIdx);
    };

    projectCards.forEach(card => {
      card.addEventListener('click', () => {
        const index = card.getAttribute('data-project-index');
        openLightbox(index);
      });
    });

    if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
    if (lightboxNext) lightboxNext.addEventListener('click', nextImage);
    if (lightboxPrev) lightboxPrev.addEventListener('click', prevImage);

    document.addEventListener('keydown', (e) => {
      if (lightbox && !lightbox.classList.contains('hidden')) {
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowRight') nextImage();
        if (e.key === 'ArrowLeft') prevImage();
      }
      if (modal && !modal.classList.contains('hidden')) {
        if (e.key === 'Escape') closeQuoteModal();
      }
    });

    if (lightbox) {
      lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox || e.target === lightbox.querySelector('.relative')) {
          closeLightbox();
        }
      });
    }

    // 2.1 HORIZONTAL MASONRY LOOP CONTROLLER
    const loopWrapper = document.getElementById('projects-masonry-wrapper');
    const loopTrack = document.getElementById('projects-masonry-track');
    const loopPrevBtn = document.getElementById('projects-loop-prev');
    const loopNextBtn = document.getElementById('projects-loop-next');

    if (loopWrapper && loopTrack) {
      let isLoopPaused = false;
      let isDragging = false;
      let startX = 0;
      let startScrollLeft = 0;
      const velocity = 0.8; // px per animation frame

      function scrollLoopStep() {
        if (!isLoopPaused && !isDragging) {
          loopWrapper.scrollLeft += velocity;
          const halfWidth = loopTrack.scrollWidth / 2;
          if (halfWidth > 0 && loopWrapper.scrollLeft >= halfWidth) {
            loopWrapper.scrollLeft -= halfWidth;
          }
        }
        requestAnimationFrame(scrollLoopStep);
      }
      requestAnimationFrame(scrollLoopStep);

      // Pause on hover & touch
      loopWrapper.addEventListener('mouseenter', () => { isLoopPaused = true; });
      loopWrapper.addEventListener('mouseleave', () => { if (!isDragging) isLoopPaused = false; });
      loopWrapper.addEventListener('touchstart', () => { isLoopPaused = true; }, { passive: true });
      loopWrapper.addEventListener('touchend', () => { 
        setTimeout(() => { if (!isDragging) isLoopPaused = false; }, 800); 
      }, { passive: true });

      // Drag to scroll
      loopWrapper.addEventListener('mousedown', (e) => {
        isDragging = true;
        isLoopPaused = true;
        startX = e.pageX - loopWrapper.offsetLeft;
        startScrollLeft = loopWrapper.scrollLeft;
      });

      window.addEventListener('mouseup', () => {
        if (isDragging) {
          isDragging = false;
          setTimeout(() => { isLoopPaused = false; }, 800);
        }
      });

      loopWrapper.addEventListener('mousemove', (e) => {
        if (!isDragging) return;
        e.preventDefault();
        const x = e.pageX - loopWrapper.offsetLeft;
        const walk = (x - startX) * 1.5;
        loopWrapper.scrollLeft = startScrollLeft - walk;

        const halfWidth = loopTrack.scrollWidth / 2;
        if (halfWidth > 0) {
          if (loopWrapper.scrollLeft >= halfWidth) {
            loopWrapper.scrollLeft -= halfWidth;
            startScrollLeft -= halfWidth;
          } else if (loopWrapper.scrollLeft <= 0) {
            loopWrapper.scrollLeft += halfWidth;
            startScrollLeft += halfWidth;
          }
        }
      });

      // Prev / Next button step
      if (loopPrevBtn) {
        loopPrevBtn.addEventListener('click', () => {
          isLoopPaused = true;
          const colWidth = loopTrack.children[0] ? (loopTrack.children[0].offsetWidth + 24) : 400;
          loopWrapper.scrollBy({ left: -colWidth, behavior: 'smooth' });
          setTimeout(() => { isLoopPaused = false; }, 1800);
        });
      }

      if (loopNextBtn) {
        loopNextBtn.addEventListener('click', () => {
          isLoopPaused = true;
          const colWidth = loopTrack.children[0] ? (loopTrack.children[0].offsetWidth + 24) : 400;
          loopWrapper.scrollBy({ left: colWidth, behavior: 'smooth' });
          setTimeout(() => { isLoopPaused = false; }, 1800);
        });
      }
    }

    // 3. PRODUCT CAROUSEL SLIDER NATIVE INTERACTION (Guaranteed 1-Row Horizontal Slider)
    document.querySelectorAll('.product-slider-wrapper').forEach((wrapper) => {
      const slider = wrapper.querySelector('.product-swiper');
      const previous = wrapper.querySelector('.custom-swiper-prev');
      const next = wrapper.querySelector('.custom-swiper-next');
      if (!slider) return;

      let scrollRaf = null;
      const updateButtons = () => {
        if (scrollRaf) cancelAnimationFrame(scrollRaf);
        const scrollLeft = slider.scrollLeft;
        const clientWidth = slider.clientWidth;
        const scrollWidth = slider.scrollWidth;

        scrollRaf = requestAnimationFrame(() => {
          // If total content width fits entirely in screen, hide both buttons
          if (scrollWidth <= clientWidth + 4) {
            if (previous) previous.disabled = true;
            if (next) next.disabled = true;
          } else {
            if (previous) previous.disabled = scrollLeft <= 4;
            if (next) next.disabled = scrollLeft + clientWidth >= scrollWidth - 4;
          }
        });
      };

      previous?.addEventListener('click', () => slider.scrollBy({ left: -slider.clientWidth * 0.85, behavior: 'smooth' }));
      next?.addEventListener('click', () => slider.scrollBy({ left: slider.clientWidth * 0.85, behavior: 'smooth' }));
      slider.addEventListener('scroll', updateButtons, { passive: true });
      window.addEventListener('resize', updateButtons, { passive: true });
      updateButtons();
    });

    // 4. ARROW SLIDER & PILLS FOR SOLUTIONS STUDIO
    const solutionSlides = document.querySelectorAll('.solution-slide');
    const solutionPills = document.querySelectorAll('.solution-pill-btn');
    const solPrevBtn = document.getElementById('sol-slide-prev');
    const solNextBtn = document.getElementById('sol-slide-next');
    let currentSolIndex = 0;
    const totalSolSlides = solutionSlides.length;

    // Solutions A4 Data for active button
    const solutionsA4Data = <?php echo json_encode(array_values(array_map(function($s) {
      return [
        'title'    => $s['title'],
        'full_img' => $s['full_img'],
        'sub'      => 'Catalogue hồ sơ kỹ thuật trọn gói HacoLED 2026',
      ];
    }, $solutions_data)), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;

    window.openActiveSolutionA4 = function() {
      const cur = solutionsA4Data[currentSolIndex] || solutionsA4Data[0];
      if (cur && typeof window.openImageLightbox === 'function') {
        window.openImageLightbox(cur.full_img, cur.title, cur.sub);
      }
    };

    function goToSolSlide(index) {
      if (totalSolSlides === 0) return;
      currentSolIndex = (index + totalSolSlides) % totalSolSlides;

      // Update Slides
      solutionSlides.forEach((slide, i) => {
        if (i === currentSolIndex) {
          slide.classList.remove('hidden');
          slide.classList.add('block');
          setTimeout(() => {
            slide.classList.remove('opacity-0');
            slide.classList.add('opacity-100');
          }, 15);
        } else {
          slide.classList.remove('block', 'opacity-100');
          slide.classList.add('hidden', 'opacity-0');
        }
      });

      // Update Navigation Pills
      solutionPills.forEach((pill, i) => {
        const badge = pill.querySelector('span:first-child');
        if (i === currentSolIndex) {
          pill.classList.remove('bg-transparent', 'text-slate-600', 'hover:text-slate-950', 'hover:bg-white/90', 'border-transparent', 'font-bold');
          pill.classList.add('bg-[#B31217]', 'text-white', 'shadow-md', 'shadow-red-600/30', 'border-[#B31217]', 'font-extrabold');
          if (badge) {
            badge.classList.remove('bg-slate-200', 'text-slate-600');
            badge.classList.add('bg-white/20', 'text-white');
          }
          // Scroll active pill into view smoothly
          if (typeof pill.scrollIntoView === 'function') {
            pill.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
          }
        } else {
          pill.classList.remove('bg-[#B31217]', 'text-white', 'shadow-md', 'shadow-red-600/30', 'border-[#B31217]', 'font-extrabold');
          pill.classList.add('bg-transparent', 'text-slate-600', 'hover:text-slate-950', 'hover:bg-white/90', 'border-transparent', 'font-bold');
          if (badge) {
            badge.classList.remove('bg-white/20', 'text-white');
            badge.classList.add('bg-slate-200', 'text-slate-600');
          }
        }
      });
    }

    if (solPrevBtn) {
      solPrevBtn.addEventListener('click', () => goToSolSlide(currentSolIndex - 1));
    }
    if (solNextBtn) {
      solNextBtn.addEventListener('click', () => goToSolSlide(currentSolIndex + 1));
    }

    solutionPills.forEach(pill => {
      pill.addEventListener('click', () => {
        const idx = parseInt(pill.getAttribute('data-slide-index') || '0', 10);
        goToSolSlide(idx);
      });
    });

    // Mobile Swipe Gesture on the slider container
    const solSliderContainer = document.getElementById('solution-slides-container');
    if (solSliderContainer) {
      let touchStartX = 0;
      let touchEndX = 0;
      solSliderContainer.addEventListener('touchstart', e => {
        touchStartX = e.changedTouches[0].screenX;
      }, { passive: true });
      solSliderContainer.addEventListener('touchend', e => {
        touchEndX = e.changedTouches[0].screenX;
        if (touchStartX - touchEndX > 50) {
          goToSolSlide(currentSolIndex + 1); // Swipe left -> next
        } else if (touchEndX - touchStartX > 50) {
          goToSolSlide(currentSolIndex - 1); // Swipe right -> prev
        }
      }, { passive: true });
    }

  });

  // 5. GLOBAL LIGHTBOX FOR SOLUTION BROCHURES
  window.openImageLightbox = function(url, title, meta) {
    const lightbox = document.getElementById('project-lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxMeta = document.getElementById('lightbox-meta');
    const lightboxPrev = document.getElementById('lightbox-prev');
    const lightboxNext = document.getElementById('lightbox-next');
    if (!lightbox || !lightboxImg) return;

    if (lightboxPrev) lightboxPrev.style.display = 'none';
    if (lightboxNext) lightboxNext.style.display = 'none';

    lightbox.classList.remove('hidden');
    lightbox.classList.add('flex');
    setTimeout(() => {
      lightbox.classList.remove('opacity-0');
      lightbox.classList.add('opacity-100');
    }, 10);
    document.body.style.overflow = 'hidden';

    lightboxImg.classList.add('opacity-0', 'scale-95');
    lightboxImg.classList.remove('opacity-100', 'scale-100');
    setTimeout(() => {
      lightboxImg.src = url;
      if (lightboxTitle) lightboxTitle.innerText = title;
      if (lightboxMeta) lightboxMeta.innerText = meta || 'Hồ sơ kỹ thuật giải pháp HacoLED';
      lightboxImg.onload = () => {
        lightboxImg.classList.remove('opacity-0', 'scale-95');
        lightboxImg.classList.add('opacity-100', 'scale-100');
      };
    }, 150);
  };

  // 4. QUOTE MODAL FUNCTIONS
  const modal = document.getElementById('quote-modal');
  const modalBox = document.getElementById('quote-modal-box');
  const interestField = document.getElementById('modal-interest-field');
  const interestDisplay = document.getElementById('modal-interest-display');

  window.openQuoteModal = function(interestText) {
    if (!modal) return;
    if (interestField) interestField.value = interestText || 'Màn hình LED';
    if (interestDisplay) interestDisplay.value = interestText || 'Màn hình LED';
    
    modal.classList.remove('hidden');
    setTimeout(() => {
      modal.classList.remove('opacity-0');
      modal.classList.add('opacity-100');
      if (modalBox) {
        modalBox.classList.remove('scale-95');
        modalBox.classList.add('scale-100');
      }
    }, 10);
    document.body.style.overflow = 'hidden';
  };

  window.closeQuoteModal = function() {
    if (!modal) return;
    modal.classList.remove('opacity-100');
    modal.classList.add('opacity-0');
    if (modalBox) {
      modalBox.classList.remove('scale-100');
      modalBox.classList.add('scale-95');
    }
    setTimeout(() => {
      modal.classList.add('hidden');
    }, 300);
    document.body.style.overflow = '';
  };

  if (modal) {
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        closeQuoteModal();
      }
    });
  }

  // 5. LEAD FORM HANDLER WITH REAL-TIME BACKEND & GOOGLE SHEETS SYNC
  window.handleLeadSubmit = function(e) {
    e.preventDefault();
    const form = e.target;
    const submitBtn = document.getElementById('lead-submit-btn');
    const errorMsg = document.getElementById('lead-error-msg');
    const successMsg = document.getElementById('lead-success-msg');
    const successText = document.getElementById('lead-success-text');

    if (errorMsg) {
      errorMsg.classList.add('hidden');
      errorMsg.innerText = '';
    }

    const formData = new FormData(form);
    const phone = (formData.get('phone') || '').trim();
    const interest = (formData.get('product_interest') || 'Màn hình LED').trim();

    if (!phone) {
      if (errorMsg) {
        errorMsg.innerText = 'Vui lòng nhập số điện thoại hoặc Zalo!';
        errorMsg.classList.remove('hidden');
      }
      return;
    }

    // Capture URL & UTM parameters
    const urlParams = new URLSearchParams(window.location.search);
    const utmSource = urlParams.get('utm_source') || (document.referrer ? 'Referrer: ' + document.referrer : 'Trực tiếp / Website');
    formData.append('action', 'hacoled_submit_lead');
    formData.append('page_url', window.location.href);
    formData.append('utm_source', utmSource);

    // Disable button & show spinner state
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<i class="ph-bold ph-spinner animate-spin text-base"></i><span>Đang gửi thông tin...</span>';
    }

    // Send AJAX to WordPress Backend (saves to WP CPT and syncs Real-time to Google Sheets)
    fetch('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data && data.success) {
        // Dispatch Tracking Events for Google Ads, Facebook Pixel, TikTok Ads
        if (typeof window.dataLayer !== 'undefined') {
          window.dataLayer.push({
            event: 'generate_lead',
            lead_category: interest,
            lead_source: 'landing_led_ads'
          });
        }
        if (typeof window.gtag === 'function') {
          window.gtag('event', 'conversion', { 'send_to': 'AW-CONVERSION_ID', 'value': 1.0 });
        }
        if (typeof window.fbq === 'function') {
          window.fbq('track', 'Lead', { content_name: interest });
        }
        if (typeof window.oaiq === 'function') {
          window.oaiq('event', 'Lead', { content_name: interest, value: 1.0 });
        }

        // HacoLED Internal Analytics Conversion Tracking
        if (typeof window.hacoledTrackEvent === 'function') {
          window.hacoledTrackEvent('form_submit', 'form-lead-modal', 'Đăng Ký Form Báo Giá: ' + interest, { phone: phone, name: formData.get('name') || '' });
        }

        // Show success state
        form.classList.add('hidden');
        if (successMsg) {
          if (successText && data.data && data.data.message) {
            successText.innerText = data.data.message;
          }
          successMsg.classList.remove('hidden');
        }

        // Auto close modal after 3.5 seconds
        setTimeout(() => {
          closeQuoteModal();
          setTimeout(() => {
            form.reset();
            form.classList.remove('hidden');
            if (successMsg) successMsg.classList.add('hidden');
            if (submitBtn) {
              submitBtn.disabled = false;
              submitBtn.innerHTML = '<i class="ph-bold ph-paper-plane-tilt text-base"></i><span>Gửi Yêu Cầu Báo Giá Nhanh</span>';
            }
          }, 500);
        }, 3500);
      } else {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = '<i class="ph-bold ph-paper-plane-tilt text-base"></i><span>Gửi Yêu Cầu Báo Giá Nhanh</span>';
        }
        if (errorMsg) {
          errorMsg.innerText = (data && data.data && data.data.message) ? data.data.message : 'Có lỗi xảy ra, vui lòng thử lại hoặc gọi Hotline!';
          errorMsg.classList.remove('hidden');
        }
      }
    })
    .catch(err => {
      console.error('Lead submit error:', err);
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="ph-bold ph-paper-plane-tilt text-base"></i><span>Gửi Yêu Cầu Báo Giá Nhanh</span>';
      }
      if (errorMsg) {
        errorMsg.innerText = 'Không thể kết nối máy chủ, vui lòng gọi trực tiếp Hotline để nhận báo giá ngay!';
        errorMsg.classList.remove('hidden');
      }
    });
  };
</script>

<!-- ==========================================
     HACOLED PRO LANDING ANALYTICS & CRO ENGINE
     - Measures Daily Visits & Unique Visitors
     - Measures Section-by-Section Reach & Dwell Time
     - Measures All CTA Clicks, Hotline, Zalo, A4 & Lightbox
=========================================== -->
<script id="hacoled-analytics-engine">
(function() {
  const CONFIG = {
    ajaxUrl: '<?php echo esc_url(admin_url('admin-ajax.php')); ?>',
    isAdmin: <?php echo (is_user_logged_in() && current_user_can('manage_options')) ? '1' : '0'; ?>,
    pageUrl: window.location.href,
    sessKey: 'hacoled_led_session_id',
    visitedSecsKey: 'hacoled_visited_secs_' + window.location.pathname,
  };

  // 1. Session ID (Persists in sessionStorage)
  let sessionId = sessionStorage.getItem(CONFIG.sessKey);
  let isFirstVisitInSession = false;
  if (!sessionId) {
    sessionId = 'sess_' + Date.now().toString(36) + '_' + Math.random().toString(36).substring(2, 9);
    sessionStorage.setItem(CONFIG.sessKey, sessionId);
    isFirstVisitInSession = true;
  }

  // 2. Helper to detect device
  function getDeviceType() {
    const w = window.innerWidth;
    if (w < 768) return 'mobile';
    if (w < 1024) return 'tablet';
    return 'desktop';
  }

  // 3. Robust Data Sender (Beacon API with Fetch Keepalive fallback)
  function sendData(payload) {
    payload.session_id = sessionId;
    payload.is_admin = CONFIG.isAdmin;
    const bodyStr = JSON.stringify(payload);
    const targetUrl = CONFIG.ajaxUrl + '?action=hacoled_track_analytics';

    if (navigator.sendBeacon) {
      try {
        const blob = new Blob([bodyStr], { type: 'application/json' });
        navigator.sendBeacon(targetUrl, blob);
        return;
      } catch (e) {}
    }

    fetch(targetUrl, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: bodyStr,
      keepalive: true
    }).catch(function() {});
  }

  // Public event tracker
  window.hacoledTrackEvent = function(eventType, targetId, targetLabel, metadata) {
    sendData({
      type: 'event',
      event_type: eventType,
      target_id: targetId || '',
      target_label: targetLabel || '',
      metadata: metadata || null
    });
  };

  // 4. Record Initial Visit
  if (isFirstVisitInSession) {
    const urlParams = new URLSearchParams(window.location.search);
    sendData({
      type: 'visit',
      device: getDeviceType(),
      referrer: document.referrer || '',
      page_url: window.location.href,
      utm_source: urlParams.get('utm_source') || '',
      utm_medium: urlParams.get('utm_medium') || '',
      utm_campaign: urlParams.get('utm_campaign') || '',
      utm_term: urlParams.get('utm_term') || ''
    });
  }

  // 5. Section-by-Section Visibility & Dwell Time Tracking (IntersectionObserver)
  document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('[data-track-section]');
    if (!sections.length || !('IntersectionObserver' in window)) return;

    const visibleSections = new Map(); // sectionId => { time, name }
    let recordedSections = new Set();
    try {
      const stored = sessionStorage.getItem(CONFIG.visitedSecsKey);
      if (stored) recordedSections = new Set(JSON.parse(stored));
    } catch(e) {}

    const observer = new IntersectionObserver((entries) => {
      const now = Date.now();
      entries.forEach(entry => {
        const sec = entry.target;
        const secId = sec.getAttribute('data-track-section');
        const secName = sec.getAttribute('data-section-name') || secId;

        if (entry.isIntersecting) {
          // Section entered screen
          visibleSections.set(secId, { time: now, name: secName });
        } else {
          // Section left screen -> calculate dwell time
          if (visibleSections.has(secId)) {
            const entryData = visibleSections.get(secId);
            const dwellSec = Math.round((now - entryData.time) / 1000);
            visibleSections.delete(secId);

            // Record section view if user spent at least 1 second viewing it
            if (dwellSec >= 1) {
              sendData({
                type: 'event',
                event_type: 'section_view',
                target_id: secId,
                target_label: 'Xem phần: ' + entryData.name,
                dwell_time: dwellSec
              });
              recordedSections.add(secId);
              try {
                sessionStorage.setItem(CONFIG.visitedSecsKey, JSON.stringify(Array.from(recordedSections)));
              } catch(e) {}
            }
          }
        }
      });
    }, {
      threshold: 0.35 // At least 35% of section is visible in viewport
    });

    sections.forEach(sec => observer.observe(sec));

    // When leaving or switching tab, flush currently visible sections
    function flushVisibleSections() {
      const now = Date.now();
      visibleSections.forEach((entryData, secId) => {
        const dwellSec = Math.round((now - entryData.time) / 1000);
        if (dwellSec >= 1) {
          sendData({
            type: 'event',
            event_type: 'section_view',
            target_id: secId,
            target_label: 'Xem phần: ' + entryData.name,
            dwell_time: dwellSec
          });
        }
      });
      visibleSections.clear();
    }

    // 6. Global CTA & Interactive Element Click Listener
    document.body.addEventListener('click', function(e) {
      // 6.1 Elements with explicit data-track-cta
      const ctaEl = e.target.closest('[data-track-cta]');
      if (ctaEl) {
        const ctaId = ctaEl.getAttribute('data-track-cta');
        const ctaLabel = ctaEl.getAttribute('data-track-label') || ctaEl.innerText.trim().substring(0, 50);
        window.hacoledTrackEvent('cta_click', ctaId, ctaLabel);
        return;
      }

      // 6.2 Phone link click
      const telLink = e.target.closest('a[href^="tel:"]');
      if (telLink) {
        window.hacoledTrackEvent('cta_click', 'call-hotline', 'Bấm Gọi Hotline: ' + telLink.getAttribute('href').replace('tel:', ''));
        return;
      }

      // 6.3 Zalo link click
      const zaloLink = e.target.closest('a[href*="zalo.me"]');
      if (zaloLink) {
        window.hacoledTrackEvent('cta_click', 'chat-zalo', 'Bấm Chat Zalo Tư Vấn');
        return;
      }

      // 6.4 FAQ accordion expand
      const faqBtn = e.target.closest('.faq-toggle');
      if (faqBtn) {
        const questionText = faqBtn.querySelector('span')?.innerText.trim() || 'Câu hỏi FAQ';
        window.hacoledTrackEvent('faq_expand', 'faq-question', 'Mở xem FAQ: ' + questionText);
        return;
      }

      // 6.5 Project card click (Lightbox trigger)
      const projectCard = e.target.closest('.project-card-item');
      if (projectCard) {
        const projTitle = projectCard.querySelector('h4')?.innerText.trim() || 'Dự án thực tế';
        window.hacoledTrackEvent('lightbox_open', 'project-lightbox', 'Xem chi tiết dự án: ' + projTitle);
        return;
      }
    });

    // 7. Session Duration & Max Scroll Depth Ping
    let maxScrollPct = 0;
    const pageStartTime = Date.now();

    window.addEventListener('scroll', function() {
      const scrollTop = window.scrollY || document.documentElement.scrollTop;
      const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
      if (scrollHeight > 0) {
        const pct = Math.min(100, Math.round((scrollTop / scrollHeight) * 100));
        if (pct > maxScrollPct) maxScrollPct = pct;
      }
    }, { passive: true });

    function sendLeavePing() {
      flushVisibleSections();
      const totalSeconds = Math.round((Date.now() - pageStartTime) / 1000);
      sendData({
        type: 'ping',
        scroll_depth: maxScrollPct,
        time_seconds: totalSeconds
      });
    }

    window.addEventListener('visibilitychange', function() {
      if (document.visibilityState === 'hidden') {
        sendLeavePing();
      }
    });
    window.addEventListener('pagehide', sendLeavePing);
  });
})();
</script>

<?php
$this->renderFooter($footer_type ?? 'default');
?>
