<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preload" as="style"
    href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@200;300;400;500;600;700;900&family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap">
  <link
    href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@200;300;400;500;600;700;900&family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" media="print" onload="this.media='all'">
  <noscript>
    <link
      href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@200;300;400;500;600;700;900&family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap"
      rel="stylesheet">
  </noscript>



  <style>
    [x-cloak] {
      display: none !important;
    }

    /* Prevent home-critical.css from applying transform: translate(-50%, -50%) which misaligns the drum stamp on homepage */
    .hdr-logo-ds {
      transform: none !important;
    }

    php-block {
      display: none !important;
    }

    /* Custom Scrollbar Mobile */
    .mobile-scroll::-webkit-scrollbar {
      width: 4px;
    }

    .mobile-scroll::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.2);
      border-radius: 99px;
    }
  </style>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <php-block class="hidden">
    <?php
    $header_menu_configs = hacoled_header_menu_settings();
    $about_url = home_url('/gioi-thieu/');
    $services_url = home_url('/dich-vu/');
    $contact_url = home_url('/lien-he/');
    $news_url = home_url('/tin-tuc/');
    $posts_url = home_url('/bai-viet/');

    $about_page = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-about.php'));
    if (!empty($about_page))
      $about_url = get_permalink($about_page[0]->ID);

    $services_page = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-services.php'));
    if (!empty($services_page))
      $services_url = get_permalink($services_page[0]->ID);

    $contact_page = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-contact.php'));
    if (!empty($contact_page))
      $contact_url = get_permalink($contact_page[0]->ID);

    $custom_logo_id = get_theme_mod('custom_logo');
    $logo = $custom_logo_id ? wp_get_attachment_image_url($custom_logo_id, 'full') : home_url('/wp-content/uploads/2026/06/HacoLED-Logo-Moi.png');
    $showcase_led = get_template_directory_uri() . '/assets/images/showcase-led.png';
    $showcase_audio = get_template_directory_uri() . '/assets/images/showcase-audio.png';

    $led_cat = get_category_by_slug('blog-man-hinh-led');
    $led_url = $led_cat ? get_category_link($led_cat->term_id) : home_url('/blog-man-hinh-led/');

    $audio_cat = get_category_by_slug('blog-am-thanh');
    $audio_url = $audio_cat ? get_category_link($audio_cat->term_id) : home_url('/blog-am-thanh/');

    $tech_cat = get_category_by_slug('huong-dan-ky-thuat');
    $tech_url = $tech_cat ? get_category_link($tech_cat->term_id) : home_url('/kien-thuc-ky-thuat/');

    $news_cat = get_category_by_slug('tin-tuc');
    $news_url = $news_cat ? get_category_link($news_cat->term_id) : home_url('/tin-tuc/');

    $project_in_cat = get_category_by_slug('du-an-trong-nha');
    $project_in_url = $project_in_cat ? get_category_link($project_in_cat->term_id) : home_url('/du-an-trong-nha/');

    $project_out_cat = get_category_by_slug('du-an-ngoai-troi');
    $project_out_url = $project_out_cat ? get_category_link($project_out_cat->term_id) : home_url('/du-an-ngoai-troi/');

    $project_school_cat = get_category_by_slug('du-an-truong-hoc');
    $project_school_url = $project_school_cat ? get_category_link($project_school_cat->term_id) : home_url('/du-an-truong-hoc/');

    $project_videowall_cat = get_category_by_slug('du-an-man-hinh-ghep');
    $project_videowall_url = $project_videowall_cat ? get_category_link($project_videowall_cat->term_id) : home_url('/du-an-man-hinh-ghep/');

    $project_audio_cat = get_category_by_slug('du-an-am-thanh');
    $project_audio_url = $project_audio_cat ? get_category_link($project_audio_cat->term_id) : home_url('/du-an-am-thanh/');
    ?>
  </php-block>

  <!-- ═══════════════════════════════════════════════════════════
     SITE HEADER – Premium V7 (Visual Rich Mega Menus)
     ═══════════════════════════════════════════════════════════ -->
  <header id="site-header" x-data="{ mobile: false, scrolled: false }" @scroll.window="scrolled = (window.scrollY > 80)"
    class="site-header fixed top-0 left-0 z-[200] w-full transition-transform duration-500 ease-out"
    :class="scrolled ? 'translate-y-[-1px] is-scrolled' : ''">

    <div class="haco-desktop-navigation hidden lg:block">

      <!-- ══ Sắc nét Gold Line ══ -->
      <div class="h-[4px] w-full relative z-20 haco-gold-line"></div>

      <!-- ══ KHỐI NỀN ĐỎ NGUYÊN KHỐI (MONOLITHIC WRAPPER - WITHOUT OVERFLOW-HIDDEN) ══ -->
      <div class="w-full relative">

        <!-- LỚP NỀN VÀ TRỐNG ĐỒNG BỊ CẮT BỞI OVERFLOW-HIDDEN -->
        <div class="absolute inset-0 haco-brand-shell overflow-hidden pointer-events-none z-0">
          <!-- Pattern chìm cực kỳ tinh tế -->
          <div class="absolute inset-0 opacity-[0.06]"
            style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 24px 24px;">
          </div>

          <!-- Trống đồng — JS auto-center theo logo, clipped bởi overflow-hidden -->
          <div id="hdr-drum-stamp" class="hdr-logo-ds" style="position:absolute;"></div>
        </div>

        <!-- ══ BREAKING NEWS TICKER (Top Header Bar — inside red wrapper) ══ -->
        <div class="w-full relative z-10 py-1.5 border-b border-white/10" x-show="!scrolled"
          x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 max-h-10"
          x-transition:leave-end="opacity-0 max-h-0">
          <div
            class="max-w-[1440px] mx-auto px-4 lg:px-8 flex items-center justify-between gap-4 text-[11px] text-white/90 font-medium">
            <div class="flex items-center gap-2 shrink-0 text-white/60">
              <i class="ph-bold ph-calendar text-[11px]"></i>
              <span><?php echo date_i18n('l, d/m/Y'); ?></span>
            </div>
            <div class="flex-1 overflow-hidden relative flex items-center gap-3">
              <span
                class="bg-white/15 text-white px-2 py-0.5 rounded text-[8px] font-extrabold uppercase tracking-wider shrink-0 animate-pulse border border-white/20">Tin
                Mới</span>
              <div class="relative w-full overflow-hidden h-4">
                <div class="absolute whitespace-nowrap animate-marquee flex gap-12 text-white/80">
                  <span>🔥 Dự án tiêu biểu: Lắp đặt 150m² màn hình LED P1.5 tại CT Cổ Phần Đầu Tư FORTUNE</span>
                  <span>🔥 Báo chí: VnExpress vinh danh HacoLED là Thương hiệu AV Pro Xuất sắc nhất năm 2025</span>
                  <span>🔥 Tuyển dụng gấp: Kỹ sư lắp đặt màn hình LED & Âm thanh ánh sáng tại HN & HCM</span>
                  <span>🔥 Dự án tiêu biểu: Lắp đặt 150m² màn hình LED P1.5 tại CT Cổ Phần Đầu Tư FORTUNE</span>
                  <span>🔥 Báo chí: VnExpress vinh danh HacoLED là Thương hiệu AV Pro Xuất sắc nhất năm 2025</span>
                  <span>🔥 Tuyển dụng gấp: Kỹ sư lắp đặt màn hình LED & Âm thanh ánh sáng tại HN & HCM</span>
                </div>
              </div>
            </div>
            <a href="tel:0342324488"
              class="shrink-0 text-[#fbbf24] hover:text-white flex items-center gap-1.5 font-bold text-[10px] uppercase tracking-wider">
              <i class="ph-fill ph-phone-call text-[11px]"></i> 034.232.4488
            </a>
          </div>
        </div>

        <!-- ── TOP BAR: Logo & Search ── -->
        <div id="hdr-top" class="w-full relative transition-all duration-300 ease-out py-3.5 lg:py-5"
          :class="scrolled ? 'lg:!py-0 lg:!h-0 lg:!opacity-0 lg:!pointer-events-none overflow-hidden !py-2' : 'py-3.5 lg:py-5'">

          <div
            class="max-w-[1440px] mx-auto px-4 lg:px-8 flex items-center justify-between gap-6 lg:gap-12 relative z-10">

            <!-- Logo -->
            <div class="hdr-logo" id="hdr-logo-el">
              <a href="<?php echo esc_url(home_url('/')); ?>" class="hdr-logo-link" aria-label="HacoLED">
                <img src="<?php echo esc_url($logo); ?>" alt="HacoLED" class="h-[72px] w-auto object-contain" />
              </a>
            </div>

            <!-- SEARCH BAR (Sleek Glassmorphism) -->
            <div class="hidden md:block flex-1 max-w-2xl">
              <form method="get" action="<?php echo esc_url(home_url('/')); ?>" role="search" class="relative group">
                <input type="search" name="s"
                  placeholder="<?php esc_attr_e('Tìm sản phẩm, giải pháp hiển thị, âm thanh...', 'hacoled'); ?>"
                  class="w-full rounded-full pl-12 pr-10 py-3 text-[13px] text-white placeholder-white/70 focus:outline-none transition-all duration-300 focus:bg-black/20 border border-white/20 focus:border-[#fbbf24]"
                  style="background: rgba(0, 0, 0, 0.12);" />
                <span
                  class="absolute left-4.5 top-1/2 -translate-y-1/2 text-white/60 group-hover:text-white transition-colors pointer-events-none">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.602 10.602z" />
                  </svg>
                </span>
                <span
                  class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] text-white/50 border border-white/30 rounded px-1.5 py-0.5 font-sans pointer-events-none group-focus-within:hidden">⌘K</span>
              </form>
            </div>

            <!-- HOTLINES -->
            <div class="hidden lg:flex items-center gap-6 ml-auto text-white flex-shrink-0">
              <!-- Kỹ thuật -->
              <a href="tel:0868474488" class="flex items-center gap-3 group">
                <div
                  class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 group-hover:bg-white group-hover:scale-105 border border-white/30"
                  style="background: rgba(255,255,255,0.1);">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white group-hover:text-[#b31217]"
                    fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z" />
                  </svg>
                </div>
                <div class="leading-tight">
                  <span class="block text-[9px] font-bold uppercase tracking-widest text-white/70">Kỹ thuật &
                    CSKH</span>
                  <span
                    class="block text-[14px] font-extrabold tracking-wide font-display group-hover:text-[#fbbf24] transition-colors">086.847.4488</span>
                </div>
              </a>

              <div class="w-[1px] h-8 bg-white/20"></div>

              <!-- Báo giá -->
              <a href="tel:0342324488" class="flex items-center gap-3 group">
                <div
                  class="w-10 h-10 rounded-full flex items-center justify-center relative transition-all duration-300 group-hover:scale-105 border border-[#fbbf24]/50"
                  style="background: rgba(251,191,36,0.15);">
                  <span class="absolute inset-0 rounded-full animate-ping opacity-30 bg-[#fbbf24]"></span>
                  <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4 text-[#fbbf24] relative z-10 group-hover:text-white" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.802-5.127-4.106-6.93-6.93l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25z" />
                  </svg>
                </div>
                <div class="leading-tight">
                  <span class="block text-[9px] font-bold uppercase tracking-widest text-[#fbbf24]">Hotline báo
                    giá</span>
                  <span
                    class="block text-[15px] font-extrabold tracking-wide text-white font-display">034.232.4488</span>
                </div>
              </a>
            </div>

            <!-- Mobile Toggle (Hidden in favor of bottom navigation bar) -->
            <button @click="mobile = !mobile" class="hidden">
              <svg x-show="!mobile" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
              </svg>
              <svg x-show="mobile" x-cloak class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
              </svg>
            </button>

          </div>
        </div>

        <!-- ── NAV BAR: BẮT ĐẦU TỪ TRÁI, GAP CỐ ĐỊNH CHUẨN PIXEL-PERFECT ── -->
        <nav id="hdr-nav" class="hidden lg:block w-full transition-all duration-300 relative z-20 pt-1 pb-3"
          :class="scrolled ? 'bg-haco-red shadow-lg !py-0' : 'pt-1 pb-3'">

          <div class="max-w-[1440px] mx-auto px-4 lg:px-8 flex items-center justify-start w-full relative">

            <!-- Compact Logo (Sticky mode) -->
            <div
              class="flex-shrink-0 transition-all duration-500 ease-in-out relative w-0 opacity-0 mr-0 pointer-events-none overflow-hidden"
              :class="scrolled ? '!w-[115px] xl:!w-[125px] !opacity-100 !mr-5 lg:!mr-8 !pointer-events-auto' : 'w-0 opacity-0 mr-0 pointer-events-none'">
              <div class="hdr-logo-ds"></div>
              <a href="<?php echo esc_url(home_url('/')); ?>" :tabindex="scrolled ? 0 : -1" class="block relative z-10">
                <img src="<?php echo esc_url($logo); ?>" alt="HacoLED" class="h-7 w-auto object-contain rounded" />
              </a>
            </div>

            <!-- ── NAV LINKS CONTAINER (Dàn đều cân bằng 2 bên lề) ── -->
            <div class="flex flex-1 items-center justify-between w-full transition-all duration-300">

              <!-- TRANG CHỦ -->
              <a href="<?php echo esc_url(home_url('/')); ?>" :class="scrolled ? 'py-4' : 'py-2'"
                class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
                <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none"
                  stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <?php echo esc_html(hacoled_header_menu_label('home')); ?>
                <span
                  class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-[#fbbf24] transition-all duration-300 group-hover:w-full"></span>
              </a>

              <!-- GIỚI THIỆU (DROPDOWN) -->
              <div class="relative group/navitem" x-data="{ open: false }" @mouseenter="open = true"
                @mouseleave="open = false">
                <a href="<?php echo esc_url(hacoled_header_menu_url('about')); ?>" :class="scrolled ? 'py-4' : 'py-2'"
                  class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
                  <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none"
                    stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                  </svg>
                  <?php echo esc_html(hacoled_header_menu_label('about')); ?>
                  <svg class="w-3 h-3 text-white/50 transition-transform"
                    :class="open ? 'rotate-180 text-[#fbbf24]' : 'group-hover:text-[#fbbf24]'" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                  </svg>
                  <span
                    class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] bg-[#fbbf24] transition-all duration-300"
                    :class="open ? 'w-full' : 'w-0 group-hover:w-full'"></span>
                </a>

                <!-- Dropdown Menu -->
                <div x-show="open" x-cloak @click.away="open = false"
                  x-transition:enter="transition ease-out duration-200"
                  x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                  x-transition:leave="transition ease-in duration-150"
                  x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
                  class="absolute top-full left-1/2 -translate-x-1/2 translate-y-[15px] w-64 bg-white rounded-2xl shadow-[0_20px_40px_-15px_rgba(0,0,0,0.1)] border border-slate-100/50 p-3 z-[150]">

                  <!-- Indicator arrow pointing up -->
                  <div
                    class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white rotate-45 border-l border-t border-slate-100/50">
                  </div>

                  <div class="relative z-10 flex flex-col space-y-1">
                    <a href="<?php echo esc_url($about_url); ?>"
                      class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors group/link">
                      <div
                        class="w-8 h-8 rounded-lg bg-red-50 text-[#b31217] flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                      </div>
                      <div
                        class="text-[13.5px] font-bold text-slate-700 group-hover/link:text-[#b31217] transition-colors whitespace-nowrap">
                        Giới thiệu chung</div>
                    </a>

                    <a href="<?php echo esc_url(home_url('/cam-ket-chat-luong/')); ?>"
                      class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors group/link">
                      <div
                        class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                      </div>
                      <div
                        class="text-[13.5px] font-bold text-slate-700 group-hover/link:text-[#b31217] transition-colors whitespace-nowrap">
                        Cam kết chất lượng</div>
                    </a>

                    <a href="<?php echo esc_url(home_url('/tuyen-dung/')); ?>"
                      class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors group/link">
                      <div
                        class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                      </div>
                      <div
                        class="text-[13.5px] font-bold text-slate-700 group-hover/link:text-[#b31217] transition-colors whitespace-nowrap">
                        Tuyển dụng</div>
                    </a>

                    <a href="<?php echo esc_url(home_url('/su-kien/')); ?>"
                      class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors group/link">
                      <div
                        class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                      </div>
                      <div
                        class="text-[13.5px] font-bold text-slate-700 group-hover/link:text-[#b31217] transition-colors whitespace-nowrap">
                        Sự kiện</div>
                    </a>
                  </div>
                </div>
              </div>

              <!-- ── MÀN HÌNH LED (MEGA MENU TẠP CHÍ + ẢNH MỚI) ── -->
              <div class="navitem-relative group/navitem" x-data="{ open: false }" @mouseenter="open = true"
                @mouseleave="open = false">
                <a href="<?php echo esc_url(hacoled_header_menu_url('led')); ?>" :class="scrolled ? 'py-4' : 'py-2'"
                  class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
                  <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none"
                    stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h17.25c.621 0 1.125-.504 1.125-1.125V4.875c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125z" />
                  </svg>
                  <?php echo esc_html(hacoled_header_menu_label('led')); ?>
                  <svg class="w-3 h-3 text-white/50 transition-transform"
                    :class="open ? 'rotate-180 text-[#fbbf24]' : 'group-hover:text-[#fbbf24]'" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                  </svg>
                  <span
                    class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] bg-[#fbbf24] transition-all duration-300"
                    :class="open ? 'w-full' : 'w-0 group-hover:w-full'"></span>
                </a>

                <!-- Menu Nội Dung + Ảnh Dự Án Lớn -->
                <div x-show="open" x-cloak @click.away="open = false"
                  x-transition:enter="transition ease-out duration-200"
                  x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                  x-transition:leave="transition ease-in duration-150"
                  x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
                  class="mega-menu-wrapper">
                  <?php get_template_part('views/components/headers/mega/led'); ?>
                </div>
              </div>

              <!-- ── MÀN HÌNH GHÉP (MINI MEGA MENU) ── -->
              <div class="navitem-relative group/navitem" x-data="{ open: false }" @mouseenter="open = true"
                @mouseleave="open = false">
                <a href="<?php echo esc_url(hacoled_header_menu_url('videowall')); ?>" :class="scrolled ? 'py-4' : 'py-2'"
                  class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
                  <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none"
                    stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                  </svg>
                  <?php echo esc_html(hacoled_header_menu_label('videowall')); ?>
                  <svg class="w-3 h-3 text-white/50 transition-transform"
                    :class="open ? 'rotate-180 text-[#fbbf24]' : 'group-hover:text-[#fbbf24]'" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                  </svg>
                  <span
                    class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] bg-[#fbbf24] transition-all duration-300"
                    :class="open ? 'w-full' : 'w-0 group-hover:w-full'"></span>
                </a>

                <!-- Menu Nội Dung + Ảnh Dự Án Lớn -->
                <div x-show="open" x-cloak @click.away="open = false"
                  x-transition:enter="transition ease-out duration-200"
                  x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                  x-transition:leave="transition ease-in duration-150"
                  x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
                  class="mega-menu-wrapper mega-sm">
                  <?php get_template_part('views/components/headers/mega/videowall'); ?>
                </div>
              </div>

              <!-- ── GIẢI PHÁP (GRID LƯỚI HÌNH ẢNH CỰC ĐỈNH) ── -->
              <div class="navitem-relative group/navitem" x-data="{ open: false }" @mouseenter="open = true"
                @mouseleave="open = false">
                <a href="<?php echo esc_url(hacoled_header_menu_url('solutions')); ?>" :class="scrolled ? 'py-4' : 'py-2'"
                  class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
                  <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none"
                    stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.82 1.508-2.316a7.5 7.5 0 10-7.516 0c.85.496 1.508 1.333 1.508 2.316V18" />
                  </svg>
                  <?php echo esc_html(hacoled_header_menu_label('solutions')); ?>
                  <svg class="w-3 h-3 text-white/50 transition-transform"
                    :class="open ? 'rotate-180 text-[#fbbf24]' : 'group-hover:text-[#fbbf24]'" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                  </svg>
                  <span
                    class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] bg-[#fbbf24] transition-all duration-300"
                    :class="open ? 'w-full' : 'w-0 group-hover:w-full'"></span>
                </a>

                <!-- Menu Nội Dung + Ảnh Dự Án Lớn -->
                <div x-show="open" x-cloak @click.away="open = false"
                  x-transition:enter="transition ease-out duration-200"
                  x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                  x-transition:leave="transition ease-in duration-150"
                  x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
                  class="mega-menu-wrapper">
                  <?php get_template_part('views/components/headers/mega/solutions'); ?>
                </div>
              </div>

              <!-- ── ÂM THANH (BỔ SUNG VISUAL CARD BÊN PHẢI) ── -->
              <div class="navitem-relative group/navitem" x-data="{ open: false }" @mouseenter="open = true"
                @mouseleave="open = false">
                <a href="<?php echo esc_url(hacoled_header_menu_url('audio')); ?>" :class="scrolled ? 'py-4' : 'py-2'"
                  class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
                  <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none"
                    stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z" />
                  </svg>
                  <?php echo esc_html(hacoled_header_menu_label('audio')); ?>
                  <svg class="w-3 h-3 text-white/50 transition-transform"
                    :class="open ? 'rotate-180 text-[#fbbf24]' : 'group-hover:text-[#fbbf24]'" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                  </svg>
                  <span
                    class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] bg-[#fbbf24] transition-all duration-300"
                    :class="open ? 'w-full' : 'w-0 group-hover:w-full'"></span>
                </a>

                <!-- Menu Nội Dung + Ảnh Dự Án Lớn -->
                <div x-show="open" x-cloak @click.away="open = false"
                  x-transition:enter="transition ease-out duration-200"
                  x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                  x-transition:leave="transition ease-in duration-150"
                  x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
                  class="mega-menu-wrapper">
                  <?php get_template_part('views/components/headers/mega/audio'); ?>
                </div>
              </div>

              <!-- ── DỰ ÁN (CHUYỂN THÀNH MỘT LIST & ẢNH ĐẠI DIỆN LỚN) ── -->
              <div class="navitem-relative group/navitem" x-data="{ open: false }" @mouseenter="open = true"
                @mouseleave="open = false">
                <a href="<?php echo esc_url(hacoled_header_menu_url('projects')); ?>" :class="scrolled ? 'py-4' : 'py-2'"
                  class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
                  <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none"
                    stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                  </svg>
                  <?php echo esc_html(hacoled_header_menu_label('projects')); ?>
                  <svg class="w-3 h-3 text-white/50 transition-transform"
                    :class="open ? 'rotate-180 text-[#fbbf24]' : 'group-hover:text-[#fbbf24]'" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                  </svg>
                  <span
                    class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] bg-[#fbbf24] transition-all duration-300"
                    :class="open ? 'w-full' : 'w-0 group-hover:w-full'"></span>
                </a>

                <!-- Menu Nội Dung + Ảnh Dự Án Lớn -->
                <div x-show="open" x-cloak @click.away="open = false"
                  x-transition:enter="transition ease-out duration-200"
                  x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                  x-transition:leave="transition ease-in duration-150"
                  x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
                  class="mega-menu-wrapper mega-md">
                  <?php get_template_part('views/components/headers/mega/projects'); ?>
                </div>
              </div>

              <!-- DỊCH VỤ -->
              <a href="<?php echo esc_url($services_url); ?>" :class="scrolled ? 'py-4' : 'py-2'"
                class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
                <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none"
                  stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.827M11.42 15.17l2.492-3.396M11.42 15.17l-3.396 2.492m0-5.888l5.888-5.888a2.652 2.652 0 00-3.75-3.75l-5.888 5.888m7.5 7.5l-3.396 2.492m-5.888-5.888L2.25 17.25A2.652 2.652 0 006 21l5.827-5.877" />
                </svg>
                <?php echo esc_html(hacoled_header_menu_label('services')); ?>
                <span
                  class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-[#fbbf24] transition-all duration-300 group-hover:w-full"></span>
              </a>

              <!-- ── TIN TỨC & BLOG (Dropdown Drop) ── -->
              <div class="inline-block group/navitem relative" x-data="{ open: false }" @mouseenter="open = true"
                @mouseleave="open = false">
                <a href="<?php echo esc_url(hacoled_header_menu_url('news')); ?>" :class="scrolled ? 'py-4' : 'py-2'"
                  class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
                  <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none"
                    stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                  </svg>
                  <?php echo esc_html(hacoled_header_menu_label('news')); ?>
                  <svg class="w-3 h-3 text-white/50 transition-transform"
                    :class="open ? 'rotate-180 text-[#fbbf24]' : 'group-hover:text-[#fbbf24]'" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                  </svg>
                  <span
                    class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] bg-[#fbbf24] transition-all duration-300"
                    :class="open ? 'w-full' : 'w-0 group-hover:w-full'"></span>
                </a>

                <div x-show="open" x-cloak @click.away="open = false"
                  x-transition:enter="transition ease-out duration-200"
                  x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                  x-transition:leave="transition ease-in duration-150"
                  x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
                  class="absolute top-full left-1/2 -translate-x-1/2 translate-y-[15px] w-64 bg-white rounded-2xl shadow-[0_20px_40px_-15px_rgba(0,0,0,0.1)] border border-slate-100/50 p-3 z-[150]">

                  <!-- Indicator arrow pointing up -->
                  <div
                    class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white rotate-45 border-l border-t border-slate-100/50">
                  </div>

                  <div class="relative z-10 flex flex-col space-y-1">
                    <a href="<?php echo esc_url($led_url); ?>"
                      class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors group/link">
                      <div
                        class="w-8 h-8 rounded-lg bg-red-50 text-[#b31217] flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h17.25c.621 0 1.125-.504 1.125-1.125V4.875c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                      </div>
                      <div
                        class="text-[13.5px] font-bold text-slate-700 group-hover/link:text-[#b31217] transition-colors whitespace-nowrap">
                        Blog về màn hình LED</div>
                    </a>

                    <a href="<?php echo esc_url($audio_url); ?>"
                      class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors group/link">
                      <div
                        class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z" />
                        </svg>
                      </div>
                      <div
                        class="text-[13.5px] font-bold text-slate-700 group-hover/link:text-[#b31217] transition-colors whitespace-nowrap">
                        Blog về âm thanh</div>
                    </a>

                    <a href="<?php echo esc_url($tech_url); ?>"
                      class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors group/link">
                      <div
                        class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                      </div>
                      <div
                        class="text-[13.5px] font-bold text-slate-700 group-hover/link:text-[#b31217] transition-colors whitespace-nowrap">
                        Hướng dẫn kỹ thuật</div>
                    </a>

                    <a href="<?php echo esc_url($news_url); ?>"
                      class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors group/link">
                      <div
                        class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                        </svg>
                      </div>
                      <div
                        class="text-[13.5px] font-bold text-slate-700 group-hover/link:text-[#b31217] transition-colors whitespace-nowrap">
                        Tin Tức</div>
                    </a>
                  </div>
                </div>
              </div>



              <a href="<?php echo esc_url(hacoled_header_menu_url('contact')); ?>" :class="scrolled ? 'py-4' : 'py-2'"
                class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
                <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none"
                  stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                </svg>
                <?php echo esc_html(hacoled_header_menu_label('contact')); ?>
                <span
                  class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-[#fbbf24] transition-all duration-300 group-hover:w-full"></span>
              </a>

            </div> <!-- KẾT THÚC CỤM MENU FLEXBOX -->
          </div>
        </nav>


      </div> <!-- End Monolithic Wrapper -->
    </div> <!-- End Desktop Header Wrapper -->
  </header>

  <?php
  // Define local variables for mobile bar
  $footer_about_url = home_url('/gioi-thieu/');
  $footer_services_url = home_url('/dich-vu/');
  $footer_contact_url = home_url('/lien-he/');
  $footer_news_url = home_url('/tin-tuc/');
  $footer_commitment_url = home_url('/cam-ket-chat-luong/');
  $footer_careers_url = home_url('/tuyen-dung/');

  $footer_about_pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-about.php'));
  if (!empty($footer_about_pages))
    $footer_about_url = get_permalink($footer_about_pages[0]->ID);

  $footer_services_pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-services.php'));
  if (!empty($footer_services_pages))
    $footer_services_url = get_permalink($footer_services_pages[0]->ID);

  $footer_contact_pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-contact.php'));
  if (!empty($footer_contact_pages))
    $footer_contact_url = get_permalink($footer_contact_pages[0]->ID);

  $footer_commitment_pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-commitment.php'));
  if (!empty($footer_commitment_pages))
    $footer_commitment_url = get_permalink($footer_commitment_pages[0]->ID);

  $footer_careers_pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-careers.php'));
  if (!empty($footer_careers_pages))
    $footer_careers_url = get_permalink($footer_careers_pages[0]->ID);

  $footer_job_args = array(
    'post_type' => 'job',
    'posts_per_page' => 5,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC'
  );
  $footer_jobs = get_posts($footer_job_args);
  ?>
  <!-- Mobile Bottom Navigation & Drawers (lg:hidden) -->
  <div x-data="{ activeDrawer: null }" class="haco-mobile-navigation lg:hidden">

      <!-- Backdrop Overlay -->
      <div x-show="activeDrawer" x-cloak @click="activeDrawer = null"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[190]">
      </div>

      <!-- Bottom Navigation Bar -->
      <nav aria-label="Mobile Navigation"
        class="haco-mobile-bottom-bar fixed bottom-0 left-0 right-0 z-[210] bg-gradient-to-t from-[#7a080c] to-[#990d12] border-t border-white/10 shadow-[0_-5px_25px_rgba(0,0,0,0.3)]"
        style="padding-bottom: env(safe-area-inset-bottom);">
        <div class="flex justify-around items-center h-16 px-2">

          <!-- Tab 1: Trang chủ -->
          <a href="<?php echo esc_url(home_url('/')); ?>"
            class="flex items-center justify-center w-16 h-full transition-all duration-200"
            :class="activeDrawer === null && (window.location.pathname === '/' || window.location.pathname === '/index.php') ? 'text-[#fbbf24] scale-105' : 'text-white/70 hover:text-white'">
            <i class="text-[26px]"
              :class="activeDrawer === null && (window.location.pathname === '/' || window.location.pathname === '/index.php') ? 'ph-fill ph-house' : 'ph-bold ph-house'"></i>
          </a>

          <!-- Tab 2: Sản phẩm -->
          <button aria-label="Sản phẩm" @click="activeDrawer = activeDrawer === 'products' ? null : 'products'"
            class="flex items-center justify-center w-16 h-full transition-all duration-200 outline-none"
            :class="activeDrawer === 'products' ? 'text-[#fbbf24] scale-105' : 'text-white/70 hover:text-white'">
            <i class="text-[26px]"
              :class="activeDrawer === 'products' ? 'ph-fill ph-package' : 'ph-bold ph-package'"></i>
          </button>

          <!-- Tab 3: Blog -->
          <button aria-label="Blog" @click="activeDrawer = activeDrawer === 'blog' ? null : 'blog'"
            class="flex items-center justify-center w-16 h-full transition-all duration-200 outline-none"
            :class="activeDrawer === 'blog' ? 'text-[#fbbf24] scale-105' : 'text-white/70 hover:text-white'">
            <i class="text-[26px]"
              :class="activeDrawer === 'blog' ? 'ph-fill ph-newspaper' : 'ph-bold ph-newspaper'"></i>
          </button>

          <!-- Tab 4: Info -->
          <button aria-label="Thông tin" @click="activeDrawer = activeDrawer === 'info' ? null : 'info'"
            class="flex items-center justify-center w-16 h-full transition-all duration-200 outline-none"
            :class="activeDrawer === 'info' ? 'text-[#fbbf24] scale-105' : 'text-white/70 hover:text-white'">
            <i class="text-[26px]" :class="activeDrawer === 'info' ? 'ph-fill ph-info' : 'ph-bold ph-info'"></i>
          </button>

          <!-- Tab 5: Menu -->
          <button aria-label="Menu" @click="activeDrawer = activeDrawer === 'menu' ? null : 'menu'"
            class="flex items-center justify-center w-16 h-full transition-all duration-200 outline-none"
            :class="activeDrawer === 'menu' ? 'text-[#fbbf24] scale-105' : 'text-white/70 hover:text-white'">
            <i class="text-[26px]" :class="activeDrawer === 'menu' ? 'ph-fill ph-list' : 'ph-bold ph-list'"></i>
          </button>

        </div>
      </nav>

      <!-- Drawer 1: Sản phẩm -->
      <div x-show="activeDrawer === 'products'" x-cloak x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-y-0"
        x-transition:leave-end="translate-y-full"
        class="fixed bottom-0 left-0 right-0 z-[200] max-h-[80vh] rounded-t-[2.5rem] haco-brand-panel border-t border-white/20 text-white flex flex-col shadow-2xl pb-20 overflow-hidden">

        <!-- Dong Son Bronze Drum watermark background -->
        <div
          class="absolute -bottom-16 -right-16 w-64 h-64 bg-no-repeat bg-contain bg-center pointer-events-none mix-blend-screen z-0"
          style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg/960px-Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg.png'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%); opacity: 0.05;">
        </div>

        <div class="w-12 h-1.5 bg-white/20 rounded-full mx-auto my-3 shrink-0 cursor-pointer relative z-10"
          @click="activeDrawer = null"></div>
        <div class="px-6 pb-4 flex items-center justify-between border-b border-white/10 shrink-0 relative z-10">
          <h3 class="text-base font-extrabold uppercase tracking-wider text-[#fbbf24] flex items-center gap-2">
            <i class="ph-fill ph-package text-lg"></i> Danh Mục Sản Phẩm
          </h3>
          <button @click="activeDrawer = null"
            class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors">
            <i class="ph-bold ph-x"></i>
          </button>
        </div>
        <div class="overflow-y-auto px-6 py-4 space-y-4 mobile-scroll flex-1 text-left relative z-10">

          <!-- LED TRONG NHÀ -->
          <div>
            <h4
              class="text-[12px] font-black uppercase tracking-wider text-[#fbbf24]/90 mb-2 border-b border-white/5 pb-1">
              Màn Hình LED Trong Nhà</h4>
            <div class="grid grid-cols-2 gap-2">
              <a href="https://hacoled.com/man-hinh-led-trong-nha/"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Tất
                cả trong nhà</a>
              <a href="<?php echo esc_url(home_url('/man-hinh-led-p0-9-trong-nha/')); ?>"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED
                P0.9</a>
              <a href="<?php echo esc_url(home_url('/man-hinh-led-p1-25-trong-nha/')); ?>"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED
                P1.25</a>
              <a href="<?php echo esc_url(home_url('/man-hinh-led-p1-53-trong-nha/')); ?>"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED
                P1.53</a>
              <a href="<?php echo esc_url(home_url('/man-hinh-led-p1-8-trong-nha/')); ?>"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED
                P1.8</a>
              <a href="<?php echo esc_url(home_url('/man-hinh-led-p2-trong-nha/')); ?>"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED
                P2</a>
              <a href="<?php echo esc_url(home_url('/man-hinh-led-p2-5-trong-nha/')); ?>"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED
                P2.5</a>
              <a href="<?php echo esc_url(home_url('/man-hinh-led-p3-trong-nha/')); ?>"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED
                P3</a>
            </div>
          </div>

          <!-- LED NGOÀI TRỜI -->
          <div>
            <h4
              class="text-[12px] font-black uppercase tracking-wider text-[#fbbf24]/90 mb-2 border-b border-white/5 pb-1">
              Màn Hình LED Ngoài Trời</h4>
            <div class="grid grid-cols-2 gap-2">
              <a href="https://hacoled.com/man-hinh-led-ngoai-troi/"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Tất
                cả ngoài trời</a>
              <a href="<?php echo esc_url(home_url('/man-hinh-led-p2-5-ngoai-troi/')); ?>"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED
                P2.5</a>
              <a href="<?php echo esc_url(home_url('/man-hinh-led-p3-ngoai-troi/')); ?>"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED
                P3</a>
              <a href="<?php echo esc_url(home_url('/man-hinh-led-p4-ngoai-troi/')); ?>"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED
                P4</a>
              <a href="<?php echo esc_url(home_url('/man-hinh-led-p5-ngoai-troi/')); ?>"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED
                P5</a>
              <a href="<?php echo esc_url(home_url('/man-hinh-led-p10-ngoai-troi/')); ?>"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED
                P10</a>
            </div>
          </div>

          <!-- MÀN HÌNH GHÉP LCD -->
          <div>
            <h4
              class="text-[12px] font-black uppercase tracking-wider text-[#fbbf24]/90 mb-2 border-b border-white/5 pb-1">
              Màn Hình Ghép LCD</h4>
            <div class="grid grid-cols-2 gap-2">
              <a href="https://hacoled.com/man-hinh-ghep/"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Tất
                cả màn ghép</a>
              <a href="<?php echo esc_url(home_url('/man-hinh-ghep-boe/')); ?>"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Màn
                ghép BOE</a>
              <a href="<?php echo esc_url(home_url('/man-hinh-ghep-orion/')); ?>"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Màn
                ghép Orion</a>
              <a href="<?php echo esc_url(home_url('/man-hinh-ghep-vestel/')); ?>"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Màn
                ghép Vestel</a>
            </div>
          </div>

          <!-- ÂM THANH & ÁNH SÁNG -->
          <div>
            <h4
              class="text-[12px] font-black uppercase tracking-wider text-[#fbbf24]/90 mb-2 border-b border-white/5 pb-1">
              Âm Thanh | Ánh Sáng</h4>
            <div class="grid grid-cols-2 gap-2">
              <a href="https://hacoled.com/am-thanh/"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Tất
                cả âm thanh</a>
              <a href="<?php echo esc_url(home_url('/dbacoustic-loa/')); ?>"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Loa
                DBacoustic</a>
              <a href="<?php echo esc_url(home_url('/dbacoustic-amply/')); ?>"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Amply
                DBacoustic</a>
              <a href="<?php echo esc_url(home_url('/dbacoustic-micro/')); ?>"
                class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Micro
                DBacoustic</a>
            </div>
          </div>

        </div>
      </div>

      <!-- Drawer 2: Blog -->
      <div x-show="activeDrawer === 'blog'" x-cloak x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-y-0"
        x-transition:leave-end="translate-y-full"
        class="fixed bottom-0 left-0 right-0 z-[200] max-h-[80vh] rounded-t-[2.5rem] haco-brand-panel border-t border-white/20 text-white flex flex-col shadow-2xl pb-20 overflow-hidden">

        <!-- Dong Son Bronze Drum watermark background -->
        <div
          class="absolute -bottom-16 -right-16 w-64 h-64 bg-no-repeat bg-contain bg-center pointer-events-none mix-blend-screen z-0"
          style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg/960px-Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg.png'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%); opacity: 0.05;">
        </div>

        <div class="w-12 h-1.5 bg-white/20 rounded-full mx-auto my-3 shrink-0 cursor-pointer relative z-10"
          @click="activeDrawer = null"></div>
        <div class="px-6 pb-4 flex items-center justify-between border-b border-white/10 shrink-0 relative z-10">
          <h3 class="text-base font-extrabold uppercase tracking-wider text-[#fbbf24] flex items-center gap-2">
            <i class="ph-fill ph-article text-lg"></i> Tin Tức & Blog
          </h3>
          <button @click="activeDrawer = null"
            class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors">
            <i class="ph-bold ph-x"></i>
          </button>
        </div>
        <div class="overflow-y-auto px-6 py-5 space-y-3 mobile-scroll flex-1 text-left relative z-10">
          <a href="<?php echo esc_url($footer_news_url); ?>"
            class="flex items-center gap-4 p-4 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 hover:border-[#fbbf24] transition-all group">
            <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-[#fbbf24] flex items-center justify-center shrink-0">
              <i class="ph-bold ph-newspaper text-xl"></i>
            </div>
            <div class="flex-1 text-left">
              <p class="font-bold text-sm">Xem tất cả Tin Tức & Blog</p>
              <p class="text-xs text-white/50">Cập nhật xu hướng & dự án nổi bật</p>
            </div>
            <i class="ph-bold ph-caret-right text-white/30 group-hover:text-white transition-colors"></i>
          </a>

          <a href="<?php echo esc_url(home_url('/blog-man-hinh-led/')); ?>"
            class="flex items-center gap-4 p-4 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 hover:border-[#fbbf24] transition-all group">
            <div class="w-10 h-10 rounded-xl bg-red-500/10 text-red-400 flex items-center justify-center shrink-0">
              <i class="ph-bold ph-monitor text-xl"></i>
            </div>
            <div class="flex-1 text-left">
              <p class="font-bold text-sm">Blog về màn hình LED</p>
              <p class="text-xs text-white/50">Kiến thức chuyên sâu về màn hình LED</p>
            </div>
            <i class="ph-bold ph-caret-right text-white/30 group-hover:text-white transition-colors"></i>
          </a>

          <a href="<?php echo esc_url(home_url('/blog-am-thanh/')); ?>"
            class="flex items-center gap-4 p-4 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 hover:border-[#fbbf24] transition-all group">
            <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center shrink-0">
              <i class="ph-bold ph-speaker-high text-xl"></i>
            </div>
            <div class="flex-1 text-left">
              <p class="font-bold text-sm">Blog về âm thanh</p>
              <p class="text-xs text-white/50">Tư vấn, đánh giá thiết bị âm thanh</p>
            </div>
            <i class="ph-bold ph-caret-right text-white/30 group-hover:text-white transition-colors"></i>
          </a>

          <a href="<?php echo esc_url(home_url('/kien-thuc-ky-thuat/')); ?>"
            class="flex items-center gap-4 p-4 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 hover:border-[#fbbf24] transition-all group">
            <div class="w-10 h-10 rounded-xl bg-green-500/10 text-green-400 flex items-center justify-center shrink-0">
              <i class="ph-bold ph-book-open text-xl"></i>
            </div>
            <div class="flex-1 text-left">
              <p class="font-bold text-sm">Hướng dẫn kỹ thuật</p>
              <p class="text-xs text-white/50">Tài liệu, hướng dẫn vận hành kỹ thuật</p>
            </div>
            <i class="ph-bold ph-caret-right text-white/30 group-hover:text-white transition-colors"></i>
          </a>
        </div>
      </div>

      <!-- Drawer 3: Info -->
      <div x-show="activeDrawer === 'info'" x-cloak x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-y-0"
        x-transition:leave-end="translate-y-full"
        class="fixed bottom-0 left-0 right-0 z-[200] max-h-[85vh] rounded-t-[2.5rem] haco-brand-panel border-t border-white/20 text-white flex flex-col shadow-2xl pb-20 overflow-hidden">

        <!-- Dong Son Bronze Drum watermark background -->
        <div
          class="absolute -bottom-16 -right-16 w-64 h-64 bg-no-repeat bg-contain bg-center pointer-events-none mix-blend-screen z-0"
          style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg/960px-Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg.png'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%); opacity: 0.05;">
        </div>

        <div class="w-12 h-1.5 bg-white/20 rounded-full mx-auto my-3 shrink-0 cursor-pointer relative z-10"
          @click="activeDrawer = null"></div>
        <div class="px-6 pb-4 flex items-center justify-between border-b border-white/10 shrink-0 relative z-10">
          <h3 class="text-base font-extrabold uppercase tracking-wider text-[#fbbf24] flex items-center gap-2">
            <i class="ph-fill ph-info text-lg"></i> Thông Tin Liên Hệ
          </h3>
          <button @click="activeDrawer = null"
            class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors">
            <i class="ph-bold ph-x"></i>
          </button>
        </div>
        <address class="overflow-y-auto px-6 py-5 space-y-6 mobile-scroll flex-1 text-left not-italic relative z-10">

          <!-- Company Branding & Socials -->
          <div class="flex flex-col items-center text-center space-y-4 pb-5 border-b border-white/10">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block">
              <img class="w-[180px] h-auto object-contain rounded shadow-sm"
                src="<?php echo esc_url(home_url('/wp-content/uploads/2026/06/HacoLED-Logo-Moi.png')); ?>"
                alt="HacoLED Logo" />
            </a>
            <p class="text-xs text-white/70 leading-relaxed max-w-xs">
              <?php _e('Công ty CP Công Nghệ HACO Việt Nam - Đơn vị tiên phong cung cấp giải pháp màn hình LED và thiết bị công nghệ hiển thị cao cấp.', 'hacoled'); ?>
            </p>
            <div class="flex gap-2">
              <!-- Facebook SVG -->
              <a class="w-9 h-9 rounded bg-haco-red/80 border border-white/15 flex items-center justify-center text-slate-300 hover:bg-[#fbbf24] hover:text-haco-ink transition-all"
                href="https://www.facebook.com/hacoled" target="_blank" rel="noopener" aria-label="Facebook">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                  <path d="M9 8H7v3h2v9h3v-9h3l.5-3H12V6c0-.883.398-1.5 1.5-1.5H15V1h-2.5C9.945 1 9 2.557 9 4.833V8z" />
                </svg>
              </a>
              <!-- Twitter / X SVG -->
              <a class="w-9 h-9 rounded bg-haco-red/80 border border-white/15 flex items-center justify-center text-slate-300 hover:bg-[#fbbf24] hover:text-haco-ink transition-all"
                href="https://x.com/HacoLed" target="_blank" rel="noopener" aria-label="X (Twitter)">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                  <path
                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                </svg>
              </a>
              <!-- Youtube SVG -->
              <a class="w-9 h-9 rounded bg-haco-red/80 border border-white/15 flex items-center justify-center text-slate-300 hover:bg-[#fbbf24] hover:text-haco-ink transition-all"
                href="https://www.youtube.com/@hacoled" target="_blank" rel="noopener" aria-label="YouTube">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                  <path
                    d="M23.498 6.163a3.003 3.003 0 00-2.11-2.11C19.517 3.545 12 3.545 12 3.545s-7.517 0-9.388.508a3.003 3.003 0 00-2.11 2.11C0 8.033 0 12 0 12s0 3.967.502 5.837a3.003 3.003 0 002.11 2.11c1.871.508 9.388.508 9.388.508s7.517 0 9.388-.508a3.003 3.003 0 002.11-2.11C24 15.967 24 12 24 12s0-3.967-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                </svg>
              </a>
              <!-- Linkedin SVG -->
              <a class="w-9 h-9 rounded bg-haco-red/80 border border-white/15 flex items-center justify-center text-slate-300 hover:bg-[#fbbf24] hover:text-haco-ink transition-all"
                href="https://www.linkedin.com/in/hacoled/" target="_blank" rel="noopener" aria-label="LinkedIn">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                  <path
                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                </svg>
              </a>
            </div>
          </div>

          <!-- Contacts Quick Grid -->
          <div class="grid grid-cols-2 gap-3">
            <a href="tel:0342324488"
              class="p-3 bg-white/5 border border-white/10 rounded-2xl flex flex-col items-center text-center">
              <i class="ph-fill ph-phone text-xl text-[#fbbf24] mb-1"></i>
              <span class="text-[10px] text-white/50 font-bold uppercase">Hotline</span>
              <span class="text-xs font-extrabold text-white">034.232.4488</span>
            </a>
            <a href="tel:0868474488"
              class="p-3 bg-white/5 border border-white/10 rounded-2xl flex flex-col items-center text-center">
              <i class="ph-fill ph-headset text-xl text-[#fbbf24] mb-1"></i>
              <span class="text-[10px] text-white/50 font-bold uppercase">CSKH & Mua Hàng</span>
              <span class="text-xs font-extrabold text-white">086.847.4488</span>
            </a>
            <a href="mailto:kinhdoanh@hacoled.com"
              class="p-3 bg-white/5 border border-white/10 rounded-2xl flex flex-col items-center text-center col-span-2">
              <i class="ph-fill ph-envelope text-xl text-[#fbbf24] mb-1"></i>
              <span class="text-[10px] text-white/50 font-bold uppercase">Email</span>
              <span class="text-xs font-semibold text-white">kinhdoanh@hacoled.com</span>
            </a>
          </div>

          <!-- Trụ sở & Chi nhánh -->
          <div class="space-y-4">

            <div>
              <h4 class="text-xs font-black uppercase text-[#fbbf24] tracking-wide mb-1 flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-[#fbbf24]"></span> TRỤ SỞ & VP MIỀN BẮC
              </h4>
              <p class="text-xs text-white/80 pl-3 leading-relaxed mb-1.5"><strong>Trụ sở chính:</strong> Ngách 57/92
                Đường Quang Minh, Thôn Gia Thượng 2, Xã Quang Minh, TP. Hà Nội</p>
              <p class="text-xs text-white/80 pl-3 leading-relaxed"><strong>Văn phòng HN:</strong> Số 11 ngõ 10 Nghĩa
                Đô, phường Nghĩa Đô, TP. Hà Nội</p>
            </div>

            <div>
              <h4 class="text-xs font-black uppercase text-[#fbbf24] tracking-wide mb-1 flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-[#fbbf24]"></span> CN HỒ CHÍ MINH
              </h4>
              <p class="text-xs text-white/80 pl-3 leading-relaxed">400 Đ.Nguyễn Thị Thập, P. Tân Hưng, TP. HCM</p>
            </div>

            <div>
              <h4 class="text-xs font-black uppercase text-[#fbbf24] tracking-wide mb-1 flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-[#fbbf24]"></span> CN ĐÀ NẴNG
              </h4>
              <p class="text-xs text-white/80 pl-3 leading-relaxed">Số 88 Tây Sơn, P. Ngũ Hành Sơn, TP. Đà Nẵng</p>
            </div>

            <div>
              <h4 class="text-xs font-black uppercase text-[#fbbf24] tracking-wide mb-1 flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-[#fbbf24]"></span> CN TÂY NGUYÊN
              </h4>
              <p class="text-xs text-white/80 pl-3 leading-relaxed">TDP4, P. Đông Gia Nghĩa, Lâm Đồng</p>
            </div>

          </div>

          <div class="pt-4 border-t border-white/10 text-center flex flex-col gap-2.5">
            <a href="<?php echo esc_url($footer_contact_url); ?>"
               class="w-full py-2.5 bg-[#D90429] hover:bg-[#b90323] text-white font-bold rounded-xl text-xs uppercase tracking-wider flex items-center justify-center gap-2 transition-all shadow-md">
              <i class="ph-bold ph-envelope-simple text-sm"></i> Trang Liên Hệ Chi Tiết
            </a>
            <span class="text-[11px] text-white/50"><strong>MST:</strong> 0108701064</span>
          </div>

        </address>
      </div>

      <!-- Drawer 4: Menu -->
      <div x-show="activeDrawer === 'menu'" x-cloak x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-y-0"
        x-transition:leave-end="translate-y-full"
        class="fixed bottom-0 left-0 right-0 z-[200] max-h-[85vh] rounded-t-[2.5rem] haco-brand-panel border-t border-white/20 text-white flex flex-col shadow-2xl pb-20 overflow-hidden">

        <!-- Dong Son Bronze Drum watermark background -->
        <div
          class="absolute -bottom-16 -right-16 w-64 h-64 bg-no-repeat bg-contain bg-center pointer-events-none mix-blend-screen z-0"
          style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg/960px-Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg.png'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%); opacity: 0.05;">
        </div>

        <div class="w-12 h-1.5 bg-white/20 rounded-full mx-auto my-3 shrink-0 cursor-pointer relative z-10"
          @click="activeDrawer = null"></div>
        <div class="px-6 pb-4 flex items-center justify-between border-b border-white/10 shrink-0 relative z-10">
          <h3 class="text-base font-extrabold uppercase tracking-wider text-[#fbbf24] flex items-center gap-2">
            <i class="ph-fill ph-list text-lg"></i> Menu Điều Hướng
          </h3>
          <button @click="activeDrawer = null"
            class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors">
            <i class="ph-bold ph-x"></i>
          </button>
        </div>
        <div class="overflow-y-auto px-6 py-4 space-y-4 mobile-scroll flex-1 text-left relative z-10">

          <!-- Search Mobile -->
          <div class="pb-3 border-b border-white/10 mb-4">
            <form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="relative">
              <input type="search" name="s" placeholder="Tìm kiếm sản phẩm, dịch vụ..."
                class="w-full rounded-xl pl-10 pr-4 py-2.5 text-[13px] text-white placeholder-white/60 bg-white/5 border border-white/15 focus:outline-none focus:border-[#fbbf24] focus:bg-white/10 transition-all" />
              <span class="absolute left-3 top-1/2 -translate-y-1/2 text-white/50">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.602 10.602z" />
                </svg>
              </span>
            </form>
          </div>

          <!-- Primary Pages List with Accordions (Single-Open Mode) -->
          <div class="space-y-1.5 text-left" x-data="{ activeAccordion: null }">
            <?php if (hacoled_header_menu_enabled('home')): ?><a
                href="<?php echo esc_url(hacoled_header_menu_url('home')); ?>"
                class="block px-3 py-2.5 text-sm font-bold text-white/90 hover:bg-white/5 rounded-xl transition-all"><?php echo esc_html(hacoled_header_menu_label('home')); ?></a><?php endif; ?>
            <?php
            foreach (['about', 'solutions', 'audio', 'projects'] as $mobile_menu_key) {
              hacoled_render_mobile_header_menu($header_menu_configs[$mobile_menu_key] ?? [], $mobile_menu_key);
            }
            ?>
            <?php if (hacoled_header_menu_enabled('services')): ?><a
                href="<?php echo esc_url(hacoled_header_menu_url('services')); ?>"
                class="block px-3 py-2.5 text-sm font-bold text-white/90 hover:bg-white/5 rounded-xl transition-all"><?php echo esc_html(hacoled_header_menu_label('services')); ?></a><?php endif; ?>
          </div>

        </div>
      </div>

    </div>
  </div>

  <!-- Drum pattern auto-center script -->
  <script>
    (function () {
      function positionDrum() {
        var logo = document.getElementById('hdr-logo-el');
        var drum = document.getElementById('hdr-drum-stamp');
        var overlay = drum && drum.parentElement;
        if (!logo || !drum || !overlay) return;
        var lr = logo.getBoundingClientRect();
        var or2 = overlay.getBoundingClientRect();
        var cx = (lr.left + lr.width / 2) - or2.left;
        var cy = (lr.top + lr.height / 2) - or2.top;
        var size = 580;
        drum.style.left = (cx - size / 2) + 'px';
        drum.style.top = (cy - size / 2) + 'px';
        drum.style.width = size + 'px';
        drum.style.height = size + 'px';
      }
      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', positionDrum);
      } else {
        positionDrum();
      }
      window.addEventListener('resize', positionDrum);
      window.addEventListener('scroll', positionDrum);
    })();
  </script>
