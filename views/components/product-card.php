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
$is_hot       = true; // default
$reviews      = rand(10, 300); // placeholder or fetch if needed
$in_stock     = true; // placeholder

?>
<div class="relative group w-full max-w-[400px] h-[310px] sm:h-[400px] md:h-[520px] rounded-[1.5rem] md:rounded-[2rem] transition-all duration-700 perspective-1000 mx-auto transform-gpu">
  
  <!-- Lớp hào quang phía sau thẻ, tỏa sáng khi hover -->
  <div class="absolute -inset-0.5 rounded-[1.5rem] md:rounded-[2rem] bg-gradient-to-br from-[#E3000F]/30 via-transparent to-[#D4AF37]/30 opacity-0 blur-2xl transition-opacity duration-700 group-hover:opacity-100 group-hover:duration-500 pointer-events-none will-change-[opacity]"></div>

  <!-- Background chính của thẻ -->
  <div class="absolute inset-0 rounded-[1.5rem] md:rounded-[2rem] bg-white/60 backdrop-blur-2xl border border-white/80 overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.05)] transition-all duration-700 group-hover:border-white group-hover:bg-white/80 group-hover:shadow-[0_30px_60px_rgba(0,0,0,0.1)] transform-gpu">
    
    <!-- Link ẩn bao trọn card -->
    <a href="<?php echo esc_url($permalink); ?>" class="absolute inset-0 z-30" aria-label="<?php echo esc_attr($title); ?>"></a>

    <!-- Điểm nhấn gradient nhẹ ở góc -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-[#E3000F]/5 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-[#D4AF37]/5 rounded-full blur-[80px] translate-y-1/2 -translate-x-1/2 pointer-events-none"></div>

    <!-- Layout hiển thị hình ảnh và các tag nổi -->
    <div class="absolute inset-0 p-2 md:p-4 pb-[135px] sm:pb-[180px] md:pb-[220px] flex items-start justify-center pt-4 md:pt-10 z-10 pointer-events-none">
      <div class="relative w-full h-full flex items-center justify-center" style="transform: translateY(-8px) md:translateY(-13px);">
          <!-- Họa tiết trống đồng mờ nhạt phía sau sản phẩm -->
          <div class="absolute w-[140px] h-[140px] sm:w-[220px] sm:h-[220px] md:w-[320px] md:h-[320px] opacity-[0.10] group-hover:opacity-[0.20] transition-all duration-1000 ease-out group-hover:scale-105 group-hover:rotate-12 pointer-events-none" 
               style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/dongson.png'); background-repeat: no-repeat; background-position: center; background-size: contain; filter: url(#to-gold-light);">
          </div>
        
        <!-- Wrapper cho Ảnh và Tag -->
        <div class="relative w-full h-full transition-all duration-700 ease-out transform group-hover:-translate-y-4 md:group-hover:-translate-y-6 group-hover:scale-90 origin-bottom">
          <?php if (!empty($thumbnail)): ?>
            <img 
              src="<?php echo esc_url($thumbnail); ?>" 
              alt="<?php echo esc_attr($title); ?>"
              class="relative z-10 w-full h-full object-contain filter drop-shadow-[0_10px_15px_rgba(0,0,0,0.12)] md:drop-shadow-[0_20px_30px_rgba(0,0,0,0.15)]"
            />
          <?php else: ?>
            <div class="relative z-10 w-full h-full flex items-center justify-center bg-slate-100/50 rounded-full">
              <span class="text-slate-400 text-[10px] md:text-xs font-medium">No Image</span>
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
            <div class="flex-1">
              <h3 class="text-xs md:text-lg font-bold text-gray-900 leading-tight group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-[#E3000F] group-hover:to-[#ff4d4d] transition-all duration-300 line-clamp-2">
                <?php echo esc_html($title); ?>
              </h3>
              
              <!-- Tag 5 Ngôi sao -->
              <div class="flex items-center gap-0.5 mt-0.5 md:mt-1">
                <?php for($i=1; $i<=5; $i++): ?>
                  <i class="ph-fill ph-star text-[10px] md:text-[13px] text-amber-400"></i>
                <?php endfor; ?>
              </div>

              <!-- Giá sản phẩm hiển thị cố định -->
              <div class="mt-1 md:mt-2 transition-all duration-300">
                <div class="price-wrapper flex items-baseline gap-1.5 flex-wrap [&>del]:text-[9px] md:[&>del]:text-[11px] [&>del]:text-slate-400 [&>del]:line-through [&>del]:font-medium [&>ins]:no-underline text-xs md:text-base [&>ins]:text-xs md:[&>ins]:text-base [&>ins]:font-extrabold [&>ins]:text-[#E3000F] [&>ins]:leading-none [&>.amount]:text-xs md:[&>.amount]:text-base [&>.amount]:font-extrabold [&>.amount]:text-[#E3000F] [&>.amount]:leading-none">
                  <?php echo wp_kses_post($price); ?>
                </div>
              </div>

              <!-- Animation mở rộng mô tả (Chỉ hiển thị trên màn hình lớn) -->
              <div class="hidden md:grid transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] grid-rows-[0fr] opacity-0 mt-0 group-hover:grid-rows-[1fr] group-hover:opacity-100 group-hover:mt-2">
                <p class="text-[11px] md:text-xs text-gray-600 font-medium leading-relaxed overflow-hidden line-clamp-3">
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
