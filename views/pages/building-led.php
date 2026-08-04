<?php
/**
 * Building Decorative LED Page View Template - Ultra-Premium Light Aceternity UI Edition
 *
 * @var array  $page
 * @var array  $products
 * @var array  $projects
 * @var string $header_type
 * @var string $footer_type
 */

$this->renderHeader($header_type ?? 'default');

// Curated architectural night facade & LED building lighting photos
$display_projects = [];
$unsplash_ids = [
    'photo-1519501025264-65ba15a82390', 'photo-1477959858617-67f85cf4f1df', 'photo-1486406146926-c627a92ad1ab',
    'photo-1513694203232-719a280e022f', 'photo-1514565131-fce0801e5785', 'photo-1565814636199-ae8133055c1c',
    'photo-1496568818309-53d7c7753022', 'photo-1480714378408-67cf0d13bc1b', 'photo-1509198397868-475647b2a1e5',
    'photo-1518241353330-0f7941c2d9b5', 'photo-1506744038136-46273834b3fb', 'photo-1520250497591-112f2f40a3f4',
    'photo-1497215728101-856f4ea42174', 'photo-1497366216548-37526070297c', 'photo-1512917774080-9991f1c4c750',
    'photo-1541888946425-d0fbb186a5b2', 'photo-1470071459604-3b5ec3a7fe05', 'photo-1475855581690-80accde3ae2b',
    'photo-1449034446853-66c86144b0ad', 'photo-1516450360452-9312f5e86fc7', 'photo-1502877338535-766e1452684a',
    'photo-1504608524841-42fe6f032b4b', 'photo-1469474968028-56623f02e42e', 'photo-1447752875215-b2761acb3c5d',
    'photo-1472214222541-d510753a4907', 'photo-1500530855697-b586d89ba3ee', 'photo-1513829096999-497860229434',
    'photo-1518495973542-4542c06a5843', 'photo-1505232458729-4106786a5171', 'photo-1513836279014-a89f7a76ae86',
    'photo-1522071820081-009f0129c71c', 'photo-1515187029135-18ee286d815b', 'photo-1497366811353-6870744d04b2',
    'photo-1504384308090-c894fdcc538d', 'photo-1542744094-3a31f103e35f', 'photo-1454165804606-c3d57bc86b40',
    'photo-1519389950473-47ba0277781c', 'photo-1531403009284-440f080d1e12', 'photo-1531482615713-2afd69097998',
    'photo-1556761175-4b46a572b786', 'photo-1552581230-261c4701235d', 'photo-1558224494-46b221937987',
    'photo-1568992687947-868a62a9f521', 'photo-1573497019940-1c28c88b4f3e', 'photo-1573164713714-d95e436ab8d6'
];

// Diverse aspect ratio classes to produce true staggered Pinterest-style Masonry layout
$aspect_ratios = [
    'aspect-[3/4]',   // Tall portrait
    'aspect-[4/3]',   // Standard landscape
    'aspect-[1/1]',   // Square
    'aspect-[16/10]', // Wide landscape
    'aspect-[9/12]',  // Medium tall
    'aspect-[4/5]',   // Soft portrait
];

$districts = ['Quận 1, TP.HCM', 'Quận Ba Đình, Hà Nội', 'Quận Cầu Giấy, Hà Nội', 'Quận Hải Châu, Đà Nẵng', 'Quận Ngũ Hành Sơn, Đà Nẵng', 'Quận Hoàn Kiếm, Hà Nội'];
$clients = ['Tập đoàn Vingroup', 'Tập đoàn Geleximco', 'Ngân hàng Vietcombank', 'Ngân hàng VPBank', 'Kinh Đô TCI Group', 'Tập đoàn Bitexco', 'Tập đoàn Novaland', 'Tập đoàn Sun Group'];
$lighting_types = ['LED Mesh P16-32 ngoài trời', 'LED Linear RGB chạy viền', 'LED Pixel Dot 50mm lập trình', 'LED Wall Washer 48W chiếu rọi'];

for ($i = 0; $i < 50; $i++) {
    $img_id = $unsplash_ids[$i % count($unsplash_ids)];
    $client = $clients[$i % count($clients)];
    $district = $districts[$i % count($districts)];
    $type = $lighting_types[$i % count($lighting_types)];
    $year = 2023 + ($i % 4);
    $aspect = $aspect_ratios[$i % count($aspect_ratios)];
    
    $display_projects[] = [
        'title'        => sprintf(__('Chiếu sáng mỹ thuật Tòa nhà Landmark %02d', 'hacoled'), $i + 1),
        'client'       => $client . ' - ' . $district,
        'tech_specs'   => $type . ' | DMX512',
        'year'         => (string)$year,
        'aspect_ratio' => $aspect,
        'image'        => 'https://images.unsplash.com/' . $img_id . '?q=80&w=1000&auto=format&fit=crop',
    ];
}

// FETCH REAL PRODUCTS FROM WOOCOMMERCE CATEGORY: 'led-trang-tri-toa-nha'
$staggered_products = [];
$category_slug = 'led-trang-tri-toa-nha';

if (function_exists('wc_get_products')) {
    $wc_products = wc_get_products([
        'category' => [$category_slug],
        'limit'    => -1,
        'status'   => 'publish',
    ]);

    if (!empty($wc_products)) {
        foreach ($wc_products as $wc_prod) {
            $p_id = $wc_prod->get_id();
            $p_image = get_the_post_thumbnail_url($p_id, 'large');
            if (empty($p_image)) {
                $p_image = wc_placeholder_img_src('large');
            }
            
            $excerpt = wp_strip_all_tags($wc_prod->get_short_description());
            if (empty($excerpt)) {
                $excerpt = wp_strip_all_tags(get_the_excerpt($p_id));
            }
            if (empty($excerpt)) {
                $excerpt = __('Sản phẩm LED trang trí mặt dựng tòa nhà chất lượng cao nhập khẩu chính ngạch, đạt chuẩn IP68, hỗ trợ điều khiển lập trình DMX512.', 'hacoled');
            }

            $sku = $wc_prod->get_sku();

            $staggered_products[] = [
                'id'          => $p_id,
                'name'        => $wc_prod->get_name(),
                'permalink'   => get_permalink($p_id),
                'subtitle'    => $sku ? ('SKU: ' . $sku) : 'THIẾT BỊ LED FACADE CHÍNH HÃNG',
                'desc'        => $excerpt,
                'image'       => $p_image,
                'price_html'  => $wc_prod->get_price_html(),
                'specs'       => ['Chuẩn IP68', 'DMX512', 'CO/CQ Chính Hãng'],
                'badge'       => 'Sản phẩm HacoLED',
                'highlights'  => [
                    'Nhập khẩu chính ngạch, có đầy đủ chứng chỉ CO/CQ.',
                    'Hỗ trợ khảo sát & dựng bản vẽ mô phỏng 3D miễn phí.',
                    'Bảo hành vàng 36 tháng tận nơi tại Hà Nội & TP.HCM.'
                ]
            ];
        }
    }
}

