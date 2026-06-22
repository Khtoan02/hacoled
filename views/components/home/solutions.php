<?php
/**
 * UI Component: Home Solutions — Immersive Glassmorphism Cards
 * 
 * Design: Full-bleed images with glassmorphism overlay containing ALL info.
 * Unified with the premium dark red brand gradient, gold accents, and Dong Son drum watermark.
 */
?>
<style>
    @media (max-width: 1023px) {
        .mobile-aspect-16-9 {
            aspect-ratio: 16 / 9 !important;
            height: auto !important;
            min-height: 0 !important;
        }
    }
</style>
<!-- ========================================== -->
<!-- SECTION: GIẢI PHÁP TOÀN DIỆN              -->
<!-- ========================================== -->
<section id="solutions" class="py-0 md:py-20 relative overflow-hidden z-10 bg-transparent">
    <div class="max-w-[1440px] mx-auto px-0 md:px-4 lg:px-8 relative z-10">
        
        <!-- Premium Block Card Wrapper -->
        <div class="relative overflow-hidden rounded-none md:rounded-3xl text-white pt-6 pb-5 px-4 md:p-12 lg:p-14 shadow-2xl border-x-0 md:border border-white/5" style="background: linear-gradient(to bottom right, #b31217, #8a0b10);" data-tech-bg="particle">
            
            <!-- Lớp 0: Dynamic Gradient Background overlay -->
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_30%,rgba(179,18,23,0.95)_0%,rgba(138,11,16,0.98)_80%)] z-0"></div>
            
            <!-- Lớp 1: Lưới điện tử Tech Grid -->
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff06_1px,transparent_1px),linear-gradient(to_bottom,#ffffff06_1px,transparent_1px)] bg-[size:40px_40px] z-0 pointer-events-none"></div>

            <!-- Gold Top Border Line -->
            <div class="absolute top-0 left-0 w-full h-[4px] z-20" style="background: linear-gradient(90deg, #b45309, #fbbf24, #fffbeb, #fbbf24, #b45309);"></div>
            <div class="glow-red top-1/2 -translate-y-1/2 -left-20 opacity-40 z-0"></div>
            <div class="glow-gold top-1/2 -translate-y-1/2 -right-20 opacity-30 z-0"></div>
            
            <!-- Dong Son Drum watermark background -->
            <div class="absolute -right-[20%] -bottom-[35%] w-[1000px] h-[1000px] bg-no-repeat bg-contain bg-center pointer-events-none mix-blend-screen opacity-[0.15] z-0" 
                 style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/dongson.png'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%);">
            </div>

            <div class="relative z-10">
                <!-- ─── Section Header ─── -->
                <div class="text-center max-w-3xl mx-auto mb-6 md:mb-10 fade-up">
                    <div class="inline-flex items-center gap-2 px-3 py-1 md:px-4 md:py-1.5 rounded-full bg-white/10 backdrop-blur border border-[#fbbf24]/30 mb-3">
                        <i class="ph-fill ph-squares-four text-[#fbbf24] text-xs md:text-lg"></i>
                        <span class="text-white text-[10px] md:text-xs font-bold uppercase tracking-widest whitespace-nowrap">HỆ SINH THÁI CỐT LÕI</span>
                    </div>
                    <h2 class="text-2xl md:text-4xl lg:text-5xl font-extrabold uppercase tracking-tight text-white mb-3">
                        Giải Pháp <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#fbbf24] to-[#fffbeb]">Toàn Diện</span>
                    </h2>
                    <p class="text-gray-300 text-xs md:text-base leading-relaxed max-w-xl mx-auto px-2">
                        Cung cấp cơ sở hạ tầng phần cứng đa dạng, đáp ứng mọi bài toán không gian và kỹ thuật khắt khe.
                    </p>
                </div>

                <!-- ─── 3 Immersive Cards: LED Hero (7 col) + 2 stacked (5 col) ─── -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 md:gap-5 mb-6 md:mb-10">

                    <!-- ★ FLAGSHIP: Màn Hình LED — Full Image + Glass Overlay -->
                    <div class="lg:col-span-7 rounded-2xl relative group flex overflow-hidden mobile-aspect-16-9 lg:aspect-auto lg:min-h-[500px] border border-white/10 shadow-xl">
                        <!-- Background Image -->
                        <img src="<?php echo esc_url(get_theme_mod('hacoled_solutions_led_img') ?: get_template_directory_uri() . '/assets/images/home-solution-led.png'); ?>" 
                             alt="Hệ thống màn hình LED HacoLED" 
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                             loading="lazy" decoding="async">
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-black/10"></div>
                        <!-- Glow border on hover -->
                        <div class="absolute -inset-[1px] rounded-2xl border-2 border-transparent group-hover:border-[#fbbf24]/40 transition-colors duration-300 pointer-events-none z-20"></div>

                        <!-- Glass Content Overlay — positioned at bottom -->
                        <div class="relative z-10 mt-auto w-full p-3 sm:p-5 lg:p-6">
                            <!-- Top Badge -->
                            <div class="mb-2 md:mb-3.5 flex items-center gap-2">
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-[#b31217] text-[8px] md:text-[9px] font-bold text-white uppercase tracking-wider shadow-lg">
                                    <span class="w-1 h-1 rounded-full bg-[#fbbf24] animate-pulse"></span>
                                    Flagship
                                </span>
                                <span class="text-[8px] md:text-[9px] text-white/60 font-mono font-bold uppercase tracking-wider">01. LED DISPLAY</span>
                            </div>

                            <!-- Glass Card (relative for floating product) -->
                            <div class="backdrop-blur-xl bg-black/70 md:bg-black/40 border border-white/15 rounded-xl md:rounded-2xl p-2.5 md:p-5 shadow-2xl relative overflow-visible flex items-center justify-between gap-3">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start gap-3 md:gap-4 mb-0 sm:mb-2 md:mb-3">
                                        <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg md:rounded-xl bg-[#fbbf24]/20 backdrop-blur-sm flex items-center justify-center text-[#fbbf24] shrink-0 border border-white/15">
                                            <i class="ph-fill ph-monitor-play text-sm md:text-lg"></i>
                                        </div>
                                        <div class="pr-2 lg:pr-24">
                                            <h3 class="text-sm md:text-lg font-black text-white tracking-wide mb-0.5 md:mb-1">Màn Hình LED</h3>
                                            <p class="hidden sm:block text-[10px] md:text-[11px] text-white/70 leading-relaxed font-light">
                                                Giải pháp hiển thị cỡ lớn Indoor/Outdoor. Module tiên tiến, độ sáng cao, tần số quét chuẩn.
                                            </p>
                                            <p class="block sm:hidden text-[9px] text-white/60 font-light">
                                                Indoor/Outdoor • Độ sáng cao • 24/7
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <!-- Spec Tags (Hidden on mobile) -->
                                    <div class="hidden sm:flex flex-wrap gap-1.5 mb-3">
                                        <span class="px-2 py-0.5 rounded bg-white/5 border border-white/10 text-[9px] font-bold text-white font-mono">4K UHD</span>
                                        <span class="px-2 py-0.5 rounded bg-white/5 border border-white/10 text-[9px] font-bold text-white font-mono">100K Giờ</span>
                                        <span class="px-2 py-0.5 rounded bg-white/5 border border-white/10 text-[9px] font-bold text-white font-mono">IP65</span>
                                    </div>

                                    <!-- Product Links (from mega menu, Hidden on mobile) -->
                                    <div class="border-t border-white/10 pt-2 md:pt-3 hidden sm:block">
                                        <div class="flex flex-wrap gap-1.5">
                                            <a href="<?php echo esc_url(home_url('/man-hinh-led-hoi-truong/')); ?>" class="px-2 py-0.5 rounded bg-white/5 hover:bg-[#fbbf24]/30 border border-white/10 text-[9px] text-white/80 hover:text-white transition-colors font-medium">Hội trường</a>
                                            <a href="<?php echo esc_url(home_url('/man-hinh-led-phong-hop-hoi-truong/')); ?>" class="px-2 py-0.5 rounded bg-white/5 hover:bg-[#fbbf24]/30 border border-white/10 text-[9px] text-white/80 hover:text-white transition-colors font-medium">Phòng họp</a>
                                            <a href="<?php echo esc_url(home_url('/man-hinh-led-san-khau/')); ?>" class="px-2 py-0.5 rounded bg-white/5 hover:bg-[#fbbf24]/30 border border-white/10 text-[9px] text-white/80 hover:text-white transition-colors font-medium">Sân khấu</a>
                                            <a href="<?php echo esc_url(home_url('/man-hinh-led-truong-hoc/')); ?>" class="px-2 py-0.5 rounded bg-white/5 hover:bg-[#fbbf24]/30 border border-white/10 text-[9px] text-white/80 hover:text-white transition-colors font-medium">Trường học</a>
                                            <a href="<?php echo esc_url(home_url('/man-hinh-led-tiec-cuoi-nha-hang/')); ?>" class="px-2 py-0.5 rounded bg-white/5 hover:bg-[#fbbf24]/30 border border-white/10 text-[9px] text-white/80 hover:text-white transition-colors font-medium">Tiệc cưới</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Right-side Arrow Button CTA -->
                                <a href="https://hacoled.com/man-hinh-led/" class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-[#fbbf24] text-black flex items-center justify-center hover:bg-white hover:scale-105 active:scale-95 transition-all shrink-0 shadow-lg" aria-label="Xem tất cả">
                                    <i class="ph-bold ph-arrow-right text-base"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: 2 Compact Cards stacked -->
                    <div class="lg:col-span-5 flex flex-col gap-4 md:gap-5">

                        <!-- Màn Hình Ghép — Image + Glass Overlay -->
                        <div class="w-full mobile-aspect-16-9 lg:aspect-auto lg:min-h-[240px] lg:flex-grow rounded-2xl relative group flex overflow-hidden border border-white/10 shadow-lg">
                            <img src="<?php echo esc_url(get_theme_mod('hacoled_solutions_videowall_img') ?: get_template_directory_uri() . '/assets/images/home-solution-videowall.png'); ?>" 
                                 alt="Hệ thống màn hình ghép Video Wall HacoLED" 
                                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 loading="lazy" decoding="async">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/30 to-black/10"></div>
                            <div class="absolute -inset-[1px] rounded-2xl border-2 border-transparent group-hover:border-[#fbbf24]/40 transition-colors duration-300 pointer-events-none z-20"></div>

                            <div class="relative z-10 mt-auto w-full p-3 md:p-4">
                                <div class="mb-1.5 flex items-center gap-2">
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-full bg-[#fbbf24] text-[8px] font-bold text-black uppercase tracking-wider shadow">
                                        <span class="w-1 h-1 rounded-full bg-white animate-pulse"></span>
                                        Enterprise
                                    </span>
                                    <span class="text-[8px] text-white/50 font-mono font-bold uppercase">02. VIDEO WALL</span>
                                </div>

                                <div class="backdrop-blur-xl bg-black/70 md:bg-black/40 border border-white/15 rounded-xl p-2.5 md:p-4 shadow-xl relative overflow-visible flex items-center justify-between gap-3">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 md:gap-3">
                                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg md:rounded-xl bg-[#fbbf24]/20 backdrop-blur-sm flex items-center justify-center text-[#fbbf24] shrink-0 border border-white/15">
                                                <i class="ph-fill ph-squares-four text-sm md:text-lg"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-xs md:text-sm font-black text-white">Màn Hình Ghép</h3>
                                                <p class="text-[9px] md:text-[10px] text-white/60 font-light">Viền siêu mỏng • IPS • 24/7</p>
                                            </div>
                                        </div>
                                        <div class="hidden sm:flex flex-wrap gap-1 mt-2">
                                            <a href="<?php echo esc_url(home_url('/man-hinh-ghep-boe/')); ?>" class="px-2 py-0.5 rounded bg-white/5 hover:bg-[#fbbf24]/30 border border-white/10 text-[8px] text-white/80 hover:text-white transition-colors font-medium">BOE</a>
                                            <a href="<?php echo esc_url(home_url('/man-hinh-ghep-orion/')); ?>" class="px-2 py-0.5 rounded bg-white/5 hover:bg-[#fbbf24]/30 border border-white/10 text-[8px] text-white/80 hover:text-white transition-colors font-medium">Orion</a>
                                        </div>
                                    </div>
                                    <!-- Right-side Arrow Button CTA -->
                                    <a href="https://hacoled.com/man-hinh-ghep/" class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-[#fbbf24] text-black flex items-center justify-center hover:bg-white hover:scale-105 active:scale-95 transition-all shrink-0 shadow-lg" aria-label="Xem tất cả">
                                        <i class="ph-bold ph-arrow-right text-base"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Âm Thanh & Ánh Sáng — Image + Glass Overlay -->
                        <div class="w-full mobile-aspect-16-9 lg:aspect-auto lg:min-h-[240px] lg:flex-grow rounded-2xl relative group flex overflow-hidden border border-white/10 shadow-lg">
                            <img src="<?php echo esc_url(get_theme_mod('hacoled_solutions_audio_img') ?: get_template_directory_uri() . '/assets/images/home-solution-audio.png'); ?>" 
                                 alt="Hệ thống âm thanh ánh sáng chuyên nghiệp HacoLED" 
                                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 loading="lazy" decoding="async">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/30 to-black/10"></div>
                            <div class="absolute -inset-[1px] rounded-2xl border-2 border-transparent group-hover:border-[#fbbf24]/40 transition-colors duration-300 pointer-events-none z-20"></div>

                            <div class="relative z-10 mt-auto w-full p-3 md:p-4">
                                <div class="mb-1.5 flex items-center gap-2">
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-full bg-[#fbbf24] text-[8px] font-bold text-black uppercase tracking-wider shadow">
                                        <span class="w-1 h-1 rounded-full bg-white animate-pulse"></span>
                                        Pro Audio
                                    </span>
                                    <span class="text-[8px] text-white/50 font-mono font-bold uppercase">03. AV SYSTEM</span>
                                </div>

                                <div class="backdrop-blur-xl bg-black/70 md:bg-black/40 border border-white/15 rounded-xl p-2.5 md:p-4 shadow-xl relative overflow-visible flex items-center justify-between gap-3">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 md:gap-3">
                                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg md:rounded-xl bg-[#fbbf24]/20 backdrop-blur-sm flex items-center justify-center text-[#fbbf24] shrink-0 border border-white/15">
                                                <i class="ph-fill ph-speaker-hifi text-sm md:text-lg"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-xs md:text-sm font-black text-white">Âm Thanh & Ánh Sáng</h3>
                                                <p class="text-[9px] md:text-[10px] text-white/60 font-light">DBacoustic • AV System</p>
                                            </div>
                                        </div>
                                        <div class="hidden sm:flex flex-wrap gap-1 mt-2">
                                            <a href="<?php echo esc_url(home_url('/dbacoustic-loa/')); ?>" class="px-2 py-0.5 rounded bg-white/5 hover:bg-[#fbbf24]/30 border border-white/10 text-[8px] text-white/80 hover:text-white transition-colors font-medium">Loa</a>
                                            <a href="<?php echo esc_url(home_url('/dbacoustic-amply/')); ?>" class="px-2 py-0.5 rounded bg-white/5 hover:bg-[#fbbf24]/30 border border-white/10 text-[8px] text-white/80 hover:text-white transition-colors font-medium">Amply</a>
                                        </div>
                                    </div>
                                    <!-- Right-side Arrow Button CTA -->
                                    <a href="https://hacoled.com/am-thanh/" class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-[#fbbf24] text-black flex items-center justify-center hover:bg-white hover:scale-105 active:scale-95 transition-all shrink-0 shadow-lg" aria-label="Xem tất cả">
                                        <i class="ph-bold ph-arrow-right text-base"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ─── 4 Solution Categories (Larger cards) ─── -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 md:gap-4 fade-up">
                    <a href="<?php echo esc_url(home_url('/man-hinh-led-film-dan-kinh/')); ?>" class="group p-2.5 md:p-5 rounded-xl md:rounded-2xl glass-card-dark border border-white/10 hover:border-[#fbbf24]/50 hover:shadow-lg transition-all duration-300 flex items-center gap-2 md:gap-4">
                        <div class="w-8 h-8 md:w-12 md:h-12 rounded-lg md:rounded-xl bg-[#fbbf24]/10 flex items-center justify-center border border-[#fbbf24]/20 text-[#fbbf24] group-hover:bg-[#fbbf24] group-hover:text-black transition-colors shrink-0">
                            <i class="ph-fill ph-film-strip text-sm md:text-xl"></i>
                        </div>
                        <div>
                            <div class="text-[10px] md:text-xs font-black text-white uppercase tracking-wide">LED Dán Kính</div>
                            <div class="text-[8px] md:text-[9px] text-white/50 font-medium mt-0.5">Transparent Film</div>
                        </div>
                    </a>
                    <a href="<?php echo esc_url(home_url('/man-hinh-led-trong-suot/')); ?>" class="group p-2.5 md:p-5 rounded-xl md:rounded-2xl glass-card-dark border border-white/10 hover:border-[#fbbf24]/50 hover:shadow-lg transition-all duration-300 flex items-center gap-2 md:gap-4">
                        <div class="w-8 h-8 md:w-12 md:h-12 rounded-lg md:rounded-xl bg-[#fbbf24]/10 flex items-center justify-center border border-[#fbbf24]/20 text-[#fbbf24] group-hover:bg-[#fbbf24] group-hover:text-black transition-colors shrink-0">
                            <i class="ph-fill ph-grid-nine text-sm md:text-xl"></i>
                        </div>
                        <div>
                            <div class="text-[10px] md:text-xs font-black text-white uppercase tracking-wide">LED Lưới</div>
                            <div class="text-[8px] md:text-[9px] text-white/50 font-medium mt-0.5">Mesh & Grille</div>
                        </div>
                    </a>
                    <a href="#" class="group p-2.5 md:p-5 rounded-xl md:rounded-2xl glass-card-dark border border-white/10 hover:border-[#fbbf24]/50 hover:shadow-lg transition-all duration-300 flex items-center gap-2 md:gap-4">
                        <div class="w-8 h-8 md:w-12 md:h-12 rounded-lg md:rounded-xl bg-[#fbbf24]/10 flex items-center justify-center border border-[#fbbf24]/20 text-[#fbbf24] group-hover:bg-[#fbbf24] group-hover:text-black transition-colors shrink-0">
                            <i class="ph-fill ph-hand-tap text-sm md:text-xl"></i>
                        </div>
                        <div>
                            <div class="text-[10px] md:text-xs font-black text-white uppercase tracking-wide">Màn Tương Tác</div>
                            <div class="text-[8px] md:text-[9px] text-white/50 font-medium mt-0.5">Interactive</div>
                        </div>
                    </a>
                    <a href="#" class="group p-2.5 md:p-5 rounded-xl md:rounded-2xl glass-card-dark border border-white/10 hover:border-[#fbbf24]/50 hover:shadow-lg transition-all duration-300 flex items-center gap-2 md:gap-4">
                        <div class="w-8 h-8 md:w-12 md:h-12 rounded-lg md:rounded-xl bg-[#fbbf24]/10 flex items-center justify-center border border-[#fbbf24]/20 text-[#fbbf24] group-hover:bg-[#fbbf24] group-hover:text-black transition-colors shrink-0">
                            <i class="ph-fill ph-sliders text-sm md:text-xl"></i>
                        </div>
                        <div>
                            <div class="text-[10px] md:text-xs font-black text-white uppercase tracking-wide">Hệ Thống AV</div>
                            <div class="text-[8px] md:text-[9px] text-white/50 font-medium mt-0.5">Professional AV</div>
                        </div>
                    </a>
                </div>

            </div>
        </div>

    </div>
</section>

