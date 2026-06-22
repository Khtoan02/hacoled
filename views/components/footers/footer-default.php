<!-- HacoLED Brand Footer with Dong Son Drum watermark -->
<footer class="hidden lg:block relative overflow-hidden text-slate-200 pt-16 pb-0 leading-relaxed font-sans z-10" style="background: linear-gradient(to bottom right, #b31217, #8a0b10);">
  
  <!-- Gold Top Border Line -->
  <div class="absolute top-0 left-0 w-full h-[4px] z-20" style="background: linear-gradient(90deg, #b45309, #fbbf24, #fffbeb, #fbbf24, #b45309);"></div>
  
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
          <a class="w-9 h-9 rounded bg-[#7f1d1d] border border-accent-border flex items-center justify-center text-slate-300 hover:bg-accent-gold hover:text-primary transition-all" 
             href="https://www.facebook.com/hacoled" target="_blank" rel="noopener" aria-label="Facebook">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M9 8H7v3h2v9h3v-9h3l.5-3H12V6c0-.883.398-1.5 1.5-1.5H15V1h-2.5C9.945 1 9 2.557 9 4.833V8z"/></svg>
          </a>
          <!-- Twitter / X SVG -->
          <a class="w-9 h-9 rounded bg-[#7f1d1d] border border-accent-border flex items-center justify-center text-slate-300 hover:bg-accent-gold hover:text-primary transition-all" 
             href="https://x.com/HacoLed" target="_blank" rel="noopener" aria-label="X (Twitter)">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
          <!-- Youtube SVG -->
          <a class="w-9 h-9 rounded bg-[#7f1d1d] border border-accent-border flex items-center justify-center text-slate-300 hover:bg-accent-gold hover:text-primary transition-all" 
             href="https://www.youtube.com/@hacoled" target="_blank" rel="noopener" aria-label="YouTube">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.163a3.003 3.003 0 00-2.11-2.11C19.517 3.545 12 3.545 12 3.545s-7.517 0-9.388.508a3.003 3.003 0 00-2.11 2.11C0 8.033 0 12 0 12s0 3.967.502 5.837a3.003 3.003 0 002.11 2.11c1.871.508 9.388.508 9.388.508s7.517 0 9.388-.508a3.003 3.003 0 002.11-2.11C24 15.967 24 12 24 12s0-3.967-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
          </a>
          <!-- Linkedin SVG -->
          <a class="w-9 h-9 rounded bg-[#7f1d1d] border border-accent-border flex items-center justify-center text-slate-300 hover:bg-accent-gold hover:text-primary transition-all" 
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
  <div class="relative bg-black/45 border-t border-accent-border py-4 text-center text-xs text-slate-400 mt-10 z-10">
    <div class="max-w-[1440px] mx-auto px-4 lg:px-8">
      <p>Copyright 2026 © <strong class="text-white">HacoLED</strong>. All Rights Reserved.</p>
    </div>
  </div>

</footer>

<?php
// Define local variables for mobile bar
$footer_about_url    = home_url('/gioi-thieu/');
$footer_services_url = home_url('/dich-vu/');
$footer_contact_url  = home_url('/lien-he/');
$footer_news_url     = home_url('/tin-tuc/');
$footer_commitment_url = home_url('/cam-ket-chat-luong/');
$footer_careers_url  = home_url('/tuyen-dung/');

$footer_about_pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-about.php'));
if (!empty($footer_about_pages)) $footer_about_url = get_permalink($footer_about_pages[0]->ID);

$footer_services_pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-services.php'));
if (!empty($footer_services_pages)) $footer_services_url = get_permalink($footer_services_pages[0]->ID);

$footer_contact_pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-contact.php'));
if (!empty($footer_contact_pages)) $footer_contact_url = get_permalink($footer_contact_pages[0]->ID);

$footer_commitment_pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-commitment.php'));
if (!empty($footer_commitment_pages)) $footer_commitment_url = get_permalink($footer_commitment_pages[0]->ID);

$footer_careers_pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-careers.php'));
if (!empty($footer_careers_pages)) $footer_careers_url = get_permalink($footer_careers_pages[0]->ID);

$footer_job_args = array(
    'post_type'      => 'job',
    'posts_per_page' => 5,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC'
);
$footer_jobs = get_posts($footer_job_args);
?>

