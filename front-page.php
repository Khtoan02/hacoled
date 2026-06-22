<?php
/**
 * Front page template router (prioritized by WP for static homepages)
 */

use App\Controllers\HomeController;

$controller = new HomeController();
$controller->index();
