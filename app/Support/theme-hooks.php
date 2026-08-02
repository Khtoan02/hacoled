<?php
/**
 * WordPress hooks retained as procedural callbacks for native compatibility.
 *
 * New domain and presentation code belongs in the namespaced app directory.
 */

defined('ABSPATH') || exit;

// 2. THEME FEATURES SETUP
if (!function_exists('hacoled_setup')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function hacoled_setup() {
        // Make theme available for translation
        load_theme_textdomain('hacoled', get_template_directory() . '/languages');

        // Let WordPress manage the document title dynamically
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails on posts and pages
        add_theme_support('post-thumbnails');

        // Register header & footer navigation locations
        register_nav_menus([
            'primary' => __('Menu chính', 'hacoled'),
            'footer'  => __('Menu chân trang', 'hacoled'),
        ]);

        // Switch default core markup to output clean HTML5
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
        ]);

        // Enable support for WooCommerce
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

        // Enable support for custom logo
        add_theme_support('custom-logo', [
            'height'      => 72,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ]);
    }
}
add_action('after_setup_theme', 'hacoled_setup');

// Native emoji rendering is sufficient for this site and avoids WordPress's
// front-end emoji capability worker on every page view.
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

// 3. ENQUEUE SCRIPTS AND STYLES
function hacoled_scripts() {
    $theme_version = wp_get_theme()->get('Version');

    // The homepage build already embeds font faces and style.css only contains
    // theme metadata, so avoid two extra render-blocking requests there.
    if (!is_front_page()) {
        wp_enqueue_style('hacoled-core-style', get_stylesheet_uri(), [], $theme_version);
        wp_enqueue_style(
            'hacoled-fonts',
            get_template_directory_uri() . '/assets/css/fonts.css',
            [],
            filemtime(get_template_directory() . '/assets/css/fonts.css')
        );
        wp_enqueue_style(
            'hacoled-font-display',
            'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&display=swap',
            [],
            null
        );
    }

    // Use a homepage-specific Tailwind build to avoid shipping utilities that
    // only belong to product, archive and editorial templates.
    $tailwind_stylesheet = is_front_page()
        ? '/assets/css/home.css'
        : '/assets/css/app.css';
    $tailwind_stylesheet_path = get_template_directory() . $tailwind_stylesheet;

    if (is_front_page()) {
        // Inline only the rules needed in the first viewport. The complete
        // stylesheet is fetched with a non-matching media query and activated
        // after first paint by home-loader.js.
        $critical_stylesheet_path = get_template_directory() . '/assets/css/home-critical.css';
        $homepage_css = file_get_contents($critical_stylesheet_path);
        if (wp_is_mobile()) {
            $homepage_css = preg_replace('/@font-face\{[^}]*\}/', '', $homepage_css);
        }
        // Keep mobile sections in the normal render flow so content never
        // appears blank while the visitor is scrolling. Desktop can retain
        // the off-screen paint optimization.
        $homepage_css .= '@media (min-width:768px){.home main>section:not(#hero-section),.home footer{content-visibility:auto;contain-intrinsic-size:auto 900px}}';
        $homepage_css = str_replace(
            ['../fonts/', '../images/', 'assets/fonts/', 'assets/images/'],
            [
                get_template_directory_uri() . '/assets/fonts/',
                get_template_directory_uri() . '/assets/images/',
                get_template_directory_uri() . '/assets/fonts/',
                get_template_directory_uri() . '/assets/images/',
            ],
            $homepage_css
        );

        wp_register_style('hacoled-home-critical', false, [], filemtime($critical_stylesheet_path));
        wp_enqueue_style('hacoled-home-critical');
        wp_add_inline_style('hacoled-home-critical', $homepage_css);

        wp_register_style(
            'hacoled-compiled-tailwind',
            get_template_directory_uri() . $tailwind_stylesheet,
            [],
            filemtime($tailwind_stylesheet_path)
        );
        wp_enqueue_style('hacoled-compiled-tailwind');
    } else {
        wp_enqueue_style(
            'hacoled-compiled-tailwind',
            get_template_directory_uri() . $tailwind_stylesheet,
            [],
            filemtime($tailwind_stylesheet_path)
        );
    }

    // Enqueue complete Phosphor Icons stylesheet for all pages
    $icon_stylesheet = '/assets/css/phosphor-icons.css';
    $icon_stylesheet_path = get_template_directory() . $icon_stylesheet;

    if (file_exists($icon_stylesheet_path)) {
        wp_enqueue_style(
            'phosphor-icons',
            get_template_directory_uri() . $icon_stylesheet,
            [],
            filemtime($icon_stylesheet_path)
        );
    }

    // The homepage only needs Alpine and navigation behavior; GSAP and
    // ScrollTrigger remain available to templates that actually use them.
    $script_bundle = is_front_page()
        ? '/assets/js/home-loader.js'
        : '/assets/js/app.js';
    $script_bundle_path = get_template_directory() . $script_bundle;

    wp_enqueue_script(
        'hacoled-compiled-js',
        get_template_directory_uri() . $script_bundle,
        [],
        filemtime($script_bundle_path),
        [
            'in_footer' => true,
            'strategy'  => is_front_page() ? 'async' : 'defer',
        ]
    );
}
add_action('wp_enqueue_scripts', 'hacoled_scripts');

/**
 * The homepage renders product summaries itself and does not use WooCommerce
 * blocks, cart actions or attribution tracking. Avoid loading those global
 * assets on this route; they account for most of the blocking CSS/JS weight.
 */
function hacoled_front_page_asset_cleanup() {
    if (!is_front_page()) {
        return;
    }

    foreach ([
        'wc-blocks-style',
        'wc-blocks-vendors-style',
        'wc-blocks-packages-style',
        'woocommerce-blocktheme',
        'wp-block-library',
        'wp-block-library-theme',
        'classic-theme-styles',
        'global-styles',
    ] as $style_handle) {
        wp_dequeue_style($style_handle);
    }

    foreach ([
        'wc-cart-fragments',
        'wc-add-to-cart',
        'woocommerce',
        'jquery-blockui',
        'js-cookie',
        'sourcebuster-js',
        'wc-order-attribution',
        'jquery-migrate',
        'jquery-core',
        'jquery',
    ] as $script_handle) {
        wp_dequeue_script($script_handle);
    }
}
add_action('wp_enqueue_scripts', 'hacoled_front_page_asset_cleanup', 100);
add_action('wp_print_styles', 'hacoled_front_page_asset_cleanup', 100);
add_action('wp_print_scripts', 'hacoled_front_page_asset_cleanup', 100);

/**
 * Add intrinsic dimensions to local homepage images that are authored as raw
 * template markup. This prevents layout shifts without forcing fixed CSS sizes.
 */
