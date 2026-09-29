<?php
namespace HacoLED\Theme\Admin;

use HacoLED\Theme\Core\LayoutRegistry;
use WP_Term;

/**
 * Manages category-level layout assignment for WooCommerce product taxonomies.
 */
class CategoryLayoutManager {
    const META_KEY = '_hacoled_category_layout';

    /**
     * Register taxonomy admin hooks.
     */
    public function register() {
        add_action('product_cat_add_form_fields', [$this, 'renderAddLayoutField'], 15);
        add_action('product_cat_edit_form_fields', [$this, 'renderEditLayoutField'], 15);
        add_action('created_product_cat', [$this, 'saveLayoutMeta'], 10, 2);
        add_action('edited_product_cat', [$this, 'saveLayoutMeta'], 10, 2);
    }

    /**
     * Render layout field on "Add New Category" screen.
     */
    public function renderAddLayoutField() {
        $layouts = LayoutRegistry::categoryLayouts();
        ?>
        <div class="form-field term-group">
            <label for="hacoled_category_layout">
                <?php esc_html_e('Mẫu giao diện danh mục', 'hacoled'); ?>
            </label>
            <select name="hacoled_category_layout" id="hacoled_category_layout" class="postform">
                <?php foreach ($layouts as $key => $layout): ?>
                    <option value="<?php echo esc_attr($key); ?>">
                        <?php echo esc_html($layout['label'] ?? $key); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <p class="description">
                <?php esc_html_e('Chọn giao diện cho trang danh mục này. Chọn "Landing Page Quảng Cáo" khi chạy chiến dịch Ads.', 'hacoled'); ?>
            </p>
        </div>
        <?php
    }

    /**
     * Render layout field on "Edit Category" screen.
     *
     * @param WP_Term $term
     */
    public function renderEditLayoutField($term) {
        if (!$term instanceof WP_Term) {
            return;
        }

        $selected = sanitize_key((string) get_term_meta($term->term_id, self::META_KEY, true));
        if (empty($selected)) {
            $selected = 'default';
        }

        $layouts = LayoutRegistry::categoryLayouts();
        ?>
        <tr class="form-field term-group-wrap">
            <th scope="row">
                <label for="hacoled_category_layout">
                    <?php esc_html_e('Mẫu giao diện danh mục', 'hacoled'); ?>
                </label>
            </th>
            <td>
                <div style="max-width: 600px;">
                    <select name="hacoled_category_layout" id="hacoled_category_layout" class="postform" style="width: 100%; max-width: 450px; font-weight: 500;">
                        <?php foreach ($layouts as $key => $layout): ?>
                            <option value="<?php echo esc_attr($key); ?>" <?php selected($selected, $key); ?>>
                                <?php echo esc_html(($key === $selected && $key !== 'default') ? ($layout['label'] . ' — [ĐANG KÍCH HOẠT]') : $layout['label']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    
                    <p class="description" style="margin-top: 8px;">
                        <?php esc_html_e('Tùy biến hiển thị cho danh mục: Chọn "Mặc định" để hiển thị danh mục sản phẩm WooCommerce thông thường; hoặc chọn "Landing Page Quảng Cáo" khi chạy chiến dịch Ads để tối ưu tỷ lệ chuyển đổi.', 'hacoled'); ?>
                    </p>

                    <?php if (isset($layouts[$selected]['description'])): ?>
                        <p class="description" style="margin-top: 4px; color: #1d2327; font-weight: 500;">
                            💡 <em><?php echo esc_html($layouts[$selected]['description']); ?></em>
                        </p>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
        <?php
    }

    /**
     * Save category layout metadata when the term is created or edited.
     *
     * @param int $term_id
     * @param int $tt_id
     */
    public function saveLayoutMeta($term_id, $tt_id = 0) {
        if (!current_user_can('edit_term', $term_id)) {
            return;
        }

        if (isset($_POST['hacoled_category_layout'])) {
            $layout_key = sanitize_key(wp_unslash($_POST['hacoled_category_layout']));
            $layouts = LayoutRegistry::categoryLayouts();

            if (!empty($layout_key) && $layout_key !== 'default' && isset($layouts[$layout_key])) {
                update_term_meta($term_id, self::META_KEY, $layout_key);
            } else {
                delete_term_meta($term_id, self::META_KEY);
            }
        }
    }
}
