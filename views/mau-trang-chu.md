
text/x-generic page-homepage.php ( PHP script, UTF-8 Unicode text, with very long lines )
<?php
/**
 * Template name: Trang Chủ (Homepage)
 * @package       Wordpress
 */

get_header();

/**
 * AMP Story: Lấy logo và poster URL động từ WordPress
 * publisher-logo-src → logo theme đang set trong Flatsome Customizer
 * poster-portrait-src → featured image trang chủ (nếu có), fallback thumbnail mới nhất, rồi fallback ảnh hardcode
 */

// 1. Logo: Flatsome lưu attachment ID trong theme mod 'site_logo'
$_amp_logo_id  = get_theme_mod( 'site_logo' );
$_amp_logo_url = '';
if ( $_amp_logo_id && is_numeric( $_amp_logo_id ) ) {
    $_amp_logo_url = wp_get_attachment_image_url( $_amp_logo_id, 'full' );
}
// Fallback: WordPress custom logo
if ( ! $_amp_logo_url ) {
    $_amp_custom_logo_id = get_theme_mod( 'custom_logo' );
    if ( $_amp_custom_logo_id ) {
        $_amp_logo_url = wp_get_attachment_image_url( $_amp_custom_logo_id, 'full' );
    }
}
// Fallback: site icon (favicon)
if ( ! $_amp_logo_url ) {
    $_amp_logo_url = get_site_icon_url( 512 );
}
// Fallback cuối cùng: asset mặc định theme
if ( ! $_amp_logo_url ) {
    $_amp_logo_url = get_template_directory_uri() . '/assets/img/logo.png';
}

