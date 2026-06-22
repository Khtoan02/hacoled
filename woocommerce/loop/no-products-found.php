<?php
/**
 * Displayed when no products are found matching the current query
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/no-products-found.php.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-no-products-found bg-white rounded-2xl border border-slate-100 shadow-sm p-10 md:p-14 text-center my-4">
    <div class="max-w-md mx-auto">
        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
            <i class="ph-bold ph-shopping-bag-open text-3xl text-slate-400"></i>
        </div>
        <h3 class="text-lg font-extrabold text-slate-900 mb-2">Chưa có sản phẩm nào</h3>
        <p class="text-xs text-slate-500 leading-relaxed mb-6">
            Danh mục sản phẩm này hiện tại chưa có sản phẩm hiển thị. Chúng tôi đang cập nhật các thiết bị công nghệ mới nhất. Quý khách vui lòng tham khảo các danh mục khác hoặc liên hệ hotline để được tư vấn nhanh nhất.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
               class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs uppercase tracking-wider rounded-xl transition-all w-full sm:w-auto">
                <i class="ph-bold ph-arrow-left"></i>
                <span>Xem danh mục khác</span>
            </a>
            <a href="tel:0932678910" 
               class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-[#D90429] hover:bg-[#b90323] text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-red-500/10 transition-all w-full sm:w-auto">
                <i class="ph-bold ph-phone"></i>
                <span>Hotline 0932.678.910</span>
            </a>
        </div>
    </div>
</div>
