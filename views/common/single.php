<?php
/**
 * Common Single Article / Detail Template View
 *
 * @var array  $post
 * @var string $header_type
 * @var string $footer_type
 */

// Render header
$this->renderHeader($header_type ?? 'default');
?>

<main class="relative bg-[#FAFAFA] pt-28 md:pt-48 pb-20 min-h-[85vh] bg-tech-grid overflow-hidden" data-tech-bg="circuit"
      x-data="{ percent: 0 }" @scroll.window="percent = (window.pageYOffset / (document.documentElement.scrollHeight - window.innerHeight)) * 100">
  
  <!-- Reading Progress Bar -->
  <div class="fixed top-0 left-0 right-0 h-[3px] bg-slate-200/50 z-[999] pointer-events-none">
    <div class="h-full bg-gradient-to-r from-accent-red to-accent-gold transition-all duration-75" :style="'width: ' + percent + '%'"></div>
  </div>
  
  <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
      
      <!-- MAIN CONTENT COLUMN (70%) -->
      <div class="lg:col-span-2 bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-10 shadow-sm space-y-6">
        
        <!-- Top Metadata & Back Link -->
        <div class="flex items-center justify-between text-xs text-slate-500 font-semibold tracking-wider pb-4 border-b border-slate-100">
          <div class="flex items-center gap-2.5">
            <div class="flex flex-wrap gap-1.5">
              <?php if (!empty($post['categories'])): 
                foreach ($post['categories'] as $cat): 
              ?>
                <a href="<?php echo esc_url($cat['link']); ?>" class="bg-accent-red/10 border border-accent-red/20 text-accent-red text-[9px] font-extrabold px-2.5 py-0.5 rounded transition-all duration-300 uppercase tracking-wider">
                  <?php echo esc_html($cat['name']); ?>
                </a>
              <?php 
                endforeach; 
              endif; ?>
            </div>
            <span class="text-slate-350">•</span>
            <span><?php echo esc_html($post['date']); ?></span>
          </div>
          <a href="<?php echo esc_url(get_post_type_archive_link('post') ?: home_url('/')); ?>" class="text-slate-500 hover:text-accent-red transition-colors flex items-center gap-1">
            <i class="ph-bold ph-arrow-left text-[11px]"></i>
            <?php _e('Quay lại danh sách', 'hacoled'); ?>
          </a>
        </div>

        <!-- Featured Image -->
        <?php if (!empty($post['thumbnail'])): ?>
          <div class="w-full h-64 md:h-[380px] rounded-2xl overflow-hidden border border-slate-200 bg-slate-50 shadow-sm group">
            <img src="<?php echo esc_url($post['thumbnail']); ?>" alt="<?php echo esc_attr($post['title']); ?>" class="w-full h-full object-cover group-hover:scale-101 transition-transform duration-500">
          </div>
        <?php endif; ?>

        <!-- Headline Title -->
        <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight pt-2">
          <?php echo esc_html($post['title']); ?>
        </h1>

        <!-- Editorial Excerpt Lead -->
        <?php if (!empty($post['excerpt'])): ?>
          <p class="text-slate-500 italic text-[13px] border-l-2 border-accent-red pl-4 py-1 leading-relaxed font-light">
            <?php echo esc_html($post['excerpt']); ?>
          </p>
        <?php endif; ?>

        <!-- Author / Time Badge -->
        <div class="flex items-center justify-between gap-3 text-xs text-slate-500 border-b border-slate-100 pb-6">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-accent-red/10 border border-accent-red/20 flex items-center justify-center font-bold text-accent-red text-sm font-mono">
              <?php echo esc_html(substr($post['author'], 0, 1)); ?>
            </div>
            <div class="flex flex-col">
              <span class="font-bold text-slate-800"><?php echo sprintf(__('Đăng bởi %s', 'hacoled'), esc_html($post['author'])); ?></span>
              <span class="text-[10px] text-slate-450"><?php _e('Ban biên tập HacoLED', 'hacoled'); ?></span>
            </div>
          </div>
          <div class="flex items-center gap-1.5 font-mono text-[10px] text-slate-400">
            <i class="ph-bold ph-clock text-accent-red"></i>
            <span><?php echo ceil(str_word_count(strip_tags($post['content'])) / 200) ?: 3; ?> <?php _e('phút đọc', 'hacoled'); ?></span>
          </div>
        </div>

        <!-- Full HTML Post Body -->
        <article class="prose-custom text-slate-650 leading-relaxed pt-2">
          <?php 
          echo apply_filters('the_content', $post['content']); 
          ?>
        </article>

        <!-- Article Footer: Social Share -->
        <div class="flex flex-wrap items-center justify-between gap-4 pt-6 border-t border-slate-100 text-xs">
          <div class="flex items-center gap-2.5" x-data="{ copied: false }">
            <span class="text-slate-400 font-bold"><?php _e('Chia sẻ bài viết:', 'hacoled'); ?></span>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="w-8 h-8 rounded-full border border-slate-200 flex items-center justify-center hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-colors">
              <i class="ph-bold ph-facebook-logo text-sm"></i>
            </a>
            <button @click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2000)" 
                    class="w-8 h-8 rounded-full border border-slate-200 flex items-center justify-center hover:bg-slate-800 hover:text-white hover:border-slate-800 transition-colors relative">
              <i class="ph-bold ph-link text-sm"></i>
              <span x-show="copied" class="absolute -top-8 bg-slate-900 text-white text-[9px] px-2 py-0.5 rounded tracking-wider whitespace-nowrap shadow-md" x-cloak>
                <?php _e('Đã sao chép!', 'hacoled'); ?>
              </span>
            </button>
          </div>
          <div class="text-[10px] text-slate-400 uppercase tracking-widest font-mono">
            <?php _e('HACOLED JOURNAL', 'hacoled'); ?>
          </div>
        </div>

        <!-- Related Posts Section -->
        <?php
        if ($post['id'] > 0):
          $categories = wp_get_post_categories($post['id']);
          if (!empty($categories)):
            $related_args = [
                'category__in'   => $categories,
                'post__not_in'   => [$post['id']],
                'posts_per_page' => 2,
                'orderby'        => 'rand'
            ];
            $related_query = new \WP_Query($related_args);
            if ($related_query->have_posts()):
          ?>
            <div class="pt-10 border-t border-slate-100 mt-10 space-y-6">
              <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest flex items-center gap-2 border-b border-slate-100 pb-3">
                <span class="w-2.5 h-2.5 rounded-full bg-accent-red animate-pulse"></span>
                <?php _e('Bài viết liên quan', 'hacoled'); ?>
              </h3>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <?php 
                while ($related_query->have_posts()): 
                  $related_query->the_post();
                  $rel_categories = get_the_category();
                  $rel_cat_name = !empty($rel_categories) ? $rel_categories[0]->name : __('Tin tức', 'hacoled');
                  $post_item = [
                      'id'        => get_the_ID(),
                      'title'     => get_the_title(),
                      'excerpt'   => get_the_excerpt(),
                      'permalink' => get_permalink(),
                      'date'      => get_the_date(),
                      'author'    => get_the_author(),
                      'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'large') ?: '',
                      'category'  => $rel_cat_name
                  ];
                  $this->renderComponent('blog-card', $post_item);
                endwhile; 
                ?>
              </div>
            </div>
          <?php 
            wp_reset_postdata();
            endif;
          endif;
        endif;
        ?>

      </div>

      <!-- SIDEBAR COLUMN (30%) -->
      <div class="space-y-8">
        
        <!-- Sidebar Widget: Table of Contents -->
        <div x-data="{ headings: null }" x-init="
          setTimeout(() => {
            const items = Array.from(document.querySelectorAll('article h2, article h3')).map((el, i) => {
              if (!el.id) el.id = 'heading-' + i;
              return { text: el.innerText, id: el.id, level: el.tagName.toLowerCase() };
            });
            headings = items;
          }, 100);
        " class="rounded-2xl bg-white border border-slate-200/80 p-6 space-y-4 shadow-sm">
          <div class="relative pb-3 border-b border-slate-100">
            <!-- Thin elegant red accent line for brand identity -->
            <div class="absolute bottom-0 left-0 w-12 h-[2px] bg-accent-red"></div>
            <h3 class="text-xs font-black uppercase tracking-widest text-slate-900">
              <?php _e('Mục lục nội dung', 'hacoled'); ?>
            </h3>
          </div>
          
          <div class="text-xs text-slate-650 leading-relaxed">
            <!-- TOC List -->
            <ul x-show="headings !== null && headings.length > 0" class="space-y-3" x-cloak>
              <template x-for="h in headings" :key="h.id">
                <li :class="h.level === 'h3' ? 'pl-4' : ''">
                  <a :href="'#' + h.id" class="hover:text-accent-red transition-colors flex items-start gap-2 group text-slate-700">
                    <span class="text-slate-400 group-hover:text-accent-red transition-colors">•</span>
                    <span x-text="h.text" class="line-clamp-2"></span>
                  </a>
                </li>
              </template>
            </ul>
            
            <!-- Fallback placeholder when no headings -->
            <div x-show="headings !== null && headings.length === 0" class="space-y-2 py-1 text-slate-500 font-light" x-cloak>
              <p><?php _e('Bài viết đang cập nhật mục lục chi tiết. Vui lòng cuộn xuống để theo dõi toàn bộ nội dung.', 'hacoled'); ?></p>
              <div class="flex items-center gap-1.5 text-accent-red font-semibold text-[10px] uppercase tracking-wider mt-3">
                <span><?php _e('Xem chi tiết bên dưới', 'hacoled'); ?></span>
                <i class="ph-bold ph-arrow-down animate-bounce"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Sidebar Widget: Latest Articles by Category -->
        <?php 
        ob_start();
        
        $current_cats = ($post['id'] > 0) ? wp_get_post_categories($post['id']) : [];
        $latest_posts = [];
        
        // 1. Fetch category-specific articles
        if (!empty($current_cats)) {
            $cat_args = [
                'post_type'      => 'post',
                'posts_per_page' => 4,
                'post__not_in'   => [$post['id'] > 0 ? $post['id'] : 0],
                'category__in'   => $current_cats,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC'
            ];
            $cat_query = new \WP_Query($cat_args);
            if ($cat_query->have_posts()) {
                while ($cat_query->have_posts()) {
                    $cat_query->the_post();
                    $latest_posts[] = [
                        'id'        => get_the_ID(),
                        'title'     => get_the_title(),
                        'permalink' => get_permalink(),
                        'date'      => get_the_date(),
                        'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: ''
                    ];
                }
                wp_reset_postdata();
            }
        }
        
        // 2. Fallback to general latest articles if less than 4 found
        if (count($latest_posts) < 4) {
            $exclude_ids = [$post['id'] > 0 ? $post['id'] : 0];
            foreach ($latest_posts as $lp) {
                $exclude_ids[] = $lp['id'];
            }
            
            $general_args = [
                'post_type'      => 'post',
                'posts_per_page' => 4 - count($latest_posts),
                'post__not_in'   => $exclude_ids,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC'
            ];
            $general_query = new \WP_Query($general_args);
            if ($general_query->have_posts()) {
                while ($general_query->have_posts()) {
                    $general_query->the_post();
                    $latest_posts[] = [
                        'id'        => get_the_ID(),
                        'title'     => get_the_title(),
                        'permalink' => get_permalink(),
                        'date'      => get_the_date(),
                        'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: ''
                    ];
                }
                wp_reset_postdata();
            }
        }
        
        // 3. Fallback to premium mock posts if database is empty (ensures UI is never blank)
        if (empty($latest_posts)) {
            $latest_posts = [
                [
                    'id'        => 1,
                    'title'     => __('Màn hình LED COB là gì? Tương lai của hiển thị nét cao', 'hacoled'),
                    'permalink' => '#',
                    'date'      => date('d/m/Y'),
                    'thumbnail' => 'https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?q=80&w=150&auto=format&fit=crop'
                ],
                [
                    'id'        => 2,
                    'title'     => __('Cách chọn công suất loa Line Array phù hợp cho hội trường', 'hacoled'),
                    'permalink' => '#',
                    'date'      => date('d/m/Y', strtotime('-2 days')),
                    'thumbnail' => 'https://images.unsplash.com/photo-1470229722913-7c090bf8c04c?q=80&w=150&auto=format&fit=crop'
                ],
                [
                    'id'        => 3,
                    'title'     => __('Xu hướng lắp đặt màn hình LED quảng cáo ngoài trời 2026', 'hacoled'),
                    'permalink' => '#',
                    'date'      => date('d/m/Y', strtotime('-5 days')),
                    'thumbnail' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=150&auto=format&fit=crop'
                ],
                [
                    'id'        => 4,
                    'title'     => __('Báo giá thi công trọn gói màn hình LED P2 trong nhà', 'hacoled'),
                    'permalink' => '#',
                    'date'      => date('d/m/Y', strtotime('-7 days')),
                    'thumbnail' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=150&auto=format&fit=crop'
                ]
            ];
        }
        ?>
        <div class="space-y-4">
          <?php foreach ($latest_posts as $lp): 
            $thumb = $lp['thumbnail'] ?: '';
          ?>
            <div class="flex items-center gap-3.5 group cursor-pointer" onclick="window.location.href='<?php echo esc_url($lp['permalink']); ?>'">
              <div class="w-20 aspect-video rounded-lg overflow-hidden border border-slate-200/80 bg-slate-50 shrink-0 relative shadow-sm">
                <?php if (!empty($thumb)): ?>
                  <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($lp['title']); ?>" class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-500">
                <?php else: ?>
                  <div class="w-full h-full bg-gradient-to-br from-slate-50 to-slate-100 flex items-center justify-center">
                    <i class="ph-bold ph-image text-slate-350 text-sm"></i>
                  </div>
                <?php endif; ?>
              </div>
              <div class="space-y-0.5 flex-1">
                <h4 class="text-xs font-bold text-slate-800 leading-snug group-hover:text-accent-red transition-colors line-clamp-2">
                  <a href="<?php echo esc_url($lp['permalink']); ?>"><?php echo esc_html($lp['title']); ?></a>
                </h4>
                <span class="text-[9px] font-mono text-slate-400 block"><?php echo esc_html($lp['date']); ?></span>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <?php 
        $widget_latest_content = ob_get_clean();

        $this->renderComponent('widget', [
            'title'   => __('Bài viết liên quan mới nhất', 'hacoled'),
            'content' => $widget_latest_content
        ]);
        ?>

        <!-- Sidebar Widget: Product Categories -->
        <?php 
        ob_start();
        
        $product_cats = [];
        if (taxonomy_exists('product_cat')) {
            $terms = get_terms([
                'taxonomy'   => 'product_cat',
                'orderby'    => 'count',
                'order'      => 'DESC',
                'hide_empty' => false,
                'number'     => 6
            ]);
            if (!is_wp_error($terms) && !empty($terms)) {
                foreach ($terms as $term) {
                    if (in_array($term->slug, ['uncategorized', 'chua-phan-loai'])) continue;
                    $product_cats[] = [
                        'name'  => $term->name,
                        'link'  => get_term_link($term),
                        'count' => $term->count
                    ];
                }
            }
        }
        
        // Premium fallback product categories if empty in DB
        if (empty($product_cats)) {
            $product_cats = [
                ['name' => 'Màn hình LED trong nhà', 'link' => home_url('/danh-muc/man-hinh-led-trong-nha/'), 'count' => 18],
                ['name' => 'Màn hình LED ngoài trời', 'link' => home_url('/danh-muc/man-hinh-led-ngoai-troi/'), 'count' => 12],
                ['name' => 'Màn hình LED hội trường', 'link' => home_url('/danh-muc/man-hinh-led-hoi-truong/'), 'count' => 8],
                ['name' => 'Màn hình LED quảng cáo', 'link' => home_url('/danh-muc/man-hinh-led-quang-cao/'), 'count' => 15],
                ['name' => 'Bộ xử lý hình ảnh LED', 'link' => home_url('/danh-muc/bo-xu-ly-hinh-anh-led/'), 'count' => 9],
                ['name' => 'Âm thanh phòng họp', 'link' => home_url('/danh-muc/am-thanh-phong-hop/'), 'count' => 6]
            ];
        }
        ?>
        <ul class="space-y-3 text-xs font-bold text-slate-700">
          <?php foreach ($product_cats as $cat): ?>
            <li>
              <a href="<?php echo esc_url($cat['link']); ?>" class="flex items-center justify-between hover:text-accent-red transition-all duration-300 group py-0.5">
                <span class="flex items-center gap-2">
                  <span class="w-1.5 h-1.5 rounded-full bg-slate-300 group-hover:bg-accent-red transition-colors shrink-0"></span>
                  <span class="group-hover:translate-x-0.5 transition-transform duration-300 text-slate-700 group-hover:text-accent-red"><?php echo esc_html($cat['name']); ?></span>
                </span>
                <span class="text-[9px] font-mono bg-slate-100 text-slate-500 px-2 py-0.5 rounded-md border border-slate-200/60 group-hover:bg-accent-red group-hover:text-white group-hover:border-transparent transition-all duration-300">
                  <?php echo esc_html($cat['count']); ?>
                </span>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
        <?php
        $widget_categories_content = ob_get_clean();
        
        $this->renderComponent('widget', [
            'title'   => __('Danh mục sản phẩm', 'hacoled'),
            'content' => $widget_categories_content
        ]);
        ?>

        <!-- Sidebar Widget: Tech Consulting CTA -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#4A0505] to-primary p-6 border border-white/10 text-white shadow-xl shadow-red-950/15 group">
          <div class="absolute -right-12 -bottom-12 w-36 h-36 bg-accent-gold/10 rounded-full blur-2xl pointer-events-none group-hover:scale-110 transition-transform duration-500"></div>
          <div class="relative z-10 space-y-4">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded bg-accent-gold/90 text-[9px] font-extrabold text-primary-dark tracking-wider uppercase font-mono">
              <?php _e('TƯ VẤN THI CÔNG', 'hacoled'); ?>
            </span>
            <h3 class="text-sm font-extrabold leading-snug uppercase">
              <?php _e('Giải pháp màn hình LED & AV Pro', 'hacoled'); ?>
            </h3>
            <p class="text-[10px] text-slate-350 leading-relaxed font-light">
              <?php _e('Khảo sát thực địa và thiết kế phối cảnh 3D màn hình LED, âm thanh phòng họp hoàn toàn miễn phí.', 'hacoled'); ?>
            </p>
            <div class="pt-2">
              <a href="<?php echo esc_url(home_url('/lien-he/')); ?>" class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-accent-gold to-yellow-500 hover:from-yellow-500 hover:to-accent-gold text-primary-dark font-extrabold text-[10px] uppercase tracking-wider py-3 rounded-xl shadow-lg transition-all duration-300">
                <span><?php _e('Liên hệ khảo sát ngay', 'hacoled'); ?></span>
                <i class="ph-bold ph-arrow-right text-[9px]"></i>
              </a>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</main>

<?php
// Render footer
$this->renderFooter($footer_type ?? 'default');
?>
