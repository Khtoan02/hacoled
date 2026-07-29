<?php
/**
 * HacoLED Journal - structured news and knowledge hub.
 *
 * @var array  $page
 * @var array  $sections Keys: led, audio, tech, projects, press, news, events, jobs
 * @var array  $categories_slugs
 * @var string $header_type
 * @var string $footer_type
 */

$this->renderHeader($header_type ?? 'default');

$section_keys = ['projects', 'led', 'audio', 'tech', 'news', 'press', 'events', 'jobs'];
$sections = wp_parse_args($sections ?? [], array_fill_keys($section_keys, []));

$section_meta = [
    'projects' => [
        'label' => __('Dự án bàn giao', 'hacoled'),
        'short' => __('Dự án', 'hacoled'),
        'icon' => 'ph-fill ph-folder-open',
        'anchor' => 'du-an',
        'desc' => __('Công trình thực tế, phương án triển khai và năng lực thi công của HacoLED.', 'hacoled'),
        'tone' => 'gold',
    ],
    'led' => [
        'label' => __('Màn hình LED', 'hacoled'),
        'short' => __('Màn hình LED', 'hacoled'),
        'icon' => 'ph-fill ph-monitor',
        'anchor' => 'man-hinh-led',
        'desc' => __('Kiến thức về pixel pitch, module, cabinet và cách vận hành màn hình LED.', 'hacoled'),
        'tone' => 'red',
    ],
    'audio' => [
        'label' => __('Âm thanh hội trường', 'hacoled'),
        'short' => __('Âm thanh', 'hacoled'),
        'icon' => 'ph-fill ph-speaker-high',
        'anchor' => 'am-thanh',
        'desc' => __('Giải pháp loa, micro, mixer, âm học và hệ thống hội nghị chuyên nghiệp.', 'hacoled'),
        'tone' => 'gold',
    ],
    'tech' => [
        'label' => __('Kỹ thuật vận hành', 'hacoled'),
        'short' => __('Kỹ thuật', 'hacoled'),
        'icon' => 'ph-fill ph-wrench',
        'anchor' => 'ky-thuat',
        'desc' => __('Hướng dẫn cấu hình, xử lý sự cố và checklist nghiệm thu thiết bị AV.', 'hacoled'),
        'tone' => 'red',
    ],
    'news' => [
        'label' => __('Kinh nghiệm chọn giải pháp', 'hacoled'),
        'short' => __('Kinh nghiệm', 'hacoled'),
        'icon' => 'ph-fill ph-lightbulb',
        'anchor' => 'kinh-nghiem',
        'desc' => __('Góc nhìn dễ hiểu về chi phí, hiệu quả, độ bền và phương án đầu tư.', 'hacoled'),
        'tone' => 'gold',
    ],
    'press' => [
        'label' => __('Báo chí nói về HacoLED', 'hacoled'),
        'short' => __('Báo chí', 'hacoled'),
        'icon' => 'ph-fill ph-newspaper',
        'anchor' => 'bao-chi',
        'desc' => __('Bài viết, phóng sự và đánh giá truyền thông về thương hiệu HacoLED.', 'hacoled'),
        'tone' => 'red',
    ],
    'events' => [
        'label' => __('Sự kiện & hoạt động', 'hacoled'),
        'short' => __('Sự kiện', 'hacoled'),
        'icon' => 'ph-fill ph-calendar-blank',
        'anchor' => 'su-kien',
        'desc' => __('Hoạt động đội ngũ, đào tạo kỹ thuật, hội thảo và dấu mốc phát triển.', 'hacoled'),
        'tone' => 'gold',
    ],
    'jobs' => [
        'label' => __('Cơ hội nghề nghiệp', 'hacoled'),
        'short' => __('Tuyển dụng', 'hacoled'),
        'icon' => 'ph-fill ph-users-three',
        'anchor' => 'tuyen-dung',
        'desc' => __('Cơ hội dành cho đội ngũ kinh doanh, kỹ thuật, nội dung và vận hành dự án.', 'hacoled'),
        'tone' => 'red',
    ],
];

