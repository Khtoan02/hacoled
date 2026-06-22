<?php
namespace App\Controllers;

use App\Core\Controller;

/**
 * Controller handling WooCommerce integrations (Products, Shop, and Catalog Category archives)
 */
class ProductController extends Controller {
    /**
     * Main Product Shop Page Listing
     */
    public function shop() {
        $this->render('woocommerce/archive-product', [
            'title'       => woocommerce_page_title(false),
            'header_type' => 'default',
            'footer_type' => 'default'
        ]);
    }

    /**
     * Product Category list (supports parent or subcategories archives identically)
     */
    public function category() {
        $current_term = get_queried_object();

        $this->render('woocommerce/taxonomy-product_cat', [
            'category_name' => $current_term ? $current_term->name : __('Danh mục sản phẩm', 'hacoled'),
            'description'   => $current_term ? $current_term->description : '',
            'header_type'   => 'default',
            'footer_type'   => 'default'
        ]);
    }

    /**
     * Single Product Details page
     */
    public function detail() {
        $this->render('woocommerce/single-product', [
            'header_type' => 'default',
            'footer_type' => 'default'
        ]);
    }
}
