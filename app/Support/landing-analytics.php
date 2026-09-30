<?php
/**
 * HacoLED Landing Page Analytics & User Behavior Tracking Engine.
 * 
 * Provides deep measurement of:
 * - Daily traffic (visits, unique visitors, sessions).
 * - Section-by-section impressions, reach rate & dwell time (Scroll Funnel).
 * - Detailed user behaviors (CTA clicks, hotline calls, Zalo chats, A4 profile views, tab switches, lightbox zoom, leads).
 * - Actionable conversion rate optimization (CRO) insights.
 */

defined('ABSPATH') || exit;

define('HACOLED_ANALYTICS_DB_VERSION', '1.0.0');

/**
 * 1. Initialize Tables in Database
 */
add_action('admin_init', 'hacoled_check_landing_analytics_tables');

function hacoled_check_landing_analytics_tables() {
    $installed_ver = get_option('hacoled_analytics_db_version', '');
    if ($installed_ver !== HACOLED_ANALYTICS_DB_VERSION) {
        hacoled_create_landing_analytics_tables();
        update_option('hacoled_analytics_db_version', HACOLED_ANALYTICS_DB_VERSION);
    }
}

function hacoled_create_landing_analytics_tables() {
    global $wpdb;
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $charset_collate = $wpdb->get_charset_collate();
    $table_visits = "{$wpdb->prefix}hacoled_landing_visits";
    $table_events = "{$wpdb->prefix}hacoled_landing_events";

    $sql_visits = "CREATE TABLE $table_visits (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        session_id VARCHAR(64) NOT NULL,
        ip_address VARCHAR(45) NOT NULL DEFAULT '',
        device VARCHAR(20) NOT NULL DEFAULT 'desktop',
        user_agent VARCHAR(255) NOT NULL DEFAULT '',
        referrer TEXT NULL,
        utm_source VARCHAR(100) NOT NULL DEFAULT '',
        utm_medium VARCHAR(100) NOT NULL DEFAULT '',
        utm_campaign VARCHAR(100) NOT NULL DEFAULT '',
        utm_term VARCHAR(100) NOT NULL DEFAULT '',
        page_url TEXT NULL,
        max_scroll_depth TINYINT(3) UNSIGNED NOT NULL DEFAULT 0,
        total_time_seconds INT(10) UNSIGNED NOT NULL DEFAULT 0,
        has_converted TINYINT(1) NOT NULL DEFAULT 0,
        is_admin_visit TINYINT(1) NOT NULL DEFAULT 0,
        created_at DATETIME NOT NULL,
        updated_at DATETIME NOT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY session_id (session_id),
        KEY created_at (created_at),
        KEY device (device),
        KEY utm_source (utm_source),
        KEY is_admin_visit (is_admin_visit)
    ) $charset_collate;";

    $sql_events = "CREATE TABLE $table_events (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        session_id VARCHAR(64) NOT NULL,
        event_type VARCHAR(50) NOT NULL,
        target_id VARCHAR(100) NOT NULL,
        target_label VARCHAR(255) NOT NULL,
        dwell_time INT(10) UNSIGNED NOT NULL DEFAULT 0,
        metadata TEXT NULL,
        is_admin_visit TINYINT(1) NOT NULL DEFAULT 0,
        created_at DATETIME NOT NULL,
        PRIMARY KEY (id),
        KEY session_id (session_id),
        KEY event_type (event_type),
        KEY target_id (target_id),
        KEY created_at (created_at),
        KEY is_admin_visit (is_admin_visit)
    ) $charset_collate;";

    dbDelta($sql_visits);
    dbDelta($sql_events);
}

/**
 * 2. Register Submenu in WP Admin under 'Khách Hàng' (Lead Manager CPT)
 */
add_action('admin_menu', function () {
    add_submenu_page(
        'edit.php?post_type=hacoled_lead',
        'Đo Lường & Thống Kê Trang LED',
        '📊 Thống Kê Trang LED',
        'manage_options',
        'hacoled-landing-analytics',
        'hacoled_render_landing_analytics_page'
    );
});

/**
 * 3. Handle Tracking AJAX / Beacon Requests (Front-end)
 */
add_action('wp_ajax_hacoled_track_analytics', 'hacoled_handle_track_analytics');
add_action('wp_ajax_nopriv_hacoled_track_analytics', 'hacoled_handle_track_analytics');

