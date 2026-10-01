<?php
namespace HacoLED\Theme\Admin;

defined('ABSPATH') || exit;

/**
 * HacoLED Website Health & Page Speed Diagnostic Manager.
 * Enables in-depth server-side and client-side testing of individual pages,
 * measuring TTFB, response times, HTTP errors, cache headers, and HTML health directly on the host.
 */
class SiteHealthSpeedManager {
    const MENU_SLUG = 'hacoled-speed-diagnostic';
    const NONCE_ACTION = 'hacoled_speed_diagnostic_nonce';

    public function register() {
        add_action('admin_menu', [$this, 'addMenuPages']);
        add_action('admin_enqueue_scripts', [$this, 'enqueueAssets']);
        add_action('wp_ajax_hacoled_test_page_speed', [$this, 'handleAjaxTestPageSpeed']);
        add_action('wp_ajax_hacoled_run_pagespeed_api', [$this, 'handleAjaxPageSpeedApi']);
        add_action('wp_ajax_hacoled_clear_all_caches', [$this, 'handleAjaxClearAllCaches']);
    }

    public function addMenuPages() {
        // Top-level menu for immediate visibility
        add_menu_page(
            __('Kiểm tra Tốc độ & Tình trạng Web', 'hacoled'),
            __('⚡ Tốc độ & Sức khỏe', 'hacoled'),
            'edit_theme_options',
            self::MENU_SLUG,
            [$this, 'renderPage'],
            'dashicons-performance',
            59
        );

        // Also make it accessible under Appearance (Giao diện)
        add_theme_page(
            __('Kiểm tra Tốc độ & Tình trạng Web', 'hacoled'),
            __('⚡ Kiểm tra Tải Trang', 'hacoled'),
            'edit_theme_options',
            self::MENU_SLUG,
            [$this, 'renderPage']
        );
    }

    public function enqueueAssets($hook) {
        if (strpos($hook, self::MENU_SLUG) === false) {
            return;
        }

        $css_file = get_template_directory() . '/assets/admin/speed-diagnostic.css';
        $js_file  = get_template_directory() . '/assets/admin/speed-diagnostic.js';

        $css_version = file_exists($css_file) ? filemtime($css_file) : '1.0.0';
        $js_version  = file_exists($js_file) ? filemtime($js_file) : '1.0.0';

        wp_enqueue_style(
            'hacoled-speed-diagnostic',
            get_template_directory_uri() . '/assets/admin/speed-diagnostic.css',
            [],
            $css_version
        );

        wp_enqueue_script(
            'hacoled-speed-diagnostic',
            get_template_directory_uri() . '/assets/admin/speed-diagnostic.js',
            ['jquery'],
            $js_version,
            true
        );

        wp_localize_script('hacoled-speed-diagnostic', 'hacoledSpeedDiag', [
            'ajaxUrl'   => admin_url('admin-ajax.php'),
            'nonce'     => wp_create_nonce(self::NONCE_ACTION),
            'homeUrl'   => home_url('/'),
            'siteDomain'=> wp_parse_url(home_url(), PHP_URL_HOST),
            'routes'    => $this->getAllTestRoutes(),
        ]);
    }

    /**
     * Retrieve all important routes of the site for testing.
     */
    public function getAllTestRoutes() {
        $routes = [];

        // 1. Homepage
        $routes[] = [
            'group' => 'Trang chính',
            'title' => 'Trang chủ (Homepage)',
            'url'   => home_url('/'),
            'type'  => 'home',
        ];

        // 2. Managed pages from app/Config/pages.php
        $managed_pages_config = get_template_directory() . '/app/Config/pages.php';
        if (file_exists($managed_pages_config)) {
            $pages_def = include $managed_pages_config;
            if (is_array($pages_def)) {
                foreach ($pages_def as $key => $item) {
                    if (!empty($item['front_page'])) {
                        continue;
                    }
                    $slug = $item['slug'] ?? $key;
                    $routes[] = [
                        'group' => 'Trang tĩnh',
                        'title' => $item['title'] ?? ucfirst($key),
                        'url'   => home_url('/' . ltrim($slug, '/') . '/'),
                        'type'  => 'page',
                    ];
                }
            }
        }

        // 3. Product Categories (WooCommerce)
        if (taxonomy_exists('product_cat')) {
            $categories = get_terms([
                'taxonomy'   => 'product_cat',
                'hide_empty' => false,
                'number'     => 10,
            ]);
            if (!is_wp_error($categories) && !empty($categories)) {
                foreach ($categories as $cat) {
                    $link = get_term_link($cat);
                    if (!is_wp_error($link)) {
                        $routes[] = [
                            'group' => 'Danh mục sản phẩm',
                            'title' => 'Danh mục: ' . $cat->name,
                            'url'   => $link,
                            'type'  => 'category',
                        ];
                    }
                }
            }
        }

        // 4. Sample Products
        if (post_type_exists('product')) {
            $products = get_posts([
                'post_type'      => 'product',
                'post_status'    => 'publish',
                'posts_per_page' => 5,
            ]);
            foreach ($products as $prod) {
                $routes[] = [
                    'group' => 'Sản phẩm chi tiết',
                    'title' => 'Sản phẩm: ' . $prod->post_title,
                    'url'   => get_permalink($prod->ID),
                    'type'  => 'product',
                ];
            }
        }

        // 5. Sample Blog Posts
        $posts = get_posts([
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 4,
        ]);
        foreach ($posts as $post_item) {
            $routes[] = [
                'group' => 'Bài viết tin tức',
                'title' => 'Bài viết: ' . $post_item->post_title,
                'url'   => get_permalink($post_item->ID),
                'type'  => 'post',
            ];
        }

        return $routes;
    }

