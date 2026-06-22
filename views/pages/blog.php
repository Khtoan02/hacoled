<?php
/**
 * News & Blog Page View Template - Luxury Tech Journal Style
 *
 * @var array  $page
 * @var array  $sections
 * @var string $header_type
 * @var string $footer_type
 */

$this->renderHeader($header_type ?? 'default');

// Extract all posts to find the primary featured post
$all_posts = [];
foreach ($sections as $sec_posts) {
    if (!empty($sec_posts)) {
        $all_posts = array_merge($all_posts, $sec_posts);
    }
}

// Find main featured
$main_featured = !empty($sections['led']) ? $sections['led'][0] : (!empty($all_posts) ? $all_posts[0] : null);

// Find two sub-featured articles from $all_posts
$sub_featured_1 = null;
$sub_featured_2 = null;
if (!empty($all_posts)) {
    foreach ($all_posts as $post) {
        if ($main_featured && $post['id'] === $main_featured['id']) continue;
        if (!$sub_featured_1) {
            $sub_featured_1 = $post;
        } elseif (!$sub_featured_2 && $post['id'] !== $sub_featured_1['id']) {
            $sub_featured_2 = $post;
            break;
        }
    }
}

// Track used post IDs to avoid duplicates on the entire page
$used_post_ids = [];
if ($main_featured) {
    $used_post_ids[] = $main_featured['id'];
}
if ($sub_featured_1) {
    $used_post_ids[] = $sub_featured_1['id'];
}
if ($sub_featured_2) {
    $used_post_ids[] = $sub_featured_2['id'];
}
?>

