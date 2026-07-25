<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    [x-cloak] { display: none !important; }
    php-block { display: none !important; }
    @keyframes hacoled-news-ticker-scroll {
      from { transform: translate3d(0, 0, 0); }
      to { transform: translate3d(-50%, 0, 0); }
    }
    .hdr-ticker-track {
      display: flex;
      align-items: center;
      width: max-content;
      min-width: max-content;
    }
    .hdr-ticker-track.is-animated {
      animation: hacoled-news-ticker-scroll 55s linear infinite;
      will-change: transform;
    }
    .hdr-ticker-group {
      display: flex;
      align-items: center;
      gap: 1.5rem;
      padding-right: 1.5rem;
    }
    .hdr-ticker-viewport:hover .hdr-ticker-track.is-animated {
      animation-play-state: paused;
    }
    @media (prefers-reduced-motion: reduce) {
      .hdr-ticker-track.is-animated {
        animation: none;
        transform: none;
        will-change: auto;
      }
    }
    .site-header.is-scrolled {
      box-shadow: 0 12px 36px rgba(0, 0, 0, 0.32) !important;
    }
    .site-header .header-pattern-anchor {
      position: absolute;
      left: calc(max((100vw - 1440px) / 2, 0px) + 120px);
      top: 85px;
      width: 0;
      height: 0;
      transition: left 260ms cubic-bezier(0.16, 1, 0.3, 1), top 260ms cubic-bezier(0.16, 1, 0.3, 1);
      will-change: left, top;
    }
    .site-header .header-pattern-anchor .hdr-logo-ds,
    .site-header.is-scrolled .header-pattern-anchor .hdr-logo-ds {
      top: 0;
      left: 0;
      width: 580px !important;
      height: 580px !important;
      transform: translate(-50%, -50%);
    }
    .site-header.is-scrolled .header-pattern-anchor {
      left: calc(max((100vw - 1440px) / 2, 0px) + 84px);
      top: 20px;
    }
    .site-header .top-header,
    .site-header .main-header {
      max-height: 140px;
      opacity: 1;
      transform: translateY(0);
      overflow: hidden;
      transition: max-height 260ms cubic-bezier(0.16, 1, 0.3, 1), opacity 180ms ease, transform 260ms cubic-bezier(0.16, 1, 0.3, 1), padding 260ms cubic-bezier(0.16, 1, 0.3, 1);
      will-change: max-height, opacity, transform;
    }
    .site-header .main-header {
      max-height: 120px;
    }
    .site-header.is-scrolled .top-header,
    .site-header.is-scrolled .main-header {
      max-height: 0 !important;
      opacity: 0 !important;
      transform: translateY(-10px) !important;
      padding-top: 0 !important;
      padding-bottom: 0 !important;
      pointer-events: none !important;
      border-width: 0 !important;
    }
    .site-header.is-scrolled .bottom-header,
    .site-header.is-scrolled #hdr-nav {
      background: transparent !important;
      box-shadow: none !important;
      padding-top: 0 !important;
      padding-bottom: 0 !important;
    }
    .site-header.is-scrolled .bottom-header a,
    .site-header.is-scrolled .bottom-header button {
      padding-top: 0.55rem !important;
      padding-bottom: 0.55rem !important;
      font-size: 12px !important;
    }
    .site-header .bottom-header {
      transition: padding 260ms cubic-bezier(0.16, 1, 0.3, 1);
    }
    .site-header .bottom-header-logo {
      width: 0;
      opacity: 0;
      margin-right: 0;
      transform: translateX(-8px);
      overflow: hidden;
      pointer-events: none;
      transition: width 260ms cubic-bezier(0.16, 1, 0.3, 1), opacity 180ms ease, margin 260ms cubic-bezier(0.16, 1, 0.3, 1), transform 260ms cubic-bezier(0.16, 1, 0.3, 1);
    }
    .site-header.is-scrolled .bottom-header-logo {
      width: 104px;
      opacity: 1;
      margin-right: 16px;
      transform: translateX(0);
      pointer-events: auto;
    }
    
    /* Custom Scrollbar Mobile */
    .mobile-scroll::-webkit-scrollbar { width: 4px; }
    .mobile-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 99px; }
  </style>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<php-block class="hidden">
<?php
$news_url     = hacoled_managed_page_url('blog');

