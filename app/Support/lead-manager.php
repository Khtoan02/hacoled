<?php
/**
 * Customer Lead Management & Real-time Google Sheets Synchronization.
 *
 * Handles customer registrations, quote requests, storage in WordPress CPT,
 * and instant synchronization to Google Sheets via Webhook.
 */

defined('ABSPATH') || exit;

// Default Google Sheets Webhook URL
if (!defined('HACOLED_GSHEET_WEBHOOK_URL')) {
    define('HACOLED_GSHEET_WEBHOOK_URL', 'https://script.google.com/macros/s/AKfycbxp1cqyFnm08b0I1L2d_ifr52b9N1vMSuy4_E5yzk5HC5C5yUgjQOfeSRdCc6v3dCtt/exec');
}

/**
 * 1. Register Custom Post Type: hacoled_lead
 */
add_action('init', function () {
    $labels = [
        'name'               => 'Khách Hàng Đăng Ký',
        'singular_name'      => 'Khách Hàng',
        'menu_name'          => 'Khách Hàng',
        'all_items'          => 'Tất cả khách hàng',
        'edit_item'          => 'Chi tiết khách hàng',
        'view_item'          => 'Xem thông tin khách hàng',
        'search_items'       => 'Tìm kiếm khách hàng',
        'not_found'          => 'Chưa có lượt đăng ký nào',
        'not_found_in_trash' => 'Thùng rác trống',
    ];

    $args = [
        'labels'             => $labels,
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 26,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => ['title'],
        'capability_type'    => 'post',
        'capabilities'       => [
            'create_posts' => false, // Only create via website forms or API
        ],
        'map_meta_cap'       => true,
    ];

    register_post_type('hacoled_lead', $args);
});

/**
 * 2. Display badge count of new/unhandled leads in admin menu
 */
add_action('admin_menu', function () {
    global $menu;
    $count = hacoled_get_new_leads_count();
    if ($count > 0) {
        foreach ($menu as $key => $value) {
            if ($value[2] === 'edit.php?post_type=hacoled_lead') {
                $menu[$key][0] .= sprintf(' <span class="update-plugins count-%1$d" style="background:#B31217; color:#fff; border-radius:10px; padding:2px 7px; font-size:10px; font-weight:bold;"><span class="plugin-count">%1$d</span></span>', $count);
                break;
            }
        }
    }
}, 99);

function hacoled_get_new_leads_count() {
    $leads = get_posts([
        'post_type'      => 'hacoled_lead',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'meta_key'       => '_lead_status',
        'meta_value'     => 'moi',
        'fields'         => 'ids',
    ]);
    return count($leads);
}

/**
 * 3. Custom Admin Columns for hacoled_lead List Table
 */
add_filter('manage_hacoled_lead_posts_columns', function ($columns) {
    $new_cols = [];
    $new_cols['cb']          = $columns['cb'];
    $new_cols['title']       = 'Họ Tên Khách Hàng';
    $new_cols['lead_phone']  = 'Số Điện Thoại / Zalo';
    $new_cols['lead_interest']= 'Nhu Cầu Màn Hình LED';
    $new_cols['lead_location']= 'Địa Điểm / Kích Thước';
    $new_cols['lead_source'] = 'Nguồn Đăng Ký (Ads)';
    $new_cols['lead_status'] = 'Trạng Thái Xử Lý';
    $new_cols['lead_gsheet'] = 'Google Sheet';
    $new_cols['date']        = 'Thời Gian';
    return $new_cols;
});

