<?php
/**
 * Application bootstrap for the HacoLED theme.
 */

defined('ABSPATH') || exit;

require_once __DIR__ . '/Core/Autoloader.php';

HacoLED\Theme\Core\Autoloader::register();

require_once __DIR__ . '/Support/theme-hooks.php';
require_once __DIR__ . '/Support/theme-upgrades.php';
require_once __DIR__ . '/Support/managed-pages.php';
require_once __DIR__ . '/Support/header-menu.php';
require_once __DIR__ . '/Support/seo.php';
require_once __DIR__ . '/Support/security-headers.php';
require_once __DIR__ . '/Support/page-cache.php';

if (is_admin()) {
    $page_template_manager = new HacoLED\Theme\Admin\PageTemplateManager();
    $page_template_manager->register();

    $content_layout_manager = new HacoLED\Theme\Admin\ContentLayoutManager();
    $content_layout_manager->register();

    $header_menu_manager = new HacoLED\Theme\Admin\HeaderMenuManager();
    $header_menu_manager->register();
}
