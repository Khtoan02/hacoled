<?php
/**
 * Reusable Sidebar Widget: Hotline Contact Info (Premium Red & Gold Trống Đồng Style)
 */
?>
<div class="sp-privileges-card relative rounded-2xl p-6 overflow-hidden shadow-xl group border border-red-800/10">
  <!-- Gold mat inner frame -->
  <div class="sp-priv-red-mat"></div>

  <!-- Trống đồng Đông Sơn image pattern overlay (Gold metallic filter) -->
  <div class="absolute -right-16 -bottom-16 w-64 h-64 pointer-events-none z-0 overflow-hidden opacity-20">
    <div class="w-full h-full bg-no-repeat bg-center bg-contain animate-[spin_120s_linear_infinite]"
      style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/dongson-optimized.webp'); ?>'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%);">
    </div>
  </div>

  <!-- Base background gradient -->
  <div class="absolute inset-0 bg-gradient-to-br from-[#a8031d] via-[#d90429] to-[#65000f] -z-10"></div>

  <!-- Gold radial ambient glow -->
  <div class="absolute inset-0 -z-10 opacity-30"
    style="background:radial-gradient(ellipse at 50% 0%, rgba(255,215,0,.4), transparent 70%);"></div>

  <!-- Gold glow orbs -->
  <div class="absolute -top-12 -right-8 w-48 h-48 bg-[#FFD700] rounded-full opacity-[0.12] blur-[50px] pointer-events-none"></div>
  <div class="absolute -bottom-12 -left-8 w-40 h-40 bg-[#FFA500] rounded-full opacity-[0.10] blur-[40px] pointer-events-none"></div>

  <!-- Glossy sweep -->
  <div class="absolute inset-0 sp-priv-gloss pointer-events-none"></div>

  <div class="relative z-10 space-y-4">
    <span class="inline-flex items-center gap-1 bg-white/10 text-white text-[9px] font-extrabold px-2.5 py-0.5 rounded uppercase tracking-wider font-mono">
      Hotline 24/7
    </span>
    
    <h3 class="text-sm font-extrabold leading-tight uppercase font-heading text-white tracking-wide">
      Liên hệ tư vấn lắp đặt miễn phí
    </h3>
    
    <p class="text-[10.5px] text-red-100/90 leading-relaxed font-light">
      Nhận ngay báo giá tối ưu nhất & khảo sát thiết kế bản vẽ phối cảnh 3D hoàn toàn miễn phí.
    </p>
    
    <div class="flex items-center justify-between pt-3 border-t border-white/15">
      <div class="flex flex-col">
        <span class="text-[9px] text-red-200 uppercase font-extrabold tracking-wider">Gọi ngay</span>
        <a href="tel:0342324488"
          class="text-sm font-black text-white hover:text-accent-gold transition-colors tracking-wide">034.232.44.88</a>
      </div>
      
      <a href="tel:0342324488"
        class="w-10 h-10 rounded-full bg-white text-[#D90429] flex items-center justify-center hover:bg-red-50 hover:shadow-lg hover:shadow-red-950/20 hover:-translate-y-0.5 transition-all duration-300">
        <i class="ph-bold ph-phone-call text-base animate-pulse"></i>
      </a>
    </div>
  </div>
</div>
