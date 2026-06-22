<?php
/**
 * Reusable Widget Component
 *
 * @var string $title
 * @var string $content
 */

$title   = $title ?? '';
$content = $content ?? '';
?>

<div class="rounded-2xl bg-white border border-slate-200/80 p-6 space-y-4 shadow-sm">
  <?php if (!empty($title)): ?>
    <div class="relative pb-3 border-b border-slate-100">
      <!-- Thin elegant red accent line for brand identity -->
      <div class="absolute bottom-0 left-0 w-12 h-[2px] bg-accent-red"></div>
      <h3 class="text-xs font-black uppercase tracking-widest text-slate-900">
        <?php echo esc_html($title); ?>
      </h3>
    </div>
  <?php endif; ?>
  
  <div class="text-xs text-slate-600 leading-relaxed space-y-3">
    <?php echo $content; ?>
  </div>
</div>
