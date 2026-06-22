<?php
/**
 * View: Job Detail (Chi tiết Tuyển dụng)
 */
?>

<?php $this->renderHeader($header_type ?? 'default'); ?>

<main class="relative bg-brand-bg pt-28 md:pt-48 pb-24 overflow-hidden min-h-[80vh]">
  
  <!-- Glowing Background Orbs -->
  <div class="glow-gold -top-20 -right-20 opacity-10"></div>
  <div class="glow-red bottom-10 left-10 opacity-5"></div>

  <!-- Dong Son drum watermark -->

  <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10 flex flex-col lg:flex-row gap-10">
    
    <!-- Main Content -->
    <div class="lg:w-2/3">
      
      <!-- Breadcrumbs -->
      <nav aria-label="Breadcrumb" class="gsap-reveal mb-8 text-xs font-semibold text-slate-400 uppercase tracking-widest flex items-center gap-2 flex-wrap" data-direction="up" data-delay="0.1">
        <span>
          <a href="<?php echo esc_url(home_url('/')); ?>" class="text-slate-500 hover:text-accent-gold transition-colors">
            <?php _e('Trang chủ', 'hacoled'); ?>
          </a>
        </span>
        <span class="text-slate-400">/</span>
        <span>
          <a href="<?php echo esc_url(home_url('/tuyen-dung/')); ?>" class="text-slate-500 hover:text-accent-gold transition-colors">
            <?php _e('Tuyển dụng', 'hacoled'); ?>
          </a>
        </span>
        <span class="text-slate-400">/</span>
        <span>
          <span class="text-slate-650"><?php echo esc_html(get_the_title()); ?></span>
        </span>
      </nav>

      <?php
        // Get custom fields or use fallbacks
        $post_id = get_the_ID();
        $job_department = get_post_meta($post_id, 'job_department', true) ?: 'Phòng ban chuyên môn';
        $job_location = get_post_meta($post_id, 'job_location', true) ?: 'Hà Nội / TP. HCM';
        $job_type = get_post_meta($post_id, 'job_type', true) ?: 'Toàn thời gian';
        $job_salary = get_post_meta($post_id, 'job_salary', true) ?: 'Thỏa thuận';
      ?>
      
      <!-- Job Header Info -->
      <div class="glass-card bg-white/90 p-8 md:p-10 rounded-3xl shadow-lg border border-slate-200 mb-10 relative overflow-hidden gsap-reveal" data-direction="up" data-delay="0.2">
        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-accent-red to-brand-gold"></div>
        <div class="absolute -right-12 -top-12 w-40 h-40 bg-accent-red/5 rounded-full blur-3xl"></div>

        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-brand-red/10 text-brand-red rounded-full text-xs font-bold uppercase tracking-widest mb-6 border border-brand-red/10">
          <i class="ph-fill ph-briefcase"></i> <?php echo esc_html($job_department); ?>
        </div>
        
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-slate-900 mb-8 leading-tight tracking-tight"><?php the_title(); ?></h1>
        
        <div class="flex flex-wrap items-center gap-y-4 gap-x-8 text-sm text-slate-600 font-medium border-t border-slate-200/60 pt-6">
          <div class="flex items-center gap-2.5">
            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 border border-slate-200"><i class="ph-bold ph-map-pin text-lg"></i></div>
            <span class="font-semibold text-slate-700"><?php echo esc_html($job_location); ?></span>
          </div>
          <div class="flex items-center gap-2.5">
            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 border border-slate-200"><i class="ph-bold ph-clock text-lg"></i></div>
            <span class="font-semibold text-slate-700"><?php echo esc_html($job_type); ?></span>
          </div>
          <div class="flex items-center gap-2.5">
            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-green-600 border border-green-100"><i class="ph-bold ph-money text-lg"></i></div>
            <span class="text-green-600 font-extrabold text-base"><?php echo esc_html($job_salary); ?></span>
          </div>
        </div>
      </div>

      <!-- Job Description (Dynamic Content) -->
      <div class="glass-card bg-white/80 p-8 md:p-12 rounded-3xl shadow-md border border-slate-200 prose prose-slate max-w-none prose-headings:text-slate-800 prose-headings:font-extrabold prose-a:text-brand-red hover:prose-a:text-accent-red prose-li:text-slate-600 prose-p:text-slate-600 prose-p:leading-relaxed prose-p:font-light gsap-reveal" data-direction="up" data-delay="0.3">
        <?php 
          $content = get_the_content();
          if (empty(trim($content))) {
            echo '<h3>Mô tả công việc</h3><p>Vui lòng cập nhật nội dung chi tiết của vị trí tuyển dụng này trong trình soạn thảo của WordPress.</p>';
          } else {
            the_content();
          }
        ?>
      </div>
      
      <!-- Social Share -->
      <div class="mt-8 flex items-center gap-4 gsap-reveal" data-direction="up" data-delay="0.4">
        <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Chia sẻ tin này:</span>
        <div class="flex gap-2">
          <a href="#" class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-brand-red hover:border-brand-red transition-colors"><i class="ph-fill ph-facebook-logo text-xl"></i></a>
          <a href="#" class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-blue-500 hover:border-blue-500 transition-colors"><i class="ph-fill ph-linkedin-logo text-xl"></i></a>
          <a href="#" class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-slate-900 hover:border-slate-900 transition-colors"><i class="ph-bold ph-link text-xl"></i></a>
        </div>
      </div>

    </div>

    <!-- Application Form Sidebar -->
    <div class="lg:w-1/3">
      <div class="sticky top-28 p-8 rounded-3xl glass-card bg-white/90 shadow-2xl border border-brand-red/10 relative overflow-hidden gsap-reveal" data-direction="left" data-delay="0.4">
        <div class="absolute inset-0 bg-grid-pattern opacity-5 pointer-events-none"></div>
        <div class="relative z-10">
          <div class="mb-8">
            <span class="block text-[10px] font-bold text-accent-red uppercase tracking-widest font-mono mb-2"><?php _e('GỬI HỒ SƠ ỨNG TUYỂN', 'hacoled'); ?></span>
            <h3 class="text-2xl font-extrabold text-slate-900 mb-2">Gia nhập HacoLED</h3>
            <p class="text-sm text-slate-500 font-light">Hãy điền thông tin bên dưới để gửi CV của bạn trực tiếp đến Bộ phận Tuyển dụng.</p>
          </div>

          <form class="space-y-5" onsubmit="event.preventDefault(); alert('Cảm ơn bạn đã ứng tuyển! Chúng tôi sẽ liên hệ lại sớm nhất.');">
            
            <div>
              <label class="block text-[13px] font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Họ và tên <span class="text-accent-red">*</span></label>
              <input type="text" required placeholder="Nhập họ và tên của bạn" class="w-full px-4 py-3 rounded-xl bg-slate-50/50 border border-slate-200 focus:bg-white focus:border-brand-red focus:ring-4 focus:ring-brand-red/10 outline-none transition-all text-sm text-slate-800 placeholder:text-slate-400">
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-[13px] font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Số điện thoại <span class="text-accent-red">*</span></label>
                <input type="tel" required placeholder="09xx..." class="w-full px-4 py-3 rounded-xl bg-slate-50/50 border border-slate-200 focus:bg-white focus:border-brand-red focus:ring-4 focus:ring-brand-red/10 outline-none transition-all text-sm text-slate-800 placeholder:text-slate-400">
              </div>
              <div>
                <label class="block text-[13px] font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Email <span class="text-accent-red">*</span></label>
                <input type="email" required placeholder="email@..." class="w-full px-4 py-3 rounded-xl bg-slate-50/50 border border-slate-200 focus:bg-white focus:border-brand-red focus:ring-4 focus:ring-brand-red/10 outline-none transition-all text-sm text-slate-800 placeholder:text-slate-400">
              </div>
            </div>

            <div>
              <label class="block text-[13px] font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Vị trí ứng tuyển <span class="text-accent-red">*</span></label>
              <div class="relative">
                <input type="text" readonly value="<?php echo esc_attr(get_the_title()); ?>" class="w-full px-4 py-3 rounded-xl bg-slate-100 border border-slate-200 text-slate-600 font-bold text-sm focus:outline-none cursor-not-allowed">
              </div>
            </div>

            <div>
              <label class="block text-[13px] font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Link CV / Portfolio <span class="text-accent-red">*</span></label>
              <input type="url" required placeholder="Google Drive, Behance, LinkedIn..." class="w-full px-4 py-3 rounded-xl bg-slate-50/50 border border-slate-200 focus:bg-white focus:border-brand-red focus:ring-4 focus:ring-brand-red/10 outline-none transition-all text-sm text-slate-800 placeholder:text-slate-400">
              <p class="text-[11px] text-slate-400 mt-2 font-light">Vui lòng đảm bảo link CV của bạn đã được bật quyền truy cập công khai (public).</p>
            </div>

            <div class="pt-2">
              <button type="submit" class="w-full flex items-center justify-center gap-2 py-4 rounded-xl bg-gradient-to-r from-accent-red to-brand-red hover:to-accent-red text-white font-bold text-[15px] uppercase tracking-wider transition-all duration-300 shadow-lg shadow-brand-red/20 hover:-translate-y-0.5">
                Nộp hồ sơ ứng tuyển
                <i class="ph-bold ph-paper-plane-right text-lg"></i>
              </button>
            </div>
            
          </form>
        </div>
      </div>
    </div>
    
  </div>
</main>

<?php $this->renderFooter($footer_type ?? 'default'); ?>
