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
         headerHeight: 70,
         updateHeaderHeight() {
             let hdr = document.getElementById('site-header');
             if (hdr) {
                 this.headerHeight = Math.round(hdr.getBoundingClientRect().height);
             }
         }
     }"
     x-init="updateHeaderHeight(); window.addEventListener('resize', () => updateHeaderHeight())"
     @scroll.window="
         updateHeaderHeight();
         showStickyBar = (window.scrollY > 450);
     ">

    <!-- STICKY PRODUCT SUB-HEADER (Executive Solid White Style) -->
    <div x-show="showStickyBar"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="-translate-y-full opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="translate-y-0 opacity-100"
         x-transition:leave-end="-translate-y-full opacity-0"
         :style="{ top: (headerHeight - 1) + 'px' }"
         class="fixed left-0 w-full bg-white border-b border-gray-200 z-[210] shadow-md hidden lg:block"
         x-cloak>
        <div class="max-w-[1440px] mx-auto px-6 lg:px-10 py-3.5 flex items-center justify-between gap-6">
            <!-- Left Side: Title & Badges Below Title -->
            <div class="flex flex-col gap-1.5 justify-center min-w-0">
                <!-- Row 1: Full Title + Brand Badge -->
                <div class="flex items-center gap-3">
                    <span class="text-slate-900 font-bold text-base lg:text-lg tracking-tight leading-snug"><?php the_title(); ?></span>
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-red-50 border border-red-200 text-red-600 text-[10px] font-extrabold uppercase tracking-wider shrink-0 shadow-xs">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span> Chính Hãng
                    </span>
                </div>

                <!-- Row 2: Badges (CO/CQ, Bảo hành, Vẽ 3D) sitting under title -->
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 border border-emerald-200/70 text-[11px] font-semibold">
                        <i class="ph-bold ph-shield-check text-emerald-600"></i> CO/CQ đầy đủ
                    </span>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-amber-50 text-amber-700 border border-amber-200/70 text-[11px] font-semibold">
                        <i class="ph-bold ph-star text-amber-600"></i> Bảo hành 24–36T
                    </span>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-sky-50 text-sky-700 border border-sky-200/70 text-[11px] font-semibold">
                        <i class="ph-bold ph-package text-sky-600"></i> Thiết kế 3D Free
                    </span>
                </div>
            </div>
            
            <!-- Right Side: Regular Price (Giá Gốc) + Selling Price (Giá Bán) + CTA -->
            <div class="flex items-center gap-6 xl:gap-8 shrink-0">
                <!-- Price Display (Giác gốc + Giá bán, balanced size) -->
                <div class="flex items-baseline gap-2">
                    <div class="sp-sticky-price-inline flex items-baseline gap-2">
                        <?php echo ! empty( $price_html ) ? $price_html : '<span class="text-base lg:text-lg font-bold text-slate-900 tracking-tight">Liên hệ</span>'; ?>
                    </div>
                </div>
                
                <!-- CTA Button -->
                <a href="<?php echo esc_url( hacoled_managed_page_url( 'contact' ) ); ?>"
                   class="bg-[#D90429] hover:bg-[#b90323] text-white font-bold px-7 py-2.5 rounded-xl flex items-center justify-center gap-2 transition-all duration-300 text-xs lg:text-sm uppercase tracking-wider shadow-md hover:-translate-y-0.5 whitespace-nowrap">
                    <i class="ph-bold ph-headset text-base"></i> Nhận Báo Giá Ngay
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

                    <!-- PRIVILEGES CARD — Premium Vibrant Red & Gold (Trống Đồng Đông Sơn) -->
                    <div class="sp-privileges-card relative rounded-2xl p-5 md:p-6 lg:p-7 mb-6 overflow-hidden">
                        <!-- Gold mat inner frame -->
                        <div class="sp-priv-red-mat"></div>

                        <!-- Trống đồng Đông Sơn image pattern (header brand asset) -->
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-0 overflow-hidden">
                            <div class="w-[440px] h-[440px] md:w-[540px] md:h-[540px] bg-no-repeat bg-center bg-contain opacity-20"
                                 style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/dongson-optimized.webp'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%);"></div>
                        </div>

                        <!-- Base background gradient -->
                        <div class="absolute inset-0 bg-gradient-to-br from-[#a8031d] via-[#d90429] to-[#65000f] -z-10"></div>
                        <!-- Gold radial ambient glow -->
                        <div class="absolute inset-0 -z-10 opacity-30" style="background:radial-gradient(ellipse at 50% 0%, rgba(255,215,0,.35), transparent 65%);"></div>
                        <!-- Gold glow orbs -->
                        <div class="absolute -top-16 -right-10 w-56 h-56 bg-[#FFD700] rounded-full opacity-[0.12] blur-[60px] pointer-events-none"></div>
                        <div class="absolute -bottom-16 -left-10 w-44 h-44 bg-[#FFA500] rounded-full opacity-[0.10] blur-[50px] pointer-events-none"></div>
                        <!-- Glossy sweep -->
                        <div class="absolute inset-0 sp-priv-gloss pointer-events-none"></div>
                        <!-- Top specular hairline -->
                        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/50 to-transparent"></div>

                        <!-- Header -->
                        <div class="flex items-center gap-3.5 mb-2 relative z-10">
                            <div class="w-11 h-11 md:w-12 md:h-12 rounded-xl flex items-center justify-center text-[#3a1f05] shadow-lg shrink-0"
                                 style="background:linear-gradient(135deg,#ffffff,#ffe89c 45%,#ffd700 70%,#d49214); box-shadow: 0 4px 14px rgba(0,0,0,.35), inset 0 1px 1px rgba(255,255,255,.8);">
                                <i class="ph-bold ph-crown text-xl text-[#851800]"></i>
                            </div>
                            <div>
                                <h3 class="sp-priv-gold-text font-extrabold text-base md:text-lg tracking-[0.1em] uppercase">Đặc Quyền Dịch Vụ</h3>
                                <p class="text-[11px] md:text-xs text-[#FFF3D1] font-semibold mt-0.5 tracking-wide">Dẫn dầu thị trường </p>
                            </div>
                        </div>
                        <div class="sp-priv-gold-hairline sp-priv-shimmer mb-5 relative z-10"></div>

                        <!-- 2 Columns -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 lg:gap-6 relative z-10">
                            <!-- Cam kết vàng -->
                            <div>
                                <h4 class="text-xs lg:text-sm font-bold text-[#FFE8A3] uppercase tracking-wider mb-3 flex items-center gap-2.5">
                                    <span class="w-7 h-7 rounded-lg flex items-center justify-center border border-[#FFD700]/40 bg-[#000000]/20 shadow-sm">
                                        <i class="ph-bold ph-shield-check text-[#FFD700] text-sm"></i>
                                    </span>
                                    Cam kết vàng
                                </h4>
                                <ul class="space-y-2.5">
                                    <li class="flex items-start gap-2.5 text-white/95 hover:text-white transition-colors">
                                        <i class="ph-bold ph-check-circle text-[#FFD700] text-base mt-0.5 flex-shrink-0"></i>
                                        <span class="text-sm leading-snug font-medium">Hàng chính hãng 100% (CO/CQ)</span>
                                    </li>
                                    <li class="flex items-start gap-2.5 text-white/95 hover:text-white transition-colors">
                                        <i class="ph-bold ph-check-circle text-[#FFD700] text-base mt-0.5 flex-shrink-0"></i>
                                        <span class="text-sm leading-snug font-medium">Nguồn gốc xuất xứ rõ ràng</span>
                                    </li>
                                    <li class="flex items-start gap-2.5 text-white/95 hover:text-white transition-colors">
                                        <i class="ph-bold ph-check-circle text-[#FFD700] text-base mt-0.5 flex-shrink-0"></i>
                                        <span class="text-sm leading-snug font-medium">Giá cạnh tranh nhất thị trường</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Ưu đãi lớn -->
                            <div class="md:pl-6 md:border-l md:border-[#FFD700]/25">
                                <h4 class="text-xs lg:text-sm font-bold text-[#FFE8A3] uppercase tracking-wider mb-3 flex items-center gap-2.5">
                                    <span class="w-7 h-7 rounded-lg flex items-center justify-center border border-[#FFD700]/40 bg-[#000000]/20 shadow-sm">
                                        <i class="ph-bold ph-gift text-[#FFD700] text-sm"></i>
                                    </span>
                                    Ưu đãi lớn
                                </h4>
                                <ul class="space-y-2.5">
                                    <li class="flex items-start gap-2.5 text-white/95 hover:text-white transition-colors">
                                        <i class="ph-bold ph-star text-[#FFD700] text-base mt-0.5 flex-shrink-0"></i>
                                        <span class="text-sm leading-snug font-medium">Bảo hành chính hãng 24 – 36 tháng</span>
                                    </li>
                                    <li class="flex items-start gap-2.5 text-white/95 hover:text-white transition-colors">
                                        <i class="ph-bold ph-star text-[#FFD700] text-base mt-0.5 flex-shrink-0"></i>
                                        <span class="text-sm leading-snug font-medium">Tư vấn kỹ thuật MIỄN PHÍ 24/7</span>
                                    </li>
                                    <li class="flex items-start gap-2.5 text-white/95 hover:text-white transition-colors">
                                        <i class="ph-bold ph-star text-[#FFD700] text-base mt-0.5 flex-shrink-0"></i>
                                        <span class="text-sm leading-snug font-medium">Khảo sát hiện trạng &amp; vẽ 3D miễn phí</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Trọn bộ thiết bị -->
                        <div class="mt-5 pt-4 relative z-10">
                            <div class="sp-priv-gold-hairline mb-3.5"></div>
                            <h4 class="text-xs lg:text-sm font-bold text-[#FFE8A3] uppercase tracking-wider mb-2 flex items-center gap-2.5">
                                <span class="w-7 h-7 rounded-lg flex items-center justify-center border border-[#FFD700]/40 bg-[#000000]/20 shadow-sm">
                                    <i class="ph-bold ph-package text-[#FFD700] text-sm"></i>
                                </span>
                                Trọn bộ thiết bị
                            </h4>
                            <div class="rounded-xl p-3 lg:p-3.5 border border-[#FFD700]/30 shadow-inner" style="background: rgba(0, 0, 0, 0.22);">
                                <p class="text-xs lg:text-sm text-white/90 leading-relaxed font-medium">
                                    Module LED nhập khẩu cao cấp, Video Processor chuyên dụng, Khung nhôm định hình, Nguồn &amp; cáp tín hiệu đồng bộ.
                                </p>
                            </div>
                        </div>
                    </div>

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

    <!-- SECTION 2: TABS & SIDEBAR (2/3 vs 1/3) -->
    <div class="max-w-[1440px] w-full mx-auto px-0">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 pt-8 border-t border-gray-200/80" x-data="{ activeTab: 'info' }">
            
            <!-- Left: Product Tabs (2/3 - 8 Cols) -->
            <div class="lg:col-span-8 min-w-0 space-y-6">
                
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
                    <!-- Tab 1: Info content (Alpine.js Read-More) -->
                    <div x-show="activeTab === 'info'" 
                         x-transition:enter="transition ease-out duration-200" 
                         x-data="{ expanded: false, showButton: false, checkHeight() { this.showButton = this.$refs.content ? this.$refs.content.scrollHeight > 280 : false; } }" 
                         x-init="checkHeight(); $nextTick(() => checkHeight()); window.addEventListener('load', () => checkHeight()); if (window.ResizeObserver && $refs.content) { new ResizeObserver(() => checkHeight()).observe($refs.content); }"
                         style="overflow-anchor: none;"
                         class="relative">
                        <div x-ref="content" 
                             :class="expanded ? '' : 'max-h-[280px] overflow-hidden'" 
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

            <!-- Right: Sidebar Widgets (1/3 - 4 Cols) -->
            <div class="lg:col-span-4 min-w-0 space-y-6 lg:sticky lg:top-[120px] lg:self-start">
                
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
                            'category_name'  => 'projects',
                        ) );
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

