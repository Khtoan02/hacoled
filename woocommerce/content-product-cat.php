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

$controller = new \HacoLED\Theme\Controllers\ProductController();
?>
<div <?php wc_product_cat_class( 'h-full list-none', $category ); ?>>
    <?php
    $controller->renderComponent('subcategory-card', [
        'title'     => $category->name,
        'permalink' => $link,
        'thumbnail' => $image_url,
        'count'     => $category->count
    ]);
    ?>
</div>
