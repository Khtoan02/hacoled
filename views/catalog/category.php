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

<main class="relative bg-[#FAFAFA] bg-tech-grid pt-28 md:pt-48 pb-20 min-h-[70vh] overflow-hidden" data-tech-bg="circuit">
  
  <!-- Ambient Light glows (Theme design system) -->
  <div class="absolute top-20 left-10 w-[400px] h-[400px] bg-red-600/5 rounded-full blur-[120px] pointer-events-none z-0"></div>
  <div class="absolute top-1/2 right-10 w-[500px] h-[500px] bg-amber-500/5 rounded-full blur-[140px] pointer-events-none z-0"></div>

  <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10">

    <!-- Category Hero Header (Perfectly matched with Home Hero visual) -->
    <div class="relative overflow-hidden rounded-3xl bg-[#0A0000] text-white p-8 md:p-12 lg:p-14 mb-8 shadow-2xl border border-white/5">
      <!-- Lớp 0: Dynamic Gradient Background overlay -->
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_30%,#4A0404_0%,#0A0000_80%)]"></div>
      
      <!-- Lớp 1: Lưới điện tử Tech Grid -->
      <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff06_1px,transparent_1px),linear-gradient(to_bottom,#ffffff06_1px,transparent_1px)] bg-[size:40px_40px] z-0 pointer-events-none"></div>

      <!-- Lớp 2: Dong Son Drum chìm xoay chậm -->
      <div class="absolute z-0 pointer-events-none opacity-[0.06] animate-[spin_60s_linear_infinite]"
           style="width: 800px; height: 800px; top: 50%; right: -200px; transform: translateY(-50%); background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/dongson.png'); background-repeat: no-repeat; background-position: center; background-size: contain; filter: invert(0.8) sepia(1) saturate(3) hue-rotate(-20deg);">
      </div>
      
      <!-- Lớp 3: Ambient Light glows -->
      <div class="absolute top-0 -left-20 w-[400px] h-[400px] bg-red-600/20 rounded-full blur-[100px] pointer-events-none z-0"></div>
      <div class="absolute -bottom-20 -right-10 w-[500px] h-[500px] bg-yellow-500/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

      <!-- Lớp 4: Nội dung chính -->
      <div class="relative z-10 max-w-4xl">
        <!-- Breadcrumb (Clean & Minimal) -->
        <nav class="text-[11px] md:text-xs text-slate-400 mb-6 flex flex-wrap items-center gap-2 font-medium uppercase tracking-wider">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-white transition-colors">Trang chủ</a>
          <i class="ph ph-caret-right text-[10px] text-slate-500"></i>
          <?php
          if ( $current_term instanceof WP_Term ) {
              foreach ( $breadcrumbs as $breadcrumb ) {
                  echo '<a href="' . esc_url( $breadcrumb['url'] ) . '" class="hover:text-white transition-colors">' . esc_html( $breadcrumb['name'] ) . '</a>';
                  echo '<i class="ph ph-caret-right text-[10px] text-slate-500"></i>';
              }
              echo '<span class="text-white">' . esc_html($current_term->name) . '</span>';
          } else {
              echo '<span class="text-white">Danh mục sản phẩm</span>';
          }
          ?>
        </nav>
        
        <!-- Tagline badge -->
        <div class="flex items-center gap-3 px-5 py-2.5 mb-6 w-fit relative overflow-hidden border border-white/10 bg-white/5 backdrop-blur-md rounded-full shadow-[0_8px_32px_rgba(0,0,0,0.2)]">
            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-gradient-to-b from-[#F5A623] to-[#D90429] rounded-l-full"></div>
            <i class="ph-fill ph-sparkle text-[#F5A623] animate-pulse text-base"></i>
            <span class="text-gray-200 text-xs font-bold uppercase tracking-[0.2em]">Giải pháp hiển thị chuyên nghiệp</span>
        </div>

        <!-- H1 Title -->
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight mb-5 drop-shadow-lg leading-[1.15]">
          <span class="relative inline-block">
              <span class="absolute -inset-1 bg-gradient-to-r from-[#F5A623] via-yellow-300 to-[#D90429] blur-lg opacity-30"></span>
              <span class="relative text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 via-[#F5A623] to-yellow-500">
                <?php echo esc_html( $category_name ); ?>
              </span>
          </span>
        </h1>
        
        <!-- Description -->
        <?php if ( ! empty( $description ) ) : ?>
          <p class="text-base md:text-lg text-gray-300 line-clamp-3 leading-relaxed font-light max-w-2xl">
            <?php echo wp_strip_all_tags( $description ); ?>
          </p>
        <?php endif; ?>

        <!-- Service Experience 3T & CTAs -->
        <div class="mt-8 pt-8 border-t border-white/10 relative z-10">
          <h3 class="text-xs md:text-sm font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-[#F5A623] to-yellow-200 mb-5 uppercase tracking-[0.15em] flex items-center gap-2">
            <i class="ph-fill ph-seal-check text-[#F5A623]"></i>
            Trải nghiệm dịch vụ 3T: Tận Tâm - Nhanh Chóng - Trọn Vẹn
          </h3>
          
          <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-8 mb-8">
            <!-- Tận Tâm -->
            <div class="flex flex-col gap-2">
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#D90429] to-red-600 flex items-center justify-center shrink-0 shadow-lg shadow-red-500/20 border border-red-400/20">
                  <i class="ph-bold ph-heart text-white text-sm"></i>
                </div>
                <span class="font-extrabold text-white uppercase tracking-wider text-xs">Tận Tâm</span>
              </div>
              <p class="text-[11px] md:text-xs text-slate-300 leading-relaxed font-light md:pl-11">Lắng nghe và đồng hành bằng tâm huyết và hỗ trợ khách hàng hết mình.</p>
            </div>
            
            <!-- Nhanh Chóng -->
            <div class="flex flex-col gap-2">
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-yellow-500 to-amber-600 flex items-center justify-center shrink-0 shadow-lg shadow-yellow-500/20 border border-yellow-400/20">
                  <i class="ph-bold ph-lightning text-white text-sm"></i>
                </div>
                <span class="font-extrabold text-white uppercase tracking-wider text-xs">Nhanh Chóng</span>
              </div>
              <p class="text-[11px] md:text-xs text-slate-300 leading-relaxed font-light md:pl-11">Thời gian phản hồi nhanh nhất và luôn sẵn sàng hỗ trợ 24/7.</p>
            </div>

            <!-- Trọn Vẹn -->
            <div class="flex flex-col gap-2">
              <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center shrink-0 shadow-lg shadow-green-500/20 border border-green-400/20">
                  <i class="ph-bold ph-shield-check text-white text-sm"></i>
                </div>
                <span class="font-extrabold text-white uppercase tracking-wider text-xs">Trọn Vẹn</span>
              </div>
              <p class="text-[11px] md:text-xs text-slate-300 leading-relaxed font-light md:pl-11">Cung cấp đầy đủ thủ tục pháp lý, chất lượng chuẩn mực đúng hợp đồng.</p>
            </div>
          </div>

          <!-- CTAs -->
          <div class="flex flex-wrap items-center gap-4">
            <a href="/cam-ket-chat-luong-dich-vu//" class="group relative px-6 py-3 bg-gradient-to-r from-[#D90429] to-red-700 text-white text-[11px] font-extrabold uppercase tracking-widest rounded-full shadow-[0_8px_20px_rgba(217,4,41,0.3)] hover:shadow-[0_10px_25px_rgba(217,4,41,0.5)] overflow-hidden transition-all duration-300 hover:-translate-y-0.5 flex items-center gap-2 border border-red-500/30">
              <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-[150%] group-hover:translate-x-[150%] transition-transform duration-700"></span>
              <i class="ph-bold ph-file-text text-sm"></i>
              Xem chi tiết cam kết
            </a>
            <a href="tel:0932678910" class="px-6 py-3 bg-white/5 hover:bg-white/10 border border-white/20 text-white text-[11px] font-extrabold uppercase tracking-widest rounded-full backdrop-blur-md transition-all duration-300 hover:-translate-y-0.5 hover:border-brand-gold hover:text-brand-gold flex items-center gap-2">
              <i class="ph-bold ph-phone-call text-sm"></i>
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
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/viettel-logo.svg" alt="Viettel" class="h-6 md:h-8 object-contain grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/samsung-logo.svg" alt="Samsung" class="h-5 md:h-6 object-contain grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/vingroup-logo.svg" alt="Vingroup" class="h-6 md:h-8 object-contain grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/fpt-logo.svg" alt="FPT" class="h-5 md:h-7 object-contain grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/evn-logo.svg" alt="EVN" class="h-6 md:h-8 object-contain grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
        </div>
      </div>
    </div>

    <!-- SECTION 3: Layout - Left Sidebar (1/4) & Right Main Content (3/4) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left Sidebar Column (1/4 - 3 Cols) -->
        <div class="lg:col-span-3 space-y-6 lg:sticky lg:top-[120px] lg:self-start">
            
            <!-- Widget 1: Subcategories/Siblings Links List (Giải Pháp Hiển Thị Chuyên Biệt) -->
            <?php if ( ! empty( $navigation_categories ) ) : ?>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                    <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                        <i class="ph-bold ph-squares-four text-[#D90429]"></i>
                        <span><?php esc_html_e('Giải pháp liên quan', 'hacoled'); ?></span>
                    </h3>
                    <div class="flex flex-col gap-2">
                        <?php foreach ( $navigation_categories as $category ) : ?>
                            <a href="<?php echo esc_url( $category['url'] ); ?>" 
                               class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold border transition-all duration-200 bg-white text-slate-700 border-slate-100 hover:border-slate-300 hover:bg-slate-50">
                                <span><?php echo esc_html( $category['name'] ); ?></span>
                                <i class="ph-bold ph-caret-right text-[10px]"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Widget 2: Hotline & Support commitments (Hacoled privileges - Premium Light Style) -->
            <div class="bg-gradient-to-br from-white to-red-50/20 border border-gray-100 rounded-2xl p-5 shadow-[0_8px_30px_rgba(0,0,0,0.04)] relative overflow-hidden group">
                <div class="absolute right-0 bottom-0 translate-x-4 translate-y-4 opacity-[0.03] pointer-events-none transition-transform group-hover:scale-110 duration-500">
                    <i class="ph-fill ph-shield-check text-[120px] text-red-500"></i>
                </div>
                
                <h3 class="text-sm font-extrabold pb-3 border-b border-gray-100 mb-4 flex items-center gap-2.5 text-gray-900 uppercase tracking-wide">
                    <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-[#D90429] to-red-600 flex items-center justify-center text-white shadow-md shadow-red-200">
                        <i class="ph-bold ph-crown text-xs"></i>
                    </div>
                    <span>Đặc quyền tại Hacoled</span>
                </h3>
                <ul class="space-y-4 text-xs text-gray-600 font-medium relative z-10">
                    <li class="flex items-start gap-3">
                        <div class="mt-0.5 w-6 h-6 rounded-md bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0">
                            <i class="ph-bold ph-shield-check text-sm"></i>
                        </div>
                        <div>
                            <span class="font-bold text-gray-900 block mb-0.5">Cam kết chính hãng</span>
                            <span class="text-[11px] leading-relaxed text-gray-500">Màn hình LED nhập khẩu chính ngạch CO, CQ đầy đủ.</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="mt-0.5 w-6 h-6 rounded-md bg-red-50 text-red-500 flex items-center justify-center shrink-0">
                            <i class="ph-bold ph-wrench text-sm"></i>
                        </div>
                        <div>
                            <span class="font-bold text-gray-900 block mb-0.5">Bảo hành 24-36 tháng</span>
                            <span class="text-[11px] leading-relaxed text-gray-500">Bảo trì trọn đời, hỗ trợ kỹ thuật tận nơi 24/7.</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="mt-0.5 w-6 h-6 rounded-md bg-blue-50 text-blue-500 flex items-center justify-center shrink-0">
                            <i class="ph-bold ph-truck text-sm"></i>
                        </div>
                        <div>
                            <span class="font-bold text-gray-900 block mb-0.5">Thi công nhanh chóng</span>
                            <span class="text-[11px] leading-relaxed text-gray-500">Giao hàng toàn quốc, lắp đặt chuyên nghiệp toàn diện.</span>
                        </div>
                    </li>
                </ul>
                <div class="mt-5 pt-4 border-t border-gray-100 flex items-center justify-between relative z-10 bg-gray-50/50 -mx-5 -mb-5 p-5 rounded-b-2xl">
                    <div>
                        <span class="text-[10px] text-gray-500 block uppercase font-bold tracking-wider mb-0.5">Tổng đài 24/7</span>
                        <a href="tel:0932678910" class="text-sm font-extrabold text-[#D90429] hover:text-red-700 transition-colors">0932.678.910</a>
                    </div>
                    <a href="tel:0932678910" class="w-10 h-10 rounded-full bg-gradient-to-br from-[#D90429] to-red-600 flex items-center justify-center text-white hover:shadow-lg hover:shadow-red-200 hover:-translate-y-0.5 transition-all">
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
                    if ( $featured_projects ) :
                        foreach ( $featured_projects as $project ) :
                            ?>
                            <div class="flex items-center gap-3 group">
                                <a href="<?php echo esc_url($project['url']); ?>" class="w-14 h-10 rounded overflow-hidden flex-shrink-0 bg-gray-50">
                                    <?php if ($project['thumbnail']) : ?><img src="<?php echo esc_url($project['thumbnail']); ?>" alt="" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"><?php endif; ?>
                                </a>
                                <div class="min-w-0 flex-1">
                                    <a href="<?php echo esc_url($project['url']); ?>" class="text-[11px] font-bold text-gray-800 hover:text-[#D90429] transition-colors line-clamp-2 leading-tight">
                                        <?php echo esc_html($project['title']); ?>
                                    </a>
                                </div>
                            </div>
                            <?php
                        endforeach;
                    else :
                        echo '<p class="text-xs text-gray-400">Không có dự án mới.</p>';
                    endif;
                    ?>
                </div>
            </div>
            
        </div>

        <!-- Right Main Column: Product List & SEO Content (3/4 - 9 Cols) -->
        <div class="lg:col-span-9 space-y-10">
            
            <!-- WooCommerce Product Loop Container -->
            <div class="woocommerce-content-container relative z-20">
              <?php 
              if ( woocommerce_product_loop() ) {
                woocommerce_product_loop_start();

                if ( wc_get_loop_prop( 'total' ) ) {
                  while ( have_posts() ) {
                    the_post();
                    do_action( 'woocommerce_shop_loop' );
                    wc_get_template_part( 'content', 'product' );
                  }
                }

                woocommerce_product_loop_end();
                do_action( 'woocommerce_after_shop_loop' );
              } else {
                do_action( 'woocommerce_no_products_found' );
              }
              ?>
            </div>

            <!-- SEO Category Description at the Bottom (TGDD Style) -->
            <?php if ( ! empty( $description ) ) : ?>
              <div class="seo-content-block bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8 relative" 
                   style="overflow-anchor: none;"
                   x-data="{ expanded: false, showButton: false }"
                   x-init="showButton = $refs.content.scrollHeight > 280">
                <div x-ref="content"
                     :class="expanded ? '' : 'max-h-[280px] overflow-hidden'" 
                     class="prose prose-slate prose-sm text-gray-600 text-sm leading-relaxed max-w-none transition-all duration-300 relative">
                  <?php echo apply_filters( 'the_content', $description ); ?>
                  
                  <!-- Fade overlay when not expanded -->
                  <div x-show="showButton && !expanded" 
                       class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-white to-transparent pointer-events-none z-10"></div>
                </div>
                
                <!-- Single Smart Toggle Button -->
                <div x-show="showButton" 
                     :class="expanded ? 'sticky bottom-6 z-[120] mt-8 pb-4 w-fit mx-auto' : 'text-center mt-4 border-t border-gray-100 pt-4'"
                     class="transition-all duration-300">
                  <button @click="if (expanded) { expanded = false; window.scrollTo({ top: $refs.content.getBoundingClientRect().top + window.scrollY - 180, behavior: 'smooth' }); } else { const currentScroll = window.scrollY; expanded = true; $nextTick(function() { window.scrollTo(0, currentScroll); }); }" 
                          :class="expanded ? 'inline-flex items-center gap-2 bg-[#D90429] hover:bg-[#b90323] text-white font-extrabold px-6 py-3 rounded-full shadow-2xl text-[10.5px] uppercase tracking-wider transition-all duration-300 hover:-translate-y-0.5' : 'inline-flex items-center gap-1 text-xs font-bold text-[#D90429] hover:text-red-700 transition-colors uppercase tracking-wider'">
                    <span x-text="expanded ? 'Thu gọn nội dung' : 'Xem thêm chi tiết'"></span>
                    <i class="ph-bold" :class="expanded ? 'ph-caret-up' : 'ph-caret-down'"></i>
                  </button>
                </div>
              </div>
            <?php endif; ?>
            
        </div>
        
    </div>

    <!-- SECTION 5: TIN TỨC & KIẾN THỨC MỚI NHẤT (Blog / Nurturing) -->
    <div class="mt-16 pt-12 border-t border-slate-200/60">
      <div class="flex flex-col md:flex-row md:items-end justify-between mb-8">
        <div>
          <span class="text-xs font-extrabold text-[#D90429] uppercase tracking-widest mb-1 block">Tin tức & Hướng dẫn</span>
          <h2 class="text-2xl md:text-3xl font-extrabold text-slate-800">Kiến thức chuyên sâu & dự án thực tế</h2>
        </div>
        <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="mt-4 md:mt-0 text-xs font-bold text-[#D90429] hover:text-red-700 uppercase tracking-wider flex items-center gap-1">
          Xem tất cả bài viết <i class="ph-bold ph-caret-right"></i>
        </a>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php
        if ( $latest_articles ) :
            $idx = 0;
            foreach ( $latest_articles as $article ) :
                $idx++;
                $thumbnail = $article['thumbnail'] ?: get_template_directory_uri() . '/assets/images/services-hero.png';
                $badges = ['Tư vấn', 'Dự án', 'Kiến thức'];
                $badge = $badges[$idx % 3];
                ?>
                <a href="<?php echo esc_url($article['url']); ?>" class="group bg-white rounded-2xl border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_10px_40px_rgba(0,0,0,0.08)] transition-all duration-500 p-3 flex flex-col justify-start">
                  <div class="relative w-full aspect-[4/3] rounded-[14px] overflow-hidden mb-5">
                    <img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr($article['title']); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute top-3 left-3 bg-[#D90429] text-white text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-widest shadow-sm z-10">
                      <?php echo esc_html( $badge ); ?>
                    </div>
                  </div>
                  <div class="px-2 pb-3">
                    <span class="text-[10px] text-slate-400 font-mono font-medium block mb-2 uppercase tracking-wider"><?php echo esc_html($article['date']); ?></span>
                    <h3 class="text-[15px] md:text-base font-extrabold text-slate-800 line-clamp-2 leading-snug group-hover:text-[#D90429] transition-colors">
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
      <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff03_1px,transparent_1px),linear-gradient(to_bottom,#ffffff03_1px,transparent_1px)] bg-[size:32px_32px] pointer-events-none"></div>
      <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-[#D90429]/10 rounded-full blur-[100px] pointer-events-none"></div>
      
      <div class="relative z-10 px-8 py-10 md:p-12 flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="max-w-xl text-center md:text-left">
          <span class="text-xs font-extrabold text-yellow-300 uppercase tracking-[0.2em] mb-2 block">Tư vấn kỹ thuật miễn phí</span>
          <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight mb-3 text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-100 to-yellow-200">
            Cần lên bản vẽ 3D và báo giá chi tiết?
          </h2>
          <p class="text-sm text-slate-300 font-light leading-relaxed">
            Hỗ trợ tư vấn giải pháp, khảo sát mặt bằng tận nơi và lên bản vẽ thiết kế 3D hoàn toàn miễn phí.
          </p>
        </div>
        <div class="shrink-0 flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto">
          <a href="tel:0932678910" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#D90429] hover:bg-red-700 text-white font-extrabold text-sm uppercase tracking-wider px-8 py-4 rounded-full transition-all shadow-lg hover:shadow-red-500/20 hover:scale-105 duration-200 text-center">
            <i class="ph-bold ph-phone-call"></i>
            <span>Nhận Báo Giá Dự Án</span>
          </a>
          <a href="tel:0932678910" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 border border-white/20 hover:border-white/40 hover:bg-white/5 text-white font-bold text-sm uppercase tracking-wider px-8 py-4 rounded-full transition-all duration-200 text-center">
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