add_action('manage_hacoled_lead_posts_custom_column', function ($column, $post_id) {
    switch ($column) {
        case 'lead_phone':
            $phone = get_post_meta($post_id, '_lead_phone', true);
            if ($phone) {
                $clean_phone = preg_replace('/[^0-9]/', '', $phone);
                echo '<div style="font-family:monospace; font-size:13px; font-weight:700; color:#0f172a; margin-bottom:4px;">' . esc_html($phone) . '</div>';
                echo '<div style="display:flex; gap:6px;">';
                echo '<a href="tel:' . esc_attr($clean_phone) . '" class="button button-small" style="color:#059669; border-color:#059669;"><span class="dashicons dashicons-phone" style="font-size:14px; margin-top:2px;"></span> Gọi ngay</a>';
                echo '<a href="https://zalo.me/' . esc_attr($clean_phone) . '" target="_blank" rel="noopener" class="button button-small" style="color:#0284c7; border-color:#0284c7;">Chat Zalo</a>';
                echo '</div>';
            } else {
                echo '<span style="color:#94a3b8;">—</span>';
            }
            break;

        case 'lead_interest':
            $interest = get_post_meta($post_id, '_lead_interest', true) ?: 'Màn hình LED';
            echo '<span style="display:inline-block; padding:3px 8px; border-radius:6px; background:#fef2f2; color:#b91c1c; font-weight:600; font-size:11px; border:1px solid #fecaca;">' . esc_html($interest) . '</span>';
            break;

        case 'lead_location':
            $loc = get_post_meta($post_id, '_lead_location', true);
            echo $loc ? esc_html($loc) : '<span style="color:#94a3b8;">Chưa nhập</span>';
            break;

        case 'lead_source':
            $utm = get_post_meta($post_id, '_lead_utm_source', true);
            $page = get_post_meta($post_id, '_lead_page_url', true);
            echo '<div style="font-size:11px; font-weight:600; color:#334155;">' . esc_html($utm ?: 'Trực tiếp / Website') . '</div>';
            if ($page) {
                echo '<a href="' . esc_url($page) . '" target="_blank" style="font-size:10px; color:#64748b; text-decoration:none;" title="' . esc_attr($page) . '">Xem trang &rarr;</a>';
            }
            break;

        case 'lead_status':
            $status = get_post_meta($post_id, '_lead_status', true) ?: 'moi';
            $badges = [
                'moi'        => ['label' => '🔴 Mới tiếp nhận', 'bg' => '#fee2e2', 'color' => '#991b1b', 'border' => '#f87171'],
                'dang_goi'   => ['label' => '🟡 Đang tư vấn', 'bg' => '#fef3c7', 'color' => '#92400e', 'border' => '#fcd34d'],
                'da_bao_gia' => ['label' => '🔵 Đã gửi báo giá', 'bg' => '#e0f2fe', 'color' => '#075985', 'border' => '#7dd3fc'],
                'chot_don'   => ['label' => '🟢 Chốt hợp đồng', 'bg' => '#dcfce7', 'color' => '#166534', 'border' => '#86efac'],
                'that_bai'   => ['label' => '⚫ Không tiềm năng', 'bg' => '#f1f5f9', 'color' => '#475569', 'border' => '#cbd5e1'],
            ];
            $b = $badges[$status] ?? $badges['moi'];
            echo sprintf(
                '<span style="display:inline-block; padding:3px 9px; border-radius:9999px; background:%s; color:%s; border:1px solid %s; font-size:11px; font-weight:700;">%s</span>',
                $b['bg'], $b['color'], $b['border'], $b['label']
            );
            break;

        case 'lead_gsheet':
            $synced = get_post_meta($post_id, '_lead_gsheet_synced', true);
            if ($synced) {
                echo '<span style="color:#059669; font-weight:700; font-size:11px;">✓ Real-time</span>';
            } else {
                echo '<span style="color:#e11d48; font-size:11px;">Chờ gửi lại</span>';
            }
            break;
    }
}, 10, 2);

/**
 * 4. Detail Metabox for Editing Lead Status & Viewing Notes
 */
