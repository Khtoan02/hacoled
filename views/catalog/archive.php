<?php
/**
 * Controller-owned catalog archive view.
 *
 * This is not a WooCommerce core template override. Actual overrides live in
 * the theme-level woocommerce/ directory.
 *
 * WooCommerce Shop Archive View
 *
 * @var string $title
 * @var string $header_type
 * @var string $footer_type
 */

$this->renderHeader($header_type ?? 'default');

$navigation_categories = $navigation_categories ?? [];
$shop_description = $shop_description ?? '';
$featured_projects = $featured_projects ?? [];
?>

<main class="relative bg-[#FAFAFA] bg-tech-grid pt-28 md:pt-48 pb-20 min-h-[70vh] overflow-hidden" data-tech-bg="circuit">
  
  <!-- Ambient Light glows (Theme design system) -->
  <div class="absolute top-20 left-10 w-[400px] h-[400px] bg-red-600/5 rounded-full blur-[120px] pointer-events-none z-0"></div>
  <div class="absolute top-1/2 right-10 w-[500px] h-[500px] bg-amber-500/5 rounded-full blur-[140px] pointer-events-none z-0"></div>

  <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10">

    <!-- Category Hero Header (Perfectly matched with Home Hero visual) -->
    <div class="relative overflow-hidden rounded-3xl bg-[#0A0000] text-white p-8 md:p-12 mb-8 shadow-xl border border-white/5">
      <!-- Dynamic Gradient Background overlay -->
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_30%,#4A0404_0%,#0A0000_80%)]"></div>
      
      <!-- Dong Son Drum chìm xoay chậm -->
      <div class="absolute z-0 pointer-events-none opacity-[0.05] right-[-100px] top-[-100px] w-[500px] h-[500px] bg-no-repeat bg-center bg-contain"
           style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/dongson.png');">
      </div>
      
      <!-- Tech Grid overlay -->
      <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff03_1px,transparent_1px),linear-gradient(to_bottom,#ffffff03_1px,transparent_1px)] bg-[size:32px_32px] z-0 pointer-events-none"></div>

      <div class="relative z-10 max-w-3xl">
        <!-- Breadcrumb -->
        <nav class="text-xs md:text-sm text-slate-300 mb-4 flex flex-wrap items-center gap-1.5">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-white transition-colors">Trang chủ</a>
          <i class="ph ph-caret-right text-[10px]"></i>
          <span class="text-white font-semibold"><?php echo esc_html( $title ); ?></span>
        </nav>
        
        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-3">
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 via-amber-400 to-yellow-500">
            <?php echo esc_html( $title ); ?>
          </span>
        </h1>
        <p class="text-xs md:text-sm text-slate-300 leading-relaxed font-light">
          Khám phá danh sách sản phẩm màn hình LED, cabin LED và giải pháp trình chiếu chất lượng cao chính hãng từ Hacoled.
        </p>
      </div>
    </div>

    <!-- Category Navigation Slider -->
    <?php if ( ! empty( $navigation_categories ) ) : ?>
      <div class="mb-8">
        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3 flex items-center gap-1.5">
          <i class="ph-bold ph-squares-four text-[#D90429]"></i>
          <span>Danh mục nổi bật</span>
        </h3>
        <div class="flex items-center gap-3 overflow-x-auto pb-3 scrollbar-thin scrollbar-thumb-slate-200">
          <?php foreach ( $navigation_categories as $category ) : ?>
              <a href="<?php echo esc_url( $category['url'] ); ?>" 
                 class="flex-shrink-0 flex items-center gap-3 px-4 py-2.5 rounded-2xl border bg-white text-slate-700 border-slate-100 hover:border-slate-300 hover:shadow-md transition-all duration-200 shadow-sm">
                <img src="<?php echo esc_url( $category['image'] ); ?>" alt="<?php echo esc_attr( $category['name'] ); ?>" class="w-8 h-8 rounded-lg object-cover bg-slate-50" />
                <span class="text-xs md:text-sm font-bold tracking-tight"><?php echo esc_html( $category['name'] ); ?></span>
              </a>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>

    <!-- SECTION 2: Grid Layout - Content (2/3) & Sticky Sidebar (1/3) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left Column: Product List & SEO Content (2/3 - 8 Cols) -->
        <div class="lg:col-span-8 space-y-10">
            
            <!-- WooCommerce Product Loop Container -->
            <div class="woocommerce-content-container text-slate-800 relative z-20">
              <?php 
              if ( woocommerce_product_loop() ) {
                echo '<div class="flex flex-col sm:flex-row sm:items-center justify-end mb-6 pb-4 border-b border-slate-200/60 wc-shop-header-wrapper">';
                do_action( 'woocommerce_before_shop_loop' );
                echo '</div><div class="clear-both"></div>';

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
            <?php if ( ! empty( $shop_description ) ) : ?>
                    <div class="seo-content-block bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8 relative" 
                         style="overflow-anchor: none;"
                         x-data="{ expanded: false, showButton: false }"
                         x-init="showButton = $refs.content.scrollHeight > 280">
                      <div x-ref="content"
                           :class="expanded ? '' : 'max-h-[280px] overflow-hidden'" 
                           class="prose prose-slate prose-sm text-gray-600 text-sm leading-relaxed max-w-none transition-all duration-300 relative">
                        <?php echo apply_filters( 'the_content', $shop_description ); ?>
                        
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

        <!-- Right Column: Sticky Sidebar Widgets (1/3 - 4 Cols) -->
        <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-[120px] lg:self-start">
            
            <!-- Widget 1: Main Categories Links List -->
            <?php if ( ! empty( $navigation_categories ) ) : ?>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                    <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                        <i class="ph-bold ph-tree-structure text-[#D90429]"></i>
                        <span>Danh mục sản phẩm</span>
                    </h3>
                    <div class="flex flex-col gap-2">
                        <?php foreach ( $navigation_categories as $category ) : ?>
                            <a href="<?php echo esc_url( $category['url'] ); ?>" 
                               class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold border bg-white text-slate-700 border-slate-100 hover:border-slate-300 hover:bg-slate-50 transition-all duration-200">
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
