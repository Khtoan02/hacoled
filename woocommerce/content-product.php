<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$terms = get_the_terms( $product->get_id(), 'product_cat' );
$category_name = ( ! empty( $terms ) && ! is_wp_error( $terms ) ) ? $terms[0]->name : __('Màn hình LED', 'hacoled');

// Instantiate controller to render the component
$controller = new \App\Controllers\ProductController();
?>
<div <?php wc_product_class( 'h-full', $product ); ?>>
    <?php
    $controller->renderComponent('product-card', [
        'title'        => get_the_title(),
        'description'  => $product->get_short_description() ?: get_the_excerpt(),
        'permalink'    => get_permalink(),
        'thumbnail'    => get_the_post_thumbnail_url(get_the_ID(), 'large') ?: '',
        'price'        => $product->get_price_html() ?: __('Liên hệ', 'hacoled'),
        'category'     => $category_name,
        'pitch'        => get_post_meta(get_the_ID(), '_led_pitch', true) ?: (get_post_meta(get_the_ID(), '_product_pitch', true) ?: 'P2.5'),
        'brightness'   => get_post_meta(get_the_ID(), '_led_brightness', true) ?: (get_post_meta(get_the_ID(), '_product_brightness', true) ?: '1000 nits'),
        'refresh_rate' => get_post_meta(get_the_ID(), '_led_refresh', true) ?: (get_post_meta(get_the_ID(), '_product_refresh', true) ?: '3840Hz'),
        'variant'      => 'light'
    ]);
    ?>
</div>
