<?php
/**
 * Building Decorative LED Page View Template - Complete Aceternity UI Reference Layout (Ultra-Glassy Light Edition)
 *
 * @var array  $page
 * @var array  $products
 * @var array  $projects
 * @var string $header_type
 * @var string $footer_type
 */

$this->renderHeader($header_type ?? 'default');

// Hardcode 50 high-quality dynamic project images for testing and illustration
$display_projects = [];
$unsplash_ids = [
    'photo-1565814636199-ae8133055c1c', 'photo-1540575467063-178a50c2df87', 'photo-1517604931442-7e0c8ed2963c',
    'photo-1507608869274-d3177c8bb4c7', 'photo-1517245386807-bb43f82c33c4', 'photo-1477959858617-67f85cf4f1df',
    'photo-1486406146926-c627a92ad1ab', 'photo-1496568818309-53d7c7753022', 'photo-1519501025264-65ba15a82390',
    'photo-1470071459604-3b5ec3a7fe05', 'photo-1509198397868-475647b2a1e5', 'photo-1475855581690-80accde3ae2b',
    'photo-1513694203232-719a280e022f', 'photo-1518241353330-0f7941c2d9b5', 'photo-1480714378408-67cf0d13bc1b',
    'photo-1449034446853-66c86144b0ad', 'photo-1516450360452-9312f5e86fc7', 'photo-1502877338535-766e1452684a',
    'photo-1504608524841-42fe6f032b4b', 'photo-1520250497591-112f2f40a3f4', 'photo-1506744038136-46273834b3fb',
    'photo-1501785888041-af3ef285b470', 'photo-1469474968028-56623f02e42e', 'photo-1447752875215-b2761acb3c5d',
    'photo-1472214222541-d510753a4907', 'photo-1433832597026-a5a0823c9657', 'photo-1500530855697-b586d89ba3ee',
    'photo-1513829096999-497860229434', 'photo-1518495973542-4542c06a5843', 'photo-1505232458729-4106786a5171',
    'photo-1513836279014-a89f7a76ae86', 'photo-1522071820081-009f0129c71c', 'photo-1515187029135-18ee286d815b',
    'photo-1497366216548-37526070297c', 'photo-1497215728101-856f4ea42174', 'photo-1497366811353-6870744d04b2',
    'photo-1504384308090-c894fdcc538d', 'photo-1542744094-3a31f103e35f', 'photo-1454165804606-c3d57bc86b40',
    'photo-1519389950473-47ba0277781c', 'photo-1531403009284-440f080d1e12', 'photo-1522071820081-009f0129c71c',
    'photo-1531482615713-2afd69097998', 'photo-1556761175-4b46a572b786', 'photo-1515187029135-18ee286d815b',
    'photo-1552581230-261c4701235d', 'photo-1558224494-46b221937987', 'photo-1568992687947-868a62a9f521',
    'photo-1573497019940-1c28c88b4f3e', 'photo-1573164713714-d95e436ab8d6'
];

$districts = ['Quận 1, TP.HCM', 'Quận Ba Đình, Hà Nội', 'Quận Cầu Giấy, Hà Nội', 'Quận Hải Châu, Đà Nẵng', 'Quận Ngũ Hành Sơn, Đà Nẵng', 'Quận Hoàn Kiếm, Hà Nội'];
$clients = ['Tập đoàn Vingroup', 'Tập đoàn Geleximco', 'Ngân hàng Vietcombank', 'Ngân hàng VPBank', 'Kinh Đô TCI Group', 'Tập đoàn Bitexco', 'Tập đoàn Novaland', 'Tập đoàn Sun Group'];
$lighting_types = ['LED Mesh P16-32 ngoài trời', 'LED Linear RGB chạy viền', 'LED Pixel Dot 50mm lập trình', 'LED Wall Washer 48W chiếu rọi'];

for ($i = 0; $i < 50; $i++) {
    $img_id = $unsplash_ids[$i % count($unsplash_ids)];
    $client = $clients[$i % count($clients)];
    $district = $districts[$i % count($districts)];
    $type = $lighting_types[$i % count($lighting_types)];
    $year = 2023 + ($i % 4);
    
    $display_projects[] = [
        'title'      => sprintf(__('Chiếu sáng mỹ thuật Tòa nhà Landmark %02d', 'hacoled'), $i + 1),
        'client'     => $client . ' - ' . $district,
        'tech_specs' => $type . ' | DMX512',
        'year'       => (string)$year,
        'image'      => 'https://images.unsplash.com/' . $img_id . '?q=80&w=1000&auto=format&fit=crop',
    ];
}

$hero_bg_url = get_template_directory_uri() . '/assets/images/ChatGPT Image 15_16_34 3 thg 8, 2026.png';
?>

