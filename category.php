<?php
/**
 * Blog category list routing file
 */

use App\Controllers\ArchiveController;
use App\Controllers\PageController;

$cat_id   = get_queried_object_id();
$template = get_term_meta( $cat_id, 'category_template', true ) ?: 'default';

if ( $template === 'blog' || is_category('tin-tuc') ) {
    $controller = new PageController();
    $controller->blog();
} elseif ( $template === 'project' ) {
    $controller = new PageController();
    $controller->projects();
} else {
    $controller = new ArchiveController();
    $controller->category();
}