// 2. Poster: featured image của trang chủ (page_on_front)
$_amp_front_id  = (int) get_option( 'page_on_front' );
$_amp_poster_url = '';
if ( $_amp_front_id ) {
    $_amp_poster_url = get_the_post_thumbnail_url( $_amp_front_id, 'large' );
}
// Fallback: ảnh mới nhất trong Media Library
if ( ! $_amp_poster_url ) {
    $_amp_latest_img = get_posts( array(
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'posts_per_page' => 1,
        'post_status'    => 'inherit',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );
    if ( ! empty( $_amp_latest_img ) ) {
        $_amp_poster_url = wp_get_attachment_image_url( $_amp_latest_img[0]->ID, 'large' );
    }
}
// Fallback cuối: ảnh hero có sẵn trong template
if ( ! $_amp_poster_url ) {
    $_amp_poster_url = 'https://hacoled.com/wp-content/uploads/2026/04/anh-doi-ky-thuat-hacoled-cung-voi-bac-chinh.jpg';
}
?>
    <!-- Các thư viện của riêng trang Chủ (Bypass Litespeed Cache) -->
    <link data-no-optimize="1" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style data-no-optimize="1">
        .product-swiper .swiper-pagination-bullet-active { background-color: #d32f2f; }
        .product-slider-wrapper .swiper-button-lock { display: flex !important; opacity: 0.3 !important; cursor: not-allowed !important; pointer-events: none !important; }
        .product-slider-wrapper .swiper-button-disabled { opacity: 0.3 !important; cursor: not-allowed !important; pointer-events: none !important; }
    </style>
    
    <!-- Fonts: Được kế thừa từ Header toàn cục của theme -->
    
    <!-- Icons -->
    <script data-no-optimize="1" src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <!-- Swiper JS -->
    <script data-no-optimize="1" src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Tailwind CSS -->
    <script data-no-optimize="1" src="https://cdn.tailwindcss.com"></script>
    <script data-no-optimize="1">
        tailwind.config = {
  theme: {
      extend: {
          fontFamily: { 
    sans: ['"Inter"', '"Outfit"', 'sans-serif']
          },
          colors: {
    brand: {
        red: '#CC0000',      // Đỏ thương hiệu (Sang, mạnh mẽ)
        darkRed: '#990000',  // Đỏ sậm
        gold: '#F5A623',     // Vàng nghệ thuật (Premium)
        lightGold: '#FDF4E3',// Vàng nhạt (Nền phụ)
        text: '#1C0505',     // Đỏ nâu sâu (thay đen)
        muted: '#5C3030',    // Đỏ xám trung tính
        bg: '#FAFAFA',       // Trắng kem hiện đại
    }
          }
      }
  }
        }
    </script>
    <style data-no-optimize="1">
        @media (max-width: 767px) { html { font-size: 9.6px !important; } }
        body { background-color: #FAFAFA; color: #1C0505; }
        /* KHÔNG dùng overflow-x:hidden trên body vì sẽ tạo stacking context mới
           làm vỡ z-index của mobile menu Flatsome (phải ấn 2 lần mới hoạt động) */

        /* Patterns */
        .bg-tech-grid {
  background-image: linear-gradient(to right, rgba(180, 0, 0, 0.05) 1px, transparent 1px),
          linear-gradient(to bottom, rgba(180, 0, 0, 0.05) 1px, transparent 1px);
  background-size: 32px 32px;
        }
        
        .bg-dongson {
  position: absolute;
  background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg/960px-Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg.png');
  background-repeat: no-repeat;
  background-position: center;
  background-size: contain;
  pointer-events: none;
  z-index: 0;
        }
        .bg-dongson.light {
  filter: url(#to-gold-light);
  opacity: 0.12;
        }
        .bg-dongson.dark {
  filter: url(#to-gold-dark);
  opacity: 0.15;
        }

        /* Glassmorphism */
        .glass-card {
  background: rgba(255, 255, 255, 0.7);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.8);
  box-shadow: 0 10px 40px -10px rgba(180, 0, 0, 0.08);
  transition: all 0.4s ease;
        }
        .glass-card:hover {
  background: rgba(255, 255, 255, 0.9);
  border-color: rgba(245, 166, 35, 0.4);
  box-shadow: 0 20px 40px -10px rgba(204, 0, 0, 0.15);
  transform: translateY(-5px);
        }

        .glass-card-dark {
  background: rgba(80, 5, 5, 0.55);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.12);
  transition: all 0.4s ease;
        }
        .glass-card-dark:hover {
  border-color: rgba(245, 166, 35, 0.5);
  box-shadow: 0 10px 30px rgba(245, 166, 35, 0.2);
        }

        /* Decor Glows */
        .glow-red { position: absolute; width: 300px; height: 300px; background: rgba(204, 0, 0, 0.15); filter: blur(80px); border-radius: 50%; pointer-events: none; z-index: 0; }
        .glow-gold { position: absolute; width: 300px; height: 300px; background: rgba(245, 166, 35, 0.15); filter: blur(80px); border-radius: 50%; pointer-events: none; z-index: 0; }

        /* Animations */
        .fade-up { opacity: 0; transform: translateY(30px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
        .fade-up.visible { opacity: 1; transform: translateY(0); }

        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        ::selection { background: #CC0000; color: #fff; }
        
        .text-gradient {
  background: linear-gradient(to right, #CC0000, #F5A623);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
        }
    </style>
    <script data-no-optimize="1">
        /* Scroll smooth không can thiệp vào click events */
        document.documentElement.classList.add("scroll-smooth");
    </script>
    <script data-no-optimize="1">
    /**
     * FIX: Flatsome lazy-init trigger
     * 
     * Flatsome cố tình delay hàm Qe() (tính sticky header height) đến lần interaction đầu tiên
     * bằng cách lắng nghe: keydown, pointermove, touchstart { once: true }
     * 
     * Điều này gây ra: lần chạm/click đầu tiên của user trigger Qe() → reflow header → 
     * miss click target → phải chạm lần 2 mới được.
     * 
     * Giải pháp: Dispatch synthetic events ngay sau DOMContentLoaded để Flatsome
     * hoàn tất init trước khi user thao tác thật.
     */
    function _flatsomeEarlyInit() {
        // setTimeout(0) nhường JS engine xử lý toàn bộ pending callbacks
        // (bao gồm Flatsome's DOMContentLoaded handler đăng ký trigger Qe)
        // trước khi chúng ta dispatch synthetic events
        setTimeout(function() {
            try {
                window.dispatchEvent(new PointerEvent('pointermove', {
                    bubbles: true, cancelable: true, clientX: 1, clientY: 1
                }));
            } catch(e) {}
            try {
                // iOS Safari cần TouchEvent (PointerEvent không trigger Flatsome's touchstart listener)
                window.dispatchEvent(new TouchEvent('touchstart', { bubbles: true, cancelable: true }));
            } catch(e) {}
        }, 0);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', _flatsomeEarlyInit, { once: true });
    } else {
        _flatsomeEarlyInit();
    }
    </script>
<?php
// HELPER FUNCTION: Render Product Slides from WooCommerce Categories
function haco_render_product_slides($categories) {
    if ( ! class_exists( 'WooCommerce' ) ) {
        echo '<div class="w-full text-center py-10">Vui lòng kích hoạt WooCommerce</div>';
        return;
    }
    
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 12,
        'tax_query' => array(
  array(
      'taxonomy' => 'product_cat',
      'field'    => 'slug',
      'terms'    => $categories,
      'operator' => 'IN'
  )
        )
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) {
        while ($query->have_posts()) {
  $query->the_post();
  global $product;
  $img = get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: 'https://via.placeholder.com/600x400';
  $title = get_the_title();
  $price = $product->get_price_html();
  $link = get_permalink();
  $tag = "Mới";
  if ($product->is_on_sale()) $tag = "Sale";
  elseif ($product->is_featured()) $tag = "Hot";
  ?>
      <div class="swiper-slide rounded-2xl overflow-hidden group cursor-pointer relative" onclick="window.location.href='<?php echo esc_url($link); ?>'">
          <div class="aspect-square relative overflow-hidden bg-gray-100">
    <!-- Tag badge -->
    <div class="absolute top-2.5 left-2.5 z-10">
        <span class="bg-white/90 backdrop-blur-sm text-brand-red text-[10px] font-bold px-2 py-1 rounded shadow-sm uppercase tracking-wider"><?php echo esc_html($tag); ?></span>
    </div>

    <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($title); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-600">

    <!-- Glassmorphism đỏ thắm, viền vàng, text vàng óng -->
    <div class="absolute bottom-3 left-3 right-3 z-10">
        <div class="block w-full backdrop-blur-md border shadow-lg px-3 py-2 rounded-xl"
   style="background: rgba(90,12,12,0.65); border-color: rgba(245,166,35,0.55);">
  <div class="w-4 h-0.5 bg-brand-gold mb-1.5 group-hover:w-full transition-all duration-500 ease-out"></div>
  <h4 class="font-heading font-bold text-sm leading-snug line-clamp-2
   bg-gradient-to-r from-yellow-200 via-brand-gold to-yellow-300
   bg-clip-text text-transparent"><?php echo esc_html($title); ?></h4>
        </div>
    </div>

    <!-- Nút CTA — góc trên phải, hiện khi hover -->
    <div class="absolute top-2.5 right-2.5 z-10
      opacity-0 group-hover:opacity-100
      transition-opacity duration-300">
        <span class="inline-flex items-center gap-1 bg-brand-red text-white text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-1.5 rounded-full shadow-lg backdrop-blur-sm">
  Xem <i class="ph-bold ph-arrow-up-right"></i>
        </span>
    </div>
          </div>
      </div>
  <?php
        }
    } else {
        // Render 6 mock products for testing loop functionality
        $mock_titles = array("Sản phẩm Demo Thiết Bị Mẫu 1 Thiết Bị Mẫu 1", "Sản phẩm Demo Hình Ảnh 2", "Sản phẩm Demo Chuyên Dụng 3", "Giải pháp hiển thị Demo 4", "Hệ thống cao cấp Demo 5", "Module sự kiện Demo 6");
        $mock_imgs = array(
  "https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=600&auto=format&fit=crop",
  "https://images.unsplash.com/photo-1492619375914-88005aa9e8fb?q=80&w=600&auto=format&fit=crop",
  "https://images.unsplash.com/photo-1470229722913-7c090bf8c04c?q=80&w=600&auto=format&fit=crop",
  "https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?q=80&w=600&auto=format&fit=crop",
  "https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=600&auto=format&fit=crop",
  "https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=600&auto=format&fit=crop"
        );
        for ($i = 0; $i < 6; $i++) {
  ?>
  <div class="swiper-slide rounded-2xl overflow-hidden group cursor-pointer relative">
      <div class="aspect-square relative overflow-hidden bg-gray-100">
          <!-- Tag badge -->
          <div class="absolute top-2.5 left-2.5 z-10">
    <span class="bg-white/90 backdrop-blur-sm text-brand-red text-[10px] font-bold px-2 py-1 rounded shadow-sm uppercase tracking-wider">Demo</span>
          </div>

          <img src="<?php echo esc_url($mock_imgs[$i]); ?>" alt="<?php echo esc_attr($mock_titles[$i]); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-600">

          <!-- Glassmorphism đỏ thắm, viền vàng, text vàng óng -->
          <div class="absolute bottom-3 left-3 right-3 z-10">
    <div class="block w-full backdrop-blur-md border shadow-lg px-3 py-2 rounded-xl"
         style="background: rgba(90,12,12,0.65); border-color: rgba(245,166,35,0.55);">
        <div class="w-4 h-0.5 bg-brand-gold mb-1.5 group-hover:w-full transition-all duration-500 ease-out"></div>
        <h4 class="font-heading font-bold text-sm leading-snug line-clamp-2
         bg-gradient-to-r from-yellow-200 via-brand-gold to-yellow-300
         bg-clip-text text-transparent"><?php echo esc_html($mock_titles[$i]); ?></h4>
    </div>
          </div>

          <!-- Nút CTA — góc trên phải, hiện khi hover -->
          <div class="absolute top-2.5 right-2.5 z-10
  opacity-0 group-hover:opacity-100
  transition-opacity duration-300">
    <span class="inline-flex items-center gap-1 bg-brand-red text-white text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-1.5 rounded-full shadow-lg backdrop-blur-sm">
        Xem <i class="ph-bold ph-arrow-up-right"></i>
    </span>
          </div>
      </div>
  </div>
  <?php
        }
    }
    wp_reset_postdata();
}
?>
    <!-- AMP Story metadata: publisher-logo-src và poster-portrait-src lấy động từ WordPress -->
    <!-- Khắc phục lỗi Google Search Console: "Thiếu URL trong thẻ HTML amp-story" -->
    <amp-story
        standalone
        title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
        publisher="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
        publisher-logo-src="<?php echo esc_url( $_amp_logo_url ); ?>"
        poster-portrait-src="<?php echo esc_url( $_amp_poster_url ); ?>">
    </amp-story>

    <main id="main" class="w-full overflow-clip bg-tech-grid">

        <!-- SVG Filter Definitions -->
        <!-- feColorMatrix: black→gold, white→transparent -->
        <!-- feComposite operator=in: mask lại alpha gốc, tránh pixel trong suốt bên ngoài bị tô vàng -->
        <svg style="display:none;" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
  <defs>
      <!-- #D4AF37 Metallic Gold cho nền sáng -->
      <filter id="to-gold-light" color-interpolation-filters="sRGB">
          <feColorMatrix type="matrix" values="
    -0.831  0  0  0  0.831
     0  -0.686  0  0  0.686
     0  0  -0.216  0  0.216
    -1  0  0  0  1
          " result="gold"/>
          <!-- Mask: pixel ngoài vòng tròn (A gốc=0) giữ trong suốt -->
          <feComposite in="gold" in2="SourceGraphic" operator="in"/>
      </filter>
      <!-- #FFD700 Bright Gold cho nền tối -->
      <filter id="to-gold-dark" color-interpolation-filters="sRGB">
          <feColorMatrix type="matrix" values="
    -1  0  0  0  1
     0  -0.843  0  0  0.843
     0  0  0  0  0
    -1  0  0  0  1
          " result="gold"/>
          <feComposite in="gold" in2="SourceGraphic" operator="in"/>
      </filter>
      <!-- TechZ logo: giữ kênh R, xoá G+B → trắng→đỏ, đỏ gốc giữ nguyên -->
      <filter id="to-techz-red" color-interpolation-filters="sRGB">
          <feColorMatrix type="matrix" values="
    1  0  0  0  0
    0  0  0  0  0
    0  0  0  0  0
    0  0  0  1  0
          "/>
      </filter>
      <!-- Tách nền trắng: giữ màu gốc, tính Alpha = 1 - luminance (Rec.601) -->
      <!-- Trắng (lum=1) → A=0 (trong suốt). Màu đậm → A cao → giữ nguyên -->
      <filter id="to-remove-white" color-interpolation-filters="sRGB">
          <feColorMatrix type="matrix" values="
    1      0      0  0  0
    0      1      0  0  0
    0      0      1  0  0
   -0.299 -0.587 -0.114  0  1
          "/>
      </filter>
  </defs>
        </svg>
        
        
        <!-- ========================================== -->
        <!-- SECTION 1: HERO        -->
        <!-- ========================================== -->
        <style data-no-optimize="1">
  /* Chỉ clip overflow trên các wrapper nội dung, KHÔNG đặt trên html/body
     vì sẽ tạo stacking context mới làm vỡ z-index của mobile menu Flatsome */
  #wrapper, #main, .page-wrapper { overflow-x: clip; }

  .animate-fade-in-up { animation: heroFadeInUp 1s cubic-bezier(0.16,1,0.3,1) forwards; opacity: 0; transform: translateY(30px); }
  .delay-100 { animation-delay: 100ms; }
  .delay-200 { animation-delay: 200ms; }
  .delay-300 { animation-delay: 300ms; }
  .delay-400 { animation-delay: 400ms; }
  @keyframes heroFadeInUp { to { opacity: 1; transform: translateY(0); } }

  .animate-spin-slow { animation: spinSlow 60s linear infinite; }
  @keyframes spinSlow { to { transform: translate(-50%,-50%) rotate(360deg); } }

  .animate-led-pulse { animation: ledPulse 3s infinite alternate; }
  @keyframes ledPulse {
      0%   { box-shadow: 0 0 10px rgba(220,38,38,0.2), inset 0 0 10px rgba(220,38,38,0.1); }
      100% { box-shadow: 0 0 30px rgba(220,38,38,0.6), inset 0 0 20px rgba(220,38,38,0.3); }
  }
  .perspective-1000 { perspective: 1000px; }

  .hero-float-1 { animation: heroFloat1 6s ease-in-out infinite; }
  .hero-float-2 { animation: heroFloat2 8s ease-in-out infinite; animation-delay: 1s; }
  .hero-float-3 { animation: heroFloat3 7s ease-in-out infinite; animation-delay: 2s; }
  @keyframes heroFloat1 {
      0%,100% { transform: rotateY(-10deg) rotateX(4deg) translateY(0); }
      50%     { transform: rotateY(-10deg) rotateX(4deg) translateY(-12px); }
  }
  @keyframes heroFloat2 {
      0%,100% { transform: rotateY(-15deg) rotateX(6deg) translateY(0) scale(1.05); }
      50%     { transform: rotateY(-15deg) rotateX(6deg) translateY(-15px) scale(1.05); }
  }
  @keyframes heroFloat3 {
      0%,100% { transform: rotateY(-5deg) rotateX(-4deg) translateY(0); }
      50%     { transform: rotateY(-5deg) rotateX(-4deg) translateY(-8px); }
  }
        </style>

        <section id="hero-section" class="relative w-full min-h-[75vh] flex items-center overflow-hidden bg-[#0A0000]">

  <!-- Lớp 0: Dynamic Gradient Background -->
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_30%,#4A0404_0%,#0A0000_70%)]"></div>

  <!-- Lớp 1: Ảnh nền mờ -->
  <div class="absolute inset-0 z-0 opacity-[0.15] mix-blend-luminosity">
      <img src="https://hacoled.com/wp-content/uploads/2026/04/anh-doi-ky-thuat-hacoled-cung-voi-bac-chinh.jpg"
 alt="Đội ngũ HacoLED" class="w-full h-full object-cover" style="object-position: center 30%;"
 onerror="this.src='https://hacoled.com/wp-content/uploads/2026/03/thiet.webp'">
      <div class="absolute inset-0 bg-gradient-to-r from-[#0A0000] via-[#0A0000]/80 to-transparent"></div>
      <div class="absolute inset-0 bg-gradient-to-t from-[#0A0000] via-transparent to-[#0A0000]/80"></div>
  </div>

  <!-- Lớp 2: Tech Grid -->
  <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff06_1px,transparent_1px),linear-gradient(to_bottom,#ffffff06_1px,transparent_1px)] bg-[size:40px_40px] z-0 pointer-events-none"></div>

  <!-- Lớp 3: Trống Đồng Đông Sơn xoay chậm -->
  <div class="absolute z-0 pointer-events-none animate-spin-slow opacity-[0.06]"
       style="width:1400px;height:1400px;top:50%;left:50%;transform:translate(-50%,-50%);">
       <div class="bg-dongson dark w-full h-full"></div>
  </div>

  <!-- Ambient Light glows -->
  <div class="absolute top-0 -left-20 w-[600px] h-[600px] bg-brand-red/15 rounded-full blur-[140px] pointer-events-none z-0"></div>
  <div class="absolute -bottom-20 -right-10 w-[700px] h-[700px] bg-brand-gold/10 rounded-full blur-[160px] pointer-events-none z-0"></div>

  <!-- CONTENT -->
  <div class="container mx-auto px-6 md:px-12 relative z-10 w-full pt-40 lg:pt-56 pb-20">
      <div class="flex flex-col lg:flex-row items-center w-full gap-16 lg:gap-10">

          <!-- CỘT TRÁI: TEXT -->
          <div class="w-full lg:w-5/12 flex flex-col items-start">

    <!-- Tagline badge -->
    <div class="animate-fade-in-up flex items-center gap-3 px-5 py-2.5 mb-7 relative overflow-hidden border border-white/10 bg-white/5 backdrop-blur-md rounded-full shadow-[0_8px_32px_rgba(0,0,0,0.2)]">
        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-gradient-to-b from-brand-gold to-brand-red rounded-l-full"></div>
        <i class="ph-fill ph-sparkle text-brand-gold animate-pulse text-base"></i>
        <span class="text-gray-200 text-xs font-medium uppercase tracking-[0.2em]">Đơn vị tiên phong cung cấp giải pháp hiển thị</span>
    </div>

    <!-- H1 -->
    <h1 class="animate-fade-in-up delay-100 text-4xl md:text-5xl lg:text-[3.5rem] font-bold text-white leading-[1.15] mb-6 tracking-tight drop-shadow-lg">
        HacoLED – Đối tác tin cậy cho các <br class="hidden lg:block" />
        <span class="relative inline-block mt-2">
            <span class="absolute -inset-1 bg-gradient-to-r from-brand-gold via-yellow-400 to-brand-red blur-lg opacity-30"></span>
            <span class="relative text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 via-brand-gold to-yellow-500">công trình lớn</span>
        </span>
    </h1>

    <!-- Description -->
    <p class="animate-fade-in-up delay-200 text-gray-300 text-base md:text-lg font-light mb-10 leading-relaxed max-w-xl">
        Với kinh nghiệm triển khai thành công <strong class="text-white font-semibold">1000+ dự án</strong> quy quy mô toàn quốc, chúng tôi cam kết kiến tạo những không gian hiển thị đỉnh cao, kết hợp hoàn hảo giữa chất lượng linh kiện và giá thành tối ưu.
    </p>

    <!-- CTA Buttons -->
    <div class="animate-fade-in-up delay-300 flex flex-col sm:flex-row items-center gap-6 w-full sm:w-auto">
        <a href="#projects" class="relative group w-full sm:w-auto flex items-center justify-center gap-3 bg-gradient-to-r from-brand-red to-[#990000] text-white px-8 py-4 font-bold uppercase tracking-widest rounded-full overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-[0_10px_40px_rgba(204,0,0,0.4)] border border-red-500/30">
  <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-[150%] group-hover:translate-x-[150%] transition-transform duration-700"></span>
  <i class="ph ph-squares-four text-xl"></i>
  <span>Xem Công Trình</span>
        </a>
        <a href="#solutions" class="group flex items-center justify-center sm:justify-start gap-4 cursor-pointer text-gray-300 hover:text-white transition-colors w-full sm:w-auto">
  <div class="relative w-14 h-14 flex items-center justify-center rounded-full border border-white/20 bg-white/5 backdrop-blur-md group-hover:border-brand-gold group-hover:bg-brand-gold/10 transition-all duration-300 shadow-lg">
      <i class="ph-fill ph-play text-xl group-hover:text-brand-gold transition-colors"></i>
      <div class="absolute inset-0 rounded-full border border-brand-gold/0 group-hover:border-brand-gold/40 group-hover:animate-ping"></div>
  </div>
  <span class="font-medium text-sm tracking-widest uppercase">Khám phá giải pháp</span>
        </a>
    </div>

    <!-- Stats -->
    <div class="animate-fade-in-up delay-400 flex gap-12 md:gap-24 mt-12 pt-10 border-t border-white/10 w-full max-w-2xl">
        <div class="flex flex-col gap-2">
  <div class="text-3xl font-heading font-extrabold text-white tracking-tight">1000<span class="text-brand-red">+</span></div>
  <div class="text-[11px] text-gray-400 uppercase tracking-widest font-medium">Công trình</div>
        </div>
        <div class="flex flex-col gap-2">
  <div class="text-3xl font-heading font-extrabold text-white tracking-tight">24<span class="text-blue-500">/7</span></div>
  <div class="text-[11px] text-gray-400 uppercase tracking-widest font-medium">Hỗ trợ kỹ thuật</div>
        </div>
    </div>
          </div>

          <!-- CỘT PHẢI: 3D FLOATING PANELS -->
          <div class="w-full lg:w-7/12 relative h-[450px] lg:h-[650px] perspective-1000 flex items-center justify-center animate-fade-in-up delay-400">
    <div class="relative w-full h-full">

        <!-- Panel 1: Sau, trái -->
        <div class="absolute top-[10%] left-0 w-[55%] h-[260px] lg:h-[320px] rounded-2xl overflow-hidden border border-white/10 bg-gray-900 shadow-2xl hero-float-1 opacity-80 z-30 transition-transform duration-500 hover:scale-105 hover:opacity-100">
  <div class="absolute inset-0 bg-[linear-gradient(rgba(0,0,0,0.1)_1px,transparent_1px),linear-gradient(90deg,rgba(0,0,0,0.1)_1px,transparent_1px)] bg-[size:4px_4px] z-10 pointer-events-none mix-blend-overlay"></div>
  <img src="https://hacoled.com/wp-content/uploads/2026/04/anh-doi-ky-thuat-hacoled-cung-voi-bac-chinh.jpg" onerror="this.src='https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=800&q=80'" class="w-full h-full object-cover grayscale-[20%]" alt="Công trình LED HacoLED">
        </div>

        <!-- Panel 2: Giữa, to nhất, viền LED đỏ -->
        <div class="absolute top-[20%] left-[20%] lg:left-[22%] w-[65%] h-[300px] lg:h-[380px] rounded-2xl overflow-hidden border border-brand-red/40 bg-black animate-led-pulse hero-float-2 z-20 shadow-[0_20px_50px_rgba(204,0,0,0.2)]">
  <div class="absolute inset-0 bg-[linear-gradient(rgba(0,0,0,0.2)_1px,transparent_1px),linear-gradient(90deg,rgba(0,0,0,0.2)_1px,transparent_1px)] bg-[size:4px_4px] z-10 pointer-events-none mix-blend-overlay"></div>
  <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/5 to-transparent z-10"></div>
  <img src="https://hacoled.com/wp-content/uploads/2025/04/man-hinh-led-san-khauhacoled-1-2.jpg" onerror="this.src='https://images.unsplash.com/photo-1492619375914-88005aa9e8fb?auto=format&fit=crop&w=800&q=80'" class="w-full h-full object-cover" alt="Màn hình LED sân khấu HacoLED">
        </div>

        <!-- Panel 3: Nhỏ, phải dưới -->
        <div class="absolute bottom-[12%] right-[2%] w-[40%] h-[180px] lg:h-[220px] rounded-2xl overflow-hidden border border-white/20 bg-gray-800 shadow-[0_30px_60px_rgba(0,0,0,0.6)] hero-float-3 z-10 transition-transform duration-500 hover:scale-105">
  <div class="absolute inset-0 bg-[linear-gradient(rgba(0,0,0,0.1)_1px,transparent_1px),linear-gradient(90deg,rgba(0,0,0,0.1)_1px,transparent_1px)] bg-[size:4px_4px] z-10 pointer-events-none mix-blend-overlay"></div>
  <img src="https://hacoled.com/wp-content/uploads/2025/04/man-hinh-led-p30-trong-nha-hacoled-11.jpg" onerror="this.src='https://images.unsplash.com/photo-1505373877841-8d25f7d46678?auto=format&fit=crop&w=800&q=80'" class="w-full h-full object-cover" alt="Màn hình LED trong nhà HacoLED">
        </div>

        <!-- Floating Data Tags -->
        <div class="absolute top-[40%] right-[-5%] bg-black/40 backdrop-blur-xl border border-white/10 px-4 py-2.5 rounded-xl shadow-xl flex items-center gap-3 z-40 hero-float-1">
            <div class="w-2 h-2 rounded-full bg-brand-gold animate-pulse"></div>
  <span class="text-xs font-mono font-bold text-brand-gold tracking-wider">RES: 4K UHD+</span>
        </div>
        <div class="absolute bottom-[25%] left-[-2%] bg-black/40 backdrop-blur-xl border border-white/10 px-4 py-2.5 rounded-xl shadow-xl flex items-center gap-3 z-40 hero-float-3">
            <div class="w-2 h-2 rounded-full bg-brand-red animate-pulse"></div>
  <span class="text-xs font-mono font-bold text-brand-red tracking-wider">REFRESH: 3840Hz</span>
        </div>

    </div>
          </div>

      </div>
  </div>
        </section>

        <!-- ========================================== -->
        <!-- SECTION 2 & 3: GIẢI PHÁP CUNG CẤP KHÁC     -->
        <!-- ========================================== -->
        <section id="solutions" class="py-16 relative overflow-hidden bg-[#FAFAFA]" data-tech-bg="circuit">
  <!-- Decorative Glows -->
  <div class="glow-red -top-20 -left-20"></div>
  <div class="glow-gold top-1/2 right-0"></div>

  <div class="container mx-auto px-4 md:px-8 relative z-10">
      <div class="text-center max-w-3xl mx-auto mb-10 fade-up">
          <p class="text-brand-red text-sm font-bold uppercase tracking-widest mb-2 flex items-center justify-center gap-2">
    <i class="ph-fill ph-squares-four text-brand-gold"></i> Hệ Sinh Thái Cốt Lõi
          </p>
          <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold uppercase tracking-tight text-brand-text mb-4">Giải Pháp Toàn Diện</h2>
          <p class="text-brand-muted text-base">Cung cấp cơ sở hạ tầng phần cứng đa dạng, đáp ứng mọi bài toán không gian và yêu cầu kỹ thuật khắt khe nhất từ khách hàng.</p>
      </div>

      <!-- SECTION 2: 3 Giải pháp chính -->
      <div class="grid grid-cols-3 gap-3 md:gap-6 mb-8">
          <!-- Sol 1 -->
          <div class="glass-card rounded-[20px] overflow-hidden group fade-up">
    <div class="h-48 overflow-hidden relative">
        <img src="https://hacoled.com/wp-content/uploads/2026/01/man-hinh-led-trong-nha.jpg" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="Màn hình LED">
        <div class="absolute bottom-3 left-5 flex items-center gap-2">
  <div class="w-9 h-9 bg-brand-red rounded-lg flex items-center justify-center text-white shadow-lg">
      <i class="ph-fill ph-monitor-play text-lg"></i>
  </div>
  <h3 class="font-heading text-xl font-bold text-white">Màn hình LED</h3>
        </div>
    </div>
    <div class="p-6">
        <p class="text-brand-muted text-sm leading-relaxed mb-4">Giải pháp hiển thị cỡ lớn Indoor/Outdoor. Công nghệ module tiên tiến mang lại độ sáng cao, tần số quét chuẩn và góc nhìn siêu rộng.</p>
        <ul class="space-y-1.5 text-sm font-medium text-brand-text mb-4">
  <li class="flex items-center gap-2"><i class="ph-bold ph-check text-brand-gold"></i> Tích hợp công nghệ chống chói</li>
  <li class="flex items-center gap-2"><i class="ph-bold ph-check text-brand-gold"></i> Tuổi thọ lên đến 100,000 giờ</li>
  <li class="flex items-center gap-2"><i class="ph-bold ph-check text-brand-gold"></i> Độ phân giải từ HD đến 4K</li>
        </ul>
        <a href="https://hacoled.com/man-hinh-led/" class="text-brand-red font-bold uppercase tracking-wider text-sm hover:text-brand-gold transition-colors flex items-center gap-1">Chi tiết <i class="ph-bold ph-arrow-right"></i></a>
    </div>
          </div>

          <!-- Sol 2 -->
          <div class="glass-card rounded-[20px] overflow-hidden group fade-up" style="transition-delay: 100ms;">
    <div class="h-48 overflow-hidden relative">
        <img src="https://hacoled.com/wp-content/uploads/2023/10/anh-lap-dat-man-hinh-ghep-3x2-trong-nha-tai-tong-cuc-kt-bqp-2-min.jpg" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="Màn hình Ghép">
        <div class="absolute bottom-3 left-5 flex items-center gap-2">
  <div class="w-9 h-9 bg-brand-red rounded-lg flex items-center justify-center text-white shadow-lg">
      <i class="ph-fill ph-squares-four text-lg"></i>
  </div>
  <h3 class="font-heading text-xl font-bold text-white">Màn hình Ghép</h3>
        </div>
    </div>
    <div class="p-6">
        <p class="text-brand-muted text-sm leading-relaxed mb-4">Video Wall hiển thị liền mạch với viền siêu mỏng, ứng dụng hoàn hảo cho trung tâm điều hành, phòng họp trực tuyến và hội nghị.</p>
        <ul class="space-y-1.5 text-sm font-medium text-brand-text mb-4">
  <li class="flex items-center gap-2"><i class="ph-bold ph-check text-brand-gold"></i> Viền siêu mỏng chỉ từ 0.88mm</li>
  <li class="flex items-center gap-2"><i class="ph-bold ph-check text-brand-gold"></i> Hoạt động bền bỉ 24/7</li>
  <li class="flex items-center gap-2"><i class="ph-bold ph-check text-brand-gold"></i> Tấm nền IPS màu sắc trung thực</li>
        </ul>
        <a href="https://hacoled.com/man-hinh-ghep/" class="text-brand-red font-bold uppercase tracking-wider text-sm hover:text-brand-gold transition-colors flex items-center gap-1">Chi tiết <i class="ph-bold ph-arrow-right"></i></a>
    </div>
          </div>

          <!-- Sol 3 -->
          <div class="glass-card rounded-[20px] overflow-hidden group fade-up" style="transition-delay: 200ms;">
    <div class="h-48 overflow-hidden relative">
        <img src="https://hacoled.com/wp-content/uploads/2025/03/cau-tao-va-nguyen-ly-hoat-dong-cua-loa-1.jpg" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="Âm thanh Ánh sáng">
        <div class="absolute bottom-3 left-5 flex items-center gap-2">
  <div class="w-9 h-9 bg-brand-red rounded-lg flex items-center justify-center text-white shadow-lg">
      <i class="ph-fill ph-speaker-hifi text-lg"></i>
  </div>
  <h3 class="font-heading text-xl font-bold text-white">Âm thanh & Ánh sáng</h3>
        </div>
    </div>
    <div class="p-6">
        <p class="text-brand-muted text-sm leading-relaxed mb-4">Đồng bộ hóa hoàn hảo hệ thống nghe nhìn. Setup hệ thống âm thanh, ánh sáng sân khấu chuyên nghiệp, chuẩn quốc tế.</p>
        <ul class="space-y-1.5 text-sm font-medium text-brand-text mb-4">
  <li class="flex items-center gap-2"><i class="ph-bold ph-check text-brand-gold"></i> Âm thanh vòm kỹ thuật số</li>
  <li class="flex items-center gap-2"><i class="ph-bold ph-check text-brand-gold"></i> Module DSP xử lý tín hiệu</li>
  <li class="flex items-center gap-2"><i class="ph-bold ph-check text-brand-gold"></i> Setup ánh sáng linh hoạt</li>
        </ul>
        <a href="https://hacoled.com/am-thanh/" class="text-brand-red font-bold uppercase tracking-wider text-sm hover:text-brand-gold transition-colors flex items-center gap-1">Chi tiết <i class="ph-bold ph-arrow-right"></i></a>
    </div>
          </div>
      </div>

      <!-- SECTION 3: Các giải pháp đặc thù -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 fade-up">
          <div class="glass-card p-5 rounded-2xl text-center group cursor-pointer">
    <div class="w-12 h-12 mx-auto bg-brand-lightGold rounded-full flex items-center justify-center mb-3 group-hover:bg-brand-red transition-colors">
        <i class="ph-fill ph-film-strip text-2xl text-brand-gold group-hover:text-white transition-colors"></i>
    </div>
    <h4 class="font-heading font-bold text-base text-brand-text group-hover:text-brand-red transition-colors">LED Dán kính</h4>
          </div>
          <div class="glass-card p-5 rounded-2xl text-center group cursor-pointer">
    <div class="w-12 h-12 mx-auto bg-brand-lightGold rounded-full flex items-center justify-center mb-3 group-hover:bg-brand-red transition-colors">
        <i class="ph-fill ph-grid-nine text-2xl text-brand-gold group-hover:text-white transition-colors"></i>
    </div>
    <h4 class="font-heading font-bold text-base text-brand-text group-hover:text-brand-red transition-colors">LED Lưới</h4>
          </div>
          <div class="glass-card p-5 rounded-2xl text-center group cursor-pointer">
    <div class="w-12 h-12 mx-auto bg-brand-lightGold rounded-full flex items-center justify-center mb-3 group-hover:bg-brand-red transition-colors">
        <i class="ph-fill ph-hand-tap text-2xl text-brand-gold group-hover:text-white transition-colors"></i>
    </div>
    <h4 class="font-heading font-bold text-base text-brand-text group-hover:text-brand-red transition-colors">Màn Tương Tác</h4>
          </div>
          <div class="glass-card p-5 rounded-2xl text-center group cursor-pointer">
    <div class="w-12 h-12 mx-auto bg-brand-lightGold rounded-full flex items-center justify-center mb-3 group-hover:bg-brand-red transition-colors">
        <i class="ph-fill ph-sliders text-2xl text-brand-gold group-hover:text-white transition-colors"></i>
    </div>
    <h4 class="font-heading font-bold text-base text-brand-text group-hover:text-brand-red transition-colors">Hệ thống AV Pro</h4>
          </div>
      </div>
  </div>
        </section>

        <!-- ========================================== -->
        <!-- SECTION 4, 5, 6: DANH MỤC SẢN PHẨM         -->
        <!-- ========================================== -->
        <section id="products" class="py-24 relative overflow-hidden bg-[#FAFAFA]" data-tech-bg="circuit">
  <div class="glow-gold -bottom-20 -left-20"></div>
  
  <div class="container mx-auto px-4 md:px-8 relative z-10">
      <div class="text-center max-w-2xl mx-auto mb-16 fade-up">
          <p class="text-brand-red text-sm font-bold uppercase tracking-widest mb-3">SẢN PHẨM CUNG CẤP</p>
          <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold uppercase tracking-tight text-brand-text mb-6">Thiết Bị Công Nghệ Cao</h2>
      </div>

      <!-- SECTION 4: Hệ thống LED -->
      <div class="mb-20">
          <div class="flex justify-between items-end mb-8 fade-up border-b border-gray-200 pb-4">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 bg-brand-red rounded-lg flex items-center justify-center text-white"><i class="ph-fill ph-monitor-play text-2xl"></i></div>
        <h3 class="font-heading text-2xl md:text-3xl font-extrabold text-brand-text">Hệ thống màn hình LED</h3>
    </div>
    <a href="#" class="hidden md:flex text-sm font-bold text-brand-red hover:text-brand-gold transition-colors items-center gap-1 uppercase tracking-wider">Xem danh mục <i class="ph-bold ph-caret-right"></i></a>
          </div>
          <div class="product-slider-wrapper relative">
    <div class="swiper product-swiper !px-4 !py-4 -mx-4">
        <div class="swiper-wrapper">
  <?php haco_render_product_slides(array('man-hinh-led', 'he-thong-man-hinh-led', 'led')); ?>
        </div>
    </div>
    <div class="custom-swiper-prev absolute top-1/2 -translate-y-1/2 -left-3 md:-left-6 w-12 h-12 bg-white rounded-full shadow-[0_5px_15px_rgba(0,0,0,0.08)] z-20 flex items-center justify-center cursor-pointer border border-gray-100 text-gray-400 hover:text-white hover:bg-brand-red hover:border-brand-red transition-all duration-300">
        <i class="ph-bold ph-caret-left text-xl relative left-[-1px]"></i>
    </div>
    <div class="custom-swiper-next absolute top-1/2 -translate-y-1/2 -right-3 md:-right-6 w-12 h-12 bg-white rounded-full shadow-[0_5px_15px_rgba(0,0,0,0.08)] z-20 flex items-center justify-center cursor-pointer border border-gray-100 text-gray-400 hover:text-white hover:bg-brand-red hover:border-brand-red transition-all duration-300">
        <i class="ph-bold ph-caret-right text-xl relative right-[-1px]"></i>
    </div>
          </div>
      </div>

      <!-- SECTION 5: Âm thanh Ánh sáng -->
      <div class="mb-20">
          <div class="flex justify-between items-end mb-8 fade-up border-b border-gray-200 pb-4">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 bg-brand-red rounded-lg flex items-center justify-center text-white"><i class="ph-fill ph-speaker-hifi text-2xl"></i></div>
        <h3 class="font-heading text-2xl md:text-3xl font-extrabold text-brand-text">Âm thanh & Ánh sáng</h3>
    </div>
    <a href="#" class="hidden md:flex text-sm font-bold text-brand-red hover:text-brand-gold transition-colors items-center gap-1 uppercase tracking-wider">Xem danh mục <i class="ph-bold ph-caret-right"></i></a>
          </div>
          <div class="product-slider-wrapper relative">
    <div class="swiper product-swiper !px-4 !py-4 -mx-4">
        <div class="swiper-wrapper">
  <?php haco_render_product_slides(array('am-thanh', 'thiet-bi-am-thanh', 'am-thanh-anh-sang')); ?>
        </div>
    </div>
    <div class="custom-swiper-prev absolute top-1/2 -translate-y-1/2 -left-3 md:-left-6 w-12 h-12 bg-white rounded-full shadow-[0_5px_15px_rgba(0,0,0,0.08)] z-20 flex items-center justify-center cursor-pointer border border-gray-100 text-gray-400 hover:text-white hover:bg-brand-red hover:border-brand-red transition-all duration-300">
        <i class="ph-bold ph-caret-left text-xl relative left-[-1px]"></i>
    </div>
    <div class="custom-swiper-next absolute top-1/2 -translate-y-1/2 -right-3 md:-right-6 w-12 h-12 bg-white rounded-full shadow-[0_5px_15px_rgba(0,0,0,0.08)] z-20 flex items-center justify-center cursor-pointer border border-gray-100 text-gray-400 hover:text-white hover:bg-brand-red hover:border-brand-red transition-all duration-300">
        <i class="ph-bold ph-caret-right text-xl relative right-[-1px]"></i>
    </div>
          </div>
      </div>

      <!-- SECTION 6: Màn hình ghép -->
      <div>
          <div class="flex justify-between items-end mb-8 fade-up border-b border-gray-200 pb-4">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 bg-brand-red rounded-lg flex items-center justify-center text-white"><i class="ph-fill ph-squares-four text-2xl"></i></div>
        <h3 class="font-heading text-2xl md:text-3xl font-extrabold text-brand-text">Màn hình Ghép</h3>
    </div>
    <a href="#" class="hidden md:flex text-sm font-bold text-brand-red hover:text-brand-gold transition-colors items-center gap-1 uppercase tracking-wider">Xem danh mục <i class="ph-bold ph-caret-right"></i></a>
          </div>
          <div class="product-slider-wrapper relative">
    <div class="swiper product-swiper !px-4 !py-4 -mx-4">
        <div class="swiper-wrapper">
  <?php haco_render_product_slides(array('man-hinh-ghep', 'he-thong-man-hinh-ghep', 'videowall')); ?>
        </div>
    </div>
    <div class="custom-swiper-prev absolute top-1/2 -translate-y-1/2 -left-3 md:-left-6 w-12 h-12 bg-white rounded-full shadow-[0_5px_15px_rgba(0,0,0,0.08)] z-20 flex items-center justify-center cursor-pointer border border-gray-100 text-gray-400 hover:text-white hover:bg-brand-red hover:border-brand-red transition-all duration-300">
        <i class="ph-bold ph-caret-left text-xl relative left-[-1px]"></i>
    </div>
    <div class="custom-swiper-next absolute top-1/2 -translate-y-1/2 -right-3 md:-right-6 w-12 h-12 bg-white rounded-full shadow-[0_5px_15px_rgba(0,0,0,0.08)] z-20 flex items-center justify-center cursor-pointer border border-gray-100 text-gray-400 hover:text-white hover:bg-brand-red hover:border-brand-red transition-all duration-300">
        <i class="ph-bold ph-caret-right text-xl relative right-[-1px]"></i>
    </div>
          </div>
      </div>
  </div>
        </section>

        <!-- ========================================== -->
        <!-- SECTION 7 & 8: UY TÍN & CAM KẾT -->
        <!-- ========================================== -->
        <section class="bg-[#5a0c0c]" style="padding: 0;">
  <!-- Decor lines -->
  <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-red via-brand-gold to-brand-red z-10"></div>
  <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-brand-red via-brand-gold to-brand-red z-10"></div>
  <!-- Trống đồng mờ -->
  <div class="bg-dongson dark w-[900px] h-[900px] top-1/2 -translate-y-1/2 left-0 opacity-8"></div>

  <!-- Layout: 2 cột không có container bao ngoài -->
  <div class="flex flex-col lg:flex-row min-h-[700px]">

      <!-- LEFT: Text content — chiếm 38% -->
      <div class="lg:w-[38%] flex-shrink-0 flex flex-col justify-center px-8 md:px-12 lg:px-16 py-20 relative z-10">
          <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-6 self-start">
    <i class="ph-fill ph-shield-check text-brand-gold text-lg"></i>
    <span class="text-white text-xs font-bold uppercase tracking-widest">Năng Lực & Uy Tín</span>
          </div>

          <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold uppercase tracking-tight mb-5 leading-tight text-white fade-up">
    UY TÍN tạo nên<br>
    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-gold to-yellow-200">THƯƠNG HIỆU</span>
          </h2>
          <p class="text-gray-300 mb-8 leading-relaxed text-base font-light fade-up">
    Đối tác chiến lược của <strong class="text-white font-semibold">Viettel, FPT, EVN, Vingroup, Masterise, BRG</strong> và hàng trăm tập đoàn hàng đầu Việt Nam.
          </p>

          <!-- 3F compact -->
          <div class="space-y-3 fade-up">
    <div class="flex items-center gap-3 glass-card-dark px-4 py-3 rounded-xl group hover:bg-white/5 transition-all">
        <div class="w-9 h-9 shrink-0 rounded-lg bg-white/10 flex items-center justify-center text-brand-gold border border-white/20 group-hover:border-brand-gold transition-all">
  <i class="ph-fill ph-users text-lg"></i>
        </div>
        <div>
  <span class="font-heading text-sm font-bold text-white">Friendly</span>
  <span class="text-gray-400 text-xs ml-2">HacoLED có đội ngũ nhân viên nhiệt tình, tâm huyết với công việc, sẵn sàng lắng nghe và hỗ trợ khách hàng trong mọi thời điểm.</span>
        </div>
    </div>
    <div class="flex items-center gap-3 glass-card-dark px-4 py-3 rounded-xl group hover:bg-white/5 transition-all">
        <div class="w-9 h-9 shrink-0 rounded-lg bg-white/10 flex items-center justify-center text-brand-gold border border-white/20 group-hover:border-brand-gold transition-all">
  <i class="ph-fill ph-lightning text-lg"></i>
        </div>
        <div>
  <span class="font-heading text-sm font-bold text-white">Fast</span>
  <span class="text-gray-400 text-xs ml-2">HacoLED cam kết đáp ứng nhu cầu và yêu cầu của khách hàng trong thời gian ngắn nhất, đảm bảo thời gian phản hồi và xử lý yêu cầu nhanh chóng và hiệu quả.</span>
        </div>
    </div>
    <div class="flex items-center gap-3 glass-card-dark px-4 py-3 rounded-xl group hover:bg-white/5 transition-all">
        <div class="w-9 h-9 shrink-0 rounded-lg bg-white/10 flex items-center justify-center text-brand-gold border border-white/20 group-hover:border-brand-gold transition-all">
  <i class="ph-fill ph-shield-check text-lg"></i>
        </div>
        <div>
  <span class="font-heading text-sm font-bold text-white">Full</span>
  <span class="text-gray-400 text-xs ml-2">HacoLED cam kết đem đến cho khách hàng những dịch vụ và sản phẩm đầy đủ và chính xác, đảm bảo mọi thủ tục trong hợp đồng được thực hiện đầy đủ.</span>
        </div>
    </div>
          </div>

          <!-- Stats inline -->
          <div class="flex items-center gap-6 mt-8 pt-6 border-t border-white/10 fade-up">
    <div>
        <div class="font-heading text-3xl font-black text-white"><span class="counter" data-target="1000">0</span>+</div>
        <div class="text-[10px] text-brand-gold uppercase font-bold tracking-wider">Dự án</div>
    </div>
    <div class="w-px h-10 bg-white/20"></div>
    <div>
        <div class="font-heading text-3xl font-black text-white"><span class="counter" data-target="20">0</span>K+</div>
        <div class="text-[10px] text-white/60 uppercase font-bold tracking-wider">m² Màn hình</div>
    </div>
    <div class="w-px h-10 bg-white/20"></div>
    <div>
        <div class="font-heading text-3xl font-black text-white">10+</div>
        <div class="text-[10px] text-white/60 uppercase font-bold tracking-wider">Năm KN</div>
    </div>
          </div>
      </div>

      <!-- RIGHT: Gallery 6 ảnh tràn viền phải — chiếm 62% -->
      <div class="lg:w-[62%] relative flex-shrink-0 min-h-[520px] lg:min-h-[700px] fade-up" style="transition-delay: 150ms;">

          <!-- Lưới 8 ảnh Bento đều nhau -->
          <div class="absolute inset-0 grid grid-cols-2 md:grid-cols-4 grid-rows-4 md:grid-rows-2 gap-2 md:gap-3 p-2 lg:p-3">

    <div class="rounded-xl overflow-hidden group cursor-pointer ring-1 ring-white/10 relative">
        <img src="https://hacoled.com/wp-content/uploads/2025/04/man-hinh-led-p30-trong-nha-hacoled-1-6.jpg"
   alt="Uy tín thương hiệu 1" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
    </div>

    <div class="rounded-xl overflow-hidden group cursor-pointer ring-1 ring-brand-gold/20 relative">
        <img src="https://hacoled.com/wp-content/uploads/2024/08/man-hinh-led-p2-trong-nha-hacoled-1-5.jpg"
   alt="Uy tín thương hiệu 2" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
    </div>

    <div class="rounded-xl overflow-hidden group cursor-pointer ring-1 ring-brand-gold/20 relative">
        <img src="https://hacoled.com/wp-content/uploads/2025/08/p3-trong-nha-tai-truong-tieu-hoc-phu-nhuan-hcm-1.jpg"
   alt="Uy tín thương hiệu 3" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
    </div>

    <div class="rounded-xl overflow-hidden group cursor-pointer ring-1 ring-white/10 relative">
        <img src="https://hacoled.com/wp-content/uploads/2025/08/hacoled-don-tiep-qiangliled.jpg"
   alt="Uy tín thương hiệu 4" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
    </div>

    <div class="rounded-xl overflow-hidden group cursor-pointer ring-1 ring-white/10 relative">
        <img src="https://hacoled.com/wp-content/uploads/2025/05/team-hacoled.jpg"
   alt="Uy tín thương hiệu 5" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
    </div>

    <div class="rounded-xl overflow-hidden group cursor-pointer ring-1 ring-brand-gold/20 relative">
        <img src="https://hacoled.com/wp-content/uploads/2025/04/man-hinh-led-p30-trong-nha-hacoled-15.jpg"
   alt="Uy tín thương hiệu 6" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
    </div>

    <div class="rounded-xl overflow-hidden group cursor-pointer ring-1 ring-brand-gold/20 relative">
        <img src="https://hacoled.com/wp-content/uploads/2025/04/man-hinh-led-p30-trong-nha-hacoled-11.jpg"
   alt="Uy tín thương hiệu 7" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
    </div>

    <div class="rounded-xl overflow-hidden group cursor-pointer ring-1 ring-white/10 relative">
        <img src="https://hacoled.com/wp-content/uploads/2025/04/man-hinh-led-san-khauhacoled-1-2.jpg"
   alt="Uy tín thương hiệu 8" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
    </div>

          </div>

          <!-- Fade trái để hoà vào phần text -->
          <div class="absolute inset-y-0 left-0 w-12 bg-gradient-to-r from-[#5a0c0c] to-transparent z-10 pointer-events-none"></div>
      </div>
  </div>
        </section>


        <!-- ========================================== -->
        <!-- SECTION 9: CÔNG TRÌNH TIÊU BIỂU -->
        <!-- ========================================== -->
        <section id="projects" class="py-16 relative overflow-hidden bg-[#FAFAFA]" data-tech-bg="circuit">
  <!-- Decor -->
  <div class="glow-red -top-20 right-10 opacity-20"></div>
  <div class="glow-gold -bottom-20 left-10 opacity-15"></div>

  <div class="container mx-auto px-4 md:px-8 relative z-10">

      <!-- Header -->
      <div class="text-center max-w-3xl mx-auto mb-8 fade-up">
          <div class="inline-flex items-center gap-2 mb-3">
    <div class="w-8 h-0.5 bg-brand-red"></div>
    <p class="text-brand-red text-sm font-bold uppercase tracking-widest">Portfolio</p>
    <div class="w-8 h-0.5 bg-brand-red"></div>
          </div>
          <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold uppercase tracking-tight text-brand-text mb-4">Công Trình Tiêu Biểu</h2>
          <p class="text-brand-muted text-sm mb-5">Hơn <strong class="text-brand-red">1.000 công trình LED</strong> đã được HacoLED triển khai thành công trên toàn quốc — từ trung tâm thương mại, hội trường tập đoàn, sân khấu âm nhạc quy mô quốc gia đến các công trình ngoài trời chiến lược. Mỗi dự án là minh chứng cho năng lực kỹ thuật, tiêu chuẩn thi công chuyên nghiệp và cam kết đồng hành lâu dài cùng khách hàng.</p>
          <a href="#" class="inline-flex items-center gap-2 border-2 border-brand-red text-brand-red hover:bg-brand-red hover:text-white px-6 py-2.5 font-bold uppercase tracking-wider rounded-full transition-all text-sm">
    Xem tất cả <i class="ph-bold ph-arrow-right"></i>
          </a>
      </div>

      <!-- Projects Grid: 4 cột × 3 hàng = 12 dự án -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4" id="projects-container"></div>

  </div>
        </section>


        <!-- ========================================== -->
        <!-- SECTION 10: BÁO CHÍ NÓI GÌ VỀ CHÚNG TÔI  -->
        <!-- ========================================== -->
        <section id="press" class="py-16 relative overflow-hidden bg-[#3D0808]">
  <!-- Decor -->
  <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-red via-brand-gold to-brand-red"></div>
  <div class="glow-red top-1/2 -translate-y-1/2 -left-20 opacity-40"></div>
  <div class="glow-gold top-1/2 -translate-y-1/2 -right-20 opacity-30"></div>
  <!-- Trống đồng pattern -->
  <div class="bg-dongson dark w-[700px] h-[700px] top-1/2 -translate-y-1/2 -left-32 opacity-10"></div>
  <div class="bg-dongson dark w-[700px] h-[700px] top-1/2 -translate-y-1/2 -right-32 opacity-10"></div>
  
  <div class="container mx-auto px-4 md:px-8 relative z-10">
      <!-- Header -->
      <div class="text-center max-w-3xl mx-auto mb-8 fade-up">
          <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur border border-white/20 mb-4">
    <i class="ph-fill ph-newspaper text-brand-gold text-lg"></i>
    <span class="text-white text-sm font-bold uppercase tracking-widest">Truyền Thông Nói Về Chúng Tôi</span>
          </div>
          <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold uppercase tracking-tight text-white mb-4">
    Báo Chí Nói Gì Về <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-gold to-yellow-200">HacoLED?</span>
          </h2>
          <p class="text-gray-400 text-base">Uy tín được kiểm chứng qua hàng loạt bài viết từ các tạp chí, báo điện tử và kênh truyền thông hàng đầu Việt Nam.</p>
      </div>

      <!-- Press Cards Grid: 3 cột × 2 hàng = 6 bài -->
      <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5" id="press-container">
          <!-- JS Injected -->
      </div>

      <!-- Logo strip: tất cả tờ báo đưới grid -->
      <div class="mt-6 pt-5 border-t border-white/10 fade-up">
          <p class="text-center text-white/40 text-xs font-bold uppercase tracking-widest mb-4">Đã được đăng tải bởi</p>
          <div class="flex flex-wrap items-center justify-center gap-3" id="press-logo-strip">
    <!-- JS Injected -->
          </div>
      </div>
  </div>
        </section>

        <!-- ========================================== -->
        <!-- SECTION 11: TIN TỨC CHUYÊN NGÀNH          -->
        <!-- ========================================== -->
        <section id="news" class="py-16 relative overflow-hidden bg-[#FAFAFA]">
  <div class="container mx-auto px-4 md:px-8">
      <div class="text-center max-w-2xl mx-auto mb-8 fade-up border-b border-gray-200 pb-6">
          <p class="text-brand-red text-sm font-bold uppercase tracking-widest mb-1">Cập Nhật Bài Viết</p>
          <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold uppercase tracking-tight text-brand-text mb-4">Tin Tức</h2>
          <p class="text-brand-muted text-sm mb-4">Cập nhật kiến thức chuyên sâu về công nghệ màn hình LED, xu hướng thiết kế trình diễn và kinh nghiệm thi công thực tế từ đội ngũ chuyên gia HacoLED. Những bài viết được biên soạn kỹ lưỡng, giúp quý khách hàng hiểu rõ giải pháp phù hợp và đưa ra quyết định đầu tư LED thông minh, hiệu quả và bền vững.</p>
          <a href="/category/tin-tuc/" class="inline-flex items-center gap-2 border-2 border-brand-red text-brand-red hover:bg-brand-red hover:text-white px-6 py-2.5 font-bold uppercase tracking-wider rounded-full transition-colors text-sm">
    Xem tất cả <i class="ph-bold ph-arrow-right"></i>
          </a>
      </div>
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4" id="news-container">
          <?php
          $args_news = array(
    'post_type'      => 'post',
    'posts_per_page' => 8,
    'category_name'  => 'blog',
    'post_status'    => 'publish'
          );
          $query_news = new WP_Query($args_news);
          if ($query_news->have_posts()) :
    $idx = 0;
    while ($query_news->have_posts()) : $query_news->the_post();
        $idx++;
        $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium_large') ?: 'https://via.placeholder.com/600x400';
        $date = get_the_date('d/m/Y');
        ?>
        <a href="<?php the_permalink(); ?>" class="group rounded-xl overflow-hidden relative block fade-up shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-500" style="transition-delay: <?php echo ($idx % 4) * 100; ?>ms">
  <div class="aspect-[16/9] relative overflow-hidden bg-gray-200">
      <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">

      <!-- Date badge — góc trên trái -->
      <div class="absolute top-2.5 left-2.5 z-10">
          <span class="inline-flex items-center gap-1 bg-white/20 backdrop-blur-sm text-white text-[10px] font-bold px-2 py-1 rounded border border-white/20">
    <i class="ph-fill ph-calendar text-brand-gold"></i> <?php echo esc_html($date); ?>
          </span>
      </div>

      <!-- Glassmorphism title bar -->
      <div class="absolute bottom-0 left-0 right-0 z-10
        backdrop-blur-md bg-black/30 border-t border-white/15
        px-3 py-2.5">
          <div class="w-5 h-0.5 bg-brand-red mb-1.5 group-hover:w-full transition-all duration-500 ease-out"></div>
          <h4 class="font-heading font-bold text-sm text-white leading-snug line-clamp-2"><?php the_title(); ?></h4>
      </div>

      <!-- Hover CTA slides up -->
      <div class="absolute inset-x-0 bottom-0 z-20
        translate-y-full group-hover:translate-y-0
        transition-transform duration-300 ease-out
        flex items-end justify-end px-3 pb-3">
          <span class="inline-flex items-center gap-1 border border-brand-red text-brand-red text-[10px] font-extrabold uppercase tracking-wider px-3 py-1.5 rounded-full bg-white/90 backdrop-blur-sm shadow">
    Đọc tiếp <i class="ph-bold ph-arrow-right"></i>
          </span>
      </div>
  </div>
        </a>
        <?php
    endwhile;
          else :
    echo '<p class="col-span-full text-center text-gray-400">Chưa có bài viết nào trong chuyên mục Tin tức.</p>';
          endif;
          wp_reset_postdata();
          ?>
      </div>
  </div>
        </section>

        <!-- ========================================== -->
        <!-- SECTION 12: SỰ KIỆN NỔI BẬT      -->
        <!-- ========================================== -->
        <section id="events" class="py-16 relative overflow-hidden bg-[#1C0505] text-white">
  <!-- Pattern trống đồng cho block Sự kiện -->
  <div class="bg-dongson dark w-[700px] h-[700px] top-1/2 -translate-y-1/2 -right-32 pointer-events-none"></div>

  <div class="container mx-auto px-4 md:px-8 relative z-10">
      <div class="text-center max-w-2xl mx-auto mb-8 fade-up border-b border-white/10 pb-6">
          <p class="text-brand-gold text-sm font-bold uppercase tracking-widest mb-1">Hoạt Động Thực Tế</p>
          <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold uppercase tracking-tight text-white mb-4">Sự Kiện</h2>
          <p class="text-gray-400 text-sm mb-4">Những dấu ấn nổi bật ghi lại hành trình HacoLED đồng hành cùng các sự kiện âm nhạc, hội nghị doanh nghiệp, lễ hội văn hóa và triển lãm quốc tế trên khắp cả nước. Mỗi sự kiện là một biểu hiện thực tế về sức mạnh công nghệ LED trong việc tạo nên những trải nghiệm thị giác đảnh cào, khắc sâu thương hiệu trong lòng khán giả.</p>
          <a href="/category/su-kien/" class="inline-flex items-center gap-2 border-2 border-brand-gold text-brand-gold hover:bg-brand-gold hover:text-[#1C0505] px-6 py-2.5 font-bold uppercase tracking-wider rounded-full transition-colors text-sm">
    Xem tất cả <i class="ph-bold ph-arrow-right"></i>
          </a>
      </div>
      <!-- Sự kiện giới hạn 4 bài -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4" id="events-container">
          <?php
          $args_evt = array(
    'post_type'      => 'post',
    'posts_per_page' => 4,
    'category_name'  => 'su-kien-hacoled',
    'post_status'    => 'publish'
          );
          $query_evt = new WP_Query($args_evt);
          if ($query_evt->have_posts()) :
    $idx = 0;
    while ($query_evt->have_posts()) : $query_evt->the_post();
        $idx++;
        $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium_large') ?: 'https://via.placeholder.com/600x400';
        $date = get_the_date('d/m/Y');
        ?>
        <a href="<?php the_permalink(); ?>" class="group rounded-xl overflow-hidden relative block fade-up hover:-translate-y-1 transition-all duration-500 shadow-lg hover:shadow-[0_20px_40px_rgba(0,0,0,0.6)]" style="transition-delay: <?php echo $idx * 100; ?>ms">
  <div class="aspect-[16/9] relative overflow-hidden bg-[#1C0505]">
      <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">

      <!-- Gold top line -->
      <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-brand-gold to-transparent"></div>

      <!-- Badge SỰ KIỆN -->
      <div class="absolute top-2.5 left-2.5 z-10">
          <span class="inline-flex items-center gap-1 bg-brand-gold text-[#1C0505] text-[9px] font-extrabold uppercase tracking-widest px-2 py-1 rounded shadow-lg">
    <i class="ph-fill ph-star"></i> SỰ KIỆN
          </span>
      </div>

      <!-- Glassmorphism title bar -->
      <div class="absolute bottom-0 left-0 right-0 z-10
        backdrop-blur-md bg-black/35 border-t border-white/10
        px-3 py-2.5">
          <div class="text-brand-gold/80 text-[10px] font-bold mb-1"><?php echo esc_html($date); ?></div>
          <h4 class="font-heading font-bold text-sm text-white leading-snug line-clamp-2 group-hover:text-brand-gold transition-colors duration-300"><?php the_title(); ?></h4>
          <div class="mt-1.5 h-px bg-gradient-to-r from-brand-gold/60 to-transparent w-6 group-hover:w-full transition-all duration-700 ease-out"></div>
      </div>

      <!-- Hover CTA slides up -->
      <div class="absolute inset-x-0 bottom-0 z-20
        translate-y-full group-hover:translate-y-0
        transition-transform duration-300 ease-out
        flex items-end justify-end px-3 pb-3">
          <span class="inline-flex items-center gap-1.5 border border-brand-gold text-brand-gold text-[10px] font-extrabold uppercase tracking-wider px-3 py-1.5 rounded-full bg-black/50 backdrop-blur-sm shadow-lg">
    Xem chi tiết <i class="ph-bold ph-arrow-up-right"></i>
          </span>
      </div>
  </div>
        </a>
        <?php
    endwhile;
          else :
    echo '<p class="col-span-full text-center text-gray-400">Chưa có sự kiện nào được đăng tải.</p>';
          endif;
          wp_reset_postdata();
          ?>
      </div>
  </div>
        </section>

        <!-- ========================================== -->
        <!-- SECTION 13: FAQ        -->
        <!-- ========================================== -->
        <section class="py-24 relative overflow-hidden bg-[#FAFAFA]" data-tech-bg="particle">
  <div class="top-0 left-0"></div>

  <!-- Bỏ max-w-6xl để mở rộng cân bằng với container của toàn trang -->
  <div class="container mx-auto px-6 md:px-12 w-full relative z-10">
      <div class="text-center mb-16 fade-up">
          <p class="text-brand-red text-sm font-bold uppercase tracking-widest mb-3">Hỗ Trợ Khách Hàng</p>
          <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold uppercase tracking-tight text-brand-text mb-6">Câu Hỏi Thường Gặp</h2>
          <p class="text-brand-muted max-w-2xl mx-auto">Giải đáp chi tiết mọi thắc mắc của quý khách hàng về năng lực doanh nghiệp, sản phẩm, quy trình và dịch vụ hậu mãi của HacoLED.</p>
      </div>
      
      <!-- Lưới 2 cột mở rộng, dùng JS accordion để bật/đóng -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-8 fade-up" id="faq-accordion">
          <!-- Column 1 -->
          <div class="space-y-3">
    <details name="faq" class="group bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 [&_summary::-webkit-details-marker]:hidden open:border-brand-red/30 transition-all duration-300">
        <summary class="flex cursor-pointer items-center justify-between gap-4 px-5 py-4 font-bold text-sm text-brand-text hover:text-brand-red transition-colors outline-none">
  <span class="pr-4">1. Quy trình khảo sát và thi công màn hình LED diễn ra như thế nào?</span>
  <span class="shrink-0 flex items-center justify-center w-8 h-8 rounded-full bg-gray-50 text-gray-400 group-hover:bg-brand-red/10 group-hover:text-brand-red group-open:bg-brand-red group-open:text-white group-open:rotate-180 transition-all duration-300">
      <i class="ph-bold ph-caret-down text-base"></i>
  </span>
        </summary>
        <div class="px-5 pb-4 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4 mt-1 animate-fade-in-up">
  HacoLED áp dụng quy trình 5 bước chuẩn quốc tế: (1) Tiếp nhận & Tư vấn giải pháp, (2) Khảo sát thực tế mặt bằng, (3) Thiết kế bản vẽ & Báo giá chi tiết, (4) Thi công lắp đặt an toàn, (5) Bàn giao, hướng dẫn vận hành và kích hoạt bảo hành.
        </div>
    </details>
    
    <details name="faq" class="group bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 [&_summary::-webkit-details-marker]:hidden open:border-brand-red/30 transition-all duration-300">
        <summary class="flex cursor-pointer items-center justify-between gap-4 px-5 py-4 font-bold text-sm text-brand-text hover:text-brand-red transition-colors outline-none">
  <span class="pr-4">2. Nguồn gốc xuất xứ linh kiện màn hình LED của HacoLED từ đâu?</span>
  <span class="shrink-0 flex items-center justify-center w-8 h-8 rounded-full bg-gray-50 text-gray-400 group-hover:bg-brand-red/10 group-hover:text-brand-red group-open:bg-brand-red group-open:text-white group-open:rotate-180 transition-all duration-300">
      <i class="ph-bold ph-caret-down text-base"></i>
  </span>
        </summary>
        <div class="px-5 pb-4 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4 mt-1 animate-fade-in-up">
  100% linh kiện (Module, Card điều khiển, Nguồn) được chúng tôi nhập khẩu chính ngạch trực tiếp từ các thương hiệu TOP đầu thế giới như Novastar, Colorlight, Qiangli. Cung cấp đầy đủ giấy tờ chứng nhận xuất xứ (CO) và chất lượng (CQ) cho mọi dự án.
        </div>
    </details>

    <details name="faq" class="group bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 [&_summary::-webkit-details-marker]:hidden open:border-brand-red/30 transition-all duration-300">
        <summary class="flex cursor-pointer items-center justify-between gap-4 px-5 py-4 font-bold text-sm text-brand-text hover:text-brand-red transition-colors outline-none">
  <span class="pr-4">3. Chính sách bảo hành và bảo trì hệ thống của doanh nghiệp ra sao?</span>
  <span class="shrink-0 flex items-center justify-center w-8 h-8 rounded-full bg-gray-50 text-gray-400 group-hover:bg-brand-red/10 group-hover:text-brand-red group-open:bg-brand-red group-open:text-white group-open:rotate-180 transition-all duration-300">
      <i class="ph-bold ph-caret-down text-base"></i>
  </span>
        </summary>
        <div class="px-5 pb-4 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4 mt-1 animate-fade-in-up">
  Chúng tôi tự hào mang đến gói bảo hành Vàng từ 24 - 36 tháng tận nơi. Khi có sự cố, đội ngũ kỹ thuật tiếp nhận và hỗ trợ xử lý online 24/7, đồng thời có mặt tại hiện trường trong vòng 12-24h để đảm bảo hệ thống vận hành xuyên suốt.
        </div>
    </details>

    <details name="faq" class="group bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 [&_summary::-webkit-details-marker]:hidden open:border-brand-red/30 transition-all duration-300">
        <summary class="flex cursor-pointer items-center justify-between gap-4 px-5 py-4 font-bold text-sm text-brand-text hover:text-brand-red transition-colors outline-none">
  <span class="pr-4">4. Tuổi thọ trung bình của hệ thống màn hình LED là bao lâu?</span>
  <span class="shrink-0 flex items-center justify-center w-8 h-8 rounded-full bg-gray-50 text-gray-400 group-hover:bg-brand-red/10 group-hover:text-brand-red group-open:bg-brand-red group-open:text-white group-open:rotate-180 transition-all duration-300">
      <i class="ph-bold ph-caret-down text-base"></i>
  </span>
        </summary>
        <div class="px-5 pb-4 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4 mt-1 animate-fade-in-up">
  Với linh kiện cao cấp và quy trình thi công tản nhiệt chuẩn xác từ HacoLED, hệ thống màn hình có tuổi thọ lên tới 100.000 giờ chiếu sáng liên tục (tương đương hơn 10 năm sử dụng), suy hao ánh sáng cực thấp theo thời gian.
        </div>
    </details>

    <details name="faq" class="group bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 [&_summary::-webkit-details-marker]:hidden open:border-brand-red/30 transition-all duration-300">
        <summary class="flex cursor-pointer items-center justify-between gap-4 px-5 py-4 font-bold text-sm text-brand-text hover:text-brand-red transition-colors outline-none">
  <span class="pr-4">5. Màn hình ngoài trời (Outdoor) có chịu được thời tiết khắc nghiệt không?</span>
  <span class="shrink-0 flex items-center justify-center w-8 h-8 rounded-full bg-gray-50 text-gray-400 group-hover:bg-brand-red/10 group-hover:text-brand-red group-open:bg-brand-red group-open:text-white group-open:rotate-180 transition-all duration-300">
      <i class="ph-bold ph-caret-down text-base"></i>
  </span>
        </summary>
        <div class="px-5 pb-4 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4 mt-1 animate-fade-in-up">
  Hoàn toàn có thể. Màn hình ngoài trời được trang bị công nghệ chống nước, chống bụi chuẩn IP65/IP68, tích hợp cabinet hợp kim nhôm chống gỉ, tản nhiệt tốt, chịu được nắng nóng, mưa bão và môi trường muối mặn vùng biển.
        </div>
    </details>
          </div>

          <!-- Column 2 -->
          <div class="space-y-3">
    <details name="faq" class="group bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 [&_summary::-webkit-details-marker]:hidden open:border-brand-red/30 transition-all duration-300">
        <summary class="flex cursor-pointer items-center justify-between gap-4 px-5 py-4 font-bold text-sm text-brand-text hover:text-brand-red transition-colors outline-none">
  <span class="pr-4">6. HacoLED có hỗ trợ thiết kế 3D trước khi thi công không?</span>
  <span class="shrink-0 flex items-center justify-center w-8 h-8 rounded-full bg-gray-50 text-gray-400 group-hover:bg-brand-red/10 group-hover:text-brand-red group-open:bg-brand-red group-open:text-white group-open:rotate-180 transition-all duration-300">
      <i class="ph-bold ph-caret-down text-base"></i>
  </span>
        </summary>
        <div class="px-5 pb-4 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4 mt-1 animate-fade-in-up">
  Chắc chắn rồi. Đội ngũ kỹ sư thiết kế của chúng tôi sẽ cung cấp bản vẽ kỹ thuật và phối cảnh 3D trực quan sát với thực tế 99%, giúp quý khách dễ dàng hình dung quy mô và thẩm mỹ dự án trước khi chốt phương án.
        </div>
    </details>

    <details name="faq" class="group bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 [&_summary::-webkit-details-marker]:hidden open:border-brand-red/30 transition-all duration-300">
        <summary class="flex cursor-pointer items-center justify-between gap-4 px-5 py-4 font-bold text-sm text-brand-text hover:text-brand-red transition-colors outline-none">
  <span class="pr-4">7. Thời gian thi công một dự án màn hình LED mất khoảng bao lâu?</span>
  <span class="shrink-0 flex items-center justify-center w-8 h-8 rounded-full bg-gray-50 text-gray-400 group-hover:bg-brand-red/10 group-hover:text-brand-red group-open:bg-brand-red group-open:text-white group-open:rotate-180 transition-all duration-300">
      <i class="ph-bold ph-caret-down text-base"></i>
  </span>
        </summary>
        <div class="px-5 pb-4 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4 mt-1 animate-fade-in-up">
  Nhờ năng lực đội ngũ chuyên nghiệp và hàng hóa luôn sẵn kho, HacoLED tự tin triển khai các dự án vừa và nhỏ trong 2-5 ngày. Với các dự án quy mô tập đoàn hoặc yêu cầu kết cấu phức tạp, chúng tôi sẽ có tiến độ cam kết cụ thể.
        </div>
    </details>

    <details name="faq" class="group bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 [&_summary::-webkit-details-marker]:hidden open:border-brand-red/30 transition-all duration-300">
        <summary class="flex cursor-pointer items-center justify-between gap-4 px-5 py-4 font-bold text-sm text-brand-text hover:text-brand-red transition-colors outline-none">
  <span class="pr-4">8. Hệ thống màn hình có dễ dàng thay đổi nội dung trình chiếu không?</span>
  <span class="shrink-0 flex items-center justify-center w-8 h-8 rounded-full bg-gray-50 text-gray-400 group-hover:bg-brand-red/10 group-hover:text-brand-red group-open:bg-brand-red group-open:text-white group-open:rotate-180 transition-all duration-300">
      <i class="ph-bold ph-caret-down text-base"></i>
  </span>
        </summary>
        <div class="px-5 pb-4 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4 mt-1 animate-fade-in-up">
  Rất dễ dàng. Hệ thống được điều khiển thông qua phần mềm đồng bộ trên máy tính hoặc ứng dụng điện thoại thông minh. Khách hàng có thể thay đổi hình ảnh, video, chạy chữ trực tiếp chỉ với vài thao tác click chuột.
        </div>
    </details>

    <details name="faq" class="group bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 [&_summary::-webkit-details-marker]:hidden open:border-brand-red/30 transition-all duration-300">
        <summary class="flex cursor-pointer items-center justify-between gap-4 px-5 py-4 font-bold text-sm text-brand-text hover:text-brand-red transition-colors outline-none">
  <span class="pr-4">9. Tại sao nên chọn HacoLED thay vì các đơn vị giá rẻ trên thị trường?</span>
  <span class="shrink-0 flex items-center justify-center w-8 h-8 rounded-full bg-gray-50 text-gray-400 group-hover:bg-brand-red/10 group-hover:text-brand-red group-open:bg-brand-red group-open:text-white group-open:rotate-180 transition-all duration-300">
      <i class="ph-bold ph-caret-down text-base"></i>
  </span>
        </summary>
        <div class="px-5 pb-4 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4 mt-1 animate-fade-in-up">
  "Giá trị đi đôi với chất lượng". HacoLED không cạnh tranh bằng linh kiện trôi nổi. Chúng tôi cam kết bằng sự ổn định của hệ thống, tuổi thọ sản phẩm, dịch vụ hậu mãi "Fast & Friendly" và uy tín đã được bảo chứng qua hàng ngàn dự án lớn.
        </div>
    </details>

    <details name="faq" class="group bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 [&_summary::-webkit-details-marker]:hidden open:border-brand-red/30 transition-all duration-300">
        <summary class="flex cursor-pointer items-center justify-between gap-4 px-5 py-4 font-bold text-sm text-brand-text hover:text-brand-red transition-colors outline-none">
  <span class="pr-4">10. HacoLED có cung cấp giải pháp thanh toán linh hoạt không?</span>
  <span class="shrink-0 flex items-center justify-center w-8 h-8 rounded-full bg-gray-50 text-gray-400 group-hover:bg-brand-red/10 group-hover:text-brand-red group-open:bg-brand-red group-open:text-white group-open:rotate-180 transition-all duration-300">
      <i class="ph-bold ph-caret-down text-base"></i>
  </span>
        </summary>
        <div class="px-5 pb-4 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4 mt-1 animate-fade-in-up">
  Chúng tôi luôn thấu hiểu bài toán tài chính của doanh nghiệp. Tùy thuộc vào quy mô dự án và năng lực đối tác, HacoLED sẽ tư vấn các gói thanh toán linh hoạt, chia nhỏ theo từng giai đoạn nghiệm thu công trình.
        </div>
    </details>
          </div>
      </div>
  </div>

  <!-- Script cho Accordion FAQ (Bật cái này đóng cái kia) cho các trình duyệt chưa support 'name' attribute của thẻ details -->
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const faqs = document.querySelectorAll('#faq-accordion details');
          faqs.forEach(faq => {
              faq.addEventListener('click', function(e) {
                  if (this.open) return; // Nếu đang đóng mà bấm mở thì OK
                  faqs.forEach(otherFaq => {
                      if (otherFaq !== this && otherFaq.open) {
                          otherFaq.removeAttribute('open');
                      }
                  });
              });
          });
      });
  </script>
        </section>

        <!-- Call To Action Section -->
        <!-- Call To Action Section -->
        <section class="py-24 md:py-36 relative overflow-hidden bg-[#0A0000] text-white border-t border-white/5">
            <!-- Sleek Decorative Background Elements -->
            <div class="absolute inset-0 pointer-events-none z-0">
                <!-- Tech Grid overlay with gradient mask -->
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAwIDQwIEwgNDAgNDAgNDAgMCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJyZ2JhKDI1NSwyNTUsMjU1LDAuMDUpIiBzdHJva2Utd2lkdGg9IjEiLz48L3BhdHRlcm4+PC9kZWZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JpZCkiLz48L3N2Zz4=')] opacity-25"></div>
                
                <!-- Glowing ambient orbs -->
                <div class="absolute top-1/2 left-1/4 -translate-y-1/2 w-[400px] h-[400px] rounded-full bg-brand-red/10 blur-[130px]"></div>
                <div class="absolute top-1/3 right-1/4 -translate-y-1/2 w-[500px] h-[500px] rounded-full bg-brand-gold/5 blur-[150px]"></div>
                <div class="absolute -bottom-10 left-1/2 -translate-x-1/2 w-[600px] h-[300px] rounded-full bg-red-900/10 blur-[120px]"></div>
                
                <!-- Linear light streaks / abstract LED board mockup edge -->
                <div class="absolute top-0 left-0 right-0 h-[1px] bg-gradient-to-r from-transparent via-brand-red/50 to-transparent"></div>
            </div>

            <div class="container mx-auto px-6 relative z-10">
                <div class="max-w-4xl mx-auto">
                    <!-- Glassmorphism container card -->
                    <div class="relative rounded-3xl p-8 md:p-16 overflow-hidden border border-white/[0.08] bg-gradient-to-br from-white/[0.03] to-white/[0.01] backdrop-blur-xl shadow-[0_30px_70px_rgba(0,0,0,0.7)] text-center">
                        
                        <!-- Accent micro-badge -->
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-red/10 border border-brand-red/20 mb-6 md:mb-8">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-gold opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-gold"></span>
                            </span>
                            <span class="text-brand-gold text-[10px] md:text-xs font-bold uppercase tracking-widest">TƯ VẤN & BÁO GIÁ MIỄN PHÍ</span>
                        </div>

                        <!-- Main Title (ALL CAPS H2) -->
                        <h2 class="text-3xl md:text-4xl lg:text-5xl font-black uppercase tracking-tight text-white mb-6 leading-tight">
                            SẴN SÀNG NÂNG TẦM <br class="hidden sm:inline">
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-red via-red-500 to-brand-gold">KHÔNG GIAN TRÌNH CHIẾU?</span>
                        </h2>

                        <!-- Subtitle text -->
                        <p class="text-gray-300 max-w-2xl mx-auto mb-10 text-sm md:text-base lg:text-lg font-light leading-relaxed">
                            Liên hệ ngay với chuyên gia của HacoLED để nhận giải pháp thi công màn hình LED toàn diện và tối ưu chi phí nhất cho doanh nghiệp của bạn.
                        </p>

                        <!-- Call to actions -->
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 md:gap-6 max-w-md mx-auto sm:max-w-none">
                            <!-- Button Primary: Tư vấn -->
                            <a href="https://hacoled.com/lien-he/" class="group relative inline-flex items-center justify-center px-8 py-4 font-bold text-white transition-all duration-300 bg-gradient-to-r from-brand-red to-red-600 rounded-full hover:shadow-[0_0_30px_rgba(204,0,0,0.5)] hover:scale-[1.03] active:scale-[0.98] overflow-hidden w-full sm:w-auto">
                                <span class="relative flex items-center gap-2">
                                    Nhận Tư Vấn Miễn Phí
                                    <i class="ph-bold ph-arrow-right group-hover:translate-x-1.5 transition-transform duration-300"></i>
                                </span>
                            </a>
                            <!-- Button Secondary: Call -->
                            <a href="tel:0342324488" class="group inline-flex items-center justify-center px-8 py-4 font-bold text-white transition-all duration-300 bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/10 rounded-full hover:scale-[1.03] active:scale-[0.98] hover:shadow-[0_10px_20px_rgba(0,0,0,0.3)] w-full sm:w-auto">
                                <i class="ph-fill ph-phone-call text-brand-gold mr-2 text-xl group-hover:scale-110 group-hover:rotate-12 transition-transform duration-300"></i>
                                034 232 4488
                            </a>
                        </div>

                        <!-- Small Trust Indicators inside the card -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-12 pt-8 border-t border-white/5 text-gray-400 text-xs md:text-sm font-medium">
                            <div class="flex items-center justify-center gap-2">
                                <i class="ph-bold ph-clock-countdown text-brand-gold text-lg"></i>
                                <span>Khảo sát nhanh trong 2h</span>
                            </div>
                            <div class="flex items-center justify-center gap-2 border-y sm:border-y-0 sm:border-x border-white/5 py-2 sm:py-0">
                                <i class="ph-bold ph-chats-teardrop text-brand-gold text-lg"></i>
                                <span>Tư vấn kỹ thuật 24/7</span>
                            </div>
                            <div class="flex items-center justify-center gap-2">
                                <i class="ph-bold ph-shield-check text-brand-gold text-lg"></i>
                                <span>Cam kết thiết bị chính hãng</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </main>
    <script>
        // 1. DỮ LIỆU DỰ ÁN VÀ BÁO CHÍ
        const projects = [
            { title: "Lắp đặt màn hình LED P3 trong nhà tại Phố Xanh Building", category: "Dự án trong nhà", year: "2026", client: "Phố Xanh Building", desc: "Dự án thi công và lắp đặt màn hình LED P3 độ phân giải cao trong nhà cho Phố Xanh Building.", img: "https://hacoled.com/wp-content/uploads/2026/04/man-hinh-led-p3-trong-nha-pho-xanh-building.jpg", url: "https://hacoled.com/lap-dat-man-hinh-led-p3-trong-nha-tai-pho-xanh-building/" },
            { title: "Lắp đặt màn hình LED P1.5 trong nhà tại CT Cổ Phần Đầu Tư FORTUNE", category: "Dự án trong nhà", year: "2026", client: "CT Cổ Phần Đầu Tư FORTUNE", desc: "Thi công giải pháp màn hình LED P1.5 cao cấp, sắc nét trong nhà cho công ty cổ phần đầu tư Fortune.", img: "https://hacoled.com/wp-content/uploads/2026/03/man-hinh-led-p1-5-cong-ty-co-phan-dau-tu-fortune.jpg", url: "https://hacoled.com/man-hinh-led-p1-5-trong-nha-cong-ty-fotune/" },
            { title: "Lắp đặt màn hình LED P3.91 cho Trường THPT FPT Tây Hà Nội", category: "Dự án ngoài trời", year: "2026", client: "Trường THPT FPT Tây Hà Nội", desc: "Triển khai lắp đặt màn hình LED P3.91 ngoài trời phục vụ các hoạt động sự kiện tại THPT FPT Tây Hà Nội.", img: "https://hacoled.com/wp-content/uploads/2026/03/man-hinh-led-p3-91-truong-thpt-fpt-tay-ha-noi.jpg", url: "https://hacoled.com/lap-dat-man-hinh-led-p3-91-cho-truong-thpt-fpt-tay-ha-noi/" },
            { title: "Lắp đặt màn hình LED P3 trong nhà tại thôn Ngọc – Hưng Yên", category: "Dự án trong nhà", year: "2026", client: "Nhà văn hóa thôn Ngọc – Hưng Yên", desc: "Hoàn thiện lắp đặt hệ thống màn hình LED P3 trong nhà phục vụ sinh hoạt tại nhà văn hóa thôn Ngọc.", img: "https://hacoled.com/wp-content/uploads/2026/03/man-hinh-led-p3-trong-nha-tai-nha-van-hoa-thon-ngoc-hung-yen.jpg", url: "https://hacoled.com/lap-dat-man-hinh-led-p3-trong-nha-tai-thon-ngoc-hung-yen/" },
            { title: "Lắp đặt màn hình LED P2 trong nhà tại Học Viện Kỹ Thuật Mật Mã", category: "Dự án trong nhà", year: "2026", client: "Học Viện Kỹ Thuật Mật Mã", desc: "Cung cấp và lắp đặt màn hình LED P2 trong nhà chất lượng cao phục vụ Học Viện Kỹ Thuật Mật Mã.", img: "https://hacoled.com/wp-content/uploads/2026/02/man-hinh-led-p2-trong-nha-tai-hoc-vien-ky-thuat-mat-ma.jpg", url: "https://hacoled.com/lap-dat-man-hinh-led-p2-trong-nha-hoc-vien-ky-thuat-mat-ma/" },
            { title: "Lắp đặt màn hình LED P2 trong nhà tại Công Ty TNHH MTV Cao Su 75", category: "Dự án trong nhà", year: "2026", client: "Công Ty TNHH MTV Cao Su 75", desc: "Dự án thi công màn hình LED P2 trong nhà hiển thị sắc nét dành cho Công ty TNHH MTV Cao su 75.", img: "https://hacoled.com/wp-content/uploads/2026/01/man-hinh-led-p2-trong-nha-tai-cong-ty-tnhh-mtv-cao-su-75.jpg", url: "https://hacoled.com/lap-dat-man-hinh-led-p2-trong-nha-tai-cong-ty-cao-su-75/" },
            { title: "Lắp đặt màn hình LED P1.8 trong nhà tại Công Ty Cổ Phần Xây Dựng & Thương Mại 299", category: "Dự án trong nhà", year: "2026", client: "Công Ty Cổ Phần Xây Dựng & Thương Mại 299", desc: "Cung cấp giải pháp hiển thị màn hình LED P1.8 trong nhà cho Công ty Xây dựng và Thương mại 299.", img: "https://hacoled.com/wp-content/uploads/2026/01/man-hinh-led-p1-8-trong-nha-tai-cong-ty-co-phan-xd-va-tm-299.jpg", url: "https://hacoled.com/man-hinh-led-p1-8-trong-nha-tai-cong-ty-co-phan-xay-dung-thuong-mai-299/" },
            { title: "Lắp đặt màn hình LED P1.5 trong nhà tại Côn Đảo", category: "Dự án trong nhà", year: "2026", client: "Đối tác tại Côn Đảo", desc: "Hoàn thiện hạng mục cung cấp và thi công màn hình LED P1.5 trong nhà hiện đại tại khu vực Côn Đảo.", img: "https://hacoled.com/wp-content/uploads/2026/01/man-hinh-led-p1-5-trong-nha-tai-con-dao.jpg", url: "https://hacoled.com/lap-dat-man-hinh-led-p1-5-trong-nha-tai-con-dao/" },
            { title: "Lắp đặt màn hình LED P2 trong nhà tại Capital Elite", category: "Dự án trong nhà", year: "2026", client: "Capital Elite (Phạm Hùng)", desc: "Thi công lắp đặt hệ thống màn hình LED P2 trong nhà cao cấp cho dự án tòa nhà Capital Elite.", img: "https://hacoled.com/wp-content/uploads/2026/01/man-hinh-led-p2-trong-nha-tai-capital-elite-pham-hung-2.jpg", url: "https://hacoled.com/lap-dat-man-hinh-led-p2-trong-nha-tai-capital-elite/" },
            { title: "Lắp đặt màn hình LED P2 trong nhà tại Công an xã Vĩnh Thanh", category: "Dự án trong nhà", year: "2026", client: "Công an xã Vĩnh Thanh", desc: "Hoàn thành hạng mục lắp đặt màn hình LED P2 trong nhà phục vụ công tác tại Công an xã Vĩnh Thanh.", img: "https://hacoled.com/wp-content/uploads/2026/01/man-hinh-led-p2-trong-nha-tai-cong-an-xa-vinh-thanh-3.jpg", url: "https://hacoled.com/man-hinh-led-p2-trong-nha-tai-cong-an-xa-vinh-thanh/" },
            { title: "Lắp đặt màn hình LED P1.8 trong nhà tại Bệnh Viện Quốc Tế Carmel", category: "Dự án trong nhà", year: "2026", client: "Bệnh Viện Quốc Tế Carmel", desc: "Trang bị hệ thống màn hình LED P1.8 độ nét cao trong nhà phục vụ hiển thị tại Bệnh viện Quốc tế Carmel.", img: "https://hacoled.com/wp-content/uploads/2026/01/man-hinh-led-p1-8-trong-nha-tai-benh-vien-quoc-te-carmel-1.jpg", url: "https://hacoled.com/man-hinh-led-p1-8-trong-nha-tai-benh-vien-quoc-te-carmel/" },
            { title: "Lắp đặt màn hình LED P3 trong nhà tại Trường Tân Hòa – Đồng Nai", category: "Dự án trong nhà", year: "2026", client: "Trường Tân Hòa – Đồng Nai", desc: "Lắp đặt hoàn thiện hệ thống màn hình LED P3 trong nhà phục vụ giảng dạy tại Trường Tân Hòa, Đồng Nai.", img: "https://hacoled.com/wp-content/uploads/2026/01/man-hinh-led-p3-trong-nha-truong-tan-hoa-3.jpg", url: "https://hacoled.com/man-hinh-led-p3-trong-nha-tai-truong-tan-hoa/" }
        ];

        const press = [
            { source: "BÁO THÁI NGUYÊN", logo: "https://baothainguyen.vn/common/v1/images/logo.svg?1", title: "Lắp đặt màn hình LED ngoài trời - Giải pháp quảng cáo thu lợi tiền tỷ.", img: "https://hacoled.com/wp-content/uploads/2025/04/hacoled-don-vi-thi-cong-man-hinh-led-tin-cay-10.jpg", url: "http://baothainguyen.vn/thong-tin-quang-cao/202307/lap-dat-man-hinh-led-ngoai-troi-giai-phap-quang-cao-thu-loi-tien-ty-9874a80" },
            { source: "TECH Z", logo: "https://www.techz.vn/version2/images/logo.svg", logoDark: true, title: "HACOLED - Đơn vị cung cấp màn hình LED quảng cáo hàng đầu Việt Nam.", img: "https://hacoled.com/wp-content/uploads/2025/04/hacoled-don-vi-thi-cong-man-hinh-led-tin-cay9.jpg", url: "http://techz.vn/143-621-6-hacoled-don-vi-cung-cap-man-hinh-led-quang-cao-hang-dau-viet-nam-ylt531513.html" },
            { source: "BÁO TUYÊN QUANG", logo: "https://hacoled.com/wp-content/uploads/2026/04/logo-tuenquang.png", title: "Màn hình LED hội trường - Công nghệ đột phá trong trải nghiệm sự kiện.", img: "https://hacoled.com/wp-content/uploads/2025/04/hacoled-don-vi-thi-cong-man-hinh-led-tin-cay-4.jpg", url: "http://baotuyenquang.com.vn/man-hinh-led-hoi-truong-cong-nghe-dot-pha-trong-trai-nghiem-su-kien-177097.html" },
            { source: "VIỆT STOCK", logo: "https://image.vietstock.vn/common/vietstock.svg?6", title: "HACOLED - Đơn vị thi công màn hình LED uy tín, hỗ trợ bảo hành 24 tháng.", img: "https://hacoled.com/wp-content/uploads/2025/04/hacoled-don-vi-thi-cong-man-hinh-led-tin-cay-5.jpg", url: "http://vietstock.vn/2024/02/hacoled-don-vi-thi-cong-man-hinh-led-uy-tin-ho-tro-bao-hanh-24-thang-4511-1158530.htm" },
            { source: "BÁO TÂY NINH", logo: "https://media.baotayninh.vn/upload/files/logo/logo_new.png", title: "Màn hình LED sân khấu nên lắp đặt đơn vị nào uy tín, giá rẻ?", img: "https://hacoled.com/wp-content/uploads/2025/04/hacoled-don-vi-thi-cong-man-hinh-led-tin-cay-6.jpg", url: "http://baotayninh.vn/-man-hinh-led-san-khau-nen-lap-dat-don-vi-nao-uy-tin-gia-re-a160671.html" },
            { source: "BÁO QUẢNG NAM", logo: "https://bqn.1cdn.vn/assets/images/logodn.png", title: "HACOLED - Đơn vị thi công màn hình LED số 1 Hà Nội và Sài Gòn.", img: "https://hacoled.com/wp-content/uploads/2025/04/hacoled-don-vi-thi-cong-man-hinh-led-tin-cay.jpg", url: "http://baoquangnam.vn/hacoled-don-vi-thi-cong-man-hinh-led-so-1-ha-noi-va-sai-gon-3050735.html" }
        ];

        function init() {
            // 2. KHỞI TẠO SWIPER SLIDER
            if (typeof Swiper !== 'undefined') {
                const wrappers = document.querySelectorAll('.product-slider-wrapper');
                wrappers.forEach(wrapper => {
                    const swiperEl = wrapper.querySelector('.product-swiper');
                    if(swiperEl) {
                        new Swiper(swiperEl, {
                            slidesPerView: 2,
                            spaceBetween: 10,
                            loop: true,
                            grabCursor: true,
                            navigation: {
                                nextEl: wrapper.querySelector('.custom-swiper-next'),
                                prevEl: wrapper.querySelector('.custom-swiper-prev'),
                            },
                            breakpoints: {
                                640: { slidesPerView: 2, spaceBetween: 20 },
                                768: { slidesPerView: 3, spaceBetween: 24 },
                                1024: { slidesPerView: 4, spaceBetween: 24 }
                            }
                        });
                    }
                });
            }

            // 3. RENDER HTML DỰ ÁN
            document.getElementById('projects-container').innerHTML = projects.map((p, idx) => {
                const cat = p.category.split(',')[0].trim();
                return `
                <a href="${p.url}" target="_blank" rel="noopener"
                   class="group rounded-xl overflow-hidden relative block fade-up shadow-sm hover:shadow-2xl transition-all duration-500 ring-1 ring-black/5" style="transition-delay: ${(idx % 4) * 60}ms">
                    <div class="aspect-video relative overflow-hidden bg-gray-100">
                        <img src="${p.img}" alt="${p.title}"
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                        <div class="absolute top-2 left-2 z-10">
                            <span class="bg-brand-red/90 backdrop-blur-sm text-white text-[9px] font-bold px-2 py-0.5 rounded shadow uppercase tracking-widest">${cat}</span>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 z-10 backdrop-blur-md bg-black/30 border-t border-white/15 px-2.5 py-2">
                            <h4 class="font-heading text-xs md:text-sm font-bold text-white leading-snug line-clamp-2">${p.title}</h4>
                        </div>
                        <div class="absolute inset-0 z-20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/20">
                            <span class="inline-flex items-center gap-1.5 bg-brand-gold text-[#1C0505] text-[11px] font-extrabold uppercase tracking-wider px-3.5 py-1.5 rounded-full shadow-lg">
                                Xem dự án <i class="ph-bold ph-arrow-up-right"></i>
                            </span>
                        </div>
                    </div>
                </a>`;
            }).join('');

            // 4. RENDER HTML BÁO CHÍ
            document.getElementById('press-container').innerHTML = press.map((p, idx) => `
                <a href="${p.url}" target="_blank" rel="noopener"
                   class="group rounded-2xl overflow-hidden relative block fade-up transition-all duration-500 hover:-translate-y-1 hover:shadow-[0_20px_60px_rgba(0,0,0,0.5)]"
                   style="transition-delay: ${idx * 80}ms">
                    <div class="aspect-[16/9] relative overflow-hidden bg-gray-900">
                        <img src="${p.img}" alt="${p.source}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-brand-gold to-transparent opacity-70"></div>
                        <div class="absolute top-3 left-3 z-10">
                            <span class="inline-flex items-center gap-1 bg-brand-gold text-[#1C0505] text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded-full shadow-lg">
                                Đọc bài <i class="ph-bold ph-arrow-up-right"></i>
                            </span>
                        </div>
                        <div class="absolute top-3 right-3 z-10">
                            <div class="rounded-md px-2 py-1 flex items-center shadow-xl overflow-hidden border border-white/10"
                                 style="background: ${p.logoDark ? 'rgba(20,2,2,0.88)' : 'rgba(255,255,255,0.92)'}; backdrop-filter: blur(8px);">
                                <img src="${p.logo}" alt="${p.source}" class="h-4 max-w-[70px] object-contain"
                                     style="${p.logoBlend ? 'mix-blend-mode:multiply' : ''}"
                                     onerror="this.style.display='none';this.nextElementSibling.style.display='inline'">
                                <span class="text-[9px] font-extrabold uppercase tracking-widest" style="display:none;color:${p.logoDark ? '#f5c842' : '#1C0505'}">${p.source}</span>
                            </div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 z-10 backdrop-blur-md bg-black/35 border-t border-white/15 px-3 py-2.5">
                            <div class="text-brand-gold/70 text-lg font-serif leading-none mb-0.5 select-none">&ldquo;</div>
                            <h4 class="font-heading text-sm font-bold text-white leading-snug line-clamp-2 group-hover:text-brand-gold transition-colors duration-300">${p.title}</h4>
                            <div class="mt-2 h-px bg-gradient-to-r from-brand-gold/60 to-transparent w-6 group-hover:w-full transition-all duration-700 ease-out"></div>
                        </div>
                    </div>
                </a>
            `).join('');

            // Logo báo chí
            const logoStrip = document.getElementById('press-logo-strip');
            if (logoStrip) {
                logoStrip.innerHTML = press.map(p => `
                    <a href="${p.url}" target="_blank" rel="noopener"
                       class="flex items-center justify-center px-4 py-2 rounded-lg border border-white/10 hover:border-brand-gold/50 transition-all duration-300 group"
                       style="background: rgba(255,255,255,0.05); backdrop-filter: blur(6px);">
                        <img src="${p.logo}" alt="${p.source}"
                             class="h-5 max-w-[90px] object-contain opacity-60 group-hover:opacity-100 transition-opacity duration-300"
                             style="${p.logoDark ? 'filter: brightness(10)' : ''}"
                             onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
                        <span class="text-[10px] font-bold text-white/60 group-hover:text-white uppercase tracking-wider" style="display:none">${p.source}</span>
                    </a>
                `).join('');
            }
        }

        // 5. ANIMATION SỐ NHẢY
        function animateCounters() {
            document.querySelectorAll('.counter').forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const speed = 80;
                const updateCount = () => {
                    const count = +counter.innerText;
                    const inc = target / speed;
                    if (count < target) {
                        counter.innerText = Math.ceil(count + inc);
                        setTimeout(updateCount, 25);
                    } else {
                        counter.innerText = target;
                    }
                };
                updateCount();
            });
        }

        // 6. HIỆU ỨNG HIỆN DẦN (FADE-UP) KHI CUỘN CHUỘT
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    if(entry.target.querySelector('.counter')) {
                        animateCounters();
                    }
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        document.addEventListener('DOMContentLoaded', () => {
            init();
            document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
        });
    </script>
    
    <script>
    (function() {
        var COLOR_MAIN  = '#d32f2f';
        var COLOR_ALT   = '#dfb931';
        var COLOR_PULSE = '#ffb300';
        var COLOR_DOT   = '#C4941A';
        var GRID        = 40;
        var PART_COUNT  = 50;
        var PART_SPEED  = 0.22;
        var LINK_DIST   = 120;

        function snap(v) { return Math.round(v / GRID) * GRID; }

        function makePath(W, H) {
            var pts = [{ x: snap(Math.random()*W), y: snap(Math.random()*H) }];
            var isDashed = Math.random() > 0.7;
            var color    = Math.random() > 0.45 ? COLOR_MAIN : COLOR_ALT;
            var lw       = Math.random() > 0.8 ? 1.5 : 1.0;
            var alpha    = Math.random() * 0.11 + 0.04;
            var cur = pts[0], angle = Math.floor(Math.random()*8) * (Math.PI/4);
            var segs = Math.floor(Math.random()*4) + 2;
            for (var i = 0; i < segs; i++) {
                var len  = (Math.floor(Math.random()*5)+2) * GRID;
                var next = { x: cur.x + Math.cos(angle)*len, y: cur.y + Math.sin(angle)*len };
                pts.push(next); cur = next;
                angle += (Math.random()>0.5?1:-1) * (Math.random()>0.5 ? Math.PI/2 : Math.PI/4);
            }
            return { pts:pts, isDashed:isDashed, color:color, lw:lw, alpha:alpha };
        }

        function drawPath(ctx, p) {
            if (p.pts.length < 2) return;
            ctx.beginPath();
            ctx.moveTo(p.pts[0].x, p.pts[0].y);
            for (var i = 1; i < p.pts.length; i++) ctx.lineTo(p.pts[i].x, p.pts[i].y);
            ctx.strokeStyle = p.color;
            ctx.lineWidth   = p.lw;
            ctx.globalAlpha = p.alpha;
            ctx.setLineDash(p.isDashed ? [4,6] : []);
            ctx.stroke();
            ctx.globalAlpha = 1; ctx.setLineDash([]);
        }

        function makePulse(path) {
            return { path:path, seg:0, prog:0, speed:0.007+Math.random()*0.012, size:2 };
        }

        function updatePulse(pulse) {
            pulse.prog += pulse.speed;
            if (pulse.prog >= 1) {
                pulse.prog = 0; pulse.seg++;
                if (pulse.seg >= pulse.path.pts.length-1) pulse.seg = 0;
            }
        }

        function drawPulse(ctx, pulse) {
            var p1 = pulse.path.pts[pulse.seg], p2 = pulse.path.pts[pulse.seg+1];
            if (!p1||!p2) return;
            var x = p1.x + (p2.x-p1.x)*pulse.prog;
            var y = p1.y + (p2.y-p1.y)*pulse.prog;
            ctx.beginPath(); ctx.arc(x, y, pulse.size, 0, Math.PI*2);
            ctx.fillStyle = COLOR_PULSE;
            ctx.globalAlpha = 0.45;
            ctx.shadowBlur = 4; ctx.shadowColor = COLOR_PULSE;
            ctx.fill();
            ctx.shadowBlur = 0; ctx.globalAlpha = 1;
        }

        function makeDecoration(x, y) {
            return { x:x, y:y, type:Math.floor(Math.random()*4), r:Math.random()*7+3 };
        }

        function drawDecoration(ctx, d) {
            ctx.strokeStyle = COLOR_MAIN; ctx.fillStyle = COLOR_MAIN;
            ctx.lineWidth = 1.0; ctx.globalAlpha = 0.15;
            if (d.type===0) {
                ctx.beginPath(); ctx.arc(d.x,d.y,2.5,0,Math.PI*2); ctx.fill();
            } else if (d.type===1) {
                ctx.beginPath(); ctx.arc(d.x,d.y,1.5,0,Math.PI*2); ctx.fill();
                ctx.beginPath(); ctx.arc(d.x,d.y,d.r,0,Math.PI*2); ctx.globalAlpha=0.08; ctx.stroke();
            } else if (d.type===2) {
                ctx.beginPath(); ctx.arc(d.x,d.y,d.r,0,Math.PI*2); ctx.globalAlpha=0.10; ctx.stroke();
                ctx.setLineDash([2,4]); ctx.beginPath(); ctx.arc(d.x,d.y,d.r+4,0,Math.PI*2);
                ctx.globalAlpha=0.06; ctx.stroke(); ctx.setLineDash([]);
            } else {
                ctx.beginPath(); ctx.arc(d.x,d.y,2.5,0,Math.PI*2);
                ctx.fillStyle=COLOR_PULSE; ctx.globalAlpha=0.3; ctx.fill();
            }
            ctx.globalAlpha = 1;
        }

        function SectionFX(section) {
            this.section = section;
            this.type    = section.getAttribute('data-tech-bg') || 'circuit';
            this.canvas  = document.createElement('canvas');
            this.canvas.setAttribute('aria-hidden','true');
            this.canvas.style.cssText =
                'position:absolute;inset:0;width:100%;height:100%;pointer-events:none;z-index:0;display:block;';
            this.ctx    = this.canvas.getContext('2d');
            this.active = false; this.animID = null;
            this.paths = []; this.pulses = []; this.decs = []; this.particles = [];
            section.insertBefore(this.canvas, section.firstChild);
            this.resize();
            this.generate();
        }

        SectionFX.prototype.resize = function() {
            this.W = this.canvas.width  = this.section.offsetWidth  || window.innerWidth;
            this.H = this.canvas.height = this.section.offsetHeight || 600;
        };

        SectionFX.prototype.generate = function() {
            var W = this.W, H = this.H, type = this.type;
            this.paths = []; this.pulses = []; this.decs = []; this.particles = [];
            if (type === 'circuit') {
                var numPaths = Math.max(5, Math.floor((W * H) / 60000));
                for (var i = 0; i < numPaths; i++) {
                    var p = makePath(W, H);
                    this.paths.push(p);
                    if (Math.random() > 0.35) this.pulses.push(makePulse(p));
                    this.decs.push(makeDecoration(p.pts[0].x, p.pts[0].y));
                    var last = p.pts[p.pts.length-1];
                    this.decs.push(makeDecoration(last.x, last.y));
                    for (var j = 1; j < p.pts.length-1; j++) {
                        if (Math.random() > 0.7) this.decs.push(makeDecoration(p.pts[j].x, p.pts[j].y));
                    }
                }
            }
            if (type === 'particle') {
                for (var i = 0; i < PART_COUNT; i++) {
                    this.particles.push({
                        x: Math.random()*W, y: Math.random()*H,
                        vx:(Math.random()-0.5)*PART_SPEED, vy:(Math.random()-0.5)*PART_SPEED,
                        r: Math.random()*1.2+0.6
                    });
                }
            }
        };

        SectionFX.prototype.draw = function() {
            if (!this.active) return;
            var ctx = this.ctx, W = this.W, H = this.H, type = this.type;
            ctx.clearRect(0, 0, W, H);
            if (type === 'circuit') {
                for (var i = 0; i < this.paths.length; i++) drawPath(ctx, this.paths[i]);
                for (var i = 0; i < this.decs.length;  i++) drawDecoration(ctx, this.decs[i]);
                for (var i = 0; i < this.pulses.length; i++) {
                    updatePulse(this.pulses[i]);
                    drawPulse(ctx, this.pulses[i]);
                }
            }
            if (type === 'particle') {
                var ps = this.particles;
                for (var i = 0; i < ps.length; i++) {
                    var p = ps[i];
                    p.x += p.vx; p.y += p.vy;
                    if (p.x < 0 || p.x > W) p.vx *= -1;
                    if (p.y < 0 || p.y > H) p.vy *= -1;
                    ctx.beginPath();
                    ctx.arc(p.x, p.y, p.r + 1.6, 0, Math.PI*2);
                    ctx.fillStyle = COLOR_DOT;
                    ctx.globalAlpha = 0.35;
                    ctx.fill();
                }
                ctx.globalAlpha = 1;
                for (var i = 0; i < ps.length; i++) {
                    for (var j = i+1; j < ps.length; j++) {
                        var a = ps[i], b = ps[j];
                        var dx = a.x-b.x, dy = a.y-b.y;
                        var distSq = dx*dx + dy*dy;
                        if (distSq < LINK_DIST*LINK_DIST) {
                            var al = (1 - Math.sqrt(distSq)/LINK_DIST) * 0.10;
                            ctx.beginPath(); ctx.moveTo(a.x, a.y); ctx.lineTo(b.x, b.y);
                            ctx.strokeStyle = 'rgba(204,0,0,'+al+')';
                            ctx.lineWidth = 0.6; ctx.stroke();
                        }
                    }
                }
            }
            var self = this;
            this.animID = requestAnimationFrame(function(){ self.draw(); });
        };

        SectionFX.prototype.start = function() {
            this.active = true;
            if (!this.animID) this.draw();
        };

        SectionFX.prototype.stop = function() {
            this.active = false;
            if (this.animID) { cancelAnimationFrame(this.animID); this.animID = null; }
        };

        function initFX() {
            var sections  = document.querySelectorAll('[data-tech-bg]');
            var instances = [];
            sections.forEach(function(sec) {
                if (getComputedStyle(sec).position === 'static') sec.style.position = 'relative';
                instances.push(new SectionFX(sec));
            });
            var io = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    for (var k = 0; k < instances.length; k++) {
                        if (instances[k].section === entry.target) {
                            if (entry.isIntersecting) instances[k].start();
                            else instances[k].stop();
                            break;
                        }
                    }
                });
            }, { threshold: 0.05 });
            sections.forEach(function(s) { io.observe(s); });
            window.addEventListener('resize', function() {
                instances.forEach(function(fx) { fx.resize(); fx.generate(); });
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initFX);
        } else {
            initFX();
        }
    })();
    </script>
    



<?php do_action( "flatsome_after_page" ); ?>

<?php get_footer(); ?>