<!-- Mobile Bottom Navigation & Drawers (lg:hidden) -->
<div x-data="{ activeDrawer: null }" class="lg:hidden">
  
  <!-- Backdrop Overlay -->
  <div x-show="activeDrawer" x-cloak
       @click="activeDrawer = null"
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="opacity-0"
       x-transition:enter-end="opacity-100"
       x-transition:leave="transition ease-in duration-200"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0"
       class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[190]">
  </div>

  <!-- Bottom Navigation Bar -->
  <div class="fixed bottom-0 left-0 right-0 z-[210] bg-gradient-to-t from-[#7a080c] to-[#990d12] border-t border-white/10 shadow-[0_-5px_25px_rgba(0,0,0,0.3)]" style="padding-bottom: env(safe-area-inset-bottom);">
    <div class="flex justify-around items-center h-16 px-2">
      
      <!-- Tab 1: Trang chủ -->
      <a href="<?php echo esc_url(home_url('/')); ?>" 
         class="flex items-center justify-center w-16 h-full transition-all duration-200"
         :class="activeDrawer === null && (window.location.pathname === '/' || window.location.pathname === '/index.php') ? 'text-[#fbbf24] scale-105' : 'text-white/70 hover:text-white'">
        <i class="text-[26px]" :class="activeDrawer === null && (window.location.pathname === '/' || window.location.pathname === '/index.php') ? 'ph-fill ph-house' : 'ph-bold ph-house'"></i>
      </a>

      <!-- Tab 2: Sản phẩm -->
      <button @click="activeDrawer = activeDrawer === 'products' ? null : 'products'" 
              class="flex items-center justify-center w-16 h-full transition-all duration-200 outline-none"
              :class="activeDrawer === 'products' ? 'text-[#fbbf24] scale-105' : 'text-white/70 hover:text-white'">
        <i class="text-[26px]" :class="activeDrawer === 'products' ? 'ph-fill ph-package' : 'ph-bold ph-package'"></i>
      </button>

      <!-- Tab 3: Blog -->
      <button @click="activeDrawer = activeDrawer === 'blog' ? null : 'blog'" 
              class="flex items-center justify-center w-16 h-full transition-all duration-200 outline-none"
              :class="activeDrawer === 'blog' ? 'text-[#fbbf24] scale-105' : 'text-white/70 hover:text-white'">
        <i class="text-[26px]" :class="activeDrawer === 'blog' ? 'ph-fill ph-newspaper' : 'ph-bold ph-newspaper'"></i>
      </button>

      <!-- Tab 4: Info -->
      <button @click="activeDrawer = activeDrawer === 'info' ? null : 'info'" 
              class="flex items-center justify-center w-16 h-full transition-all duration-200 outline-none"
              :class="activeDrawer === 'info' ? 'text-[#fbbf24] scale-105' : 'text-white/70 hover:text-white'">
        <i class="text-[26px]" :class="activeDrawer === 'info' ? 'ph-fill ph-info' : 'ph-bold ph-info'"></i>
      </button>

      <!-- Tab 5: Menu -->
      <button @click="activeDrawer = activeDrawer === 'menu' ? null : 'menu'" 
              class="flex items-center justify-center w-16 h-full transition-all duration-200 outline-none"
              :class="activeDrawer === 'menu' ? 'text-[#fbbf24] scale-105' : 'text-white/70 hover:text-white'">
        <i class="text-[26px]" :class="activeDrawer === 'menu' ? 'ph-fill ph-list' : 'ph-bold ph-list'"></i>
      </button>

    </div>
  </div>

  <!-- Drawer 1: Sản phẩm -->
  <div x-show="activeDrawer === 'products'" x-cloak
       x-transition:enter="transition ease-out duration-300 transform"
       x-transition:enter-start="translate-y-full"
       x-transition:enter-end="translate-y-0"
       x-transition:leave="transition ease-in duration-200 transform"
       x-transition:leave-start="translate-y-0"
       x-transition:leave-end="translate-y-full"
       class="fixed bottom-0 left-0 right-0 z-[200] max-h-[80vh] rounded-t-[2.5rem] bg-gradient-to-b from-[#8a0b10] to-[#6b0509] border-t border-white/20 text-white flex flex-col shadow-2xl pb-20 overflow-hidden">
    
    <!-- Dong Son Bronze Drum watermark background -->
    <div class="absolute -bottom-16 -right-16 w-64 h-64 bg-no-repeat bg-contain bg-center pointer-events-none mix-blend-screen z-0" 
         style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg/960px-Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg.png'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%); opacity: 0.05;">
    </div>

    <div class="w-12 h-1.5 bg-white/20 rounded-full mx-auto my-3 shrink-0 cursor-pointer relative z-10" @click="activeDrawer = null"></div>
    <div class="px-6 pb-4 flex items-center justify-between border-b border-white/10 shrink-0 relative z-10">
      <h3 class="text-base font-extrabold uppercase tracking-wider text-[#fbbf24] flex items-center gap-2">
        <i class="ph-fill ph-package text-lg"></i> Danh Mục Sản Phẩm
      </h3>
      <button @click="activeDrawer = null" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors">
        <i class="ph-bold ph-x"></i>
      </button>
    </div>
    <div class="overflow-y-auto px-6 py-4 space-y-4 mobile-scroll flex-1 text-left relative z-10">
      
      <!-- LED TRONG NHÀ -->
      <div>
        <h4 class="text-[12px] font-black uppercase tracking-wider text-[#fbbf24]/90 mb-2 border-b border-white/5 pb-1">Màn Hình LED Trong Nhà</h4>
        <div class="grid grid-cols-2 gap-2">
          <a href="https://hacoled.com/man-hinh-led-trong-nha/" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Tất cả trong nhà</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p0-9-trong-nha/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P0.9</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p1-25-trong-nha/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P1.25</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p1-53-trong-nha/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P1.53</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p1-8-trong-nha/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P1.8</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p2-trong-nha/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P2</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p2-5-trong-nha/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P2.5</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p3-trong-nha/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P3</a>
        </div>
      </div>

      <!-- LED NGOÀI TRỜI -->
      <div>
        <h4 class="text-[12px] font-black uppercase tracking-wider text-[#fbbf24]/90 mb-2 border-b border-white/5 pb-1">Màn Hình LED Ngoài Trời</h4>
        <div class="grid grid-cols-2 gap-2">
          <a href="https://hacoled.com/man-hinh-led-ngoai-troi/" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Tất cả ngoài trời</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p2-5-ngoai-troi/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P2.5</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p3-ngoai-troi/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P3</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p4-ngoai-troi/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P4</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p5-ngoai-troi/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P5</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-led-p10-ngoai-troi/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">LED P10</a>
        </div>
      </div>

      <!-- MÀN HÌNH GHÉP LCD -->
      <div>
        <h4 class="text-[12px] font-black uppercase tracking-wider text-[#fbbf24]/90 mb-2 border-b border-white/5 pb-1">Màn Hình Ghép LCD</h4>
        <div class="grid grid-cols-2 gap-2">
          <a href="https://hacoled.com/man-hinh-ghep/" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Tất cả màn ghép</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-ghep-boe/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Màn ghép BOE</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-ghep-orion/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Màn ghép Orion</a>
          <a href="<?php echo esc_url(home_url('/man-hinh-ghep-vestel/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Màn ghép Vestel</a>
        </div>
      </div>

      <!-- ÂM THANH & ÁNH SÁNG -->
      <div>
        <h4 class="text-[12px] font-black uppercase tracking-wider text-[#fbbf24]/90 mb-2 border-b border-white/5 pb-1">Âm Thanh | Ánh Sáng</h4>
        <div class="grid grid-cols-2 gap-2">
          <a href="https://hacoled.com/am-thanh/" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Tất cả âm thanh</a>
          <a href="<?php echo esc_url(home_url('/dbacoustic-loa/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Loa DBacoustic</a>
          <a href="<?php echo esc_url(home_url('/dbacoustic-amply/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Amply DBacoustic</a>
          <a href="<?php echo esc_url(home_url('/dbacoustic-micro/')); ?>" class="block p-3 bg-white/5 border border-white/10 rounded-xl text-center text-xs font-semibold hover:bg-white/10 hover:border-[#fbbf24] transition-all">Micro DBacoustic</a>
        </div>
      </div>

    </div>
  </div>

  <!-- Drawer 2: Blog -->
  <div x-show="activeDrawer === 'blog'" x-cloak
       x-transition:enter="transition ease-out duration-300 transform"
       x-transition:enter-start="translate-y-full"
       x-transition:enter-end="translate-y-0"
       x-transition:leave="transition ease-in duration-200 transform"
       x-transition:leave-start="translate-y-0"
       x-transition:leave-end="translate-y-full"
       class="fixed bottom-0 left-0 right-0 z-[200] max-h-[80vh] rounded-t-[2.5rem] bg-gradient-to-b from-[#8a0b10] to-[#6b0509] border-t border-white/20 text-white flex flex-col shadow-2xl pb-20 overflow-hidden">
    
    <!-- Dong Son Bronze Drum watermark background -->
    <div class="absolute -bottom-16 -right-16 w-64 h-64 bg-no-repeat bg-contain bg-center pointer-events-none mix-blend-screen z-0" 
         style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg/960px-Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg.png'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%); opacity: 0.05;">
    </div>

    <div class="w-12 h-1.5 bg-white/20 rounded-full mx-auto my-3 shrink-0 cursor-pointer relative z-10" @click="activeDrawer = null"></div>
    <div class="px-6 pb-4 flex items-center justify-between border-b border-white/10 shrink-0 relative z-10">
      <h3 class="text-base font-extrabold uppercase tracking-wider text-[#fbbf24] flex items-center gap-2">
        <i class="ph-fill ph-article text-lg"></i> Tin Tức & Blog
      </h3>
      <button @click="activeDrawer = null" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors">
        <i class="ph-bold ph-x"></i>
      </button>
    </div>
    <div class="overflow-y-auto px-6 py-5 space-y-3 mobile-scroll flex-1 text-left relative z-10">
      <a href="<?php echo esc_url($footer_news_url); ?>" class="flex items-center gap-4 p-4 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 hover:border-[#fbbf24] transition-all group">
        <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-[#fbbf24] flex items-center justify-center shrink-0">
          <i class="ph-bold ph-newspaper text-xl"></i>
        </div>
        <div class="flex-1 text-left">
          <p class="font-bold text-sm">Xem tất cả Tin Tức & Blog</p>
          <p class="text-xs text-white/50">Cập nhật xu hướng & dự án nổi bật</p>
        </div>
        <i class="ph-bold ph-caret-right text-white/30 group-hover:text-white transition-colors"></i>
      </a>

      <a href="<?php echo esc_url(home_url('/blog-man-hinh-led/')); ?>" class="flex items-center gap-4 p-4 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 hover:border-[#fbbf24] transition-all group">
        <div class="w-10 h-10 rounded-xl bg-red-500/10 text-red-400 flex items-center justify-center shrink-0">
          <i class="ph-bold ph-monitor text-xl"></i>
        </div>
        <div class="flex-1 text-left">
          <p class="font-bold text-sm">Blog về màn hình LED</p>
          <p class="text-xs text-white/50">Kiến thức chuyên sâu về màn hình LED</p>
        </div>
        <i class="ph-bold ph-caret-right text-white/30 group-hover:text-white transition-colors"></i>
      </a>

      <a href="<?php echo esc_url(home_url('/blog-am-thanh/')); ?>" class="flex items-center gap-4 p-4 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 hover:border-[#fbbf24] transition-all group">
        <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center shrink-0">
          <i class="ph-bold ph-speaker-high text-xl"></i>
        </div>
        <div class="flex-1 text-left">
          <p class="font-bold text-sm">Blog về âm thanh</p>
          <p class="text-xs text-white/50">Tư vấn, đánh giá thiết bị âm thanh</p>
        </div>
        <i class="ph-bold ph-caret-right text-white/30 group-hover:text-white transition-colors"></i>
      </a>

      <a href="<?php echo esc_url(home_url('/kien-thuc-ky-thuat/')); ?>" class="flex items-center gap-4 p-4 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 hover:border-[#fbbf24] transition-all group">
        <div class="w-10 h-10 rounded-xl bg-green-500/10 text-green-400 flex items-center justify-center shrink-0">
          <i class="ph-bold ph-book-open text-xl"></i>
        </div>
        <div class="flex-1 text-left">
          <p class="font-bold text-sm">Hướng dẫn kỹ thuật</p>
          <p class="text-xs text-white/50">Tài liệu, hướng dẫn vận hành kỹ thuật</p>
        </div>
        <i class="ph-bold ph-caret-right text-white/30 group-hover:text-white transition-colors"></i>
      </a>
    </div>
  </div>

  <!-- Drawer 3: Info -->
  <div x-show="activeDrawer === 'info'" x-cloak
       x-transition:enter="transition ease-out duration-300 transform"
       x-transition:enter-start="translate-y-full"
       x-transition:enter-end="translate-y-0"
       x-transition:leave="transition ease-in duration-200 transform"
       x-transition:leave-start="translate-y-0"
       x-transition:leave-end="translate-y-full"
       class="fixed bottom-0 left-0 right-0 z-[200] max-h-[85vh] rounded-t-[2.5rem] bg-gradient-to-b from-[#8a0b10] to-[#6b0509] border-t border-white/20 text-white flex flex-col shadow-2xl pb-20 overflow-hidden">
    
    <!-- Dong Son Bronze Drum watermark background -->
    <div class="absolute -bottom-16 -right-16 w-64 h-64 bg-no-repeat bg-contain bg-center pointer-events-none mix-blend-screen z-0" 
         style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg/960px-Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg.png'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%); opacity: 0.05;">
    </div>

    <div class="w-12 h-1.5 bg-white/20 rounded-full mx-auto my-3 shrink-0 cursor-pointer relative z-10" @click="activeDrawer = null"></div>
    <div class="px-6 pb-4 flex items-center justify-between border-b border-white/10 shrink-0 relative z-10">
      <h3 class="text-base font-extrabold uppercase tracking-wider text-[#fbbf24] flex items-center gap-2">
        <i class="ph-fill ph-info text-lg"></i> Thông Tin Liên Hệ
      </h3>
      <button @click="activeDrawer = null" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors">
        <i class="ph-bold ph-x"></i>
      </button>
    </div>
    <address class="overflow-y-auto px-6 py-5 space-y-6 mobile-scroll flex-1 text-left not-italic relative z-10">
      
      <!-- Company Branding & Socials -->
      <div class="flex flex-col items-center text-center space-y-4 pb-5 border-b border-white/10">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block">
          <img class="w-[180px] h-auto object-contain rounded shadow-sm" 
               src="<?php echo esc_url(home_url('/wp-content/uploads/2026/06/HacoLED-Logo-Moi.png')); ?>" alt="HacoLED Logo" />
        </a>
        <p class="text-xs text-white/70 leading-relaxed max-w-xs">
          <?php _e('Công ty CP Công Nghệ HACO Việt Nam - Đơn vị tiên phong cung cấp giải pháp màn hình LED và thiết bị công nghệ hiển thị cao cấp.', 'hacoled'); ?>
        </p>
        <div class="flex gap-2">
          <!-- Facebook SVG -->
          <a class="w-9 h-9 rounded bg-[#7f1d1d] border border-white/15 flex items-center justify-center text-slate-300 hover:bg-[#fbbf24] hover:text-[#6b0509] transition-all" 
             href="https://www.facebook.com/hacoled" target="_blank" rel="noopener" aria-label="Facebook">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M9 8H7v3h2v9h3v-9h3l.5-3H12V6c0-.883.398-1.5 1.5-1.5H15V1h-2.5C9.945 1 9 2.557 9 4.833V8z"/></svg>
          </a>
          <!-- Twitter / X SVG -->
          <a class="w-9 h-9 rounded bg-[#7f1d1d] border border-white/15 flex items-center justify-center text-slate-300 hover:bg-[#fbbf24] hover:text-[#6b0509] transition-all" 
             href="https://x.com/HacoLed" target="_blank" rel="noopener" aria-label="X (Twitter)">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
          <!-- Youtube SVG -->
          <a class="w-9 h-9 rounded bg-[#7f1d1d] border border-white/15 flex items-center justify-center text-slate-300 hover:bg-[#fbbf24] hover:text-[#6b0509] transition-all" 
             href="https://www.youtube.com/@hacoled" target="_blank" rel="noopener" aria-label="YouTube">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.163a3.003 3.003 0 00-2.11-2.11C19.517 3.545 12 3.545 12 3.545s-7.517 0-9.388.508a3.003 3.003 0 00-2.11 2.11C0 8.033 0 12 0 12s0 3.967.502 5.837a3.003 3.003 0 002.11 2.11c1.871.508 9.388.508 9.388.508s7.517 0 9.388-.508a3.003 3.003 0 002.11-2.11C24 15.967 24 12 24 12s0-3.967-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
          </a>
          <!-- Linkedin SVG -->
          <a class="w-9 h-9 rounded bg-[#7f1d1d] border border-white/15 flex items-center justify-center text-slate-300 hover:bg-[#fbbf24] hover:text-[#6b0509] transition-all" 
             href="https://www.linkedin.com/in/hacoled/" target="_blank" rel="noopener" aria-label="LinkedIn">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
          </a>
        </div>
      </div>
      
      <!-- Contacts Quick Grid -->
      <div class="grid grid-cols-2 gap-3">
        <a href="tel:0342324488" class="p-3 bg-white/5 border border-white/10 rounded-2xl flex flex-col items-center text-center">
          <i class="ph-fill ph-phone text-xl text-[#fbbf24] mb-1"></i>
          <span class="text-[10px] text-white/50 font-bold uppercase">Hotline</span>
          <span class="text-xs font-extrabold text-white">034.232.4488</span>
        </a>
        <a href="tel:0868474488" class="p-3 bg-white/5 border border-white/10 rounded-2xl flex flex-col items-center text-center">
          <i class="ph-fill ph-headset text-xl text-[#fbbf24] mb-1"></i>
          <span class="text-[10px] text-white/50 font-bold uppercase">CSKH & Mua Hàng</span>
          <span class="text-xs font-extrabold text-white">086.847.4488</span>
        </a>
        <a href="mailto:kinhdoanh@hacoled.com" class="p-3 bg-white/5 border border-white/10 rounded-2xl flex flex-col items-center text-center col-span-2">
          <i class="ph-fill ph-envelope text-xl text-[#fbbf24] mb-1"></i>
          <span class="text-[10px] text-white/50 font-bold uppercase">Email</span>
          <span class="text-xs font-semibold text-white">kinhdoanh@hacoled.com</span>
        </a>
      </div>

      <!-- Trụ sở & Chi nhánh -->
      <div class="space-y-4">
        
        <div>
          <h4 class="text-xs font-black uppercase text-[#fbbf24] tracking-wide mb-1 flex items-center gap-1.5">
            <span class="w-1.5 h-1.5 rounded-full bg-[#fbbf24]"></span> TRỤ SỞ & VP MIỀN BẮC
          </h4>
          <p class="text-xs text-white/80 pl-3 leading-relaxed mb-1.5"><strong>Trụ sở chính:</strong> Ngách 57/92 Đường Quang Minh, Thôn Gia Thượng 2, Xã Quang Minh, TP. Hà Nội</p>
          <p class="text-xs text-white/80 pl-3 leading-relaxed"><strong>Văn phòng HN:</strong> Số 11 ngõ 10 Nghĩa Đô, phường Nghĩa Đô, TP. Hà Nội</p>
        </div>

        <div>
          <h4 class="text-xs font-black uppercase text-[#fbbf24] tracking-wide mb-1 flex items-center gap-1.5">
            <span class="w-1.5 h-1.5 rounded-full bg-[#fbbf24]"></span> CN HỒ CHÍ MINH
          </h4>
          <p class="text-xs text-white/80 pl-3 leading-relaxed">400 Đ.Nguyễn Thị Thập, P. Tân Hưng, TP. HCM</p>
        </div>

        <div>
          <h4 class="text-xs font-black uppercase text-[#fbbf24] tracking-wide mb-1 flex items-center gap-1.5">
            <span class="w-1.5 h-1.5 rounded-full bg-[#fbbf24]"></span> CN ĐÀ NẴNG
          </h4>
          <p class="text-xs text-white/80 pl-3 leading-relaxed">Số 88 Tây Sơn, P. Ngũ Hành Sơn, TP. Đà Nẵng</p>
        </div>

        <div>
          <h4 class="text-xs font-black uppercase text-[#fbbf24] tracking-wide mb-1 flex items-center gap-1.5">
            <span class="w-1.5 h-1.5 rounded-full bg-[#fbbf24]"></span> CN TÂY NGUYÊN
          </h4>
          <p class="text-xs text-white/80 pl-3 leading-relaxed">TDP4, P. Đông Gia Nghĩa, Lâm Đồng</p>
        </div>

      </div>

      <div class="pt-3 border-t border-white/10 text-center">
        <span class="text-[11px] text-white/50"><strong>MST:</strong> 0108701064</span>
      </div>

    </address>
  </div>

  <!-- Drawer 4: Menu -->
  <div x-show="activeDrawer === 'menu'" x-cloak
       x-transition:enter="transition ease-out duration-300 transform"
       x-transition:enter-start="translate-y-full"
       x-transition:enter-end="translate-y-0"
       x-transition:leave="transition ease-in duration-200 transform"
       x-transition:leave-start="translate-y-0"
       x-transition:leave-end="translate-y-full"
       class="fixed bottom-0 left-0 right-0 z-[200] max-h-[85vh] rounded-t-[2.5rem] bg-gradient-to-b from-[#8a0b10] to-[#6b0509] border-t border-white/20 text-white flex flex-col shadow-2xl pb-20 overflow-hidden">
    
    <!-- Dong Son Bronze Drum watermark background -->
    <div class="absolute -bottom-16 -right-16 w-64 h-64 bg-no-repeat bg-contain bg-center pointer-events-none mix-blend-screen z-0" 
         style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg/960px-Tr%E1%BB%91ng_%C4%91%E1%BB%93ng_%C4%90%C3%B4ng_S%C6%A1n.svg.png'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%); opacity: 0.05;">
    </div>

    <div class="w-12 h-1.5 bg-white/20 rounded-full mx-auto my-3 shrink-0 cursor-pointer relative z-10" @click="activeDrawer = null"></div>
    <div class="px-6 pb-4 flex items-center justify-between border-b border-white/10 shrink-0 relative z-10">
      <h3 class="text-base font-extrabold uppercase tracking-wider text-[#fbbf24] flex items-center gap-2">
        <i class="ph-fill ph-list text-lg"></i> Menu Điều Hướng
      </h3>
      <button @click="activeDrawer = null" class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-colors">
        <i class="ph-bold ph-x"></i>
      </button>
    </div>
    <div class="overflow-y-auto px-6 py-4 space-y-4 mobile-scroll flex-1 text-left relative z-10">
      
      <!-- Search Mobile -->
      <div class="pb-3 border-b border-white/10 mb-4">
        <form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="relative">
          <input type="search" name="s" placeholder="Tìm kiếm sản phẩm, dịch vụ..." class="w-full rounded-xl pl-10 pr-4 py-2.5 text-[13px] text-white placeholder-white/60 bg-white/5 border border-white/15 focus:outline-none focus:border-[#fbbf24] focus:bg-white/10 transition-all" />
          <span class="absolute left-3 top-1/2 -translate-y-1/2 text-white/50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.602 10.602z"/></svg>
          </span>
        </form>
      </div>

      <!-- Primary Pages List with Accordions -->
      <div class="space-y-2">
        <!-- Về HacoLED Accordion -->
        <div x-data="{ open: false }" class="border-b border-white/5 pb-1">
          <button @click="open = !open" class="w-full flex items-center justify-between p-3 rounded-xl hover:bg-white/5 font-bold text-sm text-white/90 transition-all outline-none">
            <span class="flex items-center gap-2.5">
              <i class="ph-bold ph-info text-[#fbbf24]"></i> Về HacoLED
            </span>
            <i class="ph-bold ph-caret-down text-white/50 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : ''"></i>
          </button>
          <div x-show="open" x-cloak class="pl-8 pr-2 pb-2 mt-1 space-y-1 border-l border-white/10 ml-5">
            <a href="<?php echo esc_url($footer_about_url); ?>" class="block py-2 text-xs text-white/80 hover:text-white transition-colors">Giới thiệu chung</a>
            <a href="<?php echo esc_url($footer_commitment_url); ?>" class="block py-2 text-xs text-white/80 hover:text-white transition-colors">Cam kết chất lượng</a>
            <a href="<?php echo esc_url($footer_careers_url); ?>" class="block py-2 text-xs text-white/80 hover:text-white transition-colors">Tuyển dụng</a>
            <a href="<?php echo esc_url(home_url('/su-kien/')); ?>" class="block py-2 text-xs text-white/80 hover:text-white transition-colors">Sự kiện nổi bật</a>
          </div>
        </div>

        <!-- Giải Pháp Accordion -->
        <div x-data="{ open: false }" class="border-b border-white/5 pb-1">
          <button @click="open = !open" class="w-full flex items-center justify-between p-3 rounded-xl hover:bg-white/5 font-bold text-sm text-white/90 transition-all outline-none">
            <span class="flex items-center gap-2.5">
              <i class="ph-bold ph-lightbulb text-[#fbbf24]"></i> Giải Pháp Màn Hình LED
            </span>
            <i class="ph-bold ph-caret-down text-white/50 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : ''"></i>
          </button>
          <div x-show="open" x-cloak class="pl-8 pr-2 pb-2 mt-1 space-y-1 border-l border-white/10 ml-5">
            <a href="<?php echo esc_url(home_url('/man-hinh-led-hoi-truong/')); ?>" class="block py-2 text-xs text-white/80 hover:text-white transition-colors">Màn hình LED Hội trường</a>
            <a href="<?php echo esc_url(home_url('/man-hinh-led-phong-hop-hoi-truong/')); ?>" class="block py-2 text-xs text-white/80 hover:text-white transition-colors">Màn hình LED Phòng họp</a>
            <a href="<?php echo esc_url(home_url('/man-hinh-led-san-khau/')); ?>" class="block py-2 text-xs text-white/80 hover:text-white transition-colors">Màn hình LED Sân khấu</a>
            <a href="<?php echo esc_url(home_url('/man-hinh-led-truong-hoc/')); ?>" class="block py-2 text-xs text-white/80 hover:text-white transition-colors">Màn hình LED Trường học</a>
            <a href="<?php echo esc_url(home_url('/man-hinh-led-tiec-cuoi-nha-hang/')); ?>" class="block py-2 text-xs text-white/80 hover:text-white transition-colors">Màn hình LED Tiệc, đám cưới</a>
            <a href="<?php echo esc_url(home_url('/man-hinh-led-studio/')); ?>" class="block py-2 text-xs text-white/80 hover:text-white transition-colors">Màn hình LED Studio</a>
            <a href="<?php echo esc_url(home_url('/man-hinh-led-100-200-300-inch/')); ?>" class="block py-2 text-xs text-white/80 hover:text-white transition-colors">Màn hình LED 100, 200, 300 inch</a>
            <a href="<?php echo esc_url(home_url('/man-hinh-led-trong-suot/')); ?>" class="block py-2 text-xs text-white/80 hover:text-white transition-colors">Màn hình LED Trong suốt</a>
            <a href="<?php echo esc_url(home_url('/man-hinh-led-film-dan-kinh/')); ?>" class="block py-2 text-xs text-white/80 hover:text-white transition-colors">Màn hình LED Film dán kính</a>
          </div>
        </div>

        <!-- Dịch Vụ Link -->
        <a href="<?php echo esc_url($footer_services_url); ?>" class="flex items-center justify-between p-3 rounded-xl hover:bg-white/5 transition-all font-bold text-sm text-white/90">
          <span class="flex items-center gap-2.5">
            <i class="ph-bold ph-wrench text-[#fbbf24]"></i> Dịch Vụ
          </span>
          <i class="ph-bold ph-caret-right opacity-40"></i>
        </a>

        <!-- Liên Hệ Link -->
        <a href="<?php echo esc_url($footer_contact_url); ?>" class="flex items-center justify-between p-3 rounded-xl hover:bg-white/5 transition-colors font-bold text-sm text-[#fbbf24]">
          <span class="flex items-center gap-2.5">
            <i class="ph-bold ph-phone text-[#fbbf24]"></i> Liên Hệ HacoLED
          </span>
          <i class="ph-bold ph-caret-right opacity-40"></i>
        </a>
      </div>

      <!-- Projects Group Accordion -->
      <div x-data="{ open: false }" class="border-t border-white/10 pt-3">
        <button @click="open = !open" class="w-full flex items-center justify-between p-3 rounded-xl hover:bg-white/5 font-bold text-sm text-white/90 outline-none">
          <span>Dự Án Đã Thực Hiện</span>
          <i class="ph-bold ph-caret-down text-white/50 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : ''"></i>
        </button>
        <div x-show="open" x-cloak class="pl-4 pr-2 pb-2 mt-1 space-y-1 border-l border-white/10 ml-3">
          <a href="https://hacoled.com/hang-muc-da-thi-cong/" class="block py-2 text-xs text-white/80 hover:text-white">Tất cả dự án</a>
          <a href="<?php echo esc_url(home_url('/du-an-trong-nha/')); ?>" class="block py-2 text-xs text-white/80 hover:text-white">Dự án trong nhà</a>
          <a href="<?php echo esc_url(home_url('/du-an-ngoai-troi/')); ?>" class="block py-2 text-xs text-white/80 hover:text-white">Dự án ngoài trời</a>
          <a href="<?php echo esc_url(home_url('/du-an-truong-hoc/')); ?>" class="block py-2 text-xs text-white/80 hover:text-white">Dự án trường học</a>
          <a href="<?php echo esc_url(home_url('/du-an-man-hinh-ghep/')); ?>" class="block py-2 text-xs text-white/80 hover:text-white">Dự án màn hình ghép</a>
          <a href="<?php echo esc_url(home_url('/du-an-am-thanh/')); ?>" class="block py-2 text-xs text-white/80 hover:text-white">Dự án âm thanh</a>
        </div>
      </div>

      <!-- Recruitment Group Accordion -->
      <div x-data="{ open: false }" class="border-t border-white/10 pt-3">
        <button @click="open = !open" class="w-full flex items-center justify-between p-3 rounded-xl hover:bg-white/5 font-bold text-sm text-white/90 outline-none">
          <span>Cơ Hội Tuyển Dụng</span>
          <i class="ph-bold ph-caret-down text-white/50 transition-transform" :class="open ? 'rotate-180 text-[#fbbf24]' : ''"></i>
        </button>
        <div x-show="open" x-cloak class="pl-4 pr-2 pb-2 mt-1 space-y-1 border-l border-white/10 ml-3">
          <?php
          if ($footer_jobs) {
              foreach ($footer_jobs as $job) {
                  $job_link = get_permalink($job->ID);
                  $job_title = esc_html(get_the_title($job->ID));
                  echo '<a href="' . esc_url($job_link) . '" class="block py-2 text-xs text-white/80 hover:text-white">' . $job_title . '</a>';
              }
          } else {
              echo '<p class="text-xs text-white/40 py-2">Không có vị trí tuyển dụng mới...</p>';
          }
          ?>
          <a href="<?php echo home_url('/tuyen-dung/'); ?>" class="block py-2 text-xs font-bold text-[#fbbf24] mt-1">Xem tất cả cơ hội tuyển dụng →</a>
        </div>
      </div>

    </div>
  </div>

</div>

<!-- JSON-LD LocalBusiness Schema for Search Engines (SEO E-E-A-T) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "HACOLED",
  "image": "<?php echo esc_url(home_url('/wp-content/uploads/2026/06/HacoLED-Logo-Moi.png')); ?>",
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
