<?php
/**
 * Blog category list routing file
 */

use HacoLED\Theme\Controllers\ArchiveController;
use HacoLED\Theme\Controllers\TemplateController;

$cat_id   = get_queried_object_id();
$template = get_term_meta( $cat_id, 'category_template', true ) ?: 'default';

if ( ! is_paged() && ( $template === 'blog' || is_category('tin-tuc') ) ) {
    $controller = new TemplateController();
    $controller->blog();
} elseif ( ! is_paged() && $template === 'project' ) {
    $controller = new TemplateController();
    $controller->projects();
} else {
    $controller = new ArchiveController();
    $controller->category();
}