// Fallback via WP_Query if wc_get_products returned empty
if (empty($staggered_products)) {
    $cat_query = new WP_Query([
        'post_type'      => 'product',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'tax_query'      => [
            [
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $category_slug,
            ],
        ],
    ]);

    if ($cat_query->have_posts()) {
        while ($cat_query->have_posts()) {
            $cat_query->the_post();
            $p_id = get_the_ID();
            $p_image = get_the_post_thumbnail_url($p_id, 'large');
            if (empty($p_image)) {
                $p_image = 'https://images.unsplash.com/photo-1518241353330-0f7941c2d9b5?q=80&w=800&auto=format&fit=crop';
            }

            $staggered_products[] = [
                'id'          => $p_id,
                'name'        => get_the_title(),
                'permalink'   => get_permalink(),
                'subtitle'    => 'THIẾT BỊ LED FACADE CHÍNH HÃNG',
                'desc'        => get_the_excerpt() ?: __('Sản phẩm LED trang trí mặt dựng tòa nhà chất lượng cao nhập khẩu chính ngạch, đạt chuẩn IP68, hỗ trợ điều khiển lập trình DMX512.', 'hacoled'),
                'image'       => $p_image,
                'price_html'  => '',
                'specs'       => ['Chuẩn IP68', 'DMX512', 'CO/CQ Chính Hãng'],
                'badge'       => 'Sản phẩm HacoLED',
                'highlights'  => [
                    'Nhập khẩu chính ngạch, có đầy đủ chứng chỉ CO/CQ.',
                    'Hỗ trợ khảo sát & dựng bản vẽ mô phỏng 3D miễn phí.',
                    'Bảo hành vàng 36 tháng tận nơi tại Hà Nội & TP.HCM.'
                ]
            ];
        }
        wp_reset_postdata();
    }
}

// Default curated fallback if no products are in category yet
if (empty($staggered_products)) {
    $staggered_products = [
        [
            'name'        => 'Đèn LED Thanh Linear RGB / DMX512 High Power',
            'permalink'   => hacoled_managed_page_url('contact'),
            'subtitle'    => 'CHUYÊN DỤNG CHẠY VIỀN KIẾN TRÚC TÒA NHÀ',
            'desc'        => 'Module LED thanh định hình chuyên dụng chiếu sáng viền và gờ kiến trúc. Điều khiển từng pixel độc lập qua chuẩn DMX512, tạo dải hiệu ứng chuyển màu rực rỡ và mượt mà tuyệt đối.',
            'image'       => 'https://images.unsplash.com/photo-1518241353330-0f7941c2d9b5?q=80&w=800&auto=format&fit=crop',
            'price_html'  => '',
            'specs'       => ['Chuẩn IP68 kháng nước', 'Chip LED OSRAM / CREE', 'Tuổi thọ 50.000 giờ'],
            'badge'       => 'Sản phẩm bán chạy #1',
            'highlights'  => [
                'Thân nhôm Anode đúc nguyên khối chống ăn mòn muối biển.',
                'Kính cường lực 4mm chịu lực va đập cơ học cấp IK10.',
                'Tích hợp mạch bảo vệ quá nhiệt & quá áp thông minh.'
            ]
        ],
        [
            'name'        => 'Màn Hình LED Lưới Trong Suốt Facade Mesh P16-32',
            'permalink'   => hacoled_managed_page_url('contact'),
            'subtitle'    => 'TRUYỀN THÔNG TRONG SUỐT VÁCH KÍNH TÒA NHÀ',
            'desc'        => 'Giải pháp biến toàn bộ mặt dựng kính tòa nhà cao tầng thành màn hình video quảng cáo khổng lồ. Độ truyền sáng trên 80% đảm bảo văn phòng bên trong vẫn tràn ngập ánh sáng tự nhiên.',
            'image'       => 'https://images.unsplash.com/photo-1514565131-fce0801e5785?q=80&w=800&auto=format&fit=crop',
            'price_html'  => '',
            'specs'       => ['Độ truyền sáng >80%', 'Độ sáng 8000 nits Nắng', 'Siêu nhẹ 6kg/m²'],
            'badge'       => 'Công nghệ đột phá 2026',
            'highlights'  => [
                'Trọng lượng siêu nhẹ không ảnh hưởng tới kết cấu chịu lực kính.',
                'Tiết kiệm 35% điện năng so với màn hình LED cabin thông thường.',
                'Đạt tiêu chuẩn kháng gió bão nhiệt đới lên tới cấp 12.'
            ]
        ],
        [
            'name'        => 'LED Điểm Pixel Dot 50mm Lập Trình Ma Trận',
            'permalink'   => hacoled_managed_page_url('contact'),
            'subtitle'    => 'TẠO MÀN HÌNH ĐIỂM SÁNG TRÊN MẶT VÁCH CONG',
            'desc'        => 'Chuỗi LED điểm Pixel đính trên giàn khung lưới thép ngoài trời. Tạo thành ma trận điểm sáng khổng lồ linh hoạt uốn lượn theo mọi đường cong phức tạp của công trình.',
            'image'       => 'https://images.unsplash.com/photo-1509198397868-475647b2a1e5?q=80&w=800&auto=format&fit=crop',
            'price_html'  => '',
            'specs'       => ['Đường kính 50mm IP68', 'Điều khiển SPI/DMX', 'Bọc keo PU chống UV'],
            'badge'       => 'Linh hoạt mọi bề mặt',
            'highlights'  => [
                'Vỏ nhựa Bayer chịu nhiệt độ ngoài trời từ -40°C đến +80°C.',
                'Dây dẫn lõi đồng nguyên chất mạ niken chống đứt gãy.',
                'Hỗ trợ lập trình trình chiếu kịch bản ánh sáng theo mùa.'
            ]
        ],
        [
            'name'        => 'Đèn Pha LED Wall Washer 48W Chiếu Rọi Cột',
            'permalink'   => hacoled_managed_page_url('contact'),
            'subtitle'    => 'CHIẾU QUÉT MẢNG MÀU NGHỆ THUẬT VÁCH TƯỜNG',
            'desc'        => 'Dòng đèn pha rọi chuyên dụng tạo các dải sáng quét cao từ 10m đến 30m dọc theo cột tòa nhà. Tôn vinh từng đường gờ hoa văn kiến trúc tân cổ điển & hiện đại.',
            'image'       => 'https://images.unsplash.com/photo-1565814636199-ae8133055c1c?q=80&w=800&auto=format&fit=crop',
            'price_html'  => '',
            'specs'       => ['Công suất 48W - 108W', 'Chuẩn chống nước IP67', 'Góc chiếu rọi 15°-60°'],
            'badge'       => 'Rọi xa tới 30m',
            'highlights'  => [
                'Thấu kính quang học PMMA đối ứng không gây chói mắt.',
                'Van thở cân bằng áp suất chống ngưng tụ hơi nước bên trong.',
                'Bảo hành đổi mới vật tư 36 tháng tận nơi.'
            ]
        ]
    ];
}