    /**
     * AJAX handler: Test page speed & diagnostics via server cURL
     */
    public function handleAjaxTestPageSpeed() {
        check_ajax_referer(self::NONCE_ACTION, 'nonce');

        if (!current_user_can('edit_theme_options')) {
            wp_send_json_error(['message' => 'Bạn không có quyền thực hiện thao tác này.']);
        }

        $target_url = esc_url_raw(wp_unslash($_POST['target_url'] ?? ''));
        if (empty($target_url)) {
            wp_send_json_error(['message' => 'URL không hợp lệ.']);
        }

        $bypass_cache = !empty($_POST['bypass_cache']);
        $device_mode  = sanitize_key($_POST['device_mode'] ?? 'desktop');

        $result = $this->measureUrlPerformance($target_url, $bypass_cache, $device_mode);

        wp_send_json_success($result);
    }

    /**
     * High-precision cURL diagnostic function directly from server.
     */
    protected function measureUrlPerformance($url, $bypass_cache = false, $device_mode = 'desktop') {
        $ch = curl_init();

        $headers = [
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
            'Accept-Language: vi-VN,vi;q=0.9,en-US;q=0.8,en;q=0.7',
            'Connection: keep-alive',
        ];

        if ($bypass_cache) {
            $headers[] = 'Cache-Control: no-cache';
            $headers[] = 'Pragma: no-cache';
        }

        $user_agent = ($device_mode === 'mobile')
            ? 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.5 Mobile/15E148 Safari/604.1'
            : 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36';

        $url_host = parse_url($url, PHP_URL_HOST);
        $site_host = parse_url(home_url(), PHP_URL_HOST);
        $server_ip = !empty($_SERVER['SERVER_ADDR']) && filter_var($_SERVER['SERVER_ADDR'], FILTER_VALIDATE_IP)
            ? $_SERVER['SERVER_ADDR']
            : '103.77.162.37';

        $resolve_list = [];
        if ($url_host && ($url_host === $site_host || strpos($url_host, 'hacoled.com') !== false)) {
            // Force cURL to connect directly to origin server IP.
            // Eliminates the 700ms - 900ms international round-trip ping to QUIC.cloud edge POP in Europe (Helsinki).
            $resolve_list = [
                "hacoled.com:443:{$server_ip}",
                "hacoled.com:80:{$server_ip}",
                "www.hacoled.com:443:{$server_ip}",
                "www.hacoled.com:80:{$server_ip}",
            ];
            if ($url_host !== 'hacoled.com' && $url_host !== 'www.hacoled.com') {
                $resolve_list[] = "{$url_host}:443:{$server_ip}";
                $resolve_list[] = "{$url_host}:80:{$server_ip}";
            }
        }

        // Pre-warm cache if testing cached performance to ensure measurement reflects warm cache
        if (!$bypass_cache) {
            $warm_ch = curl_init();
            curl_setopt($warm_ch, CURLOPT_URL, $url);
            curl_setopt($warm_ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($warm_ch, CURLOPT_TIMEOUT, 8);
            curl_setopt($warm_ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($warm_ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($warm_ch, CURLOPT_USERAGENT, $user_agent);
            if (!empty($resolve_list)) {
                curl_setopt($warm_ch, CURLOPT_RESOLVE, $resolve_list);
            }
            @curl_exec($warm_ch);
            @curl_close($warm_ch);
            usleep(100000); // 100ms pause for storage sync
        }

        $response_headers = [];

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_ENCODING, ''); // Accepts gzip/deflate/br
        if (!empty($resolve_list)) {
            curl_setopt($ch, CURLOPT_RESOLVE, $resolve_list);
        }

        curl_setopt($ch, CURLOPT_HEADERFUNCTION, function ($curl, $header_line) use (&$response_headers) {
            $len = strlen($header_line);
            $parts = explode(':', $header_line, 2);
            if (count($parts) === 2) {
                $name = strtolower(trim($parts[0]));
                $value = trim($parts[1]);
                $response_headers[$name] = $value;
            }
            return $len;
        });

        $start_time = microtime(true);
        $body = curl_exec($ch);
        $exec_duration = (microtime(true) - $start_time) * 1000;

        $curl_error = curl_error($ch);
        $curl_errno = curl_errno($ch);

        $info = curl_getinfo($ch);
        curl_close($ch);

        if ($curl_errno !== 0) {
            return [
                'success'    => false,
                'url'        => $url,
                'error'      => $curl_error ?: 'cURL Error (' . $curl_errno . ')',
                'http_code'  => 0,
            ];
        }

        $http_code = (int) ($info['http_code'] ?? 0);
        $namelookup_time = round(($info['namelookup_time'] ?? 0) * 1000, 1);
        $connect_time    = round(($info['connect_time'] ?? 0) * 1000, 1);
        $appconnect_time = round(($info['appconnect_time'] ?? 0) * 1000, 1);
        $ttfb            = round(($info['starttransfer_time'] ?? 0) * 1000, 1);
        $total_time      = round(($info['total_time'] ?? 0) * 1000, 1);
        $size_download   = round(($info['size_download'] ?? 0) / 1024, 2); // KB
        $speed_download  = round((($info['speed_download'] ?? 0) / 1024), 2); // KB/s

        // Extract key caching headers
        $cache_control = $response_headers['cache-control'] ?? 'Không thiết lập';
        $litespeed_cache = $response_headers['x-litespeed-cache'] ?? $response_headers['x-qc-cache'] ?? $response_headers['x-hacoled-page-cache'] ?? null;
        $content_encoding = $response_headers['content-encoding'] ?? 'Không nén (uncompressed)';
        $server_header = $response_headers['server'] ?? ($info['primary_port'] ?? 'Unknown');
        $content_type = $response_headers['content-type'] ?? '';

        // Analyze HTML contents for issues
        $html_analysis = $this->analyzeHtmlQuality($body ?: '');

        // Grade TTFB
        $ttfb_grade = 'good'; // green
        if ($ttfb > 1200) {
            $ttfb_grade = 'poor'; // red
        } elseif ($ttfb > 500) {
            $ttfb_grade = 'needs-improvement'; // yellow
        }

        // Grade Total Time
        $total_grade = 'good';
        if ($total_time > 3000) {
            $total_grade = 'poor';
        } elseif ($total_time > 1500) {
            $total_grade = 'needs-improvement';
        }

        return [
            'success'          => true,
            'url'              => $url,
            'http_code'        => $http_code,
            'http_code_label'  => $http_code === 200 ? '200 OK' : $http_code,
            'effective_url'    => $info['url'] ?? $url,
            'namelookup_time'  => $namelookup_time,
            'connect_time'     => $connect_time,
            'appconnect_time'  => $appconnect_time,
            'ttfb'             => $ttfb,
            'ttfb_grade'       => $ttfb_grade,
            'total_time'       => $total_time,
            'total_grade'      => $total_grade,
            'size_download_kb' => $size_download,
            'speed_download_kb'=> $speed_download,
            'server_header'    => $server_header,
            'cache_control'    => $cache_control,
            'cache_status'     => $litespeed_cache ?: 'Bỏ qua hoặc không có header',
            'content_encoding' => $content_encoding,
            'content_type'     => $content_type,
            'resolved_ip'      => !empty($resolve_list) ? $server_ip : null,
            'qc_pop'           => $response_headers['x-qc-pop'] ?? null,
            'html_analysis'    => $html_analysis,
            'tested_at'        => current_time('H:i:s d/m/Y'),
        ];
    }

    /**
     * Inspect HTML content for health, broken elements, large images, and SEO tags.
     */
    protected function analyzeHtmlQuality($html) {
        if (empty($html)) {
            return [
                'has_fatal_error' => false,
                'title'           => 'Trang rỗng',
                'img_count'       => 0,
                'img_missing_alt' => 0,
                'heavy_pngs'      => [],
                'script_count'    => 0,
                'css_count'       => 0,
                'has_meta_desc'   => false,
            ];
        }

        $has_fatal_error = false;
        $fatal_message = '';
        if (stripos($html, 'Fatal error:') !== false || stripos($html, 'Parse error:') !== false) {
            $has_fatal_error = true;
            preg_match('/(Fatal error|Parse error):[^\n<]+/i', $html, $m);
            $fatal_message = $m[0] ?? 'Phát hiện lỗi Fatal error trong mã nguồn!';
        }

        // Title
        preg_match('/<title[^>]*>(.*?)<\/title>/is', $html, $title_match);
        $title = !empty($title_match[1]) ? trim(wp_strip_all_tags($title_match[1])) : 'Thiếu thẻ <title>';

        // Meta Description
        $has_meta_desc = (bool) preg_match('/<meta\s+name=["\']description["\']\s+content=["\']([^"\']+)["\']/i', $html);

        // Images inspection
        preg_match_all('/<img\s+[^>]*>/i', $html, $img_tags);
        $all_imgs = $img_tags[0] ?? [];
        $img_count = count($all_imgs);
        $img_missing_alt = 0;
        $heavy_pngs = [];

        foreach ($all_imgs as $img_tag) {
            // Check alt
            if (!preg_match('/alt=["\'][^"\']+["\']/i', $img_tag)) {
                $img_missing_alt++;
            }
            // Check for large uncompressed PNGs
            if (preg_match('/src=["\']([^"\']+\.(png|PNG))["\']/i', $img_tag, $src_m)) {
                $src = $src_m[1];
                if (stripos($src, 'hero-led') !== false || stripos($src, 'space-') !== false || stripos($src, 'banner') !== false) {
                    $heavy_pngs[] = basename(parse_url($src, PHP_URL_PATH));
                }
            }
        }

        // Script & Stylesheet count
        preg_match_all('/<script\b/i', $html, $script_matches);
        $script_count = count($script_matches[0] ?? []);

        preg_match_all('/<link\s+[^>]*rel=["\']stylesheet["\']/i', $html, $css_matches);
        $css_count = count($css_matches[0] ?? []);

        return [
            'has_fatal_error' => $has_fatal_error,
            'fatal_message'   => $fatal_message,
            'title'           => $title,
            'has_meta_desc'   => $has_meta_desc,
            'img_count'       => $img_count,
            'img_missing_alt' => $img_missing_alt,
            'heavy_pngs'      => array_unique($heavy_pngs),
            'script_count'    => $script_count,
            'css_count'       => $css_count,
        ];
    }

    /**
     * AJAX handler: Query Google PageSpeed Insights live API
     */
    public function handleAjaxPageSpeedApi() {
        check_ajax_referer(self::NONCE_ACTION, 'nonce');

        if (!current_user_can('edit_theme_options')) {
            wp_send_json_error(['message' => 'Bạn không có quyền thực hiện thao tác này.']);
        }

        $target_url = esc_url_raw(wp_unslash($_POST['target_url'] ?? ''));
        $strategy   = sanitize_key($_POST['strategy'] ?? 'desktop');

        if (empty($target_url)) {
            wp_send_json_error(['message' => 'URL không hợp lệ.']);
        }

        // Google PageSpeed Insights public endpoint
        $api_endpoint = add_query_arg([
            'url'      => $target_url,
            'strategy' => $strategy,
            'category' => ['performance', 'accessibility', 'best-practices', 'seo'],
        ], 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed');

        $response = wp_remote_get($api_endpoint, [
            'timeout' => 60,
            'sslverify' => false,
        ]);

        if (is_wp_error($response)) {
            wp_send_json_error(['message' => 'Không thể kết nối đến Google PageSpeed API: ' . $response->get_error_message()]);
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body_raw    = wp_remote_retrieve_body($response);
        $data        = json_decode($body_raw, true);

        if ($status_code !== 200 || empty($data['lighthouseResult'])) {
            $err_msg = $data['error']['message'] ?? ('Google API trả về mã ' . $status_code);
            wp_send_json_error(['message' => $err_msg]);
        }

        $lh = $data['lighthouseResult'];
        $categories = $lh['categories'] ?? [];
        $audits     = $lh['audits'] ?? [];

        $scores = [
            'performance'   => round(($categories['performance']['score'] ?? 0) * 100),
            'accessibility' => round(($categories['accessibility']['score'] ?? 0) * 100),
            'best_practices'=> round(($categories['best-practices']['score'] ?? 0) * 100),
            'seo'           => round(($categories['seo']['score'] ?? 0) * 100),
        ];

        $metrics = [
            'fcp'  => $audits['first-contentful-paint']['displayValue'] ?? 'N/A',
            'lcp'  => $audits['largest-contentful-paint']['displayValue'] ?? 'N/A',
            'cls'  => $audits['cumulative-layout-shift']['displayValue'] ?? 'N/A',
            'tbt'  => $audits['total-blocking-time']['displayValue'] ?? 'N/A',
            'si'   => $audits['speed-index']['displayValue'] ?? 'N/A',
            'ttfb' => $audits['server-response-time']['displayValue'] ?? 'N/A',
        ];

        wp_send_json_success([
            'url'        => $target_url,
            'strategy'   => $strategy,
            'scores'     => $scores,
            'metrics'    => $metrics,
            'report_url' => 'https://pagespeed.web.dev/analysis?url=' . rawurlencode($target_url) . '&form_factor=' . $strategy,
            'fetched_at' => current_time('H:i:s d/m/Y'),
        ]);
    }

    /**
     * AJAX handler: Clear all caches (Transients, Theme page cache, LiteSpeed, OPcache)
     */
    public function handleAjaxClearAllCaches() {
        check_ajax_referer(self::NONCE_ACTION, 'nonce');

        if (!current_user_can('edit_theme_options')) {
            wp_send_json_error(['message' => 'Bạn không có quyền thực hiện thao tác này.']);
        }

        // 1. WordPress Object Cache
        wp_cache_flush();

        // 2. Theme custom page cache
        if (function_exists('hacoled_page_cache_flush')) {
            hacoled_page_cache_flush();
        }

        // 3. LiteSpeed Cache Purge All Hook
        if (has_action('litespeed_purge_all')) {
            do_action('litespeed_purge_all');
        }

        // 4. PHP OPcache reset if allowed
        if (function_exists('opcache_reset')) {
            @opcache_reset();
        }

        wp_send_json_success([
            'message' => 'Đã làm mới và xóa toàn bộ bộ nhớ đệm (Object Cache, Theme Page Cache, LiteSpeed Cache) thành công!',
            'time'    => current_time('H:i:s d/m/Y'),
        ]);
    }

    /**
     * Render the Diagnostic Admin Dashboard
     */
    public function renderPage() {
        if (!current_user_can('edit_theme_options')) {
            wp_die(esc_html__('Bạn không có quyền truy cập trang này.', 'hacoled'));
        }

        $routes = $this->getAllTestRoutes();
        $server_info = $this->getServerEnvironmentInfo();
        ?>
        <div class="wrap hacoled-diag-wrap">
            <!-- Header Banner -->
            <div class="hacoled-diag-header">
                <div class="hacoled-diag-header-content">
                    <div class="hacoled-badge-brand">HACOLED DIAGNOSTIC TOOLKIT</div>
                    <h1>⚡ Kiểm Tra Tốc Độ & Tình Trạng Website Trên Host</h1>
                    <p class="hacoled-diag-lead">
                        Công cụ đo lường thực tế từ chính máy chủ Host và trình duyệt: phân tích chỉ số phản hồi (TTFB), thời gian tải trang, trạng thái bộ nhớ đệm LiteSpeed Cache, phát hiện lỗi ẩn và liên kết với Google PageSpeed Insights.
                    </p>
                </div>
                <div class="hacoled-diag-header-actions">
                    <button type="button" id="btn-clear-caches" class="button button-secondary hacoled-btn-action">
                        <span class="dashicons dashicons-trash"></span> Xóa Toàn Bộ Cache
                    </button>
                    <a href="<?php echo esc_url(home_url('/')); ?>" target="_blank" class="button button-primary hacoled-btn-action">
                        <span class="dashicons dashicons-external"></span> Xem Website
                    </a>
                </div>
            </div>

            <!-- Server Quick Stats Bar -->
            <div class="hacoled-server-bar">
                <div class="server-stat-item">
                    <span class="label">Môi trường:</span>
                    <span class="value badge-<?php echo esc_attr($server_info['env_class']); ?>">
                        <?php echo esc_html($server_info['environment']); ?>
                    </span>
                </div>
                <div class="server-stat-item">
                    <span class="label">Tên miền Host:</span>
                    <span class="value font-mono"><?php echo esc_html($server_info['host_domain']); ?></span>
                </div>
                <div class="server-stat-item">
                    <span class="label">PHP Version:</span>
                    <span class="value font-mono"><?php echo esc_html($server_info['php_version']); ?></span>
                </div>
                <div class="server-stat-item">
                    <span class="label">Web Server:</span>
                    <span class="value"><?php echo esc_html($server_info['server_software']); ?></span>
                </div>
                <div class="server-stat-item">
                    <span class="label">LiteSpeed Cache:</span>
                    <span class="value badge-<?php echo $server_info['litespeed_active'] ? 'green' : 'amber'; ?>">
                        <?php echo $server_info['litespeed_active'] ? 'Đang hoạt động' : 'Chưa bật plugin'; ?>
                    </span>
                </div>
                <div class="server-stat-item">
                    <span class="label">Memory Limit:</span>
                    <span class="value"><?php echo esc_html($server_info['memory_limit']); ?></span>
                </div>
            </div>

            <!-- Navigation Tabs -->
            <div class="hacoled-diag-tabs">
                <a href="#tab-pages" class="tab-link active" data-tab="tab-pages">
                    <span class="dashicons dashicons-dashboard"></span> Kiểm Tra Từng Trang Giao Diện (<?php echo count($routes); ?>)
                </a>
                <a href="#tab-pagespeed" class="tab-link" data-tab="tab-pagespeed">
                    <span class="dashicons dashicons-google"></span> Google PageSpeed Insights Trực Tiếp
                </a>
                <a href="#tab-server" class="tab-link" data-tab="tab-server">
                    <span class="dashicons dashicons-admin-generic"></span> Thông Số Kỹ Thuật Server
                </a>
            </div>

            <!-- Tab 1: Page Speed & Error Inspector -->
            <div id="tab-pages" class="hacoled-tab-content active">
                <div class="hacoled-control-panel">
                    <div class="hacoled-control-left">
                        <label for="route-selector" class="control-label">Chọn trang cần kiểm tra:</label>
                        <select id="route-selector" class="hacoled-select">
                            <option value="">-- Chọn từ danh sách trang có sẵn --</option>
                            <?php 
                            $current_group = '';
                            foreach ($routes as $route): 
                                if ($current_group !== $route['group']):
                                    if ($current_group !== '') echo '</optgroup>';
                                    $current_group = $route['group'];
                                    echo '<optgroup label="' . esc_attr($current_group) . '">';
                                endif;
                            ?>
                                <option value="<?php echo esc_url($route['url']); ?>">
                                    <?php echo esc_html($route['title']); ?> (<?php echo esc_html(wp_make_link_relative($route['url'])); ?>)
                                </option>
                            <?php endforeach; ?>
                            <?php if ($current_group !== '') echo '</optgroup>'; ?>
                        </select>

                        <div class="custom-url-box">
                            <label for="custom-url-input" class="control-label">Hoặc nhập URL tùy chỉnh:</label>
                            <div class="custom-url-group">
                                <input type="url" id="custom-url-input" class="regular-text" placeholder="https://hacoled.com/...">
                                <button type="button" id="btn-use-custom-url" class="button">Áp dụng</button>
                            </div>
                        </div>
                    </div>

                    <div class="hacoled-control-right">
                        <div class="option-toggles">
                            <label class="toggle-item">
                                <input type="checkbox" id="opt-bypass-cache">
                                <span>Bỏ qua Cache (Test thời gian render thuần PHP)</span>
                            </label>
                            <label class="toggle-item">
                                <input type="radio" name="opt-device" value="desktop" checked>
                                <span>Desktop</span>
                            </label>
                            <label class="toggle-item">
                                <input type="radio" name="opt-device" value="mobile">
                                <span>Mobile</span>
                            </label>
                        </div>
                        <div class="action-buttons-group">
                            <button type="button" id="btn-test-single" class="button button-primary button-hero">
                                <span class="dashicons dashicons-controls-play"></span> Kiểm Tra Trang Này
                            </button>
                            <button type="button" id="btn-test-all" class="button button-secondary button-hero">
                                <span class="dashicons dashicons-update"></span> ⚡ Chạy Test Toàn Bộ (Batch Test)
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Batch Progress Box (Hidden by default) -->
                <div id="batch-progress-container" class="hacoled-progress-card" style="display: none;">
                    <div class="progress-title-row">
                        <span id="batch-progress-status">Đang chạy kiểm tra toàn bộ website...</span>
                        <span id="batch-progress-percentage" class="font-bold">0%</span>
                    </div>
                    <div class="progress-bar-track">
                        <div id="batch-progress-bar" class="progress-bar-fill" style="width: 0%;"></div>
                    </div>
                    <div class="progress-actions">
                        <button type="button" id="btn-stop-batch" class="button button-link-delete">Hủy quá trình test</button>
                    </div>
                </div>

                <!-- Test Results Section -->
                <div class="hacoled-results-section">
                    <div class="results-header-row">
                        <h3>📊 Kết Quả Kiểm Tra Tốc Độ & Trạng Thái Trang</h3>
                        <div class="filter-pills">
                            <button type="button" class="filter-pill active" data-filter="all">Tất cả (<span id="count-all">0</span>)</button>
                            <button type="button" class="filter-pill pill-green" data-filter="fast">Nhanh (< 500ms) (<span id="count-fast">0</span>)</button>
                            <button type="button" class="filter-pill pill-yellow" data-filter="moderate">Trung bình (<span id="count-moderate">0</span>)</button>
                            <button type="button" class="filter-pill pill-red" data-filter="slow">Chậm / Lỗi (<span id="count-slow">0</span>)</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="diagnostic-results-table" class="widefat striped hacoled-table">
                            <thead>
                                <tr>
                                    <th style="width: 35px;">STT</th>
                                    <th>Trang / Đường dẫn</th>
                                    <th style="width: 90px;">Mã HTTP</th>
                                    <th style="width: 110px;">TTFB (Host)</th>
                                    <th style="width: 110px;">Tổng thời gian</th>
                                    <th style="width: 90px;">Dung lượng</th>
                                    <th style="width: 140px;">Bộ nhớ Cache</th>
                                    <th>Tình trạng HTML / Lỗi phát hiện</th>
                                    <th style="width: 110px;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="diagnostic-results-body">
                                <tr class="no-data-row">
                                    <td colspan="9" class="text-center py-8 text-gray-500">
                                        <span class="dashicons dashicons-search large-icon"></span><br>
                                        Chưa có bài test nào được chạy. Hãy chọn 1 trang bấm <strong>"Kiểm Tra Trang Này"</strong> hoặc bấm <strong>"Chạy Test Toàn Bộ"</strong> để bắt đầu.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tab 2: Google PageSpeed Insights API Live -->
            <div id="tab-pagespeed" class="hacoled-tab-content">
                <div class="hacoled-control-panel">
                    <div class="hacoled-control-left" style="max-width: 600px;">
                        <label for="psi-url-selector" class="control-label">Chọn URL kiểm tra với Google PageSpeed Insights:</label>
                        <select id="psi-url-selector" class="hacoled-select">
                            <?php foreach ($routes as $route): ?>
                                <option value="<?php echo esc_url($route['url']); ?>">
                                    <?php echo esc_html($route['title']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="hacoled-control-right">
                        <div class="option-toggles">
                            <label class="toggle-item">
                                <input type="radio" name="psi-device" value="desktop" checked>
                                <span>Desktop</span>
                            </label>
                            <label class="toggle-item">
                                <input type="radio" name="psi-device" value="mobile">
                                <span>Mobile</span>
                            </label>
                        </div>
                        <button type="button" id="btn-run-psi" class="button button-primary button-hero">
                            <span class="dashicons dashicons-google"></span> Chạy Chấm Điểm Google PageSpeed
                        </button>
                    </div>
                </div>

                <div id="psi-loading" class="hacoled-loading-card" style="display: none;">
                    <div class="spinner is-active"></div>
                    <p>Đang kết nối Google Lighthouse API để phân tích URL... Quá trình này thường mất từ 10 - 25 giây.</p>
                </div>

                <div id="psi-result-card" class="hacoled-psi-card" style="display: none;">
                    <div class="psi-card-header">
                        <div>
                            <span class="psi-badge" id="psi-device-label">DESKTOP REPORT</span>
                            <h2 id="psi-tested-url" class="psi-url-title">https://hacoled.com/</h2>
                            <span id="psi-timestamp" class="psi-timestamp">Đo lúc: --:--:--</span>
                        </div>
                        <div>
                            <a id="psi-official-link" href="#" target="_blank" class="button button-secondary">
                                <span class="dashicons dashicons-external"></span> Xem trên web.dev
                            </a>
                        </div>
                    </div>

                    <!-- 4 Lighthouse Score Rings -->
                    <div class="psi-scores-grid">
                        <div class="score-box" id="box-score-perf">
                            <div class="score-circle" id="circle-score-perf">--</div>
                            <span class="score-label">Hiệu suất (Performance)</span>
                        </div>
                        <div class="score-box" id="box-score-a11y">
                            <div class="score-circle" id="circle-score-a11y">--</div>
                            <span class="score-label">Tiếp cận (Accessibility)</span>
                        </div>
                        <div class="score-box" id="box-score-best">
                            <div class="score-circle" id="circle-score-best">--</div>
                            <span class="score-label">Thực hành tốt (Best Practices)</span>
                        </div>
                        <div class="score-box" id="box-score-seo">
                            <div class="score-circle" id="circle-score-seo">--</div>
                            <span class="score-label">Chuẩn SEO</span>
                        </div>
                    </div>

                    <!-- Core Web Vitals Key Metrics -->
                    <div class="psi-metrics-grid">
                        <div class="metric-item">
                            <span class="m-label">First Contentful Paint (FCP)</span>
                            <span class="m-value" id="val-fcp">--</span>
                        </div>
                        <div class="metric-item">
                            <span class="m-label">Largest Contentful Paint (LCP)</span>
                            <span class="m-value" id="val-lcp">--</span>
                        </div>
                        <div class="metric-item">
                            <span class="m-label">Cumulative Layout Shift (CLS)</span>
                            <span class="m-value" id="val-cls">--</span>
                        </div>
                        <div class="metric-item">
                            <span class="m-label">Total Blocking Time (TBT)</span>
                            <span class="m-value" id="val-tbt">--</span>
                        </div>
                        <div class="metric-item">
                            <span class="m-label">Speed Index</span>
                            <span class="m-value" id="val-si">--</span>
                        </div>
                        <div class="metric-item">
                            <span class="m-label">Server Response Time (TTFB)</span>
                            <span class="m-value" id="val-ttfb">--</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab 3: Server & Host Specs -->
            <div id="tab-server" class="hacoled-tab-content">
                <div class="hacoled-specs-grid">
                    <div class="spec-card">
                        <h3>🖥️ Cấu Hình Máy Chủ Host</h3>
                        <table class="widefat striped">
                            <tbody>
                                <tr>
                                    <td><strong>Tên miền cài đặt:</strong></td>
                                    <td><?php echo esc_html(home_url('/')); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Địa chỉ IP Máy Chủ:</strong></td>
                                    <td><?php echo esc_html($_SERVER['SERVER_ADDR'] ?? gethostbyname($_SERVER['HTTP_HOST'] ?? 'localhost')); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Phần mềm Web Server:</strong></td>
                                    <td><?php echo esc_html($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Phiên bản PHP:</strong></td>
                                    <td><?php echo esc_html(PHP_VERSION); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Memory Limit:</strong></td>
                                    <td><?php echo esc_html(ini_get('memory_limit')); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Max Execution Time:</strong></td>
                                    <td><?php echo esc_html(ini_get('max_execution_time')); ?>s</td>
                                </tr>
                                <tr>
                                    <td><strong>Giao thức SSL / HTTPS:</strong></td>
                                    <td><?php echo is_ssl() ? '✅ Đang bật (HTTPS an toàn)' : '⚠️ Chưa bật HTTPS'; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="spec-card">
                        <h3>⚡ Tình Trạng Bộ Nhớ Đệm & Tối Ưu</h3>
                        <table class="widefat striped">
                            <tbody>
                                <tr>
                                    <td><strong>LiteSpeed Cache Plugin:</strong></td>
                                    <td>
                                        <?php if (defined('LSCWP_V')): ?>
                                            <span class="badge-green">✅ Đã cài đặt (v<?php echo esc_html(LSCWP_V); ?>)</span>
                                        <?php else: ?>
                                            <span class="badge-amber">⚠️ Chưa phát hiện Plugin LiteSpeed Cache</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>LiteSpeed Server:</strong></td>
                                    <td>
                                        <?php if (stripos($_SERVER['SERVER_SOFTWARE'] ?? '', 'LiteSpeed') !== false): ?>
                                            <span class="badge-green">✅ Máy chủ LiteSpeed Enterprise</span>
                                        <?php else: ?>
                                            <span><?php echo esc_html($_SERVER['SERVER_SOFTWARE'] ?? 'N/A'); ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>PHP OPcache:</strong></td>
                                    <td>
                                        <?php if (function_exists('opcache_get_status') && @opcache_get_status()): ?>
                                            <span class="badge-green">✅ Đang hoạt động</span>
                                        <?php else: ?>
                                            <span class="badge-amber">Tắt hoặc chưa kích hoạt</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Theme Page Cache:</strong></td>
                                    <td>
                                        <?php if (function_exists('hacoled_page_cache_try_serve')): ?>
                                            <span class="badge-green">✅ Bộ đệm theme HTML đang bật</span>
                                        <?php else: ?>
                                            <span>Không sử dụng</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Nén GZIP / Brotli:</strong></td>
                                    <td>
                                        <?php if (function_exists('gzencode')): ?>
                                            <span class="badge-green">✅ Hỗ trợ zlib / Gzip</span>
                                        <?php else: ?>
                                            <span>Không hỗ trợ</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Gather system environment information.
     */
    protected function getServerEnvironmentInfo() {
        $host = wp_parse_url(home_url(), PHP_URL_HOST);
        $is_local = in_array($host, ['localhost', '127.0.0.1', 'hacoled.test', 'hacoled.local'], true) || str_ends_with($host, '.test') || str_ends_with($host, '.local');

        return [
            'environment'     => $is_local ? 'Môi trường Local Dev' : 'Máy chủ Host (Live)',
            'env_class'       => $is_local ? 'amber' : 'green',
            'host_domain'     => $host,
            'php_version'     => PHP_VERSION,
            'server_software' => explode(' ', $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown')[0],
            'litespeed_active'=> defined('LSCWP_V') || stripos($_SERVER['SERVER_SOFTWARE'] ?? '', 'LiteSpeed') !== false,
            'memory_limit'    => ini_get('memory_limit'),
        ];
    }
}
