<?php
/**
 * UI Component: Home Solutions — Single Viewport Compact Layout
 * 
 * Synchronized Transparent Background Design (Seamless with Homepage Container)
 * - Section Background: Pure bg-transparent to inherit parent background color 100%.
 * - Row 1: Compact Flex Accordion (5 Image Cards: Hội trường, Phòng họp, Sân khấu, Trường học, Tiệc & Đám cưới)
 * - Row 2: Specialized Feature Cards (5 Icon Cards: LED Tương tác, Film dán kính, LED lưới, Studio, LED Trong suốt)
 * - Tools: Interactive LED Pixel Calculator Modal & Comprehensive Solution Detail Modals.
 */
?>
<style>
    /* Compact Accordion Animation */
    .sol-expanding-card {
        flex: 1;
        transition: all 0.45s cubic-bezier(0.25, 1, 0.5, 1);
    }
    
    @media (min-width: 768px) {
        .sol-expanding-card.is-expanded {
            flex: 3.2;
        }
    }
    
    .sol-expanding-card .card-bg-img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease, filter 0.4s ease;
    }
    
    .sol-expanding-card:not(.is-expanded) .card-bg-img {
        filter: brightness(0.82) contrast(1.03);
    }

    .sol-expanding-card.is-expanded .card-bg-img {
        transform: scale(1.05);
        filter: brightness(1) contrast(1);
    }

    /* Collapsed Vertical Title Preview */
    .sol-expanding-card .card-collapsed-title {
        opacity: 1;
        transition: opacity 0.35s ease;
    }
    .sol-expanding-card.is-expanded .card-collapsed-title {
        opacity: 0;
    }

    .sol-expanding-card .content-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 1rem;
        background: linear-gradient(to top, rgba(16, 19, 24, 0.92) 0%, rgba(16, 19, 24, 0.35) 50%, transparent 100%);
        transition: all 0.35s ease;
    }
    
    .sol-expanding-card.is-expanded .content-overlay {
        background: linear-gradient(to top, rgba(179, 18, 23, 0.95) 0%, rgba(16, 19, 24, 0.75) 55%, transparent 100%);
    }

    .sol-expanding-card .card-inner-flex {
        transition: gap 0.35s ease;
        gap: 0;
    }
    .sol-expanding-card.is-expanded .card-inner-flex {
        gap: 0.65rem;
    }

    .sol-expanding-card .card-icon-container {
        transition: all 0.35s ease;
        margin: 0 auto;
    }
    
    .sol-expanding-card.is-expanded .card-icon-container {
        margin: 0;
    }

    .sol-expanding-card .card-content-reveal {
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        white-space: nowrap;
        transition: all 0.35s cubic-bezier(0.25, 1, 0.5, 1);
        transform: translateX(12px);
    }
    
    .sol-expanding-card.is-expanded .card-content-reveal {
        max-width: 400px;
        opacity: 1;
        transform: translateX(0);
        white-space: normal;
    }

    @media (max-width: 767px) {
        .sol-accordion-wrapper {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            padding-bottom: 0.5rem;
            gap: 0.65rem;
        }
        .sol-expanding-card {
            flex: 0 0 85% !important;
            scroll-snap-align: start;
            height: 300px !important;
        }
        .sol-expanding-card .card-collapsed-title {
            display: none !important;
        }
        .sol-expanding-card .card-content-reveal {
            max-width: 100% !important;
            opacity: 1 !important;
            transform: none !important;
            white-space: normal !important;
        }
        .sol-expanding-card .card-icon-container {
            margin: 0 !important;
        }
        .sol-expanding-card .card-inner-flex {
            gap: 0.65rem !important;
        }
    }
</style>

