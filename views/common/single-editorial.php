<?php
/**
 * Editorial layout for an individually selected WordPress post.
 *
 * @var array  $post
 * @var string $header_type
 * @var string $footer_type
 */

defined('ABSPATH') || exit;

$this->renderHeader($header_type ?? 'default');
$hero_style = !empty($post['thumbnail'])
    ? 'background-image: linear-gradient(90deg, rgba(2,6,23,.96), rgba(2,6,23,.68)), url(' . esc_url($post['thumbnail']) . ');'
    : '';
?>

<main class="min-h-[80vh] bg-white pt-28 md:pt-64">
    <header class="bg-slate-950 bg-cover bg-center text-white" style="<?php echo esc_attr($hero_style); ?>">
        <div class="mx-auto max-w-5xl px-4 py-20 text-center sm:px-6 lg:py-32">
            <?php if (!empty($post['categories'])) : ?>
                <div class="mb-6 flex flex-wrap justify-center gap-2">
                    <?php foreach ($post['categories'] as $category) : ?>
                        <a href="<?php echo esc_url($category['link']); ?>" class="rounded-full border border-amber-300/30 bg-amber-300/10 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-amber-300">
                            <?php echo esc_html($category['name']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <h1 class="text-4xl font-black leading-tight sm:text-6xl"><?php echo esc_html($post['title']); ?></h1>
            <div class="mt-7 text-sm text-slate-300">
                <?php echo esc_html($post['date']); ?>
                <span class="mx-2">•</span>
                <?php echo esc_html($post['author']); ?>
            </div>
        </div>
    </header>

    <article class="prose prose-slate mx-auto max-w-4xl px-4 py-16 sm:px-6 lg:py-24">
        <?php echo wp_kses_post(apply_filters('the_content', $post['content'])); ?>
    </article>
</main>

<?php $this->renderFooter($footer_type ?? 'default'); ?>
