<?php
/**
 * URL helpers for pages managed by the HacoLED theme.
 */

defined('ABSPATH') || exit;

/**
 * Resolve a managed page URL from its tracked ID or configured slug.
 */
function hacoled_managed_page_url($page_key) {
    $page_key = sanitize_key($page_key);
    $managed_ids = get_option('hacoled_managed_page_ids', []);

    if (is_array($managed_ids) && !empty($managed_ids[$page_key])) {
        $page = get_post(absint($managed_ids[$page_key]));

        if ($page instanceof WP_Post && $page->post_type === 'page' && $page->post_status !== 'trash') {
            return apply_filters('hacoled_managed_page_url', get_permalink($page), $page_key, $page);
        }
    }

    $definitions = require get_template_directory() . '/app/Config/pages.php';
    $stored_slugs = get_option('hacoled_managed_page_slugs', []);
    $slug = '';

    if (is_array($stored_slugs) && !empty($stored_slugs[$page_key]) && is_string($stored_slugs[$page_key])) {
        $slug = sanitize_title($stored_slugs[$page_key]);
    } elseif (!empty($definitions[$page_key]['slug'])) {
        $slug = sanitize_title($definitions[$page_key]['slug']);
    }

    $url = $slug ? home_url('/' . $slug . '/') : home_url('/');

    return apply_filters('hacoled_managed_page_url', $url, $page_key, null);
}
