<?php
/**
 * Common Blog Category Archive View - Premium Luxury Journal Layout (TGDD & Apple Style)
 *
 * @var string $category_name
 * @var string $description
 * @var array  $posts
 * @var string $header_type
 * @var string $footer_type
 */

$this->renderHeader($header_type ?? 'default');

// Define category list for navigation filters
$categories_filter = [
    'blog-man-hinh-led'  => ['label' => __('Blog Màn Hình LED', 'hacoled'), 'icon' => 'ph-monitor'],
    'blog-am-thanh'      => ['label' => __('Blog Âm Thanh', 'hacoled'), 'icon' => 'ph-speaker-high'],
    'huong-dan-ky-thuat' => ['label' => __('Hướng dẫn kỹ thuật', 'hacoled'), 'icon' => 'ph-wrench'],
    'tin-tuc'            => ['label' => __('Tin Tức & Sự Kiện', 'hacoled'), 'icon' => 'ph-newspaper'],
];

// Split posts into Featured and List
$featured_post = !empty($posts) ? $posts[0] : null;
$list_posts = !empty($posts) ? array_slice($posts, 1) : [];

// Sidebar query for popular posts (recent posts)
$popular_posts_query = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => 4,
    'post__not_in'   => $featured_post ? [$featured_post['id']] : [],
]);
$popular_posts = [];
if ($popular_posts_query->have_posts()) {
    while ($popular_posts_query->have_posts()) {
        $popular_posts_query->the_post();
        $popular_posts[] = [
            'id'        => get_the_ID(),
            'title'     => get_the_title(),
            'permalink' => get_permalink(),
            'date'      => get_the_date('d/m/Y'),
            'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'thumbnail') ?: '',
            'category'  => strip_tags(get_the_category_list(', ')) ?: __('Tin tức', 'hacoled')
        ];
    }
    wp_reset_postdata();
}
?>