$normalize_post = static function ($post) {
    return wp_parse_args($post ?? [], [
        'id' => 0,
        'title' => __('Bản tin HacoLED đang cập nhật', 'hacoled'),
        'excerpt' => __('Nội dung đang được Ban biên tập HacoLED hoàn thiện.', 'hacoled'),
        'permalink' => '#',
        'date' => date_i18n('d/m/Y'),
        'author' => __('Ban biên tập', 'hacoled'),
        'category' => __('HacoLED Journal', 'hacoled'),
        'thumbnail' => get_template_directory_uri() . '/assets/images/home-solution-led.webp',
        'thumbnail_alt' => '',
        'thumbnail_srcset' => '',
        'reading_time' => __('4 phút đọc', 'hacoled'),
    ]);
};

$collect_posts = static function ($keys, $limit = 8) use (&$sections, $normalize_post) {
    $items = [];
    $seen = [];

    foreach ((array) $keys as $key) {
        foreach (($sections[$key] ?? []) as $post) {
            $post = $normalize_post($post);
            $identity = (string) ($post['id'] ?: md5($post['title'] . $post['permalink']));
            if (isset($seen[$identity])) {
                continue;
            }
            $seen[$identity] = true;
            $items[] = $post;
            if (count($items) >= $limit) {
                return $items;
            }
        }
    }

    return $items;
};

$all_posts = $collect_posts($section_keys, 40);
$featured_post = $all_posts[0] ?? $normalize_post([]);
$latest_posts = array_slice($all_posts, 1, 4);
$total_posts = array_sum(array_map(static fn($posts) => is_array($posts) ? count($posts) : 0, $sections));

$tone_classes = [
    'red' => [
        'soft' => 'bg-rose-50 text-brand-red border-rose-200/80',
        'solid' => 'bg-brand-red text-white',
        'line' => 'bg-brand-red',
    ],
    'gold' => [
        'soft' => 'bg-amber-50 text-amber-700 border-amber-200/80',
        'solid' => 'bg-amber-400 text-amber-950',
        'line' => 'bg-amber-400',
    ],
];

$render_image = static function ($post, $class, $loading = 'lazy', $sizes = '(max-width: 767px) 100vw, 33vw') {
    $alt = trim((string) ($post['thumbnail_alt'] ?? '')) ?: wp_strip_all_tags($post['title']);
    ?>
    <img
      src="<?php echo esc_url($post['thumbnail']); ?>"
      <?php if (!empty($post['thumbnail_srcset'])): ?>
        srcset="<?php echo esc_attr($post['thumbnail_srcset']); ?>"
      <?php endif; ?>
      sizes="<?php echo esc_attr($sizes); ?>"
      alt="<?php echo esc_attr($alt); ?>"
      class="<?php echo esc_attr($class); ?>"
      loading="<?php echo esc_attr($loading); ?>"
      decoding="async"
      <?php if ($loading === 'eager'): ?>fetchpriority="high"<?php endif; ?>
    >
    <?php
};

$render_meta = static function ($post, $light = false) {
    $text_class = $light ? 'text-white/70' : 'text-slate-500';
    ?>
    <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-[10px] font-semibold <?php echo esc_attr($text_class); ?>">
      <span class="inline-flex items-center gap-1.5">
        <i class="ph-bold ph-calendar-blank" aria-hidden="true"></i>
        <?php echo esc_html($post['date']); ?>
      </span>
      <span class="inline-flex items-center gap-1.5">
        <i class="ph-bold ph-clock" aria-hidden="true"></i>
        <?php echo esc_html($post['reading_time']); ?>
      </span>
    </div>
    <?php
};

