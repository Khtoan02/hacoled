<?php
namespace HacoLED\Theme\Core;

/**
 * Base Controller class for handling views and component rendering
 */
class Controller {
    /**
     * Render a view and extract variables
     * 
     * @param string $view Name of the view file (excluding .php extension)
     * @param array $data Associative array of data to pass to the view
     */
    protected function render($view, $data = []) {
        extract($data, EXTR_SKIP);
        $file = get_template_directory() . "/views/{$view}.php";
        if (file_exists($file)) {
            include $file;
        } else {
            wp_die(sprintf(__('View template `views/%s.php` not found.', 'hacoled'), esc_html($view)));
        }
    }

    /**
     * Render a header module (default or custom)
     * 
     * @param string $name Name of the header variant (header-{$name}.php)
     * @param array $data Associative array of data
     */
    public function renderHeader($name = 'default', $data = []) {
        extract($data, EXTR_SKIP);
        do_action('get_header', $name, $data);
        $file = get_template_directory() . "/views/components/headers/header-{$name}.php";
        if (file_exists($file)) {
            include $file;
        } else {
            $default_file = get_template_directory() . "/views/components/headers/header-default.php";
            if (file_exists($default_file)) {
                include $default_file;
            } else {
                echo '<!-- Default header not found -->';
            }
        }
    }

    /**
     * Render a footer module (default or custom)
     * 
     * @param string $name Name of the footer variant (footer-{$name}.php)
     * @param array $data Associative array of data
     */
    public function renderFooter($name = 'default', $data = []) {
        extract($data, EXTR_SKIP);
        do_action('get_footer', $name, $data);
        $file = get_template_directory() . "/views/components/footers/footer-{$name}.php";
        if (file_exists($file)) {
            include $file;
        } else {
            $default_file = get_template_directory() . "/views/components/footers/footer-default.php";
            if (file_exists($default_file)) {
                include $default_file;
            } else {
                echo '<!-- Default footer not found -->';
            }
        }
    }

    /**
     * Render a reusable frontend UI component (e.g. product-card, button, etc.)
     * 
     * @param string $name Name of the component file (excluding .php extension)
     * @param array $data Associative array of data
     */
    public function renderComponent($name, $data = []) {
        extract($data, EXTR_SKIP);
        $file = get_template_directory() . "/views/components/{$name}.php";
        if (file_exists($file)) {
            include $file;
        } else {
            echo "<!-- Component component/{{$name}} not found -->";
        }
    }
}