$logo = get_template_directory_uri() . '/assets/images/hacoled-logo-square-256.webp';

$news_cat = get_category_by_slug('tin-tuc');
$news_url = $news_cat ? get_category_link($news_cat->term_id) : hacoled_managed_page_url('blog');
$header_menu_configs = hacoled_header_menu_settings();
?>
</php-block>

<?php if (wp_is_mobile()) : ?>
<style>
  .hacoled-mobile-header{position:fixed;inset:0 0 auto;z-index:200;height:52px;display:flex;align-items:center;justify-content:space-between;padding:0 14px;background:linear-gradient(90deg,#b31217,#8a0b10);border-top:2px solid #fbbf24;box-shadow:0 4px 16px rgba(0,0,0,.25)}
  .hacoled-mobile-header img{display:block;width:38px;height:38px;object-fit:contain;background:#fff;border-radius:6px}
  .hacoled-mobile-header summary{list-style:none;display:flex;align-items:center;justify-content:center;width:38px;height:38px;color:#fff;font-size:24px;cursor:pointer}
  .hacoled-mobile-header summary::-webkit-details-marker{display:none}
  .hacoled-mobile-header nav{position:absolute;top:52px;left:0;right:0;display:grid;gap:2px;padding:10px 14px 14px;background:#920d12;box-shadow:0 12px 24px rgba(0,0,0,.3)}
  .hacoled-mobile-header nav a{padding:10px 12px;border-radius:8px;color:#fff;font:600 14px/1.3 Arial,sans-serif;text-decoration:none}
  .hacoled-mobile-header nav a:focus,.hacoled-mobile-header nav a:hover{background:rgba(255,255,255,.1);color:#fbbf24}
</style>
<header class="hacoled-mobile-header" aria-label="Đầu trang HacoLED">
  <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="Trang chủ HacoLED">
    <img src="<?php echo esc_url($logo); ?>" width="38" height="38" alt="HacoLED" fetchpriority="high">
  </a>
  <a href="tel:0342324488" style="color:#fbbf24;font:700 13px Arial,sans-serif;text-decoration:none">034.232.4488</a>
  <details>
    <summary aria-label="Mở menu">☰</summary>
    <nav aria-label="Menu chính trên điện thoại">
      <?php foreach (['home', 'about', 'led', 'videowall', 'solutions', 'audio', 'projects', 'services', 'news', 'contact'] as $mobile_menu_key) : ?>
        <?php if (hacoled_header_menu_enabled($mobile_menu_key)) : ?>
          <a href="<?php echo esc_url(hacoled_header_menu_url($mobile_menu_key)); ?>"><?php echo esc_html(hacoled_header_menu_label($mobile_menu_key)); ?></a>
        <?php endif; ?>
      <?php endforeach; ?>
    </nav>
  </details>
</header>
<div aria-hidden="true" style="height:52px;background:#8a0b10"></div>
<?php else : ?>

<!-- ═══════════════════════════════════════════════════════════
     SITE HEADER – Premium V7 (Visual Rich Mega Menus)
     ═══════════════════════════════════════════════════════════ -->
<header
  id="site-header"
  x-data="{ mobile: false, scrolled: false }"
  @scroll.window="scrolled = (window.scrollY > 80)"
  class="site-header hidden lg:block fixed top-0 left-0 z-[200] w-full overflow-visible bg-gradient-to-r from-[#b31217] via-[#a30f14] to-[#8a0b10]"
  :class="scrolled ? 'is-scrolled shadow-[0_12px_36px_rgba(0,0,0,0.32)]' : 'shadow-2xl'">

  <!-- HEADER BACKGROUND: shared visual layer for top/main/bottom header -->
  <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
    <div class="absolute inset-0 opacity-[0.06]" style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 24px 24px;"></div>
    <div class="header-pattern-anchor" aria-hidden="true">
      <div class="hdr-logo-ds"></div>
    </div>
  </div>

  <!-- Gold accent belongs to the whole header and stays at its top edge. -->
  <div class="h-[2px] w-full relative z-40" style="background: linear-gradient(90deg, #b45309, #fbbf24, #fffbeb, #fbbf24, #b45309);"></div>

  <!-- TOP HEADER: latest posts ticker + quick trust info -->
  <div id="hdr-news-ticker" class="top-header relative z-30 w-full border-b border-white/10 text-white">
    <div class="max-w-[1440px] mx-auto px-4 lg:px-8 h-[30px] flex items-center gap-4 overflow-hidden">
      <a href="<?php echo esc_url($news_url); ?>" class="shrink-0 inline-flex items-center gap-1.5 text-[10px] font-light tracking-wide text-[#fbbf24]">
        <i class="ph ph-newspaper text-[12px]"></i>
        Tin mới
      </a>
      <div class="h-3 w-px bg-white/15 shrink-0"></div>
      <div class="hdr-ticker-viewport min-w-0 flex flex-1 items-center h-full overflow-hidden">
        <?php
        $hacoled_ticker_posts = get_posts([
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'numberposts'         => 8,
            'ignore_sticky_posts' => true,
            'orderby'             => 'date',
            'order'               => 'DESC',
        ]);
        ?>
        <div class="hdr-ticker-track whitespace-nowrap<?php echo !empty($hacoled_ticker_posts) ? ' is-animated' : ''; ?>">
          <?php if (!empty($hacoled_ticker_posts)) : ?>
            <?php for ($ticker_copy = 0; $ticker_copy < 2; $ticker_copy++) : ?>
              <div class="hdr-ticker-group"<?php echo $ticker_copy ? ' aria-hidden="true"' : ''; ?>>
                <?php foreach ($hacoled_ticker_posts as $ticker_post) : ?>
                  <a
                    href="<?php echo esc_url(get_permalink($ticker_post)); ?>"
                    class="inline-flex items-center gap-1.5 text-[10px] font-light text-white/80 hover:text-[#fbbf24]"
                    <?php echo $ticker_copy ? 'tabindex="-1"' : ''; ?>>
                    <span class="w-1 h-1 rounded-full bg-[#fbbf24]/80"></span>
                    <?php echo esc_html(get_the_title($ticker_post)); ?>
                  </a>
                <?php endforeach; ?>
              </div>
            <?php endfor; ?>
          <?php else : ?>
            <span class="text-[10px] font-light text-white/75">Cập nhật tin tức, dự án và giải pháp hiển thị mới nhất từ HacoLED.</span>
          <?php endif; ?>
        </div>
      </div>
      <div class="shrink-0 hidden xl:flex items-center gap-4 text-[10px] font-light text-white/70">
        <span class="inline-flex items-center gap-1.5"><i class="ph-fill ph-shield-check text-[#fbbf24]"></i> Bảo hành tận nơi</span>
        <span class="inline-flex items-center gap-1.5"><i class="ph-fill ph-lightning text-[#fbbf24]"></i> Hỗ trợ 24/7</span>
      </div>
    </div>
  </div>

  <!-- HEADER CONTENT: each layer owns content only; background belongs to #site-header -->
  <div class="w-full relative z-10">

    <!-- ── TOP BAR: Logo & Search ── -->
    <div
      id="hdr-top"
      class="main-header w-full relative py-2">

      <div class="max-w-[1440px] mx-auto px-4 lg:px-8 flex items-center justify-between gap-6 lg:gap-12 relative z-10">

        <!-- Logo -->
        <div class="hdr-logo">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="hdr-logo-link" aria-label="HacoLED">
            <img
              src="<?php echo esc_url($logo); ?>"
              alt="HacoLED"
              width="500"
              height="500"
              class="object-contain"
              style="width: 88px; height: 88px;" />
          </a>
        </div>

        <!-- SEARCH BAR (Sleek Glassmorphism) -->
        <div class="hidden md:block flex-1 max-w-2xl">
          <form method="get" action="<?php echo esc_url(home_url('/')); ?>" role="search" class="relative group">
            <input
              type="search" name="s" autocomplete="off" aria-label="Tìm kiếm sản phẩm và giải pháp HacoLED"
              placeholder="<?php esc_attr_e('Tìm sản phẩm, giải pháp hiển thị, âm thanh...', 'hacoled'); ?>"
              class="w-full rounded-full pl-12 pr-10 py-3 text-[13px] text-white placeholder-white/70 focus:outline-none transition-all duration-300 focus:bg-black/20 border border-white/20 focus:border-[#fbbf24]"
              style="background: rgba(0, 0, 0, 0.12);" />
            <span class="absolute left-4.5 top-1/2 -translate-y-1/2 text-white/60 group-hover:text-white transition-colors pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.602 10.602z"/></svg>
            </span>
            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] text-white/50 border border-white/30 rounded px-1.5 py-0.5 font-sans pointer-events-none group-focus-within:hidden">⌘K</span>
          </form>
        </div>

        <!-- HOTLINES -->
        <div class="hidden lg:flex items-center gap-6 ml-auto text-white flex-shrink-0">
          <!-- Kỹ thuật -->
          <a href="tel:0868474488" class="flex items-center gap-3 group">
            <div class="w-10 h-10 rounded-full flex items-center justify-center bg-white/10 transition-all duration-300 group-hover:bg-white group-hover:scale-105 border border-white/30">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white group-hover:text-[#b31217]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z"/></svg>
            </div>
            <div class="leading-tight">
              <span class="block text-[9px] font-bold uppercase tracking-widest text-white/70">Kỹ thuật & CSKH</span>
              <span class="block text-[14px] font-extrabold tracking-wide font-display group-hover:text-[#fbbf24] transition-colors">086.847.4488</span>
            </div>
          </a>

          <div class="w-[1px] h-8 bg-white/20"></div>

          <!-- Báo giá -->
          <a href="tel:0342324488" class="flex items-center gap-3 group">
            <div class="w-10 h-10 rounded-full flex items-center justify-center bg-white/10 transition-all duration-300 group-hover:bg-white group-hover:scale-105 border border-white/30">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white group-hover:text-[#b31217]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.802-5.127-4.106-6.93-6.93l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25z"/></svg>
            </div>
            <div class="leading-tight">
              <span class="block text-[9px] font-bold uppercase tracking-widest text-[#fbbf24]">Hotline báo giá</span>
              <span class="block text-[15px] font-extrabold tracking-wide text-white font-display">034.232.4488</span>
            </div>
          </a>
        </div>

        <!-- Mobile Toggle (Hidden in favor of bottom navigation bar) -->
        <button type="button" @click="mobile = !mobile" class="hidden" aria-label="Mở hoặc đóng menu di động">
          <svg x-show="!mobile" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
          <svg x-show="mobile" x-cloak class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
        </button>

      </div>
    </div>

    <!-- ── NAV BAR: BẮT ĐẦU TỪ TRÁI, GAP CỐ ĐỊNH CHUẨN PIXEL-PERFECT ── -->
    <nav
      id="hdr-nav"
      class="bottom-header hidden lg:block w-full relative z-20 pb-2"
      :class="scrolled ? '!pt-0 !pb-0' : ''">

      <div class="max-w-[1440px] mx-auto px-4 lg:px-8 flex items-center justify-start w-full relative">

        <!-- Sticky compact logo: belongs to bottom header only when top/main are collapsed -->
        <div class="bottom-header-logo shrink-0 relative flex items-center justify-center">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center justify-center" aria-label="HacoLED">
            <span class="font-display text-[17px] font-extrabold tracking-tight text-white leading-none">HacoLED</span>
          </a>
        </div>

        <!-- ── NAV LINKS CONTAINER (Dàn đều cân bằng 2 bên lề) ── -->
        <div class="flex flex-1 items-center justify-between w-full transition-all duration-300">

          <!-- TRANG CHỦ -->
          <?php if (hacoled_header_menu_enabled('home')) : ?>
          <a href="<?php echo esc_url(hacoled_header_menu_url('home')); ?>"
             :class="scrolled ? 'py-4' : 'py-2'"
             class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
            <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
            <?php echo esc_html(hacoled_header_menu_label('home')); ?>
            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-[#fbbf24] transition-all duration-300 group-hover:w-full"></span>
          </a>
          <?php endif; ?>

          <!-- GIỚI THIỆU (DROPDOWN) -->
          <?php if (hacoled_header_menu_enabled('about')) : ?>
          <div class="relative group/navitem" x-data="hacoledNavMenu('about-menu')" @mouseenter="openMenu()" @mouseleave="scheduleClose()" @focusout="handleFocusOut($event)">
            <button type="button" x-ref="trigger" id="about-menu-trigger" @click="toggleMenu()" @keydown.arrow-down.prevent="focusFirst()" @keydown.escape.stop="closeMenu(true)"
               aria-haspopup="menu" aria-controls="about-menu-panel" :aria-expanded="open.toString()"
               :class="scrolled ? 'py-4' : 'py-2'"
               class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
              <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0z"/></svg>
              <?php echo esc_html(hacoled_header_menu_label('about')); ?>
              <svg class="w-3 h-3 text-white/50 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : 'group-hover:text-[#fbbf24]'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
              <span class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] bg-[#fbbf24] transition-all duration-300" :class="open ? 'w-full' : 'w-0 group-hover:w-full'"></span>
            </button>
            <div id="about-menu-panel" role="menu" aria-labelledby="about-menu-trigger" x-show="open" x-cloak @click.outside="closeMenu(false)"
                 @keydown.escape.stop="closeMenu(true)" @keydown.arrow-down.prevent="focusItem(1)" @keydown.arrow-up.prevent="focusItem(-1)" @keydown.home.prevent="focusBoundary('start')" @keydown.end.prevent="focusBoundary('end')"
                 x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
                 class="hacoled-dropdown-wrapper">
              <div class="hacoled-dropdown-surface">
                <span class="hacoled-dropdown-arrow" aria-hidden="true"></span>
                <?php hacoled_render_header_dropdown_items($header_menu_configs['about']['items'] ?? []); ?>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <!-- ── MÀN HÌNH LED (MEGA MENU TẠP CHÍ + ẢNH MỚI) ── -->
          <?php if (hacoled_header_menu_enabled('led')) : ?>
          <div class="navitem-relative group/navitem" x-data="hacoledNavMenu('led-menu')" @mouseenter="openMenu()" @mouseleave="scheduleClose()" @focusout="handleFocusOut($event)">
            <button type="button" x-ref="trigger" id="led-menu-trigger" @click="toggleMenu()" @keydown.arrow-down.prevent="focusFirst()" @keydown.escape.stop="closeMenu(true)"
               aria-haspopup="menu" aria-controls="led-menu-panel" :aria-expanded="open.toString()"
               :class="scrolled ? 'py-4' : 'py-2'"
               class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
              <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h17.25c.621 0 1.125-.504 1.125-1.125V4.875c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125z"/></svg>
              <?php echo esc_html(hacoled_header_menu_label('led')); ?>
              <svg class="w-3 h-3 text-white/50 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : 'group-hover:text-[#fbbf24]'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
              <span class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] bg-[#fbbf24] transition-all duration-300" :class="open ? 'w-full' : 'w-0 group-hover:w-full'"></span>
            </button>

            <!-- Menu Nội Dung + Ảnh Dự Án Lớn -->
            <div id="led-menu-panel" role="menu" aria-labelledby="led-menu-trigger" x-show="open" x-cloak @click.outside="closeMenu(false)"
                 @keydown.escape.stop="closeMenu(true)" @keydown.arrow-down.prevent="focusItem(1)" @keydown.arrow-up.prevent="focusItem(-1)" @keydown.home.prevent="focusBoundary('start')" @keydown.end.prevent="focusBoundary('end')"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-2"
                 class="mega-menu-wrapper">
              <div class="mega-menu-surface"><?php get_template_part('views/components/headers/mega/led'); ?></div>
            </div>
          </div>
          <?php endif; ?>

          <!-- ── MÀN HÌNH GHÉP (MINI MEGA MENU) ── -->
          <?php if (hacoled_header_menu_enabled('videowall')) : ?>
          <div class="navitem-relative group/navitem" x-data="hacoledNavMenu('videowall-menu')" @mouseenter="openMenu()" @mouseleave="scheduleClose()" @focusout="handleFocusOut($event)">
            <button type="button" x-ref="trigger" id="videowall-menu-trigger" @click="toggleMenu()" @keydown.arrow-down.prevent="focusFirst()" @keydown.escape.stop="closeMenu(true)"
               aria-haspopup="menu" aria-controls="videowall-menu-panel" :aria-expanded="open.toString()"
               :class="scrolled ? 'py-4' : 'py-2'"
               class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
              <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z"/></svg>
              <?php echo esc_html(hacoled_header_menu_label('videowall')); ?>
              <svg class="w-3 h-3 text-white/50 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : 'group-hover:text-[#fbbf24]'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
              <span class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] bg-[#fbbf24] transition-all duration-300" :class="open ? 'w-full' : 'w-0 group-hover:w-full'"></span>
            </button>

            <!-- Menu Nội Dung + Ảnh Dự Án Lớn -->
            <div id="videowall-menu-panel" role="menu" aria-labelledby="videowall-menu-trigger" x-show="open" x-cloak @click.outside="closeMenu(false)"
                 @keydown.escape.stop="closeMenu(true)" @keydown.arrow-down.prevent="focusItem(1)" @keydown.arrow-up.prevent="focusItem(-1)" @keydown.home.prevent="focusBoundary('start')" @keydown.end.prevent="focusBoundary('end')"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-2"
                 class="mega-menu-wrapper mega-sm">
              <div class="mega-menu-surface"><?php get_template_part('views/components/headers/mega/videowall'); ?></div>
            </div>
          </div>
          <?php endif; ?>

          <!-- ── GIẢI PHÁP (GRID LƯỚI HÌNH ẢNH CỰC ĐỈNH) ── -->
          <?php if (hacoled_header_menu_enabled('solutions')) : ?>
          <div class="navitem-relative group/navitem" x-data="hacoledNavMenu('solutions-menu')" @mouseenter="openMenu()" @mouseleave="scheduleClose()" @focusout="handleFocusOut($event)">
            <button type="button" x-ref="trigger" id="solutions-menu-trigger" @click="toggleMenu()" @keydown.arrow-down.prevent="focusFirst()" @keydown.escape.stop="closeMenu(true)"
               aria-haspopup="menu" aria-controls="solutions-menu-panel" :aria-expanded="open.toString()"
               :class="scrolled ? 'py-4' : 'py-2'"
               class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
              <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.82 1.508-2.316a7.5 7.5 0 10-7.516 0c.85.496 1.508 1.333 1.508 2.316V18"/></svg>
              <?php echo esc_html(hacoled_header_menu_label('solutions')); ?>
              <svg class="w-3 h-3 text-white/50 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : 'group-hover:text-[#fbbf24]'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
              <span class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] bg-[#fbbf24] transition-all duration-300" :class="open ? 'w-full' : 'w-0 group-hover:w-full'"></span>
            </button>

            <!-- Menu Nội Dung + Ảnh Dự Án Lớn -->
            <div id="solutions-menu-panel" role="menu" aria-labelledby="solutions-menu-trigger" x-show="open" x-cloak @click.outside="closeMenu(false)"
                 @keydown.escape.stop="closeMenu(true)" @keydown.arrow-down.prevent="focusItem(1)" @keydown.arrow-up.prevent="focusItem(-1)" @keydown.home.prevent="focusBoundary('start')" @keydown.end.prevent="focusBoundary('end')"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-2"
                 class="mega-menu-wrapper">
              <div class="mega-menu-surface"><?php get_template_part('views/components/headers/mega/solutions'); ?></div>
            </div>
          </div>
          <?php endif; ?>

          <!-- ── ÂM THANH (BỔ SUNG VISUAL CARD BÊN PHẢI) ── -->
          <?php if (hacoled_header_menu_enabled('audio')) : ?>
          <div class="navitem-relative group/navitem" x-data="hacoledNavMenu('audio-menu')" @mouseenter="openMenu()" @mouseleave="scheduleClose()" @focusout="handleFocusOut($event)">
            <button type="button" x-ref="trigger" id="audio-menu-trigger" @click="toggleMenu()" @keydown.arrow-down.prevent="focusFirst()" @keydown.escape.stop="closeMenu(true)"
               aria-haspopup="menu" aria-controls="audio-menu-panel" :aria-expanded="open.toString()"
               :class="scrolled ? 'py-4' : 'py-2'"
               class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
              <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/></svg>
              <?php echo esc_html(hacoled_header_menu_label('audio')); ?>
              <svg class="w-3 h-3 text-white/50 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : 'group-hover:text-[#fbbf24]'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
              <span class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] bg-[#fbbf24] transition-all duration-300" :class="open ? 'w-full' : 'w-0 group-hover:w-full'"></span>
            </button>

            <!-- Menu Nội Dung + Ảnh Dự Án Lớn -->
            <div id="audio-menu-panel" role="menu" aria-labelledby="audio-menu-trigger" x-show="open" x-cloak @click.outside="closeMenu(false)"
                 @keydown.escape.stop="closeMenu(true)" @keydown.arrow-down.prevent="focusItem(1)" @keydown.arrow-up.prevent="focusItem(-1)" @keydown.home.prevent="focusBoundary('start')" @keydown.end.prevent="focusBoundary('end')"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-2"
                 class="mega-menu-wrapper">
              <div class="mega-menu-surface"><?php get_template_part('views/components/headers/mega/audio'); ?></div>
            </div>
          </div>
          <?php endif; ?>

          <!-- ── DỰ ÁN (CHUYỂN THÀNH MỘT LIST & ẢNH ĐẠI DIỆN LỚN) ── -->
          <?php if (hacoled_header_menu_enabled('projects')) : ?>
          <div class="navitem-relative group/navitem" x-data="hacoledNavMenu('projects-menu')" @mouseenter="openMenu()" @mouseleave="scheduleClose()" @focusout="handleFocusOut($event)">
            <button type="button" x-ref="trigger" id="projects-menu-trigger" @click="toggleMenu()" @keydown.arrow-down.prevent="focusFirst()" @keydown.escape.stop="closeMenu(true)"
               aria-haspopup="menu" aria-controls="projects-menu-panel" :aria-expanded="open.toString()"
               :class="scrolled ? 'py-4' : 'py-2'"
               class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
              <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/></svg>
              <?php echo esc_html(hacoled_header_menu_label('projects')); ?>
              <svg class="w-3 h-3 text-white/50 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : 'group-hover:text-[#fbbf24]'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
              <span class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] bg-[#fbbf24] transition-all duration-300" :class="open ? 'w-full' : 'w-0 group-hover:w-full'"></span>
            </button>

            <!-- Menu Nội Dung + Ảnh Dự Án Lớn -->
            <div id="projects-menu-panel" role="menu" aria-labelledby="projects-menu-trigger" x-show="open" x-cloak @click.outside="closeMenu(false)"
                 @keydown.escape.stop="closeMenu(true)" @keydown.arrow-down.prevent="focusItem(1)" @keydown.arrow-up.prevent="focusItem(-1)" @keydown.home.prevent="focusBoundary('start')" @keydown.end.prevent="focusBoundary('end')"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-2"
                 class="mega-menu-wrapper mega-md">
              <div class="mega-menu-surface"><?php get_template_part('views/components/headers/mega/projects'); ?></div>
            </div>
          </div>
          <?php endif; ?>

          <!-- DỊCH VỤ -->
          <?php if (hacoled_header_menu_enabled('services')) : ?>
          <a href="<?php echo esc_url(hacoled_header_menu_url('services')); ?>"
             :class="scrolled ? 'py-4' : 'py-2'"
             class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
            <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.827M11.42 15.17l2.492-3.396M11.42 15.17l-3.396 2.492m0-5.888l5.888-5.888a2.652 2.652 0 00-3.75-3.75l-5.888 5.888m7.5 7.5l-3.396 2.492m-5.888-5.888L2.25 17.25A2.652 2.652 0 006 21l5.827-5.877"/></svg>
            <?php echo esc_html(hacoled_header_menu_label('services')); ?>
            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-[#fbbf24] transition-all duration-300 group-hover:w-full"></span>
          </a>
          <?php endif; ?>

          <!-- ── TIN TỨC & BLOG (Dropdown Drop) ── -->
          <?php if (hacoled_header_menu_enabled('news')) : ?>
          <div class="inline-block group/navitem relative" x-data="hacoledNavMenu('news-menu')" @mouseenter="openMenu()" @mouseleave="scheduleClose()" @focusout="handleFocusOut($event)">
            <button type="button" x-ref="trigger" id="news-menu-trigger" @click="toggleMenu()" @keydown.arrow-down.prevent="focusFirst()" @keydown.escape.stop="closeMenu(true)"
               aria-haspopup="menu" aria-controls="news-menu-panel" :aria-expanded="open.toString()"
               :class="scrolled ? 'py-4' : 'py-2'"
               class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
              <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
              <?php echo esc_html(hacoled_header_menu_label('news')); ?>
              <svg class="w-3 h-3 text-white/50 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : 'group-hover:text-[#fbbf24]'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
              <span class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] bg-[#fbbf24] transition-all duration-300" :class="open ? 'w-full' : 'w-0 group-hover:w-full'"></span>
            </button>

            <div id="news-menu-panel" role="menu" aria-labelledby="news-menu-trigger" x-show="open" x-cloak @click.outside="closeMenu(false)"
                 @keydown.escape.stop="closeMenu(true)" @keydown.arrow-down.prevent="focusItem(1)" @keydown.arrow-up.prevent="focusItem(-1)" @keydown.home.prevent="focusBoundary('start')" @keydown.end.prevent="focusBoundary('end')"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-2"
                 class="hacoled-dropdown-wrapper">
              <div class="hacoled-dropdown-surface">
                <span class="hacoled-dropdown-arrow" aria-hidden="true"></span>
                <?php hacoled_render_header_dropdown_items($header_menu_configs['news']['items'] ?? []); ?>
              </div>
            </div>
          </div>
          <?php endif; ?>



          <!-- LIÊN HỆ -->
          <?php if (hacoled_header_menu_enabled('contact')) : ?>
          <a href="<?php echo esc_url(hacoled_header_menu_url('contact')); ?>"
             :class="scrolled ? 'py-4' : 'py-2'"
             class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
            <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
            <?php echo esc_html(hacoled_header_menu_label('contact')); ?>
            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-[#fbbf24] transition-all duration-300 group-hover:w-full"></span>
          </a>
          <?php endif; ?>

        </div> <!-- KẾT THÚC CỤM MENU FLEXBOX -->
      </div>
    </nav>

  <!-- ══════════════════════════════════════════════
       MOBILE MENU DRAWER (Giữ nguyên cấu trúc Accordion)
       ══════════════════════════════════════════════ -->
  <div
    id="mobile-menu"
    x-show="mobile" x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 -translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-4"
    class="lg:hidden absolute top-full left-0 w-full max-h-[80vh] overflow-y-auto shadow-2xl mobile-scroll"
    style="background: #a30f14; border-top: 1px solid rgba(255,255,255,0.1);">

    <div class="px-5 py-6 space-y-1 text-white">
      
      <!-- Search Mobile -->
      <div class="pb-4">
        <form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="relative">
          <input type="search" name="s" autocomplete="off" aria-label="Tìm kiếm trên HacoLED" placeholder="Tìm kiếm..." class="w-full rounded-xl pl-10 pr-4 py-3 text-[13px] text-white placeholder-white/60 bg-black/20 border border-white/20 focus:outline-none focus:border-[#fbbf24]" />
          <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-white/50"><svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.602 10.602z"/></svg></span>
        </form>
      </div>

      <?php if (hacoled_header_menu_enabled('home')) : ?><a href="<?php echo esc_url(hacoled_header_menu_url('home')); ?>" class="block px-4 py-3 text-[14px] font-semibold hover:bg-white/10 rounded-xl"><?php echo esc_html(hacoled_header_menu_label('home')); ?></a><?php endif; ?>
      <?php
      foreach (['about', 'led', 'videowall', 'solutions', 'audio', 'projects'] as $mobile_menu_key) {
          hacoled_render_mobile_header_menu($header_menu_configs[$mobile_menu_key] ?? []);
      }
      ?>
      <?php if (hacoled_header_menu_enabled('services')) : ?><a href="<?php echo esc_url(hacoled_header_menu_url('services')); ?>" class="block px-4 py-3 text-[14px] font-semibold hover:bg-white/10 rounded-xl"><?php echo esc_html(hacoled_header_menu_label('services')); ?></a><?php endif; ?>
      <?php hacoled_render_mobile_header_menu($header_menu_configs['news'] ?? []); ?>

      <?php if (hacoled_header_menu_enabled('contact')) : ?><a href="<?php echo esc_url(hacoled_header_menu_url('contact')); ?>" class="block px-4 py-3 text-[14px] font-semibold hover:bg-white/10 rounded-xl"><?php echo esc_html(hacoled_header_menu_label('contact')); ?></a><?php endif; ?>

      <!-- Action Buttons Mobile -->
      <div class="pt-6 pb-2 border-t border-white/10 mt-6 space-y-3 px-1">
        <a href="tel:0342324488" class="flex items-center justify-center gap-2.5 py-3.5 rounded-xl bg-[#fbbf24] text-[#8a0b10] text-[14px] font-extrabold tracking-wider shadow-lg">
          <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.802-5.127-4.106-6.93-6.93l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25z"/></svg>
          GỌI BÁO GIÁ: 034.232.4488
        </a>
      </div>

    </div>
  </div>

  </div> <!-- End Monolithic Wrapper -->
</header>
<?php endif; ?>
