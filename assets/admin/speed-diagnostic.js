/**
 * HacoLED Admin Speed & Health Diagnostic Scripts
 */
(function ($) {
    'use strict';

    let testResults = [];
    let isBatchRunning = false;
    let batchIndex = 0;
    let batchQueue = [];
    let shouldStopBatch = false;

    $(document).ready(function () {
        initTabs();
        initSingleTest();
        initBatchTest();
        initFilters();
        initPsiRunner();
        initCacheClear();
        initCustomUrl();
    });

    /**
     * 1. Navigation Tabs
     */
    function initTabs() {
        $('.hacoled-diag-tabs .tab-link').on('click', function (e) {
            e.preventDefault();
            const targetTab = $(this).data('tab');

            $('.hacoled-diag-tabs .tab-link').removeClass('active');
            $(this).addClass('active');

            $('.hacoled-tab-content').removeClass('active');
            $('#' + targetTab).addClass('active');
        });
    }

    /**
     * Custom URL Handler
     */
    function initCustomUrl() {
        $('#btn-use-custom-url').on('click', function () {
            const customUrl = $('#custom-url-input').val().trim();
            if (!customUrl) {
                alert('Vui lòng nhập URL hợp lệ.');
                return;
            }

            // Deselect selector and trigger single test
            $('#route-selector').val('');
            runSingleTest(customUrl, 'URL Tùy Chỉnh');
        });
    }

    /**
     * 2. Single Page Speed Test
     */
    function initSingleTest() {
        $('#btn-test-single').on('click', function () {
            let url = $('#route-selector').val();
            let label = $('#route-selector option:selected').text();

            if (!url) {
                url = $('#custom-url-input').val().trim();
                label = 'URL Tùy Chỉnh';
            }

            if (!url) {
                alert('Vui lòng chọn 1 trang từ danh sách hoặc nhập URL cần kiểm tra.');
                return;
            }

            runSingleTest(url, label);
        });

        // Re-test button click in table
        $(document).on('click', '.btn-retest-row', function () {
            const url = $(this).data('url');
            const label = $(this).data('title') || url;
            runSingleTest(url, label);
        });
    }

    function runSingleTest(url, title) {
        const bypassCache = $('#opt-bypass-cache').is(':checked') ? 1 : 0;
        const deviceMode = $('input[name="opt-device"]:checked').val() || 'desktop';

        const $btn = $('#btn-test-single');
        $btn.prop('disabled', true).addClass('updating-message');

        const tempId = 'test-' + Date.now();
        prependLoadingRow(tempId, url, title);

        $.ajax({
            url: hacoledSpeedDiag.ajaxUrl,
            type: 'POST',
            data: {
                action: 'hacoled_test_page_speed',
                nonce: hacoledSpeedDiag.nonce,
                target_url: url,
                bypass_cache: bypassCache,
                device_mode: deviceMode
            },
            success: function (res) {
                $btn.prop('disabled', false).removeClass('updating-message');
                if (res.success && res.data) {
                    res.data.title = title;
                    updateOrReplaceRow(tempId, res.data);
                    recordResult(res.data);
                } else {
                    const errMsg = (res.data && res.data.message) ? res.data.message : 'Lỗi kết nối';
                    renderErrorRow(tempId, url, title, errMsg);
                }
            },
            error: function (xhr, status, error) {
                $btn.prop('disabled', false).removeClass('updating-message');
                renderErrorRow(tempId, url, title, 'Lỗi HTTP (' + status + ': ' + error + ')');
            }
        });
    }

    /**
     * 3. Batch Test Runner (All Routes)
     */
    function initBatchTest() {
        $('#btn-test-all').on('click', function () {
            if (isBatchRunning) return;

            const allRoutes = hacoledSpeedDiag.routes || [];
            if (!allRoutes.length) {
                alert('Không tìm thấy danh sách trang để kiểm tra.');
                return;
            }

            if (!confirm('Hệ thống sẽ chạy kiểm tra lần lượt ' + allRoutes.length + ' trang trên website. Bạn có muốn bắt đầu không?')) {
                return;
            }

            batchQueue = allRoutes.slice();
            batchIndex = 0;
            shouldStopBatch = false;
            isBatchRunning = true;

            $('#batch-progress-container').slideDown(200);
            $('#btn-test-all').prop('disabled', true);
            $('#btn-test-single').prop('disabled', true);

            updateBatchProgress(0, batchQueue.length);
            runNextInBatch();
        });

        $('#btn-stop-batch').on('click', function () {
            if (!isBatchRunning) return;
            shouldStopBatch = true;
            $('#batch-progress-status').text('Đang dừng quá trình test...');
        });
    }

    function runNextInBatch() {
        if (shouldStopBatch || batchIndex >= batchQueue.length) {
            finishBatchTest();
            return;
        }

        const item = batchQueue[batchIndex];
        const bypassCache = $('#opt-bypass-cache').is(':checked') ? 1 : 0;
        const deviceMode = $('input[name="opt-device"]:checked').val() || 'desktop';

        $('#batch-progress-status').text('Đang kiểm tra [' + (batchIndex + 1) + '/' + batchQueue.length + ']: ' + item.title);

        const tempId = 'batch-' + batchIndex + '-' + Date.now();
        prependLoadingRow(tempId, item.url, item.title);

        $.ajax({
            url: hacoledSpeedDiag.ajaxUrl,
            type: 'POST',
            data: {
                action: 'hacoled_test_page_speed',
                nonce: hacoledSpeedDiag.nonce,
                target_url: item.url,
                bypass_cache: bypassCache,
                device_mode: deviceMode
            },
            success: function (res) {
                if (res.success && res.data) {
                    res.data.title = item.title;
                    updateOrReplaceRow(tempId, res.data);
                    recordResult(res.data);
                } else {
                    const errMsg = (res.data && res.data.message) ? res.data.message : 'Lỗi kết nối';
                    renderErrorRow(tempId, item.url, item.title, errMsg);
                }
            },
            error: function (xhr, status, error) {
                renderErrorRow(tempId, item.url, item.title, 'Lỗi cURL: ' + error);
            },
            complete: function () {
                batchIndex++;
                updateBatchProgress(batchIndex, batchQueue.length);
                setTimeout(runNextInBatch, 300); // 300ms pause between server tests to prevent rate limiting
            }
        });
    }

    function updateBatchProgress(current, total) {
        const pct = Math.round((current / total) * 100);
        $('#batch-progress-percentage').text(pct + '%');
        $('#batch-progress-bar').css('width', pct + '%');
    }

    function finishBatchTest() {
        isBatchRunning = false;
        $('#btn-test-all').prop('disabled', false);
        $('#btn-test-single').prop('disabled', false);

        if (shouldStopBatch) {
            $('#batch-progress-status').text('Đã dừng tiến trình kiểm tra.');
        } else {
            $('#batch-progress-status').text('✅ Đã hoàn tất kiểm tra ' + batchIndex + ' trang!');
        }

        setTimeout(function () {
            $('#batch-progress-container').slideUp(300);
        }, 3500);
    }

    /**
     * UI Rendering Helpers
     */
    function prependLoadingRow(rowId, url, title) {
        $('.no-data-row').remove();

        const rowHtml = `
            <tr id="${rowId}" class="diag-loading-row">
                <td><span class="spinner is-active" style="float:none; margin:0;"></span></td>
                <td>
                    <strong>${escapeHtml(title)}</strong><br>
                    <small class="text-gray-500 font-mono">${escapeHtml(url)}</small>
                </td>
                <td colspan="6" class="text-gray-500">
                    <em>Đang gửi cURL đo lường phản hồi từ máy chủ Host...</em>
                </td>
                <td>--</td>
            </tr>
        `;
        $('#diagnostic-results-body').prepend(rowHtml);
    }

    function updateOrReplaceRow(rowId, data) {
        const stt = $('#diagnostic-results-body tr:not(.diag-loading-row):not(.no-data-row)').length + 1;

        // Classify TTFB
        let ttfbClass = 'timing-good';
        if (data.ttfb > 1200) {
            ttfbClass = 'timing-poor';
        } else if (data.ttfb > 500) {
            ttfbClass = 'timing-needs-improvement';
        }

        // Classify Total
        let totalClass = 'timing-good';
        if (data.total_time > 3000) {
            totalClass = 'timing-poor';
        } else if (data.total_time > 1500) {
            totalClass = 'timing-needs-improvement';
        }

        // HTML Analysis chips
        let chipsHtml = '';
        const ha = data.html_analysis || {};

        if (ha.has_fatal_error) {
            chipsHtml += `<span class="audit-chip audit-chip-error">⚠️ ${escapeHtml(ha.fatal_message || 'PHP Fatal Error')}</span>`;
        }

        if (data.http_code === 200) {
            chipsHtml += `<span class="audit-chip audit-chip-ok">200 OK</span>`;
        } else {
            chipsHtml += `<span class="audit-chip audit-chip-error">HTTP ${data.http_code}</span>`;
        }

        if (ha.img_missing_alt > 0) {
            chipsHtml += `<span class="audit-chip audit-chip-warning">${ha.img_missing_alt} ảnh thiếu alt</span>`;
        }

        if (ha.heavy_pngs && ha.heavy_pngs.length > 0) {
            chipsHtml += `<span class="audit-chip audit-chip-warning">Ảnh PNG nặng: ${escapeHtml(ha.heavy_pngs.join(', '))}</span>`;
        }

        if (ha.has_meta_desc) {
            chipsHtml += `<span class="audit-chip audit-chip-ok">Có Meta Desc</span>`;
        } else {
            chipsHtml += `<span class="audit-chip audit-chip-warning">Thiếu Meta Desc</span>`;
        }

        // Cache Status Badge
        let cacheBadge = `<span class="badge-amber">${escapeHtml(data.cache_status)}</span>`;
        if (data.cache_status && (data.cache_status.indexOf('hit') !== -1 || data.cache_status.indexOf('HIT') !== -1)) {
            cacheBadge = `<span class="badge-green">HIT (${escapeHtml(data.cache_status)})</span>`;
        }

        // Row Category for Filter
        let rowFilterType = 'fast';
        if (data.http_code !== 200 || data.ttfb > 1200 || ha.has_fatal_error) {
            rowFilterType = 'slow';
        } else if (data.ttfb > 500) {
            rowFilterType = 'moderate';
        }

        const cleanHtml = `
            <tr id="${rowId}" class="diag-result-row filter-item-${rowFilterType}">
                <td>${stt}</td>
                <td>
                    <strong>${escapeHtml(data.title || 'Trang')}</strong><br>
                    <a href="${escapeHtml(data.url)}" target="_blank" class="font-mono text-xs text-blue-600">
                        ${escapeHtml(data.url)}
                    </a>
                </td>
                <td>
                    <span class="${data.http_code === 200 ? 'badge-green' : 'badge-red'} font-bold">
                        ${data.http_code}
                    </span>
                </td>
                <td>
                    <span class="timing-badge ${ttfbClass}">
                        ${data.ttfb} ms
                    </span>
                </td>
                <td>
                    <span class="timing-badge ${totalClass}">
                        ${data.total_time} ms
                    </span>
                </td>
                <td>
                    <span class="font-mono text-xs font-bold">${data.size_download_kb} KB</span>
                </td>
                <td>
                    ${cacheBadge}<br>
                    <small class="text-gray-500 font-mono text-[10px]">${escapeHtml(data.cache_control || '')}</small>
                </td>
                <td>
                    <div class="analysis-chips-wrapper">
                        ${chipsHtml}
                    </div>
                </td>
                <td>
                    <button type="button" class="button button-small btn-retest-row" data-url="${escapeHtml(data.url)}" data-title="${escapeHtml(data.title)}">
                        <span class="dashicons dashicons-update"></span> Test Lại
                    </button>
                </td>
            </tr>
        `;

        $('#' + rowId).replaceWith(cleanHtml);
    }

    function renderErrorRow(rowId, url, title, errorMsg) {
        const errorHtml = `
            <tr id="${rowId}" class="diag-result-row filter-item-slow">
                <td>!</td>
                <td>
                    <strong>${escapeHtml(title)}</strong><br>
                    <small class="font-mono text-xs text-red-500">${escapeHtml(url)}</small>
                </td>
                <td><span class="badge-red font-bold">LỖI</span></td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                <td><span class="audit-chip audit-chip-error">⚠️ ${escapeHtml(errorMsg)}</span></td>
                <td>
                    <button type="button" class="button button-small btn-retest-row" data-url="${escapeHtml(url)}" data-title="${escapeHtml(title)}">
                        <span class="dashicons dashicons-update"></span> Thử Lại
                    </button>
                </td>
            </tr>
        `;
        $('#' + rowId).replaceWith(errorHtml);
        updateCounters();
    }

    function recordResult(data) {
        testResults.push(data);
        updateCounters();
    }

    function updateCounters() {
        const $rows = $('#diagnostic-results-body tr.diag-result-row');
        const countAll = $rows.length;
        const countFast = $rows.filter('.filter-item-fast').length;
        const countModerate = $rows.filter('.filter-item-moderate').length;
        const countSlow = $rows.filter('.filter-item-slow').length;

        $('#count-all').text(countAll);
        $('#count-fast').text(countFast);
        $('#count-moderate').text(countModerate);
        $('#count-slow').text(countSlow);
    }

    /**
     * 4. Results Filter Buttons
     */
    function initFilters() {
        $('.filter-pill').on('click', function () {
            $('.filter-pill').removeClass('active');
            $(this).addClass('active');

            const filter = $(this).data('filter');
            const $rows = $('#diagnostic-results-body tr.diag-result-row');

            if (filter === 'all') {
                $rows.show();
            } else {
                $rows.hide();
                $rows.filter('.filter-item-' + filter).show();
            }
        });
    }

    /**
     * 5. Google PageSpeed Insights Live Runner
     */
    function initPsiRunner() {
        $('#btn-run-psi').on('click', function () {
            const url = $('#psi-url-selector').val();
            const strategy = $('input[name="psi-device"]:checked').val() || 'desktop';

            if (!url) {
                alert('Vui lòng chọn 1 URL để chấm điểm Google PageSpeed.');
                return;
            }

            $('#psi-result-card').hide();
            $('#psi-loading').fadeIn(200);
            $('#btn-run-psi').prop('disabled', true);

            $.ajax({
                url: hacoledSpeedDiag.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'hacoled_run_pagespeed_api',
                    nonce: hacoledSpeedDiag.nonce,
                    target_url: url,
                    strategy: strategy
                },
                success: function (res) {
                    $('#psi-loading').hide();
                    $('#btn-run-psi').prop('disabled', false);

                    if (res.success && res.data) {
                        renderPsiResult(res.data);
                    } else {
                        const msg = (res.data && res.data.message) ? res.data.message : 'Không nhận được kết quả từ Google API.';
                        alert('Lỗi chấm điểm: ' + msg);
                    }
                },
                error: function (xhr, status, error) {
                    $('#psi-loading').hide();
                    $('#btn-run-psi').prop('disabled', false);
                    alert('Lỗi kết nối: ' + error);
                }
            });
        });
    }

    function renderPsiResult(data) {
        const scores = data.scores || {};
        const metrics = data.metrics || {};

        $('#psi-device-label').text((data.strategy || 'desktop').toUpperCase() + ' REPORT');
        $('#psi-tested-url').text(data.url);
        $('#psi-timestamp').text('Đo lúc: ' + (data.fetched_at || 'Vừa xong'));
        $('#psi-official-link').attr('href', data.report_url || '#');

        renderScoreRing('perf', scores.performance);
        renderScoreRing('a11y', scores.accessibility);
        renderScoreRing('best', scores.best_practices);
        renderScoreRing('seo', scores.seo);

        $('#val-fcp').text(metrics.fcp || '--');
        $('#val-lcp').text(metrics.lcp || '--');
        $('#val-cls').text(metrics.cls || '--');
        $('#val-tbt').text(metrics.tbt || '--');
        $('#val-si').text(metrics.si || '--');
        $('#val-ttfb').text(metrics.ttfb || '--');

        $('#psi-result-card').slideDown(300);
    }

    function renderScoreRing(key, score) {
        const $circle = $('#circle-score-' + key);
        $circle.removeClass('circle-good circle-average circle-poor');
        $circle.text(score || 0);

        if (score >= 90) {
            $circle.addClass('circle-good');
        } else if (score >= 50) {
            $circle.addClass('circle-average');
        } else {
            $circle.addClass('circle-poor');
        }
    }

    /**
     * 6. Purge All Caches
     */
    function initCacheClear() {
        $('#btn-clear-caches').on('click', function () {
            if (!confirm('Bạn có chắc muốn làm mới và xóa toàn bộ bộ nhớ đệm (LiteSpeed Cache, Theme Cache, Transients)?')) {
                return;
            }

            const $btn = $(this);
            $btn.prop('disabled', true).text('Đang xóa cache...');

            $.ajax({
                url: hacoledSpeedDiag.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'hacoled_clear_all_caches',
                    nonce: hacoledSpeedDiag.nonce
                },
                success: function (res) {
                    $btn.prop('disabled', false).html('<span class="dashicons dashicons-trash"></span> Xóa Toàn Bộ Cache');
                    alert(res.data && res.data.message ? res.data.message : 'Đã xóa toàn bộ bộ nhớ đệm thành công!');
                },
                error: function () {
                    $btn.prop('disabled', false).html('<span class="dashicons dashicons-trash"></span> Xóa Toàn Bộ Cache');
                    alert('Lỗi khi xóa cache.');
                }
            });
        });
    }

    function escapeHtml(text) {
        if (!text) return '';
        return String(text)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

})(jQuery);
