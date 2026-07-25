<?php
/**
 * Lightweight anonymous HTML cache for expensive public pages.
 *
 * This lives in the theme on purpose: HacoLED should work without adding a
 * separate performance plugin, while still avoiding repeated homepage renders.
 */

defined('ABSPATH') || exit;

const HACOLED_PAGE_CACHE_TTL = 15 * MINUTE_IN_SECONDS;
const HACOLED_PAGE_CACHE_GROUP = 'hacoled-page-cache-v68';
const HACOLED_PAGE_CACHE_DIR = 'cache/hacoled-page-cache';

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

function hacoled_page_cache_is_cacheable_request() {
    if (!hacoled_page_cache_can_run()) {
        return false;
    }

    return is_front_page() || is_home();
}

function hacoled_page_cache_key() {
    $scheme = is_ssl() ? 'https' : 'http';
    $host = strtolower((string) ($_SERVER['HTTP_HOST'] ?? ''));
    $uri = (string) ($_SERVER['REQUEST_URI'] ?? '/');

    $device = wp_is_mobile() ? 'mobile' : 'desktop';

    return HACOLED_PAGE_CACHE_GROUP . ':' . md5($scheme . '://' . $host . $uri . '|' . $device);
}

function hacoled_page_cache_file_path() {
    return WP_CONTENT_DIR . '/' . HACOLED_PAGE_CACHE_DIR . '/' . str_replace(':', '-', hacoled_page_cache_key()) . '.html';
}

function hacoled_page_cache_try_serve() {
    if (!hacoled_page_cache_is_cacheable_request()) {
        return;
    }

    $cached = get_transient(hacoled_page_cache_key());

    if (!is_string($cached) || $cached === '') {
        header('X-HacoLED-Page-Cache: MISS');
        ob_start('hacoled_page_cache_store');
        return;
    }

    header('X-HacoLED-Page-Cache: HIT');
    echo $cached;
    exit;
}
add_action('template_redirect', 'hacoled_page_cache_try_serve', 0);

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

    set_transient(hacoled_page_cache_key(), $html, HACOLED_PAGE_CACHE_TTL);

    hacoled_page_cache_write_file($html);

    return $html;
}

function hacoled_page_cache_write_file($html) {
    $cache_dir = WP_CONTENT_DIR . '/' . HACOLED_PAGE_CACHE_DIR;
    if (wp_mkdir_p($cache_dir) && is_writable($cache_dir)) {
        file_put_contents(hacoled_page_cache_file_path(), $html, LOCK_EX);
    }
}

function hacoled_page_cache_flush() {
    global $wpdb;

    $prefix = $wpdb->esc_like('_transient_' . HACOLED_PAGE_CACHE_GROUP) . '%';
    $timeout_prefix = $wpdb->esc_like('_transient_timeout_' . HACOLED_PAGE_CACHE_GROUP) . '%';

    $wpdb->query(
        $wpdb->prepare(
            "DELETE FROM {$wpdb->options} WHERE option_name LIKE %s OR option_name LIKE %s",
            $prefix,
            $timeout_prefix
        )
    );

    $cache_dir = WP_CONTENT_DIR . '/' . HACOLED_PAGE_CACHE_DIR;
    foreach (glob($cache_dir . '/*.html') ?: [] as $cache_file) {
        if (is_file($cache_file)) {
            unlink($cache_file);
        }
    }
}

add_action('save_post', 'hacoled_page_cache_flush');
add_action('deleted_post', 'hacoled_page_cache_flush');
add_action('edited_terms', 'hacoled_page_cache_flush');
add_action('customize_save_after', 'hacoled_page_cache_flush');
