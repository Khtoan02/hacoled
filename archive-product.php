<?php
/**
 * WooCommerce product list / shop routing file
 */

use App\Controllers\ProductController;

$controller = new ProductController();
$controller->shop();
