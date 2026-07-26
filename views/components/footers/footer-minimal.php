<?php
$custom_logo_id = get_theme_mod('custom_logo');
$footer_logo    = $custom_logo_id ? wp_get_attachment_image_url($custom_logo_id, 'full') : home_url('/wp-content/uploads/2026/06/HacoLED-Logo-Moi.png');
if (empty($footer_logo)) {
    $footer_logo = get_template_directory_uri() . '/assets/images/logo-haco.png';
}
?>
<!-- Minimal Footer Module (HacoLED Brand Maroon Theme) -->
<footer class="bg-primary text-slate-400 border-t-2 border-accent-gold py-8 text-xs font-sans z-10 relative">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
      
      <!-- Left: Logo & Copyright -->
      <div class="flex items-center gap-3">
        <a class="inline-block" href="<?php echo esc_url(home_url('/')); ?>">
          <img class="h-8 w-auto object-contain transition-all duration-300" 
               src="<?php echo esc_url($footer_logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?> Logo" />
        </a>
        <span class="text-accent-border">|</span>
        <p>&copy; <?php echo date('Y'); ?> HacoLED. All Rights Reserved.</p>
      </div>

      <!-- Right: Creator badge link -->
      <div class="flex items-center gap-4">
        <span>Designed by <a href="https://facebook.com/khanhtoan678" target="_blank" class="text-slate-200 hover:text-accent-gold underline">Khánh Toàn</a></span>
        <span class="text-accent-border">|</span>
        <div class="flex gap-4">
          <a href="#" class="hover:text-slate-200 transition-colors"><?php _e('Trợ giúp', 'hacoled'); ?></a>
          <a href="#" class="hover:text-slate-200 transition-colors"><?php _e('Bảo mật', 'hacoled'); ?></a>
        </div>
      </div>

    </div>
  </div>
</footer>

  <!-- SVG Filter Definitions (Khanh Toan Design Spec) -->
  <svg style="display:none;" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
    <defs>
      <!-- #D4AF37 Metallic Gold cho nền sáng -->
      <filter id="to-gold-light" color-interpolation-filters="sRGB">
        <feColorMatrix type="matrix" values="
          -0.831  0  0  0  0.831
           0  -0.686  0  0  0.686
           0  0  -0.216  0  0.216
          -1  0  0  0  1
        " result="gold"/>
        <feComposite in="gold" in2="SourceGraphic" operator="in"/>
      </filter>
      <!-- #FFD700 Bright Gold cho nền tối -->
      <filter id="to-gold-dark" color-interpolation-filters="sRGB">
        <feColorMatrix type="matrix" values="
          -1  0  0  0  1
           0  -0.843  0  0  0.843
           0  0  0  0  0
          -1  0  0  0  1
        " result="gold"/>
        <feComposite in="gold" in2="SourceGraphic" operator="in"/>
      </filter>
    </defs>
  </svg>

<?php get_template_part('views/components/tech-bg-script'); ?>
<?php wp_footer(); ?>
</body>
</html>
