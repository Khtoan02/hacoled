<?php
/**
 * View: Careers (Tuyển dụng)
 */
?>

<?php $this->renderHeader($header_type ?? 'default'); ?>

<main class="relative bg-brand-bg pt-28 md:pt-48 pb-24 overflow-hidden min-h-[80vh]">
  
  <!-- Glowing Background Orbs -->
  <div class="glow-gold -top-20 -right-20 opacity-10"></div>
  <div class="glow-red bottom-10 left-10 opacity-5"></div>

  <!-- Dong Son drum watermark -->

  <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10">

    <!-- Breadcrumbs -->
    <nav aria-label="Breadcrumb" class="gsap-reveal mb-12 text-xs font-semibold text-slate-400 uppercase tracking-widest flex items-center gap-2" data-direction="up" data-delay="0.1">
      <span>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-slate-500 hover:text-accent-gold transition-colors">
          <?php _e('Trang chủ', 'hacoled'); ?>
        </a>
      </span>
      <span class="text-slate-400">/</span>
      <span>
        <span class="text-slate-650"><?php echo esc_html($page['title'] ?? 'Tuyển dụng'); ?></span>
      </span>
    </nav>

    <!-- SECTION 1: HERO SECTION -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-24">
      
      <!-- Left side: Narrative Text -->
      <div class="lg:col-span-6 space-y-6 gsap-reveal" data-direction="up" data-delay="0.2">
        <div class="w-12 h-1 bg-gradient-to-r from-accent-red to-accent-gold rounded-full"></div>
        <span class="block text-[11px] font-bold text-accent-red uppercase tracking-widest font-mono"><?php _e('GIA NHẬP ĐỘI NGŨ HACOLED', 'hacoled'); ?></span>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.1]">
          <?php _e('Kiến tạo tương lai', 'hacoled'); ?><br>
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent-red to-brand-gold">
            <?php _e('công nghệ hiển thị', 'hacoled'); ?>
          </span>
        </h1>
        <p class="text-slate-600 text-base leading-relaxed font-light pt-2 max-w-lg">
          <?php _e('Trở thành một phần của đội ngũ tiên phong mang đến các giải pháp hiển thị LED và âm thanh chuyên nghiệp hàng đầu Việt Nam. Nơi tài năng của bạn được công nhận và phát huy tối đa.', 'hacoled'); ?>
        </p>
        <div class="pt-4">
          <a href="#open-positions" class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full bg-gradient-to-r from-accent-red to-brand-red hover:to-accent-red text-white text-sm font-bold uppercase tracking-wider transition-all duration-300 shadow-lg shadow-accent-red/30">
            <?php _e('Xem vị trí đang tuyển', 'hacoled'); ?> <i class="ph-bold ph-arrow-down"></i>
          </a>
        </div>
      </div>

      <!-- Right side: Hero Image -->
      <div class="lg:col-span-6 relative group gsap-reveal" data-direction="right" data-delay="0.3">
        <div class="absolute -inset-1 bg-gradient-to-r from-accent-red to-accent-gold rounded-3xl blur opacity-20 group-hover:opacity-40 transition-opacity duration-500"></div>
        <div class="relative w-full rounded-3xl overflow-hidden border border-white/40 bg-white aspect-[4/3] shadow-2xl">
          <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80" 
               alt="Gia nhập HacoLED" 
               class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
        </div>
        
        <!-- Floating Stat -->
        <div class="absolute -bottom-6 -left-6 p-5 rounded-2xl glass-card border border-white/60 shadow-xl bg-white/90 backdrop-blur-md hidden sm:block">
          <div class="text-3xl font-black text-brand-red font-mono">100+</div>
          <div class="text-xs font-bold text-slate-700 uppercase tracking-widest mt-1">Thành viên ưu tú</div>
        </div>
      </div>

    </div>

    <!-- SECTION 2: TẠI SAO CHỌN HACOLED? -->
    <div class="mb-24 border-b border-slate-200 pb-20">
      <div class="text-center max-w-2xl mx-auto mb-14 gsap-reveal" data-direction="up" data-delay="0.1">
        <span class="block text-[10px] font-bold text-accent-red uppercase tracking-widest font-mono mb-1"><?php _e('VĂN HOÁ & MÔI TRƯỜNG', 'hacoled'); ?></span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-wide uppercase relative inline-block">
          <?php _e('Tại sao chọn HacoLED?', 'hacoled'); ?>
          <div class="absolute left-1/2 -translate-x-1/2 -bottom-2 w-2/3 h-0.5 bg-gradient-to-r from-accent-red to-accent-gold"></div>
        </h2>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Perk 1 -->
        <div class="p-8 rounded-3xl glass-card border border-slate-200 hover:border-brand-red/30 transition-all duration-300 bg-white/60 group gsap-reveal" data-direction="up" data-delay="0.2">
          <div class="w-14 h-14 bg-red-50 text-brand-red rounded-2xl flex items-center justify-center mb-6 border border-brand-red/10 group-hover:-translate-y-2 transition-transform duration-300 shadow-sm">
            <i class="ph-fill ph-rocket-launch text-3xl"></i>
          </div>
          <h3 class="text-lg font-extrabold text-slate-900 mb-3"><?php _e('Phát triển thần tốc', 'hacoled'); ?></h3>
          <p class="text-slate-600 text-sm leading-relaxed font-light"><?php _e('Môi trường làm việc năng động, lộ trình thăng tiến rõ ràng, được làm việc trực tiếp với các chuyên gia kỹ thuật AV Pro hàng đầu.', 'hacoled'); ?></p>
        </div>
        
        <!-- Perk 2 -->
        <div class="p-8 rounded-3xl glass-card border border-slate-200 hover:border-brand-gold/30 transition-all duration-300 bg-white/60 group gsap-reveal" data-direction="up" data-delay="0.3">
          <div class="w-14 h-14 bg-amber-50 text-brand-gold rounded-2xl flex items-center justify-center mb-6 border border-brand-gold/10 group-hover:-translate-y-2 transition-transform duration-300 shadow-sm">
            <i class="ph-fill ph-coins text-3xl"></i>
          </div>
          <h3 class="text-lg font-extrabold text-slate-900 mb-3"><?php _e('Đãi ngộ cạnh tranh', 'hacoled'); ?></h3>
          <p class="text-slate-600 text-sm leading-relaxed font-light"><?php _e('Lương thưởng xứng đáng với năng lực, thưởng dự án lớn, tháng lương thứ 13 và đầy đủ chế độ BHXH, BHYT theo luật lao động hiện hành.', 'hacoled'); ?></p>
        </div>
        
        <!-- Perk 3 -->
        <div class="p-8 rounded-3xl glass-card border border-slate-200 hover:border-green-500/30 transition-all duration-300 bg-white/60 group gsap-reveal" data-direction="up" data-delay="0.4">
          <div class="w-14 h-14 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mb-6 border border-green-500/10 group-hover:-translate-y-2 transition-transform duration-300 shadow-sm">
            <i class="ph-fill ph-users-three text-3xl"></i>
          </div>
          <h3 class="text-lg font-extrabold text-slate-900 mb-3"><?php _e('Văn hoá gắn kết', 'hacoled'); ?></h3>
          <p class="text-slate-600 text-sm leading-relaxed font-light"><?php _e('Du lịch, Teambuilding thường niên. Môi trường làm việc cởi mở, khuyến khích sáng tạo và tôn trọng sự khác biệt của mỗi cá nhân.', 'hacoled'); ?></p>
        </div>
      </div>
    </div>

    <!-- SECTION 3: CÁC VỊ TRÍ ĐANG TUYỂN -->
    <div id="open-positions" class="max-w-4xl mx-auto">
      <div class="text-center mb-14 gsap-reveal" data-direction="up" data-delay="0.1">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-wide uppercase relative inline-block">
          <?php _e('Vị trí đang tuyển dụng', 'hacoled'); ?>
          <div class="absolute left-1/2 -translate-x-1/2 -bottom-2 w-2/3 h-0.5 bg-gradient-to-r from-accent-red to-accent-gold"></div>
        </h2>
      </div>

      <?php
      // Query for all jobs using Custom Post Type
      $jobs_query = new WP_Query([
          'post_type' => 'job',
          'posts_per_page' => -1,
          'post_status' => 'publish'
      ]);

      if ($jobs_query->have_posts()) :
          $grouped_jobs = [];
          
          while ($jobs_query->have_posts()) : $jobs_query->the_post();
              $dept = get_post_meta(get_the_ID(), 'job_department', true);
              if (empty($dept)) $dept = 'Phòng ban khác';
              $grouped_jobs[$dept][] = [
                  'id' => get_the_ID(),
                  'title' => get_the_title(),
                  'link' => get_permalink(),
                  'location' => get_post_meta(get_the_ID(), 'job_location', true) ?: 'Hà Nội / TP. HCM',
                  'type' => get_post_meta(get_the_ID(), 'job_type', true) ?: 'Toàn thời gian',
                  'salary' => get_post_meta(get_the_ID(), 'job_salary', true) ?: 'Thỏa thuận',
              ];
          endwhile;
          wp_reset_postdata();

          // Loop through each department group
          $delay = 0.2;
          foreach ($grouped_jobs as $dept_name => $jobs) :
      ?>
      <div class="mb-12 gsap-reveal" data-direction="up" data-delay="<?php echo $delay; ?>">
        <h3 class="text-lg font-extrabold text-slate-800 mb-6 flex items-center gap-3">
          <span class="w-8 h-8 rounded-full bg-brand-red/10 border border-brand-red/20 text-brand-red flex items-center justify-center">
            <i class="ph-fill ph-briefcase"></i>
          </span>
          <?php echo esc_html($dept_name); ?>
        </h3>
        
        <div class="space-y-4">
          <?php foreach ($jobs as $job) : ?>
          <a href="<?php echo esc_url($job['link']); ?>" class="block glass-card bg-white/80 border border-slate-200 p-6 md:p-8 rounded-2xl hover:border-brand-red/50 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
              
              <div class="flex-1">
                <h4 class="text-xl font-bold text-slate-900 group-hover:text-brand-red mb-3 transition-colors"><?php echo esc_html($job['title']); ?></h4>
                <div class="flex flex-wrap items-center gap-y-3 gap-x-6 text-sm text-slate-500 font-medium">
                  <span class="flex items-center gap-1.5"><i class="ph-bold ph-map-pin text-slate-400"></i> <?php echo esc_html($job['location']); ?></span>
                  <span class="flex items-center gap-1.5"><i class="ph-bold ph-clock text-slate-400"></i> <?php echo esc_html($job['type']); ?></span>
                  <span class="flex items-center gap-1.5 text-green-600"><i class="ph-bold ph-money text-green-500"></i> <?php echo esc_html($job['salary']); ?></span>
                </div>
              </div>

              <div class="shrink-0 flex items-center justify-center bg-slate-100 text-slate-600 px-6 py-3 rounded-full text-sm font-bold group-hover:bg-brand-red group-hover:text-white transition-colors duration-300 self-start md:self-auto">
                <?php _e('Chi tiết', 'hacoled'); ?> <i class="ph-bold ph-arrow-right ml-1.5"></i>
              </div>

            </div>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php 
          $delay += 0.1;
          endforeach; 
      else : 
      ?>
      <div class="text-center p-12 glass-card rounded-3xl border border-slate-200 bg-white/50">
        <div class="w-16 h-16 mx-auto bg-slate-100 rounded-full flex items-center justify-center text-slate-400 mb-4">
          <i class="ph-fill ph-magnifying-glass text-2xl"></i>
        </div>
        <h4 class="text-lg font-bold text-slate-800 mb-2">Chưa có vị trí tuyển dụng mới</h4>
        <p class="text-sm text-slate-500">Hiện tại HacoLED chưa mở đợt tuyển dụng mới. Vui lòng theo dõi hoặc quay lại sau nhé!</p>
      </div>
      <?php endif; ?>
    </div>

  </div>
</main>

<?php $this->renderFooter($footer_type ?? 'default'); ?>
