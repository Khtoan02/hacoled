<?php
namespace HacoLED\Theme\Controllers;

use HacoLED\Theme\Core\Controller;
use HacoLED\Theme\Repositories\CatalogRepository;

/**
 * Controller handling WooCommerce integrations (Products, Shop, and Catalog Category archives)
 */
class ProductController extends Controller {
    /**
     * Main Product Shop Page Listing
     */
    public function shop() {
        $catalog = new CatalogRepository();
        $this->render('catalog/archive', [
            'title'                 => woocommerce_page_title(false),
            'navigation_categories' => $catalog->topLevelCategories(),
            'shop_description'      => $catalog->shopDescription(),
            'featured_projects'     => $catalog->featuredProjects(),
            'header_type'           => 'default',
            'footer_type'           => 'default',
        ]);
    }

    /**
     * Single Product Details page
     */
    public function detail() {
        $this->render('catalog/product', [
            'header_type' => 'default',
            'footer_type' => 'default'
        ]);
    }
}
