<?php
/**
 * Mega Menu: Màn Hình Ghép
 */
?>
<div class="w-full flex">
  <!-- Left: Links Area -->
  <div class="flex-1 p-8 xl:p-10 grid grid-cols-1 gap-8 xl:gap-12 min-w-0">
  <div class="flex flex-col">
    <div class="flex items-center gap-3 mb-4 pb-3 border-b border-slate-100">
      <div class="w-8 h-8 rounded-lg bg-red-50 text-[#b31217] flex items-center justify-center shadow-sm shrink-0">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>
      </div>
      <h4 class="text-[13px] font-bold text-slate-800 uppercase tracking-[0.05em]">Màn Hình Ghép Videowall</h4>
    </div>
    <div class="flex flex-col space-y-1">
      <a href="<?php echo esc_url(home_url('/man-hinh-ghep-boe/')); ?>" class="group flex items-center justify-between py-2 px-3 -mx-3 rounded-lg hover:bg-slate-50 transition-all duration-300">
        <span class="text-[14px] font-medium text-slate-600 group-hover:text-[#b31217] group-hover:translate-x-1 transition-transform duration-300 flex items-center whitespace-nowrap">
          Màn hình ghép BOE 
        </span>
        <svg class="w-3.5 h-3.5 text-slate-300 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-[#b31217] transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
      </a>
      <a href="<?php echo esc_url(home_url('/man-hinh-ghep-orion/')); ?>" class="group flex items-center justify-between py-2 px-3 -mx-3 rounded-lg hover:bg-slate-50 transition-all duration-300">
        <span class="text-[14px] font-medium text-slate-600 group-hover:text-[#b31217] group-hover:translate-x-1 transition-transform duration-300 flex items-center whitespace-nowrap">
          Màn hình ghép Orion 
        </span>
        <svg class="w-3.5 h-3.5 text-slate-300 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-[#b31217] transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
      </a>
      <a href="<?php echo esc_url(home_url('/man-hinh-ghep-vestel/')); ?>" class="group flex items-center justify-between py-2 px-3 -mx-3 rounded-lg hover:bg-slate-50 transition-all duration-300">
        <span class="text-[14px] font-medium text-slate-600 group-hover:text-[#b31217] group-hover:translate-x-1 transition-transform duration-300 flex items-center whitespace-nowrap">
          Màn hình ghép Vestel 
        </span>
        <svg class="w-3.5 h-3.5 text-slate-300 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-[#b31217] transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
      </a>
    </div>
  </div>
  </div>

  <!-- Right: Visual Card Area -->
  <div class="w-[340px] shrink-0 border-l border-slate-100 bg-slate-50 relative overflow-hidden group/card cursor-pointer">
    <img src="https://images.unsplash.com/photo-1542744094-24638ea0b3b5?auto=format&fit=crop&w=600&q=80" alt="Viền ghép siêu mỏng, không giới hạn không gian" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover/card:scale-110" />
    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/95 via-slate-900/40 to-transparent"></div>
    <div class="absolute bottom-0 left-0 w-full p-8 flex flex-col justify-end">
      <span class="inline-block text-[10px] font-black uppercase tracking-widest px-2 py-1 rounded bg-[#b31217] text-white w-max mb-3">VIDEOWALL</span>
      <h4 class="text-[16px] font-bold text-white mb-2 leading-tight drop-shadow-md">Viền ghép siêu mỏng, không giới hạn không gian</h4>
      <div class="flex items-center gap-2 text-[13px] font-medium text-amber-400 group-hover/card:text-white transition-colors">
        Tìm hiểu thêm <svg class="w-4 h-4 transition-transform group-hover/card:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </div>
    </div>
  </div>
</div>
