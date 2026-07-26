<?php
/**
 * Homepage Template View
 *
 * @var string $title
 * @var string $tagline
 * @var string $designer
 * @var string $designer_contact
 * @var array  $products
 * @var array  $posts
 * @var string $header_type
 * @var string $footer_type
 */

// Render dynamically configured header
$this->renderHeader('default');
?>
<?php
/**
 * Dynamic WP_Query for Homepage Press
 */

// Query Press
$args_press = array(
    'post_type'      => 'post',
    'posts_per_page' => 6,
    'category_name'  => 'bao-chi-noi-ve-hacoled',
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC'
);
$query_press = new WP_Query($args_press);
if (!$query_press->have_posts()) {
    $args_press['category_name'] = 'press';
    $query_press = new WP_Query($args_press);
}

$press_data = array();
if ($query_press->have_posts()) {
    while ($query_press->have_posts()) {
        $query_press->the_post();
        $source = get_post_meta(get_the_ID(), '_press_source', true);
        if (!$source) {
            $source = get_post_meta(get_the_ID(), '_press_author', true) ?: 'Truyền thông';
        }
        $logo = get_post_meta(get_the_ID(), '_press_logo', true);
        if (!$logo) {
            $logo = get_template_directory_uri() . '/assets/images/dmca-badge.webp';
        }
        $logo_dark = get_post_meta(get_the_ID(), '_press_logo_dark', true);
        
        $press_data[] = array(
            'source'   => $source,
            'logo'     => $logo,
            'logoDark' => !empty($logo_dark) && ($logo_dark === 'yes' || $logo_dark === '1' || $logo_dark === true),
            'title'    => get_the_title(),
            'img'      => get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_template_directory_uri() . '/assets/images/home-solution-led.webp',
            'url'      => get_post_meta(get_the_ID(), '_press_url', true) ?: get_permalink()
        );
    }
    wp_reset_postdata();
}

