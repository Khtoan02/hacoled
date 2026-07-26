<?php
/**
 * Dedicated Image-First Subcategory Card Component (Danh Mục Con)
 *
 * Full-bleed image hero card with gradient text overlay.
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

<div class="subcategory-card relative group w-full h-[280px] sm:h-[320px] md:h-[360px] rounded-2xl md:rounded-3xl overflow-hidden transition-all duration-700 transform-gpu hover:-translate-y-2 shadow-xl hover:shadow-[0_20px_50px_rgba(217,4,41,0.35)] border border-white/20 bg-slate-950 flex flex-col justify-between p-5 md:p-7">
  
  <!-- Full-bleed Background Image -->
  <div class="absolute inset-0 z-0 overflow-hidden bg-gradient-to-br from-[#100102] via-[#380208] to-[#0d0002]">
    <?php if (!empty($thumbnail)): ?>
      <img 
        src="<?php echo esc_url($thumbnail); ?>" 
        alt="<?php echo esc_attr($title); ?>" 
        class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-700 ease-out filter brightness-[0.9] group-hover:brightness-100" 
        loading="lazy" 
      />
    <?php else: ?>
      <div class="w-full h-full bg-gradient-to-br from-[#65000f] via-[#a8031d] to-[#3a0007] flex items-center justify-center relative opacity-80">
        <i class="ph-bold ph-squares-four text-6xl text-white/20"></i>
      </div>
    <?php endif; ?>
    
    <!-- Dark Gradient Overlays for Crisp Text Legibility -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/55 to-black/30 group-hover:from-black/90 group-hover:via-black/45 group-hover:to-black/20 transition-colors duration-500"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-transparent to-black/40"></div>
    
    <!-- Ambient Gold Glow Orb on Hover -->
    <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-[#FFD700] rounded-full opacity-0 group-hover:opacity-25 blur-[60px] transition-opacity duration-700 pointer-events-none"></div>

    <!-- Dong Son Drum motif overlay -->
    <div class="absolute right-[-40px] bottom-[-40px] w-64 h-64 md:w-80 md:h-80 opacity-[0.12] group-hover:opacity-[0.25] transition-all duration-700 pointer-events-none bg-no-repeat bg-center bg-contain"
         style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/dongson-optimized.webp'); ?>'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg);">
    </div>
  </div>

  <!-- Full Card Link (Clickable area) -->
  <a href="<?php echo esc_url($permalink); ?>" class="absolute inset-0 z-30" aria-label="<?php echo esc_attr($title); ?>">
    <span class="sr-only"><?php echo esc_html($title); ?></span>
  </a>

  <!-- TOP ROW: Category Badge & Product Count Pill -->
  <div class="relative z-10 flex items-center justify-between gap-2">
    <!-- Subcategory Badge -->
    <div class="flex items-center gap-1.5 px-3 py-1.5 bg-black/50 backdrop-blur-md border border-[#FFD700]/40 rounded-full text-[10px] md:text-[11px] font-extrabold text-[#FFE8A3] uppercase tracking-wider shadow-lg">
      <i class="ph-bold ph-folders text-xs text-[#FFD700] animate-pulse"></i>
      <span>Danh Mục Con</span>
    </div>

    <!-- Product Count Pill -->
    <?php if ($count > 0): ?>
      <span class="px-3 py-1.5 bg-gradient-to-r from-[#FFD700] to-[#F5A623] text-[#2D0202] text-[10px] md:text-[11px] font-black uppercase tracking-wider rounded-full shadow-lg border border-yellow-200/50 flex items-center gap-1">
        <i class="ph-bold ph-package text-xs"></i>
        <?php echo sprintf(__('%d sản phẩm', 'hacoled'), $count); ?>
      </span>
    <?php endif; ?>
  </div>

  <!-- BOTTOM ROW: Title, Subtitle & Interactive CTA -->
  <div class="relative z-10 mt-auto pt-6">
    <!-- Category Title -->
    <h3 class="text-lg sm:text-xl md:text-2xl font-black text-white group-hover:text-[#FFD700] transition-colors duration-300 leading-snug drop-shadow-md line-clamp-2">
      <?php echo esc_html($title); ?>
    </h3>
    
    <!-- Subtitle / Short hint -->
    <p class="text-xs md:text-sm text-slate-200/90 font-medium mt-1.5 leading-relaxed line-clamp-2 drop-shadow-sm">
      Khám phá bộ sưu tập <?php echo esc_html($title); ?> chính hãng chất lượng cao.
    </p>

    <!-- Bottom Action Divider & CTA button -->
    <div class="mt-4 pt-3.5 border-t border-white/20 flex items-center justify-between">
      <span class="text-[11px] md:text-xs font-extrabold text-[#FFE8A3] group-hover:text-white uppercase tracking-widest transition-colors flex items-center gap-1.5">
        Xem danh mục ngay
      </span>
      
      <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-white/20 backdrop-blur-md border border-white/30 text-white group-hover:bg-[#FFD700] group-hover:border-[#FFD700] group-hover:text-[#2D0202] flex items-center justify-center transition-all duration-300 shadow-lg group-hover:scale-110 group-hover:rotate-12">
        <i class="ph-bold ph-arrow-right text-sm md:text-base"></i>
      </div>
    </div>
  </div>

  <!-- Top Specular Gloss Hairline -->
  <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/50 to-transparent pointer-events-none z-20"></div>
</div>
