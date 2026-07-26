<?php
/**
 * Privileges Card Component (Đặc Quyền Dịch Vụ - Premium Red & Gold Trống Đồng)
 *
 * Usage:
 * get_template_part('views/components/privileges-card', null, [
 *     'title'         => 'Đặc Quyền Dịch Vụ',
 *     'subtitle'      => 'Dẫn đầu thị trường',
 *     'commitments'   => ['Hàng chính hãng 100% (CO/CQ)', 'Nguồn gốc xuất xứ rõ ràng', 'Giá cạnh tranh nhất thị trường'],
 *     'perks'         => ['Bảo hành chính hãng 24 – 36 tháng', 'Tư vấn kỹ thuật MIỄN PHÍ 24/7', 'Khảo sát hiện trạng & vẽ 3D miễn phí'],
 *     'package_title' => 'Trọn bộ thiết bị',
 *     'package_desc'  => 'Module LED nhập khẩu cao cấp, Video Processor chuyên dụng, Khung nhôm định hình, Nguồn & cáp tín hiệu đồng bộ.'
 * ]);
 *
 * @var array $args Passed arguments
 */

$title         = $args['title'] ?? __('Đặc Quyền Dịch Vụ', 'hacoled');
$subtitle      = $args['subtitle'] ?? __('Dẫn đầu thị trường', 'hacoled');
$commitments   = $args['commitments'] ?? [
    __('Hàng chính hãng 100% (CO/CQ)', 'hacoled'),
    __('Nguồn gốc xuất xứ rõ ràng', 'hacoled'),
    __('Giá cạnh tranh nhất thị trường', 'hacoled'),
];
$perks         = $args['perks'] ?? [
    __('Bảo hành chính hãng 24 – 36 tháng', 'hacoled'),
    __('Tư vấn kỹ thuật MIỄN PHÍ 24/7', 'hacoled'),
    __('Khảo sát hiện trạng & vẽ 3D miễn phí', 'hacoled'),
];
$package_title = $args['package_title'] ?? __('Trọn bộ thiết bị', 'hacoled');
$package_desc  = $args['package_desc'] ?? __('Module LED nhập khẩu cao cấp, Video Processor chuyên dụng, Khung nhôm định hình, Nguồn & cáp tín hiệu đồng bộ.', 'hacoled');
$class         = $args['class'] ?? '';
?>

