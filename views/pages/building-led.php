<?php
/**
 * Building Decorative LED Page View Template - Premium Light Architectural Design
 *
 * @var array  $page
 * @var array  $products
 * @var array  $projects
 * @var string $header_type
 * @var string $footer_type
 */

$this->renderHeader($header_type ?? 'default');

// Prepare mock projects if the database is empty or doesn't have enough building projects
$display_projects = $projects;
if (empty($display_projects)) {
    $display_projects = [
        [
            'title'      => __('Chiếu sáng mỹ thuật tòa nhà Geleximco Building Láng Hạ', 'hacoled'),
            'client'     => __('Tập đoàn Geleximco', 'hacoled'),
            'tech_specs' => 'LED Linear RGB | DMX512',
            'year'       => '2026',
            'image'      => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=800&auto=format&fit=crop',
        ],
        [
            'title'      => __('Thi công màn hình LED lưới ngoài trời tại Vietcombank Tower TP.HCM', 'hacoled'),
            'client'     => __('Vietcombank', 'hacoled'),
            'tech_specs' => 'LED Mesh P16-32 | 8000 nits',
            'year'       => '2026',
            'image'      => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=800&auto=format&fit=crop',
        ],
        [
            'title'      => __('Hệ thống LED viền chạy hiệu ứng tòa nhà VPBank Tower Hà Nội', 'hacoled'),
            'client'     => __('VPBank', 'hacoled'),
            'tech_specs' => 'LED Linear DMX | IP68',
            'year'       => '2026',
            'image'      => 'https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?q=80&w=800&auto=format&fit=crop',
        ],
        [
            'title'      => __('LED trang trí kiến trúc mặt dựng tòa nhà Discovery Complex', 'hacoled'),
            'client'     => __('Kinh Đô TCI Group', 'hacoled'),
            'tech_specs' => 'LED Pixel Dot 50mm | RGB',
            'year'       => '2025',
            'image'      => 'https://images.unsplash.com/photo-1507608869274-d3177c8bb4c7?q=80&w=800&auto=format&fit=crop',
        ],
        [
            'title'      => __('Lắp đặt LED chiếu rọi mặt dựng Landmark 81', 'hacoled'),
            'client'     => __('Vingroup', 'hacoled'),
            'tech_specs' => 'LED Wall Washer 48W | RGBW',
            'year'       => '2026',
            'image'      => 'https://images.unsplash.com/photo-1565814636199-ae8133055c1c?q=80&w=800&auto=format&fit=crop',
        ]
    ];
}

// Prepare mock products if WooCommerce is empty or doesn't return products
$display_products = $products;
if (empty($display_products)) {
    $display_products = [
        [
            'id'          => 801,
            'title'       => __('LED Lưới Trong Suốt Haco-Mesh M16', 'hacoled'),
            'description' => __('Giải pháp LED lưới chuyên dụng cho mặt kính tòa nhà. Khối lượng siêu nhẹ, độ trong suốt cao từ 70-80%, cản gió cực thấp và độ sáng lên đến 8000 nits giúp hiển thị sắc nét ngay cả dưới ánh nắng mặt trời trực tiếp.', 'hacoled'),
            'thumbnail'   => 'https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=800&auto=format&fit=crop',
            'category'    => __('LED lưới tòa nhà', 'hacoled'),
            'permalink'   => '#',
        ],
        [
            'id'          => 802,
            'title'       => __('LED Thanh Facade Cao Cấp Haco-Linear L100', 'hacoled'),
            'description' => __('LED thanh chuyên dụng chạy viền tòa nhà, bo góc kiến trúc. Thiết kế nhôm anode bền bỉ, chuẩn kháng nước tuyệt đối IP68, hỗ trợ lập trình hiệu ứng chuyển động RGBW mượt mà qua giao thức DMX512.', 'hacoled'),
            'thumbnail'   => 'https://images.unsplash.com/photo-1608976328267-e673d3ec06ce?q=80&w=800&auto=format&fit=crop',
            'category'    => __('LED thanh trang trí', 'hacoled'),
            'permalink'   => '#',
        ],
        [
            'id'          => 803,
            'title'       => __('LED Điểm Pixel Dot Thông Minh Haco-Pixel P40', 'hacoled'),
            'description' => __('Đèn LED điểm thông minh thiết kế dạng chuỗi. Thích hợp lắp đặt trên các bề mặt cong phức tạp, khối bê tông tòa nhà. Khả năng phối màu không giới hạn, tạo các màn hình trình chiếu video tự do.', 'hacoled'),
            'thumbnail'   => 'https://images.unsplash.com/photo-1507608869274-d3177c8bb4c7?q=80&w=800&auto=format&fit=crop',
            'category'    => __('LED điểm thông minh', 'hacoled'),
            'permalink'   => '#',
        ],
        [
            'id'          => 804,
            'title'       => __('Đèn LED Pha Chiếu Tường Nghệ Thuật Haco-Wall Washer W36', 'hacoled'),
            'description' => __('Đèn pha led rọi tường công suất cao với góc chiếu định hướng chính xác. Chuyên dùng để làm nổi bật bề mặt tường phẳng lớn hoặc cột trụ tòa nhà, thay đổi màu sắc RGBW sinh động từ xa.', 'hacoled'),
            'thumbnail'   => 'https://images.unsplash.com/photo-1565814636199-ae8133055c1c?q=80&w=800&auto=format&fit=crop',
            'category'    => __('LED pha chiếu tường', 'hacoled'),
            'permalink'   => '#',
        ]
    ];
}
?>