<!-- ========================================== -->
<!-- SECTION: GIẢI PHÁP MÀN HÌNH LED            -->
<!-- ========================================== -->
<section id="solutions" class="py-6 md:py-10 bg-transparent relative z-10">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- ─── Synchronized Section Header ─── -->
        <div class="text-center max-w-3xl mx-auto mb-4 md:mb-5 fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-50 border border-rose-200/80 mb-2 shadow-sm">
                <i class="ph-fill ph-sparkle text-[#b31217] text-xs md:text-sm"></i>
                <span class="text-[#b31217] text-[10px] md:text-xs font-extrabold uppercase tracking-widest whitespace-nowrap">GIẢI PHÁP MÀN HÌNH LED</span>
            </div>
            
            <!-- Synchronized H2 Heading Size with Homepage -->
            <h2 id="giai-phap-toan-dien" class="text-xl md:text-4xl lg:text-5xl font-extrabold uppercase tracking-tight text-slate-800 mb-2">
                Giải Pháp Hiển Thị <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#b31217] to-[#e11d48]">Cho Mọi Không Gian</span>
            </h2>
            
            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed max-w-2xl mx-auto px-2 font-normal hidden sm:block">
                Cung cấp các giải pháp màn hình LED tối ưu, đáp ứng đa dạng nhu cầu từ hội trường, phòng họp đến sân khấu, studio và nhiều không gian khác.
            </p>

            <!-- Compact Action Toolbar -->
            <div class="flex items-center justify-center gap-3 mt-3">
                <button type="button" onclick="openHacoledCalcModal()" class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-slate-900 hover:bg-[#b31217] text-white text-xs font-bold transition-all shadow-md active:scale-95">
                    <i class="ph-bold ph-calculator text-[#fbbf24] text-sm"></i>
                    <span>Công cụ Tính Pixel & Size</span>
                </button>
            </div>
        </div>

        <!-- ─── SECTION 1: Dynamic Expanding Gallery (5 Image Cards - Compact Height) ─── -->
        <div class="w-full relative mb-3.5 md:mb-4">
            <div id="solImageAccordion" class="sol-accordion-wrapper flex w-full md:h-[320px] lg:h-[340px] gap-2.5">
                <!-- Rendered via JS below -->
            </div>
        </div>

        <!-- ─── SECTION 2: Specialized Feature Cards (5 Columns Grid) ─── -->
        <div class="w-full">
            <div id="solIconCardsGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-2.5 sm:gap-3">
                <!-- Rendered via JS below -->
            </div>
        </div>

    </div>
</section>

<!-- ========================================== -->
<!-- MODALS FOR SOLUTIONS                       -->
<!-- ========================================== -->

<!-- Solution Detail Modal -->
<div id="solDetailModal" class="fixed inset-0 z-50 bg-black/75 backdrop-blur-sm hidden items-center justify-center p-4">
    <div class="bg-[#141820] text-white rounded-3xl max-w-3xl w-full p-5 sm:p-7 shadow-2xl border border-white/15 relative max-h-[90vh] overflow-y-auto">
        <button type="button" onclick="closeHacoledModal('solDetailModal')" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-white/10 text-white/70 hover:text-white hover:bg-white/20 flex items-center justify-center transition">
            <i class="ph-bold ph-x text-base"></i>
        </button>
        <div id="solDetailModalContent">
            <!-- Rendered dynamically -->
        </div>
    </div>
</div>

<!-- LED Calculator Modal -->
<div id="solCalcModal" class="fixed inset-0 z-50 bg-black/75 backdrop-blur-sm hidden items-center justify-center p-4">
    <div class="bg-[#141820] text-white rounded-3xl max-w-2xl w-full p-5 sm:p-7 shadow-2xl border border-white/15 relative max-h-[90vh] overflow-y-auto">
        <button type="button" onclick="closeHacoledModal('solCalcModal')" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-white/10 text-white/70 hover:text-white hover:bg-white/20 flex items-center justify-center transition">
            <i class="ph-bold ph-x text-base"></i>
        </button>

        <div class="flex items-center gap-3 mb-5">
            <div class="w-10 h-10 rounded-xl bg-[#fbbf24]/20 text-[#fbbf24] border border-[#fbbf24]/30 flex items-center justify-center text-lg font-bold shrink-0">
                <i class="ph-fill ph-calculator"></i>
            </div>
            <div>
                <h3 class="text-lg font-black text-white">Công Cụ Tính Pixel & Size Màn LED</h3>
                <p class="text-xs text-white/70">Xác định Pixel Pitch (P1.25, P2, P2.5...) & khoảng cách xem tối ưu</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="space-y-3.5">
                <div>
                    <label class="block text-xs font-bold text-white/80 mb-1">Môi trường lắp đặt</label>
                    <select id="solCalcEnv" onchange="runHacoledCalc()" class="w-full bg-white/5 border border-white/15 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-[#fbbf24]">
                        <option value="indoor" class="bg-[#141820] text-white">Trong nhà (Indoor)</option>
                        <option value="outdoor" class="bg-[#141820] text-white">Ngoài trời (Outdoor)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-white/80 mb-1">Khoảng cách xem gần nhất (m)</label>
                    <input type="number" id="solCalcDistance" value="3" min="1" max="50" step="0.5" oninput="runHacoledCalc()" class="w-full bg-white/5 border border-white/15 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-[#fbbf24]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-white/80 mb-1">Chiều rộng ước tính (m)</label>
                    <input type="number" id="solCalcWidth" value="4" min="1" max="30" step="0.5" oninput="runHacoledCalc()" class="w-full bg-white/5 border border-white/15 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-[#fbbf24]">
                </div>
            </div>

            <!-- Result Box -->
            <div class="bg-white/5 rounded-2xl p-4 border border-[#fbbf24]/30 flex flex-col justify-between">
                <div>
                    <span class="text-[10px] font-extrabold text-[#fbbf24] uppercase tracking-wider">ĐỀ XUẤT KỸ THUẬT</span>
                    <div class="mt-2">
                        <p class="text-xs text-white/60">Pixel Pitch khuyên dùng:</p>
                        <p id="solCalcResultPitch" class="text-2xl font-black text-[#fbbf24] my-1">LED P2.0</p>
                    </div>
                    <div class="mt-3 space-y-1.5 text-xs text-white/80">
                        <p class="flex items-center gap-1.5"><i class="ph-bold ph-check text-[#fbbf24]"></i>Kích thước: <span id="solCalcResultInch" class="font-bold text-white">180 inch</span></p>
                        <p class="flex items-center gap-1.5"><i class="ph-bold ph-check text-[#fbbf24]"></i>Độ phân giải: <span id="solCalcResultRes" class="font-bold text-white">1920 x 1080 (Full HD)</span></p>
                        <p class="flex items-center gap-1.5"><i class="ph-bold ph-check text-[#fbbf24]"></i>Khoảng cách xem: <span id="solCalcResultDist" class="font-bold text-white">2.5m - 12m</span></p>
                    </div>
                </div>
                <a href="tel:0986086714" class="mt-4 w-full py-2 bg-[#b31217] hover:bg-white text-white hover:text-black font-extrabold text-xs rounded-xl shadow-md transition text-center inline-block">
                    Nhận tư vấn giải pháp này
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- JAVASCRIPT LOGIC                           -->
<!-- ========================================== -->
<script>
(function() {
    // Dynamic Solutions Data Store
    const hacoledSolutions = [
        // Row 1: Image Accordion Cards (5 items)
        {
            id: 'hoi-truong',
            type: 'image',
            title: 'Màn hình LED Hội trường',
            badgeIcon: 'ph-users-three',
            url: '<?php echo esc_url(home_url('/man-hinh-led-hoi-truong/')); ?>',
            image: '<?php echo esc_url(get_template_directory_uri() . "/assets/images/home-solution-led.webp"); ?>',
            description: 'Hiển thị rõ nét cho không gian hội nghị, hội thảo, trung tâm sự kiện quy mô lớn.',
            specs: {
                pixelPitch: 'P1.86 / P2.0 / P2.5',
                brightness: '600 - 1000 nits',
                refreshRate: '3840Hz Ultra-smooth',
                viewingAngle: '160° / 160°',
                lifespan: '100,000 giờ',
                bestFor: 'Hội nghị cấp cao, hội trường lớn, trung tâm sự kiện'
            },
            highlights: [
                'Hình ảnh chuẩn HD/4K không xé hình',
                'Độ tương phản cao, góc nhìn cực rộng',
                'Tiết kiệm điện năng, vận hành bền bỉ 24/7'
            ]
        },
        {
            id: 'phong-hop',
            type: 'image',
            title: 'Màn hình LED Phòng họp',
            badgeIcon: 'ph-presentation',
            url: '<?php echo esc_url(home_url('/man-hinh-led-phong-hop-hoi-truong/')); ?>',
            image: 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800&q=80',
            description: 'Giải pháp trình chiếu chuyên nghiệp, sắc nét cho phòng họp doanh nghiệp & hội nghị online.',
            specs: {
                pixelPitch: 'P1.25 / P1.53 / P1.86',
                brightness: '500 - 800 nits',
                refreshRate: '3840Hz',
                viewingAngle: '170° / 170°',
                lifespan: '100,000 giờ',
                bestFor: 'Phòng họp doanh nghiệp, phòng điều hành, hội nghị trực tuyến'
            },
            highlights: [
                'Tích hợp kết nối không dây đa thiết bị',
                'Hiển thị văn bản & tài liệu siêu sắc nét',
                'Chống lóa mắt khi họp liên tục'
            ]
        },
        {
            id: 'san-khau',
            type: 'image',
            title: 'Màn hình LED Sân khấu',
            badgeIcon: 'ph-sparkle',
            url: '<?php echo esc_url(home_url('/man-hinh-led-san-khau/')); ?>',
            image: 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&w=800&q=80',
            description: 'Hiệu ứng hình ảnh sống động, tần số quét cực cao phục vụ biểu diễn nghệ thuật & liveshow.',
            specs: {
                pixelPitch: 'P2.6 / P2.97 / P3.91',
                brightness: '1200 - 4500 nits',
                refreshRate: '3840Hz - 7680Hz',
                viewingAngle: '140° / 140°',
                lifespan: '100,000 giờ',
                bestFor: 'Sân khấu ca nhạc, liveshow, sự kiện ngoài trời & trong nhà'
            },
            highlights: [
                'Tốc độ làm tươi cực cao hỗ trợ quay phim chuyên nghiệp',
                'Tháo lắp dạng Cabin nhanh chóng',
                'Chịu va đập và chống ẩm tốt'
            ]
        },
        {
            id: 'truong-hoc',
            type: 'image',
            title: 'Màn hình LED Trường học',
            badgeIcon: 'ph-chalkboard-teacher',
            url: '<?php echo esc_url(home_url('/man-hinh-led-truong-hoc/')); ?>',
            image: 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=800&q=80',
            description: 'Trình chiếu giảng dạy & truyền thông trực quan cho môi trường giáo dục hiện đại.',
            specs: {
                pixelPitch: 'P2.0 / P2.5',
                brightness: '600 - 800 nits',
                refreshRate: '1920Hz - 3840Hz',
                viewingAngle: '160° / 160°',
                lifespan: '100,000 giờ',
                bestFor: 'Giảng đường, phòng học thông minh, nhà thể thao'
            },
            highlights: [
                'Bảo vệ thị lực học sinh, chống chói',
                'Hỗ trợ công cụ tương tác & trình chiếu bài giảng',
                'Dễ dàng quản lý nội dung trung tâm'
            ]
        },
        {
            id: 'tiec-cuoi',
            type: 'image',
            title: 'Màn hình LED Tiệc & Đám cưới',
            badgeIcon: 'ph-wine',
            url: '<?php echo esc_url(home_url('/man-hinh-led-tiec-cuoi-nha-hang/')); ?>',
            image: 'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=800&q=80',
            description: 'Tạo không gian sang trọng, hiệu ứng 3D chân thực tôn vinh trọn vẹn khoảnh khắc tiệc cưới.',
            specs: {
                pixelPitch: 'P2.5 / P3.0',
                brightness: '800 - 1200 nits',
                refreshRate: '3840Hz',
                viewingAngle: '160° / 160°',
                lifespan: '100,000 giờ',
                bestFor: 'Trung tâm tiệc cưới, nhà hàng tiệc cao cấp, gala dinner'
            },
            highlights: [
                'Màu sắc ấm áp, tái tạo màu da cô dâu chú rể chân thực',
                'Tạo phông nền dynamic 3D sống động',
                'Tùy biến kích thước theo thiết kế sảnh'
            ]
        },

        // Row 2: Icon Cards (5 items)
        {
            id: 'led-tuong-tac',
            type: 'icon',
            title: 'Màn hình LED Tương tác',
            badgeIcon: 'ph-hand-tap',
            url: '<?php echo esc_url(home_url('/man-hinh-tuong-tac/')); ?>',
            description: 'Cảm ứng đa điểm nhạy bén, phục vụ điều hành, họp chiến lược & trải nghiệm thương hiệu.',
            specs: {
                pixelPitch: 'P1.25 / P1.56 / P1.87',
                brightness: '600 - 800 nits',
                refreshRate: '3840Hz',
                viewingAngle: '170° / 170°',
                lifespan: '100,000 giờ',
                bestFor: 'Phòng học trải nghiệm, trung tâm chỉ huy, triển lãm tương tác'
            },
            highlights: ['Cảm ứng đa điểm nhạy bén', 'Kính gia cường chống va đập', 'Hệ điều hành Android/Windows']
        },
        {
            id: 'led-film',
            type: 'icon',
            title: 'LED Film Dán Kính',
            badgeIcon: 'ph-film-strip',
            url: '<?php echo esc_url(home_url('/man-hinh-led-film-dan-kinh/')); ?>',
            description: 'Tấm film trong suốt dán trực tiếp lên kính, giữ nguyên ánh sáng tự nhiên.',
            specs: {
                pixelPitch: 'P3.91 / P7.81 / P10',
                brightness: '2000 - 5000 nits',
                refreshRate: '3840Hz',
                viewingAngle: '140° / 140°',
                lifespan: '80,000 giờ',
                bestFor: 'Vách kính showroom, tòa nhà, cửa hàng cao cấp'
            },
            highlights: ['Độ trong suốt lên đến 85%', 'Dán trực tiếp không che sáng', 'Siêu nhẹ 3-5kg/m²']
        },
        {
            id: 'led-luoi',
            type: 'icon',
            title: 'Màn hình LED Lưới',
            badgeIcon: 'ph-grid-nine',
            url: '<?php echo esc_url(home_url('/man-hinh-led-trong-suot/')); ?>',
            description: 'Cấu trúc lưới xuyên gió, siêu nhẹ, tối ưu cho kiến trúc mặt tiền ngoài trời.',
            specs: {
                pixelPitch: 'P15.6 / P31.25 / P50',
                brightness: '5000 - 8000 nits',
                refreshRate: '3840Hz',
                viewingAngle: '120° / 120°',
                lifespan: '100,000 giờ',
                bestFor: 'Mặt tiền tòa nhà, biển quảng cáo ngoài trời'
            },
            highlights: ['Chịu gió giật mạnh', 'Tản nhiệt tự nhiên', 'Chống nước IP67']
        },
        {
            id: 'led-studio',
            type: 'icon',
            title: 'Màn hình LED Studio',
            badgeIcon: 'ph-video-camera',
            url: '<?php echo esc_url(home_url('/man-hinh-led-studio/')); ?>',
            description: 'Độ màu DCI-P3 99%, tần số 7680Hz chống chớp cho đài truyền hình & xưởng Virtual Production.',
            specs: {
                pixelPitch: 'P1.56 / P1.95 / P2.6',
                brightness: '800 - 1200 nits',
                refreshRate: '7680Hz Anti-flicker',
                viewingAngle: '170° / 170°',
                lifespan: '100,000 giờ',
                bestFor: 'Studio ảo, đài truyền hình, livestream chuyên nghiệp'
            },
            highlights: ['Dải màu DCI-P3 99%', 'Không hiệu ứng Moiré khi quay', 'Phản hồi nanosecond']
        },
        {
            id: 'led-trong-suot',
            type: 'icon',
            title: 'Màn hình LED Trong suốt',
            badgeIcon: 'ph-squares-four',
            url: '<?php echo esc_url(home_url('/man-hinh-led-trong-suot/')); ?>',
            description: 'Mô-đun nhôm tinh tế trong suốt 80%, kiến tạo đẳng cấp không gian sang trọng.',
            specs: {
                pixelPitch: 'P2.8 / P3.91 / P7.82',
                brightness: '4500 - 6000 nits',
                refreshRate: '3840Hz',
                viewingAngle: '160° / 160°',
                lifespan: '100,000 giờ',
                bestFor: 'Showroom cao cấp, sân khấu hiện đại, kiến trúc kính'
            },
            highlights: ['Độ trong suốt 70 - 80%', 'Giữ nguyên thiết kế kính', 'Khung nhôm mỏng nhẹ']
        }
    ];

    // Render Function
    function renderHacoledCards() {
        const accordionEl = document.getElementById('solImageAccordion');
        const gridEl = document.getElementById('solIconCardsGrid');
        if (!accordionEl || !gridEl) return;

        const currentExpanded = document.querySelector('.sol-expanding-card.is-expanded');
        const expandedId = currentExpanded ? currentExpanded.getAttribute('data-id') : 'hoi-truong';

        accordionEl.innerHTML = '';
        gridEl.innerHTML = '';

        const imageItems = hacoledSolutions.filter(item => item.type === 'image');
        const iconItems = hacoledSolutions.filter(item => item.type === 'icon');

        // 1. Render Row 1 Image Accordion Cards (5 cards)
        imageItems.forEach((item, index) => {
            const isExpanded = item.id === expandedId;
            const expandedClass = isExpanded ? 'is-expanded' : '';

            const card = document.createElement('div');
            card.className = `sol-expanding-card ${expandedClass} relative rounded-2xl overflow-hidden cursor-pointer shadow-md hover:shadow-xl border border-slate-200/80 group`;
            card.setAttribute('data-id', item.id);

            card.innerHTML = `
                <img src="${item.image}" alt="${item.title}" class="card-bg-img" loading="lazy">
                
                <!-- Vertical Title Preview for Collapsed State (Desktop) -->
                <div class="card-collapsed-title hidden md:flex absolute inset-0 items-center justify-center pointer-events-none z-10 pb-10">
                    <span class="text-white font-black text-xs lg:text-sm tracking-widest uppercase whitespace-nowrap -rotate-90 drop-shadow-[0_2px_8px_rgba(0,0,0,0.9)]">
                        ${item.title.replace('Màn hình LED ', '')}
                    </span>
                </div>

                <div class="content-overlay">
                    <div class="flex flex-col h-full justify-end">
                        <div class="flex items-center w-full card-inner-flex">
                            <div class="card-icon-container w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center shrink-0 border border-white/30 text-white shadow-md">
                                <i class="ph-fill ${item.badgeIcon} text-base"></i>
                            </div>
                            
                            <div class="card-content-reveal flex flex-col justify-center pr-2">
                                <h3 class="font-black text-xs sm:text-base lg:text-lg text-white drop-shadow mb-0.5">${item.title}</h3>
                                <p class="text-[11px] sm:text-xs text-white/85 leading-snug drop-shadow line-clamp-2">${item.description}</p>
                                <div class="mt-1.5 flex items-center gap-1.5">
                                    <span class="inline-flex items-center gap-1 text-[10px] sm:text-[11px] font-extrabold text-[#fbbf24] hover:underline">
                                        <span>Xem giải pháp</span> <i class="ph-bold ph-arrow-right"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Hover event to expand
            card.addEventListener('mouseenter', () => {
                document.querySelectorAll('.sol-expanding-card').forEach(c => c.classList.remove('is-expanded'));
                card.classList.add('is-expanded');
            });

            // Click card body opens detail modal
            card.addEventListener('click', () => {
                window.openHacoledDetailModal(item.id);
            });

            accordionEl.appendChild(card);
        });

        // 2. Render Row 2 Icon Cards (5 cards)
        iconItems.forEach(item => {
            const card = document.createElement('div');
            card.className = 'bg-white border border-slate-200/90 hover:border-[#b31217]/50 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 group rounded-xl p-3 flex items-center gap-3 cursor-pointer h-full';
            
            card.innerHTML = `
                <div class="w-10 h-10 rounded-xl bg-rose-50 text-[#b31217] border border-rose-100 flex items-center justify-center text-lg shrink-0 group-hover:bg-[#b31217] group-hover:text-white transition-colors shadow-sm">
                    <i class="ph-fill ${item.badgeIcon}"></i>
                </div>
                <div class="flex flex-col flex-1 min-w-0">
                    <h3 class="font-extrabold text-xs lg:text-[13px] text-slate-900 leading-snug line-clamp-2 group-hover:text-[#b31217] transition-colors">${item.title}</h3>
                    <p class="text-[10px] sm:text-[11px] text-slate-500 leading-tight line-clamp-2 mt-0.5">${item.description}</p>
                </div>
            `;

            card.addEventListener('click', () => window.openHacoledDetailModal(item.id));
            gridEl.appendChild(card);
        });
    }

    // Modal Control Functions
    window.openHacoledDetailModal = function(id) {
        const item = hacoledSolutions.find(s => s.id === id);
        if (!item) return;

        const content = document.getElementById('solDetailModalContent');
        if (!content) return;

        content.innerHTML = `
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-[#fbbf24]/20 text-[#fbbf24] border border-[#fbbf24]/30 flex items-center justify-center text-lg shrink-0">
                    <i class="ph-fill ${item.badgeIcon}"></i>
                </div>
                <div>
                    <span class="text-[10px] font-extrabold text-[#fbbf24] uppercase tracking-wider">GIẢI PHÁP CHUYÊN SÂU HACOLED</span>
                    <h3 class="text-xl sm:text-2xl font-black text-white">${item.title}</h3>
                </div>
            </div>

            ${item.type === 'image' ? `
                <div class="h-48 sm:h-64 rounded-2xl overflow-hidden mb-5 relative border border-white/10">
                    <img src="${item.image}" alt="${item.title}" class="w-full h-full object-cover">
                    <div class="absolute bottom-3 left-3 bg-black/70 backdrop-blur-md px-3 py-1 rounded-lg text-white text-xs">
                        <i class="ph-bold ph-camera mr-1"></i> Ảnh ứng dụng thực tế
                    </div>
                </div>
            ` : ''}

            <p class="text-white/80 text-xs sm:text-sm leading-relaxed mb-5">${item.description}</p>

            <div class="mb-5">
                <h4 class="text-xs font-extrabold uppercase tracking-wider text-white/50 mb-2.5">Đặc tính ưu việt</h4>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                    ${item.highlights.map(hl => `
                        <div class="bg-white/5 p-2.5 rounded-xl border border-white/10 text-xs text-white/90 flex items-start gap-2">
                            <i class="ph-fill ph-check-circle text-[#fbbf24] mt-0.5 shrink-0"></i>
                            <span>${hl}</span>
                        </div>
                    `).join('')}
                </div>
            </div>

            <div class="bg-white/5 rounded-2xl p-4 border border-white/10 mb-6">
                <h4 class="text-xs font-extrabold uppercase tracking-wider text-[#fbbf24] mb-3 flex items-center gap-1.5">
                    <i class="ph-bold ph-sliders"></i>Thông số kỹ thuật đề xuất
                </h4>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs">
                    <div><span class="text-white/50 block">Pixel Pitch</span><span class="font-bold text-white">${item.specs.pixelPitch}</span></div>
                    <div><span class="text-white/50 block">Độ sáng</span><span class="font-bold text-white">${item.specs.brightness}</span></div>
                    <div><span class="text-white/50 block">Tần số quét</span><span class="font-bold text-white">${item.specs.refreshRate}</span></div>
                    <div><span class="text-white/50 block">Góc nhìn</span><span class="font-bold text-white">${item.specs.viewingAngle}</span></div>
                    <div><span class="text-white/50 block">Tuổi thọ bóng</span><span class="font-bold text-white">${item.specs.lifespan}</span></div>
                    <div><span class="text-white/50 block">Phù hợp nhất</span><span class="font-bold text-white">${item.specs.bestFor}</span></div>
                </div>
            </div>

            <div class="flex items-center justify-end">
                <a href="${item.url}" class="w-full sm:w-auto px-6 py-3 bg-[#b31217] hover:bg-white text-white hover:text-black text-center rounded-xl font-extrabold text-xs shadow-lg transition">
                    <i class="ph-bold ph-arrow-right mr-1"></i>Xem trang chi tiết giải pháp
                </a>
            </div>
        `;

        const modal = document.getElementById('solDetailModal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    };

    window.closeHacoledModal = function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    };

    window.openHacoledCalcModal = function() {
        const modal = document.getElementById('solCalcModal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            runHacoledCalc();
        }
    };

    window.runHacoledCalc = function() {
        const env = document.getElementById('solCalcEnv')?.value || 'indoor';
        const dist = parseFloat(document.getElementById('solCalcDistance')?.value || '3');
        const width = parseFloat(document.getElementById('solCalcWidth')?.value || '4');

        let pitch = 'P2.0';
        if (env === 'outdoor') {
            if (dist < 4) pitch = 'P3.0 Outdoor';
            else if (dist < 8) pitch = 'P3.91 Outdoor';
            else pitch = 'P5.0 Outdoor';
        } else {
            if (dist < 2) pitch = 'P1.25 Ultra Fine';
            else if (dist < 3.5) pitch = 'P1.86 / P2.0';
            else pitch = 'P2.5 Indoor';
        }

        const inch = Math.round(width * 39.37 / 0.87);
        const pitchNum = parseFloat(pitch.replace(/[^\d.]/g, '')) || 2.0;
        const widthPx = Math.round((width * 1000) / pitchNum);
        const heightPx = Math.round(widthPx * 9 / 16);

        let res = `${widthPx} x ${heightPx}px`;
        if (widthPx >= 3840) res += ' (4K UHD)';
        else if (widthPx >= 1920) res += ' (Full HD)';

        const minD = (pitchNum * 1.2).toFixed(1);
        const maxD = (pitchNum * 5).toFixed(1);

        document.getElementById('solCalcResultPitch').textContent = `LED ${pitch}`;
        document.getElementById('solCalcResultInch').textContent = `~${inch} inch`;
        document.getElementById('solCalcResultRes').textContent = res;
        document.getElementById('solCalcResultDist').textContent = `${minD}m - ${maxD}m`;
    };

    // Init on DOM Load
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', renderHacoledCards);
    } else {
        renderHacoledCards();
    }
})();
</script>
