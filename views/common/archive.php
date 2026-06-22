<?php
/**
 * Common Blog Archive List View
 *
 * @var string $title
 * @var array  $posts
 * @var string $header_type
 * @var string $footer_type
 */

$this->renderHeader($header_type ?? 'default');
?>

<main class="relative bg-[#FAFAFA] pt-28 md:pt-48 pb-20 min-h-[70vh] overflow-hidden" data-tech-bg="circuit">
  <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10">
    
    <!-- Title -->
    <h1 class="text-3xl sm:text-5xl font-extrabold text-slate-900 mb-8 tracking-tight">
      <?php echo esc_html($title); ?>
    </h1>

    <!-- Posts Loop -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <?php if (!empty($posts)): ?>
        <?php foreach ($posts as $post_item): ?>
          <?php $this->renderComponent('blog-card', $post_item); ?>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-slate-500 col-span-full"><?php _e('Không tìm thấy bài viết nào.', 'hacoled'); ?></p>
      <?php endif; ?>
    </div>

  </div>
</main>

<?php
$this->renderFooter($footer_type ?? 'default');
?>
