<?php
/**
 * Application bootstrap for the HacoLED theme.
 */

defined('ABSPATH') || exit;

require_once __DIR__ . '/Core/Autoloader.php';

HacoLED\Theme\Core\Autoloader::register();

require_once __DIR__ . '/Support/theme-hooks.php';
