<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
            display: ['Outfit', 'sans-serif'],
          }
        }
      }
    }
  </script>

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

$logo = get_template_directory_uri() . '/assets/images/logo-haco.png';
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
  class="fixed top-0 left-0 z-[200] w-full transition-transform duration-500 ease-out shadow-2xl"
  :class="scrolled ? 'translate-y-[-1px]' : ''">

  <!-- ══ Sắc nét Gold Line ══ -->
  <div class="h-[4px] w-full relative z-20" style="background: linear-gradient(90deg, #b45309, #fbbf24, #fffbeb, #fbbf24, #b45309);"></div>

  <!-- ══ KHỐI NỀN ĐỎ NGUYÊN KHỐI (MONOLITHIC WRAPPER) ══ -->
  <div class="w-full relative bg-gradient-to-r from-[#b31217] via-[#a30f14] to-[#8a0b10]">
    
    <!-- Pattern chìm cực kỳ tinh tế -->
    <div class="absolute inset-0 opacity-[0.06] pointer-events-none" style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 24px 24px;"></div>

    <!-- ── TOP BAR: Logo & Search ── -->
    <div
      id="hdr-top"
      class="w-full relative transition-all duration-300 ease-out"
      :class="scrolled ? 'lg:py-0 lg:h-0 lg:opacity-0 lg:pointer-events-none overflow-hidden py-2' : 'py-3.5 lg:py-5'">

      <div class="max-w-[1400px] mx-auto px-4 lg:px-8 flex items-center justify-between gap-6 lg:gap-12 relative z-10">

        <!-- LOGO -->
        <div class="flex-shrink-0 transition-transform duration-300 hover:scale-[1.02]" style="min-width:140px;">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center">
            <svg class="h-8 lg:h-11 w-auto transition-all duration-300 drop-shadow-md" viewBox="0 0 160 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10 5H18V18H32V5H40V35H32V25H18V35H10V5Z" fill="#FFF"/>
              <path d="M55 5L66 35H57L55 29H47L45 35H37L48 5H55ZM51 11L48.5 22.5H53.5L51 11Z" fill="#FFF"/>
              <path d="M85 10C80 10 74 13 74 20C74 27 80 30 85 30C89 30 92 28 94 25L99 29C96 33 91 36 84 36C71 36 65 28 65 20C65 12 71 4 84 4C91 4 96 7 99 11L94 15C92 12 89 10 85 10Z" fill="#FFF"/>
              <path d="M115 4C102 4 96 12 96 20C96 28 102 36 115 36C128 36 134 28 134 20C134 12 128 4 115 4ZM115 30C108 30 105 25 105 20C105 15 108 10 115 10C122 10 125 15 125 20C125 25 122 30 115 30Z" fill="#fbbf24"/>
              <path d="M140 5V35H158V29H148V5H140Z" fill="#fbbf24"/>
            </svg>
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

        <!-- Mobile Toggle -->
        <button @click="mobile = !mobile" class="lg:hidden ml-auto p-2 rounded-xl text-white hover:bg-white/10 border border-white/20">
          <svg x-show="!mobile" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
          <svg x-show="mobile" x-cloak class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
        </button>

      </div>
    </div>

    <!-- ── NAV BAR: BẮT ĐẦU TỪ TRÁI, GAP CỐ ĐỊNH CHUẨN PIXEL-PERFECT ── -->
    <nav
      id="hdr-nav"
      class="hidden lg:block w-full transition-all duration-300 relative z-20"
      :class="scrolled ? 'bg-[#b31217] shadow-lg py-0' : 'pt-1 pb-3'">

      <div class="max-w-[1400px] mx-auto px-4 lg:px-8 flex items-center justify-start w-full relative">

        <!-- Compact Logo (Sticky mode) -->
        <div class="flex-shrink-0 overflow-hidden transition-all duration-500 ease-in-out" :class="scrolled ? 'w-[100px] xl:w-[110px] opacity-100 mr-5 lg:mr-8' : 'w-0 opacity-0 mr-0 pointer-events-none'">
          <a href="<?php echo esc_url(home_url('/')); ?>" :tabindex="scrolled ? 0 : -1" class="block">
            <svg class="h-7 w-auto" viewBox="0 0 160 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10 5H18V18H32V5H40V35H32V25H18V35H10V5Z" fill="#FFF"/>
              <path d="M55 5L66 35H57L55 29H47L45 35H37L48 5H55ZM51 11L48.5 22.5H53.5L51 11Z" fill="#FFF"/>
              <path d="M85 10C80 10 74 13 74 20C74 27 80 30 85 30C89 30 92 28 94 25L99 29C96 33 91 36 84 36C71 36 65 28 65 20C65 12 71 4 84 4C91 4 96 7 99 11L94 15C92 12 89 10 85 10Z" fill="#FFF"/>
              <path d="M115 4C102 4 96 12 96 20C96 28 102 36 115 36C128 36 134 28 134 20C134 12 128 4 115 4ZM115 30C108 30 105 25 105 20C105 15 108 10 115 10C122 10 125 15 125 20C125 25 122 30 115 30Z" fill="#fbbf24"/>
              <path d="M140 5V35H158V29H148V5H140Z" fill="#fbbf24"/>
            </svg>
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

          <!-- GIỚI THIỆU -->
          <a href="<?php echo esc_url($about_url); ?>"
             :class="scrolled ? 'py-4' : 'py-2'"
             class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
            <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
            Về HacoLED
            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-[#fbbf24] transition-all duration-300 group-hover:w-full"></span>
          </a>

          <!-- ── MÀN HÌNH LED (MEGA MENU TẠP CHÍ + ẢNH MỚI) ── -->
          <div class="inline-block group/navitem">
            <button 
               :class="scrolled ? 'py-4' : 'py-2'"
               class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
              <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h17.25c.621 0 1.125-.504 1.125-1.125V4.875c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125z"/></svg>
              Màn Hình LED
              <svg class="w-3 h-3 text-white/50 group-hover:text-[#fbbf24] group-hover/navitem:rotate-180 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
              <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-[#fbbf24] transition-all duration-300 group-hover/navitem:w-full"></span>
            </button>

            <!-- Menu Nội Dung + Ảnh Dự Án Lớn -->
            <div class="absolute top-full left-1/2 -translate-x-1/2 translate-y-[15px] bg-white rounded-b-[24px] shadow-[0_40px_80px_-20px_rgba(0,0,0,0.3)] border-t-[3px] border-[#b31217] z-[150] opacity-0 invisible pointer-events-none transition-all duration-300 ease-out group-hover/navitem:opacity-100 group-hover/navitem:visible group-hover/navitem:pointer-events-auto group-hover/navitem:translate-y-0 overflow-hidden flex" style="width: 1040px; min-height: 380px;">
              <div class="w-2/3 grid grid-cols-2 gap-10 p-10">
                <div>
                  <div class="text-[11px] font-extrabold uppercase tracking-[0.08em] text-slate-400 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#b31217]"></span> LED Trong Nhà
                  </div>
                  <div class="space-y-1.5">
                    <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">LED P0.9 Trong Nhà</a>
                    <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">LED P1.25 Siêu Mịn</a>
                    <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">LED P1.53 Phòng Họp</a>
                    <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">LED P1.8 Hội Trường</a>
                    <a href="#" class="flex items-center justify-between text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">
                      <span>LED P2 Cao Cấp</span><span class="text-[9px] font-black py-0.5 px-2 rounded bg-red-50 text-red-600 tracking-wider">HOT</span>
                    </a>
                    <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">LED P2.5 Bán Chạy</a>
                    <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">LED P3 Hội Trường</a>
                  </div>
                </div>
                <div>
                  <div class="text-[11px] font-extrabold uppercase tracking-[0.08em] text-slate-400 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> LED Ngoài Trời
                  </div>
                  <div class="space-y-1.5">
                    <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">LED P2.5 Ngoài Trời</a>
                    <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">LED P3 Ngoài Trời</a>
                    <a href="#" class="flex items-center justify-between text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">
                      <span>LED P4 Ngoài Trời</span><span class="text-[9px] font-black py-0.5 px-2 rounded bg-amber-50 text-amber-600 tracking-wider">PRO</span>
                    </a>
                    <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">LED P5 Quảng Cáo</a>
                    <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">LED P10 Tấm Lớn</a>
                  </div>
                </div>
              </div>
              
              <!-- Cột Ảnh Visual Nổi Bật -->
              <div class="w-1/3 bg-slate-50 relative overflow-hidden group/card block cursor-pointer">
                <!-- Hình nền mờ -->
                <img src="<?php echo $showcase_led; ?>" data-fallback="https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=600&q=80" alt="Dự án màn hình LED" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover/card:scale-110" />
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent"></div>
                
                <!-- Nội dung Overlay -->
                <div class="absolute bottom-0 left-0 w-full p-8 flex flex-col justify-end">
                  <span class="inline-block text-[10px] font-black uppercase tracking-widest px-2 py-1 rounded bg-[#b31217] text-white w-max mb-3">Dự Án Nổi Bật</span>
                  <h4 class="text-[16px] font-bold text-white mb-2 leading-tight drop-shadow-md">Giải pháp Màn hình LED P1.53 Phòng Khánh Tiết EVN</h4>
                  <div class="flex items-center gap-2 text-[13px] font-medium text-amber-400 group-hover/card:text-white transition-colors">
                    Xem dự án ngay <svg class="w-4 h-4 transition-transform group-hover/card:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- ── MÀN HÌNH GHÉP (BỔ SUNG ẢNH VISUAL VIDEO WALL) ── -->
          <div class="inline-block group/navitem">
            <button 
               :class="scrolled ? 'py-4' : 'py-2'"
               class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
              <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>
              Màn Hình Ghép
              <svg class="w-3 h-3 text-white/50 group-hover:text-[#fbbf24] group-hover/navitem:rotate-180 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
              <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-[#fbbf24] transition-all duration-300 group-hover/navitem:w-full"></span>
            </button>

            <!-- Flex 2/3 Text - 1/3 Visual -->
            <div class="absolute top-full left-1/2 -translate-x-1/2 translate-y-[15px] bg-white rounded-b-[24px] shadow-[0_40px_80px_-20px_rgba(0,0,0,0.3)] border-t-[3px] border-[#b31217] z-[150] opacity-0 invisible pointer-events-none transition-all duration-300 ease-out group-hover/navitem:opacity-100 group-hover/navitem:visible group-hover/navitem:pointer-events-auto group-hover/navitem:translate-y-0 overflow-hidden flex" style="width: 1040px; min-height: 380px;">
              <div class="w-2/3 grid grid-cols-2 gap-10 p-10">
                <!-- Col 1 -->
                <div>
                  <div class="text-[11px] font-extrabold uppercase tracking-[0.08em] text-slate-400 border-b border-slate-100 pb-3 mb-4">Thương Hiệu</div>
                  <div class="space-y-1.5">
                    <a href="#" class="flex items-center justify-between text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform"><span>Màn Hình Ghép BOE</span><span class="text-[9px] font-black py-0.5 px-2 rounded bg-red-50 text-red-600 tracking-wider">TOP</span></a>
                    <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Màn Hình Ghép Orion</a>
                    <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Màn Hình Ghép LG</a>
                    <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Màn Hình Ghép Samsung</a>
                    <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Màn Hình Ghép Vestel</a>
                  </div>
                </div>
                <!-- Col 2 -->
                <div>
                  <div class="text-[11px] font-extrabold uppercase tracking-[0.08em] text-slate-400 border-b border-slate-100 pb-3 mb-4">Thông Số & Kích Thước</div>
                  <div class="space-y-1.5">
                    <a href="#" class="block text-[14px] font-bold text-slate-800 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Viền Siêu Mỏng 0.88 mm</a>
                    <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Viền Ghép 1.74 mm</a>
                    <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Viền Ghép 3.5 mm</a>
                    <div class="h-2"></div>
                    <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Kích Thước 49 inches</a>
                    <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Kích Thước 55 inches</a>
                  </div>
                </div>
              </div>
              <!-- Col 3: Visual Image -->
              <div class="w-1/3 relative overflow-hidden group/card block cursor-pointer">
                <img src="#" data-fallback="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=600&q=80" alt="Giải pháp Video Wall" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover/card:scale-110" />
                <div class="absolute inset-0 bg-gradient-to-t from-[#b31217]/90 via-slate-900/40 to-transparent"></div>
                
                <div class="absolute bottom-0 left-0 w-full p-8 flex flex-col justify-end">
                  <span class="inline-block text-[10px] font-black uppercase tracking-widest px-2 py-1 rounded bg-[#fbbf24] text-slate-900 w-max mb-3">Trung Tâm Điều Hành (NOC)</span>
                  <h4 class="text-[16px] font-bold text-white mb-2 leading-tight drop-shadow-md">Trải nghiệm khả năng hiển thị không giới hạn với Video Wall</h4>
                </div>
              </div>
            </div>
          </div>

          <!-- ── GIẢI PHÁP (GRID LƯỚI HÌNH ẢNH CỰC ĐỈNH) ── -->
          <div class="inline-block group/navitem">
            <button 
               :class="scrolled ? 'py-4' : 'py-2'"
               class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
              <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.82 1.508-2.316a7.5 7.5 0 10-7.516 0c.85.496 1.508 1.333 1.508 2.316V18"/></svg>
              Giải Pháp
              <svg class="w-3 h-3 text-white/50 group-hover:text-[#fbbf24] group-hover/navitem:rotate-180 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
              <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-[#fbbf24] transition-all duration-300 group-hover/navitem:w-full"></span>
            </button>

            <!-- Lưới Image Cards 1/3 List, 2/3 Image Grid -->
            <div class="absolute top-full left-1/2 -translate-x-1/2 translate-y-[15px] bg-white rounded-b-[24px] shadow-[0_40px_80px_-20px_rgba(0,0,0,0.3)] border-t-[3px] border-[#b31217] z-[150] opacity-0 invisible pointer-events-none transition-all duration-300 ease-out group-hover/navitem:opacity-100 group-hover/navitem:visible group-hover/navitem:pointer-events-auto group-hover/navitem:translate-y-0 overflow-hidden flex" style="width: 1100px; min-height: 400px;">
              
              <!-- Text Links Column -->
              <div class="w-1/3 p-10 border-r border-slate-100">
                <div class="text-[11px] font-extrabold uppercase tracking-[0.08em] text-slate-400 border-b border-slate-100 pb-3 mb-4">Dịch Vụ & Giải Pháp Khác</div>
                <div class="space-y-1.5">
                  <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Quảng Cáo Ngoài Trời (OOH)</a>
                  <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">LED Trong Suốt (Transparent)</a>
                  <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Màn Hình Tương Tác Cảm Ứng</a>
                  <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Thi Công Trọn Gói 63 Tỉnh Thành</a>
                </div>
                <div class="mt-8">
                  <a href="#" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-[13px] font-bold text-[#b31217] bg-red-50 hover:bg-red-100 transition-colors">Tất cả giải pháp →</a>
                </div>
              </div>

              <!-- Visual Image Grid -->
              <div class="w-2/3 bg-slate-50 p-8 grid grid-cols-2 gap-4">
                <!-- Card 1 -->
                <div class="relative rounded-xl overflow-hidden group/card shadow-sm h-full cursor-pointer">
                  <img src="#" data-fallback="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?auto=format&fit=crop&w=400&q=80" alt="Phòng họp" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover/card:scale-110" />
                  <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 to-transparent"></div>
                  <div class="absolute bottom-4 left-5 text-white">
                    <h5 class="font-bold text-[15px] mb-1">Phòng Họp Trực Tuyến</h5>
                    <p class="text-[11px] text-slate-300">Giải pháp hội nghị cao cấp</p>
                  </div>
                </div>
                <!-- Card 2 -->
                <div class="relative rounded-xl overflow-hidden group/card shadow-sm h-full cursor-pointer">
                  <img src="#" data-fallback="https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?auto=format&fit=crop&w=400&q=80" alt="Hội trường" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover/card:scale-110" />
                  <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 to-transparent"></div>
                  <div class="absolute bottom-4 left-5 text-white">
                    <h5 class="font-bold text-[15px] mb-1">Hội Trường Sự Kiện</h5>
                    <p class="text-[11px] text-slate-300">Hiển thị sắc nét, góc nhìn rộng</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- ── ÂM THANH (BỔ SUNG VISUAL CARD BÊN PHẢI) ── -->
          <div class="inline-block group/navitem">
            <button 
               :class="scrolled ? 'py-4' : 'py-2'"
               class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
              <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/></svg>
              Âm Thanh
              <svg class="w-3 h-3 text-white/50 group-hover:text-[#fbbf24] group-hover/navitem:rotate-180 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
              <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-[#fbbf24] transition-all duration-300 group-hover/navitem:w-full"></span>
            </button>

            <!-- Flex layout for Audio Menu -->
            <div class="absolute top-full left-1/2 -translate-x-1/2 translate-y-[15px] bg-white rounded-b-[24px] shadow-[0_40px_80px_-20px_rgba(0,0,0,0.3)] border-t-[3px] border-[#b31217] z-[150] opacity-0 invisible pointer-events-none transition-all duration-300 ease-out group-hover/navitem:opacity-100 group-hover/navitem:visible group-hover/navitem:pointer-events-auto group-hover/navitem:translate-y-0 overflow-hidden flex" style="width: 1040px; min-height: 380px;">
              <div class="w-2/3 grid grid-cols-3 gap-8 p-10 text-left">
                <!-- Col 1 -->
                <div>
                  <div class="text-[11px] font-extrabold uppercase tracking-[0.08em] text-slate-800 border-b border-slate-100 pb-3 mb-4">dBacoustic</div>
                  <div class="space-y-1.5">
                    <a href="#" class="block text-[13px] font-medium text-slate-500 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Loa Chuyên Nghiệp</a>
                    <a href="#" class="block text-[13px] font-medium text-slate-500 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Amply Công Suất lớn</a>
                    <a href="#" class="block text-[13px] font-medium text-slate-500 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Micro Không Dây</a>
                    <a href="#" class="block text-[13px] font-medium text-slate-500 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Vang Số Cao Cấp</a>
                    <a href="#" class="block text-[13px] font-medium text-slate-500 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Sub Siêu Trầm</a>
                  </div>
                </div>
                <!-- Col 2 -->
                <div>
                  <div class="text-[11px] font-extrabold uppercase tracking-[0.08em] text-slate-800 border-b border-slate-100 pb-3 mb-4">TD Classic</div>
                  <div class="space-y-1.5">
                    <a href="#" class="block text-[13px] font-medium text-slate-500 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Loa Karaoke Gia Đình</a>
                    <a href="#" class="block text-[13px] font-medium text-slate-500 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Micro Phát Biểu Hội Thảo</a>
                    <a href="#" class="block text-[13px] font-medium text-slate-500 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Amply Tích Hợp</a>
                    <a href="#" class="block text-[13px] font-medium text-slate-500 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Thiết Bị Cắm Trực Tiếp</a>
                  </div>
                </div>
                <!-- Col 3 -->
                <div>
                  <div class="text-[11px] font-extrabold uppercase tracking-[0.08em] text-slate-800 border-b border-slate-100 pb-3 mb-4">CF Audio & Peavey</div>
                  <div class="space-y-1.5">
                    <a href="#" class="block text-[13px] font-medium text-slate-500 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Dàn Loa Line Array</a>
                    <a href="#" class="block text-[13px] font-medium text-slate-500 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Loa Sân Khấu Ngoài Trời</a>
                    <a href="#" class="block text-[13px] font-medium text-slate-500 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Cục Đẩy Công Suất Lớn</a>
                    <div class="h-2"></div>
                    <a href="#" class="block text-[13px] font-medium text-slate-500 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Bàn Mixer Chuyên Nghiệp</a>
                  </div>
                </div>
              </div>

              <!-- Visual Audio Image -->
              <div class="w-1/3 relative overflow-hidden group/card block cursor-pointer">
                <img src="#" data-fallback="https://images.unsplash.com/photo-1520523839897-bd0b52f945a0?auto=format&fit=crop&w=600&q=80" alt="Hệ thống âm thanh" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover/card:scale-110" />
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/30 to-transparent"></div>
                
                <div class="absolute bottom-0 left-0 w-full p-8 flex flex-col justify-end">
                  <span class="inline-block text-[10px] font-black uppercase tracking-widest px-2 py-1 rounded bg-[#b31217] text-white w-max mb-3">Âm Thanh Pro</span>
                  <h4 class="text-[16px] font-bold text-white mb-2 leading-tight drop-shadow-md">Thiết bị âm thanh Sân khấu & Sự kiện đỉnh cao</h4>
                </div>
              </div>
            </div>
          </div>

          <!-- ── DỰ ÁN (CHUYỂN THÀNH MỘT LIST & ẢNH ĐẠI DIỆN LỚN) ── -->
          <div class="inline-block group/navitem">
            <button 
               :class="scrolled ? 'py-4' : 'py-2'"
               class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
              <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/></svg>
              Dự Án
              <svg class="w-3 h-3 text-white/50 group-hover:text-[#fbbf24] group-hover/navitem:rotate-180 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
              <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-[#fbbf24] transition-all duration-300 group-hover/navitem:w-full"></span>
            </button>

            <!-- Lưới Flex Dự Án -->
            <div class="absolute top-full left-1/2 -translate-x-1/2 translate-y-[15px] bg-white rounded-b-[24px] shadow-[0_40px_80px_-20px_rgba(0,0,0,0.3)] border-t-[3px] border-[#b31217] z-[150] opacity-0 invisible pointer-events-none transition-all duration-300 ease-out group-hover/navitem:opacity-100 group-hover/navitem:visible group-hover/navitem:pointer-events-auto group-hover/navitem:translate-y-0 overflow-hidden flex" style="width: 900px; min-height: 380px;">
              <div class="w-2/5 p-10 border-r border-slate-100">
                <div class="text-[11px] font-extrabold uppercase tracking-[0.08em] text-slate-400 border-b border-slate-100 pb-3 mb-4">Hồ Sơ Năng Lực</div>
                <div class="space-y-1.5">
                  <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Dự Án Màn Hình LED Trong Nhà</a>
                  <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Dự Án Màn Hình LED Ngoài Trời</a>
                  <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Dự Án Màn Hình Ghép LCD</a>
                  <a href="#" class="block text-[14px] font-medium text-slate-700 py-1.5 hover:text-[#b31217] hover:translate-x-1 transition-transform">Dự Án Âm Thanh Sự Kiện</a>
                </div>
              </div>

              <!-- Ảo Visual Lớn -->
              <div class="w-3/5 relative overflow-hidden group/card block cursor-pointer">
                <img src="<?php echo $showcase_audio; ?>" data-fallback="https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=800&q=80" alt="Dự án âm thanh" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover/card:scale-110" />
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent"></div>
                
                <div class="absolute bottom-0 left-0 w-full p-8 flex flex-col justify-end">
                  <span class="inline-block text-[10px] font-black uppercase tracking-widest px-2 py-1 rounded bg-[#b31217] text-white w-max mb-3">ÂM THANH & LED SỰ KIỆN</span>
                  <h4 class="text-[16px] font-bold text-white mb-2 leading-tight drop-shadow-md">Tổ hợp Hiển thị và Âm thanh tại Cung Điền Kinh Quốc Gia</h4>
                </div>
              </div>
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
          <div class="inline-block group/navitem">
            <button 
               :class="scrolled ? 'py-4' : 'py-2'"
               class="group relative font-display font-medium text-white/95 flex items-center gap-1.5 transition-colors hover:text-[#fbbf24] whitespace-nowrap text-[13px] xl:text-[14px]">
              <svg class="w-3.5 h-3.5 opacity-70 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
              Tin Tức & Blog
              <svg class="w-3 h-3 text-white/50 group-hover:text-[#fbbf24] group-hover/navitem:rotate-180 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
              <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-[#fbbf24] transition-all duration-300 group-hover/navitem:w-full"></span>
            </button>
            
            <div class="absolute top-full left-1/2 -translate-x-1/2 translate-y-[10px] w-64 bg-white rounded-b-[20px] shadow-[0_20px_40px_-10px_rgba(0,0,0,0.2)] border-t-[3px] border-[#b31217] z-[150] py-3 opacity-0 invisible pointer-events-none transition-all duration-300 ease-out group-hover/navitem:opacity-100 group-hover/navitem:visible group-hover/navitem:pointer-events-auto group-hover/navitem:translate-y-0 text-left">
              <a href="<?php echo esc_url($news_url); ?>" class="block px-6 py-2.5 text-[13px] font-medium text-slate-600 hover:text-[#b31217] hover:bg-red-50/50 transition-colors">Kiến thức kỹ thuật LED</a>
              <a href="<?php echo esc_url($news_url); ?>" class="block px-6 py-2.5 text-[13px] font-medium text-slate-600 hover:text-[#b31217] hover:bg-red-50/50 transition-colors">Tin tức HacoLED</a>
              <a href="<?php echo esc_url($posts_url); ?>" class="block px-6 py-2.5 text-[13px] font-medium text-slate-600 hover:text-[#b31217] hover:bg-red-50/50 transition-colors">Blog Thiết Bị Âm Thanh</a>
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
        <div x-show="open" x-cloak class="pl-6 pr-2 pb-2 mt-1 border-l border-white/20 ml-2 space-y-1">
          <p class="pt-2 pb-1 text-[10px] font-bold uppercase tracking-widest text-[#fbbf24]">LED Trong Nhà</p>
          <a href="#" class="block py-2 text-[13px] text-white/80 hover:text-white">LED P1.25 Siêu Mịn</a>
          <a href="#" class="block py-2 text-[13px] text-white/80 hover:text-white">LED P2 Cao Cấp</a>
          <p class="pt-3 pb-1 text-[10px] font-bold uppercase tracking-widest text-[#fbbf24]">LED Ngoài Trời</p>
          <a href="#" class="block py-2 text-[13px] text-white/80 hover:text-white">LED P3 Ngoài Trời</a>
          <a href="#" class="block py-2 text-[13px] text-white/80 hover:text-white">LED P4 Quảng Cáo</a>
        </div>
      </div>

      <!-- Accordion Mobile: Màn Hình Ghép -->
      <div x-data="{ open: false }">
        <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-[14px] font-semibold hover:bg-white/10 focus:outline-none">
          <span>Màn Hình Ghép</span>
          <svg class="w-4 h-4 text-white/70 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
        </button>
        <div x-show="open" x-cloak class="pl-6 pr-2 pb-2 mt-1 border-l border-white/20 ml-2 space-y-1">
          <a href="#" class="block py-2 text-[13px] text-white/80 hover:text-white">Màn Hình Ghép BOE</a>
          <a href="#" class="block py-2 text-[13px] text-white/80 hover:text-white">Màn Hình Ghép LG</a>
        </div>
      </div>

      <!-- Khác -->
      <a href="#" class="block px-4 py-3 text-[14px] font-semibold hover:bg-white/10 rounded-xl">Âm Thanh</a>
      <a href="#" class="block px-4 py-3 text-[14px] font-semibold hover:bg-white/10 rounded-xl">Dự Án</a>
      <a href="<?php echo esc_url($services_url); ?>" class="block px-4 py-3 text-[14px] font-semibold hover:bg-white/10 rounded-xl">Dịch Vụ</a>
      <a href="<?php echo esc_url($news_url); ?>" class="block px-4 py-3 text-[14px] font-semibold hover:bg-white/10 rounded-xl">Tin Tức & Blog</a>
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

<script>
  document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('input[type="search"]').forEach(function(input) {
      if (input.placeholder && input.placeholder.trim().includes('<?php')) {
        input.placeholder = 'Tìm sản phẩm, giải pháp hiển thị, âm thanh...';
      }
    });
    document.querySelectorAll('img').forEach(function(img) {
      const src = img.getAttribute('src');
      if (src && (src.trim().includes('<?php') || src.includes('assets/images'))) {
        const fallback = img.getAttribute('data-fallback');
        if (fallback) img.setAttribute('src', fallback);
      }
    });
    document.querySelectorAll('a').forEach(function(a) {
      const href = a.getAttribute('href');
      if (href && href.trim().includes('<?php')) a.setAttribute('href', '#');
    });
  });
</script>