<?php
/**
 * Common Static Page Template View
 *
 * @var array  $page
 * @var string $header_type
 * @var string $footer_type
 */

// Render header
$this->renderHeader($header_type ?? 'default');
?>

<main class="relative bg-[#FAFAFA] pt-28 md:pt-48 pb-20 min-h-[70vh] overflow-hidden" data-tech-bg="circuit">
  
  <!-- Subtle back lights -->
  <div class="absolute top-[20%] left-[-10%] w-[350px] h-[350px] rounded-full bg-accent-red/5 blur-[100px] pointer-events-none"></div>

  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    
    <!-- Breadcrumbs / Top Indicator -->
    <div class="mb-4 text-xs font-semibold text-slate-450 uppercase tracking-widest flex items-center gap-2">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-accent-red transition-colors"><?php _e('Trang chủ', 'hacoled'); ?></a>
      <span>/</span>
      <span class="text-slate-600"><?php echo esc_html($page['title']); ?></span>
    </div>

    <!-- Featured Header Image -->
    <?php if (!empty($page['thumbnail'])): ?>
      <div class="w-full h-64 md:h-[400px] rounded-2xl overflow-hidden border border-slate-200/80 mb-10">
        <img src="<?php echo esc_url($page['thumbnail']); ?>" alt="<?php echo esc_attr($page['title']); ?>" class="w-full h-full object-cover">
      </div>
    <?php endif; ?>

    <!-- Title -->
    <h1 class="text-3xl sm:text-5xl font-extrabold text-slate-900 mb-8 tracking-tight">
      <?php echo esc_html($page['title']); ?>
    </h1>

    <!-- Article Content -->
    <article class="prose prose-slate max-w-none text-slate-600 leading-relaxed space-y-6">
      <?php 
      // Apply wordpress default content formatting filter
      echo apply_filters('the_content', $page['content']); 
      ?>
    </article>

  </div>
</main>

<?php
// Render footer
$this->renderFooter($footer_type ?? 'default');
?>