<!-- ACETERNITY UI STYLE LANDING PAGE FOR HACOLED FACADE (ULTRA-GLASSY LIGHT EDITION) -->
<main class="relative bg-[#F8F6F5] text-slate-900 min-h-screen overflow-hidden selection:bg-[#B31217] selection:text-white font-sans">
  
  <!-- SECTION 1: HERO SECTION (Raw 4K Background Image + Ultra-Transparent Glassmorphism + White-to-Gold Gradient Text, No Shadows) -->
  <section class="relative pt-44 lg:pt-52 pb-16 lg:pb-20 px-4 lg:px-8 border-b border-slate-200 overflow-hidden min-h-screen flex flex-col justify-between">
    <!-- Raw 100% Opacity Custom Background Image -->
    <div class="absolute inset-0 z-0 overflow-hidden">
      <img src="<?php echo esc_url($hero_bg_url); ?>" alt="HacoLED Building Facade" class="w-full h-full object-cover opacity-100">
    </div>

    <div class="max-w-[1440px] mx-auto w-full relative z-10 space-y-8 my-auto">
      
      <!-- Top Badge (Ultra Transparent Glass + Yellow Dot) -->
      <div class="flex justify-start">
        <div class="inline-flex items-center gap-2 bg-white/25 border border-white/50 px-4 py-1.5 rounded-full text-xs font-mono font-semibold text-white shadow-xl backdrop-blur-xl">
          <span class="w-2.5 h-2.5 rounded-full bg-[#FBBF24] animate-pulse"></span>
          <span>HACOLED FACADE · Nhà thầu chiếu sáng mỹ thuật 3D</span>
        </div>
      </div>

      <!-- Left-Aligned Hero Content Block -->
      <div class="max-w-3xl space-y-6">
        <!-- Headline: From White to Premium Gold Yellow, NO TEXT SHADOW -->
        <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black tracking-tight leading-[1.08] text-transparent bg-clip-text bg-gradient-to-r from-white via-[#FDE047] to-[#FBBF24]">
          Chiếu Sáng Mỹ Thuật<br/>
          Kiến Tạo Biểu Tượng Tòa Nhà.
        </h1>

        <!-- Ultra-Transparent Glass Description Box -->
        <p class="text-slate-100 text-sm sm:text-base leading-relaxed font-medium bg-white/25 p-6 rounded-2xl border border-white/40 shadow-2xl backdrop-blur-2xl max-w-2xl">
          Chúng tôi tư vấn, thiết kế 3D và thi công trọn gói hệ thống LED mặt dựng tòa nhà cao tầng. Tối ưu năng lượng, vận hành thông minh qua DMX512 và Cloud IoT.
        </p>

        <div class="flex flex-wrap items-center gap-4 pt-2">
          <!-- Primary CTA Button (Yellow Hero Accent) -->
          <a href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>" class="inline-flex items-center gap-2 bg-[#FBBF24] hover:bg-amber-400 text-slate-950 font-black text-xs uppercase px-8 py-4 rounded-xl transition-all duration-300 shadow-2xl shadow-amber-500/30 border border-amber-300">
            <i class="ph-bold ph-chats-circle text-base"></i>
            <span>Khảo Sát & Báo Giá 3D</span>
          </a>
          <!-- Secondary Ultra-Glass Button -->
          <a href="#projects-section" class="inline-flex items-center gap-2 bg-white/30 backdrop-blur-xl border border-white/50 text-white hover:bg-white/40 font-bold text-xs uppercase px-6 py-4 rounded-xl transition-all duration-300 shadow-lg">
            <span>Dự Án</span>
            <i class="ph-bold ph-arrow-down text-xs text-[#FBBF24]"></i>
          </a>
        </div>
      </div>

    </div>

    <!-- Client Logos Marquee (Ultra-Transparent Glass Theme) -->
    <div class="max-w-[1440px] mx-auto w-full relative z-10 pt-12 pb-4">
      <div class="bg-white/25 border border-white/40 backdrop-blur-2xl rounded-2xl p-6 md:p-8 text-center space-y-6 shadow-2xl">
        <span class="text-[10px] font-mono font-bold tracking-widest text-slate-200 uppercase">ĐÃ ĐỒNG HÀNH CÙNG CÁC TẬP ĐOÀN VÀ CHỦ ĐẦU TƯ HÀNG ĐẦU</span>
        
        <div class="flex flex-wrap items-center justify-center gap-6 md:gap-12 opacity-95 text-xs font-mono font-bold text-white">
          <span class="px-4 py-2 bg-white/25 backdrop-blur-md rounded-lg border border-white/40 shadow-sm hover:border-[#FBBF24]">VINGROUP</span>
          <span class="px-4 py-2 bg-white/25 backdrop-blur-md rounded-lg border border-white/40 shadow-sm hover:border-[#FBBF24]">GELEXIMCO</span>
          <span class="px-4 py-2 bg-white/25 backdrop-blur-md rounded-lg border border-white/40 shadow-sm hover:border-[#FBBF24]">VIETCOMBANK</span>
          <span class="px-4 py-2 bg-white/25 backdrop-blur-md rounded-lg border border-white/40 shadow-sm hover:border-[#FBBF24]">VPBANK</span>
          <span class="px-4 py-2 bg-white/25 backdrop-blur-md rounded-lg border border-white/40 shadow-sm hover:border-[#FBBF24]">BITEXCO</span>
          <span class="px-4 py-2 bg-white/25 backdrop-blur-md rounded-lg border border-white/40 shadow-sm hover:border-[#FBBF24]">SUN GROUP</span>
          <span class="px-4 py-2 bg-white/25 backdrop-blur-md rounded-lg border border-white/40 shadow-sm hover:border-[#FBBF24]">NOVALAND</span>
        </div>
      </div>
    </div>

  </section>

  <!-- SECTION 2: BENTO FEATURE GRID "Tại sao chọn HacoLED" (Light Theme) -->
  <section class="py-24 px-4 lg:px-8 bg-[#F8F6F5] text-slate-900 border-b border-slate-200">
    <div class="max-w-[1440px] mx-auto space-y-16">
      
      <div class="max-w-2xl space-y-3">
        <span class="text-xs font-mono font-bold text-[#B31217] uppercase tracking-widest">TẠI SAO CHỌN HACOLED</span>
        <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight uppercase text-slate-900">
          Giải Pháp Chiếu Sáng Mỹ Thuật Trọn Gói.
        </h2>
      </div>

      <!-- Bento Grid Layout -->
      <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        
        <!-- Card 1: Light Card on Left (col-span-4) -->
        <div class="md:col-span-4 bg-white text-slate-900 p-8 rounded-3xl border border-slate-200 flex flex-col justify-between space-y-8 shadow-md">
          <div class="space-y-4">
            <span class="px-3 py-1 rounded-full bg-red-50 border border-red-200 text-[#B31217] font-mono text-[10px] font-bold uppercase tracking-wider">3D Facade Studio</span>
            <h3 class="text-2xl font-bold text-slate-900">Thiết Kế & Mô Phỏng 3D Sơ Bộ Miễn Phí</h3>
            <p class="text-xs text-slate-600 leading-relaxed font-normal">
              Chúng tôi tiến hành dựng toàn bộ hiệu ứng ánh sáng 3D trên mô hình tòa nhà của bạn trước khi thi công, giúp chủ đầu tư duyệt phương án trực quan 100%.
            </p>
          </div>

          <div class="space-y-4">
            <div class="w-full aspect-[4/3] rounded-2xl bg-slate-100 overflow-hidden border border-slate-200 relative">
              <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover" alt="3D Simulation">
            </div>
            <a href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>" class="w-full inline-flex items-center justify-center gap-2 bg-[#FBBF24] hover:bg-amber-400 text-slate-950 font-extrabold text-xs uppercase py-3.5 rounded-xl transition-colors shadow-sm">
              <span>Đăng ký bản vẽ 3D</span>
              <i class="ph-bold ph-arrow-right text-xs"></i>
            </a>
          </div>
        </div>

        <!-- Right Side 4 Bento Cards Grid (col-span-8) -->
        <div class="md:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-6">
          
          <!-- Card 2: Top Left (Tracking & Status) -->
          <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-4 flex flex-col justify-between">
            <div class="space-y-2">
              <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold">
                <i class="ph-bold ph-clock-afternoon text-xl"></i>
              </div>
              <h4 class="text-lg font-bold text-slate-900">Giám Sát Tiến Độ 24/7</h4>
              <p class="text-xs text-slate-500 font-normal leading-relaxed">
                Hệ thống báo cáo nhật ký thi công điện tử liên tục, giúp ban quản lý dự án theo dõi sát sao từng mốc nghiệm thu.
              </p>
            </div>
            <div class="bg-slate-50 p-3 rounded-xl border border-slate-100 flex items-center justify-between text-xs font-mono">
              <span class="text-slate-500">Trạng thái thi công:</span>
              <span class="text-[#B31217] font-bold">● Đang đúng tiến độ</span>
            </div>
          </div>

          <!-- Card 3: Top Right (Cloud & IoT Map) -->
          <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-4 flex flex-col justify-between">
            <div class="space-y-2">
              <div class="w-10 h-10 rounded-xl bg-red-50 text-[#B31217] flex items-center justify-center font-bold">
                <i class="ph-bold ph-cloud-arrow-up text-xl"></i>
              </div>
              <h4 class="text-lg font-bold text-slate-900">Quản Lý Đám Mây IoT</h4>
              <p class="text-xs text-slate-500 font-normal leading-relaxed">
                Đồng bộ điều khiển kịch bản chiếu sáng từ xa qua Internet, hỗ trợ đặt lịch bật/tắt theo lễ tết tự động.
              </p>
            </div>
            <div class="bg-slate-100 text-slate-800 p-3 rounded-xl border border-slate-200 flex items-center justify-between text-xs font-mono">
              <span>HacoLED Portal Cloud</span>
              <span class="text-[#B31217] font-bold">Online</span>
            </div>
          </div>

          <!-- Card 4: Bottom Left (Certified Hardware IP68) -->
          <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-4 flex flex-col justify-between">
            <div class="space-y-2">
              <div class="w-10 h-10 rounded-xl bg-red-50 text-[#B31217] flex items-center justify-center font-bold">
                <i class="ph-bold ph-shield-check text-xl"></i>
              </div>
              <h4 class="text-lg font-bold text-slate-900">Vật Tư Chuẩn IP68 & CO/CQ</h4>
              <p class="text-xs text-slate-500 font-normal leading-relaxed">
                100% module LED nhập khẩu chính ngạch, đạt chuẩn kháng nước chống bụi IP68 và vỏ hợp kim chống ăn mòn.
              </p>
            </div>
            <div class="flex gap-2 text-[10px] font-mono font-bold">
              <span class="px-2.5 py-1 bg-red-50 text-[#B31217] rounded">ISO 9001</span>
              <span class="px-2.5 py-1 bg-red-50 text-[#B31217] rounded">CE Certified</span>
            </div>
          </div>

          <!-- Card 5: Bottom Right (Warranty & Life support) -->
          <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-4 flex flex-col justify-between">
            <div class="space-y-2">
              <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold">
                <i class="ph-bold ph-wrench text-xl"></i>
              </div>
              <h4 class="text-lg font-bold text-slate-900">Bảo Hành Vàng 36 Tháng</h4>
              <p class="text-xs text-slate-500 font-normal leading-relaxed">
                Cam kết khắc phục sự cố tại công trình trong vòng 2 giờ tại Hà Nội và TP.HCM. Bảo trì định kỳ trọn đời.
              </p>
            </div>
            <div class="text-xs font-mono text-[#B31217] font-bold">
              ★ Hỗ trợ kỹ thuật 24/7
            </div>
          </div>

        </div>

      </div>

    </div>
  </section>

  <!-- SECTION 3: PROJECTS WITH GIANT WATERMARK TEXT (Light Theme) -->
  <section id="projects-section" class="py-28 px-4 lg:px-8 bg-[#F8F6F5] relative overflow-hidden border-b border-slate-200">
    
    <!-- Massive Watermark Text "PROJECTS" -->
    <div class="absolute top-8 left-1/2 -translate-x-1/2 pointer-events-none select-none">
      <span class="text-[16vw] font-black text-slate-300/40 leading-none tracking-tighter uppercase font-mono">
        PROJECTS
      </span>
    </div>

    <div class="max-w-[1440px] mx-auto relative z-10 space-y-16">
      
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-3 max-w-xl">
          <span class="text-xs font-mono font-bold text-[#B31217] uppercase tracking-widest">HỒ SƠ NĂNG LỰC DỰ ÁN</span>
          <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight uppercase text-slate-900">
            Công Trình Thực Tế Đã Thi Công.
          </h2>
          <p class="text-slate-600 text-xs sm:text-sm font-normal">
            Dưới đây là các dự án chiếu sáng mặt dựng nổi bật. Bấm vào ảnh bất kỳ để lướt xem trình chiếu toàn màn hình.
          </p>
        </div>
      </div>

      <!-- Bento Masonry Projects Container (50 Images Loader) -->
      <div id="projects-masonry-container" class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6">
        <?php foreach ($display_projects as $index => $project): 
          $image_url = !empty($project['image']) ? $project['image'] : (!empty($project['thumbnail']) ? $project['thumbnail'] : '');
          if (empty($image_url)) continue;
          
          // Show first 6 images, hide the rest for high performance initial load
          $hide_class = ($index >= 6) ? 'hidden project-item-hidden' : '';
        ?>
          <div class="project-card-item <?php echo esc_attr($hide_class); ?> break-inside-avoid group relative rounded-3xl overflow-hidden bg-white border border-slate-200 shadow-md hover:border-[#B31217] hover:-translate-y-1 transition-all duration-500 cursor-pointer" data-project-index="<?php echo $index; ?>">
            <div class="relative overflow-hidden aspect-[4/3]">
              <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($project['title']); ?>" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
              <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
              
              <span class="absolute top-4 left-4 px-2.5 py-1 rounded-md bg-[#FBBF24] text-slate-950 text-[9px] font-mono font-bold shadow-md">
                <?php echo esc_html($project['year']); ?>
              </span>
            </div>

            <div class="p-6 space-y-2 relative z-10 -mt-12">
              <span class="block text-[9px] font-mono text-slate-300 uppercase tracking-widest"><?php echo esc_html($project['client']); ?></span>
              <h3 class="text-base font-bold text-white group-hover:text-[#FBBF24] transition-colors"><?php echo esc_html($project['title']); ?></h3>
              <p class="text-[10px] font-mono text-amber-300 font-bold"><?php echo esc_html($project['tech_specs']); ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Load More Trigger Button -->
      <?php if (count($display_projects) > 6): ?>
        <div class="text-center pt-8">
          <button id="load-more-projects-btn" class="inline-flex items-center gap-2 bg-white hover:bg-[#B31217] hover:text-white text-slate-900 border border-slate-300 font-extrabold text-xs uppercase px-8 py-4 rounded-xl transition-all duration-300 cursor-pointer shadow-md">
            <i class="ph-bold ph-plus text-[#B31217]"></i>
            <span><?php echo sprintf(__('Xem thêm %d dự án khác', 'hacoled'), count($display_projects) - 6); ?></span>
          </button>
        </div>
      <?php endif; ?>

    </div>
  </section>

  <!-- SECTION 4: EXTENSIVE PACKAGES / B2B SOLUTION PLANS (Light Theme) -->
  <section class="py-24 px-4 lg:px-8 bg-[#F8F6F5] border-b border-slate-200">
    <div class="max-w-[1200px] mx-auto space-y-16">
      
      <div class="text-center max-w-2xl mx-auto space-y-3">
        <span class="text-xs font-mono font-bold text-[#B31217] uppercase tracking-widest">GÓI TƯ VẤN THI CÔNG B2B</span>
        <h2 class="text-3xl sm:text-4xl font-extrabold uppercase tracking-tight text-slate-900">
          Các Gói Giải Pháp LED Facade
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
        
        <!-- Package 1 -->
        <div class="bg-white p-8 rounded-3xl border border-slate-200 flex flex-col justify-between space-y-8 shadow-sm">
          <div class="space-y-4">
            <span class="text-xs font-mono text-slate-500 uppercase">GÓI TÔN VIỀN KIẾN TRÚC</span>
            <h3 class="text-xl font-bold text-slate-900">LED Thanh Viền Facade</h3>
            <p class="text-xs text-slate-600 font-normal">Dành cho các tòa nhà văn phòng, trụ sở ngân hàng cần chạy viền sắc nét theo cấu trúc đứng.</p>
            <ul class="text-xs text-slate-700 space-y-2 border-t border-slate-100 pt-4 font-mono">
              <li>✔ LED Thanh Linear IP68</li>
              <li>✔ Điều khiển DMX512 Chuyển Mượt</li>
              <li>✔ Thân Nhôm Anode Chống Rỉ</li>
            </ul>
          </div>
          <a href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>" class="w-full inline-flex items-center justify-center bg-slate-100 hover:bg-[#B31217] hover:text-white text-slate-900 font-bold text-xs uppercase py-3.5 rounded-xl transition-colors border border-slate-200">
            Nhận báo giá chi tiết
          </a>
        </div>

        <!-- Package 2: Featured Red Accent Card -->
        <div class="bg-white p-8 rounded-3xl border-2 border-[#B31217] flex flex-col justify-between space-y-8 relative shadow-xl scale-[1.03]">
          <div class="absolute -top-3 left-1/2 -translate-x-1/2 px-4 py-1 bg-[#B31217] text-white text-[9px] font-mono font-bold uppercase rounded-full shadow-md">
            Khuyên dùng cho tòa kính
          </div>
          <div class="space-y-4 pt-2">
            <span class="text-xs font-mono text-[#B31217] uppercase">GÓI TRUYỀN THÔNG TRONG SUỐT</span>
            <h3 class="text-xl font-bold text-slate-900">LED Lưới Facade Mesh</h3>
            <p class="text-xs text-slate-600 font-normal">Biến mặt vách kính tòa nhà thành màn hình video sống động nhưng vẫn giữ độ truyền sáng 80%.</p>
            <ul class="text-xs text-slate-700 space-y-2 border-t border-slate-100 pt-4 font-mono">
              <li>✔ Màn Hình LED Lưới Trong Suốt</li>
              <li>✔ Độ Sáng 8000 nits Hiển Thị Nắng</li>
              <li>✔ Quản Lý Đám Mây IoT Từ Xa</li>
            </ul>
          </div>
          <a href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>" class="w-full inline-flex items-center justify-center bg-[#FBBF24] hover:bg-amber-400 text-slate-950 font-extrabold text-xs uppercase py-3.5 rounded-xl transition-colors shadow-md">
            Đăng ký khảo sát 3D
          </a>
        </div>

        <!-- Package 3 -->
        <div class="bg-white p-8 rounded-3xl border border-slate-200 flex flex-col justify-between space-y-8 shadow-sm">
          <div class="space-y-4">
            <span class="text-xs font-mono text-slate-500 uppercase">GÓI CHIẾU RỌI NGHỆ THUẬT</span>
            <h3 class="text-xl font-bold text-slate-900">LED Điểm & Pha Rọi Tường</h3>
            <p class="text-xs text-slate-600 font-normal">Dành cho các khách sạn sang trọng, tòa nhà di sản cần hiệu ứng chiếu rọi quét mảng màu lớn.</p>
            <ul class="text-xs text-slate-700 space-y-2 border-t border-slate-100 pt-4 font-mono">
              <li>✔ Đèn Pha Wall Washer Công Suất Cao</li>
              <li>✔ LED Điểm Pixel Chuỗi Linh Hoạt</li>
              <li>✔ Lập Trình Kịch Bản Lễ Tết</li>
            </ul>
          </div>
          <a href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>" class="w-full inline-flex items-center justify-center bg-slate-100 hover:bg-[#B31217] hover:text-white text-slate-900 font-bold text-xs uppercase py-3.5 rounded-xl transition-colors border border-slate-200">
            Nhận báo giá chi tiết
          </a>
        </div>

      </div>

    </div>
  </section>

  <!-- SECTION 5: THE FOUNDER'S DESK / ĐỘI NGŨ KỸ SƯ (Light Theme) -->
  <section class="py-24 px-4 lg:px-8 bg-[#F8F6F5] border-b border-slate-200">
    <div class="max-w-[1200px] mx-auto bg-white rounded-3xl border border-slate-200 p-8 sm:p-12 shadow-lg">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
        
        <!-- Left photo -->
        <div class="lg:col-span-5 rounded-2xl overflow-hidden aspect-[4/3] bg-slate-100 border border-slate-200">
          <img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover" alt="HacoLED Engineers">
        </div>

        <!-- Right Letter text -->
        <div class="lg:col-span-7 space-y-6">
          <span class="text-xs font-mono text-[#B31217] font-bold uppercase tracking-widest">CAM KẾT TỪ GIÁM ĐỐC KỸ THUẬT HACOLED</span>
          <h3 class="text-2xl sm:text-3xl font-bold text-slate-900 leading-tight">
            "Mỗi công trình là một kiệt tác ánh sáng được thi công với sự chính xác tuyệt đối."
          </h3>
          <p class="text-xs sm:text-sm text-slate-600 font-normal leading-relaxed">
            HacoLED không bán thiết bị đơn thuần. Chúng tôi cung cấp giải pháp tổng thể từ khâu khảo sát cơ điện, vẽ lập trình hiệu ứng 3D cho đến thi công an toàn trên cao. Cam kết đồng hành bảo trì trọn đời cùng chủ đầu tư.
          </p>
          <div class="pt-4 border-t border-slate-200 flex items-center justify-between text-xs font-mono">
            <span class="text-slate-800 font-bold">Ban Kỹ Thuật Dự Án HacoLED</span>
            <span class="text-[#B31217] font-bold">Hà Nội & TP.HCM</span>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- SECTION 6: TESTIMONIAL REVIEWS (Light Theme) -->
  <section class="py-24 px-4 lg:px-8 bg-[#F8F6F5] border-b border-slate-200">
    <div class="max-w-[1200px] mx-auto space-y-16">
      
      <div class="text-center max-w-2xl mx-auto space-y-3">
        <span class="text-xs font-mono font-bold text-[#B31217] uppercase tracking-widest">ĐÁNH GIÁ TỪ CHỦ ĐẦU TƯ</span>
        <h2 class="text-3xl sm:text-4xl font-extrabold uppercase tracking-tight text-slate-900">
          Khách Hàng Nói Gì Về HacoLED
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <!-- Review 1 -->
        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-4 flex flex-col justify-between">
          <p class="text-xs text-slate-600 font-normal leading-relaxed">
            "HacoLED đã tư vấn và dựng bản vẽ 3D rất trực quan cho tòa nhà trụ sở của chúng tôi. Quá trình thi công chuyên nghiệp và cực kỳ an toàn."
          </p>
          <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-[#B31217] text-white font-bold flex items-center justify-center text-xs">V</div>
            <div>
              <h5 class="text-xs font-bold text-slate-900">Đại diện Ban Dự án</h5>
              <span class="text-[10px] text-slate-500 font-mono">Vietcombank Tower</span>
            </div>
          </div>
        </div>

        <!-- Review 2 -->
        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-4 flex flex-col justify-between">
          <p class="text-xs text-slate-600 font-normal leading-relaxed">
            "Hệ thống LED lưới mặt kính trong suốt hoạt động vô cùng ổn định, hiệu ứng chuyển màu mượt mà. Rất hài lòng với dịch vụ bảo hành của HacoLED."
          </p>
          <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-[#B31217] text-white font-bold flex items-center justify-center text-xs">G</div>
            <div>
              <h5 class="text-xs font-bold text-slate-900">Giám đốc Quản lý Tòa nhà</h5>
              <span class="text-[10px] text-slate-500 font-mono">Geleximco Building</span>
            </div>
          </div>
        </div>

        <!-- Review 3 -->
        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-4 flex flex-col justify-between">
          <p class="text-xs text-slate-600 font-normal leading-relaxed">
            "Tốc độ ứng cứu sự cố kỹ thuật của HacoLED rất ấn tượng. Chỉ sau hơn 1 giờ nhận báo tin là kỹ sư đã tới tận công trình xử lý xong."
          </p>
          <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-[#B31217] text-white font-bold flex items-center justify-center text-xs">V</div>
            <div>
              <h5 class="text-xs font-bold text-slate-900">Đội ngũ Vận hành Cơ điện</h5>
              <span class="text-[10px] text-slate-500 font-mono">VPBank Tower</span>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- SECTION 7: FREQUENTLY ASKED QUESTIONS ACCORDION (Light Theme) -->
  <section class="py-24 px-4 lg:px-8 bg-[#F8F6F5] border-b border-slate-200">
    <div class="max-w-[1200px] mx-auto space-y-16">
      
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        
        <!-- Left Callout Box -->
        <div class="lg:col-span-5 bg-white p-8 rounded-3xl border border-slate-200 shadow-lg space-y-6">
          <span class="text-xs font-mono text-[#B31217] uppercase font-bold">TƯ VẤN TRỰC TIẾP</span>
          <h3 class="text-2xl font-bold text-slate-900">Bạn Cần Đội Ngũ Kỹ Sư Khảo Sát Tận Nơi?</h3>
          <p class="text-xs text-slate-600 font-normal leading-relaxed">
            Đăng ký thông tin công trình của bạn ngay hôm nay. Đội ngũ kỹ sư HacoLED sẽ cử cán bộ tới khảo sát đo đạc thực địa trong 24h.
          </p>
          <a href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>" class="w-full inline-flex items-center justify-center gap-2 bg-[#FBBF24] hover:bg-amber-400 text-slate-950 font-extrabold text-xs uppercase py-4 rounded-xl transition-colors shadow-md">
            <i class="ph-bold ph-phone-call text-sm"></i>
            <span>Yêu cầu khảo sát ngay</span>
          </a>
        </div>

        <!-- Right FAQ Accordion List -->
        <div class="lg:col-span-7 space-y-4">
          <h3 class="text-xl font-bold text-slate-900 mb-6">Câu Hỏi Thường Gặp (FAQ)</h3>

          <!-- FAQ Item 1 -->
          <div class="faq-item bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
            <button class="faq-toggle w-full p-5 text-left font-bold text-sm text-slate-900 hover:text-[#B31217] flex justify-between items-center cursor-pointer transition-colors">
              <span>HacoLED có hỗ trợ dựng bản vẽ 3D hiệu ứng miễn phí không?</span>
              <i class="ph-bold ph-caret-down text-[#B31217] faq-icon transition-transform"></i>
            </button>
            <div class="faq-content hidden px-5 pb-5 text-xs text-slate-600 font-normal leading-relaxed border-t border-slate-100 pt-3">
              Có. 100% các dự án chiếu sáng mặt dựng tòa nhà khi liên hệ HacoLED đều được đội ngũ kiến trúc sư dựng phương án 3D miễn phí để chủ đầu tư duyệt trước khi ký hợp đồng.
            </div>
          </div>

          <!-- FAQ Item 2 -->
          <div class="faq-item bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
            <button class="faq-toggle w-full p-5 text-left font-bold text-sm text-slate-900 hover:text-[#B31217] flex justify-between items-center cursor-pointer transition-colors">
              <span>Hệ thống LED ngoài trời có chịu được bão và chống nước tốt không?</span>
              <i class="ph-bold ph-caret-down text-[#B31217] faq-icon transition-transform"></i>
            </button>
            <div class="faq-content hidden px-5 pb-5 text-xs text-slate-600 font-normal leading-relaxed border-t border-slate-100 pt-3">
              Toàn bộ thiết bị LED Facade của HacoLED đều đạt chuẩn bảo vệ IP68 chống nước tuyệt đối. Hệ giàn khung giá đỡ được tính toán kết cấu chịu lực gió bão lên đến cấp 12.
            </div>
          </div>

          <!-- FAQ Item 3 -->
          <div class="faq-item bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
            <button class="faq-toggle w-full p-5 text-left font-bold text-sm text-slate-900 hover:text-[#B31217] flex justify-between items-center cursor-pointer transition-colors">
              <span>Thời gian thi công hoàn thiện một tòa nhà mất bao lâu?</span>
              <i class="ph-bold ph-caret-down text-[#B31217] faq-icon transition-transform"></i>
            </button>
            <div class="faq-content hidden px-5 pb-5 text-xs text-slate-600 font-normal leading-relaxed border-t border-slate-100 pt-3">
              Tùy thuộc vào quy mô vách dựng. Thông thường các tòa nhà từ 15-30 tầng được HacoLED thi công hoàn thiện và nghiệm thu chạy thử trong vòng 15 đến 25 ngày làm việc.
            </div>
          </div>

          <!-- FAQ Item 4 -->
          <div class="faq-item bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
            <button class="faq-toggle w-full p-5 text-left font-bold text-sm text-slate-900 hover:text-[#B31217] flex justify-between items-center cursor-pointer transition-colors">
              <span>Chính sách bảo hành và sửa chữa sự cố như thế nào?</span>
              <i class="ph-bold ph-caret-down text-[#B31217] faq-icon transition-transform"></i>
            </button>
            <div class="faq-content hidden px-5 pb-5 text-xs text-slate-600 font-normal leading-relaxed border-t border-slate-100 pt-3">
              HacoLED bảo hành vàng 36 tháng cho toàn bộ vật tư. Khi xảy ra sự cố, kỹ sư trực tại Hà Nội và TP.HCM có mặt tại công trình trong vòng 2 giờ để xử lý.
            </div>
          </div>

        </div>

      </div>

    </div>
  </section>

</main>

<!-- Lightbox Overlay HTML -->
<div id="project-lightbox" class="fixed inset-0 bg-black/95 z-[9999] hidden flex flex-col items-center justify-center p-4 select-none opacity-0 transition-opacity duration-300 backdrop-blur-md">
  <button id="lightbox-close" class="absolute top-6 right-6 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-all cursor-pointer border border-white/10">
    <i class="ph-bold ph-x text-xl"></i>
  </button>
  
  <div class="relative max-w-5xl max-h-[75vh] w-full flex items-center justify-center">
    <button id="lightbox-prev" class="absolute left-4 z-20 w-12 h-12 rounded-full bg-black/40 hover:bg-[#B31217] text-white flex items-center justify-center transition-all cursor-pointer border border-white/10 hover:scale-105">
      <i class="ph-bold ph-caret-left text-xl"></i>
    </button>
    
    <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[75vh] object-contain rounded-lg shadow-2xl transition-all duration-300 transform scale-95 opacity-0">
    
    <button id="lightbox-next" class="absolute right-4 z-20 w-12 h-12 rounded-full bg-black/40 hover:bg-[#B31217] text-white flex items-center justify-center transition-all cursor-pointer border border-white/10 hover:scale-105">
      <i class="ph-bold ph-caret-right text-xl"></i>
    </button>
  </div>

  <div class="mt-6 text-center space-y-1 px-4 max-w-xl">
    <h4 id="lightbox-title" class="text-white text-lg font-bold"></h4>
    <p id="lightbox-meta" class="text-slate-400 text-xs font-mono uppercase tracking-wider"></p>
  </div>
</div>

<!-- SCRIPTS: FAQ ACCORDION & LIGHTBOX & LOAD MORE -->
<script>
  document.addEventListener('DOMContentLoaded', () => {

    // 1. FAQ ACCORDION SCRIPT
    const faqToggles = document.querySelectorAll('.faq-toggle');
    faqToggles.forEach(toggle => {
      toggle.addEventListener('click', () => {
        const content = toggle.nextElementSibling;
        const icon = toggle.querySelector('.faq-icon');
        const isHidden = content.classList.contains('hidden');

        // Close all other FAQs
        document.querySelectorAll('.faq-content').forEach(c => c.classList.add('hidden'));
        document.querySelectorAll('.faq-icon').forEach(i => i.classList.remove('rotate-180'));

        // Toggle current
        if (isHidden) {
          content.classList.remove('hidden');
          icon.classList.add('rotate-180');
        }
      });
    });

    // 2. LOAD MORE SCRIPT
    const loadMoreBtn = document.getElementById('load-more-projects-btn');
    if (loadMoreBtn) {
      loadMoreBtn.addEventListener('click', () => {
        const hiddenItems = document.querySelectorAll('.project-item-hidden');
        hiddenItems.forEach((item, index) => {
          item.classList.remove('hidden', 'project-item-hidden');
          item.style.opacity = '0';
          setTimeout(() => {
            item.style.transition = 'opacity 500ms ease-out, transform 500ms ease-out';
            item.style.opacity = '1';
          }, index * 60);
        });
        loadMoreBtn.parentElement.classList.add('hidden');
      });
    }

    // 3. LIGHTBOX GALLERY SLIDER SCRIPT
    const projectsData = <?php echo json_encode($display_projects); ?>;
    const projectCards = document.querySelectorAll('.project-card-item');
    const lightbox = document.getElementById('project-lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxClose = document.getElementById('lightbox-close');
    const lightboxPrev = document.getElementById('lightbox-prev');
    const lightboxNext = document.getElementById('lightbox-next');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxMeta = document.getElementById('lightbox-meta');

    let currentIdx = 0;

    const openLightbox = (index) => {
      currentIdx = parseInt(index);
      const proj = projectsData[currentIdx];
      if (!proj) return;

      const imgUrl = proj.image || proj.thumbnail;
      if (!imgUrl) return;

      lightbox.classList.remove('hidden');
      setTimeout(() => {
        lightbox.classList.remove('opacity-0');
        lightbox.classList.add('opacity-100', 'flex');
      }, 10);
      document.body.style.overflow = 'hidden';

      loadLightboxImage(imgUrl, proj.title, proj.client || '', proj.tech_specs || '', proj.year || '');
    };

    const loadLightboxImage = (url, title, client, specs, year) => {
      lightboxImg.classList.add('opacity-0', 'scale-95');
      lightboxImg.classList.remove('opacity-100', 'scale-100');

      setTimeout(() => {
        lightboxImg.src = url;
        lightboxTitle.innerText = title;
        
        let metaParts = [];
        if (client) metaParts.push(client);
        if (specs) metaParts.push(specs);
        if (year) metaParts.push('Năm: ' + year);
        lightboxMeta.innerText = metaParts.join(' | ');

        lightboxImg.onload = () => {
          lightboxImg.classList.remove('opacity-0', 'scale-[#B31217] scale-100');
          lightboxImg.classList.add('opacity-100', 'scale-100');
        };
      }, 150);
    };

    const closeLightbox = () => {
      lightbox.classList.remove('opacity-100');
      lightbox.classList.add('opacity-0');
      setTimeout(() => {
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
        lightboxImg.src = '';
      }, 300);
      document.body.style.overflow = '';
    };

    const nextImage = () => {
      let nextIdx = currentIdx + 1;
      if (nextIdx >= projectsData.length) nextIdx = 0;
      openLightbox(nextIdx);
    };

    const prevImage = () => {
      let prevIdx = currentIdx - 1;
      if (prevIdx < 0) prevIdx = projectsData.length - 1;
      openLightbox(prevIdx);
    };

    projectCards.forEach(card => {
      card.addEventListener('click', () => {
        const index = card.getAttribute('data-project-index');
        openLightbox(index);
      });
    });

    lightboxClose.addEventListener('click', closeLightbox);
    lightboxNext.addEventListener('click', nextImage);
    lightboxPrev.addEventListener('click', prevImage);

    document.addEventListener('keydown', (e) => {
      if (lightbox.classList.contains('hidden')) return;
      if (e.key === 'Escape') closeLightbox();
      if (e.key === 'ArrowRight') nextImage();
      if (e.key === 'ArrowLeft') prevImage();
    });

    lightbox.addEventListener('click', (e) => {
      if (e.target === lightbox || e.target === lightbox.querySelector('.relative')) {
        closeLightbox();
      }
    });
  });
</script>

<?php
$this->renderFooter($footer_type ?? 'default');
?>
