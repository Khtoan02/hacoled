<?php
/**
 * Common Blog Category Archive View
 *
 * @var string $category_name
 * @var string $description
 * @var array  $posts
 * @var string $header_type
 * @var string $footer_type
 */

$this->renderHeader($header_type ?? 'default');
?>

<main class="relative bg-[#FAFAFA] pt-28 md:pt-48 pb-20 min-h-[70vh] overflow-hidden" data-tech-bg="circuit">
  <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10">
    
    <!-- Category Info -->
    <div class="mb-12">
      <span class="text-xs font-bold text-accent-red uppercase tracking-widest block mb-2"><?php _e('Danh mục bài viết', 'hacoled'); ?></span>
      <h1 class="text-3xl sm:text-5xl font-extrabold text-slate-900 tracking-tight">
        <?php echo esc_html($category_name); ?>
      </h1>
      <?php if (!empty($description)): ?>
        <p class="text-slate-600 mt-4 max-w-3xl text-sm leading-relaxed"><?php echo esc_html($description); ?></p>
      <?php endif; ?>
    </div>

    <!-- Posts Loop -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $post_item): ?>
          <?php $this->renderComponent('blog-card', $post_item); ?>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-slate-500 col-span-full"><?php _e('Không có bài viết nào trong danh mục này.', 'hacoled'); ?></p>
      <?php endif; ?>
    </div>

  </div>
</main>

<?php
$this->renderFooter($footer_type ?? 'default');
?>
