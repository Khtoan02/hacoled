<?php
/**
 * HacoLED Executive Brand Footer Template
 */

$custom_logo_id = get_theme_mod('custom_logo');
$footer_logo    = $custom_logo_id ? wp_get_attachment_image_url($custom_logo_id, 'full') : home_url('/wp-content/uploads/2026/06/HacoLED-Logo-Moi.png');
if (empty($footer_logo)) {
    $footer_logo = get_template_directory_uri() . '/assets/images/logo-haco.png';
}
?>
<!-- HacoLED Brand Footer -->
<footer class="relative overflow-hidden text-white pt-0 pb-0 leading-relaxed font-sans z-10 haco-brand-shell">
  
  <!-- Gold Top Border Line -->
  <div class="absolute top-0 left-0 w-full h-[4px] z-20 haco-gold-line"></div>

  <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10">

    <!-- COMPANY INFO & BRANCHES GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10 py-10 lg:py-14 border-b border-white/15">

      <!-- Column 1: Company Profile & Contacts -->
      <div class="space-y-4 relative">
        
        <!-- Logo Wrapper with Centered Dong Son Drum Stamp (1160px Watermark) -->
        <div class="relative inline-block my-1">
          <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[1160px] h-[1160px] max-w-[none] bg-no-repeat bg-center bg-contain opacity-[0.08] pointer-events-none z-0 mix-blend-screen"
               style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/dongson-optimized.webp'); ?>'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%);"></div>
          <a class="relative z-10 inline-block" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
            <img class="w-[220px] max-w-full h-auto object-contain transition-all duration-300 hover:scale-[1.02] rounded" 
                 src="<?php echo esc_url($footer_logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" />
          </a>
        </div>

        <p class="text-xs sm:text-sm text-white/90 leading-relaxed font-medium relative z-10">
          <?php _e('Công ty CP Công Nghệ HACO Việt Nam - Đơn vị tiên phong cung cấp giải pháp màn hình LED và thiết bị công nghệ hiển thị cao cấp.', 'hacoled'); ?>
        </p>

        <ul class="space-y-3.5 relative z-10">
          <li class="flex items-start gap-3 text-sm">
            <i class="ph-bold ph-phone-call text-[#FFD700] text-xl shrink-0 mt-0.5"></i>
            <div>
              <span class="block text-[11px] text-[#FFE8A3] uppercase font-extrabold tracking-wider"><?php _e('Hotline Báo Giá', 'hacoled'); ?></span>
              <a class="text-white font-extrabold text-base lg:text-lg hover:text-[#FFD700] transition-colors tracking-wide" href="tel:0342324488">034.232.4488</a>
            </div>
          </li>
          <li class="flex items-start gap-3 text-sm">
            <i class="ph-bold ph-headset text-[#FFD700] text-xl shrink-0 mt-0.5"></i>
            <div>
              <span class="block text-[11px] text-[#FFE8A3] uppercase font-extrabold tracking-wider"><?php _e('CSKH / Mua hàng', 'hacoled'); ?></span>
              <div class="flex items-center gap-1.5 font-bold text-white">
                <a class="hover:text-[#FFD700] transition-colors" href="tel:0868474488">086.847.4488</a>
                <span class="text-white/50">&bull;</span>
                <a class="hover:text-[#FFD700] transition-colors" href="tel:02422424488">0242.242.4488</a>
              </div>
            </div>
          </li>
          <li class="flex items-center gap-3 text-sm">
            <i class="ph-bold ph-envelope-simple text-[#FFD700] text-xl shrink-0"></i>
            <a class="text-white hover:text-[#FFD700] transition-colors font-bold" href="mailto:kinhdoanh@hacoled.com">kinhdoanh@hacoled.com</a>
          </li>
          <li class="flex items-center gap-3 text-sm">
            <i class="ph-bold ph-file-text text-[#FFD700] text-xl shrink-0"></i>
            <span class="text-white font-semibold"><strong>MST:</strong> 0108701064</span>
          </li>
        </ul>

        <!-- Social Media Icons (Phosphor Icons) -->
        <div class="flex gap-2.5 pt-2 relative z-10">
          <a class="w-9 h-9 rounded-xl bg-black/30 border border-[#FFD700]/40 flex items-center justify-center text-white hover:bg-[#FFD700] hover:text-[#4a1800] transition-all shadow-sm"
             href="https://www.facebook.com/hacoled" target="_blank" rel="noopener" aria-label="Facebook">
            <i class="ph-bold ph-facebook-logo text-lg"></i>
          </a>
          <a class="w-9 h-9 rounded-xl bg-black/30 border border-[#FFD700]/40 flex items-center justify-center text-white hover:bg-[#FFD700] hover:text-[#4a1800] transition-all shadow-sm"
             href="https://x.com/HacoLed" target="_blank" rel="noopener" aria-label="X (Twitter)">
            <i class="ph-bold ph-x-logo text-lg"></i>
          </a>
          <a class="w-9 h-9 rounded-xl bg-black/30 border border-[#FFD700]/40 flex items-center justify-center text-white hover:bg-[#FFD700] hover:text-[#4a1800] transition-all shadow-sm"
             href="https://www.youtube.com/@hacoled" target="_blank" rel="noopener" aria-label="YouTube">
            <i class="ph-bold ph-youtube-logo text-lg"></i>
          </a>
          <a class="w-9 h-9 rounded-xl bg-black/30 border border-[#FFD700]/40 flex items-center justify-center text-white hover:bg-[#FFD700] hover:text-[#4a1800] transition-all shadow-sm"
             href="https://www.linkedin.com/in/hacoled/" target="_blank" rel="noopener" aria-label="LinkedIn">
            <i class="ph-bold ph-linkedin-logo text-lg"></i>
          </a>
        </div>
      </div>

      <!-- Column 2: Northern HQ & Offices -->
      <div class="space-y-4">
        <h4 class="text-white text-base lg:text-lg font-extrabold uppercase tracking-wider mb-5 flex items-center gap-2">
          <i class="ph-bold ph-buildings text-[#FFD700] text-xl"></i>
          <?php _e('Trụ sở & VP Miền Bắc', 'hacoled'); ?>
        </h4>
        
        <div class="space-y-4">
          <div>
            <div class="flex items-center gap-2 text-[#FFD700] font-extrabold text-xs uppercase tracking-wider mb-1.5">
              <span class="w-1.5 h-1.5 rounded-full bg-[#FFD700]"></span>
              <span><?php _e('TRỤ SỞ CHÍNH', 'hacoled'); ?></span>
            </div>
            <p class="text-xs sm:text-sm text-white/90 leading-relaxed font-medium pl-3.5 border-l-2 border-[#FFD700]/40">
              <?php _e('Ngách 57/92 Đường Quang Minh, Thôn Gia Thượng 2, Xã Quang Minh, TP. Hà Nội', 'hacoled'); ?>
            </p>
          </div>

          <div>
            <div class="flex items-center gap-2 text-[#FFD700] font-extrabold text-xs uppercase tracking-wider mb-1.5">
              <span class="w-1.5 h-1.5 rounded-full bg-[#FFD700]"></span>
              <span><?php _e('VĂN PHÒNG HÀ NỘI', 'hacoled'); ?></span>
            </div>
            <div class="pl-3.5 border-l-2 border-[#FFD700]/40 space-y-1">
              <p class="text-xs sm:text-sm text-white/90 leading-relaxed font-medium">
                <?php _e('Số 11 ngõ 10 Nghĩa Đô, phường Nghĩa Đô, TP. Hà Nội', 'hacoled'); ?>
              </p>
              <div class="text-xs text-[#FFE8A3] font-semibold pt-0.5">
                <span><?php _e('Liên hệ:', 'hacoled'); ?></span> 
                <a class="text-white hover:text-[#FFD700] transition-colors" href="tel:02422424488">0242.242.4488</a> - 
                <a class="text-white hover:text-[#FFD700] transition-colors" href="tel:0868474488">086.847.4488</a> - 
                <a class="text-white hover:text-[#FFD700] transition-colors" href="tel:0342324488">034.232.4488</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Column 3: Branch Network -->
      <div class="space-y-4">
        <h4 class="text-white text-base lg:text-lg font-extrabold uppercase tracking-wider mb-5 flex items-center gap-2">
          <i class="ph-bold ph-map-pin text-[#FFD700] text-xl"></i>
          <?php _e('Hệ thống chi nhánh', 'hacoled'); ?>
        </h4>
        
        <div class="space-y-4">
          <!-- HCM -->
          <div>
            <div class="flex items-center gap-2 text-[#FFD700] font-extrabold text-xs uppercase tracking-wider mb-1.5">
              <span class="w-1.5 h-1.5 rounded-full bg-[#FFD700]"></span>
              <span><?php _e('CN HỒ CHÍ MINH', 'hacoled'); ?></span>
            </div>
            <div class="pl-3.5 border-l-2 border-[#FFD700]/40 space-y-1">
              <p class="text-xs sm:text-sm text-white/90 leading-relaxed font-medium">
                <?php _e('400 Đ.Nguyễn Thị Thập, P. Tân Hưng, TP. HCM', 'hacoled'); ?>
              </p>
              <div class="text-xs text-[#FFE8A3] font-semibold pt-0.5">
                <span><?php _e('Liên hệ:', 'hacoled'); ?></span> 
                <a class="text-white hover:text-[#FFD700] transition-colors" href="tel:02866728779">0286.672.8779</a> - 
                <a class="text-white hover:text-[#FFD700] transition-colors" href="tel:0896894488">089.689.4488</a>
              </div>
            </div>
          </div>

          <!-- DN -->
          <div>
            <div class="flex items-center gap-2 text-[#FFD700] font-extrabold text-xs uppercase tracking-wider mb-1.5">
              <span class="w-1.5 h-1.5 rounded-full bg-[#FFD700]"></span>
              <span><?php _e('CN ĐÀ NẴNG', 'hacoled'); ?></span>
            </div>
            <div class="pl-3.5 border-l-2 border-[#FFD700]/40 space-y-1">
              <p class="text-xs sm:text-sm text-white/90 leading-relaxed font-medium">
                <?php _e('Số 88 Tây Sơn, P. Ngũ Hành Sơn, TP. Đà Nẵng', 'hacoled'); ?>
              </p>
              <div class="text-xs text-[#FFE8A3] font-semibold pt-0.5">
                <span><?php _e('Liên hệ:', 'hacoled'); ?></span> 
                <a class="text-white hover:text-[#FFD700] transition-colors" href="tel:0973954488">097.395.4488</a>
              </div>
            </div>
          </div>

          <!-- TN -->
          <div>
            <div class="flex items-center gap-2 text-[#FFD700] font-extrabold text-xs uppercase tracking-wider mb-1.5">
              <span class="w-1.5 h-1.5 rounded-full bg-[#FFD700]"></span>
              <span><?php _e('CN TÂY NGUYÊN', 'hacoled'); ?></span>
            </div>
            <div class="pl-3.5 border-l-2 border-[#FFD700]/40 space-y-1">
              <p class="text-xs sm:text-sm text-white/90 leading-relaxed font-medium">
                <?php _e('TDP4, P. Đông Gia Nghĩa, Lâm Đồng', 'hacoled'); ?>
              </p>
              <div class="text-xs text-[#FFE8A3] font-semibold pt-0.5">
                <span><?php _e('Liên hệ:', 'hacoled'); ?></span> 
                <a class="text-white hover:text-[#FFD700] transition-colors" href="tel:0973954488">097.395.4488</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Column 4: Quick links & Certification -->
      <div class="space-y-4">
        <h4 class="text-white text-base lg:text-lg font-extrabold uppercase tracking-wider mb-5 flex items-center gap-2">
          <i class="ph-bold ph-info text-[#FFD700] text-xl"></i>
          <?php _e('Về HacoLED', 'hacoled'); ?>
        </h4>
        
        <ul class="space-y-3">
          <li>
            <a class="group flex items-center gap-2 text-xs sm:text-sm text-white/90 hover:text-[#FFD700] transition-colors font-medium" 
               href="<?php echo esc_url(hacoled_managed_page_url('about')); ?>">
              <i class="ph-bold ph-caret-right text-[#FFD700] text-xs transition-transform group-hover:translate-x-1"></i>
              <span><?php _e('Giới thiệu về HacoLED', 'hacoled'); ?></span>
            </a>
          </li>
          <li>
            <a class="group flex items-center gap-2 text-xs sm:text-sm text-white/90 hover:text-[#FFD700] transition-colors font-medium" 
               href="<?php echo esc_url(hacoled_managed_page_url('projects')); ?>">
              <i class="ph-bold ph-caret-right text-[#FFD700] text-xs transition-transform group-hover:translate-x-1"></i>
              <span><?php _e('Dự án đã triển khai', 'hacoled'); ?></span>
            </a>
          </li>
          <li>
            <a class="group flex items-center gap-2 text-xs sm:text-sm text-white/90 hover:text-[#FFD700] transition-colors font-medium" 
               href="<?php echo esc_url(hacoled_managed_page_url('blog')); ?>">
              <i class="ph-bold ph-caret-right text-[#FFD700] text-xs transition-transform group-hover:translate-x-1"></i>
              <span><?php _e('Blog / Tin tức công nghệ', 'hacoled'); ?></span>
            </a>
          </li>
          <li>
            <a class="group flex items-center gap-2 text-xs sm:text-sm text-white/90 hover:text-[#FFD700] transition-colors font-medium" 
               href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>">
              <i class="ph-bold ph-caret-right text-[#FFD700] text-xs transition-transform group-hover:translate-x-1"></i>
              <span><?php _e('Liên hệ với chúng tôi', 'hacoled'); ?></span>
            </a>
          </li>
        </ul>

        <!-- DMCA Certification Status -->
        <div class="pt-4">
          <a class="inline-block hover:opacity-85 transition-opacity" 
             href="https://www.dmca.com/Protection/Status.aspx?ID=4a1eb724-aeb4-4217-a7c4-a41a8aa95f1b&amp;refurl=https://hacoled.com/" 
             target="_blank" rel="nofollow noopener noreferrer">
            <img class="h-9 w-auto" src="<?php echo get_template_directory_uri(); ?>/assets/images/dmca-badge.png" alt="DMCA.com Protection Status" />
          </a>
        </div>
      </div>

    </div>
  </div>

  <!-- COPYRIGHT BOTTOM STRIP -->
  <div class="relative bg-black/45 border-t border-white/15 py-4 text-center text-xs text-white/80 z-10">
    <div class="max-w-[1440px] mx-auto px-4 lg:px-8">
      <p class="font-medium">Copyright <?php echo date('Y'); ?> © <strong class="text-white font-bold">HACOLED CO., LTD</strong>. All Rights Reserved.</p>
    </div>
  </div>

