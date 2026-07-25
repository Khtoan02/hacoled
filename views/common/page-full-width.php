<?php
/**
 * Full-width layout for an individually selected WordPress page.
 *
 * @var array  $page
 * @var string $header_type
 * @var string $footer_type
 */

defined('ABSPATH') || exit;

$this->renderHeader($header_type ?? 'default');
?>

<main class="min-h-[75vh] bg-white pt-32 md:pt-56">
    <header class="border-b border-slate-200 bg-slate-950 text-white">
        <div class="mx-auto max-w-[1440px] px-4 py-14 lg:px-8 lg:py-20">
            <nav class="mb-5 text-xs font-semibold uppercase tracking-widest text-slate-400">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="transition hover:text-white"><?php echo esc_html__('Trang chủ', 'hacoled'); ?></a>
                <span class="mx-2">/</span>
                <span class="text-amber-300"><?php echo esc_html($page['title']); ?></span>
            </nav>
            <h1 class="max-w-5xl text-4xl font-black leading-tight sm:text-6xl">
                <?php echo esc_html($page['title']); ?>
            </h1>
        </div>
    </header>

    <?php if (!empty($page['thumbnail'])) : ?>
        <div class="mx-auto -mb-10 max-w-[1440px] px-4 pt-10 lg:px-8">
            <img src="<?php echo esc_url($page['thumbnail']); ?>" alt="<?php echo esc_attr($page['title']); ?>" class="max-h-[680px] w-full rounded-3xl object-cover shadow-xl">
        </div>
    <?php endif; ?>

    <article class="prose prose-slate mx-auto max-w-[1440px] px-4 py-16 lg:px-8 lg:py-24">
        <?php echo wp_kses_post(apply_filters('the_content', $page['content'])); ?>
    </article>
</main>

<?php $this->renderFooter($footer_type ?? 'default'); ?>
