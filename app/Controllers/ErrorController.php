<?php
namespace HacoLED\Theme\Controllers;

use HacoLED\Theme\Core\Controller;

/**
 * Handles HTTP error pages.
 */
class ErrorController extends Controller {
    public function notFound() {
        $this->render('pages/404', [
            'header_type' => 'default',
            'footer_type' => 'default',
        ]);
    }
}
