<?php
/**
 * Final WordPress template fallback.
 *
 * The front page has its own front-page.php entry. Keeping index.php generic
 * prevents searches, feeds and unmatched requests from rendering the homepage.
 */

use HacoLED\Theme\Controllers\ArchiveController;

$controller = new ArchiveController();
$controller->index();
