<?php
/**
 * About Page View Template
 *
 * @var array  $page
 * @var array  $values
 * @var string $header_type
 * @var string $footer_type
 */

$this->renderHeader($header_type ?? 'default');
?>

<!-- Premium About Page Wrapper (Light Theme with Brand Accents) -->
<main class="relative bg-[#FAFAFA] pt-28 md:pt-48 pb-24 overflow-hidden min-h-[80vh]">
  
  <!-- Glowing Background Orbs -->
  <div class="glow-gold -top-20 -right-20 opacity-10"></div>
  <div class="glow-red bottom-10 left-10 opacity-5"></div>

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

    <!-- SECTION 1: LỜI MỞ ĐẦU -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-20 border-b border-slate-200 pb-16">
      
      <!-- Left side: Narrative Text (span-7) -->
      <div class="lg:col-span-7 space-y-6 gsap-reveal" data-direction="up" data-delay="0.2">
        <div class="w-12 h-1 bg-gradient-to-r from-accent-red to-accent-gold rounded-full"></div>
        <span class="block text-[11px] font-bold text-accent-red uppercase tracking-widest font-mono"><?php _e('CÔNG TY CỔ PHẦN CÔNG NGHỆ HACO VIỆT NAM', 'hacoled'); ?></span>
        <h1 class="text-3xl sm:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
          <?php _e('LỜI MỞ ĐẦU', 'hacoled'); ?>
        </h1>
        <div class="text-slate-600 text-sm leading-relaxed space-y-4 font-light">
          <p>
            <?php _e('Năm 2019, HacoLED bắt đầu hành trình từ một văn phòng nhỏ tại Hà Nội, chỉ với chưa đầy 10 nhân viên. Bằng sự nỗ lực không ngừng và khát vọng mang đến giá trị tốt nhất cho khách hàng, chúng tôi đã nhanh chóng mở rộng mạng lưới hoạt động. Hiện nay, HacoLED đã có chi nhánh tại cả miền Nam và miền Trung, đánh dấu bước phát triển vượt bậc và nâng cao khả năng phục vụ khách hàng trên toàn lãnh thổ Việt Nam cũng như trong khu vực Đông Nam Á.', 'hacoled'); ?>
          </p>
          <p>
            <?php _e('Ngay từ những ngày đầu thành lập, HacoLED đã kiên định xây dựng thương hiệu dựa trên uy tín và sự đóng góp tích cực vào sự phát triển của các doanh nghiệp đối tác. Chúng tôi đặt mục tiêu trở thành công ty hàng đầu Việt Nam trong lĩnh vực màn hình LED, lấy lợi ích khách hàng làm trọng tâm và cam kết chất lượng sản phẩm cùng dịch vụ vượt trội.', 'hacoled'); ?>
          </p>
        </div>
      </div>

      <!-- Right side: Installation Image (span-5) -->
      <div class="lg:col-span-5 relative group gsap-reveal" data-direction="right" data-delay="0.3">
        <div class="absolute -inset-1 bg-gradient-to-r from-accent-red to-accent-gold rounded-3xl blur opacity-20 group-hover:opacity-35 transition-opacity"></div>
        <div class="relative w-full rounded-2xl overflow-hidden border border-slate-200 bg-slate-100 aspect-[4/3] sm:aspect-[16/10] shadow-lg">
          <img src="https://hacoled.com/wp-content/uploads/2025/04/man-hinh-led-san-khauhacoled-1-2.jpg" 
               alt="Công trình màn hình LED HacoLED" 
               class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-500"
               fetchpriority="high"
               decoding="async"
               width="800"
               height="500">
        </div>
      </div>

    </div>

    <!-- SECTION 2: NHỮNG CON SỐ ẤN TƯỢNG -->
    <div class="mb-20 border-b border-slate-200 pb-16">
      
      <!-- Title Block -->
      <div class="text-center max-w-3xl mx-auto mb-12 gsap-reveal" data-direction="up" data-delay="0.1">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-wide uppercase relative inline-block">
          <?php _e('NHỮNG CON SỐ ẤN TƯỢNG', 'hacoled'); ?>
          <div class="absolute left-1/2 -translate-x-1/2 -bottom-2 w-2/3 h-0.5 bg-gradient-to-r from-accent-red to-accent-gold"></div>
        </h2>
        <p class="text-slate-600 text-sm mt-4 font-light">
          <?php _e('HacoLED tự hào đồng hành cùng hơn 800 Doanh Nghiệp Việt Nam trong việc cung cấp, lắp đặt màn hình LED.', 'hacoled'); ?>
        </p>
      </div>

      <!-- Stats 4 Columns Grid -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-10 text-center">
        <!-- Stat 1 -->
        <div class="p-6 rounded-2xl glass-card border border-slate-200/80 transition-all duration-300 gsap-reveal" data-direction="up" data-delay="0.2">
          <div class="text-3xl sm:text-5xl font-black text-accent-red mb-2 font-mono tracking-tight">1,000+</div>
          <div class="text-xs sm:text-sm text-slate-700 font-bold tracking-wide uppercase"><?php _e('Dự án triển khai', 'hacoled'); ?></div>
        </div>
        <!-- Stat 2 -->
        <div class="p-6 rounded-2xl glass-card border border-slate-200/80 transition-all duration-300 gsap-reveal" data-direction="up" data-delay="0.3">
          <div class="text-3xl sm:text-5xl font-black text-accent-red mb-2 font-mono tracking-tight">800+</div>
          <div class="text-xs sm:text-sm text-slate-700 font-bold tracking-wide uppercase"><?php _e('Khách hàng', 'hacoled'); ?></div>
        </div>
        <!-- Stat 3 -->
        <div class="p-6 rounded-2xl glass-card border border-slate-200/80 transition-all duration-300 gsap-reveal" data-direction="up" data-delay="0.4">
          <div class="text-3xl sm:text-5xl font-black text-accent-red mb-2 font-mono tracking-tight">3+</div>
          <div class="text-xs sm:text-sm text-slate-700 font-bold tracking-wide uppercase"><?php _e('Chi nhánh', 'hacoled'); ?></div>
        </div>
        <!-- Stat 4 -->
        <div class="p-6 rounded-2xl glass-card border border-slate-200/80 transition-all duration-300 gsap-reveal" data-direction="up" data-delay="0.5">
          <div class="text-3xl sm:text-5xl font-black text-accent-red mb-2 font-mono tracking-tight">100+</div>
          <div class="text-xs sm:text-sm text-slate-700 font-bold tracking-wide uppercase"><?php _e('Đối tác tiêu biểu', 'hacoled'); ?></div>
        </div>
      </div>

      <!-- Partner Logos Box (Premium clean design shape) -->
      <div class="gsap-reveal" data-direction="up" data-delay="0.3">
        <div class="p-8 sm:p-12 rounded-3xl glass-card border border-slate-200/80 bg-white/80 shadow-lg relative overflow-hidden">
          <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
          <div class="relative z-10 flex flex-wrap items-center justify-around gap-8 md:gap-12">
            <!-- Vingroup -->
            <div class="h-10 w-32 flex items-center justify-center filter grayscale opacity-75 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/vingroup-logo.svg" alt="Vingroup" class="max-h-full max-w-full object-contain">
            </div>
            <!-- Viettel -->
            <div class="h-10 w-28 flex items-center justify-center filter grayscale opacity-75 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/viettel-logo.svg" alt="Viettel" class="max-h-full max-w-full object-contain">
            </div>
            <!-- Masterise -->
            <div class="h-10 w-32 flex items-center justify-center filter grayscale opacity-75 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
              <span class="font-serif font-extrabold tracking-widest text-[#B5945B] text-[13px]">MASTERISE</span>
            </div>
            <!-- Vietinbank -->
            <div class="h-10 w-32 flex items-center justify-center filter grayscale opacity-75 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/vietinbank-logo.png" alt="VietinBank" class="max-h-full max-w-full object-contain">
            </div>
            <!-- BRG Group -->
            <div class="h-10 w-28 flex items-center justify-center filter grayscale opacity-75 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
              <span class="font-serif font-black tracking-wider text-[#002855] text-[15px]">BRG <span class="text-[#D4AF37]">GROUP</span></span>
            </div>
            <!-- FPT -->
            <div class="h-10 w-20 flex items-center justify-center filter grayscale opacity-75 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/fpt-logo.svg" alt="FPT" class="max-h-full max-w-full object-contain">
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- SECTION 3: SỬ MỆNH CỦA HACOLED -->
    <div class="mb-20 border-b border-slate-200 pb-16">
      
      <!-- Title Block -->
      <div class="text-center max-w-3xl mx-auto mb-12 gsap-reveal" data-direction="up" data-delay="0.1">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-wide uppercase relative inline-block">
          <?php _e('SỬ MỆNH CỦA HACOLED', 'hacoled'); ?>
          <div class="absolute left-1/2 -translate-x-1/2 -bottom-2 w-2/3 h-0.5 bg-gradient-to-r from-accent-red to-accent-gold"></div>
        </h2>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <!-- Left: Text column (span-7) -->
        <div class="lg:col-span-7 space-y-8 gsap-reveal" data-direction="left" data-delay="0.2">
          
          <!-- Sứ mệnh với Khách hàng -->
          <div class="space-y-3">
            <h3 class="text-lg font-bold text-accent-red uppercase tracking-wide flex items-center gap-2">
              <span class="w-1.5 h-6 bg-accent-red rounded-full"></span>
              <?php _e('Sứ mệnh với Khách hàng', 'hacoled'); ?>
            </h3>
            <p class="text-slate-650 text-sm leading-relaxed font-light pl-3.5">
              <?php _e('HacoLED mang đến cho khách hàng giải pháp màn hình LED phù hợp nhất, đảm bảo mọi quy trình và tiêu chuẩn được thực hiện theo đúng hợp đồng, đem đến sự hài lòng và tin tưởng cho khách hàng.', 'hacoled'); ?>
            </p>
          </div>

          <!-- Sứ mệnh với Nhân viên -->
          <div class="space-y-3">
            <h3 class="text-lg font-bold text-accent-red uppercase tracking-wide flex items-center gap-2">
              <span class="w-1.5 h-6 bg-accent-red rounded-full"></span>
              <?php _e('Sứ mệnh với Nhân viên', 'hacoled'); ?>
            </h3>
            <p class="text-slate-650 text-sm leading-relaxed font-light pl-3.5">
              <?php _e('Mục tiêu của HacoLED là mang lại sự tử tế và sung túc, đồng thời tạo ra môi trường giúp các thành viên cùng nhau phát triển sự nghiệp để mang lại cuộc sống tốt đẹp hơn cho bản thân, gia đình & xã hội.', 'hacoled'); ?>
            </p>
          </div>

        </div>

        <!-- Right: Modern SVG Target/Success Illustration (span-5) -->
        <div class="lg:col-span-5 flex justify-center gsap-reveal" data-direction="right" data-delay="0.3">
          <div class="w-72 h-72 sm:w-80 sm:h-80 relative flex items-center justify-center">
            <!-- Modern Target and Goal Vector Graphic -->
            <svg class="w-full h-full" viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
              <defs>
                <linearGradient id="svgGlow" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" stop-color="#ef4444" stop-opacity="0.3"/>
                  <stop offset="100%" stop-color="#fbbf24" stop-opacity="0.3"/>
                </linearGradient>
                <linearGradient id="svgGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" stop-color="#ef4444"/>
                  <stop offset="100%" stop-color="#fbbf24"/>
                </linearGradient>
              </defs>
              <!-- Outer glowing circles -->
              <circle cx="200" cy="200" r="160" stroke="url(#svgGlow)" stroke-width="2" stroke-dasharray="8 8"/>
              <circle cx="200" cy="200" r="120" stroke="url(#svgGlow)" stroke-width="1.5"/>
              
              <!-- Simulated Gears (background) -->
              <circle cx="120" cy="140" r="30" stroke="#cbd5e1" stroke-width="2" stroke-dasharray="5 3"/>
              <circle cx="120" cy="140" r="15" stroke="#cbd5e1" stroke-width="1.5"/>
              
              <!-- Red bullseye target circular rings -->
              <circle cx="280" cy="160" r="60" stroke="#ef4444" stroke-width="3" opacity="0.3"/>
              <circle cx="280" cy="160" r="40" stroke="#ef4444" stroke-width="3" opacity="0.6"/>
              <circle cx="280" cy="160" r="20" fill="url(#svgGrad)"/>
              
              <!-- Success Arrow -->
              <path d="M100 300 L270 170" stroke="#475569" stroke-width="4" stroke-linecap="round"/>
              <path d="M260 162 L280 160 L278 180" fill="#475569"/>
              
              <!-- Trophy Icon overlaying -->
              <path d="M185 240 L215 240 L210 270 L190 270 Z" fill="#fbbf24"/>
              <path d="M175 190 L225 190 L215 240 L185 240 Z" fill="#fbbf24"/>
              <path d="M185 270 L215 270 L215 280 L185 280 Z" fill="#e2e8f0"/>
              <!-- Handles -->
              <path d="M175 200 C165 200 165 220 178 225" stroke="#fbbf24" stroke-width="3" fill="none"/>
              <path d="M225 200 C235 200 235 220 222 225" stroke="#fbbf24" stroke-width="3" fill="none"/>
              
              <!-- Upward growth arrow line -->
              <path d="M60 350 C 130 330, 200 280, 320 220" stroke="url(#svgGrad)" stroke-width="5" stroke-linecap="round" fill="none"/>
              <path d="M310 215 L325 218 L318 230" fill="#ef4444"/>
            </svg>
          </div>
        </div>
      </div>

    </div>

    <!-- SECTION 4: DẤU ẤN 6 NĂM PHÁT TRIỂN -->
    <div class="mb-20 border-b border-slate-200 pb-16">
      
      <!-- Title Block -->
      <div class="text-center max-w-xl mx-auto mb-16 gsap-reveal" data-direction="up" data-delay="0.1">
        <span class="block text-[10px] font-bold text-accent-red uppercase tracking-widest font-mono mb-1"><?php _e('HÀNH TRÌNH PHÁT TRIỂN', 'hacoled'); ?></span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-wide uppercase relative inline-block">
          <?php _e('DẤU ẤN 6 NĂM PHÁT TRIỂN', 'hacoled'); ?>
          <div class="absolute left-1/2 -translate-x-1/2 -bottom-2 w-2/3 h-0.5 bg-gradient-to-r from-accent-red to-accent-gold"></div>
        </h2>
      </div>

      <!-- Vertical Timeline Component -->
      <div class="relative max-w-4xl mx-auto">
        <!-- Vertical Center Line -->
        <div class="absolute left-4 md:left-1/2 top-0 bottom-0 w-0.5 bg-gradient-to-b from-accent-red via-accent-gold to-green-500 transform md:-translate-x-1/2"></div>

        <!-- Milestone 1: 2019 -->
        <div class="relative flex flex-col md:flex-row items-stretch mb-12 gsap-reveal" data-direction="up" data-delay="0.2">
          <div class="flex items-center md:w-1/2 justify-start md:justify-end md:pr-12 pl-12 md:pl-0">
            <div class="p-6 rounded-2xl glass-card border border-slate-200/60 hover:border-accent-red/30 transition-all w-full md:max-w-md bg-white/70">
              <span class="inline-block text-xs font-bold text-accent-red uppercase tracking-wider mb-1">Năm 2019</span>
              <h4 class="text-base font-bold text-slate-900 mb-2"><?php _e('Khởi đầu khát vọng', 'hacoled'); ?></h4>
              <p class="text-xs text-slate-500 leading-relaxed font-light">
                <?php _e('Quá trình xây dựng đội ngũ thời ban đầu chỉ với 4 nhân sự, từ một nhóm kỹ sư đam mê LED tập trung nghiên cứu và xây dựng sản phẩm màn hình LED.', 'hacoled'); ?>
              </p>
            </div>
          </div>
          <!-- Node point -->
          <div class="absolute left-4 md:left-1/2 w-6 h-6 rounded-full bg-white border-4 border-accent-red transform -translate-x-1/2 flex items-center justify-center z-10 top-6"></div>
          <div class="hidden md:block w-1/2"></div>
        </div>

        <!-- Milestone 2: 2021 -->
        <div class="relative flex flex-col md:flex-row items-stretch mb-12 gsap-reveal" data-direction="up" data-delay="0.3">
          <div class="hidden md:block w-1/2"></div>
          <!-- Node point -->
          <div class="absolute left-4 md:left-1/2 w-6 h-6 rounded-full bg-white border-4 border-accent-gold transform -translate-x-1/2 flex items-center justify-center z-10 top-6"></div>
          <div class="flex items-center md:w-1/2 justify-start md:pl-12 pl-12">
            <div class="p-6 rounded-2xl glass-card border border-slate-200/60 hover:border-accent-gold/30 transition-all w-full md:max-w-md bg-white/70">
              <span class="inline-block text-xs font-bold text-accent-gold uppercase tracking-wider mb-1">Năm 2021</span>
              <h4 class="text-base font-bold text-slate-900 mb-2"><?php _e('Bản lĩnh vươn tầm', 'hacoled'); ?></h4>
              <p class="text-xs text-slate-500 leading-relaxed font-light">
                <?php _e('Vươn mình phát triển, tập trung triển khai các dự án màn hình LED, màn hình ghép với các đối tác là Tập đoàn và Doanh nghiệp tư nhân một cách bài bản và chuyên nghiệp.', 'hacoled'); ?>
              </p>
            </div>
          </div>
        </div>

        <!-- Milestone 3: 2025 -->
        <div class="relative flex flex-col md:flex-row items-stretch gsap-reveal" data-direction="up" data-delay="0.4">
          <div class="flex items-center md:w-1/2 justify-start md:justify-end md:pr-12 pl-12 md:pl-0">
            <div class="p-6 rounded-2xl glass-card border border-slate-200/60 hover:border-green-500/30 transition-all w-full md:max-w-md bg-white/70">
              <span class="inline-block text-xs font-bold text-green-500 uppercase tracking-wider mb-1">Năm 2025 - Hiện tại</span>
              <h4 class="text-base font-bold text-slate-900 mb-2"><?php _e('Hệ sinh thái AV Pro toàn diện', 'hacoled'); ?></h4>
              <p class="text-xs text-slate-500 leading-relaxed font-light">
                <?php _e('Mở rộng thị trường, cung cấp thêm giải pháp tổng thể cho phòng họp, hội trường. Mang đến cho khách hàng giải pháp trọn gói bao gồm: Hiển thị, âm thanh, ánh sáng.', 'hacoled'); ?>
              </p>
            </div>
          </div>
          <!-- Node point -->
          <div class="absolute left-4 md:left-1/2 w-6 h-6 rounded-full bg-white border-4 border-green-500 transform -translate-x-1/2 flex items-center justify-center z-10 top-6"></div>
          <div class="hidden md:block w-1/2"></div>
        </div>
      </div>
    </div>

    <!-- SECTION 5: GIẢI PHÁP LẤP ĐẶT TIÊU BIỂU (Tách biệt thành từng Section chi tiết, xen kẽ) -->
    <div class="mb-20 border-b border-slate-200 pb-16">
      
      <!-- Title Block -->
      <div class="text-center max-w-3xl mx-auto mb-16 gsap-reveal" data-direction="up" data-delay="0.1">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-wide uppercase relative inline-block">
          <?php _e('GIẢI PHÁP LẮP ĐẶT TIÊU BIỂU', 'hacoled'); ?>
          <div class="absolute left-1/2 -translate-x-1/2 -bottom-2 w-2/3 h-0.5 bg-gradient-to-r from-accent-red to-accent-gold"></div>
        </h2>
        <p class="text-slate-600 text-sm mt-4 font-light">
          <?php _e('HacoLED cung cấp các giải pháp hiển thị kỹ thuật số đỉnh cao cho từng phân khúc chuyên biệt.', 'hacoled'); ?>
        </p>
      </div>

      <!-- Detail Alternating Sections -->
      <div class="space-y-24">
        
        <!-- Segment 1: Trong nhà (Image Left, Text Right) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
          <div class="lg:col-span-5 relative group gsap-reveal" data-direction="right" data-delay="0.2">
            <div class="absolute -inset-1 bg-gradient-to-r from-accent-red to-accent-gold rounded-2xl blur opacity-15 group-hover:opacity-30 transition-opacity"></div>
            <div class="relative rounded-xl overflow-hidden border border-slate-200 bg-slate-100 aspect-[16/10] shadow-md">
              <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&auto=format&fit=crop&q=80" alt="Màn hình LED lắp trong nhà" class="w-full h-full object-cover">
            </div>
          </div>
          <div class="lg:col-span-7 space-y-4 gsap-reveal pl-0 lg:pl-6" data-direction="left" data-delay="0.3">
            <span class="text-xs font-bold text-accent-red uppercase tracking-wider font-mono">01. INDOOR DISPLAY</span>
            <h3 class="text-2xl font-extrabold text-slate-900"><?php _e('Màn hình LED lắp trong nhà', 'hacoled'); ?></h3>
            <p class="text-slate-600 text-sm leading-relaxed font-light">
              <?php _e('Giải pháp màn hình LED trong nhà của HacoLED mang lại khả năng hiển thị đỉnh cao với độ sáng cao, tần số quét cực lớn (đến 3840Hz) giúp chống nhấp nháy khi ghi hình. Module LED siêu nhẹ và mỏng cho phép lắp đặt gọn gàng, tiết kiệm không gian sảnh, hội trường hay showroom lớn. Màn hình hoạt động không tiếng ồn, tiết kiệm năng lượng và thân thiện với môi trường, đáp ứng các tiêu chuẩn khắt khe về thẩm mỹ của thiết kế kiến trúc nội thất hiện đại.', 'hacoled'); ?>
            </p>
            <div class="pt-2">
              <a href="https://hacoled.com/man-hinh-led-trong-nha/" class="inline-flex items-center justify-center gap-1.5 px-6 py-2.5 rounded-full bg-accent-red hover:bg-accent-rose text-white text-xs font-bold uppercase tracking-wider transition-all duration-300 shadow-md">
                <?php _e('Xem nhiều hơn', 'hacoled'); ?> <i class="ph-bold ph-caret-double-right"></i>
              </a>
            </div>
          </div>
        </div>

        <!-- Segment 2: Ngoài trời (Text Left, Image Right) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
          <div class="lg:col-span-7 space-y-4 gsap-reveal pr-0 lg:pr-6 order-2 lg:order-1" data-direction="right" data-delay="0.3">
            <span class="text-xs font-bold text-accent-red uppercase tracking-wider font-mono">02. OUTDOOR DISPLAY</span>
            <h3 class="text-2xl font-extrabold text-slate-900"><?php _e('Màn hình LED lắp ngoài trời', 'hacoled'); ?></h3>
            <p class="text-slate-600 text-sm leading-relaxed font-light">
              <?php _e('Hệ thống màn hình LED ngoài trời được thiết kế đặc thù để chịu được các điều kiện thời tiết khắc nghiệt như mưa bão, nắng nóng gay gắt và bụi bẩn với tiêu chuẩn kháng nước bụi IP65/IP66. Bóng LED công nghệ cao cung cấp độ sáng vượt trội (lên đến 8000 nits) đảm bảo hình ảnh hiển thị sắc nét, sống động ngay cả dưới ánh nắng mặt trời chiếu trực tiếp. Đây là giải pháp hoàn hảo cho bảng quảng cáo tấm lớn ngoài trời, mặt tiền tòa nhà hay sân khấu sự kiện lớn.', 'hacoled'); ?>
            </p>
            <div class="pt-2">
              <a href="https://hacoled.com/man-hinh-led-ngoai-troi/" class="inline-flex items-center justify-center gap-1.5 px-6 py-2.5 rounded-full bg-accent-red hover:bg-accent-rose text-white text-xs font-bold uppercase tracking-wider transition-all duration-300 shadow-md">
                <?php _e('Xem nhiều hơn', 'hacoled'); ?> <i class="ph-bold ph-caret-double-right"></i>
              </a>
            </div>
          </div>
          <div class="lg:col-span-5 relative group gsap-reveal order-1 lg:order-2" data-direction="left" data-delay="0.2">
            <div class="absolute -inset-1 bg-gradient-to-r from-accent-red to-accent-gold rounded-2xl blur opacity-15 group-hover:opacity-30 transition-opacity"></div>
            <div class="relative rounded-xl overflow-hidden border border-slate-200 bg-slate-100 aspect-[16/10] shadow-md">
              <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=800&auto=format&fit=crop&q=80" alt="Màn hình LED lắp ngoài trời" class="w-full h-full object-cover">
            </div>
          </div>
        </div>

        <!-- Segment 3: Hội trường (Image Left, Text Right) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
          <div class="lg:col-span-5 relative group gsap-reveal" data-direction="right" data-delay="0.2">
            <div class="absolute -inset-1 bg-gradient-to-r from-accent-red to-accent-gold rounded-2xl blur opacity-15 group-hover:opacity-30 transition-opacity"></div>
            <div class="relative rounded-xl overflow-hidden border border-slate-200 bg-slate-100 aspect-[16/10] shadow-md">
              <img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=800&auto=format&fit=crop&q=80" alt="Màn hình LED lắp cho hội trường" class="w-full h-full object-cover">
            </div>
          </div>
          <div class="lg:col-span-7 space-y-4 gsap-reveal pl-0 lg:pl-6" data-direction="left" data-delay="0.3">
            <span class="text-xs font-bold text-accent-red uppercase tracking-wider font-mono">03. AUDITORIUM SOLUTIONS</span>
            <h3 class="text-2xl font-extrabold text-slate-900"><?php _e('Màn hình LED lắp cho hội trường', 'hacoled'); ?></h3>
            <p class="text-slate-600 text-sm leading-relaxed font-light">
              <?php _e('Màn hình LED hội trường đóng vai trò là hạt nhân hiển thị trung tâm, thay thế hoàn toàn cho máy chiếu truyền thống nhờ độ phân giải siêu nét (từ Full HD đến 4K) và độ tương phản tuyệt đối. HacoLED tư vấn lắp đặt hệ thống cơ khí chịu lực vững chãi kết hợp bộ xử lý hình ảnh Processor đa cổng cho phép chia nhiều khung hình hiển thị cùng lúc (nội dung thuyết trình, cầu truyền hình trực tuyến, tư liệu họp), nâng tầm quy mô chuyên nghiệp cho hội nghị lớn.', 'hacoled'); ?>
            </p>
            <div class="pt-2">
              <a href="https://hacoled.com/man-hinh-led-san-khau/" class="inline-flex items-center justify-center gap-1.5 px-6 py-2.5 rounded-full bg-accent-red hover:bg-accent-rose text-white text-xs font-bold uppercase tracking-wider transition-all duration-300 shadow-md">
                <?php _e('Xem nhiều hơn', 'hacoled'); ?> <i class="ph-bold ph-caret-double-right"></i>
              </a>
            </div>
          </div>
        </div>

        <!-- Segment 4: Phòng họp (Text Left, Image Right) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
          <div class="lg:col-span-7 space-y-4 gsap-reveal pr-0 lg:pr-6 order-2 lg:order-1" data-direction="right" data-delay="0.3">
            <span class="text-xs font-bold text-accent-red uppercase tracking-wider font-mono">04. BOARDROOM SYSTEMS</span>
            <h3 class="text-2xl font-extrabold text-slate-900"><?php _e('Màn hình LED lắp cho phòng họp', 'hacoled'); ?></h3>
            <p class="text-slate-600 text-sm leading-relaxed font-light">
              <?php _e('Nhắm tới môi trường doanh nghiệp hiện đại, giải pháp màn hình LED phòng họp của HacoLED sở hữu các dòng cabin mỏng nhẹ và khoảng cách điểm ảnh cực nhỏ (P1.2 đến P1.86) cho phép đọc văn bản nhỏ rõ ràng ở cự ly gần. Hệ thống hỗ trợ tương tác trình chiếu không dây từ điện thoại, laptop cực kỳ nhanh chóng và tương thích hoàn hảo với các thiết bị họp trực tuyến camera AI, nâng cao hiệu suất làm việc nhóm và các buổi đàm phán quan trọng.', 'hacoled'); ?>
            </p>
            <div class="pt-2">
              <a href="https://hacoled.com/man-hinh-led-trong-nha/" class="inline-flex items-center justify-center gap-1.5 px-6 py-2.5 rounded-full bg-accent-red hover:bg-accent-rose text-white text-xs font-bold uppercase tracking-wider transition-all duration-300 shadow-md">
                <?php _e('Xem nhiều hơn', 'hacoled'); ?> <i class="ph-bold ph-caret-double-right"></i>
              </a>
            </div>
          </div>
          <div class="lg:col-span-5 relative group gsap-reveal order-1 lg:order-2" data-direction="left" data-delay="0.2">
            <div class="absolute -inset-1 bg-gradient-to-r from-accent-red to-accent-gold rounded-2xl blur opacity-15 group-hover:opacity-30 transition-opacity"></div>
            <div class="relative rounded-xl overflow-hidden border border-slate-200 bg-slate-100 aspect-[16/10] shadow-md">
              <img src="https://images.unsplash.com/photo-1492619375914-88005aa9e8fb?w=800&auto=format&fit=crop&q=80" alt="Màn hình LED lắp cho phòng họp" class="w-full h-full object-cover">
            </div>
          </div>
        </div>

        <!-- Segment 5: Trường học (Image Left, Text Right) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center font-light">
          <div class="lg:col-span-5 relative group gsap-reveal" data-direction="right" data-delay="0.2">
            <div class="absolute -inset-1 bg-gradient-to-r from-accent-red to-accent-gold rounded-2xl blur opacity-15 group-hover:opacity-30 transition-opacity"></div>
            <div class="relative rounded-xl overflow-hidden border border-slate-200 bg-slate-100 aspect-[16/10] shadow-md">
              <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800&auto=format&fit=crop&q=80" alt="Màn hình LED lắp cho trường học" class="w-full h-full object-cover">
            </div>
          </div>
          <div class="lg:col-span-7 space-y-4 gsap-reveal pl-0 lg:pl-6" data-direction="left" data-delay="0.3">
            <span class="text-xs font-bold text-accent-red uppercase tracking-wider font-mono">05. EDUCATION SPACES</span>
            <h3 class="text-2xl font-extrabold text-slate-900"><?php _e('Màn hình LED lắp cho trường học', 'hacoled'); ?></h3>
            <p class="text-slate-600 text-sm leading-relaxed font-light">
              <?php _e('Đầu tư cho giáo dục hiện đại, HacoLED cung cấp màn hình LED trường học đáp ứng nhu cầu giảng dạy đa phương tiện sinh động tại các giảng đường lớn hoặc sân trường ngoài trời. Hệ thống được trang bị bộ lọc bảo vệ mắt (chống ánh sáng xanh và chống chói tốt) giúp học sinh dễ dàng theo dõi bài học trong thời gian dài mà không mỏi mắt. Với cấu trúc bền bỉ và vận hành đơn giản, giáo viên có thể dễ dàng cắm chạy nội dung chỉ bằng USB hoặc truyền tin qua mạng nội bộ.', 'hacoled'); ?>
            </p>
            <div class="pt-2">
              <a href="https://hacoled.com/man-hinh-led-truong-hoc/" class="inline-flex items-center justify-center gap-1.5 px-6 py-2.5 rounded-full bg-accent-red hover:bg-accent-rose text-white text-xs font-bold uppercase tracking-wider transition-all duration-300 shadow-md">
                <?php _e('Xem nhiều hơn', 'hacoled'); ?> <i class="ph-bold ph-caret-double-right"></i>
              </a>
            </div>
          </div>
        </div>

      </div>

    </div>

    <!-- SECTION 6: GIÁ TRỊ CỐT LÕI -->
    <div class="mb-20 border-b border-slate-200 pb-16">
      <div class="text-center max-w-xl mx-auto mb-12 gsap-reveal" data-direction="up" data-delay="0.1">
        <span class="block text-[10px] font-bold text-accent-red uppercase tracking-widest font-mono mb-1"><?php _e('GIÁ TRỊ CỐT LÕI', 'hacoled'); ?></span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 uppercase tracking-wide">
          <?php _e('Cam kết tạo dựng niềm tin', 'hacoled'); ?>
        </h2>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Value 1 -->
        <div class="p-8 rounded-2xl glass-card border border-slate-200/60 hover:border-accent-gold/25 hover:bg-white transition-all duration-350 space-y-4 gsap-reveal" data-direction="up" data-delay="0.2">
          <div class="w-12 h-12 rounded-xl bg-accent-red/10 flex items-center justify-center border border-accent-red/20 text-accent-red">
            <i class="ph-fill ph-shield-check text-2xl"></i>
          </div>
          <h3 class="text-base font-extrabold text-slate-900 tracking-wide"><?php echo esc_html($values[0]['title'] ?? __('Chất lượng hàng đầu', 'hacoled')); ?></h3>
          <p class="text-xs text-slate-500 leading-relaxed"><?php echo esc_html($values[0]['desc'] ?? __('Cam kết linh kiện chính hãng CO/CQ đầy đủ, kiểm định nghiêm ngặt trước khi xuất xưởng.', 'hacoled')); ?></p>
        </div>

        <!-- Value 2 -->
        <div class="p-8 rounded-2xl glass-card border border-slate-200/60 hover:border-accent-gold/25 hover:bg-white transition-all duration-350 space-y-4 gsap-reveal" data-direction="up" data-delay="0.3">
          <div class="w-12 h-12 rounded-xl bg-accent-gold/10 flex items-center justify-center border border-accent-gold/20 text-accent-gold">
            <i class="ph-fill ph-lightbulb-filament text-2xl"></i>
          </div>
          <h3 class="text-base font-extrabold text-slate-900 tracking-wide"><?php echo esc_html($values[1]['title'] ?? __('Giải pháp tối ưu', 'hacoled')); ?></h3>
          <p class="text-xs text-slate-500 leading-relaxed"><?php echo esc_html($values[1]['desc'] ?? __('Tư vấn thiết kế bản vẽ kỹ thuật chi tiết phù hợp nhất với ngân sách và không gian của bạn.', 'hacoled')); ?></p>
        </div>

        <!-- Value 3 -->
        <div class="p-8 rounded-2xl glass-card border border-slate-200/60 hover:border-accent-gold/25 hover:bg-white transition-all duration-350 space-y-4 gsap-reveal" data-direction="up" data-delay="0.4">
          <div class="w-12 h-12 rounded-xl bg-green-500/10 flex items-center justify-center border border-green-500/20 text-green-500">
            <i class="ph-fill ph-handshake text-2xl"></i>
          </div>
          <h3 class="text-base font-extrabold text-slate-900 tracking-wide"><?php echo esc_html($values[2]['title'] ?? __('Dịch vụ tận tâm', 'hacoled')); ?></h3>
          <p class="text-xs text-slate-500 leading-relaxed"><?php echo esc_html($values[2]['desc'] ?? __('Hỗ trợ kỹ thuật 24/7, xử lý sự cố nhanh chóng, bảo hành vàng lên tới 3 năm.', 'hacoled')); ?></p>
        </div>
      </div>
    </div>

    <!-- SECTION 7: CAM KẾT CHẤT LƯỢNG DỊCH VỤ (Tóm tắt & Điều hướng) -->
    <div class="mb-20 border-b border-slate-200 pb-16">
      <div class="p-8 sm:p-12 rounded-3xl glass-card border border-slate-200 bg-white/80 shadow-lg relative overflow-hidden gsap-reveal" data-direction="up" data-delay="0.2">
        <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
          
          <!-- Left content: Text description -->
          <div class="lg:col-span-7 space-y-6">
            <span class="block text-xs font-bold text-accent-red uppercase tracking-widest font-mono"><?php _e('CAM KẾT CHẤT LƯỢNG', 'hacoled'); ?></span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">
              <?php _e('Trải nghiệm dịch vụ 3T: Tận Tâm - Nhanh Chóng - Trọn Vẹn', 'hacoled'); ?>
            </h2>
            <p class="text-slate-650 text-sm leading-relaxed font-light">
              <?php _e('Tại HacoLED, chúng tôi hiểu rằng một giải pháp hiển thị hoàn hảo không chỉ dừng lại ở thiết bị chất lượng mà còn đi liền với trải nghiệm dịch vụ đẳng cấp. Chúng tôi cam kết đồng hành cùng đối tác trong mọi khâu, từ tư vấn thiết kế đến bảo hành dài lâu.', 'hacoled'); ?>
            </p>
            <div class="pt-2">
              <a href="<?php echo esc_url(home_url('/cam-ket-chat-luong-dich-vu/')); ?>" class="inline-flex items-center justify-center gap-1.5 px-6 py-3 rounded-full bg-accent-red hover:bg-accent-rose text-white text-xs font-bold uppercase tracking-wider transition-all duration-300 shadow-md">
                <?php _e('Xem chi tiết cam kết dịch vụ', 'hacoled'); ?> <i class="ph-bold ph-caret-double-right"></i>
              </a>
            </div>
          </div>

          <!-- Right content: 3 criteria list with icons -->
          <div class="lg:col-span-5 space-y-4">
            
            <!-- Pillar 1 -->
            <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50/50 border border-slate-100 hover:border-accent-red/20 transition-all duration-300">
              <div class="w-10 h-10 rounded-xl bg-accent-red/10 flex items-center justify-center border border-accent-red/10 text-accent-red shrink-0">
                <i class="ph-fill ph-hand-heart text-xl"></i>
              </div>
              <div class="space-y-0.5">
                <h4 class="text-xs sm:text-sm font-extrabold text-slate-900"><?php _e('Tận Tâm', 'hacoled'); ?></h4>
                <p class="text-xs text-slate-500 font-light"><?php _e('Lắng nghe và đồng hành bằng tâm huyết và hỗ trợ khách hàng hết mình.', 'hacoled'); ?></p>
              </div>
            </div>

            <!-- Pillar 2 -->
            <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50/50 border border-slate-100 hover:border-accent-gold/20 transition-all duration-300">
              <div class="w-10 h-10 rounded-xl bg-accent-gold/10 flex items-center justify-center border border-accent-gold/10 text-accent-gold shrink-0">
                <i class="ph-fill ph-lightning text-xl"></i>
              </div>
              <div class="space-y-0.5">
                <h4 class="text-xs sm:text-sm font-extrabold text-slate-900"><?php _e('Nhanh Chóng', 'hacoled'); ?></h4>
                <p class="text-xs text-slate-500 font-light"><?php _e('Thời gian phản hồi nhanh nhất và luôn sẵn sàng hỗ trợ 24/7.', 'hacoled'); ?></p>
              </div>
            </div>

            <!-- Pillar 3 -->
            <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50/50 border border-slate-100 hover:border-green-500/20 transition-all duration-300">
              <div class="w-10 h-10 rounded-xl bg-green-500/10 flex items-center justify-center border border-green-500/10 text-green-500 shrink-0">
                <i class="ph-fill ph-circle-wavy-check text-xl"></i>
              </div>
              <div class="space-y-0.5">
                <h4 class="text-xs sm:text-sm font-extrabold text-slate-900"><?php _e('Trọn Vẹn', 'hacoled'); ?></h4>
                <p class="text-xs text-slate-500 font-light"><?php _e('Cung cấp đầy đủ thủ tục pháp lý, chất lượng chuẩn mực đúng hợp đồng.', 'hacoled'); ?></p>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>

    <!-- SECTION 8: CALL TO ACTION (CTA) -->
    <div class="gsap-reveal" data-direction="up" data-delay="0.2">
      <div class="relative rounded-3xl overflow-hidden bg-[#4A0505] border border-white/10 p-8 sm:p-12 text-center max-w-4xl mx-auto shadow-2xl">
        <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
        <div class="relative z-10 space-y-6">
          <span class="text-xs font-bold text-accent-gold uppercase tracking-widest font-mono"><?php _e('TƯ VẤN & BÁO GIÁ', 'hacoled'); ?></span>
          <h3 class="text-2xl sm:text-3xl font-extrabold text-white leading-tight uppercase">
            <?php _e('Bạn đang cần khảo sát & báo giá dự án?', 'hacoled'); ?>
          </h3>
          <p class="text-slate-300 text-xs max-w-xl mx-auto leading-relaxed">
            <?php _e('HacoLED hỗ trợ khảo sát thực địa tận nơi và thiết kế bản vẽ kỹ thuật 2D/3D chi tiết hoàn toàn miễn phí. Đội ngũ chuyên gia của chúng tôi sẽ đề xuất giải pháp phù hợp nhất với không gian và ngân sách của bạn.', 'hacoled'); ?>
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