<!-- Premium News Homepage Wrapper (Luxury Magazine Style) -->
<main class="relative bg-[#FAFAFA] pt-28 md:pt-48 pb-24 overflow-hidden min-h-[95vh]"
      x-data="{ activePost: null, showDrawer: false }">
  
  <!-- Glowing Background Orbs -->
  <div class="glow-red top-1/4 left-1/4 opacity-[0.08] w-[500px] h-[500px]"></div>
  <div class="glow-gold bottom-1/3 right-1/4 opacity-[0.08] w-[600px] h-[600px]"></div>

  <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10 space-y-16">

    <!-- Breadcrumbs with schema -->
    <nav aria-label="Breadcrumb" class="mb-4 text-[10px] font-semibold text-slate-400 uppercase tracking-widest flex items-center gap-2">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="text-slate-500 hover:text-accent-gold transition-colors"><?php _e('Trang chủ', 'hacoled'); ?></a>
      <span class="text-slate-300">/</span>
      <span class="text-slate-750"><?php echo esc_html($page['title']); ?></span>
    </nav>

    <!-- JOURNAL LOGO STRIP & DATE -->
    <div class="border-y border-slate-200 py-4 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs font-mono font-bold text-slate-800">
      <div class="flex items-center gap-3">
        <span class="relative flex h-2 w-2">
          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent-red opacity-75"></span>
          <span class="relative inline-flex rounded-full h-2 w-2 bg-accent-red"></span>
        </span>
        <span class="px-2.5 py-1 bg-[#4A0505] text-white text-[9px] rounded-md tracking-widest font-sans"><?php _e('TẠP CHÍ HỆ THỐNG AV PRO', 'hacoled'); ?></span>
        <span>HacoLED Journal</span>
      </div>
      <div class="flex items-center gap-3">
        <span class="text-slate-500"><?php echo date('l, d/m/Y'); ?></span>
        <span class="text-slate-300">|</span>
        <span class="text-accent-red bg-accent-red/5 px-2 py-0.5 rounded"><?php _e('Phát hành định kỳ', 'hacoled'); ?></span>
      </div>
    </div>

    <!-- ========================================== -->
    <!-- SECTION 1: MEGA HERO SPOTLIGHT -->
    <!-- ========================================== -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
      
      <!-- Left Spotlight & Sub-Features (8 Cols) - Balanced Aspect Ratio -->
      <div class="lg:col-span-8 flex flex-col gap-6">
        
        <!-- Main Spotlight - Wide layout -->
        <div class="group relative overflow-hidden rounded-3xl border border-slate-200/80 bg-slate-950 shadow-lg min-h-[360px] sm:min-h-[400px] flex flex-col justify-between">
          <?php if ($main_featured): 
            $featured_json = json_encode([
                'title' => esc_html($main_featured['title']),
                'excerpt' => esc_html($main_featured['excerpt']),
                'permalink' => esc_url($main_featured['permalink']),
                'thumbnail' => esc_url($main_featured['thumbnail']),
                'category' => esc_html($main_featured['category']),
                'date' => esc_html($main_featured['date']),
                'author' => esc_html($main_featured['author'])
            ], JSON_HEX_APOS | JSON_HEX_QUOT);
          ?>
            <!-- Background image with gradient mask -->
            <div class="absolute inset-0 z-0 overflow-hidden">
              <img src="<?php echo esc_url($main_featured['thumbnail']); ?>" alt="<?php echo esc_attr($main_featured['title']); ?>" class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-700 ease-out">
              <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/60 to-transparent z-10"></div>
            </div>

            <!-- Top Overlay tag -->
            <div class="relative z-20 p-6 self-start">
              <span class="bg-brand-red/90 border border-brand-red/20 backdrop-blur-md text-white text-[9px] font-extrabold px-3 py-1 rounded-md shadow uppercase tracking-widest">
                <?php echo esc_html($main_featured['category']); ?>
              </span>
            </div>

            <!-- Bottom Text details -->
            <div class="relative z-20 p-6 sm:p-10 space-y-4">
              <span class="text-[9px] font-bold text-accent-gold uppercase tracking-widest font-mono"><?php _e('TIÊU ĐIỂM SỐ RA HÔM NAY', 'hacoled'); ?></span>
              <h2 class="text-2xl sm:text-4xl font-extrabold text-white leading-snug tracking-tight hover:text-accent-gold transition-colors duration-300">
                <a href="<?php echo esc_url($main_featured['permalink']); ?>"><?php echo esc_html($main_featured['title']); ?></a>
              </h2>
              <p class="text-xs text-slate-300 leading-relaxed font-light line-clamp-2 max-w-2xl">
                <?php echo esc_html($main_featured['excerpt']); ?>
              </p>
              
              <div class="pt-4 border-t border-white/10 flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-3 text-[10px] text-slate-400 font-mono">
                  <span><?php echo esc_html($main_featured['date']); ?></span>
                  <span>•</span>
                  <span><?php echo sprintf(__('Đăng bởi %s', 'hacoled'), esc_html($main_featured['author'])); ?></span>
                </div>
                <div class="flex items-center gap-3">
                  <button @click.prevent='activePost = <?php echo $featured_json; ?>; showDrawer = true' 
                          class="bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-[10px] uppercase px-4 py-2 rounded-lg tracking-wider transition-all duration-300">
                    <?php _e('Xem nhanh', 'hacoled'); ?>
                  </button>
                  <a href="<?php echo esc_url($main_featured['permalink']); ?>" class="bg-accent-red hover:bg-brand-red text-white font-bold text-[10px] uppercase px-4 py-2 rounded-lg tracking-wider transition-all duration-300">
                    <?php _e('Đọc tiếp', 'hacoled'); ?>
                  </a>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>

        <!-- Two Sub-Features side-by-side -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <?php if ($sub_featured_1): 
            $sf1_json = json_encode([
                'title' => esc_html($sub_featured_1['title']),
                'excerpt' => esc_html($sub_featured_1['excerpt']),
                'permalink' => esc_url($sub_featured_1['permalink']),
                'thumbnail' => esc_url($sub_featured_1['thumbnail']),
                'category' => esc_html($sub_featured_1['category']),
                'date' => esc_html($sub_featured_1['date']),
                'author' => esc_html($sub_featured_1['author'])
            ], JSON_HEX_APOS | JSON_HEX_QUOT);
          ?>
            <div class="group flex flex-col justify-between bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm hover:shadow-md hover:border-accent-red/20 transition-all duration-300">
              <div class="space-y-3">
                <div class="aspect-[16/9] relative rounded-xl overflow-hidden bg-slate-950 border border-slate-100 shrink-0">
                  <img src="<?php echo esc_url($sub_featured_1['thumbnail']); ?>" alt="<?php echo esc_attr($sub_featured_1['title']); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="space-y-1">
                  <span class="text-[8px] font-bold text-accent-red uppercase tracking-wider font-mono"><?php echo esc_html($sub_featured_1['category']); ?></span>
                  <h4 class="text-xs font-bold text-slate-900 leading-snug group-hover:text-accent-red transition-colors line-clamp-2">
                    <a href="<?php echo esc_url($sub_featured_1['permalink']); ?>"><?php echo esc_html($sub_featured_1['title']); ?></a>
                  </h4>
                </div>
              </div>
              <div class="pt-3 border-t border-slate-100 flex justify-between items-center mt-3 text-[9px] font-mono text-slate-400">
                <span><?php echo esc_html($sub_featured_1['date']); ?></span>
                <button @click.prevent='activePost = <?php echo $sf1_json; ?>; showDrawer = true' class="text-accent-red hover:underline font-bold">
                  <?php _e('Xem nhanh', 'hacoled'); ?>
                </button>
              </div>
            </div>
          <?php endif; ?>

          <?php if ($sub_featured_2): 
            $sf2_json = json_encode([
                'title' => esc_html($sub_featured_2['title']),
                'excerpt' => esc_html($sub_featured_2['excerpt']),
                'permalink' => esc_url($sub_featured_2['permalink']),
                'thumbnail' => esc_url($sub_featured_2['thumbnail']),
                'category' => esc_html($sub_featured_2['category']),
                'date' => esc_html($sub_featured_2['date']),
                'author' => esc_html($sub_featured_2['author'])
            ], JSON_HEX_APOS | JSON_HEX_QUOT);
          ?>
            <div class="group flex flex-col justify-between bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm hover:shadow-md hover:border-accent-red/20 transition-all duration-300">
              <div class="space-y-3">
                <div class="aspect-[16/9] relative rounded-xl overflow-hidden bg-slate-950 border border-slate-100 shrink-0">
                  <img src="<?php echo esc_url($sub_featured_2['thumbnail']); ?>" alt="<?php echo esc_attr($sub_featured_2['title']); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="space-y-1">
                  <span class="text-[8px] font-bold text-accent-red uppercase tracking-wider font-mono"><?php echo esc_html($sub_featured_2['category']); ?></span>
                  <h4 class="text-xs font-bold text-slate-900 leading-snug group-hover:text-accent-red transition-colors line-clamp-2">
                    <a href="<?php echo esc_url($sub_featured_2['permalink']); ?>"><?php echo esc_html($sub_featured_2['title']); ?></a>
                  </h4>
                </div>
              </div>
              <div class="pt-3 border-t border-slate-100 flex justify-between items-center mt-3 text-[9px] font-mono text-slate-400">
                <span><?php echo esc_html($sub_featured_2['date']); ?></span>
                <button @click.prevent='activePost = <?php echo $sf2_json; ?>; showDrawer = true' class="text-accent-red hover:underline font-bold">
                  <?php _e('Xem nhanh', 'hacoled'); ?>
                </button>
              </div>
            </div>
          <?php endif; ?>
        </div>

      </div>

      <!-- Right Trending Quick list with Big Numbers (4 Cols) -->
      <div class="lg:col-span-4 border-l border-slate-200 lg:pl-8 flex flex-col justify-between">
        <div class="space-y-6">
          <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest border-b-2 border-slate-900 pb-2 flex items-center gap-2">
            <i class="ph-bold ph-trend-up text-accent-red text-base"></i>
            <?php _e('Chia sẻ kinh nghiệm', 'hacoled'); ?>
          </h3>
          <div class="space-y-5">
            <?php 
            $quick_news = !empty($sections['news']) ? $sections['news'] : [];
            $news_shown = 0;
            if (!empty($quick_news)):
              foreach ($quick_news as $qn): 
                if (in_array($qn['id'], $used_post_ids)) continue;
                if ($news_shown >= 6) break;
                $news_shown++;
                $used_post_ids[] = $qn['id'];
                $qn_json = json_encode([
                    'title' => esc_html($qn['title']),
                    'excerpt' => esc_html($qn['excerpt']),
                    'permalink' => esc_url($qn['permalink']),
                    'thumbnail' => esc_url($qn['thumbnail']),
                    'category' => esc_html($qn['category']),
                    'date' => esc_html($qn['date']),
                    'author' => esc_html($qn['author'])
                ], JSON_HEX_APOS | JSON_HEX_QUOT);
            ?>
              <div class="flex items-start gap-4 group">
                <span class="text-4xl font-black text-slate-200 font-mono leading-none tracking-tight group-hover:text-accent-red/35 transition-colors">
                  0<?php echo $news_shown; ?>
                </span>
                <div class="space-y-1">
                  <span class="text-[8px] font-bold text-accent-red uppercase tracking-wider font-mono"><?php echo esc_html($qn['category']); ?></span>
                  <h4 class="text-xs font-bold text-slate-900 leading-snug group-hover:text-accent-red transition-colors line-clamp-2">
                    <a href="<?php echo esc_url($qn['permalink']); ?>"><?php echo esc_html($qn['title']); ?></a>
                  </h4>
                  <div class="flex items-center gap-2.5 pt-0.5 text-[9px] text-slate-400">
                    <span><?php echo esc_html($qn['date']); ?></span>
                    <button @click.prevent='activePost = <?php echo $qn_json; ?>; showDrawer = true' class="text-accent-red hover:underline font-bold">
                      <?php _e('[Xem nhanh]', 'hacoled'); ?>
                    </button>
                  </div>
                </div>
              </div>
            <?php 
              endforeach; 
              if ($news_shown === 0):
            ?>
              <p class="text-slate-450 text-xs py-4"><?php _e('Đang cập nhật bài viết...', 'hacoled'); ?></p>
            <?php
              endif;
            else:
            ?>
              <p class="text-slate-450 text-xs py-4"><?php _e('Đang cập nhật tin tức...', 'hacoled'); ?></p>
            <?php endif; ?>
          </div>
        </div>

        <!-- Luxury tech hotline support inside Sidebar -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#4A0505] to-slate-950 p-6 text-white border border-white/10 shadow-lg mt-6 group">
          <div class="absolute -right-8 -bottom-8 w-24 h-24 bg-accent-gold/15 rounded-full blur-xl pointer-events-none group-hover:scale-110 transition-transform"></div>
          <div class="relative z-10 space-y-4">
            <span class="text-[9px] font-bold text-accent-gold uppercase tracking-wider block font-mono"><?php _e('LIÊN HỆ KHẢO SÁT & TƯ VẤN', 'hacoled'); ?></span>
            <h4 class="text-xs font-bold leading-normal uppercase"><?php _e('Bản vẽ 2D/3D & Báo giá chi tiết', 'hacoled'); ?></h4>
            <div class="flex flex-col gap-2">
              <a href="<?php echo esc_url(home_url('/lien-he/')); ?>" class="flex items-center justify-center bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-[10px] uppercase py-3 rounded-xl tracking-wider transition-all duration-300">
                <?php _e('Yêu cầu báo giá', 'hacoled'); ?>
              </a>
              <a href="tel:0342324488" class="flex items-center justify-center gap-2 bg-gradient-to-r from-accent-gold to-yellow-500 hover:from-yellow-500 hover:to-accent-gold text-primary-dark font-extrabold text-[10px] uppercase py-3 rounded-xl tracking-wider shadow-md transition-all duration-300">
                <i class="ph-bold ph-phone-call"></i>
                <span>Hotline: 034.232.4488</span>
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- ========================================== -->
    <!-- SECTION 2: BLOG MÀN HÌNH LED (GLASS CARDS) -->
    <!-- ========================================== -->
    <div class="space-y-6">
      <div class="flex justify-between items-end border-b border-slate-200 pb-3">
        <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2 relative">
          <span class="w-1.5 h-6 bg-accent-red block rounded"></span>
          <?php _e('Blog màn hình LED', 'hacoled'); ?>
        </h3>
        <span class="text-[9px] font-mono font-bold text-slate-400 uppercase tracking-widest"><?php _e('CHUYÊN MỤC TIÊU BIỂU', 'hacoled'); ?></span>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <?php 
        $led_posts = !empty($sections['led']) ? $sections['led'] : [];
        $led_shown = 0;
        if (!empty($led_posts)):
          foreach ($led_posts as $lp): 
            if (in_array($lp['id'], $used_post_ids)) continue;
            if ($led_shown >= 6) break;
            $led_shown++;
            $used_post_ids[] = $lp['id'];
            $lp_json = json_encode([
                'title' => esc_html($lp['title']),
                'excerpt' => esc_html($lp['excerpt']),
                'permalink' => esc_url($lp['permalink']),
                'thumbnail' => esc_url($lp['thumbnail']),
                'category' => esc_html($lp['category']),
                'date' => esc_html($lp['date']),
                'author' => esc_html($lp['author'])
            ], JSON_HEX_APOS | JSON_HEX_QUOT);
        ?>
          <!-- Luxury Glass Grid Card -->
          <div class="group flex flex-col justify-between glass-card rounded-2xl p-5 border border-white/80 bg-white/70 shadow-sm hover:border-brand-gold/40 hover:shadow-glow-gold hover:bg-white/90 transition-all duration-300">
            <div class="space-y-4">
              <div class="aspect-[16/10] relative rounded-xl overflow-hidden bg-slate-950 border border-slate-100 shadow-inner">
                <img src="<?php echo esc_url($lp['thumbnail']); ?>" alt="<?php echo esc_attr($lp['title']); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
              </div>
              <div class="space-y-2">
                <span class="text-[9px] font-bold text-accent-red uppercase tracking-wider font-mono"><?php echo esc_html($lp['category']); ?></span>
                <h4 class="text-xs font-bold text-slate-900 leading-snug group-hover:text-accent-red transition-colors line-clamp-2">
                  <a href="<?php echo esc_url($lp['permalink']); ?>"><?php echo esc_html($lp['title']); ?></a>
                </h4>
                <div class="w-4 h-0.5 bg-accent-red group-hover:w-full transition-all duration-500"></div>
                <p class="text-[11px] text-slate-550 leading-relaxed font-light line-clamp-3 pt-1">
                  <?php echo esc_html($lp['excerpt']); ?>
                </p>
              </div>
            </div>
            <div class="pt-4 border-t border-slate-100 flex justify-between items-center mt-4 text-[9px] font-mono text-slate-400">
              <span><?php echo esc_html($lp['date']); ?></span>
              <div class="flex items-center gap-2">
                <button @click.prevent='activePost = <?php echo $lp_json; ?>; showDrawer = true' 
                        class="text-slate-500 hover:text-accent-red font-bold uppercase transition-colors">
                  <?php _e('Xem nhanh', 'hacoled'); ?>
                </button>
                <span class="text-slate-300">|</span>
                <a href="<?php echo esc_url($lp['permalink']); ?>" class="text-accent-red font-bold uppercase hover:text-slate-800 transition-colors flex items-center gap-1">
                  <?php _e('Đọc', 'hacoled'); ?>
                  <i class="ph-bold ph-caret-right"></i>
                </a>
              </div>
            </div>
          </div>
        <?php 
          endforeach;
          if ($led_shown === 0):
        ?>
          <p class="text-slate-450 text-xs py-6 col-span-full"><?php _e('Đang cập nhật bài viết...', 'hacoled'); ?></p>
        <?php
          endif;
        else:
        ?>
          <p class="text-slate-450 text-xs py-6 col-span-full"><?php _e('Đang cập nhật bài viết...', 'hacoled'); ?></p>
        <?php endif; ?>
      </div>
    </div>

    <!-- ========================================== -->
    <!-- SECTION 3: SPLIT COLUMNS (AUDIO vs TECH GUIDE) -->
    <!-- ========================================== -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
      
      <!-- COLUMN LEFT: BLOG ÂM THANH (1 Big + 2 Small) -->
      <div class="space-y-6">
        <div class="flex justify-between items-end border-b border-slate-200 pb-3">
          <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2 relative">
            <span class="w-1.5 h-6 bg-accent-gold block rounded"></span>
            <?php _e('Blog âm thanh', 'hacoled'); ?>
          </h3>
          <span class="text-[9px] font-bold text-slate-400 font-mono uppercase tracking-widest"><?php _e('ÂM THANH HỘI TRƯỜNG', 'hacoled'); ?></span>
        </div>

        <div class="space-y-6">
          <?php 
          $audio_posts = !empty($sections['audio']) ? $sections['audio'] : [];
          $audio_filtered = [];
          if (!empty($audio_posts)) {
              foreach ($audio_posts as $ap) {
                  if (!in_array($ap['id'], $used_post_ids)) {
                      $audio_filtered[] = $ap;
                  }
              }
          }
          if (!empty($audio_filtered)):
            $audio_featured = $audio_filtered[0];
            $used_post_ids[] = $audio_featured['id'];
            $audio_list = array_slice($audio_filtered, 1, 5);
            foreach ($audio_list as $al) {
                $used_post_ids[] = $al['id'];
            }
            
            $af_json = json_encode([
                'title' => esc_html($audio_featured['title']),
                'excerpt' => esc_html($audio_featured['excerpt']),
                'permalink' => esc_url($audio_featured['permalink']),
                'thumbnail' => esc_url($audio_featured['thumbnail']),
                'category' => esc_html($audio_featured['category']),
                'date' => esc_html($audio_featured['date']),
                'author' => esc_html($audio_featured['author'])
            ], JSON_HEX_APOS | JSON_HEX_QUOT);
          ?>
            <!-- Main Audio Story - Glass effect -->
            <div class="group grid grid-cols-1 md:grid-cols-12 gap-6 items-center glass-card rounded-2xl p-5 border border-white/80 bg-white/70 shadow-sm hover:shadow-md transition-all duration-300">
              <div class="md:col-span-5 aspect-[4/3] relative rounded-xl overflow-hidden bg-slate-950 border border-slate-100">
                <img src="<?php echo esc_url($audio_featured['thumbnail']); ?>" alt="<?php echo esc_attr($audio_featured['title']); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
              </div>
              <div class="md:col-span-7 space-y-2.5">
                <span class="text-[9px] font-bold text-accent-red uppercase tracking-wider font-mono"><?php echo esc_html($audio_featured['category']); ?></span>
                <h4 class="text-xs font-bold text-slate-900 leading-snug group-hover:text-accent-red transition-colors">
                  <a href="<?php echo esc_url($audio_featured['permalink']); ?>"><?php echo esc_html($audio_featured['title']); ?></a>
                </h4>
                <div class="w-4 h-0.5 bg-accent-red group-hover:w-full transition-all duration-500"></div>
                <p class="text-[10px] text-slate-500 leading-relaxed line-clamp-3 font-light pt-1">
                  <?php echo esc_html($audio_featured['excerpt']); ?>
                </p>
                <div class="flex items-center justify-between pt-1.5 text-[9px] font-mono text-slate-400">
                  <span><?php echo esc_html($audio_featured['date']); ?></span>
                  <button @click.prevent='activePost = <?php echo $af_json; ?>; showDrawer = true' class="text-accent-red hover:underline font-bold">
                    <?php _e('Đọc nhanh', 'hacoled'); ?>
                  </button>
                </div>
              </div>
            </div>

            <!-- List Audio Stories -->
            <div class="space-y-4">
              <?php foreach ($audio_list as $al): 
                $al_json = json_encode([
                    'title' => esc_html($al['title']),
                    'excerpt' => esc_html($al['excerpt']),
                    'permalink' => esc_url($al['permalink']),
                    'thumbnail' => esc_url($al['thumbnail']),
                    'category' => esc_html($al['category']),
                    'date' => esc_html($al['date']),
                    'author' => esc_html($al['author'])
                ], JSON_HEX_APOS | JSON_HEX_QUOT);
              ?>
                <div class="flex items-center gap-4 py-3 border-b border-slate-200 last:border-0 group">
                  <div class="w-16 h-12 rounded-lg overflow-hidden bg-slate-950 border border-slate-100 shrink-0">
                    <img src="<?php echo esc_url($al['thumbnail']); ?>" alt="<?php echo esc_attr($al['title']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                  </div>
                  <div class="space-y-1">
                    <h5 class="text-xs font-bold text-slate-900 leading-snug group-hover:text-accent-red transition-colors line-clamp-2">
                      <a href="<?php echo esc_url($al['permalink']); ?>"><?php echo esc_html($al['title']); ?></a>
                    </h5>
                    <div class="flex items-center gap-2 text-[9px] font-mono text-slate-400">
                      <span><?php echo esc_html($al['date']); ?></span>
                      <span>•</span>
                      <button @click.prevent='activePost = <?php echo $al_json; ?>; showDrawer = true' class="text-accent-red hover:underline">
                        <?php _e('Xem nhanh', 'hacoled'); ?>
                      </button>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <p class="text-slate-450 text-xs py-6"><?php _e('Đang cập nhật bài viết...', 'hacoled'); ?></p>
          <?php endif; ?>
        </div>
      </div>

      <!-- COLUMN RIGHT: HƯỚNG DẪN KỸ THUẬT (1 Big + 2 Small) -->
      <div class="space-y-6">
        <div class="flex justify-between items-end border-b border-slate-200 pb-3">
          <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2 relative">
            <span class="w-1.5 h-6 bg-green-500 block rounded"></span>
            <?php _e('Hướng dẫn kỹ thuật', 'hacoled'); ?>
          </h3>
          <span class="text-[9px] font-bold text-slate-400 font-mono uppercase tracking-widest"><?php _e('KỸ THUẬT LẮP ĐẶT', 'hacoled'); ?></span>
        </div>

        <div class="space-y-6">
          <?php 
          $tech_posts = !empty($sections['tech']) ? $sections['tech'] : [];
          $tech_filtered = [];
          if (!empty($tech_posts)) {
              foreach ($tech_posts as $tp) {
                  if (!in_array($tp['id'], $used_post_ids)) {
                      $tech_filtered[] = $tp;
                  }
              }
          }
          if (!empty($tech_filtered)):
            $tech_featured = $tech_filtered[0];
            $used_post_ids[] = $tech_featured['id'];
            $tech_list = array_slice($tech_filtered, 1, 5);
            foreach ($tech_list as $tl) {
                $used_post_ids[] = $tl['id'];
            }
            
            $tf_json = json_encode([
                'title' => esc_html($tech_featured['title']),
                'excerpt' => esc_html($tech_featured['excerpt']),
                'permalink' => esc_url($tech_featured['permalink']),
                'thumbnail' => esc_url($tech_featured['thumbnail']),
                'category' => esc_html($tech_featured['category']),
                'date' => esc_html($tech_featured['date']),
                'author' => esc_html($tech_featured['author'])
            ], JSON_HEX_APOS | JSON_HEX_QUOT);
          ?>
            <!-- Main Tech Story - Glass effect -->
            <div class="group grid grid-cols-1 md:grid-cols-12 gap-6 items-center glass-card rounded-2xl p-5 border border-white/80 bg-white/70 shadow-sm hover:shadow-md transition-all duration-300">
              <div class="md:col-span-5 aspect-[4/3] relative rounded-xl overflow-hidden bg-slate-950 border border-slate-100">
                <img src="<?php echo esc_url($tech_featured['thumbnail']); ?>" alt="<?php echo esc_attr($tech_featured['title']); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
              </div>
              <div class="md:col-span-7 space-y-2.5">
                <span class="text-[9px] font-bold text-accent-red uppercase tracking-wider font-mono"><?php echo esc_html($tech_featured['category']); ?></span>
                <h4 class="text-xs font-bold text-slate-900 leading-snug group-hover:text-accent-red transition-colors">
                  <a href="<?php echo esc_url($tech_featured['permalink']); ?>"><?php echo esc_html($tech_featured['title']); ?></a>
                </h4>
                <div class="w-4 h-0.5 bg-accent-red group-hover:w-full transition-all duration-500"></div>
                <p class="text-[10px] text-slate-500 leading-relaxed line-clamp-3 font-light pt-1">
                  <?php echo esc_html($tech_featured['excerpt']); ?>
                </p>
                <div class="flex items-center justify-between pt-1.5 text-[9px] font-mono text-slate-400">
                  <span><?php echo esc_html($tech_featured['date']); ?></span>
                  <button @click.prevent='activePost = <?php echo $tf_json; ?>; showDrawer = true' class="text-accent-red hover:underline font-bold">
                    <?php _e('Đọc nhanh', 'hacoled'); ?>
                  </button>
                </div>
              </div>
            </div>

            <!-- List Tech Stories -->
            <div class="space-y-4">
              <?php foreach ($tech_list as $tl): 
                $tl_json = json_encode([
                    'title' => esc_html($tl['title']),
                    'excerpt' => esc_html($tl['excerpt']),
                    'permalink' => esc_url($tl['permalink']),
                    'thumbnail' => esc_url($tl['thumbnail']),
                    'category' => esc_html($tl['category']),
                    'date' => esc_html($tl['date']),
                    'author' => esc_html($tl['author'])
                ], JSON_HEX_APOS | JSON_HEX_QUOT);
              ?>
                <div class="flex items-center gap-4 py-3 border-b border-slate-200 last:border-0 group">
                  <div class="w-16 h-12 rounded-lg overflow-hidden bg-slate-950 border border-slate-100 shrink-0">
                    <img src="<?php echo esc_url($tl['thumbnail']); ?>" alt="<?php echo esc_attr($tl['title']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                  </div>
                  <div class="space-y-1">
                    <h5 class="text-xs font-bold text-slate-900 leading-snug group-hover:text-accent-red transition-colors line-clamp-2">
                      <a href="<?php echo esc_url($tl['permalink']); ?>"><?php echo esc_html($tl['title']); ?></a>
                    </h5>
                    <div class="flex items-center gap-2 text-[9px] font-mono text-slate-400">
                      <span><?php echo esc_html($tl['date']); ?></span>
                      <span>•</span>
                      <button @click.prevent='activePost = <?php echo $tl_json; ?>; showDrawer = true' class="text-accent-red hover:underline">
                        <?php _e('Xem nhanh', 'hacoled'); ?>
                      </button>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <p class="text-slate-450 text-xs py-6"><?php _e('Đang cập nhật bài viết...', 'hacoled'); ?></p>
          <?php endif; ?>
        </div>
      </div>

    </div>

    <!-- ========================================== -->
    <!-- SECTION 4: BÁO CHÍ ĐƯA TIN & SỰ KIỆN HACOLED -->
    <!-- ========================================== -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
      
      <!-- Press Reviews (7 Cols) -->
      <div class="lg:col-span-7 space-y-6">
        <div class="flex justify-between items-end border-b border-slate-200 pb-3">
          <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2 relative">
            <span class="w-1.5 h-6 bg-blue-500 block rounded"></span>
            <?php _e('Báo chí nói về HacoLED', 'hacoled'); ?>
          </h3>
          <span class="text-[9px] font-bold text-slate-400 font-mono uppercase tracking-widest"><?php _e('TRUYỀN THÔNG ĐƯA TIN', 'hacoled'); ?></span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <?php 
          $press_posts = !empty($sections['press']) ? $sections['press'] : [];
          $press_shown = 0;
          if (!empty($press_posts)):
            foreach ($press_posts as $pp):
              if (in_array($pp['id'], $used_post_ids)) continue;
              if ($press_shown >= 4) break;
              $press_shown++;
              $used_post_ids[] = $pp['id'];
              $pp_json = json_encode([
                  'title' => esc_html($pp['title']),
                  'excerpt' => esc_html($pp['excerpt']),
                  'permalink' => esc_url($pp['permalink']),
                  'thumbnail' => esc_url($pp['thumbnail']),
                  'category' => esc_html($pp['category']),
                  'date' => esc_html($pp['date']),
                  'author' => esc_html($pp['author'])
              ], JSON_HEX_APOS | JSON_HEX_QUOT);
          ?>
            <div class="bg-white border border-slate-200 rounded-2xl p-5 hover:shadow-md hover:border-blue-500/20 transition-all duration-300 group flex flex-col justify-between">
              <div class="space-y-3">
                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-slate-100 text-[8px] font-black text-slate-600 tracking-wider uppercase font-mono border border-slate-200">
                  <i class="ph-bold ph-newspaper text-[9px]"></i>
                  <?php echo esc_html($pp['author']); ?>
                </div>
                <h4 class="text-xs font-bold text-slate-900 leading-snug group-hover:text-accent-red transition-colors line-clamp-2">
                  <a href="<?php echo esc_url($pp['permalink']); ?>"><?php echo esc_html($pp['title']); ?></a>
                </h4>
                <p class="text-[10px] text-slate-500 leading-relaxed font-light line-clamp-3">
                  <?php echo esc_html($pp['excerpt']); ?>
                </p>
              </div>
              <div class="flex items-center justify-between pt-4 border-t border-slate-100 mt-4 text-[9px] text-slate-400 font-mono">
                <span><?php echo esc_html($pp['date']); ?></span>
                <div class="flex items-center gap-2">
                  <button @click.prevent='activePost = <?php echo $pp_json; ?>; showDrawer = true' class="text-slate-450 hover:text-accent-red">
                    <?php _e('Đọc nhanh', 'hacoled'); ?>
                  </button>
                  <span>|</span>
                  <a href="<?php echo esc_url($pp['permalink']); ?>" class="text-accent-red font-bold hover:text-slate-900 transition-colors uppercase">
                    <?php _e('Chi tiết', 'hacoled'); ?>
                  </a>
                </div>
              </div>
            </div>
          <?php 
            endforeach;
            if ($press_shown === 0):
          ?>
            <p class="text-slate-450 text-xs py-6 col-span-full"><?php _e('Đang cập nhật bài viết...', 'hacoled'); ?></p>
          <?php
            endif;
          else:
          ?>
            <p class="text-slate-450 text-xs py-6 col-span-full"><?php _e('Đang cập nhật tin tức báo chí...', 'hacoled'); ?></p>
          <?php endif; ?>
        </div>
      </div>

      <!-- Events list (5 Cols) -->
      <div class="lg:col-span-5 space-y-6">
        <div class="flex justify-between items-end border-b border-slate-200 pb-3">
          <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2 relative">
            <span class="w-1.5 h-6 bg-purple-500 block rounded"></span>
            <?php _e('Sự kiện HacoLED', 'hacoled'); ?>
          </h3>
          <span class="text-[9px] font-bold text-slate-400 font-mono uppercase tracking-widest"><?php _e('HOẠT ĐỘNG DOANH NGHIỆP', 'hacoled'); ?></span>
        </div>

        <div class="space-y-4">
          <?php 
          $event_posts = !empty($sections['events']) ? $sections['events'] : [];
          $event_shown = 0;
          if (!empty($event_posts)):
            foreach ($event_posts as $ep):
              if (in_array($ep['id'], $used_post_ids)) continue;
              if ($event_shown >= 5) break;
              $event_shown++;
              $used_post_ids[] = $ep['id'];
              $ep_json = json_encode([
                  'title' => esc_html($ep['title']),
                  'excerpt' => esc_html($ep['excerpt']),
                  'permalink' => esc_url($ep['permalink']),
                  'thumbnail' => esc_url($ep['thumbnail']),
                  'category' => esc_html($ep['category']),
                  'date' => esc_html($ep['date']),
                  'author' => esc_html($ep['author'])
              ], JSON_HEX_APOS | JSON_HEX_QUOT);
          ?>
            <div class="group flex items-start gap-4 p-4 bg-white border border-slate-200/80 rounded-2xl hover:shadow-md transition-all duration-300">
              <div class="w-20 aspect-square rounded-lg overflow-hidden bg-slate-950 border border-slate-100 shrink-0">
                <img src="<?php echo esc_url($ep['thumbnail']); ?>" alt="<?php echo esc_attr($ep['title']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
              </div>
              <div class="space-y-1.5">
                <span class="text-[8px] font-mono text-accent-red font-bold uppercase tracking-widest block"><?php _e('EVENT', 'hacoled'); ?></span>
                <h4 class="text-xs font-bold text-slate-900 leading-snug group-hover:text-accent-red transition-colors line-clamp-2">
                  <a href="<?php echo esc_url($ep['permalink']); ?>"><?php echo esc_html($ep['title']); ?></a>
                </h4>
                <div class="flex items-center gap-2 text-[9px] text-slate-400 font-mono">
                  <span><?php echo esc_html($ep['date']); ?></span>
                  <span>•</span>
                  <button @click.prevent='activePost = <?php echo $ep_json; ?>; showDrawer = true' class="text-accent-red hover:underline">
                    <?php _e('Xem nhanh', 'hacoled'); ?>
                  </button>
                </div>
              </div>
            </div>
          <?php 
            endforeach;
            if ($event_shown === 0):
          ?>
            <p class="text-slate-450 text-xs py-6"><?php _e('Đang cập nhật bài viết...', 'hacoled'); ?></p>
          <?php
            endif;
          else:
          ?>
            <p class="text-slate-450 text-xs py-6"><?php _e('Đang cập nhật sự kiện...', 'hacoled'); ?></p>
          <?php endif; ?>
        </div>
      </div>

    </div>

    <!-- ========================================== -->
    <!-- SECTION 5: TUYỂN DỤNG & ĐĂNG KÝ BẢN TIN -->
    <!-- ========================================== -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-stretch">
      
      <!-- Recruitment cards (8 Cols) -->
      <div class="lg:col-span-8 space-y-6">
        <div class="flex justify-between items-end border-b border-slate-200 pb-3">
          <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2 relative">
            <span class="w-1.5 h-6 bg-cyan-500 block rounded"></span>
            <?php _e('Tuyển dụng / Sự nghiệp', 'hacoled'); ?>
          </h3>
          <span class="text-[9px] font-bold text-slate-400 font-mono uppercase tracking-widest"><?php _e('GIA NHẬP HACOLED', 'hacoled'); ?></span>
        </div>

        <div class="space-y-4">
          <?php 
          $job_posts = !empty($sections['jobs']) ? $sections['jobs'] : [];
          if (!empty($job_posts)):
            foreach (array_slice($job_posts, 0, 5) as $jp):
          ?>
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-5 bg-white border border-slate-200 rounded-2xl hover:border-accent-red/20 transition-all shadow-sm group">
              <div class="space-y-1">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded bg-accent-red/5 text-[9px] font-black text-accent-red tracking-wider uppercase font-mono border border-accent-red/10">
                  <?php _e('Hot Job', 'hacoled'); ?>
                </span>
                <h4 class="text-xs font-bold text-slate-900 group-hover:text-accent-red transition-colors pt-1">
                  <a href="<?php echo esc_url($jp['permalink']); ?>"><?php echo esc_html($jp['title']); ?></a>
                </h4>
                <p class="text-[10px] text-slate-500 font-light line-clamp-1 max-w-xl">
                  <?php echo esc_html($jp['excerpt']); ?>
                </p>
              </div>
              <a href="<?php echo esc_url($jp['permalink']); ?>" class="shrink-0 text-center text-[10px] font-black uppercase tracking-wider text-slate-900 border border-slate-350 hover:bg-accent-red hover:border-accent-red hover:text-white px-5 py-2.5 rounded-xl transition-all duration-300">
                <?php _e('Chi tiết ứng tuyển', 'hacoled'); ?>
              </a>
            </div>
          <?php 
            endforeach;
          else:
          ?>
            <p class="text-slate-450 text-xs py-6"><?php _e('Hiện không có vị trí nào đang tuyển dụng.', 'hacoled'); ?></p>
          <?php endif; ?>
        </div>
      </div>

      <!-- Newsletter subscription form (4 Cols) -->
      <div class="lg:col-span-4 flex flex-col justify-between">
        <div class="space-y-6">
          <div class="flex justify-between items-end border-b border-slate-200 pb-3">
            <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2">
              <span class="w-1.5 h-6 bg-slate-400 block rounded"></span>
              <?php _e('Đăng ký nhận tin', 'hacoled'); ?>
            </h3>
          </div>
          
          <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#4A0505] to-slate-950 p-6 text-white border border-white/10 shadow-lg group">
            <div class="absolute -right-8 -bottom-8 w-24 h-24 bg-accent-gold/15 rounded-full blur-xl pointer-events-none"></div>
            <div class="relative z-10 space-y-4">
              <p class="text-[10.5px] text-slate-300 leading-relaxed font-light">
                <?php _e('Đăng ký để cập nhật sớm nhất các cẩm nang hướng dẫn kỹ thuật, xu hướng màn hình hiển thị LED và giải pháp AV Pro tích hợp cao cấp.', 'hacoled'); ?>
              </p>
              <div class="space-y-2">
                <input type="email" placeholder="<?php _e('Nhập địa chỉ email của bạn...', 'hacoled'); ?>" class="w-full text-xs font-semibold px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:outline-none focus:border-brand-gold focus:bg-white/10 text-white placeholder-slate-400 transition-colors">
                <button class="w-full text-xs font-black uppercase tracking-widest text-primary-dark bg-gradient-to-r from-accent-gold to-yellow-500 hover:from-yellow-500 hover:to-accent-gold py-3.5 rounded-xl shadow-md transition-all duration-300">
                  <?php _e('Đăng ký bản tin', 'hacoled'); ?>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- ========================================== -->
    <!-- SECTION 6: KHO KIẾN THỨC & TỔNG HỢP TRI THỨC AV PRO -->
    <!-- ========================================== -->
    <?php
    // Collect all shown posts to prevent duplication
    $used_post_ids = [];
    if ($main_featured) {
        $used_post_ids[] = $main_featured['id'];
    }
    if (!empty($sections['news'])) {
        foreach (array_slice($sections['news'], 0, 6) as $qn) {
            $used_post_ids[] = $qn['id'];
        }
    }
    if (!empty($sections['led'])) {
        foreach (array_slice($sections['led'], 0, 6) as $lp) {
            $used_post_ids[] = $lp['id'];
        }
    }
    if (!empty($sections['audio'])) {
        foreach (array_slice($sections['audio'], 0, 6) as $ap) {
            $used_post_ids[] = $ap['id'];
        }
    }
    if (!empty($sections['tech'])) {
        foreach (array_slice($sections['tech'], 0, 6) as $tp) {
            $used_post_ids[] = $tp['id'];
        }
    }
    if (!empty($sections['press'])) {
        foreach (array_slice($sections['press'], 0, 4) as $pp) {
            $used_post_ids[] = $pp['id'];
        }
    }
    if (!empty($sections['events'])) {
        foreach (array_slice($sections['events'], 0, 5) as $ep) {
            $used_post_ids[] = $ep['id'];
        }
    }

    // Gather all remaining posts
    $remaining_posts = [];
    foreach ($sections as $cat_key => $sec_posts) {
        if ($cat_key === 'jobs') continue; // Skip jobs in general news stream
        if (!empty($sec_posts)) {
            foreach ($sec_posts as $post_item) {
                if (!in_array($post_item['id'], $used_post_ids)) {
                    $remaining_posts[] = $post_item;
                }
            }
        }
    }
    // Sort remaining by date descending
    usort($remaining_posts, function($a, $b) {
        return strcmp($b['date'], $a['date']);
    });
    ?>

    <?php if (!empty($remaining_posts)): ?>
    <div class="space-y-6 pt-12 border-t border-slate-200">
      <div class="flex justify-between items-end border-b border-slate-200 pb-3">
        <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest flex items-center gap-2 relative">
          <span class="w-1.5 h-6 bg-slate-900 block rounded"></span>
          <?php _e('Kho kiến thức & Cẩm nang tổng hợp', 'hacoled'); ?>
        </h3>
        <span class="text-[9px] font-mono font-bold text-slate-400 uppercase tracking-widest">
          <?php echo sprintf(__('%d bài viết khác', 'hacoled'), count($remaining_posts)); ?>
        </span>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php foreach ($remaining_posts as $rp): 
          $rp_json = json_encode([
              'title' => esc_html($rp['title']),
              'excerpt' => esc_html($rp['excerpt']),
              'permalink' => esc_url($rp['permalink']),
              'thumbnail' => esc_url($rp['thumbnail']),
              'category' => esc_html($rp['category']),
              'date' => esc_html($rp['date']),
              'author' => esc_html($rp['author'])
          ], JSON_HEX_APOS | JSON_HEX_QUOT);
        ?>
          <!-- Compact Luxury Card -->
          <div class="group flex flex-col justify-between bg-white border border-slate-200/80 rounded-2xl p-4 hover:shadow-md hover:border-slate-350 transition-all duration-300">
            <div class="space-y-3">
              <div class="aspect-[16/10] relative rounded-xl overflow-hidden bg-slate-950 border border-slate-100">
                <img src="<?php echo esc_url($rp['thumbnail']); ?>" alt="<?php echo esc_attr($rp['title']); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
              </div>
              <div class="space-y-1">
                <span class="text-[8px] font-bold text-accent-red uppercase tracking-wider font-mono"><?php echo esc_html($rp['category']); ?></span>
                <h4 class="text-[11px] font-bold text-slate-900 leading-snug group-hover:text-accent-red transition-colors line-clamp-2">
                  <a href="<?php echo esc_url($rp['permalink']); ?>"><?php echo esc_html($rp['title']); ?></a>
                </h4>
                <p class="text-[10px] text-slate-550 leading-relaxed font-light line-clamp-2 pt-0.5">
                  <?php echo esc_html($rp['excerpt']); ?>
                </p>
              </div>
            </div>
            <div class="pt-3 border-t border-slate-100 flex justify-between items-center mt-3 text-[9px] font-mono text-slate-400">
              <span><?php echo esc_html($rp['date']); ?></span>
              <div class="flex items-center gap-2">
                <button @click.prevent='activePost = <?php echo $rp_json; ?>; showDrawer = true' 
                        class="text-slate-500 hover:text-accent-red font-bold uppercase transition-colors">
                  <?php _e('Xem nhanh', 'hacoled'); ?>
                </button>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

  </div>

  <!-- ========================================== -->
  <!-- ALPINE.JS POWERED QUICK READ DRAWER -->
  <!-- ========================================== -->
  <!-- Overlay dim background -->
  <div x-show="showDrawer" 
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="opacity-0"
       x-transition:enter-end="opacity-100"
       x-transition:leave="transition ease-in duration-200"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0"
       @click="showDrawer = false" 
       class="fixed inset-0 bg-black/60 backdrop-blur-md z-50"
       x-cloak></div>

  <!-- Right Drawer Panel -->
  <div x-show="showDrawer" 
       x-transition:enter="transition ease-out duration-300 transform"
       x-transition:enter-start="translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transition ease-in duration-200 transform"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="translate-x-full"
       class="fixed right-0 top-0 bottom-0 w-full sm:w-[480px] bg-[#0A0000] border-l border-white/10 shadow-2xl p-6 sm:p-8 z-50 flex flex-col justify-between overflow-y-auto"
       x-cloak>
    
    <div class="space-y-6">
      <!-- Top header strip -->
      <div class="flex items-center justify-between pb-4 border-b border-white/10">
        <span class="text-[9px] font-bold text-accent-gold uppercase tracking-widest font-mono" x-text="activePost?.category"></span>
        <button @click="showDrawer = false" class="w-8 h-8 rounded-full border border-white/10 bg-white/5 flex items-center justify-center text-white hover:bg-accent-red hover:border-accent-red transition-all">
          <i class="ph-bold ph-x text-sm"></i>
        </button>
      </div>

      <!-- Post details -->
      <div class="space-y-4" x-show="activePost">
        <h3 class="text-lg sm:text-xl font-extrabold text-white leading-snug uppercase" x-text="activePost?.title"></h3>
        
        <!-- Metadata -->
        <div class="flex items-center gap-2 text-[10px] text-gray-400 font-mono">
          <span x-text="activePost?.date"></span>
          <span>•</span>
          <span x-text="activePost?.author"></span>
        </div>

        <!-- Post Image -->
        <div class="aspect-video w-full rounded-xl overflow-hidden bg-slate-900 border border-white/10">
          <img :src="activePost?.thumbnail" alt="" class="w-full h-full object-cover">
        </div>

        <!-- Excerpt summary -->
        <div class="text-xs text-gray-300 leading-relaxed font-light space-y-4">
          <p class="font-bold text-white text-[11px] uppercase tracking-wider text-accent-gold font-mono"><?php _e('TÓM TẮT CHI TIẾT:', 'hacoled'); ?></p>
          <p class="bg-white/5 border border-white/5 rounded-xl p-4 italic text-slate-300" x-text="activePost?.excerpt"></p>
          <p class="text-[10px] text-gray-400">
            <?php _e('Bạn đang đọc bản tin nhanh được biên soạn bởi đội ngũ Kỹ thuật HacoLED. Vui lòng bấm nút phía dưới để xem toàn bộ nội dung hướng dẫn chi tiết và các sơ đồ kỹ thuật đấu nối.', 'hacoled'); ?>
          </p>
        </div>
      </div>
    </div>

    <!-- Bottom Actions -->
    <div class="pt-6 border-t border-white/10 space-y-3 bg-[#0A0000] sticky bottom-0">
      <a :href="activePost?.permalink" 
         class="w-full inline-flex items-center justify-center gap-2 bg-accent-red hover:bg-brand-red text-white font-extrabold text-xs uppercase py-4 rounded-xl tracking-wider shadow-lg transition-all duration-300">
        <span><?php _e('Xem toàn bộ bài viết', 'hacoled'); ?></span>
        <i class="ph-bold ph-arrow-right text-[10px]"></i>
      </a>
      <a href="tel:0342324488" 
         class="w-full inline-flex items-center justify-center gap-2 bg-white/5 border border-white/10 hover:bg-white/10 text-white font-bold text-xs uppercase py-3 rounded-xl transition-all duration-300">
        <i class="ph-fill ph-phone-call text-[12px] text-accent-gold"></i>
        <span>Hotline hỗ trợ: 034.232.4488</span>
      </a>
    </div>

  </div>

</main>

<?php
$this->renderFooter($footer_type ?? 'default');
?>