$render_card = static function ($post, $meta, $wide = false) use ($normalize_post, $render_image, $render_meta, $tone_classes) {
    $post = $normalize_post($post);
    $tone = $tone_classes[$meta['tone']];
    $article_layout = $wide ? 'max-w-4xl md:grid md:grid-cols-[0.9fr_1.1fr]' : '';
    $media_layout = $wide ? 'md:aspect-auto md:min-h-[300px]' : '';
    ?>
    <article class="group flex h-full min-w-0 flex-col overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-[0_10px_30px_rgba(15,23,42,0.05)] transition-all duration-300 hover:-translate-y-1 hover:border-brand-red/20 hover:shadow-[0_18px_42px_rgba(15,23,42,0.10)] <?php echo esc_attr($article_layout); ?>">
      <a href="<?php echo esc_url($post['permalink']); ?>" class="relative block aspect-[16/9] overflow-hidden bg-slate-100 <?php echo esc_attr($media_layout); ?>" aria-label="<?php echo esc_attr($post['title']); ?>">
        <?php $render_image($post, 'h-full w-full object-cover object-center transition-transform duration-500 group-hover:scale-[1.035]'); ?>
        <span class="absolute left-3 top-3 max-w-[75%] truncate rounded-full border px-2.5 py-1 text-[8px] font-black uppercase tracking-wider shadow-sm <?php echo esc_attr($tone['soft']); ?>">
          <?php echo esc_html($meta['short']); ?>
        </span>
      </a>

      <div class="flex flex-1 flex-col p-4 md:p-5">
        <?php $render_meta($post); ?>
        <h3 class="mt-3 line-clamp-2 text-base font-black leading-snug text-slate-950 transition-colors group-hover:text-brand-red md:text-lg">
          <a href="<?php echo esc_url($post['permalink']); ?>"><?php echo esc_html($post['title']); ?></a>
        </h3>
        <p class="mt-2 line-clamp-2 text-xs leading-relaxed text-slate-500">
          <?php echo esc_html($post['excerpt']); ?>
        </p>
        <div class="mt-auto flex items-center justify-between gap-4 border-t border-slate-100 pt-4">
          <span class="truncate text-[10px] font-semibold text-slate-400"><?php echo esc_html($post['author']); ?></span>
          <a href="<?php echo esc_url($post['permalink']); ?>" class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-slate-200 bg-slate-50 text-brand-red transition-all group-hover:border-brand-red group-hover:bg-brand-red group-hover:text-white" aria-label="<?php echo esc_attr(sprintf(__('Đọc bài: %s', 'hacoled'), $post['title'])); ?>">
            <i class="ph-bold ph-arrow-up-right text-sm" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </article>
    <?php
};
?>