function hacoled_handle_track_analytics() {
    global $wpdb;

    // Support both FormData/POST and raw JSON (via navigator.sendBeacon)
    $payload_raw = file_get_contents('php://input');
    $data = [];
    if (!empty($payload_raw)) {
        $json = json_decode($payload_raw, true);
        if (is_array($json)) {
            $data = $json;
        }
    }
    if (empty($data)) {
        $data = $_POST;
    }

    $type = sanitize_key($data['type'] ?? 'event');
    $session_id = sanitize_text_field($data['session_id'] ?? '');

    if (empty($session_id)) {
        wp_send_json_error(['message' => 'Missing session_id']);
        exit;
    }

    $is_admin = (is_user_logged_in() && current_user_can('manage_options')) ? 1 : (int)($data['is_admin'] ?? 0);
    $now = current_time('mysql');
    $table_visits = "{$wpdb->prefix}hacoled_landing_visits";
    $table_events = "{$wpdb->prefix}hacoled_landing_events";

    // 3.1 TYPE: VISIT (Initial Page Load)
    if ($type === 'visit') {
        $raw_ip = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
        $ua = sanitize_text_field(substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255));
        
        // Detect Device
        $device = 'desktop';
        if (wp_is_mobile()) {
            $device = 'mobile';
        }
        if (!empty($data['device']) && in_array($data['device'], ['mobile', 'tablet', 'desktop'], true)) {
            $device = sanitize_text_field($data['device']);
        }

        $referrer = esc_url_raw($data['referrer'] ?? wp_get_referer());
        $page_url = esc_url_raw($data['page_url'] ?? '');
        $utm_source = sanitize_text_field(substr($data['utm_source'] ?? '', 0, 100));
        $utm_medium = sanitize_text_field(substr($data['utm_medium'] ?? '', 0, 100));
        $utm_campaign = sanitize_text_field(substr($data['utm_campaign'] ?? '', 0, 100));
        $utm_term = sanitize_text_field(substr($data['utm_term'] ?? '', 0, 100));

        // Insert or ignore if duplicate session
        $existing = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table_visits WHERE session_id = %s", $session_id));
        if (!$existing) {
            $wpdb->insert($table_visits, [
                'session_id'         => $session_id,
                'ip_address'         => $raw_ip,
                'device'             => $device,
                'user_agent'         => $ua,
                'referrer'           => $referrer,
                'utm_source'         => $utm_source,
                'utm_medium'         => $utm_medium,
                'utm_campaign'       => $utm_campaign,
                'utm_term'           => $utm_term,
                'page_url'           => $page_url,
                'max_scroll_depth'   => 0,
                'total_time_seconds' => 0,
                'has_converted'      => 0,
                'is_admin_visit'     => $is_admin,
                'created_at'         => $now,
                'updated_at'         => $now,
            ], ['%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%d', '%d', '%s', '%s']);
        }

        wp_send_json_success(['status' => 'visit_recorded']);
        exit;
    }

    // 3.2 TYPE: EVENTS (Batch or Single Event: section_view, cta_click, tab_switch, etc.)
    if ($type === 'event' || $type === 'events') {
        $events_list = [];
        if (!empty($data['events']) && is_array($data['events'])) {
            $events_list = $data['events'];
        } elseif (!empty($data['event_type'])) {
            $events_list[] = [
                'event_type'   => $data['event_type'],
                'target_id'    => $data['target_id'] ?? '',
                'target_label' => $data['target_label'] ?? '',
                'dwell_time'   => $data['dwell_time'] ?? 0,
                'metadata'     => $data['metadata'] ?? '',
            ];
        }

        $has_conversion = false;
        foreach ($events_list as $ev) {
            $ev_type = sanitize_key($ev['event_type'] ?? 'event');
            $target_id = sanitize_text_field(substr($ev['target_id'] ?? '', 0, 100));
            $target_label = sanitize_text_field(substr($ev['target_label'] ?? '', 0, 255));
            $dwell_time = (int)($ev['dwell_time'] ?? 0);
            $meta = is_array($ev['metadata'] ?? null) ? json_encode($ev['metadata'], JSON_UNESCAPED_UNICODE) : sanitize_text_field($ev['metadata'] ?? '');

            if ($ev_type === 'cta_click' || $ev_type === 'form_submit') {
                $has_conversion = true;
            }

            $wpdb->insert($table_events, [
                'session_id'     => $session_id,
                'event_type'     => $ev_type,
                'target_id'      => $target_id,
                'target_label'   => $target_label,
                'dwell_time'     => $dwell_time,
                'metadata'       => $meta,
                'is_admin_visit' => $is_admin,
                'created_at'     => $now,
            ], ['%s', '%s', '%s', '%s', '%d', '%s', '%d', '%s']);
        }

        // If user interacted with a conversion element, update visit record
        if ($has_conversion) {
            $wpdb->update($table_visits, [
                'has_converted' => 1,
                'updated_at'    => $now,
            ], ['session_id' => $session_id], ['%d', '%s'], ['%s']);
        }

        wp_send_json_success(['status' => 'events_recorded', 'count' => count($events_list)]);
        exit;
    }

    // 3.3 TYPE: PING / LEAVE (Update Max Scroll Depth & Total Time)
    if ($type === 'ping' || $type === 'leave') {
        $scroll_depth = min(100, max(0, (int)($data['scroll_depth'] ?? 0)));
        $time_seconds = max(0, (int)($data['time_seconds'] ?? 0));

        $update_data = ['updated_at' => $now];
        $update_formats = ['%s'];

        if ($scroll_depth > 0) {
            $update_data['max_scroll_depth'] = $scroll_depth;
            $update_formats[] = '%d';
        }
        if ($time_seconds > 0) {
            $update_data['total_time_seconds'] = $time_seconds;
            $update_formats[] = '%d';
        }

        $wpdb->update($table_visits, $update_data, ['session_id' => $session_id], $update_formats, ['%s']);

        wp_send_json_success(['status' => 'session_updated']);
        exit;
    }

    wp_send_json_error(['message' => 'Unknown tracking type']);
}

/**
 * 4. Admin AJAX: Clear Test Data
 */
add_action('wp_ajax_hacoled_clear_analytics_data', function () {
    check_ajax_referer('hacoled_clear_analytics_nonce', 'nonce');
    if (!current_user_can('manage_options')) {
        wp_send_json_error(['message' => 'Không có quyền thực hiện']);
    }

    global $wpdb;
    $scope = sanitize_key($_POST['scope'] ?? 'admin_only');
    $table_visits = "{$wpdb->prefix}hacoled_landing_visits";
    $table_events = "{$wpdb->prefix}hacoled_landing_events";

    if ($scope === 'all') {
        $wpdb->query("TRUNCATE TABLE $table_visits");
        $wpdb->query("TRUNCATE TABLE $table_events");
        wp_send_json_success(['message' => 'Đã xóa toàn bộ dữ liệu thống kê thành công!']);
    } else {
        $wpdb->query("DELETE FROM $table_visits WHERE is_admin_visit = 1");
        $wpdb->query("DELETE FROM $table_events WHERE is_admin_visit = 1");
        wp_send_json_success(['message' => 'Đã xóa toàn bộ dữ liệu thử nghiệm của Admin!']);
    }
});

/**
 * 5. Data Analytics Aggregator Functions for Dashboard
 */

// Helper to construct WHERE clause by date range and admin exclusion
function hacoled_analytics_where_clause($range, $exclude_admin, $alias = '') {
    $prefix = $alias ? "{$alias}." : "";
    $clauses = ["1=1"];

    if ($exclude_admin) {
        $clauses[] = "{$prefix}is_admin_visit = 0";
    }

    switch ($range) {
        case 'today':
            $clauses[] = "DATE({$prefix}created_at) = CURDATE()";
            break;
        case 'yesterday':
            $clauses[] = "DATE({$prefix}created_at) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)";
            break;
        case '7days':
            $clauses[] = "{$prefix}created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
            break;
        case '30days':
            $clauses[] = "{$prefix}created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
            break;
        case 'all':
        default:
            // No date filter
            break;
    }

    return implode(' AND ', $clauses);
}