add_action('add_meta_boxes', function () {
    add_meta_box('hacoled_lead_meta', 'Chi Tiết Khách Hàng & Tiến Độ Xử Lý', function ($post) {
        $phone    = get_post_meta($post->ID, '_lead_phone', true);
        $interest = get_post_meta($post->ID, '_lead_interest', true);
        $location = get_post_meta($post->ID, '_lead_location', true);
        $page_url = get_post_meta($post->ID, '_lead_page_url', true);
        $utm      = get_post_meta($post->ID, '_lead_utm_source', true);
        $status   = get_post_meta($post->ID, '_lead_status', true) ?: 'moi';
        $notes    = get_post_meta($post->ID, '_lead_notes', true);
        $ip       = get_post_meta($post->ID, '_lead_ip', true);

        wp_nonce_field('hacoled_save_lead_meta', 'hacoled_lead_nonce');
        ?>
        <table class="form-table" style="max-width:800px;">
            <tr>
                <th style="width:180px;"><label>Số điện thoại / Zalo:</label></th>
                <td>
                    <strong style="font-size:16px; color:#0f172a; font-family:monospace;"><?php echo esc_html($phone); ?></strong>
                    <span style="margin-left:12px;">
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>" class="button button-small" style="color:#059669;"><span class="dashicons dashicons-phone" style="font-size:14px; margin-top:3px;"></span> Gọi ngay</a>
                        <a href="https://zalo.me/<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>" target="_blank" class="button button-small" style="color:#0284c7;">Mở Zalo</a>
                    </span>
                </td>
            </tr>
            <tr>
                <th><label>Sản phẩm quan tâm:</label></th>
                <td><strong style="color:#b91c1c;"><?php echo esc_html($interest); ?></strong></td>
            </tr>
            <tr>
                <th><label>Địa điểm / Kích thước:</label></th>
                <td><?php echo esc_html($location ?: 'Chưa cung cấp'); ?></td>
            </tr>
            <tr>
                <th><label>Trang gửi form & Nguồn:</label></th>
                <td>
                    <div>Nguồn Ads / UTM: <strong><?php echo esc_html($utm ?: 'Trực tiếp'); ?></strong></div>
                    <div style="font-size:12px; color:#64748b; margin-top:2px;">URL: <a href="<?php echo esc_url($page_url); ?>" target="_blank"><?php echo esc_html($page_url); ?></a></div>
                    <div style="font-size:11px; color:#94a3b8;">IP: <?php echo esc_html($ip); ?></div>
                </td>
            </tr>
            <tr>
                <th><label for="hacoled_lead_status">Trạng thái xử lý:</label></th>
                <td>
                    <select name="hacoled_lead_status" id="hacoled_lead_status" style="min-width:220px; font-weight:700;">
                        <option value="moi" <?php selected($status, 'moi'); ?>>🔴 Mới tiếp nhận</option>
                        <option value="dang_goi" <?php selected($status, 'dang_goi'); ?>>🟡 Đang tư vấn / Khảo sát</option>
                        <option value="da_bao_gia" <?php selected($status, 'da_bao_gia'); ?>>🔵 Đã gửi báo giá chi tiết</option>
                        <option value="chot_don" <?php selected($status, 'chot_don'); ?>>🟢 Chốt hợp đồng thành công</option>
                        <option value="that_bai" <?php selected($status, 'that_bai'); ?>>⚫ Không tiềm năng / Hủy</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="hacoled_lead_notes">Ghi chú chăm sóc của Sales:</label></th>
                <td>
                    <textarea name="hacoled_lead_notes" id="hacoled_lead_notes" rows="4" style="width:100%; border-radius:6px;" placeholder="Ví dụ: Đã liên hệ anh Nam hẹn khảo sát thứ 5 tại hội trường UBND..."><?php echo esc_textarea($notes); ?></textarea>
                </td>
            </tr>
        </table>
        <?php
    }, 'hacoled_lead', 'normal', 'high');
});

