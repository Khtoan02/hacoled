<?php
namespace HacoLED\Theme\Admin;

/**
 * A purpose-built editor for the structured HacoLED header menus.
 */
class HeaderMenuManager {
    const MENU_SLUG = 'hacoled-header-menu';
    const ACTION = 'hacoled_save_header_menu';
    const EXPORT_ACTION = 'hacoled_export_header_menu';
    const NONCE = 'hacoled_header_menu_nonce';

    public function register() {
        add_action('admin_menu', [$this, 'addMenuPage']);
        add_action('admin_post_' . self::ACTION, [$this, 'handleRequest']);
        add_action('admin_post_' . self::EXPORT_ACTION, [$this, 'handleExport']);
        add_action('admin_enqueue_scripts', [$this, 'enqueueAssets']);
    }

    public function addMenuPage() {
        add_theme_page(
            __('Header HacoLED', 'hacoled'),
            __('Header HacoLED', 'hacoled'),
            'edit_theme_options',
            self::MENU_SLUG,
            [$this, 'renderPage']
        );
    }

    public function enqueueAssets($hook) {
        if ($hook !== 'appearance_page_' . self::MENU_SLUG) {
            return;
        }

        $css = get_template_directory() . '/assets/admin/header-menu.css';
        $js = get_template_directory() . '/assets/admin/header-menu.js';
        wp_enqueue_media();
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_style('hacoled-header-menu-admin', get_template_directory_uri() . '/assets/admin/header-menu.css', [], filemtime($css));
        wp_enqueue_script('hacoled-header-menu-admin', get_template_directory_uri() . '/assets/admin/header-menu.js', ['jquery', 'jquery-ui-sortable'], filemtime($js), true);
    }

    public function handleRequest() {
        if (!current_user_can('edit_theme_options')) {
            wp_die(esc_html__('Bạn không có quyền chỉnh sửa Header HacoLED.', 'hacoled'));
        }
        check_admin_referer(self::ACTION, self::NONCE);

        $operation = sanitize_key(wp_unslash($_POST['operation'] ?? 'save'));
        if ($operation === 'reset') {
            delete_option(HACOLED_HEADER_MENU_OPTION);
            $status = 'reset';
        } elseif ($operation === 'import') {
            $json = $this->readImportJson();
            $decoded = json_decode($json, true);
            $imported = is_array($decoded['menus'] ?? null) ? $decoded['menus'] : $decoded;
            if (!is_array($imported) || json_last_error() !== JSON_ERROR_NONE) {
                $this->redirectWithStatus('import_error');
            }
            update_option(HACOLED_HEADER_MENU_OPTION, $this->sanitizeSettings($imported), false);
            $status = 'imported';
        } else {
            $raw = isset($_POST['menus']) && is_array($_POST['menus']) ? wp_unslash($_POST['menus']) : [];
            update_option(HACOLED_HEADER_MENU_OPTION, $this->sanitizeSettings($raw), false);
            $status = 'saved';
        }

        if (function_exists('hacoled_page_cache_flush')) {
            hacoled_page_cache_flush();
        }

        $this->redirectWithStatus($status);
    }

    public function handleExport() {
        if (!current_user_can('edit_theme_options')) {
            wp_die(esc_html__('Bạn không có quyền xuất cấu hình Header.', 'hacoled'));
        }
        check_admin_referer(self::EXPORT_ACTION);

        $payload = [
            'schema' => 'hacoled-header-menu-v1',
            'exported_at' => current_time('c'),
            'menus' => hacoled_header_menu_settings(),
        ];
        nocache_headers();
        header('Content-Type: application/json; charset=utf-8');
        header('Content-Disposition: attachment; filename="hacoled-header-menu-' . gmdate('Y-m-d') . '.json"');
        echo wp_json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }

    private function readImportJson() {
        if (!empty($_FILES['menu_json_file']['tmp_name']) && is_uploaded_file($_FILES['menu_json_file']['tmp_name'])) {
            if ((int) ($_FILES['menu_json_file']['size'] ?? 0) > 2 * MB_IN_BYTES) {
                return '';
            }
            return (string) file_get_contents($_FILES['menu_json_file']['tmp_name']);
        }
        return isset($_POST['bulk_json']) ? (string) wp_unslash($_POST['bulk_json']) : '';
    }

