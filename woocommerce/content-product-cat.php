<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product-cat.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** @var \WP_Term $category */
$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
$image_url    = $thumbnail_id ? wp_get_attachment_url( $thumbnail_id ) : '';
$link         = get_term_link( $category, 'product_cat' );
if ( is_wp_error( $link ) ) {
    $link = '#';
}
$count = $category->count;
?>
<div <?php wc_product_cat_class( 'h-full list-none', $category ); ?>>
    <div class="relative group w-full max-w-[400px] h-[310px] sm:h-[400px] md:h-[520px] rounded-[1.5rem] md:rounded-[2rem] transition-all duration-700 perspective-1000 mx-auto transform-gpu">
      
      <!-- Background chính của thẻ -->
      <div class="absolute inset-0 rounded-[1.5rem] md:rounded-[2rem] bg-white/60 backdrop-blur-2xl border border-white/80 overflow-hidden shadow-[0_10px_30px_rgba(227,0,15,0.06)] transition-all duration-700 group-hover:border-white group-hover:bg-white/95 group-hover:shadow-[0_16px_36px_rgba(227,0,15,0.22)] transform-gpu">
        
        <!-- Điểm nhấn ánh sáng khi hover -->
        <div class="absolute top-0 left-0 w-72 h-72 bg-gradient-to-br from-[#E3000F]/22 via-[#D4AF37]/15 to-transparent rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none z-0"></div>
        
        <!-- Link bao trọn card -->
        <a href="<?php echo esc_url($link); ?>" class="absolute inset-0 z-30" aria-label="<?php echo esc_attr($category->name); ?>">
          <span class="sr-only"><?php echo esc_html($category->name); ?></span>
        </a>

        <!-- Layout hiển thị hình ảnh danh mục -->
        <div class="absolute inset-0 p-2 md:p-4 pb-[135px] sm:pb-[180px] md:pb-[220px] flex items-start justify-center pt-4 md:pt-10 z-10 pointer-events-none">
          <div class="relative w-full h-full flex items-center justify-center">
              <!-- Họa tiết trống đồng -->
              <div class="absolute w-[140px] h-[140px] sm:w-[220px] sm:h-[220px] md:w-[320px] md:h-[320px] opacity-[0.10] group-hover:opacity-[0.20] transition-all duration-1000 ease-out group-hover:scale-105 group-hover:rotate-12 pointer-events-none" 
                   style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/dongson-optimized.webp'); background-repeat: no-repeat; background-position: center; background-size: contain; filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg);">
              </div>
            
            <div class="relative w-full h-full transition-all duration-700 ease-out transform group-hover:-translate-y-4 md:group-hover:-translate-y-6 group-hover:scale-90 origin-bottom">
              <?php if (!empty($image_url)): ?>
                <img 
                  src="<?php echo esc_url($image_url); ?>" 
                  alt="<?php echo esc_attr($category->name); ?>"
                  class="relative z-10 w-full h-full object-contain filter drop-shadow-[0_10px_15px_rgba(0,0,0,0.12)] md:drop-shadow-[0_20px_30px_rgba(0,0,0,0.15)]"
                  loading="lazy"
                />
              <?php else: ?>
                <div class="relative z-10 w-4/5 h-4/5 flex flex-col items-center justify-center bg-gradient-to-br from-slate-50 via-slate-100/60 to-red-50/40 rounded-2xl border border-dashed border-slate-200/80 p-4 text-center my-auto">
                  <i class="ph-bold ph-squares-four text-3xl md:text-4xl text-[#D90429]/40 mb-1"></i>
                  <span class="text-[9px] md:text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">HacoLED</span>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- Bảng thông tin bên dưới -->
        <div class="absolute bottom-2 md:bottom-4 left-2 md:left-4 right-2 md:right-4 z-20 pointer-events-none">
          <div class="relative bg-white/70 backdrop-blur-xl border border-white rounded-2xl md:rounded-3xl p-2.5 md:p-5 overflow-hidden transition-all duration-500 shadow-[0_10px_40px_rgba(0,0,0,0.05)] group-hover:bg-white/95 group-hover:shadow-[0_15px_50px_rgba(0,0,0,0.1)]">
            <div class="flex flex-col gap-1.5 md:gap-3">
              <div class="flex flex-wrap gap-1 md:gap-1.5">
                <span class="px-1.5 md:px-2.5 py-0.5 md:py-1 text-[8px] md:text-[9.5px] font-extrabold tracking-wider text-white bg-gradient-to-r from-[#E3000F] to-[#ff4d4d] rounded-md md:rounded-full uppercase shadow-sm">
                  <i class="ph-bold ph-folder-open"></i> Danh Mục Con
                </span>
                <?php if ($count > 0): ?>
                  <span class="px-1.5 md:px-2.5 py-0.5 md:py-1 text-[8px] md:text-[9.5px] font-bold tracking-wider text-amber-700 bg-amber-50/90 border border-amber-200/80 rounded-md md:rounded-full">
                    <?php echo sprintf(__('%d sản phẩm', 'hacoled'), $count); ?>
                  </span>
                <?php endif; ?>
              </div>

              <div class="flex items-center justify-between gap-2 md:gap-4 mt-0.5">
                <div class="flex-1">
                  <h3 class="text-xs md:text-lg font-bold text-gray-900 leading-tight group-hover:text-[#E3000F] transition-colors line-clamp-2">
                    <?php echo esc_html($category->name); ?>
                  </h3>
                </div>

                <div class="flex flex-shrink-0 w-6 h-6 md:w-10 md:h-10 items-center justify-center rounded-md md:rounded-2xl bg-gray-100 border border-gray-200 text-gray-600 transition-all duration-300 group-hover:bg-[#E3000F] group-hover:border-[#E3000F] group-hover:text-white group-hover:shadow-[0_0_20px_rgba(227,0,15,0.3)] group-hover:scale-105 pointer-events-auto relative z-40">
                  <i class="ph-bold ph-arrow-right text-[10px] md:text-lg transition-transform duration-300 group-hover:translate-x-0.5"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
</div>
