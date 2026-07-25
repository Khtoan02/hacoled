<?php
/**
 * News & Blog Page - Premium HacoLED Journal Hub
 *
 * @var array  $page
 * @var array  $sections Keys: led, audio, tech, projects, press, news, events, jobs
 * @var string $header_type
 * @var string $footer_type
 */

$this->renderHeader($header_type ?? 'default');

$theme_uri = get_template_directory_uri();
$section_keys = ['projects', 'led', 'audio', 'tech', 'press', 'events', 'news', 'jobs'];
$sections = wp_parse_args($sections ?? [], array_fill_keys($section_keys, []));

$section_meta = [
    'projects' => [
        'label' => __('Dự án bàn giao', 'hacoled'),
        'short' => __('Dự án', 'hacoled'),
        'icon' => 'ph-fill ph-folder-open',
        'anchor' => 'du-an',
        'desc' => __('Hồ sơ công trình thực tế, bối cảnh triển khai và năng lực thi công AV Pro.', 'hacoled'),
        'tone' => 'gold',
    ],
    'led' => [
        'label' => __('Màn hình LED', 'hacoled'),
        'short' => __('LED', 'hacoled'),
        'icon' => 'ph-fill ph-monitor',
        'anchor' => 'led',
        'desc' => __('Tư vấn công nghệ hiển thị, pixel pitch, module, cabinet và vận hành màn hình LED.', 'hacoled'),
        'tone' => 'red',
    ],
    'audio' => [
        'label' => __('Âm thanh hội trường', 'hacoled'),
        'short' => __('Âm thanh', 'hacoled'),
        'icon' => 'ph-fill ph-speaker-high',
        'anchor' => 'audio',
        'desc' => __('Giải pháp loa, micro, mixer, xử lý âm học và hệ thống hội nghị chuyên nghiệp.', 'hacoled'),
        'tone' => 'gold',
    ],
    'tech' => [
        'label' => __('Kỹ thuật vận hành', 'hacoled'),
        'short' => __('Kỹ thuật', 'hacoled'),
        'icon' => 'ph-fill ph-wrench',
        'anchor' => 'ky-thuat',
        'desc' => __('Cẩm nang cấu hình card, tủ điện, xử lý lỗi tín hiệu và checklist nghiệm thu.', 'hacoled'),
        'tone' => 'red',
    ],
    'press' => [
        'label' => __('Báo chí nói về HacoLED', 'hacoled'),
        'short' => __('Báo chí', 'hacoled'),
        'icon' => 'ph-fill ph-newspaper',
        'anchor' => 'bao-chi',
        'desc' => __('Các bài viết, phóng sự và tín hiệu truyền thông xoay quanh thương hiệu HacoLED.', 'hacoled'),
        'tone' => 'red',
    ],
    'events' => [
        'label' => __('Sự kiện & hoạt động', 'hacoled'),
        'short' => __('Sự kiện', 'hacoled'),
        'icon' => 'ph-fill ph-calendar-blank',
        'anchor' => 'su-kien',
        'desc' => __('Hoạt động nội bộ, đào tạo kỹ thuật, hội thảo và dấu mốc phát triển.', 'hacoled'),
        'tone' => 'red',
    ],
    'news' => [
        'label' => __('Kinh nghiệm chọn giải pháp', 'hacoled'),
        'short' => __('Kinh nghiệm', 'hacoled'),
        'icon' => 'ph-fill ph-lightbulb',
        'anchor' => 'kinh-nghiem',
        'desc' => __('Góc nhìn dễ hiểu cho chủ đầu tư khi cân nhắc chi phí, hiệu quả và độ bền.', 'hacoled'),
        'tone' => 'gold',
    ],
    'jobs' => [
        'label' => __('Cơ hội nghề nghiệp', 'hacoled'),
        'short' => __('Tuyển dụng', 'hacoled'),
        'icon' => 'ph-fill ph-users-three',
        'anchor' => 'tuyen-dung',
        'desc' => __('Tin tuyển dụng đội ngũ kinh doanh, kỹ thuật, nội dung và vận hành dự án.', 'hacoled'),
        'tone' => 'red',
    ],
];

$normalize_post = static function ($post, $fallback = []) use ($theme_uri) {
    $post = wp_parse_args($post ?? [], [
        'id' => 0,
        'title' => __('Bản tin HacoLED đang cập nhật', 'hacoled'),
        'excerpt' => __('Nội dung mẫu cho khu vực tin tức HacoLED Journal.', 'hacoled'),
        'permalink' => '#',
        'date' => date_i18n('d/m/Y'),
        'author' => __('Ban biên tập', 'hacoled'),
        'category' => __('HacoLED Journal', 'hacoled'),
        'thumbnail' => 'https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?q=80&w=1200&auto=format&fit=crop',
        'reading_time' => __('4 phút đọc', 'hacoled'),
    ]);

    return wp_parse_args($post, $fallback);
};

$collect_posts = static function ($keys, $limit = 8) use (&$sections, $normalize_post) {
    $items = [];
    $seen = [];

    foreach ((array) $keys as $key) {
        foreach (($sections[$key] ?? []) as $post) {
            $post = $normalize_post($post);
            $id = (string) ($post['id'] ?: md5($post['title'] . $post['permalink']));
            if (isset($seen[$id])) {
                continue;
            }
            $seen[$id] = true;
            $items[] = $post;
            if (count($items) >= $limit) {
                return $items;
            }
        }
    }

    return $items;
};

$first_post = static function ($key, $fallback_keys = []) use (&$sections, $normalize_post, $collect_posts) {
    if (!empty($sections[$key][0])) {
        return $normalize_post($sections[$key][0]);
    }

    $fallback = $collect_posts($fallback_keys ?: array_keys($sections), 1);
    return $fallback[0] ?? $normalize_post([]);
};

