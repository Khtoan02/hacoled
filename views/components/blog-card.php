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
 */

$category  = $category ?? __('Tin tức', 'hacoled');
$permalink = $permalink ?? '#';
$thumbnail = $thumbnail ?? '';
$author    = $author ?? 'Khánh Toàn';
$date      = $date ?? date('d/m/Y');
$excerpt   = $excerpt ?? '';
?>

<div class="group relative rounded-2xl bg-primary-light border border-white/5 p-5 hover:border-accent-red/30 transition-all duration-300 flex flex-col justify-between h-full">
  <div>
    <!-- Cover Thumbnail -->
    <div class="relative w-full h-40 rounded-xl bg-slate-950 overflow-hidden border border-white/5 mb-5">
      <?php if (!empty($thumbnail)): ?>
        <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
      <?php else: ?>
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900 to-primary flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-slate-700 transform group-hover:rotate-6 transition-transform">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18V6a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 6v3.75m-9A3.75 3.75 0 118.25 6H12m0 0v3.75m-9.75 0h16.5" />
          </svg>
        </div>
      <?php endif; ?>
      <span class="absolute bottom-3 left-3 px-2.5 py-0.5 rounded text-[9px] font-bold uppercase tracking-wider bg-slate-950/80 text-slate-300 backdrop-blur-md">
        <?php echo esc_html($category); ?>
      </span>
    </div>

    <!-- Date and Author metadata -->
    <div class="flex items-center gap-3 text-[10px] text-slate-500 mb-2">
      <span><?php echo esc_html($date); ?></span>
      <span>•</span>
      <span><?php echo sprintf(__('Tác giả: %s', 'hacoled'), esc_html($author)); ?></span>
    </div>

    <!-- Title -->
    <h3 class="text-base font-bold text-white mb-2 line-clamp-2 group-hover:text-accent-red transition-colors">
      <a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($title); ?></a>
    </h3>

    <!-- Excerpt summary -->
    <p class="text-xs text-slate-400 leading-relaxed line-clamp-3 mb-4">
      <?php echo esc_html($excerpt); ?>
    </p>
  </div>

  <!-- Read More Link -->
  <div class="border-t border-white/5 pt-4 mt-auto">
    <a href="<?php echo esc_url($permalink); ?>" class="inline-flex items-center gap-1 text-xs font-semibold text-accent-red hover:text-white transition-colors group/link">
      <?php _e('Đọc tiếp', 'hacoled'); ?>
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 transform group-hover/link:translate-x-0.5 transition-transform">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
      </svg>
    </a>
  </div>
</div>
