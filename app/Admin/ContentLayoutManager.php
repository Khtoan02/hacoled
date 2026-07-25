<?php
namespace HacoLED\Theme\Admin;

use HacoLED\Theme\Core\LayoutRegistry;

/**
 * Adds a secure, globally unique layout selector to supported edit screens.
 */
class ContentLayoutManager {
    const NONCE_ACTION = 'hacoled_save_content_layout';
    const NONCE_NAME   = 'hacoled_content_layout_nonce';

    /**
     * Register admin and metadata hooks.
     */
    public function register() {
        add_action('init', [$this, 'registerMeta']);
        add_action('add_meta_boxes', [$this, 'addMetaBoxes']);
        add_action('save_post', [$this, 'saveLayout']);
        add_filter('update_post_metadata', [$this, 'preventDuplicateLayout'], 10, 5);
    }

    /**
     * Register the selected layout for REST/editor compatibility.
     */
    public function registerMeta() {
        foreach (LayoutRegistry::postTypes() as $post_type) {
            register_post_meta($post_type, LayoutRegistry::META_KEY, [
                'type'              => 'string',
                'single'            => true,
                'show_in_rest'      => true,
                'sanitize_callback' => 'sanitize_key',
                'auth_callback'     => function ($allowed, $meta_key, $post_id) {
                    return current_user_can('edit_post', $post_id);
                },
            ]);
        }
    }

    /**
     * Add the selector to every managed content type.
     */
    public function addMetaBoxes() {
        foreach (LayoutRegistry::postTypes() as $post_type) {
            if (!post_type_exists($post_type)) {
                continue;
            }

            add_meta_box(
                'hacoled-content-layout',
                __('Giao diện HacoLED', 'hacoled'),
                [$this, 'renderMetaBox'],
                $post_type,
                'side',
                'default'
            );
        }
    }

    /**
     * Show the current layout plus every globally unassigned layout.
     */
    public function renderMetaBox($post) {
        $layouts = LayoutRegistry::all();
        $selected = sanitize_key((string) get_post_meta($post->ID, LayoutRegistry::META_KEY, true));

        if ($selected === '' && $post->post_type === 'page') {
            $native_template = get_post_meta($post->ID, '_wp_page_template', true);
            $selected = LayoutRegistry::forPageTemplate($native_template);
        }

        $visible_layouts = [];

        foreach ($layouts as $key => $layout) {
            if ($key === $selected || !LayoutRegistry::isAssignedElsewhere($key, $post->ID)) {
                $visible_layouts[$key] = $layout;
            }
        }

        wp_nonce_field(self::NONCE_ACTION, self::NONCE_NAME);
        ?>
        <p>
            <label for="hacoled-content-layout-select"><?php echo esc_html__('Chọn mẫu giao diện cho nội dung này:', 'hacoled'); ?></label>
        </p>
        <select id="hacoled-content-layout-select" name="hacoled_content_layout" style="width: 100%;">
            <option value=""><?php echo esc_html__('Mặc định theo loại nội dung', 'hacoled'); ?></option>
            <?php foreach ($visible_layouts as $key => $layout) : ?>
                <?php $label = $layout['label'] ?? $key; ?>
                <option value="<?php echo esc_attr($key); ?>" <?php selected($selected, $key); ?>>
                    <?php echo esc_html($key === $selected ? $label . ' — Đang sử dụng' : $label); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <p class="description"><?php echo esc_html__('Danh sách chỉ hiển thị mẫu chưa được gán ở nơi khác. Mỗi mẫu chỉ được dùng cho một Page, Post, Product hoặc Job.', 'hacoled'); ?></p>

        <?php if ($selected !== '' && !empty($layouts[$selected]['description'])) : ?>
            <p class="description"><strong><?php echo esc_html($layouts[$selected]['description']); ?></strong></p>
        <?php endif; ?>
        <?php
    }

    /**
     * Save a layout only when it is not owned by another content item.
     */
    public function saveLayout($post_id) {
        if (!isset($_POST[self::NONCE_NAME])) {
            return;
        }

        $nonce = sanitize_text_field(wp_unslash($_POST[self::NONCE_NAME]));

        if (!wp_verify_nonce($nonce, self::NONCE_ACTION)) {
            return;
        }

        if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || wp_is_post_revision($post_id)) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        $post_type = get_post_type($post_id);
        $layout_key = isset($_POST['hacoled_content_layout'])
            ? sanitize_key(wp_unslash($_POST['hacoled_content_layout']))
            : '';

        if ($layout_key === '') {
            delete_post_meta($post_id, LayoutRegistry::META_KEY);

            if ($post_type === 'page') {
                update_post_meta($post_id, '_wp_page_template', 'default');
            }

            return;
        }

        $layouts = LayoutRegistry::all();

        if (!isset($layouts[$layout_key]) || LayoutRegistry::isAssignedElsewhere($layout_key, $post_id)) {
            return;
        }

        update_post_meta($post_id, LayoutRegistry::META_KEY, $layout_key);

        if ($post_type === 'page') {
            $implementation = LayoutRegistry::implementationFor($layout_key, 'page');
            $page_template = (
                $implementation
                && ($implementation['type'] ?? '') === 'page_template'
                && !empty($implementation['template'])
            ) ? $implementation['template'] : 'default';

            update_post_meta($post_id, '_wp_page_template', $page_template);
        }
    }

    /**
     * Enforce uniqueness for REST requests and any direct metadata update too.
     */
    public function preventDuplicateLayout($check, $post_id, $meta_key, $meta_value, $previous_value) {
        if ($meta_key !== LayoutRegistry::META_KEY) {
            return $check;
        }

        $layout_key = sanitize_key((string) $meta_value);

        if ($layout_key && LayoutRegistry::isAssignedElsewhere($layout_key, $post_id)) {
            return false;
        }

        return $check;
    }
}
