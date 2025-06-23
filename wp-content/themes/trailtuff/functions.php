<?php
// Theme setup
function tailwind_woo_setup() {
    add_theme_support('woocommerce');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'gallery', 'caption'));
}
add_action('after_setup_theme', 'tailwind_woo_setup');

// Enqueue scripts & styles
function tailwind_woo_enqueue_scripts() {
    wp_enqueue_style('tailwind-css', get_template_directory_uri() . '/assets/css/tailwind.css', array(), filemtime(get_template_directory() . '/assets/css/tailwind.css'));
}
add_action('wp_enqueue_scripts', 'tailwind_woo_enqueue_scripts');

// WooCommerce template override path
function tailwind_woo_woocommerce_template_path() {
    return 'woocommerce/';
}
add_filter('woocommerce_template_path', 'tailwind_woo_woocommerce_template_path');

// Disable WooCommerce styles (optional)
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

function tailwind_woo_register_menus() {
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'tailwind-woo'),
        'footer_left'  => 'Footer Left',
        'footer_right' => 'Footer Right',
    ));
}
add_action('after_setup_theme', 'tailwind_woo_register_menus');

function companystart_enqueue_styles() {
    wp_enqueue_style('tailwindcss', get_template_directory_uri() . '/src/output.css', array(), null);
}
add_action('wp_enqueue_scripts', 'companystart_enqueue_styles');

// Load all CPT files from /cpt/
foreach ( glob( get_template_directory() . '/cpt/*.php' ) as $cpt_file ) {
    require_once $cpt_file;
}

function enqueue_theme_scripts() {
    wp_enqueue_script(
        'custom-js',
        get_stylesheet_directory_uri() . '/src/main.js',
        array(),
        filemtime(get_stylesheet_directory() . '/src/main.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_theme_scripts');


class Tailwind_Navwalker extends Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"ml-4 space-y-2\">\n";
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty( $item->classes ) ? [] : (array) $item->classes;
        $classes[] = 'menu-item';

        $class_names = implode( ' ', array_filter( $classes ) );
        $output .= "<li class=\"px-3 m-0 {$class_names}\">";

        $attributes  = !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= ' class="block text-base text-browndark hover:text-redmain transition duration-300 py-4"';

        $output .= '<a' . $attributes . '>';
        $output .= esc_html($item->title);
        $output .= '</a>';
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= "</li>\n";
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= "</ul>\n";
    }
}

class Tailwind_Desktop_Navwalker extends Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"ml-4 space-y-2\">\n";
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty( $item->classes ) ? [] : (array) $item->classes;
        $classes[] = 'menu-item';

        $class_names = implode( ' ', array_filter( $classes ) );
        $output .= "<li class=\"{$class_names}\">";

        $attributes  = !empty($item->url) ? ' href="' . esc_url($item->url) . '"' : '';
        $attributes .= ' class="hover:text-browndark transition-colors duration-300"';

        $output .= '<a' . $attributes . '>';
        $output .= esc_html($item->title);
        $output .= '</a>';
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= "</li>\n";
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= "</ul>\n";
    }
}

function remove_block_library_css() {
    wp_dequeue_style('wp-block-library'); // Front-end block styles
    wp_dequeue_style('wp-block-library-theme'); // Default block theme styles
    wp_dequeue_style('global-styles'); // Global styles added by theme.json
}
add_action('wp_enqueue_scripts', 'remove_block_library_css', 100);

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');

function theme_enqueue_swiper() {
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], null, true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_swiper');