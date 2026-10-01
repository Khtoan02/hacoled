<?php
/**
 * Lightweight, high-performance HTML File Cache & LiteSpeed Server Accelerator.
 *
 * Built directly into the theme for maximum efficiency without external plugins.
 * Works seamlessly with LiteSpeed Enterprise Web Server via native headers,
 * while maintaining a local SSD file cache fallback.
 */

defined('ABSPATH') || exit;

const HACOLED_PAGE_CACHE_TTL   = 24 * HOUR_IN_SECONDS; // Cache for 24 hours
const HACOLED_PAGE_CACHE_GROUP = 'hacoled-cache-v70';
const HACOLED_PAGE_CACHE_DIR   = 'cache/hacoled-page-cache';

/**
 * Check if the current request is eligible for caching.
 */
function hacoled_page_cache_can_run() {
    if (is_admin() || wp_doing_ajax() || wp_doing_cron()) {
        return false;
    }

    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'GET') {
        return false;
    }

    if (is_user_logged_in()) {
        return false;
    }

    // Do not cache search queries or WooCommerce dynamic customer sessions
    if (!empty($_GET['s']) || isset($_GET['add-to-cart'])) {
        return false;
    }

    $blocked_cookies = [
        'wordpress_logged_in_',
        'woocommerce_items_in_cart',
        'wp_woocommerce_session_',
        'woocommerce_cart_hash',
        'comment_author_',
    ];

    foreach (array_keys($_COOKIE) as $cookie_name) {
        foreach ($blocked_cookies as $blocked_cookie) {
            if (strpos($cookie_name, $blocked_cookie) === 0) {
                return false;
            }
        }
    }

    return true;
}

/**
 * Check if the current route is a public cacheable page.
 */
function hacoled_page_cache_is_cacheable_request() {
    if (!hacoled_page_cache_can_run()) {
        return false;
    }

    if (is_404() || is_search() || is_feed() || is_trackback()) {
        return false;
    }

    // Never cache dynamic WooCommerce checkout/cart/account
    if (function_exists('is_cart') && is_cart()) return false;
    if (function_exists('is_checkout') && is_checkout()) return false;
    if (function_exists('is_account_page') && is_account_page()) return false;

    // Cache all public viewable pages: Home, Pages, Single posts/products, Archives & Taxonomies
    return (
        is_front_page()
        || is_home()
        || is_singular()
        || is_archive()
        || is_tax()
        || is_category()
        || is_tag()
        || is_page()
    );
}

/**
 * Generate a unique cache key based on URL, scheme and device type.
 */
function hacoled_page_cache_key() {
    $scheme = is_ssl() ? 'https' : 'http';
    $host   = strtolower((string) ($_SERVER['HTTP_HOST'] ?? ''));
    $uri    = (string) ($_SERVER['REQUEST_URI'] ?? '/');
    $device = wp_is_mobile() ? 'mobile' : 'desktop';

    return HACOLED_PAGE_CACHE_GROUP . ':' . md5($scheme . '://' . $host . $uri . '|' . $device);
}

/**
 * File path on SSD for the cached HTML.
 */
function hacoled_page_cache_file_path() {
    $dir = WP_CONTENT_DIR . '/' . HACOLED_PAGE_CACHE_DIR;
    return $dir . '/' . str_replace(':', '-', hacoled_page_cache_key()) . '.html';
}

/**
 * Try to serve cached HTML instantly from disk, or instruct LiteSpeed Server.
 */
function hacoled_page_cache_try_serve() {
    if (!hacoled_page_cache_is_cacheable_request()) {
        return;
    }

    $file = hacoled_page_cache_file_path();

    // 1. Check if cached file exists on disk and is still fresh
    if (file_exists($file) && (time() - filemtime($file)) < HACOLED_PAGE_CACHE_TTL) {
        // Send LiteSpeed Server Cache Headers
        header('X-LiteSpeed-Cache-Control: public, max-age=604800');
        header('X-LiteSpeed-Tag: hacoled_page,hacoled_html');
        header('Cache-Control: public, max-age=3600, stale-while-revalidate=86400');
        header('X-HacoLED-Page-Cache: HIT (File)');

        // Stream file directly with 0ms memory overhead
        readfile($file);
        exit;
    }

    // 2. Cache MISS: Hook buffer to capture and store HTML
    header('X-LiteSpeed-Cache-Control: public, max-age=604800');
    header('X-LiteSpeed-Tag: hacoled_page,hacoled_html');
    header('Cache-Control: public, max-age=3600, stale-while-revalidate=86400');

    ob_start('hacoled_page_cache_store');
}
add_action('template_redirect', 'hacoled_page_cache_try_serve', 0);

/**
 * Save rendered HTML to SSD cache file.
 */
function hacoled_page_cache_store($html) {
    if (!hacoled_page_cache_is_cacheable_request()) {
        return $html;
    }

    if (http_response_code() !== 200) {
        return $html;
    }

    if (!is_string($html) || stripos($html, '</html>') === false) {
        return $html;
    }

    // Ensure cache directory exists
    $cache_dir = WP_CONTENT_DIR . '/' . HACOLED_PAGE_CACHE_DIR;
    if (wp_mkdir_p($cache_dir) && is_writable($cache_dir)) {
        file_put_contents(hacoled_page_cache_file_path(), $html, LOCK_EX);
    }

    // Ensure LiteSpeed & Browser headers are emitted on fresh HTML output
    if (!headers_sent()) {
        header('X-LiteSpeed-Cache-Control: public, max-age=604800');
        header('X-LiteSpeed-Tag: hacoled_page,hacoled_html');
        header('Cache-Control: public, max-age=3600, stale-while-revalidate=86400');
    }

    return $html;
}

/**
 * Flush all cached files when content is updated.
 */
function hacoled_page_cache_flush() {
    $cache_dir = WP_CONTENT_DIR . '/' . HACOLED_PAGE_CACHE_DIR;
    if (is_dir($cache_dir)) {
        $files = glob($cache_dir . '/*.html');
        if (is_array($files)) {
            foreach ($files as $cache_file) {
                if (is_file($cache_file)) {
                    @unlink($cache_file);
                }
            }
        }
    }

    // Purge LiteSpeed Server Cache via header hook if on LiteSpeed
    if (!headers_sent()) {
        header('X-LiteSpeed-Purge: *');
    }
}

add_action('save_post', 'hacoled_page_cache_flush');
add_action('deleted_post', 'hacoled_page_cache_flush');
add_action('edited_terms', 'hacoled_page_cache_flush');
add_action('customize_save_after', 'hacoled_page_cache_flush');
add_action('switch_theme', 'hacoled_page_cache_flush');