$hero_bg_url = get_template_directory_uri() . '/assets/images/Building_with_LED_lighting_4K_202608031635.jpeg';
?>

<!-- ACETERNITY UI STYLE LANDING PAGE FOR HACOLED FACADE (FULL SCREEN HERO + ULTRA-PREMIUM SECTIONS) -->
<main class="relative bg-[#FAFAFA] text-slate-900 min-h-screen overflow-hidden selection:bg-[#B31217] selection:text-white font-sans">
  
  <!-- SECTION 1: HERO SECTION (Full 100vh Viewport Screen + Raw 4K Background Image + Ultra-Transparent Glassmorphism) -->
  <section class="relative min-h-screen pt-36 lg:pt-44 pb-16 lg:pb-24 px-4 lg:px-8 border-b border-slate-200/60 overflow-hidden flex flex-col justify-center">
    <!-- Raw 100% Opacity Custom Background Image -->
    <div class="absolute inset-0 z-0 overflow-hidden">
      <img src="<?php echo esc_url($hero_bg_url); ?>" alt="HacoLED Building Facade" class="w-full h-full object-cover opacity-100">
    </div>

    <div class="max-w-[1440px] mx-auto w-full relative z-10 space-y-8 my-auto">
      
      <!-- Top Badge (Ultra Transparent Glass + Yellow Dot) -->
      <div class="flex justify-start">
        <div class="inline-flex items-center gap-2.5 bg-white/25 border border-white/50 px-4 py-2 rounded-full text-xs font-mono font-bold text-white shadow-xl backdrop-blur-xl">
          <span class="w-2.5 h-2.5 rounded-full bg-[#FBBF24] animate-pulse"></span>
          <span>HACOLED FACADE · Nhà thầu chiếu sáng mỹ thuật 3D</span>
        </div>
      </div>

      <!-- Left-Aligned Hero Content Block -->
      <div class="max-w-3xl space-y-6">
        <!-- Headline: From White to Premium Gold Yellow, NO TEXT SHADOW -->
        <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black tracking-tight leading-[1.08] text-transparent bg-clip-text bg-gradient-to-r from-white via-[#FDE047] to-[#FBBF24]">
          Chiếu Sáng Mỹ Thuật<br/>
          Kiến Tạo Biểu Tượng Tòa Nhà.
        </h1>

        <!-- Ultra-Transparent Glass Description Box -->
        <p class="text-slate-100 text-sm sm:text-base leading-relaxed font-medium bg-white/25 p-6 rounded-2xl border border-white/40 shadow-2xl backdrop-blur-2xl max-w-2xl">
          Chúng tôi tư vấn, thiết kế 3D và thi công trọn gói hệ thống LED mặt dựng tòa nhà cao tầng. Tối ưu năng lượng, vận hành thông minh qua DMX512 và Cloud IoT.
        </p>

        <div class="flex flex-wrap items-center gap-4 pt-2">
          <!-- Primary CTA Button (Yellow Hero Accent) -->
          <a href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>" class="inline-flex items-center gap-2.5 bg-[#FBBF24] hover:bg-amber-400 text-slate-950 font-black text-xs uppercase px-8 py-4 rounded-xl transition-all duration-300 shadow-2xl shadow-amber-500/30 border border-amber-300">
            <i class="ph-bold ph-chats-circle text-base"></i>
            <span>Khảo Sát & Báo Giá 3D</span>
          </a>
          <!-- Secondary Ultra-Glass Button -->
          <a href="#projects-section" class="inline-flex items-center gap-2.5 bg-white/30 backdrop-blur-xl border border-white/50 text-white hover:bg-white/40 font-bold text-xs uppercase px-6 py-4 rounded-xl transition-all duration-300 shadow-lg">
            <span>Dự Án</span>
            <i class="ph-bold ph-arrow-down text-xs text-[#FBBF24]"></i>
          </a>
        </div>
      </div>

    </div>
  </section>

  <!-- SECTION 2: ULTRA-MODERN BENTO FEATURE GRID "Tại sao chọn HacoLED" -->
  <section class="py-28 px-4 lg:px-8 bg-gradient-to-b from-[#FAFAFA] via-slate-50 to-[#F5F5F7] text-slate-900 border-b border-slate-200/80 relative overflow-hidden">
    
    <!-- Giant Watermark Typography -->
    <div class="absolute top-4 left-1/2 -translate-x-1/2 pointer-events-none select-none">
      <span class="text-[18vw] font-black text-slate-200/50 leading-none tracking-tighter uppercase font-mono">
        SOLUTIONS
      </span>
    </div>

    <div class="max-w-[1440px] mx-auto relative z-10 space-y-16">
      
      <!-- Section Header (Unified Giant Watermark Style) -->
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-3 max-w-2xl">
          <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-red-50 border border-red-200/80 text-[#B31217] font-mono text-xs font-bold uppercase tracking-widest">
            <i class="ph-bold ph-sparkle text-sm"></i>
            <span>TẠI SAO CHỌN HACOLED FACADE</span>
          </div>
          <h2 class="text-3xl sm:text-5xl font-black tracking-tight uppercase text-slate-900 leading-tight">
            Giải Pháp Chiếu Sáng Mỹ Thuật <span class="text-[#B31217]">Trọn Gói & Đẳng Cấp.</span>
          </h2>
        </div>
        <p class="text-slate-500 text-xs sm:text-sm max-w-md font-normal leading-relaxed">
          Đồng hành từ ý tưởng sơ bộ, mô phỏng hiệu ứng 3D trực quan cho tới bàn giao hệ thống điều khiển thông minh.
        </p>
      </div>

      <!-- Bento Grid Layout -->
      <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
        
        <!-- Card 1: 3D Facade Studio Featured Hero Card (col-span-5) -->
        <div class="md:col-span-5 bg-gradient-to-br from-slate-900 via-slate-950 to-slate-900 text-white p-8 lg:p-10 rounded-3xl border border-slate-800 flex flex-col justify-between space-y-8 shadow-2xl relative overflow-hidden group">
          <div class="absolute top-0 right-0 w-64 h-64 bg-[#B31217]/10 rounded-full filter blur-3xl pointer-events-none"></div>
          
          <div class="space-y-4 relative z-10">
            <div class="flex items-center justify-between">
              <span class="px-3.5 py-1.5 rounded-full bg-[#B31217]/30 border border-[#B31217]/50 text-red-400 font-mono text-[11px] font-bold uppercase tracking-wider">3D Facade Studio</span>
              <span class="text-slate-500 font-mono text-xs">01 / FEATURE</span>
            </div>
            <h3 class="text-2xl lg:text-3xl font-extrabold text-white leading-snug">
              Thiết Kế & Mô Phỏng 3D Sơ Bộ Miễn Phí
            </h3>
            <p class="text-xs lg:text-sm text-slate-300 leading-relaxed font-light">
              Chúng tôi tiến hành dựng toàn bộ hiệu ứng ánh sáng 3D trên mô hình tòa nhà của bạn trước khi thi công, giúp chủ đầu tư duyệt phương án trực quan 100%.
            </p>
          </div>

          <div class="space-y-5 relative z-10">
            <div class="w-full aspect-[16/10] rounded-2xl bg-slate-800/90 overflow-hidden border border-slate-700/80 relative shadow-inner">
              <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover opacity-90 group-hover:scale-105 transition-transform duration-700" alt="3D Simulation">
              <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
              <div class="absolute bottom-3 left-3 px-3 py-1 bg-black/60 backdrop-blur-md rounded-lg border border-white/10 text-[10px] font-mono text-slate-300">
                ▶ Simulation Engine v4.2
              </div>
            </div>

            <a href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>" class="w-full inline-flex items-center justify-center gap-2 bg-[#FBBF24] hover:bg-amber-400 text-slate-950 font-black text-xs uppercase py-4 rounded-xl transition-all shadow-lg shadow-amber-500/20">
              <span>Đăng ký bản vẽ 3D</span>
              <i class="ph-bold ph-arrow-right text-sm"></i>
            </a>
          </div>
        </div>

        <!-- Right Side 4 Bento Cards Grid (col-span-7) -->
        <div class="md:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-6">
          
          <!-- Card 2: Tracking & Progress -->
          <div class="bg-white p-7 rounded-3xl border border-slate-200/90 shadow-lg hover:shadow-xl hover:border-[#B31217]/40 transition-all duration-300 space-y-6 flex flex-col justify-between">
            <div class="space-y-3">
              <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold shadow-sm border border-amber-200/60">
                <i class="ph-bold ph-clock-afternoon text-2xl"></i>
              </div>
              <h4 class="text-xl font-extrabold text-slate-900">Giám Sát Tiến Độ 24/7</h4>
              <p class="text-xs text-slate-600 font-normal leading-relaxed">
                Hệ thống báo cáo nhật ký thi công điện tử liên tục, giúp ban quản lý dự án theo dõi sát sao từng mốc nghiệm thu.
              </p>
            </div>
            <div class="bg-slate-50 p-3.5 rounded-2xl border border-slate-100 flex items-center justify-between text-xs font-mono">
              <span class="text-slate-500">Tiến độ thi công:</span>
              <span class="text-[#B31217] font-bold">● Đúng cam kết</span>
            </div>
          </div>

          <!-- Card 3: Cloud & IoT Control Map -->
          <div class="bg-white p-7 rounded-3xl border border-slate-200/90 shadow-lg hover:shadow-xl hover:border-[#B31217]/40 transition-all duration-300 space-y-6 flex flex-col justify-between">
            <div class="space-y-3">
              <div class="w-12 h-12 rounded-2xl bg-red-50 text-[#B31217] flex items-center justify-center font-bold shadow-sm border border-red-200/60">
                <i class="ph-bold ph-cloud-arrow-up text-2xl"></i>
              </div>
              <h4 class="text-lg font-extrabold text-slate-900">Quản Lý Đám Mây IoT</h4>
              <p class="text-xs text-slate-600 font-normal leading-relaxed">
                Đồng bộ điều khiển kịch bản chiếu sáng từ xa qua Internet, hỗ trợ đặt lịch bật/tắt theo lễ tết tự động.
              </p>
            </div>
            <div class="bg-slate-900 text-white p-3.5 rounded-2xl flex items-center justify-between text-xs font-mono shadow-md">
              <span class="text-slate-300">HacoLED Portal Cloud</span>
              <span class="text-emerald-400 font-bold">● Active Online</span>
            </div>
          </div>

          <!-- Card 4: Certified Hardware IP68 -->
          <div class="bg-white p-7 rounded-3xl border border-slate-200/90 shadow-lg hover:shadow-xl hover:border-[#B31217]/40 transition-all duration-300 space-y-6 flex flex-col justify-between">
            <div class="space-y-3">
              <div class="w-12 h-12 rounded-2xl bg-red-50 text-[#B31217] flex items-center justify-center font-bold shadow-sm border border-red-200/60">
                <i class="ph-bold ph-shield-check text-2xl"></i>
              </div>
              <h4 class="text-xl font-extrabold text-slate-900">Vật Tư Chuẩn IP68 & CO/CQ</h4>
              <p class="text-xs text-slate-600 font-normal leading-relaxed">
                100% module LED nhập khẩu chính ngạch, đạt chuẩn kháng nước chống bụi IP68 và vỏ hợp kim chống ăn mòn.
              </p>
            </div>
            <div class="flex gap-2 text-[11px] font-mono font-bold">
              <span class="px-3 py-1 bg-red-50 text-[#B31217] rounded-lg border border-red-200/80">ISO 9001</span>
              <span class="px-3 py-1 bg-red-50 text-[#B31217] rounded-lg border border-red-200/80">CE Certified</span>
            </div>
          </div>

          <!-- Card 5: Warranty & Life Support -->
          <div class="bg-white p-7 rounded-3xl border border-slate-200/90 shadow-lg hover:shadow-xl hover:border-[#B31217]/40 transition-all duration-300 space-y-6 flex flex-col justify-between">
            <div class="space-y-3">
              <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold shadow-sm border border-amber-200/60">
                <i class="ph-bold ph-wrench text-2xl"></i>
              </div>
              <h4 class="text-xl font-extrabold text-slate-900">Bảo Hành Vàng 36 Tháng</h4>
              <p class="text-xs text-slate-600 font-normal leading-relaxed">
                Cam kết khắc phục sự cố tại công trình trong vòng 2 giờ tại Hà Nội và TP.HCM. Bảo trì định kỳ trọn đời.
              </p>
            </div>
            <div class="text-xs font-mono text-[#B31217] font-bold flex items-center gap-1">
              <i class="ph-fill ph-star text-amber-500"></i>
              <span>Hỗ trợ kỹ thuật 24/7/365</span>
            </div>
          </div>

        </div>

      </div>

    </div>
  </section>

  <!-- SECTION 3: PRODUCTS CATALOGUE (Sản Phẩm Danh Mục 'led-trang-tri-toa-nha' Trình Bày Đồng Bộ) -->
  <section class="py-32 px-4 lg:px-8 bg-white border-b border-slate-200/80 relative overflow-hidden">
    
    <!-- Giant Watermark Typography -->
    <div class="absolute top-4 left-1/2 -translate-x-1/2 pointer-events-none select-none">
      <span class="text-[18vw] font-black text-slate-100/90 leading-none tracking-tighter uppercase font-mono">
        PRODUCTS
      </span>
    </div>

    <div class="max-w-[1440px] mx-auto relative z-10 space-y-24">
      
      <!-- Section Header (Unified Giant Watermark Style) -->
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-3 max-w-2xl">
          <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-red-50 text-[#B31217] font-mono text-xs font-bold uppercase tracking-widest border border-red-200/80">
            <i class="ph-bold ph-lightning text-sm"></i>
            <span>DANH MỤC: LED-TRANG-TRI-TOA-NHA</span>
          </div>
          <h2 class="text-3xl sm:text-5xl font-black uppercase tracking-tight text-slate-900 leading-tight">
            Sản Phẩm LED Facade <span class="text-[#B31217]">Chính Hãng.</span>
          </h2>
        </div>
        <p class="text-slate-500 text-xs sm:text-sm max-w-md font-normal leading-relaxed">
          Dữ liệu được lấy trực tiếp từ hệ thống danh mục WooCommerce sản phẩm LED Trang Trí Tòa Nhà đạt chuẩn CO/CQ.
        </p>
      </div>

      <!-- Product Slider Carousel (Synchronized with Website's Component Style) -->
      <div class="product-slider-wrapper relative group/slider mt-12 md:mt-16">
        <style>
          .product-slider-wrapper {
              overflow: visible !important;
          }
          .product-swiper {
              display: block !important;
              overflow-x: auto !important;
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
          }
          .product-swiper .swiper-wrapper {
              display: flex !important;
              flex-direction: row !important;
              flex-wrap: nowrap !important;
              gap: 1.25rem !important;
              width: 100% !important;
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
            <?php foreach ($staggered_products as $prod): 
              $product_url = !empty($prod['permalink']) ? $prod['permalink'] : hacoled_managed_page_url('contact');
              $terms = get_the_terms($prod['id'] ?? 0, 'product_cat');
              $category_name = (!empty($terms) && !is_wp_error($terms)) ? $terms[0]->name : __('LED Trang Trí Tòa Nhà', 'hacoled');
            ?>
              <div class="swiper-slide h-auto">
                <?php 
                $this->renderComponent('product-card', [
                    'title'       => $prod['name'],
                    'description' => $prod['desc'],
                    'permalink'   => $product_url,
                    'thumbnail'   => $prod['image'],
                    'price'       => !empty($prod['price_html']) ? $prod['price_html'] : __('Liên hệ', 'hacoled'),
                    'category'    => $category_name,
                ]);
                ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Navigation Buttons -->
        <button class="custom-swiper-prev absolute top-1/2 -translate-y-1/2 -left-2 md:-left-6 w-10 h-10 md:w-12 md:h-12 bg-white text-gray-800 rounded-full shadow-lg border border-gray-100 flex items-center justify-center hover:bg-[#B31217] hover:text-white hover:border-[#B31217] hover:scale-110 hover:shadow-[0_8px_25px_rgba(204,0,0,0.3)] transition-all duration-300 z-20 opacity-80 md:opacity-0 group-hover/slider:opacity-100 -translate-x-1 md:-translate-x-4 group-hover/slider:translate-x-0" aria-label="Previous slide">
            <i class="ph-bold ph-caret-left text-lg md:text-xl"></i>
        </button>
        <button class="custom-swiper-next absolute top-1/2 -translate-y-1/2 -right-2 md:-right-6 w-10 h-10 md:w-12 md:h-12 bg-white text-gray-800 rounded-full shadow-lg border border-gray-100 flex items-center justify-center hover:bg-[#B31217] hover:text-white hover:border-[#B31217] hover:scale-110 hover:shadow-[0_8px_25px_rgba(204,0,0,0.3)] transition-all duration-300 z-20 opacity-80 md:opacity-0 group-hover/slider:opacity-100 translate-x-1 md:translate-x-4 group-hover/slider:translate-x-0" aria-label="Next slide">
            <i class="ph-bold ph-caret-right text-lg md:text-xl"></i>
        </button>
      </div>

    </div>
  </section>

  <!-- SECTION 4: TRUE STAGGERED MASONRY PROJECTS GALLERY WITH HOVER OVERLAY ONLY -->
  <section id="projects-section" class="py-32 px-4 lg:px-8 bg-[#FAFAFA] relative overflow-hidden border-b border-slate-200/80">
    
    <!-- Giant Watermark Typography -->
    <div class="absolute top-4 left-1/2 -translate-x-1/2 pointer-events-none select-none">
      <span class="text-[18vw] font-black text-slate-200/80 leading-none tracking-tighter uppercase font-mono">
        PROJECTS
      </span>
    </div>

    <div class="max-w-[1440px] mx-auto relative z-10 space-y-16">
      
      <!-- Section Title & Intro (Unified Giant Watermark Style) -->
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-3 max-w-xl">
          <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-red-50 text-[#B31217] font-mono text-xs font-bold uppercase tracking-widest border border-red-200/80">
            <i class="ph-bold ph-buildings text-sm"></i>
            <span>HỒ SƠ NĂNG LỰC DỰ ÁN</span>
          </div>
          <h2 class="text-3xl sm:text-5xl font-black tracking-tight uppercase text-slate-900 leading-tight">
            Công Trình Thực Tế <span class="text-[#B31217]">Đã Thi Công.</span>
          </h2>
        </div>
        <p class="text-slate-500 text-xs sm:text-sm max-w-md font-normal leading-relaxed">
          Dưới đây là các dự án chiếu sáng mặt dựng biểu tượng. Rê chuột vào ảnh để xem chi tiết dự án, hoặc nhấp vào ảnh để lướt xem ảnh full-size.
        </p>
      </div>

      <!-- Dynamic Staggered Masonry Gallery Container (Clean Image by default -> Fade-in Glass Overlay on Hover) -->
      <div id="projects-masonry-container" class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6">
        <?php foreach ($display_projects as $index => $project): 
          $image_url = !empty($project['image']) ? $project['image'] : (!empty($project['thumbnail']) ? $project['thumbnail'] : '');
          if (empty($image_url)) continue;
          
          $aspect_class = !empty($project['aspect_ratio']) ? $project['aspect_ratio'] : 'aspect-[4/3]';
          // Show first 6 images, hide the rest for performance
          $hide_class = ($index >= 6) ? 'hidden project-item-hidden' : '';
        ?>
          <div class="project-card-item <?php echo esc_attr($hide_class); ?> break-inside-avoid group relative rounded-3xl overflow-hidden bg-slate-950 border border-slate-200/80 shadow-md hover:shadow-2xl hover:border-[#B31217] transition-all duration-500 cursor-pointer" data-project-index="<?php echo $index; ?>">
            <div class="relative overflow-hidden w-full <?php echo esc_attr($aspect_class); ?>">
              
              <!-- Clean Raw Image by Default -->
              <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($project['title']); ?>" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
              
              <!-- Smooth Fade-In Glass Overlay on Hover ONLY (opacity-0 -> group-hover:opacity-100) -->
              <div class="absolute inset-0 bg-gradient-to-t from-slate-950/95 via-slate-950/50 to-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-between p-6 z-10">
                
                <!-- Top Badges on Hover -->
                <div class="flex items-center justify-between w-full">
                  <span class="px-3 py-1 rounded-full bg-[#FBBF24] text-slate-950 text-[10px] font-mono font-bold shadow-md">
                    Năm <?php echo esc_html($project['year']); ?>
                  </span>
                  <div class="w-9 h-9 rounded-full bg-black/40 backdrop-blur-md text-white flex items-center justify-center border border-white/20">
                    <i class="ph-bold ph-arrows-out-simple text-sm"></i>
                  </div>
                </div>

                <!-- Bottom Text Info on Hover -->
                <div class="space-y-1.5 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                  <span class="block text-[10px] font-mono text-amber-300 font-bold uppercase tracking-widest drop-shadow"><?php echo esc_html($project['client']); ?></span>
                  <h3 class="text-base sm:text-lg font-extrabold text-white group-hover:text-[#FBBF24] transition-colors leading-snug drop-shadow-md"><?php echo esc_html($project['title']); ?></h3>
                  <p class="text-[11px] font-mono text-slate-300 drop-shadow"><?php echo esc_html($project['tech_specs']); ?></p>
                </div>

              </div>

            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Load More Trigger Button -->
      <?php if (count($display_projects) > 6): ?>
        <div class="text-center pt-8">
          <button id="load-more-projects-btn" class="inline-flex items-center gap-2.5 bg-slate-900 hover:bg-[#B31217] text-white font-extrabold text-xs uppercase px-9 py-4 rounded-xl transition-all duration-300 cursor-pointer shadow-xl border border-slate-800">
            <i class="ph-bold ph-plus text-[#FBBF24]"></i>
            <span><?php echo sprintf(__('Xem thêm %d công trình khác', 'hacoled'), count($display_projects) - 6); ?></span>
          </button>
        </div>
      <?php endif; ?>

    </div>
  </section>

  <!-- SECTION 5: HIGH-IMPACT B2B SOLUTION PACKAGES -->
  <section class="py-32 px-4 lg:px-8 bg-white border-b border-slate-200/80 relative overflow-hidden">
    
    <!-- Giant Watermark Typography -->
    <div class="absolute top-4 left-1/2 -translate-x-1/2 pointer-events-none select-none">
      <span class="text-[18vw] font-black text-slate-100/90 leading-none tracking-tighter uppercase font-mono">
        PACKAGES
      </span>
    </div>

    <div class="max-w-[1240px] mx-auto relative z-10 space-y-16">
      
      <!-- Section Header (Unified Giant Watermark Style) -->
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-3 max-w-xl">
          <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-red-50 text-[#B31217] font-mono text-xs font-bold uppercase tracking-widest border border-red-200/80">
            <i class="ph-bold ph-cubes text-sm"></i>
            <span>GÓI TƯ VẤN THI CÔNG B2B</span>
          </div>
          <h2 class="text-3xl sm:text-5xl font-black uppercase tracking-tight text-slate-900 leading-tight">
            Các Gói Giải Pháp <span class="text-[#B31217]">LED Facade.</span>
          </h2>
        </div>
        <p class="text-slate-500 text-xs sm:text-sm max-w-md font-normal leading-relaxed">
          Lựa chọn gói giải pháp tối ưu dựa theo nhu cầu kiến trúc và ngân sách đầu tư của doanh nghiệp.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
        
        <!-- Package 1 -->
        <div class="bg-[#FAFAFA] p-8 lg:p-9 rounded-3xl border border-slate-200/90 shadow-md hover:shadow-xl transition-all flex flex-col justify-between space-y-8">
          <div class="space-y-5">
            <span class="text-[11px] font-mono text-slate-500 font-bold uppercase tracking-wider">GÓI TÔN VIỀN KIẾN TRÚC</span>
            <h3 class="text-2xl font-extrabold text-slate-900">LED Thanh Viền Facade</h3>
            <p class="text-xs text-slate-600 font-normal leading-relaxed">Dành cho các tòa nhà văn phòng, trụ sở ngân hàng cần chạy viền sắc nét theo cấu trúc đứng.</p>
            <div class="border-t border-slate-200/60 pt-5 space-y-3 text-xs text-slate-700 font-mono">
              <div class="flex items-center gap-2">
                <i class="ph-bold ph-check-circle text-[#B31217] text-base"></i>
                <span>LED Thanh Linear IP68 Chống Rỉ</span>
              </div>
              <div class="flex items-center gap-2">
                <i class="ph-bold ph-check-circle text-[#B31217] text-base"></i>
                <span>Điều khiển DMX512 Chuyển Mượt</span>
              </div>
              <div class="flex items-center gap-2">
                <i class="ph-bold ph-check-circle text-[#B31217] text-base"></i>
                <span>Thân Nhôm Anode Hợp Kim</span>
              </div>
            </div>
          </div>
          <a href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>" class="w-full inline-flex items-center justify-center bg-white hover:bg-[#B31217] hover:text-white text-slate-900 font-bold text-xs uppercase py-4 rounded-xl transition-colors border border-slate-200">
            Nhận báo giá chi tiết
          </a>
        </div>

        <!-- Package 2: Featured Highlighted Card -->
        <div class="bg-white p-8 lg:p-9 rounded-3xl border-2 border-[#B31217] flex flex-col justify-between space-y-8 relative shadow-2xl scale-[1.03] z-10">
          <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1.5 bg-[#B31217] text-white text-[10px] font-mono font-bold uppercase rounded-full shadow-lg">
            ★ KHUYÊN DÙNG CHO TÒA KÍNH
          </div>
          <div class="space-y-5 pt-2">
            <span class="text-[11px] font-mono text-[#B31217] font-bold uppercase tracking-wider">GÓI TRUYỀN THÔNG TRONG SUỐT</span>
            <h3 class="text-2xl font-extrabold text-slate-900">LED Lưới Facade Mesh</h3>
            <p class="text-xs text-slate-600 font-normal leading-relaxed">Biến mặt vách kính tòa nhà thành màn hình video sống động nhưng vẫn giữ độ truyền sáng 80%.</p>
            <div class="border-t border-slate-100 pt-5 space-y-3 text-xs text-slate-700 font-mono">
              <div class="flex items-center gap-2">
                <i class="ph-bold ph-check-circle text-[#B31217] text-base"></i>
                <span>Màn Hình LED Lưới Trong Suốt</span>
              </div>
              <div class="flex items-center gap-2">
                <i class="ph-bold ph-check-circle text-[#B31217] text-base"></i>
                <span>Độ Sáng 8000 nits Hiển Thị Nắng</span>
              </div>
              <div class="flex items-center gap-2">
                <i class="ph-bold ph-check-circle text-[#B31217] text-base"></i>
                <span>Quản Lý Đám Mây IoT Từ Xa</span>
              </div>
            </div>
          </div>
          <a href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>" class="w-full inline-flex items-center justify-center bg-[#FBBF24] hover:bg-amber-400 text-slate-950 font-black text-xs uppercase py-4 rounded-xl transition-colors shadow-lg shadow-amber-500/30">
            Đăng ký khảo sát 3D
          </a>
        </div>

        <!-- Package 3 -->
        <div class="bg-[#FAFAFA] p-8 lg:p-9 rounded-3xl border border-slate-200/90 shadow-md hover:shadow-xl transition-all flex flex-col justify-between space-y-8">
          <div class="space-y-5">
            <span class="text-[11px] font-mono text-slate-500 font-bold uppercase tracking-wider">GÓI CHIẾU RỌI NGHỆ THUẬT</span>
            <h3 class="text-2xl font-extrabold text-slate-900">LED Điểm & Pha Rọi Tường</h3>
            <p class="text-xs text-slate-600 font-normal leading-relaxed">Dành cho các khách sạn sang trọng, tòa nhà di sản cần hiệu ứng chiếu rọi quét mảng màu lớn.</p>
            <div class="border-t border-slate-200/60 pt-5 space-y-3 text-xs text-slate-700 font-mono">
              <div class="flex items-center gap-2">
                <i class="ph-bold ph-check-circle text-[#B31217] text-base"></i>
                <span>Đèn Pha Wall Washer Công Suất Cao</span>
              </div>
              <div class="flex items-center gap-2">
                <i class="ph-bold ph-check-circle text-[#B31217] text-base"></i>
                <span>LED Điểm Pixel Chuỗi Linh Hoạt</span>
              </div>
              <div class="flex items-center gap-2">
                <i class="ph-bold ph-check-circle text-[#B31217] text-base"></i>
                <span>Lập Trình Kịch Bản Lễ Tết</span>
              </div>
            </div>
          </div>
          <a href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>" class="w-full inline-flex items-center justify-center bg-white hover:bg-[#B31217] hover:text-white text-slate-900 font-bold text-xs uppercase py-4 rounded-xl transition-colors border border-slate-200">
            Nhận báo giá chi tiết
          </a>
        </div>

      </div>

    </div>
  </section>

  <!-- SECTION 6: EXECUTIVE BRAND STATEMENT / ĐỘI NGŨ KỸ SƯ -->
  <section class="py-28 px-4 lg:px-8 bg-[#FAFAFA] border-b border-slate-200/80">
    <div class="max-w-[1240px] mx-auto bg-gradient-to-br from-slate-900 via-slate-950 to-slate-900 text-white rounded-3xl border border-slate-800 p-8 sm:p-14 shadow-2xl relative overflow-hidden">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center relative z-10">
        
        <!-- Left Photo Frame -->
        <div class="lg:col-span-5 rounded-2xl overflow-hidden aspect-[4/3] bg-slate-800 border border-slate-700 shadow-xl relative">
          <img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover" alt="HacoLED Engineers">
          <div class="absolute bottom-3 left-3 px-3 py-1 bg-black/60 backdrop-blur-md rounded-lg text-[10px] font-mono text-amber-300 border border-white/10">
            ★ Đội ngũ Kỹ sư Facade HacoLED
          </div>
        </div>

        <!-- Right Quote text -->
        <div class="lg:col-span-7 space-y-6">
          <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#B31217]/30 border border-[#B31217]/50 text-red-400 font-mono text-xs font-bold uppercase">
            <i class="ph-bold ph-quotes text-sm"></i>
            <span>CAM KẾT TỪ GIÁM ĐỐC KỸ THUẬT HACOLED</span>
          </div>
          <h3 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white leading-tight">
            "Mỗi công trình là một kiệt tác ánh sáng được thi công với sự chính xác tuyệt đối."
          </h3>
          <p class="text-xs sm:text-sm text-slate-300 font-light leading-relaxed">
            HacoLED không bán thiết bị đơn thuần. Chúng tôi cung cấp giải pháp tổng thể từ khâu khảo sát cơ điện, vẽ lập trình hiệu ứng 3D cho đến thi công an toàn trên cao. Cam kết đồng hành bảo trì trọn đời cùng chủ đầu tư.
          </p>
          <div class="pt-4 border-t border-slate-800 flex items-center justify-between text-xs font-mono">
            <span class="text-slate-200 font-bold">Ban Kỹ Thuật Dự Án HacoLED</span>
            <span class="text-[#FBBF24] font-bold">Hà Nội & TP.HCM</span>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- SECTION 7: CLIENT TESTIMONIAL REVIEWS -->
  <section class="py-28 px-4 lg:px-8 bg-white border-b border-slate-200/80 relative overflow-hidden">
    
    <!-- Giant Watermark Typography -->
    <div class="absolute top-4 left-1/2 -translate-x-1/2 pointer-events-none select-none">
      <span class="text-[18vw] font-black text-slate-100/90 leading-none tracking-tighter uppercase font-mono">
        REVIEWS
      </span>
    </div>

    <div class="max-w-[1240px] mx-auto relative z-10 space-y-16">
      
      <!-- Section Header (Unified Giant Watermark Style) -->
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-3 max-w-xl">
          <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-red-50 text-[#B31217] font-mono text-xs font-bold uppercase tracking-widest border border-red-200/80">
            <i class="ph-bold ph-star text-sm"></i>
            <span>ĐÁNH GIÁ TỪ CHỦ ĐẦU TƯ</span>
          </div>
          <h2 class="text-3xl sm:text-5xl font-black uppercase tracking-tight text-slate-900 leading-tight">
            Khách Hàng Nói Gì <span class="text-[#B31217]">Về HacoLED.</span>
          </h2>
        </div>
        <p class="text-slate-500 text-xs sm:text-sm max-w-md font-normal leading-relaxed">
          Ý kiến đánh giá và sự hài lòng thực tế từ các chủ đầu tư tòa nhà cao tầng hàng đầu tại Việt Nam.
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
              "HacoLED đã tư vấn và dựng bản vẽ 3D rất trực quan cho tòa nhà trụ sở của chúng tôi. Quá trình thi công chuyên nghiệp và cực kỳ an toàn."
            </p>
          </div>
          <div class="pt-4 border-t border-slate-200/60 flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-[#B31217] text-white font-bold flex items-center justify-center text-xs shadow-md">V</div>
            <div>
              <h5 class="text-xs font-bold text-slate-900">Đại diện Ban Dự án</h5>
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
              "Hệ thống LED lưới mặt kính trong suốt hoạt động vô cùng ổn định, hiệu ứng chuyển màu mượt mà. Rất hài lòng với dịch vụ bảo hành của HacoLED."
            </p>
          </div>
          <div class="pt-4 border-t border-slate-200/60 flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-[#B31217] text-white font-bold flex items-center justify-center text-xs shadow-md">G</div>
            <div>
              <h5 class="text-xs font-bold text-slate-900">Giám đốc Quản lý Tòa nhà</h5>
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
              "Tốc độ ứng cứu sự cố kỹ thuật của HacoLED rất ấn tượng. Chỉ sau hơn 1 giờ nhận báo tin là kỹ sư đã tới tận công trình xử lý xong."
            </p>
          </div>
          <div class="pt-4 border-t border-slate-200/60 flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-[#B31217] text-white font-bold flex items-center justify-center text-xs shadow-md">V</div>
            <div>
              <h5 class="text-xs font-bold text-slate-900">Đội ngũ Vận hành Cơ điện</h5>
              <span class="text-[10px] text-slate-500 font-mono">VPBank Tower</span>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- SECTION 8: FREQUENTLY ASKED QUESTIONS ACCORDION -->
  <section class="py-28 px-4 lg:px-8 bg-[#FAFAFA] relative overflow-hidden">
    
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
          <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-red-50 text-[#B31217] font-mono text-xs font-bold uppercase border border-red-200/80">
            <i class="ph-bold ph-headset text-sm"></i>
            <span>TƯ VẤN TRỰC TIẾP</span>
          </div>
          <h3 class="text-2xl lg:text-3xl font-extrabold text-slate-900">Bạn Cần Đội Ngũ Kỹ Sư Khảo Sát Tận Nơi?</h3>
          <p class="text-xs text-slate-600 font-normal leading-relaxed">
            Đăng ký thông tin công trình của bạn ngay hôm nay. Đội ngũ kỹ sư HacoLED sẽ cử cán bộ tới khảo sát đo đạc thực địa trong 24h.
          </p>
          <a href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>" class="w-full inline-flex items-center justify-center gap-2 bg-[#FBBF24] hover:bg-amber-400 text-slate-950 font-black text-xs uppercase py-4 rounded-xl transition-colors shadow-md">
            <i class="ph-bold ph-phone-call text-base"></i>
            <span>Yêu cầu khảo sát ngay</span>
          </a>
        </div>

        <!-- Right FAQ Accordion List -->
        <div class="lg:col-span-7 space-y-4">
          <h3 class="text-2xl font-black text-slate-900 mb-6">Câu Hỏi Thường Gặp (FAQ)</h3>

          <!-- FAQ Item 1 -->
          <div class="faq-item bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-sm">
            <button class="faq-toggle w-full p-5 text-left font-bold text-sm text-slate-900 hover:text-[#B31217] flex justify-between items-center cursor-pointer transition-colors">
              <span>HacoLED có hỗ trợ dựng bản vẽ 3D hiệu ứng miễn phí không?</span>
              <i class="ph-bold ph-caret-down text-[#B31217] faq-icon transition-transform"></i>
            </button>
            <div class="faq-content hidden px-5 pb-5 text-xs text-slate-600 font-normal leading-relaxed border-t border-slate-200/60 pt-3">
              Có. 100% các dự án chiếu sáng mặt dựng tòa nhà khi liên hệ HacoLED đều được đội ngũ kiến trúc sư dựng phương án 3D miễn phí để chủ đầu tư duyệt trước khi ký hợp đồng.
            </div>
          </div>

          <!-- FAQ Item 2 -->
          <div class="faq-item bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-sm">
            <button class="faq-toggle w-full p-5 text-left font-bold text-sm text-slate-900 hover:text-[#B31217] flex justify-between items-center cursor-pointer transition-colors">
              <span>Hệ thống LED ngoài trời có chịu được bão và chống nước tốt không?</span>
              <i class="ph-bold ph-caret-down text-[#B31217] faq-icon transition-transform"></i>
            </button>
            <div class="faq-content hidden px-5 pb-5 text-xs text-slate-600 font-normal leading-relaxed border-t border-slate-200/60 pt-3">
              Toàn bộ thiết bị LED Facade của HacoLED đều đạt chuẩn bảo vệ IP68 chống nước tuyệt đối. Hệ giàn khung giá đỡ được tính toán kết cấu chịu lực gió bão lên đến cấp 12.
            </div>
          </div>

          <!-- FAQ Item 3 -->
          <div class="faq-item bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-sm">
            <button class="faq-toggle w-full p-5 text-left font-bold text-sm text-slate-900 hover:text-[#B31217] flex justify-between items-center cursor-pointer transition-colors">
              <span>Thời gian thi công hoàn thiện một tòa nhà mất bao lâu?</span>
              <i class="ph-bold ph-caret-down text-[#B31217] faq-icon transition-transform"></i>
            </button>
            <div class="faq-content hidden px-5 pb-5 text-xs text-slate-600 font-normal leading-relaxed border-t border-slate-200/60 pt-3">
              Tùy thuộc vào quy mô vách dựng. Thông thường các tòa nhà từ 15-30 tầng được HacoLED thi công hoàn thiện và nghiệm thu chạy thử trong vòng 15 đến 25 ngày làm việc.
            </div>
          </div>

          <!-- FAQ Item 4 -->
          <div class="faq-item bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-sm">
            <button class="faq-toggle w-full p-5 text-left font-bold text-sm text-slate-900 hover:text-[#B31217] flex justify-between items-center cursor-pointer transition-colors">
              <span>Chính sách bảo hành và sửa chữa sự cố như thế nào?</span>
              <i class="ph-bold ph-caret-down text-[#B31217] faq-icon transition-transform"></i>
            </button>
            <div class="faq-content hidden px-5 pb-5 text-xs text-slate-600 font-normal leading-relaxed border-t border-slate-200/60 pt-3">
              HacoLED bảo hành vàng 36 tháng cho toàn bộ vật tư. Khi xảy ra sự cố, kỹ sư trực tại Hà Nội và TP.HCM có mặt tại công trình trong vòng 2 giờ để xử lý.
            </div>
          </div>

        </div>

      </div>

    </div>
  </section>

</main>

<!-- Lightbox Overlay HTML -->
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

<!-- SCRIPTS: FAQ ACCORDION & LIGHTBOX & LOAD MORE -->
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

    // 2. LOAD MORE SCRIPT
    const loadMoreBtn = document.getElementById('load-more-projects-btn');
    if (loadMoreBtn) {
      loadMoreBtn.addEventListener('click', () => {
        const hiddenItems = document.querySelectorAll('.project-item-hidden');
        hiddenItems.forEach((item, index) => {
          item.classList.remove('hidden', 'project-item-hidden');
          item.style.opacity = '0';
          setTimeout(() => {
            item.style.transition = 'opacity 500ms ease-out, transform 500ms ease-out';
            item.style.opacity = '1';
          }, index * 60);
        });
        loadMoreBtn.parentElement.classList.add('hidden');
      });
    }

    // 3. LIGHTBOX GALLERY SLIDER SCRIPT
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

    lightboxClose.addEventListener('click', closeLightbox);
    lightboxNext.addEventListener('click', nextImage);
    lightboxPrev.addEventListener('click', prevImage);

    document.addEventListener('keydown', (e) => {
      if (lightbox.classList.contains('hidden')) return;
      if (e.key === 'Escape') closeLightbox();
      if (e.key === 'ArrowRight') nextImage();
      if (e.key === 'ArrowLeft') prevImage();
    });

    lightbox.addEventListener('click', (e) => {
      if (e.target === lightbox || e.target === lightbox.querySelector('.relative')) {
        closeLightbox();
      }
    });

    // 4. PRODUCT CAROUSEL SLIDER NATIVE INTERACTION
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
          if (previous) previous.disabled = scrollLeft <= 4;
          if (next) next.disabled = scrollLeft + clientWidth >= scrollWidth - 4;
        });
      };
      previous?.addEventListener('click', () => slider.scrollBy({ left: -slider.clientWidth * 0.85, behavior: 'smooth' }));
      next?.addEventListener('click', () => slider.scrollBy({ left: slider.clientWidth * 0.85, behavior: 'smooth' }));
      slider.addEventListener('scroll', updateButtons, { passive: true });
      updateButtons();
    });
  });
</script>

<?php
$this->renderFooter($footer_type ?? 'default');
?>
