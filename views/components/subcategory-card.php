<?php
/**
 * Dedicated Bright & Clear Subcategory Card Component (Danh Mục Con)
 *
 * Designed to showcase clean, bright category images with a fresh white glass content panel.
 *
 * @var string $title        Subcategory name
 * @var string $permalink    Subcategory URL
 * @var string $thumbnail    Subcategory thumbnail URL
 * @var int    $count        Product count
 */

$title     = $title ?? __('Danh mục con', 'hacoled');
$permalink = $permalink ?? '#';
$thumbnail = $thumbnail ?? '';
$count     = $count ?? 0;
?>

<div class="subcategory-card relative group w-full h-full min-h-[290px] md:min-h-[330px] rounded-2xl md:rounded-3xl overflow-hidden transition-all duration-500 transform-gpu hover:-translate-y-1.5 shadow-[0_8px_25px_rgba(0,0,0,0.06)] hover:shadow-[0_16px_45px_rgba(217,4,41,0.18)] border border-slate-200/90 bg-white flex flex-col justify-between">
  
  <!-- Full Card Link -->
  <a href="<?php echo esc_url($permalink); ?>" class="absolute inset-0 z-30" aria-label="<?php echo esc_attr($title); ?>">
    <span class="sr-only"><?php echo esc_html($title); ?></span>
  </a>

  <!-- TOP HERO: Crisp, Bright & Clear Image Area (60% Height) -->
  <div class="relative w-full h-[170px] sm:h-[190px] md:h-[210px] overflow-hidden bg-slate-100 shrink-0">
    <?php if (!empty($thumbnail)): ?>
      <img 
        src="<?php echo esc_url($thumbnail); ?>" 
        alt="<?php echo esc_attr($title); ?>" 
        class="w-full h-full object-cover object-center group-hover:scale-108 transition-transform duration-700 ease-out" 
        loading="lazy" 
      />
    <?php else: ?>
      <div class="w-full h-full bg-gradient-to-br from-red-50 via-slate-100 to-amber-50 flex items-center justify-center">
        <i class="ph-bold ph-squares-four text-5xl text-[#D90429]/30"></i>
      </div>
    <?php endif; ?>

    <!-- Subtle gradient shadow only at top to contrast floating badges -->
    <div class="absolute top-0 left-0 right-0 h-16 bg-gradient-to-b from-black/40 to-transparent pointer-events-none"></div>

    <!-- Floating Badges on Top of Image -->
    <div class="absolute top-3 left-3 right-3 flex items-center justify-between gap-2 z-10 pointer-events-none">
      <!-- Subcategory Badge -->
      <div class="flex items-center gap-1.5 px-3 py-1 bg-white/90 backdrop-blur-md border border-white/80 rounded-full text-[10px] md:text-[11px] font-extrabold text-[#D90429] uppercase tracking-wider shadow-md">
        <i class="ph-bold ph-folders text-xs text-[#D90429]"></i>
        <span>Danh Mục Con</span>
      </div>

      <!-- Product Count Pill -->
      <?php if ($count > 0): ?>
        <span class="px-2.5 py-1 bg-[#FFD700] text-[#3a1f05] text-[10px] md:text-[11px] font-black uppercase tracking-wider rounded-full shadow-md border border-yellow-200/60 flex items-center gap-1">
          <i class="ph-bold ph-package text-xs"></i>
          <?php echo sprintf(__('%d sản phẩm', 'hacoled'), $count); ?>
        </span>
      <?php endif; ?>
    </div>
  </div>

  <!-- BOTTOM PANEL: Bright White Glass Content Box -->
  <div class="p-4 md:p-5 flex-1 flex flex-col justify-between bg-white relative z-10">
    <div>
      <h3 class="text-sm md:text-base font-extrabold text-slate-900 group-hover:text-[#D90429] transition-colors leading-snug line-clamp-2">
        <?php echo esc_html($title); ?>
      </h3>
      <p class="text-[11px] md:text-xs text-slate-500 font-medium mt-1 leading-relaxed line-clamp-1">
        Khám phá bộ sưu tập <?php echo esc_html($title); ?> chính hãng.
      </p>
    </div>

    <!-- Bottom Action Row -->
    <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between">
      <span class="text-[11px] font-extrabold text-[#D90429] group-hover:text-red-700 uppercase tracking-wider transition-colors flex items-center gap-1">
        Xem danh mục ngay
      </span>
      <div class="w-7 h-7 md:w-8 md:h-8 rounded-full bg-red-50 group-hover:bg-[#D90429] text-[#D90429] group-hover:text-white flex items-center justify-center transition-all duration-300 shadow-sm group-hover:translate-x-0.5">
        <i class="ph-bold ph-arrow-right text-xs md:text-sm"></i>
      </div>
    </div>
  </div>
</div>
