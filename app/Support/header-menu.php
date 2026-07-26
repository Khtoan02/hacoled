<?php
/**
 * Shared renderers for desktop dropdown and mega-menu content.
 */

defined('ABSPATH') || exit;

const HACOLED_HEADER_MENU_OPTION = 'hacoled_header_menu_settings';

/**
 * Load the theme-owned defaults. Saved values are always optional overrides,
 * so a damaged or incomplete option can safely fall back to working menus.
 */
function hacoled_header_menu_defaults() {
    static $defaults = null;
    if ($defaults === null) {
        $defaults = require get_template_directory() . '/app/Config/header-menu.php';
    }
    return $defaults;
}

function hacoled_header_menu_settings() {
    static $settings = null;
    if ($settings !== null) {
        return $settings;
    }

    $defaults = hacoled_header_menu_defaults();
    $saved = get_option(HACOLED_HEADER_MENU_OPTION, []);
    $settings = [];

    foreach ($defaults as $key => $default) {
        $override = isset($saved[$key]) && is_array($saved[$key]) ? $saved[$key] : [];
        $settings[$key] = array_merge($default, $override);
        if (isset($default['visual'])) {
            $settings[$key]['visual'] = array_merge($default['visual'], is_array($override['visual'] ?? null) ? $override['visual'] : []);

            foreach (['image', 'fallback'] as $image_field) {
                $image_url = (string) ($settings[$key]['visual'][$image_field] ?? '');
                if ($image_url === '' || !str_ends_with(strtolower(parse_url($image_url, PHP_URL_PATH) ?: ''), '.png')) {
                    continue;
                }

                $webp_url = preg_replace('/\.png$/i', '.webp', $image_url);
                $webp_file = get_template_directory() . '/assets/images/' . basename((string) parse_url($webp_url, PHP_URL_PATH));
                if (is_file($webp_file)) {
                    $settings[$key]['visual'][$image_field] = $webp_url;
                }
            }
        }
    }

    return $settings;
}

function hacoled_get_header_menu_config($key) {
    $settings = hacoled_header_menu_settings();
    return $settings[$key] ?? [];
}

function hacoled_header_menu_enabled($key) {
    $menu = hacoled_get_header_menu_config($key);
    return !isset($menu['enabled']) || (bool) $menu['enabled'];
}

function hacoled_header_menu_label($key) {
    $menu = hacoled_get_header_menu_config($key);
    return $menu['label'] ?? '';
}

function hacoled_header_menu_url($key) {
    $menu = hacoled_get_header_menu_config($key);
    return $menu['url'] ?? '#';
}

function hacoled_header_menu_icon_choices() {
    return ['monitor', 'sun', 'grid', 'sparkles', 'speaker', 'document', 'info', 'shield', 'user', 'calendar', 'book', 'newspaper'];
}

function hacoled_header_menu_tone_choices() {
    return ['red', 'gold', 'slate'];
}

/**
 * Return one consistent outline icon used by header menus.
 */
function hacoled_header_menu_icon($name, $class = 'hacoled-menu-icon-svg') {
    $icons = [
        'monitor'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h17.25c.621 0 1.125-.504 1.125-1.125V4.875c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125z"/>',
        'sun'       => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0z"/>',
        'grid'      => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6zm0 9.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25zM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6zm0 9.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25z"/>',
        'sparkles'  => '<path stroke-linecap="round" stroke-linejoin="round" d="m9.813 15.904-.813 2.846-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09zM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456z"/>',
        'speaker'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/>',
        'document'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625A3.375 3.375 0 0 0 16.125 8.25h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9z"/>',
        'info'      => '<path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/>',
        'shield'    => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622A11.99 11.99 0 0 0 20.402 6 11.959 11.959 0 0 1 12 2.714z"/>',
        'user'      => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0zM4.5 20.118a7.5 7.5 0 0 1 15 0A17.9 17.9 0 0 1 12 21.75c-2.676 0-5.216-.584-7.5-1.632z"/>',
        'calendar'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 9h18M5.25 5.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25A2.25 2.25 0 0 1 18.75 21H5.25A2.25 2.25 0 0 1 3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25z"/>',
        'book'      => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/>',
        'newspaper' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3z"/>',
    ];

    $path = $icons[$name] ?? $icons['monitor'];

    return '<svg class="' . esc_attr($class) . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">' . $path . '</svg>';
}

/**
 * Render the small dropdown item list shared by About and News.
 */
function hacoled_render_header_dropdown_items(array $items) {
    echo '<div class="hacoled-dropdown-items">';
    foreach ($items as $item) {
        $tone = $item['tone'] ?? 'red';
        echo '<a role="menuitem" href="' . esc_url($item['url']) . '" class="hacoled-dropdown-item">';
        echo '<span class="hacoled-dropdown-icon is-' . esc_attr($tone) . '">' . hacoled_header_menu_icon($item['icon'] ?? 'info') . '</span>';
        echo '<span class="hacoled-dropdown-label">' . esc_html($item['label']) . '</span>';
        echo '</a>';
    }
    echo '</div>';
}

/**
 * Render the same Admin-managed structure as a compact mobile accordion.
 */