// 5.1 KPI Summary Cards
function hacoled_get_analytics_summary($range, $exclude_admin) {
    global $wpdb;
    $table_visits = "{$wpdb->prefix}hacoled_landing_visits";
    $table_events = "{$wpdb->prefix}hacoled_landing_events";
    $where_v = hacoled_analytics_where_clause($range, $exclude_admin);
    $where_e = hacoled_analytics_where_clause($range, $exclude_admin);

    $visits_row = $wpdb->get_row("
        SELECT 
            COUNT(id) AS total_visits,
            COUNT(DISTINCT session_id) AS unique_visitors,
            AVG(total_time_seconds) AS avg_time,
            AVG(max_scroll_depth) AS avg_scroll,
            SUM(has_converted) AS total_converted
        FROM $table_visits
        WHERE $where_v
    ");

    $events_row = $wpdb->get_row("
        SELECT 
            COUNT(id) AS total_events,
            SUM(CASE WHEN event_type = 'cta_click' THEN 1 ELSE 0 END) AS total_cta_clicks,
            SUM(CASE WHEN event_type = 'form_submit' THEN 1 ELSE 0 END) AS total_leads
        FROM $table_events
        WHERE $where_e
    ");

    $total_visits = (int)($visits_row->total_visits ?? 0);
    $unique_visitors = (int)($visits_row->unique_visitors ?? 0);
    $avg_time = (int)($visits_row->avg_time ?? 0);
    $avg_scroll = (int)($visits_row->avg_scroll ?? 0);
    $total_cta = (int)($events_row->total_cta_clicks ?? 0);
    $total_leads = (int)($events_row->total_leads ?? 0);
    $total_converted = (int)($visits_row->total_converted ?? 0);

    $conversion_rate = ($total_visits > 0) ? round(($total_converted / $total_visits) * 100, 1) : 0;
    $cta_rate = ($total_visits > 0) ? round(($total_cta / $total_visits) * 100, 1) : 0;

    return [
        'total_visits'     => $total_visits,
        'unique_visitors'  => $unique_visitors,
        'avg_time'         => $avg_time,
        'avg_scroll'       => $avg_scroll,
        'total_cta'        => $total_cta,
        'total_leads'      => $total_leads,
        'conversion_rate'  => $conversion_rate,
        'cta_rate'         => $cta_rate,
    ];
}

// 5.2 Daily Visits Chart Data
function hacoled_get_analytics_daily_chart($range, $exclude_admin) {
    global $wpdb;
    $table_visits = "{$wpdb->prefix}hacoled_landing_visits";
    $table_events = "{$wpdb->prefix}hacoled_landing_events";
    
    // Always default to last 14 days if '7days' or '30days'
    $days_count = ($range === '30days') ? 30 : 14;
    if ($range === 'today' || $range === 'yesterday') {
        $days_count = 7;
    }

    $where_v = $exclude_admin ? "is_admin_visit = 0 AND" : "";
    $results = $wpdb->get_results("
        SELECT 
            DATE(created_at) as visit_date,
            COUNT(id) as visits,
            COUNT(DISTINCT session_id) as uniques,
            SUM(has_converted) as conversions
        FROM $table_visits
        WHERE $where_v created_at >= DATE_SUB(CURDATE(), INTERVAL $days_count DAY)
        GROUP BY DATE(created_at)
        ORDER BY visit_date ASC
    ", ARRAY_A);

    // Fill missing dates with 0 for smooth graph
    $chart = [];
    $indexed = [];
    foreach ($results as $r) {
        $indexed[$r['visit_date']] = $r;
    }

    for ($i = $days_count; $i >= 0; $i--) {
        $d = date('Y-m-d', strtotime("-$i days"));
        $short_label = date('d/m', strtotime($d));
        if (isset($indexed[$d])) {
            $chart[] = [
                'date'        => $d,
                'label'       => $short_label,
                'visits'      => (int)$indexed[$d]['visits'],
                'uniques'     => (int)$indexed[$d]['uniques'],
                'conversions' => (int)$indexed[$d]['conversions'],
            ];
        } else {
            $chart[] = [
                'date'        => $d,
                'label'       => $short_label,
                'visits'      => 0,
                'uniques'     => 0,
                'conversions' => 0,
            ];
        }
    }

    return $chart;
}

// 5.3 Section Impressions & Funnel Drop-off Analysis
function hacoled_get_analytics_sections($range, $exclude_admin, $total_visits = 1) {
    global $wpdb;
    $table_events = "{$wpdb->prefix}hacoled_landing_events";
    $where = hacoled_analytics_where_clause($range, $exclude_admin);

    // List of canonical sections on the LED Landing page in natural order
    $canonical_sections = [
        'sec-hero' => [
            'id'    => 'sec-hero',
            'name'  => 'Hero Banner Đầu Trang',
            'desc'  => 'Banner chính, Headline, Uy tín số 1, Nút Báo giá & Khảo sát',
            'icon'  => 'dashicons-slides',
        ],
        'sec-solutions-studio' => [
            'id'    => 'sec-solutions-studio',
            'name'  => 'Studio 5 Giải Pháp Không Gian',
            'desc'  => 'Hội trường, Phòng họp, Sân khấu, Showroom, Sự kiện & Nút Xem Hồ sơ A4',
            'icon'  => 'dashicons-grid-view',
        ],
        'sec-man-hinh-led-trong-nha' => [
            'id'    => 'sec-man-hinh-led-trong-nha',
            'name'  => 'Danh mục 01: LED Trong Nhà',
            'desc'  => 'Dòng P0.9 - P3.0 phòng họp, hội trường, độ tương phản cao',
            'icon'  => 'dashicons-desktop',
        ],
        'sec-man-hinh-led-ngoai-troi' => [
            'id'    => 'sec-man-hinh-led-ngoai-troi',
            'name'  => 'Danh mục 02: LED Ngoài Trời',
            'desc'  => 'Dòng P3.0 - P10 chuẩn IP65 chống nước, độ sáng 8000 nits',
            'icon'  => 'dashicons-visibility',
        ],
        'sec-man-hinh-led-trong-suot' => [
            'id'    => 'sec-man-hinh-led-trong-suot',
            'name'  => 'Danh mục 03: LED Trong Suốt',
            'desc'  => 'Độ trong suốt 75-90% cho trung tâm thương mại và showroom',
            'icon'  => 'dashicons-admin-appearance',
        ],
        'sec-giai-phap-man-hinh-led' => [
            'id'    => 'sec-giai-phap-man-hinh-led',
            'name'  => 'Danh mục 04: Giải Pháp Ứng Dụng',
            'desc'  => 'Giải pháp giảng đường, tiệc cưới, y tế bệnh viện thông minh',
            'icon'  => 'dashicons-lightbulb',
        ],
        'sec-man-hinh-led-studio' => [
            'id'    => 'sec-man-hinh-led-studio',
            'name'  => 'Danh mục 05: LED Studio xR',
            'desc'  => 'Phim trường ảo 7680Hz, đài truyền hình, sàn LED chịu lực 2 tấn',
            'icon'  => 'dashicons-video-alt3',
        ],
        'sec-man-hinh-led-cong' => [
            'id'    => 'sec-man-hinh-led-cong',
            'name'  => 'Danh mục 06: LED Cong 3D',
            'desc'  => 'Uốn cong 360 độ, màn hình góc vuông 90 độ hiệu ứng 3D Naked-Eye',
            'icon'  => 'dashicons-image-rotate',
        ],
        'sec-man-hinh-led-film-dan-kinh' => [
            'id'    => 'sec-man-hinh-led-film-dan-kinh',
            'name'  => 'Danh mục 07: LED Film Dán Kính',
            'desc'  => 'Dán trực tiếp vách kính, siêu nhẹ 3kg/m2, không chắn tầm nhìn',
            'icon'  => 'dashicons-format-gallery',
        ],
        'sec-projects' => [
            'id'    => 'sec-projects',
            'name'  => 'Dự Án Thực Tế & Công Trình Tiêu Biểu',
            'desc'  => 'Băng chuyền vô tận 2 hàng Masonry và phóng to ảnh Lightbox',
            'icon'  => 'dashicons-portfolio',
        ],
        'sec-reviews' => [
            'id'    => 'sec-reviews',
            'name'  => 'Đánh Giá Khách Hàng (Reviews)',
            'desc'  => 'Phản hồi từ Ban quản lý tòa nhà, Geleximco, Sun Group',
            'icon'  => 'dashicons-testimonial',
        ],
        'sec-faq' => [
            'id'    => 'sec-faq',
            'name'  => 'Câu Hỏi FAQ & Form Khảo Sát Kỹ Sư',
            'desc'  => 'Box đặt lịch khảo sát 2 giờ & 4 câu hỏi thường gặp nhất',
            'icon'  => 'dashicons-editor-help',
        ],
    ];

    $db_stats = $wpdb->get_results("
        SELECT 
            target_id,
            COUNT(id) as total_views,
            COUNT(DISTINCT session_id) as unique_sessions,
            AVG(dwell_time) as avg_dwell_time
        FROM $table_events
        WHERE $where AND event_type = 'section_view'
        GROUP BY target_id
    ", ARRAY_A);

    $mapped = [];
    foreach ($db_stats as $s) {
        $mapped[$s['target_id']] = $s;
    }

    $base_reach = max(1, $total_visits);
    $sections = [];
    $prev_reach = 100;

    foreach ($canonical_sections as $sec_id => $info) {
        $view_count = isset($mapped[$sec_id]) ? (int)$mapped[$sec_id]['total_views'] : 0;
        $unique_sessions = isset($mapped[$sec_id]) ? (int)$mapped[$sec_id]['unique_sessions'] : 0;
        $dwell = isset($mapped[$sec_id]) ? round((float)$mapped[$sec_id]['avg_dwell_time'], 1) : 0;

        // % of total visitors who reached this section
        $reach_pct = ($total_visits > 0) ? min(100, round(($unique_sessions / $total_visits) * 100, 1)) : 0;
        
        // Calculate drop-off compared to previous section
        $drop_off = ($prev_reach > 0 && $reach_pct < $prev_reach) ? round($prev_reach - $reach_pct, 1) : 0;
        $prev_reach = $reach_pct;

        // Actionable CRO recommendation
        $insight = '';
        if ($sec_id === 'sec-hero') {
            $insight = 'Điểm chạm đầu tiên. Cần giữ thông điệp rõ ràng và CTA nổi bật ngay trong màn hình 1.';
        } elseif ($reach_pct >= 70) {
            $insight = '🔥 Khu vực tương tác mạnh! Tỷ lệ tiếp cận cao, nên đặt ưu đãi hoặc hotline tại đây.';
        } elseif ($dwell >= 12) {
            $insight = '⭐ Khách dừng lại đọc rất kỹ (' . $dwell . 's)! Nội dung phần này rất thu hút khách.';
        } elseif ($drop_off >= 20) {
            $insight = '⚠️ Điểm rơi khách lớn (-' . $drop_off . '%). Nên rút gọn bớt độ dài hoặc thêm nút CTA kêu gọi ngay trước phần này.';
        } else {
            $insight = 'Tỷ lệ xem ổn định. Thường xuyên cập nhật hình ảnh dự án thực tế để tăng uy tín.';
        }

        $sections[] = array_merge($info, [
            'views'           => $view_count,
            'unique_sessions' => $unique_sessions,
            'reach_pct'       => $reach_pct,
            'dwell_time'      => $dwell,
            'drop_off'        => $drop_off,
            'insight'         => $insight,
        ]);
    }

    return $sections;
}

// 5.4 Top User Behaviors & CTA Heatmap
function hacoled_get_analytics_behaviors($range, $exclude_admin) {
    global $wpdb;
    $table_events = "{$wpdb->prefix}hacoled_landing_events";
    $where = hacoled_analytics_where_clause($range, $exclude_admin);

    $results = $wpdb->get_results("
        SELECT 
            target_id,
            target_label,
            event_type,
            COUNT(id) as click_count,
            COUNT(DISTINCT session_id) as unique_users
        FROM $table_events
        WHERE $where AND event_type IN ('cta_click', 'tab_switch', 'lightbox_open', 'form_submit', 'faq_expand')
        GROUP BY target_id, target_label, event_type
        ORDER BY click_count DESC
        LIMIT 25
    ", ARRAY_A);

    return $results;
}

// 5.5 Device & Traffic Sources Breakdown
function hacoled_get_analytics_devices($range, $exclude_admin) {
    global $wpdb;
    $table_visits = "{$wpdb->prefix}hacoled_landing_visits";
    $where = hacoled_analytics_where_clause($range, $exclude_admin);

    return $wpdb->get_results("
        SELECT 
            device,
            COUNT(id) as count
        FROM $table_visits
        WHERE $where
        GROUP BY device
        ORDER BY count DESC
    ", ARRAY_A);
}

function hacoled_get_analytics_sources($range, $exclude_admin) {
    global $wpdb;
    $table_visits = "{$wpdb->prefix}hacoled_landing_visits";
    $where = hacoled_analytics_where_clause($range, $exclude_admin);

    return $wpdb->get_results("
        SELECT 
            CASE 
                WHEN utm_source != '' THEN utm_source 
                WHEN referrer LIKE '%facebook%' THEN 'Facebook Ads / Post'
                WHEN referrer LIKE '%google%' THEN 'Google Search / Ads'
                WHEN referrer LIKE '%zalo%' THEN 'Zalo Ads / Chat'
                WHEN referrer LIKE '%tiktok%' THEN 'TikTok Ads'
                ELSE 'Trực tiếp / Website' 
            END as source_name,
            COUNT(id) as count,
            SUM(has_converted) as conversions
        FROM $table_visits
        WHERE $where
        GROUP BY source_name
        ORDER BY count DESC
        LIMIT 10
    ", ARRAY_A);
}

// 5.6 Recent Visitor Journeys Feed
function hacoled_get_analytics_recent_sessions($limit = 15, $exclude_admin = true) {
    global $wpdb;
    $table_visits = "{$wpdb->prefix}hacoled_landing_visits";
    $table_events = "{$wpdb->prefix}hacoled_landing_events";

    $where_v = $exclude_admin ? "is_admin_visit = 0" : "1=1";
    $sessions = $wpdb->get_results("
        SELECT * FROM $table_visits
        WHERE $where_v
        ORDER BY created_at DESC
        LIMIT $limit
    ", ARRAY_A);

    if (empty($sessions)) return [];

    $session_ids = array_map(function($s) { return "'" . esc_sql($s['session_id']) . "'"; }, $sessions);
    $in_clause = implode(',', $session_ids);

    $events = $wpdb->get_results("
        SELECT session_id, event_type, target_label, dwell_time, created_at
        FROM $table_events
        WHERE session_id IN ($in_clause)
        ORDER BY created_at ASC
    ", ARRAY_A);

    $events_by_session = [];
    foreach ($events as $ev) {
        $events_by_session[$ev['session_id']][] = $ev;
    }

    foreach ($sessions as &$s) {
        $s['events'] = $events_by_session[$s['session_id']] ?? [];
    }

    return $sessions;
}

/**
 * 6. Admin Page Renderer (Modern High-Conversion UI)
 */
function hacoled_render_landing_analytics_page() {
    $range = sanitize_key($_GET['range'] ?? '7days');
    $exclude_admin = isset($_GET['include_admin']) ? 0 : 1;

    $summary   = hacoled_get_analytics_summary($range, $exclude_admin);
    $daily     = hacoled_get_analytics_daily_chart($range, $exclude_admin);
    $sections  = hacoled_get_analytics_sections($range, $exclude_admin, $summary['total_visits']);
    $behaviors = hacoled_get_analytics_behaviors($range, $exclude_admin);
    $devices   = hacoled_get_analytics_devices($range, $exclude_admin);
    $sources   = hacoled_get_analytics_sources($range, $exclude_admin);
    $recents   = hacoled_get_analytics_recent_sessions(12, $exclude_admin);

    $landing_url = home_url('/man-hinh-led/');
    ?>
    <div class="wrap hacoled-analytics-wrap" style="max-width: 1400px; margin: 20px auto 40px auto; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
        
        <!-- Header Banner -->
        <div style="background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%); color: #fff; padding: 24px 30px; border-radius: 16px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1); margin-bottom: 24px; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px;">
            <div>
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
                    <span style="background: #B31217; color: #fff; font-size: 11px; font-weight: 800; padding: 3px 8px; border-radius: 6px; letter-spacing: 0.5px;">HACOLED PRO ANALYTICS</span>
                    <span style="display: inline-flex; align-items: center; gap: 5px; font-size: 12px; color: #4ADE80; font-weight: 600;">
                        <span style="display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: #4ADE80; animation: pulse 2s infinite;"></span>
                        Đang thu thập thời gian thực (Real-time Active)
                    </span>
                </div>
                <h1 style="color: #fff; font-size: 26px; font-weight: 900; margin: 0; line-height: 1.2;">
                    Đo Lường & Phân Tích Hành Vi Trang Màn Hình LED
                </h1>
                <p style="color: #94A3B8; font-size: 13px; margin: 6px 0 0 0;">
                    Trang mục tiêu: <a href="<?php echo esc_url($landing_url); ?>" target="_blank" style="color: #FBBF24; text-decoration: underline; font-weight: 600;"><?php echo esc_html($landing_url); ?></a> · Cung cấp đầy đủ chỉ số truy cập, phễu cuộn từng phần và các điểm chạm hành vi.
                </p>
            </div>

            <!-- Controls: Filter & Actions -->
            <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 10px;">
                <!-- Range Selector Form -->
                <form method="GET" action="" style="display: flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.08); padding: 4px 8px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.15);">
                    <input type="hidden" name="post_type" value="hacoled_lead">
                    <input type="hidden" name="page" value="hacoled-landing-analytics">
                    
                    <label style="font-size: 12px; color: #CBD5E1; font-weight: 600;">Thời gian:</label>
                    <select name="range" onchange="this.form.submit()" style="background: #0F172A; color: #fff; border: 1px solid #334155; border-radius: 6px; padding: 4px 8px; font-size: 12px; font-weight: 600;">
                        <option value="today" <?php selected($range, 'today'); ?>>Hôm nay</option>
                        <option value="yesterday" <?php selected($range, 'yesterday'); ?>>Hôm qua</option>
                        <option value="7days" <?php selected($range, '7days'); ?>>7 ngày qua</option>
                        <option value="30days" <?php selected($range, '30days'); ?>>30 ngày qua</option>
                        <option value="all" <?php selected($range, 'all'); ?>>Tất cả dữ liệu</option>
                    </select>

                    <label style="font-size: 12px; color: #CBD5E1; margin-left: 8px; display: flex; align-items: center; gap: 4px; cursor: pointer;">
                        <input type="checkbox" name="include_admin" value="1" <?php checked($exclude_admin, 0); ?> onchange="this.form.submit()">
                        Tính cả Admin
                    </label>
                </form>

                <button type="button" onclick="hacoledClearTestData('admin_only')" class="button" style="background: rgba(239, 68, 68, 0.2); color: #FCA5A5; border-color: rgba(239, 68, 68, 0.4); font-size: 12px; font-weight: 600; border-radius: 8px; padding: 4px 12px;">
                    🧹 Xóa Test Admin
                </button>
                <a href="<?php echo esc_url($landing_url); ?>" target="_blank" class="button button-primary" style="background: #B31217; border-color: #B31217; font-size: 12px; font-weight: 700; border-radius: 8px; padding: 4px 14px;">
                    Mở Trang Landing &rarr;
                </a>
            </div>
        </div>

        <!-- 1. KPI TOP CARDS (6 Key Metrics) -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 24px;">
            
            <!-- Total Visits -->
            <div style="background: #fff; border-radius: 14px; padding: 20px; border: 1px solid #E2E8F0; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <span style="font-size: 12px; font-weight: 700; color: #64748B; text-transform: uppercase;">Lượt Truy Cập</span>
                    <span style="background: #EFF6FF; color: #2563EB; width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                        <span class="dashicons dashicons-visibility" style="font-size: 18px;"></span>
                    </span>
                </div>
                <div style="font-size: 28px; font-weight: 900; color: #0F172A; line-height: 1.1;">
                    <?php echo number_format_i18n($summary['total_visits']); ?>
                </div>
                <div style="font-size: 11px; color: #64748B; margin-top: 6px;">
                    Khách riêng: <strong><?php echo number_format_i18n($summary['unique_visitors']); ?></strong> (<?php echo ($summary['total_visits'] > 0) ? round(($summary['unique_visitors']/$summary['total_visits'])*100) : 0; ?>%)
                </div>
            </div>

            <!-- Avg Time on Page -->
            <div style="background: #fff; border-radius: 14px; padding: 20px; border: 1px solid #E2E8F0; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <span style="font-size: 12px; font-weight: 700; color: #64748B; text-transform: uppercase;">Thời Gian Trên Trang</span>
                    <span style="background: #FEF3C7; color: #D97706; width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                        <span class="dashicons dashicons-clock" style="font-size: 18px;"></span>
                    </span>
                </div>
                <div style="font-size: 28px; font-weight: 900; color: #0F172A; line-height: 1.1;">
                    <?php 
                    $secs = $summary['avg_time'];
                    $mins = floor($secs / 60);
                    $rem_secs = $secs % 60;
                    echo ($mins > 0) ? "{$mins}p {$rem_secs}s" : "{$secs}s";
                    ?>
                </div>
                <div style="font-size: 11px; color: #64748B; margin-top: 6px;">
                    Độ cuộn sâu TB: <strong><?php echo $summary['avg_scroll']; ?>%</strong> trang
                </div>
            </div>

            <!-- Total CTA Clicks -->
            <div style="background: #fff; border-radius: 14px; padding: 20px; border: 1px solid #E2E8F0; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <span style="font-size: 12px; font-weight: 700; color: #64748B; text-transform: uppercase;">Tương Tác Bấm Nút</span>
                    <span style="background: #F3E8FF; color: #9333EA; width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                        <span class="dashicons dashicons-external" style="font-size: 18px;"></span>
                    </span>
                </div>
                <div style="font-size: 28px; font-weight: 900; color: #0F172A; line-height: 1.1;">
                    <?php echo number_format_i18n($summary['total_cta']); ?>
                </div>
                <div style="font-size: 11px; color: #64748B; margin-top: 6px;">
                    Tỷ lệ tương tác: <strong><?php echo $summary['cta_rate']; ?>%</strong>
                </div>
            </div>

            <!-- Leads / Form Submissions -->
            <div style="background: #fff; border-radius: 14px; padding: 20px; border: 1px solid #E2E8F0; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <span style="font-size: 12px; font-weight: 700; color: #64748B; text-transform: uppercase;">Khách Đăng Ký Form</span>
                    <span style="background: #DCFCE7; color: #16A34A; width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                        <span class="dashicons dashicons-clipboard" style="font-size: 18px;"></span>
                    </span>
                </div>
                <div style="font-size: 28px; font-weight: 900; color: #16A34A; line-height: 1.1;">
                    <?php echo number_format_i18n($summary['total_leads']); ?>
                </div>
                <div style="font-size: 11px; color: #64748B; margin-top: 6px;">
                    <a href="edit.php?post_type=hacoled_lead" style="color: #2563EB; font-weight: 600; text-decoration: none;">Xem danh sách CRM &rarr;</a>
                </div>
            </div>

            <!-- Conversion Rate -->
            <div style="background: #fff; border-radius: 14px; padding: 20px; border: 1px solid #E2E8F0; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <span style="font-size: 12px; font-weight: 700; color: #64748B; text-transform: uppercase;">Tỷ Lệ Chuyển Đổi</span>
                    <span style="background: #FEE2E2; color: #DC2626; width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                        <span class="dashicons dashicons-chart-pie" style="font-size: 18px;"></span>
                    </span>
                </div>
                <div style="font-size: 28px; font-weight: 900; color: #B31217; line-height: 1.1;">
                    <?php echo $summary['conversion_rate']; ?>%
                </div>
                <div style="font-size: 11px; color: #64748B; margin-top: 6px;">
                    Khách có hành động chuyển đổi
                </div>
            </div>

        </div>

        <!-- 2. DAILY VISITS & TREND CHART -->
        <div style="background: #fff; border-radius: 14px; padding: 24px; border: 1px solid #E2E8F0; box-shadow: 0 4px 12px rgba(0,0,0,0.03); margin-bottom: 24px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div>
                    <h3 style="font-size: 16px; font-weight: 800; color: #0F172A; margin: 0;">
                        Biến Thiên Lượt Truy Cập Hằng Ngày
                    </h3>
                    <p style="font-size: 12px; color: #64748B; margin: 4px 0 0 0;">
                        Số lượt truy cập (Visits), Khách riêng (Uniques) và Lượt chuyển đổi theo từng ngày
                    </p>
                </div>
                <div style="display: flex; align-items: center; gap: 14px; font-size: 12px; font-weight: 600;">
                    <span style="display: flex; align-items: center; gap: 5px;">
                        <span style="width: 12px; height: 12px; border-radius: 3px; background: #B31217;"></span> Lượt xem
                    </span>
                    <span style="display: flex; align-items: center; gap: 5px;">
                        <span style="width: 12px; height: 12px; border-radius: 3px; background: #3B82F6;"></span> Khách riêng
                    </span>
                    <span style="display: flex; align-items: center; gap: 5px;">
                        <span style="width: 12px; height: 12px; border-radius: 3px; background: #10B981;"></span> Chuyển đổi
                    </span>
                </div>
            </div>

            <!-- CSS/SVG Visual Bar Chart -->
            <?php 
            $max_val = 1;
            foreach ($daily as $d) {
                if ($d['visits'] > $max_val) $max_val = $d['visits'];
            }
            ?>
            <div style="display: flex; align-items: flex-end; gap: 8px; height: 180px; padding-top: 20px; border-bottom: 2px solid #E2E8F0; margin-bottom: 8px;">
                <?php foreach ($daily as $d): 
                    $h_visits = ($d['visits'] > 0) ? max(8, round(($d['visits'] / $max_val) * 140)) : 3;
                    $h_uniques = ($d['uniques'] > 0) ? max(6, round(($d['uniques'] / $max_val) * 140)) : 2;
                ?>
                    <div style="flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: flex-end; height: 100%; position: relative;" title="<?php echo esc_attr($d['date'] . ': ' . $d['visits'] . ' lượt xem, ' . $d['uniques'] . ' khách riêng, ' . $d['conversions'] . ' chuyển đổi'); ?>">
                        <?php if ($d['visits'] > 0): ?>
                            <span style="font-size: 10px; font-weight: 700; color: #475569; margin-bottom: 4px;"><?php echo $d['visits']; ?></span>
                        <?php endif; ?>
                        
                        <div style="width: 100%; max-width: 24px; display: flex; align-items: flex-end; gap: 2px;">
                            <div style="flex: 1; height: <?php echo $h_visits; ?>px; background: #B31217; border-radius: 3px 3px 0 0; transition: height 0.3s;"></div>
                            <div style="flex: 1; height: <?php echo $h_uniques; ?>px; background: #3B82F6; border-radius: 3px 3px 0 0; transition: height 0.3s;"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div style="display: flex; justify-content: space-between; gap: 8px;">
                <?php foreach ($daily as $d): ?>
                    <div style="flex: 1; text-align: center; font-size: 10px; color: #94A3B8; font-weight: 600;">
                        <?php echo $d['label']; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- 3. SECTION-BY-SECTION VISIBILITY & SCROLL DEPTH FUNNEL (CRITICAL USER REQUEST) -->
        <div style="background: #fff; border-radius: 14px; padding: 24px; border: 1px solid #E2E8F0; box-shadow: 0 4px 12px rgba(0,0,0,0.03); margin-bottom: 24px;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 18px; flex-wrap: wrap; gap: 10px;">
                <div>
                    <div style="display: inline-block; background: #FEF2F2; color: #B31217; font-size: 11px; font-weight: 800; padding: 2px 8px; border-radius: 6px; margin-bottom: 4px;">
                        ĐO LƯỜNG TỪNG PHẦN (SECTION ANALYTICS & CRO FUNNEL)
                    </div>
                    <h3 style="font-size: 18px; font-weight: 900; color: #0F172A; margin: 0;">
                        Hiệu Suất & Tỷ Lệ Khách Xem Từng Phần Của Trang
                    </h3>
                    <p style="font-size: 12px; color: #64748B; margin: 4px 0 0 0;">
                        Đo lường chính xác tỷ lệ khách cuộn tới từng Section, thời gian dừng lại đọc (Dwell Time) và điểm rơi (Drop-off point) để tối ưu trang.
                    </p>
                </div>
                <div style="background: #F8FAFC; border: 1px solid #E2E8F0; padding: 8px 14px; border-radius: 10px; font-size: 12px; color: #475569;">
                    Tổng Sections theo dõi: <strong><?php echo count($sections); ?> phần</strong>
                </div>
            </div>

            <!-- Sections Table -->
            <div style="overflow-x: auto;">
                <table class="wp-list-table widefat striped" style="border: 1px solid #E2E8F0; border-radius: 8px; overflow: hidden;">
                    <thead>
                        <tr style="background: #0F172A; color: #fff;">
                            <th style="color: #fff; font-weight: 700; width: 40px; text-align: center;">#</th>
                            <th style="color: #fff; font-weight: 700;">Tên Phần / Section</th>
                            <th style="color: #fff; font-weight: 700; width: 110px; text-align: right;">Lượt Xem</th>
                            <th style="color: #fff; font-weight: 700; width: 120px; text-align: right;">Số Khách Xem</th>
                            <th style="color: #fff; font-weight: 700; width: 220px;">Tỷ Lệ Tiếp Cận (% Reach)</th>
                            <th style="color: #fff; font-weight: 700; width: 140px; text-align: right;">Thời Gian TB</th>
                            <th style="color: #fff; font-weight: 700; min-width: 250px;">Đánh Giá & Gợi Ý Tối Ưu (CRO)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $idx = 0;
                        foreach ($sections as $s): 
                            $idx++;
                            $bar_color = ($s['reach_pct'] >= 75) ? '#10B981' : (($s['reach_pct'] >= 45) ? '#F59E0B' : '#EF4444');
                        ?>
                            <tr>
                                <td style="text-align: center; font-weight: 700; color: #64748B;">
                                    <?php echo sprintf('%02d', $idx); ?>
                                </td>
                                <td>
                                    <div style="font-weight: 800; font-size: 13px; color: #0F172A; display: flex; align-items: center; gap: 6px;">
                                        <span class="dashicons <?php echo esc_attr($s['icon']); ?>" style="color: #B31217; font-size: 16px;"></span>
                                        <?php echo esc_html($s['name']); ?>
                                    </div>
                                    <div style="font-size: 11px; color: #64748B; margin-top: 2px;">
                                        <code>#<?php echo esc_html($s['id']); ?></code> · <?php echo esc_html($s['desc']); ?>
                                    </div>
                                </td>
                                <td style="text-align: right; font-weight: 800; font-size: 13px; color: #0F172A;">
                                    <?php echo number_format_i18n($s['views']); ?>
                                </td>
                                <td style="text-align: right; font-weight: 700; font-size: 13px; color: #334155;">
                                    <?php echo number_format_i18n($s['unique_sessions']); ?>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="flex: 1; background: #E2E8F0; height: 10px; border-radius: 9999px; overflow: hidden;">
                                            <div style="width: <?php echo $s['reach_pct']; ?>%; background: <?php echo $bar_color; ?>; height: 100%; border-radius: 9999px; transition: width 0.3s;"></div>
                                        </div>
                                        <span style="font-size: 12px; font-weight: 800; color: <?php echo $bar_color; ?>; min-width: 45px;">
                                            <?php echo $s['reach_pct']; ?>%
                                        </span>
                                    </div>
                                    <?php if ($s['drop_off'] > 0 && $idx > 1): ?>
                                        <span style="font-size: 10px; color: #DC2626; font-weight: 600;">
                                            ↓ Giảm <?php echo $s['drop_off']; ?>% so với phần trên
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td style="text-align: right;">
                                    <span style="display: inline-block; padding: 2px 8px; border-radius: 6px; background: #F1F5F9; font-weight: 800; font-size: 12px; color: #0F172A; font-family: monospace;">
                                        <?php echo $s['dwell_time']; ?>s
                                    </span>
                                </td>
                                <td>
                                    <div style="font-size: 11px; line-height: 1.4; color: #334155; font-weight: 500;">
                                        <?php echo esc_html($s['insight']); ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 4. TWO COLUMNS: TOP USER BEHAVIORS & DEVICE / TRAFFIC SOURCES -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(420px, 1fr)); gap: 24px; margin-bottom: 24px;">
            
            <!-- 4.1 TOP USER BEHAVIORS & CTA CLICKS -->
            <div style="background: #fff; border-radius: 14px; padding: 24px; border: 1px solid #E2E8F0; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                    <div>
                        <h3 style="font-size: 16px; font-weight: 800; color: #0F172A; margin: 0;">
                            Hành Vi & Tương Tác Cụ Thể (CTA Ranking)
                        </h3>
                        <p style="font-size: 12px; color: #64748B; margin: 4px 0 0 0;">
                            Các nút bấm, cuộc gọi, chat Zalo và thao tác được khách thực hiện nhiều nhất
                        </p>
                    </div>
                </div>

                <?php if (!empty($behaviors)): ?>
                    <table class="wp-list-table widefat striped" style="border: 1px solid #E2E8F0; border-radius: 8px;">
                        <thead>
                            <tr style="background: #F8FAFC;">
                                <th style="font-weight: 700;">Hành Động / Nút Bấm</th>
                                <th style="font-weight: 700; width: 100px; text-align: center;">Loại</th>
                                <th style="font-weight: 700; width: 80px; text-align: right;">Lượt Bấm</th>
                                <th style="font-weight: 700; width: 80px; text-align: right;">Số Khách</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($behaviors as $b): 
                                $badge_style = 'background: #EFF6FF; color: #1D4ED8;';
                                $type_label = 'Nút CTA';
                                if ($b['event_type'] === 'tab_switch') {
                                    $badge_style = 'background: #FEF3C7; color: #B45309;';
                                    $type_label = 'Đổi Tab';
                                } elseif ($b['event_type'] === 'lightbox_open') {
                                    $badge_style = 'background: #F3E8FF; color: #7E22CE;';
                                    $type_label = 'Xem ảnh';
                                } elseif ($b['event_type'] === 'form_submit') {
                                    $badge_style = 'background: #DCFCE7; color: #15803D; font-weight: bold;';
                                    $type_label = 'Gửi Form';
                                } elseif ($b['event_type'] === 'faq_expand') {
                                    $badge_style = 'background: #F1F5F9; color: #475569;';
                                    $type_label = 'Xem FAQ';
                                }
                            ?>
                                <tr>
                                    <td>
                                        <div style="font-weight: 700; font-size: 12px; color: #0F172A;">
                                            <?php echo esc_html($b['target_label']); ?>
                                        </div>
                                        <div style="font-size: 10px; color: #94A3B8; font-family: monospace;">
                                            ID: <?php echo esc_html($b['target_id']); ?>
                                        </div>
                                    </td>
                                    <td style="text-align: center;">
                                        <span style="display: inline-block; padding: 2px 7px; border-radius: 9999px; font-size: 10px; font-weight: 700; <?php echo $badge_style; ?>">
                                            <?php echo $type_label; ?>
                                        </span>
                                    </td>
                                    <td style="text-align: right; font-weight: 800; font-size: 13px; color: #B31217;">
                                        <?php echo number_format_i18n($b['click_count']); ?>
                                    </td>
                                    <td style="text-align: right; font-weight: 600; font-size: 12px; color: #475569;">
                                        <?php echo number_format_i18n($b['unique_users']); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div style="padding: 30px; text-align: center; color: #94A3B8; background: #F8FAFC; border-radius: 8px;">
                        Chưa có dữ liệu hành vi trong khoảng thời gian này.
                    </div>
                <?php endif; ?>
            </div>

            <!-- 4.2 DEVICES & TRAFFIC SOURCES BREAKDOWN -->
            <div style="display: flex; flex-direction: column; gap: 24px;">
                
                <!-- Devices -->
                <div style="background: #fff; border-radius: 14px; padding: 20px; border: 1px solid #E2E8F0; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                    <h3 style="font-size: 15px; font-weight: 800; color: #0F172A; margin: 0 0 14px 0;">
                        Cơ Cấu Thiết Bị Truy Cập
                    </h3>
                    <?php 
                    $total_dev = array_sum(array_column($devices, 'count'));
                    ?>
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <?php foreach ($devices as $dev): 
                            $pct = ($total_dev > 0) ? round(($dev['count'] / $total_dev) * 100, 1) : 0;
                            $icon = ($dev['device'] === 'mobile') ? 'dashicons-smartphone' : (($dev['device'] === 'tablet') ? 'dashicons-tablet' : 'dashicons-desktop');
                            $dev_name = ($dev['device'] === 'mobile') ? 'Điện thoại di động (Mobile)' : (($dev['device'] === 'tablet') ? 'Máy tính bảng (Tablet)' : 'Máy tính bàn / Laptop');
                        ?>
                            <div>
                                <div style="display: flex; justify-content: space-between; font-size: 12px; font-weight: 600; margin-bottom: 4px;">
                                    <span style="display: flex; align-items: center; gap: 6px; color: #0F172A;">
                                        <span class="dashicons <?php echo $icon; ?>" style="font-size: 16px; color: #64748B;"></span>
                                        <?php echo $dev_name; ?>
                                    </span>
                                    <span style="color: #475569;"><strong><?php echo $dev['count']; ?></strong> (<?php echo $pct; ?>%)</span>
                                </div>
                                <div style="background: #F1F5F9; height: 8px; border-radius: 9999px; overflow: hidden;">
                                    <div style="width: <?php echo $pct; ?>%; height: 100%; background: #3B82F6; border-radius: 9999px;"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Traffic Sources -->
                <div style="background: #fff; border-radius: 14px; padding: 20px; border: 1px solid #E2E8F0; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                    <h3 style="font-size: 15px; font-weight: 800; color: #0F172A; margin: 0 0 14px 0;">
                        Nguồn Lưu Lượng (Traffic & Chiến Dịch Ads)
                    </h3>
                    <?php if (!empty($sources)): ?>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <?php foreach ($sources as $src): ?>
                                <div style="display: flex; justify-content: space-between; align-items: center; padding: 8px 12px; background: #F8FAFC; border-radius: 8px; border: 1px solid #E2E8F0;">
                                    <span style="font-size: 12px; font-weight: 700; color: #0F172A;">
                                        <?php echo esc_html($src['source_name']); ?>
                                    </span>
                                    <span style="font-size: 12px; color: #475569;">
                                        <strong><?php echo $src['count']; ?></strong> lượt · <strong style="color: #16A34A;"><?php echo $src['conversions']; ?></strong> C/Đổi
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div style="font-size: 12px; color: #94A3B8; text-align: center; padding: 15px;">Chưa có dữ liệu nguồn</div>
                    <?php endif; ?>
                </div>

            </div>

        </div>

        <!-- 5. REAL-TIME RECENT VISITOR JOURNEYS FEED -->
        <div style="background: #fff; border-radius: 14px; padding: 24px; border: 1px solid #E2E8F0; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                <div>
                    <h3 style="font-size: 16px; font-weight: 800; color: #0F172A; margin: 0;">
                        Nhật Ký Hành Trình Khách Hàng Gần Nhất (Visitor Journeys)
                    </h3>
                    <p style="font-size: 12px; color: #64748B; margin: 4px 0 0 0;">
                        Xem trực tiếp từng khách vào trang: họ dùng thiết bị gì, đến từ đâu, đã cuộn xem những phần nào và bấm những nút gì
                    </p>
                </div>
            </div>

            <?php if (!empty($recents)): ?>
                <div style="display: flex; flex-direction: column; gap: 14px;">
                    <?php foreach ($recents as $sess): 
                        $time_ago = human_time_diff(strtotime($sess['created_at']), current_time('timestamp')) . ' trước';
                        $ip_masked = preg_replace('/\.\d+$/', '.***', $sess['ip_address']);
                    ?>
                        <div style="border: 1px solid #E2E8F0; border-radius: 10px; padding: 14px 18px; background: <?php echo $sess['has_converted'] ? '#F0FDF4' : '#F8FAFC'; ?>;">
                            
                            <!-- Session Meta Bar -->
                            <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 8px; border-bottom: 1px solid rgba(0,0,0,0.06); padding-bottom: 8px; margin-bottom: 10px;">
                                <div style="display: flex; align-items: center; gap: 10px; font-size: 12px;">
                                    <span style="font-weight: 800; color: #0F172A;">
                                        👤 Khách #<?php echo substr($sess['session_id'], 0, 10); ?>...
                                    </span>
                                    <span style="background: #E2E8F0; padding: 1px 7px; border-radius: 4px; font-size: 11px; font-weight: 600; text-transform: uppercase;">
                                        <?php echo esc_html($sess['device']); ?>
                                    </span>
                                    <span style="color: #64748B; font-size: 11px;">
                                        IP: <?php echo esc_html($ip_masked); ?>
                                    </span>
                                    <span style="color: #64748B; font-size: 11px;">
                                        Nguồn: <strong><?php echo esc_html($sess['utm_source'] ?: ($sess['referrer'] ? 'Referrer' : 'Trực tiếp')); ?></strong>
                                    </span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 10px; font-size: 12px;">
                                    <span style="color: #64748B;"><?php echo $time_ago; ?></span>
                                    <?php if ($sess['has_converted']): ?>
                                        <span style="background: #16A34A; color: #fff; font-size: 11px; font-weight: 800; padding: 2px 8px; border-radius: 9999px;">
                                            ✓ Đã tương tác chuyển đổi
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Events Timeline for this session -->
                            <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 6px;">
                                <span style="font-size: 11px; font-weight: 700; color: #64748B; margin-right: 4px;">Hành trình:</span>
                                
                                <span style="display: inline-flex; align-items: center; gap: 4px; padding: 3px 8px; border-radius: 6px; background: #E0E7FF; color: #3730A3; font-size: 11px; font-weight: 600;">
                                    Vào trang
                                </span>

                                <?php if (!empty($sess['events'])): ?>
                                    <?php foreach ($sess['events'] as $e): 
                                        $bg = ($e['event_type'] === 'section_view') ? '#F1F5F9' : (($e['event_type'] === 'cta_click') ? '#FEE2E2' : '#FEF3C7');
                                        $color = ($e['event_type'] === 'section_view') ? '#334155' : (($e['event_type'] === 'cta_click') ? '#991B1B' : '#92400E');
                                    ?>
                                        <span style="color: #94A3B8; font-size: 10px;">&rarr;</span>
                                        <span style="display: inline-flex; align-items: center; gap: 4px; padding: 3px 8px; border-radius: 6px; background: <?php echo $bg; ?>; color: <?php echo $color; ?>; font-size: 11px; font-weight: 600;" title="<?php echo esc_attr($e['target_label'] . ($e['dwell_time'] ? ' (' . $e['dwell_time'] . 's)' : '')); ?>">
                                            <?php echo esc_html($e['target_label']); ?>
                                            <?php if ($e['dwell_time'] > 0): ?>
                                                <small style="opacity: 0.8;">(<?php echo $e['dwell_time']; ?>s)</small>
                                            <?php endif; ?>
                                        </span>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <span style="color: #94A3B8; font-size: 11px; font-style: italic;">Chưa phát sinh thêm sự kiện cuộn</span>
                                <?php endif; ?>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div style="padding: 30px; text-align: center; color: #94A3B8; background: #F8FAFC; border-radius: 8px;">
                    Chưa có nhật ký truy cập nào được ghi nhận.
                </div>
            <?php endif; ?>
        </div>

    </div>

    <!-- Admin Helper JS for Data Actions -->
    <script>
    function hacoledClearTestData(scope) {
        if (!confirm('Bạn có chắc chắn muốn xóa dữ liệu thử nghiệm này? Hành động không thể hoàn tác!')) {
            return;
        }
        const fd = new FormData();
        fd.append('action', 'hacoled_clear_analytics_data');
        fd.append('scope', scope);
        fd.append('nonce', '<?php echo wp_create_nonce('hacoled_clear_analytics_nonce'); ?>');

        fetch(ajaxurl, {
            method: 'POST',
            body: fd
        })
        .then(r => r.json())
        .then(res => {
            alert(res.data ? res.data.message : 'Đã xóa thành công!');
            window.location.reload();
        })
        .catch(e => {
            alert('Có lỗi xảy ra: ' + e);
        });
    }
    </script>
    <?php
}