    private function redirectWithStatus($status) {
        wp_safe_redirect(add_query_arg(['page' => self::MENU_SLUG, 'hacoled_status' => sanitize_key($status)], admin_url('themes.php')));
        exit;
    }

    private function sanitizeSettings(array $raw) {
        $clean = [];
        foreach (hacoled_header_menu_defaults() as $key => $default) {
            if (!isset($raw[$key]) || !is_array($raw[$key])) {
                $clean[$key] = $default;
                continue;
            }
            $menu = $raw[$key];
            $kind = $default['kind'];
            $label = sanitize_text_field($menu['label'] ?? $default['label']);
            $clean[$key] = [
                'label' => $label !== '' ? $label : $default['label'],
                'enabled' => array_key_exists('enabled', $menu) ? !empty($menu['enabled']) : !empty($default['enabled']),
                'kind' => $kind,
            ];

            if ($kind === 'link') {
                $url = esc_url_raw($menu['url'] ?? $default['url']);
                $clean[$key]['url'] = $url !== '' ? $url : $default['url'];
                continue;
            }

            if ($kind === 'dropdown') {
                $clean[$key]['items'] = array_key_exists('items', $menu)
                    ? $this->sanitizeItems($menu['items'], true)
                    : $default['items'];
                continue;
            }

            $columns = [];
            foreach (array_slice(is_array($menu['columns'] ?? null) ? $menu['columns'] : [], 0, 3) as $column) {
                if (!is_array($column)) {
                    continue;
                }
                $columns[] = [
                    'title' => sanitize_text_field($column['title'] ?? ''),
                    'icon' => $this->sanitizeChoice($column['icon'] ?? 'monitor', hacoled_header_menu_icon_choices(), 'monitor'),
                    'tone' => $this->sanitizeChoice($column['tone'] ?? 'red', hacoled_header_menu_tone_choices(), 'red'),
                    'item_columns' => (int) ($column['item_columns'] ?? 1) === 2 ? 2 : 1,
                    'items' => $this->sanitizeItems($column['items'] ?? [], false),
                ];
            }
            $clean[$key]['columns'] = $columns ?: $default['columns'];

            $visual = array_merge($default['visual'] ?? [], is_array($menu['visual'] ?? null) ? $menu['visual'] : []);
            $clean[$key]['visual'] = [
                'image' => esc_url_raw($visual['image'] ?? ''),
                'fallback' => esc_url_raw($visual['fallback'] ?? ''),
                'alt' => sanitize_text_field($visual['alt'] ?? ''),
                'badge' => sanitize_text_field($visual['badge'] ?? ''),
                'title' => sanitize_text_field($visual['title'] ?? ''),
                'cta' => sanitize_text_field($visual['cta'] ?? ''),
                'url' => esc_url_raw($visual['url'] ?? ''),
            ];
        }
        return $clean;
    }

    private function sanitizeItems($items, $dropdown) {
        $clean = [];
        foreach (array_slice(is_array($items) ? $items : [], 0, 40) as $item) {
            if (!is_array($item)) {
                continue;
            }
            $label = sanitize_text_field($item['label'] ?? '');
            $url = esc_url_raw($item['url'] ?? '');
            if ($label === '' || $url === '') {
                continue;
            }
            $entry = ['label' => $label, 'url' => $url];
            if ($dropdown) {
                $entry['icon'] = $this->sanitizeChoice($item['icon'] ?? 'info', hacoled_header_menu_icon_choices(), 'info');
                $entry['tone'] = $this->sanitizeChoice($item['tone'] ?? 'red', hacoled_header_menu_tone_choices(), 'red');
            } else {
                $badge_label = sanitize_text_field($item['badge']['label'] ?? '');
                if ($badge_label !== '') {
                    $entry['badge'] = [
                        'label' => $badge_label,
                        'tone' => $this->sanitizeChoice($item['badge']['tone'] ?? 'red', hacoled_header_menu_tone_choices(), 'red'),
                    ];
                }
            }
            $clean[] = $entry;
        }
        return $clean;
    }

