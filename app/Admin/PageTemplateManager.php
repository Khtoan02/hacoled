<?php
namespace HacoLED\Theme\Admin;

use HacoLED\Theme\Core\LayoutRegistry;

/**
 * Admin screen for configuring, creating, and synchronizing managed pages.
 */
class PageTemplateManager {
    const MENU_SLUG    = 'hacoled-pages';
    const ACTION       = 'hacoled_activate_pages';
    const NONCE        = 'hacoled_activate_pages_nonce';
    const SLUGS_OPTION = 'hacoled_managed_page_slugs';
    const IDS_OPTION   = 'hacoled_managed_page_ids';

    /**
     * Register WordPress admin hooks.
     */
    public function register() {
        add_action('admin_menu', [$this, 'addMenuPage']);
        add_action('admin_post_' . self::ACTION, [$this, 'handleRequest']);
    }

    /**
     * Add the page below Appearance.
     */
    public function addMenuPage() {
        add_theme_page(
            __('Kích hoạt trang HacoLED', 'hacoled'),
            __('Trang HacoLED', 'hacoled'),
            'edit_theme_options',
            self::MENU_SLUG,
            [$this, 'renderPage']
        );
    }

    /**
     * Render editable slug configuration and synchronization controls.
     */
    public function renderPage() {
        if (!current_user_can('edit_theme_options')) {
            wp_die(esc_html__('Bạn không có quyền quản lý các trang của theme.', 'hacoled'));
        }

        $pages = $this->getPageDefinitions();
        ?>
        <div class="wrap">
            <h1><?php echo esc_html__('Trang và slug HacoLED', 'hacoled'); ?></h1>
            <p><?php echo esc_html__('Tùy chỉnh slug, sau đó đồng bộ để tạo trang mới hoặc đổi permalink của trang hiện có. Tiêu đề và nội dung đã nhập được giữ nguyên.', 'hacoled'); ?></p>

            <?php $this->renderNotice(); ?>

            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="<?php echo esc_attr(self::ACTION); ?>">
                <?php wp_nonce_field(self::ACTION, self::NONCE); ?>

                <table class="widefat striped" style="max-width: 1180px; margin: 20px 0;">
                    <thead>
                        <tr>
                            <th><?php echo esc_html__('Trang', 'hacoled'); ?></th>
                            <th style="width: 300px;"><?php echo esc_html__('Slug tùy chỉnh', 'hacoled'); ?></th>
                            <th><?php echo esc_html__('Template', 'hacoled'); ?></th>
                            <th><?php echo esc_html__('Trạng thái', 'hacoled'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pages as $page_key => $definition) : ?>
                            <?php $state = $this->getPageState($page_key, $definition); ?>
                            <tr>
                                <td>
                                    <strong><?php echo esc_html($definition['title']); ?></strong>
                                    <?php if (!empty($state['edit_url'])) : ?>
                                        <div><a href="<?php echo esc_url($state['edit_url']); ?>"><?php echo esc_html__('Chỉnh sửa nội dung', 'hacoled'); ?></a></div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 4px;">
                                        <code>/</code>
                                        <input
                                            type="text"
                                            class="regular-text"
                                            style="width: 230px;"
                                            name="slugs[<?php echo esc_attr($page_key); ?>]"
                                            value="<?php echo esc_attr($definition['slug']); ?>"
                                            required
                                        >
                                        <code>/</code>
                                    </div>
                                </td>
                                <td><code><?php echo esc_html($definition['template']); ?></code></td>
                                <td>
                                    <?php if ($state['active']) : ?>
                                        <span style="color: #008a20; font-weight: 600;"><?php echo esc_html__('Đã đồng bộ', 'hacoled'); ?></span>
                                    <?php else : ?>
                                        <span style="color: #996800; font-weight: 600;"><?php echo esc_html__('Chưa đồng bộ', 'hacoled'); ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div style="display: flex; flex-wrap: wrap; gap: 8px; align-items: center;">
                    <button type="submit" name="operation" value="save_slugs" class="button button-secondary">
                        <?php echo esc_html__('Lưu cấu hình slug', 'hacoled'); ?>
                    </button>
                    <button type="submit" name="operation" value="synchronize" class="button button-primary">
                        <?php echo esc_html__('Lưu slug và kích hoạt/đồng bộ tất cả trang', 'hacoled'); ?>
                    </button>
                    <button type="submit" name="operation" value="reset_slugs" class="button button-link-delete" onclick="return confirm('<?php echo esc_js(__('Khôi phục toàn bộ slug mặc định?', 'hacoled')); ?>');">
                        <?php echo esc_html__('Khôi phục slug mặc định', 'hacoled'); ?>
                    </button>
                </div>
            </form>
        </div>
        <?php
    }

