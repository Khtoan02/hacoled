<?php
/**
 * Front page template router (prioritized by WP for static homepages)
 */

use HacoLED\Theme\Controllers\HomeController;

$controller = new HomeController();
$controller->index();
