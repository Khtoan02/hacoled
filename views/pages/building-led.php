<?php
/**
 * Building Decorative LED Page View Template - Complete World-Class B2B Landing Design
 *
 * @var array  $page
 * @var array  $products
 * @var array  $projects
 * @var string $header_type
 * @var string $footer_type
 */

$this->renderHeader($header_type ?? 'default');

// Prepare B2B Projects (supporting unlimited dynamic uploads)
$display_projects = $projects;
if (empty($display_projects)) {
    $display_projects = [
        [
            'title'      => __('Chiếu sáng mỹ thuật tòa nhà Geleximco Building Láng Hạ', 'hacoled'),
            'client'     => __('Tập đoàn Geleximco', 'hacoled'),
            'tech_specs' => 'LED Linear RGB | Hệ thống điều khiển DMX512',
            'year'       => '2026',
            'image'      => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=800&auto=format&fit=crop',
        ],
        [
            'title'      => __('Thi công màn hình LED lưới ngoài trời tại Vietcombank Tower TP.HCM', 'hacoled'),
            'client'     => __('Ngân hàng Vietcombank', 'hacoled'),
            'tech_specs' => 'LED Mesh P16-32 | Độ sáng 8000 nits',
            'year'       => '2026',
            'image'      => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=800&auto=format&fit=crop',
        ],
        [
            'title'      => __('Hệ thống LED viền chạy hiệu ứng tòa nhà VPBank Tower Hà Nội', 'hacoled'),
            'client'     => __('Ngân hàng VPBank', 'hacoled'),
            'tech_specs' => 'LED Linear DMX512 | Tiêu chuẩn cơ điện IP68',
            'year'       => '2026',
            'image'      => 'https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?q=80&w=800&auto=format&fit=crop',
        ],
        [
            'title'      => __('LED trang trí kiến trúc mặt dựng tòa nhà Discovery Complex', 'hacoled'),
            'client'     => __('Kinh Đô TCI Group', 'hacoled'),
            'tech_specs' => 'LED Pixel Dot 50mm | Lập trình đồng bộ Cloud',
            'year'       => '2025',
            'image'      => 'https://images.unsplash.com/photo-1507608869274-d3177c8bb4c7?q=80&w=800&auto=format&fit=crop',
        ],
        [
            'title'      => __('Lắp đặt LED chiếu rọi mặt dựng Landmark 81', 'hacoled'),
            'client'     => __('Tập đoàn Vingroup', 'hacoled'),
            'tech_specs' => 'LED Wall Washer 48W | Đồng bộ DMX Master',
            'year'       => '2026',
            'image'      => 'https://images.unsplash.com/photo-1565814636199-ae8133055c1c?q=80&w=800&auto=format&fit=crop',
        ]
    ];
}

// Prepare WooCommerce Products
$display_products = $products;
if (empty($display_products)) {
    $display_products = [
        [
            'id'          => 801,
            'title'       => __('LED Lưới Trong Suốt Haco-Mesh M16', 'hacoled'),
            'description' => __('Giải pháp LED lưới chuyên dụng cho mặt kính tòa nhà văn phòng, trung tâm thương mại. Khối lượng siêu nhẹ (chỉ 8kg/m2), độ trong suốt cao 75-80%, cản gió tối đa, độ sáng lên đến 8000 nits hỗ trợ hiển thị sắc nét dưới ánh nắng.', 'hacoled'),
            'thumbnail'   => 'https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=800&auto=format&fit=crop',
            'category'    => __('LED lưới mặt dựng kính', 'hacoled'),
            'permalink'   => '#',
            'specs'       => [
                'refresh'   => '3840Hz',
                'bright'    => '8000 nits',
                'warranty'  => '36 Tháng',
                'ic'        => 'DMX512 / ArtNet'
            ]
        ],
        [
            'id'          => 802,
            'title'       => __('LED Thanh Facade Haco-Linear L100', 'hacoled'),
            'description' => __('Đèn LED thanh chạy viền kiến trúc ngoài trời. Thân nhôm anode bền bỉ chịu ăn mòn muối biển, thấu kính polycarbonate kháng UV cường độ cao, chuẩn bảo vệ nước tuyệt đối IP68 và lập trình DMX512 mượt mà.', 'hacoled'),
            'thumbnail'   => 'https://images.unsplash.com/photo-1608976328267-e673d3ec06ce?q=80&w=800&auto=format&fit=crop',
            'category'    => __('LED thanh chạy viền', 'hacoled'),
            'permalink'   => '#',
            'specs'       => [
                'refresh'   => '1920Hz',
                'bright'    => '1500 nits',
                'warranty'  => '36 Tháng',
                'ic'        => 'DMX512 Auto-Address'
            ]
        ],
        [
            'id'          => 803,
            'title'       => __('LED Điểm Pixel Dot Haco-Pixel P40', 'hacoled'),
            'description' => __('Đèn LED điểm thông minh thiết kế dạng chuỗi linh hoạt. Chuyên dùng cho các mặt dựng bê tông lớn, kiến trúc phi quy tắc hoặc uốn cong phức tạp. Vỏ chống cháy chuyên dụng, góc nhìn rộng đến 120 độ.', 'hacoled'),
            'thumbnail'   => 'https://images.unsplash.com/photo-1507608869274-d3177c8bb4c7?q=80&w=800&auto=format&fit=crop',
            'category'    => __('LED điểm thông minh', 'hacoled'),
            'permalink'   => '#',
            'specs'       => [
                'refresh'   => '3840Hz',
                'bright'    => '2000 nits',
                'warranty'  => '24 Tháng',
                'ic'        => 'DMX512 / TTL'
            ]
        ],
        [
            'id'          => 804,
            'title'       => __('Đèn LED Pha Rọi Tường Haco-Wall Washer W36', 'hacoled'),
            'description' => __('Đèn pha led rọi tường công suất cao với góc chiếu hẹp (15/30/45 độ) định hướng chính xác. Chuyên dùng chiếu rọi làm nổi bật các cột trụ lớn, mặt tiền phẳng đứng của các tòa nhà di sản, khách sạn sang trọng.', 'hacoled'),
            'thumbnail'   => 'https://images.unsplash.com/photo-1565814636199-ae8133055c1c?q=80&w=800&auto=format&fit=crop',
            'category'    => __('LED pha rọi kiến trúc', 'hacoled'),
            'permalink'   => '#',
            'specs'       => [
                'refresh'   => 'N/A',
                'bright'    => '5400 lm',
                'warranty'  => '36 Tháng',
                'ic'        => 'DMX512 / On-Off'
            ]
        ]
    ];
}
?>

