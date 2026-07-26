<?php
/**
 * Dedicated Subcategory Card Component (Danh Mục Con)
 *
 * Designed specifically for subcategory grids to distinguish them from Product Cards.
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

<div class="subcategory-card relative group w-full h-full min-h-[220px] md:min-h-[250px] rounded-2xl md:rounded-3xl overflow-hidden transition-all duration-500 transform-gpu hover:-translate-y-1.5 shadow-[0_6px_20px_rgba(0,0,0,0.05)] hover:shadow-[0_16px_40px_rgba(217,4,41,0.18)] border border-slate-200/80 bg-white flex flex-col justify-between p-4 md:p-6">
  
  <!-- Left Red & Gold Accent Stripe -->
  <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-gradient-to-b from-[#FFD700] via-[#F5A623] to-[#D90429] rounded-l-3xl"></div>

  <!-- Ambient Light Glow on Hover -->
  <div class="absolute -top-16 -right-16 w-48 h-48 bg-gradient-to-br from-[#FFD700]/20 to-[#D90429]/15 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none"></div>

  <!-- Trống đồng Đông Sơn watermark -->
  <div class="absolute right-[-30px] bottom-[-30px] w-48 h-48 md:w-60 md:h-60 opacity-[0.06] group-hover:opacity-[0.14] transition-all duration-700 pointer-events-none bg-no-repeat bg-center bg-contain"
       style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/dongson-optimized.webp'); ?>'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg);">
  </div>

  <!-- Full Card Link -->
  <a href="<?php echo esc_url($permalink); ?>" class="absolute inset-0 z-30" aria-label="<?php echo esc_attr($title); ?>">
    <span class="sr-only"><?php echo esc_html($title); ?></span>
  </a>

  <!-- Top Bar: Category Badge & Count -->
  <div class="flex items-center justify-between gap-2 relative z-10">
    <div class="flex items-center gap-1.5 px-3 py-1 bg-red-50 border border-red-100 rounded-full text-[10px] md:text-[11px] font-extrabold text-[#D90429] uppercase tracking-wider shadow-sm">
      <i class="ph-bold ph-folders text-xs text-[#D90429]"></i>
      <span>Danh Mục Con</span>
    </div>
    <?php if ($count > 0): ?>
      <span class="px-2.5 py-1 bg-amber-50 border border-amber-200/80 rounded-full text-[10px] md:text-[11px] font-bold text-amber-800 flex items-center gap-1">
        <i class="ph-bold ph-package text-amber-600 text-xs"></i>
        <?php echo sprintf(__('%d sản phẩm', 'hacoled'), $count); ?>
      </span>
    <?php endif; ?>
  </div>

  <!-- Center Content: Thumbnail & Title -->
  <div class="my-4 flex items-center gap-4 relative z-10">
    <!-- Subcategory Thumbnail -->
    <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl border border-slate-100 bg-slate-50 flex items-center justify-center shrink-0 overflow-hidden shadow-inner group-hover:border-[#FFD700]/50 transition-colors">
      <?php if (!empty($thumbnail)): ?>
        <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" />
      <?php else: ?>
        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-red-50 to-amber-50 text-[#D90429]">
          <i class="ph-bold ph-squares-four text-2xl md:text-3xl"></i>
        </div>
      <?php endif; ?>
    </div>

    <!-- Title & Description -->
    <div class="flex-1 min-w-0">
      <h3 class="text-sm md:text-base font-extrabold text-slate-900 leading-snug group-hover:text-[#D90429] transition-colors line-clamp-2">
        <?php echo esc_html($title); ?>
      </h3>
      <p class="text-[11px] md:text-xs text-slate-500 mt-1 font-medium line-clamp-1">
        Xem tất cả sản phẩm thuộc <?php echo esc_html($title); ?>
      </p>
    </div>
  </div>

  <!-- Bottom CTA Action Bar -->
  <div class="pt-3 border-t border-slate-100 flex items-center justify-between relative z-10">
    <span class="text-[11px] font-extrabold text-slate-600 group-hover:text-[#D90429] uppercase tracking-wider transition-colors flex items-center gap-1.5">
      Khám phá danh mục
    </span>
    <div class="w-7 h-7 md:w-8 md:h-8 rounded-full bg-slate-100 group-hover:bg-[#D90429] text-slate-600 group-hover:text-white flex items-center justify-center transition-all duration-300 shadow-sm group-hover:translate-x-0.5">
      <i class="ph-bold ph-arrow-right text-xs md:text-sm"></i>
    </div>
  </div>
</div>
