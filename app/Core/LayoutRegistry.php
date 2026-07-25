<?php
namespace HacoLED\Theme\Core;

/**
 * Resolves the universal layout catalog to post-type implementations.
 */
class LayoutRegistry {
    const META_KEY = '_hacoled_content_layout';

    /**
     * Load and filter the complete registry configuration.
     */
    private static function config() {
        $config = require get_template_directory() . '/app/Config/layouts.php';
        $config = apply_filters('hacoled_content_layout_config', $config);

        return is_array($config) ? $config : [];
    }

    /**
     * Return the universal layout catalog.
     */
    public static function all() {
        $config = self::config();

        return isset($config['layouts']) && is_array($config['layouts'])
            ? $config['layouts']
            : [];
    }

    /**
     * Return post types shown in the HacoLED layout selector.
     */
    public static function postTypes() {
        $config = self::config();

        return isset($config['post_types']) && is_array($config['post_types'])
            ? array_values(array_filter(array_map('sanitize_key', $config['post_types'])))
            : [];
    }

    /**
     * Return one post-type implementation for a layout key.
     */
    public static function implementationFor($layout_key, $post_type) {
        $layouts = self::all();

        if (empty($layouts[$layout_key]['implementations'][$post_type])) {
            return null;
        }

        $implementation = $layouts[$layout_key]['implementations'][$post_type];

        return is_array($implementation) ? $implementation : null;
    }

    /**
     * Check that the configured implementation points to an existing file.
     */
    public static function isAvailable($layout_key, $post_type) {
        $implementation = self::implementationFor($layout_key, $post_type);

        if (!$implementation || empty($implementation['type'])) {
            return false;
        }

        if ($implementation['type'] === 'view' && !empty($implementation['view'])) {
            $view = self::sanitizeRelativePath($implementation['view']);
            return $view && file_exists(get_template_directory() . '/views/' . $view . '.php');
        }

        if ($implementation['type'] === 'page_template' && !empty($implementation['template'])) {
            $template = self::sanitizeRelativePath($implementation['template']);
            return $template && file_exists(get_template_directory() . '/' . $template);
        }

        return false;
    }

    /**
     * Find the universal layout key assigned to a native page template.
     */
    public static function forPageTemplate($template) {
        foreach (self::all() as $layout_key => $layout) {
            $implementation = $layout['implementations']['page'] ?? null;

            if (
                is_array($implementation)
                && ($implementation['type'] ?? '') === 'page_template'
                && ($implementation['template'] ?? '') === $template
            ) {
                return $layout_key;
            }
        }

        return '';
    }

    /**
     * Return a whitelisted TemplateController action for the selected layout.
     */
    public static function controllerActionFor($post_id) {
        $layout_key = sanitize_key((string) get_post_meta($post_id, self::META_KEY, true));
        $layouts = self::all();
        $action = $layouts[$layout_key]['controller_action'] ?? '';

        return is_string($action) && preg_match('/^[a-zA-Z][a-zA-Z0-9_]*$/', $action)
            ? $action
            : '';
    }

    /**
     * Check whether a layout is already assigned to another content item.
     */
    public static function isAssignedElsewhere($layout_key, $current_post_id = 0) {
        $layout_key = sanitize_key($layout_key);
        $current_post_id = absint($current_post_id);
        $layouts = self::all();

        if (!$layout_key || !isset($layouts[$layout_key])) {
            return false;
        }

        $query_args = [
            'post_type'      => self::postTypes(),
            'post_status'    => ['publish', 'future', 'draft', 'pending', 'private'],
            'posts_per_page' => 1,
            'fields'         => 'ids',
            'meta_key'       => self::META_KEY,
            'meta_value'     => $layout_key,
            'no_found_rows'  => true,
        ];

        if ($current_post_id) {
            $query_args['post__not_in'] = [$current_post_id];
        }

        if (get_posts($query_args)) {
            return true;
        }

        $page_implementation = self::implementationFor($layout_key, 'page');

        if (
            !$page_implementation
            || ($page_implementation['type'] ?? '') !== 'page_template'
            || empty($page_implementation['template'])
        ) {
            return false;
        }

        $page_query_args = [
            'post_type'      => 'page',
            'post_status'    => ['publish', 'future', 'draft', 'pending', 'private'],
            'posts_per_page' => 1,
            'fields'         => 'ids',
            'meta_key'       => '_wp_page_template',
            'meta_value'     => $page_implementation['template'],
            'no_found_rows'  => true,
        ];

        if ($current_post_id) {
            $page_query_args['post__not_in'] = [$current_post_id];
        }

        return (bool) get_posts($page_query_args);
    }

    /**
     * Resolve a selected view implementation while retaining a safe default.
     */
    public static function resolve($post_id, $default_view) {
        $post_id = absint($post_id);

        if (!$post_id) {
            return $default_view;
        }

        $post_type = get_post_type($post_id);
        $layout_key = sanitize_key((string) get_post_meta($post_id, self::META_KEY, true));
        $implementation = self::implementationFor($layout_key, $post_type);

        if (!$implementation || ($implementation['type'] ?? '') !== 'view') {
            return $default_view;
        }

        $view = self::sanitizeRelativePath($implementation['view'] ?? '');

        return $view && file_exists(get_template_directory() . '/views/' . $view . '.php')
            ? $view
            : $default_view;
    }

    /**
     * Permit only relative theme paths made from predictable characters.
     */
    private static function sanitizeRelativePath($path) {
        $path = trim((string) $path, '/');

        return preg_match('/^[a-zA-Z0-9\/_-]+(?:\.php)?$/', $path) ? $path : '';
    }
}
