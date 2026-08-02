<?php
/**
 * Single Product Up-Sells Template Override for HacoLED Theme
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     4.0.0
 *
 * @var array $upsells
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) : ?>

	<section class="up-sells upsells products mt-16 pt-10 border-t border-gray-200/80 relative">
		<!-- Background ambient glow -->
		<div class="absolute -top-12 left-1/2 -translate-x-1/2 w-[500px] h-48 bg-red-500/5 rounded-full blur-3xl pointer-events-none -z-10"></div>

		<!-- Section Header -->
		<div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8 lg:mb-10">
			<div>
				<div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 border border-red-200/80 text-[#D90429] text-[11px] font-extrabold uppercase tracking-widest mb-2.5 shadow-xs">
					<i class="ph-bold ph-heart text-xs"></i> Đề xuất cho bạn
				</div>
				<h2 class="text-2xl lg:text-3xl font-extrabold text-gray-900 tracking-tight">Có Thể Bạn Cũng Thích</h2>
				<p class="text-xs lg:text-sm text-gray-500 font-medium mt-1">Các dòng sản phẩm tối ưu, nâng cấp cấu hình phù hợp với nhu cầu của bạn</p>
			</div>
			
			<div class="hidden sm:flex items-center gap-2 pb-1">
				<span class="w-10 h-1 bg-[#D90429] rounded-full"></span>
				<span class="w-2.5 h-1 bg-red-200 rounded-full"></span>
				<span class="w-1.5 h-1 bg-red-100 rounded-full"></span>
			</div>
		</div>

		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 lg:gap-7">
			<?php foreach ( $upsells as $upsell ) : ?>

				<?php
				$post_object = get_post( $upsell->get_id() );

				setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

				wc_get_template_part( 'content', 'product' );
				?>

			<?php endforeach; ?>
		</div>

	</section>
	<?php
endif;

wp_reset_postdata();
