<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\PostModel;
use App\Models\LedScreenModel;

/**
 * Controller handling Homepage routing and data queries
 */
class HomeController extends Controller {
    /**
     * Index action for Homepage
     */
    public function index() {
        // Fetch 3 latest posts
        $posts = PostModel::get_latest_posts(3);
        
        // Fetch 4 featured LED screen products
        $products = LedScreenModel::get_products(4);

        // Render homepage with custom configurations
        $this->render('pages/home', [
            'title'             => __('Haco LED - Màn hình LED trình chiếu thông minh', 'hacoled'),
            'tagline'           => __('Giải pháp hiển thị kỹ thuật số đỉnh cao, thiết kế & thi công chuyên nghiệp.', 'hacoled'),
            'designer'          => 'Khánh Toàn',
            'designer_contact'  => 'https://facebook.com/khanhtoan678',
            'products'          => $products,
            'posts'             => $posts,
            'header_type'       => 'transparent', // Can change to 'default' or custom header layout
            'footer_type'       => 'default'       // Can change to 'minimal' or custom footer layout
        ]);
    }
}
