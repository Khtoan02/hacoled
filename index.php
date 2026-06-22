<?php
/**
 * Main theme entry file
 * Routes default queries to the HomeController
 */

use App\Controllers\HomeController;

$controller = new HomeController();
$controller->index();
