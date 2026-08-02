<?php
/**
 * Blog Article Card Component
 *
 * @var string $title
 * @var string $excerpt
 * @var string $date
 * @var string $permalink
 * @var string $thumbnail
 * @var string $author
 * @var string $category
 * @var string $reading_time
 */

$title        = $title ?? __('Bài viết HacoLED', 'hacoled');
$category     = wp_strip_all_tags($category ?? __('Tin tức', 'hacoled'));
$permalink    = $permalink ?? '#';
$thumbnail    = $thumbnail ?? '';
$author       = $author ?? __('Ban biên tập', 'hacoled');
$date         = $date ?? date_i18n('d/m/Y');
$excerpt      = $excerpt ?? '';
$reading_time = $reading_time ?? '';
$theme_uri    = get_template_directory_uri();

if ($reading_time === '') {
    $word_count = str_word_count(wp_strip_all_tags($excerpt));
    $reading_time = max(2, (int) ceil(max(1, $word_count) / 120)) . ' ' . __('phút đọc', 'hacoled');
}

$excerpt = $excerpt ?: __('Góc nhìn biên tập từ HacoLED Journal.', 'hacoled');
$insight_chips = [__('Phân tích', 'hacoled'), __('Ứng dụng', 'hacoled'), __('Checklist', 'hacoled')];
?>

<article class="group relative mx-auto flex w-full max-w-[430px] min-h-[390px] md:min-h-[420px] flex-col overflow-hidden rounded-[1.35rem] md:rounded-[1.75rem] border border-white/80 bg-white/85 shadow-[0_18px_55px_rgba(15,23,42,0.08)] backdrop-blur-xl transition-all duration-500 hover:-translate-y-1 hover:border-white hover:bg-white hover:shadow-[0_28px_70px_rgba(15,23,42,0.13)]">
  <div class="pointer-events-none absolute -inset-px rounded-[1.35rem] md:rounded-[1.75rem] bg-gradient-to-br from-[#E3000F]/18 via-transparent to-[#D4AF37]/20 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
  <div class="pointer-events-none absolute -right-24 -top-24 h-56 w-56 rounded-full bg-[#E3000F]/8 blur-3xl"></div>

  <div class="relative">
    <div data-news-card-image class="relative aspect-[16/10] overflow-hidden bg-slate-950 shadow-inner">
      <?php if (!empty($thumbnail)): ?>
        <img
          src="<?php echo esc_url($thumbnail); ?>"
          alt="<?php echo esc_attr($title); ?>"
          class="absolute inset-0 h-full w-full object-cover object-center brightness-[1.02] contrast-[1.03] saturate-[1.1] transition-transform duration-700 group-hover:scale-105"
          loading="lazy"
          decoding="async"
          onerror="this.onerror=null; this.src='<?php echo esc_url(get_template_directory_uri() . '/assets/images/services-hero.webp'); ?>';"
        />
      <?php else: ?>
        <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#1C0505] via-[#5a0c0c] to-[#D4AF37]/40">
          <div class="flex h-16 w-16 items-center justify-center rounded-2xl border border-white/15 bg-white/10 text-[#D4AF37] backdrop-blur">
            <i class="ph-bold ph-newspaper-clipping text-3xl"></i>
          </div>
        </div>
      <?php endif; ?>
      <div class="absolute inset-0 bg-gradient-to-t from-black/18 via-black/0 to-black/8"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_16%,rgba(212,175,55,0.1),transparent_34%)]"></div>
      <a href="<?php echo esc_url($permalink); ?>" class="absolute inset-0 z-10" aria-label="<?php echo esc_attr($title); ?>"></a>

      <div class="absolute left-3 top-3 right-3 z-20 flex items-start justify-between gap-2">
        <span class="max-w-[78%] truncate rounded-full bg-[#E3000F] px-2.5 py-1 text-[8px] font-black uppercase tracking-wider text-white shadow-[0_8px_22px_rgba(227,0,15,0.25)] md:text-[9px]">
          <?php echo esc_html($category); ?>
        </span>
        <a href="<?php echo esc_url($permalink); ?>" class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-white/80 bg-white/95 text-brand-text shadow-md transition-all hover:bg-[#E3000F] hover:text-white" aria-label="<?php echo esc_attr($title); ?>">
          <i class="ph-bold ph-arrow-up-right text-sm"></i>
        </a>
      </div>
    </div>
  </div>

  <div class="relative flex flex-1 flex-col p-4 md:p-5">
    <div class="pointer-events-none absolute -right-14 -bottom-16 h-44 w-44 bg-contain bg-center bg-no-repeat opacity-[0.045]"
         style="background-image: url('<?php echo esc_url($theme_uri . '/assets/images/dongson.png'); ?>'); filter: url(#to-gold-light);"></div>

    <div class="relative z-10 flex flex-wrap items-center gap-1.5">
      <span class="inline-flex items-center gap-1 rounded-full border border-amber-200/80 bg-amber-50/90 px-2 py-1 text-[8px] font-black uppercase tracking-wider text-amber-700">
        <i class="ph-bold ph-calendar-blank text-amber-500"></i>
        <?php echo esc_html($date); ?>
      </span>
      <span class="inline-flex items-center gap-1 rounded-full border border-amber-200/80 bg-amber-50/90 px-2 py-1 text-[8px] font-black uppercase tracking-wider text-amber-700">
        <i class="ph-bold ph-clock text-amber-500"></i>
        <?php echo esc_html($reading_time); ?>
      </span>
    </div>

    <h3 class="relative z-10 mt-3 line-clamp-3 text-base font-black leading-tight text-slate-950 transition-colors duration-300 group-hover:text-[#E3000F] md:text-[19px]">
      <a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($title); ?></a>
    </h3>

    <p class="relative z-10 mt-2 line-clamp-2 text-[12px] font-medium leading-relaxed text-slate-500">
      <?php echo esc_html($excerpt); ?>
    </p>

    <div class="relative z-10 mt-3 flex flex-wrap gap-1.5">
      <?php foreach ($insight_chips as $chip): ?>
        <span class="rounded-full border border-slate-200/80 bg-slate-50/90 px-2 py-1 text-[8px] font-black uppercase tracking-wider text-slate-500">
          <?php echo esc_html($chip); ?>
        </span>
      <?php endforeach; ?>
    </div>

    <a href="<?php echo esc_url($permalink); ?>" class="relative z-10 mt-auto flex items-center justify-between gap-4 border-t border-slate-200/70 pt-3 text-[10px] font-black uppercase tracking-wider text-brand-red transition-colors hover:text-brand-text">
      <span><?php _e('Đọc bài viết', 'hacoled'); ?></span>
      <span class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 bg-slate-50 text-brand-text transition-all group-hover:border-[#E3000F] group-hover:bg-[#E3000F] group-hover:text-white group-hover:shadow-[0_12px_28px_rgba(227,0,15,0.22)]">
        <i class="ph-bold ph-arrow-up-right text-sm transition-transform duration-300 group-hover:rotate-12"></i>
      </span>
    </a>
  </div>
</article>