add_action('save_post_hacoled_lead', function ($post_id) {
    if (!isset($_POST['hacoled_lead_nonce']) || !wp_verify_nonce($_POST['hacoled_lead_nonce'], 'hacoled_save_lead_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['hacoled_lead_status'])) {
        update_post_meta($post_id, '_lead_status', sanitize_text_field($_POST['hacoled_lead_status']));
    }
    if (isset($_POST['hacoled_lead_notes'])) {
        update_post_meta($post_id, '_lead_notes', sanitize_textarea_field($_POST['hacoled_lead_notes']));
    }
});

/**
 * 5. Handle AJAX Lead Submission & Real-time Google Sheet Synchronization
 */
add_action('wp_ajax_hacoled_submit_lead', 'hacoled_handle_lead_submission');
add_action('wp_ajax_nopriv_hacoled_submit_lead', 'hacoled_handle_lead_submission');

function hacoled_handle_lead_submission() {
    // 1. Anti-spam honeypot check (hidden field, bots will fill it)
    if (!empty($_POST['website_hp'])) {
        wp_send_json_success(['message' => 'Gửi yêu cầu thành công']);
        exit;
    }

    // 2. Sanitize user inputs
    $name     = sanitize_text_field($_POST['name'] ?? 'Khách hàng');
    $phone    = sanitize_text_field($_POST['phone'] ?? '');
    $interest = sanitize_text_field($_POST['product_interest'] ?? 'Màn hình LED');
    $location = sanitize_text_field($_POST['location'] ?? '');
    $page_url = esc_url_raw($_POST['page_url'] ?? wp_get_referer());
    $utm_src  = sanitize_text_field($_POST['utm_source'] ?? 'Trực tiếp / Website');
    $ip       = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');

    // 3. Validate required phone
    $clean_phone = preg_replace('/[^0-9]/', '', $phone);
    if (strlen($clean_phone) < 9) {
        wp_send_json_error(['message' => 'Vui lòng nhập số điện thoại hoặc Zalo hợp lệ.']);
        exit;
    }

    // 4. Save lead safely into WordPress Database (CPT: hacoled_lead)
    $post_title = ($name ?: 'Khách hàng') . ' — ' . $phone;
    $post_id = wp_insert_post([
        'post_type'   => 'hacoled_lead',
        'post_title'  => $post_title,
        'post_status' => 'publish',
    ]);

    if (!is_wp_error($post_id)) {
        update_post_meta($post_id, '_lead_phone', $phone);
        update_post_meta($post_id, '_lead_interest', $interest);
        update_post_meta($post_id, '_lead_location', $location);
        update_post_meta($post_id, '_lead_page_url', $page_url);
        update_post_meta($post_id, '_lead_utm_source', $utm_src);
        update_post_meta($post_id, '_lead_status', 'moi');
        update_post_meta($post_id, '_lead_ip', $ip);
    }

    // 5. Real-time Synchronization to Google Sheets via Webhook
    $webhook_url = get_option('hacoled_gsheet_webhook_url', HACOLED_GSHEET_WEBHOOK_URL);
    $payload = [
        'name'             => $name,
        'phone'            => $phone,
        'product_interest' => $interest,
        'location'         => $location,
        'page_url'         => $page_url,
        'utm_source'       => $utm_src,
    ];

    $gsheet_success = hacoled_send_to_google_sheet($webhook_url, $payload);

    if ($post_id && !is_wp_error($post_id)) {
        update_post_meta($post_id, '_lead_gsheet_synced', $gsheet_success ? 1 : 0);
    }

    // 6. Return response to front-end
    wp_send_json_success([
        'message'       => 'Yêu cầu của bạn đã được ghi nhận thành công! Kỹ sư HacoLED sẽ gọi điện tư vấn và gửi file báo giá chi tiết qua Zalo cho bạn trong ít phút.',
        'lead_id'       => $post_id,
        'gsheet_synced' => $gsheet_success,
    ]);
}

/**
 * Send Lead Payload to Google Sheets Webhook with proper 302 redirect conversion
 */
function hacoled_send_to_google_sheet($webhook_url, $payload) {
    if (empty($webhook_url)) return false;

    if (function_exists('curl_init')) {
        $ch = curl_init($webhook_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload, JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json; charset=utf-8']);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        // Ensure 302 redirect converts POST to GET for Google Apps Script echo server
        if (defined('CURL_REDIR_POST_ALL') && defined('CURL_REDIR_POST_302')) {
            curl_setopt($ch, CURLOPT_POSTREDIR, CURL_REDIR_POST_ALL ^ CURL_REDIR_POST_302);
        }
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $response = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($code === 200) {
            $json = json_decode($response, true);
            if (!empty($json['result']) && $json['result'] === 'success') {
                return true;
            }
        }
    }

    // Fallback: wp_remote_post without redirect (Google executes doPost on initial 302)
    $res = wp_remote_post($webhook_url, [
        'body'        => json_encode($payload, JSON_UNESCAPED_UNICODE),
        'headers'     => ['Content-Type' => 'application/json; charset=utf-8'],
        'timeout'     => 8,
        'redirection' => 0,
    ]);

    if (!is_wp_error($res)) {
        $code = wp_remote_retrieve_response_code($res);
        if ($code === 200 || $code === 302) {
            return true;
        }
    }

    return false;
}