function hacoled_render_mobile_header_menu(array $menu, $menu_key = '') {
    if (empty($menu['enabled'])) {
        return;
    }

    $kind = $menu['kind'] ?? 'dropdown';
    $groups = $kind === 'mega'
        ? ($menu['columns'] ?? [])
        : [['title' => '', 'items' => $menu['items'] ?? []]];

    if (!empty($menu_key)) {
        $escaped_key = esc_attr($menu_key);
        echo '<div>';
        echo '<button type="button" @click="activeAccordion = (activeAccordion === \'' . $escaped_key . '\' ? null : \'' . $escaped_key . '\')" :aria-expanded="(activeAccordion === \'' . $escaped_key . '\').toString()" class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-[14px] font-semibold hover:bg-white/10 focus:outline-none transition-colors">';
        echo '<span>' . esc_html($menu['label'] ?? '') . '</span>';
        echo '<svg class="w-4 h-4 text-white/70 transition-transform duration-200" :class="activeAccordion === \'' . $escaped_key . '\' ? \'rotate-180 text-[#fbbf24]\' : \'\'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>';
        echo '</button>';
        echo '<div x-show="activeAccordion === \'' . $escaped_key . '\'" x-cloak class="pl-6 pr-2 pb-2 mt-1 border-l border-white/20 ml-2 space-y-1 max-h-[350px] overflow-y-auto">';
    } else {
        echo '<div x-data="{ open: false }">';
        echo '<button type="button" @click="open = !open" :aria-expanded="open.toString()" class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-[14px] font-semibold hover:bg-white/10 focus:outline-none transition-colors">';
        echo '<span>' . esc_html($menu['label'] ?? '') . '</span>';
        echo '<svg class="w-4 h-4 text-white/70 transition-transform duration-200" :class="open ? \'rotate-180 text-[#fbbf24]\' : \'\'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>';
        echo '</button>';
        echo '<div x-show="open" x-cloak class="pl-6 pr-2 pb-2 mt-1 border-l border-white/20 ml-2 space-y-1 max-h-[350px] overflow-y-auto">';
    }

    foreach ($groups as $group) {
        if (!empty($group['title'])) {
            echo '<p class="pt-3 pb-1 text-[10px] font-bold uppercase tracking-widest text-[#fbbf24]">' . esc_html($group['title']) . '</p>';
        }
        foreach ($group['items'] ?? [] as $item) {
            echo '<a href="' . esc_url($item['url'] ?? '') . '" class="block py-1.5 text-[13px] text-white/80 hover:text-white transition-colors">' . esc_html($item['label'] ?? '') . '</a>';
        }
    }

    echo '</div></div>';
}

/**
 * Render the common visual and link structure used by every mega menu.
 */
function hacoled_render_mega_menu(array $config) {
    $columns = $config['columns'] ?? [];
    $column_count = max(1, min(3, count($columns)));
    $visual = $config['visual'] ?? [];
    $placeholder = 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=';

    echo '<div class="hacoled-mega-layout">';
    echo '<div class="hacoled-mega-links hacoled-mega-cols-' . esc_attr((string) $column_count) . '">';

    foreach ($columns as $column) {
        $tone = $column['tone'] ?? 'red';
        $item_columns = !empty($column['item_columns']) && (int) $column['item_columns'] === 2 ? ' is-two-cols' : '';
        echo '<section class="hacoled-mega-column">';
        echo '<div class="hacoled-mega-heading">';
        echo '<span class="hacoled-mega-heading-icon is-' . esc_attr($tone) . '">' . hacoled_header_menu_icon($column['icon'] ?? 'monitor') . '</span>';
        echo '<span class="hacoled-mega-title">' . esc_html($column['title']) . '</span>';
        echo '</div>';
        echo '<div class="hacoled-mega-items' . esc_attr($item_columns) . '">';

        foreach ($column['items'] ?? [] as $item) {
            echo '<a role="menuitem" href="' . esc_url($item['url']) . '" class="hacoled-mega-link">';
            echo '<span>' . esc_html($item['label']);
            if (!empty($item['badge'])) {
                $badge_tone = $item['badge']['tone'] ?? 'red';
                echo '<small class="hacoled-mega-badge is-' . esc_attr($badge_tone) . '">' . esc_html($item['badge']['label']) . '</small>';
            }
            echo '</span>';
            echo '<svg class="hacoled-mega-link-arrow" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m9 5 7 7-7 7"/></svg>';
            echo '</a>';
        }

        echo '</div></section>';
    }

    echo '</div>';

    if (!empty($visual['image'])) {
        $tag = !empty($visual['url']) ? 'a' : 'div';
        $href = !empty($visual['url']) ? ' href="' . esc_url($visual['url']) . '"' : '';
        $menu_role = $tag === 'a' ? ' role="menuitem"' : '';
        echo '<' . $tag . $href . $menu_role . ' class="hacoled-mega-visual group/card">';
        echo '<img src="' . esc_attr($placeholder) . '" data-menu-src="' . esc_url($visual['image']) . '"';
        if (!empty($visual['fallback'])) {
            echo ' data-fallback="' . esc_url($visual['fallback']) . '"';
        }
        echo ' alt="' . esc_attr($visual['alt'] ?? $visual['title'] ?? '') . '" decoding="async" class="hacoled-mega-visual-image" />';
        echo '<span class="hacoled-mega-visual-overlay"></span>';
        echo '<span class="hacoled-mega-visual-content">';
        if (!empty($visual['badge'])) {
            echo '<span class="hacoled-mega-visual-badge">' . esc_html($visual['badge']) . '</span>';
        }
        echo '<strong>' . esc_html($visual['title'] ?? '') . '</strong>';
        echo '<span class="hacoled-mega-visual-cta">' . esc_html($visual['cta'] ?? 'Xem chi tiết') . '<svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0-4 4m4-4H3"/></svg></span>';
        echo '</span></' . $tag . '>';
    }

    echo '</div>';
}
