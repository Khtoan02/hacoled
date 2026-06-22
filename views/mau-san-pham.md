<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail Section</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        led: { red: '#D90429' }
                    }
                }
            }
        }
    </script>

    <style>
        body { background-color: #ffffff; color: #1f2937; }
        
        /* Hiệu ứng fade in */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Lưới background mờ */
        .bg-grid-pattern {
            background-size: 40px 40px;
            background-image: 
                linear-gradient(to right, rgba(0,0,0,0.015) 1px, transparent 1px), 
                linear-gradient(to bottom, rgba(0,0,0,0.015) 1px, transparent 1px);
        }

        /* Tùy chỉnh Swiper 3D Gallery */
        .swiper-container-3d {
            width: 100%;
            padding-top: 40px; 
            padding-bottom: 60px;
            overflow: hidden;
            /* Gradient Mask 2 bên rìa rộng hơn (0-20% và 80-100%) để làm mờ ảnh phụ */
            -webkit-mask-image: linear-gradient(to right, transparent 0%, rgba(0,0,0,0.05) 5%, black 20%, black 80%, rgba(0,0,0,0.05) 95%, transparent 100%);
            mask-image: linear-gradient(to right, transparent 0%, rgba(0,0,0,0.05) 5%, black 20%, black 80%, rgba(0,0,0,0.05) 95%, transparent 100%);
        }
        .swiper-slide-3d {
            background-position: center;
            background-size: cover;
            width: 280px; 
            height: 280px; 
            border-radius: 20px; 
            overflow: hidden;
            transition: all 0.6s cubic-bezier(0.25, 1, 0.5, 1); /* Gia tốc lật trang mượt như iOS */
            opacity: 0.3; /* Làm mờ ảnh phụ */
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        @media (min-width: 1024px) {
            .swiper-slide-3d {
                width: 380px; /* Ảnh vuông 1:1 */
                height: 380px;
            }
        }
        .swiper-slide-active {
            opacity: 1 !important; 
            border: 4px solid #ffffff; /* Viền trắng */
            box-shadow: 0 20px 50px -10px rgba(217,4,41,0.25), 0 0 30px rgba(0,0,0,0.05) !important; 
            z-index: 10;
        }
        .swiper-pagination-bullet-active {
            background-color: #D90429 !important;
        }
    </style>
</head>
<body class="antialiased font-sans selection:bg-led-red selection:text-white relative text-sm bg-[#fbfbfb]">

    <!-- CHỈ CÒN DUY NHẤT SECTION NÀY -->
    <section class="relative min-h-screen py-12 lg:py-20 flex items-center bg-grid-pattern overflow-hidden">
        <!-- Subtle Glow Background -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-full pointer-events-none -z-10 flex justify-between">
            <div class="w-[30rem] h-[30rem] bg-red-50 rounded-full mix-blend-multiply filter blur-[100px] opacity-70 -ml-20 mt-10"></div>
            <div class="w-[30rem] h-[30rem] bg-gray-100 rounded-full mix-blend-multiply filter blur-[100px] opacity-70 mr-10 mt-40"></div>
        </div>

        <div class="max-w-[1400px] w-full mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                
                <!-- CỘT TRÁI: THÔNG TIN & ĐẶC QUYỀN -->
                <div class="flex flex-col fade-in z-20 justify-center">
                    
                    <!-- Breadcrumb -->
                    <div class="flex items-center text-[10px] text-gray-400 mb-6 font-medium tracking-wide uppercase">
                        <a href="#" class="hover:text-gray-900 transition-colors">Home</a> 
                        <span class="mx-2 text-gray-300">/</span> 
                        <a href="#" class="hover:text-gray-900 transition-colors">Giải Pháp</a> 
                        <span class="mx-2 text-gray-300">/</span> 
                        <span class="text-gray-900 font-semibold">LED Studio</span>
                    </div>

                    <!-- Title & Desc -->
                    <div class="flex flex-col items-start mb-8">
                        <div class="inline-flex items-center border border-red-200 px-2.5 py-1 bg-red-50 text-red-600 text-[10px] font-bold rounded-full mb-4 tracking-widest shadow-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-2 animate-pulse"></span> CHUYÊN NGHIỆP
                        </div>
                        <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 tracking-tight leading-[1.1] mb-4">
                            Màn hình LED <br/>Studio <span class="text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-400 font-light">Series</span>
                        </h1>
                        <p class="text-gray-500 text-sm leading-relaxed font-light pl-4 border-l-2 border-gray-200">
                            Định hình lại không gian sản xuất nội dung. Tương tác thời gian thực, đồng bộ mượt mà với camera, thay thế hoàn toàn phông xanh truyền thống bằng <strong class="text-gray-900 font-medium">không gian ảo chân thực</strong>.
                        </p>
                    </div>

                    <!-- ĐẶC QUYỀN DỊCH VỤ (Highlight) -->
                    <div class="bg-gradient-to-br from-white to-red-50/10 border border-gray-200 rounded-3xl p-6 md:p-8 mb-8 shadow-[0_10px_40px_rgba(0,0,0,0.03)] relative overflow-hidden group">
                        
                        <!-- Header Đặc Quyền -->
                        <div class="flex items-center gap-3 mb-6 relative z-10 pb-4 border-b border-gray-100">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#D90429] to-red-600 flex items-center justify-center text-white shadow-md shadow-red-200">
                                <i class="fa-solid fa-crown text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-gray-900 font-extrabold text-sm tracking-wide uppercase">Đặc Quyền Dịch Vụ</h3>
                                <p class="text-[11px] text-gray-500 font-medium mt-0.5">Dành riêng cho dự án B2B</p>
                            </div>
                        </div>

                        <!-- 2 Cột: Cam kết & Ưu đãi -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 relative z-10">
                            <div>
                                <h4 class="text-[11px] font-bold text-gray-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                                    <i class="fa-solid fa-shield-check text-emerald-500 text-sm"></i> Cam kết vàng
                                </h4>
                                <ul class="space-y-3">
                                    <li class="flex items-start gap-2.5 text-gray-600 hover:text-gray-900 transition-colors">
                                        <i class="fa-solid fa-check-circle text-emerald-500 text-[11px] mt-0.5"></i>
                                        <span class="text-xs leading-snug font-medium">Hàng chính hãng 100% (CO/CQ)</span>
                                    </li>
                                    <li class="flex items-start gap-2.5 text-gray-600 hover:text-gray-900 transition-colors">
                                        <i class="fa-solid fa-check-circle text-emerald-500 text-[11px] mt-0.5"></i>
                                        <span class="text-xs leading-snug font-medium">Nguồn gốc xuất xứ rõ ràng</span>
                                    </li>
                                    <li class="flex items-start gap-2.5 text-gray-600 hover:text-gray-900 transition-colors">
                                        <i class="fa-solid fa-check-circle text-emerald-500 text-[11px] mt-0.5"></i>
                                        <span class="text-xs leading-snug font-medium">Giá cạnh tranh nhất thị trường</span>
                                    </li>
                                </ul>
                            </div>
                            
                            <div>
                                <h4 class="text-[11px] font-bold text-gray-800 uppercase tracking-wider mb-4 flex items-center gap-2">
                                    <i class="fa-solid fa-gift text-red-500 text-sm"></i> Ưu đãi lớn
                                </h4>
                                <ul class="space-y-3">
                                    <li class="flex items-start gap-2.5 text-gray-600 hover:text-gray-900 transition-colors">
                                        <i class="fa-solid fa-star text-red-400 text-[11px] mt-0.5"></i>
                                        <span class="text-xs leading-snug font-medium">Bảo hành chính hãng 24 tháng</span>
                                    </li>
                                    <li class="flex items-start gap-2.5 text-gray-600 hover:text-gray-900 transition-colors">
                                        <i class="fa-solid fa-star text-red-400 text-[11px] mt-0.5"></i>
                                        <span class="text-xs leading-snug font-medium">Tư vấn kỹ thuật MIỄN PHÍ 24/7</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Bộ sản phẩm -->
                        <div class="mt-6 pt-5 border-t border-gray-100 relative z-10">
                            <h4 class="text-[11px] font-bold text-gray-800 uppercase tracking-wider mb-3 flex items-center gap-2">
                                <i class="fa-solid fa-box-open text-blue-500 text-sm"></i> Trọn bộ thiết bị
                            </h4>
                            <div class="bg-gray-50/80 rounded-xl p-3 border border-gray-100">
                                <p class="text-[11px] text-gray-600 leading-relaxed font-medium">
                                    Module LED, Video Processor chuyên dụng, Khung nhôm định hình, Nguồn & cáp tín hiệu đồng bộ.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Call to Action & Price (Nhỏ gọn) -->
                    <div class="flex flex-col sm:flex-row items-center gap-6 mt-auto">
                        <a href="#contact" class="w-full sm:w-auto bg-[#D90429] hover:bg-[#b90323] text-white font-bold px-10 py-4 rounded-xl flex items-center justify-center gap-3 transition-all duration-300 shadow-[0_10px_20px_rgba(217,4,41,0.25)] hover:-translate-y-1 text-xs uppercase tracking-wider whitespace-nowrap">
                            <i class="fa-solid fa-headset text-base opacity-90"></i> Nhận Báo Giá Ngay
                        </a>
                        
                        <div class="flex flex-col items-center sm:items-start opacity-80">
                            <span class="text-[10px] text-gray-500 uppercase tracking-widest font-semibold mb-0.5">Giá tham khảo từ</span>
                            <div class="flex items-baseline gap-1">
                                <span class="text-xl font-extrabold text-gray-900 tracking-tight">90.000.000</span>
                                <span class="text-sm font-semibold text-gray-900">₫</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CỘT PHẢI: GALLERY 3D COVERFLOW (Vuông, Mờ 2 bên) -->
                <div class="fade-in w-full flex flex-col justify-center relative overflow-hidden h-full">
                    
                    <div class="swiper mySwiper swiper-container-3d">
                        <div class="swiper-wrapper">
                            <!-- Ảnh 1 -->
                            <div class="swiper-slide swiper-slide-3d group">
                                <img src="https://images.unsplash.com/photo-1600607688969-a5bfcd64bd40?auto=format&fit=crop&q=80&w=800&h=800" alt="Dự án 1" class="w-full h-full object-cover">
                            </div>
                            <!-- Ảnh 2 -->
                            <div class="swiper-slide swiper-slide-3d group">
                                <img src="https://images.unsplash.com/photo-1598550476439-6847785fcea6?auto=format&fit=crop&q=80&w=800&h=800" alt="Dự án 2" class="w-full h-full object-cover">
                            </div>
                            <!-- Ảnh 3 (HOT) -->
                            <div class="swiper-slide swiper-slide-3d group">
                                <div class="absolute top-4 left-4 bg-red-600 text-white text-[10px] font-bold px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg z-20">
                                    HOT!
                                </div>
                                <img src="https://images.unsplash.com/photo-1593640408182-31c70c8268f5?auto=format&fit=crop&q=80&w=800&h=800" alt="Dự án 3" class="w-full h-full object-cover">
                            </div>
                            <!-- Ảnh 4 -->
                            <div class="swiper-slide swiper-slide-3d group">
                                <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&q=80&w=800&h=800" alt="Dự án 4" class="w-full h-full object-cover">
                            </div>
                            <!-- Ảnh 5 -->
                            <div class="swiper-slide swiper-slide-3d group">
                                <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&q=80&w=800&h=800" alt="Dự án 5" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <!-- Thêm Pagination Dots -->
                        <div class="swiper-pagination mt-8 relative bottom-0"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        // Hiệu ứng Fade in khi load trang
        document.addEventListener("DOMContentLoaded", () => {
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add('visible');
                }, index * 200); // Lần lượt hiện ra
            });
        });

        // Khởi tạo Swiper 3D
        var swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            initialSlide: 2, 
            coverflowEffect: {
                rotate: 0,      // Ép thẳng ảnh phụ (không nghiêng)
                stretch: 40,    // Khoảng cách giữa các ảnh
                depth: 400,     // Độ sâu lùi về sau của ảnh phụ
                modifier: 1, 
                scale: 0.75,    // Thu nhỏ ảnh phụ
                slideShadows: false, 
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            loop: true, 
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            }
        });
    </script>
</body>
</html>