if (empty($press_data)) {
    $press_data = array();
    $default_press = array(
        array(
            'source' => "BÁO THÁI NGUYÊN",
            'logo' => get_template_directory_uri() . "/assets/images/logo-haco.png",
            'logoDark' => false,
            'title' => "Lắp đặt màn hình LED ngoài trời - Giải pháp quảng cáo thu lợi tiền tỷ.",
            'img' => get_template_directory_uri() . "/assets/images/home-solution-led.webp",
            'url' => "http://baothainguyen.vn/thong-tin-quang-cao/202307/lap-dat-man-hinh-led-ngoai-troi-giai-phap-quang-cao-thu-loi-tien-ty-9874a80"
        ),
        array(
            'source' => "TECH Z",
            'logo' => get_template_directory_uri() . "/assets/images/logo-haco.png",
            'logoDark' => true,
            'title' => "HACOLED - Đơn vị cung cấp màn hình LED quảng cáo hàng đầu Việt Nam.",
            'img' => get_template_directory_uri() . "/assets/images/home-solution-videowall.webp",
            'url' => "http://techz.vn/143-621-6-hacoled-don-vi-cung-cap-man-hinh-led-quang-cao-hang-dau-viet-nam-ylt531513.html"
        ),
        array(
            'source' => "BÁO TUYÊN QUANG",
            'logo' => get_template_directory_uri() . "/assets/images/logo-haco.png",
            'logoDark' => false,
            'title' => "Màn hình LED hội trường - Công nghệ đột phá trong trải nghiệm sự kiện.",
            'img' => get_template_directory_uri() . "/assets/images/home-solution-audio.webp",
            'url' => "http://baotuyenquang.com.vn/man-hinh-led-hoi-truong-cong-nghe-dot-pha-trong-trai-nghiem-su-kien-177097.html"
        ),
        array(
            'source' => "VIỆT STOCK",
            'logo' => get_template_directory_uri() . "/assets/images/logo-haco.png",
            'logoDark' => false,
            'title' => "HACOLED - Đơn vị thi công màn hình LED uy tín, hỗ trợ bảo hành 24 tháng.",
            'img' => get_template_directory_uri() . "/assets/images/services-indoor.webp",
            'url' => "http://vietstock.vn/2024/02/hacoled-don-vi-thi-cong-man-hinh-led-uy-tin-ho-tro-bao-hanh-24-thang-4511-1158530.htm"
        ),
        array(
            'source' => "BÁO TÂY NINH",
            'logo' => get_template_directory_uri() . "/assets/images/logo-haco.png",
            'logoDark' => false,
            'title' => "Màn hình LED sân khấu nên lắp đặt đơn vị nào uy tín, giá rẻ?",
            'img' => get_template_directory_uri() . "/assets/images/services-outdoor.webp",
            'url' => "http://baotayninh.vn/-man-hinh-led-san-khau-nen-lap-dat-don-vi-nao-uy-tin-gia-re-a160671.html"
        ),
        array(
            'source' => "BÁO QUẢNG NAM",
            'logo' => get_template_directory_uri() . "/assets/images/logobqn.png",
            'logoDark' => false,
            'title' => "HACOLED - Đơn vị thi công màn hình LED số 1 Hà Nội và Sài Gòn.",
            'img' => get_template_directory_uri() . "/assets/images/services-hero.webp",
            'url' => "http://baoquangnam.vn/hacoled-don-vi-thi-cong-man-hinh-led-so-1-ha-noi-va-sai-gon-3050735.html"
        )
    );

    for ($i = 1; $i <= 6; $i++) {
        $source = get_theme_mod("hacoled_press_{$i}_source");
        $logo   = get_theme_mod("hacoled_press_{$i}_logo");
        if (!empty($source) || !empty($logo)) {
            $press_data[] = array(
                'source'   => $source ?: $default_press[$i-1]['source'],
                'logo'     => $logo ?: $default_press[$i-1]['logo'],
                'logoDark' => get_theme_mod("hacoled_press_{$i}_logo_dark", $default_press[$i-1]['logoDark']),
                'title'    => get_theme_mod("hacoled_press_{$i}_title") ?: $default_press[$i-1]['title'],
                'img'      => get_theme_mod("hacoled_press_{$i}_img") ?: $default_press[$i-1]['img'],
                'url'      => get_theme_mod("hacoled_press_{$i}_url") ?: $default_press[$i-1]['url']
            );
        } else {
            $press_data[] = $default_press[$i-1];
        }
    }
}
?>
    <!-- Preload only the first visible hero image. -->
    <?php
    if (!wp_is_mobile()) {
    $hero_slides_preload = array();
    $default_slides_preload = array(
        get_template_directory_uri() . '/assets/images/home-solution-led.webp',
        get_template_directory_uri() . '/assets/images/home-solution-videowall.webp',
        get_template_directory_uri() . '/assets/images/home-solution-audio.webp'
    );
    $slides_string_preload = get_theme_mod('hacoled_hero_slides');
    if (!empty($slides_string_preload)) {
        $hero_slides_preload = array_filter(explode(',', $slides_string_preload));
    }
    if (empty($hero_slides_preload)) {
        for ($i = 1; $i <= 6; $i++) {
            $img_url = get_theme_mod("hacoled_hero_slide_{$i}");
            if (!empty($img_url)) {
                $hero_slides_preload[] = $img_url;
            }
        }
    }
    if (empty($hero_slides_preload)) {
        $hero_slides_preload = $default_slides_preload;
    }
    if (isset($hero_slides_preload[0])) {
        $preload_url = $hero_slides_preload[0];
        $preload_768 = preg_replace('/\.webp(?:\?.*)?$/i', '-768.webp', $preload_url);
        $preload_path = str_replace(get_template_directory_uri(), get_template_directory(), $preload_768);
        if ($preload_768 && is_file($preload_path)) {
            $preload_url = $preload_768;
        }
        echo '<link rel="preload" href="' . esc_url($preload_url) . '" as="image" fetchpriority="high" />';
    }
    }
    ?>

    <!-- Fonts: Được kế thừa từ Header toàn cục của theme -->
    
    <style data-no-optimize="1">
        body { background-color: #FAFAFA; color: #1C0505; }
        /* KHÔNG dùng overflow-x:hidden trên body vì sẽ tạo stacking context mới
           làm vỡ z-index của mobile menu Flatsome (phải ấn 2 lần mới hoạt động) */
    </style>
    <script data-no-optimize="1">
        /* Scroll smooth không can thiệp vào click events */
        document.documentElement.classList.add("scroll-smooth");
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
        'post_status' => 'publish',
        'tax_query' => array(
  array(
      'taxonomy' => 'product_cat',
      'field'    => 'slug',
      'terms'    => $categories,
      'operator' => 'IN',
      'include_children' => true
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

    <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($title); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-600" loading="lazy" decoding="async">

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
  get_template_directory_uri() . "/assets/images/product-led-module.webp",
  get_template_directory_uri() . "/assets/images/product-videowall.webp",
  get_template_directory_uri() . "/assets/images/product-speaker.webp",
  get_template_directory_uri() . "/assets/images/home-solution-led.webp",
  get_template_directory_uri() . "/assets/images/home-solution-videowall.webp",
  get_template_directory_uri() . "/assets/images/home-solution-audio.webp"
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


    <main id="main" class="w-full overflow-clip">

        <!-- SVG Filter Definitions -->
        <!-- feColorMatrix: black→gold, white→transparent -->
        <!-- feComposite operator=in: mask lại alpha gốc, tránh pixel trong suốt bên ngoài bị tô vàng -->
        <svg style="display:none;" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
  <defs>
      <!-- #D4AF37 Metallic Gold cho nền sáng -->
      <filter id="home-to-gold-light" color-interpolation-filters="sRGB">
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
      <filter id="home-to-gold-dark" color-interpolation-filters="sRGB">
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

  .animate-fade-in-up { animation: none; opacity: 1; transform: none; }
  .delay-100, .delay-200, .delay-300, .delay-400 { animation-delay: 0ms; }
  @keyframes heroFadeInUp { to { opacity: 1; transform: translateY(0); } }

  .animate-spin-slow { animation: spinSlow 60s linear infinite; }
  @keyframes spinSlow { to { transform: translate(-50%,-50%) rotate(360deg); } }

  .animate-led-pulse { animation: ledPulse 3s infinite alternate; }
  @keyframes ledPulse {
      0%   { box-shadow: 0 0 10px rgba(220,38,38,0.2), inset 0 0 10px rgba(220,38,38,0.1); }
      100% { box-shadow: 0 0 30px rgba(220,38,38,0.6), inset 0 0 20px rgba(220,38,38,0.3); }
  }
  .perspective-1000 { perspective: 1000px; }

  .hero-float-1, .hero-float-2, .hero-float-3 { animation: none; }
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

        <section id="hero-section" class="relative w-full min-h-[75vh] flex items-center overflow-hidden bg-[#0A0000]" data-tech-bg="particle">

  <!-- Lớp 0: Dynamic Gradient Background -->
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_30%,#4A0404_0%,#0A0000_70%)]"></div>

  <!-- Lớp 1: Ảnh nền mờ -->
  <div class="absolute inset-0 z-0 opacity-[0.08] sm:opacity-[0.12] lg:opacity-[0.15] mix-blend-luminosity">
      <img src="<?php echo esc_url(get_theme_mod('hacoled_hero_bg') ?: get_template_directory_uri() . '/assets/images/services-hero.webp'); ?>"
           alt="Đội ngũ HacoLED" class="w-full h-full object-cover" style="object-position: center 30%;"
           fetchpriority="high" decoding="async"
           data-fallback-src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/services-hero.webp'); ?>">
      <div class="absolute inset-0 bg-gradient-to-r from-[#0A0000] via-[#0A0000]/80 to-transparent"></div>
      <div class="absolute inset-0 bg-gradient-to-t from-[#0A0000] via-transparent to-[#0A0000]/80"></div>
  </div>

  <!-- Lớp 2: Tech Grid -->
  <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff06_1px,transparent_1px),linear-gradient(to_bottom,#ffffff06_1px,transparent_1px)] bg-[size:40px_40px] z-0 pointer-events-none"></div>

  <!-- Ambient Light glows -->
  <div class="absolute top-0 -left-20 w-[600px] h-[600px] bg-brand-red/15 rounded-full blur-[140px] pointer-events-none z-0"></div>
  <div class="absolute -bottom-20 -right-10 w-[700px] h-[700px] bg-brand-gold/10 rounded-full blur-[160px] pointer-events-none z-0"></div>

  <!-- CONTENT -->
  <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10 w-full pt-10 md:pt-28 lg:pt-56 pb-12 md:pb-20">
      <div class="flex flex-col lg:flex-row items-center w-full gap-4 lg:gap-10">

          <!-- CỘT TRÁI: TEXT -->
          <div class="w-full lg:w-[48%] flex flex-col items-start shrink-0">

    <!-- Tagline badge -->
    <div class="animate-fade-in-up inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur border border-[#fbbf24]/30 mb-5 md:mb-7">
        <i class="ph-fill ph-sparkle text-[#fbbf24] text-xs md:text-lg"></i>
        <span class="text-white text-[10px] md:text-xs font-bold uppercase tracking-widest whitespace-nowrap">TIÊN PHONG GIẢI PHÁP HIỂN THỊ</span>
    </div>

    <!-- H1 -->
    <h1 id="hacoled-giai-phap-hien-thi" class="animate-fade-in-up delay-100 text-[32px] md:text-5xl lg:text-[3.5rem] font-bold text-white leading-[1.15] mb-5 md:mb-6 tracking-tight">
        HacoLED – Đối tác tin cậy cho các <br class="hidden lg:block" />
        <span class="relative inline-block mt-2">
            <span class="relative" style="color:#fbbf24">công trình lớn</span>
        </span>
    </h1>

    <!-- Description -->
    <p class="block animate-fade-in-up delay-200 text-gray-300 text-[13px] sm:text-[14px] md:text-lg font-light mb-6 md:mb-10 leading-relaxed max-w-xl">
        Với hàng ngàn dự án toàn quốc, HacoLED cam kết kiến tạo không gian hiển thị đỉnh cao, kết hợp chất lượng tốt nhất với chi phí tối ưu.
    </p>

    <!-- CTA Buttons -->
    <div class="animate-fade-in-up delay-300 flex flex-row items-center gap-3 md:gap-5 w-full sm:w-auto mt-2 md:mt-0 flex-nowrap">
        <a href="#projects" class="relative group flex items-center justify-center gap-1.5 bg-gradient-to-r from-brand-red to-[#990000] text-white px-4 py-2 md:px-6 md:py-3.5 text-[13px] md:text-sm font-bold uppercase tracking-wider rounded-full overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-[0_10px_40px_rgba(204,0,0,0.4)] border border-red-500/30 shrink-0">
  <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-[150%] group-hover:translate-x-[150%] transition-transform duration-700"></span>
  <i class="ph ph-squares-four text-lg md:text-xl"></i>
  <span class="whitespace-nowrap">Xem Công Trình</span>
        </a>
        <a href="#solutions" class="group flex items-center justify-start gap-2 md:gap-3 cursor-pointer text-gray-300 hover:text-white transition-colors w-auto shrink-0">
  <div class="relative w-8 h-8 md:w-11 md:h-11 flex items-center justify-center rounded-full border border-white/20 bg-white/5 backdrop-blur-md group-hover:border-brand-gold group-hover:bg-brand-gold/10 transition-all duration-300 shadow-lg shrink-0">
      <i class="ph-fill ph-play text-xs md:text-sm group-hover:text-brand-gold transition-colors"></i>
      <div class="absolute inset-0 rounded-full border border-brand-gold/0 group-hover:border-brand-gold/40 group-hover:animate-ping"></div>
  </div>
  <span class="font-medium text-[12px] md:text-xs tracking-wider uppercase whitespace-nowrap">Khám phá giải pháp</span>
        </a>
    </div>

    <!-- Value Pillars: Friendly, Fast, Full -->
    <div class="grid grid-cols-1 sm:grid-cols-3 animate-fade-in-up delay-400 items-start sm:items-center gap-3 md:gap-8 mt-7 md:mt-12 pt-6 md:pt-10 border-t border-white/10 w-full max-w-2xl shrink-0">
        <!-- Friendly -->
        <div class="flex items-center gap-3 shrink-0">
            <div class="w-10 h-10 rounded-xl bg-brand-gold/10 border border-brand-gold/20 flex items-center justify-center text-brand-gold shrink-0">
                <i class="ph-fill ph-hand-heart text-lg"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-white uppercase tracking-wider leading-none">Friendly</p>
                <p class="text-[10px] text-gray-400 mt-1">Thân thiện, Tận tâm</p>
            </div>
        </div>
        <!-- Fast -->
        <div class="flex items-center gap-3 shrink-0">
            <div class="w-10 h-10 rounded-xl bg-brand-red/10 border border-brand-red/20 flex items-center justify-center text-brand-red shrink-0">
                <i class="ph-fill ph-lightning text-lg"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-white uppercase tracking-wider leading-none">Fast</p>
                <p class="text-[10px] text-gray-400 mt-1">Nhanh chóng, 24/7</p>
            </div>
        </div>
        <!-- Full -->
        <div class="flex items-center gap-3 shrink-0">
            <div class="w-10 h-10 rounded-xl bg-green-500/10 border border-green-500/20 flex items-center justify-center text-green-400 shrink-0">
                <i class="ph-fill ph-circle-wavy-check text-lg"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-white uppercase tracking-wider leading-none">Full</p>
                <p class="text-[10px] text-gray-400 mt-1">Trọn vẹn, Đầy đủ pháp lý</p>
            </div>
        </div>
    </div>
          </div>

          <!-- CỘT PHẢI: GALLERY 3D COVERFLOW (Giống chi tiết sản phẩm) -->
          <div class="flex w-full lg:w-[52%] flex-col justify-center relative select-none animate-fade-in-up delay-400">
              <?php
              $hero_slides = array();
              $default_slides = array(
                  get_template_directory_uri() . '/assets/images/home-solution-led.webp',
                  get_template_directory_uri() . '/assets/images/home-solution-videowall.webp',
                  get_template_directory_uri() . '/assets/images/home-solution-audio.webp'
              );

              $slides_string = get_theme_mod('hacoled_hero_slides');
              if (!empty($slides_string)) {
                  $hero_slides = array_filter(explode(',', $slides_string));
              }
              if (empty($hero_slides)) {
                  for ($i = 1; $i <= 6; $i++) {
                      $img_url = get_theme_mod("hacoled_hero_slide_{$i}");
                      if (!empty($img_url)) {
                          $hero_slides[] = $img_url;
                      }
                  }
              }
              if (empty($hero_slides)) {
                  $hero_slides = $default_slides;
              }
              $total_slides = count($hero_slides);
              $initial_slide = 0;
              ?>
              
              <style>
                  /* Ghi đè CSS Swiper của Hero: tỉ lệ 4:3, sát lề phải trên desktop, tự động căn giữa và bám lề 2 bên trên mobile */
                  .hero-main-swiper {
                      margin-right: auto !important;
                      margin-left: auto !important;
                      overflow: visible !important;
                      -webkit-mask-image: none !important;
                      mask-image: none !important;
                      width: 100% !important;
                      max-width: 100% !important;
                      height: auto !important;
                  }
                  .hero-main-swiper.sp-3d-container {
                      padding-top: 0 !important;
                      padding-bottom: 24px !important; /* Giảm khoảng trống phía dưới trên mobile */
                  }
                  .hero-main-swiper .sp-3d-slide {
                      border: 1px solid rgba(255, 255, 255, 0.15) !important;
                      box-shadow: none !important;
                      border-radius: 16px !important;
                      width: 100% !important;
                      height: auto !important;
                      aspect-ratio: 4/3 !important; /* Tỉ lệ 4:3 bám sát lề 2 bên */
                  }
                  @media (min-width: 640px) {
                      .hero-main-swiper {
                          max-width: 480px !important;
                      }
                  }
                  @media (min-width: 1024px) {
                      .hero-main-swiper {
                          margin-right: 0 !important;
                          margin-left: auto !important;
                          width: 480px !important;
                          max-width: 480px !important;
                          height: 360px !important;
                      }
                      .hero-main-swiper.sp-3d-container {
                          padding-top: 16px !important;
                          padding-bottom: 56px !important; /* Phục hồi padding trên desktop cho nút và dots */
                      }
                      .hero-main-swiper .sp-3d-slide {
                          width: 480px !important;
                          height: 360px !important;
                          aspect-ratio: auto !important;
                      }
                  }
                  @media (min-width: 1280px) {
                      .hero-main-swiper {
                          width: 600px !important;
                          max-width: 600px !important;
                          height: 450px !important;
                      }
                      .hero-main-swiper .sp-3d-slide {
                          width: 600px !important;
                          height: 450px !important;
                          aspect-ratio: auto !important;
                      }
                  }
                  @media (min-width: 1440px) {
                      .hero-main-swiper {
                          width: 720px !important;
                          max-width: 720px !important;
                          height: 540px !important;
                      }
                      .hero-main-swiper .sp-3d-slide {
                          width: 720px !important;
                          height: 540px !important;
                          aspect-ratio: auto !important;
                      }
                  }
                  .hero-main-swiper,
                  .hero-main-swiper .swiper-wrapper,
                  .hero-main-swiper .swiper-slide,
                  .hero-main-swiper .swiper-slide * {
                      transition: none !important;
                      animation: none !important;
                  }
                  .hero-main-swiper:not(.swiper-initialized) .swiper-wrapper {
                      display: block !important;
                      transform: none !important;
                      width: 100% !important;
                      height: 100% !important;
                  }
                  .hero-main-swiper:not(.swiper-initialized) .sp-3d-slide {
                      display: none !important;
                      opacity: 1 !important;
                      transform: none !important;
                      filter: none !important;
                      backdrop-filter: none !important;
                  }
                  .hero-main-swiper:not(.swiper-initialized) .sp-3d-slide.is-hero-primary {
                      display: block !important;
                      filter: none !important;
                      backdrop-filter: none !important;
                  }
                  .hero-main-swiper .swiper-slide-active {
                      border: 1px solid rgba(251, 191, 36, 0.5) !important; /* Golden subtle border for active slide */
                      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5) !important;
                  }
                  /* Nút mũi tên ẩn trên mobile/tablet và chỉ hiển thị trên desktop */
                  .hero-main-swiper .sp-3d-prev,
                  .hero-main-swiper .sp-3d-next {
                      display: none !important;
                      opacity: 1 !important;
                      visibility: visible !important;
                      transform: translateY(-50%) !important;
                      transition: none !important;
                  }
                  @media (min-width: 1024px) {
                      .hero-main-swiper .sp-3d-prev,
                      .hero-main-swiper .sp-3d-next {
                          display: flex !important;
                      }
                  }
                  .hero-main-swiper .sp-3d-prev {
                      left: -60px !important;
                  }
                  .hero-main-swiper .sp-3d-next {
                      right: -60px !important;
                  }
                  .hero-main-swiper .sp-3d-prev,
                  .hero-main-swiper .sp-3d-next,
                  .hero-main-swiper .sp-3d-pagination {
                      display: none !important;
                  }
                  /* Không cần hover hiệu ứng transform/nổi lên */
                  .hero-main-swiper .sp-3d-prev:hover,
                  .hero-main-swiper .sp-3d-next:hover {
                      transform: translateY(-50%) !important;
                      background-color: rgba(255, 255, 255, 0.95) !important;
                      color: #1a1a1a !important;
                  }
              </style>

              <!-- Main 3D Coverflow Slider -->
              <div class="swiper hero-main-swiper sp-3d-gallery sp-3d-container !pt-4 !pb-14">
                  <div class="swiper-wrapper">
                      <?php 
                      $slide_idx = 0;
                      foreach ($hero_slides as $slide_img): 
                          $is_initial = ($slide_idx === $initial_slide);
                          $priority = $is_initial ? 'fetchpriority="high" decoding="sync"' : '';
                          $loading = $is_initial ? '' : 'loading="lazy" fetchpriority="low"';
                          $slide_idx++;
                      ?>
                      <div class="swiper-slide sp-3d-slide group relative <?php echo $is_initial ? 'is-hero-primary' : ''; ?>">
                          <img src="<?php echo esc_url($slide_img); ?>" 
                               data-fallback-src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/services-hero.webp'); ?>"
                               class="w-full h-full object-cover" 
                               alt="<?php echo esc_attr('Không gian trình chiếu HacoLED ' . $slide_idx); ?>" 
                               <?php echo $priority; ?>
                               <?php echo $loading; ?>
                               sizes="(max-width: 767px) 100vw, 50vw"
                               <?php echo $is_initial ? '' : 'decoding="async"'; ?>>
                          <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                      </div>
                      <?php endforeach; ?>
                  </div>
                  <!-- Controls -->
                  <div class="swiper-button-prev sp-3d-prev"></div>
                  <div class="swiper-button-next sp-3d-next"></div>
                  <!-- Pagination -->
                  <div class="swiper-pagination sp-3d-pagination mt-4 relative bottom-0"></div>
              </div>
          </div>

      </div>
  </div>
        </section>

        <?php $this->renderComponent('home/solutions'); ?>

        <!-- ========================================== -->
        <!-- SECTION: ĐỐI TÁC (HOOK)                   -->
        <!-- ========================================== -->
        <section class="py-6 md:py-12 border-y border-gray-200 bg-transparent relative overflow-hidden">
            <style>
                .partner-slider .swiper-wrapper {
                    display: flex !important;
                    flex-direction: row !important;
                    flex-wrap: wrap !important;
                    justify-content: center !important;
                    align-items: center !important;
                    gap: 0.75rem !important;
                    -webkit-transition-timing-function: linear !important;
                    transition-timing-function: linear !important;
                }
                .partner-slider .swiper-slide {
                    width: auto !important;
                    flex: 0 0 auto !important;
                }
                /* Horizontal Scroll Slider layout for Product Cards */
                .product-slider-wrapper {
                    overflow: visible !important;
                }
                .product-swiper {
                    display: block !important;
                    overflow-x: auto !important;
                    scroll-behavior: smooth !important;
                    scroll-snap-type: x mandatory !important;
                    scrollbar-width: none !important;
                    -ms-overflow-style: none !important;
                    padding-top: 12px !important;
                    padding-bottom: 16px !important;
                    margin-top: 0 !important;
                    margin-bottom: 0 !important;
                }
                .product-swiper::-webkit-scrollbar {
                    display: none !important;
                }
                .product-swiper .swiper-wrapper {
                    display: flex !important;
                    flex-direction: row !important;
                    flex-wrap: nowrap !important;
                    gap: 1.25rem !important;
                    width: max-content !important;
                    min-width: 100% !important;
                    padding-top: 0.5rem !important;
                    padding-bottom: 0.5rem !important;
                }
                .product-swiper .swiper-slide {
                    flex: 0 0 auto !important;
                    width: 82vw !important;
                    max-width: 320px !important;
                    scroll-snap-align: start !important;
                }
                @media (min-width: 640px) {
                    .product-swiper .swiper-slide {
                        width: calc(50% - 0.65rem) !important;
                        max-width: 360px !important;
                    }
                }
                @media (min-width: 1024px) {
                    .product-swiper .swiper-slide {
                        width: calc(25% - 0.95rem) !important;
                        max-width: 350px !important;
                    }
                }
            </style>
            <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10">
                <div class="text-center mb-6 md:mb-10 fade-up">
                    <div class="inline-flex items-center gap-2 px-3 py-1 md:px-4 md:py-1.5 rounded-full bg-brand-red/10 border border-brand-red/20 mb-3">
                        <i class="ph-fill ph-handshake text-brand-red text-xs md:text-lg"></i>
                        <span class="text-brand-red text-[10px] md:text-xs font-bold uppercase tracking-widest whitespace-nowrap">ĐỐI TÁC CHIẾN LƯỢC</span>
                    </div>
                    <h2 id="doi-tac-hacoled" class="text-xl md:text-4xl lg:text-5xl font-extrabold text-slate-800 uppercase tracking-tight mb-3">Đồng Hành Thương Hiệu</h2>
                </div>
                <div class="swiper partner-slider fade-up">
                    <div class="swiper-wrapper items-center">
                        <?php 
                        $partners = ['Samsung', 'LG', 'Panasonic', 'Sony', 'BOE', 'Novastar', 'Kystar', 'Absen'];
                        foreach($partners as $partner): ?>
                        <div class="swiper-slide px-1 md:px-2">
                            <div class="h-10 md:h-16 max-w-[100px] md:max-w-[160px] mx-auto bg-gray-50/50 border border-gray-100 rounded-lg md:rounded-xl flex items-center justify-center grayscale hover:grayscale-0 hover:bg-white hover:border-brand-red/20 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                <span class="text-gray-400 font-black text-xs md:text-lg tracking-widest uppercase"><?php echo $partner; ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================== -->
        <!-- SECTION: DANH MỤC SẢN PHẨM              -->
        <!-- ========================================== -->
        <?php
        // Product categories config
        $product_sections = array(
            array(
                'slugs'  => array('man-hinh-led'),
                'label'  => 'Màn hình LED',
                'desc'   => 'Giải pháp hiển thị đỉnh cao với công nghệ LED tiên tiến, mang lại hình ảnh sắc nét và rực rỡ cho mọi không gian, từ hội trường đến sân khấu ngoài trời.',
                'icon'   => 'ph-fill ph-monitor-play',
                'link'   => home_url('/danh-muc-san-pham/man-hinh-led/'),
                'limit'  => 8,
                'cols'   => 'lg:grid-cols-4'
            ),
            array(
                'slugs'  => array('am-thanh'),
                'label'  => 'Âm thanh & Ánh sáng',
                'desc'   => 'Hệ thống âm thanh ánh sáng chuyên nghiệp, tối ưu hóa trải nghiệm nghe nhìn cho các sự kiện, hội trường, phòng hát với các thương hiệu quốc tế.',
                'icon'   => 'ph-fill ph-speaker-hifi',
                'link'   => home_url('/danh-muc-san-pham/am-thanh/'),
                'limit'  => 8,
                'cols'   => 'lg:grid-cols-4'
            ),
            array(
                'slugs'  => array('man-hinh-ghep'),
                'label'  => 'Màn hình ghép',
                'desc'   => 'Màn hình ghép viền siêu mỏng, hoạt động bền bỉ 24/7, phù hợp cho các phòng điều hành, phòng họp trực tuyến và trung tâm thương mại hiện đại.',
                'icon'   => 'ph-fill ph-squares-four',
                'link'   => home_url('/danh-muc-san-pham/man-hinh-ghep/'),
                'limit'  => 8,
                'cols'   => 'lg:grid-cols-4'
            ),
        );

        foreach ($product_sections as $sec_idx => $section) :
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => $section['limit'],
                'post_status'    => 'publish',
                'tax_query'      => array(
                    array(
                        'taxonomy'         => 'product_cat',
                        'field'            => 'slug',
                        'terms'            => $section['slugs'],
                        'operator'         => 'IN',
                        'include_children' => true,
                    ),
                ),
            );
            $product_query = new WP_Query($args);
            if (!$product_query->have_posts()) {
                // Smart fallback: If specific category slug has no products, fetch latest WooCommerce products
                $fallback_args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => $section['limit'],
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                );
                $product_query = new WP_Query($fallback_args);
            }
        ?>
        <section id="category-<?php echo esc_attr($section['slugs'][0]); ?>" class="py-6 md:py-20 relative overflow-visible" style="background: transparent;">
            <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10">
                
                <!-- Section Header with View All inline -->
                <div class="flex items-center md:items-end justify-between mb-6 md:mb-14 fade-up">
                    <div class="text-left max-w-[80%] md:max-w-3xl">
                        <div class="flex items-center gap-3 mb-0 md:mb-3">
                            <div class="inline-flex items-center justify-center w-10 h-10 md:w-12 md:h-12 bg-brand-red/10 rounded-xl text-brand-red shadow-sm border border-brand-red/20 shrink-0">
                                <i class="<?php echo esc_attr($section['icon']); ?> text-lg md:text-xl"></i>
                            </div>
                            <h2 id="<?php echo esc_attr('san-pham-' . sanitize_title($section['label'])); ?>" class="text-xl md:text-3xl lg:text-4xl font-extrabold uppercase tracking-tight text-brand-text mb-0"><?php echo esc_html($section['label']); ?></h2>
                        </div>
                        <p class="text-brand-muted text-xs md:text-sm leading-relaxed mt-2 md:mt-0 mb-0"><?php echo esc_html($section['desc']); ?></p>
                    </div>
                    <div>
                        <!-- View All: Icon only on mobile, text + icon on desktop -->
                        <a href="<?php echo esc_url($section['link']); ?>" class="inline-flex items-center justify-center min-h-10 px-3 md:px-5 md:py-2.5 border-2 border-brand-red text-brand-red hover:bg-brand-red hover:text-white rounded-full transition-all text-[10px] md:text-sm font-bold uppercase tracking-wider group shrink-0" aria-label="<?php echo esc_attr('Xem tất cả ' . $section['label']); ?>">
                            <span class="mr-1.5">Xem tất cả <span class="hidden sm:inline"><?php echo esc_html($section['label']); ?></span></span>
                            <i class="ph-bold ph-arrow-right text-sm md:text-base group-hover:translate-x-0.5 transition-transform"></i>
                        </a>
                    </div>
                </div>

                <?php if ($product_query->have_posts()) : ?>
                <div class="product-slider-wrapper relative group/slider mt-4 md:mt-8">
                    <div class="swiper product-swiper py-3 !overflow-visible">
                        <div class="swiper-wrapper">
                            <?php
                            while ($product_query->have_posts()) :
                                $product_query->the_post();
                                global $product;
                                $terms = get_the_terms(get_the_ID(), 'product_cat');
                                $category_name = (!empty($terms) && !is_wp_error($terms)) ? $terms[0]->name : $section['label'];
                                
                                echo '<div class="swiper-slide h-auto">';
                                $this->renderComponent('product-card', [
                                    'title'       => get_the_title(),
                                    'description' => $product->get_short_description() ?: get_the_excerpt(),
                                    'permalink'   => get_permalink(),
                                    'thumbnail'   => get_the_post_thumbnail_url(get_the_ID(), 'large') ?: '',
                                    'price'       => $product->get_price_html() ?: __('Liên hệ', 'hacoled'),
                                    'category'    => $category_name,
                                ]);
                                echo '</div>';
                            endwhile;
                            ?>
                        </div>
                    </div>
                    <!-- Navigation Buttons -->
                    <button class="custom-swiper-prev absolute top-1/2 -translate-y-1/2 -left-2 md:-left-6 w-10 h-10 md:w-12 md:h-12 bg-white text-gray-800 rounded-full shadow-lg border border-gray-100 flex items-center justify-center hover:bg-brand-red hover:text-white hover:border-brand-red hover:scale-110 hover:shadow-[0_8px_25px_rgba(204,0,0,0.3)] transition-all duration-300 z-20 opacity-80 md:opacity-0 group-hover/slider:opacity-100 -translate-x-1 md:-translate-x-4 group-hover/slider:translate-x-0 disabled:opacity-20 disabled:hover:bg-white disabled:hover:text-gray-800 disabled:hover:scale-100 disabled:cursor-not-allowed" aria-label="Previous slide">
                        <i class="ph-bold ph-caret-left text-lg md:text-xl"></i>
                    </button>
                    <button class="custom-swiper-next absolute top-1/2 -translate-y-1/2 -right-2 md:-right-6 w-10 h-10 md:w-12 md:h-12 bg-white text-gray-800 rounded-full shadow-lg border border-gray-100 flex items-center justify-center hover:bg-brand-red hover:text-white hover:border-brand-red hover:scale-110 hover:shadow-[0_8px_25px_rgba(204,0,0,0.3)] transition-all duration-300 z-20 opacity-80 md:opacity-0 group-hover/slider:opacity-100 translate-x-1 md:translate-x-4 group-hover/slider:translate-x-0 disabled:opacity-20 disabled:hover:bg-white disabled:hover:text-gray-800 disabled:hover:scale-100 disabled:cursor-not-allowed" aria-label="Next slide">
                        <i class="ph-bold ph-caret-right text-lg md:text-xl"></i>
                    </button>
                </div>
                <?php else : ?>
                <!-- Empty state -->
                <div class="product-slider-wrapper relative group/slider mt-4 md:mt-8 opacity-80 grayscale-[20%]">
                    <div class="swiper product-swiper py-3 !overflow-visible">
                        <div class="swiper-wrapper">
                            <?php
                            for ($i = 1; $i <= $section['limit']; $i++) {
                                echo '<div class="swiper-slide h-auto">';
                                $this->renderComponent('product-card', [
                                    'title'       => 'Sản phẩm Demo ' . $i,
                                    'description' => 'Đây là sản phẩm demo để bạn xem trước bố cục thiết kế.',
                                    'permalink'   => $section['link'],
                                    'thumbnail'   => get_template_directory_uri() . '/assets/images/product-led-module.webp',
                                    'price'       => 'Liên hệ',
                                    'category'    => $section['label'],
                                ]);
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <?php 
            wp_reset_postdata();
        endforeach; 
        ?>

        <!-- ========================================== -->
        <!-- SECTION 7 & 8: UY TÍN & CAM KẾT          -->
        <!-- ========================================== -->
        <section class="py-10 sm:py-12 md:py-16 lg:py-20 relative overflow-hidden bg-transparent" aria-labelledby="uy-tin-hacoled">
            <div class="max-w-[1360px] mx-auto px-4 sm:px-6 lg:px-8">
                <?php $partners = ['Viettel', 'FPT', 'EVN', 'Vingroup', 'Masterise', 'BRG']; ?>

                <!-- Section heading -->
                <div class="grid lg:grid-cols-[minmax(0,1fr)_auto] lg:items-end gap-6 mb-8 md:mb-10">
                    <div class="max-w-4xl">
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-red/10 border border-brand-red/20 mb-4">
                            <i class="ph-fill ph-medal text-brand-red text-sm"></i>
                            <span class="text-brand-red text-[11px] md:text-xs font-black uppercase tracking-[0.16em]">Năng lực & Uy tín</span>
                        </div>
                        <h2 id="uy-tin-hacoled" class="text-3xl sm:text-4xl lg:text-5xl font-black uppercase tracking-[-0.035em] text-brand-text leading-[1.04] mb-4">
                            Uy tín <span class="text-brand-red">tạo nên thương hiệu</span>
                        </h2>
                        <p class="max-w-3xl text-sm md:text-base text-brand-muted leading-relaxed">
                            Đối tác của <strong class="text-brand-text">Viettel, FPT, EVN, Vingroup, Masterise, BRG</strong> và hàng trăm tập đoàn hàng đầu Việt Nam.
                        </p>
                    </div>

                    <div class="flex flex-wrap lg:justify-end gap-2 max-w-xl" aria-label="Đối tác tiêu biểu">
                        <?php foreach ($partners as $partner): ?>
                            <span class="px-3 py-1.5 rounded-full bg-white border border-slate-200 text-[11px] md:text-xs font-bold text-slate-600 shadow-sm">
                                <?php echo esc_html($partner); ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- ══════════════════════════════════════════════════ -->
                <!--  Luxury Split Showcase Card                       -->
                <!-- ══════════════════════════════════════════════════ -->
                <div class="relative">

                    <!-- Top Gold Gradient Accent Line -->
                    <div class="hidden"></div>

                    <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,0.61fr)_minmax(380px,0.39fr)] gap-5 lg:gap-6 lg:h-[500px] xl:h-[520px]">

                        <!-- ─────────────────────────────── -->
                        <!--  LEFT: Content, Partner Chips & 3F -->
                        <!-- ─────────────────────────────── -->
                        <div class="lg:order-2 relative overflow-hidden rounded-[24px] lg:rounded-[28px] px-6 py-7 sm:px-8 sm:py-8 lg:px-8 lg:py-7 xl:px-9 xl:py-8 flex flex-col justify-between bg-gradient-to-br from-[#b41018] via-[#8b080e] to-[#5d0307] shadow-[0_22px_55px_-28px_rgba(126,7,13,0.8)] border border-[#79080d]">

                            <!-- Dong Son Drum Watermark -->
                            <div class="absolute top-1/2 -translate-y-1/2 right-[-130px] w-[520px] h-[520px] lg:w-[620px] lg:h-[620px] bg-no-repeat bg-contain bg-center pointer-events-none mix-blend-screen opacity-[0.13] z-0"
                                 style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/dongson-optimized.webp'); filter: invert(80%) sepia(30%) saturate(1400%) hue-rotate(345deg) brightness(110%);">
                            </div>

                            <!-- Ambient Glow Accents -->
                            <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff07_1px,transparent_1px),linear-gradient(to_bottom,#ffffff07_1px,transparent_1px)] bg-[size:36px_36px] pointer-events-none z-0"></div>
                            <div class="absolute -top-24 -left-24 w-72 h-72 bg-red-400/20 rounded-full blur-3xl pointer-events-none z-0"></div>
                            <div class="absolute -bottom-24 right-0 w-72 h-72 bg-amber-400/10 rounded-full blur-3xl pointer-events-none z-0"></div>

                            <!-- Top Content Block -->
                            <div class="relative z-10">

                                <!-- Eyebrow Badge -->
                                <div class="hidden inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/[0.08] border border-white/50 backdrop-blur-md mb-3">
                                    <i class="ph-fill ph-medal text-amber-300 text-xs sm:text-sm"></i>
                                    <span class="text-amber-300 text-[11px] sm:text-xs font-black uppercase tracking-widest whitespace-nowrap">Năng Lực & Uy Tín</span>
                                </div>

                                <!-- Main Heading -->
                                <h3 class="hidden text-[30px] sm:text-4xl lg:text-[36px] xl:text-[40px] font-black uppercase tracking-[-0.03em] text-white mb-3 leading-[1.02]">
                                    Uy Tín<br class="hidden sm:block">
                                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#ffe57f] via-[#fbbf24] to-[#fff8e1] drop-shadow-sm">Tạo Nên Thương Hiệu</span>
                                </h3>

                                <!-- Partner Chips Row -->
                                <div class="hidden mb-4 pl-3 border-l-2 border-amber-300/70">
                                    <p class="text-xs sm:text-[13px] text-white/80 leading-relaxed mb-2">Đối tác của <strong class="text-white">Viettel, FPT, EVN, Vingroup, Masterise, BRG</strong> và hàng trăm tập đoàn hàng đầu Việt Nam.</p>
                                    <div class="flex flex-wrap gap-1.5" aria-label="Đối tác tiêu biểu">
                                        <?php
                                        $partners = ['Viettel', 'FPT', 'EVN', 'Vingroup', 'Masterise', 'BRG'];
                                        foreach ($partners as $partner):
                                        ?>
                                            <span class="px-2.5 py-1 rounded-full bg-black/20 border border-white/15 text-[10px] sm:text-[11px] font-bold text-white/75 backdrop-blur-md">
                                                <?php echo $partner; ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <div class="mb-5">
                                    <p class="text-amber-300 text-[11px] font-black uppercase tracking-[0.18em] mb-2">Chuẩn dịch vụ HacoLED</p>
                                    <h3 class="text-2xl sm:text-3xl font-black text-white tracking-tight">Cam kết phục vụ 3F</h3>
                                    <p class="text-xs sm:text-sm text-white/70 mt-1.5 leading-relaxed">Đồng hành xuyên suốt từ tư vấn, triển khai đến bảo hành vận hành.</p>
                                </div>

                                <!-- 3F Feature Glass Cards -->
                                <div class="space-y-2">

                                    <div class="group flex items-center gap-3.5 p-3 rounded-xl bg-white/[0.07] backdrop-blur-xl border border-white/15 hover:border-amber-300/55 hover:bg-white/[0.11] transition-all duration-300">
                                        <div class="w-10 h-10 shrink-0 rounded-lg bg-amber-300 text-[#6c080d] flex items-center justify-center shadow-[0_6px_18px_rgba(251,191,36,0.2)] group-hover:-translate-y-0.5 transition-transform duration-300">
                                            <i class="ph-fill ph-users text-lg sm:text-xl"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between">
                                            <p class="text-sm sm:text-base font-bold text-white tracking-wide group-hover:text-[#fbbf24] transition-colors">Friendly</p>
                                                <i class="ph-bold ph-check-circle text-xs text-amber-400/60 group-hover:text-amber-400 transition-colors"></i>
                                            </div>
                                            <p class="text-xs sm:text-[13px] text-white/75 leading-snug mt-0.5">Đội ngũ tận tâm, nhiệt tình, hỗ trợ kỹ thuật 24/7.</p>
                                        </div>
                                    </div>

                                    <div class="group flex items-center gap-3.5 p-3 rounded-xl bg-white/[0.07] backdrop-blur-xl border border-white/15 hover:border-amber-300/55 hover:bg-white/[0.11] transition-all duration-300">
                                        <div class="w-10 h-10 shrink-0 rounded-lg bg-amber-300 text-[#6c080d] flex items-center justify-center shadow-[0_6px_18px_rgba(251,191,36,0.2)] group-hover:-translate-y-0.5 transition-transform duration-300">
                                            <i class="ph-fill ph-lightning text-lg sm:text-xl"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between">
                                            <p class="text-sm sm:text-base font-bold text-white tracking-wide group-hover:text-[#fbbf24] transition-colors">Fast</p>
                                                <i class="ph-bold ph-check-circle text-xs text-amber-400/60 group-hover:text-amber-400 transition-colors"></i>
                                            </div>
                                            <p class="text-xs sm:text-[13px] text-white/75 leading-snug mt-0.5">Phản hồi tức thì, xử lý & khắc phục sự cố tốc độ.</p>
                                        </div>
                                    </div>

                                    <div class="group flex items-center gap-3.5 p-3 rounded-xl bg-white/[0.07] backdrop-blur-xl border border-white/15 hover:border-amber-300/55 hover:bg-white/[0.11] transition-all duration-300">
                                        <div class="w-10 h-10 shrink-0 rounded-lg bg-amber-300 text-[#6c080d] flex items-center justify-center shadow-[0_6px_18px_rgba(251,191,36,0.2)] group-hover:-translate-y-0.5 transition-transform duration-300">
                                            <i class="ph-fill ph-shield-check text-lg sm:text-xl"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between">
                                            <p class="text-sm sm:text-base font-bold text-white tracking-wide group-hover:text-[#fbbf24] transition-colors">Full</p>
                                                <i class="ph-bold ph-check-circle text-xs text-amber-400/60 group-hover:text-amber-400 transition-colors"></i>
                                            </div>
                                            <p class="text-xs sm:text-[13px] text-white/75 leading-snug mt-0.5">Dịch vụ trọn gói, pháp lý chuẩn mực, bảo hành lâu dài.</p>
                                        </div>
                                    </div>

                                </div><!-- /3F Glass Cards -->
                            </div>

                            <!-- Bottom Metrics Counter Bar -->
                            <div class="relative z-10 mt-4 pt-3 border-t border-white/15">
                                <div class="grid grid-cols-3 gap-2 text-center">
                                    <div class="py-2 px-1 rounded-xl bg-black/15 border border-white/10">
                                        <p class="text-base sm:text-xl font-extrabold text-amber-300 leading-none">10+</p>
                                        <p class="text-[9px] sm:text-[10px] font-bold text-white/70 uppercase tracking-wider mt-1">Năm Uy Tín</p>
                                    </div>
                                    <div class="py-2 px-1 rounded-xl bg-black/15 border border-white/10">
                                        <p class="text-base sm:text-xl font-extrabold text-amber-300 leading-none">1,500+</p>
                                        <p class="text-[9px] sm:text-[10px] font-bold text-white/70 uppercase tracking-wider mt-1">Dự Án LED</p>
                                    </div>
                                    <div class="py-2 px-1 rounded-xl bg-black/15 border border-white/10">
                                        <p class="text-base sm:text-xl font-extrabold text-amber-300 leading-none">24 T.</p>
                                        <p class="text-[9px] sm:text-[10px] font-bold text-white/70 uppercase tracking-wider mt-1">Bảo Hành Vàng</p>
                                    </div>
                                </div>
                            </div>

                        </div><!-- /LEFT -->

                        <!-- ─────────────────────────────────── -->
                        <!--  RIGHT: Rounded Bento Media Gallery -->
                        <!-- ─────────────────────────────────── -->
                        <div class="lg:order-1 w-full h-[360px] sm:h-[440px] lg:h-full relative overflow-hidden rounded-[24px] lg:rounded-[28px] bg-[#160607] p-2 sm:p-2.5 shadow-[0_22px_55px_-28px_rgba(15,23,42,0.7)] border border-slate-900/20">
                            <?php
                            $prestige_images = [
                                0 => [
                                    'url'     => get_theme_mod('hacoled_prestige_img_a') ?: get_template_directory_uri() . '/assets/images/services-hero.webp',
                                    'caption' => 'Dự án tiêu biểu - Thi công màn hình LED cao cấp',
                                    'grid'    => 'grid-column:1/3;grid-row:1/3;',
                                    'is_hero' => true
                                ],
                                1 => [
                                    'url'     => get_theme_mod('hacoled_prestige_img_b') ?: get_template_directory_uri() . '/assets/images/home-solution-led.webp',
                                    'caption' => 'Giải pháp màn hình LED phòng họp & hội trường',
                                    'grid'    => 'grid-column:3;grid-row:1;',
                                    'is_hero' => false
                                ],
                                2 => [
                                    'url'     => get_theme_mod('hacoled_prestige_img_c') ?: get_template_directory_uri() . '/assets/images/home-solution-videowall.webp',
                                    'caption' => 'Màn hình ghép Video Wall hiện đại',
                                    'grid'    => 'grid-column:4;grid-row:1;',
                                    'is_hero' => false
                                ],
                                3 => [
                                    'url'     => get_theme_mod('hacoled_prestige_img_d') ?: get_template_directory_uri() . '/assets/images/home-solution-audio.webp',
                                    'caption' => 'Hệ thống điều khiển & âm thanh ánh sáng',
                                    'grid'    => 'grid-column:3;grid-row:2;',
                                    'is_hero' => false
                                ],
                                4 => [
                                    'url'     => get_theme_mod('hacoled_prestige_img_e') ?: get_template_directory_uri() . '/assets/images/services-indoor.webp',
                                    'caption' => 'Lắp đặt màn hình LED trong nhà (Indoor)',
                                    'grid'    => 'grid-column:4;grid-row:2;',
                                    'is_hero' => false
                                ],
                                5 => [
                                    'url'     => get_theme_mod('hacoled_prestige_img_f') ?: get_template_directory_uri() . '/assets/images/services-outdoor.webp',
                                    'caption' => 'Thi công màn hình LED ngoài trời (Outdoor) cỡ lớn',
                                    'grid'    => 'grid-column:1;grid-row:3;',
                                    'is_hero' => false
                                ],
                                6 => [
                                    'url'     => get_theme_mod('hacoled_prestige_img_g') ?: get_template_directory_uri() . '/assets/images/services-audio.webp',
                                    'caption' => 'Sân khấu & sự kiện quy mô lớn',
                                    'grid'    => 'grid-column:2;grid-row:3;',
                                    'is_hero' => false
                                ],
                                7 => [
                                    'url'     => get_theme_mod('hacoled_prestige_img_h') ?: get_template_directory_uri() . '/assets/images/services-blueprint.webp',
                                    'caption' => 'Bản vẽ kỹ thuật & thi công trọn gói chuẩn mực',
                                    'grid'    => 'grid-column:3/5;grid-row:3;',
                                    'is_hero' => false
                                ],
                            ];
                            ?>

                            <div class="hacoled-prestige-grid h-full w-full grid grid-cols-4 grid-rows-2 gap-2 sm:gap-2.5">
                                <?php foreach ($prestige_images as $idx => $img): ?>
                                    <?php if ($idx > 4) continue; ?>
                                    <button type="button"
                                         onclick="openPrestigeLightbox(<?php echo $idx; ?>)"
                                         aria-label="<?php echo esc_attr($img['caption']); ?>"
                                         style="<?php echo $img['grid']; ?>"
                                         class="group relative overflow-hidden rounded-lg sm:rounded-xl cursor-zoom-in select-none bg-slate-900 border border-white/10 hover:border-[#fbbf24]/70 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#fbbf24] focus-visible:ring-offset-2 focus-visible:ring-offset-[#160607] transition-all duration-300 shadow-md">

                                        <!-- Image -->
                                        <img loading="lazy" decoding="async" sizes="(max-width: 1024px) 50vw, 30vw"
                                             src="<?php echo esc_url($img['url']); ?>"
                                             alt="<?php echo esc_attr($img['caption']); ?>"
                                             class="w-full h-full object-cover block transition-transform duration-700 ease-out group-hover:scale-110">

                                        <!-- Hover Gradient Overlay & Zoom Icon -->
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/5 to-transparent opacity-0 group-hover:opacity-100 group-focus-visible:opacity-100 transition-opacity duration-300 flex items-center justify-center p-3">
                                            <div class="w-11 h-11 rounded-full bg-white/20 backdrop-blur-md border border-white/60 text-white flex items-center justify-center transform scale-75 group-hover:scale-100 group-focus-visible:scale-100 transition-all duration-300 shadow-2xl">
                                                <i class="ph-bold ph-arrows-out-simple text-lg"></i>
                                            </div>
                                        </div>

                                        <?php if ($img['is_hero']): ?>
                                            <!-- Hero Badge -->
                                            <div class="absolute bottom-2.5 left-2.5 sm:bottom-3.5 sm:left-3.5 flex items-center gap-2 pointer-events-none z-10">
                                                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-black/60 backdrop-blur-md border border-[#fbbf24]/50 shadow-lg">
                                                    <span class="w-2 h-2 rounded-full bg-[#fbbf24] shadow-[0_0_8px_#fbbf24] animate-pulse"></span>
                                                    <span class="text-[9px] sm:text-xs font-black text-white uppercase tracking-wider">Dự án tiêu biểu</span>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($idx === 7): ?>
                                            <!-- Blueprint Special Badge Overlay -->
                                            <div class="absolute inset-0 bg-gradient-to-r from-[#d4af37]/20 via-transparent to-black/40 pointer-events-none"></div>
                                            <div class="absolute bottom-2 left-2 pointer-events-none z-10">
                                                <span class="px-2 py-0.5 rounded bg-black/70 backdrop-blur border border-amber-400/40 text-[9px] font-bold text-amber-300 uppercase tracking-widest">
                                                    Chuẩn Kỹ Thuật
                                                </span>
                                            </div>
                                        <?php endif; ?>
                                    </button>
                                <?php endforeach; ?>
                            </div><!-- /grid -->
                        </div><!-- /RIGHT -->

                    </div><!-- /split flex -->
                </div><!-- /card -->
            </div><!-- /container -->
        </section>

        <!-- ========================================== -->
        <!-- PRESTIGE LIGHTBOX POPUP MODAL               -->
        <!-- ========================================== -->
        <div id="hacoledPrestigeLightbox"
             class="fixed inset-0 z-[99999] bg-black/95 backdrop-blur-xl opacity-0 pointer-events-none transition-all duration-300 flex items-center justify-center p-3 sm:p-6 select-none"
             onclick="closePrestigeLightbox()"
             role="dialog"
             aria-modal="true"
             aria-labelledby="prestigeLightboxTitle"
             aria-hidden="true">

            <!-- Close Button -->
            <button type="button"
                    onclick="closePrestigeLightbox()"
                    class="absolute top-4 right-4 sm:top-6 sm:right-6 w-11 h-11 rounded-full bg-white/10 hover:bg-[#b31217] text-white flex items-center justify-center transition-all duration-200 backdrop-blur-md border border-white/20 hover:scale-105 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-300 z-30 shadow-lg cursor-pointer"
                    aria-label="Đóng hình ảnh">
                <i class="ph-bold ph-x text-xl"></i>
            </button>

            <!-- Navigation Prev -->
            <button type="button"
                    onclick="event.stopPropagation(); prevPrestigeImage();"
                    class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 w-11 h-11 sm:w-13 sm:h-13 rounded-full bg-white/10 hover:bg-[#b31217] text-white flex items-center justify-center transition-all duration-200 backdrop-blur-md border border-white/20 hover:scale-105 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-300 z-30 shadow-lg cursor-pointer group"
                    aria-label="Hình trước">
                <i class="ph-bold ph-caret-left text-2xl group-hover:-translate-x-0.5 transition-transform"></i>
            </button>

            <!-- Navigation Next -->
            <button type="button"
                    onclick="event.stopPropagation(); nextPrestigeImage();"
                    class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 w-11 h-11 sm:w-13 sm:h-13 rounded-full bg-white/10 hover:bg-[#b31217] text-white flex items-center justify-center transition-all duration-200 backdrop-blur-md border border-white/20 hover:scale-105 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-300 z-30 shadow-lg cursor-pointer group"
                    aria-label="Hình kế tiếp">
                <i class="ph-bold ph-caret-right text-2xl group-hover:translate-x-0.5 transition-transform"></i>
            </button>

            <!-- Main Image & Information Container -->
            <div class="relative max-w-6xl w-full flex flex-col items-center justify-center z-20" onclick="event.stopPropagation()">

                <!-- Main Image Wrapper -->
                <div class="relative overflow-hidden rounded-xl sm:rounded-2xl border border-white/20 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.9)] bg-black/80 flex items-center justify-center max-h-[78vh] w-full">
                    <img id="prestigeLightboxImg"
                         src=""
                         alt=""
                         class="max-h-[78vh] w-auto max-w-full object-contain transition-all duration-300 scale-95 opacity-0">
                </div>

                <!-- Footer Info Bar -->
                <div class="mt-4 flex flex-col sm:flex-row items-center justify-between w-full gap-2 px-3 text-white">
                    <div class="flex items-center gap-2.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#fbbf24] shadow-[0_0_10px_#fbbf24] animate-pulse"></span>
                        <span id="prestigeLightboxTitle" class="text-sm sm:text-base font-semibold text-white/90 drop-shadow"></span>
                    </div>
                    <div class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-xs font-bold text-[#fbbf24] tracking-wider">
                        <span id="prestigeLightboxCounter">1 / 8</span>
                    </div>
                </div>
            </div>
        </div>

        <script>
            (function() {
                const prestigeImagesData = <?php echo wp_json_encode(array_values($prestige_images)); ?>;
                let currentPrestigeIndex = 0;
                let previousPrestigeFocus = null;
                let prestigeTouchStartX = 0;

                window.openPrestigeLightbox = function(index) {
                    currentPrestigeIndex = index;
                    const lightbox = document.getElementById('hacoledPrestigeLightbox');
                    const img = document.getElementById('prestigeLightboxImg');
                    const title = document.getElementById('prestigeLightboxTitle');
                    const counter = document.getElementById('prestigeLightboxCounter');

                    if (!lightbox || !img || !prestigeImagesData[index]) return;
                    previousPrestigeFocus = document.activeElement;

                    // Update Image Src & Metadata
                    img.src = prestigeImagesData[index].url;
                    img.alt = prestigeImagesData[index].caption;
                    if (title) title.textContent = prestigeImagesData[index].caption;
                    if (counter) counter.textContent = (index + 1) + ' / ' + prestigeImagesData.length;

                    // Show Modal
                    lightbox.classList.remove('opacity-0', 'pointer-events-none');
                    lightbox.classList.add('opacity-100', 'pointer-events-auto');
                    lightbox.setAttribute('aria-hidden', 'false');
                    document.body.style.overflow = 'hidden';
                    const closeButton = lightbox.querySelector('button[aria-label="Đóng hình ảnh"]');
                    if (closeButton) closeButton.focus();

                    // Animate Image In
                    setTimeout(() => {
                        img.classList.remove('scale-95', 'opacity-0');
                        img.classList.add('scale-100', 'opacity-100');
                    }, 50);
                };

                window.closePrestigeLightbox = function() {
                    const lightbox = document.getElementById('hacoledPrestigeLightbox');
                    const img = document.getElementById('prestigeLightboxImg');

                    if (!lightbox) return;

                    if (img) {
                        img.classList.remove('scale-100', 'opacity-100');
                        img.classList.add('scale-95', 'opacity-0');
                    }

                    setTimeout(() => {
                        lightbox.classList.remove('opacity-100', 'pointer-events-auto');
                        lightbox.classList.add('opacity-0', 'pointer-events-none');
                        lightbox.setAttribute('aria-hidden', 'true');
                        document.body.style.overflow = '';
                        if (previousPrestigeFocus && typeof previousPrestigeFocus.focus === 'function') {
                            previousPrestigeFocus.focus();
                        }
                    }, 200);
                };

                window.prevPrestigeImage = function() {
                    currentPrestigeIndex = (currentPrestigeIndex - 1 + prestigeImagesData.length) % prestigeImagesData.length;
                    updatePrestigeLightboxContent();
                };

                window.nextPrestigeImage = function() {
                    currentPrestigeIndex = (currentPrestigeIndex + 1) % prestigeImagesData.length;
                    updatePrestigeLightboxContent();
                };

                function updatePrestigeLightboxContent() {
                    const img = document.getElementById('prestigeLightboxImg');
                    const title = document.getElementById('prestigeLightboxTitle');
                    const counter = document.getElementById('prestigeLightboxCounter');

                    if (!img || !prestigeImagesData[currentPrestigeIndex]) return;

                    img.classList.remove('scale-100', 'opacity-100');
                    img.classList.add('scale-95', 'opacity-0');

                    setTimeout(() => {
                        img.src = prestigeImagesData[currentPrestigeIndex].url;
                        img.alt = prestigeImagesData[currentPrestigeIndex].caption;
                        if (title) title.textContent = prestigeImagesData[currentPrestigeIndex].caption;
                        if (counter) counter.textContent = (currentPrestigeIndex + 1) + ' / ' + prestigeImagesData.length;

                        img.classList.remove('scale-95', 'opacity-0');
                        img.classList.add('scale-100', 'opacity-100');
                    }, 150);
                }

                // Keyboard Navigation (ESC, Left, Right)
                document.addEventListener('keydown', function(e) {
                    const lightbox = document.getElementById('hacoledPrestigeLightbox');
                    if (!lightbox || lightbox.classList.contains('opacity-0')) return;

                    if (e.key === 'Escape') {
                        closePrestigeLightbox();
                    } else if (e.key === 'ArrowLeft') {
                        prevPrestigeImage();
                    } else if (e.key === 'ArrowRight') {
                        nextPrestigeImage();
                    } else if (e.key === 'Tab') {
                        const focusable = Array.from(lightbox.querySelectorAll('button'));
                        if (!focusable.length) return;
                        const first = focusable[0];
                        const last = focusable[focusable.length - 1];
                        if (e.shiftKey && document.activeElement === first) {
                            e.preventDefault();
                            last.focus();
                        } else if (!e.shiftKey && document.activeElement === last) {
                            e.preventDefault();
                            first.focus();
                        }
                    }
                });

                const lightbox = document.getElementById('hacoledPrestigeLightbox');
                if (lightbox) {
                    lightbox.addEventListener('touchstart', function(e) {
                        prestigeTouchStartX = e.changedTouches[0].clientX;
                    }, { passive: true });
                    lightbox.addEventListener('touchend', function(e) {
                        const deltaX = e.changedTouches[0].clientX - prestigeTouchStartX;
                        if (Math.abs(deltaX) < 50) return;
                        deltaX > 0 ? prevPrestigeImage() : nextPrestigeImage();
                    }, { passive: true });
                }
            })();
        </script>


        <!-- ========================================== -->
        <!-- SECTION 9: CÔNG TRÌNH TIÊU BIỂU          -->
        <!-- ========================================== -->
        <section id="projects" class="py-6 md:py-20 relative overflow-hidden">
            <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10">

                <!-- Header -->
                <div class="text-center max-w-3xl mx-auto mb-6 md:mb-10 fade-up">
                    <div class="inline-flex items-center gap-2 px-3 py-1 md:px-4 md:py-1.5 rounded-full bg-brand-red/10 border border-brand-red/20 mb-3">
                        <i class="ph-fill ph-folder-open text-brand-red text-xs md:text-lg"></i>
                        <span class="text-brand-red text-[10px] md:text-xs font-bold uppercase tracking-widest whitespace-nowrap">DỰ ÁN TIÊU BIỂU</span>
                    </div>
                    <h2 id="cong-trinh-tieu-bieu" class="text-2xl md:text-4xl lg:text-5xl font-extrabold uppercase tracking-tight text-brand-text mb-3">Công Trình Tiêu Biểu</h2>
                    <p class="text-brand-muted text-xs md:text-base leading-relaxed max-w-xl mx-auto px-2">Hàng ngàn công trình LED đã được HacoLED triển khai thành công trên toàn quốc.</p>
                </div>

                <style>
                    .bento-item {
                        position: relative;
                        display: block;
                        width: 100%;
                        aspect-ratio: 16 / 9;
                    }
                    @media (min-width: 640px) {
                        .bento-item {
                            aspect-ratio: auto;
                        }
                        .bento-item-hero {
                            grid-column: span 2;
                            grid-row: span 2;
                        }
                    }
                </style>
                <!-- Bento Grid: 3 cols, hero at [0] spans 2c×2r -->
                <div id="projects-bento" class="fade-up" style="display: grid; gap: 12px;">
                    <!-- JS injected -->
                </div>

                <div class="text-center mt-10 fade-up">
                    <a href="<?php echo esc_url(hacoled_managed_page_url('projects')); ?>" class="inline-flex items-center gap-2 border-2 border-brand-red text-brand-red hover:bg-brand-red hover:text-white px-5 py-2.5 md:px-8 md:py-3 font-bold uppercase tracking-wider rounded-full transition-all text-xs md:text-sm group">
                        Xem tất cả dự án <i class="ph-bold ph-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

            </div>
        </section>


        <!-- ========================================== -->
        <!-- SECTION 10: BÁO CHÍ NÓI GÌ VỀ CHÚNG TÔI  -->
        <!-- ========================================== -->
        <section id="press" class="py-0 md:py-20 relative overflow-hidden bg-transparent">
  <div class="max-w-[1440px] mx-auto px-0 md:px-4 lg:px-8 relative z-10">
      <div class="relative overflow-hidden rounded-none md:rounded-3xl text-white pt-6 pb-5 px-4 md:p-12 lg:p-14 shadow-2xl border-x-0 md:border border-white/5" style="background: linear-gradient(to bottom right, #b31217, #8a0b10);" data-tech-bg="particle">
          <!-- Lớp 0: Dynamic Gradient Background overlay -->
          <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_30%,rgba(179,18,23,0.95)_0%,rgba(138,11,16,0.98)_80%)]"></div>
          
          <!-- Lớp 1: Lưới điện tử Tech Grid -->
          <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff06_1px,transparent_1px),linear-gradient(to_bottom,#ffffff06_1px,transparent_1px)] bg-[size:40px_40px] z-0 pointer-events-none"></div>

          <!-- Gold Top Border Line -->
          <div class="absolute top-0 left-0 w-full h-[4px] z-20" style="background: linear-gradient(90deg, #b45309, #fbbf24, #fffbeb, #fbbf24, #b45309);"></div>
          <div class="glow-red top-1/2 -translate-y-1/2 -left-20 opacity-40 z-0"></div>
          <div class="glow-gold top-1/2 -translate-y-1/2 -right-20 opacity-30 z-0"></div>
          
          <!-- Dong Son Drum watermark background -->
          <div class="absolute -right-[20%] -bottom-[35%] w-[1000px] h-[1000px] bg-no-repeat bg-contain bg-center pointer-events-none mix-blend-screen opacity-[0.15] z-0" 
               style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/dongson-optimized.webp'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%);">
          </div>
          
          <div class="relative z-10">
              <!-- Header -->
              <div class="text-center max-w-3xl mx-auto mb-6 md:mb-10 fade-up">
                  <div class="inline-flex items-center gap-2 px-3 py-1 md:px-4 md:py-1.5 rounded-full bg-white/10 backdrop-blur border border-[#fbbf24]/30 mb-3">
                      <i class="ph-fill ph-newspaper text-[#fbbf24] text-xs md:text-lg"></i>
                      <span class="text-white text-[10px] md:text-xs font-bold uppercase tracking-widest whitespace-nowrap">BÁO CHÍ & TRUYỀN THÔNG</span>
                  </div>
                  <h2 id="bao-chi-noi-ve-hacoled" class="text-2xl md:text-4xl lg:text-5xl font-extrabold uppercase tracking-tight text-white mb-3">
                      Báo Chí Nói Về <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#fbbf24] to-[#fffbeb]">HacoLED</span>
                  </h2>
                  <p class="text-gray-300 text-xs md:text-base leading-relaxed max-w-xl mx-auto px-2">Uy tín được kiểm chứng qua hàng loạt bài viết từ các tạp chí, báo điện tử và kênh truyền thông hàng đầu Việt Nam.</p>
              </div>

              <!-- Press Cards Grid: 3 cột × 2 hàng = 6 bài -->
              <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5" id="press-container">
                  <!-- JS Injected -->
              </div>

              <!-- Logo strip: tất cả tờ báo đưới grid -->
              <div class="mt-6 pt-5 border-t border-white/10 fade-up">
                  <p class="text-center text-white/40 text-xs font-bold uppercase tracking-widest mb-4">Đã được đăng tải bởi</p>
                  <div class="flex flex-wrap items-center justify-center gap-2" id="press-logo-strip">
            <!-- JS Injected -->
                  </div>
              </div>
          </div>
      </div>
  </div>
        </section>


        <!-- ========================================== -->
        <!-- SECTION 11: SỰ KIỆN NỔI BẬT                -->
        <!-- ========================================== -->
        <section id="events" class="py-6 md:py-20 relative overflow-hidden bg-transparent">
            <div class="max-w-[1440px] mx-auto px-4 lg:px-8">

                <div class="text-center max-w-3xl mx-auto mb-6 md:mb-10 fade-up">
                    <div class="inline-flex items-center gap-2 px-3 py-1 md:px-4 md:py-1.5 rounded-full bg-brand-red/10 border border-brand-red/20 mb-3">
                        <i class="ph-fill ph-calendar text-brand-red text-xs md:text-lg"></i>
                        <span class="text-brand-red text-[10px] md:text-xs font-bold uppercase tracking-widest whitespace-nowrap">Hoạt Động Thực Tế</span>
                    </div>
                    <h2 id="su-kien-noi-bat" class="text-2xl md:text-4xl lg:text-5xl font-extrabold uppercase tracking-tight text-brand-text mb-3">Sự Kiện Nổi Bật</h2>
                    <p class="text-brand-muted text-xs md:text-base leading-relaxed max-w-xl mx-auto px-2">Những dấu ấn nổi bật ghi lại hành trình HacoLED đồng hành cùng các sự kiện và đối tác trên khắp cả nước.</p>
                </div>

                <?php
                $args_evt = array(
                    'post_type'      => 'post',
                    'posts_per_page' => 5,
                    'category_name'  => get_theme_mod('hacoled_events_cat_slug', 'su-kien-hacoled'),
                    'post_status'    => 'publish'
                );
                $query_evt = new WP_Query($args_evt);
                $evt_items = array();
                if ($query_evt->have_posts()) :
                    while ($query_evt->have_posts()) : $query_evt->the_post();
                        $evt_items[] = array(
                            'title'     => get_the_title(),
                            'excerpt'   => wp_trim_words(get_the_excerpt(), 20),
                            'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_template_directory_uri() . '/assets/images/services-hero.webp',
                            'permalink' => get_permalink(),
                            'date'      => get_the_date('d/m/Y'),
                            'category'  => 'Sự kiện',
                        );
                    endwhile;
                    wp_reset_postdata();
                endif;

                $events_fallback_url = hacoled_managed_page_url('blog');
                $events_category = get_category_by_slug(get_theme_mod('hacoled_events_cat_slug', 'su-kien-hacoled'));
                if ($events_category) {
                    $events_fallback_url = get_category_link($events_category->term_id);
                }

                // Demo data if no posts found
                if (empty($evt_items)) :
                    $evt_items = array(
                        array('title' => 'Lễ khai trương showroom HacoLED Hà Nội', 'excerpt' => 'Khám phá không gian trưng bày LED hiện đại bậc nhất và các công trình thực tế.', 'thumbnail' => get_template_directory_uri() . '/assets/images/services-hero.webp', 'permalink' => $events_fallback_url, 'date' => '12/06/2025', 'category' => 'Sự kiện'),
                        array('title' => 'Triển lãm LED & Lighting Expo 2025', 'excerpt' => 'HacoLED mang đến các giải pháp trình chiếu đỉnh cao tại triển lãm công nghệ.', 'thumbnail' => get_template_directory_uri() . '/assets/images/home-solution-led.webp', 'permalink' => $events_fallback_url, 'date' => '05/06/2025', 'category' => 'Triển lãm'),
                        array('title' => 'Sự kiện âm nhạc quốc tế tại SVĐ Mỹ Đình', 'excerpt' => 'Đồng hành cung cấp hệ thống màn hình LED siêu lớn phục vụ đêm nhạc.', 'thumbnail' => get_template_directory_uri() . '/assets/images/home-solution-videowall.webp', 'permalink' => $events_fallback_url, 'date' => '28/05/2025', 'category' => 'Đêm nhạc'),
                        array('title' => 'Hội thảo công nghệ hiển thị thông minh', 'excerpt' => 'Chia sẻ xu hướng phát triển công nghệ màn hình LED COB và ghép nối.', 'thumbnail' => get_template_directory_uri() . '/assets/images/home-solution-audio.webp', 'permalink' => $events_fallback_url, 'date' => '20/05/2025', 'category' => 'Hội thảo'),
                        array('title' => 'Đêm nhạc Countdown HacoLED x FPT', 'excerpt' => 'Màn trình diễn ánh sáng hoành tráng chào đón năm mới cùng sinh viên FPT.', 'thumbnail' => get_template_directory_uri() . '/assets/images/services-audio.webp', 'permalink' => $events_fallback_url, 'date' => '31/12/2024', 'category' => 'Countdown'),
                    );
                endif;
                ?>

                <!-- Editorial Layout: Featured (left) + List (right) -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 fade-up items-stretch">

                    <!-- Featured Event (left 55%) -->
                    <?php $evt_featured = $evt_items[0]; ?>
                    <div class="lg:col-span-7 flex">
                        <a href="<?php echo esc_url($evt_featured['permalink']); ?>" class="group w-full relative rounded-2xl overflow-hidden flex flex-col justify-end shadow-lg hover:shadow-2xl transition-all duration-500 min-h-[380px] lg:min-h-[480px]">
                            <img src="<?php echo esc_url($evt_featured['thumbnail']); ?>" alt="<?php echo esc_attr($evt_featured['title']); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                            <div class="absolute top-4 left-4 z-10">
                                <span class="inline-flex items-center gap-1 text-white text-[9px] font-extrabold uppercase tracking-widest px-3 py-1 rounded-full shadow" style="background: linear-gradient(to right, #b31217, #8a0b10);">
                                    <i class="ph-fill ph-fire text-[#fbbf24]"></i> <?php echo esc_html($evt_featured['category']); ?>
                                </span>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 z-10 p-6 md:p-8">
                                <div class="flex items-center gap-2 mb-3">
                                    <i class="ph-fill ph-calendar text-[#fbbf24] text-xs"></i>
                                    <span class="text-white/60 text-xs font-medium"><?php echo esc_html($evt_featured['date']); ?></span>
                                </div>
                                <h3 class="text-xl md:text-2xl lg:text-3xl font-extrabold text-white leading-tight mb-2 group-hover:text-[#fbbf24] transition-colors duration-300"><?php echo esc_html($evt_featured['title']); ?></h3>
                                <p class="text-white/50 text-xs md:text-sm leading-relaxed line-clamp-2"><?php echo esc_html($evt_featured['excerpt']); ?></p>
                                <div class="mt-4 inline-flex items-center gap-1.5 text-[#fbbf24] text-xs font-bold uppercase tracking-wider group-hover:gap-3 transition-all duration-300">
                                    Chi tiết sự kiện <i class="ph-bold ph-arrow-right"></i>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Event List (right 45%) -->
                    <div class="lg:col-span-5 flex flex-col gap-4 justify-between">
                        <div class="flex flex-col gap-4">
                            <?php for ($i = 1; $i < count($evt_items); $i++) : $item = $evt_items[$i]; ?>
                            <a href="<?php echo esc_url($item['permalink']); ?>" class="group flex gap-4 p-3 rounded-xl bg-white/70 backdrop-blur border border-gray-100 hover:bg-white hover:shadow-lg hover:border-[#b31217]/25 transition-all duration-300">
                                <div class="flex-shrink-0 w-24 md:w-28 rounded-lg overflow-hidden" style="aspect-ratio: 4/3;">
                                    <img src="<?php echo esc_url($item['thumbnail']); ?>" alt="<?php echo esc_attr($item['title']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                </div>
                                <div class="flex-1 flex flex-col justify-center min-w-0">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-[#b31217] text-[9px] font-extrabold uppercase tracking-wider"><?php echo esc_html($item['category']); ?></span>
                                        <span class="text-gray-300">·</span>
                                        <span class="text-gray-400 text-[10px] font-medium"><?php echo esc_html($item['date']); ?></span>
                                    </div>
                                    <h3 class="text-sm font-bold text-gray-900 leading-snug line-clamp-2 group-hover:text-[#b31217] transition-colors duration-200"><?php echo esc_html($item['title']); ?></h3>
                                    <p class="text-xs text-gray-500 leading-relaxed line-clamp-2 md:line-clamp-1 mt-1"><?php echo esc_html($item['excerpt']); ?></p>
                                </div>
                            </a>
                            <?php endfor; ?>
                        </div>

                        <a href="/category/su-kien/" class="inline-flex items-center justify-center gap-2 border-2 border-[#b31217] text-[#b31217] hover:bg-[#b31217] hover:text-white px-6 py-2.5 font-bold uppercase tracking-wider rounded-full transition-all text-sm self-start mt-2">
                            Xem tất cả sự kiện <i class="ph-bold ph-arrow-right"></i>
                        </a>
                    </div>

                </div>

                </div>
            </div>
        </section>


        <!-- ========================================== -->
        <!-- SECTION 12: FAQ & CALL TO ACTION          -->
        <!-- ========================================== -->
        <section id="faq-cta" class="pt-6 pb-20 md:py-20 relative overflow-hidden bg-transparent">
            <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-stretch">
                    
                    <div class="lg:col-span-5 flex flex-col">
                        <div class="relative overflow-hidden rounded-3xl text-white p-8 md:p-10 shadow-2xl border border-white/5 h-full flex flex-col justify-between" style="background: linear-gradient(to bottom right, #b31217, #8a0b10);" data-tech-bg="particle">
                            <!-- Gradient overlay -->
                            <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_30%,rgba(179,18,23,0.95)_0%,rgba(138,11,16,0.98)_80%)] z-0"></div>
                            
                            <!-- Tech Grid overlay with gradient mask -->
                            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAwIDQwIEwgNDAgNDAgNDAgMCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJyZ2JhKDI1NSwyNTUsMjU1LDAuMDUpIiBzdHJva2Utd2lkdGg9IjEiLz48L3BhdHRlcm4+PC9kZWZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JpZCkiLz48L3N2Zz4=')] opacity-20 z-0"></div>
                            
                            <!-- Glowing ambient orbs -->
                            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[300px] h-[300px] rounded-full bg-brand-red/10 blur-[100px] z-0"></div>

                    <!-- Dong Son Drum watermark background -->
                            <div class="absolute -right-[30%] -bottom-[30%] w-[800px] h-[800px] bg-no-repeat bg-contain bg-center pointer-events-none mix-blend-screen opacity-[0.15] z-0" 
                                 style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/dongson-optimized.webp'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%);">
                            </div>
                            <div class="relative z-10 flex flex-col items-start text-left">
                                <!-- Accent micro-badge -->
                                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur border border-[#fbbf24]/30 mb-3">
                                    <span class="relative flex h-2 w-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-gold opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-gold"></span>
                                    </span>
                                    <span class="text-white text-[10px] md:text-xs font-bold uppercase tracking-widest whitespace-nowrap">TƯ VẤN & BÁO GIÁ</span>
                                </div>

                                <!-- Title -->
                                <h2 id="tu-van-giai-phap" class="text-2xl md:text-4xl lg:text-5xl font-extrabold uppercase tracking-tight text-white mb-3 leading-tight">
                                    Sẵn Sàng Nâng Tầm <br>
                                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#fbbf24] to-[#fffbeb]">Trình Chiếu?</span>
                                </h2>

                                <!-- Subtitle -->
                                <p class="text-gray-300 mb-6 text-xs md:text-base leading-relaxed font-light">
                                    Liên hệ ngay với chuyên gia của HacoLED để nhận giải pháp thi công màn hình LED toàn diện và tối ưu chi phí nhất.
                                </p>

                                <!-- Actions -->
                                <div class="flex flex-row items-center gap-3 w-full mb-8">
                                    <a href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>" class="flex-1 group relative inline-flex items-center justify-center gap-2 px-4 py-3 font-bold text-white transition-all duration-300 bg-gradient-to-r from-brand-red to-red-600 rounded-full hover:shadow-[0_0_20px_rgba(204,0,0,0.5)] hover:scale-[1.02] active:scale-[0.98] overflow-hidden text-[11px] uppercase tracking-wider text-center">
                                        <i class="ph-fill ph-chat-centered-text text-sm"></i>
                                        <span>Tư Vấn Ngay</span>
                                    </a>
                                    <a href="tel:0342324488" class="flex-1 group inline-flex items-center justify-center gap-2 px-4 py-3 font-bold text-white transition-all duration-300 bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/10 rounded-full hover:scale-[1.02] active:scale-[0.98] text-[11px] text-center">
                                        <i class="ph-fill ph-phone-call text-brand-gold text-sm group-hover:scale-110 group-hover:rotate-12 transition-transform duration-300"></i>
                                        <span>Gọi Hotline</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Trust Indicators (at the bottom of the left card) -->
                            <div class="relative z-10 grid grid-cols-1 gap-3 pt-6 border-t border-white/10 text-slate-200 text-xs font-medium">
                                <div class="flex items-center gap-2">
                                    <i class="ph-bold ph-clock-countdown text-brand-gold text-base"></i>
                                    <span>Khảo sát nhanh trong vòng 2 giờ</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="ph-bold ph-chats-teardrop text-brand-gold text-base"></i>
                                    <span>Tư vấn và hỗ trợ kỹ thuật 24/7</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="ph-bold ph-shield-check text-brand-gold text-base"></i>
                                    <span>Cam kết thiết bị chính hãng 100%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Câu hỏi thường gặp FAQ (7 columns) -->
                    <div class="lg:col-span-7 flex flex-col justify-center">
                        <div class="text-left mb-6">
                            <div class="inline-flex items-center gap-2 px-3 py-1 md:px-4 md:py-1.5 rounded-full bg-brand-red/10 border border-brand-red/20 mb-3">
                                <i class="ph-fill ph-question text-brand-red text-xs md:text-lg"></i>
                                <span class="text-brand-red text-[10px] md:text-xs font-bold uppercase tracking-widest whitespace-nowrap">HỖ TRỢ KHÁCH HÀNG</span>
                            </div>
                            <h3 id="cau-hoi-thuong-gap" class="text-2xl md:text-4xl lg:text-5xl font-extrabold uppercase tracking-tight text-brand-text mb-3">Câu Hỏi Thường Gặp</h3>
                        </div>
                        
                        <div class="space-y-3" id="faq-accordion">
                            <details name="faq" class="group bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 [&_summary::-webkit-details-marker]:hidden open:border-brand-red/30 transition-all duration-300" open>
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
                                    <span class="pr-4">5. HacoLED có hỗ trợ thiết kế 3D trước khi thi công không?</span>
                                    <span class="shrink-0 flex items-center justify-center w-8 h-8 rounded-full bg-gray-50 text-gray-400 group-hover:bg-brand-red/10 group-hover:text-brand-red group-open:bg-brand-red group-open:text-white group-open:rotate-180 transition-all duration-300">
                                        <i class="ph-bold ph-caret-down text-base"></i>
                                    </span>
                                </summary>
                                <div class="px-5 pb-4 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4 mt-1 animate-fade-in-up">
                                    Chắc chắn rồi. Đội ngũ kỹ sư thiết kế của chúng tôi sẽ cung cấp bản vẽ kỹ thuật và phối cảnh 3D trực quan sát với thực tế 99%, giúp quý khách dễ dàng hình dung quy mô và thẩm mỹ dự án trước khi chốt phương án.
                                </div>
                            </details>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <!-- Script cho Accordion FAQ (Bật cái này đóng cái kia) -->
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

    </main>
    <script>
        // 1. DỮ LIỆU DỰ ÁN VÀ BÁO CHÍ
        <?php
        $customizer_projects = array();
        $default_projects = array(
            array(
                'title' => "Lắp đặt màn hình LED P3 trong nhà tại Phố Xanh Building",
                'category' => "Dự án trong nhà",
                'year' => "2026",
                'client' => "Phố Xanh Building",
                'desc' => "Dự án thi công và lắp đặt màn hình LED P3 độ phân giải cao trong nhà cho Phố Xanh Building.",
                'img' => get_template_directory_uri() . "/assets/images/services-hero.webp",
                'url' => "https://hacoled.com/lap-dat-man-hinh-led-p3-trong-nha-tai-pho-xanh-building/"
            ),
            array(
                'title' => "Lắp đặt màn hình LED P1.5 trong nhà tại CT Cổ Phần Đầu Đầu FORTUNE",
                'category' => "Dự án trong nhà",
                'year' => "2026",
                'client' => "CT Cổ Phần Đầu Tư FORTUNE",
                'desc' => "Thi công giải pháp màn hình LED P1.5 cao cấp, sắc nét trong nhà cho công ty cổ phần đầu tư Fortune.",
                'img' => get_template_directory_uri() . "/assets/images/home-solution-led.webp",
                'url' => "https://hacoled.com/man-hinh-led-p1-5-trong-nha-cong-ty-fotune/"
            ),
            array(
                'title' => "Lắp đặt màn hình LED P3.91 cho Trường THPT FPT Tây Hà Nội",
                'category' => "Dự án ngoài trời",
                'year' => "2026",
                'client' => "Trường THPT FPT Tây Hà Nội",
                'desc' => "Triển khai lắp đặt màn hình LED P3.91 ngoài trời phục vụ các hoạt động sự kiện tại THPT FPT Tây Hà Nội.",
                'img' => get_template_directory_uri() . "/assets/images/home-solution-videowall.webp",
                'url' => "https://hacoled.com/lap-dat-man-hinh-led-p3-91-cho-truong-thpt-fpt-tay-ha-noi/"
            ),
            array(
                'title' => "Lắp đặt màn hình LED P3 trong nhà tại thôn Ngọc – Hưng Yên",
                'category' => "Dự án trong nhà",
                'year' => "2026",
                'client' => "Nhà văn hóa thôn Ngọc – Hưng Yên",
                'desc' => "Hoàn thiện lắp đặt hệ thống màn hình LED P3 trong nhà phục vụ sinh hoạt tại nhà văn hóa thôn Ngọc.",
                'img' => get_template_directory_uri() . "/assets/images/home-solution-audio.webp",
                'url' => "https://hacoled.com/lap-dat-man-hinh-led-p3-trong-nha-tai-thon-ngoc-hung-yen/"
            ),
            array(
                'title' => "Lắp đặt màn hình LED P2 trong nhà tại Học Viện Kỹ Thuật Mật Mã",
                'category' => "Dự án trong nhà",
                'year' => "2026",
                'client' => "Học Viện Kỹ Thuật Mật Mã",
                'desc' => "Cung cấp và lắp đặt màn hình LED P2 trong nhà chất lượng cao phục vụ Học Viện Kỹ Thuật Mật Mã.",
                'img' => get_template_directory_uri() . "/assets/images/services-indoor.webp",
                'url' => "https://hacoled.com/lap-dat-man-hinh-led-p2-trong-nha-hoc-vien-ky-thuat-mat-ma/"
            ),
            array(
                'title' => "Lắp đặt màn hình LED P2 trong nhà tại Công Ty TNHH MTV Cao Su 75",
                'category' => "Dự án trong nhà",
                'year' => "2026",
                'client' => "Công Ty TNHH MTV Cao Su 75",
                'desc' => "Dự án thi công màn hình LED P2 trong nhà hiển thị sắc nét dành cho Công ty TNHH MTV Cao su 75.",
                'img' => get_template_directory_uri() . "/assets/images/services-outdoor.webp",
                'url' => "https://hacoled.com/lap-dat-man-hinh-led-p2-trong-nha-tai-cong-ty-cao-su-75/"
            ),
            array(
                'title' => "Lắp đặt màn hình LED P1.8 trong nhà tại Công Ty Cổ Phần XD & TM 299",
                'category' => "Dự án trong nhà",
                'year' => "2026",
                'client' => "Công Ty Cổ Phần XD & TM 299",
                'desc' => "Cung cấp giải pháp hiển thị màn hình LED P1.8 trong nhà cho Công ty Xây dựng và Thương mại 299.",
                'img' => get_template_directory_uri() . "/assets/images/services-audio.webp",
                'url' => "https://hacoled.com/man-hinh-led-p1-8-trong-nha-tai-cong-ty-co-phan-xay-dung-thuong-mai-299/"
            ),
            array(
                'title' => "Lắp đặt màn hình LED P1.5 trong nhà tại Côn Đảo",
                'category' => "Dự án trong nhà",
                'year' => "2026",
                'client' => "Đối tác tại Côn Đảo",
                'desc' => "Hoàn thiện hạng mục cung cấp và thi công màn hình LED P1.5 trong nhà hiện đại tại khu vực Côn Đảo.",
                'img' => get_template_directory_uri() . "/assets/images/services-repair.webp",
                'url' => "https://hacoled.com/lap-dat-man-hinh-led-p1-5-trong-nha-tai-con-dao/"
            ),
            array(
                'title' => "Lắp đặt màn hình LED P2 trong nhà tại Capital Elite",
                'category' => "Dự án trong nhà",
                'year' => "2026",
                'client' => "Capital Elite (Phạm Hùng)",
                'desc' => "Thi công lắp đặt hệ thống màn hình LED P2 trong nhà cao cấp cho dự án tòa nhà Capital Elite.",
                'img' => get_template_directory_uri() . "/assets/images/services-blueprint.webp",
                'url' => "https://hacoled.com/lap-dat-man-hinh-led-p2-trong-nha-tai-capital-elite/"
            )
        );

        $args_projects = array(
            'post_type'      => 'post',
            'posts_per_page' => 9,
            'category_name'  => get_theme_mod('hacoled_projects_cat_slug', 'du-an'),
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC'
        );
        $query_projects = new WP_Query($args_projects);
        if ($query_projects->have_posts()) {
            while ($query_projects->have_posts()) {
                $query_projects->the_post();
                $cats = get_the_category();
                $cat_names = array();
                foreach ($cats as $c) {
                    if ($c->slug !== 'du-an' && $c->slug !== 'projects') {
                        $cat_names[] = $c->name;
                    }
                }
                $cat_str = !empty($cat_names) ? implode(', ', $cat_names) : 'Dự án';
                $customizer_projects[] = array(
                    'title'    => get_the_title(),
                    'category' => $cat_str,
                    'year'     => get_post_meta(get_the_ID(), '_project_year', true) ?: get_the_date('Y'),
                    'client'   => get_post_meta(get_the_ID(), '_project_client', true) ?: (get_post_meta(get_the_ID(), '_project_location', true) ?: 'HacoLED'),
                    'desc'     => wp_trim_words(get_the_excerpt(), 20),
                    'img'      => get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_template_directory_uri() . '/assets/images/services-hero.webp',
                    'url'      => get_permalink()
                );
            }
            wp_reset_postdata();
        }

        // Fallback to default projects if no posts found
        if (empty($customizer_projects)) {
            $customizer_projects = $default_projects;
        } else if (count($customizer_projects) < 9) {
            // Fill up with defaults if query returned less than 9
            $queried_count = count($customizer_projects);
            for ($i = $queried_count; $i < 9; $i++) {
                $customizer_projects[] = $default_projects[$i];
            }
        }
        ?>
        const projects = <?php echo json_encode($customizer_projects, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
        const press = <?php echo json_encode($press_data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;

        const responsiveImageAttrs = (url, sizes = '100vw') => {
            if (!url || !url.includes('/assets/images/') || !/\.webp(?:\?.*)?$/i.test(url)) return '';
            const base = url.replace(/\.webp(?:\?.*)?$/i, '');
            return `srcset="${base}-320.webp 320w, ${base}-640.webp 640w, ${base}-768.webp 768w, ${url} 1024w" sizes="${sizes}"`;
        };

        function init() {
            // 2. SLIDER NATIVE: scroll-snap, không cần tải thư viện bên thứ ba.
            document.querySelectorAll('.product-slider-wrapper').forEach((wrapper) => {
                const slider = wrapper.querySelector('.product-swiper');
                const previous = wrapper.querySelector('.custom-swiper-prev');
                const next = wrapper.querySelector('.custom-swiper-next');
                if (!slider) return;

                let scrollRaf = null;
                const updateButtons = () => {
                    if (scrollRaf) cancelAnimationFrame(scrollRaf);
                    const scrollLeft = slider.scrollLeft;
                    const clientWidth = slider.clientWidth;
                    const scrollWidth = slider.scrollWidth;

                    scrollRaf = requestAnimationFrame(() => {
                        if (previous) previous.disabled = scrollLeft <= 4;
                        if (next) next.disabled = scrollLeft + clientWidth >= scrollWidth - 4;
                    });
                };
                previous?.addEventListener('click', () => slider.scrollBy({ left: -slider.clientWidth * 0.85, behavior: 'smooth' }));
                next?.addEventListener('click', () => slider.scrollBy({ left: slider.clientWidth * 0.85, behavior: 'smooth' }));
                slider.addEventListener('scroll', updateButtons, { passive: true });
                updateButtons();
            });

            // 3. RENDER DỰ ÁN vào Bento Grid
            const bentoGrid = document.getElementById('projects-bento');
            if (bentoGrid) {
                let resizeRaf = null;
                function resizeBentoGrid() {
                    if (resizeRaf) cancelAnimationFrame(resizeRaf);
                    const containerWidth = bentoGrid.clientWidth;
                    const gap = 12;
                    const width = window.innerWidth;
                    
                    resizeRaf = requestAnimationFrame(() => {
                        if (width >= 1024) {
                            bentoGrid.style.gridTemplateColumns = 'repeat(3, 1fr)';
                            const colWidth = (containerWidth - (2 * gap)) / 3;
                            // Công thức tính để cả ô 1x1 và ô 2x2 đều đạt tỉ lệ xấp xỉ ~16:9
                            const rowHeight = (18 * colWidth - 7 * gap) / 32;
                            bentoGrid.style.gridAutoRows = `${rowHeight}px`;
                            bentoGrid.style.gap = `${gap}px`;
                        } else if (width >= 640) {
                            bentoGrid.style.gridTemplateColumns = 'repeat(2, 1fr)';
                            const colWidth = (containerWidth - gap) / 2;
                            const rowHeight = (18 * colWidth - 7 * gap) / 32;
                            bentoGrid.style.gridAutoRows = `${rowHeight}px`;
                            bentoGrid.style.gap = `${gap}px`;
                        } else {
                            bentoGrid.style.gridTemplateColumns = '1fr';
                            bentoGrid.style.gridAutoRows = 'auto';
                            bentoGrid.style.gap = `${gap}px`;
                        }
                    });
                }

                bentoGrid.innerHTML = projects.slice(0, 6).map((p, idx) => {
                    const cat = p.category.split(',')[0].trim();
                    const isHero = (idx === 0);
                    const titleSize = isHero ? 'text-lg md:text-xl' : 'text-xs md:text-sm';
                    const itemClass = isHero ? 'bento-item bento-item-hero' : 'bento-item';

                    return `
                    <a href="${p.url}" target="_blank" rel="noopener"
                       class="${itemClass} group rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-0.5">
                        <img src="${p.img}" ${responsiveImageAttrs(p.img, '100vw')} alt="${p.title}" width="1024" height="576" loading="lazy" decoding="async"
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/10 to-transparent"></div>
                        <div class="absolute top-3 left-3 z-10">
                            <span class="bg-brand-red/90 backdrop-blur-sm text-white text-[9px] font-extrabold px-2.5 py-1 rounded-full shadow uppercase tracking-widest">${cat}</span>
                        </div>
                        ${isHero ? `<div class="absolute top-3 right-3 z-10">
                            <span class="bg-brand-gold text-[#1C0505] text-[9px] font-extrabold px-2.5 py-1 rounded-full shadow-lg uppercase tracking-widest flex items-center gap-1">
                                <i class="ph-fill ph-star"></i> Nổi bật
                            </span>
                        </div>` : ''}
                        <div class="absolute bottom-0 left-0 right-0 z-10 p-3 ${isHero ? 'md:p-5' : 'md:p-3'}">
                            <h3 class="font-heading ${titleSize} font-bold text-white leading-snug line-clamp-2 group-hover:text-brand-gold transition-colors duration-300">${p.title}</h3>
                            ${isHero ? `<p class="text-white/50 text-xs mt-1 line-clamp-2 md:line-clamp-1">${p.desc}</p>` : ''}
                        </div>
                        <div class="absolute inset-0 z-20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="inline-flex items-center gap-1.5 bg-white/95 text-brand-red text-[11px] font-extrabold uppercase tracking-wider px-4 py-2 rounded-full shadow-xl backdrop-blur">
                                Xem dự án ${p.client} <i class="ph-bold ph-arrow-up-right"></i>
                            </span>
                        </div>
                    </a>`;
                }).join('');

                resizeBentoGrid();
                window.addEventListener('resize', resizeBentoGrid);
            }


            // 4. RENDER HTML BÁO CHÍ
            document.getElementById('press-container').innerHTML = press.map((p, idx) => `
                <a href="${p.url}" target="_blank" rel="noopener"
                   class="group flex flex-col h-full rounded-2xl overflow-hidden border border-white/10 bg-black/40 hover:bg-black/60 transition-all duration-300 shadow-md hover:shadow-xl fade-up"
                   style="transition-delay: ${idx * 80}ms">
                    <!-- Image: Strict 16:9 -->
                    <div class="relative w-full overflow-hidden flex-shrink-0" style="aspect-ratio: 16/9;">
                        <img src="${p.img}" ${responsiveImageAttrs(p.img, '100vw')} alt="${p.title}" width="1024" height="576" loading="lazy" decoding="async" data-fallback-src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/home-solution-led.webp'); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        
                        <!-- Source Tag -->
                        <div class="absolute top-2.5 left-2.5 z-10">
                            <span class="bg-[#b31217] text-white text-[9px] font-extrabold uppercase tracking-wider px-2 py-0.5 rounded shadow-sm">
                                ${p.source}
                            </span>
                        </div>

                        <!-- Brand Logo -->
                        <div class="absolute top-2.5 right-2.5 z-10">
                            <div class="rounded px-1.5 py-0.5 flex items-center shadow-md border border-white/10"
                                 style="background: ${p.logoDark ? 'rgba(20,2,2,0.9)' : 'rgba(255,255,255,0.95)'}; backdrop-filter: blur(4px);">
                                <img src="${p.logo}" alt="Logo ${p.source}" width="160" height="60" loading="lazy" decoding="async" class="h-3 max-w-[55px] object-contain" data-error-action="hide-show-next">
                                <span class="text-[7px] font-extrabold uppercase tracking-widest" style="display:none;color:${p.logoDark ? '#fbbf24' : '#1C0505'}">${p.source}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Content Area: Low profile height -->
                    <div class="p-3 flex-1 flex flex-col justify-between bg-black/20 border-t border-white/5">
                        <h3 class="font-heading text-xs md:text-sm font-bold text-white leading-snug line-clamp-2 group-hover:text-[#fbbf24] transition-colors duration-300">
                            ${p.title}
                        </h3>
                        <div class="mt-2.5 pt-2 border-t border-white/5 flex items-center justify-between">
                            <span class="inline-flex items-center gap-1 text-white/40 text-[9px] font-bold uppercase tracking-wider group-hover:text-[#fbbf24] transition-colors duration-300">
                                Chi tiết <i class="ph-bold ph-arrow-right group-hover:translate-x-0.5 transition-transform"></i>
                            </span>
                            <div class="h-[1.5px] bg-[#fbbf24]/50 w-6 group-hover:w-10 transition-all duration-500 ease-out"></div>
                        </div>
                    </div>
                </a>
            `).join('');

            // Logo báo chí
            const logoStrip = document.getElementById('press-logo-strip');
            if (logoStrip) {
                logoStrip.innerHTML = press.map(p => `
                    <a href="${p.url}" target="_blank" rel="noopener"
                       class="flex items-center justify-center px-2.5 py-1.5 md:px-3 md:py-2 rounded-lg border border-white/10 hover:border-brand-gold/50 transition-all duration-300 group"
                       style="background: rgba(255,255,255,0.03); backdrop-filter: blur(4px);">
                        <img src="${p.logo}" alt="Logo đối tác báo chí ${p.source}" width="160" height="60" loading="lazy" decoding="async"
                             class="h-3.5 md:h-4.5 max-w-[65px] md:max-w-[80px] object-contain opacity-40 group-hover:opacity-100 transition-opacity duration-300"
                             style="${p.logoDark ? 'filter: brightness(10)' : ''}"
                             data-error-action="hide-show-next">
                        <span class="text-[9px] font-bold text-white/45 group-hover:text-white uppercase tracking-wider" style="display:none">${p.source}</span>
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

        const initHomepageContent = () => {
            init();
            document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
        };
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initHomepageContent, { once: true });
        } else {
            initHomepageContent();
        }
    </script>
<?php
// Render dynamically configured footer
$this->renderFooter($footer_type ?? 'default');
?>
