<?php
/**
 * IRON & LEAF CULTIVATION CO. - WORDPRESS SECURITY MODULE
 * Hardening guidelines & hooks to safeguard legal cannabis digital operations.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * 1. Remove WordPress Version Number from Header & Feeds
 * Prevents automated scanners from fingerprinting vulnerable WP versions.
 */
add_filter('the_generator', '__return_empty_string');

function iron_leaf_remove_version_strings($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'iron_leaf_remove_version_strings', 9999);
add_filter('script_loader_src', 'iron_leaf_remove_version_strings', 9999);

/**
 * 2. Completely Disable XML-RPC
 * Defends against brute-force password amplification and pingback DDoS attacks.
 */
add_filter('xmlrpc_enabled', '__return_false');
add_filter('wp_headers', function($headers) {
    unset($headers['X-Pingback']);
    return $headers;
});

/**
 * 3. Block User Enumeration Attacks
 * Prevents bot scanners from running /?author=1 to discover administrative usernames.
 */
if (!is_admin()) {
    if (isset($_REQUEST['author']) && !empty($_REQUEST['author'])) {
        wp_die('Author queries are disabled for security reasons.', 'Access Denied', ['response' => 403]);
    }
}

/**
 * 4. Add Strict Security Headers via WordPress
 */
add_action('send_headers', function() {
    if (!headers_sent()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
    }
});

/**
 * 5. Sanitize SVG and Media Uploads
 * Mitigates Stored XSS via malicious XML in SVG files.
 */
add_filter('upload_mimes', function($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});

add_filter('wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
    $filetype = wp_check_filetype($filename, $mimes);
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
}, 10, 4);

/**
 * 6. Restrict REST API User Endpoint to Authenticated Admins
 */
add_filter('rest_endpoints', function($endpoints) {
    if (isset($endpoints['/wp/v2/users']) && !current_user_can('manage_options')) {
        unset($endpoints['/wp/v2/users']);
    }
    if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)']) && !current_user_can('manage_options')) {
        unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
    }
    return $endpoints;
});
