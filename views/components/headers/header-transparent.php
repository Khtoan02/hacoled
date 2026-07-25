<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
$header_menu_configs = hacoled_header_menu_settings();
$custom_logo_id = get_theme_mod('custom_logo');
$logo         = $custom_logo_id ? wp_get_attachment_image_url($custom_logo_id, 'full') : home_url('/wp-content/uploads/2026/06/HacoLED-Logo-Moi.png');
$about_url    = home_url('/gioi-thieu/');
$services_url = home_url('/dich-vu/');
$contact_url  = home_url('/lien-he/');

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

<header
  id="site-header"
  class="site-header"
  x-data="{ mobile: false }"
  x-init="
    function onScroll() {
      document.getElementById('site-header').classList.toggle('is-scrolled', window.scrollY > 64);
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  "
  style="position:sticky; top:0; z-index:500; width:100%;">

  <div class="hidden lg:block">

  <!-- ══ Gold accent line ══ -->
  <div class="h-[3px] haco-gold-line" style="box-shadow:0 2px 14px rgba(251,191,36,0.55);"></div>

  <!-- ═══════════════════════════════════════════════════
       TOP BAR
       ═══════════════════════════════════════════════════ -->
  <div class="haco-brand-shell" style="position:relative; overflow:hidden;">
    <div class="hdr-top-bg"></div>

    <div style="max-width:1320px; margin:0 auto; padding:12px 40px; display:flex; align-items:center; gap:24px; position:relative; z-index:10;">

      <!-- Logo + Trống Đồng -->
      <div class="hdr-logo">
        <div class="hdr-logo-ds"></div>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="hdr-logo-link" aria-label="HacoLED">
          <img src="<?php echo esc_url($logo); ?>" alt="HacoLED" />
        </a>
      </div>

      <!-- Search -->
      <div class="hdr-search">
        <form method="get" action="<?php echo esc_url(home_url('/')); ?>" role="search">
          <span class="hdr-search-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
            </svg>
          </span>
          <input type="search" name="s" placeholder="<?php esc_attr_e('Tìm kiếm sản phẩm, bài viết...', 'hacoled'); ?>" />
        </form>
      </div>

      <!-- Hotlines -->
      <div class="hidden lg:flex" style="align-items:center; gap:20px; margin-left:auto; flex-shrink:0;">

        <a href="tel:0868474488" class="hdr-hotline hdr-hotline-cskh">
          <div class="hdr-hotline-icon">
            <span class="hdr-ping" style="position:absolute;inset:0;border-radius:50%;background:rgba(250,204,21,0.28);"></span>
            <i class="ph-duotone ph-headset text-2xl text-yellow-400 relative z-10"></i>
          </div>
          <div>
            <span class="hdr-hotline-label text-xs uppercase tracking-wider text-yellow-300">SĐT CSKH</span>
            <span class="hdr-hotline-number text-white font-bold tracking-tight">086.847.4488</span>
          </div>
        </a>

        <div style="width:1px; height:36px; background:rgba(255,255,255,0.12);"></div>

        <a href="tel:0342324488" class="hdr-hotline hdr-hotline-sales">
          <div class="hdr-hotline-icon">
            <span class="hdr-ping" style="position:absolute;inset:0;border-radius:50%;background:rgba(255,255,255,0.28);"></span>
            <i class="ph-duotone ph-phone-call text-2xl text-white relative z-10"></i>
          </div>
          <div>
            <span class="hdr-hotline-label text-xs uppercase tracking-wider text-white/80">Hotline Mua Hàng</span>
            <span class="hdr-hotline-number text-white font-bold tracking-tight">034.232.4488</span>
          </div>
        </a>

      </div>

      <!-- Mobile hamburger (Hidden in favor of bottom navigation bar) -->
      <button
        @click="mobile = !mobile"
        class="hidden"
        style="margin-left:auto; flex-shrink:0; padding:9px; border-radius:10px; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.14); color:rgba(226,232,240,0.9);"
        :aria-expanded="mobile" aria-label="Menu">
        <svg x-show="!mobile" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
        </svg>
        <svg x-show="mobile" x-cloak width="22" height="22" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
        </svg>
      </button>

    </div>
  </div><!-- /top bar -->

  <!-- ═══════════════════════════════════════════════════
       BOTTOM NAV – Dark, CSS-hover mega menus
       #hdr-nav must be position:relative, overflow:visible
       ═══════════════════════════════════════════════════ -->
  <nav id="hdr-nav" aria-label="Điều hướng chính">
    <div class="hdr-nav-row">

      <!-- Compact logo (scrolled) -->
      <div class="hdr-compact-logo">
        <img src="<?php echo esc_url($logo); ?>" alt="HacoLED" />
      </div>

      <!-- Nav items -->
      <div class="hdr-nav-items">

        <!-- Trang Chủ -->
        <div class="hdr-item">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="hdr-link"><i class="ph-fill ph-house text-lg mr-1.5 opacity-90"></i>Trang Chủ</a>
        </div>

        <!-- Giới Thiệu -->
        <div class="hdr-item">
          <a href="<?php echo esc_url($about_url); ?>" class="hdr-link"><i class="ph-fill ph-info text-lg mr-1.5 opacity-90"></i>Giới Thiệu</a>
        </div>

        <!-- ═══ MÀN HÌNH LED — Mega Menu ═══ -->
        <div class="hdr-item">
          <button class="hdr-link" aria-haspopup="true">
            <i class="ph-fill ph-monitor-play text-lg mr-1.5 opacity-90"></i>Màn Hình LED
            <svg class="hdr-chev" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
            </svg>
          </button>

          <div class="mega-panel" role="menu">
            <div class="mega-inner" style="grid-template-columns: 1fr 1px 1fr 1px 1.05fr;">

              <!-- Col 1: Màn hình LED Trong Nhà & Giải Pháp -->
              <div>
                <div class="mega-hd">
                  <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#ef4444"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75"/></svg>
                  Màn hình LED Trong Nhà
                </div>
                <a href="<?php echo esc_url(home_url('/man-hinh-led-p0-9-trong-nha/')); ?>" class="mega-a">Màn hình LED P0.9</a>
                <a href="<?php echo esc_url(home_url('/man-hinh-led-p1-25-trong-nha/')); ?>" class="mega-a">Màn hình LED P1.25</a>
                <a href="<?php echo esc_url(home_url('/man-hinh-led-p1-53-trong-nha/')); ?>" class="mega-a">Màn hình LED P1.53</a>
                <a href="<?php echo esc_url(home_url('/man-hinh-led-p1-8-trong-nha/')); ?>" class="mega-a">Màn hình LED P1.8</a>
                <a href="<?php echo esc_url(home_url('/man-hinh-led-p2-trong-nha/')); ?>" class="mega-a">Màn hình LED P2 <span class="mb mb-hot">HOT</span></a>
                <a href="<?php echo esc_url(home_url('/man-hinh-led-p2-5-trong-nha/')); ?>" class="mega-a">Màn hình LED P2.5</a>
                <a href="<?php echo esc_url(home_url('/man-hinh-led-p3-trong-nha/')); ?>" class="mega-a">Màn hình LED P3</a>
                <a href="<?php echo esc_url(home_url('/man-hinh-led-p3-0-trong-nha/')); ?>" class="mega-a">Màn hình LED P3.0</a>

                <div style="margin-top:18px;">
                  <div class="mega-hd">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#ef4444"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
                    Giải Pháp Màn Hình LED
                  </div>
                  <a href="<?php echo esc_url(home_url('/man-hinh-led-hoi-truong/')); ?>" class="mega-a">Màn hình LED Hội trường</a>
                  <a href="<?php echo esc_url(home_url('/man-hinh-led-phong-hop-hoi-truong/')); ?>" class="mega-a">Màn hình LED Phòng họp</a>
                  <a href="<?php echo esc_url(home_url('/man-hinh-led-san-khau/')); ?>" class="mega-a">Màn hình LED Sân khấu</a>
                  <a href="<?php echo esc_url(home_url('/man-hinh-led-truong-hoc/')); ?>" class="mega-a">Màn hình LED Trường học</a>
                  <a href="<?php echo esc_url(home_url('/man-hinh-led-tiec-cuoi-nha-hang/')); ?>" class="mega-a">Màn hình LED Tiệc, đám cưới</a>
                </div>
              </div>

              <div class="mega-sep"></div>

              <!-- Col 2: Màn hình LED Ngoài Trời & Giải Pháp -->
              <div>
                <div class="mega-hd">
                  <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#ef4444"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/></svg>
                  Màn hình LED Ngoài Trời
                </div>
                <a href="<?php echo esc_url(home_url('/man-hinh-led-p2-5-ngoai-troi/')); ?>" class="mega-a">Màn hình LED P2.5</a>
                <a href="<?php echo esc_url(home_url('/man-hinh-led-p3-ngoai-troi/')); ?>" class="mega-a">Màn hình LED P3</a>
                <a href="<?php echo esc_url(home_url('/man-hinh-led-p4-ngoai-troi/')); ?>" class="mega-a">Màn hình LED P4 <span class="mb mb-pro">PRO</span></a>
                <a href="<?php echo esc_url(home_url('/man-hinh-led-p5-ngoai-troi/')); ?>" class="mega-a">Màn hình LED P5</a>
                <a href="<?php echo esc_url(home_url('/man-hinh-led-p10-ngoai-troi/')); ?>" class="mega-a">Màn hình LED P10</a>

                <div style="margin-top:18px;">
                  <div class="mega-hd">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#ef4444"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                    Giải Pháp Đặc Biệt
                  </div>
                  <a href="<?php echo esc_url(home_url('/man-hinh-led-studio/')); ?>" class="mega-a">Màn hình LED Studio</a>
                  <a href="<?php echo esc_url(home_url('/man-hinh-led-100-200-300-inch/')); ?>" class="mega-a">Màn hình LED 100, 200, 300 inch</a>
                  <a href="<?php echo esc_url(home_url('/man-hinh-led-trong-suot/')); ?>" class="mega-a">Màn hình LED Trong suốt</a>
                  <a href="<?php echo esc_url(home_url('/man-hinh-led-film-dan-kinh/')); ?>" class="mega-a">Màn hình LED Film dán kính</a>
                </div>
              </div>

              <div class="mega-sep"></div>

              <!-- Col 3: Highlight card -->
              <div>
                <div class="mega-hd">
                  <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#ef4444"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                  Dự Án Tiêu Biểu
                </div>
                <a href="#" class="mega-highlight">
                  <span class="mega-highlight-badge">DỰ ÁN TIÊU BIỂU</span>
                  <div class="mega-highlight-title">Màn hình LED P1.53<br>Tập đoàn Dầu khí PVN</div>
                  <div class="mega-highlight-desc">Hội trường khánh tiết 500 chỗ, độ phân giải Ultra Fine, màu sắc chuẩn studio.</div>
                  <span class="mega-highlight-cta">
                    Xem chi tiết
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                  </span>
                </a>
                <div class="mega-chips">
                  <a href="#" class="mega-chip">Tất cả sản phẩm →</a>
                  <a href="#" class="mega-chip">Báo giá →</a>
                </div>
              </div>

            </div>
          </div>
        </div><!-- /Màn Hình LED -->

        <!-- ═══ MÀN HÌNH GHÉP — Mega Menu ═══ -->
        <div class="hdr-item">
          <button class="hdr-link" aria-haspopup="true">
            <i class="ph-fill ph-squares-four text-lg mr-1.5 opacity-90"></i>Màn Hình Ghép
            <svg class="hdr-chev" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
            </svg>
          </button>

          <div class="mega-panel" role="menu">
            <div class="mega-inner" style="grid-template-columns: 1.2fr 1px 1fr; max-width: 650px; padding: 24px;">
              <!-- Col 1: Links -->
              <div>
                <div class="mega-hd" style="color:#b31217;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#b31217"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z"/></svg>
                  Màn Hình Ghép Videowall
                </div>
                <a href="<?php echo esc_url(home_url('/man-hinh-ghep-boe/')); ?>" class="mega-a">Màn hình ghép BOE</a>
                <a href="<?php echo esc_url(home_url('/man-hinh-ghep-orion/')); ?>" class="mega-a">Màn hình ghép Orion</a>
                <a href="<?php echo esc_url(home_url('/man-hinh-ghep-vestel/')); ?>" class="mega-a">Màn hình ghép Vestel</a>
              </div>

              <div class="mega-sep" style="margin: 0 15px;"></div>

              <!-- Col 2: Highlight -->
              <div>
                <div class="mega-hd">
                  <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#ef4444"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                  Giải Pháp Nổi Bật
                </div>
                <a href="#" class="mega-highlight" style="padding: 16px;">
                  <span class="mega-highlight-badge">VIDEOWALL</span>
                  <div class="mega-highlight-title">Viền ghép siêu mỏng</div>
                  <div class="mega-highlight-desc" style="margin-bottom: 8px;">Hiển thị liền mạch, hoàn hảo cho phòng điều hành & TTTM.</div>
                  <span class="mega-highlight-cta">
                    Tìm hiểu thêm
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                  </span>
                </a>
              </div>
            </div>
          </div>
        </div><!-- /Màn Hình Ghép -->

        <!-- ═══ ÂM THANH — Mega Menu ═══ -->
        <div class="hdr-item">
          <button class="hdr-link" aria-haspopup="true">
            <i class="ph-fill ph-speaker-hifi text-lg mr-1.5 opacity-90"></i>Âm Thanh
            <svg class="hdr-chev" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
            </svg>
          </button>

          <div class="mega-panel" role="menu">
            <div class="mega-inner" style="grid-template-columns: 1fr 1px 1fr 1px 1fr 1px 1.4fr;">

              <!-- DBACOUSTIC -->
              <div>
                <div class="mega-hd" style="color:#b31217;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#b31217"><path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/></svg>
                  DBACOUSTIC
                </div>
                <a href="<?php echo esc_url(home_url('/dbacoustic-loa/')); ?>" class="mega-a">Loa</a>
                <a href="<?php echo esc_url(home_url('/dbacoustic-amply/')); ?>" class="mega-a">Amply</a>
                <a href="<?php echo esc_url(home_url('/dbacoustic-micro/')); ?>" class="mega-a">Micro</a>
                <a href="<?php echo esc_url(home_url('/loa-sieu-tram-sub/')); ?>" class="mega-a">Loa siêu trầm - Sub</a>
                <a href="<?php echo esc_url(home_url('/day-cong-suat-dbacoustic/')); ?>" class="mega-a">Đẩy công suất</a>
                <a href="<?php echo esc_url(home_url('/vangso-mixer-crossover-dbacoustic/')); ?>" class="mega-a">Vang số, Mixer, Crossover</a>
                <a href="<?php echo esc_url(home_url('/quan-ly-nguon-dbacoustic/')); ?>" class="mega-a">Quản lý nguồn</a>
              </div>

              <div class="mega-sep"></div>

              <!-- TD CLASSIC -->
              <div>
                <div class="mega-hd" style="color:#b31217;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#b31217"><path stroke-linecap="round" stroke-linejoin="round" d="M9 9l10.5-3m0 6.553v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 11-.99-3.467l2.31-.66a2.25 2.25 0 001.632-2.163zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 01-.99-3.467l2.31-.66A2.25 2.25 0 009 15.553z"/></svg>
                  TD CLASSIC
                </div>
                <a href="<?php echo esc_url(home_url('/loa-tdclassic/')); ?>" class="mega-a">Loa</a>
                <a href="<?php echo esc_url(home_url('/micro-tdclassic/')); ?>" class="mega-a">Micro</a>
                <a href="<?php echo esc_url(home_url('/amply-tdclassic/')); ?>" class="mega-a">Amply</a>
                <a href="<?php echo esc_url(home_url('/vang-so-tdclassic/')); ?>" class="mega-a">Vang số</a>
                <a href="<?php echo esc_url(home_url('/phu-kien-am-thanh-tdclassic/')); ?>" class="mega-a">Phụ kiện âm thanh</a>
              </div>

              <div class="mega-sep"></div>

              <!-- CF AUDIO & PEAVEY -->
              <div>
                <div class="mega-hd" style="color:#b31217;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#b31217"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
                  CF AUDIO
                </div>
                <a href="<?php echo esc_url(home_url('/cfaudio-loa/')); ?>" class="mega-a" style="margin-bottom: 20px;">Loa CF AUDIO</a>

                <div class="mega-hd" style="color:#b31217;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#b31217"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253"/></svg>
                  PEAVEY
                </div>
                <a href="<?php echo esc_url(home_url('/peavey-loa/')); ?>" class="mega-a">Loa PEAVEY</a>
              </div>

              <div class="mega-sep"></div>

              <!-- Highlight -->
              <div>
                <div class="mega-hd">
                  <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#ef4444"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                  Giải Pháp Âm Thanh
                </div>
                <a href="#" class="mega-highlight" style="padding: 16px;">
                  <span class="mega-highlight-badge">ÂM THANH PRO</span>
                  <div class="mega-highlight-title">Hệ thống âm thanh<br>Sân khấu & Sự kiện</div>
                  <div class="mega-highlight-desc" style="margin-bottom: 12px;">Độ phủ sóng toàn diện, chất lượng concert ngoài trời.</div>
                  <span class="mega-highlight-cta">
                    Tìm hiểu thêm
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                  </span>
                </a>
              </div>

            </div>
          </div>
        </div><!-- /Âm Thanh -->

        <!-- ═══ DỰ ÁN — Mega Menu ═══ -->
        <div class="hdr-item">
          <button class="hdr-link" aria-haspopup="true">
            <i class="ph-fill ph-buildings text-lg mr-1.5 opacity-90"></i>Dự án đã thực hiện
            <svg class="hdr-chev" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
            </svg>
          </button>

          <div class="mega-panel" role="menu">
            <div class="mega-inner" style="grid-template-columns: 1fr 1px 1fr 1px 1fr;">

              <!-- Col 1 -->
              <div>
                <div class="mega-hd">
                  <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#ef4444"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"/></svg>
                  Hồ Sơ Năng Lực
                </div>
                <a href="<?php echo esc_url($project_in_url); ?>" class="mega-a">Dự án trong nhà</a>
                <a href="<?php echo esc_url($project_out_url); ?>" class="mega-a">Dự án ngoài trời</a>
                <a href="<?php echo esc_url($project_school_url); ?>" class="mega-a">Dự án trường học</a>
                <a href="<?php echo esc_url($project_videowall_url); ?>" class="mega-a">Dự án màn hình ghép</a>
                <a href="<?php echo esc_url($project_audio_url); ?>" class="mega-a">Dự án âm thanh</a>
              </div>

              <div class="mega-sep"></div>

              <!-- Col 2 -->
              <div>
                <div class="mega-hd">
                  <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#ef4444"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
                  Theo Lĩnh Vực
                </div>
                <a href="#" class="mega-a">Khách sạn & Nhà hàng</a>
                <a href="#" class="mega-a">Doanh nghiệp & Nhà máy <span class="mb mb-hot">HOT</span></a>
                <a href="#" class="mega-a">Cơ quan Nhà nước</a>
                <a href="#" class="mega-a">Trường học & Đại học</a>
                <a href="#" class="mega-a">Trung tâm thương mại</a>
                <a href="#" class="mega-a">Y tế & Bệnh viện</a>
              </div>

              <div class="mega-sep"></div>

              <!-- Highlight -->
              <div>
                <div class="mega-hd">
                  <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#ef4444"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                  Dự Án Nổi Bật
                </div>
                <a href="#" class="mega-highlight">
                  <span class="mega-highlight-badge">DỰ ÁN TIÊU BIỂU</span>
                  <div class="mega-highlight-title">LED P1.875<br>Tập đoàn PVN Hà Nội</div>
                  <div class="mega-highlight-desc">Lắp đặt hệ thống hiển thị phòng khánh tiết chất lượng siêu cao, độ phân giải Ultra Fine, màu chuẩn studio.</div>
                  <span class="mega-highlight-cta">
                    Xem chi tiết
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                  </span>
                </a>
              </div>

            </div>
          </div>
        </div><!-- /Dự Án -->

        <!-- Dịch Vụ -->
        <div class="hdr-item">
          <a href="<?php echo esc_url($services_url); ?>" class="hdr-link"><i class="ph-fill ph-wrench text-lg mr-1.5 opacity-90"></i>Dịch Vụ</a>
        </div>

        <!-- ═══ TIN TỨC — Simple dropdown ═══ -->
        <div class="hdr-item has-simple">
          <button class="hdr-link" aria-haspopup="true">
            <i class="ph-fill ph-newspaper text-lg mr-1.5 opacity-90"></i>Tin Tức
            <svg class="hdr-chev" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
            </svg>
          </button>
          <div class="simple-dd" role="menu">
            <a href="<?php echo esc_url($led_url); ?>">
              Blog Màn Hình LED
              <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="opacity:0.4;"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
            </a>
            <a href="<?php echo esc_url($audio_url); ?>">
              Blog Âm Thanh
              <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="opacity:0.4;"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
            </a>
            <a href="<?php echo esc_url($tech_url); ?>">
              Kiến Thức & Kỹ Thuật
              <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="opacity:0.4;"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
            </a>
            <a href="<?php echo esc_url($news_url); ?>">
              Tin Tức
              <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="opacity:0.4;"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
            </a>
          </div>
        </div>

        <!-- ═══ TUYỂN DỤNG — Mega Menu ═══ -->
        <div class="hdr-item">
          <button class="hdr-link" aria-haspopup="true">
            <i class="ph-fill ph-users text-lg mr-1.5 opacity-90"></i>Tuyển Dụng
            <svg class="hdr-chev" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
            </svg>
          </button>

          <div class="mega-panel" role="menu">
            <div class="mega-inner" style="grid-template-columns: 1.5fr 1px 1fr;">
              <!-- Col 1 -->
              <div>
                <div class="mega-hd">
                  <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#ef4444"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                  Các Vị Trí Tuyển Dụng
                </div>
                <?php
                $job_args = array(
                    'post_type'      => 'job',
                    'posts_per_page' => 5,
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                    'order'          => 'DESC'
                );
                $jobs = get_posts($job_args);
                if ($jobs) {
                    foreach ($jobs as $job) {
                        $job_link = get_permalink($job->ID);
                        $job_title = esc_html(get_the_title($job->ID));
                        echo '<a href="' . esc_url($job_link) . '" class="mega-a">' . $job_title . '</a>';
                    }
                } else {
                    echo '<p class="text-[13px] text-slate-500 py-2">Đang cập nhật vị trí ứng tuyển...</p>';
                }
                ?>
                <div style="margin-top: 15px;">
                  <a href="<?php echo home_url('/tuyen-dung/'); ?>" style="display:inline-block; font-size:12px; font-weight:700; color:#ef4444; background:#fef2f2; padding:6px 12px; border-radius:4px;">Xem toàn bộ vị trí →</a>
                </div>
              </div>

              <div class="mega-sep"></div>

              <!-- Col 2: Highlight -->
              <div>
                <div class="mega-hd">
                  <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#ef4444"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                  Gia Nhập HacoLED
                </div>
                <a href="<?php echo home_url('/tuyen-dung/'); ?>" class="mega-highlight">
                  <span class="mega-highlight-badge">VĂN HOÁ</span>
                  <div class="mega-highlight-title">Kiến tạo tương lai công nghệ</div>
                  <div class="mega-highlight-desc">Môi trường làm việc năng động, lộ trình thăng tiến rõ ràng cùng chế độ đãi ngộ hấp dẫn.</div>
                  <span class="mega-highlight-cta">
                    Tìm hiểu thêm
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                  </span>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Liên Hệ -->
        <div class="hdr-item">
          <a href="<?php echo esc_url($contact_url); ?>" class="hdr-link"><i class="ph-fill ph-envelope-simple text-lg mr-1.5 opacity-90"></i>Liên Hệ</a>
        </div>

      </div><!-- /nav items -->

      <!-- Compact CTA (scroll) -->
      <div class="hdr-cta">
        <a href="tel:0342324488">
          <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.802-5.127-4.106-6.93-6.93l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
          034.232.4488
        </a>
      </div>

    </div>
  </nav><!-- /bottom nav -->
  </div><!-- /desktop header wrapper -->

<?php
// Define local variables for mobile bar
$footer_about_url    = home_url('/gioi-thieu/');
$footer_services_url = home_url('/dich-vu/');
$footer_contact_url  = home_url('/lien-he/');
$footer_news_url     = home_url('/tin-tuc/');
$footer_commitment_url = home_url('/cam-ket-chat-luong/');
$footer_careers_url  = home_url('/tuyen-dung/');

$footer_about_pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-about.php'));
if (!empty($footer_about_pages)) $footer_about_url = get_permalink($footer_about_pages[0]->ID);

$footer_services_pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-services.php'));
if (!empty($footer_services_pages)) $footer_services_url = get_permalink($footer_services_pages[0]->ID);

$footer_contact_pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-contact.php'));
if (!empty($footer_contact_pages)) $footer_contact_url = get_permalink($footer_contact_pages[0]->ID);

$footer_commitment_pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-commitment.php'));
if (!empty($footer_commitment_pages)) $footer_commitment_url = get_permalink($footer_commitment_pages[0]->ID);

$footer_careers_pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-careers.php'));
if (!empty($footer_careers_pages)) $footer_careers_url = get_permalink($footer_careers_pages[0]->ID);

$footer_job_args = array(
    'post_type'      => 'job',
    'posts_per_page' => 5,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC'
);
$footer_jobs = get_posts($footer_job_args);
?>
<!-- Mobile Bottom Navigation & Drawers (lg:hidden) -->
<div x-data="{ activeDrawer: null }" class="lg:hidden">
  
  <!-- Backdrop Overlay -->
  <div x-show="activeDrawer" x-cloak
       @click="activeDrawer = null"
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="opacity-0"
       x-transition:enter-end="opacity-100"
       x-transition:leave="transition ease-in duration-200"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0"
       class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[190]">
  </div>

  <!-- Bottom Navigation Bar -->
  <nav aria-label="Mobile Navigation" class="fixed bottom-0 left-0 right-0 z-[210] bg-gradient-to-t from-[#7a080c] to-[#990d12] border-t border-white/10 shadow-[0_-5px_25px_rgba(0,0,0,0.3)]" style="padding-bottom: env(safe-area-inset-bottom);">
    <div class="flex justify-around items-center h-16 px-2">
      
      <!-- Tab 1: Trang chủ -->
      <a href="<?php echo esc_url(home_url('/')); ?>" 
         class="flex items-center justify-center w-16 h-full transition-all duration-200"
         :class="activeDrawer === null && (window.location.pathname === '/' || window.location.pathname === '/index.php') ? 'text-[#fbbf24] scale-105' : 'text-white/70 hover:text-white'">
        <i class="text-[26px]" :class="activeDrawer === null && (window.location.pathname === '/' || window.location.pathname === '/index.php') ? 'ph-fill ph-house' : 'ph-bold ph-house'"></i>
      </a>

      <!-- Tab 2: Sản phẩm -->
      <button @click="activeDrawer = activeDrawer === 'products' ? null : 'products'" 
              class="flex items-center justify-center w-16 h-full transition-all duration-200 outline-none"
              :class="activeDrawer === 'products' ? 'text-[#fbbf24] scale-105' : 'text-white/70 hover:text-white'">
        <i class="text-[26px]" :class="activeDrawer === 'products' ? 'ph-fill ph-package' : 'ph-bold ph-package'"></i>
      </button>

      <!-- Tab 3: Blog -->
      <button @click="activeDrawer = activeDrawer === 'blog' ? null : 'blog'" 
              class="flex items-center justify-center w-16 h-full transition-all duration-200 outline-none"
              :class="activeDrawer === 'blog' ? 'text-[#fbbf24] scale-105' : 'text-white/70 hover:text-white'">
        <i class="text-[26px]" :class="activeDrawer === 'blog' ? 'ph-fill ph-newspaper' : 'ph-bold ph-newspaper'"></i>
      </button>

      <!-- Tab 4: Info -->
      <button @click="activeDrawer = activeDrawer === 'info' ? null : 'info'" 
              class="flex items-center justify-center w-16 h-full transition-all duration-200 outline-none"
              :class="activeDrawer === 'info' ? 'text-[#fbbf24] scale-105' : 'text-white/70 hover:text-white'">
        <i class="text-[26px]" :class="activeDrawer === 'info' ? 'ph-fill ph-info' : 'ph-bold ph-info'"></i>
      </button>

      <!-- Tab 5: Menu -->
      <button @click="activeDrawer = activeDrawer === 'menu' ? null : 'menu'" 
              class="flex items-center justify-center w-16 h-full transition-all duration-200 outline-none"
              :class="activeDrawer === 'menu' ? 'text-[#fbbf24] scale-105' : 'text-white/70 hover:text-white'">
        <i class="text-[26px]" :class="activeDrawer === 'menu' ? 'ph-fill ph-list' : 'ph-bold ph-list'"></i>
      </button>

    </div>
  </nav>

  <!-- Drawer 1: Sản phẩm -->
  <div x-show="activeDrawer === 'products'" x-cloak
       x-transition:enter="transition ease-out duration-300 transform"
       x-transition:enter-start="translate-y-full"
       x-transition:enter-end="translate-y-0"
       x-transition:leave="transition ease-in duration-200 transform"
       x-transition:leave-start="translate-y-0"
       x-transition:leave-end="translate-y-full"
       class="fixed bottom-0 left-0 right-0 z-[200] max-h-[80vh] rounded-t-[2.5rem] haco-brand-panel border-t border-white/20 text-white flex flex-col shadow-2xl pb-20 overflow-hidden">
    
    <!-- Dong Son Bronze Drum watermark background -->
    <div class="absolute -bottom-16 -right-16 w-64 h-64 bg-no-repeat bg-contain bg-center pointer-events-none mix-blend-screen z-0" 
         style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg/960px-Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg.png'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%); opacity: 0.05;">
    </div>

    <div class="w-12 h-1.5 bg-white/20 rounded-full mx-auto my-3 shrink-0 cursor-pointer relative z-10" @click="activeDrawer = null"></div>
    <div class="px-6 pb-4 flex items-center justify-between border-b border-white/10 shrink-0 relative z-10">
      <h3 class="text-base font-extrabold uppercase tracking-wider text-[#fbbf24] flex items-center gap-2">
        <i class="ph-fill ph-package text-lg"></i> Danh Mục Sản Phẩm
      </h3>
      <button @click="activeDrawer = null" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors">
        <i class="ph-bold ph-x"></i>
      </button>
    </div>
    <div class="overflow-y-auto px-6 py-4 space-y-4 mobile-scroll flex-1 text-left relative z-10">
      
      <!-- LED TRONG NHÀ -->
      <div>
        <h4 class="text-[12px] font-black uppercase tracking-wider text-[#fbbf24]/90 mb-2 border-b border-white/5 pb-1">Màn Hình LED Trong Nhà</h4>
        <div class="grid grid-cols-2 gap-2">
          <a href="https://hacoled.com/man-hinh-led-trong-nha/" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Tất cả trong nhà</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p0-9-trong-nha/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P0.9</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p1-25-trong-nha/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P1.25</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p1-53-trong-nha/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P1.53</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p1-8-trong-nha/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P1.8</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p2-trong-nha/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P2</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p2-5-trong-nha/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P2.5</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p3-trong-nha/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P3</a>
        </div>
      </div>

      <!-- LED NGOÀI TRỜI -->
      <div>
        <h4 class="text-[12px] font-black uppercase tracking-wider text-[#fbbf24]/90 mb-2 border-b border-white/5 pb-1">Màn Hình LED Ngoài Trời</h4>
        <div class="grid grid-cols-2 gap-2">
          <a href="https://hacoled.com/man-hinh-led-ngoai-troi/" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Tất cả ngoài trời</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p2-5-ngoai-troi/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P2.5</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p3-ngoai-troi/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P3</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p4-ngoai-troi/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P4</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p5-ngoai-troi/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P5</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p10-ngoai-troi/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P10</a>
        </div>
      </div>

      <!-- MÀN HÌNH GHÉP LCD -->
      <div>
        <h4 class="text-[12px] font-black uppercase tracking-wider text-[#fbbf24]/90 mb-2 border-b border-white/5 pb-1">Màn Hình Ghép LCD</h4>
        <div class="grid grid-cols-2 gap-2">
          <a href="https://hacoled.com/man-hinh-ghep/" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Tất cả màn ghép</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-ghep-boe/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Màn ghép BOE</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-ghep-orion/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Màn ghép Orion</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-ghep-vestel/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Màn ghép Vestel</a>
        </div>
      </div>

      <!-- ÂM THANH & ÁNH SÁNG -->
      <div>
        <h4 class="text-[12px] font-black uppercase tracking-wider text-[#fbbf24]/90 mb-2 border-b border-white/5 pb-1">Âm Thanh | Ánh Sáng</h4>
        <div class="grid grid-cols-2 gap-2">
          <a href="https://hacoled.com/am-thanh/" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Tất cả âm thanh</a>
          <a href="<?php echo esc_url(home_url('/dbacoustic-loa/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Loa DBacoustic</a>
          <a href="<?php echo esc_url(home_url('/dbacoustic-amply/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Amply DBacoustic</a>
          <a href="<?php echo esc_url(home_url('/dbacoustic-micro/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Micro DBacoustic</a>
        </div>
      </div>

    </div>
  </div>

  <!-- Drawer 2: Blog -->
  <div x-show="activeDrawer === 'blog'" x-cloak
       x-transition:enter="transition ease-out duration-300 transform"
       x-transition:enter-start="translate-y-full"
       x-transition:enter-end="translate-y-0"
       x-transition:leave="transition ease-in duration-200 transform"
       x-transition:leave-start="translate-y-0"
       x-transition:leave-end="translate-y-full"
       class="fixed bottom-0 left-0 right-0 z-[200] max-h-[80vh] rounded-t-[2.5rem] haco-brand-panel border-t border-white/20 text-white flex flex-col shadow-2xl pb-20 overflow-hidden">
    
    <!-- Dong Son Bronze Drum watermark background -->
    <div class="absolute -bottom-16 -right-16 w-64 h-64 bg-no-repeat bg-contain bg-center pointer-events-none mix-blend-screen z-0" 
         style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg/960px-Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg.png'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%); opacity: 0.05;">
    </div>

    <div class="w-12 h-1.5 bg-white/20 rounded-full mx-auto my-3 shrink-0 cursor-pointer relative z-10" @click="activeDrawer = null"></div>
    <div class="px-6 pb-4 flex items-center justify-between border-b border-white/10 shrink-0 relative z-10">
      <h3 class="text-base font-extrabold uppercase tracking-wider text-[#fbbf24] flex items-center gap-2">
        <i class="ph-fill ph-article text-lg"></i> Tin Tức & Blog
      </h3>
      <button @click="activeDrawer = null" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors">
        <i class="ph-bold ph-x"></i>
      </button>
    </div>
    <div class="overflow-y-auto px-6 py-5 space-y-3 mobile-scroll flex-1 text-left relative z-10">
      <a href="<?php echo esc_url($footer_news_url); ?>" class="flex items-center gap-4 p-4 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 hover:border-[#fbbf24] transition-all group">
        <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-[#fbbf24] flex items-center justify-center shrink-0">
          <i class="ph-bold ph-newspaper text-xl"></i>
        </div>
        <div class="flex-1 text-left">
          <p class="font-bold text-sm">Xem tất cả Tin Tức & Blog</p>
          <p class="text-xs text-white/50">Cập nhật xu hướng & dự án nổi bật</p>
        </div>
        <i class="ph-bold ph-caret-right text-white/30 group-hover:text-white transition-colors"></i>
      </a>

      <a href="<?php echo esc_url(home_url('/blog-man-hinh-led/')); ?>" class="flex items-center gap-4 p-4 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 hover:border-[#fbbf24] transition-all group">
        <div class="w-10 h-10 rounded-xl bg-red-500/10 text-red-400 flex items-center justify-center shrink-0">
          <i class="ph-bold ph-monitor text-xl"></i>
        </div>
        <div class="flex-1 text-left">
          <p class="font-bold text-sm">Blog về màn hình LED</p>
          <p class="text-xs text-white/50">Kiến thức chuyên sâu về màn hình LED</p>
        </div>
        <i class="ph-bold ph-caret-right text-white/30 group-hover:text-white transition-colors"></i>
      </a>

      <a href="<?php echo esc_url(home_url('/blog-am-thanh/')); ?>" class="flex items-center gap-4 p-4 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 hover:border-[#fbbf24] transition-all group">
        <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center shrink-0">
          <i class="ph-bold ph-speaker-high text-xl"></i>
        </div>
        <div class="flex-1 text-left">
          <p class="font-bold text-sm">Blog về âm thanh</p>
          <p class="text-xs text-white/50">Tư vấn, đánh giá thiết bị âm thanh</p>
        </div>
        <i class="ph-bold ph-caret-right text-white/30 group-hover:text-white transition-colors"></i>
      </a>

      <a href="<?php echo esc_url(home_url('/kien-thuc-ky-thuat/')); ?>" class="flex items-center gap-4 p-4 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 hover:border-[#fbbf24] transition-all group">
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
  <div x-show="activeDrawer === 'info'" x-cloak
       x-transition:enter="transition ease-out duration-300 transform"
       x-transition:enter-start="translate-y-full"
       x-transition:enter-end="translate-y-0"
       x-transition:leave="transition ease-in duration-200 transform"
       x-transition:leave-start="translate-y-0"
       x-transition:leave-end="translate-y-full"
       class="fixed bottom-0 left-0 right-0 z-[200] max-h-[85vh] rounded-t-[2.5rem] haco-brand-panel border-t border-white/20 text-white flex flex-col shadow-2xl pb-20 overflow-hidden">
    
    <!-- Dong Son Bronze Drum watermark background -->
    <div class="absolute -bottom-16 -right-16 w-64 h-64 bg-no-repeat bg-contain bg-center pointer-events-none mix-blend-screen z-0" 
         style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg/960px-Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg.png'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%); opacity: 0.05;">
    </div>

    <div class="w-12 h-1.5 bg-white/20 rounded-full mx-auto my-3 shrink-0 cursor-pointer relative z-10" @click="activeDrawer = null"></div>
    <div class="px-6 pb-4 flex items-center justify-between border-b border-white/10 shrink-0 relative z-10">
      <h3 class="text-base font-extrabold uppercase tracking-wider text-[#fbbf24] flex items-center gap-2">
        <i class="ph-fill ph-info text-lg"></i> Thông Tin Liên Hệ
      </h3>
      <button @click="activeDrawer = null" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors">
        <i class="ph-bold ph-x"></i>
      </button>
    </div>
    <address class="overflow-y-auto px-6 py-5 space-y-6 mobile-scroll flex-1 text-left not-italic relative z-10">
      
      <!-- Company Branding & Socials -->
      <div class="flex flex-col items-center text-center space-y-4 pb-5 border-b border-white/10">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block">
          <img class="w-[180px] h-auto object-contain rounded shadow-sm" 
               src="<?php echo esc_url(home_url('/wp-content/uploads/2026/06/HacoLED-Logo-Moi.png')); ?>" alt="HacoLED Logo" />
        </a>
        <p class="text-xs text-white/70 leading-relaxed max-w-xs">
          <?php _e('Công ty CP Công Nghệ HACO Việt Nam - Đơn vị tiên phong cung cấp giải pháp màn hình LED và thiết bị công nghệ hiển thị cao cấp.', 'hacoled'); ?>
        </p>
        <div class="flex gap-2">
          <!-- Facebook SVG -->
          <a class="w-9 h-9 rounded bg-haco-red/80 border border-white/15 flex items-center justify-center text-slate-300 hover:bg-[#fbbf24] hover:text-haco-ink transition-all"
             href="https://www.facebook.com/hacoled" target="_blank" rel="noopener" aria-label="Facebook">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M9 8H7v3h2v9h3v-9h3l.5-3H12V6c0-.883.398-1.5 1.5-1.5H15V1h-2.5C9.945 1 9 2.557 9 4.833V8z"/></svg>
          </a>
          <!-- Twitter / X SVG -->
          <a class="w-9 h-9 rounded bg-haco-red/80 border border-white/15 flex items-center justify-center text-slate-300 hover:bg-[#fbbf24] hover:text-haco-ink transition-all"
             href="https://x.com/HacoLed" target="_blank" rel="noopener" aria-label="X (Twitter)">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
          <!-- Youtube SVG -->
          <a class="w-9 h-9 rounded bg-haco-red/80 border border-white/15 flex items-center justify-center text-slate-300 hover:bg-[#fbbf24] hover:text-haco-ink transition-all"
             href="https://www.youtube.com/@hacoled" target="_blank" rel="noopener" aria-label="YouTube">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.163a3.003 3.003 0 00-2.11-2.11C19.517 3.545 12 3.545 12 3.545s-7.517 0-9.388.508a3.003 3.003 0 00-2.11 2.11C0 8.033 0 12 0 12s0 3.967.502 5.837a3.003 3.003 0 002.11 2.11c1.871.508 9.388.508 9.388.508s7.517 0 9.388-.508a3.003 3.003 0 002.11-2.11C24 15.967 24 12 24 12s0-3.967-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
          </a>
          <!-- Linkedin SVG -->
          <a class="w-9 h-9 rounded bg-haco-red/80 border border-white/15 flex items-center justify-center text-slate-300 hover:bg-[#fbbf24] hover:text-haco-ink transition-all"
             href="https://www.linkedin.com/in/hacoled/" target="_blank" rel="noopener" aria-label="LinkedIn">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
          </a>
        </div>
      </div>
      
      <!-- Contacts Quick Grid -->
      <div class="grid grid-cols-2 gap-3">
        <a href="tel:0342324488" class="p-3 bg-white/5 border border-white/10 rounded-2xl flex flex-col items-center text-center">
          <i class="ph-fill ph-phone text-xl text-[#fbbf24] mb-1"></i>
          <span class="text-[10px] text-white/50 font-bold uppercase">Hotline</span>
          <span class="text-xs font-extrabold text-white">034.232.4488</span>
        </a>
        <a href="tel:0868474488" class="p-3 bg-white/5 border border-white/10 rounded-2xl flex flex-col items-center text-center">
          <i class="ph-fill ph-headset text-xl text-[#fbbf24] mb-1"></i>
          <span class="text-[10px] text-white/50 font-bold uppercase">CSKH & Mua Hàng</span>
          <span class="text-xs font-extrabold text-white">086.847.4488</span>
        </a>
        <a href="mailto:kinhdoanh@hacoled.com" class="p-3 bg-white/5 border border-white/10 rounded-2xl flex flex-col items-center text-center col-span-2">
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
          <p class="text-xs text-white/80 pl-3 leading-relaxed mb-1.5"><strong>Trụ sở chính:</strong> Ngách 57/92 Đường Quang Minh, Thôn Gia Thượng 2, Xã Quang Minh, TP. Hà Nội</p>
          <p class="text-xs text-white/80 pl-3 leading-relaxed"><strong>Văn phòng HN:</strong> Số 11 ngõ 10 Nghĩa Đô, phường Nghĩa Đô, TP. Hà Nội</p>
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

      <div class="pt-3 border-t border-white/10 text-center">
        <span class="text-[11px] text-white/50"><strong>MST:</strong> 0108701064</span>
      </div>

    </address>
  </div>

  <!-- Drawer 4: Menu -->
  <div x-show="activeDrawer === 'menu'" x-cloak
       x-transition:enter="transition ease-out duration-300 transform"
       x-transition:enter-start="translate-y-full"
       x-transition:enter-end="translate-y-0"
       x-transition:leave="transition ease-in duration-200 transform"
       x-transition:leave-start="translate-y-0"
       x-transition:leave-end="translate-y-full"
       class="fixed bottom-0 left-0 right-0 z-[200] max-h-[85vh] rounded-t-[2.5rem] haco-brand-panel border-t border-white/20 text-white flex flex-col shadow-2xl pb-20 overflow-hidden">
    
    <!-- Dong Son Bronze Drum watermark background -->
    <div class="absolute -bottom-16 -right-16 w-64 h-64 bg-no-repeat bg-contain bg-center pointer-events-none mix-blend-screen z-0" 
         style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg/960px-Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg.png'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%); opacity: 0.05;">
    </div>

    <div class="w-12 h-1.5 bg-white/20 rounded-full mx-auto my-3 shrink-0 cursor-pointer relative z-10" @click="activeDrawer = null"></div>
    <div class="px-6 pb-4 flex items-center justify-between border-b border-white/10 shrink-0 relative z-10">
      <h3 class="text-base font-extrabold uppercase tracking-wider text-[#fbbf24] flex items-center gap-2">
        <i class="ph-fill ph-list text-lg"></i> Menu Điều Hướng
      </h3>
      <button @click="activeDrawer = null" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors">
        <i class="ph-bold ph-x"></i>
      </button>
    </div>
    <div class="overflow-y-auto px-6 py-4 space-y-4 mobile-scroll flex-1 text-left relative z-10">
      
      <!-- Search Mobile -->
      <div class="pb-3 border-b border-white/10 mb-4">
        <form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="relative">
          <input type="search" name="s" placeholder="Tìm kiếm sản phẩm, dịch vụ..." class="w-full rounded-xl pl-10 pr-4 py-2.5 text-[13px] text-white placeholder-white/60 bg-white/5 border border-white/15 focus:outline-none focus:border-[#fbbf24] focus:bg-white/10 transition-all" />
          <span class="absolute left-3 top-1/2 -translate-y-1/2 text-white/50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.602 10.602z"/></svg>
          </span>
        </form>
      </div>

      <!-- Primary Pages List with Accordions -->
      <div class="space-y-2 text-left">
        <?php if (hacoled_header_menu_enabled('home')) : ?><a href="<?php echo esc_url(hacoled_header_menu_url('home')); ?>" class="block px-3 py-2.5 text-sm font-bold text-white/90 hover:bg-white/5 rounded-xl transition-all"><?php echo esc_html(hacoled_header_menu_label('home')); ?></a><?php endif; ?>
        <?php
        foreach (['about', 'led', 'videowall', 'solutions', 'audio', 'projects'] as $mobile_menu_key) {
            hacoled_render_mobile_header_menu($header_menu_configs[$mobile_menu_key] ?? []);
        }
        ?>
        <?php if (hacoled_header_menu_enabled('services')) : ?><a href="<?php echo esc_url(hacoled_header_menu_url('services')); ?>" class="block px-3 py-2.5 text-sm font-bold text-white/90 hover:bg-white/5 rounded-xl transition-all"><?php echo esc_html(hacoled_header_menu_label('services')); ?></a><?php endif; ?>
        <?php hacoled_render_mobile_header_menu($header_menu_configs['news'] ?? []); ?>
        <?php if (hacoled_header_menu_enabled('contact')) : ?><a href="<?php echo esc_url(hacoled_header_menu_url('contact')); ?>" class="block px-3 py-2.5 text-sm font-bold text-[#fbbf24] hover:bg-white/5 rounded-xl transition-all"><?php echo esc_html(hacoled_header_menu_label('contact')); ?></a><?php endif; ?>
      </div>

    </div>
  </div>

</div>
</header>
