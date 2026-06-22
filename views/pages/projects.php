<?php
/**
 * Projects List Page View Template - Tech-Dark Showroom Design
 *
 * @var array  $page
 * @var array  $projects
 * @var string $header_type
 * @var string $footer_type
 */

$this->renderHeader($header_type ?? 'default');
?>

<!-- Premium Projects Page Wrapper (Style Tech-Dark) -->
<main class="relative bg-[#0A0000] pt-28 md:pt-48 pb-24 overflow-hidden bg-tech-grid min-h-[90vh]" x-data="{ activeTab: 'all' }" data-tech-bg="particle">
  
  <!-- Glowing Background Orbs -->
  <div class="glow-red top-1/4 left-1/4 opacity-20 w-[500px] h-[500px]"></div>
  <div class="glow-gold bottom-1/3 right-1/4 opacity-15 w-[600px] h-[600px]"></div>

  <!-- Dong Son drum watermark -->

  <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10">

    <!-- Breadcrumbs with Schema.org Microdata -->
    <nav aria-label="Breadcrumb" class="gsap-reveal mb-8 text-xs font-semibold text-slate-400 uppercase tracking-widest flex items-center gap-2" data-direction="up" data-delay="0.1" itemscope itemtype="https://schema.org/BreadcrumbList">
      <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-slate-400 hover:text-accent-gold transition-colors" itemprop="item">
          <span itemprop="name"><?php _e('Trang chủ', 'hacoled'); ?></span>
        </a>
        <meta itemprop="position" content="1" />
      </span>
      <span class="text-slate-500">/</span>
      <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span class="text-slate-300" itemprop="name"><?php echo esc_html($page['title']); ?></span>
        <meta itemprop="position" content="2" />
      </span>
    </nav>

    <!-- HEADER BLOCK -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end mb-16 border-b border-white/5 pb-12">
      <div class="lg:col-span-8 space-y-4 gsap-reveal" data-direction="up" data-delay="0.2">
        <div class="w-12 h-1 bg-gradient-to-r from-brand-red via-brand-gold to-yellow-300 rounded-full"></div>
        <span class="block text-[11px] font-bold text-brand-gold uppercase tracking-widest font-mono"><?php _e('KHO CÔNG TRÌNH TIÊU BIỂU', 'hacoled'); ?></span>
        <h1 class="text-4xl sm:text-5xl font-black text-white tracking-tight leading-tight uppercase">
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-gray-100 to-accent-gold"><?php echo esc_html($page['title']); ?></span>
        </h1>
        <p class="text-gray-300 text-sm leading-relaxed font-light max-w-3xl">
          <?php _e('Khám phá hơn 1000+ công trình màn hình LED, màn hình ghép LCD và hệ thống âm thanh ánh sáng hội trường do HacoLED trực tiếp thiết kế, thi công trọn gói trên toàn quốc. Đỉnh cao chất lượng kỹ thuật và mỹ thuật.', 'hacoled'); ?>
        </p>
      </div>
      
      <!-- Interactive AlpineJS Tab Filters (span-4) -->
      <div class="lg:col-span-4 flex justify-start lg:justify-end items-center gsap-reveal" data-direction="right" data-delay="0.3">
        <div class="flex flex-wrap gap-2.5 bg-white/5 border border-white/10 p-1.5 rounded-2xl backdrop-blur-xl">
          <button @click="activeTab = 'all'" 
                  :class="activeTab === 'all' ? 'bg-brand-red text-white' : 'text-gray-300 hover:text-white hover:bg-white/5'" 
                  class="px-4 py-2 rounded-xl text-xs font-bold transition-all duration-300">
            <?php _e('Tất cả', 'hacoled'); ?>
          </button>
          <button @click="activeTab = 'indoor'" 
                  :class="activeTab === 'indoor' ? 'bg-brand-red text-white' : 'text-gray-300 hover:text-white hover:bg-white/5'" 
                  class="px-4 py-2 rounded-xl text-xs font-bold transition-all duration-300">
            <?php _e('Trong nhà', 'hacoled'); ?>
          </button>
          <button @click="activeTab = 'outdoor'" 
                  :class="activeTab === 'outdoor' ? 'bg-brand-red text-white' : 'text-gray-300 hover:text-white hover:bg-white/5'" 
                  class="px-4 py-2 rounded-xl text-xs font-bold transition-all duration-300">
            <?php _e('Ngoài trời', 'hacoled'); ?>
          </button>
          <button @click="activeTab = 'others'" 
                  :class="activeTab === 'others' ? 'bg-brand-red text-white' : 'text-gray-300 hover:text-white hover:bg-white/5'" 
                  class="px-4 py-2 rounded-xl text-xs font-bold transition-all duration-300">
            <?php _e('Khác (AV/LCD)', 'hacoled'); ?>
          </button>
        </div>
      </div>
    </div>

    <!-- PROJECTS GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-24 gsap-reveal" data-direction="up" data-delay="0.3">
      <?php if (!empty($projects)): ?>
        <?php foreach ($projects as $project): 
          // Match categories for client filtering
          $cat_slug = 'others';
          $cat_name = $project['category'];
          if (mb_stripos($cat_name, 'trong nhà') !== false || mb_stripos($cat_name, 'indoor') !== false) {
              $cat_slug = 'indoor';
          } elseif (mb_stripos($cat_name, 'ngoài trời') !== false || mb_stripos($cat_name, 'outdoor') !== false) {
              $cat_slug = 'outdoor';
          }
        ?>
          <!-- Project Card -->
          <div x-show="activeTab === 'all' || activeTab === '<?php echo $cat_slug; ?>'"
               x-transition:enter="transition ease-out duration-300"
               x-transition:enter-start="opacity-0 scale-95"
               x-transition:enter-end="opacity-100 scale-100"
               class="group relative rounded-2xl overflow-hidden border border-white/10 bg-slate-950/40 shadow-2xl transition-all duration-500 hover:border-brand-gold/30">
            
            <!-- Thumbnail Cover -->
            <div class="aspect-[16/10] relative overflow-hidden bg-slate-900 border-b border-white/5">
              <?php if (!empty($project['thumbnail'])): ?>
                <img src="<?php echo esc_url($project['thumbnail']); ?>" alt="<?php echo esc_attr($project['title']); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
              <?php else: ?>
                <div class="absolute inset-0 bg-gradient-to-br from-slate-900 to-primary flex items-center justify-center">
                  <i class="ph-bold ph-sketch-logo text-slate-800 text-6xl"></i>
                </div>
              <?php endif; ?>
              
              <!-- Badges -->
              <div class="absolute top-4 left-4 z-10 flex flex-col gap-2">
                <span class="bg-brand-red/90 border border-brand-red/20 backdrop-blur-md text-white text-[9px] font-extrabold px-3 py-1 rounded-md shadow uppercase tracking-widest">
                  <?php echo esc_html($project['category']); ?>
                </span>
              </div>
              <div class="absolute top-4 right-4 z-10">
                <span class="bg-black/60 border border-white/10 backdrop-blur-md text-accent-gold text-[9px] font-mono font-bold px-2.5 py-1 rounded-md">
                  <?php echo esc_html($project['year']); ?>
                </span>
              </div>
            </div>

            <!-- Content Panel -->
            <div class="p-6 space-y-4">
              <div class="space-y-1">
                <span class="block text-[9px] font-bold text-gray-500 uppercase tracking-widest font-mono"><?php echo sprintf(__('Khách hàng: %s', 'hacoled'), esc_html($project['client'])); ?></span>
                <h3 class="text-base font-extrabold text-white leading-snug line-clamp-2 group-hover:text-brand-gold transition-colors duration-300">
                  <a href="<?php echo esc_url($project['permalink']); ?>">
                    <?php echo esc_html($project['title']); ?>
                  </a>
                </h3>
              </div>
              
              <!-- Technical Specs Strip -->
              <div class="pt-3 border-t border-white/5 flex items-center justify-between gap-2 text-[10px] text-gray-400 font-mono uppercase tracking-wider">
                <span><?php _e('Thông số kỹ thuật', 'hacoled'); ?></span>
                <span class="text-brand-gold font-bold bg-brand-gold/5 px-2 py-1 rounded border border-brand-gold/10">
                  <?php echo esc_html($project['tech_specs']); ?>
                </span>
              </div>

              <!-- Button CTA -->
              <div class="pt-2">
                <a href="<?php echo esc_url($project['permalink']); ?>" class="w-full inline-flex items-center justify-center gap-1.5 bg-white/5 hover:bg-brand-red text-white border border-white/10 hover:border-brand-red font-bold text-xs uppercase tracking-wider py-3 rounded-xl transition-all duration-300">
                  <span><?php _e('Chi tiết công trình', 'hacoled'); ?></span>
                  <i class="ph-bold ph-arrow-up-right text-[10px]"></i>
                </a>
              </div>
            </div>

          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-gray-400 col-span-full text-center py-12"><?php _e('Không tìm thấy dự án nào.', 'hacoled'); ?></p>
      <?php endif; ?>
    </div>

    <!-- STATS BRAND AUTHORITY -->
    <div class="relative rounded-3xl overflow-hidden border border-white/[0.08] bg-gradient-to-br from-white/[0.03] to-white/[0.01] backdrop-blur-xl p-8 md:p-12 mb-24 shadow-2xl gsap-reveal" data-direction="up" data-delay="0.4">
      <div class="absolute -left-20 -top-20 w-48 h-48 bg-brand-red/10 rounded-full blur-3xl pointer-events-none"></div>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-y md:divide-y-0 md:divide-x divide-white/5">
        <!-- Stat 1 -->
        <div class="space-y-2 pt-6 md:pt-0">
          <div class="text-3xl sm:text-4xl font-black text-brand-gold flex items-center justify-center gap-0.5">
            <span class="counter" data-target="1000">0</span>
            <span class="text-xl">+</span>
          </div>
          <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest font-mono"><?php _e('Công trình hoàn tất', 'hacoled'); ?></p>
        </div>
        <!-- Stat 2 -->
        <div class="space-y-2 pt-6 md:pt-0">
          <div class="text-3xl sm:text-4xl font-black text-brand-gold flex items-center justify-center gap-0.5">
            <span class="counter" data-target="63">0</span>
          </div>
          <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest font-mono"><?php _e('Tỉnh thành phủ sóng', 'hacoled'); ?></p>
        </div>
        <!-- Stat 3 -->
        <div class="space-y-2 pt-6 md:pt-0">
          <div class="text-3xl sm:text-4xl font-black text-brand-gold flex items-center justify-center gap-0.5">
            <span class="counter" data-target="100">0</span>
            <span class="text-xl">%</span>
          </div>
          <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest font-mono"><?php _e('Linh kiện chính hãng', 'hacoled'); ?></p>
        </div>
        <!-- Stat 4 -->
        <div class="space-y-2 pt-6 md:pt-0">
          <div class="text-3xl sm:text-4xl font-black text-brand-gold flex items-center justify-center gap-0.5">
            <span class="counter" data-target="36">0</span>
            <span class="text-lg">T</span>
          </div>
          <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest font-mono"><?php _e('Bảo hành vàng tối đa', 'hacoled'); ?></p>
        </div>
      </div>
    </div>

    <!-- CTA SECTION -->
    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-primary-dark via-primary to-primary-dark border border-white/10 p-8 sm:p-12 text-center max-w-4xl mx-auto shadow-2xl gsap-reveal" data-direction="up" data-delay="0.4">
      <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
      <div class="relative z-10 space-y-6">
        <span class="text-xs font-bold text-brand-gold uppercase tracking-widest font-mono"><?php _e('HỢP TÁC & THI CÔNG', 'hacoled'); ?></span>
        <h3 class="text-2xl sm:text-3xl font-extrabold text-white leading-tight uppercase">
          <?php _e('Nâng tầm không gian trình chiếu của bạn ngay hôm nay', 'hacoled'); ?>
        </h3>
        <p class="text-gray-300 text-xs max-w-xl mx-auto leading-relaxed font-light">
          <?php _e('Chúng tôi cung cấp giải pháp màn hình hiển thị tích hợp trọn gói cho hội trường, phòng họp trực tuyến, biển hiệu quảng cáo tấm lớn ngoài trời với chi phí tối ưu và hỗ trợ bảo hành vàng 24/7.', 'hacoled'); ?>
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
          <a href="<?php echo esc_url(home_url('/lien-he/')); ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gradient-to-r from-brand-gold to-yellow-500 hover:from-yellow-500 hover:to-brand-gold text-primary-dark font-extrabold text-xs uppercase px-8 py-4 rounded-full tracking-wider shadow-lg transition-all duration-300">
            <span><?php _e('Nhận tư vấn & Báo giá', 'hacoled'); ?></span>
            <i class="ph-bold ph-arrow-right text-[11px]"></i>
          </a>
          <a href="tel:0342324488" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 border border-white/20 hover:border-white/40 text-white font-bold text-xs uppercase px-8 py-4 rounded-full tracking-wider transition-all duration-300">
            <i class="ph-fill ph-phone-call text-[13px] text-brand-gold"></i>
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
