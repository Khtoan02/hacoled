<?php
defined('ABSPATH') || exit;

$this->renderHeader($header_type ?? 'default');
?>

<main id="primary" class="min-h-[70vh] flex items-center justify-center px-4 py-24 bg-slate-50">
    <section class="max-w-2xl mx-auto text-center" aria-labelledby="not-found-title">
        <p class="text-sm font-bold tracking-[0.25em] uppercase text-[#D90429] mb-4"><?php esc_html_e('Lỗi 404', 'hacoled'); ?></p>
        <h1 id="not-found-title" class="text-4xl md:text-6xl font-black text-slate-900 mb-6">
            <?php esc_html_e('Không tìm thấy trang', 'hacoled'); ?>
        </h1>
        <p class="text-base md:text-lg text-slate-600 leading-relaxed mb-8">
            <?php esc_html_e('Nội dung bạn đang tìm có thể đã được di chuyển hoặc không còn tồn tại.', 'hacoled'); ?>
        </p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-[#D90429] text-white font-bold hover:bg-[#b90323] transition-colors">
            <?php esc_html_e('Quay về trang chủ', 'hacoled'); ?>
        </a>
    </section>
</main>

<?php $this->renderFooter($footer_type ?? 'default'); ?>