    private function sanitizeChoice($value, array $choices, $fallback) {
        $value = sanitize_key($value);
        return in_array($value, $choices, true) ? $value : $fallback;
    }

    public function renderPage() {
        if (!current_user_can('edit_theme_options')) {
            return;
        }
        $menus = hacoled_header_menu_settings();
        ?>
        <div class="wrap hacoled-header-admin">
            <div class="hacoled-admin-hero">
                <div>
                    <span class="hacoled-admin-kicker">HACOLED THEME</span>
                    <h1><?php esc_html_e('Quản lý Header & Mega Menu', 'hacoled'); ?></h1>
                    <p><?php esc_html_e('Chỉnh đúng cấu trúc giao diện đang dùng, không phụ thuộc trình quản lý Menu mặc định của WordPress.', 'hacoled'); ?></p>
                </div>
                <a class="button button-secondary" href="<?php echo esc_url(home_url('/')); ?>" target="_blank" rel="noopener"><?php esc_html_e('Xem ngoài trang ↗', 'hacoled'); ?></a>
            </div>

            <?php $this->renderNotice(); ?>

            <form method="post" enctype="multipart/form-data" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" id="hacoled-header-menu-form">
                <input type="hidden" name="action" value="<?php echo esc_attr(self::ACTION); ?>">
                <?php wp_nonce_field(self::ACTION, self::NONCE); ?>

                <?php $this->renderBulkTools($menus); ?>

                <div class="hacoled-menu-workspace">
                    <nav class="hacoled-menu-tabs" aria-label="<?php esc_attr_e('Các nhóm menu', 'hacoled'); ?>">
                        <?php $first = true; foreach ($menus as $key => $menu) : ?>
                            <button type="button" class="hacoled-menu-tab<?php echo $first ? ' is-active' : ''; ?>" data-menu-tab="<?php echo esc_attr($key); ?>">
                                <span class="hacoled-status-dot<?php echo !empty($menu['enabled']) ? ' is-on' : ''; ?>"></span>
                                <span><?php echo esc_html($menu['label']); ?></span>
                                <small><?php echo esc_html($menu['kind'] === 'mega' ? 'Mega Menu' : ($menu['kind'] === 'dropdown' ? 'Dropdown' : 'Liên kết')); ?></small>
                            </button>
                        <?php $first = false; endforeach; ?>
                    </nav>

                    <div class="hacoled-menu-editor">
                        <div class="hacoled-live-preview" aria-live="polite">
                            <div class="hacoled-preview-toolbar"><div><span>LIVE PREVIEW</span><strong><?php esc_html_e('Xem trước Header', 'hacoled'); ?></strong></div><small><?php esc_html_e('Thay đổi ngay khi nhập liệu', 'hacoled'); ?></small></div>
                            <div class="hacoled-preview-stage">
                                <div class="hacoled-preview-brand">HacoLED</div>
                                <div class="hacoled-preview-nav" data-preview-nav></div>
                                <div class="hacoled-preview-dropdown" data-preview-dropdown></div>
                            </div>
                        </div>
                        <?php $first = true; foreach ($menus as $key => $menu) : ?>
                            <section class="hacoled-menu-panel<?php echo $first ? ' is-active' : ''; ?>" data-menu-panel="<?php echo esc_attr($key); ?>" data-menu-kind="<?php echo esc_attr($menu['kind']); ?>">
                                <?php $this->renderMenuPanel($key, $menu); ?>
                            </section>
                        <?php $first = false; endforeach; ?>
                    </div>
                </div>

                <datalist id="hacoled-link-suggestions"><?php $this->renderLinkSuggestions(); ?></datalist>
                <?php $this->renderTemplates(); ?>

                <div class="hacoled-save-bar">
                    <span><?php esc_html_e('Thay đổi chỉ áp dụng sau khi bấm lưu.', 'hacoled'); ?></span>
                    <div>
                        <button type="submit" name="operation" value="reset" class="button button-link-delete hacoled-reset-button"><?php esc_html_e('Khôi phục mặc định', 'hacoled'); ?></button>
                        <button type="submit" name="operation" value="save" class="button button-primary button-hero"><?php esc_html_e('Lưu cấu hình Header', 'hacoled'); ?></button>
                    </div>
                </div>
            </form>
        </div>
        <?php
    }

