<?php
/**
 * Contact Page View Template
 *
 * @var array  $page
 * @var string $header_type
 * @var string $footer_type
 */

$this->renderHeader($header_type ?? 'default');
?>

<!-- Premium Contact Page Wrapper (Light Theme) -->
<main class="relative bg-[#FAFAFA] pt-28 md:pt-48 pb-24 overflow-hidden min-h-[80vh]">
  
  <!-- Glowing Background Orbs -->
  <div class="glow-gold top-0 left-1/4 opacity-10"></div>
  <div class="glow-red bottom-0 right-1/4 opacity-5"></div>

  <!-- Dong Son drum watermark -->

  <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10">

    <!-- Breadcrumbs with Schema.org Microdata -->
    <nav aria-label="Breadcrumb" class="mb-6 text-xs font-semibold text-slate-400 uppercase tracking-widest flex items-center gap-2" itemscope itemtype="https://schema.org/BreadcrumbList">
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

    <!-- Header block -->
    <div class="max-w-3xl mb-16 space-y-4">
      <div class="w-12 h-1 bg-gradient-to-r from-accent-red to-accent-gold rounded-full"></div>
      <span class="block text-[11px] font-bold text-accent-red uppercase tracking-widest font-mono"><?php _e('KẾT NỐI VỚI HACOLED', 'hacoled'); ?></span>
      <h1 class="text-3xl sm:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight uppercase">
        <?php echo esc_html($page['title']); ?>
      </h1>
      <p class="text-slate-600 text-sm leading-relaxed">
        <?php _e('Quý khách hàng cần tư vấn kỹ thuật màn hình LED, yêu cầu báo giá dự án thi công hoặc đăng ký lịch bảo hành bảo trì vui lòng gửi thông tin theo form bên dưới hoặc liên hệ trực tiếp với hệ thống văn phòng của chúng tôi.', 'hacoled'); ?>
      </p>
    </div>

    <!-- Contact Split Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mb-20">
      
      <!-- Left side: Office Address Cards (span-7) -->
      <div class="lg:col-span-7 space-y-6">
        
        <h3 class="text-lg font-extrabold text-slate-900 flex items-center gap-2 mb-4">
          <i class="ph-fill ph-map-pin text-accent-red text-xl"></i>
          <?php _e('Hệ thống văn phòng đại diện', 'hacoled'); ?>
        </h3>

        <!-- HN HQ Card -->
        <div class="p-6 rounded-2xl glass-card border border-slate-200/60 bg-white/75 space-y-3 hover:border-accent-red/20 transition-colors">
          <div class="flex justify-between items-center border-b border-slate-100 pb-2">
            <span class="text-xs font-extrabold text-accent-red uppercase tracking-widest"><?php _e('Trụ sở Hà Nội', 'hacoled'); ?></span>
            <span class="text-[9px] bg-red-50 text-accent-red font-bold px-2 py-0.5 rounded border border-accent-red/20 uppercase font-mono">Headquarters</span>
          </div>
          <ul class="space-y-2 text-xs text-slate-650">
            <li class="flex items-start gap-2.5">
              <i class="ph-fill ph-map-pin text-slate-400 mt-0.5 shrink-0 text-sm"></i>
              <span><?php _e('Số 11 ngõ 10 Nghĩa Đô, phường Nghĩa Đô, TP. Hà Nội', 'hacoled'); ?></span>
            </li>
            <li class="flex items-start gap-2.5">
              <i class="ph-fill ph-phone-call text-slate-400 mt-0.5 shrink-0 text-sm"></i>
              <span>Hotline: <a href="tel:0868474488" class="text-slate-900 font-bold hover:text-accent-red transition-colors">086.847.4488</a> - Cố định: <a href="tel:02422424488" class="text-slate-900 hover:text-accent-red transition-colors">0242.242.4488</a></span>
            </li>
          </ul>
        </div>

        <!-- HCMC CN Card -->
        <div class="p-6 rounded-2xl glass-card border border-slate-200/60 bg-white/75 space-y-3 hover:border-accent-red/20 transition-colors">
          <div class="flex justify-between items-center border-b border-slate-100 pb-2">
            <span class="text-xs font-extrabold text-accent-red uppercase tracking-widest"><?php _e('Văn phòng Hồ Chí Minh', 'hacoled'); ?></span>
            <span class="text-[9px] bg-slate-100 text-slate-550 font-bold px-2 py-0.5 rounded border border-slate-200 uppercase font-mono">Branch</span>
          </div>
          <ul class="space-y-2 text-xs text-slate-650">
            <li class="flex items-start gap-2.5">
              <i class="ph-fill ph-map-pin text-slate-400 mt-0.5 shrink-0 text-sm"></i>
              <span><?php _e('400 Đ.Nguyễn Thị Thập, P. Tân Hưng, TP. Hồ Chí Minh', 'hacoled'); ?></span>
            </li>
            <li class="flex items-start gap-2.5">
              <i class="ph-fill ph-phone-call text-slate-400 mt-0.5 shrink-0 text-sm"></i>
              <span>Hotline: <a href="tel:0896894488" class="text-slate-900 font-bold hover:text-accent-red transition-colors">089.689.4488</a> - Cố định: <a href="tel:02866728779" class="text-slate-900 hover:text-accent-red transition-colors">0286.672.8779</a></span>
            </li>
          </ul>
        </div>

        <!-- DN CN Card -->
        <div class="p-6 rounded-2xl glass-card border border-slate-200/60 bg-white/75 space-y-3 hover:border-accent-red/20 transition-colors">
          <div class="flex justify-between items-center border-b border-slate-100 pb-2">
            <span class="text-xs font-extrabold text-accent-red uppercase tracking-widest"><?php _e('Văn phòng Đà Nẵng', 'hacoled'); ?></span>
            <span class="text-[9px] bg-slate-100 text-slate-550 font-bold px-2 py-0.5 rounded border border-slate-200 uppercase font-mono">Branch</span>
          </div>
          <ul class="space-y-2 text-xs text-slate-650">
            <li class="flex items-start gap-2.5">
              <i class="ph-fill ph-map-pin text-slate-400 mt-0.5 shrink-0 text-sm"></i>
              <span><?php _e('Số 88 Tây Sơn, P. Ngũ Hành Sơn, TP. Đà Nẵng', 'hacoled'); ?></span>
            </li>
            <li class="flex items-start gap-2.5">
              <i class="ph-fill ph-phone-call text-slate-400 mt-0.5 shrink-0 text-sm"></i>
              <span>Hotline: <a href="tel:0973954488" class="text-slate-900 font-bold hover:text-accent-red transition-colors">097.395.4488</a></span>
            </li>
          </ul>
        </div>

      </div>

      <!-- Right side: Custom Contact Form (span-5) -->
      <div class="lg:col-span-5">
        <div class="p-8 rounded-3xl glass-card border border-slate-200/80 bg-white space-y-6 relative overflow-hidden shadow-lg">
          <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
          <div class="relative z-10 space-y-4">
            <h3 class="text-lg font-extrabold text-slate-900 flex items-center gap-2">
              <i class="ph-fill ph-envelope-open text-accent-red"></i>
              <?php _e('Yêu cầu báo giá nhanh', 'hacoled'); ?>
            </h3>
            <p class="text-slate-500 text-xs leading-relaxed">
              <?php _e('Hãy điền yêu cầu của bạn, đội ngũ tư vấn viên HacoLED sẽ liên hệ phản hồi trong 15 phút.', 'hacoled'); ?>
            </p>
            
            <form class="space-y-4 pt-2">
              <div>
                <label class="block text-[10px] font-bold text-slate-600 uppercase tracking-widest mb-1.5"><?php _e('Họ và tên', 'hacoled'); ?></label>
                <input type="text" placeholder="<?php _e('Ví dụ: Nguyễn Văn A', 'hacoled'); ?>" 
                       class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 placeholder-slate-400 text-xs focus:outline-none focus:border-accent-red focus:ring-1 focus:ring-accent-red transition-all duration-300">
              </div>
              <div>
                <label class="block text-[10px] font-bold text-slate-600 uppercase tracking-widest mb-1.5"><?php _e('Số điện thoại / Email', 'hacoled'); ?></label>
                <input type="text" placeholder="<?php _e('Ví dụ: 0987654321 hoặc cty@hacoled.com', 'hacoled'); ?>" 
                       class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 placeholder-slate-400 text-xs focus:outline-none focus:border-accent-red focus:ring-1 focus:ring-accent-red transition-all duration-300">
              </div>
              <div>
                <label class="block text-[10px] font-bold text-slate-600 uppercase tracking-widest mb-1.5"><?php _e('Nội dung yêu cầu báo giá', 'hacoled'); ?></label>
                <textarea rows="4" placeholder="<?php _e('Vui lòng ghi rõ dòng màn hình LED quan tâm (ví dụ: LED P2.5 trong nhà 10m2...)', 'hacoled'); ?>" 
                          class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 placeholder-slate-400 text-xs focus:outline-none focus:border-accent-red focus:ring-1 focus:ring-accent-red transition-all duration-300"></textarea>
              </div>
              <button type="submit" class="w-full py-3.5 rounded-xl bg-gradient-to-r from-accent-red to-accent-rose hover:opacity-90 font-extrabold text-xs text-white uppercase tracking-widest shadow-lg hover:shadow-accent-red/20 transition-all duration-300">
                <?php _e('Gửi yêu cầu ngay', 'hacoled'); ?>
              </button>
            </form>
          </div>
        </div>
      </div>

    </div>

    <!-- Section: High-Tech Simulated SVG Radar Office Map -->
    <div class="border-t border-slate-200 pt-16">
      <div class="text-center max-w-xl mx-auto mb-10">
        <span class="block text-[10px] font-bold text-accent-red uppercase tracking-widest font-mono mb-1"><?php _e('MẠNG LƯỚI HACOLED', 'hacoled'); ?></span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 uppercase tracking-wide">
          <?php _e('Vị trí trạm kỹ thuật toàn quốc', 'hacoled'); ?>
        </h2>
      </div>

      <!-- High-tech simulated interactive vector radar map -->
      <div class="w-full h-[400px] rounded-3xl bg-slate-950 border border-white/10 relative overflow-hidden flex items-center justify-center shadow-xl">
        <!-- Tech grid background -->
        <div class="absolute inset-0 bg-grid-pattern opacity-15"></div>
        <!-- Decorative circular radar sweep -->
        <div class="absolute w-[500px] h-[500px] border border-white/5 rounded-full animate-[spin_30s_linear_infinite] flex items-center justify-center">
          <div class="w-[300px] h-[300px] border border-white/5 rounded-full flex items-center justify-center">
            <div class="w-[100px] h-[100px] border border-white/5 rounded-full"></div>
          </div>
          <!-- Scanning sweep hand -->
          <div class="absolute top-0 left-1/2 w-0.5 h-1/2 bg-gradient-to-t from-accent-gold/25 to-transparent origin-bottom"></div>
        </div>

        <!-- Simulated Vector SVG Map Overlay -->
        <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 400">
          <!-- Laser connecting lines -->
          <line x1="400" y1="80" x2="430" y2="200" stroke="#fbbf24" stroke-width="1" stroke-dasharray="4,4" opacity="0.4" />
          <line x1="430" y1="200" x2="450" y2="320" stroke="#fbbf24" stroke-width="1" stroke-dasharray="4,4" opacity="0.4" />
          <line x1="400" y1="80" x2="450" y2="320" stroke="#ef4444" stroke-width="1" stroke-dasharray="6,4" opacity="0.3" />

          <!-- Location Pin: Hanoi HQ (400, 80) -->
          <g transform="translate(400, 80)">
            <circle r="18" fill="rgba(251,191,36,0.15)" class="animate-ping" />
            <circle r="8" fill="#fbbf24" class="shadow-glow-gold" />
            <circle r="3" fill="#3f0707" />
            <text x="15" y="4" fill="#ffffff" font-size="10" font-weight="bold" font-family="sans-serif" letter-spacing="1">HA NOI (HQ)</text>
          </g>

          <!-- Location Pin: Da Nang CN (430, 200) -->
          <g transform="translate(430, 200)">
            <circle r="14" fill="rgba(251,191,36,0.15)" class="animate-ping" style="animation-delay: 1s;" />
            <circle r="6" fill="#fbbf24" />
            <circle r="2" fill="#3f0707" />
            <text x="15" y="4" fill="#cbd5e1" font-size="9" font-weight="bold" font-family="sans-serif" letter-spacing="1">CN DA NANG</text>
          </g>

          <!-- Location Pin: HCMC CN (450, 320) -->
          <g transform="translate(450, 320)">
            <circle r="18" fill="rgba(239,68,68,0.15)" class="animate-ping" style="animation-delay: 2s;" />
            <circle r="8" fill="#ef4444" class="shadow-glow-red" />
            <circle r="3" fill="#3f0707" />
            <text x="15" y="4" fill="#ffffff" font-size="10" font-weight="bold" font-family="sans-serif" letter-spacing="1">CN HO CHI MINH</text>
          </g>

          <!-- Location Pin: Tay Nguyen Station (410, 270) -->
          <g transform="translate(410, 270)">
            <circle r="5" fill="#e11d48" opacity="0.8" />
            <text x="-95" y="4" fill="#94a3b8" font-size="8" font-family="sans-serif">TAY NGUYEN STATION</text>
          </g>
        </svg>

        <div class="absolute bottom-6 left-6 right-6 flex justify-between items-center bg-slate-900/90 backdrop-blur border border-white/5 rounded-xl py-3 px-4 text-[10px] text-slate-400 z-10">
          <div class="flex items-center gap-4">
            <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-accent-gold inline-block"></span><?php _e('Trụ sở / CN chính', 'hacoled'); ?></span>
            <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-accent-red inline-block"></span><?php _e('CN Kỹ thuật', 'hacoled'); ?></span>
          </div>
          <span class="hidden sm:inline font-mono text-[9px] tracking-wider text-slate-500 uppercase"><?php _e('HACOLED TELEMETRY MAPPING OK', 'hacoled'); ?></span>
        </div>
      </div>
    </div>

  </div>
</main>

<?php
$this->renderFooter($footer_type ?? 'default');
?>
