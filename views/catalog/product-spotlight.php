<?php
/**
 * Spotlight layout for individually selected WooCommerce products.
 *
 * @var string $header_type
 * @var string $footer_type
 */

defined('ABSPATH') || exit;

global $product;

$product_id = get_queried_object_id();
$product    = wc_get_product($product_id);

if (!$product) {
    $this->render('catalog/product', compact('header_type', 'footer_type'));
    return;
}

$this->renderHeader($header_type ?? 'default');

$image_url = get_the_post_thumbnail_url($product_id, 'full') ?: wc_placeholder_img_src('woocommerce_single');
?>

<main class="bg-slate-950 text-white pt-36 md:pt-56">
    <section class="relative overflow-hidden border-b border-white/10">
        <div class="absolute inset-0 opacity-20">
            <img src="<?php echo esc_url($image_url); ?>" alt="" class="h-full w-full object-cover blur-sm scale-105">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/95 to-slate-900/70"></div>

        <div class="relative z-10 mx-auto grid max-w-[1440px] grid-cols-1 items-center gap-10 px-4 py-16 lg:grid-cols-2 lg:px-8 lg:py-24">
            <div>
                <span class="inline-flex rounded-full border border-amber-400/30 bg-amber-400/10 px-4 py-2 text-[11px] font-bold uppercase tracking-[0.2em] text-amber-300">
                    <?php echo esc_html__('Sản phẩm nổi bật', 'hacoled'); ?>
                </span>
                <h1 class="mt-6 text-4xl font-black leading-tight sm:text-6xl">
                    <?php echo esc_html($product->get_name()); ?>
                </h1>
                <?php if ($product->get_short_description()) : ?>
                    <div class="mt-6 max-w-2xl text-base leading-8 text-slate-300">
                        <?php echo wp_kses_post(apply_filters('woocommerce_short_description', $product->get_short_description())); ?>
                    </div>
                <?php endif; ?>
                <?php if ($product->get_price_html()) : ?>
                    <div class="mt-7 text-2xl font-extrabold text-amber-300">
                        <?php echo wp_kses_post($product->get_price_html()); ?>
                    </div>
                <?php endif; ?>
                <a href="#chi-tiet-san-pham" class="mt-8 inline-flex items-center rounded-full bg-red-600 px-7 py-3.5 text-sm font-bold text-white shadow-lg transition hover:bg-red-500">
                    <?php echo esc_html__('Xem cấu hình và báo giá', 'hacoled'); ?>
                </a>
            </div>

            <div class="relative mx-auto w-full max-w-xl">
                <div class="absolute inset-8 rounded-full bg-red-600/20 blur-3xl"></div>
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($product->get_name()); ?>" class="relative aspect-square w-full rounded-3xl border border-white/10 object-cover shadow-2xl">
            </div>
        </div>
    </section>

    <section id="chi-tiet-san-pham" class="bg-[#FAFAFA] py-16 text-slate-800">
        <div class="mx-auto max-w-[1440px] px-4 lg:px-8">
            <div class="mb-6 text-xs text-slate-500">
                <?php do_action('woocommerce_before_main_content'); ?>
            </div>
            <div class="woocommerce-content-container">
                <?php woocommerce_content(); ?>
            </div>
            <?php do_action('woocommerce_after_main_content'); ?>
        </div>
    </section>
</main>

<?php $this->renderFooter($footer_type ?? 'default'); ?>