<main class="relative bg-[#FAFAFA] pt-28 md:pt-48 pb-24 overflow-hidden min-h-[95vh] bg-tech-grid">
  
  <!-- Glowing Premium Orbs (Background Art) -->
  <div class="absolute top-12 left-1/4 w-[500px] h-[500px] bg-accent-red/5 filter blur-[120px] rounded-full pointer-events-none z-0"></div>
  <div class="absolute top-[600px] right-1/4 w-[600px] h-[600px] bg-accent-gold/5 filter blur-[140px] rounded-full pointer-events-none z-0"></div>

  <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10 space-y-10">
    
    <!-- Breadcrumbs Section -->
    <nav aria-label="Breadcrumb" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest flex items-center gap-2">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="text-slate-500 hover:text-accent-red transition-colors"><?php _e('Trang chủ', 'hacoled'); ?></a>
      <span class="text-slate-300">/</span>
      <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>" class="text-slate-500 hover:text-accent-red transition-colors"><?php _e('Tin tức & Blog', 'hacoled'); ?></a>
      <span class="text-slate-350">/</span>
      <span class="text-slate-800 font-extrabold"><?php echo esc_html($category_name); ?></span>
    </nav>

    <!-- ============================================== -->
    <!-- HERO HEADER: LUXURY BRAND PROFILE -->
    <!-- ============================================== -->
    <div class="relative bg-gradient-to-br from-[#5a0c0c] via-[#8a0b10] to-[#200202] border border-red-950/80 rounded-3xl p-8 md:p-12 shadow-2xl overflow-hidden text-white">
      <!-- Gold accent stripe -->
      <div class="absolute top-0 left-0 w-full h-[4px] bg-gradient-to-r from-accent-gold via-amber-300 to-accent-gold"></div>
      
      <!-- Dong Son circular pattern (subtle overlay) -->
      <div class="absolute right-0 bottom-0 translate-x-1/4 translate-y-1/4 w-[420px] h-[420px] opacity-[0.06] bg-dongson pointer-events-none" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/dongson.png'); filter: invert(1);"></div>

      <div class="max-w-4xl space-y-4 relative z-10">
        <div class="flex items-center gap-2">
          <span class="h-2 w-2 rounded-full bg-accent-gold animate-pulse"></span>
          <span class="text-[10px] font-black text-accent-gold uppercase tracking-widest"><?php _e('Chuyên mục bài viết', 'hacoled'); ?></span>
          <span class="text-white/20">|</span>
          <span class="text-[10px] font-bold text-white/95 bg-white/10 border border-white/10 px-2.5 py-0.5 rounded-md font-mono"><?php echo sprintf(__('%d bài viết đã xuất bản', 'hacoled'), count($posts)); ?></span>
        </div>
        
        <h1 class="text-3xl md:text-6xl font-black text-white tracking-tight leading-none drop-shadow-md">
          <?php echo esc_html($category_name); ?>
        </h1>
        
        <?php if (!empty($description)): ?>
          <p class="text-white/85 text-xs md:text-sm leading-relaxed font-light max-w-3xl pt-1"><?php echo esc_html($description); ?></p>
        <?php else: ?>
          <p class="text-white/75 text-xs md:text-sm leading-relaxed font-light max-w-3xl pt-1"><?php echo sprintf(__('Tổng hợp các tin tức, bài viết chia sẻ kinh nghiệm lắp đặt và các giải pháp trình chiếu màn hình hiển thị & âm thanh sự kiện tối tân nhất liên quan đến %s.', 'hacoled'), esc_html($category_name)); ?></p>
        <?php endif; ?>
      </div>
    </div>

    <!-- ============================================== -->
    <!-- SUB-NAV / INTERACTIVE TAB BAR (TGDD & Medium Style) -->
    <!-- ============================================== -->
    <div class="w-full border-b border-slate-200/80 pb-1 flex items-center justify-between gap-4 overflow-x-auto scrollbar-none">
      <div class="flex items-center gap-3">
        <?php foreach ($categories_filter as $slug => $data): 
          $cat_obj = get_category_by_slug($slug);
          if ($cat_obj):
            $cat_link = get_category_link($cat_obj->term_id);
            $is_active = ($category_name === $cat_obj->name);
        ?>
          <a href="<?php echo esc_url($cat_link); ?>" 
             class="group flex items-center gap-2 text-xs font-bold px-4 py-2.5 rounded-xl border transition-all duration-300 whitespace-nowrap <?php echo $is_active ? 'bg-accent-red text-white border-accent-red shadow-lg shadow-accent-red/20' : 'bg-white text-slate-600 border-slate-250 hover:bg-slate-50 hover:text-slate-900'; ?>">
            <i class="ph-bold <?php echo $data['icon']; ?> <?php echo $is_active ? 'text-white' : 'text-slate-400 group-hover:text-accent-red'; ?> text-sm transition-colors"></i>
            <?php echo esc_html($data['label']); ?>
          </a>
        <?php 
          endif;
        endforeach; ?>
      </div>
      
      <span class="hidden md:inline-block text-[10px] font-bold text-slate-400 uppercase tracking-widest font-mono"><?php _e('Tự động cập nhật', 'hacoled'); ?></span>
    </div>

    <!-- ============================================== -->
    <!-- MAIN GRID SECTION (2 COLUMNS: CONTENT VS SIDEBAR) -->
    <!-- ============================================== -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
      
      <!-- LEFT CONTENT COLUMN (8 cols - min-w-0) -->
      <div class="lg:col-span-8 min-w-0 space-y-10">
        
        <!-- Featured Spotlight Big Post -->
        <?php if ($featured_post): ?>
          <div class="group relative overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-sm hover:shadow-lg transition-all duration-500">
            <div class="grid grid-cols-1 md:grid-cols-12 items-stretch">
              
              <!-- Left: Big image -->
              <div class="md:col-span-7 relative min-h-[240px] md:min-h-[360px] overflow-hidden bg-slate-50">
                <?php if (!empty($featured_post['thumbnail'])): ?>
                  <img src="<?php echo esc_url($featured_post['thumbnail']); ?>" 
                       alt="<?php echo esc_attr($featured_post['title']); ?>" 
                       class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-103" />
                <?php else: ?>
                  <div class="absolute inset-0 bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
                    <i class="ph-bold ph-image text-slate-350 text-5xl"></i>
                  </div>
                <?php endif; ?>
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>
                
                <span class="absolute top-5 left-5 px-3 py-1 bg-accent-red text-white text-[9px] font-black uppercase tracking-widest rounded-md shadow-md">
                  <?php _e('BÀI VIẾT TIÊU ĐIỂM', 'hacoled'); ?>
                </span>
              </div>

              <!-- Right: Info -->
              <div class="md:col-span-5 p-6 md:p-8 flex flex-col justify-between space-y-4">
                <div class="space-y-3">
                  <div class="flex items-center gap-2 text-[9px] font-bold text-slate-400 font-mono uppercase tracking-wider">
                    <span><?php echo esc_html($featured_post['date']); ?></span>
                    <span>•</span>
                    <span><?php echo esc_html($featured_post['author']); ?></span>
                  </div>

                  <h2 class="text-lg md:text-xl font-extrabold text-slate-900 leading-snug group-hover:text-accent-red transition-colors duration-300">
                    <a href="<?php echo esc_url($featured_post['permalink']); ?>">
                      <?php echo esc_html($featured_post['title']); ?>
                    </a>
                  </h2>

                  <div class="w-6 h-0.5 bg-accent-red group-hover:w-full transition-all duration-500"></div>

                  <p class="text-slate-500 text-xs leading-relaxed font-light line-clamp-4">
                    <?php echo esc_html($featured_post['excerpt']); ?>
                  </p>
                </div>

                <div>
                  <a href="<?php echo esc_url($featured_post['permalink']); ?>" 
                     class="inline-flex items-center gap-1.5 text-[10px] font-black uppercase tracking-widest text-accent-red hover:text-slate-800 transition-colors">
                    <?php _e('Xem chi tiết', 'hacoled'); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke-width="3.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                  </a>
                </div>
              </div>
              
            </div>
          </div>
        <?php endif; ?>

        <!-- Grid of standard posts -->
        <div class="space-y-6">
          <div class="relative pb-2 border-b border-slate-200/80">
            <h3 class="text-[11px] font-black uppercase tracking-widest text-slate-900 flex items-center gap-2">
              <span class="w-2.5 h-[2px] bg-accent-red"></span>
              <?php _e('Các tin bài viết khác', 'hacoled'); ?>
            </h3>
          </div>

          <?php if (!empty($list_posts) || (!empty($posts) && count($posts) === 1)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <?php 
              $display_posts = !empty($list_posts) ? $list_posts : $posts;
              foreach ($display_posts as $post_item): 
              ?>
                <?php $this->renderComponent('blog-card', $post_item); ?>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div class="bg-white border border-slate-200 rounded-3xl p-12 text-center space-y-4 shadow-sm">
              <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center mx-auto text-slate-450 border border-slate-100">
                <i class="ph-bold ph-newspaper-clipping text-2xl"></i>
              </div>
              <h4 class="text-sm font-bold text-slate-800"><?php _e('Chuyên mục đang cập nhật', 'hacoled'); ?></h4>
              <p class="text-slate-500 text-xs max-w-sm mx-auto font-light leading-relaxed">
                <?php _e('Nội dung chi tiết của chuyên mục này đang được ban biên tập HacoLED hoàn thiện và bổ sung.', 'hacoled'); ?>
              </p>
            </div>
          <?php endif; ?>
        </div>

      </div>

      <!-- RIGHT SIDEBAR COLUMN (4 cols - min-w-0 - sticky) -->
      <div class="lg:col-span-4 min-w-0 space-y-6 lg:sticky lg:top-[120px] lg:self-start">
        
        <!-- Popular Articles Widget (Trending style) -->
        <div class="bg-white border border-slate-200/80 rounded-3xl p-6 shadow-sm space-y-5">
          <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest border-b border-slate-100 pb-3 flex items-center gap-2">
            <i class="ph-bold ph-trend-up text-accent-red text-sm"></i>
            <?php _e('Xem nhiều nhất', 'hacoled'); ?>
          </h3>
          
          <div class="space-y-4">
            <?php 
            $count = 0;
            if (!empty($popular_posts)):
              foreach ($popular_posts as $pp):
                $count++;
            ?>
              <div class="flex items-start gap-4 group">
                <span class="text-3xl font-black text-slate-150 font-mono leading-none tracking-tight group-hover:text-accent-red/30 transition-colors shrink-0">
                  0<?php echo $count; ?>
                </span>
                <div class="space-y-1">
                  <span class="text-[8px] font-bold text-accent-red uppercase tracking-wider font-mono"><?php echo esc_html($pp['category']); ?></span>
                  <h4 class="text-xs font-bold text-slate-800 leading-snug group-hover:text-accent-red transition-colors line-clamp-2">
                    <a href="<?php echo esc_url($pp['permalink']); ?>"><?php echo esc_html($pp['title']); ?></a>
                  </h4>
                  <span class="block text-[9px] text-slate-400 font-mono"><?php echo esc_html($pp['date']); ?></span>
                </div>
              </div>
            <?php 
              endforeach;
            else:
            ?>
              <p class="text-xs text-slate-400 font-light"><?php _e('Đang cập nhật các bài viết xem nhiều...', 'hacoled'); ?></p>
            <?php endif; ?>
          </div>
        </div>

        <!-- Premium Solution Consultation Widget Banner -->
        <div class="relative rounded-3xl overflow-hidden border border-red-950 bg-gradient-to-br from-[#8a0b10] to-[#2b0202] text-white p-6 shadow-md group/banner flex flex-col justify-between min-h-[220px]">
          <!-- Pattern overlay -->
          <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_right,_var(--tw-gradient-stops))] from-accent-gold/20 via-transparent to-transparent pointer-events-none"></div>
          
          <div class="space-y-2.5 relative z-10">
            <span class="inline-block text-[9px] font-black uppercase tracking-widest px-2 py-0.5 rounded bg-accent-gold text-slate-950 w-max mb-1">Hỗ trợ kỹ thuật</span>
            <h4 class="text-sm font-bold text-white leading-snug"><?php _e('Tư vấn giải pháp hiển thị và âm thanh chuyên nghiệp', 'hacoled'); ?></h4>
            <p class="text-white/70 text-[10px] leading-relaxed font-light"><?php _e('Nhận khảo sát dự án và thiết kế bản vẽ kỹ thuật 2D/3D miễn phí từ đội ngũ chuyên gia HacoLED.', 'hacoled'); ?></p>
          </div>
          
          <div class="pt-4 relative z-10">
            <a href="<?php echo esc_url(home_url('/lien-he/')); ?>" 
               class="inline-flex items-center justify-center gap-2 bg-white hover:bg-accent-gold hover:text-slate-950 text-slate-900 font-black text-[10px] uppercase tracking-wider px-5 py-2.5 rounded-xl transition-all duration-300 w-full text-center">
              <?php _e('Yêu cầu báo giá ngay', 'hacoled'); ?>
              <i class="ph-bold ph-arrow-right"></i>
            </a>
          </div>
        </div>

      </div>

    </div>

  </div>
</main>

<?php
$this->renderFooter($footer_type ?? 'default');
?>
