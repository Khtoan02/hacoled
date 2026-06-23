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

<div class="group flex flex-col justify-between glass-card rounded-2xl p-5 border border-slate-200/80 bg-white/70 shadow-sm hover:border-brand-gold/40 hover:shadow-glow-gold hover:bg-white/90 transition-all duration-300 h-full">
  <div>
    <!-- Cover Thumbnail -->
    <div class="relative w-full h-44 rounded-xl bg-slate-950 overflow-hidden border border-slate-100 shadow-inner mb-5">
      <?php if (!empty($thumbnail)): ?>
        <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
      <?php else: ?>
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900 to-primary flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2500/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-slate-700 transform group-hover:rotate-6 transition-transform">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18V6a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 6v3.75m-9A3.75 3.75 0 118.25 6H12m0 0v3.75m-9.75 0h16.5" />
          </svg>
        </div>
      <?php endif; ?>
      <span class="absolute bottom-3 left-3 px-2.5 py-0.5 rounded text-[9px] font-bold uppercase tracking-wider bg-slate-950/80 text-slate-300 backdrop-blur-md">
        <?php echo esc_html(strip_tags($category)); ?>
      </span>
    </div>

    <!-- Date and Author metadata -->
    <div class="flex items-center gap-3 text-[10px] text-slate-400 mb-2 font-mono">
      <span><?php echo esc_html($date); ?></span>
      <span>•</span>
      <span><?php echo sprintf(__('Tác giả: %s', 'hacoled'), esc_html($author)); ?></span>
    </div>

    <!-- Title -->
    <h3 class="text-sm font-bold text-slate-900 mb-2 line-clamp-2 group-hover:text-accent-red transition-colors leading-snug">
      <a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($title); ?></a>
    </h3>

    <div class="w-4 h-0.5 bg-accent-red group-hover:w-full transition-all duration-500 mb-3"></div>

    <!-- Excerpt summary -->
    <p class="text-[11px] text-slate-500 leading-relaxed line-clamp-3 mb-4 font-light">
      <?php echo esc_html($excerpt); ?>
    </p>
  </div>

  <!-- Read More Link -->
  <div class="border-t border-slate-100 pt-4 mt-auto">
    <a href="<?php echo esc_url($permalink); ?>" class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider text-accent-red hover:text-slate-800 transition-colors group/link">
      <?php _e('Đọc tiếp', 'hacoled'); ?>
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 transform group-hover/link:translate-x-0.5 transition-transform">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
      </svg>
    </a>
  </div>
</div>
