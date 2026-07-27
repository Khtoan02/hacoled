<?php
/**
 * LED Product Card Component (Shared & Configurable)
 *
 * @var string $title
 * @var string $description
 * @var string $category
 * @var string $price
 * @var string $permalink
 * @var string $thumbnail
 */

$category     = $category ?? __('Màn hình LED', 'hacoled');
$price        = $price ?? __('Liên hệ', 'hacoled');
$permalink    = $permalink ?? '#';
$thumbnail    = $thumbnail ?? '';
$image_alt    = $image_alt ?? trim($title . ' – ' . $category);
$is_hot       = true; // default
$reviews      = rand(10, 300); // placeholder or fetch if needed
$in_stock     = true; // placeholder

?>
<div class="relative group w-full max-w-[400px] h-[310px] sm:h-[400px] md:h-[520px] rounded-[1.5rem] md:rounded-[2rem] transition-all duration-700 perspective-1000 mx-auto transform-gpu">
  
  <!-- Background chính của thẻ -->
  <div class="absolute inset-0 rounded-[1.5rem] md:rounded-[2rem] bg-white/60 backdrop-blur-2xl border border-white/80 overflow-hidden shadow-[0_10px_30px_rgba(227,0,15,0.06)] transition-all duration-700 group-hover:border-white group-hover:bg-white/95 group-hover:shadow-[0_16px_36px_rgba(227,0,15,0.22)] transform-gpu">
    
    <!-- Lớp điểm nhấn ánh sáng đỏ mượt phía sau thẻ khi hover -->
    <div class="absolute top-0 left-0 w-72 h-72 bg-gradient-to-br from-[#E3000F]/22 via-[#D4AF37]/15 to-transparent rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none z-0"></div>
    
    <!-- Link ẩn bao trọn card -->
    <a href="<?php echo esc_url($permalink); ?>" class="absolute inset-0 z-30" aria-label="<?php echo esc_attr($image_alt); ?>">
      <span class="sr-only"><?php echo esc_html($image_alt); ?></span>
    </a>

    <!-- Layout hiển thị hình ảnh và các tag nổi -->
    <div class="absolute left-1 md:left-2 right-1 md:right-2 top-2 sm:top-[14px] md:top-4 bottom-[135px] sm:bottom-[180px] md:bottom-[220px] flex items-center justify-center z-10 pointer-events-none">
      <div class="relative w-full h-full flex items-center justify-center -translate-y-2 md:-translate-y-[13px]">
          <!-- Họa tiết trống đồng mờ nhạt phía sau sản phẩm -->
          <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[140px] h-[140px] sm:w-[220px] sm:h-[220px] md:w-[320px] md:h-[320px] opacity-[0.10] group-hover:opacity-[0.20] transition-all duration-1000 ease-out group-hover:scale-105 group-hover:rotate-12 pointer-events-none" 
               style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/dongson-optimized.webp'); background-repeat: no-repeat; background-position: center; background-size: contain; filter: url(#to-gold-light);">
          </div>
        
        <!-- Wrapper cho Ảnh và Tag -->
        <div class="relative w-[92%] h-[92%] md:w-[86%] md:h-[86%] transition-all duration-700 ease-out transform group-hover:-translate-y-4 md:group-hover:-translate-y-6 group-hover:scale-90 origin-center">
          <?php if (!empty($thumbnail)): ?>
            <img 
              src="<?php echo esc_url($thumbnail); ?>" 
              alt="<?php echo esc_attr($image_alt); ?>"
              class="relative z-10 w-full h-full object-contain filter drop-shadow-[0_10px_15px_rgba(0,0,0,0.12)] md:drop-shadow-[0_20px_30px_rgba(0,0,0,0.15)]"
              loading="lazy"
              decoding="async"
              sizes="(max-width: 767px) 40vw, 25vw"
            />
          <?php else: ?>
            <div class="relative z-10 w-4/5 h-4/5 flex flex-col items-center justify-center bg-gradient-to-br from-slate-50 via-slate-100/60 to-red-50/40 rounded-2xl border border-dashed border-slate-200/80 p-4 text-center my-auto">
              <i class="ph-bold ph-monitor-play text-3xl md:text-4xl text-[#D90429]/40 mb-1"></i>
              <span class="text-[9px] md:text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">HacoLED</span>
            </div>
          <?php endif; ?>
        </div>

      </div>
    </div>

    <!-- Bảng thông tin bên dưới -->
    <div class="absolute bottom-2 md:bottom-4 left-2 md:left-4 right-2 md:right-4 z-20 pointer-events-none">
      <div class="relative bg-white/70 backdrop-blur-xl border border-white rounded-2xl md:rounded-3xl p-2.5 md:p-5 overflow-hidden transition-all duration-500 shadow-[0_10px_40px_rgba(0,0,0,0.05)] group-hover:bg-white/95 group-hover:shadow-[0_15px_50px_rgba(0,0,0,0.1)]">
        
        <!-- Lớp phủ gradient mỏng tạo chiều sâu -->
        <div class="absolute inset-0 bg-gradient-to-t from-white/80 to-transparent pointer-events-none"></div>

        <div class="relative flex flex-col gap-1.5 md:gap-3">
          
          <!-- Các tag tĩnh còn lại -->
          <div class="flex flex-wrap gap-1 md:gap-1.5">
            <!-- Tag Chính Hãng -->
            <span class="px-1 md:px-2 py-0.5 md:py-1 text-[7.5px] md:text-[8.5px] font-extrabold tracking-wider text-white bg-gradient-to-r from-[#E3000F] to-[#ff4d4d] rounded-md md:rounded-full flex items-center gap-0.5 md:gap-1 uppercase shadow-sm">
              <i class="ph-bold ph-shield-check"></i> Chính Hãng
            </span>
            <span class="px-1 md:px-2 py-0.5 md:py-1 text-[7.5px] md:text-[8.5px] font-bold tracking-wider text-amber-700 bg-amber-50/90 border border-amber-200/80 rounded-md md:rounded-full flex items-center gap-0.5 md:gap-1 uppercase transition-colors hover:bg-amber-100 hover:border-amber-300">
              <i class="ph-bold ph-check-circle text-amber-500"></i> BH 24t
            </span>
            <span class="px-1 md:px-2 py-0.5 md:py-1 text-[7.5px] md:text-[8.5px] font-bold tracking-wider text-amber-700 bg-amber-50/90 border border-amber-200/80 rounded-md md:rounded-full flex items-center gap-0.5 md:gap-1 uppercase transition-colors hover:bg-amber-100 hover:border-amber-300">
              <i class="ph-bold ph-check-circle text-amber-500"></i> CO/CQ
            </span>
          </div>

          <div class="flex items-start justify-between gap-2 md:gap-4 mt-0.5">
            <div class="flex-1 min-w-0">
              <h3 class="text-xs md:text-lg font-bold text-gray-900 leading-tight group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-[#E3000F] group-hover:to-[#ff4d4d] transition-all duration-300 line-clamp-2">
                <?php echo esc_html($title); ?>
              </h3>
              
              <!-- Tag 5 Ngôi sao -->
              <div class="flex items-center gap-0.5 mt-0.5 md:mt-1">
                <?php for($i=1; $i<=5; $i++): ?>
                  <i class="ph-fill ph-star text-[10px] md:text-[13px] text-amber-400"></i>
                <?php endfor; ?>
              </div>

              <!-- Giá sản phẩm hiển thị cố định nằm trên 1 hàng (Đã lọc ẩn text screen-reader) -->
              <div class="mt-1 md:mt-2 transition-all duration-300 w-full overflow-hidden">
                <div class="price-wrapper flex items-baseline gap-1 flex-nowrap whitespace-nowrap overflow-hidden text-ellipsis text-[11px] sm:text-xs md:text-sm lg:text-base [&>del]:text-[9px] md:[&>del]:text-[11px] [&>del]:text-slate-400 [&>del]:line-through [&>del]:font-medium [&>ins]:no-underline [&>ins]:text-[11px] sm:[&>ins]:text-xs md:[&>ins]:text-sm lg:[&>ins]:text-base [&>ins]:font-extrabold [&>ins]:text-[#E3000F] [&>ins]:leading-none [&>.amount]:text-[11px] sm:[&>.amount]:text-xs md:[&>.amount]:text-sm lg:[&>.amount]:text-base [&>.amount]:font-extrabold [&>.amount]:text-[#E3000F] [&>.amount]:leading-none [&_.screen-reader-text]:hidden">
                  <?php echo wp_kses_post($price); ?>
                </div>
              </div>

              <!-- Animation mở rộng mô tả (Chỉ hiển thị trên màn hình lớn) -->
              <div class="grid transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] grid-rows-[1fr] opacity-100 mt-1.5 md:grid-rows-[0fr] md:opacity-0 md:mt-0 md:group-hover:grid-rows-[1fr] md:group-hover:opacity-100 md:group-hover:mt-2">
                <p class="text-[10px] md:text-xs text-gray-600 font-medium leading-relaxed overflow-hidden line-clamp-2 md:line-clamp-3">
                  <?php echo wp_kses_post($description ?: 'Giải pháp hiển thị tích hợp hoàn chỉnh.'); ?>
                </p>
              </div>
            </div>

            <!-- Nút xem chi tiết -->
            <div class="flex flex-shrink-0 w-6 h-6 md:w-10 md:h-10 items-center justify-center rounded-md md:rounded-2xl bg-gray-100 border border-gray-200 text-gray-600 transition-all duration-300 group-hover:bg-[#E3000F] group-hover:border-[#E3000F] group-hover:text-white group-hover:shadow-[0_0_20px_rgba(227,0,15,0.3)] group-hover:scale-105 pointer-events-auto relative z-40">
              <i class="ph-bold ph-arrow-up-right text-[10px] md:text-lg transition-transform duration-300 group-hover:rotate-12"></i>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
