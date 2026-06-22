<?php
/**
 * WooCommerce Single Product Detail View
 *
 * @var string $header_type
 * @var string $footer_type
 */

$this->renderHeader($header_type ?? 'default');
?>

<!-- Swiper Slider Library -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<main class="relative bg-[#FAFAFA] pt-52 lg:pt-60 pb-20 min-h-[80vh] bg-tech-grid overflow-hidden" data-tech-bg="circuit">
  <div class="max-w-[1440px] mx-auto px-4 lg:px-8 relative z-10">

    <!-- WooCommerce before main content hooks (breadcrumbs, alerts) -->
    <div class="text-slate-500 mb-6 text-xs wc-breadcrumbs-wrapper">
      <?php do_action('woocommerce_before_main_content'); ?>
    </div>

    <!-- WooCommerce Single Product Detail Container -->
    <div class="woocommerce-content-container text-slate-800 mt-2">
      <?php 
      // Main WooCommerce single product display, gallery, reviews, tabs, add to cart
      woocommerce_content(); 
      ?>
    </div>

    <!-- WooCommerce after main content hooks -->
    <div class="mt-8">
      <?php do_action('woocommerce_after_main_content'); ?>
    </div>

  </div>
</main>

<?php
$this->renderFooter($footer_type ?? 'default');
?>