$post_json = static function ($post) use ($normalize_post) {
    $post = $normalize_post($post);
    return wp_json_encode([
        'title' => wp_strip_all_tags($post['title']),
        'excerpt' => wp_strip_all_tags($post['excerpt']),
        'permalink' => esc_url_raw($post['permalink']),
        'thumbnail' => esc_url_raw($post['thumbnail']),
        'category' => wp_strip_all_tags($post['category']),
        'date' => wp_strip_all_tags($post['date']),
        'author' => wp_strip_all_tags($post['author']),
        'reading_time' => wp_strip_all_tags($post['reading_time']),
    ], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
};

$render_section_header = function ($key, $meta, $eyebrow = '') {
    ?>
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 pb-5 border-b border-brand-red/15">
      <div class="max-w-3xl space-y-2">
        <div class="flex items-center gap-3">
          <span class="w-1.5 h-9 rounded-full bg-brand-red shadow-[0_0_18px_rgba(204,0,0,0.25)]"></span>
          <span class="inline-flex w-10 h-10 items-center justify-center rounded-xl border border-brand-red/20 bg-brand-red/10 text-brand-red">
            <i class="<?php echo esc_attr($meta['icon']); ?> text-lg"></i>
          </span>
          <div>
            <?php if ($eyebrow): ?>
              <p class="text-[9px] font-black uppercase tracking-[0.22em] text-brand-gold font-mono"><?php echo esc_html($eyebrow); ?></p>
            <?php endif; ?>
            <h2 class="text-xl md:text-3xl font-black uppercase tracking-tight text-brand-text leading-none">
              <?php echo esc_html($meta['label']); ?>
            </h2>
          </div>
        </div>
        <p class="pl-[58px] text-[12px] md:text-sm leading-relaxed text-brand-muted max-w-2xl">
          <?php echo esc_html($meta['desc']); ?>
        </p>
      </div>
      <a href="#<?php echo esc_attr($meta['anchor']); ?>"
         class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-full border border-brand-red/25 bg-white/70 px-4 py-2 text-[10px] font-black uppercase tracking-wider text-brand-red hover:bg-brand-red hover:text-white transition-all shadow-sm">
        <?php _e('Theo dõi chuyên mục', 'hacoled'); ?>
        <i class="ph-bold ph-arrow-down text-xs"></i>
      </a>
    </div>
    <?php
};

$render_story_card = function ($post, $variant = 'standard') use ($post_json, $normalize_post, $theme_uri) {
    $post = $normalize_post($post);
    $is_compact = $variant === 'compact';
    $card_min_height = $is_compact ? 'min-h-[320px] md:min-h-[350px]' : 'min-h-[390px] md:min-h-[420px]';
    $image_ratio = 'aspect-[16/10]';
    $body_padding = $is_compact ? 'p-4 md:p-4' : 'p-4 md:p-5';
    $title_class = $is_compact ? 'text-[15px] md:text-base line-clamp-2' : 'text-base md:text-[19px] line-clamp-3';
    $excerpt_class = 'line-clamp-2';
    $category_label = wp_strip_all_tags($post['category']);
    $insight_chips = $is_compact
        ? [__('Tóm tắt', 'hacoled'), __('Ứng dụng', 'hacoled')]
        : [__('Phân tích', 'hacoled'), __('Ứng dụng', 'hacoled'), __('Checklist', 'hacoled')];
    ?>
    <article data-news-post-card class="group relative mx-auto flex w-full max-w-[430px] <?php echo esc_attr($card_min_height); ?> flex-col overflow-hidden rounded-[1.35rem] md:rounded-[1.75rem] border border-white/80 bg-white/85 shadow-[0_18px_55px_rgba(15,23,42,0.08)] backdrop-blur-xl transition-all duration-500 hover:-translate-y-1 hover:border-white hover:bg-white hover:shadow-[0_28px_70px_rgba(15,23,42,0.13)]">
      <div class="pointer-events-none absolute -inset-px rounded-[1.35rem] md:rounded-[1.75rem] bg-gradient-to-br from-[#E3000F]/18 via-transparent to-[#D4AF37]/20 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
      <div class="pointer-events-none absolute -right-24 -top-24 h-56 w-56 rounded-full bg-[#E3000F]/8 blur-3xl"></div>

      <div class="relative">
        <div data-news-card-image class="relative <?php echo esc_attr($image_ratio); ?> overflow-hidden bg-slate-950 shadow-inner">
          <img src="<?php echo esc_url($post['thumbnail']); ?>" alt="<?php echo esc_attr($post['title']); ?>" class="absolute inset-0 h-full w-full object-cover object-center brightness-[1.02] contrast-[1.03] saturate-[1.1] transition-transform duration-700 group-hover:scale-105" loading="lazy" decoding="async">
          <div class="absolute inset-0 bg-gradient-to-t from-black/18 via-black/0 to-black/8"></div>
          <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_16%,rgba(212,175,55,0.1),transparent_34%)]"></div>
          <a href="<?php echo esc_url($post['permalink']); ?>" class="absolute inset-0 z-10" aria-label="<?php echo esc_attr($post['title']); ?>"></a>

          <div class="absolute left-3 top-3 right-3 z-20 flex items-start justify-between gap-2">
            <span class="max-w-[78%] truncate rounded-full bg-[#E3000F] px-2.5 py-1 text-[8px] font-black uppercase tracking-wider text-white shadow-[0_8px_22px_rgba(227,0,15,0.25)] md:text-[9px]">
              <?php echo esc_html($category_label); ?>
            </span>
            <button @click.prevent='activePost = <?php echo $post_json($post); ?>; showDrawer = true'
                    class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-white/80 bg-white/95 text-brand-text shadow-md transition-all hover:bg-[#E3000F] hover:text-white"
                    aria-label="<?php esc_attr_e('Đọc nhanh', 'hacoled'); ?>">
              <i class="ph-bold ph-eye text-sm"></i>
            </button>
          </div>
        </div>
      </div>

      <div class="relative flex flex-1 flex-col <?php echo esc_attr($body_padding); ?>">
        <div class="pointer-events-none absolute -right-14 -bottom-16 h-44 w-44 bg-contain bg-center bg-no-repeat opacity-[0.045]"
             style="background-image: url('<?php echo esc_url($theme_uri . '/assets/images/dongson.png'); ?>'); filter: url(#to-gold-light);"></div>

        <div class="relative z-10 flex flex-wrap items-center gap-1.5">
          <span class="inline-flex items-center gap-1 rounded-full border border-amber-200/80 bg-amber-50/90 px-2 py-1 text-[8px] font-black uppercase tracking-wider text-amber-700">
            <i class="ph-bold ph-calendar-blank text-amber-500"></i>
            <?php echo esc_html($post['date']); ?>
          </span>
          <span class="inline-flex items-center gap-1 rounded-full border border-amber-200/80 bg-amber-50/90 px-2 py-1 text-[8px] font-black uppercase tracking-wider text-amber-700">
            <i class="ph-bold ph-clock text-amber-500"></i>
            <?php echo esc_html($post['reading_time']); ?>
          </span>
        </div>

        <h3 class="relative z-10 mt-3 <?php echo esc_attr($title_class); ?> font-black leading-tight text-slate-950 transition-colors duration-300 group-hover:text-[#E3000F]">
          <a href="<?php echo esc_url($post['permalink']); ?>"><?php echo esc_html($post['title']); ?></a>
        </h3>

        <p class="relative z-10 mt-2 <?php echo esc_attr($excerpt_class); ?> text-[12px] font-medium leading-relaxed text-slate-500">
          <?php echo esc_html($post['excerpt']); ?>
        </p>

        <div class="relative z-10 mt-3 flex flex-wrap gap-1.5">
          <?php foreach ($insight_chips as $chip): ?>
            <span class="rounded-full border border-slate-200/80 bg-slate-50/90 px-2 py-1 text-[8px] font-black uppercase tracking-wider text-slate-500">
              <?php echo esc_html($chip); ?>
            </span>
          <?php endforeach; ?>
        </div>

        <a href="<?php echo esc_url($post['permalink']); ?>" class="relative z-10 mt-auto flex items-center justify-between gap-4 border-t border-slate-200/70 pt-3 text-[10px] font-black uppercase tracking-wider text-brand-red transition-colors hover:text-brand-text">
          <span><?php _e('Đọc bài viết', 'hacoled'); ?></span>
          <span class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 bg-slate-50 text-brand-text transition-all group-hover:border-[#E3000F] group-hover:bg-[#E3000F] group-hover:text-white group-hover:shadow-[0_12px_28px_rgba(227,0,15,0.22)]">
            <i class="ph-bold ph-arrow-up-right text-sm transition-transform duration-300 group-hover:rotate-12"></i>
          </span>
        </a>
      </div>
    </article>
    <?php
};

$render_compact_story_item = function ($post, $index = null) use ($post_json, $normalize_post) {
    $post = $normalize_post($post);
    $category_label = wp_strip_all_tags($post['category']);
    ?>
    <article data-news-compact-item class="group relative flex gap-3 rounded-2xl border border-slate-200/80 bg-white/88 p-2.5 shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:border-brand-red/20 hover:bg-white hover:shadow-lg">
      <a href="<?php echo esc_url($post['permalink']); ?>" class="relative h-20 w-28 shrink-0 overflow-hidden rounded-xl bg-slate-950 md:h-24 md:w-32" aria-label="<?php echo esc_attr($post['title']); ?>">
        <img src="<?php echo esc_url($post['thumbnail']); ?>" alt="<?php echo esc_attr($post['title']); ?>" class="absolute inset-0 h-full w-full object-cover object-center brightness-[1.02] contrast-[1.03] saturate-[1.08] transition-transform duration-500 group-hover:scale-105" loading="lazy" decoding="async">
        <span class="absolute left-2 top-2 rounded-full bg-brand-red px-2 py-0.5 text-[7px] font-black uppercase tracking-wider text-white">
          <?php echo esc_html($category_label); ?>
        </span>
      </a>
      <div class="min-w-0 flex-1 py-0.5">
        <div class="flex items-center gap-2 text-[8px] font-black uppercase tracking-wider text-amber-700">
          <?php if ($index !== null): ?>
            <span class="font-mono text-brand-red/50"><?php echo esc_html(sprintf('%02d', $index)); ?></span>
          <?php endif; ?>
          <span><?php echo esc_html($post['date']); ?></span>
          <span class="text-slate-300">/</span>
          <span><?php echo esc_html($post['reading_time']); ?></span>
        </div>
        <h4 class="mt-1.5 text-[13px] font-black leading-snug text-brand-text line-clamp-2 group-hover:text-brand-red transition-colors">
          <a href="<?php echo esc_url($post['permalink']); ?>"><?php echo esc_html($post['title']); ?></a>
        </h4>
        <p class="mt-1 line-clamp-1 text-[10px] font-medium leading-relaxed text-brand-muted">
          <?php echo esc_html($post['excerpt']); ?>
        </p>
      </div>
      <button @click.prevent='activePost = <?php echo $post_json($post); ?>; showDrawer = true'
              class="mt-auto inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-slate-200 bg-slate-50 text-slate-500 transition-all hover:border-brand-red hover:bg-brand-red hover:text-white"
              aria-label="<?php esc_attr_e('Đọc nhanh', 'hacoled'); ?>">
        <i class="ph-bold ph-eye text-xs"></i>
      </button>
    </article>
    <?php
};

$hero_post = $first_post('led', ['projects', 'tech', 'news']);
$hero_side = $collect_posts(['projects', 'audio', 'tech'], 3);
$trending_posts = $collect_posts(['news', 'tech', 'led', 'audio', 'press', 'events', 'jobs'], 8);
$visual_wall = $collect_posts(['projects', 'led', 'audio', 'press', 'events'], 9);
$knowledge_posts = $collect_posts(['led', 'audio', 'tech', 'news'], 10);
$press_event_posts = $collect_posts(['press', 'events'], 8);
$total_sample_posts = 0;
foreach ($sections as $posts) {
    $total_sample_posts += is_array($posts) ? count($posts) : 0;
}

$date_label = date_i18n('d/m/Y');
$image_fallback_url = 'https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?q=80&w=1200&auto=format&fit=crop';
?>

<script>
document.addEventListener('error', function(event) {
  var img = event.target;
  if (!img || img.tagName !== 'IMG' || img.dataset.hacoledFallbackApplied) {
    return;
  }
  img.dataset.hacoledFallbackApplied = '1';
  img.src = <?php echo wp_json_encode($image_fallback_url); ?>;
}, true);
</script>

<main id="blog-main"
      class="relative overflow-hidden bg-[#f8f6f5] pb-24 text-brand-text min-h-[90vh]"
      style="padding-top: var(--news-top-offset, 132px);"
      x-data="{ activePost: null, showDrawer: false }"
      x-init="
        const setOffset = () => {
          const hdr = document.getElementById('site-header');
          $el.style.setProperty('--news-top-offset', ((hdr ? hdr.offsetHeight : 96) + 28) + 'px');
        };
        setOffset();
        window.addEventListener('resize', setOffset);
      ">
  <div class="absolute inset-0 bg-tech-grid opacity-80 pointer-events-none"></div>
  <div class="absolute -top-24 right-[-140px] w-[520px] h-[520px] opacity-[0.045] pointer-events-none bg-dongson" style="background-image:url('<?php echo esc_url($theme_uri . '/assets/images/dongson.png'); ?>')"></div>
  <div class="absolute top-[760px] left-[-180px] w-[480px] h-[480px] opacity-[0.04] pointer-events-none bg-dongson" style="background-image:url('<?php echo esc_url($theme_uri . '/assets/images/dongson.png'); ?>')"></div>

  <div class="max-w-[1500px] mx-auto px-4 lg:px-8 relative z-10 space-y-14">
    <nav aria-label="Breadcrumb" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 flex flex-wrap items-center gap-2">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-brand-red transition-colors"><?php _e('Trang chủ', 'hacoled'); ?></a>
      <span class="text-slate-300">/</span>
      <span class="text-brand-text"><?php _e('HacoLED Journal', 'hacoled'); ?></span>
      <span class="ml-auto hidden md:inline-flex items-center gap-2 rounded-full bg-white/80 border border-slate-200 px-3 py-1 text-slate-500 tracking-wider">
        <span class="w-1.5 h-1.5 rounded-full bg-brand-red animate-pulse"></span>
        <?php echo esc_html($date_label); ?>
      </span>
    </nav>

    <section class="grid grid-cols-1 xl:grid-cols-12 gap-5 items-stretch">
      <article class="xl:col-span-7 relative min-h-[560px] rounded-3xl overflow-hidden border border-brand-gold/25 haco-brand-panel shadow-2xl group">
        <img src="<?php echo esc_url($hero_post['thumbnail']); ?>" alt="<?php echo esc_attr($hero_post['title']); ?>" class="absolute inset-0 w-full h-full object-cover object-center opacity-[0.9] brightness-[0.92] contrast-[1.05] saturate-[1.08] group-hover:scale-[1.025] transition-transform duration-1000">
        <div class="absolute inset-0 bg-gradient-to-r from-[#8A0B10]/92 via-[#B31217]/62 to-black/5"></div>
        <div class="absolute inset-0 haco-brand-grid opacity-45"></div>
        <div class="relative z-10 h-full flex flex-col justify-between p-6 md:p-9 text-white">
          <div class="flex flex-wrap items-center justify-between gap-3">
            <span class="inline-flex items-center gap-2 rounded-full bg-brand-gold text-brand-text px-3.5 py-1.5 text-[10px] font-black uppercase tracking-wider shadow-lg">
              <i class="ph-fill ph-lightning"></i>
              <?php _e('Tiêu điểm tuần này', 'hacoled'); ?>
            </span>
            <button data-news-hero-trigger
                    @click.prevent='activePost = <?php echo $post_json($hero_post); ?>; showDrawer = true'
                    class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-[10px] font-black uppercase tracking-wider text-white backdrop-blur-md hover:bg-white hover:text-brand-red transition-all">
              <i class="ph-bold ph-eye"></i>
              <?php _e('Đọc nhanh', 'hacoled'); ?>
            </button>
          </div>

          <div class="max-w-3xl space-y-5">
            <div class="inline-flex items-center gap-2 rounded-full bg-white/10 border border-white/10 px-3 py-1 text-[10px] font-bold uppercase tracking-widest text-brand-gold">
              <span class="w-1.5 h-1.5 rounded-full bg-brand-gold"></span>
              <?php echo esc_html(wp_strip_all_tags($hero_post['category'])); ?>
            </div>
            <h1 class="text-4xl md:text-6xl xl:text-7xl font-black uppercase tracking-tight leading-[0.94] max-w-4xl">
              <?php _e('Tin tức & Cẩm nang AV Pro', 'hacoled'); ?>
            </h1>
            <div class="w-20 h-1 bg-brand-gold rounded-full"></div>
            <h2 class="text-xl md:text-3xl font-extrabold leading-tight max-w-2xl">
              <a href="<?php echo esc_url($hero_post['permalink']); ?>" class="hover:text-brand-gold transition-colors"><?php echo esc_html($hero_post['title']); ?></a>
            </h2>
            <p class="text-sm md:text-base leading-relaxed text-white/78 max-w-2xl">
              <?php echo esc_html($hero_post['excerpt']); ?>
            </p>
          </div>

          <div class="grid grid-cols-2 md:grid-cols-4 gap-3 pt-6 border-t border-white/12">
            <div>
              <span class="block text-2xl font-black text-brand-gold"><?php echo esc_html($total_sample_posts); ?></span>
              <span class="block text-[9px] uppercase tracking-wider text-white/55 font-bold"><?php _e('bài mẫu', 'hacoled'); ?></span>
            </div>
            <div>
              <span class="block text-2xl font-black text-brand-gold">08</span>
              <span class="block text-[9px] uppercase tracking-wider text-white/55 font-bold"><?php _e('chuyên mục', 'hacoled'); ?></span>
            </div>
            <div>
              <span class="block text-2xl font-black text-brand-gold">24h</span>
              <span class="block text-[9px] uppercase tracking-wider text-white/55 font-bold"><?php _e('biên tập', 'hacoled'); ?></span>
            </div>
            <div>
              <span class="block text-2xl font-black text-brand-gold">AV</span>
              <span class="block text-[9px] uppercase tracking-wider text-white/55 font-bold"><?php _e('pro focus', 'hacoled'); ?></span>
            </div>
          </div>
        </div>
      </article>

      <aside class="xl:col-span-3 grid grid-cols-1 sm:grid-cols-3 xl:grid-cols-1 gap-5">
        <?php foreach ($hero_side as $idx => $post): ?>
          <article class="group relative rounded-3xl overflow-hidden min-h-[178px] border border-slate-200 bg-slate-950 shadow-sm">
            <img src="<?php echo esc_url($post['thumbnail']); ?>" alt="<?php echo esc_attr($post['title']); ?>" class="absolute inset-0 w-full h-full object-cover object-center opacity-[0.92] brightness-[0.96] contrast-[1.04] saturate-[1.08] group-hover:scale-105 transition-transform duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-black/72 via-black/10 to-black/5"></div>
            <div class="relative z-10 h-full p-5 flex flex-col justify-between text-white">
              <div class="flex items-center justify-between gap-2">
                <span class="text-[9px] font-black uppercase tracking-wider text-brand-gold"><?php echo esc_html(wp_strip_all_tags($post['category'])); ?></span>
                <button @click.prevent='activePost = <?php echo $post_json($post); ?>; showDrawer = true' class="h-8 w-8 rounded-full bg-white/15 hover:bg-brand-red flex items-center justify-center transition-all">
                  <i class="ph-bold ph-eye text-xs"></i>
                </button>
              </div>
              <div class="space-y-2">
                <h3 class="text-sm font-extrabold leading-snug line-clamp-2">
                  <a href="<?php echo esc_url($post['permalink']); ?>"><?php echo esc_html($post['title']); ?></a>
                </h3>
                <div class="flex items-center justify-between text-[9px] text-white/58 font-mono">
                  <span><?php echo esc_html($post['date']); ?></span>
                  <span><?php echo esc_html($post['reading_time']); ?></span>
                </div>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </aside>

      <aside class="xl:col-span-2 rounded-3xl border border-slate-200 bg-white/86 shadow-sm p-5 flex flex-col">
        <div class="pb-4 border-b border-slate-100">
          <p class="text-[9px] font-black uppercase tracking-[0.22em] text-brand-red font-mono"><?php _e('Newsroom Radar', 'hacoled'); ?></p>
          <h3 class="text-lg font-black uppercase leading-none mt-1"><?php _e('Đọc nhanh', 'hacoled'); ?></h3>
        </div>
        <div class="divide-y divide-slate-100 flex-1">
          <?php foreach (array_slice($trending_posts, 0, 6) as $idx => $post): ?>
            <div class="py-4 flex gap-3 group">
              <span class="w-8 shrink-0 text-2xl font-black leading-none text-brand-red/15 group-hover:text-brand-red/35 transition-colors font-mono">
                <?php echo esc_html(sprintf('%02d', $idx + 1)); ?>
              </span>
              <div class="space-y-1 min-w-0">
                <h4 class="text-[12px] font-extrabold leading-snug text-brand-text group-hover:text-brand-red transition-colors line-clamp-2">
                  <a href="<?php echo esc_url($post['permalink']); ?>"><?php echo esc_html($post['title']); ?></a>
                </h4>
                <button @click.prevent='activePost = <?php echo $post_json($post); ?>; showDrawer = true' class="text-[9px] uppercase tracking-wider font-black text-brand-muted hover:text-brand-red">
                  <?php _e('Mở tóm tắt', 'hacoled'); ?>
                </button>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </aside>
    </section>

    <section class="rounded-[1.75rem] border border-slate-200/80 bg-white/86 shadow-[0_22px_70px_rgba(15,23,42,0.08)] overflow-hidden">
      <div class="grid grid-cols-1 lg:grid-cols-[0.92fr_2.08fr]">
        <div class="min-h-[260px] md:min-h-[310px] p-5 md:p-7 haco-brand-panel text-white relative overflow-hidden flex flex-col justify-between">
          <div class="absolute inset-0 haco-brand-grid opacity-35"></div>
          <div class="absolute -right-16 bottom-[-56px] w-72 h-72 opacity-[0.13] bg-dongson" style="background-image:url('<?php echo esc_url($theme_uri . '/assets/images/dongson.png'); ?>')"></div>
          <div class="relative z-10">
            <div class="inline-flex items-center gap-2 rounded-full border border-white/16 bg-white/10 px-3 py-1.5 text-[9px] font-black uppercase tracking-[0.2em] text-brand-gold backdrop-blur">
              <i class="ph-fill ph-grid-four text-sm"></i>
              <?php _e('Lịch biên tập mẫu', 'hacoled'); ?>
            </div>
            <h2 class="mt-4 text-[22px] md:text-3xl font-black uppercase tracking-tight leading-none"><?php _e('Theo dõi theo dòng chủ đề', 'hacoled'); ?></h2>
            <p class="mt-3 max-w-sm text-xs md:text-sm text-white/70 leading-relaxed"><?php _e('Các cụm nội dung được sắp lại để người đọc quét nhanh, đi sâu theo nhu cầu và vẫn nhìn thấy đủ năng lực HacoLED.', 'hacoled'); ?></p>
          </div>
          <div class="relative z-10 mt-6 space-y-4">
            <div class="grid grid-cols-3 gap-2">
              <div class="rounded-2xl border border-white/12 bg-white/10 p-3 backdrop-blur">
                <span class="block text-2xl font-black text-brand-gold"><?php echo esc_html(count($section_meta)); ?></span>
                <span class="text-[8px] font-bold uppercase tracking-wider text-white/55"><?php _e('nhóm', 'hacoled'); ?></span>
              </div>
              <div class="rounded-2xl border border-white/12 bg-white/10 p-3 backdrop-blur">
                <span class="block text-2xl font-black text-white"><?php echo esc_html($total_sample_posts); ?></span>
                <span class="text-[8px] font-bold uppercase tracking-wider text-white/55"><?php _e('bài', 'hacoled'); ?></span>
              </div>
              <div class="rounded-2xl border border-white/12 bg-white/10 p-3 backdrop-blur">
                <span class="block text-2xl font-black text-brand-gold">AV</span>
                <span class="text-[8px] font-bold uppercase tracking-wider text-white/55"><?php _e('focus', 'hacoled'); ?></span>
              </div>
            </div>
            <a href="#du-an" class="inline-flex w-full items-center justify-between rounded-2xl border border-white/18 bg-white/12 px-4 py-3 text-[10px] font-black uppercase tracking-wider text-white backdrop-blur transition-all hover:bg-white hover:text-brand-red">
              <span><?php _e('Mở bản đồ nội dung', 'hacoled'); ?></span>
              <i class="ph-bold ph-arrow-down text-lg"></i>
            </a>
          </div>
        </div>
        <div class="p-3 md:p-5 grid grid-cols-2 xl:grid-cols-4 gap-2.5 md:gap-3">
          <?php foreach ($section_meta as $key => $meta): ?>
            <?php $section_count = count($sections[$key] ?? []); ?>
            <a href="#<?php echo esc_attr($meta['anchor']); ?>" class="group relative min-h-[128px] md:min-h-[190px] overflow-hidden rounded-2xl border border-slate-200 bg-white p-3 md:p-4 transition-all duration-300 hover:-translate-y-0.5 hover:border-brand-red/35 hover:shadow-[0_18px_42px_rgba(179,18,23,0.12)]">
              <div class="pointer-events-none absolute -right-10 -top-10 h-24 w-24 rounded-full bg-brand-red/6 blur-2xl transition-opacity group-hover:opacity-100"></div>
              <div class="relative z-10 flex items-start justify-between gap-3">
                <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-brand-red text-white shadow-[0_10px_22px_rgba(179,18,23,0.16)] transition-all duration-300 group-hover:-translate-y-0.5 group-hover:shadow-[0_14px_28px_rgba(179,18,23,0.22)] md:h-11 md:w-11">
                  <i class="<?php echo esc_attr($meta['icon']); ?> text-lg md:text-xl"></i>
                </span>
                <span class="inline-flex items-center gap-1 rounded-full bg-slate-50 px-2 py-1 text-[9px] md:text-[10px] font-black text-slate-500 ring-1 ring-slate-200">
                  <span class="font-mono text-brand-red"><?php echo esc_html(str_pad((string) $section_count, 2, '0', STR_PAD_LEFT)); ?></span>
                  <?php _e('bài', 'hacoled'); ?>
                </span>
              </div>
              <div class="relative z-10 mt-3 md:mt-4">
                <p class="text-xs md:text-sm font-black uppercase tracking-tight text-brand-text leading-tight transition-colors group-hover:text-brand-red"><?php echo esc_html($meta['short']); ?></p>
                <p class="mt-2 hidden md:line-clamp-2 text-[11px] leading-relaxed text-brand-muted"><?php echo esc_html($meta['desc']); ?></p>
              </div>
              <div class="relative z-10 mt-3 md:mt-4 flex items-center justify-between border-t border-slate-100 pt-2.5 md:pt-3">
                <span class="hidden md:inline text-[9px] font-black uppercase tracking-wider text-slate-400"><?php echo esc_html($meta['label']); ?></span>
                <span class="inline-flex h-7 w-7 md:h-8 md:w-8 items-center justify-center rounded-full border border-slate-200 text-slate-400 transition-all group-hover:border-brand-red group-hover:bg-brand-red group-hover:text-white">
                  <i class="ph-bold ph-arrow-down text-xs"></i>
                </span>
              </div>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section id="du-an" class="space-y-5 scroll-mt-28">
      <?php $render_section_header('projects', $section_meta['projects'], __('Case studies', 'hacoled')); ?>
      <?php $project_posts = $collect_posts(['projects'], 6); $featured_project = $project_posts[0] ?? $first_post('projects'); ?>
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
        <article class="lg:col-span-7 relative min-h-[330px] sm:min-h-[390px] lg:min-h-[430px] rounded-3xl overflow-hidden border border-slate-200 bg-slate-950 group shadow-sm">
          <img src="<?php echo esc_url($featured_project['thumbnail']); ?>" alt="<?php echo esc_attr($featured_project['title']); ?>" class="absolute inset-0 w-full h-full object-cover object-center opacity-[0.94] brightness-[0.95] contrast-[1.04] saturate-[1.08] group-hover:scale-[1.03] transition-transform duration-1000">
          <div class="absolute inset-0 bg-gradient-to-t from-black/78 via-black/16 to-black/5"></div>
          <div class="relative z-10 h-full p-5 md:p-8 flex flex-col justify-end text-white space-y-3 md:space-y-4">
            <span class="w-max rounded-full bg-emerald-500 text-white px-3 py-1 text-[9px] font-black uppercase tracking-wider"><?php _e('Đã bàn giao', 'hacoled'); ?></span>
            <h3 class="text-[22px] sm:text-2xl md:text-4xl font-black leading-tight max-w-3xl">
              <a href="<?php echo esc_url($featured_project['permalink']); ?>"><?php echo esc_html($featured_project['title']); ?></a>
            </h3>
            <p class="text-xs md:text-sm text-white/72 leading-relaxed max-w-2xl line-clamp-2 md:line-clamp-3"><?php echo esc_html($featured_project['excerpt']); ?></p>
            <div class="flex flex-wrap items-center gap-3 text-[10px] font-mono text-white/60">
              <span><?php echo esc_html($featured_project['date']); ?></span>
              <span class="text-white/24">/</span>
              <span><?php echo esc_html($featured_project['author']); ?></span>
              <button @click.prevent='activePost = <?php echo $post_json($featured_project); ?>; showDrawer = true' class="ml-auto rounded-full bg-white text-brand-red px-4 py-2 font-black uppercase tracking-wider hover:bg-brand-gold hover:text-brand-text transition-all">
                <?php _e('Xem nhanh', 'hacoled'); ?>
              </button>
            </div>
          </div>
        </article>
        <div class="lg:col-span-5 space-y-3">
          <?php foreach (array_slice($project_posts, 1, 3) as $idx => $post): ?>
            <?php $render_compact_story_item($post, $idx + 1); ?>
          <?php endforeach; ?>
          <div class="hidden sm:block rounded-2xl border border-brand-red/15 bg-brand-red/5 p-4">
            <p class="text-[9px] font-black uppercase tracking-[0.2em] text-brand-red"><?php _e('Dự án tiêu biểu', 'hacoled'); ?></p>
            <div class="mt-3 grid grid-cols-3 gap-2 text-center">
              <div class="rounded-xl bg-white/80 p-3"><span class="block text-lg font-black text-brand-red"><?php echo esc_html(count($sections['projects'] ?? [])); ?></span><span class="text-[8px] font-bold uppercase text-slate-400"><?php _e('hồ sơ', 'hacoled'); ?></span></div>
              <div class="rounded-xl bg-white/80 p-3"><span class="block text-lg font-black text-brand-text">AV</span><span class="text-[8px] font-bold uppercase text-slate-400"><?php _e('pro', 'hacoled'); ?></span></div>
              <div class="rounded-xl bg-white/80 p-3"><span class="block text-lg font-black text-brand-gold">24h</span><span class="text-[8px] font-bold uppercase text-slate-400"><?php _e('tư vấn', 'hacoled'); ?></span></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="kinh-nghiem" class="grid grid-cols-1 xl:grid-cols-12 gap-5 items-start scroll-mt-28">
      <div class="xl:col-span-8 space-y-5">
        <?php $render_section_header('news', $section_meta['news'], __('Buying guide', 'hacoled')); ?>
        <div class="grid grid-cols-1 gap-3 md:hidden">
          <?php foreach (array_slice($knowledge_posts, 0, 3) as $idx => $post): ?>
            <?php $render_compact_story_item($post, $idx + 1); ?>
          <?php endforeach; ?>
          <div class="rounded-2xl haco-brand-panel p-4 text-white shadow-lg">
            <div class="flex items-center justify-between gap-4">
              <div class="min-w-0">
                <p class="text-[9px] font-black uppercase tracking-wider text-brand-gold"><?php _e('Tư vấn nhanh', 'hacoled'); ?></p>
                <h3 class="mt-1 text-sm font-black uppercase leading-tight"><?php _e('Cần chọn cấu hình LED hoặc âm thanh?', 'hacoled'); ?></h3>
              </div>
              <a href="tel:0342324488" class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-brand-gold text-brand-text">
                <i class="ph-fill ph-phone-call"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="hidden md:grid md:grid-cols-3 gap-5 items-start">
          <?php foreach (array_slice($knowledge_posts, 0, 3) as $post): ?>
            <?php $render_story_card($post); ?>
          <?php endforeach; ?>
        </div>
      </div>
      <aside class="hidden xl:block xl:col-span-4 space-y-4 xl:self-start">
        <div class="rounded-3xl haco-brand-panel text-white border border-brand-gold/20 p-5 md:p-6 shadow-xl relative overflow-hidden">
          <div class="absolute right-[-60px] top-[-60px] w-44 h-44 opacity-[0.08] bg-dongson" style="background-image:url('<?php echo esc_url($theme_uri . '/assets/images/dongson.png'); ?>')"></div>
          <div class="relative z-10 space-y-4">
            <span class="inline-flex items-center gap-2 rounded-full bg-brand-gold text-brand-text px-3 py-1 text-[9px] font-black uppercase tracking-wider">
              <i class="ph-fill ph-paper-plane-tilt"></i>
              <?php _e('Tư vấn nhanh', 'hacoled'); ?>
            </span>
            <h3 class="text-2xl font-black uppercase tracking-tight leading-tight"><?php _e('Cần chọn cấu hình LED hoặc âm thanh?', 'hacoled'); ?></h3>
            <p class="text-xs leading-relaxed text-white/64"><?php _e('Để lại thông tin, đội kỹ thuật sẽ gợi ý pixel pitch, kích thước, công suất và phương án thi công phù hợp ngân sách.', 'hacoled'); ?></p>
            <form action="#" class="space-y-3" @submit.prevent="alert('Cảm ơn bạn! Đội kỹ thuật HacoLED sẽ liên hệ tư vấn.')">
              <input type="text" required placeholder="<?php esc_attr_e('Tên của bạn', 'hacoled'); ?>" class="w-full rounded-xl border border-white/10 bg-white/10 px-4 py-3 text-xs text-white placeholder-white/40 focus:outline-none focus:border-brand-gold">
              <input type="tel" required placeholder="<?php esc_attr_e('Số điện thoại', 'hacoled'); ?>" class="w-full rounded-xl border border-white/10 bg-white/10 px-4 py-3 text-xs text-white placeholder-white/40 focus:outline-none focus:border-brand-gold">
              <button class="w-full rounded-xl bg-brand-gold px-4 py-3 text-[11px] font-black uppercase tracking-wider text-brand-text hover:bg-yellow-400 transition-colors">
                <?php _e('Nhận tư vấn cấu hình', 'hacoled'); ?>
              </button>
            </form>
          </div>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white/85 p-5 shadow-sm">
          <p class="text-[9px] font-black uppercase tracking-[0.22em] text-brand-red font-mono"><?php _e('Checklist biên tập', 'hacoled'); ?></p>
          <ul class="mt-4 space-y-3 text-xs text-brand-muted">
            <li class="flex gap-3"><i class="ph-fill ph-check-circle text-brand-red text-base"></i><span><?php _e('Tình huống sử dụng: hội trường, showroom, quảng cáo, sự kiện.', 'hacoled'); ?></span></li>
            <li class="flex gap-3"><i class="ph-fill ph-check-circle text-brand-red text-base"></i><span><?php _e('Thông số cần cân nhắc: pitch, độ sáng, refresh rate, khoảng nhìn.', 'hacoled'); ?></span></li>
            <li class="flex gap-3"><i class="ph-fill ph-check-circle text-brand-red text-base"></i><span><?php _e('Bóc tách chi phí: thiết bị, khung kết cấu, điện, vận chuyển, bảo trì.', 'hacoled'); ?></span></li>
          </ul>
        </div>
      </aside>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-2 gap-5">
      <?php foreach (['led', 'audio'] as $key): ?>
        <?php $posts = $collect_posts([$key], 5); $featured = $posts[0] ?? $first_post($key); ?>
        <div id="<?php echo esc_attr($section_meta[$key]['anchor']); ?>" class="space-y-4 md:space-y-6 scroll-mt-28">
          <?php $render_section_header($key, $section_meta[$key], $key === 'led' ? __('Display lab', 'hacoled') : __('Sound lab', 'hacoled')); ?>
          <div class="rounded-3xl border border-slate-200 bg-white/85 shadow-sm overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-5">
              <div class="md:col-span-3 relative min-h-[210px] md:min-h-[280px] bg-slate-950 overflow-hidden">
                <img src="<?php echo esc_url($featured['thumbnail']); ?>" alt="<?php echo esc_attr($featured['title']); ?>" class="absolute inset-0 w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                <button @click.prevent='activePost = <?php echo $post_json($featured); ?>; showDrawer = true' class="absolute top-4 right-4 h-10 w-10 rounded-xl bg-white/95 text-brand-text hover:bg-brand-red hover:text-white transition-all shadow-md">
                  <i class="ph-bold ph-eye"></i>
                </button>
              </div>
              <div class="md:col-span-2 p-4 md:p-5 flex flex-col justify-between gap-4 md:gap-5">
                <div class="space-y-2 md:space-y-3">
                  <span class="text-[9px] font-black uppercase tracking-wider text-brand-red"><?php echo esc_html(wp_strip_all_tags($featured['category'])); ?></span>
                  <h3 class="text-base md:text-lg font-black leading-tight text-brand-text hover:text-brand-red transition-colors">
                    <a href="<?php echo esc_url($featured['permalink']); ?>"><?php echo esc_html($featured['title']); ?></a>
                  </h3>
                  <p class="text-xs leading-relaxed text-brand-muted line-clamp-2 md:line-clamp-4"><?php echo esc_html($featured['excerpt']); ?></p>
                </div>
                <div class="flex items-center justify-between text-[10px] text-slate-400 font-mono border-t border-slate-100 pt-3">
                  <span><?php echo esc_html($featured['date']); ?></span>
                  <span><?php echo esc_html($featured['reading_time']); ?></span>
                </div>
              </div>
            </div>
            <div class="divide-y divide-slate-100">
              <?php foreach (array_slice($posts, 1, 4) as $idx => $post): ?>
                <div class="<?php echo esc_attr($idx >= 2 ? 'hidden sm:flex' : 'flex'); ?> p-3 md:p-4 items-center gap-3 md:gap-4 hover:bg-slate-50/80 transition-colors group">
                  <img src="<?php echo esc_url($post['thumbnail']); ?>" alt="<?php echo esc_attr($post['title']); ?>" class="w-16 h-12 md:w-20 md:h-16 rounded-xl object-cover bg-slate-100 shrink-0">
                  <div class="min-w-0 flex-1">
                    <h4 class="text-xs font-extrabold leading-snug line-clamp-2 text-brand-text group-hover:text-brand-red transition-colors">
                      <a href="<?php echo esc_url($post['permalink']); ?>"><?php echo esc_html($post['title']); ?></a>
                    </h4>
                    <p class="text-[9px] text-slate-400 font-mono mt-1"><?php echo esc_html($post['date']); ?> / <?php echo esc_html($post['reading_time']); ?></p>
                  </div>
                  <button @click.prevent='activePost = <?php echo $post_json($post); ?>; showDrawer = true' class="h-8 w-8 rounded-full border border-slate-200 text-slate-400 hover:text-white hover:bg-brand-red hover:border-brand-red transition-all shrink-0">
                    <i class="ph-bold ph-arrow-right text-xs"></i>
                  </button>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </section>

    <section id="ky-thuat" class="space-y-7 scroll-mt-28">
      <?php $render_section_header('tech', $section_meta['tech'], __('Operation notes', 'hacoled')); ?>
      <?php $tech_posts = $collect_posts(['tech'], 6); ?>
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
        <div class="lg:col-span-8">
          <div class="grid grid-cols-1 gap-3 sm:hidden">
            <?php foreach (array_slice($tech_posts, 0, 3) as $idx => $post): ?>
              <?php $render_compact_story_item($post, $idx + 1); ?>
            <?php endforeach; ?>
          </div>
          <div class="hidden sm:grid sm:grid-cols-2 gap-5 items-start">
            <?php foreach (array_slice($tech_posts, 0, 2) as $post): ?>
              <?php $render_story_card($post); ?>
            <?php endforeach; ?>
          </div>
        </div>
        <aside class="hidden sm:block lg:col-span-4 lg:self-start lg:sticky lg:top-28 rounded-3xl border border-slate-200 bg-white/85 shadow-sm p-6 space-y-5">
          <div>
            <p class="text-[9px] font-black uppercase tracking-[0.22em] text-brand-red font-mono"><?php _e('Bản tin kỹ thuật', 'hacoled'); ?></p>
            <h3 class="mt-2 text-2xl font-black uppercase tracking-tight"><?php _e('Thông số cần nhớ', 'hacoled'); ?></h3>
          </div>
          <div class="grid grid-cols-2 gap-3">
            <div class="rounded-2xl bg-brand-red/10 border border-brand-red/15 p-4">
              <span class="text-2xl font-black text-brand-red">P2</span>
              <p class="text-[10px] uppercase tracking-wider text-brand-muted font-bold mt-1"><?php _e('hội trường', 'hacoled'); ?></p>
            </div>
            <div class="rounded-2xl bg-brand-lightGold/70 border border-brand-gold/15 p-4">
              <span class="text-2xl font-black text-brand-gold">3840Hz</span>
              <p class="text-[10px] uppercase tracking-wider text-brand-muted font-bold mt-1"><?php _e('refresh', 'hacoled'); ?></p>
            </div>
            <div class="rounded-2xl bg-white border border-slate-200 p-4">
              <span class="text-2xl font-black text-brand-text">IP65</span>
              <p class="text-[10px] uppercase tracking-wider text-brand-muted font-bold mt-1"><?php _e('ngoài trời', 'hacoled'); ?></p>
            </div>
            <div class="rounded-2xl bg-white border border-slate-200 p-4">
              <span class="text-2xl font-black text-brand-text">2h</span>
              <p class="text-[10px] uppercase tracking-wider text-brand-muted font-bold mt-1"><?php _e('phản hồi', 'hacoled'); ?></p>
            </div>
          </div>
          <a href="tel:0342324488" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-brand-red px-4 py-3 text-[11px] font-black uppercase tracking-wider text-white hover:bg-brand-text transition-colors">
            <i class="ph-fill ph-phone-call"></i>
            Hotline 034.232.4488
          </a>
          <div class="rounded-2xl border border-slate-200 bg-slate-50/80 p-4">
            <p class="text-[9px] font-black uppercase tracking-wider text-brand-red"><?php _e('Quy trình đọc nhanh', 'hacoled'); ?></p>
            <div class="mt-3 space-y-2 text-[11px] font-semibold leading-relaxed text-brand-muted">
              <div class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-brand-red"></span><?php _e('Xác định lỗi hoặc mục tiêu vận hành.', 'hacoled'); ?></div>
              <div class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-brand-gold"></span><?php _e('Đối chiếu thông số thiết bị thực tế.', 'hacoled'); ?></div>
              <div class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-brand-red"></span><?php _e('Chốt checklist nghiệm thu/bảo trì.', 'hacoled'); ?></div>
            </div>
          </div>
        </aside>
      </div>
    </section>

    <section id="bao-chi" class="space-y-7 scroll-mt-28">
      <?php $render_section_header('press', $section_meta['press'], __('Media wall', 'hacoled')); ?>
      <div class="grid grid-cols-1 gap-3 md:hidden">
        <?php foreach (array_slice($press_event_posts, 0, 4) as $idx => $post): ?>
          <?php $render_compact_story_item($post, $idx + 1); ?>
        <?php endforeach; ?>
      </div>
      <div class="hidden md:grid md:grid-cols-2 xl:grid-cols-4 gap-5">
        <?php foreach (array_slice($press_event_posts, 0, 4) as $post): ?>
          <?php $render_story_card($post, 'compact'); ?>
        <?php endforeach; ?>
      </div>
    </section>

    <?php $event_posts = array_slice($collect_posts(['events'], 5), 0, 5); $featured_event = $event_posts[0] ?? $first_post('events'); ?>
    <section id="su-kien" class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-stretch scroll-mt-28">
      <div class="lg:col-span-5 min-h-[360px] lg:min-h-0 lg:h-full rounded-3xl haco-brand-panel text-white p-5 md:p-8 relative overflow-hidden border border-brand-gold/20 flex flex-col">
        <img src="<?php echo esc_url($featured_event['thumbnail']); ?>" alt="<?php echo esc_attr($featured_event['title']); ?>" class="absolute inset-0 h-full w-full object-cover object-center opacity-[0.24] brightness-[0.8] saturate-[1.1]">
        <div class="absolute inset-0 bg-gradient-to-br from-[#8A0B10]/84 via-[#B31217]/64 to-[#E60000]/42"></div>
        <div class="absolute right-[-24px] bottom-[-42px] w-64 h-64 opacity-[0.12] bg-dongson" style="background-image:url('<?php echo esc_url($theme_uri . '/assets/images/dongson.png'); ?>')"></div>
        <div class="relative z-10 space-y-4">
          <span class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-wider text-brand-gold">
            <i class="ph-fill ph-calendar-event"></i>
            <?php _e('Nhật ký HacoLED', 'hacoled'); ?>
          </span>
          <h2 class="text-xl md:text-3xl font-black uppercase tracking-tight leading-none"><?php _e('Sự kiện, đào tạo và văn hóa đội ngũ', 'hacoled'); ?></h2>
          <p class="text-xs md:text-sm leading-relaxed text-white/72 max-w-md"><?php echo esc_html($section_meta['events']['desc']); ?></p>
        </div>
        <div class="relative z-10 mt-5 border-y border-white/14 py-4 md:py-5">
          <div class="flex items-start gap-3">
            <img src="<?php echo esc_url($featured_event['thumbnail']); ?>" alt="<?php echo esc_attr($featured_event['title']); ?>" class="h-20 w-24 shrink-0 rounded-2xl object-cover ring-1 ring-white/18 md:h-24 md:w-28">
            <div class="min-w-0">
              <p class="text-[9px] font-black uppercase tracking-wider text-brand-gold"><?php _e('Spotlight', 'hacoled'); ?> / <?php echo esc_html($featured_event['date']); ?></p>
              <h3 class="mt-1.5 text-sm md:text-base font-black leading-tight line-clamp-2">
                <a href="<?php echo esc_url($featured_event['permalink']); ?>" class="hover:text-brand-gold transition-colors"><?php echo esc_html($featured_event['title']); ?></a>
              </h3>
              <p class="mt-2 text-[11px] md:text-xs leading-relaxed text-white/68 line-clamp-2"><?php echo esc_html($featured_event['excerpt']); ?></p>
            </div>
          </div>
          <button @click.prevent='activePost = <?php echo $post_json($featured_event); ?>; showDrawer = true'
                  class="mt-4 inline-flex items-center gap-2 rounded-full border border-white/18 bg-white/10 px-4 py-2 text-[10px] font-black uppercase tracking-wider text-white backdrop-blur transition-all hover:bg-white hover:text-brand-red">
            <i class="ph-bold ph-eye"></i>
            <?php _e('Xem nhanh sự kiện', 'hacoled'); ?>
          </button>
        </div>
        <div class="relative z-10 mt-auto pt-5">
          <div class="hidden sm:grid grid-cols-3 gap-2">
            <div class="rounded-2xl border border-white/10 bg-white/10 p-3 backdrop-blur"><span class="block text-xl font-black text-brand-gold"><?php echo esc_html(count($sections['events'] ?? [])); ?></span><span class="text-[8px] font-bold uppercase text-white/55"><?php _e('tin', 'hacoled'); ?></span></div>
            <div class="rounded-2xl border border-white/10 bg-white/10 p-3 backdrop-blur"><span class="block text-xl font-black text-white">AV</span><span class="text-[8px] font-bold uppercase text-white/55"><?php _e('team', 'hacoled'); ?></span></div>
            <div class="rounded-2xl border border-white/10 bg-white/10 p-3 backdrop-blur"><span class="block text-xl font-black text-brand-gold">Q&A</span><span class="text-[8px] font-bold uppercase text-white/55"><?php _e('đào tạo', 'hacoled'); ?></span></div>
          </div>
          <div class="mt-4 flex flex-wrap items-center justify-between gap-3 text-[10px] font-black uppercase tracking-wider text-white/62">
            <span><?php _e('Đào tạo nội bộ', 'hacoled'); ?></span>
            <span class="text-brand-gold"><?php _e('Cập nhật theo tháng', 'hacoled'); ?></span>
          </div>
        </div>
      </div>
      <div class="lg:col-span-7 rounded-3xl border border-slate-200 bg-white/85 shadow-sm overflow-hidden divide-y divide-slate-100">
        <?php foreach ($event_posts as $idx => $post): ?>
          <div class="<?php echo esc_attr($idx >= 3 ? 'hidden sm:flex' : 'flex'); ?> p-4 md:p-5 items-center gap-4 group hover:bg-slate-50 transition-colors">
            <img src="<?php echo esc_url($post['thumbnail']); ?>" alt="<?php echo esc_attr($post['title']); ?>" class="w-24 h-20 rounded-2xl object-cover bg-slate-100 shrink-0">
            <div class="flex-1 min-w-0">
              <p class="text-[9px] font-black uppercase tracking-wider text-brand-red"><?php echo esc_html($post['date']); ?></p>
              <h3 class="text-sm md:text-base font-black leading-snug line-clamp-2 group-hover:text-brand-red transition-colors">
                <a href="<?php echo esc_url($post['permalink']); ?>"><?php echo esc_html($post['title']); ?></a>
              </h3>
              <p class="text-[11px] text-brand-muted line-clamp-1 mt-1"><?php echo esc_html($post['excerpt']); ?></p>
            </div>
            <button @click.prevent='activePost = <?php echo $post_json($post); ?>; showDrawer = true' class="hidden sm:inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 text-slate-400 hover:bg-brand-red hover:text-white hover:border-brand-red transition-all">
              <i class="ph-bold ph-eye text-xs"></i>
            </button>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <section id="tuyen-dung" class="space-y-7 scroll-mt-28">
      <?php $render_section_header('jobs', $section_meta['jobs'], __('Career board', 'hacoled')); ?>
      <div class="rounded-3xl border border-slate-200 bg-white/85 shadow-sm overflow-hidden divide-y divide-slate-100">
        <?php foreach (array_slice($collect_posts(['jobs'], 5), 0, 5) as $post): ?>
          <div class="p-5 flex flex-col md:flex-row md:items-center justify-between gap-4 group hover:bg-slate-50 transition-colors">
            <div class="min-w-0 space-y-2">
              <div class="flex flex-wrap items-center gap-2">
                <span class="rounded-full bg-brand-red/10 border border-brand-red/15 px-2.5 py-1 text-[9px] font-black uppercase tracking-wider text-brand-red"><?php _e('Đang tuyển', 'hacoled'); ?></span>
                <span class="text-[10px] text-slate-400 font-mono"><?php echo esc_html($post['date']); ?></span>
              </div>
              <h3 class="text-sm md:text-lg font-black leading-snug text-brand-text group-hover:text-brand-red transition-colors">
                <a href="<?php echo esc_url($post['permalink']); ?>"><?php echo esc_html($post['title']); ?></a>
              </h3>
              <p class="text-xs text-brand-muted leading-relaxed line-clamp-1"><?php echo esc_html($post['excerpt']); ?></p>
            </div>
            <div class="flex items-center gap-3 shrink-0">
              <button @click.prevent='activePost = <?php echo $post_json($post); ?>; showDrawer = true' class="rounded-xl border border-slate-200 px-4 py-2.5 text-[10px] font-black uppercase tracking-wider text-brand-text hover:border-brand-red hover:text-brand-red transition-all">
                <?php _e('Xem nhanh', 'hacoled'); ?>
              </button>
              <a href="<?php echo esc_url($post['permalink']); ?>" class="rounded-xl bg-brand-red px-4 py-2.5 text-[10px] font-black uppercase tracking-wider text-white hover:bg-brand-text transition-all">
                <?php _e('Ứng tuyển', 'hacoled'); ?>
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="rounded-3xl bg-white/85 border border-slate-200 p-4 md:p-5 shadow-sm">
      <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-3">
        <?php foreach (array_slice($visual_wall, 0, 6) as $post): ?>
          <button @click.prevent='activePost = <?php echo $post_json($post); ?>; showDrawer = true' class="group relative aspect-square rounded-2xl overflow-hidden bg-slate-950 text-left">
            <img src="<?php echo esc_url($post['thumbnail']); ?>" alt="<?php echo esc_attr($post['title']); ?>" class="absolute inset-0 w-full h-full object-cover opacity-[0.85] group-hover:scale-110 transition-transform duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-black/78 via-black/10 to-transparent"></div>
            <span class="absolute left-3 right-3 bottom-3 text-[10px] font-black leading-snug text-white line-clamp-2"><?php echo esc_html($post['title']); ?></span>
          </button>
        <?php endforeach; ?>
      </div>
    </section>
  </div>

  <div x-show="showDrawer"
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="opacity-0"
       x-transition:enter-end="opacity-100"
       x-transition:leave="transition ease-in duration-200"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0"
       @click="showDrawer = false"
       class="fixed inset-0 z-[1000] bg-slate-950/65 backdrop-blur-sm"
       x-cloak></div>

  <aside x-show="showDrawer"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         class="fixed right-0 top-0 bottom-0 z-[1001] w-full sm:w-[500px] bg-white shadow-2xl border-l border-slate-200 flex flex-col overflow-y-auto"
         x-cloak>
    <div class="p-6 md:p-8 space-y-6 flex-1">
      <div class="flex items-center justify-between gap-4 pb-4 border-b border-slate-100">
        <span class="text-[9px] font-black uppercase tracking-[0.22em] text-brand-red font-mono" x-text="activePost ? activePost.category : ''"></span>
        <button @click="showDrawer = false" class="h-9 w-9 rounded-full border border-slate-200 bg-slate-50 text-brand-text hover:bg-brand-red hover:text-white hover:border-brand-red transition-all">
          <i class="ph-bold ph-x text-xs"></i>
        </button>
      </div>
      <template x-if="activePost">
        <div class="space-y-6">
          <h3 class="text-2xl md:text-3xl font-black tracking-tight leading-tight text-brand-text" x-text="activePost.title"></h3>
          <div class="flex flex-wrap items-center gap-3 text-[10px] text-brand-muted font-mono">
            <span class="inline-flex items-center gap-1"><i class="ph-bold ph-calendar-blank text-brand-red"></i><span x-text="activePost.date"></span></span>
            <span class="text-slate-300">/</span>
            <span class="inline-flex items-center gap-1"><i class="ph-bold ph-user text-brand-red"></i><span x-text="activePost.author"></span></span>
            <span class="inline-flex items-center gap-1 rounded-full bg-brand-lightGold/70 border border-brand-gold/20 px-2.5 py-1 text-brand-gold"><i class="ph-bold ph-clock"></i><span x-text="activePost.reading_time"></span></span>
          </div>
          <div class="aspect-[16/10] rounded-3xl overflow-hidden border border-slate-200 bg-slate-100 shadow-sm">
            <img :src="activePost.thumbnail" alt="" class="w-full h-full object-cover">
          </div>
          <div class="rounded-3xl bg-slate-50 border border-slate-200 p-5 space-y-3">
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-brand-red font-mono"><?php _e('Tóm tắt biên tập', 'hacoled'); ?></p>
            <p class="text-sm leading-relaxed text-brand-muted italic" x-text="activePost.excerpt"></p>
          </div>
          <div class="grid grid-cols-3 gap-3">
            <div class="rounded-2xl border border-slate-200 p-3">
              <span class="block text-lg font-black text-brand-red">01</span>
              <span class="block text-[9px] uppercase tracking-wider text-slate-400 font-bold"><?php _e('vấn đề', 'hacoled'); ?></span>
            </div>
            <div class="rounded-2xl border border-slate-200 p-3">
              <span class="block text-lg font-black text-brand-red">02</span>
              <span class="block text-[9px] uppercase tracking-wider text-slate-400 font-bold"><?php _e('giải pháp', 'hacoled'); ?></span>
            </div>
            <div class="rounded-2xl border border-slate-200 p-3">
              <span class="block text-lg font-black text-brand-red">03</span>
              <span class="block text-[9px] uppercase tracking-wider text-slate-400 font-bold"><?php _e('liên hệ', 'hacoled'); ?></span>
            </div>
          </div>
        </div>
      </template>
    </div>
    <div class="p-6 md:p-8 pt-0 space-y-3 border-t border-slate-100 bg-white">
      <a :href="activePost ? activePost.permalink : '#'" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-brand-red px-4 py-3.5 text-xs font-black uppercase tracking-wider text-white hover:bg-brand-text transition-colors">
        <?php _e('Xem toàn bộ bài viết', 'hacoled'); ?>
        <i class="ph-bold ph-arrow-right text-[10px]"></i>
      </a>
      <a href="tel:0342324488" class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-[11px] font-black uppercase tracking-wider text-brand-text hover:border-brand-red hover:text-brand-red transition-colors">
        <i class="ph-fill ph-phone-call text-brand-red"></i>
        Hotline: 034.232.4488
      </a>
    </div>
  </aside>
</main>

<?php $this->renderFooter($footer_type ?? 'default'); ?>
