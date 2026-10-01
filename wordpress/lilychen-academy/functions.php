<?php
/**
 * Lily Chen Academy Theme Functions and Definitions
 *
 * @package LilyChen_Academy
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('LILYCHEN_VERSION', '1.0.0');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function lilychen_setup() {
    // Make theme available for translation.
    load_theme_textdomain('lilychen-academy', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title. Do NOT hardcode <title> in header.php.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1200, 675, true);

    // Register navigation menus.
    register_nav_menus(array(
        'primary' => esc_html__('Menu Chính (Header)', 'lilychen-academy'),
        'footer'  => esc_html__('Menu Chân Trang (Footer)', 'lilychen-academy'),
    ));

    // Switch default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Custom logo support.
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 220,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // Responsive embeds support.
    add_theme_support('responsive-embeds');

    // Align wide support for Gutenberg.
    add_theme_support('align-wide');
}
add_action('after_setup_theme', 'lilychen_setup');

/**
 * Enqueue scripts and styles.
 */
function lilychen_scripts() {
    // 1. Google Fonts: Playfair Display & Plus Jakarta Sans
    wp_enqueue_style(
        'lilychen-google-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );

    // 2. Main Design System Stylesheet
    wp_enqueue_style(
        'lilychen-main-style',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        LILYCHEN_VERSION
    );

    // 3. Theme Core Stylesheet (header info & WP standard classes)
    wp_enqueue_style(
        'lilychen-theme-style',
        get_stylesheet_uri(),
        array('lilychen-main-style'),
        LILYCHEN_VERSION
    );

    // 4. Main Interactive Script (Particles canvas, accordion, mobile drawer, prototype test form)
    wp_enqueue_script(
        'lilychen-main-script',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        LILYCHEN_VERSION,
        true // In footer for performance
    );

    // 5. Localize script with dynamic URLs and settings (works under /staging/ seamlessly)
    wp_localize_script('lilychen-main-script', 'lilychenVars', array(
        'homeUrl'      => home_url('/'),
        'templateUri'  => get_template_directory_uri(),
        'isStaging'    => (strpos(home_url(), '/staging') !== false),
        'formTestMode' => true,
    ));
}
add_action('wp_enqueue_scripts', 'lilychen_scripts');

/**
 * Fallback menu when no menu has been assigned yet in WordPress Admin
 */
function lilychen_primary_menu_fallback() {
    $is_khoa_hoc = is_page('khoa-hoc') || is_page_template('page-khoa-hoc.php');
    ?>
    <nav class="desktop-nav" aria-label="<?php esc_attr_e('Menu chính', 'lilychen-academy'); ?>">
        <a href="<?php echo esc_url(home_url('/gioi-thieu/')); ?>" class="nav-link"><?php esc_html_e('Giới Thiệu', 'lilychen-academy'); ?></a>
        <a href="<?php echo esc_url(home_url('/khoa-hoc/')); ?>" class="nav-link<?php echo $is_khoa_hoc ? ' active' : ''; ?>"><?php esc_html_e('Khóa Học', 'lilychen-academy'); ?></a>
        <a href="<?php echo esc_url(home_url('/portfolio/')); ?>" class="nav-link"><?php esc_html_e('Tác Phẩm', 'lilychen-academy'); ?></a>
        <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="nav-link"><?php esc_html_e('Blog', 'lilychen-academy'); ?></a>
    </nav>
    <?php
}

/**
 * Fallback mobile menu when no menu has been assigned yet in WordPress Admin
 */
function lilychen_mobile_menu_fallback() {
    $is_khoa_hoc = is_page('khoa-hoc') || is_page_template('page-khoa-hoc.php');
    ?>
    <ul class="mobile-nav-list">
        <li><a href="<?php echo esc_url(home_url('/gioi-thieu/')); ?>" class="mobile-nav-link"><?php esc_html_e('Giới Thiệu', 'lilychen-academy'); ?></a></li>
        <li><a href="<?php echo esc_url(home_url('/khoa-hoc/')); ?>" class="mobile-nav-link<?php echo $is_khoa_hoc ? ' active' : ''; ?>"><?php esc_html_e('Khóa Học', 'lilychen-academy'); ?></a></li>
        <li><a href="<?php echo esc_url(home_url('/portfolio/')); ?>" class="mobile-nav-link"><?php esc_html_e('Tác Phẩm', 'lilychen-academy'); ?></a></li>
        <li><a href="<?php echo esc_url(home_url('/blog/')); ?>" class="mobile-nav-link"><?php esc_html_e('Blog', 'lilychen-academy'); ?></a></li>
    </ul>
    <?php
}

/**
 * Custom excerpt length and read more text
 */
function lilychen_custom_excerpt_length($length) {
    return 24;
}
add_filter('excerpt_length', 'lilychen_custom_excerpt_length', 999);

function lilychen_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'lilychen_excerpt_more');

/**
 * Include Customizer, Editor Admin Panel, Block Patterns, and Helper Tags
 */
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/admin-editor.php';
require_once get_template_directory() . '/inc/block-patterns.php';

