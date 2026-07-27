(function ($) {
  'use strict';

  function esc(value) {
    return String(value == null ? '' : value).replace(/[&<>'"]/g, function (char) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#039;', '"': '&quot;' }[char];
    });
  }

  function value(scope, selector) {
    var field = scope.querySelector(selector);
    return field ? field.value.trim() : '';
  }

  function collectItems(container, dropdown) {
    if (!container) return [];
    return Array.from(container.querySelectorAll(':scope > .hacoled-item-row')).map(function (row) {
      var item = {
        label: value(row, 'input[name$="[label]"]'),
        url: value(row, 'input[name$="[url]"]')
      };
      if (dropdown) {
        item.icon = value(row, 'select[name$="[icon]"]') || 'info';
        item.tone = value(row, 'select[name$="[tone]"]') || 'red';
      } else {
        var badge = value(row, 'input[name$="[badge][label]"]');
        if (badge) item.badge = { label: badge, tone: value(row, 'select[name$="[badge][tone]"]') || 'red' };
      }
      return item;
    }).filter(function (item) { return item.label || item.url; });
  }

  function collectMenu(panel) {
    var kind = panel.dataset.menuKind;
    var menu = {
      label: value(panel, '.hacoled-general-card input[name$="[label]"]'),
      url: value(panel, '.hacoled-general-card input[name$="[url]"]'),
      enabled: !!panel.querySelector('.hacoled-switch input:checked'),
      kind: kind
    };

    if (kind === 'link') {
      // url already collected above
    } else if (kind === 'dropdown') {
      menu.items = collectItems(panel.querySelector('.hacoled-items'), true);
    } else {
      menu.columns = Array.from(panel.querySelectorAll('.hacoled-column-card')).map(function (column) {
        return {
          title: value(column, '.hacoled-column-head input[name$="[title]"]'),
          icon: value(column, '.hacoled-column-head select[name$="[icon]"]') || 'monitor',
          tone: value(column, '.hacoled-column-head select[name$="[tone]"]') || 'red',
          item_columns: Number(value(column, '.hacoled-column-head select[name$="[item_columns]"]')) === 2 ? 2 : 1,
          items: collectItems(column.querySelector('.hacoled-items'), false)
        };
      });
      var visual = panel.querySelector('.hacoled-visual-card');
      menu.visual = visual ? {
        image: value(visual, 'input[name$="[visual][image]"]'),
        fallback: value(visual, 'input[name$="[visual][fallback]"]'),
        alt: value(visual, 'input[name$="[visual][alt]"]'),
        badge: value(visual, 'input[name$="[visual][badge]"]'),
        title: value(visual, 'input[name$="[visual][title]"]'),
        cta: value(visual, 'input[name$="[visual][cta]"]'),
        url: value(visual, 'input[name$="[visual][url]"]')
      } : {};
    }
    return menu;
  }

  function collectAllMenus() {
    var menus = {};
    document.querySelectorAll('.hacoled-menu-panel').forEach(function (panel) {
      menus[panel.dataset.menuPanel] = collectMenu(panel);
    });
    return menus;
  }

  function renderPreview() {
    var nav = document.querySelector('[data-preview-nav]');
    var dropdown = document.querySelector('[data-preview-dropdown]');
    var activePanel = document.querySelector('.hacoled-menu-panel.is-active');
    if (!nav || !dropdown || !activePanel) return;

    var activeKey = activePanel.dataset.menuPanel;
    var menus = collectAllMenus();
    nav.innerHTML = Object.keys(menus).filter(function (key) { return menus[key].enabled; }).map(function (key) {
      var arrow = menus[key].kind === 'link' ? '' : '<b>⌄</b>';
      return '<span class="' + (key === activeKey ? 'is-active' : '') + '">' + esc(menus[key].label || 'Chưa đặt tên') + arrow + '</span>';
    }).join('');

    var menu = menus[activeKey];
    if (!menu || !menu.enabled) {
      dropdown.innerHTML = '<div class="hacoled-preview-empty">Menu này đang tắt.</div>';
      return;
    }
    if (menu.kind === 'link') {
      dropdown.innerHTML = '<div class="hacoled-preview-empty">Đây là liên kết đơn: <strong>' + esc(menu.url) + '</strong></div>';
      return;
    }
    if (menu.kind === 'dropdown') {
      dropdown.innerHTML = '<div class="hacoled-preview-small">' + menu.items.map(function (item) {
        return '<div><i class="is-' + esc(item.tone) + '">' + esc((item.icon || 'i').slice(0, 1).toUpperCase()) + '</i><span>' + esc(item.label) + '</span></div>';
      }).join('') + '</div>';
      return;
    }

    var columns = menu.columns.map(function (column) {
      return '<section><h4><i class="is-' + esc(column.tone) + '">' + esc((column.icon || 'm').slice(0, 1).toUpperCase()) + '</i>' + esc(column.title) + '</h4><div class="' + (column.item_columns === 2 ? 'is-two' : '') + '">' + column.items.map(function (item) {
        var badge = item.badge ? '<small class="is-' + esc(item.badge.tone) + '">' + esc(item.badge.label) + '</small>' : '';
        return '<p>' + esc(item.label) + badge + '</p>';
      }).join('') + '</div></section>';
    }).join('');
    var visual = menu.visual || {};
    var image = visual.image ? '<img src="' + esc(visual.image) + '" alt="">' : '';
    var visualCard = '<aside>' + image + '<div><em>' + esc(visual.badge) + '</em><strong>' + esc(visual.title) + '</strong><span>' + esc(visual.cta || 'Xem chi tiết') + ' →</span></div></aside>';
    dropdown.innerHTML = '<div class="hacoled-preview-mega"><div class="hacoled-preview-columns">' + columns + '</div>' + visualCard + '</div>';
  }

  function activateTab(key) {
    $('.hacoled-menu-tab').removeClass('is-active').filter('[data-menu-tab="' + key + '"]').addClass('is-active');
    $('.hacoled-menu-panel').removeClass('is-active').filter('[data-menu-panel="' + key + '"]').addClass('is-active');
    window.sessionStorage.setItem('hacoledHeaderMenuTab', key);
    renderPreview();
  }

  function initSortable(scope) {
    $(scope || document).find('.hacoled-sortable').sortable({
      handle: '.hacoled-drag', items: '> .hacoled-item-row', placeholder: 'hacoled-sortable-placeholder',
      forcePlaceholderSize: true, tolerance: 'pointer', update: renderPreview
    });
  }

  function copyJsonFromForm(button) {
    var textarea = document.getElementById('hacoled-bulk-json');
    if (!textarea) return;
    textarea.value = JSON.stringify({ schema: 'hacoled-header-menu-v1', menus: collectAllMenus() }, null, 2);
    textarea.focus(); textarea.select();
    var done = function () { var old = button.textContent; button.textContent = 'Đã sao chép ✓'; window.setTimeout(function () { button.textContent = old; }, 1400); };
    if (navigator.clipboard && window.isSecureContext) navigator.clipboard.writeText(textarea.value).then(done);
    else { document.execCommand('copy'); done(); }
  }

  $(function () {
    initSortable(document);
    var stored = window.sessionStorage.getItem('hacoledHeaderMenuTab');
    if (stored && $('.hacoled-menu-tab[data-menu-tab="' + stored + '"]').length) activateTab(stored);
    else renderPreview();

    $(document).on('click', '.hacoled-menu-tab', function () { activateTab($(this).data('menu-tab')); });
    $(document).on('input change', '.hacoled-menu-panel input, .hacoled-menu-panel select', renderPreview);

    $(document).on('click', '.hacoled-add-item', function () {
      var button = $(this), target = $(button.data('target'));
      var templateId = button.data('template') === 'dropdown' ? '#tmpl-hacoled-dropdown-item' : '#tmpl-hacoled-mega-item';
      var html = $(templateId).html().replaceAll('__PREFIX__', button.attr('data-prefix')).replaceAll('__INDEX__', Date.now().toString());
      target.append(html); initSortable(target.parent()); target.children().last().find('input').first().trigger('focus'); renderPreview();
    });

    $(document).on('click', '.hacoled-remove-item', function () {
      if (window.confirm('Xóa mục menu này?')) { $(this).closest('.hacoled-item-row').remove(); renderPreview(); }
    });

    $(document).on('change', '.hacoled-switch input', function () {
      var key = $(this).closest('.hacoled-menu-panel').data('menu-panel');
      $('.hacoled-menu-tab[data-menu-tab="' + key + '"] .hacoled-status-dot').toggleClass('is-on', this.checked); renderPreview();
    });

    $(document).on('click', '.hacoled-select-media', function () {
      var control = $(this).closest('.hacoled-media-control');
      var preview = $(this).closest('.hacoled-visual-card').find('.hacoled-media-preview');
      var frame = wp.media({ title: 'Chọn ảnh cho Mega Menu', button: { text: 'Dùng ảnh này' }, multiple: false, library: { type: 'image' } });
      frame.on('select', function () {
        var image = frame.state().get('selection').first().toJSON();
        control.find('.hacoled-media-url').val(image.url).trigger('change'); preview.html($('<img>', { src: image.url, alt: '' })); renderPreview();
      });
      frame.open();
    });

    $(document).on('click', '.hacoled-copy-json', function () { copyJsonFromForm(this); });
    $('.hacoled-reset-button').on('click', function () { return window.confirm('Khôi phục toàn bộ menu mặc định? Cấu hình đã chỉnh sẽ bị thay thế.'); });
    $('#hacoled-header-menu-form button[value="import"]').on('click', function () { return window.confirm('Nhập JSON sẽ thay thế toàn bộ cấu hình Header hiện tại. Tiếp tục?'); });
  });
})(jQuery);