    private function renderBulkTools(array $menus) {
        $payload = ['schema' => 'hacoled-header-menu-v1', 'menus' => $menus];
        $export_url = wp_nonce_url(admin_url('admin-post.php?action=' . self::EXPORT_ACTION), self::EXPORT_ACTION);
        ?>
        <details class="hacoled-bulk-tools">
            <summary><span>⇄</span><div><strong><?php esc_html_e('Nhập / xuất hàng loạt', 'hacoled'); ?></strong><small><?php esc_html_e('Tải file JSON làm mẫu, chỉnh sửa rồi nhập lại một lần.', 'hacoled'); ?></small></div></summary>
            <div class="hacoled-bulk-content">
                <div class="hacoled-bulk-guide">
                    <h3><?php esc_html_e('Quy trình đề xuất', 'hacoled'); ?></h3>
                    <ol><li><?php esc_html_e('Tải cấu hình hiện tại xuống.', 'hacoled'); ?></li><li><?php esc_html_e('Chỉnh file bằng VS Code hoặc trình soạn thảo văn bản.', 'hacoled'); ?></li><li><?php esc_html_e('Tải file lên hoặc dán JSON vào ô bên cạnh.', 'hacoled'); ?></li></ol>
                    <a href="<?php echo esc_url($export_url); ?>" class="button button-secondary">↓ <?php esc_html_e('Tải JSON hiện tại', 'hacoled'); ?></a>
                    <label class="hacoled-file-field"><span><?php esc_html_e('Hoặc chọn file JSON đã soạn', 'hacoled'); ?></span><input type="file" name="menu_json_file" accept="application/json,.json"></label>
                </div>
                <div class="hacoled-json-editor">
                    <label for="hacoled-bulk-json"><?php esc_html_e('JSON cấu hình', 'hacoled'); ?></label>
                    <textarea id="hacoled-bulk-json" name="bulk_json" spellcheck="false"><?php echo esc_textarea(wp_json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)); ?></textarea>
                    <div><button type="button" class="button hacoled-copy-json"><?php esc_html_e('Tạo & sao chép từ form', 'hacoled'); ?></button><button type="submit" name="operation" value="import" class="button button-primary"><?php esc_html_e('Nhập toàn bộ cấu hình', 'hacoled'); ?></button></div>
                </div>
            </div>
        </details>
        <?php
    }

    private function renderNotice() {
        $status = sanitize_key($_GET['hacoled_status'] ?? '');
        if ($status === 'saved') {
            echo '<div class="notice notice-success is-dismissible"><p><strong>' . esc_html__('Đã lưu cấu hình Header và làm mới cache.', 'hacoled') . '</strong></p></div>';
        } elseif ($status === 'reset') {
            echo '<div class="notice notice-info is-dismissible"><p><strong>' . esc_html__('Đã khôi phục toàn bộ menu mặc định của theme.', 'hacoled') . '</strong></p></div>';
        } elseif ($status === 'imported') {
            echo '<div class="notice notice-success is-dismissible"><p><strong>' . esc_html__('Đã nhập cấu hình JSON và làm mới Header.', 'hacoled') . '</strong></p></div>';
        } elseif ($status === 'import_error') {
            echo '<div class="notice notice-error is-dismissible"><p><strong>' . esc_html__('Không thể nhập: file JSON không hợp lệ hoặc vượt quá 2MB.', 'hacoled') . '</strong></p></div>';
        }
    }

    private function renderMenuPanel($key, array $menu) {
        ?>
        <header class="hacoled-panel-header">
            <div>
                <span class="hacoled-type-pill"><?php echo esc_html($menu['kind'] === 'mega' ? 'Mega Menu' : ($menu['kind'] === 'dropdown' ? 'Dropdown' : 'Liên kết')); ?></span>
                <h2><?php echo esc_html($menu['label']); ?></h2>
            </div>
            <label class="hacoled-switch">
                <input type="checkbox" name="menus[<?php echo esc_attr($key); ?>][enabled]" value="1" <?php checked(!empty($menu['enabled'])); ?>>
                <span></span><b><?php esc_html_e('Hiển thị trên Header', 'hacoled'); ?></b>
            </label>
        </header>

        <div class="hacoled-card hacoled-general-card">
            <label class="hacoled-field hacoled-field-wide">
                <span><?php esc_html_e('Tên hiển thị trên thanh menu', 'hacoled'); ?></span>
                <input type="text" name="menus[<?php echo esc_attr($key); ?>][label]" value="<?php echo esc_attr($menu['label']); ?>" required>
            </label>
            <?php if ($menu['kind'] === 'link') : ?>
                <label class="hacoled-field hacoled-field-wide" style="margin-top:14px">
                    <span><?php esc_html_e('Liên kết đích', 'hacoled'); ?></span>
                    <input type="url" list="hacoled-link-suggestions" name="menus[<?php echo esc_attr($key); ?>][url]" value="<?php echo esc_attr($menu['url'] ?? ''); ?>" required>
                </label>
            <?php endif; ?>
        </div>

        <?php if ($menu['kind'] === 'link') { return; } ?>

        <?php if ($menu['kind'] === 'dropdown') : ?>
            <div class="hacoled-section-title"><div><h3><?php esc_html_e('Các mục Dropdown', 'hacoled'); ?></h3><p><?php esc_html_e('Kéo biểu tượng bên trái để thay đổi thứ tự.', 'hacoled'); ?></p></div></div>
            <?php $prefix = 'menus[' . $key . '][items]'; ?>
            <div class="hacoled-items hacoled-sortable" id="items-<?php echo esc_attr($key); ?>">
                <?php foreach ($menu['items'] ?? [] as $index => $item) { $this->renderItem($prefix, $index, $item, true); } ?>
            </div>
            <button type="button" class="button hacoled-add-item" data-template="dropdown" data-target="#items-<?php echo esc_attr($key); ?>" data-prefix="<?php echo esc_attr($prefix); ?>">＋ <?php esc_html_e('Thêm mục Dropdown', 'hacoled'); ?></button>
        <?php else : ?>
            <div class="hacoled-section-title"><div><h3><?php esc_html_e('Nhóm và liên kết', 'hacoled'); ?></h3><p><?php esc_html_e('Mỗi khối bên dưới tương ứng một cột trong Mega Menu.', 'hacoled'); ?></p></div></div>
            <div class="hacoled-columns">
                <?php foreach ($menu['columns'] ?? [] as $column_index => $column) : $prefix = 'menus[' . $key . '][columns][' . $column_index . '][items]'; ?>
                    <article class="hacoled-column-card">
                        <div class="hacoled-column-head">
                            <label class="hacoled-field"><span><?php esc_html_e('Tên nhóm', 'hacoled'); ?></span><input type="text" name="menus[<?php echo esc_attr($key); ?>][columns][<?php echo esc_attr($column_index); ?>][title]" value="<?php echo esc_attr($column['title']); ?>" required></label>
                            <?php $this->renderSelect('menus[' . $key . '][columns][' . $column_index . '][icon]', __('Icon', 'hacoled'), hacoled_header_menu_icon_choices(), $column['icon']); ?>
                            <?php $this->renderSelect('menus[' . $key . '][columns][' . $column_index . '][tone]', __('Màu', 'hacoled'), hacoled_header_menu_tone_choices(), $column['tone']); ?>
                            <?php $this->renderSelect('menus[' . $key . '][columns][' . $column_index . '][item_columns]', __('Chia danh sách', 'hacoled'), ['1' => '1 cột', '2' => '2 cột'], (string) ($column['item_columns'] ?? 1), true); ?>
                        </div>
                        <div class="hacoled-items hacoled-sortable" id="items-<?php echo esc_attr($key . '-' . $column_index); ?>">
                            <?php foreach ($column['items'] ?? [] as $index => $item) { $this->renderItem($prefix, $index, $item, false); } ?>
                        </div>
                        <button type="button" class="button hacoled-add-item" data-template="mega" data-target="#items-<?php echo esc_attr($key . '-' . $column_index); ?>" data-prefix="<?php echo esc_attr($prefix); ?>">＋ <?php esc_html_e('Thêm liên kết', 'hacoled'); ?></button>
                    </article>
                <?php endforeach; ?>
            </div>
            <?php $this->renderVisual($key, $menu['visual'] ?? []); ?>
        <?php endif;
    }

    private function renderItem($prefix, $index, array $item, $dropdown) {
        ?>
        <div class="hacoled-item-row">
            <button type="button" class="hacoled-drag" aria-label="<?php esc_attr_e('Kéo để sắp xếp', 'hacoled'); ?>">⋮⋮</button>
            <label class="hacoled-field"><span><?php esc_html_e('Tên mục', 'hacoled'); ?></span><input type="text" name="<?php echo esc_attr($prefix . '[' . $index . '][label]'); ?>" value="<?php echo esc_attr($item['label'] ?? ''); ?>" required></label>
            <label class="hacoled-field hacoled-url-field"><span><?php esc_html_e('Liên kết', 'hacoled'); ?></span><input type="url" list="hacoled-link-suggestions" name="<?php echo esc_attr($prefix . '[' . $index . '][url]'); ?>" value="<?php echo esc_attr($item['url'] ?? ''); ?>" placeholder="https://..." required></label>
            <?php if ($dropdown) : ?>
                <?php $this->renderSelect($prefix . '[' . $index . '][icon]', __('Icon', 'hacoled'), hacoled_header_menu_icon_choices(), $item['icon'] ?? 'info'); ?>
                <?php $this->renderSelect($prefix . '[' . $index . '][tone]', __('Màu', 'hacoled'), hacoled_header_menu_tone_choices(), $item['tone'] ?? 'red'); ?>
            <?php else : ?>
                <label class="hacoled-field hacoled-badge-field"><span><?php esc_html_e('Badge', 'hacoled'); ?></span><input type="text" name="<?php echo esc_attr($prefix . '[' . $index . '][badge][label]'); ?>" value="<?php echo esc_attr($item['badge']['label'] ?? ''); ?>" placeholder="HOT"></label>
                <?php $this->renderSelect($prefix . '[' . $index . '][badge][tone]', __('Màu badge', 'hacoled'), hacoled_header_menu_tone_choices(), $item['badge']['tone'] ?? 'red'); ?>
            <?php endif; ?>
            <button type="button" class="hacoled-remove-item" aria-label="<?php esc_attr_e('Xóa mục', 'hacoled'); ?>">×</button>
        </div>
        <?php
    }

    private function renderSelect($name, $label, array $choices, $current, $associative = false) {
        echo '<label class="hacoled-field hacoled-select-field"><span>' . esc_html($label) . '</span><select name="' . esc_attr($name) . '">';
        foreach ($choices as $value => $text) {
            if (!$associative && is_int($value)) {
                $value = $text;
                $text = ucfirst($text);
            }
            echo '<option value="' . esc_attr($value) . '" ' . selected((string) $current, (string) $value, false) . '>' . esc_html($text) . '</option>';
        }
        echo '</select></label>';
    }

    private function renderVisual($key, array $visual) {
        ?>
        <div class="hacoled-section-title"><div><h3><?php esc_html_e('Thẻ hình ảnh nổi bật', 'hacoled'); ?></h3><p><?php esc_html_e('Ảnh chỉ tải khi người xem mở menu.', 'hacoled'); ?></p></div></div>
        <div class="hacoled-card hacoled-visual-card">
            <div class="hacoled-media-preview"><?php if (!empty($visual['image'])) : ?><img src="<?php echo esc_url($visual['image']); ?>" alt=""><?php endif; ?></div>
            <div class="hacoled-visual-fields">
                <label class="hacoled-field hacoled-field-wide"><span><?php esc_html_e('Ảnh nổi bật', 'hacoled'); ?></span><span class="hacoled-media-control"><input type="url" class="hacoled-media-url" name="menus[<?php echo esc_attr($key); ?>][visual][image]" value="<?php echo esc_attr($visual['image'] ?? ''); ?>"><button type="button" class="button hacoled-select-media"><?php esc_html_e('Chọn ảnh', 'hacoled'); ?></button></span></label>
                <label class="hacoled-field"><span><?php esc_html_e('Nhãn nhỏ', 'hacoled'); ?></span><input type="text" name="menus[<?php echo esc_attr($key); ?>][visual][badge]" value="<?php echo esc_attr($visual['badge'] ?? ''); ?>"></label>
                <label class="hacoled-field hacoled-field-wide"><span><?php esc_html_e('Tiêu đề nổi bật', 'hacoled'); ?></span><input type="text" name="menus[<?php echo esc_attr($key); ?>][visual][title]" value="<?php echo esc_attr($visual['title'] ?? ''); ?>"></label>
                <label class="hacoled-field"><span>CTA</span><input type="text" name="menus[<?php echo esc_attr($key); ?>][visual][cta]" value="<?php echo esc_attr($visual['cta'] ?? ''); ?>"></label>
                <label class="hacoled-field hacoled-field-wide"><span><?php esc_html_e('Liên kết thẻ', 'hacoled'); ?></span><input type="url" list="hacoled-link-suggestions" name="menus[<?php echo esc_attr($key); ?>][visual][url]" value="<?php echo esc_attr($visual['url'] ?? ''); ?>"></label>
                <label class="hacoled-field hacoled-field-wide"><span><?php esc_html_e('Mô tả ảnh (alt)', 'hacoled'); ?></span><input type="text" name="menus[<?php echo esc_attr($key); ?>][visual][alt]" value="<?php echo esc_attr($visual['alt'] ?? ''); ?>"></label>
                <input type="hidden" name="menus[<?php echo esc_attr($key); ?>][visual][fallback]" value="<?php echo esc_attr($visual['fallback'] ?? ''); ?>">
            </div>
        </div>
        <?php
    }

    private function renderLinkSuggestions() {
        $posts = get_posts(['post_type' => ['page', 'post', 'product'], 'post_status' => 'publish', 'numberposts' => 100, 'orderby' => 'modified', 'order' => 'DESC']);
        foreach ($posts as $post) {
            echo '<option value="' . esc_url(get_permalink($post)) . '">' . esc_html(get_the_title($post)) . '</option>';
        }
    }

    private function renderTemplates() {
        ?>
        <script type="text/html" id="tmpl-hacoled-dropdown-item">
            <div class="hacoled-item-row"><button type="button" class="hacoled-drag">⋮⋮</button><label class="hacoled-field"><span>Tên mục</span><input type="text" name="__PREFIX__[__INDEX__][label]" required></label><label class="hacoled-field hacoled-url-field"><span>Liên kết</span><input type="url" list="hacoled-link-suggestions" name="__PREFIX__[__INDEX__][url]" placeholder="https://..." required></label><label class="hacoled-field hacoled-select-field"><span>Icon</span><select name="__PREFIX__[__INDEX__][icon]"><?php foreach (hacoled_header_menu_icon_choices() as $icon) echo '<option value="' . esc_attr($icon) . '">' . esc_html(ucfirst($icon)) . '</option>'; ?></select></label><label class="hacoled-field hacoled-select-field"><span>Màu</span><select name="__PREFIX__[__INDEX__][tone]"><option value="red">Red</option><option value="gold">Gold</option><option value="slate">Slate</option></select></label><button type="button" class="hacoled-remove-item">×</button></div>
        </script>
        <script type="text/html" id="tmpl-hacoled-mega-item">
            <div class="hacoled-item-row"><button type="button" class="hacoled-drag">⋮⋮</button><label class="hacoled-field"><span>Tên mục</span><input type="text" name="__PREFIX__[__INDEX__][label]" required></label><label class="hacoled-field hacoled-url-field"><span>Liên kết</span><input type="url" list="hacoled-link-suggestions" name="__PREFIX__[__INDEX__][url]" placeholder="https://..." required></label><label class="hacoled-field hacoled-badge-field"><span>Badge</span><input type="text" name="__PREFIX__[__INDEX__][badge][label]" placeholder="HOT"></label><label class="hacoled-field hacoled-select-field"><span>Màu badge</span><select name="__PREFIX__[__INDEX__][badge][tone]"><option value="red">Red</option><option value="gold">Gold</option><option value="slate">Slate</option></select></label><button type="button" class="hacoled-remove-item">×</button></div>
        </script>
        <?php
    }
}
