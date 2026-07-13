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

// 3. ENQUEUE SCRIPTS AND STYLES
function hacoled_scripts() {
    $theme_version = wp_get_theme()->get('Version');

    // Theme metadata styles
    wp_enqueue_style('hacoled-core-style', get_stylesheet_uri(), [], $theme_version);

    // Compiled Tailwind CSS Stylesheet
    wp_enqueue_style(
        'hacoled-compiled-tailwind',
        get_template_directory_uri() . '/assets/css/app.css',
        [],
        filemtime(get_template_directory() . '/assets/css/app.css')
    );

    // Enqueue Phosphor Icons Local Stylesheet
    wp_enqueue_style(
        'phosphor-icons',
        get_template_directory_uri() . '/assets/css/phosphor-icons.css',
        [],
        '2.1.2'
    );

    // Compiled JS Bundle (Includes Alpine.js and GSAP)
    wp_enqueue_script(
        'hacoled-compiled-js',
        get_template_directory_uri() . '/assets/js/app.js',
        [],
        filemtime(get_template_directory() . '/assets/js/app.js'),
        true // Load in footer
    );
}
add_action('wp_enqueue_scripts', 'hacoled_scripts');

// Filter to load Phosphor Icons stylesheet asynchronously
add_filter('style_loader_tag', 'hacoled_async_styles', 10, 4);
function hacoled_async_styles($tag, $handle, $href, $media) {
    if ('phosphor-icons' === $handle) {
        $tag = '<link rel="preload" as="style" href="' . esc_url($href) . '" />' . "\n";
        $tag .= '<link rel="stylesheet" id="' . esc_attr($handle) . '-css" href="' . esc_url($href) . '" media="print" onload="this.media=\'all\'" />';
    }
    return $tag;
}

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

    // Section 2: Solutions
    $wp_customize->add_section('hacoled_solutions_section', [
        'title'    => __('2. Giải pháp cốt lõi', 'hacoled'),
        'panel'    => 'hacoled_homepage_panel',
        'priority' => 20,
    ]);

    $solutions_keys = [
        'led'       => __('Màn hình LED', 'hacoled'),
        'videowall' => __('Màn hình ghép', 'hacoled'),
        'audio'     => __('Âm thanh & Ánh sáng', 'hacoled'),
    ];
    foreach ($solutions_keys as $key => $label) {
        $wp_customize->add_setting("hacoled_solutions_{$key}_img", [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "hacoled_solutions_{$key}_img", [
            'label'    => sprintf(__('Ảnh nền cho %s', 'hacoled'), $label),
            'section'  => 'hacoled_solutions_section',
            'settings' => "hacoled_solutions_{$key}_img",
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

