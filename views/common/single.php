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

<main class="relative bg-[#FAFAFA] pt-28 md:pt-64 pb-20 min-h-[85vh] overflow-visible"
      x-data="{ percent: 0, lightboxOpen: false, lightboxImage: '' }" @scroll.window="percent = (window.pageYOffset / (document.documentElement.scrollHeight - window.innerHeight)) * 100">
  
  <!-- Reading Progress Bar -->
  <div class="fixed top-0 left-0 right-0 h-[3px] bg-slate-200/50 z-[999] pointer-events-none">
    <div class="h-full bg-gradient-to-r from-accent-red to-accent-gold transition-all duration-75" :style="'width: ' + percent + '%'"></div>
  </div>
  
  <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
      
      <!-- MAIN CONTENT COLUMN (75%) -->
      <div class="lg:col-span-9 min-w-0 bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-10 shadow-sm space-y-6">
        
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
        <div>
          <style>
            /* Polish Article Images & Prevent skewing */
            .prose-custom img {
              display: block;
              margin-left: auto;
              margin-right: auto;
              max-width: 100%;
              height: auto !important; /* Force proportional height */
              border-radius: 12px;
              box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
              cursor: zoom-in;
              transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.2s ease;
            }
            .prose-custom img:hover {
              transform: scale(1.015);
              opacity: 0.95;
            }
            /* Style for WordPress image captions */
            .prose-custom .wp-caption {
              max-width: 100% !important;
              margin: 1.5rem auto !important;
              text-align: center;
              background-color: #f8fafc;
              padding: 8px;
              border-radius: 14px;
              border: 1px solid #f1f5f9;
            }
            .prose-custom .wp-caption img {
              margin-bottom: 6px;
            }
            .prose-custom .wp-caption-text {
              font-size: 12px !important;
              color: #64748b !important;
              margin: 4px 0 0 0 !important;
              font-style: italic;
              line-height: 1.5;
            }
          </style>

          <article class="prose-custom text-slate-650 leading-relaxed pt-2"
                   @click="
                     if ($event.target.tagName === 'IMG') {
                       lightboxImage = $event.target.src;
                       lightboxOpen = true;
                     }
                   ">
            <?php 
            echo apply_filters('the_content', $post['content']); 
            ?>
          </article>

          <!-- Lightbox Modal -->
          <div x-show="lightboxOpen" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" 
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" 
            x-transition:leave-end="opacity-0"
            x-cloak 
            class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/85 backdrop-blur-md p-4" 
            @click="lightboxOpen = false" 
            @keydown.escape.window="lightboxOpen = false">
            
            <!-- Close button -->
            <button class="absolute top-6 right-6 text-white/80 hover:text-white text-3xl focus:outline-none transition-colors" @click="lightboxOpen = false">
              <i class="ph-bold ph-x"></i>
            </button>
            
            <!-- Image container with scale transition -->
            <div class="relative max-w-full max-h-full flex items-center justify-center"
              x-show="lightboxOpen"
              x-transition:enter="transition ease-out duration-300 transform"
              x-transition:enter-start="scale-95"
              x-transition:enter-end="scale-100"
              x-transition:leave="transition ease-in duration-200 transform"
              x-transition:leave-start="scale-100"
              x-transition:leave-end="scale-95">
              <img :src="lightboxImage" class="max-w-full max-h-[90vh] rounded-xl shadow-2xl object-contain border border-white/10" @click.stop />
            </div>
          </div>

          <!-- Post Category FAQ Section -->
          <?php
          $catalog_repo = new \HacoLED\Theme\Repositories\CatalogRepository();
          $faq = ['title' => '', 'intro' => '', 'items' => []];
          $post_id = $post['id'] ?? get_the_ID();
          
          // 1. Prioritize Post-specific FAQ configured on the edit screen
          $post_faq_items = get_post_meta($post_id, 'post_faq_items', true);
          if (is_array($post_faq_items) && !empty($post_faq_items)) {
              $faq = [
                  'title' => get_post_meta($post_id, 'post_faq_title', true) ?: '',
                  'intro' => get_post_meta($post_id, 'post_faq_intro', true) ?: '',
                  'items' => $post_faq_items,
              ];
          } else {
              // 2. Fallback to Post Category FAQ
              $post_terms = wp_get_post_terms( $post_id, 'category' );
              if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
                  $primary_term = $post_terms[0];
                  $faq = $catalog_repo->categoryFaq( $primary_term );
              }
          }
          if ( ! empty( $faq['items'] ) ) :
          ?>
              <div class="mt-12 pt-8 border-t border-slate-100 space-y-4">
                <div class="flex flex-col gap-1 mb-6">
                  <h3 class="text-sm font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                    <i class="ph-bold ph-question text-[#D90429] text-base"></i>
                    <span><?php echo esc_html(!empty($faq['title']) ? $faq['title'] : __('Câu hỏi thường gặp', 'hacoled')); ?></span>
                  </h3>
                  <?php if (!empty($faq['intro'])): ?>
                    <p class="text-xs text-slate-500 leading-relaxed mt-1"><?php echo wp_kses_post($faq['intro']); ?></p>
                  <?php endif; ?>
                </div>
                
                <div class="space-y-4">
                  <?php foreach ($faq['items'] as $index => $faqItem): ?>
                    <details class="group rounded-2xl border border-slate-200/80 bg-slate-50/40 p-5 transition-all duration-300 open:border-[#D90429]/30 open:bg-white open:shadow-[0_15px_30px_rgba(217,4,41,0.03)]"
                      <?php echo $index === 0 ? 'open' : ''; ?>>
                      <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-xs font-bold text-slate-850 transition-colors hover:text-[#D90429] group-open:text-[#D90429] [&_::-webkit-details-marker]:hidden">
                        <span><?php echo esc_html($faqItem['question']); ?></span>
                        <i class="ph-bold ph-caret-down text-slate-500 transition-transform duration-300 group-open:text-[#D90429] group-open:rotate-180 text-xs"></i>
                      </summary>
                      <div class="border-t border-slate-100 mt-4 pt-4 text-[11px] leading-relaxed text-slate-600 prose prose-slate max-w-none">
                        <?php echo wp_kses_post($faqItem['answer']); ?>
                      </div>
                    </details>
                  <?php endforeach; ?>
                </div>
              </div>
          <?php endif; ?>

        </div>

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



      </div>

      <!-- SIDEBAR COLUMN (25%) -->
      <div class="lg:col-span-3 self-stretch">
        <div class="space-y-6 lg:sticky lg:top-32 lg:z-20 w-full pb-12">
        
        <!-- Sidebar Widget: Hotline Contact -->
        <?php $this->renderComponent('widgets/hotline'); ?>

        <!-- Sidebar Widget: Table of Contents -->
        <div x-data="{ 
            headings: [], 
            activeId: '',
            init() {
              setTimeout(() => {
                const els = Array.from(document.querySelectorAll('article h2, article h3'));
                this.headings = els.map((el, i) => {
                  if (!el.id) el.id = 'heading-' + i;
                  return { text: el.innerText, id: el.id, level: el.tagName.toLowerCase() };
                });
                
                // Track active heading during scroll
                const observer = new IntersectionObserver((entries) => {
                  entries.forEach(entry => {
                    if (entry.isIntersecting) {
                      this.activeId = entry.target.id;
                    }
                  });
                }, { rootMargin: '-100px 0px -60% 0px' });
                
                els.forEach(el => observer.observe(el));
              }, 200);
            }
        }" class="rounded-2xl bg-white border border-slate-200/80 p-6 space-y-4 shadow-sm">
          <div class="relative pb-3 border-b border-slate-100">
            <!-- Thin elegant red accent line for brand identity -->
            <div class="absolute bottom-0 left-0 w-12 h-[2px] bg-accent-red"></div>
            <h3 class="text-xs font-black uppercase tracking-widest text-slate-900">
              <?php _e('Mục lục nội dung', 'hacoled'); ?>
            </h3>
          </div>
          
          <div class="text-xs text-slate-650 leading-relaxed pl-1">
            <!-- TOC Timeline List -->
            <ul x-show="headings.length > 0" class="relative pl-3 border-l-2 border-slate-100 space-y-3" x-cloak>
              <template x-for="h in headings" :key="h.id">
                <li class="relative transition-all duration-200"
                    :class="h.level === 'h3' ? 'pl-4' : ''">
                  <!-- Timeline Node Dot -->
                  <span class="absolute -left-[17px] top-[7px] w-2 h-2 rounded-full border-2 border-white transition-all duration-300"
                        :class="activeId === h.id ? 'bg-[#D90429] scale-125 shadow-md shadow-red-200 z-10' : 'bg-slate-300'"></span>
                  
                  <a :href="'#' + h.id" 
                     @click.prevent="
                       const el = document.getElementById(h.id);
                       if (el) {
                         window.scrollTo({ top: el.getBoundingClientRect().top + window.scrollY - 150, behavior: 'smooth' });
                       }
                     "
                     class="block hover:text-[#D90429] transition-colors leading-relaxed"
                     :class="activeId === h.id ? 'text-[#D90429] font-black text-[11.5px]' : (h.level === 'h2' ? 'text-slate-800 font-bold text-[11px]' : 'text-slate-500 font-medium text-[10.5px]')">
                    <span x-text="h.text" class="line-clamp-2"></span>
                  </a>
                </li>
              </template>
            </ul>
            
            <!-- Fallback placeholder when no headings -->
            <div x-show="headings.length === 0" class="space-y-2 py-1 text-slate-500 font-light" x-cloak>
              <p><?php _e('Bài viết đang cập nhật mục lục chi tiết. Vui lòng cuộn xuống để theo dõi toàn bộ nội dung.', 'hacoled'); ?></p>
              <div class="flex items-center gap-1.5 text-accent-red font-semibold text-[10px] uppercase tracking-wider mt-3">
                <span><?php _e('Xem chi tiết bên dưới', 'hacoled'); ?></span>
                <i class="ph-bold ph-arrow-down animate-bounce"></i>
              </div>
            </div>
          </div>
        </div>



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



      </div>
    </div>

    </div>

    <!-- Related Posts Section (Full Width 1440px) -->
    <?php
    if ($post['id'] > 0):
      $categories = wp_get_post_categories($post['id']);
      if (!empty($categories)):
        $related_args = [
            'category__in'   => $categories,
            'post__not_in'   => [$post['id']],
            'posts_per_page' => 4,
            'orderby'        => 'rand'
        ];
        $related_query = new \WP_Query($related_args);
        if ($related_query->have_posts()):
      ?>
        <div class="mt-16 pt-12 border-t border-gray-200/80 space-y-6">
          <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest flex items-center gap-2 pb-3">
            <span class="w-2.5 h-2.5 rounded-full bg-accent-red animate-pulse"></span>
            <?php _e('Bài viết liên quan', 'hacoled'); ?>
          </h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
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
</main>

<?php
// Render footer
$this->renderFooter($footer_type ?? 'default');
?>
