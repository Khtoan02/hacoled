<?php
namespace HacoLED\Theme\Controllers;

use HacoLED\Theme\Core\Controller;

/**
 * Routes individual job posts through the universal layout registry.
 */
class JobController extends Controller {
    public function detail() {
        if ($this->dispatchContentLayout(get_queried_object_id())) {
            return;
        }

        $controller = new TemplateController();
        $controller->jobDetail();
    }
}