    /**
     * Handle slug saving, resetting, and full page synchronization.
     */
    public function handleRequest() {
        if (!current_user_can('edit_theme_options')) {
            wp_die(esc_html__('Bạn không có quyền thực hiện thao tác này.', 'hacoled'));
        }

        check_admin_referer(self::ACTION, self::NONCE);

        $operation = isset($_POST['operation'])
            ? sanitize_key(wp_unslash($_POST['operation']))
            : 'synchronize';

        if ($operation === 'reset_slugs') {
            delete_option(self::SLUGS_OPTION);
            $this->redirect(['hacoled_reset' => 1]);
        }

        $defaults = $this->getDefaultPageDefinitions();
        $slugs = $this->sanitizeSubmittedSlugs($defaults);

        if (is_wp_error($slugs)) {
            $this->redirect(['hacoled_slug_error' => $slugs->get_error_code()]);
        }

        update_option(self::SLUGS_OPTION, $slugs, false);

        if ($operation === 'save_slugs') {
            $this->redirect(['hacoled_slugs_saved' => 1]);
        }

        $pages = $this->mergeConfiguredSlugs($defaults, $slugs);
        $managed_ids = $this->getManagedPageIds();
        $result = ['created' => 0, 'updated' => 0, 'errors' => 0];

        foreach ($pages as $page_key => $definition) {
            $sync_result = $this->synchronizePage($page_key, $definition);

            if (is_wp_error($sync_result)) {
                $result['errors']++;
                continue;
            }

            $result[$sync_result['action']]++;
            $managed_ids[$page_key] = $sync_result['page_id'];

            if (!empty($definition['front_page'])) {
                update_option('show_on_front', 'page');
                update_option('page_on_front', $sync_result['page_id']);
            }
        }

        update_option(self::IDS_OPTION, $managed_ids, false);

        $this->redirect([
            'hacoled_synced' => 1,
            'created'        => $result['created'],
            'updated'        => $result['updated'],
            'errors'         => $result['errors'],
        ]);
    }

