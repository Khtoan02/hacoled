<?php
/**
 * Mega Menu: Dự Án
 */
$showcase_audio = get_template_directory_uri() . '/assets/images/showcase-audio.png';
?>
<div class="w-full flex">
  <!-- Left: Links Area -->
  <div class="flex-1 p-8 xl:p-10 grid grid-cols-1 gap-8 xl:gap-12 min-w-0">
  <div class="flex flex-col">
    <div class="flex items-center gap-3 mb-4 pb-3 border-b border-slate-100">
      <div class="w-8 h-8 rounded-lg bg-red-50 text-[#b31217] flex items-center justify-center shadow-sm shrink-0">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
      </div>
      <h4 class="text-[13px] font-bold text-slate-800 uppercase tracking-[0.05em]">Hồ Sơ Năng Lực</h4>
    </div>
    <div class="grid grid-cols-2 gap-x-8 gap-y-1">
      <a href="<?php echo esc_url(home_url('/du-an-trong-nha/')); ?>" class="group flex items-center justify-between py-2 px-3 -mx-3 rounded-lg hover:bg-slate-50 transition-all duration-300">
        <span class="text-[14px] font-medium text-slate-600 group-hover:text-[#b31217] group-hover:translate-x-1 transition-transform duration-300 flex items-center whitespace-nowrap">
          Dự án trong nhà 
        </span>
        <svg class="w-3.5 h-3.5 text-slate-300 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-[#b31217] transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
      </a>
      <a href="<?php echo esc_url(home_url('/du-an-ngoai-troi/')); ?>" class="group flex items-center justify-between py-2 px-3 -mx-3 rounded-lg hover:bg-slate-50 transition-all duration-300">
        <span class="text-[14px] font-medium text-slate-600 group-hover:text-[#b31217] group-hover:translate-x-1 transition-transform duration-300 flex items-center whitespace-nowrap">
          Dự án ngoài trời 
        </span>
        <svg class="w-3.5 h-3.5 text-slate-300 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-[#b31217] transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
      </a>
      <a href="<?php echo esc_url(home_url('/du-an-truong-hoc/')); ?>" class="group flex items-center justify-between py-2 px-3 -mx-3 rounded-lg hover:bg-slate-50 transition-all duration-300">
        <span class="text-[14px] font-medium text-slate-600 group-hover:text-[#b31217] group-hover:translate-x-1 transition-transform duration-300 flex items-center whitespace-nowrap">
          Dự án trường học 
        </span>
        <svg class="w-3.5 h-3.5 text-slate-300 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-[#b31217] transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
      </a>
      <a href="<?php echo esc_url(home_url('/du-an-man-hinh-ghep/')); ?>" class="group flex items-center justify-between py-2 px-3 -mx-3 rounded-lg hover:bg-slate-50 transition-all duration-300">
        <span class="text-[14px] font-medium text-slate-600 group-hover:text-[#b31217] group-hover:translate-x-1 transition-transform duration-300 flex items-center whitespace-nowrap">
          Dự án màn hình ghép 
        </span>
        <svg class="w-3.5 h-3.5 text-slate-300 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-[#b31217] transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
      </a>
      <a href="<?php echo esc_url(home_url('/du-an-am-thanh/')); ?>" class="group flex items-center justify-between py-2 px-3 -mx-3 rounded-lg hover:bg-slate-50 transition-all duration-300">
        <span class="text-[14px] font-medium text-slate-600 group-hover:text-[#b31217] group-hover:translate-x-1 transition-transform duration-300 flex items-center whitespace-nowrap">
          Dự án âm thanh 
        </span>
        <svg class="w-3.5 h-3.5 text-slate-300 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-[#b31217] transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
      </a>
    </div>
  </div>
  </div>

  <!-- Right: Visual Card Area -->
  <div class="w-[340px] shrink-0 border-l border-slate-100 bg-slate-50 relative overflow-hidden group/card cursor-pointer">
    <img src="<?php echo $showcase_audio; ?>" data-fallback="https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=800&q=80" alt="Tổ hợp Hiển thị và Âm thanh tại Cung Điền Kinh Quốc Gia" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover/card:scale-110" />
    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/95 via-slate-900/40 to-transparent"></div>
    <div class="absolute bottom-0 left-0 w-full p-8 flex flex-col justify-end">
      <span class="inline-block text-[10px] font-black uppercase tracking-widest px-2 py-1 rounded bg-[#b31217] text-white w-max mb-3">ÂM THANH & LED SỰ KIỆN</span>
      <h4 class="text-[16px] font-bold text-white mb-2 leading-tight drop-shadow-md">Tổ hợp Hiển thị và Âm thanh tại Cung Điền Kinh Quốc Gia</h4>
      <div class="flex items-center gap-2 text-[13px] font-medium text-amber-400 group-hover/card:text-white transition-colors">
        Khám phá ngay <svg class="w-4 h-4 transition-transform group-hover/card:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </div>
    </div>
  </div>
</div>
