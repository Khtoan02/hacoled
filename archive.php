<?php
/**
 * General archive list routing file
 */

use App\Controllers\ArchiveController;

$controller = new ArchiveController();
$controller->index();