<!-- PRIVILEGES CARD — Premium Vibrant Red & Gold (Trống Đồng Đông Sơn) -->
<div class="sp-privileges-card relative rounded-2xl p-5 md:p-6 lg:p-7 mb-6 overflow-hidden <?php echo esc_attr($class); ?>">
    <!-- Gold mat inner frame -->
    <div class="sp-priv-red-mat"></div>

    <!-- Trống đồng Đông Sơn image pattern (header brand asset) -->
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-0 overflow-hidden">
        <div class="w-[440px] h-[440px] md:w-[540px] md:h-[540px] bg-no-repeat bg-center bg-contain opacity-20"
             style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/dongson-optimized.webp'); ?>'); filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%);"></div>
    </div>

    <!-- Base background gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-[#a8031d] via-[#d90429] to-[#65000f] -z-10"></div>
    <!-- Gold radial ambient glow -->
    <div class="absolute inset-0 -z-10 opacity-30" style="background:radial-gradient(ellipse at 50% 0%, rgba(255,215,0,.35), transparent 65%);"></div>
    <!-- Gold glow orbs -->
    <div class="absolute -top-16 -right-10 w-56 h-56 bg-[#FFD700] rounded-full opacity-[0.12] blur-[60px] pointer-events-none"></div>
    <div class="absolute -bottom-16 -left-10 w-44 h-44 bg-[#FFA500] rounded-full opacity-[0.10] blur-[50px] pointer-events-none"></div>
    <!-- Glossy sweep -->
    <div class="absolute inset-0 sp-priv-gloss pointer-events-none"></div>
    <!-- Top specular hairline -->
    <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/50 to-transparent"></div>

    <!-- Header -->
    <div class="flex items-center gap-3.5 mb-2 relative z-10">
        <div class="w-11 h-11 md:w-12 md:h-12 rounded-xl flex items-center justify-center text-[#3a1f05] shadow-lg shrink-0"
             style="background:linear-gradient(135deg,#ffffff,#ffe89c 45%,#ffd700 70%,#d49214); box-shadow: 0 4px 14px rgba(0,0,0,.35), inset 0 1px 1px rgba(255,255,255,.8);">
            <i class="ph-bold ph-crown text-xl text-[#851800]"></i>
        </div>
        <div>
            <h3 class="sp-priv-gold-text font-extrabold text-base md:text-lg tracking-[0.1em] uppercase"><?php echo esc_html($title); ?></h3>
            <?php if (!empty($subtitle)): ?>
                <p class="text-[11px] md:text-xs text-[#FFF3D1] font-semibold mt-0.5 tracking-wide"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <div class="sp-priv-gold-hairline sp-priv-shimmer mb-5 relative z-10"></div>

    <!-- 2 Columns -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 lg:gap-6 relative z-10">
        <!-- Cam kết vàng -->
        <?php if (!empty($commitments)): ?>
        <div>
            <h4 class="text-xs lg:text-sm font-bold text-[#FFE8A3] uppercase tracking-wider mb-3 flex items-center gap-2.5">
                <span class="w-7 h-7 rounded-lg flex items-center justify-center border border-[#FFD700]/40 bg-[#000000]/20 shadow-sm">
                    <i class="ph-bold ph-shield-check text-[#FFD700] text-sm"></i>
                </span>
                Cam kết vàng
            </h4>
            <ul class="space-y-2.5">
                <?php foreach ($commitments as $item): ?>
                    <li class="flex items-start gap-2.5 text-white/95 hover:text-white transition-colors">
                        <i class="ph-bold ph-check-circle text-[#FFD700] text-base mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm leading-snug font-medium"><?php echo esc_html($item); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <!-- Ưu đãi lớn -->
        <?php if (!empty($perks)): ?>
        <div class="md:pl-6 md:border-l md:border-[#FFD700]/25">
            <h4 class="text-xs lg:text-sm font-bold text-[#FFE8A3] uppercase tracking-wider mb-3 flex items-center gap-2.5">
                <span class="w-7 h-7 rounded-lg flex items-center justify-center border border-[#FFD700]/40 bg-[#000000]/20 shadow-sm">
                    <i class="ph-bold ph-gift text-[#FFD700] text-sm"></i>
                </span>
                Ưu đãi lớn
            </h4>
            <ul class="space-y-2.5">
                <?php foreach ($perks as $item): ?>
                    <li class="flex items-start gap-2.5 text-white/95 hover:text-white transition-colors">
                        <i class="ph-bold ph-star text-[#FFD700] text-base mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm leading-snug font-medium"><?php echo esc_html($item); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>
    </div>

    <!-- Trọn bộ thiết bị -->
    <?php if (!empty($package_title) || !empty($package_desc)): ?>
    <div class="mt-5 pt-4 relative z-10">
        <div class="sp-priv-gold-hairline mb-3.5"></div>
        <?php if (!empty($package_title)): ?>
        <h4 class="text-xs lg:text-sm font-bold text-[#FFE8A3] uppercase tracking-wider mb-2 flex items-center gap-2.5">
            <span class="w-7 h-7 rounded-lg flex items-center justify-center border border-[#FFD700]/40 bg-[#000000]/20 shadow-sm">
                <i class="ph-bold ph-package text-[#FFD700] text-sm"></i>
            </span>
            <?php echo esc_html($package_title); ?>
        </h4>
        <?php endif; ?>
        <?php if (!empty($package_desc)): ?>
        <div class="rounded-xl p-3 lg:p-3.5 border border-[#FFD700]/30 shadow-inner" style="background: rgba(0, 0, 0, 0.22);">
            <p class="text-xs lg:text-sm text-white/90 leading-relaxed font-medium">
                <?php echo esc_html($package_desc); ?>
            </p>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>
