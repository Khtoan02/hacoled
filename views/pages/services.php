<?php
/**
 * Services Page View Template - Consolidated AV Pro (LED + Audio + Repair)
 *
 * @var array  $page
 * @var string $header_type
 * @var string $footer_type
 */

$this->renderHeader($header_type ?? 'default');
?>

<!-- Premium Services Page Wrapper (Light Theme) -->
<main class="relative bg-[#FAFAFA] pt-28 md:pt-48 pb-24 overflow-hidden min-h-[80vh]">
  
  <!-- Glowing Background Orbs -->
  <div class="glow-gold top-1/4 right-0 opacity-10"></div>
  <div class="glow-red bottom-1/4 left-0 opacity-5"></div>

  <!-- Dong Son drum watermark -->

  <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10">

    <!-- Breadcrumbs with Schema.org Microdata -->
    <nav aria-label="Breadcrumb" class="gsap-reveal mb-6 text-xs font-semibold text-slate-400 uppercase tracking-widest flex items-center gap-2" data-direction="up" data-delay="0.1" itemscope itemtype="https://schema.org/BreadcrumbList">
      <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-slate-500 hover:text-accent-gold transition-colors" itemprop="item">
          <span itemprop="name"><?php _e('Trang chủ', 'hacoled'); ?></span>
        </a>
        <meta itemprop="position" content="1" />
      </span>
      <span class="text-slate-400">/</span>
      <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span class="text-slate-650" itemprop="name"><?php echo esc_html($page['title']); ?></span>
        <meta itemprop="position" content="2" />
      </span>
    </nav>

    <!-- HEADER BLOCK -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-16 border-b border-slate-200 pb-16">
      <div class="lg:col-span-7 space-y-4 gsap-reveal" data-direction="up" data-delay="0.2">
        <div class="w-12 h-1 bg-gradient-to-r from-accent-red to-accent-gold rounded-full"></div>
        <span class="block text-[11px] font-bold text-accent-red uppercase tracking-widest font-mono"><?php _e('HỆ SINH THÁI AV PRO TOÀN DIỆN', 'hacoled'); ?></span>
        <h1 class="text-3xl sm:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight uppercase">
          <?php echo esc_html($page['title']); ?>
        </h1>
        <p class="text-slate-650 text-sm leading-relaxed font-light">
          <?php _e('HacoLED mang đến hệ giải pháp AV Pro tích hợp đỉnh cao. Chúng tôi không chỉ cung cấp giải pháp hiển thị màn hình LED chất lượng vượt trội mà còn đồng bộ hệ thống âm thanh, ánh sáng chuyên nghiệp, đi kèm dịch vụ bảo hành sửa chữa phản tốc nhằm kiến tạo không gian trình chiếu hoàn hảo nhất.', 'hacoled'); ?>
        </p>
      </div>
      <!-- Hero Banner image -->
      <div class="lg:col-span-5 relative group gsap-reveal" data-direction="right" data-delay="0.3">
        <div class="absolute -inset-1 bg-gradient-to-r from-accent-red to-accent-gold rounded-3xl blur opacity-20 group-hover:opacity-35 transition-opacity"></div>
        <div class="relative w-full rounded-2xl overflow-hidden border border-slate-200 bg-slate-100 aspect-[16/10] shadow-lg">
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/services-hero.png'); ?>" 
               alt="Hệ thống AV Pro HacoLED" 
               class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-500"
               fetchpriority="high"
               decoding="async">
        </div>
      </div>
    </div>

    <!-- SECTION 1: LẮP ĐẶT MÀN HÌNH LED CHUYÊN NGHIỆP -->
    <div class="mb-24 border-b border-slate-200 pb-16">
      
      <!-- Section Title & Intro -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end mb-12">
        <div class="lg:col-span-7 space-y-3 gsap-reveal" data-direction="up" data-delay="0.1">
          <span class="text-xs font-bold text-accent-red uppercase tracking-widest font-mono block mb-1">SERVICES 01</span>
          <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-wide uppercase">
            <?php _e('Dịch vụ lắp đặt màn hình LED chuyên nghiệp', 'hacoled'); ?>
          </h2>
          <div class="w-16 h-0.5 bg-accent-red mt-2"></div>
        </div>
        <div class="lg:col-span-5 gsap-reveal" data-direction="up" data-delay="0.2">
          <p class="text-slate-650 text-xs leading-relaxed font-light">
            <?php _e('HacoLED thi công lắp đặt trọn gói hệ thống màn hình LED trong nhà (Indoor) và ngoài trời (Outdoor) trên toàn quốc. Đội ngũ kỹ sư lành nghề cam kết màn hình phẳng mịn, độ phân giải sắc nét, hoạt động ổn định.', 'hacoled'); ?>
          </p>
        </div>
      </div>

      <!-- LED Classifications (Horizontal 2-Column Grid) -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16 gsap-reveal" data-direction="up" data-delay="0.2">
        <!-- Indoor Class -->
        <div class="rounded-3xl bg-white border border-slate-200/80 shadow-md hover:border-accent-red/25 hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col group">
          <div class="relative aspect-[21/9] md:aspect-[16/7] overflow-hidden bg-slate-100 border-b border-slate-100">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/services-indoor.png'); ?>" 
                 alt="Màn hình LED trong nhà" 
                 class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
            <div class="absolute bottom-5 left-6 right-6">
              <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-accent-red/90 text-[10px] font-bold text-white uppercase tracking-wider">
                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                <?php _e('Indoor Solution', 'hacoled'); ?>
              </span>
            </div>
          </div>
          <div class="p-6 md:p-8 space-y-4 flex-grow flex flex-col justify-between">
            <div class="space-y-2">
              <h3 class="text-base sm:text-lg font-extrabold text-slate-900 flex items-center gap-2">
                <?php _e('Màn hình LED trong nhà', 'hacoled'); ?>
              </h3>
              <p class="text-xs text-slate-500 leading-relaxed font-light">
                <?php _e('Độ sáng vừa phải, tần số quét cao giúp hiển thị hình ảnh cực mịn màng. Được thiết kế tối ưu cho các phòng họp trực tuyến, hội trường cơ quan, showroom giới thiệu sản phẩm và trung tâm tiệc cưới sang trọng.', 'hacoled'); ?>
              </p>
            </div>
            <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
              <span class="text-[10px] font-mono text-slate-400 uppercase tracking-widest"><?php _e('Dòng sản phẩm phổ biến', 'hacoled'); ?></span>
              <span class="text-xs font-bold text-accent-red bg-accent-red/5 px-3 py-1.5 rounded-lg font-mono">
                <?php _e('P1.25 | P1.53 | P1.86 | P2 | P2.5 | P3', 'hacoled'); ?>
              </span>
            </div>
          </div>
        </div>

        <!-- Outdoor Class -->
        <div class="rounded-3xl bg-white border border-slate-200/80 shadow-md hover:border-accent-gold/25 hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col group">
          <div class="relative aspect-[21/9] md:aspect-[16/7] overflow-hidden bg-slate-100 border-b border-slate-100">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/services-outdoor.png'); ?>" 
                 alt="Màn hình LED ngoài trời" 
                 class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
            <div class="absolute bottom-5 left-6 right-6">
              <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-accent-gold/90 text-[10px] font-bold text-primary-dark uppercase tracking-wider">
                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                <?php _e('Outdoor Solution', 'hacoled'); ?>
              </span>
            </div>
          </div>
          <div class="p-6 md:p-8 space-y-4 flex-grow flex flex-col justify-between">
            <div class="space-y-2">
              <h3 class="text-base sm:text-lg font-extrabold text-slate-900 flex items-center gap-2">
                <?php _e('Màn hình LED ngoài trời', 'hacoled'); ?>
              </h3>
              <p class="text-xs text-slate-500 leading-relaxed font-light">
                <?php _e('Độ sáng cực cao (>6000 nits) thách thức ánh nắng mặt trời, tích hợp chuẩn kháng nước bụi IP65/IP66 siêu bền bỉ. Giải pháp lý tưởng cho các biển hiệu quảng cáo tấm lớn mặt tiền, màn hình LED sân khấu ngoài trời.', 'hacoled'); ?>
              </p>
            </div>
            <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
              <span class="text-[10px] font-mono text-slate-400 uppercase tracking-widest"><?php _e('Dòng sản phẩm phổ biến', 'hacoled'); ?></span>
              <span class="text-xs font-bold text-accent-gold bg-accent-gold/5 px-3 py-1.5 rounded-lg font-mono">
                <?php _e('P3 | P4 | P5 | P10', 'hacoled'); ?>
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- Technical Execution & Blueprint (2-Column Grid) -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-stretch">
        <!-- Left: 6-Step Installation Process (span-6) -->
        <div class="lg:col-span-6 space-y-6 gsap-reveal flex flex-col" data-direction="left" data-delay="0.3">
          <div class="p-6 md:p-8 rounded-3xl bg-white border border-slate-200/80 shadow-md flex-grow flex flex-col justify-between">
            <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-widest font-mono mb-6 flex items-center gap-2 border-b border-slate-100 pb-4 shrink-0">
              <i class="ph-bold ph-gear-six text-accent-red text-lg"></i>
              <?php _e('Quy trình thi công 6 bước tiêu chuẩn', 'hacoled'); ?>
            </h3>

            <div class="relative pl-6 border-l-2 border-slate-200 space-y-6 ml-2 flex-grow flex flex-col justify-around">
              
              <!-- Step 1 -->
              <div class="relative">
                <div class="absolute -left-[31px] top-0.5 w-4 h-4 rounded-full bg-white border-4 border-accent-red flex items-center justify-center z-10"></div>
                <div class="space-y-1">
                  <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                    <span class="text-accent-red font-mono font-bold">01.</span>
                    <?php _e('Tiếp nhận yêu cầu', 'hacoled'); ?>
                  </h4>
                  <p class="text-[11px] text-slate-500 font-light">
                    <?php _e('Trao đổi mục đích sử dụng (quảng cáo, họp, sự kiện), kích thước, khoảng cách nhìn để định hình giải pháp.', 'hacoled'); ?>
                  </p>
                </div>
              </div>

              <!-- Step 2 -->
              <div class="relative">
                <div class="absolute -left-[31px] top-0.5 w-4 h-4 rounded-full bg-white border-4 border-accent-red flex items-center justify-center z-10"></div>
                <div class="space-y-1">
                  <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                    <span class="text-accent-red font-mono font-bold">02.</span>
                    <?php _e('Khảo sát & Lên phối cảnh 3D', 'hacoled'); ?>
                  </h4>
                  <p class="text-[11px] text-slate-500 font-light">
                    <?php _e('Khảo sát thực địa, kiểm tra mặt bằng, kết cấu chịu lực, nguồn điện và lên phương án thiết kế bản vẽ kỹ thuật chi tiết.', 'hacoled'); ?>
                  </p>
                </div>
              </div>

              <!-- Step 3 -->
              <div class="relative">
                <div class="absolute -left-[31px] top-0.5 w-4 h-4 rounded-full bg-white border-4 border-accent-red flex items-center justify-center z-10"></div>
                <div class="space-y-1">
                  <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                    <span class="text-accent-red font-mono font-bold">03.</span>
                    <?php _e('Ký kết hợp đồng', 'hacoled'); ?>
                  </h4>
                  <p class="text-[11px] text-slate-500 font-light">
                    <?php _e('Thống nhất chủng loại module, cabinet, bộ xử lý hình ảnh (Processor), tiến độ thi công và các thủ tục pháp lý.', 'hacoled'); ?>
                  </p>
                </div>
              </div>

              <!-- Step 4 -->
              <div class="relative">
                <div class="absolute -left-[31px] top-0.5 w-4 h-4 rounded-full bg-white border-4 border-accent-red flex items-center justify-center z-10"></div>
                <div class="space-y-1">
                  <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                    <span class="text-accent-red font-mono font-bold">04.</span>
                    <?php _e('Thi công lắp đặt & Cấu hình', 'hacoled'); ?>
                  </h4>
                  <p class="text-[11px] text-slate-500 font-light">
                    <?php _e('Hàn khung sắt chịu lực, ráp module/cabinet, kết nối dây nguồn, dây tín hiệu, cấu hình phần mềm điều khiển NovaStar.', 'hacoled'); ?>
                  </p>
                </div>
              </div>

              <!-- Step 5 -->
              <div class="relative">
                <div class="absolute -left-[31px] top-0.5 w-4 h-4 rounded-full bg-white border-4 border-accent-red flex items-center justify-center z-10"></div>
                <div class="space-y-1">
                  <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                    <span class="text-accent-red font-mono font-bold">05.</span>
                    <?php _e('Bàn giao & Hướng dẫn vận hành', 'hacoled'); ?>
                  </h4>
                  <p class="text-[11px] text-slate-500 font-light">
                    <?php _e('Test chạy liên tục 72 giờ, bàn giao công nghệ, hướng dẫn khách hàng kết nối laptop/camera và điều khiển nội dung.', 'hacoled'); ?>
                  </p>
                </div>
              </div>

              <!-- Step 6 -->
              <div class="relative">
                <div class="absolute -left-[31px] top-0.5 w-4 h-4 rounded-full bg-white border-4 border-accent-red flex items-center justify-center z-10"></div>
                <div class="space-y-1">
                  <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                    <span class="text-accent-red font-mono font-bold">06.</span>
                    <?php _e('Bảo trì định kỳ', 'hacoled'); ?>
                  </h4>
                  <p class="text-[11px] text-slate-500 font-light">
                    <?php _e('Thực hiện kiểm tra bảo trì hệ thống LED định kỳ, đảm bảo màn hình luôn hoạt động ở trạng thái tốt nhất.', 'hacoled'); ?>
                  </p>
                </div>
              </div>

            </div>
          </div>
        </div>

        <!-- Right: Process Blueprint image (span-6) -->
        <div class="lg:col-span-6 space-y-6 gsap-reveal flex flex-col" data-direction="right" data-delay="0.3">
          <div class="relative group h-full flex flex-col">
            <div class="absolute -inset-1 bg-gradient-to-r from-accent-red to-accent-gold rounded-3xl blur opacity-15 group-hover:opacity-25 transition-opacity"></div>
            <div class="relative w-full rounded-3xl overflow-hidden border border-slate-200/80 bg-white shadow-md p-6 md:p-8 flex-grow flex flex-col justify-between">
              <div class="space-y-2 mb-6">
                <span class="block text-[9px] font-bold text-slate-400 uppercase tracking-wider font-mono"><?php _e('KỸ THUẬT & KẾT CẤU', 'hacoled'); ?></span>
                <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                  <i class="ph-bold ph-sketch-logo text-accent-gold text-lg"></i>
                  <?php _e('Bản vẽ phối cảnh lắp đặt 3D kỹ thuật', 'hacoled'); ?>
                </h3>
                <p class="text-[10px] text-slate-500 font-light">
                  <?php _e('Mỗi dự án đều được các kỹ sư HacoLED tính toán chi tiết tải trọng kết cấu thép, mặt cắt chịu lực và định hướng đường dây điện, cáp tín hiệu để đảm bảo an toàn tuyệt đối.', 'hacoled'); ?>
                </p>
              </div>
              <div class="w-full flex-grow flex items-center justify-center overflow-hidden rounded-2xl bg-slate-50 border border-slate-100 p-4">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/services-blueprint.png'); ?>" 
                     alt="Bản vẽ kết cấu khung màn hình LED HacoLED" 
                     class="w-full max-h-[440px] object-contain rounded-lg">
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- SECTION 2: HỆ THỐNG ÂM THANH CHUYÊN NGHIỆP ĐI KÈM -->
    <div class="mb-24 border-b border-slate-200 pb-16">
      
      <!-- Section Title -->
      <div class="mb-12 gsap-reveal" data-direction="up" data-delay="0.1">
        <span class="text-xs font-bold text-accent-gold uppercase tracking-widest font-mono block mb-1">SERVICES 02</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-wide uppercase">
          <?php _e('Hệ thống âm thanh chuyên nghiệp đi kèm', 'hacoled'); ?>
        </h2>
        <div class="w-16 h-0.5 bg-accent-gold mt-2"></div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <!-- Left: Illustration of Sound System integration (span-5) -->
        <div class="lg:col-span-5 relative group gsap-reveal" data-direction="right" data-delay="0.2">
          <div class="absolute -inset-1 bg-gradient-to-r from-accent-gold to-yellow-500 rounded-3xl blur opacity-15 group-hover:opacity-30 transition-opacity"></div>
          <div class="relative rounded-2xl overflow-hidden border border-slate-200 bg-slate-100 aspect-[16/10] shadow-lg">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/services-audio.png'); ?>" 
                 alt="Hệ thống âm thanh đi kèm HacoLED" 
                 class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-500">
          </div>
        </div>

        <!-- Right: Audio details and AV setup (span-7) -->
        <div class="lg:col-span-7 space-y-6 gsap-reveal pl-0 lg:pl-6" data-direction="left" data-delay="0.3">
          <p class="text-slate-650 text-sm leading-relaxed font-light">
            <?php _e('Một không gian trình diễn đẳng cấp không thể thiếu sự hòa quyện giữa hình ảnh sống động và âm thanh trung thực. HacoLED tích hợp trọn bộ giải pháp âm thanh chuyên nghiệp từ các thương hiệu lớn toàn cầu, được căn chỉnh thông số kỹ thuật tối ưu hóa theo kết cấu không gian phòng.', 'hacoled'); ?>
          </p>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-slate-200">
            <!-- Audio Equipments -->
            <div class="space-y-4">
              <h4 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                <i class="ph-fill ph-speaker-hifi text-accent-gold text-lg"></i>
                <?php _e('Thiết bị âm thanh cao cấp', 'hacoled'); ?>
              </h4>
              <ul class="space-y-2.5 text-[11px] text-slate-500 font-light">
                <li class="flex items-center gap-2"><i class="ph-bold ph-check text-accent-gold"></i> <?php _e('Loa Line Array công suất lớn cho hội trường', 'hacoled'); ?></li>
                <li class="flex items-center gap-2"><i class="ph-bold ph-check text-accent-gold"></i> <?php _e('Loa treo cột, loa âm trần thẩm mỹ phòng họp', 'hacoled'); ?></li>
                <li class="flex items-center gap-2"><i class="ph-bold ph-check text-accent-gold"></i> <?php _e('Amply, Cục đẩy công suất (Power Amplifier)', 'hacoled'); ?></li>
                <li class="flex items-center gap-2"><i class="ph-bold ph-check text-accent-gold"></i> <?php _e('Bàn Mixer số, bộ xử lý âm thanh vang số chuyên nghiệp', 'hacoled'); ?></li>
              </ul>
            </div>

            <!-- Sound Applications -->
            <div class="space-y-4">
              <h4 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                <i class="ph-fill ph-microphone text-accent-gold text-lg"></i>
                <?php _e('Giải pháp phòng họp & Sự kiện', 'hacoled'); ?>
              </h4>
              <ul class="space-y-2.5 text-[11px] text-slate-500 font-light">
                <li class="flex items-center gap-2"><i class="ph-bold ph-check text-accent-gold"></i> <?php _e('Hệ thống Micro hội thảo đại biểu cổ ngỗng', 'hacoled'); ?></li>
                <li class="flex items-center gap-2"><i class="ph-bold ph-check text-accent-gold"></i> <?php _e('Micro không dây chống hú tốt, bắt giọng ấm', 'hacoled'); ?></li>
                <li class="flex items-center gap-2"><i class="ph-bold ph-check text-accent-gold"></i> <?php _e('Đồng bộ tín hiệu AV (hình ảnh âm thanh) chuẩn 4K', 'hacoled'); ?></li>
                <li class="flex items-center gap-2"><i class="ph-bold ph-check text-accent-gold"></i> <?php _e('Tương thích tốt các thiết bị hội nghị trực tuyến.', 'hacoled'); ?></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- SECTION 3: DỊCH VỤ SỬA CHỮA MÀN HÌNH LED CHUYÊN NGHIỆP -->
    <div class="mb-24 border-b border-slate-200 pb-16">
      
      <!-- Section Title -->
      <div class="mb-12 gsap-reveal" data-direction="up" data-delay="0.1">
        <span class="text-xs font-bold text-green-500 uppercase tracking-widest font-mono block mb-1">SERVICES 03</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-wide uppercase">
          <?php _e('Dịch vụ sửa chữa màn hình LED uy tín #1 Việt Nam', 'hacoled'); ?>
        </h2>
        <div class="w-16 h-0.5 bg-green-500 mt-2"></div>
      </div>

      <!-- Content Split Grid (3 Columns Layout) -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Column 1: Image (span-4) -->
        <div class="lg:col-span-4 relative group gsap-reveal" data-direction="left" data-delay="0.2">
          <div class="absolute -inset-1 bg-gradient-to-r from-green-500 to-emerald-400 rounded-3xl blur opacity-15 group-hover:opacity-35 transition-opacity"></div>
          <div class="relative w-full rounded-2xl overflow-hidden border border-slate-200 bg-slate-100 aspect-[16/10] lg:aspect-[3/4] shadow-lg">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/services-repair.png'); ?>" 
                 alt="Kỹ thuật viên sửa chữa màn hình LED" 
                 class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-500">
          </div>
        </div>

        <!-- Column 2: Common Failures List (span-4) -->
        <div class="lg:col-span-4 space-y-6 gsap-reveal animate-fade-in" data-direction="up" data-delay="0.3">
          <p class="text-slate-600 text-xs leading-relaxed font-light">
            <?php _e('Màn hình LED sau thời gian dài vận hành có thể gặp sự cố ngoài ý muốn. HacoLED cung cấp dịch vụ chẩn đoán lỗi chính xác, thay thế linh kiện chính hãng và sửa chữa cấp tốc.', 'hacoled'); ?>
          </p>

          <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-widest font-mono flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-green-500"></span>
            <?php _e('Các lỗi thường gặp', 'hacoled'); ?>
          </h3>

          <!-- Grid of Warnings -->
          <div class="space-y-3">
            <!-- Fault Item 1 -->
            <div class="p-3.5 rounded-xl bg-orange-500/5 border border-orange-500/10 flex items-start gap-2.5">
              <i class="ph-fill ph-warning-octagon text-orange-500 text-base shrink-0 mt-0.5"></i>
              <div class="space-y-0.5">
                <h4 class="text-xs font-bold text-slate-900"><?php _e('Chết điểm bóng LED', 'hacoled'); ?></h4>
                <p class="text-[9px] text-slate-500 leading-normal"><?php _e('Xuất hiện chấm đỏ, xanh lá, xanh dương chết sáng hoặc tắt lịm trên module.', 'hacoled'); ?></p>
              </div>
            </div>
            <!-- Fault Item 2 -->
            <div class="p-3.5 rounded-xl bg-orange-500/5 border border-orange-500/10 flex items-start gap-2.5">
              <i class="ph-fill ph-warning-octagon text-orange-500 text-base shrink-0 mt-0.5"></i>
              <div class="space-y-0.5">
                <h4 class="text-xs font-bold text-slate-900"><?php _e('Chết mảng / sọc màn hình', 'hacoled'); ?></h4>
                <p class="text-[9px] text-slate-500 leading-normal"><?php _e('Chết nguyên cả hàng dọc/ngang hoặc một vùng màn hình bị đen hoàn toàn.', 'hacoled'); ?></p>
              </div>
            </div>
            <!-- Fault Item 3 -->
            <div class="p-3.5 rounded-xl bg-orange-500/5 border border-orange-500/10 flex items-start gap-2.5">
              <i class="ph-fill ph-warning-octagon text-orange-500 text-base shrink-0 mt-0.5"></i>
              <div class="space-y-0.5">
                <h4 class="text-xs font-bold text-slate-900"><?php _e('Lỗi nguồn / Hỏng IC', 'hacoled'); ?></h4>
                <p class="text-[9px] text-slate-500 leading-normal"><?php _e('Chập nguồn tổ ong cấp điện, màn hình không lên, hỏng card nhận hoặc IC điều khiển.', 'hacoled'); ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Column 3: 4-Step Repair Process (span-4) -->
        <div class="lg:col-span-4 space-y-6 gsap-reveal" data-direction="right" data-delay="0.3">
          <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-md">
            <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-widest font-mono mb-4 flex items-center gap-2">
              <i class="ph-fill ph-wrench text-green-500 text-lg"></i>
              <?php _e('Quy trình xử lý sự cố cấp tốc', 'hacoled'); ?>
            </h3>

            <!-- 4-step Timeline -->
            <div class="space-y-4 relative pl-4 border-l-2 border-green-500/20 ml-2">
              <!-- Step 1 -->
              <div class="relative">
                <div class="absolute -left-[23px] top-1 w-2.5 h-2.5 rounded-full bg-white border-4 border-green-500 z-10"></div>
                <h4 class="text-[11px] font-bold text-slate-900 uppercase"><?php _e('1. Tiếp nhận thông tin', 'hacoled'); ?></h4>
                <p class="text-[9px] text-slate-500 leading-relaxed font-light"><?php _e('Nhận phản hồi tình trạng lỗi màn hình LED qua hotline và xếp lịch kiểm tra nhanh.', 'hacoled'); ?></p>
              </div>
              <!-- Step 2 -->
              <div class="relative">
                <div class="absolute -left-[23px] top-1 w-2.5 h-2.5 rounded-full bg-white border-4 border-green-500 z-10"></div>
                <h4 class="text-[11px] font-bold text-slate-900 uppercase"><?php _e('2. Chẩn đoán nguyên nhân', 'hacoled'); ?></h4>
                <p class="text-[9px] text-slate-500 leading-relaxed font-light"><?php _e('Đo đạc, kiểm tra card phát/nhận, nguồn điện và IC để định vị linh kiện lỗi.', 'hacoled'); ?></p>
              </div>
              <!-- Step 3 -->
              <div class="relative">
                <div class="absolute -left-[23px] top-1 w-2.5 h-2.5 rounded-full bg-white border-4 border-green-500 z-10"></div>
                <h4 class="text-[11px] font-bold text-slate-900 uppercase"><?php _e('3. Báo giá & Linh kiện', 'hacoled'); ?></h4>
                <p class="text-[9px] text-slate-500 leading-relaxed font-light"><?php _e('Gửi phương án khắc phục chi tiết kèm báo giá linh kiện thay thế chính hãng.', 'hacoled'); ?></p>
              </div>
              <!-- Step 4 -->
              <div class="relative">
                <div class="absolute -left-[23px] top-1 w-2.5 h-2.5 rounded-full bg-white border-4 border-green-500 z-10"></div>
                <h4 class="text-[11px] font-bold text-slate-900 uppercase"><?php _e('4. Sửa chữa & Bàn giao', 'hacoled'); ?></h4>
                <p class="text-[9px] text-slate-500 leading-relaxed font-light"><?php _e('Tiến hành sửa chữa, hàn chân chip bóng LED hoặc thay thế linh kiện, chạy thử 24 giờ trước khi bàn giao hoàn tất.', 'hacoled'); ?></p>
              </div>
            </div>

            <!-- Fast Commitment Notice -->
            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-2">
              <div class="w-6 h-6 rounded-md bg-green-500/10 flex items-center justify-center text-green-500 shrink-0">
                <i class="ph-bold ph-shield-check text-base"></i>
              </div>
              <p class="text-[9px] text-slate-650 leading-relaxed font-light">
                <strong><?php _e('Cam kết 48 giờ:', 'hacoled'); ?></strong> <?php _e('Mọi sự cố thông thường được khắc phục triệt để không quá 48 giờ, bảo hành vàng sau sửa chữa.', 'hacoled'); ?>
              </p>
            </div>

          </div>
        </div>

      </div>
    </div>

    <!-- SECTION 4: INTERACTIVE FAQs ACCORDION (AlpineJS) -->
    <div class="mb-24" x-data="{ activeFaq: null }">
      
      <!-- Title Block -->
      <div class="text-center max-w-xl mx-auto mb-16 gsap-reveal" data-direction="up" data-delay="0.1">
        <span class="block text-[10px] font-bold text-accent-red uppercase tracking-widest font-mono mb-1"><?php _e('GIẢI ĐÁP THẮC MẮC', 'hacoled'); ?></span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 uppercase tracking-wide relative inline-block">
          <?php _e('Câu hỏi thường gặp', 'hacoled'); ?>
          <div class="absolute left-1/2 -translate-x-1/2 -bottom-2 w-2/3 h-0.5 bg-gradient-to-r from-accent-red to-accent-gold"></div>
        </h2>
      </div>

      <!-- FAQ Accordion List -->
      <div class="max-w-4xl mx-auto space-y-4 gsap-reveal" data-direction="up" data-delay="0.2">
        
        <!-- FAQ 1 -->
        <div class="border border-slate-200/80 rounded-2xl bg-white shadow-sm overflow-hidden">
          <button @click="activeFaq === 1 ? activeFaq = null : activeFaq = 1" 
                  class="w-full text-left px-6 py-5 flex justify-between items-center hover:bg-slate-50 transition-colors">
            <span class="text-xs sm:text-sm font-bold text-slate-900"><?php _e('Màn hình LED có tuổi thọ bao lâu và cần lưu ý gì?', 'hacoled'); ?></span>
            <i class="ph-bold text-slate-500 transition-transform duration-300" :class="activeFaq === 1 ? 'ph-minus rotate-180' : 'ph-plus'"></i>
          </button>
          <div x-show="activeFaq === 1" x-collapse x-cloak class="px-6 pb-5 border-t border-slate-100/50 pt-4 text-xs text-slate-500 leading-relaxed font-light space-y-2">
            <p>
              <?php _e('Tuổi thọ trung bình của bóng LED chính hãng HacoLED cung cấp lên đến 100.000 giờ sử dụng liên tục (tương đương 10 - 12 năm vận hành trong điều kiện chuẩn).', 'hacoled'); ?>
            </p>
            <p>
              <?php _e('Để kéo dài tuổi thọ màn hình, khách hàng nên: Vận hành màn hình ở độ sáng hợp lý (khoảng 70-80%), tránh bật tắt đột ngột, lau chùi bề mặt tấm module bằng cọ khô mềm, và tiến hành kiểm tra bảo trì định kỳ các đầu cáp tín hiệu.', 'hacoled'); ?>
            </p>
          </div>
        </div>

        <!-- FAQ 2 -->
        <div class="border border-slate-200/80 rounded-2xl bg-white shadow-sm overflow-hidden">
          <button @click="activeFaq === 2 ? activeFaq = null : activeFaq = 2" 
                  class="w-full text-left px-6 py-5 flex justify-between items-center hover:bg-slate-50 transition-colors">
            <span class="text-xs sm:text-sm font-bold text-slate-900"><?php _e('HacoLED có hỗ trợ khảo sát mặt bằng và vẽ thiết kế trước không?', 'hacoled'); ?></span>
            <i class="ph-bold text-slate-500 transition-transform duration-300" :class="activeFaq === 2 ? 'ph-minus rotate-180' : 'ph-plus'"></i>
          </button>
          <div x-show="activeFaq === 2" x-collapse x-cloak class="px-6 pb-5 border-t border-slate-100/50 pt-4 text-xs text-slate-500 leading-relaxed font-light">
            <?php _e('Có. HacoLED hỗ trợ khảo sát thực tế mặt bằng lắp đặt tận nơi, kiểm tra kết cấu chịu lực, nguồn cấp điện và lên phối cảnh bản vẽ 2D/3D chi tiết gửi khách hàng hoàn toàn miễn phí trước khi tiến hành ký kết hợp đồng.', 'hacoled'); ?>
          </div>
        </div>

        <!-- FAQ 3 -->
        <div class="border border-slate-200/80 rounded-2xl bg-white shadow-sm overflow-hidden">
          <button @click="activeFaq === 3 ? activeFaq = null : activeFaq = 3" 
                  class="w-full text-left px-6 py-5 flex justify-between items-center hover:bg-slate-50 transition-colors">
            <span class="text-xs sm:text-sm font-bold text-slate-900"><?php _e('Hệ thống âm thanh đi kèm được tích hợp như thế nào?', 'hacoled'); ?></span>
            <i class="ph-bold text-slate-500 transition-transform duration-300" :class="activeFaq === 3 ? 'ph-minus rotate-180' : 'ph-plus'"></i>
          </button>
          <div x-show="activeFaq === 3" x-collapse x-cloak class="px-6 pb-5 border-t border-slate-100/50 pt-4 text-xs text-slate-500 leading-relaxed font-light">
            <?php _e('Chúng tôi đồng bộ hóa giải pháp hiển thị và âm thanh thông qua bộ xử lý trung tâm đa kênh. Tùy thuộc vào ứng dụng (phòng họp trực tuyến hay hội trường lớn), HacoLED sẽ bố trí loa cột âm trần thẩm mỹ cao hoặc loa Line Array treo hai bên màn hình LED để âm thanh khuếch tán đều, triệt tiêu tiếng vang hú khó chịu.', 'hacoled'); ?>
          </div>
        </div>

        <!-- FAQ 4 -->
        <div class="border border-slate-200/80 rounded-2xl bg-white shadow-sm overflow-hidden">
          <button @click="activeFaq === 4 ? activeFaq = null : activeFaq = 4" 
                  class="w-full text-left px-6 py-5 flex justify-between items-center hover:bg-slate-50 transition-colors">
            <span class="text-xs sm:text-sm font-bold text-slate-900"><?php _e('Chi phí sửa chữa màn hình LED được tính như thế nào và mất bao lâu?', 'hacoled'); ?></span>
            <i class="ph-bold text-slate-500 transition-transform duration-300" :class="activeFaq === 4 ? 'ph-minus rotate-180' : 'ph-plus'"></i>
          </button>
          <div x-show="activeFaq === 4" x-collapse x-cloak class="px-6 pb-5 border-t border-slate-100/50 pt-4 text-xs text-slate-500 leading-relaxed font-light">
            <?php _e('Mức giá sửa chữa phụ thuộc vào nguyên nhân lỗi (chết bóng LED, hỏng nguồn, hỏng IC điều khiển hay card nhận) và số lượng linh kiện cần thay thế. HacoLED cam kết chẩn đoán đúng bệnh, báo giá minh bạch. Thời gian sửa chữa thông thường được cam kết hoàn thành không quá 48 giờ sau khi tiếp nhận để hạn chế tối đa gián đoạn công việc của khách hàng.', 'hacoled'); ?>
          </div>
        </div>

      </div>
    </div>

    <!-- SECTION 5: CALL TO ACTION (CTA) -->
    <div class="gsap-reveal" data-direction="up" data-delay="0.2">
      <div class="relative rounded-3xl overflow-hidden bg-[#4A0505] border border-white/10 p-8 sm:p-12 text-center max-w-4xl mx-auto shadow-2xl">
        <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
        <div class="relative z-10 space-y-6">
          <span class="text-xs font-bold text-accent-gold uppercase tracking-widest font-mono"><?php _e('LIÊN HỆ KHẢO SÁT & BÁO GIÁ', 'hacoled'); ?></span>
          <h3 class="text-2xl sm:text-3xl font-extrabold text-white leading-tight uppercase">
            <?php _e('Bạn đang cần lắp đặt hoặc sửa chữa màn hình LED?', 'hacoled'); ?>
          </h3>
          <p class="text-slate-300 text-xs max-w-xl mx-auto leading-relaxed font-light">
            <?php _e('Đội ngũ chuyên gia HacoLED luôn sẵn sàng hỗ trợ khảo sát mặt bằng thực địa tận nơi và lên bản vẽ thiết kế kỹ thuật hoàn toàn miễn phí. Cam kết cung cấp giải pháp trọn gói chất lượng cao nhất.', 'hacoled'); ?>
          </p>
          <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
            <a href="<?php echo esc_url(home_url('/lien-he/')); ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gradient-to-r from-accent-gold to-yellow-500 hover:from-yellow-500 hover:to-accent-gold text-primary-dark font-extrabold text-xs uppercase px-8 py-4 rounded-full tracking-wider shadow-lg transition-all duration-300">
              <?php _e('Yêu cầu báo giá', 'hacoled'); ?>
              <i class="ph-bold ph-arrow-right text-[11px]"></i>
            </a>
            <a href="tel:0342324488" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 border border-white/30 hover:border-white/60 text-white font-bold text-xs uppercase px-8 py-4 rounded-full tracking-wider transition-all duration-300">
              <i class="ph-fill ph-phone-call text-[13px]"></i>
              <span>Hotline: 034.232.4488</span>
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>

<?php
$this->renderFooter($footer_type ?? 'default');
?>
