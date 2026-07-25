<?php
/**
 * Single job template selected by the native WordPress hierarchy.
 */

use HacoLED\Theme\Controllers\JobController;

$controller = new JobController();
$controller->detail();