<!-- Immersive B2B Facade LED Landing Page (Redesigned from Scratch) -->
<main class="relative bg-[#F8F6F5] pt-28 md:pt-48 pb-24 overflow-hidden min-h-[90vh] text-slate-800">
  
  <!-- Glowing Background Orbs -->
  <div class="glow-red top-1/4 left-1/4 opacity-10 w-[500px] h-[500px]"></div>
  <div class="glow-gold bottom-1/3 right-1/4 opacity-5 w-[600px] h-[600px]"></div>

  <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10">

    <!-- B2B Breadcrumbs -->
    <nav aria-label="Breadcrumb" class="gsap-reveal mb-8 text-xs font-bold text-slate-400 uppercase tracking-widest flex items-center gap-2" data-direction="up" data-delay="0.1" itemscope itemtype="https://schema.org/BreadcrumbList">
      <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-slate-500 hover:text-[#B31217] transition-colors" itemprop="item">
          <span itemprop="name"><?php _e('Trang chủ', 'hacoled'); ?></span>
        </a>
        <meta itemprop="position" content="1" />
      </span>
      <span class="text-slate-400">/</span>
      <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span class="text-slate-700 font-extrabold" itemprop="name"><?php echo esc_html($page['title']); ?></span>
        <meta itemprop="position" content="2" />
      </span>
    </nav>

    <!-- SECTION 1: IMPRESSIVE HERO SECTION (Symphony of Light & Architecture) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-28 items-stretch">
      
      <!-- Box A (col-span-8): Main Statement Card -->
      <div class="lg:col-span-8 bg-white/70 backdrop-blur-xl border border-white/80 p-8 md:p-12 rounded-[2rem] flex flex-col justify-between shadow-[0_15px_45px_rgba(0,0,0,0.02)] hover:shadow-xl transition-all duration-500 ease-out gsap-reveal" data-direction="up" data-delay="0.1">
        <div class="space-y-6">
          <div class="inline-flex items-center gap-2 bg-[#B31217]/10 border border-[#B31217]/25 px-4 py-1.5 rounded-full text-[10px] font-extrabold uppercase tracking-widest text-[#B31217] font-mono">
            <span class="w-1.5 h-1.5 rounded-full bg-[#B31217] animate-ping"></span>
            <?php _e('Nhà Thầu Chiếu Sáng Mỹ Thuật Kiến Trúc Trọn Gói', 'hacoled'); ?>
          </div>
          
          <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-none uppercase font-heading text-slate-900">
            <?php _e('Chiếu Sáng Mỹ Thuật', 'hacoled'); ?>
            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-[#B31217] via-red-700 to-[#FBBF24]"><?php _e('Kiến Tạo Biểu Tượng', 'hacoled'); ?></span>
          </h1>
          <p class="text-slate-655 text-sm sm:text-base leading-relaxed font-light max-w-2xl">
            <?php _e('HacoLED tự hào đồng hành cùng các tập đoàn và đơn vị thiết kế kiến trúc kiến tạo bản sắc ánh sáng độc bản cho các tòa nhà cao tầng tại Việt Nam. Quy trình trọn gói từ tư vấn thiết kế hiệu ứng 3D, cung cấp vật tư chính ngạch đến thi công an toàn tuyệt đối.', 'hacoled'); ?>
          </p>
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-4 pt-12">
          <a href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#B31217] hover:bg-[#E60000] text-white font-extrabold text-xs uppercase px-8 py-4.5 rounded-xl tracking-wider shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
            <span><?php _e('Đăng Ký Tư Vấn Phương Án 3D', 'hacoled'); ?></span>
            <i class="ph-bold ph-arrow-right text-[11px]"></i>
          </a>
          <a href="#projects-section" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 border border-slate-250 hover:border-slate-400 text-slate-800 font-bold text-xs uppercase px-8 py-4.5 rounded-xl tracking-wider transition-all duration-300 bg-white shadow-sm">
            <span><?php _e('Xem Hồ Sơ Năng Lực Dự Án', 'hacoled'); ?></span>
            <i class="ph-bold ph-arrow-down text-[11px] text-[#B31217]"></i>
          </a>
        </div>
      </div>

      <!-- Box B (col-span-4): B2B Central Control Console Mockup -->
      <div class="lg:col-span-4 bg-white/70 backdrop-blur-xl border border-white/80 p-8 rounded-[2rem] flex flex-col justify-between shadow-[0_15px_45px_rgba(0,0,0,0.02)] hover:shadow-xl transition-all duration-500 ease-out gsap-reveal" data-direction="right" data-delay="0.2">
        <div class="flex items-center justify-between border-b border-slate-150 pb-4">
          <span class="text-[10px] font-bold text-[#B31217] font-mono tracking-widest uppercase">HacoLED Facade Studio</span>
          <span class="w-2.5 h-2.5 rounded-full bg-green-500 animate-pulse"></span>
        </div>

        <div class="my-6 flex-1 flex items-center justify-center relative min-h-[160px]">
          <div class="w-[85%] h-full border-l border-r border-t border-dashed border-slate-300 relative">
            <div class="absolute left-1/3 right-1/3 top-0 bottom-0 border-l border-r border-dashed border-slate-200"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-[#B31217]/5 via-[#FBBF24]/3 to-transparent"></div>
            
            <div class="absolute left-[33%] top-[20%] w-[33%] h-0.5 bg-gradient-to-r from-transparent via-[#FBBF24] to-transparent shadow-glow-gold animate-pulse"></div>
            <div class="absolute left-0 top-[45%] w-full h-0.5 bg-gradient-to-r from-transparent via-[#B31217] to-transparent shadow-glow-red"></div>
            <div class="absolute left-[33%] top-[70%] w-[33%] h-0.5 bg-gradient-to-r from-transparent via-[#FBBF24] to-transparent shadow-glow-gold animate-pulse" style="animation-delay: 0.5s"></div>

            <span class="absolute top-[20%] left-[33%] w-2 h-2 rounded-full bg-[#FBBF24] shadow-glow-gold"></span>
            <span class="absolute top-[45%] left-[50%] w-2 h-2 rounded-full bg-[#B31217] shadow-glow-red" style="animation-delay: 0.3s"></span>
            <span class="absolute top-[70%] right-[33%] w-2 h-2 rounded-full bg-[#FBBF24] shadow-glow-gold" style="animation-delay: 0.6s"></span>
          </div>
        </div>

        <div class="bg-slate-50 border border-slate-100 rounded-2xl p-4 space-y-1 text-xs">
          <div class="flex justify-between text-slate-500">
            <span><?php _e('Giao thức vận hành:', 'hacoled'); ?></span>
            <span class="font-bold text-slate-800">DMX512 / ArtNet / RDM</span>
          </div>
          <div class="flex justify-between text-slate-500">
            <span><?php _e('Tần số quét hình:', 'hacoled'); ?></span>
            <span class="font-bold text-[#B31217]">3840Hz (Flicker-Free)</span>
          </div>
        </div>
      </div>

    </div>

    <!-- SECTION 2: LIGHTING DESIGN PHILOSOPHY (Accentuating Form, Digital Dynamics, Sustainable Light) -->
    <div class="mb-28">
      <div class="text-center max-w-3xl mx-auto mb-16 space-y-4 gsap-reveal" data-direction="up" data-delay="0.2">
        <span class="block text-xs font-bold text-[#B31217] uppercase tracking-widest font-mono"><?php _e('TRIẾT LÝ THIẾT KẾ ÁNH SÁNG', 'hacoled'); ?></span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight uppercase">
          <?php _e('Nhân Tố Cấu Thành Ánh Sáng Kiến Trúc Đạt Chuẩn', 'hacoled'); ?>
        </h2>
        <p class="text-slate-550 text-sm font-light">
          HacoLED tin rằng ánh sáng không chỉ để thắp sáng mà là ngôn ngữ tôn vinh hình khối kiến trúc, tạo nên nhịp điệu sinh động và tiết kiệm năng lượng bền vững.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <!-- Philosophy 1: Accentuate Form -->
        <div class="group p-8 rounded-[2rem] bg-white/70 backdrop-blur-xl border border-white/80 shadow-[0_10px_30px_rgba(0,0,0,0.02)] hover:shadow-xl hover:border-[#B31217]/20 hover:-translate-y-1.5 transition-all duration-500 ease-out flex flex-col justify-between gsap-reveal" data-direction="up" data-delay="0.2">
          <div class="space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-[#B31217]/10 flex items-center justify-center text-[#B31217] border border-[#B31217]/20 group-hover:rotate-6 transition-transform duration-300">
              <i class="ph-bold ph-cube text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-900"><?php _e('Tôn Vinh Hình Khối Kiến Trúc', 'hacoled'); ?></h3>
            <p class="text-xs text-slate-600 leading-relaxed font-light">
              <?php _e('Đi viền chạy dọc các góc tường phẳng phào chỉ, ôm cong theo cấu trúc độc đáo để phô diễn trọn vẹn đường nét thiết kế nguyên bản của các kiến trúc sư vào ban đêm.', 'hacoled'); ?>
            </p>
          </div>
          <div class="pt-6 border-t border-slate-100/80 text-[10px] font-mono text-[#B31217] font-bold uppercase tracking-wider">
            <?php _e('Accentuating Architecture Form', 'hacoled'); ?>
          </div>
        </div>

        <!-- Philosophy 2: Digital Rhythm & Dynamics -->
        <div class="group p-8 rounded-[2rem] bg-white/70 backdrop-blur-xl border border-white/80 shadow-[0_10px_30px_rgba(0,0,0,0.02)] hover:shadow-xl hover:border-[#B31217]/20 hover:-translate-y-1.5 transition-all duration-500 ease-out flex flex-col justify-between gsap-reveal" data-direction="up" data-delay="0.3">
          <div class="space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-amber-100 flex items-center justify-center text-[#FBBF24] border border-[#FBBF24]/30 group-hover:rotate-6 transition-transform duration-300">
              <i class="ph-bold ph-activity text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-900"><?php _e('Nhịp Điệu & Chuyển Động Số', 'hacoled'); ?></h3>
            <p class="text-xs text-slate-600 leading-relaxed font-light">
              <?php _e('Hệ thống lập trình thông minh điều khiển từng cụm pixel hoặc tuyến tính, tạo nên nhịp điệu ánh sáng chuyển sắc mượt mà, biến tòa nhà thành màn hình đa sắc sống động.', 'hacoled'); ?>
            </p>
          </div>
          <div class="pt-6 border-t border-slate-100/80 text-[10px] font-mono text-[#B31217] font-bold uppercase tracking-wider">
            <?php _e('Digital Rhythm & Motion Dynamics', 'hacoled'); ?>
          </div>
        </div>

        <!-- Philosophy 3: Sustainable Eco-Light -->
        <div class="group p-8 rounded-[2rem] bg-white/70 backdrop-blur-xl border border-white/80 shadow-[0_10px_30px_rgba(0,0,0,0.02)] hover:shadow-xl hover:border-[#B31217]/20 hover:-translate-y-1.5 transition-all duration-500 ease-out flex flex-col justify-between gsap-reveal" data-direction="up" data-delay="0.4">
          <div class="space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-[#B31217]/10 flex items-center justify-center text-[#B31217] border border-[#B31217]/20 group-hover:rotate-6 transition-transform duration-300">
              <i class="ph-bold ph-leaf text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-900"><?php _e('Giải Pháp Ánh Sáng Bền Vững', 'hacoled'); ?></h3>
            <p class="text-xs text-slate-600 leading-relaxed font-light">
              <?php _e('Tích hợp các module LED thế hệ mới hỗ trợ tự động tiết kiệm năng lượng lên tới 50% cùng các bộ điều khiển hẹn giờ bật tắt thông minh, giảm khí thải cacbon của đô thị.', 'hacoled'); ?>
            </p>
          </div>
          <div class="pt-6 border-t border-slate-100/80 text-[10px] font-mono text-[#B31217] font-bold uppercase tracking-wider">
            <?php _e('Sustainable Eco-Friendly Lighting', 'hacoled'); ?>
          </div>
        </div>

      </div>
    </div>

    <!-- SECTION 3: SMART SYSTEM INTEGRATION MAP (3-Layer Architecture) -->
    <div class="mb-28 bg-[#FFFBEB] rounded-[3rem] p-8 md:p-16 border border-[#FDE68A]/20">
      <div class="text-center max-w-3xl mx-auto mb-16 space-y-4 gsap-reveal" data-direction="up" data-delay="0.2">
        <span class="block text-xs font-bold text-[#B31217] uppercase tracking-widest font-mono"><?php _e('HỆ THỐNG ĐIỀU KHIỂN THÔNG MINH', 'hacoled'); ?></span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight uppercase">
          <?php _e('Sơ Đồ Tích Hợp Hệ Thống LED Facade', 'hacoled'); ?>
        </h2>
        <p class="text-slate-655 text-sm font-light">
          HacoLED xây dựng kiến trúc hệ thống 3 lớp đồng bộ giúp kiểm soát toàn diện và vận hành bền bỉ từ thiết bị đầu cuối cho đến phần mềm đám mây từ xa.
        </p>
      </div>

      <!-- 3-Layer Bento Box Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
        
        <!-- Layer 1: Nodes -->
        <div class="group p-8 rounded-3xl bg-white/90 border border-white hover:border-[#B31217]/20 hover:scale-[1.01] transition-all duration-500 ease-out flex flex-col justify-between shadow-sm">
          <div class="space-y-4">
            <div class="flex items-center justify-between">
              <span class="text-2xl font-black text-[#B31217] font-mono">01</span>
              <span class="px-2.5 py-0.5 rounded bg-slate-900 text-[8px] font-bold text-white uppercase tracking-widest">FACADE LAYERS</span>
            </div>
            <h3 class="text-lg font-bold text-slate-900"><?php _e('Lớp 1: Thiết Bị Đầu Cuối (Nodes)', 'hacoled'); ?></h3>
            <p class="text-xs text-slate-600 leading-relaxed font-light">
              <?php _e('Bao gồm các dòng LED lưới (LED Mesh), LED thanh (Linear LED), LED điểm (Pixel Dot) và LED pha chiếu rọi (Wall Washer) phân bố uốn lượn trên mặt tiền tòa nhà.', 'hacoled'); ?>
            </p>
            <ul class="text-[11px] space-y-1.5 text-slate-500 font-mono">
              <li><i class="ph-bold ph-check text-[#B31217] mr-1.5"></i><?php _e('Module LED IP68 kháng thời tiết', 'hacoled'); ?></li>
              <li><i class="ph-bold ph-check text-[#B31217] mr-1.5"></i><?php _e('Thiết kế vỏ nhôm chống ăn mòn', 'hacoled'); ?></li>
              <li><i class="ph-bold ph-check text-[#B31217] mr-1.5"></i><?php _e('Lắp đặt đồng bộ an toàn leo cao', 'hacoled'); ?></li>
            </ul>
          </div>
          <div class="pt-4 border-t border-slate-100 text-[10px] text-slate-400 font-mono">
            <?php _e('Physical Hardware Devices', 'hacoled'); ?>
          </div>
        </div>

        <!-- Layer 2: Controllers -->
        <div class="group p-8 rounded-3xl bg-white/90 border border-white hover:border-[#B31217]/20 hover:scale-[1.01] transition-all duration-500 ease-out flex flex-col justify-between shadow-sm">
          <div class="space-y-4">
            <div class="flex items-center justify-between">
              <span class="text-2xl font-black text-[#FBBF24] font-mono">02</span>
              <span class="px-2.5 py-0.5 rounded bg-[#B31217] text-[8px] font-bold text-white uppercase tracking-widest">CONTROL RACKS</span>
            </div>
            <h3 class="text-lg font-bold text-slate-900"><?php _e('Lớp 2: Trung Tâm Tải & Lập Trình', 'hacoled'); ?></h3>
            <p class="text-xs text-slate-600 leading-relaxed font-light">
              <?php _e('Hệ tủ điều khiển cơ điện trung tâm tích hợp nguồn công suất cao và các bộ điều khiển DMX Master / ArtNet Node tiếp nhận và chuyển hóa tín hiệu hiệu ứng.', 'hacoled'); ?>
            </p>
            <ul class="text-[11px] space-y-1.5 text-slate-500 font-mono">
              <li><i class="ph-bold ph-check text-[#FBBF24] mr-1.5"></i><?php _e('Bộ điều khiển DMX512 / ArtNet', 'hacoled'); ?></li>
              <li><i class="ph-bold ph-check text-[#FBBF24] mr-1.5"></i><?php _e('Bộ nguồn chuyển đổi chuẩn Meanwell', 'hacoled'); ?></li>
              <li><i class="ph-bold ph-check text-[#FBBF24] mr-1.5"></i><?php _e('Chống sét lan truyền lan truyền bảo vệ tủ', 'hacoled'); ?></li>
            </ul>
          </div>
          <div class="pt-4 border-t border-slate-100 text-[10px] text-slate-400 font-mono">
            <?php _e('Hardware Signal Transmission', 'hacoled'); ?>
          </div>
        </div>

        <!-- Layer 3: Cloud Portal -->
        <div class="group p-8 rounded-3xl bg-white/90 border border-white hover:border-[#B31217]/20 hover:scale-[1.01] transition-all duration-500 ease-out flex flex-col justify-between shadow-sm">
          <div class="space-y-4">
            <div class="flex items-center justify-between">
              <span class="text-2xl font-black text-[#B31217] font-mono">03</span>
              <span class="px-2.5 py-0.5 rounded bg-slate-900 text-[8px] font-bold text-white uppercase tracking-widest">CLOUD MANAGEMENT</span>
            </div>
            <h3 class="text-lg font-bold text-slate-900"><?php _e('Lớp 3: Cổng Điều Khiển Đám Mây', 'hacoled'); ?></h3>
            <p class="text-xs text-slate-600 leading-relaxed font-light">
              <?php _e('Phần mềm quản lý tập trung HacoLED Cloud Portal. Cho phép quản trị nội dung trình chiếu từ xa, hẹn giờ lập lịch hiệu ứng linh hoạt qua internet.', 'hacoled'); ?>
            </p>
            <ul class="text-[11px] space-y-1.5 text-slate-500 font-mono">
              <li><i class="ph-bold ph-check text-[#B31217] mr-1.5"></i><?php _e('Đồng bộ hiệu ứng nhiều vách tòa nhà', 'hacoled'); ?></li>
              <li><i class="ph-bold ph-check text-[#B31217] mr-1.5"></i><?php _e('Cảnh báo lỗi thiết bị tự động', 'hacoled'); ?></li>
              <li><i class="ph-bold ph-check text-[#B31217] mr-1.5"></i><?php _e('Bảo mật dữ liệu truyền tín hiệu hóa', 'hacoled'); ?></li>
            </ul>
          </div>
          <div class="pt-4 border-t border-slate-100 text-[10px] text-slate-400 font-mono">
            <?php _e('Centralized Software Remote Control', 'hacoled'); ?>
          </div>
        </div>

      </div>
    </div>

    <!-- SECTION 4: PROJECTS PORTFOLIO (Asymmetric Masonry with Load More & Lightbox Gallery) -->
    <div id="projects-section" class="mb-28">
      <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6 gsap-reveal" data-direction="up" data-delay="0.2">
        <div class="space-y-4">
          <span class="block text-xs font-bold text-[#B31217] uppercase tracking-widest font-mono"><?php _e('HỒ SƠ NĂNG LỰC DỰ ÁN', 'hacoled'); ?></span>
          <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight uppercase">
            <?php _e('Hồ Sơ Dự Án Thực Tế Đã Thi Công', 'hacoled'); ?>
          </h2>
          <p class="text-slate-550 text-sm font-light max-w-2xl">
            <?php _e('Hình ảnh nghiệm thu trực tế từ các dự án chiếu sáng mỹ thuật lớn. Bấm vào ảnh bất kỳ để lướt xem thư viện trình chiếu toàn màn hình.', 'hacoled'); ?>
          </p>
        </div>
      </div>

      <!-- Asymmetric Masonry grid -->
      <div id="projects-masonry-container" class="columns-1 md:columns-2 lg:columns-3 gap-8 space-y-8">
        <?php foreach ($display_projects as $index => $project): 
          $image_url = !empty($project['image']) ? $project['image'] : (!empty($project['thumbnail']) ? $project['thumbnail'] : '');
          if (empty($image_url)) continue;
          
          // Show first 6 images, hide the remaining ones dynamically to ensure fast initial page load (SEO friendly)
          $hide_class = ($index >= 6) ? 'hidden project-item-hidden' : '';
        ?>
          <!-- Masonry Project Card -->
          <div class="project-card-item <?php echo esc_attr($hide_class); ?> break-inside-avoid group relative rounded-2xl overflow-hidden border border-white/80 bg-white/70 backdrop-blur-xl shadow-[0_10px_35px_rgba(0,0,0,0.03)] hover:shadow-2xl hover:border-[#B31217]/30 hover:-translate-y-1.5 hover:scale-[1.01] transition-all duration-500 ease-out flex flex-col cursor-pointer" data-project-index="<?php echo $index; ?>">
            <!-- Cover image wrapper -->
            <div class="relative overflow-hidden bg-slate-100 border-b border-slate-100">
              <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($project['title']); ?>" loading="lazy" decoding="async" class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
              
              <!-- Hover visual hint -->
              <div class="absolute inset-0 bg-black/35 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center z-10">
                <div class="w-12 h-12 rounded-full bg-[#B31217] text-white flex items-center justify-center shadow-lg transform scale-90 group-hover:scale-100 transition-transform duration-300">
                  <i class="ph-bold ph-magnifying-glass-plus text-lg"></i>
                </div>
              </div>

              <!-- Verified Badge -->
              <div class="absolute top-4 left-4 z-10">
                <span class="bg-green-600/95 text-white text-[8px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-md shadow-md inline-flex items-center gap-1">
                  <span class="w-1.5 h-1.5 rounded-full bg-white animate-ping"></span>
                  <?php _e('Đã nghiệm thu', 'hacoled'); ?>
                </span>
              </div>

              <!-- Year Badge -->
              <?php if (!empty($project['year'])): ?>
                <div class="absolute top-4 right-4 z-10">
                  <span class="bg-slate-900/90 border border-white/10 text-[#FBBF24] text-[9px] font-mono font-bold px-2.5 py-1 rounded-md">
                    <?php echo esc_html($project['year']); ?>
                  </span>
                </div>
              <?php endif; ?>
            </div>

            <!-- Content Panel -->
            <div class="p-6 space-y-4">
              <div class="space-y-1">
                <?php if (!empty($project['client'])): ?>
                  <span class="block text-[9px] font-bold text-slate-400 uppercase tracking-widest font-mono"><?php echo sprintf(__('Chủ đầu tư: %s', 'hacoled'), esc_html($project['client'])); ?></span>
                <?php endif; ?>
                <h3 class="text-base font-extrabold text-slate-900 leading-snug group-hover:text-[#B31217] transition-colors duration-300">
                  <?php echo esc_html($project['title']); ?>
                </h3>
              </div>
              
              <!-- Technical Specs Strip -->
              <?php if (!empty($project['tech_specs'])): ?>
                <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2 text-[10px] text-slate-500 font-mono uppercase tracking-wider">
                  <span><?php _e('Cấu hình vật tư', 'hacoled'); ?></span>
                  <span class="text-[#B31217] font-bold bg-[#B31217]/5 px-2 py-1 rounded border border-[#B31217]/10">
                    <?php echo esc_html($project['tech_specs']); ?>
                  </span>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Staggered Load More button -->
      <?php if (count($display_projects) > 6): ?>
        <div class="text-center pt-16 gsap-reveal" data-direction="up">
          <button id="load-more-projects-btn" class="inline-flex items-center gap-2 bg-white hover:bg-slate-50 text-slate-800 hover:text-[#B31217] font-extrabold text-xs uppercase px-8 py-4.5 rounded-xl border border-slate-250 hover:border-[#B31217]/30 shadow-sm transition-all duration-300 cursor-pointer">
            <i class="ph-bold ph-plus text-[#B31217]"></i>
            <span><?php echo sprintf(__('Xem thêm %d hình ảnh công trình khác', 'hacoled'), count($display_projects) - 6); ?></span>
          </button>
        </div>
      <?php endif; ?>
    </div>

    <!-- SECTION 5: PRODUCTS CATALOG (SẢN PHẨM THỰC TẾ - B2B SPECIFICATION SHEET) -->
    <div id="facade-products" class="mb-28 bg-[#FFFBEB] rounded-[3rem] p-8 md:p-16 border border-[#FDE68A]/20">
      <div class="text-center max-w-3xl mx-auto mb-16 space-y-4 gsap-reveal" data-direction="up" data-delay="0.2">
        <span class="block text-xs font-bold text-[#B31217] uppercase tracking-widest font-mono"><?php _e('THIẾT BỊ CHUYÊN DỤNG', 'hacoled'); ?></span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight uppercase">
          <?php _e('Catalogue Thiết Bị LED Facade B2B', 'hacoled'); ?>
        </h2>
        <p class="text-slate-655 text-sm font-light">
          <?php _e('Các thiết bị chuyên dụng mặt dựng kiến trúc tòa nhà cao tầng từ HacoLED. Đầy đủ hồ sơ năng lực và chứng nhận CO/CQ.', 'hacoled'); ?>
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

            <!-- Product Details & B2B Spec Grid -->
            <div class="flex-1 flex flex-col justify-between space-y-4">
              <div class="space-y-2">
                <h3 class="text-lg font-bold text-slate-900 group-hover:text-[#B31217] transition-colors duration-300">
                  <?php echo esc_html($prod['title']); ?>
                </h3>
                <p class="text-xs text-slate-500 leading-relaxed font-light line-clamp-3">
                  <?php echo wp_kses_post($prod['description']); ?>
                </p>
              </div>
              
              <!-- Spec Grid values -->
              <?php if (!empty($prod['specs'])): ?>
                <div class="grid grid-cols-2 gap-2 bg-slate-50 p-2.5 rounded-xl border border-slate-100 text-[10px] font-mono">
                  <div class="flex justify-between border-r border-slate-200/60 pr-2">
                    <span class="text-slate-400"><?php _e('Tần số quét:', 'hacoled'); ?></span>
                    <span class="font-bold text-slate-700"><?php echo esc_html($prod['specs']['refresh']); ?></span>
                  </div>
                  <div class="flex justify-between pl-2">
                    <span class="text-slate-400"><?php _e('Độ sáng:', 'hacoled'); ?></span>
                    <span class="font-bold text-[#B31217]"><?php echo esc_html($prod['specs']['bright']); ?></span>
                  </div>
                  <div class="flex justify-between border-r border-slate-200/60 pr-2 pt-1 border-t border-slate-200/40">
                    <span class="text-slate-400"><?php _e('Bảo hành:', 'hacoled'); ?></span>
                    <span class="font-bold text-slate-700"><?php echo esc_html($prod['specs']['warranty']); ?></span>
                  </div>
                  <div class="flex justify-between pl-2 pt-1 border-t border-slate-200/40">
                    <span class="text-slate-400"><?php _e('Hệ IC:', 'hacoled'); ?></span>
                    <span class="font-bold text-slate-700"><?php echo esc_html($prod['specs']['ic']); ?></span>
                  </div>
                </div>
              <?php endif; ?>

              <!-- Spec tags and Detail Link Button -->
              <div class="flex items-center justify-between gap-4 pt-2 border-t border-slate-100 flex-wrap">
                <div class="flex flex-wrap gap-1.5">
                  <span class="px-2 py-0.5 text-[9px] font-bold text-slate-500 bg-slate-100 rounded">
                    <i class="ph-bold ph-shield-check text-[#B31217] mr-1"></i><?php _e('Đầy đủ CO/CQ', 'hacoled'); ?>
                  </span>
                  <span class="px-2 py-0.5 text-[9px] font-bold text-slate-500 bg-slate-100 rounded">
                    <i class="ph-bold ph-seal-check text-[#B31217] mr-1"></i><?php _e('ISO 9001', 'hacoled'); ?>
                  </span>
                </div>
                <?php if (!empty($prod['permalink']) && $prod['permalink'] !== '#') : ?>
                  <a href="<?php echo esc_url($prod['permalink']); ?>" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-white hover:bg-[#B31217] text-slate-700 hover:text-white border border-slate-250 hover:border-[#B31217] font-bold text-xs uppercase tracking-wider transition-all duration-300 pointer-events-auto shadow-sm">
                    <span><?php _e('Bản vẽ & Báo giá B2B', 'hacoled'); ?></span>
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
        <span class="block text-xs font-bold text-[#B31217] uppercase tracking-widest font-mono"><?php _e('TIÊU CHUẨN KỸ THUẬT & DỊCH VỤ', 'hacoled'); ?></span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight uppercase">
          <?php _e('Cam Kết Chuẩn 3F & Tiêu Chí An Toàn Trên Cao', 'hacoled'); ?>
        </h2>
        <p class="text-slate-550 text-sm font-light">
          Nhà thầu HacoLED kết hợp dịch vụ 3F độc quyền cùng quy chuẩn cơ điện leo cao chuyên dụng đảm bảo tuyệt đối an toàn kết cấu xây dựng.
        </p>
      </div>

      <!-- Double Grid: 3F on left, Facade specialties on right -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-stretch">
        
        <!-- Left: 3F Criteria -->
        <div class="p-8 sm:p-12 rounded-3xl bg-white/70 backdrop-blur-xl border border-white/80 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-500 ease-out flex flex-col justify-between space-y-8">
          <div>
            <span class="block text-xs font-bold text-[#B31217] uppercase tracking-widest font-mono mb-2"><?php _e('DỊCH VỤ 3F', 'hacoled'); ?></span>
            <h3 class="text-2xl font-black text-slate-900 uppercase tracking-wide mb-6"><?php _e('Hệ Giá Trị Dịch Vụ 3F', 'hacoled'); ?></h3>
            
            <div class="space-y-6">
              
              <!-- Friendly -->
              <div class="flex items-start gap-4">
                <div class="w-10 h-10 shrink-0 rounded-lg bg-[#FBBF24] text-slate-950 flex items-center justify-center font-black shadow-md">
                  F
                </div>
                <div class="space-y-1">
                  <h4 class="text-base font-bold text-slate-900">Friendly (Tận Tâm & Thân Thiện)</h4>
                  <p class="text-xs text-slate-650 leading-relaxed font-light">
                    Đồng hành cùng đối tác từ bước khảo sát hiện trạng công trình, lên phương án thiết kế hiệu ứng ánh sáng 3D sơ bộ hoàn toàn miễn phí.
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
                    Hỗ trợ kỹ thuật 24/7. Tiếp nhận và xử lý sự cố thiết bị tại công trình trong vòng 2 giờ tại các thành phố lớn Hà Nội và TP.HCM.
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
                    Hợp đồng kinh tế minh bạch, cung cấp hồ sơ kiểm định chất lượng CO/CQ nhập khẩu đầy đủ. Cam kết bảo hành vàng 36 tháng.
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
            <h3 class="text-2xl font-black text-slate-900 uppercase tracking-wide mb-6"><?php _e('Tiêu Chuẩn Cơ Điện Trên Cao', 'hacoled'); ?></h3>
            
            <div class="space-y-6">
              
              <!-- Wind load and safety -->
              <div class="flex gap-4">
                <div class="w-10 h-10 shrink-0 rounded-lg bg-white border border-slate-100 flex items-center justify-center text-[#FBBF24] shadow-sm">
                  <i class="ph-bold ph-wind text-xl"></i>
                </div>
                <div class="space-y-1">
                  <h4 class="text-base font-bold text-slate-900"><?php _e('Chứng Chỉ Thi Công & Chống Tải Gió', 'hacoled'); ?></h4>
                  <p class="text-xs text-slate-655 leading-relaxed font-light">
                    100% nhân sự có chứng chỉ an toàn lao động trên cao. Hệ khung giàn giá đỡ cơ khí được tính toán chi tiết chống gió bão lên đến cấp 12.
                  </p>
                </div>
              </div>

              <!-- IP68 Weather durability -->
              <div class="flex gap-4">
                <div class="w-10 h-10 shrink-0 rounded-lg bg-white border border-slate-100 flex items-center justify-center text-[#B31217] shadow-sm">
                  <i class="ph-bold ph-drop text-xl"></i>
                </div>
                <div class="space-y-1">
                  <h4 class="text-base font-bold text-slate-900"><?php _e('Kháng Thời Tiết IP68 & Chống Muối Biển', 'hacoled'); ?></h4>
                  <p class="text-xs text-slate-655 leading-relaxed font-light">
                    Chất liệu vỏ nhôm hàng không anode hóa chịu ăn mòn cực tốt trong mọi điều kiện khí hậu. Đổ keo chống nước xâm nhập và chống tia UV tuyệt đối.
                  </p>
                </div>
              </div>

              <!-- Smart Cloud control -->
              <div class="flex gap-4">
                <div class="w-10 h-10 shrink-0 rounded-lg bg-white border border-slate-100 flex items-center justify-center text-[#FBBF24] shadow-sm">
                  <i class="ph-bold ph-cloud-arrow-up text-xl"></i>
                </div>
                <div class="space-y-1">
                  <h4 class="text-base font-bold text-slate-900"><?php _e('Hệ Điều Khiển Tập Trung Thông Minh', 'hacoled'); ?></h4>
                  <p class="text-xs text-slate-655 leading-relaxed font-light">
                    Lập trình hiệu ứng ánh sáng thông minh qua giao thức DMX512. Tích hợp IoT hỗ trợ đặt lịch biểu và đồng bộ điều khiển từ xa qua Internet.
                  </p>
                </div>
              </div>

            </div>
          </div>
          <div class="pt-6 border-t border-slate-100">
            <span class="text-xs text-slate-400 font-mono"><?php _e('Cam kết chất lượng và an toàn bền vững', 'hacoled'); ?></span>
          </div>
        </div>

      </div>
    </div>

    <!-- CTA SECTION - Brand red premium callout -->
    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-[#B31217] via-[#A30F14] to-[#8A0B10] border border-[#B31217]/20 p-8 sm:p-12 text-center max-w-4xl mx-auto shadow-2xl gsap-reveal" data-direction="up" data-delay="0.4">
      <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
      <div class="relative z-10 space-y-6">
        <span class="text-xs font-bold text-[#FBBF24] uppercase tracking-widest font-mono"><?php _e('LIÊN HỆ KHẢO SÁT & BÁO GIÁ', 'hacoled'); ?></span>
        <h3 class="text-2xl sm:text-3xl font-extrabold text-white leading-tight uppercase">
          <?php _e('Khảo Sát Thực Địa & Thiết Kế Hiệu Ứng 3D Miễn Phí', 'hacoled'); ?>
        </h3>
        <p class="text-slate-200 text-xs max-w-xl mx-auto leading-relaxed font-light">
          Bắt đầu nâng tầm giá trị thương hiệu và hình ảnh công trình của bạn ngay hôm nay. Đội ngũ kỹ sư dự án HacoLED sẵn sàng tới tận nơi khảo sát kỹ thuật.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
          <a href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#FBBF24] hover:bg-yellow-500 text-slate-900 font-extrabold text-xs uppercase px-8 py-4 rounded-xl tracking-wider shadow-lg transition-all duration-300">
            <span><?php _e('Đăng Ký Khảo Sát & Tư Vấn', 'hacoled'); ?></span>
            <i class="ph-bold ph-arrow-right text-[11px] text-slate-900"></i>
          </a>
          <a href="tel:0342324488" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 border border-white/20 hover:border-white/40 text-white font-bold text-xs uppercase px-8 py-4 rounded-xl tracking-wider transition-all duration-300">
            <i class="ph-fill ph-phone-call text-[13px] text-[#FBBF24]"></i>
            <span>Hotline B2B: 034.232.4488</span>
          </a>
        </div>
      </div>
    </div>

  </div>
</main>

<!-- Lightbox Overlay HTML -->
<div id="project-lightbox" class="fixed inset-0 bg-black/95 z-[9999] hidden flex flex-col items-center justify-center p-4 select-none opacity-0 transition-opacity duration-300 backdrop-blur-md">
  <!-- Close Button -->
  <button id="lightbox-close" class="absolute top-6 right-6 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-all cursor-pointer border border-white/10">
    <i class="ph-bold ph-x text-xl"></i>
  </button>
  
  <!-- Main Wrapper -->
  <div class="relative max-w-5xl max-h-[75vh] w-full flex items-center justify-center">
    <!-- Prev Arrow -->
    <button id="lightbox-prev" class="absolute left-4 z-20 w-12 h-12 rounded-full bg-black/40 hover:bg-[#B31217] text-white flex items-center justify-center transition-all cursor-pointer border border-white/10 hover:scale-105">
      <i class="ph-bold ph-caret-left text-xl"></i>
    </button>
    
    <!-- Image -->
    <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[75vh] object-contain rounded-lg shadow-2xl transition-all duration-300 transform scale-95 opacity-0">
    
    <!-- Next Arrow -->
    <button id="lightbox-next" class="absolute right-4 z-20 w-12 h-12 rounded-full bg-black/40 hover:bg-[#B31217] text-white flex items-center justify-center transition-all cursor-pointer border border-white/10 hover:scale-105">
      <i class="ph-bold ph-caret-right text-xl"></i>
    </button>
  </div>

  <!-- Caption text block -->
  <div class="mt-6 text-center space-y-1 px-4 max-w-xl">
    <h4 id="lightbox-title" class="text-white text-lg font-bold"></h4>
    <p id="lightbox-meta" class="text-slate-400 text-xs font-mono uppercase tracking-wider"></p>
  </div>
</div>

<!-- Project data, Load More and Lightbox Slider scripts -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // 1. ANIC COUNTERS LOGIC
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

    // 2. LOAD MORE LOGIC (Supports smooth grid expansion of 50+ images without slow initial loads)
    const loadMoreBtn = document.getElementById('load-more-projects-btn');
    if (loadMoreBtn) {
      loadMoreBtn.addEventListener('click', () => {
        const hiddenItems = document.querySelectorAll('.project-item-hidden');
        hiddenItems.forEach((item, index) => {
          // Remove hidden class
          item.classList.remove('hidden', 'project-item-hidden');
          // Add opacity transitions
          item.style.opacity = '0';
          setTimeout(() => {
            item.style.transition = 'opacity 500ms ease-out, transform 500ms ease-out';
            item.style.opacity = '1';
          }, index * 80); // Stagger fade-in effect
        });
        
        // Hide the button since everything is loaded
        loadMoreBtn.parentElement.classList.add('hidden');
      });
    }

    // 3. LIGHTBOX GALLERY SLIDER LOGIC
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

      // Show lightbox overlay
      lightbox.classList.remove('hidden');
      setTimeout(() => {
        lightbox.classList.remove('opacity-0');
        lightbox.classList.add('opacity-100', 'flex');
      }, 10);

      // Disable page scrolling
      document.body.style.overflow = 'hidden';

      loadLightboxImage(imgUrl, proj.title, proj.client || '', proj.tech_specs || '', proj.year || '');
    };

    const loadLightboxImage = (url, title, client, specs, year) => {
      // Fade out image before load
      lightboxImg.classList.add('opacity-0', 'scale-95');
      lightboxImg.classList.remove('opacity-100', 'scale-100');

      setTimeout(() => {
        lightboxImg.src = url;
        lightboxTitle.innerText = title;
        
        let metaParts = [];
        if (client) metaParts.push('Đối tác: ' + client);
        if (specs) metaParts.push('Hệ thống: ' + specs);
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

      // Enable page scrolling
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

    // Attach click events on grid cards
    projectCards.forEach(card => {
      card.addEventListener('click', () => {
        const index = card.getAttribute('data-project-index');
        openLightbox(index);
      });
    });

    // Control hooks
    lightboxClose.addEventListener('click', closeLightbox);
    lightboxNext.addEventListener('click', nextImage);
    lightboxPrev.addEventListener('click', prevImage);

    // Keyboard support
    document.addEventListener('keydown', (e) => {
      if (lightbox.classList.contains('hidden')) return;
      if (e.key === 'Escape') closeLightbox();
      if (e.key === 'ArrowRight') nextImage();
      if (e.key === 'ArrowLeft') prevImage();
    });

    // Close on clicking backdrop (except active controls)
    lightbox.addEventListener('click', (e) => {
      if (e.target === lightbox || e.target === lightbox.querySelector('.relative')) {
        closeLightbox();
      }
    });
  });
</script>

<?php
$this->renderFooter($footer_type ?? 'default');
?>
