<?php
/**
 * Controller-owned product category view.
 *
 * This is not a WooCommerce core template override. Actual overrides live in
 * the theme-level woocommerce/ directory.
 *
 * WooCommerce Product Category Archive View
 *
 * @var string $category_name
 * @var string $description
 * @var string $header_type
 * @var string $footer_type
 */

$this->renderHeader($header_type ?? 'default');

$navigation_categories = $navigation_categories ?? [];
$breadcrumbs = $breadcrumbs ?? [];
$featured_projects = $featured_projects ?? [];
$latest_articles = $latest_articles ?? [];
?>

<main class="relative bg-[#FAFAFA] pt-28 md:pt-64 pb-20 min-h-[70vh] overflow-visible">

  <!-- Ambient Light glows (Theme design system) -->
  <div
    class="absolute top-20 left-10 w-[400px] h-[400px] bg-red-600/5 rounded-full blur-[120px] pointer-events-none z-0">
  </div>
  <div
    class="absolute top-1/2 right-10 w-[500px] h-[500px] bg-amber-500/5 rounded-full blur-[140px] pointer-events-none z-0">
  </div>

  <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10">

    <!-- Category Hero Header (Privileges Card Style: Red & Gold Trống Đồng) -->
    <div class="sp-privileges-card relative rounded-3xl p-6 md:p-10 lg:p-12 mb-8 overflow-hidden shadow-2xl">
      <!-- Gold mat inner frame -->
      <div class="sp-priv-red-mat"></div>

      <!-- Trống đồng Đông Sơn image pattern overlay (Gold metallic filter) -->
      <div
        class="absolute -right-20 -bottom-20 w-[480px] h-[480px] md:w-[620px] md:h-[620px] pointer-events-none z-0 overflow-hidden opacity-25">
        <div class="w-full h-full bg-no-repeat bg-center bg-contain animate-[spin_120s_linear_infinite]"
          style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/dongson-optimized.webp'); ?>'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%);">
        </div>
      </div>

      <!-- Base background gradient -->
      <div class="absolute inset-0 bg-gradient-to-br from-[#a8031d] via-[#d90429] to-[#65000f] -z-10"></div>

      <!-- Gold radial ambient glow -->
      <div class="absolute inset-0 -z-10 opacity-40"
        style="background:radial-gradient(ellipse at 50% 0%, rgba(255,215,0,.4), transparent 70%);"></div>

      <!-- Gold glow orbs -->
      <div
        class="absolute -top-20 -right-10 w-80 h-80 bg-[#FFD700] rounded-full opacity-[0.16] blur-[70px] pointer-events-none">
      </div>
      <div
        class="absolute -bottom-20 -left-10 w-64 h-64 bg-[#FFA500] rounded-full opacity-[0.12] blur-[60px] pointer-events-none">
      </div>

      <!-- Glossy sweep -->
      <div class="absolute inset-0 sp-priv-gloss pointer-events-none"></div>

      <!-- Top specular hairline -->
      <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/60 to-transparent">
      </div>

      <!-- Content Container -->
      <div class="relative z-10 max-w-4xl">
        <!-- Breadcrumb (Clean & Minimal) -->
        <nav
          class="text-[11px] md:text-xs text-[#FFF3D1]/80 mb-5 flex flex-wrap items-center gap-2 font-medium uppercase tracking-wider">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-white transition-colors">Trang chủ</a>
          <i class="ph ph-caret-right text-[10px] text-[#FFD700]/70"></i>
          <?php
          if ($current_term instanceof WP_Term) {
            foreach ($breadcrumbs as $breadcrumb) {
              echo '<a href="' . esc_url($breadcrumb['url']) . '" class="hover:text-white transition-colors">' . esc_html($breadcrumb['name']) . '</a>';
              echo '<i class="ph ph-caret-right text-[10px] text-[#FFD700]/70"></i>';
            }
            echo '<span class="text-white font-bold">' . esc_html($current_term->name) . '</span>';
          } else {
            echo '<span class="text-white font-bold">Danh mục sản phẩm</span>';
          }
          ?>
        </nav>

        <!-- Header Badge & Icon -->
        <div class="flex flex-wrap items-center gap-3 mb-5">
          <div
            class="w-10 h-10 md:w-11 md:h-11 rounded-xl flex items-center justify-center text-[#3a1f05] shadow-lg shrink-0"
            style="background:linear-gradient(135deg,#ffffff,#ffe89c 45%,#ffd700 70%,#d49214); box-shadow: 0 4px 14px rgba(0,0,0,.35), inset 0 1px 1px rgba(255,255,255,.8);">
            <i class="ph-bold ph-monitor text-lg md:text-xl text-[#851800]"></i>
          </div>
          <div
            class="flex items-center gap-2 border border-[#FFD700]/35 bg-[#000000]/30 backdrop-blur-md rounded-full px-4 py-1.5 shadow-sm">
            <i class="ph-fill ph-sparkle text-[#FFD700] animate-pulse text-sm"></i>
            <span class="text-[#FFE8A3] text-[11px] md:text-xs font-extrabold uppercase tracking-[0.18em]">Giải pháp
              hiển thị chuyên nghiệp</span>
          </div>
        </div>

        <!-- H1 Title (Metallic Gold) -->
        <h1
          class="sp-priv-gold-text text-3xl md:text-5xl lg:text-6xl font-black tracking-tight leading-tight mb-4 drop-shadow-md">
          <?php echo esc_html($category_name); ?>
        </h1>

        <!-- Description -->
        <?php if (!empty($description)): ?>
          <p
            class="text-xs md:text-sm lg:text-base text-[#FFF3D1] line-clamp-3 leading-relaxed font-medium max-w-3xl drop-shadow-sm">
            <?php echo wp_strip_all_tags($description); ?>
          </p>
        <?php endif; ?>

        <!-- Shimmering hairline divider -->
        <div class="sp-priv-gold-hairline sp-priv-shimmer my-6"></div>

        <!-- Service Experience 3T & CTAs -->
        <div class="relative z-10">
          <h3
            class="text-xs md:text-sm font-extrabold text-[#FFE8A3] mb-4 uppercase tracking-[0.15em] flex items-center gap-2">
            <span
              class="w-6 h-6 rounded-lg flex items-center justify-center border border-[#FFD700]/40 bg-[#000000]/25 shadow-sm">
              <i class="ph-bold ph-shield-check text-[#FFD700] text-xs"></i>
            </span>
            Trải nghiệm dịch vụ 3T: Tận Tâm - Nhanh Chóng - Trọn Vẹn
          </h3>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-6">
            <!-- Tận Tâm -->
            <div class="flex flex-col gap-1.5 rounded-xl p-3.5 border border-[#FFD700]/25 shadow-inner"
              style="background: rgba(0, 0, 0, 0.22);">
              <div class="flex items-center gap-2.5">
                <span
                  class="w-7 h-7 rounded-lg flex items-center justify-center border border-[#FFD700]/30 bg-[#000000]/30 shrink-0 shadow-sm">
                  <i class="ph-bold ph-heart text-[#FFD700] text-xs"></i>
                </span>
                <span class="font-extrabold text-[#FFE8A3] uppercase tracking-wider text-xs">Tận Tâm</span>
              </div>
              <p class="text-[11px] md:text-xs text-white/90 leading-relaxed font-medium">Lắng nghe và đồng hành bằng
                tâm huyết và hỗ trợ khách hàng hết mình.</p>
            </div>

            <!-- Nhanh Chóng -->
            <div class="flex flex-col gap-1.5 rounded-xl p-3.5 border border-[#FFD700]/25 shadow-inner"
              style="background: rgba(0, 0, 0, 0.22);">
              <div class="flex items-center gap-2.5">
                <span
                  class="w-7 h-7 rounded-lg flex items-center justify-center border border-[#FFD700]/30 bg-[#000000]/30 shrink-0 shadow-sm">
                  <i class="ph-bold ph-lightning text-[#FFD700] text-xs"></i>
                </span>
                <span class="font-extrabold text-[#FFE8A3] uppercase tracking-wider text-xs">Nhanh Chóng</span>
              </div>
              <p class="text-[11px] md:text-xs text-white/90 leading-relaxed font-medium">Thời gian phản hồi nhanh nhất
                và luôn sẵn sàng hỗ trợ 24/7.</p>
            </div>

            <!-- Trọn Vẹn -->
            <div class="flex flex-col gap-1.5 rounded-xl p-3.5 border border-[#FFD700]/25 shadow-inner"
              style="background: rgba(0, 0, 0, 0.22);">
              <div class="flex items-center gap-2.5">
                <span
                  class="w-7 h-7 rounded-lg flex items-center justify-center border border-[#FFD700]/30 bg-[#000000]/30 shrink-0 shadow-sm">
                  <i class="ph-bold ph-seal-check text-[#FFD700] text-xs"></i>
                </span>
                <span class="font-extrabold text-[#FFE8A3] uppercase tracking-wider text-xs">Trọn Vẹn</span>
              </div>
              <p class="text-[11px] md:text-xs text-white/90 leading-relaxed font-medium">Cung cấp đầy đủ thủ tục pháp
                lý, chất lượng chuẩn mực đúng hợp đồng.</p>
            </div>
          </div>

          <!-- CTAs -->
          <div class="flex flex-wrap items-center gap-3.5">
            <a href="<?php echo esc_url(hacoled_managed_page_url('commitment')); ?>"
              class="group relative px-6 py-3 bg-gradient-to-r from-[#FFD700] via-[#F5A623] to-[#D90429] text-[#2D0202] text-[11px] font-extrabold uppercase tracking-widest rounded-xl shadow-lg hover:shadow-red-500/30 overflow-hidden transition-all duration-300 hover:-translate-y-0.5 flex items-center gap-2 border border-[#FFD700]/40">
              <span
                class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-[150%] group-hover:translate-x-[150%] transition-transform duration-700"></span>
              <i class="ph-bold ph-file-text text-sm"></i>
              Xem chi tiết cam kết
            </a>
            <a href="tel:0342324488"
              class="px-6 py-3 bg-black/40 hover:bg-black/60 border border-[#FFD700]/35 text-[#FFE8A3] hover:text-white text-[11px] font-extrabold uppercase tracking-widest rounded-xl backdrop-blur-md transition-all duration-300 hover:-translate-y-0.5 flex items-center gap-2 shadow-sm">
              <i class="ph-bold ph-phone-call text-sm text-[#FFD700]"></i>
              Liên hệ ngay
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- SECTION 2: ĐỐI TÁC TIN CẬY (Social Proof / Bảo Chứng) -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 mb-8 relative overflow-hidden">
      <div class="flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="shrink-0">
          <h4 class="text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-1">Đối tác tin cậy</h4>
          <p class="text-sm font-bold text-slate-800">1000+ Tập đoàn & Doanh nghiệp đã hợp tác</p>
        </div>
        <div class="w-full md:w-auto flex flex-wrap items-center justify-center md:justify-end gap-6 md:gap-8">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/viettel-logo.svg" alt="Viettel"
            class="h-6 md:h-8 object-contain grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/samsung-logo.svg" alt="Samsung"
            class="h-5 md:h-6 object-contain grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/vingroup-logo.svg" alt="Vingroup"
            class="h-6 md:h-8 object-contain grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/fpt-logo.svg" alt="FPT"
            class="h-5 md:h-7 object-contain grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/evn-logo.svg" alt="EVN"
            class="h-6 md:h-8 object-contain grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
        </div>
      </div>
    </div>

    <!-- SECTION 3: Layout - Left Sidebar (1/4) & Right Main Content (3/4) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

      <!-- Left Sidebar Column (1/4 - 3 Cols) -->
      <div class="lg:col-span-3 self-stretch">
        <div class="space-y-6 lg:sticky lg:top-32 lg:z-20 w-full">

        <!-- Widget 1: Subcategories/Siblings Links List (Giải Pháp Hiển Thị Chuyên Biệt) -->
        <?php if (!empty($navigation_categories)): ?>
          <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
              <i class="ph-bold ph-squares-four text-[#D90429]"></i>
              <span><?php esc_html_e('Giải pháp liên quan', 'hacoled'); ?></span>
            </h3>
            <div class="flex flex-col gap-2">
              <?php foreach ($navigation_categories as $category): ?>
                <a href="<?php echo esc_url($category['url']); ?>"
                  class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold border transition-all duration-200 bg-white text-slate-700 border-slate-100 hover:border-slate-300 hover:bg-slate-50">
                  <span><?php echo esc_html($category['name']); ?></span>
                  <i class="ph-bold ph-caret-right text-[10px]"></i>
                </a>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>

        <!-- Widget 2: Hotline & Support commitments (Hacoled privileges - Premium Light Style) -->
        <div
          class="bg-gradient-to-br from-white to-red-50/20 border border-gray-100 rounded-2xl p-5 shadow-[0_8px_30px_rgba(0,0,0,0.04)] relative overflow-hidden group">
          <div
            class="absolute right-0 bottom-0 translate-x-4 translate-y-4 opacity-[0.03] pointer-events-none transition-transform group-hover:scale-110 duration-500">
            <i class="ph-fill ph-shield-check text-[120px] text-red-500"></i>
          </div>

          <h3
            class="text-sm font-extrabold pb-3 border-b border-gray-100 mb-4 flex items-center gap-2.5 text-gray-900 uppercase tracking-wide">
            <div
              class="w-7 h-7 rounded-lg bg-gradient-to-br from-[#D90429] to-red-600 flex items-center justify-center text-white shadow-md shadow-red-200">
              <i class="ph-bold ph-crown text-xs"></i>
            </div>
            <span>Đặc quyền tại Hacoled</span>
          </h3>
          <ul class="space-y-4 text-xs text-gray-600 font-medium relative z-10">
            <li class="flex items-start gap-3">
              <div
                class="mt-0.5 w-6 h-6 rounded-md bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0">
                <i class="ph-bold ph-shield-check text-sm"></i>
              </div>
              <div>
                <span class="font-bold text-gray-900 block mb-0.5">Cam kết chính hãng</span>
                <span class="text-[11px] leading-relaxed text-gray-500">Màn hình LED nhập khẩu chính ngạch CO, CQ đầy
                  đủ.</span>
              </div>
            </li>
            <li class="flex items-start gap-3">
              <div class="mt-0.5 w-6 h-6 rounded-md bg-red-50 text-red-500 flex items-center justify-center shrink-0">
                <i class="ph-bold ph-wrench text-sm"></i>
              </div>
              <div>
                <span class="font-bold text-gray-900 block mb-0.5">Bảo hành 24-36 tháng</span>
                <span class="text-[11px] leading-relaxed text-gray-500">Bảo trì trọn đời, hỗ trợ kỹ thuật tận nơi
                  24/7.</span>
              </div>
            </li>
            <li class="flex items-start gap-3">
              <div class="mt-0.5 w-6 h-6 rounded-md bg-blue-50 text-blue-500 flex items-center justify-center shrink-0">
                <i class="ph-bold ph-truck text-sm"></i>
              </div>
              <div>
                <span class="font-bold text-gray-900 block mb-0.5">Thi công nhanh chóng</span>
                <span class="text-[11px] leading-relaxed text-gray-500">Giao hàng toàn quốc, lắp đặt chuyên nghiệp toàn
                  diện.</span>
              </div>
            </li>
          </ul>
          <div
            class="mt-5 pt-4 border-t border-gray-100 flex items-center justify-between relative z-10 bg-gray-50/50 -mx-5 -mb-5 p-5 rounded-b-2xl">
            <div>
              <span class="text-[10px] text-gray-500 block uppercase font-bold tracking-wider mb-0.5">Tổng đài
                24/7</span>
              <a href="tel:0342324488"
                class="text-sm font-extrabold text-[#D90429] hover:text-red-700 transition-colors">034.232.44.88</a>
            </div>
            <a href="tel:0342324488"
              class="w-10 h-10 rounded-full bg-gradient-to-br from-[#D90429] to-red-600 flex items-center justify-center text-white hover:shadow-lg hover:shadow-red-200 hover:-translate-y-0.5 transition-all">
              <i class="ph-bold ph-phone-call text-lg animate-pulse"></i>
            </a>
          </div>
        </div>

        <!-- Widget 3: Dự án tiêu biểu mới -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
          <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
            <i class="ph-bold ph-monitor text-[#D90429]"></i>
            Dự án mới thi công
          </h3>
          <div class="space-y-4">
            <?php
            if ($featured_projects):
              foreach ($featured_projects as $project):
                ?>
                <div class="flex items-center gap-3 group">
                  <a href="<?php echo esc_url($project['url']); ?>"
                    class="w-14 h-10 rounded overflow-hidden flex-shrink-0 bg-gray-50">
                    <?php if ($project['thumbnail']): ?><img src="<?php echo esc_url($project['thumbnail']); ?>" alt=""
                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"><?php endif; ?>
                  </a>
                  <div class="min-w-0 flex-1">
                    <a href="<?php echo esc_url($project['url']); ?>"
                      class="text-[11px] font-bold text-gray-800 hover:text-[#D90429] transition-colors line-clamp-2 leading-tight">
                      <?php echo esc_html($project['title']); ?>
                    </a>
                  </div>
                </div>
                <?php
              endforeach;
            else:
              echo '<p class="text-xs text-gray-400">Không có dự án mới.</p>';
            endif;
            ?>
          </div>
        </div>

      </div>
    </div>

      <!-- Right Main Column: Product List & SEO Content (3/4 - 9 Cols) -->
      <div class="lg:col-span-9 lg:col-start-4 space-y-10">

        <!-- WooCommerce Product Loop Container -->
        <div class="woocommerce-content-container relative z-20">
          <?php
          if (woocommerce_product_loop()) {
            woocommerce_product_loop_start();

            if (wc_get_loop_prop('total')) {
              while (have_posts()) {
                the_post();
                do_action('woocommerce_shop_loop');
                wc_get_template_part('content', 'product');
              }
            }

            woocommerce_product_loop_end();
            do_action('woocommerce_after_shop_loop');
          } else {
            do_action('woocommerce_no_products_found');
          }
          ?>
        </div>

        <!-- SEO Category Description at the Bottom (TGDD Style) -->
        <?php if (!empty($description)): ?>
          <style>
            /* Polish Category Description Images & Prevent skewing */
            .seo-content-block .prose img {
              display: block;
              margin-left: auto;
              margin-right: auto;
              max-width: 100%;
              height: auto !important; /* Force proportional height */
              border-radius: 12px;
              box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
              cursor: zoom-in;
              transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.2s ease;
            }
            .seo-content-block .prose img:hover {
              transform: scale(1.015);
              opacity: 0.95;
            }
            /* Style for WordPress image captions */
            .seo-content-block .prose .wp-caption {
              max-width: 100% !important;
              margin: 1.5rem auto !important;
              text-align: center;
              background-color: #f8fafc;
              padding: 8px;
              border-radius: 14px;
              border: 1px solid #f1f5f9;
            }
            .seo-content-block .prose .wp-caption img {
              margin-bottom: 6px;
            }
            .seo-content-block .prose .wp-caption-text {
              font-size: 12px !important;
              color: #64748b !important;
              margin: 4px 0 0 0 !important;
              font-style: italic;
              line-height: 1.5;
            }
          </style>

          <div class="seo-content-block bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8 relative"
            style="overflow-anchor: none;" x-data="{ expanded: false, showButton: false, lightboxOpen: false, lightboxImage: '' }"
            x-init="showButton = $refs.content.scrollHeight > 280">
            <div x-ref="content" :class="expanded ? '' : 'max-h-[280px] overflow-hidden'"
              @click="
                if ($event.target.tagName === 'IMG') {
                  lightboxImage = $event.target.src;
                  lightboxOpen = true;
                }
              "
              class="prose prose-slate prose-sm text-gray-600 text-sm leading-relaxed max-w-none transition-all duration-300 relative">
              <?php echo apply_filters('the_content', $description); ?>

              <!-- Fade overlay when not expanded -->
              <div x-show="showButton && !expanded"
                class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-white to-transparent pointer-events-none z-10">
              </div>
            </div>

            <!-- Single Smart Toggle Button -->
            <div x-show="showButton"
              :class="expanded ? 'sticky bottom-6 z-[120] mt-8 pb-4 w-fit mx-auto' : 'text-center mt-4 border-t border-gray-100 pt-4'"
              class="transition-all duration-300">
              <button
                @click="if (expanded) { expanded = false; window.scrollTo({ top: $refs.content.getBoundingClientRect().top + window.scrollY - 180, behavior: 'smooth' }); } else { const currentScroll = window.scrollY; expanded = true; $nextTick(function() { window.scrollTo(0, currentScroll); }); }"
                :class="expanded ? 'inline-flex items-center gap-2 bg-[#D90429] hover:bg-[#b90323] text-white font-extrabold px-6 py-3 rounded-full shadow-2xl text-[10.5px] uppercase tracking-wider transition-all duration-300 hover:-translate-y-0.5' : 'inline-flex items-center gap-1 text-xs font-bold text-[#D90429] hover:text-red-700 transition-colors uppercase tracking-wider'">
                <span x-text="expanded ? 'Thu gọn nội dung' : 'Xem thêm chi tiết'"></span>
                <i class="ph-bold" :class="expanded ? 'ph-caret-up' : 'ph-caret-down'"></i>
              </button>
            </div>

            <!-- Lightbox Modal -->
            <div x-show="lightboxOpen" 
              x-transition:enter="transition ease-out duration-300"
              x-transition:enter-start="opacity-0" 
              x-transition:enter-end="opacity-100"
              x-transition:leave="transition ease-in duration-200"
              x-transition:leave-start="opacity-100" 
              x-transition:leave-end="opacity-0"
              x-cloak 
              class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/85 backdrop-blur-md p-4" 
              @click="lightboxOpen = false" 
              @keydown.escape.window="lightboxOpen = false">
              
              <!-- Close button -->
              <button class="absolute top-6 right-6 text-white/80 hover:text-white text-3xl focus:outline-none transition-colors" @click="lightboxOpen = false">
                <i class="ph-bold ph-x"></i>
              </button>
              
              <!-- Image container with scale transition -->
              <div class="relative max-w-full max-h-full flex items-center justify-center"
                x-show="lightboxOpen"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="scale-95"
                x-transition:enter-end="scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="scale-100"
                x-transition:leave-end="scale-95">
                <img :src="lightboxImage" class="max-w-full max-h-[90vh] rounded-xl shadow-2xl object-contain border border-white/10" @click.stop />
              </div>
            </div>
          </div>
        <?php endif; ?>

        <!-- FAQ Section -->
        <?php if (!empty($faq['title']) || !empty($faq['intro']) || !empty($faq['items'])): ?>
          <section class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 md:p-8">
            <div class="flex flex-col gap-2 mb-6">
              <h3 class="text-xl font-black text-slate-900">
                <?php echo esc_html(!empty($faq['title']) ? $faq['title'] : __('Câu hỏi thường gặp', 'hacoled')); ?>
              </h3>
              <?php if (!empty($faq['intro'])): ?>
                <p class="text-sm text-slate-600 leading-7">
                  <?php echo wp_kses_post($faq['intro']); ?>
                </p>
              <?php endif; ?>
            </div>

            <div class="space-y-3">
              <?php foreach ($faq['items'] as $index => $faqItem): ?>
                <details class="group rounded-2xl border border-slate-200 bg-slate-50/70 p-4 transition-all duration-300 open:border-[#D90429]/30 open:bg-white"
                  <?php echo $index === 0 ? 'open' : ''; ?>>
                  <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-sm font-bold text-slate-800 [&_::-webkit-details-marker]:hidden">
                    <span><?php echo esc_html($faqItem['question']); ?></span>
                    <i class="ph-bold ph-plus text-slate-500 transition-transform duration-300 group-open:rotate-45"></i>
                  </summary>
                  <div class="pt-4 text-sm leading-7 text-slate-600 prose prose-sm max-w-none">
                    <?php echo wp_kses_post($faqItem['answer']); ?>
                  </div>
                </details>
              <?php endforeach; ?>
            </div>
          </section>
        <?php endif; ?>

      </div>

    </div>

    <!-- SECTION 5: TIN TỨC & KIẾN THỨC MỚI NHẤT (Blog / Nurturing) -->
    <div class="mt-16 pt-12 border-t border-slate-200/60">
      <div class="flex flex-col md:flex-row md:items-end justify-between mb-8">
        <div>
          <span class="text-xs font-extrabold text-[#D90429] uppercase tracking-widest mb-1 block">Tin tức & Hướng
            dẫn</span>
          <h2 class="text-2xl md:text-3xl font-extrabold text-slate-800">Kiến thức chuyên sâu & dự án thực tế</h2>
        </div>
        <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"
          class="mt-4 md:mt-0 text-xs font-bold text-[#D90429] hover:text-red-700 uppercase tracking-wider flex items-center gap-1">
          Xem tất cả bài viết <i class="ph-bold ph-caret-right"></i>
        </a>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
        <?php
        $articles = array_slice((array) $latest_articles, 0, 4);
        if (!empty($articles)):
          $idx = 0;
          foreach ($articles as $article):
            $idx++;
            $thumbnail = $article['thumbnail'] ?: get_template_directory_uri() . '/assets/images/services-hero.webp';
            $badges = ['Tư vấn', 'Dự án', 'Kiến thức', 'Mẹo'];
            $badge = $badges[($idx - 1) % 4];
            ?>
            <a href="<?php echo esc_url($article['url']); ?>"
              class="group bg-white rounded-2xl border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_10px_40px_rgba(0,0,0,0.08)] transition-all duration-500 p-3 flex flex-col justify-start">
              <div class="relative w-full aspect-[4/3] rounded-[14px] overflow-hidden mb-5">
                <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($article['title']); ?>"
                  class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                <div
                  class="absolute top-3 left-3 bg-[#D90429] text-white text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-widest shadow-sm z-10">
                  <?php echo esc_html($badge); ?>
                </div>
              </div>
              <div class="px-2 pb-3">
                <span
                  class="text-[10px] text-slate-400 font-mono font-medium block mb-2 uppercase tracking-wider"><?php echo esc_html($article['date']); ?></span>
                <h3
                  class="text-[15px] md:text-base font-extrabold text-slate-800 line-clamp-2 leading-snug group-hover:text-[#D90429] transition-colors">
                  <?php echo esc_html($article['title']); ?>
                </h3>
              </div>
            </a>
            <?php
          endforeach;
        endif;
        ?>
      </div>
    </div>

    <!-- SECTION 6: CALL TO ACTION - CTA (Chốt Sale) -->
    <div class="mt-16 rounded-3xl relative overflow-hidden text-white border border-[#F5A623]/30 shadow-2xl"
      style="background: linear-gradient(135deg, #4A0404 0%, #0A0000 100%);">
      <div
        class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff03_1px,transparent_1px),linear-gradient(to_bottom,#ffffff03_1px,transparent_1px)] bg-[size:32px_32px] pointer-events-none">
      </div>
      <div
        class="absolute -right-20 -bottom-20 w-80 h-80 bg-[#D90429]/10 rounded-full blur-[100px] pointer-events-none">
      </div>

      <div class="relative z-10 px-8 py-10 md:p-12 flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="max-w-xl text-center md:text-left">
          <span class="text-xs font-extrabold text-yellow-300 uppercase tracking-[0.2em] mb-2 block">Tư vấn kỹ thuật
            miễn phí</span>
          <h2
            class="text-2xl md:text-3xl font-extrabold tracking-tight mb-3 text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-100 to-yellow-200">
            Cần lên bản vẽ 3D và báo giá chi tiết?
          </h2>
          <p class="text-sm text-slate-300 font-light leading-relaxed">
            Hỗ trợ tư vấn giải pháp, khảo sát mặt bằng tận nơi và lên bản vẽ thiết kế 3D hoàn toàn miễn phí.
          </p>
        </div>
        <div class="shrink-0 flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto">
          <a href="tel:0342324488"
            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#D90429] hover:bg-red-700 text-white font-extrabold text-sm uppercase tracking-wider px-8 py-4 rounded-full transition-all shadow-lg hover:shadow-red-500/20 hover:scale-105 duration-200 text-center">
            <i class="ph-bold ph-phone-call"></i>
            <span>Nhận Báo Giá Dự Án</span>
          </a>
          <a href="tel:0342324488"
            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 border border-white/20 hover:border-white/40 hover:bg-white/5 text-white font-bold text-sm uppercase tracking-wider px-8 py-4 rounded-full transition-all duration-200 text-center">
            <span>Yêu cầu khảo sát</span>
          </a>
        </div>
      </div>
    </div>

    <!-- WooCommerce after main content hooks -->
    <div class="mt-8">
      <?php do_action('woocommerce_after_main_content'); ?>
    </div>

  </div>
</main>

<?php
$this->renderFooter($footer_type ?? 'default');
?>