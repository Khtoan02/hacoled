<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override of WooCommerce template for HacoLED theme.
 * Design: Premium B2B with 3D Coverflow Gallery
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

// Unhook default product tabs from rendering inside woocommerce_after_single_product_summary
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
// Unhook default woocommerce gallery images
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
// Unhook default sale flash badges
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product', 'woocommerce_show_product_sale_flash', 10 );
$price_html = $product->get_price_html();
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'single-product-container relative z-10', $product ); ?>
     x-data="{ 
         showStickyBar: false, 
         headerHeight: 0,
         updateHeaderHeight() {
             let hdr = document.getElementById('site-header');
             if (hdr) {
                 this.headerHeight = Math.max(0, Math.round(hdr.getBoundingClientRect().bottom));
             }
         }
     }"
     x-init="updateHeaderHeight(); window.addEventListener('resize', () => updateHeaderHeight()); $nextTick(() => updateHeaderHeight()); window.addEventListener('load', () => updateHeaderHeight())"
     @scroll.window="
         updateHeaderHeight();
         showStickyBar = (window.scrollY > (window.innerWidth < 768 ? 380 : 450));
     ">

    <!-- STICKY PRODUCT SUB-HEADER (Executive Solid White Style - Desktop & Mobile) -->
    <div x-show="showStickyBar"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="-translate-y-full opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="translate-y-0 opacity-100"
         x-transition:leave-end="-translate-y-full opacity-0"
         :style="{ top: (headerHeight > 0 ? (headerHeight - 1) + 'px' : '0px') }"
         class="fixed left-0 w-full bg-white/95 backdrop-blur-md border-b border-gray-200/90 z-[180] shadow-md transition-[top] duration-150 ease-out block"
         x-cloak>
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-10 py-2 sm:py-2.5 lg:py-3.5 flex items-center justify-between gap-3 sm:gap-6">
            <!-- Left Side: Title & Badges Below Title -->
            <div class="flex flex-col gap-0.5 sm:gap-1.5 justify-center min-w-0 flex-1 lg:flex-none">
                <!-- Row 1: Full Title + Brand Badge -->
                <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                    <span class="text-slate-900 font-bold text-xs sm:text-base lg:text-lg tracking-tight leading-snug truncate lg:whitespace-normal"><?php the_title(); ?></span>
                    <span class="inline-flex items-center gap-1 px-1.5 sm:px-2 py-0.5 rounded-full bg-red-50 border border-red-200 text-red-600 text-[8px] sm:text-[10px] font-extrabold uppercase tracking-wider shrink-0 shadow-xs">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span> Chính Hãng
                    </span>
                </div>

                <!-- Row 2: Trust badges, kept available at every viewport -->
                <div class="flex items-center gap-1 lg:gap-2 overflow-x-auto no-scrollbar max-w-full">
                    <span class="inline-flex items-center gap-1 px-1.5 lg:px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 border border-emerald-200/70 text-[8px] sm:text-[9px] lg:text-[11px] font-semibold whitespace-nowrap">
                        <i class="ph-bold ph-shield-check text-emerald-600"></i> CO/CQ đầy đủ
                    </span>
                    <span class="inline-flex items-center gap-1 px-1.5 lg:px-2 py-0.5 rounded-md bg-amber-50 text-amber-700 border border-amber-200/70 text-[8px] sm:text-[9px] lg:text-[11px] font-semibold whitespace-nowrap">
                        <i class="ph-bold ph-star text-amber-600"></i> Bảo hành 24–36T
                    </span>
                    <span class="inline-flex items-center gap-1 px-1.5 lg:px-2 py-0.5 rounded-md bg-sky-50 text-sky-700 border border-sky-200/70 text-[8px] sm:text-[9px] lg:text-[11px] font-semibold whitespace-nowrap">
                        <i class="ph-bold ph-package text-sky-600"></i> Thiết kế 3D Free
                    </span>
                </div>

                <!-- Mobile Sub-row: Price on Mobile -->
                <div class="flex lg:hidden items-center gap-1.5 text-xs font-bold text-[#D90429]">
                    <div class="sp-sticky-price-inline text-xs font-extrabold text-[#D90429] flex items-baseline gap-1">
                        <?php echo ! empty( $price_html ) ? $price_html : '<span class="text-xs font-extrabold text-[#D90429]">Liên hệ</span>'; ?>
                    </div>
                </div>
            </div>
            
            <!-- Right Side: Regular Price (Giá Gốc) + Selling Price (Giá Bán) + CTA -->
            <div class="flex items-center gap-3 sm:gap-6 xl:gap-8 shrink-0">
                <!-- Price Display (Desktop Only) -->
                <div class="hidden lg:flex items-baseline gap-2">
                    <div class="sp-sticky-price-inline flex items-baseline gap-2">
                        <?php echo ! empty( $price_html ) ? $price_html : '<span class="text-base lg:text-lg font-bold text-slate-900 tracking-tight">Liên hệ</span>'; ?>
                    </div>
                </div>
                
                <!-- CTA Button -->
                <a href="<?php echo esc_url( hacoled_managed_page_url( 'contact' ) ); ?>"
                   class="bg-[#D90429] hover:bg-[#b90323] text-white font-bold px-3.5 sm:px-7 py-1.5 sm:py-2 lg:py-2.5 rounded-lg lg:rounded-xl flex items-center justify-center gap-1.5 sm:gap-2 transition-all duration-300 text-[11px] sm:text-xs lg:text-sm uppercase tracking-wider shadow-md hover:-translate-y-0.5 whitespace-nowrap">
                    <i class="ph-bold ph-headset text-sm lg:text-base"></i>
                    <span class="hidden sm:inline">Nhận Báo Giá Ngay</span>
                    <span class="inline sm:hidden">Nhận báo giá</span>
                </a>
            </div>
        </div>
    </div>

    <!-- SECTION 1: HERO (Equal Grid — Info Left, Gallery Right) -->
    <section class="relative pt-4 pb-12 lg:pb-20 flex items-center sp-hero-section overflow-hidden">
        <!-- Subtle Glow Background -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-[1440px] h-full pointer-events-none -z-10 flex justify-between">
            <div class="w-[30rem] h-[30rem] bg-red-50 rounded-full mix-blend-multiply filter blur-[100px] opacity-70 -ml-20 mt-10"></div>
            <div class="w-[30rem] h-[30rem] bg-gray-100 rounded-full mix-blend-multiply filter blur-[100px] opacity-70 mr-10 mt-40"></div>
        </div>

        <div class="max-w-[1440px] w-full mx-auto px-0 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-14 items-start">
                
                <!-- LEFT COLUMN: Info & Privileges -->
                <div class="flex flex-col sp-fade-in z-20 justify-center">
                    
                    <!-- Breadcrumb (WooCommerce hooks handle this via woocommerce_before_main_content) -->

                    <!-- Title & Desc -->
                    <div class="flex flex-col items-start mb-6 lg:mb-8">
                        <!-- Category Badge -->
                        <?php
                        $terms = get_the_terms( $product->get_id(), 'product_cat' );
                        $cat_name = ( ! empty( $terms ) ) ? esc_html( $terms[0]->name ) : 'Sản phẩm';
                        ?>
                        <div class="inline-flex items-center border border-red-200 px-3 py-1.5 bg-red-50 text-red-600 text-xs lg:text-sm font-bold rounded-full mb-4 tracking-widest shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-red-500 mr-2 animate-pulse"></span> <?php echo strtoupper( $cat_name ); ?>
                        </div>

                        <!-- Product Title H1 -->
                        <h1 class="text-3xl lg:text-[2.75rem] xl:text-5xl font-bold text-gray-900 tracking-tight leading-[1.15] mb-4">
                            <?php the_title(); ?>
                        </h1>

                        <!-- Short Description -->
                        <div class="text-gray-500 text-sm lg:text-base leading-relaxed font-normal pl-4 border-l-2 border-gray-200 sp-excerpt-block">
                            <?php woocommerce_template_single_excerpt(); ?>
                        </div>
                    </div>

                    <!-- PRIVILEGES CARD COMPONENT -->
                    <?php get_template_part( 'views/components/privileges-card' ); ?>

                    <!-- CTA & Price Row (Price Left, CTA Right) -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-5 mt-5 w-full">
                        <div class="flex flex-col items-start">
                            <span class="text-xs lg:text-sm text-gray-500 uppercase tracking-widest font-semibold mb-1">Giá tham khảo từ</span>
                            <div class="sp-price-inline flex items-baseline gap-2">
                                <?php 
                                $price_html = $product->get_price_html();
                                echo ! empty( $price_html ) ? $price_html : '<span class="text-2xl lg:text-3xl font-extrabold text-gray-900 tracking-tight">Liên hệ</span>'; 
                                ?>
                            </div>
                        </div>

                        <a href="<?php echo esc_url( hacoled_managed_page_url( 'contact' ) ); ?>"
                           class="w-full sm:w-auto bg-[#D90429] hover:bg-[#b90323] text-white font-bold px-10 py-4 rounded-xl flex items-center justify-center gap-2.5 transition-all duration-300 shadow-[0_10px_20px_rgba(217,4,41,0.20)] hover:-translate-y-1 text-sm lg:text-base uppercase tracking-wider whitespace-nowrap">
                            <i class="ph-bold ph-headset text-lg opacity-90"></i> Nhận Báo Giá Ngay
                        </a>
                    </div>
                </div>

                <!-- RIGHT COLUMN: PRODUCT SHOWCASE GALLERY -->
                <div class="sp-fade-in w-full flex flex-col justify-start relative lg:sticky lg:top-8" x-data="spGallery()" x-init="init()">
                    <?php
                    // Renders hooks if any are left
                    do_action( 'woocommerce_before_single_product_summary' );
                    
                    $featured_image_id = $product->get_image_id();
                    $attachment_ids    = $product->get_gallery_image_ids();
                    $all_image_ids     = array();
                    if ( $featured_image_id ) $all_image_ids[] = $featured_image_id;
                    if ( ! empty( $attachment_ids ) ) $all_image_ids = array_merge( $all_image_ids, $attachment_ids );
                    $total_slides = count( $all_image_ids );
                    
                    if ( ! empty( $all_image_ids ) ) :
                    ?>
                        <!-- Main Showcase Image -->
                        <div class="sp-showcase-main relative">

                            <!-- Subtle gradient backdrop for transparent product images -->
                            <div class="sp-showcase-backdrop"></div>

                            <?php foreach ( $all_image_ids as $img_index => $img_id ) :
                                $img_large = wp_get_attachment_image_url( $img_id, 'large' );
                                $img_full  = wp_get_attachment_image_url( $img_id, 'full' );
                            ?>
                                <div class="sp-showcase-slide" 
                                     x-show="active === <?php echo $img_index; ?>" 
                                     x-transition:enter="transition ease-out duration-300"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     <?php echo $img_index === 0 ? '' : 'style="display:none"'; ?>>
                                    <img src="<?php echo esc_url( $img_large ); ?>" 
                                         alt="<?php echo esc_attr( get_the_title() ); ?> - Ảnh <?php echo $img_index + 1; ?>" 
                                         class="sp-showcase-img"
                                         loading="<?php echo $img_index === 0 ? 'eager' : 'lazy'; ?>" />
                                </div>
                            <?php endforeach; ?>

                            <!-- Nav arrows -->
                            <?php if ( $total_slides > 1 ) : ?>
                            <button class="sp-showcase-nav sp-showcase-prev" @click="prev()" aria-label="Ảnh trước">
                                <i class="ph-bold ph-caret-left"></i>
                            </button>
                            <button class="sp-showcase-nav sp-showcase-next" @click="next()" aria-label="Ảnh sau">
                                <i class="ph-bold ph-caret-right"></i>
                            </button>
                            <?php endif; ?>
                        </div>

                        <!-- Thumbnail Strip -->
                        <?php if ( $total_slides > 1 ) : ?>
                        <div class="sp-showcase-thumbs">
                            <?php foreach ( $all_image_ids as $thumb_index => $thumb_id ) : ?>
                                <button class="sp-thumb" 
                                        :class="active === <?php echo $thumb_index; ?> ? 'sp-thumb-active' : ''"
                                        @click="goTo(<?php echo $thumb_index; ?>)" 
                                        aria-label="Xem ảnh <?php echo $thumb_index + 1; ?>">
                                    <?php echo wp_get_attachment_image( $thumb_id, 'thumbnail', false, array( 'class' => 'sp-thumb-img' ) ); ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <!-- Alpine.js Gallery Controller -->
                        <script>
                        function spGallery() {
                            return {
                                active: 0,
                                total: <?php echo $total_slides; ?>,
                                autoTimer: null,
                                init() {
                                    this.startAuto();
                                },
                                goTo(index) {
                                    this.active = index;
                                    this.restartAuto();
                                },
                                next() {
                                    this.active = (this.active + 1) % this.total;
                                    this.restartAuto();
                                },
                                prev() {
                                    this.active = (this.active - 1 + this.total) % this.total;
                                    this.restartAuto();
                                },
                                startAuto() {
                                    if (this.total <= 1) return;
                                    this.autoTimer = setInterval(() => { this.active = (this.active + 1) % this.total; }, 5000);
                                },
                                restartAuto() {
                                    clearInterval(this.autoTimer);
                                    this.startAuto();
                                }
                            };
                        }
                        </script>
                    <?php else : ?>
                        <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm text-center text-slate-400">
                            Chưa cập nhật hình ảnh sản phẩm.
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>

    <div class="max-w-[1440px] w-full mx-auto px-0">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 pt-8 border-t border-gray-200/80" x-data="{ activeTab: 'info' }">
            
            <!-- Left: Product Tabs (3/4 - 9 Cols) -->
            <div class="lg:col-span-9 min-w-0 space-y-6">
                
                <!-- Tab Headers -->
                <div class="flex border-b border-gray-200 bg-white rounded-t-xl p-2 gap-2">
                    <button @click="activeTab = 'info'" 
                            :class="activeTab === 'info' ? 'bg-[#D90429] text-white' : 'text-gray-600 hover:bg-gray-50'"
                            class="px-5 py-3 rounded-lg font-bold text-sm transition-all duration-200 flex items-center gap-2">
                        <i class="ph-bold ph-file-text"></i>
                        Thông tin sản phẩm
                    </button>
                    <button @click="activeTab = 'specs'" 
                            :class="activeTab === 'specs' ? 'bg-[#D90429] text-white' : 'text-gray-600 hover:bg-gray-50'"
                            class="px-5 py-3 rounded-lg font-bold text-sm transition-all duration-200 flex items-center gap-2">
                        <i class="ph-bold ph-sliders"></i>
                        Thông số sản phẩm
                    </button>
                </div>

                <!-- Tab Contents -->
                <div class="bg-white rounded-b-xl border-x border-b border-gray-100 shadow-sm p-6 lg:p-8">
                    <!-- Tab 1: Info content (Alpine.js Read-More with Lightbox & FAQ) -->
                    <div x-show="activeTab === 'info'" 
                         x-transition:enter="transition ease-out duration-200" 
                         x-data="{ expanded: false, showButton: false, lightboxOpen: false, lightboxImage: '' }" 
                         x-init="
                           $nextTick(() => { 
                             showButton = $refs.content ? $refs.content.scrollHeight > 280 : false; 
                           });
                           if (window.ResizeObserver) {
                             new ResizeObserver(() => {
                               showButton = $refs.content ? $refs.content.scrollHeight > 280 : false;
                             }).observe($refs.content);
                           }
                         "
                         style="overflow-anchor: none;"
                         class="relative">
                        
                        <style>
                          /* Polish Product Description Images & Prevent skewing */
                          .sp-excerpt-block img,
                          .prose img {
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
                          .sp-excerpt-block img:hover,
                          .prose img:hover {
                            transform: scale(1.015);
                            opacity: 0.95;
                          }
                          /* Style for WordPress image captions */
                          .prose .wp-caption {
                            max-width: 100% !important;
                            margin: 1.5rem auto !important;
                            text-align: center;
                            background-color: #f8fafc;
                            padding: 8px;
                            border-radius: 14px;
                            border: 1px solid #f1f5f9;
                          }
                          .prose .wp-caption img {
                            margin-bottom: 6px;
                          }
                          .prose .wp-caption-text {
                            font-size: 12px !important;
                            color: #64748b !important;
                            margin: 4px 0 0 0 !important;
                            font-style: italic;
                            line-height: 1.5;
                          }
                        </style>

                        <div x-ref="content" 
                             :class="expanded ? '' : 'max-h-[280px] overflow-hidden'" 
                             @click="
                               if ($event.target.tagName === 'IMG') {
                                 lightboxImage = $event.target.src;
                                 lightboxOpen = true;
                               }
                             "
                             class="prose prose-slate prose-sm text-gray-600 text-sm leading-relaxed max-w-none transition-all duration-300 relative">
                            <?php the_content(); ?>
                            
                            <!-- Fade overlay when not expanded -->
                            <div x-show="showButton && !expanded" 
                                 class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-white to-transparent pointer-events-none z-10"></div>
                        </div>
                        
                        <!-- Single Smart Button for Show More / Collapse -->
                        <div x-show="showButton" 
                             :class="expanded ? 'sticky bottom-6 z-[120] mt-8 pb-4 w-fit mx-auto' : 'text-center mt-4 border-t border-gray-100 pt-4'"
                             class="transition-all duration-300">
                            <button @click="if (expanded) { expanded = false; window.scrollTo({ top: $refs.content.getBoundingClientRect().top + window.scrollY - 180, behavior: 'smooth' }); } else { expanded = true; }" 
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

                        <!-- Product Category FAQ Section -->
                        <?php
                        $product_terms = get_the_terms( get_the_ID(), 'product_cat' );
                        $faq = ['title' => '', 'intro' => '', 'items' => []];
                        if ( ! empty( $product_terms ) && ! is_wp_error( $product_terms ) ) {
                            $primary_term = $product_terms[0];
                            $catalog_repo = new \HacoLED\Theme\Repositories\CatalogRepository();
                            $faq = $catalog_repo->categoryFaq( $primary_term );
                        }
                        if ( ! empty( $faq['items'] ) ) :
                        ?>
                          <div class="mt-12 pt-8 border-t border-slate-100">
                            <div class="flex flex-col gap-2 mb-6">
                              <h3 class="text-lg md:text-xl font-heading font-extrabold text-slate-900 tracking-tight">
                                <?php echo esc_html(!empty($faq['title']) ? $faq['title'] : __('Câu hỏi thường gặp về sản phẩm', 'hacoled')); ?>
                              </h3>
                              <?php if (!empty($faq['intro'])): ?>
                                <p class="text-xs md:text-sm text-slate-500 leading-relaxed max-w-3xl mt-1">
                                  <?php echo wp_kses_post($faq['intro']); ?>
                                </p>
                              <?php endif; ?>
                            </div>

                            <div class="space-y-4" x-data="{ openFaq: 0 }">
                              <?php foreach ($faq['items'] as $faq_idx => $faqItem): ?>
                                <details class="group rounded-2xl border border-slate-200/80 bg-slate-50/40 p-4 transition-all duration-300 open:border-[#D90429]/30 open:bg-white open:shadow-[0_15px_30px_rgba(217,4,41,0.03)]"
                                  :open="openFaq === <?php echo $faq_idx; ?>"
                                  @toggle="if ($event.target.open) openFaq = <?php echo $faq_idx; ?>">
                                  <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-xs md:text-sm font-heading font-extrabold text-slate-800 transition-colors hover:text-[#D90429] group-open:text-[#D90429] [&_::-webkit-details-marker]:hidden">
                                    <span><?php echo esc_html($faqItem['question']); ?></span>
                                    <i class="ph-bold ph-caret-down text-slate-500 transition-transform duration-300 group-open:text-[#D90429] group-open:rotate-180 text-xs md:text-sm"></i>
                                  </summary>
                                  <div class="border-t border-slate-100 mt-3 pt-3 text-[12px] md:text-xs leading-relaxed text-slate-600 prose prose-slate max-w-none">
                                    <?php echo wp_kses_post($faqItem['answer']); ?>
                                  </div>
                                </details>
                              <?php endforeach; ?>
                            </div>
                          </div>
                        <?php endif; ?>
                    </div>

                    <!-- Tab 2: Specs content -->
                    <div x-show="activeTab === 'specs'" x-transition:enter="transition ease-out duration-200" style="display: none;">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2 border-b border-gray-100 pb-3">
                            <i class="ph-bold ph-sliders text-[#D90429]"></i>
                            Thông số kỹ thuật chi tiết
                        </h3>
                        <div class="specs-table-wrapper overflow-hidden rounded-xl border border-gray-100 text-xs">
                            <?php 
                            global $product;
                            do_action( 'woocommerce_product_additional_information', $product );
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Sidebar Widgets (1/4 - 3 Cols) -->
            <div class="lg:col-span-3 self-stretch">
                <div class="space-y-6 lg:sticky lg:top-32 lg:z-20 w-full">
                
                <!-- Widget 1: Sản phẩm cùng danh mục -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                    <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                        <i class="ph-bold ph-squares-four text-[#D90429]"></i>
                        Sản phẩm cùng danh mục
                    </h3>
                    <div class="space-y-4">
                        <?php
                        $terms = wp_get_post_terms( get_the_ID(), 'product_cat', array( 'fields' => 'ids' ) );
                        if ( ! empty( $terms ) ) {
                            $cat_products_query = new WP_Query( array(
                                'post_type'      => 'product',
                                'posts_per_page' => 4,
                                'post__not_in'   => array( get_the_ID() ),
                                'tax_query'      => array(
                                    array(
                                        'taxonomy' => 'product_cat',
                                        'field'    => 'term_id',
                                        'terms'    => $terms,
                                    ),
                                ),
                            ) );
                            if ( $cat_products_query->have_posts() ) :
                                while ( $cat_products_query->have_posts() ) : $cat_products_query->the_post();
                                    $rel_product = wc_get_product( get_the_ID() );
                                    $rel_price   = $rel_product ? $rel_product->get_price_html() : '';
                                    ?>
                                    <div class="flex items-center gap-3 group">
                                        <a href="<?php the_permalink(); ?>" class="w-12 h-12 rounded-lg border border-gray-100 overflow-hidden flex-shrink-0 bg-gray-50">
                                            <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'w-full h-full object-cover transition-transform duration-300 group-hover:scale-110' ) ); ?>
                                        </a>
                                        <div class="min-w-0 flex-1">
                                            <a href="<?php the_permalink(); ?>" class="text-xs font-semibold text-gray-800 hover:text-[#D90429] transition-colors line-clamp-2 leading-tight">
                                                <?php the_title(); ?>
                                            </a>
                                            <div class="text-[11px] font-bold text-[#D90429] mt-0.5">
                                                <?php echo ! empty( $rel_price ) ? $rel_price : 'Liên hệ tư vấn'; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                                wp_reset_postdata();
                            else :
                                echo '<p class="text-xs text-gray-400">Không có sản phẩm cùng danh mục.</p>';
                            endif;
                        } else {
                            echo '<p class="text-xs text-gray-400">Không tìm thấy danh mục sản phẩm.</p>';
                        }
                        ?>
                    </div>
                </div>

                <!-- Widget 2: Dự án mới nhất -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                    <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                        <i class="ph-bold ph-monitor text-[#D90429]"></i>
                        Dự án tiêu biểu mới
                    </h3>
                    <div class="space-y-4">
                        <?php
                        $projects_query = new WP_Query( array(
                            'post_type'      => 'post',
                            'posts_per_page' => 3,
                            'category_name'  => 'du-an-tieu-bieu-moi',
                        ) );
                        if ( !$projects_query->have_posts() ) {
                            $projects_query = new WP_Query( array(
                                'post_type'      => 'post',
                                'posts_per_page' => 3,
                                'category_name'  => 'projects,du-an,hang-muc-da-thi-cong',
                            ) );
                        }
                        if ( $projects_query->have_posts() ) :
                            while ( $projects_query->have_posts() ) : $projects_query->the_post();
                                ?>
                                <div class="flex items-center gap-3 group">
                                    <a href="<?php the_permalink(); ?>" class="w-14 h-10 rounded overflow-hidden flex-shrink-0 bg-gray-50">
                                        <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'w-full h-full object-cover transition-transform duration-300 group-hover:scale-110' ) ); ?>
                                    </a>
                                    <div class="min-w-0 flex-1">
                                        <a href="<?php the_permalink(); ?>" class="text-xs font-semibold text-gray-800 hover:text-[#D90429] transition-colors line-clamp-2 leading-tight">
                                            <?php the_title(); ?>
                                        </a>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<p class="text-xs text-gray-400">Không có dự án tiêu biểu.</p>';
                        endif;
                        ?>
                    </div>
                </div>

                <!-- Widget 3: Bài viết mới nhất -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                    <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
                        <i class="ph-bold ph-newspaper text-[#D90429]"></i>
                        Tin tức công nghệ LED
                    </h3>
                    <div class="space-y-4">
                        <?php
                        $proj_cat = get_category_by_slug('projects');
                        $exclude_cat = $proj_cat ? -$proj_cat->term_id : '';
                        $news_query = new WP_Query( array(
                            'post_type'      => 'post',
                            'posts_per_page' => 3,
                            'cat'            => $exclude_cat,
                        ) );
                        if ( $news_query->have_posts() ) :
                            while ( $news_query->have_posts() ) : $news_query->the_post();
                                ?>
                                <div class="flex items-center gap-3 group">
                                    <a href="<?php the_permalink(); ?>" class="w-12 h-12 rounded-lg border border-gray-100 overflow-hidden flex-shrink-0 bg-gray-50">
                                        <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'w-full h-full object-cover transition-transform duration-300 group-hover:scale-110' ) ); ?>
                                    </a>
                                    <div class="min-w-0 flex-1">
                                        <a href="<?php the_permalink(); ?>" class="text-xs font-semibold text-gray-800 hover:text-[#D90429] transition-colors line-clamp-2 leading-tight">
                                            <?php the_title(); ?>
                                        </a>
                                        <span class="text-[10px] text-gray-400"><?php echo get_the_date('d/m/Y'); ?></span>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<p class="text-xs text-gray-400">Không có bài viết mới.</p>';
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 3: REVIEWS -->
    <div class="max-w-[1440px] w-full mx-auto px-0">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:p-8 mt-8">
            <h2 class="text-xl font-bold text-gray-900 pb-4 border-b border-gray-100 mb-6 flex items-center gap-2">
                <i class="ph-bold ph-star text-amber-500 text-xl"></i>
                <span>Đánh giá từ khách hàng</span>
            </h2>
            <div class="reviews-content">
                <?php 
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
                ?>
            </div>
        </div>
    </div>

    <!-- SECTION 4: RELATED PRODUCTS -->
    <div class="max-w-[1440px] w-full mx-auto px-0">
        <div class="mt-12 pt-8 border-t border-gray-200/80">
            <?php 
            // Hook this block to display default related products or upsells if configured
            do_action( 'woocommerce_after_single_product_summary' ); 
            ?>
        </div>
    </div>

</div>

<!-- Fade-in Animation Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var fadeEls = document.querySelectorAll('.sp-fade-in');
    fadeEls.forEach(function(el, index) {
        setTimeout(function() {
            el.classList.add('visible');
            // Dispatch custom event so Swiper can init after visibility
            try { el.dispatchEvent(new Event('sp-visible')); } catch(e) {}
        }, index * 200);
    });
});
</script>

<?php do_action( 'woocommerce_after_single_product' ); ?>