function hacoled_front_page_add_image_dimensions($html) {
    if (!is_string($html) || $html === '') {
        return $html;
    }

    $theme_url = trailingslashit(get_template_directory_uri());
    $theme_dir = trailingslashit(get_template_directory());
    $uploads   = wp_get_upload_dir();

    return preg_replace_callback('/<img\b[^>]*>/i', static function ($match) use ($theme_url, $theme_dir, $uploads) {
        $tag = $match[0];
        if (preg_match('/\bwidth=["\'][^"\']+["\']/i', $tag) && preg_match('/\bheight=["\'][^"\']+["\']/i', $tag)) {
            return $tag;
        }

        $image_url = '';
        foreach (['data-menu-src', 'data-src', 'src'] as $attribute) {
            if (preg_match('/\b' . preg_quote($attribute, '/') . '=["\']([^"\']+)["\']/i', $tag, $url_match)) {
                $candidate = html_entity_decode($url_match[1], ENT_QUOTES, 'UTF-8');
                if (strpos($candidate, 'data:') !== 0) {
                    $image_url = $candidate;
                    break;
                }
            }
        }

        $image_path = '';
        if ($image_url !== '' && strpos($image_url, $theme_url) === 0) {
            $image_path = $theme_dir . ltrim(substr($image_url, strlen($theme_url)), '/');
        } elseif (
            $image_url !== ''
            && !empty($uploads['baseurl'])
            && !empty($uploads['basedir'])
            && strpos($image_url, trailingslashit($uploads['baseurl'])) === 0
        ) {
            $image_path = trailingslashit($uploads['basedir']) . ltrim(substr($image_url, strlen(trailingslashit($uploads['baseurl']))), '/');
        }

        if ($image_path === '' || !is_file($image_path)) {
            return $tag;
        }

        $cache_key = 'haco_img_sz_' . md5($image_path);
        $size = get_transient($cache_key);
        if (!is_array($size) || empty($size[0]) || empty($size[1])) {
            $size_raw = @getimagesize($image_path);
            if ($size_raw && !empty($size_raw[0]) && !empty($size_raw[1])) {
                $size = [(int) $size_raw[0], (int) $size_raw[1]];
                set_transient($cache_key, $size, WEEK_IN_SECONDS * 4); // Cache for 4 weeks
            } else {
                return $tag;
            }
        }

        $attributes = ' width="' . $size[0] . '" height="' . $size[1] . '"';

        if (
            !preg_match('/\bsrcset=["\']/i', $tag)
            && !preg_match('/\bdata-menu-src=["\']/i', $tag)
            && strtolower(pathinfo($image_path, PATHINFO_EXTENSION)) === 'webp'
            && (int) $size[0] > 320
        ) {
            $sources = [];
            foreach ([320, 640, 768] as $candidate_width) {
                $candidate_path = preg_replace('/\.webp$/i', '-' . $candidate_width . '.webp', $image_path);
                if ($candidate_path && is_file($candidate_path)) {
                    $candidate_url = preg_replace('/\.webp(?:\?.*)?$/i', '-' . $candidate_width . '.webp', $image_url);
                    $sources[] = esc_url($candidate_url) . ' ' . $candidate_width . 'w';
                }
            }
            $sources[] = esc_url($image_url) . ' ' . (int) $size[0] . 'w';

            if (count($sources) > 1) {
                $attributes .= ' srcset="' . implode(', ', $sources) . '"';
                if (!preg_match('/\bsizes=["\']/i', $tag)) {
                    $attributes .= ' sizes="(max-width: 767px) 100vw, 50vw"';
                }
            }
        }

        if (preg_match('/\/>\s*$/', $tag)) {
            return preg_replace('/\s*\/>\s*$/', $attributes . ' />', $tag, 1);
        }

        return preg_replace('/>\s*$/', $attributes . '>', $tag, 1);
    }, $html);
}

function hacoled_front_page_start_image_dimension_buffer() {
    if (is_front_page()) {
        ob_start('hacoled_front_page_add_image_dimensions');
    }
}
add_action('template_redirect', 'hacoled_front_page_start_image_dimension_buffer', 1);

// Filter to load Phosphor Icons stylesheet asynchronously
add_filter('style_loader_tag', 'hacoled_async_styles', 10, 4);
function hacoled_async_styles($tag, $handle, $href, $media) {
    if (is_front_page() && in_array($handle, ['wc-blocks-style', 'wc-blocks-vendors-style', 'wc-blocks-packages-style'], true)) {
        return '';
    }

    if ('phosphor-icons' === $handle) {
        $tag = '<link rel="preload" as="style" href="' . esc_url($href) . '" />' . "\n";
        $tag .= '<link rel="stylesheet" id="' . esc_attr($handle) . '-css" href="' . esc_url($href) . '" media="all" />';
    }

    if (is_front_page() && 'hacoled-compiled-tailwind' === $handle) {
        $tag = '<link rel="stylesheet" id="hacoled-compiled-tailwind-css" href="' . esc_url($href) . '" media="print" onload="this.media=\'all\'" data-hacoled-full-style />';
        $tag .= '<noscript><link rel="stylesheet" href="' . esc_url($href) . '" /></noscript>';
    }
    return $tag;
}

// Preload critical fonts on front page to shorten Critical Request Chains and prevent layout shifts (FOUT)
function hacoled_preload_critical_fonts() {
    if (!is_front_page()) {
        return;
    }
    $font_dir = get_template_directory_uri() . '/assets/fonts/';
    ?>
    <link rel="preload" href="<?php echo esc_url($font_dir . 'inter-vietnamese.woff2'); ?>" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?php echo esc_url($font_dir . 'inter-latin.woff2'); ?>" as="font" type="font/woff2" crossorigin>
    <?php
}
add_action('wp_head', 'hacoled_preload_critical_fonts', 2);

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

// Disable WooCommerce default CSS to avoid conflicts with TailwindCSS
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// 4. REGISTER CUSTOM POST TYPE: JOB
function hacoled_register_job_post_type() {
    $labels = [
        'name'               => 'Tuyển dụng',
        'singular_name'      => 'Vị trí Tuyển dụng',
        'menu_name'          => 'Tuyển dụng',
        'name_admin_bar'     => 'Tuyển dụng',
        'add_new'            => 'Thêm Vị trí mới',
        'add_new_item'       => 'Thêm Vị trí Tuyển dụng',
        'new_item'           => 'Vị trí mới',
        'edit_item'          => 'Sửa Vị trí',
        'view_item'          => 'Xem Vị trí',
        'all_items'          => 'Tất cả Vị trí',
        'search_items'       => 'Tìm kiếm Vị trí',
        'not_found'          => 'Không tìm thấy vị trí nào.',
        'not_found_in_trash' => 'Không có vị trí nào trong thùng rác.'
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => ['slug' => 'tuyen-dung/chi-tiet'],
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-id',
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest'       => true, // Enable Gutenberg
    ];

    register_post_type('job', $args);
}
add_action('init', 'hacoled_register_job_post_type');

