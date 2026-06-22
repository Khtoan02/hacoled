<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
  <noscript>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  </noscript>
  
  

  <style>
    [x-cloak] { display: none !important; }
    php-block { display: none !important; }
    
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
$about_url    = home_url('/gioi-thieu/');
$services_url = home_url('/dich-vu/');
$contact_url  = home_url('/lien-he/');
$news_url     = home_url('/tin-tuc/');
$posts_url    = home_url('/bai-viet/');

$about_page = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-about.php'));
if (!empty($about_page)) $about_url = get_permalink($about_page[0]->ID);

$services_page = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-services.php'));
if (!empty($services_page)) $services_url = get_permalink($services_page[0]->ID);

$contact_page = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-contact.php'));
if (!empty($contact_page)) $contact_url = get_permalink($contact_page[0]->ID);

$logo = home_url('/wp-content/uploads/2026/06/HacoLED-Logo-Moi.png');
$showcase_led   = get_template_directory_uri() . '/assets/images/showcase-led.png';
$showcase_audio = get_template_directory_uri() . '/assets/images/showcase-audio.png';
?>
</php-block>

<!-- ═══════════════════════════════════════════════════════════
     SITE HEADER – Premium V7 (Visual Rich Mega Menus)
     ═══════════════════════════════════════════════════════════ -->
