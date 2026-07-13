<?php
namespace HacoLED\Theme\Controllers;

use HacoLED\Theme\Core\Controller;
use HacoLED\Theme\Repositories\CatalogRepository;
use WP_Term;

/**
 * Presents WooCommerce product-category taxonomy archives.
 */
class ProductCategoryController extends Controller {
    public function index() {
        $term = get_queried_object();
        $term = $term instanceof WP_Term ? $term : null;
        $catalog = new CatalogRepository();

        $this->render('catalog/category', [
            'current_term'          => $term,
            'category_name'         => $term ? $term->name : __('Danh mục sản phẩm', 'hacoled'),
            'description'           => $term ? $term->description : '',
            'navigation_categories' => $catalog->categoryNavigation($term),
            'breadcrumbs'           => $catalog->breadcrumbs($term),
            'featured_projects'     => $catalog->featuredProjects(),
            'latest_articles'       => $catalog->latestArticles(),
            'header_type'           => 'default',
            'footer_type'           => 'default',
        ]);
    }
}