// 5. ADD META BOXES FOR JOB DETAILS
function hacoled_add_job_meta_boxes() {
    add_meta_box(
        'job_details_meta',
        'Thông tin Tuyển dụng',
        'hacoled_job_meta_box_callback',
        'job',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'hacoled_add_job_meta_boxes');

function hacoled_job_meta_box_callback($post) {
    wp_nonce_field('hacoled_save_job_meta', 'hacoled_job_meta_nonce');

    $job_department = get_post_meta($post->ID, 'job_department', true);
    $job_location = get_post_meta($post->ID, 'job_location', true);
    $job_type = get_post_meta($post->ID, 'job_type', true);
    $job_salary = get_post_meta($post->ID, 'job_salary', true);

    ?>
    <style>
        .hacoled-meta-row { margin-bottom: 15px; }
        .hacoled-meta-row label { display: inline-block; width: 150px; font-weight: bold; }
        .hacoled-meta-row input { width: 100%; max-width: 400px; padding: 5px; }
        .hacoled-meta-desc { color: #666; font-size: 12px; font-style: italic; display: block; margin-left: 155px; margin-top: 4px; }
    </style>
    <div class="hacoled-meta-row">
        <label for="job_department">Phòng ban:</label>
        <input type="text" id="job_department" name="job_department" value="<?php echo esc_attr($job_department); ?>" placeholder="VD: Phòng Kinh Doanh">
        <span class="hacoled-meta-desc">Tên phòng ban hoặc chuyên môn. Dùng để gom nhóm ngoài trang Tuyển dụng.</span>
    </div>
    <div class="hacoled-meta-row">
        <label for="job_location">Địa điểm làm việc:</label>
        <input type="text" id="job_location" name="job_location" value="<?php echo esc_attr($job_location); ?>" placeholder="VD: Hà Nội / TP.HCM">
    </div>
    <div class="hacoled-meta-row">
        <label for="job_type">Hình thức:</label>
        <input type="text" id="job_type" name="job_type" value="<?php echo esc_attr($job_type); ?>" placeholder="VD: Toàn thời gian">
    </div>
    <div class="hacoled-meta-row">
        <label for="job_salary">Mức lương:</label>
        <input type="text" id="job_salary" name="job_salary" value="<?php echo esc_attr($job_salary); ?>" placeholder="VD: Thỏa thuận hoặc 15 - 20 Triệu">
    </div>
    <?php
}

function hacoled_save_job_meta($post_id) {
    if (!isset($_POST['hacoled_job_meta_nonce'])) return;
    if (!wp_verify_nonce($_POST['hacoled_job_meta_nonce'], 'hacoled_save_job_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['job_department'])) {
        update_post_meta($post_id, 'job_department', sanitize_text_field($_POST['job_department']));
    }
    if (isset($_POST['job_location'])) {
        update_post_meta($post_id, 'job_location', sanitize_text_field($_POST['job_location']));
    }
    if (isset($_POST['job_type'])) {
        update_post_meta($post_id, 'job_type', sanitize_text_field($_POST['job_type']));
    }
    if (isset($_POST['job_salary'])) {
        update_post_meta($post_id, 'job_salary', sanitize_text_field($_POST['job_salary']));
    }
}
add_action('save_post_job', 'hacoled_save_job_meta');

// 6. THEME CUSTOMIZER CONFIGURATIONS
if (class_exists('WP_Customize_Control') && !class_exists('Hacoled_Customize_Gallery_Control')) {
    class Hacoled_Customize_Gallery_Control extends WP_Customize_Control {
        public $type = 'hacoled_gallery';

        public function enqueue() {
            wp_enqueue_media();
        }

        public function render_content() {
            $value = $this->value();
            $images = !empty($value) ? explode(',', $value) : array();
            ?>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php if (!empty($this->description)) : ?>
                <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php endif; ?>

            <div class="hacoled-gallery-preview" style="display: flex; flex-wrap: wrap; gap: 5px; margin-bottom: 10px;">
                <?php foreach ($images as $img_url) : if (empty($img_url)) continue; ?>
                    <div class="hacoled-gallery-img" style="position: relative; width: 50px; height: 50px; border: 1px solid #ccc; border-radius: 4px; overflow: hidden;">
                        <img src="<?php echo esc_url($img_url); ?>" style="width: 100%; height: 100%; object-fit: cover;" />
                    </div>
                <?php endforeach; ?>
            </div>

            <input type="hidden" class="hacoled-gallery-input" <?php $this->link(); ?> value="<?php echo esc_attr($value); ?>" />
            <button type="button" class="button hacoled-gallery-button"><?php _e('Chọn thư viện ảnh', 'hacoled'); ?></button>
            <button type="button" class="button hacoled-gallery-clear" style="margin-left: 5px; color: #a00; border-color: #a00;"><?php _e('Xóa tất cả', 'hacoled'); ?></button>

            <script>
            jQuery(document).ready(function($) {
                var controlId = '<?php echo esc_attr($this->id); ?>';
                var selector = '#customize-control-' + controlId.replace(/\[/g, '-').replace(/\]/g, '');
                var container = $(selector);
                
                container.on('click', '.hacoled-gallery-button', function(e) {
                    e.preventDefault();
                    
                    var frame = wp.media({
                        title: '<?php _e('Chọn ảnh slider', 'hacoled'); ?>',
                        button: {
                            text: '<?php _e('Thêm vào Slider', 'hacoled'); ?>'
                        },
                        multiple: true
                    });

                    frame.on('select', function() {
                        var selection = frame.state().get('selection');
                        var urls = [];
                        var previewHtml = '';
                        
                        selection.map(function(attachment) {
                            attachment = attachment.toJSON();
                            if (attachment.url) {
                                urls.push(attachment.url);
                                previewHtml += '<div style="position: relative; width: 50px; height: 50px; border: 1px solid #ccc; border-radius: 4px; overflow: hidden;"><img src="' + attachment.url + '" style="width: 100%; height: 100%; object-fit: cover;" /></div>';
                            }
                        });
                        
                        container.find('.hacoled-gallery-input').val(urls.join(',')).trigger('change');
                        container.find('.hacoled-gallery-preview').html(previewHtml);
                    });

                    frame.open();
                });

                container.on('click', '.hacoled-gallery-clear', function(e) {
                    e.preventDefault();
                    container.find('.hacoled-gallery-input').val('').trigger('change');
                    container.find('.hacoled-gallery-preview').html('');
                });
            });
            </script>
            <?php
        }
    }
}

function hacoled_customize_register($wp_customize) {
    // Panel for Homepage Configuration
    $wp_customize->add_panel('hacoled_homepage_panel', [
        'title'       => __('Trang chủ HacoLED', 'hacoled'),
        'description' => __('Cấu hình các phần hiển thị trên Trang chủ', 'hacoled'),
        'priority'    => 30,
    ]);

    // Section 1: Hero Section
    $wp_customize->add_section('hacoled_hero_section', [
        'title'    => __('1. Hero Section', 'hacoled'),
        'panel'    => 'hacoled_homepage_panel',
        'priority' => 10,
    ]);

    // Hero Background
    $wp_customize->add_setting('hacoled_hero_bg', [
        'default'           => 'https://hacoled.com/wp-content/uploads/2026/04/anh-doi-ky-thuat-hacoled-cung-voi-bac-chinh.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hacoled_hero_bg', [
        'label'    => __('Ảnh nền Hero', 'hacoled'),
        'section'  => 'hacoled_hero_section',
        'settings' => 'hacoled_hero_bg',
    ]));

    // Multi-select Hero Slides Gallery
    $wp_customize->add_setting('hacoled_hero_slides', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control(new Hacoled_Customize_Gallery_Control($wp_customize, 'hacoled_hero_slides', [
        'label'       => __('Bộ sưu tập ảnh Slide Hero (Chọn nhiều ảnh cùng lúc)', 'hacoled'),
        'description' => __('Bấm nút chọn để mở thư viện media và giữ Ctrl/Cmd (hoặc kéo chuột) để chọn nhiều hình ảnh làm slide cùng lúc.', 'hacoled'),
        'section'     => 'hacoled_hero_section',
        'settings'    => 'hacoled_hero_slides',
    ]));

    // Individual Hero Slides (For Backward Compatibility)
    for ($i = 1; $i <= 6; $i++) {
        $wp_customize->add_setting("hacoled_hero_slide_{$i}", [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "hacoled_hero_slide_{$i}", [
            'label'    => sprintf(__('Ảnh Slide Hero %d (Dự phòng)', 'hacoled'), $i),
            'section'  => 'hacoled_hero_section',
            'settings' => "hacoled_hero_slide_{$i}",
        ]));
    }


    // Section 3: Featured Projects
    $wp_customize->add_section('hacoled_projects_section', [
        'title'    => __('3. Dự án tiêu biểu', 'hacoled'),
        'panel'    => 'hacoled_homepage_panel',
        'priority' => 30,
    ]);

    $wp_customize->add_setting('hacoled_projects_cat_slug', [
        'default'           => 'du-an',
        'sanitize_callback' => 'sanitize_title',
    ]);
    $wp_customize->add_control('hacoled_projects_cat_slug', [
        'label'       => __('Slug danh mục Dự án', 'hacoled'),
        'description' => __('Slug của danh mục tin tức dùng để truy vấn các Dự án tiêu biểu hiển thị ở Bento Grid (Mặc định: du-an)', 'hacoled'),
        'section'     => 'hacoled_projects_section',
        'type'        => 'text',
    ]);

    // Section 3.5: Prestige Bento Gallery
    $wp_customize->add_section('hacoled_prestige_section', [
        'title'    => __('3.5 Năng lực & Uy tín', 'hacoled'),
        'panel'    => 'hacoled_homepage_panel',
        'priority' => 35,
    ]);

    $prestige_panels = [
        'a' => __('Ảnh panel A (2x2 Hero)', 'hacoled'),
        'b' => __('Ảnh panel B (1x1)', 'hacoled'),
        'c' => __('Ảnh panel C (1x1)', 'hacoled'),
        'd' => __('Ảnh panel D (1x1)', 'hacoled'),
        'e' => __('Ảnh panel E (1x1)', 'hacoled'),
        'f' => __('Ảnh panel F (1x1)', 'hacoled'),
        'g' => __('Ảnh panel G (1x1)', 'hacoled'),
        'h' => __('Ảnh panel H (2x1 wide)', 'hacoled'),
    ];

    foreach ($prestige_panels as $key => $label) {
        $wp_customize->add_setting("hacoled_prestige_img_{$key}", [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "hacoled_prestige_img_{$key}", [
            'label'    => $label,
            'section'  => 'hacoled_prestige_section',
            'settings' => "hacoled_prestige_img_{$key}",
        ]));
    }

    // Section 4: Press
    $wp_customize->add_section('hacoled_press_section', [
        'title'    => __('4. Bài báo chí', 'hacoled'),
        'panel'    => 'hacoled_homepage_panel',
        'priority' => 40,
    ]);

    for ($i = 1; $i <= 6; $i++) {
        // Source
        $wp_customize->add_setting("hacoled_press_{$i}_source", [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("hacoled_press_{$i}_source", [
            'label'    => sprintf(__('Bài báo %d: Tên tòa báo', 'hacoled'), $i),
            'section'  => 'hacoled_press_section',
            'type'     => 'text',
        ]);

        // Logo
        $wp_customize->add_setting("hacoled_press_{$i}_logo", [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "hacoled_press_{$i}_logo", [
            'label'    => sprintf(__('Bài báo %d: Logo tòa báo', 'hacoled'), $i),
            'section'  => 'hacoled_press_section',
            'settings' => "hacoled_press_{$i}_logo",
        ]));

        // Logo Dark
        $wp_customize->add_setting("hacoled_press_{$i}_logo_dark", [
            'default'           => false,
            'sanitize_callback' => 'wp_validate_boolean',
        ]);
        $wp_customize->add_control("hacoled_press_{$i}_logo_dark", [
            'label'    => sprintf(__('Bài báo %d: Nền tối cho logo', 'hacoled'), $i),
            'section'  => 'hacoled_press_section',
            'type'     => 'checkbox',
        ]);

        // Title
        $wp_customize->add_setting("hacoled_press_{$i}_title", [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("hacoled_press_{$i}_title", [
            'label'    => sprintf(__('Bài báo %d: Tiêu đề bài viết', 'hacoled'), $i),
            'section'  => 'hacoled_press_section',
            'type'     => 'text',
        ]);

        // Image
        $wp_customize->add_setting("hacoled_press_{$i}_img", [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "hacoled_press_{$i}_img", [
            'label'    => sprintf(__('Bài báo %d: Ảnh minh họa', 'hacoled'), $i),
            'section'  => 'hacoled_press_section',
            'settings' => "hacoled_press_{$i}_img",
        ]));

        // URL
        $wp_customize->add_setting("hacoled_press_{$i}_url", [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control("hacoled_press_{$i}_url", [
            'label'    => sprintf(__('Bài báo %d: Liên kết bài viết', 'hacoled'), $i),
            'section'  => 'hacoled_press_section',
            'type'     => 'text',
        ]);
    }

    // Section 5: Events Category Configuration
    $wp_customize->add_section('hacoled_events_section', [
        'title'    => __('5. Sự kiện nổi bật', 'hacoled'),
        'panel'    => 'hacoled_homepage_panel',
        'priority' => 50,
    ]);

    $wp_customize->add_setting('hacoled_events_cat_slug', [
        'default'           => 'su-kien-hacoled',
        'sanitize_callback' => 'sanitize_title',
    ]);
    $wp_customize->add_control('hacoled_events_cat_slug', [
        'label'       => __('Slug danh mục bài viết Sự kiện', 'hacoled'),
        'description' => __('Slug của danh mục dùng để truy vấn các bài viết cho phần Sự kiện nổi bật (Mặc định: su-kien-hacoled)', 'hacoled'),
        'section'     => 'hacoled_events_section',
        'type'        => 'text',
    ]);

    // Section 6: Đối tác chiến lược & Khách hàng
    $wp_customize->add_section('hacoled_partners_section', [
        'title'    => __('6. Logo Đối tác & Khách hàng', 'hacoled'),
        'panel'    => 'hacoled_homepage_panel',
        'priority' => 60,
    ]);

    // Strategic Partners Chips
    $wp_customize->add_setting('hacoled_strategic_partners_text', [
        'default'           => 'Viettel, FPT, EVN, Vingroup, Masterise, BRG',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('hacoled_strategic_partners_text', [
        'label'       => __('Tên các Đối tác chiến lược', 'hacoled'),
        'description' => __('Nhập tên các đối tác, phân cách bằng dấu phẩy (vd: Viettel, FPT, EVN...)', 'hacoled'),
        'section'     => 'hacoled_partners_section',
        'type'        => 'text',
    ]);

    // Multi-select Partner Logos Gallery
    $wp_customize->add_setting('hacoled_partner_logos', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control(new Hacoled_Customize_Gallery_Control($wp_customize, 'hacoled_partner_logos', [
        'label'       => __('Logo Đối tác (Slider)', 'hacoled'),
        'description' => __('Bấm chọn nhiều ảnh (Giữ Ctrl/Cmd) để hiển thị ở Slider đối tác. Lưu ý: Nên dùng ảnh có nền trong suốt (PNG/WebP). Nếu để trống sẽ hiển thị chữ mặc định (Samsung, LG...).', 'hacoled'),
        'section'     => 'hacoled_partners_section',
        'settings'    => 'hacoled_partner_logos',
    ]));

    // Panel for Blog Page Configuration
    $wp_customize->add_panel('hacoled_blog_panel', [
        'title'       => __('Trang Tin tức & Blog', 'hacoled'),
        'description' => __('Cấu hình các chuyên mục trên Trang Tin tức', 'hacoled'),
        'priority'    => 35,
    ]);

    $wp_customize->add_section('hacoled_blog_categories_section', [
        'title'    => __('Slug các chuyên mục', 'hacoled'),
        'panel'    => 'hacoled_blog_panel',
        'priority' => 10,
    ]);

    $blog_sections = [
        'press'    => ['Báo chí nói về HacoLED', 'bao-chi-noi-ve-hacoled'],
        'audio'    => ['Blog âm thanh', 'blog-am-thanh'],
        'led'      => ['Blog màn hình LED', 'blog-man-hinh-led'],
        'tech'     => ['Hướng dẫn kỹ thuật', 'huong-dan-ky-thuat'],
        'events'   => ['Sự kiện HacoLED', 'su-kien-hacoled'],
        'news'     => ['Kinh nghiệm & Tin tức', 'tin-tuc'],
        'jobs'     => ['Tuyển dụng', 'tuyen-dung'],
        'projects' => ['Dự án tiêu biểu', 'du-an'],
    ];

    foreach ($blog_sections as $key => $data) {
        $wp_customize->add_setting("hacoled_blog_cat_{$key}", [
            'default'           => $data[1],
            'sanitize_callback' => 'sanitize_title',
        ]);
        $wp_customize->add_control("hacoled_blog_cat_{$key}", [
            'label'       => sprintf(__('Slug: %s', 'hacoled'), $data[0]),
            'description' => sprintf(__('Mặc định: %s', 'hacoled'), $data[1]),
            'section'     => 'hacoled_blog_categories_section',
            'type'        => 'text',
        ]);
    }

    // Section: Tracking & Scripts
    $wp_customize->add_section('hacoled_scripts_section', [
        'title'    => __('Theo dõi & Scripts', 'hacoled'),
        'priority' => 200,
    ]);

    // Header Scripts
    $wp_customize->add_setting('hacoled_header_scripts', [
        'default'           => '',
        'sanitize_callback' => 'hacoled_sanitize_raw_html',
    ]);
    $wp_customize->add_control('hacoled_header_scripts', [
        'label'       => __('Scripts trong <head>', 'hacoled'),
        'description' => __('Chèn các mã theo dõi như Google Analytics, Google Tag Manager (phần head), Facebook Pixel, v.v.', 'hacoled'),
        'section'     => 'hacoled_scripts_section',
        'type'        => 'textarea',
        'input_attrs' => ['rows' => 10],
    ]);

    // Body Scripts (wp_body_open)
    $wp_customize->add_setting('hacoled_body_scripts', [
        'default'           => '',
        'sanitize_callback' => 'hacoled_sanitize_raw_html',
    ]);
    $wp_customize->add_control('hacoled_body_scripts', [
        'label'       => __('Scripts ngay sau <body>', 'hacoled'),
        'description' => __('Chèn mã Google Tag Manager (phần noscript) hoặc các script cần chạy ngay khi mở body.', 'hacoled'),
        'section'     => 'hacoled_scripts_section',
        'type'        => 'textarea',
        'input_attrs' => ['rows' => 10],
    ]);

    // Footer Scripts
    $wp_customize->add_setting('hacoled_footer_scripts', [
        'default'           => '',
        'sanitize_callback' => 'hacoled_sanitize_raw_html',
    ]);
    $wp_customize->add_control('hacoled_footer_scripts', [
        'label'       => __('Scripts trước thẻ </body> (Footer)', 'hacoled'),
        'description' => __('Chèn các mã script theo dõi, chat widget (Zalo, Tawk.to, Messenger) cần tải ở cuối trang.', 'hacoled'),
        'section'     => 'hacoled_scripts_section',
        'type'        => 'textarea',
        'input_attrs' => ['rows' => 10],
    ]);
}
add_action('customize_register', 'hacoled_customize_register');

// 7. CUSTOM CATEGORY TEMPLATE META FIELD
function hacoled_add_category_template_field() {
    ?>
    <div class="form-field term-group">
        <label for="category_template"><?php _e('Mẫu giao diện chuyên mục', 'hacoled'); ?></label>
        <select name="category_template" id="category_template" class="postform">
            <option value="default"><?php _e('Mặc định (Giao diện Danh mục 2 cột)', 'hacoled'); ?></option>
            <option value="blog"><?php _e('Mẫu trang Tin tức & Blog (Tạp chí cao cấp)', 'hacoled'); ?></option>
            <option value="project"><?php _e('Mẫu trang Dự án (Hồ sơ năng lực)', 'hacoled'); ?></option>
        </select>
        <p class="description"><?php _e('Chọn giao diện hiển thị cho chuyên mục này.', 'hacoled'); ?></p>
    </div>
    <?php
}
add_action('category_add_form_fields', 'hacoled_add_category_template_field', 10, 2);

function hacoled_edit_category_template_field($term) {
    $template = get_term_meta($term->term_id, 'category_template', true) ?: 'default';
    ?>
    <tr class="form-field term-group-wrap">
        <th scope="row"><label for="category_template"><?php _e('Mẫu giao diện chuyên mục', 'hacoled'); ?></label></th>
        <td>
            <select name="category_template" id="category_template" class="postform">
                <option value="default" <?php selected($template, 'default'); ?>><?php _e('Mặc định (Giao diện Danh mục 2 cột)', 'hacoled'); ?></option>
                <option value="blog" <?php selected($template, 'blog'); ?>><?php _e('Mẫu trang Tin tức & Blog (Tạp chí cao cấp)', 'hacoled'); ?></option>
                <option value="project" <?php selected($template, 'project'); ?>><?php _e('Mẫu trang Dự án (Hồ sơ năng lực)', 'hacoled'); ?></option>
            </select>
            <p class="description"><?php _e('Chọn giao diện hiển thị cho chuyên mục này.', 'hacoled'); ?></p>
        </td>
    </tr>
    <?php
}
add_action('category_edit_form_fields', 'hacoled_edit_category_template_field', 10, 2);

function hacoled_save_category_template_meta($term_id) {
    if (isset($_POST['category_template'])) {
        update_term_meta($term_id, 'category_template', sanitize_text_field($_POST['category_template']));
    }
}
add_action('created_category', 'hacoled_save_category_template_meta', 10, 2);
add_action('edited_category', 'hacoled_save_category_template_meta', 10, 2);

// 8. PRODUCT CATEGORY FAQ META FIELDS
function hacoled_product_cat_faq_fields_markup($term = null, $is_edit = false) {
    $faq_title = '';
    $faq_intro = '';
    $faq_items = [];

    if ($term instanceof WP_Term) {
        $faq_title = get_term_meta($term->term_id, 'product_cat_faq_title', true) ?: '';
        $faq_intro = get_term_meta($term->term_id, 'product_cat_faq_intro', true) ?: '';
        $faq_items = get_term_meta($term->term_id, 'product_cat_faq_items', true);
        if (!is_array($faq_items)) {
            $faq_items = [];
        }
    }

    if (empty($faq_items)) {
        $faq_items = [['question' => '', 'answer' => '']];
    }

    $wrapper_start = $is_edit ? '<tr class="form-field term-group-wrap"><th scope="row"><label for="product_cat_faq_title">' . esc_html__('FAQ danh mục sản phẩm', 'hacoled') . '</label></th><td>' : '<div class="form-field term-group"><label for="product_cat_faq_title">' . esc_html__('FAQ danh mục sản phẩm', 'hacoled') . '</label>';
    $wrapper_end = $is_edit ? '</td></tr>' : '</div>';

    ob_start();
    echo $wrapper_start;
    ?>
    <div class="hacoled-product-cat-faq-wrapper" style="max-width: 760px;">
        <p class="description" style="margin-top:0; margin-bottom:12px;"><?php esc_html_e('Thêm các câu hỏi thường gặp cho danh mục này để hiển thị ở trang danh mục sản phẩm.', 'hacoled'); ?></p>

        <div style="margin-bottom: 12px;">
            <label for="product_cat_faq_title" style="display:block; margin-bottom:6px; font-weight:600;"><?php esc_html_e('Tiêu đề phần FAQ', 'hacoled'); ?></label>
            <input type="text" name="product_cat_faq_title" id="product_cat_faq_title" value="<?php echo esc_attr($faq_title); ?>" class="regular-text" />
        </div>

        <div style="margin-bottom: 12px;">
            <label for="product_cat_faq_intro" style="display:block; margin-bottom:6px; font-weight:600;"><?php esc_html_e('Mô tả ngắn phía trên FAQ', 'hacoled'); ?></label>
            <textarea name="product_cat_faq_intro" id="product_cat_faq_intro" rows="3" class="large-text"><?php echo esc_textarea($faq_intro); ?></textarea>
        </div>

        <div style="margin-bottom: 12px;">
            <label style="display:block; margin-bottom:8px; font-weight:600;"><?php esc_html_e('Danh sách FAQ', 'hacoled'); ?></label>
            <div id="hacoled-product-cat-faq-list">
                <?php foreach ($faq_items as $index => $item): ?>
                    <div class="hacoled-product-cat-faq-item" style="border:1px solid #d0d7de; padding:12px; margin-bottom:10px; border-radius:8px; background:#fff;">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; gap:8px;">
                            <strong><?php echo esc_html(sprintf(__('FAQ %d', 'hacoled'), $index + 1)); ?></strong>
                            <button type="button" class="button-link-delete hacoled-remove-faq-item"><?php esc_html_e('Xóa', 'hacoled'); ?></button>
                        </div>
                        <div style="margin-bottom:8px;">
                            <label style="display:block; margin-bottom:6px; font-weight:600;"><?php esc_html_e('Câu hỏi', 'hacoled'); ?></label>
                            <input type="text" name="product_cat_faq_items[<?php echo intval($index); ?>][question]" value="<?php echo esc_attr($item['question'] ?? ''); ?>" class="regular-text" />
                        </div>
                        <div>
                            <label style="display:block; margin-bottom:6px; font-weight:600;"><?php esc_html_e('Câu trả lời', 'hacoled'); ?></label>
                            <textarea name="product_cat_faq_items[<?php echo intval($index); ?>][answer]" rows="4" class="large-text"><?php echo esc_textarea($item['answer'] ?? ''); ?></textarea>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <p style="margin-top:8px;"><button type="button" class="button button-secondary" id="hacoled-add-product-cat-faq"><?php esc_html_e('Thêm FAQ', 'hacoled'); ?></button></p>
        </div>
    </div>

    <script>
    (function () {
        const list = document.getElementById('hacoled-product-cat-faq-list');
        const addButton = document.getElementById('hacoled-add-product-cat-faq');
        if (!list || !addButton) {
            return;
        }

        function renumberItems() {
            const items = list.querySelectorAll('.hacoled-product-cat-faq-item');
            items.forEach(function (item, index) {
                const title = item.querySelector('strong');
                if (title) {
                    title.textContent = 'FAQ ' + (index + 1);
                }
                const questionInput = item.querySelector('input[type="text"]');
                const answerInput = item.querySelector('textarea');
                if (questionInput) {
                    questionInput.name = 'product_cat_faq_items[' + index + '][question]';
                }
                if (answerInput) {
                    answerInput.name = 'product_cat_faq_items[' + index + '][answer]';
                }
            });
        }

        addButton.addEventListener('click', function () {
            const items = list.querySelectorAll('.hacoled-product-cat-faq-item');
            const index = items.length;
            const item = document.createElement('div');
            item.className = 'hacoled-product-cat-faq-item';
            item.style.cssText = 'border:1px solid #d0d7de; padding:12px; margin-bottom:10px; border-radius:8px; background:#fff;';
            item.innerHTML = '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; gap:8px;"><strong>FAQ ' + (index + 1) + '</strong><button type="button" class="button-link-delete hacoled-remove-faq-item">Xóa</button></div><div style="margin-bottom:8px;"><label style="display:block; margin-bottom:6px; font-weight:600;">Câu hỏi</label><input type="text" name="product_cat_faq_items[' + index + '][question]" class="regular-text" /></div><div><label style="display:block; margin-bottom:6px; font-weight:600;">Câu trả lời</label><textarea name="product_cat_faq_items[' + index + '][answer]" rows="4" class="large-text"></textarea></div>';
            list.appendChild(item);
        });

        list.addEventListener('click', function (event) {
            if (event.target.classList.contains('hacoled-remove-faq-item')) {
                event.target.closest('.hacoled-product-cat-faq-item').remove();
                renumberItems();
            }
        });
    })();
    </script>
    <?php
    echo $wrapper_end;
    return ob_get_clean();
}

function hacoled_add_product_cat_faq_fields() {
    echo hacoled_product_cat_faq_fields_markup(null, false);
}

function hacoled_edit_product_cat_faq_fields($term) {
    echo hacoled_product_cat_faq_fields_markup($term, true);
}

function hacoled_save_product_cat_faq_meta($term_id, $tt_id = 0, $taxonomy = '') {
    if ($taxonomy !== 'product_cat' && $taxonomy !== '') {
        return;
    }

    if (isset($_POST['product_cat_faq_title'])) {
        update_term_meta($term_id, 'product_cat_faq_title', sanitize_text_field(wp_unslash($_POST['product_cat_faq_title'])));
    }

    if (isset($_POST['product_cat_faq_intro'])) {
        update_term_meta($term_id, 'product_cat_faq_intro', sanitize_textarea_field(wp_unslash($_POST['product_cat_faq_intro'])));
    }

    $faq_items = [];
    if (isset($_POST['product_cat_faq_items']) && is_array($_POST['product_cat_faq_items'])) {
        foreach ($_POST['product_cat_faq_items'] as $item) {
            if (!is_array($item)) {
                continue;
            }

            $question = isset($item['question']) ? sanitize_text_field(wp_unslash($item['question'])) : '';
            $answer = isset($item['answer']) ? wp_kses_post(wp_unslash($item['answer'])) : '';

            if ($question === '' && $answer === '') {
                continue;
            }

            $faq_items[] = [
                'question' => $question,
                'answer' => $answer,
            ];
        }
    }

    if (!empty($faq_items)) {
        update_term_meta($term_id, 'product_cat_faq_items', $faq_items);
    } else {
        delete_term_meta($term_id, 'product_cat_faq_items');
    }
}

add_action('product_cat_add_form_fields', 'hacoled_add_product_cat_faq_fields', 20);
add_action('product_cat_edit_form_fields', 'hacoled_edit_product_cat_faq_fields', 20);
add_action('category_add_form_fields', 'hacoled_add_product_cat_faq_fields', 20);
add_action('category_edit_form_fields', 'hacoled_edit_product_cat_faq_fields', 20);
add_action('created_product_cat', 'hacoled_save_product_cat_faq_meta', 10, 2);
add_action('edited_product_cat', 'hacoled_save_product_cat_faq_meta', 10, 2);
add_action('created_term', 'hacoled_save_product_cat_faq_meta', 10, 3);
add_action('edited_term', 'hacoled_save_product_cat_faq_meta', 10, 3);

// Sanitize Raw HTML/JS tracking scripts
function hacoled_sanitize_raw_html($value) {
    return $value;
}

// Hook to output header scripts
add_action('wp_head', function() {
    $scripts = get_theme_mod('hacoled_header_scripts');
    if (!empty($scripts)) {
        echo "\n<!-- Start HacoLED Header Scripts -->\n";
        echo $scripts;
        echo "\n<!-- End HacoLED Header Scripts -->\n";
    }
}, 100);

// Hook to output body scripts
add_action('wp_body_open', function() {
    $scripts = get_theme_mod('hacoled_body_scripts');
    if (!empty($scripts)) {
        echo "\n<!-- Start HacoLED Body Scripts -->\n";
        echo $scripts;
        echo "\n<!-- End HacoLED Body Scripts -->\n";
    }
}, 100);

// Hook to output footer scripts
add_action('wp_footer', function() {
    $scripts = get_theme_mod('hacoled_footer_scripts');
    if (!empty($scripts)) {
        echo "\n<!-- Start HacoLED Footer Scripts -->\n";
        echo $scripts;
        echo "\n<!-- End HacoLED Footer Scripts -->\n";
    }
}, 100);

// 9. POST FAQ META FIELDS (METABOX FOR SINGLE POSTS)
function hacoled_add_post_faq_meta_box() {
    add_meta_box(
        'post_faq_meta',
        'FAQ Bài viết',
        'hacoled_post_faq_meta_box_callback',
        'post',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'hacoled_add_post_faq_meta_box');

function hacoled_post_faq_meta_box_callback($post) {
    wp_nonce_field('hacoled_save_post_faq_meta', 'hacoled_post_faq_nonce');

    $faq_title = get_post_meta($post->ID, 'post_faq_title', true) ?: '';
    $faq_intro = get_post_meta($post->ID, 'post_faq_intro', true) ?: '';
    $faq_items = get_post_meta($post->ID, 'post_faq_items', true);
    if (!is_array($faq_items)) {
        $faq_items = [];
    }
    if (empty($faq_items)) {
        $faq_items = [['question' => '', 'answer' => '']];
    }
    ?>
    <div class="hacoled-post-faq-wrapper" style="max-width: 100%;">
        <p class="description" style="margin-bottom:15px;"><?php esc_html_e('Thêm danh sách câu hỏi thường gặp (FAQ) hiển thị riêng cho bài viết này.', 'hacoled'); ?></p>

        <div style="margin-bottom: 15px;">
            <label for="post_faq_title" style="display:block; margin-bottom:6px; font-weight:600;"><?php esc_html_e('Tiêu đề phần FAQ', 'hacoled'); ?></label>
            <input type="text" name="post_faq_title" id="post_faq_title" value="<?php echo esc_attr($faq_title); ?>" style="width: 100%; max-width: 600px;" />
        </div>

        <div style="margin-bottom: 15px;">
            <label for="post_faq_intro" style="display:block; margin-bottom:6px; font-weight:600;"><?php esc_html_e('Mô tả ngắn phía trên FAQ', 'hacoled'); ?></label>
            <textarea name="post_faq_intro" id="post_faq_intro" rows="3" style="width: 100%; max-width: 600px;"><?php echo esc_textarea($faq_intro); ?></textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display:block; margin-bottom:8px; font-weight:600;"><?php esc_html_e('Danh sách FAQ', 'hacoled'); ?></label>
            <div id="hacoled-post-faq-list">
                <?php foreach ($faq_items as $index => $item): ?>
                    <div class="hacoled-post-faq-item" style="border:1px solid #d0d7de; padding:15px; margin-bottom:10px; border-radius:8px; background:#f9f9f9; max-width: 600px;">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px; gap:10px;">
                            <strong style="flex-grow:1;"><?php echo esc_html(sprintf(__('FAQ %d', 'hacoled'), $index + 1)); ?></strong>
                            <button type="button" class="button button-link-delete hacoled-remove-post-faq-item"><?php esc_html_e('Xóa', 'hacoled'); ?></button>
                        </div>
                        <div style="margin-bottom:10px;">
                            <label style="display:block; margin-bottom:6px; font-weight:600;"><?php esc_html_e('Câu hỏi', 'hacoled'); ?></label>
                            <input type="text" name="post_faq_items[<?php echo intval($index); ?>][question]" value="<?php echo esc_attr($item['question'] ?? ''); ?>" style="width: 100%;" />
                        </div>
                        <div>
                            <label style="display:block; margin-bottom:6px; font-weight:600;"><?php esc_html_e('Câu trả lời', 'hacoled'); ?></label>
                            <textarea name="post_faq_items[<?php echo intval($index); ?>][answer]" rows="4" style="width: 100%;"><?php echo esc_textarea($item['answer'] ?? ''); ?></textarea>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <p style="margin-top:10px;"><button type="button" class="button button-secondary" id="hacoled-add-post-faq"><?php esc_html_e('Thêm FAQ', 'hacoled'); ?></button></p>
        </div>
    </div>

    <script>
    (function () {
        const list = document.getElementById('hacoled-post-faq-list');
        const addButton = document.getElementById('hacoled-add-post-faq');
        if (!list || !addButton) {
            return;
        }

        function renumberItems() {
            const items = list.querySelectorAll('.hacoled-post-faq-item');
            items.forEach(function (item, index) {
                const title = item.querySelector('strong');
                if (title) {
                    title.textContent = 'FAQ ' + (index + 1);
                }
                const questionInput = item.querySelector('input[type="text"]');
                const answerInput = item.querySelector('textarea');
                if (questionInput) {
                    questionInput.name = 'post_faq_items[' + index + '][question]';
                }
                if (answerInput) {
                    answerInput.name = 'post_faq_items[' + index + '][answer]';
                }
            });
        }

        addButton.addEventListener('click', function () {
            const items = list.querySelectorAll('.hacoled-post-faq-item');
            const index = items.length;
            const item = document.createElement('div');
            item.className = 'hacoled-post-faq-item';
            item.style.cssText = 'border:1px solid #d0d7de; padding:15px; margin-bottom:10px; border-radius:8px; background:#f9f9f9; max-width: 600px;';
            item.innerHTML = '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px; gap:10px;"><strong style="flex-grow:1;">FAQ ' + (index + 1) + '</strong><button type="button" class="button button-link-delete hacoled-remove-post-faq-item">Xóa</button></div><div style="margin-bottom:10px;"><label style="display:block; margin-weight:600; margin-bottom:6px;">Câu hỏi</label><input type="text" name="post_faq_items[' + index + '][question]" style="width:100%;" /></div><div><label style="display:block; margin-weight:600; margin-bottom:6px;">Câu trả lời</label><textarea name="post_faq_items[' + index + '][answer]" rows="4" style="width:100%;"></textarea></div>';
            list.appendChild(item);
        });

        list.addEventListener('click', function (event) {
            if (event.target.classList.contains('hacoled-remove-post-faq-item')) {
                event.target.closest('.hacoled-post-faq-item').remove();
                renumberItems();
            }
        });
    })();
    </script>
    <?php
}

function hacoled_save_post_faq_meta($post_id) {
    if (!isset($_POST['hacoled_post_faq_nonce']) || !wp_verify_nonce($_POST['hacoled_post_faq_nonce'], 'hacoled_save_post_faq_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['post_faq_title'])) {
        update_post_meta($post_id, 'post_faq_title', sanitize_text_field(wp_unslash($_POST['post_faq_title'])));
    }
    if (isset($_POST['post_faq_intro'])) {
        update_post_meta($post_id, 'post_faq_intro', sanitize_textarea_field(wp_unslash($_POST['post_faq_intro'])));
    }

    $faq_items = [];
    if (isset($_POST['post_faq_items']) && is_array($_POST['post_faq_items'])) {
        foreach ($_POST['post_faq_items'] as $item) {
            $question = isset($item['question']) ? sanitize_text_field(wp_unslash($item['question'])) : '';
            $answer = isset($item['answer']) ? wp_kses_post(wp_unslash($item['answer'])) : '';
            if ($question !== '' || $answer !== '') {
                $faq_items[] = [
                    'question' => $question,
                    'answer' => $answer
                ];
            }
        }
    }

    if (!empty($faq_items)) {
        update_post_meta($post_id, 'post_faq_items', $faq_items);
    } else {
        delete_post_meta($post_id, 'post_faq_items');
    }
}
add_action('save_post', 'hacoled_save_post_faq_meta');
