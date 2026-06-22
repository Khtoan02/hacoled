<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$columns = wc_get_loop_prop( 'columns' );
$grid_class = 'grid-cols-2 lg:grid-cols-3'; // Default to 3 columns max
?>
<div class="grid <?php echo esc_attr( $grid_class ); ?> gap-5 xl:gap-6 products columns-<?php echo esc_attr( $columns ); ?>">
