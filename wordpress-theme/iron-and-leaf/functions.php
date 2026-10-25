<?php
/**
 * IRON & LEAF CULTIVATION CO. - THEME FUNCTIONS
 * Modern, Secure & Fast WordPress Theme for Craft Cannabis & Motorcycle Culture
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. Include Dedicated Modules
require_once get_template_directory() . '/inc/security.php';
require_once get_template_directory() . '/inc/cpt-strains.php';

// 2. Theme Setup
function iron_leaf_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('responsive-embeds');

    // Register Nav Menus
    register_nav_menus([
        'primary-menu' => __('Primary Navigation', 'iron-and-leaf'),
        'footer-menu'  => __('Footer Navigation', 'iron-and-leaf'),
    ]);
}
add_action('after_setup_theme', 'iron_leaf_theme_setup');

// 3. Enqueue Styles & Scripts
function iron_leaf_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style(
        'iron-leaf-fonts',
        'https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cinzel:wght@600;800;900&family=Inter:wght@300;400;500;600;700&display=swap',
        [],
        null
    );

    // Main Theme Stylesheet
    wp_enqueue_style(
        'iron-leaf-style',
        get_template_directory_uri() . '/assets/css/style.css',
        [],
        '1.0.0'
    );

    // Main JavaScript
    wp_enqueue_script(
        'iron-leaf-script',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        '1.0.0',
        true
    );

    // Pass Nonce and AJAX URL to JavaScript for Web Security
    wp_localize_script('iron-leaf-script', 'IronLeafSecurity', [
        'ajax_url'   => admin_url('admin-ajax.php'),
        'csrf_nonce' => wp_create_nonce('iron_leaf_secure_inquiry_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'iron_leaf_enqueue_assets');

// 4. Secure AJAX Handler for Inquiries inside WordPress
function iron_leaf_handle_ajax_inquiry() {
    // Verify Security Nonce (Anti-CSRF)
    check_ajax_referer('iron_leaf_secure_inquiry_nonce', 'csrf_token');

    // Honeypot spam trap
    if (!empty($_POST['biker_secret_field'])) {
        wp_send_json_error(['error' => 'Bot activity detected.'], 403);
    }

    $name    = sanitize_text_field($_POST['fullname'] ?? '');
    $email   = sanitize_email($_POST['email'] ?? '');
    $phone   = sanitize_text_field($_POST['phone'] ?? '');
    $license = sanitize_text_field($_POST['license_no'] ?? '');
    $type    = sanitize_text_field($_POST['inquiry_type'] ?? 'general');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    if (empty($name) || !is_email($email) || empty($message)) {
        wp_send_json_error(['error' => 'Please fill out all required fields with valid data.'], 422);
    }

    // In production, save to custom post type or email admin
    wp_send_json_success([
        'message' => 'Encrypted dispatch received! Our dispensary crew will reach out within 24 hours.'
    ]);
}
add_action('wp_ajax_iron_inquiry', 'iron_leaf_handle_ajax_inquiry');
add_action('wp_ajax_nopriv_iron_inquiry', 'iron_leaf_handle_ajax_inquiry');
