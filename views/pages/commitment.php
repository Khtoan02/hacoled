<?php
/**
 * Service Quality Commitment View Template
 *
 * @var array  $page
 * @var string $header_type
 * @var string $footer_type
 */

$this->renderHeader($header_type ?? 'default');
?>

<!-- Premium Commitment Page Wrapper (Light Theme with Brand Accents) -->
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

    <!-- SECTION 1: HERO TITLE & INTRODUCTION -->
    <div class="max-w-3xl mx-auto text-center mb-16 space-y-6 gsap-reveal" data-direction="up" data-delay="0.2">
      <div class="w-16 h-1 bg-gradient-to-r from-accent-red to-accent-gold rounded-full mx-auto"></div>
      <span class="block text-xs font-bold text-accent-red uppercase tracking-widest font-mono"><?php _e('GIÁ TRỊ NIỀM TIN', 'hacoled'); ?></span>
      <h1 class="text-3xl sm:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight uppercase">
        <?php echo esc_html($page['title']); ?>
      </h1>
      <div class="text-slate-650 text-sm sm:text-base leading-relaxed space-y-4 font-light">
        <p>
          <?php _e('Công ty Cổ phần Công nghệ Haco Việt Nam rất vinh dự khi được phục vụ và đồng hành cùng quý khách hàng. Tại đây, chúng tôi cam kết mang đến cho quý khách hàng những trải nghiệm tuyệt vời nhất với ba tiêu chí cốt lõi: Tận Tâm, Nhanh Chóng và Trọn Vẹn.', 'hacoled'); ?>
        </p>
        <p>
          <?php _e('Chúng tôi luôn đặt niềm tin và sự hài lòng của khách hàng lên hàng đầu, và với cam kết của mình, HacoLED sẽ nỗ lực hết mình để đáp ứng và vượt qua mọi mong đợi của quý khách hàng.', 'hacoled'); ?>
        </p>
      </div>
    </div>

    <!-- SECTION 2: 3 TIÊU CHÍ LỚN (3T GRID) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-20">
      
      <!-- Tiêu chí 1: Tận Tâm -->
      <div class="p-8 sm:p-10 rounded-3xl glass-card border border-slate-200 bg-white/70 shadow-lg hover:shadow-xl hover:border-accent-red/30 transition-all duration-355 flex flex-col justify-between gsap-reveal" data-direction="up" data-delay="0.2">
        <div class="space-y-6">
          <div class="w-16 h-16 rounded-2xl bg-accent-red/10 flex items-center justify-center border border-accent-red/20 text-accent-red">
            <i class="ph-fill ph-hand-heart text-3xl"></i>
          </div>
          <div>
            <span class="block text-xs font-bold text-accent-red font-mono uppercase tracking-wider mb-1">01. DEDICATION</span>
            <h2 class="text-2xl font-black text-slate-900 tracking-wide"><?php _e('Tận Tâm', 'hacoled'); ?></h2>
          </div>
          <div class="space-y-5 text-sm text-slate-650 leading-relaxed font-light">
            <div class="space-y-2">
              <h3 class="font-bold text-slate-900 flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-accent-red rounded-full"></span>
                <?php _e('Tâm huyết', 'hacoled'); ?>
              </h3>
              <p class="pl-3.5 text-xs text-slate-500">
                <?php _e('Chúng tôi có đội ngũ nhân viên nhiệt tình và tâm huyết với công việc, đảm bảo sự hài lòng và tin tưởng của khách hàng.', 'hacoled'); ?>
              </p>
            </div>
            <div class="space-y-2">
              <h3 class="font-bold text-slate-900 flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-accent-red rounded-full"></span>
                <?php _e('Hỗ trợ', 'hacoled'); ?>
              </h3>
              <p class="pl-3.5 text-xs text-slate-500">
                <?php _e('Chúng tôi sẵn sàng lắng nghe và hỗ trợ khách hàng trong mọi thời điểm, đem đến trải nghiệm dịch vụ tốt nhất cho khách hàng.', 'hacoled'); ?>
              </p>
            </div>
          </div>
        </div>
        <div class="pt-8 border-t border-slate-100 mt-8">
          <span class="text-xs font-semibold text-accent-red uppercase tracking-wider flex items-center gap-1.5">
            <?php _e('Lấy khách hàng làm trọng tâm', 'hacoled'); ?>
          </span>
        </div>
      </div>

      <!-- Tiêu chí 2: Nhanh Chóng -->
      <div class="p-8 sm:p-10 rounded-3xl glass-card border border-slate-200 bg-white/70 shadow-lg hover:shadow-xl hover:border-accent-gold/30 transition-all duration-355 flex flex-col justify-between gsap-reveal" data-direction="up" data-delay="0.3">
        <div class="space-y-6">
          <div class="w-16 h-16 rounded-2xl bg-accent-gold/10 flex items-center justify-center border border-accent-gold/20 text-accent-gold">
            <i class="ph-fill ph-lightning text-3xl"></i>
          </div>
          <div>
            <span class="block text-xs font-bold text-accent-gold font-mono uppercase tracking-wider mb-1">02. VELOCITY</span>
            <h2 class="text-2xl font-black text-slate-900 tracking-wide"><?php _e('Nhanh Chóng', 'hacoled'); ?></h2>
          </div>
          <div class="space-y-5 text-sm text-slate-650 leading-relaxed font-light">
            <div class="space-y-2">
              <h3 class="font-bold text-slate-900 flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-accent-gold rounded-full"></span>
                <?php _e('Phản hồi nhanh', 'hacoled'); ?>
              </h3>
              <p class="pl-3.5 text-xs text-slate-500">
                <?php _e('Chúng tôi cam kết đáp ứng nhu cầu và yêu cầu của khách hàng trong thời gian ngắn nhất, đảm bảo thời gian phản hồi và xử lý yêu cầu của khách hàng nhanh chóng và hiệu quả.', 'hacoled'); ?>
              </p>
            </div>
            <div class="space-y-2">
              <h3 class="font-bold text-slate-900 flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-accent-gold rounded-full"></span>
                <?php _e('Phục vụ 24/7', 'hacoled'); ?>
              </h3>
              <p class="pl-3.5 text-xs text-slate-500">
                <?php _e('Chúng tôi sẵn sàng phục vụ khách hàng bất kỳ lúc nào trong ngày, đem đến sự tiện lợi và thoải mái cho khách hàng.', 'hacoled'); ?>
              </p>
            </div>
          </div>
        </div>
        <div class="pt-8 border-t border-slate-100 mt-8">
          <span class="text-xs font-semibold text-accent-gold uppercase tracking-wider flex items-center gap-1.5">
            <?php _e('Đáp ứng tức thì 24/7', 'hacoled'); ?>
          </span>
        </div>
      </div>

      <!-- Tiêu chí 3: Trọn Vẹn -->
      <div class="p-8 sm:p-10 rounded-3xl glass-card border border-slate-200 bg-white/70 shadow-lg hover:shadow-xl hover:border-green-500/30 transition-all duration-355 flex flex-col justify-between gsap-reveal" data-direction="up" data-delay="0.4">
        <div class="space-y-6">
          <div class="w-16 h-16 rounded-2xl bg-green-500/10 flex items-center justify-center border border-green-500/20 text-green-500">
            <i class="ph-fill ph-circle-wavy-check text-3xl"></i>
          </div>
          <div>
            <span class="block text-xs font-bold text-green-500 font-mono uppercase tracking-wider mb-1">03. INTEGRITY</span>
            <h2 class="text-2xl font-black text-slate-900 tracking-wide"><?php _e('Trọn Vẹn', 'hacoled'); ?></h2>
          </div>
          <div class="space-y-5 text-sm text-slate-650 leading-relaxed font-light">
            <div class="space-y-2">
              <h3 class="font-bold text-slate-900 flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                <?php _e('Đầy đủ', 'hacoled'); ?>
              </h3>
              <p class="pl-3.5 text-xs text-slate-500">
                <?php _e('Chúng tôi cam kết đem đến cho khách hàng những dịch vụ và sản phẩm đầy đủ và chính xác, đảm bảo mọi thủ tục trong hợp đồng được thực hiện đầy đủ.', 'hacoled'); ?>
              </p>
            </div>
            <div class="space-y-2">
              <h3 class="font-bold text-slate-900 flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                <?php _e('Chất lượng', 'hacoled'); ?>
              </h3>
              <p class="pl-3.5 text-xs text-slate-500">
                <?php _e('Chúng tôi đảm bảo mọi quy trình và tiêu chuẩn được thực hiện theo đúng hợp đồng, đem đến sự hài lòng và tin tưởng cho khách hàng về chất lượng dịch vụ và sản phẩm.', 'hacoled'); ?>
              </p>
            </div>
          </div>
        </div>
        <div class="pt-8 border-t border-slate-100 mt-8">
          <span class="text-xs font-semibold text-green-500 uppercase tracking-wider flex items-center gap-1.5">
            <?php _e('Chuẩn mực chất lượng CO/CQ', 'hacoled'); ?>
          </span>
        </div>
      </div>

    </div>

    <!-- SECTION 3: BOTTOM SLOGAN & PARTNERSHIP -->
    <div class="max-w-4xl mx-auto border-t border-slate-200 pt-16 flex flex-col md:flex-row items-center gap-12 gsap-reveal" data-direction="up" data-delay="0.2">
      <div class="md:w-1/2 space-y-4">
        <h3 class="text-2xl font-extrabold text-slate-900 leading-tight">
          <?php _e('Đối tác tin cậy - Đồng hành bền vững', 'hacoled'); ?>
        </h3>
        <p class="text-slate-650 text-sm leading-relaxed font-light">
          <?php _e('Với đội ngũ nhân viên giàu kinh nghiệm và tâm huyết, HacoLED tự hào mang đến cho khách hàng những dịch vụ và sản phẩm màn hình LED, màn hình ghép chất lượng nhất, đáp ứng trọn vẹn mọi yêu cầu kỹ thuật khắt khe.', 'hacoled'); ?>
        </p>
      </div>
      <div class="md:w-1/2 p-8 rounded-3xl bg-[#4A0505] text-white space-y-6 relative overflow-hidden shadow-xl">
        <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
        <div class="relative z-10 space-y-3">
          <span class="text-xs font-bold text-accent-gold uppercase tracking-widest font-mono"><?php _e('KẾT NỐI NGAY', 'hacoled'); ?></span>
          <p class="text-xs text-slate-300 font-light leading-relaxed">
            <?php _e('Hãy để chúng tôi trở thành đối tác tin cậy của quý khách hàng và cùng nhau xây dựng một tương lai thành công và bền vững.', 'hacoled'); ?>
          </p>
          <div class="flex flex-wrap items-center gap-4 pt-3">
            <a href="<?php echo esc_url(home_url('/lien-he/')); ?>" class="inline-flex items-center gap-1.5 px-6 py-3 rounded-full bg-gradient-to-r from-accent-gold to-yellow-500 text-primary-dark font-extrabold text-xs uppercase tracking-wider transition-all duration-300 shadow-md">
              <?php _e('Liên hệ ngay', 'hacoled'); ?>
              <i class="ph-bold ph-arrow-right text-[10px]"></i>
            </a>
            <a href="tel:0342324488" class="inline-flex items-center gap-2 text-white font-bold text-xs uppercase hover:underline">
              <i class="ph-fill ph-phone-call text-[13px]"></i>
              <span>034.232.4488</span>
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