    /**
     * Create a page or rename/update the page already owned by this key.
     */
    private function synchronizePage($page_key, $definition) {
        $template_path = get_template_directory() . '/' . $definition['template'];

        if ($definition['template'] !== 'default' && !file_exists($template_path)) {
            return new \WP_Error('missing_template', __('Không tìm thấy file page template.', 'hacoled'));
        }

        $page = $this->findExistingPage($page_key, $definition);
        $is_new = !($page instanceof \WP_Post);
        $layout_key = LayoutRegistry::forPageTemplate($definition['template']);

        if ($layout_key && LayoutRegistry::isAssignedElsewhere($layout_key, $is_new ? 0 : $page->ID)) {
            return new \WP_Error('layout_in_use', __('Mẫu giao diện đã được gán cho nội dung khác.', 'hacoled'));
        }

        $conflicting_page = get_page_by_path($definition['slug'], OBJECT, 'page');

        if (
            $conflicting_page instanceof \WP_Post
            && (!$page instanceof \WP_Post || $conflicting_page->ID !== $page->ID)
        ) {
            return new \WP_Error('slug_conflict', __('Slug đang được một trang khác sử dụng.', 'hacoled'));
        }

        $post_data = [
            'post_type'   => 'page',
            'post_status' => 'publish',
            'post_name'   => $definition['slug'],
        ];

        if ($is_new) {
            $post_data['post_title']   = $definition['title'];
            $post_data['post_content'] = '';
            $page_id = wp_insert_post(wp_slash($post_data), true);
        } else {
            $post_data['ID'] = $page->ID;
            $page_id = wp_update_post(wp_slash($post_data), true);
        }

        if (is_wp_error($page_id)) {
            return $page_id;
        }

        $saved_page = get_post($page_id);

        if (!$saved_page || $saved_page->post_name !== $definition['slug']) {
            return new \WP_Error('slug_conflict', __('Slug đang được một nội dung khác sử dụng.', 'hacoled'));
        }

        update_post_meta($page_id, '_wp_page_template', $definition['template']);

        if ($layout_key) {
            update_post_meta($page_id, LayoutRegistry::META_KEY, $layout_key);
        }

        return [
            'action'  => $is_new ? 'created' : 'updated',
            'page_id' => (int) $page_id,
        ];
    }

    /**
     * Locate a previously managed page before considering its configured slug.
     */
    private function findExistingPage($page_key, $definition) {
        $managed_ids = $this->getManagedPageIds();

        if (!empty($managed_ids[$page_key])) {
            $managed_page = get_post(absint($managed_ids[$page_key]));

            if ($managed_page instanceof \WP_Post && $managed_page->post_type === 'page' && $managed_page->post_status !== 'trash') {
                return $managed_page;
            }
        }

        if (!empty($definition['front_page'])) {
            $front_page = get_post(absint(get_option('page_on_front')));

            if ($front_page instanceof \WP_Post && $front_page->post_type === 'page' && $front_page->post_status !== 'trash') {
                return $front_page;
            }
        }

        if ($definition['template'] !== 'default') {
            $assigned_pages = get_posts([
                'post_type'      => 'page',
                'post_status'    => ['publish', 'future', 'draft', 'pending', 'private'],
                'posts_per_page' => 1,
                'orderby'        => 'ID',
                'order'          => 'ASC',
                'meta_key'       => '_wp_page_template',
                'meta_value'     => $definition['template'],
            ]);

            if (!empty($assigned_pages)) {
                return $assigned_pages[0];
            }
        }

        return get_page_by_path($definition['slug'], OBJECT, 'page') ?: null;
    }

    /**
     * Determine whether a configured page matches status, slug, and template.
     */
    private function getPageState($page_key, $definition) {
        $page = $this->findExistingPage($page_key, $definition);

        if (!($page instanceof \WP_Post)) {
            return ['active' => false, 'edit_url' => ''];
        }

        $assigned_template = get_post_meta($page->ID, '_wp_page_template', true) ?: 'default';
        $is_active = $page->post_status === 'publish'
            && $page->post_name === $definition['slug']
            && $assigned_template === $definition['template'];

        if (!empty($definition['front_page'])) {
            $is_active = $is_active
                && get_option('show_on_front') === 'page'
                && (int) get_option('page_on_front') === (int) $page->ID;
        }

        return [
            'active'   => $is_active,
            'edit_url' => get_edit_post_link($page->ID, 'raw') ?: '',
        ];
    }

    /**
     * Sanitize submitted slugs and reject empty or duplicate values.
     */
    private function sanitizeSubmittedSlugs($definitions) {
        $submitted = isset($_POST['slugs']) && is_array($_POST['slugs'])
            ? wp_unslash($_POST['slugs'])
            : [];
        $slugs = [];
        $used = [];

        foreach ($definitions as $page_key => $definition) {
            $raw_slug = isset($submitted[$page_key]) && is_string($submitted[$page_key])
                ? $submitted[$page_key]
                : $definition['slug'];
            $slug = sanitize_title($raw_slug);

            if ($slug === '') {
                return new \WP_Error('empty_slug', __('Slug không được để trống.', 'hacoled'));
            }

            if (isset($used[$slug])) {
                return new \WP_Error('duplicate_slug', __('Các trang không được sử dụng trùng slug.', 'hacoled'));
            }

            $slugs[$page_key] = $slug;
            $used[$slug] = true;
        }

        return $slugs;
    }

