<!-- HacoLED Brand Footer with Dong Son Drum watermark -->
<footer class="relative overflow-hidden text-slate-200 lg:pt-16 pt-0 pb-0 leading-relaxed font-sans z-10 haco-brand-shell">
  
  <!-- Gold Top Border Line -->
  <div class="absolute top-0 left-0 w-full h-[4px] z-20 haco-gold-line"></div>
  
  <!-- Dong Son Bronze Drum watermark background -->
  <div class="absolute top-1/2 -translate-y-1/2 -right-[15%] w-[1300px] max-w-[150%] h-[1300px] bg-no-repeat bg-contain bg-center pointer-events-none mix-blend-screen z-0" 
       style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg/960px-Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg.png'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%); opacity: 0.20;">
  </div>

  <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10">

    <!-- SECTION 1: PRODUCT CATEGORIES -->
    <div class="mb-12 hidden md:block">
      <h4 class="text-white text-base font-bold uppercase tracking-wider mb-5 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-accent-gold">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m-15 0a2.25 2.25 0 00-1.5 2.122v8.378c0 .248.201.45.45.45h15.1c.249 0 .45-.202.45-.45V12a2.25 2.25 0 00-1.5-2.122m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128" />
        </svg>
        <?php _e('Danh mục sản phẩm', 'hacoled'); ?>
      </h4>
      
      <!-- Responsive dynamic categories flex wrapping -->
      <div class="flex flex-wrap gap-3 mb-10">
        <a class="flex-1 min-w-[160px] bg-primary-light/85 border border-accent-border rounded-lg py-3 px-2 text-center text-slate-200 text-sm font-medium hover:bg-primary-light hover:text-white hover:border-accent-gold backdrop-blur-sm transition-all duration-300 flex items-center justify-center" 
           href="https://hacoled.com/man-hinh-led-trong-nha/"><?php _e('Màn hình LED trong nhà', 'hacoled'); ?></a>
        <a class="flex-1 min-w-[160px] bg-primary-light/85 border border-accent-border rounded-lg py-3 px-2 text-center text-slate-200 text-sm font-medium hover:bg-primary-light hover:text-white hover:border-accent-gold backdrop-blur-sm transition-all duration-300 flex items-center justify-center" 
           href="https://hacoled.com/man-hinh-led-ngoai-troi/"><?php _e('Màn hình LED ngoài trời', 'hacoled'); ?></a>
        <a class="flex-1 min-w-[160px] bg-primary-light/85 border border-accent-border rounded-lg py-3 px-2 text-center text-slate-200 text-sm font-medium hover:bg-primary-light hover:text-white hover:border-accent-gold backdrop-blur-sm transition-all duration-300 flex items-center justify-center" 
           href="https://hacoled.com/man-hinh-led-truong-hoc/"><?php _e('Màn hình LED trường học', 'hacoled'); ?></a>
        <a class="flex-1 min-w-[160px] bg-primary-light/85 border border-accent-border rounded-lg py-3 px-2 text-center text-slate-200 text-sm font-medium hover:bg-primary-light hover:text-white hover:border-accent-gold backdrop-blur-sm transition-all duration-300 flex items-center justify-center" 
           href="https://hacoled.com/man-hinh-led-san-khau/"><?php _e('Màn hình LED sân khấu', 'hacoled'); ?></a>
        <a class="flex-1 min-w-[160px] bg-primary-light/85 border border-accent-border rounded-lg py-3 px-2 text-center text-slate-200 text-sm font-medium hover:bg-primary-light hover:text-white hover:border-accent-gold backdrop-blur-sm transition-all duration-300 flex items-center justify-center" 
           href="https://hacoled.com/man-hinh-ghep/"><?php _e('Màn hình ghép LCD', 'hacoled'); ?></a>
        <a class="flex-1 min-w-[160px] bg-primary-light/85 border border-accent-border rounded-lg py-3 px-2 text-center text-slate-200 text-sm font-medium hover:bg-primary-light hover:text-white hover:border-accent-gold backdrop-blur-sm transition-all duration-300 flex items-center justify-center" 
           href="https://hacoled.com/am-thanh/"><?php _e('Âm thanh | Ánh sáng', 'hacoled'); ?></a>
      </div>
    </div>

    <div class="border-t border-accent-border mb-10 hidden md:block"></div>

    <!-- SECTION 2: COMPANY INFO & BRANCHES -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-10 hidden md:grid">

      <!-- Column 1: Company Profile & Contacts -->
      <div class="space-y-4">
        <a class="inline-block -mt-6 -mb-4" href="<?php echo esc_url(home_url('/')); ?>">
          <img class="w-[220px] h-auto object-contain transition-all duration-300 hover:scale-[1.02] rounded" 
               src="<?php echo esc_url(home_url('/wp-content/uploads/2026/06/HacoLED-Logo-Moi.png')); ?>" alt="HacoLED Logo" />
        </a>
        <p class="text-sm text-slate-200">
          <?php _e('Công ty CP Công Nghệ HACO Việt Nam - Đơn vị tiên phong cung cấp giải pháp màn hình LED và thiết bị công nghệ hiển thị cao cấp.', 'hacoled'); ?>
        </p>

        <ul class="space-y-3">
          <li class="flex items-start gap-3 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-accent-gold shrink-0 mt-1">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.802-5.127-4.106-6.93-6.93l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
            </svg>
            <div>
              <span class="block text-[11px] text-slate-400 uppercase font-semibold"><?php _e('Hotline', 'hacoled'); ?></span>
              <a class="text-white font-bold text-base hover:text-accent-gold transition-colors" href="tel:0342324488">034.232.4488</a>
            </div>
          </li>
          <li class="flex items-start gap-3 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-accent-gold shrink-0 mt-1">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9.75v-4.5m0 4.5h4.5m-4.5 0l6-6m-3 18c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0 0l-3-3m3 3l3-3" />
            </svg>
            <div>
              <span class="block text-[11px] text-slate-400 uppercase font-semibold"><?php _e('CSKH / Mua hàng', 'hacoled'); ?></span>
              <a class="text-white hover:text-accent-gold transition-colors" href="tel:0868474488">086.847.4488</a> - 
              <a class="text-white hover:text-accent-gold transition-colors" href="tel:02422424488">0242.242.4488</a>
            </div>
          </li>
          <li class="flex items-center gap-3 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-accent-gold shrink-0">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0l-7.5-4.615a2.25 2.25 0 01-1.07-1.916V6.75" />
            </svg>
            <a class="text-white hover:text-accent-gold transition-colors font-medium" href="mailto:kinhdoanh@hacoled.com">kinhdoanh@hacoled.com</a>
          </li>
          <li class="flex items-center gap-3 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-accent-gold shrink-0">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5A3.375 3.375 0 0010.125 2.25H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
            <span class="text-white"><strong>MST:</strong> 0108701064</span>
          </li>
        </ul>

        <!-- Social Media SVG Link Icons -->
        <div class="flex gap-2 pt-2">
          <!-- Facebook SVG -->
          <a class="w-9 h-9 rounded bg-haco-red/80 border border-accent-border flex items-center justify-center text-slate-300 hover:bg-accent-gold hover:text-primary transition-all"
             href="https://www.facebook.com/hacoled" target="_blank" rel="noopener" aria-label="Facebook">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M9 8H7v3h2v9h3v-9h3l.5-3H12V6c0-.883.398-1.5 1.5-1.5H15V1h-2.5C9.945 1 9 2.557 9 4.833V8z"/></svg>
          </a>
          <!-- Twitter / X SVG -->
          <a class="w-9 h-9 rounded bg-haco-red/80 border border-accent-border flex items-center justify-center text-slate-300 hover:bg-accent-gold hover:text-primary transition-all"
             href="https://x.com/HacoLed" target="_blank" rel="noopener" aria-label="X (Twitter)">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
          <!-- Youtube SVG -->
          <a class="w-9 h-9 rounded bg-haco-red/80 border border-accent-border flex items-center justify-center text-slate-300 hover:bg-accent-gold hover:text-primary transition-all"
             href="https://www.youtube.com/@hacoled" target="_blank" rel="noopener" aria-label="YouTube">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.163a3.003 3.003 0 00-2.11-2.11C19.517 3.545 12 3.545 12 3.545s-7.517 0-9.388.508a3.003 3.003 0 00-2.11 2.11C0 8.033 0 12 0 12s0 3.967.502 5.837a3.003 3.003 0 002.11 2.11c1.871.508 9.388.508 9.388.508s7.517 0 9.388-.508a3.003 3.003 0 002.11-2.11C24 15.967 24 12 24 12s0-3.967-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
          </a>
          <!-- Linkedin SVG -->
          <a class="w-9 h-9 rounded bg-haco-red/80 border border-accent-border flex items-center justify-center text-slate-300 hover:bg-accent-gold hover:text-primary transition-all"
             href="https://www.linkedin.com/in/hacoled/" target="_blank" rel="noopener" aria-label="LinkedIn">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
          </a>
        </div>
      </div>

      <!-- Column 2: Northern HQ & Offices -->
      <div class="space-y-4">
        <h4 class="text-white text-base font-bold uppercase tracking-wider mb-5"><?php _e('Trụ sở & VP Miền Bắc', 'hacoled'); ?></h4>
        
        <div class="space-y-4">
          <div>
            <div class="flex items-center gap-2 text-white font-semibold text-sm mb-1.5">
              <span class="bg-gradient-to-r from-accent-gold to-yellow-500 bg-clip-text text-transparent uppercase"><?php _e('TRỤ SỞ CHÍNH', 'hacoled'); ?></span>
            </div>
            <ul class="list-none pl-6 text-sm text-slate-200 space-y-1 relative">
              <span class="absolute left-0 top-1.5 w-1.5 h-1.5 rounded-full bg-accent-gold"></span>
              <li><?php _e('Ngách 57/92 Đường Quang Minh, Thôn Gia Thượng 2, Xã Quang Minh, TP. Hà Nội', 'hacoled'); ?></li>
            </ul>
          </div>

          <div>
            <div class="flex items-center gap-2 text-white font-semibold text-sm mb-1.5">
              <span class="bg-gradient-to-r from-accent-gold to-yellow-500 bg-clip-text text-transparent uppercase"><?php _e('VĂN PHÒNG HÀ NỘI', 'hacoled'); ?></span>
            </div>
            <ul class="list-none pl-6 text-sm text-slate-200 space-y-2 relative">
              <span class="absolute left-0 top-1.5 w-1.5 h-1.5 rounded-full bg-accent-gold"></span>
              <li><?php _e('Số 11 ngõ 10 Nghĩa Đô, phường Nghĩa Đô, TP. Hà Nội', 'hacoled'); ?></li>
              <li class="text-slate-400 text-xs mt-1">
                <?php _e('Liên hệ:', 'hacoled'); ?> 
                <a class="text-slate-200 hover:text-accent-gold transition-colors" href="tel:02422424488">0242.242.4488</a> - 
                <a class="text-slate-200 hover:text-accent-gold transition-colors" href="tel:0868474488">086.847.4488</a> - 
                <a class="text-slate-200 hover:text-accent-gold transition-colors" href="tel:0342324488">034.232.4488</a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Column 3: Branch Network -->
      <div class="space-y-4">
        <h4 class="text-white text-base font-bold uppercase tracking-wider mb-5"><?php _e('Hệ thống chi nhánh', 'hacoled'); ?></h4>
        
        <div class="space-y-4">
          <!-- HCM -->
          <div>
            <div class="flex items-center gap-2 text-white font-semibold text-sm mb-1.5">
              <span class="bg-gradient-to-r from-accent-gold to-yellow-500 bg-clip-text text-transparent uppercase"><?php _e('CN HỒ CHÍ MINH', 'hacoled'); ?></span>
            </div>
            <ul class="list-none pl-6 text-sm text-slate-200 relative">
              <span class="absolute left-0 top-1.5 w-1.5 h-1.5 rounded-full bg-accent-gold"></span>
              <li><?php _e('400 Đ.Nguyễn Thị Thập, P. Tân Hưng, TP. HCM', 'hacoled'); ?></li>
              <li class="text-slate-400 text-xs mt-1">
                <?php _e('Liên hệ:', 'hacoled'); ?> 
                <a class="text-slate-200 hover:text-accent-gold transition-colors" href="tel:02866728779">0286.672.8779</a> - 
                <a class="text-slate-200 hover:text-accent-gold transition-colors" href="tel:0896894488">089.689.4488</a>
              </li>
            </ul>
          </div>

          <!-- DN -->
          <div>
            <div class="flex items-center gap-2 text-white font-semibold text-sm mb-1.5">
              <span class="bg-gradient-to-r from-accent-gold to-yellow-500 bg-clip-text text-transparent uppercase"><?php _e('CN ĐÀ NẴNG', 'hacoled'); ?></span>
            </div>
            <ul class="list-none pl-6 text-sm text-slate-200 relative">
              <span class="absolute left-0 top-1.5 w-1.5 h-1.5 rounded-full bg-accent-gold"></span>
              <li><?php _e('Số 88 Tây Sơn, P. Ngũ Hành Sơn, TP. Đà Nẵng', 'hacoled'); ?></li>
              <li class="text-slate-400 text-xs mt-1">
                <?php _e('Liên hệ:', 'hacoled'); ?> <a class="text-slate-200 hover:text-accent-gold transition-colors" href="tel:0973954488">097.395.4488</a>
              </li>
            </ul>
          </div>

          <!-- TN -->
          <div>
            <div class="flex items-center gap-2 text-white font-semibold text-sm mb-1.5">
              <span class="bg-gradient-to-r from-accent-gold to-yellow-500 bg-clip-text text-transparent uppercase"><?php _e('CN TÂY NGUYÊN', 'hacoled'); ?></span>
            </div>
            <ul class="list-none pl-6 text-sm text-slate-200 relative">
              <span class="absolute left-0 top-1.5 w-1.5 h-1.5 rounded-full bg-accent-gold"></span>
              <li><?php _e('TDP4, P. Đông Gia Nghĩa, Lâm Đồng', 'hacoled'); ?></li>
              <li class="text-slate-400 text-xs mt-1">
                <?php _e('Liên hệ:', 'hacoled'); ?> <a class="text-slate-200 hover:text-accent-gold transition-colors" href="tel:0973954488">097.395.4488</a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Column 4: Quick links & Certification -->
      <div class="space-y-4">
        <h4 class="text-white text-base font-bold uppercase tracking-wider mb-5"><?php _e('Về HacoLED', 'hacoled'); ?></h4>
        
        <ul class="space-y-3">
          <li>
            <a class="flex items-center gap-2 text-sm text-slate-200 hover:text-accent-gold transition-colors" href="https://hacoled.com/gioi-thieu/">
              <span class="w-1.5 h-1.5 bg-accent-gold/40 rounded-full"></span>
              <?php _e('Giới thiệu về HacoLED', 'hacoled'); ?>
            </a>
          </li>
          <li>
            <a class="flex items-center gap-2 text-sm text-slate-200 hover:text-accent-gold transition-colors" href="https://hacoled.com/hang-muc-da-thi-cong/">
              <span class="w-1.5 h-1.5 bg-accent-gold/40 rounded-full"></span>
              <?php _e('Dự án đã triển khai', 'hacoled'); ?>
            </a>
          </li>
          <li>
            <a class="flex items-center gap-2 text-sm text-slate-200 hover:text-accent-gold transition-colors" href="https://hacoled.com/tin-tuc-noi-bat/">
              <span class="w-1.5 h-1.5 bg-accent-gold/40 rounded-full"></span>
              <?php _e('Blog / Tin tức công nghệ', 'hacoled'); ?>
            </a>
          </li>
          <li>
            <a class="flex items-center gap-2 text-sm text-slate-200 hover:text-accent-gold transition-colors" href="https://hacoled.com/lien-he/">
              <span class="w-1.5 h-1.5 bg-accent-gold/40 rounded-full"></span>
              <?php _e('Liên hệ với chúng tôi', 'hacoled'); ?>
            </a>
          </li>
        </ul>

        <!-- DMCA Certification Status -->
        <div class="pt-4">
          <a class="inline-block hover:opacity-85 transition-opacity" 
             href="https://www.dmca.com/Protection/Status.aspx?ID=4a1eb724-aeb4-4217-a7c4-a41a8aa95f1b&amp;refurl=https://hacoled.com/" 
             target="_blank" rel="nofollow noopener noreferrer">
            <img class="h-8 w-auto" src="<?php echo get_template_directory_uri(); ?>/assets/images/dmca-badge.png" alt="DMCA.com Protection Status" />
          </a>
        </div>
      </div>

    </div>
  </div>

  <!-- SECTION 3: COPYRIGHT BOTTOM STRIP -->
  <div class="relative bg-black/45 border-t border-accent-border py-4 text-center text-xs text-slate-400 lg:mt-10 mt-0 z-10">
    <div class="max-w-[1440px] mx-auto px-4 lg:px-8">
      <p>Copyright 2026 © <strong class="text-white">HacoLED</strong>. All Rights Reserved.</p>
    </div>
  </div>

</footer>

<!-- JSON-LD LocalBusiness Schema for Search Engines (SEO E-E-A-T) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "HACOLED",
  "image": "<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo-haco.png'); ?>",
  "@id": "https://hacoled.com/#organization",
  "url": "https://hacoled.com/",
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

<?php get_template_part('views/components/tech-bg-script'); ?>
<?php wp_footer(); ?>
</body>
</html>