<!-- Premium Building LED Template Wrapper (Light Theme synchronized with Homepage) -->
<main class="relative bg-[#F8F6F5] pt-28 md:pt-52 pb-24 overflow-hidden min-h-[90vh]">
  
  <!-- Glowing Background Orbs -->
  <div class="glow-red top-1/4 left-1/4 opacity-10 w-[500px] h-[500px]"></div>
  <div class="glow-gold bottom-1/3 right-1/4 opacity-5 w-[600px] h-[600px]"></div>

  <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10">

    <!-- Breadcrumbs with Schema.org Microdata -->
    <nav aria-label="Breadcrumb" class="gsap-reveal mb-8 text-xs font-semibold text-slate-500 uppercase tracking-widest flex items-center gap-2" data-direction="up" data-delay="0.1" itemscope itemtype="https://schema.org/BreadcrumbList">
      <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-slate-500 hover:text-[#B31217] transition-colors" itemprop="item">
          <span itemprop="name"><?php _e('Trang chủ', 'hacoled'); ?></span>
        </a>
        <meta itemprop="position" content="1" />
      </span>
      <span class="text-slate-400">/</span>
      <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span class="text-slate-700 font-bold" itemprop="name"><?php echo esc_html($page['title']); ?></span>
        <meta itemprop="position" content="2" />
      </span>
    </nav>

    <!-- SECTION 1: HERO SECTION -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-24 min-h-[60vh]">
      <div class="lg:col-span-7 space-y-6 gsap-reveal" data-direction="up" data-delay="0.2">
        <div class="w-12 h-1 bg-gradient-to-r from-[#B31217] via-[#FBBF24] to-yellow-500 rounded-full"></div>
        <span class="block text-xs font-bold text-[#B31217] uppercase tracking-widest font-mono"><?php _e('GIẢI PHÁP CHIẾU SÁNG MỸ THUẬT', 'hacoled'); ?></span>
        <h1 class="text-4xl sm:text-6xl font-black text-slate-900 tracking-tight leading-tight uppercase">
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-950 via-slate-800 to-[#B31217]"><?php _e('LED Trang Trí', 'hacoled'); ?></span>
          <span class="block text-transparent bg-clip-text bg-gradient-to-r from-[#B31217] via-red-650 to-[#FBBF24]"><?php _e('Tòa Nhà Cao Tầng', 'hacoled'); ?></span>
        </h1>
        <p class="text-slate-655 text-sm sm:text-base leading-relaxed font-light max-w-2xl">
          <?php _e('HacoLED tự hào cung cấp giải pháp chiếu sáng mỹ thuật kiến trúc trọn gói. Biến mặt tiền tòa nhà khô khan thành tác phẩm nghệ thuật ánh sáng sống động vào ban đêm, nâng tầm giá trị thương hiệu và tạo điểm nhấn biểu tượng bền vững.', 'hacoled'); ?>
        </p>
        <div class="flex flex-col sm:flex-row items-center gap-4 pt-4">
          <a href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gradient-to-r from-[#B31217] to-[#E60000] hover:from-[#E60000] hover:to-[#B31217] text-white font-extrabold text-xs uppercase px-8 py-4 rounded-full tracking-wider shadow-lg shadow-red-955/15 transition-all duration-300 transform hover:-translate-y-0.5">
            <span><?php _e('Nhận Tư Vấn Thiết Kế 3D Miễn Phí', 'hacoled'); ?></span>
            <i class="ph-bold ph-arrow-right text-[11px]"></i>
          </a>
          <a href="#building-categories" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 border border-slate-250 hover:border-slate-400 text-slate-800 font-bold text-xs uppercase px-8 py-4 rounded-full tracking-wider transition-all duration-300 bg-white shadow-sm">
            <span><?php _e('Khám Phá Giải Pháp', 'hacoled'); ?></span>
            <i class="ph-bold ph-arrow-down text-[11px] text-[#B31217]"></i>
          </a>
        </div>
      </div>
      <div class="lg:col-span-5 relative gsap-reveal" data-direction="right" data-delay="0.3">
        <!-- Abstract neon building mockup representation -->
        <div class="relative w-full aspect-[4/5] max-w-[450px] mx-auto rounded-3xl overflow-hidden border border-white bg-white/70 p-6 flex flex-col justify-end shadow-2xl backdrop-blur-md">
          <div class="absolute inset-0 bg-gradient-to-t from-slate-100/90 via-transparent to-transparent z-10"></div>
          <!-- Decorative Background pattern simulating light pixels -->
          <div class="absolute inset-0 bg-grid-pattern opacity-5 pointer-events-none" style="filter: invert(1);"></div>
          
          <!-- Neon facade lighting abstract graphic -->
          <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-60">
            <div class="w-[80%] h-[90%] border-l border-r border-t border-dashed border-[#B31217]/20 relative">
              <div class="absolute left-1/4 right-1/4 top-0 bottom-0 border-l border-r border-dashed border-[#FBBF24]/20"></div>
              <div class="absolute inset-0 bg-gradient-to-b from-[#B31217]/5 via-[#FBBF24]/3 to-transparent"></div>
              <!-- Floating light points simulating pixel nodes -->
              <span class="absolute top-[20%] left-[25%] w-2.5 h-2.5 rounded-full bg-[#B31217] shadow-glow-red animate-pulse"></span>
              <span class="absolute top-[40%] right-[25%] w-2.5 h-2.5 rounded-full bg-[#FBBF24] shadow-glow-gold animate-pulse"></span>
              <span class="absolute top-[60%] left-[50%] w-2.5 h-2.5 rounded-full bg-[#B31217] shadow-glow-red animate-pulse" style="animation-delay: 0.5s"></span>
              <span class="absolute top-[30%] left-[75%] w-2.5 h-2.5 rounded-full bg-[#FBBF24] shadow-glow-gold animate-pulse" style="animation-delay: 0.8s"></span>
            </div>
          </div>

          <div class="relative z-20 space-y-3">
            <span class="px-3 py-1 rounded-md bg-[#B31217]/10 border border-[#B31217]/20 text-xs font-bold text-[#B31217] uppercase tracking-wider inline-block">Facade Media Art</span>
            <h4 class="text-xl font-bold text-slate-900 uppercase tracking-wide">Vincom Plaza Facade LED</h4>
            <p class="text-xs text-slate-550 leading-relaxed font-light">
              Mô phỏng 3D mặt dựng lập trình ánh sáng thông minh. Giải pháp biến đổi diện mạo kiến trúc chỉ bằng một nút chạm từ xa.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- SECTION 2: APPLICATION CATEGORIES (GIỚI THIỆU HẠNG MỤC ÁP DỤNG) - Premium Light cards with Stagger/Scale Interactions -->
    <div id="building-categories" class="mb-28 scroll-mt-24">
      <div class="text-center max-w-3xl mx-auto mb-16 space-y-4 gsap-reveal" data-direction="up" data-delay="0.2">
        <span class="block text-xs font-bold text-[#B31217] uppercase tracking-widest font-mono"><?php _e('ỨNG DỤNG KIẾN TRÚC', 'hacoled'); ?></span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight uppercase">
          <?php _e('Các Hạng Mục Áp Dụng LED Tòa Nhà', 'hacoled'); ?>
        </h2>
        <p class="text-slate-600 text-sm font-light">
          Tùy theo cấu trúc mặt tiền (kính, bê tông hay nhôm định hình), HacoLED cung cấp các dòng sản phẩm tối ưu nhằm đạt hiệu quả thẩm mỹ vượt trội.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        
        <!-- Category 1: LED lưới -->
        <div class="group p-0 rounded-3xl overflow-hidden bg-white/70 backdrop-blur-xl border border-white/80 shadow-[0_10px_30px_rgba(0,0,0,0.03)] hover:shadow-2xl hover:border-[#B31217]/30 hover:-translate-y-1.5 hover:scale-[1.02] transition-all duration-500 ease-out flex flex-col justify-between gsap-reveal" data-direction="up" data-delay="0.2">
          <div class="aspect-[16/10] overflow-hidden bg-slate-100 relative">
            <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&q=80" alt="LED Lưới (LED Mesh)" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent"></div>
          </div>
          <div class="p-6 space-y-3">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-[#B31217]/10 border border-[#B31217]/20 flex items-center justify-center text-[#B31217] group-hover:rotate-6 transition-transform duration-300">
                <i class="ph-fill ph-grid-four text-xl"></i>
              </div>
              <h3 class="text-lg font-bold text-slate-900 group-hover:text-[#B31217] transition-colors duration-300"><?php _e('LED Lưới (LED Mesh)', 'hacoled'); ?></h3>
            </div>
            <p class="text-xs text-slate-600 leading-relaxed font-light">
              <?php _e('Chuyên lắp đặt trên bề mặt vách kính lớn tòa nhà. Không cản trở ánh sáng tự nhiên đi vào bên trong tòa nhà vào ban ngày, giữ nguyên cấu trúc kính sang trọng.', 'hacoled'); ?>
            </p>
          </div>
          <div class="p-6 pt-0 border-t border-slate-100 text-[11px] font-mono text-[#B31217] font-bold flex items-center justify-between">
            <span><?php _e('Độ trong suốt:', 'hacoled'); ?></span>
            <span>70% - 85%</span>
          </div>
        </div>

        <!-- Category 2: LED thanh -->
        <div class="group p-0 rounded-3xl overflow-hidden bg-white/70 backdrop-blur-xl border border-white/80 shadow-[0_10px_30px_rgba(0,0,0,0.03)] hover:shadow-2xl hover:border-[#B31217]/30 hover:-translate-y-1.5 hover:scale-[1.02] transition-all duration-500 ease-out flex flex-col justify-between gsap-reveal" data-direction="up" data-delay="0.3">
          <div class="aspect-[16/10] overflow-hidden bg-slate-100 relative">
            <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=600&q=80" alt="LED Thanh (Linear Facade)" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent"></div>
          </div>
          <div class="p-6 space-y-3">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-amber-100 border border-[#FBBF24]/30 flex items-center justify-center text-[#FBBF24] group-hover:rotate-6 transition-transform duration-300">
                <i class="ph-fill ph-rows text-xl"></i>
              </div>
              <h3 class="text-lg font-bold text-slate-900 group-hover:text-[#B31217] transition-colors duration-300"><?php _e('LED Thanh (Linear)', 'hacoled'); ?></h3>
            </div>
            <p class="text-xs text-slate-600 leading-relaxed font-light">
              <?php _e('Định hình toàn bộ viền góc, các đường nét kiến trúc nổi bật. Thích hợp dọc các góc tường phẳng, cột trụ đứng để phô diễn cấu trúc hình khối của công trình.', 'hacoled'); ?>
            </p>
          </div>
          <div class="p-6 pt-0 border-t border-slate-100 text-[11px] font-mono text-[#B31217] font-bold flex items-center justify-between">
            <span><?php _e('Tiêu chuẩn:', 'hacoled'); ?></span>
            <span>IP67 / IP68 waterproof</span>
          </div>
        </div>

        <!-- Category 3: LED điểm -->
        <div class="group p-0 rounded-3xl overflow-hidden bg-white/70 backdrop-blur-xl border border-white/80 shadow-[0_10px_30px_rgba(0,0,0,0.03)] hover:shadow-2xl hover:border-[#B31217]/30 hover:-translate-y-1.5 hover:scale-[1.02] transition-all duration-500 ease-out flex flex-col justify-between gsap-reveal" data-direction="up" data-delay="0.4">
          <div class="aspect-[16/10] overflow-hidden bg-slate-100 relative">
            <img src="https://images.unsplash.com/photo-1507608869274-d3177c8bb4c7?w=600&q=80" alt="LED Điểm (Pixel Dot)" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent"></div>
          </div>
          <div class="p-6 space-y-3">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-[#B31217]/10 border border-[#B31217]/20 flex items-center justify-center text-[#B31217] group-hover:rotate-6 transition-transform duration-300">
                <i class="ph-fill ph-circles-four text-xl"></i>
              </div>
              <h3 class="text-lg font-bold text-slate-900 group-hover:text-[#B31217] transition-colors duration-300"><?php _e('LED Điểm (Pixel Dot)', 'hacoled'); ?></h3>
            </div>
            <p class="text-xs text-slate-600 leading-relaxed font-light">
              <?php _e('Lắp đặt rải đều theo các lưới ô bề mặt bê tông hoặc vách dựng phi quy tắc. Cho phép lập trình linh hoạt chạy chữ, đồ họa chuyển động theo yêu cầu của chủ đầu tư.', 'hacoled'); ?>
            </p>
          </div>
          <div class="p-6 pt-0 border-t border-slate-100 text-[11px] font-mono text-[#B31217] font-bold flex items-center justify-between">
            <span><?php _e('Điều khiển:', 'hacoled'); ?></span>
            <span>Cloud Smart Sync</span>
          </div>
        </div>

        <!-- Category 4: LED pha chiếu tường -->
        <div class="group p-0 rounded-3xl overflow-hidden bg-white/70 backdrop-blur-xl border border-white/80 shadow-[0_10px_30px_rgba(0,0,0,0.03)] hover:shadow-2xl hover:border-[#B31217]/30 hover:-translate-y-1.5 hover:scale-[1.02] transition-all duration-500 ease-out flex flex-col justify-between gsap-reveal" data-direction="up" data-delay="0.5">
          <div class="aspect-[16/10] overflow-hidden bg-slate-100 relative">
            <img src="https://images.unsplash.com/photo-1565814636199-ae8133055c1c?w=600&q=80" alt="LED Pha Rọi (Wall Washer)" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent"></div>
          </div>
          <div class="p-6 space-y-3">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-amber-100 border border-[#FBBF24]/30 flex items-center justify-center text-[#FBBF24] group-hover:rotate-6 transition-transform duration-300">
                <i class="ph-fill ph-flashlight text-xl"></i>
              </div>
              <h3 class="text-lg font-bold text-slate-900 group-hover:text-[#B31217] transition-colors duration-300"><?php _e('LED Pha Rọi', 'hacoled'); ?></h3>
            </div>
            <p class="text-xs text-slate-600 leading-relaxed font-light">
              <?php _e('Giải pháp tạo mảng màu chuyển màu mượt mà quét từ dưới chân lên dọc theo các bề mặt tường phẳng đặc, cột trụ to rộng giúp tôn vinh hình khối kiến trúc cổ điển hoặc hiện đại.', 'hacoled'); ?>
            </p>
          </div>
          <div class="p-6 pt-0 border-t border-slate-100 text-[11px] font-mono text-[#B31217] font-bold flex items-center justify-between">
            <span><?php _e('Góc chiếu rọi:', 'hacoled'); ?></span>
            <span>15° / 30° / 45°</span>
          </div>
        </div>

      </div>
    </div>

    <!-- SECTION 3: TRUST METRICS PROJECTED TO 2030 (CÁC CON SỐ ĐỘ TRUST ĐẾN 2030) -->
    <div class="relative rounded-3xl overflow-hidden border border-white/80 bg-white/60 backdrop-blur-xl p-8 md:p-12 mb-28 shadow-xl gsap-reveal" data-direction="up" data-delay="0.3">
      <div class="absolute -left-20 -top-20 w-48 h-48 bg-brand-red/5 rounded-full blur-3xl pointer-events-none"></div>
      
      <div class="mb-12 text-center space-y-2">
        <span class="text-xs font-bold text-[#B31217] uppercase tracking-widest font-mono"><?php _e('TẦM NHÌN DỰ BÁO 2030', 'hacoled'); ?></span>
        <h3 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight uppercase"><?php _e('Kiến Tạo Tương Lai Ánh Sáng Đô Thị', 'hacoled'); ?></h3>
        <p class="text-xs text-slate-500 font-light max-w-xl mx-auto">
          <?php _e('Là một ngành hàng công nghệ mới mang tính đột phá, HacoLED tự tin đặt ra những con số dự phóng phát triển hạ tầng và công nghệ đến năm 2030.', 'hacoled'); ?>
        </p>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-y md:divide-y-0 md:divide-x divide-slate-150">
        <!-- Stat 1 -->
        <div class="space-y-2 pt-6 md:pt-0">
          <div class="text-3xl sm:text-5xl font-black text-[#B31217] flex items-center justify-center gap-0.5">
            <span class="counter" data-target="200">0</span>
            <span class="text-xl">+</span>
          </div>
          <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest font-mono"><?php _e('Tòa nhà thắp sáng (2030)', 'hacoled'); ?></p>
        </div>
        <!-- Stat 2 -->
        <div class="space-y-2 pt-6 md:pt-0">
          <div class="text-3xl sm:text-5xl font-black text-[#B31217] flex items-center justify-center gap-0.5">
            <span class="counter" data-target="100000">0</span>
            <span class="text-xl">m+</span>
          </div>
          <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest font-mono"><?php _e('Mét dài LED tuyến tính', 'hacoled'); ?></p>
        </div>
        <!-- Stat 3 -->
        <div class="space-y-2 pt-6 md:pt-0">
          <div class="text-3xl sm:text-5xl font-black text-[#FBBF24] flex items-center justify-center gap-0.5">
            <span class="counter" data-target="50">0</span>
            <span class="text-xl">%</span>
          </div>
          <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest font-mono"><?php _e('Tiết kiệm điện năng Eco', 'hacoled'); ?></p>
        </div>
        <!-- Stat 4 -->
        <div class="space-y-2 pt-6 md:pt-0">
          <div class="text-3xl sm:text-5xl font-black text-[#B31217] flex items-center justify-center gap-0.5">
            <span class="counter" data-target="99">0</span>
            <span class="text-lg">.9%</span>
          </div>
          <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest font-mono"><?php _e('Tỉ lệ ổn định thời tiết', 'hacoled'); ?></p>
        </div>
      </div>
    </div>

    <!-- SECTION 4: PROJECTS SHOWCASE (DỰ ÁN TIÊU BIỂU - Light Masonry Grid with Zoom & Tilt interactions) -->
    <div class="mb-28">
      <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6 gsap-reveal" data-direction="up" data-delay="0.2">
        <div class="space-y-4">
          <span class="block text-xs font-bold text-[#B31217] uppercase tracking-widest font-mono"><?php _e('HỒ SƠ NĂNG LỰC THỰC TẾ', 'hacoled'); ?></span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight uppercase">
            <?php _e('Dự Án Tiêu Biểu Đã Thực Hiện', 'hacoled'); ?>
          </h2>
          <p class="text-slate-555 text-sm font-light max-w-2xl">
            <?php _e('Hình ảnh thực tế từ các công trình được thiết kế mỹ thuật và tải trực tiếp từ trang quản lý HacoLED.', 'hacoled'); ?>
          </p>
        </div>
      </div>

      <!-- CSS Columns responsive Masonry Grid Layout -->
      <div class="columns-1 md:columns-2 lg:columns-3 gap-8 space-y-8">
        <?php foreach ($display_projects as $project): 
          $image_url = !empty($project['image']) ? $project['image'] : (!empty($project['thumbnail']) ? $project['thumbnail'] : '');
          if (empty($image_url)) continue;
        ?>
          <!-- Masonry Project Card -->
          <div class="break-inside-avoid group relative rounded-2xl overflow-hidden border border-white/80 bg-white/70 backdrop-blur-xl shadow-[0_10px_35px_rgba(0,0,0,0.03)] hover:shadow-2xl hover:border-[#B31217]/30 hover:-translate-y-1.5 hover:scale-[1.01] transition-all duration-500 ease-out flex flex-col">
            <!-- Thumbnail Cover -->
            <div class="relative overflow-hidden bg-slate-100 border-b border-slate-100">
              <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($project['title']); ?>" class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
              
              <!-- Year Badge -->
              <?php if (!empty($project['year'])): ?>
                <div class="absolute top-4 right-4 z-10">
                  <span class="bg-black/75 border border-white/10 backdrop-blur-md text-[#FBBF24] text-[9px] font-mono font-bold px-2.5 py-1 rounded-md">
                    <?php echo esc_html($project['year']); ?>
                  </span>
                </div>
              <?php endif; ?>
            </div>

            <!-- Content Panel -->
            <div class="p-6 space-y-4">
              <div class="space-y-1">
                <?php if (!empty($project['client'])): ?>
                  <span class="block text-[9px] font-bold text-slate-400 uppercase tracking-widest font-mono"><?php echo sprintf(__('Khách hàng: %s', 'hacoled'), esc_html($project['client'])); ?></span>
                <?php endif; ?>
                <h3 class="text-base font-extrabold text-slate-900 leading-snug group-hover:text-[#B31217] transition-colors duration-300">
                  <?php echo esc_html($project['title']); ?>
                </h3>
              </div>
              
              <!-- Technical Specs Strip -->
              <?php if (!empty($project['tech_specs'])): ?>
                <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2 text-[10px] text-slate-500 font-mono uppercase tracking-wider">
                  <span><?php _e('Thông số kỹ thuật', 'hacoled'); ?></span>
                  <span class="text-[#B31217] font-bold bg-[#B31217]/5 px-2 py-1 rounded border border-[#B31217]/10">
                    <?php echo esc_html($project['tech_specs']); ?>
                  </span>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- SECTION 5: PRODUCTS CATALOG (SẢN PHẨM THỰC TẾ - KHÔNG ĐỂ GIÁ, CÓ NÚT XEM CHI TIẾT) -->
    <div class="mb-28 bg-[#FFFBEB] rounded-[3rem] p-8 md:p-16 border border-[#FDE68A]/20">
      <div class="text-center max-w-3xl mx-auto mb-16 space-y-4 gsap-reveal" data-direction="up" data-delay="0.2">
        <span class="block text-xs font-bold text-[#B31217] uppercase tracking-widest font-mono"><?php _e('DANH MỤC THIẾT BỊ', 'hacoled'); ?></span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight uppercase">
          <?php _e('Sản Phẩm LED Facade Chuyên Dụng', 'hacoled'); ?>
        </h2>
        <p class="text-slate-655 text-sm font-light">
          <?php _e('Xem thông tin các thiết bị LED chuyên dụng phục vụ trang trí tòa nhà từ HacoLED. Thiết kế thẩm mỹ và kiểm định chặt chẽ.', 'hacoled'); ?>
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <?php foreach ($display_products as $prod): ?>
          <!-- Custom Product Card for Facade (Light premium design with smooth depth hover) -->
          <div class="group flex flex-col sm:flex-row gap-6 p-6 rounded-3xl bg-white/80 border border-white hover:border-[#B31217]/30 hover:bg-white hover:-translate-y-1 hover:scale-[1.01] transition-all duration-500 ease-out shadow-[0_4px_20px_rgba(0,0,0,0.02)] hover:shadow-xl">
            <!-- Product Image -->
            <div class="w-full sm:w-[150px] aspect-square rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 shrink-0 flex items-center justify-center relative">
              <?php if (!empty($prod['thumbnail'])): ?>
                <img src="<?php echo esc_url($prod['thumbnail']); ?>" alt="<?php echo esc_attr($prod['title']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
              <?php else: ?>
                <i class="ph-bold ph-monitor-play text-slate-400 text-5xl"></i>
              <?php endif; ?>
              
              <!-- Category Badge -->
              <span class="absolute top-2 left-2 px-2 py-0.5 rounded bg-slate-900/90 text-[8px] font-bold text-[#FBBF24] uppercase tracking-widest">
                <?php echo esc_html($prod['category'] ?? __('LED tòa nhà', 'hacoled')); ?>
              </span>
            </div>

            <!-- Product Details -->
            <div class="flex-1 flex flex-col justify-between space-y-4">
              <div class="space-y-2">
                <h3 class="text-lg font-bold text-slate-900 group-hover:text-[#B31217] transition-colors duration-300">
                  <?php echo esc_html($prod['title']); ?>
                </h3>
                <p class="text-xs text-slate-600 leading-relaxed font-light line-clamp-4">
                  <?php echo wp_kses_post($prod['description']); ?>
                </p>
              </div>
              
              <!-- Spec tags and Detail Link Button -->
              <div class="flex items-center justify-between gap-4 pt-4 border-t border-slate-100 flex-wrap">
                <div class="flex flex-wrap gap-2">
                  <span class="px-2 py-1 text-[9px] font-bold text-slate-500 bg-slate-100 rounded">
                    <i class="ph-bold ph-shield-check text-[#B31217] mr-1"></i><?php _e('CO/CQ Chuẩn', 'hacoled'); ?>
                  </span>
                  <span class="px-2 py-1 text-[9px] font-bold text-slate-500 bg-slate-100 rounded">
                    <i class="ph-bold ph-clock text-[#B31217] mr-1"></i><?php _e('BH 24-36T', 'hacoled'); ?>
                  </span>
                </div>
                <?php if (!empty($prod['permalink']) && $prod['permalink'] !== '#') : ?>
                  <a href="<?php echo esc_url($prod['permalink']); ?>" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-white hover:bg-[#B31217] text-slate-700 hover:text-white border border-slate-200 hover:border-[#B31217] font-bold text-xs uppercase tracking-wider transition-all duration-300 pointer-events-auto shadow-sm">
                    <span><?php _e('Xem chi tiết', 'hacoled'); ?></span>
                    <i class="ph-bold ph-arrow-up-right text-[10px]"></i>
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- SECTION 6: HACOLED CRITERIA (3F & BUILDING FACADE LED SPECIALTIES) -->
    <div class="mb-24">
      <div class="text-center max-w-3xl mx-auto mb-16 space-y-4 gsap-reveal" data-direction="up" data-delay="0.2">
        <span class="block text-xs font-bold text-[#B31217] uppercase tracking-widest font-mono"><?php _e('TIÊU CHUẨN DỊCH VỤ HACOLED', 'hacoled'); ?></span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight uppercase">
          <?php _e('Cam Kết 3F & Tiêu Chí Chuyên Biệt', 'hacoled'); ?>
        </h2>
        <p class="text-slate-550 text-sm font-light">
          HacoLED mang chuẩn phục vụ 3F độc quyền kết hợp chặt chẽ với các tiêu chuẩn an toàn kỹ thuật khắt khe của ngành cơ điện trên cao.
        </p>
      </div>

      <!-- Double Grid: 3F on left, Facade specialties on right -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-stretch">
        
        <!-- Left: 3F Criteria -->
        <div class="p-8 sm:p-12 rounded-3xl bg-white/70 backdrop-blur-xl border border-white/80 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-500 ease-out flex flex-col justify-between space-y-8">
          <div>
            <span class="block text-xs font-bold text-[#B31217] uppercase tracking-widest font-mono mb-2"><?php _e('DỊCH VỤ 3F', 'hacoled'); ?></span>
            <h3 class="text-2xl font-black text-slate-900 uppercase tracking-wide mb-6"><?php _e('Trải Nghiệm Dịch Vụ 3F', 'hacoled'); ?></h3>
            
            <div class="space-y-6">
              
              <!-- Friendly -->
              <div class="flex items-start gap-4">
                <div class="w-10 h-10 shrink-0 rounded-lg bg-[#FBBF24] text-slate-950 flex items-center justify-center font-black shadow-md">
                  F
                </div>
                <div class="space-y-1">
                  <h4 class="text-base font-bold text-slate-900">Friendly (Tận Tâm & Thân Thiện)</h4>
                  <p class="text-xs text-slate-650 leading-relaxed font-light">
                    Tư vấn nhiệt tình, hỗ trợ khách hàng lên bản vẽ kỹ thuật và mô phỏng 3D miễn phí trước khi quyết định đầu tư.
                  </p>
                </div>
              </div>

              <!-- Fast -->
              <div class="flex items-start gap-4">
                <div class="w-10 h-10 shrink-0 rounded-lg bg-[#B31217] text-white flex items-center justify-center font-black shadow-md">
                  F
                </div>
                <div class="space-y-1">
                  <h4 class="text-base font-bold text-slate-900">Fast (Tốc Độ & Phản Hồi Nhanh)</h4>
                  <p class="text-xs text-slate-650 leading-relaxed font-light">
                    Đáp ứng mọi cuộc gọi kỹ thuật trong vòng 2 giờ. Khắc phục sự cố hệ thống điều khiển ngoài trời tốc độ tối đa.
                  </p>
                </div>
              </div>

              <!-- Full -->
              <div class="flex items-start gap-4">
                <div class="w-10 h-10 shrink-0 rounded-lg bg-[#FBBF24] text-slate-950 flex items-center justify-center font-black shadow-md">
                  F
                </div>
                <div class="space-y-1">
                  <h4 class="text-base font-bold text-slate-900">Full (Trọn Vẹn & Đầy Đủ)</h4>
                  <p class="text-xs text-slate-650 leading-relaxed font-light">
                    Hợp đồng minh bạch, cung cấp đầy đủ giấy chứng nhận nguồn gốc xuất xứ CO/CQ. Bảo hành vàng dài hạn lên đến 3 năm.
                  </p>
                </div>
              </div>

            </div>
          </div>
          <div class="pt-6 border-t border-slate-100">
            <span class="text-xs text-slate-400 font-mono"><?php _e('Chuẩn dịch vụ độc quyền tại HacoLED', 'hacoled'); ?></span>
          </div>
        </div>

        <!-- Right: Facade Special Aspects - Red tinted premium container -->
        <div class="p-8 sm:p-12 rounded-3xl bg-[#FFF5F5] border border-[#B31217]/10 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-500 ease-out flex flex-col justify-between space-y-8">
          <div>
            <span class="block text-xs font-bold text-[#B31217] uppercase tracking-widest font-mono mb-2"><?php _e('KỸ THUẬT ĐẶC THÙ', 'hacoled'); ?></span>
            <h3 class="text-2xl font-black text-slate-900 uppercase tracking-wide mb-6"><?php _e('Yêu Cầu Kỹ Thuật Đặc Thù', 'hacoled'); ?></h3>
            
            <div class="space-y-6">
              
              <!-- Wind load and safety -->
              <div class="flex gap-4">
                <div class="w-10 h-10 shrink-0 rounded-lg bg-white border border-slate-100 flex items-center justify-center text-[#FBBF24] shadow-sm">
                  <i class="ph-bold ph-wind text-xl"></i>
                </div>
                <div class="space-y-1">
                  <h4 class="text-base font-bold text-slate-900"><?php _e('An Toàn Trên Cao & Tải Gió', 'hacoled'); ?></h4>
                  <p class="text-xs text-slate-655 leading-relaxed font-light">
                    Đội ngũ thi công đạt chứng chỉ an toàn lao động trên cao. Kết cấu giá đỡ tính toán chịu sức gió bão lên đến cấp 12.
                  </p>
                </div>
              </div>

              <!-- IP68 Weather durability -->
              <div class="flex gap-4">
                <div class="w-10 h-10 shrink-0 rounded-lg bg-white border border-slate-100 flex items-center justify-center text-[#B31217] shadow-sm">
                  <i class="ph-bold ph-drop text-xl"></i>
                </div>
                <div class="space-y-1">
                  <h4 class="text-base font-bold text-slate-900"><?php _e('Kháng Thời Tiết IP68 & Chống Ăn Mòn', 'hacoled'); ?></h4>
                  <p class="text-xs text-slate-655 leading-relaxed font-light">
                    Sử dụng vật liệu nhôm hàng không anode chống chịu muối biển ăn mòn. Module đạt chuẩn IP68 chống tia cực tím độc hại.
                  </p>
                </div>
              </div>

              <!-- Smart Cloud control -->
              <div class="flex gap-4">
                <div class="w-10 h-10 shrink-0 rounded-lg bg-white border border-slate-100 flex items-center justify-center text-[#FBBF24] shadow-sm">
                  <i class="ph-bold ph-cloud-arrow-up text-xl"></i>
                </div>
                <div class="space-y-1">
                  <h4 class="text-base font-bold text-slate-900"><?php _e('Hệ Điều Khiển Đám Mây Smart Facade', 'hacoled'); ?></h4>
                  <p class="text-xs text-slate-655 leading-relaxed font-light">
                    Hỗ trợ quản lý nội dung từ xa thông qua đám mây. Tự động lập lịch trình chiếu và đồng bộ nhiều vách tòa nhà.
                  </p>
                </div>
              </div>

            </div>
          </div>
          <div class="pt-6 border-t border-slate-100">
            <span class="text-xs text-slate-400 font-mono"><?php _e('Đảm bảo kỹ thuật và mỹ thuật bền vững', 'hacoled'); ?></span>
          </div>
        </div>

      </div>
    </div>

    <!-- CTA SECTION - Brand red premium callout -->
    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-[#B31217] via-[#A30F14] to-[#8A0B10] border border-[#B31217]/20 p-8 sm:p-12 text-center max-w-4xl mx-auto shadow-2xl gsap-reveal" data-direction="up" data-delay="0.4">
      <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
      <div class="relative z-10 space-y-6">
        <span class="text-xs font-bold text-[#FBBF24] uppercase tracking-widest font-mono"><?php _e('ĐỐI TÁC THI CÔNG TIN CẬY', 'hacoled'); ?></span>
        <h3 class="text-2xl sm:text-3xl font-extrabold text-white leading-tight uppercase">
          <?php _e('Liên Hệ HacoLED Để Thiết Kế Ánh Sáng Tòa Nhà', 'hacoled'); ?>
        </h3>
        <p class="text-slate-200 text-xs max-w-xl mx-auto leading-relaxed font-light">
          <?php _e('Bắt đầu nâng tầm kiến trúc tòa nhà của bạn ngay hôm nay. HacoLED sẵn sàng hỗ trợ khảo sát thực địa và tư vấn phương án kỹ thuật miễn phí.', 'hacoled'); ?>
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
          <a href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#FBBF24] hover:bg-yellow-500 text-slate-900 font-extrabold text-xs uppercase px-8 py-4 rounded-full tracking-wider shadow-lg transition-all duration-300">
            <span><?php _e('Gửi Yêu Cầu Thiết Kế', 'hacoled'); ?></span>
            <i class="ph-bold ph-arrow-right text-[11px] text-slate-900"></i>
          </a>
          <a href="tel:0342324488" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 border border-white/20 hover:border-white/40 text-white font-bold text-xs uppercase px-8 py-4 rounded-full tracking-wider transition-all duration-300">
            <i class="ph-fill ph-phone-call text-[13px] text-[#FBBF24]"></i>
            <span>Hotline: 034.232.4488</span>
          </a>
        </div>
      </div>
    </div>

  </div>
</main>

<!-- Number counters Javascript (same as home.php counters) -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('.counter');
    const animateCounters = () => {
      counters.forEach(counter => {
        const target = +counter.getAttribute('data-target');
        const speed = 60;
        const updateCount = () => {
          const count = +counter.innerText;
          const inc = target / speed;
          if (count < target) {
            counter.innerText = Math.ceil(count + inc);
            setTimeout(updateCount, 30);
          } else {
            counter.innerText = target;
          }
        };
        updateCount();
      });
    };

    // Scroll trigger observer
    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateCounters();
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    const statsBlock = document.querySelector('.counter');
    if (statsBlock) {
      observer.observe(statsBlock.parentElement.parentElement);
    }
  });
</script>

<?php
$this->renderFooter($footer_type ?? 'default');
?>