</footer>

<!-- JSON-LD LocalBusiness Schema for Search Engines (SEO E-E-A-T) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "HACOLED",
  "image": "<?php echo esc_url($footer_logo); ?>",
  "@id": "<?php echo esc_url(home_url('/#organization')); ?>",
  "url": "<?php echo esc_url(home_url('/')); ?>",
  "telephone": "0342324488",
  "priceRange": "$$",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Số 11 ngõ 10 Nghĩa Đô, phường Nghĩa Đô",
    "addressLocality": "Hà Nội",
    "addressCountry": "VN"
  },
  "taxID": "0108701064",
  "email": "kinhdoanh@hacoled.com",
  "sameAs": [
    "https://www.facebook.com/hacoled",
    "https://x.com/HacoLed",
    "https://www.youtube.com/@hacoled",
    "https://www.linkedin.com/in/hacoled"
  ],
  "contactPoint": [
    {
      "@type": "ContactPoint",
      "telephone": "+84-342324488",
      "contactType": "sales",
      "areaServed": "VN",
      "availableLanguage": ["Vietnamese"]
    },
    {
      "@type": "ContactPoint",
      "telephone": "+84-868474488",
      "contactType": "customer service",
      "areaServed": "VN",
      "availableLanguage": ["Vietnamese"]
    }
  ]
}
</script>

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

<?php wp_footer(); ?>
</body>
</html>
