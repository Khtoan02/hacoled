<?php
/**
 * Clean & Elegant 404 Page (White background, standard site footer, Trống đồng inside shape)
 */
defined('ABSPATH') || exit;

$this->renderHeader($header_type ?? 'default');
?>

<main id="primary" class="bg-white min-h-[70vh] flex flex-col justify-center items-center pt-36 sm:pt-44 lg:pt-52 pb-20 px-4 sm:px-6">
  <div class="max-w-xl w-full mx-auto text-center">
    
    <!-- Trống Đồng in a stylish shape badge -->
    <div class="relative w-24 h-24 sm:w-28 sm:h-28 mx-auto mb-6 flex items-center justify-center rounded-3xl bg-red-50 border border-red-100/80 shadow-sm overflow-hidden group">
      <!-- Dong Son drum pattern inside the shape -->
      <div class="absolute inset-0 bg-no-repeat bg-center bg-contain opacity-25 transition-transform duration-700 group-hover:scale-110"
           style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/dongson-optimized.webp'); ?>'); filter: invert(20%) sepia(85%) saturate(3000%) hue-rotate(345deg) brightness(85%);"></div>
      
      <!-- 404 Badge Text -->
      <span class="relative z-10 text-2xl sm:text-3xl font-black text-[#D90429] tracking-tight">404</span>
    </div>

    <!-- Title & Short Description -->
    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight mb-3">
      <?php esc_html_e('Không tìm thấy trang', 'hacoled'); ?>
    </h1>
    <p class="text-sm sm:text-base text-slate-500 leading-relaxed max-w-md mx-auto mb-8 font-normal">
      <?php esc_html_e('Rất tiếc! Trang bạn đang tìm kiếm không tồn tại hoặc đã được di chuyển sang địa chỉ khác.', 'hacoled'); ?>
    </p>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row items-center justify-center gap-3 max-w-sm mx-auto">
      <a href="<?php echo esc_url(home_url('/')); ?>"
         class="w-full sm:w-auto flex-1 bg-[#D90429] hover:bg-[#b90323] text-white font-bold px-6 py-3 rounded-xl flex items-center justify-center gap-2 transition-all duration-300 text-xs uppercase tracking-wider shadow-md hover:-translate-y-0.5 whitespace-nowrap">
        <i class="ph-bold ph-house text-base"></i>
        <span>Quay về trang chủ</span>
      </a>

      <a href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>"
         class="w-full sm:w-auto flex-1 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold px-6 py-3 rounded-xl flex items-center justify-center gap-2 transition-all duration-300 text-xs uppercase tracking-wider hover:-translate-y-0.5 whitespace-nowrap">
        <i class="ph-bold ph-headset text-base text-[#D90429]"></i>
        <span>Liên hệ hỗ trợ</span>
      </a>
    </div>

  </div>
</main>

<?php $this->renderFooter($footer_type ?? 'default'); ?>