<header
  id="site-header"
  x-data="{ mobile: false, scrolled: false }"
  @scroll.window="scrolled = (window.scrollY > 80)"
  class="site-header hidden lg:block fixed top-0 left-0 z-[200] w-full transition-transform duration-500 ease-out shadow-2xl"
  :class="scrolled ? 'translate-y-[-1px] is-scrolled' : ''">

  <!-- ══ Sắc nét Gold Line ══ -->
  <div class="h-[4px] w-full relative z-20" style="background: linear-gradient(90deg, #b45309, #fbbf24, #fffbeb, #fbbf24, #b45309);"></div>

  <!-- ══ KHỐI NỀN ĐỎ NGUYÊN KHỐI (MONOLITHIC WRAPPER - WITHOUT OVERFLOW-HIDDEN) ══ -->
  <div class="w-full relative">
    
    <!-- LỚP NỀN VÀ TRỐNG ĐỒNG BỊ CẮT BỞI OVERFLOW-HIDDEN -->
    <div class="absolute inset-0 bg-gradient-to-r from-[#b31217] via-[#a30f14] to-[#8a0b10] overflow-hidden pointer-events-none z-0">
      <!-- Pattern chìm cực kỳ tinh tế -->
      <div class="absolute inset-0 opacity-[0.06]" style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 24px 24px;"></div>
      
      <!-- Trống đồng được căn theo logo chính và hiển thị trên toàn bộ chiều cao của header (cả top bar và nav bar) -->
      <div class="max-w-[1440px] mx-auto px-4 lg:px-8 h-full relative">
        <div class="absolute left-4 lg:left-8 top-[40px] -translate-y-1/2" style="width: 160px; height: 80px;">
          <div class="hdr-logo-ds"></div>
        </div>
      </div>
    </div>

    <!-- ── TOP BAR: Logo & Search ── -->
    <div
      id="hdr-top"
      class="w-full relative transition-all duration-300 ease-out py-3.5 lg:py-5"
      :class="scrolled ? 'lg:!py-0 lg:!h-0 lg:!opacity-0 lg:!pointer-events-none overflow-hidden !py-2' : 'py-3.5 lg:py-5'">

      <div class="max-w-[1440px] mx-auto px-4 lg:px-8 flex items-center justify-between gap-6 lg:gap-12 relative z-10">

        <!-- Logo -->
        <div class="hdr-logo">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="hdr-logo-link" aria-label="HacoLED">
            <img src="<?php echo esc_url($logo); ?>" alt="HacoLED" class="h-[72px] w-auto object-contain" />
          </a>
        </div>

        <!-- SEARCH BAR (Sleek Glassmorphism) -->
        <div class="hidden md:block flex-1 max-w-2xl">
          <form method="get" action="<?php echo esc_url(home_url('/')); ?>" role="search" class="relative group">
            <input
              type="search" name="s"
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
            <div class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 group-hover:bg-white group-hover:scale-105 border border-white/30" style="background: rgba(255,255,255,0.1);">
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
            <div class="w-10 h-10 rounded-full flex items-center justify-center relative transition-all duration-300 group-hover:scale-105 border border-[#fbbf24]/50" style="background: rgba(251,191,36,0.15);">
              <span class="absolute inset-0 rounded-full animate-ping opacity-30 bg-[#fbbf24]"></span>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#fbbf24] relative z-10 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.802-5.127-4.106-6.93-6.93l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25z"/></svg>
            </div>
            <div class="leading-tight">
              <span class="block text-[9px] font-bold uppercase tracking-widest text-[#fbbf24]">Hotline báo giá</span>
              <span class="block text-[15px] font-extrabold tracking-wide text-white font-display">034.232.4488</span>
            </div>
          </a>
        </div>

        <!-- Mobile Toggle (Hidden in favor of bottom navigation bar) -->
        <button @click="mobile = !mobile" class="hidden">
          <svg x-show="!mobile" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
          <svg x-show="mobile" x-cloak class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
        </button>

      </div>
    </div>

    <!-- ── NAV BAR: BẮT ĐẦU TỪ TRÁI, GAP CỐ ĐỊNH CHUẨN PIXEL-PERFECT ── -->
    <nav
      id="hdr-nav"
      class="hidden lg:block w-full transition-all duration-300 relative z-20 pt-1 pb-3"
      :class="scrolled ? 'bg-[#b31217] shadow-lg !py-0' : 'pt-1 pb-3'">

      <div class="max-w-[1440px] mx-auto px-4 lg:px-8 flex items-center justify-start w-full relative">

        <!-- Compact Logo (Sticky mode) -->
        <div class="flex-shrink-0 transition-all duration-500 ease-in-out relative w-0 opacity-0 mr-0 pointer-events-none overflow-hidden" :class="scrolled ? '!w-[115px] xl:!w-[125px] !opacity-100 !mr-5 lg:!mr-8 !pointer-events-auto' : 'w-0 opacity-0 mr-0 pointer-events-none'">
          <div class="hdr-logo-ds"></div>
          <a href="<?php echo esc_url(home_url('/')); ?>" :tabindex="scrolled ? 0 : -1" class="block relative z-10">
            <img src="<?php echo esc_url($logo); ?>" alt="HacoLED" class="h-7 w-auto object-contain rounded" />
          </a>
        </div>

        <!-- ── NAV LINKS CONTAINER (Dàn đều cân bằng 2 bên lề) ── -->
        <div class="flex flex-1 items-center justify-between w-full transition-all duration-300">

          <!-- TRANG CHỦ -->
          <a href="<?php echo esc_url(home_url('/')); ?>"
             :class="scrolled ? 'py-4' : 'py-2'"
             class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
            <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
            Trang Chủ
            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-[#fbbf24] transition-all duration-300 group-hover:w-full"></span>
          </a>

          <!-- GIỚI THIỆU (DROPDOWN) -->
          <div class="relative group/navitem" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
            <button @click="open = !open"
               :class="scrolled ? 'py-4' : 'py-2'"
               class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
              <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
              Về HacoLED
              <svg class="w-3 h-3 text-white/50 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : 'group-hover:text-[#fbbf24]'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
              <span class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] bg-[#fbbf24] transition-all duration-300" :class="open ? 'w-full' : 'w-0 group-hover:w-full'"></span>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" x-cloak @click.away="open = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-2"
                 class="absolute top-full left-1/2 -translate-x-1/2 translate-y-[15px] w-64 bg-white rounded-2xl shadow-[0_20px_40px_-15px_rgba(0,0,0,0.1)] border border-slate-100/50 p-3 z-[150]">
              
              <!-- Indicator arrow pointing up -->
              <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white rotate-45 border-l border-t border-slate-100/50"></div>

              <div class="relative z-10 flex flex-col space-y-1">
                <a href="<?php echo esc_url($about_url); ?>" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors group/link">
                  <div class="w-8 h-8 rounded-lg bg-red-50 text-[#b31217] flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                  </div>
                  <div class="text-[13.5px] font-bold text-slate-700 group-hover/link:text-[#b31217] transition-colors whitespace-nowrap">Giới thiệu chung</div>
                </a>
                
                <a href="<?php echo esc_url(home_url('/cam-ket-chat-luong/')); ?>" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors group/link">
                  <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                  </div>
                  <div class="text-[13.5px] font-bold text-slate-700 group-hover/link:text-[#b31217] transition-colors whitespace-nowrap">Cam kết chất lượng</div>
                </a>
                
                <a href="<?php echo esc_url(home_url('/tuyen-dung/')); ?>" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors group/link">
                  <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                  </div>
                  <div class="text-[13.5px] font-bold text-slate-700 group-hover/link:text-[#b31217] transition-colors whitespace-nowrap">Tuyển dụng</div>
                </a>
                
                <a href="<?php echo esc_url(home_url('/su-kien/')); ?>" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors group/link">
                  <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                  </div>
                  <div class="text-[13.5px] font-bold text-slate-700 group-hover/link:text-[#b31217] transition-colors whitespace-nowrap">Sự kiện</div>
                </a>
              </div>
            </div>
          </div>

          <!-- ── MÀN HÌNH LED (MEGA MENU TẠP CHÍ + ẢNH MỚI) ── -->
          <div class="navitem-relative group/navitem" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
            <button @click="open = !open" 
               :class="scrolled ? 'py-4' : 'py-2'"
               class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
              <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h17.25c.621 0 1.125-.504 1.125-1.125V4.875c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125z"/></svg>
              Màn Hình LED
              <svg class="w-3 h-3 text-white/50 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : 'group-hover:text-[#fbbf24]'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
              <span class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] bg-[#fbbf24] transition-all duration-300" :class="open ? 'w-full' : 'w-0 group-hover:w-full'"></span>
            </button>

            <!-- Menu Nội Dung + Ảnh Dự Án Lớn -->
            <div x-show="open" x-cloak @click.away="open = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-2"
                 class="mega-menu-wrapper">
              <?php get_template_part('views/components/headers/mega/led'); ?>
            </div>
          </div>

          <!-- ── MÀN HÌNH GHÉP (MINI MEGA MENU) ── -->
          <div class="navitem-relative group/navitem" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
            <button @click="open = !open" 
               :class="scrolled ? 'py-4' : 'py-2'"
               class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
              <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z"/></svg>
              Màn Hình Ghép
              <svg class="w-3 h-3 text-white/50 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : 'group-hover:text-[#fbbf24]'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
              <span class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] bg-[#fbbf24] transition-all duration-300" :class="open ? 'w-full' : 'w-0 group-hover:w-full'"></span>
            </button>

            <!-- Menu Nội Dung + Ảnh Dự Án Lớn -->
            <div x-show="open" x-cloak @click.away="open = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-2"
                 class="mega-menu-wrapper mega-sm">
              <?php get_template_part('views/components/headers/mega/videowall'); ?>
            </div>
          </div>

          <!-- ── GIẢI PHÁP (GRID LƯỚI HÌNH ẢNH CỰC ĐỈNH) ── -->
          <div class="navitem-relative group/navitem" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
            <button @click="open = !open" 
               :class="scrolled ? 'py-4' : 'py-2'"
               class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
              <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.82 1.508-2.316a7.5 7.5 0 10-7.516 0c.85.496 1.508 1.333 1.508 2.316V18"/></svg>
              Giải Pháp
              <svg class="w-3 h-3 text-white/50 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : 'group-hover:text-[#fbbf24]'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
              <span class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] bg-[#fbbf24] transition-all duration-300" :class="open ? 'w-full' : 'w-0 group-hover:w-full'"></span>
            </button>

            <!-- Menu Nội Dung + Ảnh Dự Án Lớn -->
            <div x-show="open" x-cloak @click.away="open = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-2"
                 class="mega-menu-wrapper">
              <?php get_template_part('views/components/headers/mega/solutions'); ?>
            </div>
          </div>

          <!-- ── ÂM THANH (BỔ SUNG VISUAL CARD BÊN PHẢI) ── -->
          <div class="navitem-relative group/navitem" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
            <button @click="open = !open" 
               :class="scrolled ? 'py-4' : 'py-2'"
               class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
              <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/></svg>
              Âm Thanh
              <svg class="w-3 h-3 text-white/50 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : 'group-hover:text-[#fbbf24]'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
              <span class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] bg-[#fbbf24] transition-all duration-300" :class="open ? 'w-full' : 'w-0 group-hover:w-full'"></span>
            </button>

            <!-- Menu Nội Dung + Ảnh Dự Án Lớn -->
            <div x-show="open" x-cloak @click.away="open = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-2"
                 class="mega-menu-wrapper">
              <?php get_template_part('views/components/headers/mega/audio'); ?>
            </div>
          </div>

          <!-- ── DỰ ÁN (CHUYỂN THÀNH MỘT LIST & ẢNH ĐẠI DIỆN LỚN) ── -->
          <div class="navitem-relative group/navitem" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
            <button @click="open = !open" 
               :class="scrolled ? 'py-4' : 'py-2'"
               class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
              <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/></svg>
              Dự án đã thực hiện
              <svg class="w-3 h-3 text-white/50 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : 'group-hover:text-[#fbbf24]'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
              <span class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] bg-[#fbbf24] transition-all duration-300" :class="open ? 'w-full' : 'w-0 group-hover:w-full'"></span>
            </button>

            <!-- Menu Nội Dung + Ảnh Dự Án Lớn -->
            <div x-show="open" x-cloak @click.away="open = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-2"
                 class="mega-menu-wrapper mega-md">
              <?php get_template_part('views/components/headers/mega/projects'); ?>
            </div>
          </div>

          <!-- DỊCH VỤ -->
          <a href="<?php echo esc_url($services_url); ?>"
             :class="scrolled ? 'py-4' : 'py-2'"
             class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
            <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.827M11.42 15.17l2.492-3.396M11.42 15.17l-3.396 2.492m0-5.888l5.888-5.888a2.652 2.652 0 00-3.75-3.75l-5.888 5.888m7.5 7.5l-3.396 2.492m-5.888-5.888L2.25 17.25A2.652 2.652 0 006 21l5.827-5.877"/></svg>
            Dịch Vụ
            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-[#fbbf24] transition-all duration-300 group-hover:w-full"></span>
          </a>

          <!-- ── TIN TỨC & BLOG (Dropdown Drop) ── -->
          <div class="inline-block group/navitem relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
            <button @click="open = !open" 
               :class="scrolled ? 'py-4' : 'py-2'"
               class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
              <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
              Tin Tức & Blog
              <svg class="w-3 h-3 text-white/50 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : 'group-hover:text-[#fbbf24]'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
              <span class="absolute bottom-0 left-1/2 -translate-x-1/2 h-[2px] bg-[#fbbf24] transition-all duration-300" :class="open ? 'w-full' : 'w-0 group-hover:w-full'"></span>
            </button>

            <div x-show="open" x-cloak @click.away="open = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 translate-y-2"
                 class="absolute top-full left-1/2 -translate-x-1/2 translate-y-[15px] w-64 bg-white rounded-2xl shadow-[0_20px_40px_-15px_rgba(0,0,0,0.1)] border border-slate-100/50 p-3 z-[150]">
              
              <!-- Indicator arrow pointing up -->
              <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white rotate-45 border-l border-t border-slate-100/50"></div>

              <div class="relative z-10 flex flex-col space-y-1">
                <a href="<?php echo esc_url(home_url('/blog-man-hinh-led/')); ?>" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors group/link">
                  <div class="w-8 h-8 rounded-lg bg-red-50 text-[#b31217] flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h17.25c.621 0 1.125-.504 1.125-1.125V4.875c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125z"/></svg>
                  </div>
                  <div class="text-[13.5px] font-bold text-slate-700 group-hover/link:text-[#b31217] transition-colors whitespace-nowrap">Blog về màn hình LED</div>
                </a>
                
                <a href="<?php echo esc_url(home_url('/blog-am-thanh/')); ?>" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors group/link">
                  <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/></svg>
                  </div>
                  <div class="text-[13.5px] font-bold text-slate-700 group-hover/link:text-[#b31217] transition-colors whitespace-nowrap">Blog về âm thanh</div>
                </a>
                
                <a href="<?php echo esc_url(home_url('/kien-thuc-ky-thuat/')); ?>" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors group/link">
                  <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                  </div>
                  <div class="text-[13.5px] font-bold text-slate-700 group-hover/link:text-[#b31217] transition-colors whitespace-nowrap">Hướng dẫn kỹ thuật</div>
                </a>

                <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition-colors group/link">
                  <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/></svg>
                  </div>
                  <div class="text-[13.5px] font-bold text-slate-700 group-hover/link:text-[#b31217] transition-colors whitespace-nowrap">Tin Tức</div>
                </a>
              </div>
            </div>
          </div>



          <!-- LIÊN HỆ -->
          <a href="<?php echo esc_url($contact_url); ?>"
             :class="scrolled ? 'py-4' : 'py-2'"
             class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
            <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
            Liên Hệ
            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-[#fbbf24] transition-all duration-300 group-hover:w-full"></span>
          </a>

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
          <input type="search" name="s" placeholder="Tìm kiếm..." class="w-full rounded-xl pl-10 pr-4 py-3 text-[13px] text-white placeholder-white/60 bg-black/20 border border-white/20 focus:outline-none focus:border-[#fbbf24]" />
          <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-white/50"><svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.602 10.602z"/></svg></span>
        </form>
      </div>

      <a href="<?php echo esc_url(home_url('/')); ?>" class="block px-4 py-3 text-[14px] font-semibold hover:bg-white/10 rounded-xl">Trang Chủ</a>
      <a href="<?php echo esc_url($about_url); ?>" class="block px-4 py-3 text-[14px] font-semibold hover:bg-white/10 rounded-xl">Về HacoLED</a>

      <!-- Accordion Mobile: Màn Hình LED -->
      <div x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-[14px] font-semibold hover:bg-white/10 focus:outline-none">
          <span>Màn Hình LED</span>
          <svg class="w-4 h-4 text-white/70 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
        </button>
        <div x-show="open" x-cloak class="pl-6 pr-2 pb-2 mt-1 border-l border-white/20 ml-2 space-y-1 max-h-[350px] overflow-y-auto">
          <p class="pt-2 pb-1 text-[10px] font-bold uppercase tracking-widest text-[#fbbf24]">LED Trong Nhà</p>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p0-9-trong-nha/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED P0.9</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p1-25-trong-nha/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED P1.25</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p1-53-trong-nha/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED P1.53</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p1-8-trong-nha/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED P1.8</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p2-trong-nha/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED P2</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p2-5-trong-nha/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED P2.5</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p3-trong-nha/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED P3</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p3-0-trong-nha/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED P3.0</a>
          
          <p class="pt-3 pb-1 text-[10px] font-bold uppercase tracking-widest text-[#fbbf24]">LED Ngoài Trời</p>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p2-5-ngoai-troi/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED P2.5</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p3-ngoai-troi/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED P3</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p4-ngoai-troi/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED P4</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p5-ngoai-troi/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED P5</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p10-ngoai-troi/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED P10</a>

          <p class="pt-3 pb-1 text-[10px] font-bold uppercase tracking-widest text-[#fbbf24]">Giải pháp LED</p>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-hoi-truong/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED Hội trường</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-phong-hop-hoi-truong/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED Phòng họp</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-san-khau/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED Sân khấu</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-truong-hoc/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED Trường học</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-tiec-cuoi-nha-hang/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED Tiệc, đám cưới</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-studio/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED Studio</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-100-200-300-inch/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED 100, 200, 300 inch</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-trong-suot/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED Trong suốt</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-film-dan-kinh/')); ?>" class="block py-1.5 text-[13px] text-white/80 hover:text-white">LED Film dán kính</a>
        </div>
      </div>

      <!-- Accordion Mobile: Màn hình ghép -->
      <div x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-[14px] font-semibold hover:bg-white/10 focus:outline-none">
          <span>Màn hình ghép</span>
          <svg class="w-4 h-4 text-white/70 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
        </button>
        <div x-show="open" x-cloak class="pl-6 pr-2 pb-2 mt-1 border-l border-white/20 ml-2 space-y-1">
          <a href="<?php echo esc_url(home_url('/man-hinh-ghep-boe/')); ?>" class="block py-2 text-[13px] text-white/80 hover:text-white">Màn hình ghép BOE</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-ghep-orion/')); ?>" class="block py-2 text-[13px] text-white/80 hover:text-white">Màn hình ghép Orion</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-ghep-vestel/')); ?>" class="block py-2 text-[13px] text-white/80 hover:text-white">Màn hình ghép Vestel</a>
        </div>
      </div>

      <!-- Accordion Mobile: Âm thanh -->
      <div x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-[14px] font-semibold hover:bg-white/10 focus:outline-none">
          <span>Âm thanh</span>
          <svg class="w-4 h-4 text-white/70 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
        </button>
        <div x-show="open" x-cloak class="pl-6 pr-2 pb-2 mt-1 border-l border-white/20 ml-2 space-y-3">
          <!-- DBACOUSTIC Group -->
          <div>
            <div class="text-[11px] font-extrabold uppercase tracking-[0.08em] text-[#fbbf24] mb-1">DBACOUSTIC</div>
            <div class="space-y-1">
              <a href="<?php echo esc_url(home_url('/dbacoustic-loa/')); ?>" class="block py-1 text-[13px] text-white/80 hover:text-white">Loa</a>
              <a href="<?php echo esc_url(home_url('/dbacoustic-amply/')); ?>" class="block py-1 text-[13px] text-white/80 hover:text-white">Amply</a>
              <a href="<?php echo esc_url(home_url('/dbacoustic-micro/')); ?>" class="block py-1 text-[13px] text-white/80 hover:text-white">Micro</a>
              <a href="<?php echo esc_url(home_url('/loa-sieu-tram-sub/')); ?>" class="block py-1 text-[13px] text-white/80 hover:text-white">Loa siêu trầm - Sub</a>
              <a href="<?php echo esc_url(home_url('/day-cong-suat-dbacoustic/')); ?>" class="block py-1 text-[13px] text-white/80 hover:text-white">Đẩy công suất</a>
              <a href="<?php echo esc_url(home_url('/vangso-mixer-crossover-dbacoustic/')); ?>" class="block py-1 text-[13px] text-white/80 hover:text-white">Vang số, Mixer, Crossover</a>
              <a href="<?php echo esc_url(home_url('/quan-ly-nguon-dbacoustic/')); ?>" class="block py-1 text-[13px] text-white/80 hover:text-white">Quản lý nguồn</a>
            </div>
          </div>
          <!-- TD CLASSIC Group -->
          <div>
            <div class="text-[11px] font-extrabold uppercase tracking-[0.08em] text-[#fbbf24] mb-1">TD CLASSIC</div>
            <div class="space-y-1">
              <a href="<?php echo esc_url(home_url('/loa-tdclassic/')); ?>" class="block py-1 text-[13px] text-white/80 hover:text-white">Loa</a>
              <a href="<?php echo esc_url(home_url('/micro-tdclassic/')); ?>" class="block py-1 text-[13px] text-white/80 hover:text-white">Micro</a>
              <a href="<?php echo esc_url(home_url('/amply-tdclassic/')); ?>" class="block py-1 text-[13px] text-white/80 hover:text-white">Amply</a>
              <a href="<?php echo esc_url(home_url('/vang-so-tdclassic/')); ?>" class="block py-1 text-[13px] text-white/80 hover:text-white">Vang số</a>
              <a href="<?php echo esc_url(home_url('/phu-kien-am-thanh-tdclassic/')); ?>" class="block py-1 text-[13px] text-white/80 hover:text-white">Phụ kiện âm thanh</a>
            </div>
          </div>
          <!-- CF AUDIO Group -->
          <div>
            <div class="text-[11px] font-extrabold uppercase tracking-[0.08em] text-[#fbbf24] mb-1">CF AUDIO</div>
            <div class="space-y-1">
              <a href="<?php echo esc_url(home_url('/cfaudio-loa/')); ?>" class="block py-1 text-[13px] text-white/80 hover:text-white">Loa</a>
            </div>
          </div>
          <!-- PEAVEY Group -->
          <div>
            <div class="text-[11px] font-extrabold uppercase tracking-[0.08em] text-[#fbbf24] mb-1">PEAVEY</div>
            <div class="space-y-1">
              <a href="<?php echo esc_url(home_url('/peavey-loa/')); ?>" class="block py-1 text-[13px] text-white/80 hover:text-white">Loa</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Accordion Mobile: Dự án đã thực hiện -->
      <div x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-[14px] font-semibold hover:bg-white/10 focus:outline-none">
          <span>Dự án đã thực hiện</span>
          <svg class="w-4 h-4 text-white/70 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
        </button>
        <div x-show="open" x-cloak class="pl-6 pr-2 pb-2 mt-1 border-l border-white/20 ml-2 space-y-1">
          <a href="<?php echo esc_url(home_url('/du-an-trong-nha/')); ?>" class="block py-2 text-[13px] text-white/80 hover:text-white">Dự án trong nhà</a>
          <a href="<?php echo esc_url(home_url('/du-an-ngoai-troi/')); ?>" class="block py-2 text-[13px] text-white/80 hover:text-white">Dự án ngoài trời</a>
          <a href="<?php echo esc_url(home_url('/du-an-truong-hoc/')); ?>" class="block py-2 text-[13px] text-white/80 hover:text-white">Dự án trường học</a>
          <a href="<?php echo esc_url(home_url('/du-an-man-hinh-ghep/')); ?>" class="block py-2 text-[13px] text-white/80 hover:text-white">Dự án màn hình ghép</a>
          <a href="<?php echo esc_url(home_url('/du-an-am-thanh/')); ?>" class="block py-2 text-[13px] text-white/80 hover:text-white">Dự án âm thanh</a>
        </div>
      </div>
      <a href="<?php echo esc_url($services_url); ?>" class="block px-4 py-3 text-[14px] font-semibold hover:bg-white/10 rounded-xl">Dịch Vụ</a>
      <a href="<?php echo esc_url($news_url); ?>" class="block px-4 py-3 text-[14px] font-semibold hover:bg-white/10 rounded-xl">Tin Tức & Blog</a>
      <!-- Accordion Mobile: Tuyển Dụng -->
      <div x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-[14px] font-semibold hover:bg-white/10 focus:outline-none">
          <span>Tuyển Dụng</span>
          <svg class="w-4 h-4 text-white/70 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
        </button>
        <div x-show="open" x-cloak class="pl-6 pr-2 pb-2 mt-1 border-l border-white/20 ml-2 space-y-1">
          <?php
          if ($jobs) {
              foreach ($jobs as $job) {
                  $job_link = get_permalink($job->ID);
                  $job_title = esc_html(get_the_title($job->ID));
                  echo '<a href="' . esc_url($job_link) . '" class="block py-2 text-[13px] text-white/80 hover:text-white">' . $job_title . '</a>';
              }
          }
          ?>
          <a href="<?php echo home_url('/tuyen-dung/'); ?>" class="block py-2 text-[13px] font-bold text-[#fbbf24] mt-2">Xem tất cả vị trí →</a>
        </div>
      </div>
      <a href="<?php echo esc_url($contact_url); ?>" class="block px-4 py-3 text-[14px] font-semibold hover:bg-white/10 rounded-xl">Liên Hệ</a>

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