    /**
     * Load source-controlled defaults.
     */
    private function getDefaultPageDefinitions() {
        $pages = require get_template_directory() . '/app/Config/pages.php';

        return apply_filters('hacoled_managed_pages', $pages);
    }

    /**
     * Merge per-site slug settings into source-controlled definitions.
     */
    private function getPageDefinitions() {
        $defaults = $this->getDefaultPageDefinitions();
        $stored_slugs = get_option(self::SLUGS_OPTION, []);

        return $this->mergeConfiguredSlugs($defaults, is_array($stored_slugs) ? $stored_slugs : []);
    }

    private function mergeConfiguredSlugs($definitions, $slugs) {
        foreach ($definitions as $page_key => &$definition) {
            if (!empty($slugs[$page_key]) && is_string($slugs[$page_key])) {
                $definition['slug'] = sanitize_title($slugs[$page_key]);
            }
        }
        unset($definition);

        return $definitions;
    }

    private function getManagedPageIds() {
        $ids = get_option(self::IDS_OPTION, []);

        return is_array($ids) ? array_map('absint', $ids) : [];
    }

    /**
     * Redirect safely back to the manager screen.
     */
    private function redirect($args) {
        $args['page'] = self::MENU_SLUG;
        wp_safe_redirect(add_query_arg($args, admin_url('themes.php')));
        exit;
    }

    /**
     * Show save, reset, validation, or synchronization feedback.
     */
    private function renderNotice() {
        if (!empty($_GET['hacoled_slug_error'])) {
            $error_code = sanitize_key(wp_unslash($_GET['hacoled_slug_error']));
            $message = $error_code === 'duplicate_slug'
                ? __('Có ít nhất hai trang đang dùng cùng một slug. Hãy nhập các slug khác nhau.', 'hacoled')
                : __('Slug không hợp lệ hoặc đang để trống.', 'hacoled');
            ?>
            <div class="notice notice-error"><p><?php echo esc_html($message); ?></p></div>
            <?php
            return;
        }

        if (!empty($_GET['hacoled_slugs_saved'])) {
            ?>
            <div class="notice notice-success is-dismissible"><p><?php echo esc_html__('Đã lưu cấu hình slug. Bấm đồng bộ để áp dụng permalink mới cho các trang.', 'hacoled'); ?></p></div>
            <?php
            return;
        }

        if (!empty($_GET['hacoled_reset'])) {
            ?>
            <div class="notice notice-success is-dismissible"><p><?php echo esc_html__('Đã khôi phục cấu hình slug mặc định. Bấm đồng bộ để đổi lại permalink các trang.', 'hacoled'); ?></p></div>
            <?php
            return;
        }

        if (empty($_GET['hacoled_synced'])) {
            return;
        }

        $created = isset($_GET['created']) ? absint($_GET['created']) : 0;
        $updated = isset($_GET['updated']) ? absint($_GET['updated']) : 0;
        $errors  = isset($_GET['errors']) ? absint($_GET['errors']) : 0;
        $class   = $errors > 0 ? 'notice notice-warning is-dismissible' : 'notice notice-success is-dismissible';
        ?>
        <div class="<?php echo esc_attr($class); ?>">
            <p><?php echo esc_html(sprintf(__('Đã tạo %1$d trang, cập nhật %2$d trang, có %3$d lỗi.', 'hacoled'), $created, $updated, $errors)); ?></p>
        </div>
        <?php
    }
}
