<?php
/**
 * One-time data migrations required by theme structure changes.
 */

defined('ABSPATH') || exit;

/**
 * Migrate legacy root page-template assignments to page-templates/.
 *
 * WordPress stores the relative template filename in post meta. Removing the
 * old root routers without migrating that value would silently reset existing
 * pages to the default page template.
 */
function hacoled_run_theme_upgrades() {
    $target_version  = '1.1.0';
    $current_version = (string) get_option('hacoled_theme_schema_version', '0.0.0');

    if (version_compare($current_version, $target_version, '>=')) {
        return;
    }

    global $wpdb;

    $template_map = [
        'template-about.php'      => 'page-templates/about.php',
        'template-blog.php'       => 'page-templates/blog.php',
        'template-careers.php'    => 'page-templates/careers.php',
        'template-commitment.php' => 'page-templates/commitment.php',
        'template-contact.php'    => 'page-templates/contact.php',
        'template-job-detail.php' => 'page-templates/job-detail.php',
        'template-projects.php'   => 'page-templates/projects.php',
        'template-services.php'   => 'page-templates/services.php',
    ];

    foreach ($template_map as $legacy_template => $current_template) {
        $updated = $wpdb->update(
            $wpdb->postmeta,
            ['meta_value' => $current_template],
            [
                'meta_key'   => '_wp_page_template',
                'meta_value' => $legacy_template,
            ],
            ['%s'],
            ['%s', '%s']
        );

        if ($updated === false) {
            return;
        }
    }

    update_option('hacoled_theme_schema_version', $target_version, false);
}
add_action('after_setup_theme', 'hacoled_run_theme_upgrades', 20);