<main id="blog-main" class="min-h-screen bg-[#f7f6f4] bg-tech-grid pb-20 pt-44 text-brand-text lg:pb-28 lg:pt-52">
  <div class="mx-auto max-w-[1440px] px-4 sm:px-6 lg:px-8">
    <nav aria-label="<?php esc_attr_e('Breadcrumb', 'hacoled'); ?>" class="flex flex-wrap items-center gap-2 text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="transition-colors hover:text-brand-red"><?php _e('Trang chủ', 'hacoled'); ?></a>
      <i class="ph-bold ph-caret-right text-[9px]" aria-hidden="true"></i>
      <span class="text-brand-text" aria-current="page"><?php _e('Tin tức & kiến thức', 'hacoled'); ?></span>
    </nav>

    <header class="relative mt-8 grid gap-8 overflow-hidden rounded-3xl border border-white bg-white/80 p-5 shadow-[0_18px_55px_rgba(28,5,5,0.06)] backdrop-blur md:p-8 lg:grid-cols-[minmax(0,1fr)_auto] lg:items-end">
      <div class="pointer-events-none absolute inset-y-0 left-0 w-1.5 bg-gradient-to-b from-brand-red via-brand-red to-amber-400"></div>
      <div class="pointer-events-none absolute -right-24 -top-32 h-72 w-72 rounded-full bg-brand-red/5 blur-3xl"></div>
      <div class="max-w-4xl">
        <div class="inline-flex items-center gap-2 rounded-full border border-rose-200 bg-rose-50 px-3 py-1.5 text-[10px] font-black uppercase tracking-[0.18em] text-brand-red">
          <span class="h-1.5 w-1.5 rounded-full bg-brand-red"></span>
          <?php _e('HacoLED Journal', 'hacoled'); ?>
        </div>
        <h1 class="mt-5 text-3xl font-black leading-[1.08] tracking-tight text-brand-text sm:text-4xl lg:text-5xl">
          <?php _e('Tin tức, dự án và kiến thức AV', 'hacoled'); ?>
        </h1>
        <p class="mt-4 max-w-3xl text-sm leading-7 text-brand-muted md:text-base">
          <?php _e('Một nơi để theo dõi công trình đã bàn giao, tìm hiểu công nghệ màn hình LED - âm thanh và tra cứu hướng dẫn vận hành từ đội ngũ HacoLED.', 'hacoled'); ?>
        </p>
      </div>
      <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white px-4 py-3">
          <strong class="block text-xl font-black text-brand-red"><?php echo esc_html($total_posts); ?></strong>
          <span class="text-[9px] font-bold uppercase tracking-wider text-slate-400"><?php _e('Bài viết', 'hacoled'); ?></span>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white px-4 py-3">
          <strong class="block text-xl font-black text-brand-text"><?php echo esc_html(count($section_meta)); ?></strong>
          <span class="text-[9px] font-bold uppercase tracking-wider text-slate-400"><?php _e('Chuyên mục', 'hacoled'); ?></span>
        </div>
        <div class="hidden rounded-2xl border border-slate-200 bg-white px-4 py-3 sm:block">
          <strong class="block text-xl font-black text-amber-500">AV</strong>
          <span class="text-[9px] font-bold uppercase tracking-wider text-slate-400"><?php _e('Chuyên sâu', 'hacoled'); ?></span>
        </div>
      </div>
    </header>

    <nav aria-label="<?php esc_attr_e('Chuyên mục bài viết', 'hacoled'); ?>" class="sticky top-0 z-[190] -mx-4 border-b border-slate-200/80 bg-[#f7f6f4]/95 px-4 py-3 shadow-[0_8px_24px_rgba(15,23,42,0.04)] backdrop-blur sm:mx-0 sm:px-0 lg:top-[58px]">
      <div class="no-scrollbar mx-auto flex max-w-[1440px] gap-2 overflow-x-auto pb-1">
        <?php foreach ($section_meta as $meta): ?>
          <a href="#<?php echo esc_attr($meta['anchor']); ?>" class="inline-flex shrink-0 items-center gap-2 rounded-full border border-slate-200 bg-white px-3.5 py-2 text-[10px] font-black uppercase tracking-wider text-slate-600 transition-all hover:border-brand-red hover:bg-brand-red hover:text-white">
            <i class="<?php echo esc_attr($meta['icon']); ?> text-sm" aria-hidden="true"></i>
            <?php echo esc_html($meta['short']); ?>
          </a>
        <?php endforeach; ?>
      </div>
    </nav>

    <section aria-labelledby="featured-heading" class="grid gap-5 py-10 lg:grid-cols-12 lg:gap-6">
      <article class="group relative overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-[0_16px_48px_rgba(15,23,42,0.07)] lg:col-span-8">
        <div class="pointer-events-none absolute inset-x-0 top-0 z-20 h-1 bg-gradient-to-r from-brand-red via-amber-400 to-brand-red"></div>
        <div class="grid h-full md:grid-cols-[1.2fr_0.8fr]">
          <a href="<?php echo esc_url($featured_post['permalink']); ?>" class="relative min-h-[280px] overflow-hidden bg-slate-100 md:min-h-[430px]" aria-label="<?php echo esc_attr($featured_post['title']); ?>">
            <?php $render_image($featured_post, 'absolute inset-0 h-full w-full object-cover object-center transition-transform duration-700 group-hover:scale-[1.025]', 'eager', '(max-width: 767px) 100vw, 58vw'); ?>
            <span class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-black/5"></span>
            <span class="absolute left-4 top-4 rounded-full bg-brand-red px-3 py-1.5 text-[9px] font-black uppercase tracking-wider text-white shadow-lg">
              <?php _e('Nổi bật', 'hacoled'); ?>
            </span>
          </a>
          <div class="relative flex flex-col bg-gradient-to-br from-white via-white to-rose-50/50 p-5 sm:p-7 lg:p-8">
            <span class="pointer-events-none absolute bottom-0 right-0 h-28 w-28 rounded-tl-full bg-brand-red/5"></span>
            <p class="text-[10px] font-black uppercase tracking-[0.18em] text-brand-red"><?php echo esc_html($featured_post['category']); ?></p>
            <h2 id="featured-heading" class="mt-4 text-2xl font-black leading-tight tracking-tight text-brand-text sm:text-3xl">
              <a href="<?php echo esc_url($featured_post['permalink']); ?>" class="transition-colors hover:text-brand-red"><?php echo esc_html($featured_post['title']); ?></a>
            </h2>
            <p class="mt-4 line-clamp-4 text-sm leading-7 text-brand-muted"><?php echo esc_html($featured_post['excerpt']); ?></p>
            <div class="mt-5"><?php $render_meta($featured_post); ?></div>
            <div class="mt-auto pt-7">
              <a href="<?php echo esc_url($featured_post['permalink']); ?>" class="inline-flex items-center gap-2 rounded-full bg-brand-red px-5 py-3 text-[11px] font-black uppercase tracking-wider text-white transition-colors hover:bg-brand-text">
                <?php _e('Đọc bài nổi bật', 'hacoled'); ?>
                <i class="ph-bold ph-arrow-right" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
      </article>

      <aside class="overflow-hidden rounded-3xl border border-slate-200 bg-white lg:col-span-4" aria-labelledby="latest-heading">
        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
          <div>
            <p class="text-[9px] font-black uppercase tracking-[0.18em] text-brand-red"><?php _e('Mới cập nhật', 'hacoled'); ?></p>
            <h2 id="latest-heading" class="mt-1 text-lg font-black text-brand-text"><?php _e('Bài viết mới nhất', 'hacoled'); ?></h2>
          </div>
          <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-rose-50 text-brand-red">
            <i class="ph-fill ph-newspaper text-lg" aria-hidden="true"></i>
          </span>
        </div>
        <div class="divide-y divide-slate-100">
          <?php foreach ($latest_posts as $index => $post): $post = $normalize_post($post); ?>
            <article class="group flex gap-3 p-4 transition-colors hover:bg-slate-50">
              <a href="<?php echo esc_url($post['permalink']); ?>" class="h-20 w-24 shrink-0 overflow-hidden rounded-xl bg-slate-100" aria-label="<?php echo esc_attr($post['title']); ?>">
                <?php $render_image($post, 'h-full w-full object-cover object-center transition-transform duration-500 group-hover:scale-105', 'lazy', '96px'); ?>
              </a>
              <div class="min-w-0 flex-1">
                <div class="flex items-center gap-2 text-[9px] font-bold text-slate-400">
                  <span class="text-brand-red"><?php echo esc_html(sprintf('%02d', $index + 1)); ?></span>
                  <span><?php echo esc_html($post['date']); ?></span>
                </div>
                <h3 class="mt-1.5 line-clamp-2 text-xs font-black leading-snug text-brand-text transition-colors group-hover:text-brand-red">
                  <a href="<?php echo esc_url($post['permalink']); ?>"><?php echo esc_html($post['title']); ?></a>
                </h3>
                <span class="mt-1 block text-[9px] text-slate-400"><?php echo esc_html($post['reading_time']); ?></span>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </aside>
    </section>

    <div class="space-y-4">
      <?php $section_number = 0; ?>
      <?php foreach ($section_meta as $section_key => $meta): ?>
        <?php
        $section_number++;
        $section_posts = $sections[$section_key] ?? [];
        $posts = array_slice(array_map($normalize_post, $section_posts), 0, 3);
        $tone = $tone_classes[$meta['tone']];
        
        $cat_slug = $categories_slugs[$section_key] ?? '';
        $cat_obj = get_category_by_slug($cat_slug);
        $cat_url = $cat_obj ? get_category_link($cat_obj->term_id) : '';
        ?>
        <section id="<?php echo esc_attr($meta['anchor']); ?>" class="scroll-mt-36 border-t border-slate-200 py-10 md:py-12" aria-labelledby="<?php echo esc_attr($meta['anchor']); ?>-heading">
          <div class="mb-6 flex flex-col gap-4 md:mb-8 md:flex-row md:items-end md:justify-between">
            <div class="flex min-w-0 items-start gap-4">
              <span class="hidden text-4xl font-black leading-none text-slate-200 sm:block"><?php echo esc_html(sprintf('%02d', $section_number)); ?></span>
              <span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border <?php echo esc_attr($tone['soft']); ?>">
                <i class="<?php echo esc_attr($meta['icon']); ?> text-lg" aria-hidden="true"></i>
              </span>
              <div class="min-w-0">
                <h2 id="<?php echo esc_attr($meta['anchor']); ?>-heading" class="text-xl font-black tracking-tight text-brand-text md:text-2xl hover:text-brand-red transition-colors">
                  <?php if (!empty($cat_url)): ?>
                    <a href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($meta['label']); ?></a>
                  <?php else: ?>
                    <?php echo esc_html($meta['label']); ?>
                  <?php endif; ?>
                </h2>
                <p class="mt-1 max-w-2xl text-xs leading-relaxed text-brand-muted md:text-sm"><?php echo esc_html($meta['desc']); ?></p>
              </div>
            </div>
            <?php if (!empty($cat_url)): ?>
              <a href="<?php echo esc_url($cat_url); ?>" class="inline-flex self-start rounded-full border px-3 py-1.5 text-[9px] font-black uppercase tracking-wider md:self-auto <?php echo esc_attr($tone['soft']); ?> hover:bg-brand-red hover:text-white hover:border-brand-red transition-all duration-300">
                <?php echo esc_html(sprintf(_n('%d bài viết', '%d bài viết', count($section_posts), 'hacoled'), count($section_posts))); ?>
              </a>
            <?php else: ?>
              <span class="inline-flex self-start rounded-full border px-3 py-1.5 text-[9px] font-black uppercase tracking-wider md:self-auto <?php echo esc_attr($tone['soft']); ?>">
                <?php echo esc_html(sprintf(_n('%d bài viết', '%d bài viết', count($section_posts), 'hacoled'), count($section_posts))); ?>
              </span>
            <?php endif; ?>
          </div>

          <?php if ($posts): ?>
            <?php
            $post_count = count($posts);
            $grid_class = $post_count === 1
                ? 'grid-cols-1'
                : ($post_count === 2 ? 'md:grid-cols-2' : 'md:grid-cols-2 lg:grid-cols-3');
            ?>
            <div class="grid items-stretch gap-5 <?php echo esc_attr($grid_class); ?>">
              <?php foreach ($posts as $post): ?>
                <?php $render_card($post, $meta, $post_count === 1); ?>
              <?php endforeach; ?>
            </div>
            
            <?php if (!empty($cat_url) && count($section_posts) > 3): ?>
              <div class="mt-8 flex justify-center">
                <a href="<?php echo esc_url($cat_url); ?>" 
                   class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-6 py-3 text-[10px] font-black uppercase tracking-wider text-slate-700 shadow-sm hover:border-brand-red/30 hover:bg-slate-50 hover:text-brand-red hover:shadow-md hover:shadow-brand-red/5 transition-all duration-300">
                  <?php echo sprintf(__('Xem tất cả bài viết về %s', 'hacoled'), $meta['short']); ?>
                  <i class="ph-bold ph-caret-right text-xs" aria-hidden="true"></i>
                </a>
              </div>
            <?php endif; ?>
          <?php else: ?>
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white/60 px-6 py-10 text-center">
              <i class="<?php echo esc_attr($meta['icon']); ?> mx-auto text-2xl text-slate-300" aria-hidden="true"></i>
              <p class="mt-3 text-sm font-semibold text-slate-500"><?php _e('Chuyên mục đang được cập nhật nội dung mới.', 'hacoled'); ?></p>
            </div>
          <?php endif; ?>
        </section>
      <?php endforeach; ?>
    </div>

    <section class="mt-4 overflow-hidden rounded-3xl bg-brand-text px-5 py-8 text-white sm:px-8 lg:px-10 lg:py-10">
      <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_auto] lg:items-center">
        <div>
          <p class="text-[10px] font-black uppercase tracking-[0.18em] text-amber-400"><?php _e('Cần tư vấn theo dự án?', 'hacoled'); ?></p>
          <h2 class="mt-2 text-2xl font-black leading-tight sm:text-3xl"><?php _e('Trao đổi trực tiếp với chuyên gia HacoLED', 'hacoled'); ?></h2>
          <p class="mt-3 max-w-2xl text-sm leading-6 text-white/65"><?php _e('Gửi nhu cầu về kích thước, khoảng cách nhìn hoặc ngân sách để nhận cấu hình phù hợp.', 'hacoled'); ?></p>
        </div>
        <div class="flex flex-col gap-3 sm:flex-row">
          <a href="tel:0342324488" class="inline-flex items-center justify-center gap-2 rounded-full bg-amber-400 px-5 py-3 text-[11px] font-black uppercase tracking-wider text-amber-950 transition-colors hover:bg-white">
            <i class="ph-fill ph-phone-call" aria-hidden="true"></i>
            034.232.4488
          </a>
          <a href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>" class="inline-flex items-center justify-center gap-2 rounded-full border border-white/20 bg-white/10 px-5 py-3 text-[11px] font-black uppercase tracking-wider text-white transition-colors hover:bg-white hover:text-brand-text">
            <?php _e('Gửi yêu cầu', 'hacoled'); ?>
            <i class="ph-bold ph-arrow-right" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </section>
  </div>
</main>

<?php $this->renderFooter($footer_type ?? 'default'); ?>
