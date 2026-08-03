<?php
/**
 * Building Decorative LED Page View Template - Premium Magazine Editorial & Capability Portfolio
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
    'photo-1519389950473-47ba0277781c', 'photo-1531403009284-440f080d1e12', 'photo-1522202176988-66273c2fd55f',
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
        'title'      => sprintf(__('Dự án chiếu sáng mỹ thuật kiến trúc Tòa nhà Landmark %02d', 'hacoled'), $i + 1),
        'client'     => $client . ' - ' . $district,
        'tech_specs' => $type . ' | DMX512',
        'year'       => (string)$year,
        'image'      => 'https://images.unsplash.com/' . $img_id . '?q=80&w=1200&auto=format&fit=crop',
    ];
}

// Prepare WooCommerce Products
$display_products = $products;
if (empty($display_products)) {
    $display_products = [
        [
            'id'          => 801,
            'title'       => __('LED Lưới Trong Suốt Haco-Mesh M16', 'hacoled'),
            'description' => __('Giải pháp LED lưới chuyên dụng cho mặt kính tòa nhà văn phòng, trung tâm thương mại. Khối lượng siêu nhẹ (chỉ 8kg/m2), độ trong suốt cao 75-80%, cản gió tối đa, độ sáng lên đến 8000 nits giúp hiển thị rõ dưới ánh nắng.', 'hacoled'),
            'thumbnail'   => 'https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=800&auto=format&fit=crop',
            'category'    => __('LED lưới mặt dựng kính', 'hacoled'),
            'permalink'   => '#',
            'specs'       => [
                'refresh'   => '3840Hz',
                'bright'    => '8000 nits',
                'warranty'  => '36 Tháng',
                'ic'        => 'DMX512 / ArtNet'
            ]
        ],
        [
            'id'          => 802,
            'title'       => __('LED Thanh Facade Haco-Linear L100', 'hacoled'),
            'description' => __('Đèn LED thanh chạy viền kiến trúc ngoài trời. Thân nhôm anode bền bỉ chịu ăn mòn muối biển, thấu kính polycarbonate kháng UV cường độ cao, chuẩn bảo vệ nước tuyệt đối IP68 và lập trình DMX512 mượt mà.', 'hacoled'),
            'thumbnail'   => 'https://images.unsplash.com/photo-1608976328267-e673d3ec06ce?q=80&w=800&auto=format&fit=crop',
            'category'    => __('LED thanh chạy viền', 'hacoled'),
            'permalink'   => '#',
            'specs'       => [
                'refresh'   => '1920Hz',
                'bright'    => '1500 nits',
                'warranty'  => '36 Tháng',
                'ic'        => 'DMX512 Auto-Address'
            ]
        ],
        [
            'id'          => 803,
            'title'       => __('LED Điểm Pixel Dot Haco-Pixel P40', 'hacoled'),
            'description' => __('Đèn LED điểm thông minh thiết kế dạng chuỗi linh hoạt. Chuyên dùng cho các mặt dựng bê tông lớn, kiến trúc phi quy tắc hoặc uốn cong phức tạp. Vỏ chống cháy chuyên dụng, góc nhìn rộng đến 120 độ.', 'hacoled'),
            'thumbnail'   => 'https://images.unsplash.com/photo-1507608869274-d3177c8bb4c7?q=80&w=800&auto=format&fit=crop',
            'category'    => __('LED điểm thông minh', 'hacoled'),
            'permalink'   => '#',
            'specs'       => [
                'refresh'   => '3840Hz',
                'bright'    => '2000 nits',
                'warranty'  => '24 Tháng',
                'ic'        => 'DMX512 / TTL'
            ]
        ],
        [
            'id'          => 804,
            'title'       => __('Đèn LED Pha Rọi Tường Haco-Wall Washer W36', 'hacoled'),
            'description' => __('Đèn pha led rọi tường công suất cao với góc chiếu hẹp (15/30/45 độ) định hướng chính xác. Chuyên dùng chiếu rọi làm nổi bật các cột trụ lớn, mặt tiền phẳng đứng của các tòa nhà di sản, khách sạn sang trọng.', 'hacoled'),
            'thumbnail'   => 'https://images.unsplash.com/photo-1565814636199-ae8133055c1c?q=80&w=800&auto=format&fit=crop',
            'category'    => __('LED pha rọi kiến trúc', 'hacoled'),
            'permalink'   => '#',
            'specs'       => [
                'refresh'   => 'N/A',
                'bright'    => '5400 lm',
                'warranty'  => '36 Tháng',
                'ic'        => 'DMX512 / On-Off'
            ]
        ]
    ];
}
?>

<!-- Import Cormorant Garamond Google Font for luxury editorial heading style -->
<style>
  @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,400&display=swap');
  .font-editorial {
    font-family: 'Cormorant Garamond', serif;
  }
</style>

<!-- Luxury Model Magazine Editorial Portfolio Page -->
<main class="relative bg-[#F8F6F5] pt-28 md:pt-44 pb-36 overflow-hidden min-h-[100vh] text-[#1C0505]">
  
  <div class="max-w-[1440px] mx-auto px-4 lg:px-12 relative z-10 space-y-36">

    <!-- FRONT COVER: IMPRESSIVE FULL-HEIGHT HERO SPREAD -->
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-stretch min-h-[80vh] border-b border-[#1C0505]/10 pb-20">
      
      <!-- Left side (col-span-7): Large scale title and B2B Manifesto -->
      <div class="lg:col-span-7 flex flex-col justify-between space-y-12">
        <div class="space-y-8">
          <div class="inline-flex items-center gap-2 border-b border-[#1C0505] pb-2 text-[10px] font-bold uppercase tracking-widest font-mono">
            <?php _e('EDITORIAL ISSUE 2026 // HACOLED ARCHITECTURAL DIVISION', 'hacoled'); ?>
          </div>
          
          <h1 class="text-5xl sm:text-7xl lg:text-8xl font-editorial font-bold tracking-tight leading-none uppercase">
            LED Facade
            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-[#B31217] via-red-800 to-[#FBBF24] italic"><?php _e('The Model', 'hacoled'); ?></span>
            <span class="block text-2xl sm:text-3xl font-light tracking-wide normal-case mt-4 text-slate-700"><?php _e('Tôn vinh hình thể & kết cấu ánh sáng cao tầng', 'hacoled'); ?></span>
          </h1>
        </div>

        <div class="space-y-6">
          <p class="text-slate-600 text-sm sm:text-base leading-relaxed font-light max-w-xl">
            <?php _e('Chúng tôi coi mỗi tòa nhà cao tầng là một thực thể nghệ thuật. Giống như việc chụp một bộ ảnh tạp chí thời trang, hệ thống ánh sáng mỹ thuật của HacoLED được sinh ra để tôn vinh những đường nét thiết kế, tạo điểm nhấn và chiều sâu kiến trúc đô thị bền vững.', 'hacoled'); ?>
          </p>
          
          <div class="flex flex-col sm:flex-row items-center gap-6 pt-4">
            <a href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#B31217] hover:bg-[#E60000] text-white font-extrabold text-xs uppercase px-8 py-4.5 rounded-xl tracking-wider transition-all duration-300">
              <span><?php _e('Đăng ký Phương án Thiết kế 3D', 'hacoled'); ?></span>
              <i class="ph-bold ph-arrow-right text-[11px]"></i>
            </a>
            <a href="#editorial-portfolio" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 border-b border-[#1C0505] hover:text-[#B31217] hover:border-[#B31217] font-extrabold text-xs uppercase py-2 tracking-wider transition-all duration-300">
              <span><?php _e('Lướt xem Bộ sưu tập', 'hacoled'); ?></span>
              <i class="ph-bold ph-arrow-down text-[11px]"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- Right side (col-span-5): Massive Portrait Cover Model Visual -->
      <div class="lg:col-span-5 relative group flex flex-col justify-end">
        <div class="w-full aspect-[3/4] rounded-2xl overflow-hidden bg-slate-100 border border-[#1C0505]/10 shadow-2xl relative">
          <!-- Large visual of the Cover Project -->
          <img src="<?php echo esc_url($display_projects[0]['image']); ?>" alt="Cover Skyscraper Model" class="absolute inset-0 w-full h-full object-cover group-hover:scale-103 transition-transform duration-[1500ms] ease-out">
          <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent"></div>
          
          <!-- Editorial metadata overlay -->
          <div class="absolute bottom-8 left-8 right-8 z-10 text-white space-y-2">
            <span class="text-[9px] font-mono tracking-widest text-[#FBBF24] font-bold uppercase">MODEL NO. 01 // GELEXIMCO BUILDING</span>
            <h3 class="text-2xl font-editorial font-bold uppercase leading-tight"><?php echo esc_html($display_projects[0]['title']); ?></h3>
            <p class="text-[10px] text-slate-300 font-mono tracking-wider uppercase"><?php echo esc_html($display_projects[0]['tech_specs']); ?></p>
          </div>
        </div>
      </div>

    </section>

    <!-- SECTION 2: EDITORIAL CONCEPT & ARCHITECTURAL PHILOSOPHY -->
    <section class="space-y-16">
      <div class="border-b border-[#1C0505]/10 pb-6">
        <span class="text-xs font-bold text-[#B31217] tracking-widest uppercase font-mono block mb-2"><?php _e('DESIGN PHILOSOPHY', 'hacoled'); ?></span>
        <h2 class="text-4xl sm:text-5xl font-editorial font-bold uppercase leading-none tracking-tight">
          <?php _e('Triết Lý Điêu Khắc Ánh Sáng', 'hacoled'); ?>
        </h2>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        <div class="lg:col-span-4 space-y-6">
          <span class="text-6xl font-editorial font-light italic text-[#B31217] block">“</span>
          <p class="text-xl sm:text-2xl font-editorial font-bold text-slate-900 leading-snug">
            <?php _e('Ánh sáng là bộ trang phục rực rỡ nhất tôn lên hình thể hoàn mỹ của mỗi kỳ quan kiến trúc khi màn đêm buông xuống.', 'hacoled'); ?>
          </p>
        </div>
        
        <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-8 divide-y sm:divide-y-0 sm:divide-x divide-[#1C0505]/10 pl-0 lg:pl-12">
          <div class="space-y-4">
            <h4 class="text-lg font-bold uppercase tracking-wider text-slate-950">Accentuating Form</h4>
            <p class="text-xs text-slate-600 leading-relaxed font-light">
              <?php _e('Chiếu sáng mặt dựng (Facade LED) không chỉ đơn thuần là gắn đèn mà là sự tính toán điểm rơi của bóng tối và hướng đi của dải sáng. Chúng tôi tôn vinh cấu trúc cột, phào chỉ phẳng dựng và đường vách kính của công trình.', 'hacoled'); ?>
            </p>
          </div>
          <div class="space-y-4 pt-8 sm:pt-0 sm:pl-8">
            <h4 class="text-lg font-bold uppercase tracking-wider text-slate-950">Dynamic Digitalism</h4>
            <p class="text-xs text-slate-655 leading-relaxed font-light">
              <?php _e('Sử dụng bộ lập trình tín hiệu DMX512 thế hệ mới điều khiển chính xác hàng triệu điểm LED, tạo nên các hiệu ứng chuyển màu uyển chuyển nhịp nhàng như nhịp đập hơi thở sinh động của đô thị.', 'hacoled'); ?>
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- SECTION 3: SYSTEM ARCHITECTURE (High-Contrast Engineering Sheet) -->
    <section class="bg-white/80 border border-white rounded-[2rem] p-8 md:p-16 shadow-[0_10px_35px_rgba(0,0,0,0.02)] space-y-16">
      <div class="text-center max-w-2xl mx-auto space-y-3">
        <span class="text-xs font-bold text-[#B31217] tracking-widest uppercase font-mono block"><?php _e('SYSTEM INTEGRATION', 'hacoled'); ?></span>
        <h3 class="text-3xl font-editorial font-bold uppercase tracking-wide text-slate-950"><?php _e('Cơ Cấu Tích Hợp Hệ Thống', 'hacoled'); ?></h3>
        <p class="text-xs text-slate-500 font-light"><?php _e('Bản mô phỏng 3 lớp phần cứng và phần mềm điều khiển khép kín được triển khai bởi các kỹ sư HacoLED.', 'hacoled'); ?></p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <!-- Layer 1 -->
        <div class="p-6 border-r border-[#1C0505]/10 space-y-4">
          <span class="text-3xl font-editorial font-light italic text-[#B31217]">01 /</span>
          <h4 class="text-base font-bold uppercase tracking-wider text-slate-950"><?php _e('Lớp Vật Tư Đầu Cuối (LED Nodes)', 'hacoled'); ?></h4>
          <p class="text-xs text-slate-600 font-light leading-relaxed">
            <?php _e('Các dòng module LED lưới trong suốt chuyên dụng mặt kính, LED thanh đi định hình viền kiến trúc, LED điểm thông minh chạy đồ họa độc lập, đạt chỉ số bảo vệ thời tiết khắt khe IP68.', 'hacoled'); ?>
          </p>
        </div>

        <!-- Layer 2 -->
        <div class="p-6 border-r border-[#1C0505]/10 space-y-4">
          <span class="text-3xl font-editorial font-light italic text-[#FBBF24]">02 /</span>
          <h4 class="text-base font-bold uppercase tracking-wider text-slate-950"><?php _e('Tủ Điều Khiển Trung Tâm (Controllers)', 'hacoled'); ?></h4>
          <p class="text-xs text-slate-600 font-light leading-relaxed">
            <?php _e('Bao gồm các bộ nguồn công suất cao Meanwell chính hãng và các thiết bị mã hóa giải mã tín hiệu DMX512 Master / ArtNet Node truyền tải tín hiệu ổn định tối đa.', 'hacoled'); ?>
          </p>
        </div>

        <!-- Layer 3 -->
        <div class="p-6 space-y-4">
          <span class="text-3xl font-editorial font-light italic text-[#B31217]">03 /</span>
          <h4 class="text-base font-bold uppercase tracking-wider text-slate-950"><?php _e('Quản Trị Đám Mây (Cloud Portal)', 'hacoled'); ?></h4>
          <p class="text-xs text-slate-600 font-light leading-relaxed">
            <?php _e('Cổng điều khiển đám mây HacoLED Portal. Hỗ trợ thay đổi hiệu ứng ánh sáng, lập lịch bật tắt trình chiếu từ xa và cảnh báo lỗi thiết bị tự động qua internet.', 'hacoled'); ?>
          </p>
        </div>

      </div>
    </section>

    <!-- SECTION 4: THE MODEL PORTFOLIO (High-Fashion Skyscraper Spread - 50 Image Loader & Lightbox) -->
    <section id="editorial-portfolio" class="space-y-16">
      <div class="border-b border-[#1C0505]/10 pb-6 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-2">
          <span class="text-xs font-bold text-[#B31217] tracking-widest uppercase font-mono block"><?php _e('ICONIC PORTFOLIO', 'hacoled'); ?></span>
          <h2 class="text-4xl sm:text-5xl font-editorial font-bold uppercase leading-none tracking-tight">
            <?php _e('Bộ Sưu Tập Mô Hình Biểu Tượng', 'hacoled'); ?>
          </h2>
        </div>
        <div class="text-xs text-slate-500 font-light uppercase tracking-widest font-mono">
          <?php echo sprintf(__('SHOWING %d IMAGES // DỰ ÁN RENDER LỚN', 'hacoled'), count($display_projects)); ?>
        </div>
      </div>

      <!-- Asymmetrical Editorial Grid Layout -->
      <div id="projects-masonry-container" class="grid grid-cols-1 md:grid-cols-12 gap-12 items-stretch">
        
        <?php foreach ($display_projects as $index => $project): 
          $image_url = !empty($project['image']) ? $project['image'] : (!empty($project['thumbnail']) ? $project['thumbnail'] : '');
          if (empty($image_url)) continue;
          
          // Determine the grid span and aspect ratio based on index to mimic magazine layout page spreads
          $span_class = 'md:col-span-6'; // default
          $aspect_class = 'aspect-[16/10]';
          if ($index % 5 === 0) {
              $span_class = 'md:col-span-12'; // full-bleed showcase
              $aspect_class = 'aspect-[16/9] lg:aspect-[21/9]';
          } elseif ($index % 5 === 1) {
              $span_class = 'md:col-span-7';
              $aspect_class = 'aspect-[16/10]';
          } elseif ($index % 5 === 2) {
              $span_class = 'md:col-span-5';
              $aspect_class = 'aspect-[3/4]'; // Tall portrait model
          } elseif ($index % 5 === 3) {
              $span_class = 'md:col-span-5';
              $aspect_class = 'aspect-[3/4]';
          } elseif ($index % 5 === 4) {
              $span_class = 'md:col-span-7';
              $aspect_class = 'aspect-[16/10]';
          }

          // Hide items from index 6 to keep initial page weight light and page loading fast (SEO standard)
          $hide_class = ($index >= 6) ? 'hidden project-item-hidden' : '';
        ?>
          <!-- Editorial Project Card -->
          <div class="project-card-item <?php echo esc_attr($span_class); ?> <?php echo esc_attr($hide_class); ?> group flex flex-col justify-between space-y-4 cursor-pointer" data-project-index="<?php echo $index; ?>">
            <!-- Giant scale image wrapper -->
            <div class="w-full <?php echo esc_attr($aspect_class); ?> rounded-2xl overflow-hidden bg-slate-100 border border-[#1C0505]/10 shadow-md relative">
              <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($project['title']); ?>" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover group-hover:scale-103 transition-transform duration-[1200ms] ease-out">
              
              <!-- Hover lens effect hint -->
              <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center z-10">
                <span class="px-6 py-3 rounded-full bg-white text-slate-900 font-extrabold text-[10px] uppercase tracking-widest shadow-2xl transform translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                  <?php _e('Xem toàn màn hình', 'hacoled'); ?>
                </span>
              </div>
            </div>

            <!-- Monospace editorial description caption underneath (Museum/Gallery style) -->
            <div class="space-y-1">
              <div class="flex items-center justify-between text-[9px] font-mono text-slate-400 uppercase tracking-widest">
                <span><?php echo esc_html($project['client']); ?></span>
                <span><?php echo esc_html($project['year']); ?></span>
              </div>
              <h3 class="text-xl font-editorial font-bold uppercase text-slate-900 group-hover:text-[#B31217] transition-colors duration-300">
                <?php echo esc_html($project['title']); ?>
              </h3>
              <p class="text-[10px] text-slate-500 font-mono tracking-wider uppercase"><?php echo esc_html($project['tech_specs']); ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Load More Trigger Button -->
      <?php if (count($display_projects) > 6): ?>
        <div class="text-center pt-20">
          <button id="load-more-projects-btn" class="inline-flex items-center gap-2 bg-[#1C0505] hover:bg-[#B31217] text-white font-extrabold text-xs uppercase px-12 py-5 rounded-full tracking-widest transition-all duration-300 cursor-pointer shadow-lg">
            <i class="ph-bold ph-plus text-[#FBBF24]"></i>
            <span><?php echo sprintf(__('Xem thêm %d mô hình công trình', 'hacoled'), count($display_projects) - 6); ?></span>
          </button>
        </div>
      <?php endif; ?>
    </section>

    <!-- SECTION 5: PRODUCTS CATALOG (WooCommerce spec integration) -->
    <section id="facade-products" class="bg-[#FFFBEB] rounded-[3rem] p-8 md:p-16 border border-[#FDE68A]/20">
      <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
        <span class="text-xs font-bold text-[#B31217] tracking-widest uppercase font-mono block"><?php _e('FACADE HARDWARE SPEC', 'hacoled'); ?></span>
        <h2 class="text-3xl font-editorial font-bold uppercase text-slate-900"><?php _e('Danh Mục Thiết Bị B2B Chuyên Dụng', 'hacoled'); ?></h2>
        <p class="text-slate-655 text-sm font-light">
          <?php _e('Các thiết bị mặt dựng kiến trúc được kiểm định khắt khe, đạt chuẩn nhập khẩu chính ngạch.', 'hacoled'); ?>
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <?php foreach ($display_products as $prod): ?>
          <div class="group flex flex-col sm:flex-row gap-6 p-6 rounded-3xl bg-white/80 border border-white hover:border-[#B31217]/30 hover:bg-white hover:-translate-y-1 transition-all duration-500 ease-out shadow-sm">
            <div class="w-full sm:w-[150px] aspect-square rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 shrink-0 flex items-center justify-center relative">
              <?php if (!empty($prod['thumbnail'])): ?>
                <img src="<?php echo esc_url($prod['thumbnail']); ?>" alt="<?php echo esc_attr($prod['title']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
              <?php else: ?>
                <i class="ph-bold ph-monitor-play text-slate-400 text-5xl"></i>
              <?php endif; ?>
              <span class="absolute top-2 left-2 px-2 py-0.5 rounded bg-slate-900/90 text-[8px] font-bold text-[#FBBF24] uppercase tracking-widest">
                <?php echo esc_html($prod['category'] ?? __('LED tòa nhà', 'hacoled')); ?>
              </span>
            </div>

            <div class="flex-1 flex flex-col justify-between space-y-4">
              <div class="space-y-2">
                <h3 class="text-lg font-bold text-slate-900 group-hover:text-[#B31217] transition-colors duration-300">
                  <?php echo esc_html($prod['title']); ?>
                </h3>
                <p class="text-xs text-slate-500 font-light line-clamp-3">
                  <?php echo wp_kses_post($prod['description']); ?>
                </p>
              </div>
              
              <?php if (!empty($prod['specs'])): ?>
                <div class="grid grid-cols-2 gap-2 bg-slate-50 p-2.5 rounded-xl border border-slate-100 text-[10px] font-mono">
                  <div class="flex justify-between border-r border-slate-200/60 pr-2">
                    <span class="text-slate-400"><?php _e('Tần số quét:', 'hacoled'); ?></span>
                    <span class="font-bold text-slate-700"><?php echo esc_html($prod['specs']['refresh']); ?></span>
                  </div>
                  <div class="flex justify-between pl-2">
                    <span class="text-slate-400"><?php _e('Độ sáng:', 'hacoled'); ?></span>
                    <span class="font-bold text-[#B31217]"><?php echo esc_html($prod['specs']['bright']); ?></span>
                  </div>
                  <div class="flex justify-between border-r border-slate-200/60 pr-2 pt-1 border-t border-slate-200/40">
                    <span class="text-slate-400"><?php _e('Bảo hành:', 'hacoled'); ?></span>
                    <span class="font-bold text-slate-700"><?php echo esc_html($prod['specs']['warranty']); ?></span>
                  </div>
                  <div class="flex justify-between pl-2 pt-1 border-t border-slate-200/40">
                    <span class="text-slate-400"><?php _e('Hệ IC:', 'hacoled'); ?></span>
                    <span class="font-bold text-slate-700"><?php echo esc_html($prod['specs']['ic']); ?></span>
                  </div>
                </div>
              <?php endif; ?>

              <div class="flex items-center justify-between gap-4 pt-2 border-t border-slate-100 flex-wrap">
                <div class="flex flex-wrap gap-1.5">
                  <span class="px-2 py-0.5 text-[9px] font-bold text-slate-500 bg-slate-100 rounded">
                    <i class="ph-bold ph-shield-check text-[#B31217] mr-1"></i><?php _e('CO/CQ đầy đủ', 'hacoled'); ?>
                  </span>
                </div>
                <?php if (!empty($prod['permalink']) && $prod['permalink'] !== '#') : ?>
                  <a href="<?php echo esc_url($prod['permalink']); ?>" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-white hover:bg-[#B31217] text-slate-700 hover:text-white border border-slate-250 hover:border-[#B31217] font-bold text-xs uppercase tracking-wider transition-all duration-300 pointer-events-auto shadow-sm">
                    <span><?php _e('Bản vẽ & Báo giá', 'hacoled'); ?></span>
                    <i class="ph-bold ph-arrow-up-right text-[10px]"></i>
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- SECTION 6: HACOLED CRITERIA (3F & SAFETY STANDARDS) -->
    <section class="space-y-16">
      <div class="text-center max-w-2xl mx-auto space-y-3">
        <span class="text-xs font-bold text-[#B31217] tracking-widest uppercase font-mono block"><?php _e('EXECUTION STANDARDS', 'hacoled'); ?></span>
        <h2 class="text-3xl sm:text-4xl font-editorial font-bold uppercase text-slate-900"><?php _e('Cam Kết Dịch Vụ & Tiêu Chuẩn Leo Cao', 'hacoled'); ?></h2>
        <p class="text-slate-550 text-sm font-light">
          HacoLED tích hợp dịch vụ 3F độc quyền cùng tiêu chuẩn kỹ thuật cơ điện trên cao khắt khe.
        </p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-stretch">
        
        <!-- Left: 3F -->
        <div class="p-8 sm:p-12 rounded-3xl bg-white/70 backdrop-blur-xl border border-white/80 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-500 ease-out flex flex-col justify-between space-y-8">
          <div class="space-y-6">
            <span class="text-xs font-bold text-[#B31217] tracking-widest uppercase font-mono block border-b border-slate-150 pb-2"><?php _e('QUY CHUẨN DỊCH VỤ 3F', 'hacoled'); ?></span>
            
            <div class="space-y-6">
              <div class="flex items-start gap-4">
                <span class="w-10 h-10 shrink-0 rounded-lg bg-[#FBBF24] text-slate-950 flex items-center justify-center font-black shadow">F</span>
                <div class="space-y-1">
                  <h4 class="text-base font-bold text-slate-900">Friendly (Tận Tâm & Thân Thiện)</h4>
                  <p class="text-xs text-slate-600 font-light leading-relaxed">
                    Khảo sát kỹ thuật thực địa và tư vấn phương án dựng 3D chiếu sáng mỹ thuật kiến trúc sơ bộ hoàn toàn miễn phí.
                  </p>
                </div>
              </div>
              <div class="flex items-start gap-4">
                <span class="w-10 h-10 shrink-0 rounded-lg bg-[#B31217] text-white flex items-center justify-center font-black shadow">F</span>
                <div class="space-y-1">
                  <h4 class="text-base font-bold text-slate-900">Fast (Tốc Độ & Phản Hồi)</h4>
                  <p class="text-xs text-slate-600 font-light leading-relaxed">
                    Đội ngũ hỗ trợ phản ứng nhanh 24/7. Có mặt khắc phục sự cố phần cứng tại công trình trong vòng 2 giờ tại Hà Nội & TP.HCM.
                  </p>
                </div>
              </div>
              <div class="flex items-start gap-4">
                <span class="w-10 h-10 shrink-0 rounded-lg bg-[#FBBF24] text-slate-950 flex items-center justify-center font-black shadow">F</span>
                <div class="space-y-1">
                  <h4 class="text-base font-bold text-slate-900">Full (Trọn Vẹn & Đầy Đủ)</h4>
                  <p class="text-xs text-slate-600 font-light leading-relaxed">
                    Hồ sơ nghiệm thu CO/CQ chính ngạch đầy đủ. Chính sách bảo hành vàng 24-36 tháng đối với toàn bộ thiết bị.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="pt-6 border-t border-slate-100 text-[10px] text-slate-400 font-mono">
            <?php _e('Exclusive HacoLED Service Standards', 'hacoled'); ?>
          </div>
        </div>

        <!-- Right: Safety -->
        <div class="p-8 sm:p-12 rounded-3xl bg-[#FFF5F5] border border-[#B31217]/10 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-500 ease-out flex flex-col justify-between space-y-8">
          <div class="space-y-6">
            <span class="text-xs font-bold text-[#B31217] tracking-widest uppercase font-mono block border-b border-red-200 pb-2"><?php _e('QUY CHUẨN KỸ THUẬT LEO CAO', 'hacoled'); ?></span>
            
            <div class="space-y-6">
              <div class="flex gap-4">
                <div class="w-10 h-10 shrink-0 rounded-lg bg-white border border-slate-100 flex items-center justify-center text-[#FBBF24] shadow-sm">
                  <i class="ph-bold ph-wind text-xl"></i>
                </div>
                <div class="space-y-1">
                  <h4 class="text-base font-bold text-slate-900"><?php _e('Kết Cấu Chống Chịu Bão Cấp 12', 'hacoled'); ?></h4>
                  <p class="text-xs text-slate-655 leading-relaxed font-light">
                    Hệ thống giàn khung giá đỡ được các kỹ sư tính toán sức bền cơ học chịu lực gió bão lốc lên tới cấp 12 an toàn.
                  </p>
                </div>
              </div>
              <div class="flex gap-4">
                <div class="w-10 h-10 shrink-0 rounded-lg bg-white border border-slate-100 flex items-center justify-center text-[#B31217] shadow-sm">
                  <i class="ph-bold ph-drop text-xl"></i>
                </div>
                <div class="space-y-1">
                  <h4 class="text-base font-bold text-slate-900"><?php _e('Chuẩn Kháng Ăn Mòn Muối Biển IP68', 'hacoled'); ?></h4>
                  <p class="text-xs text-slate-655 leading-relaxed font-light">
                    Module phủ keo kháng tia cực tím UV và đạt chuẩn chống nước bụi tuyệt đối IP68 chống rỉ sét ăn mòn ngoài trời.
                  </p>
                </div>
              </div>
              <div class="flex gap-4">
                <div class="w-10 h-10 shrink-0 rounded-lg bg-white border border-slate-100 flex items-center justify-center text-[#FBBF24] shadow-sm">
                  <i class="ph-bold ph-user-focus text-xl"></i>
                </div>
                <div class="space-y-1">
                  <h4 class="text-base font-bold text-slate-900"><?php _e('Chứng Chỉ Nhân Sự Leo Cao Quốc Gia', 'hacoled'); ?></h4>
                  <p class="text-xs text-slate-655 leading-relaxed font-light">
                    100% thợ thi công đu dây lắp đặt được đào tạo bài bản và có chứng chỉ an toàn lao động trên cao quốc gia.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="pt-6 border-t border-red-150 text-[10px] text-slate-400 font-mono">
            <?php _e('High-Altitude Engineering Safety Standards', 'hacoled'); ?>
          </div>
        </div>

      </div>
    </section>

    <!-- SECTION 7: EDITORIAL CTA (Minimalist Contact block) -->
    <section class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-[#B31217] via-[#A30F14] to-[#8A0B10] border border-[#B31217]/25 p-8 sm:p-16 text-center max-w-4xl mx-auto shadow-2xl gsap-reveal" data-direction="up" data-delay="0.4">
      <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
      <div class="relative z-10 space-y-6">
        <span class="text-xs font-bold text-[#FBBF24] tracking-widest uppercase font-mono block"><?php _e('COLLABORATE WITH HACOLED', 'hacoled'); ?></span>
        <h3 class="text-3xl sm:text-5xl font-editorial font-bold text-white leading-tight uppercase">
          <?php _e('Cùng Kiến Tạo Biểu Tượng Ánh Sáng Mới', 'hacoled'); ?>
        </h3>
        <p class="text-slate-200 text-xs max-w-xl mx-auto leading-relaxed font-light">
          <?php _e('Hãy bắt đầu nâng tầm giá trị thương hiệu kiến trúc tòa nhà của bạn cùng HacoLED ngay hôm nay. Đội ngũ kỹ sư thiết kế của chúng tôi sẵn sàng hỗ trợ khảo sát thực địa tận công trình.', 'hacoled'); ?>
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-6 pt-4">
          <a href="<?php echo esc_url(hacoled_managed_page_url('contact')); ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#FBBF24] hover:bg-yellow-500 text-slate-900 font-extrabold text-xs uppercase px-10 py-5 rounded-full tracking-wider transition-all duration-300 shadow-md">
            <span><?php _e('Yêu Cầu Khảo Sát & Dựng Bản Vẽ 3D', 'hacoled'); ?></span>
            <i class="ph-bold ph-arrow-right text-[11px] text-slate-900"></i>
          </a>
          <a href="tel:0342324488" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 border border-white/20 hover:border-white/40 text-white font-bold text-xs uppercase px-8 py-5 rounded-full tracking-wider transition-all duration-300">
            <i class="ph-fill ph-phone-call text-[13px] text-[#FBBF24]"></i>
            <span>Hotline B2B: 034.232.4488</span>
          </a>
        </div>
      </div>
    </section>

  </div>
</main>

<!-- Lightbox Overlay HTML -->
<div id="project-lightbox" class="fixed inset-0 bg-black/95 z-[9999] hidden flex flex-col items-center justify-center p-4 select-none opacity-0 transition-opacity duration-300 backdrop-blur-md">
  <!-- Close Button -->
  <button id="lightbox-close" class="absolute top-6 right-6 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-all cursor-pointer border border-white/10">
    <i class="ph-bold ph-x text-xl"></i>
  </button>
  
  <!-- Main Wrapper -->
  <div class="relative max-w-5xl max-h-[75vh] w-full flex items-center justify-center">
    <!-- Prev Arrow -->
    <button id="lightbox-prev" class="absolute left-4 z-20 w-12 h-12 rounded-full bg-black/40 hover:bg-[#B31217] text-white flex items-center justify-center transition-all cursor-pointer border border-white/10 hover:scale-105">
      <i class="ph-bold ph-caret-left text-xl"></i>
    </button>
    
    <!-- Image -->
    <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[75vh] object-contain rounded-lg shadow-2xl transition-all duration-300 transform scale-95 opacity-0">
    
    <!-- Next Arrow -->
    <button id="lightbox-next" class="absolute right-4 z-20 w-12 h-12 rounded-full bg-black/40 hover:bg-[#B31217] text-white flex items-center justify-center transition-all cursor-pointer border border-white/10 hover:scale-105">
      <i class="ph-bold ph-caret-right text-xl"></i>
    </button>
  </div>

  <!-- Caption text block -->
  <div class="mt-6 text-center space-y-1 px-4 max-w-xl">
    <h4 id="lightbox-title" class="text-white text-lg font-bold"></h4>
    <p id="lightbox-meta" class="text-slate-400 text-xs font-mono uppercase tracking-wider"></p>
  </div>
</div>

<!-- Project data, Load More and Lightbox Slider scripts -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // 1. LOAD MORE LOGIC (Supports smooth grid expansion of 50+ images without slow initial loads)
    const loadMoreBtn = document.getElementById('load-more-projects-btn');
    if (loadMoreBtn) {
      loadMoreBtn.addEventListener('click', () => {
        const hiddenItems = document.querySelectorAll('.project-item-hidden');
        hiddenItems.forEach((item, index) => {
          // Remove hidden class
          item.classList.remove('hidden', 'project-item-hidden');
          // Add opacity transitions
          item.style.opacity = '0';
          setTimeout(() => {
            item.style.transition = 'opacity 500ms ease-out, transform 500ms ease-out';
            item.style.opacity = '1';
          }, index * 80); // Stagger fade-in effect
        });
        
        // Hide the button since everything is loaded
        loadMoreBtn.parentElement.classList.add('hidden');
      });
    }

    // 2. LIGHTBOX GALLERY SLIDER LOGIC
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

      // Show lightbox overlay
      lightbox.classList.remove('hidden');
      setTimeout(() => {
        lightbox.classList.remove('opacity-0');
        lightbox.classList.add('opacity-100', 'flex');
      }, 10);

      // Disable page scrolling
      document.body.style.overflow = 'hidden';

      loadLightboxImage(imgUrl, proj.title, proj.client || '', proj.tech_specs || '', proj.year || '');
    };

    const loadLightboxImage = (url, title, client, specs, year) => {
      // Fade out image before load
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
          lightboxImg.classList.remove('opacity-0', 'scale-95');
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

      // Enable page scrolling
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

    // Attach click events on grid cards
    projectCards.forEach(card => {
      card.addEventListener('click', () => {
        const index = card.getAttribute('data-project-index');
        openLightbox(index);
      });
    });

    // Control hooks
    lightboxClose.addEventListener('click', closeLightbox);
    lightboxNext.addEventListener('click', nextImage);
    lightboxPrev.addEventListener('click', prevImage);

    // Keyboard support
    document.addEventListener('keydown', (e) => {
      if (lightbox.classList.contains('hidden')) return;
      if (e.key === 'Escape') closeLightbox();
      if (e.key === 'ArrowRight') nextImage();
      if (e.key === 'ArrowLeft') prevImage();
    });

    // Close on clicking backdrop (except active controls)
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
