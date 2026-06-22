<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override of WooCommerce template for HacoLED theme.
 * Design: Premium B2B with 3D Coverflow Gallery
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
     x-data="{ showStickyBar: false }"
     @scroll.window="showStickyBar = (window.scrollY > 600)">

    <!-- STICKY PRODUCT SUB-HEADER (Samsung Style) -->
    <div x-show="showStickyBar"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="-translate-y-full opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="translate-y-0 opacity-100"
         x-transition:leave-end="-translate-y-full opacity-0"
         class="fixed top-[56px] left-0 w-full bg-white/90 backdrop-blur-md border-b border-gray-200/80 z-[140] shadow-sm hidden lg:block"
         x-cloak>
        <div class="max-w-[1440px] mx-auto px-4 lg:px-8 h-14 flex items-center justify-between">
            <!-- Left Side: Title & Badge -->
            <div class="flex items-center gap-3">
                <span class="text-slate-800 font-extrabold text-sm tracking-tight leading-none"><?php the_title(); ?></span>
                <span class="px-2 py-0.5 rounded bg-red-50 border border-red-150 text-[9px] font-bold text-red-600 uppercase tracking-wider">Chính Hãng</span>
            </div>
            
            <!-- Right Side: Spacing, Pricing, Privileges, CTA -->
            <div class="flex items-center gap-6">
                <!-- Short privileges -->
                <div class="hidden xl:flex items-center gap-4 text-[10.5px] text-slate-500 font-medium border-r border-slate-200 pr-5">
                    <span class="flex items-center gap-1"><i class="ph-bold ph-shield-check text-emerald-500"></i> CO/CQ đầy đủ</span>
                    <span class="flex items-center gap-1"><i class="ph-bold ph-star text-red-400"></i> Bảo hành 24-36T</span>
                    <span class="flex items-center gap-1"><i class="ph-bold ph-sketch-logo text-blue-500"></i> Thiết kế 3D Free</span>
                </div>
                
                <!-- Price -->
                <div class="flex items-baseline gap-1 opacity-90 leading-none">
                    <span class="text-[9px] text-slate-400 uppercase tracking-widest font-semibold mr-1">Giá từ</span>
                    <div class="sp-price-inline flex items-baseline gap-1 text-xs">
                        <?php echo ! empty( $price_html ) ? $price_html : '<span class="text-sm font-extrabold text-gray-900 tracking-tight">Liên hệ</span>'; ?>
                    </div>
                </div>
                
                <!-- CTA Button -->
                <a href="<?php echo esc_url( home_url( '/lien-he/' ) ); ?>" 
                   class="bg-[#D90429] hover:bg-[#b90323] text-white font-extrabold px-6 py-2 rounded-lg flex items-center justify-center gap-1.5 transition-all duration-300 text-[10.5px] uppercase tracking-wider shadow-md hover:-translate-y-0.5">
                    <i class="ph-bold ph-headset text-xs"></i> Nhận Báo Giá
                </a>
            </div>
        </div>
    </div>

    <!-- SECTION 1: HERO (50/50 Grid — Info Left, 3D Gallery Right) -->
    <section class="relative pt-1 pb-10 lg:pb-16 flex items-center sp-hero-section overflow-hidden">
        <!-- Subtle Glow Background -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-[1440px] h-full pointer-events-none -z-10 flex justify-between">
            <div class="w-[30rem] h-[30rem] bg-red-50 rounded-full mix-blend-multiply filter blur-[100px] opacity-70 -ml-20 mt-10"></div>
            <div class="w-[30rem] h-[30rem] bg-gray-100 rounded-full mix-blend-multiply filter blur-[100px] opacity-70 mr-10 mt-40"></div>
        </div>

        <div class="max-w-[1440px] w-full mx-auto px-0 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                
                <!-- LEFT COLUMN: Info & Privileges -->
                <div class="flex flex-col sp-fade-in z-20 justify-center">
                    
                    <!-- Breadcrumb (WooCommerce hooks handle this via woocommerce_before_main_content) -->

                    <!-- Title & Desc -->
                    <div class="flex flex-col items-start mb-5">
                        <!-- Category Badge -->
                        <?php
                        $terms = get_the_terms( $product->get_id(), 'product_cat' );
                        $cat_name = ( ! empty( $terms ) ) ? esc_html( $terms[0]->name ) : 'Sản phẩm';
                        ?>
                        <div class="inline-flex items-center border border-red-200 px-2.5 py-1 bg-red-50 text-red-600 text-[10px] font-bold rounded-full mb-3 tracking-widest shadow-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-2 animate-pulse"></span> <?php echo strtoupper( $cat_name ); ?>
                        </div>

                        <!-- Product Title H1 -->
                        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 tracking-tight leading-[1.15] mb-3">
                            <?php the_title(); ?>
                        </h1>

                        <!-- Short Description -->
                        <div class="text-gray-500 text-xs leading-relaxed font-light pl-4 border-l-2 border-gray-200 sp-excerpt-block">
                            <?php woocommerce_template_single_excerpt(); ?>
                        </div>
                    </div>

                    <!-- PRIVILEGES CARD -->
                    <div class="bg-gradient-to-br from-white to-red-50/10 border border-gray-200 rounded-2xl p-4 md:p-5 mb-5 shadow-[0_8px_30px_rgba(0,0,0,0.02)] relative overflow-hidden group">
                        
                        <!-- Header -->
                        <div class="flex items-center gap-2.5 mb-4 relative z-10 pb-3 border-b border-gray-100">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#D90429] to-red-600 flex items-center justify-center text-white shadow-md shadow-red-200">
                                <i class="ph-bold ph-crown text-xs"></i>
                            </div>
                            <div>
                                <h3 class="text-gray-900 font-extrabold text-xs tracking-wide uppercase">Đặc Quyền Dịch Vụ</h3>
                                <p class="text-[10px] text-gray-500 font-medium mt-0.5">Dành riêng cho dự án B2B</p>
                            </div>
                        </div>

                        <!-- 2 Columns: Cam kết & Ưu đãi -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 relative z-10">
                            <div>
                                <h4 class="text-[10px] font-bold text-gray-800 uppercase tracking-wider mb-2.5 flex items-center gap-1.5">
                                    <i class="ph-bold ph-shield-check text-emerald-500 text-xs"></i> Cam kết vàng
                                </h4>
                                <ul class="space-y-2">
                                    <li class="flex items-start gap-2 text-gray-600 hover:text-gray-900 transition-colors">
                                        <i class="ph-bold ph-check-circle text-emerald-500 text-[10px] mt-0.5"></i>
                                        <span class="text-xs leading-snug font-medium">Hàng chính hãng 100% (CO/CQ)</span>
                                    </li>
                                    <li class="flex items-start gap-2 text-gray-600 hover:text-gray-900 transition-colors">
                                        <i class="ph-bold ph-check-circle text-emerald-500 text-[10px] mt-0.5"></i>
                                        <span class="text-xs leading-snug font-medium">Nguồn gốc xuất xứ rõ ràng</span>
                                    </li>
                                    <li class="flex items-start gap-2 text-gray-600 hover:text-gray-900 transition-colors">
                                        <i class="ph-bold ph-check-circle text-emerald-500 text-[10px] mt-0.5"></i>
                                        <span class="text-xs leading-snug font-medium">Giá cạnh tranh nhất thị trường</span>
                                    </li>
                                </ul>
                            </div>
                            
                            <div>
                                <h4 class="text-[10px] font-bold text-gray-800 uppercase tracking-wider mb-2.5 flex items-center gap-1.5">
                                    <i class="ph-bold ph-gift text-red-500 text-xs"></i> Ưu đãi lớn
                                </h4>
                                <ul class="space-y-2">
                                    <li class="flex items-start gap-2 text-gray-600 hover:text-gray-900 transition-colors">
                                        <i class="ph-bold ph-star text-red-400 text-[10px] mt-0.5"></i>
                                        <span class="text-xs leading-snug font-medium">Bảo hành chính hãng 24 – 36 tháng</span>
                                    </li>
                                    <li class="flex items-start gap-2 text-gray-600 hover:text-gray-900 transition-colors">
                                        <i class="ph-bold ph-star text-red-400 text-[10px] mt-0.5"></i>
                                        <span class="text-xs leading-snug font-medium">Tư vấn kỹ thuật MIỄN PHÍ 24/7</span>
                                    </li>
                                    <li class="flex items-start gap-2 text-gray-600 hover:text-gray-900 transition-colors">
                                        <i class="ph-bold ph-star text-red-400 text-[10px] mt-0.5"></i>
                                        <span class="text-xs leading-snug font-medium">Khảo sát hiện trạng & vẽ 3D miễn phí</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Trọn bộ thiết bị -->
                        <div class="mt-4 pt-3.5 border-t border-gray-100 relative z-10">
                            <h4 class="text-[10px] font-bold text-gray-800 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                                <i class="ph-bold ph-package text-blue-500 text-xs"></i> Trọn bộ thiết bị
                            </h4>
                            <div class="bg-gray-50/80 rounded-lg p-2.5 border border-gray-100">
                                <p class="text-[10.5px] text-gray-600 leading-relaxed font-medium">
                                    Module LED nhập khẩu cao cấp, Video Processor chuyên dụng, Khung nhôm định hình, Nguồn & cáp tín hiệu đồng bộ.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- CTA & Price Row (Price Left, CTA Right) -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-4 w-full">
                        <div class="flex flex-col items-start opacity-90">
                            <span class="text-[10px] text-gray-500 uppercase tracking-widest font-semibold mb-0.5">Giá tham khảo từ</span>
                            <div class="sp-price-inline flex items-baseline gap-1">
                                <?php 
                                $price_html = $product->get_price_html();
                                echo ! empty( $price_html ) ? $price_html : '<span class="text-xl font-extrabold text-gray-900 tracking-tight">Liên hệ</span>'; 
                                ?>
                            </div>
                        </div>

                        <a href="<?php echo esc_url( home_url( '/lien-he/' ) ); ?>" 
                           class="w-full sm:w-auto bg-[#D90429] hover:bg-[#b90323] text-white font-bold px-8 py-3.5 rounded-xl flex items-center justify-center gap-2.5 transition-all duration-300 shadow-[0_10px_20px_rgba(217,4,41,0.20)] hover:-translate-y-1 text-xs uppercase tracking-wider whitespace-nowrap">
                            <i class="ph-bold ph-headset text-sm opacity-90"></i> Nhận Báo Giá Ngay
                        </a>
                    </div>
                </div>

                <!-- RIGHT COLUMN: 3D COVERFLOW GALLERY -->
                <div class="sp-fade-in w-full flex flex-col justify-center relative h-full">
                    <?php
                    // Renders hooks if any are left
                    do_action( 'woocommerce_before_single_product_summary' );
                    
                    $featured_image_id = $product->get_image_id();
                    $attachment_ids    = $product->get_gallery_image_ids();
                    
                    if ( $featured_image_id || ! empty( $attachment_ids ) ) :
                        // Count total slides for initialSlide
                        $total_slides = 0;
                        if ( $featured_image_id ) $total_slides++;
                        $total_slides += count( $attachment_ids );
                        $initial_slide = floor( $total_slides / 2 );
                    ?>
                        <div class="swiper sp-3d-gallery sp-3d-container">
                            <div class="swiper-wrapper">
                                <?php if ( $featured_image_id ) : ?>
                                    <div class="swiper-slide sp-3d-slide group relative">
                                        <?php if ( $product->is_on_sale() ) : ?>
                                            <div class="absolute top-4 left-4 bg-red-600 text-white text-[10px] font-bold px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg z-20">
                                                Giảm giá!
                                            </div>
                                        <?php endif; ?>
                                        <?php echo wp_get_attachment_image( $featured_image_id, 'large', false, array( 'class' => 'w-full h-full object-cover' ) ); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php foreach ( $attachment_ids as $attachment_id ) : ?>
                                    <div class="swiper-slide sp-3d-slide group">
                                        <?php echo wp_get_attachment_image( $attachment_id, 'large', false, array( 'class' => 'w-full h-full object-cover' ) ); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <!-- Navigation Buttons -->
                            <div class="swiper-button-prev sp-3d-prev"></div>
                            <div class="swiper-button-next sp-3d-next"></div>
                            
                            <!-- Pagination Dots -->
                            <div class="swiper-pagination sp-3d-pagination mt-8 relative bottom-0"></div>
                        </div>

                        <!-- Swiper 3D Coverflow Init -->
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            if (typeof Swiper !== 'undefined') {
                                new Swiper('.sp-3d-gallery', {
                                    effect: 'coverflow',
                                    grabCursor: true,
                                    centeredSlides: true,
                                    slidesPerView: 'auto',
                                    initialSlide: <?php echo intval( $initial_slide ); ?>,
                                    coverflowEffect: {
                                        rotate: 0,
                                        stretch: 120, // Overlap slides tighter
                                        depth: 180,   // Pull-back scale
                                        modifier: 1,
                                        scale: 0.75,  // Inactive slides scale down more
                                        slideShadows: false,
                                    },
                                    navigation: {
                                        nextEl: '.sp-3d-next',
                                        prevEl: '.sp-3d-prev',
                                    },
                                    pagination: {
                                        el: '.sp-3d-pagination',
                                        clickable: true,
                                    },
                                    loop: true,
                                    autoplay: {
                                        delay: 4000,
                                        disableOnInteraction: false,
                                    }
                                });
                            }
                        });
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
            <div class="lg:col-span-8 space-y-6">
                
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
                         x-data="{ expanded: false, showButton: false }" 
                         x-init="showButton = $refs.content.scrollHeight > 280"
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
            <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-[120px] lg:self-start">
                
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
                                    global $product;
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
                                                <?php echo $product->get_price_html() ?: 'Liên hệ tư vấn'; ?>
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
        }, index * 200);
    });
});
</script>

<?php do_action( 'woocommerce_after_single_product' ); ?>

