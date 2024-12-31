<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Add SVG support and restrict uploads based on the selected capabilities
add_filter('upload_mimes', function ($upload_mimes) {
    // Get the options
    $options = devops_general_options();
    $svg_upload_capability = (array)($options['svg_upload_capability'] ?? ['manage_options']); // Default to manage_options

    // Allow SVG uploads only if the current user has one of the required capabilities
    foreach ($svg_upload_capability as $capability) {
        if (current_user_can($capability)) {
            $upload_mimes['svg']  = 'image/svg+xml';
            $upload_mimes['svgz'] = 'image/svg+xml'; // Support for compressed SVG
            break; // Stop checking once a valid capability is found
        }
    }

    return $upload_mimes;
});

// Sanitize SVG content and restrict uploads based on the selected capabilities
add_filter('wp_handle_upload_prefilter', function ($file) {
    // Get the options
    $options = devops_general_options();
    $svg_upload_capability = (array)($options['svg_upload_capability'] ?? ['manage_options']); // Default to manage_options

    // Check if the file is an SVG
    if ($file['type'] === 'image/svg+xml') {
        // Restrict SVG uploads to users with the required capabilities
        $has_permission = false;
        foreach ($svg_upload_capability as $capability) {
            if (current_user_can($capability)) {
                $has_permission = true;
                break;
            }
        }

        if (!$has_permission) {
            $file['error'] = __('You do not have permission to upload SVG files.');
            return $file;
        }

        // Get the file content
        $file_content = file_get_contents($file['tmp_name']);

        // Check if the SVG contains unsafe elements (blocking potentially malicious code)
        if (preg_match('/<\/?(script|iframe|embed|object|form|input)/i', $file_content)) {
            $file['error'] = __('The SVG file contains forbidden elements and cannot be uploaded.');
        }
    }

    return $file;
});


// Validate MIME and file extension for SVG files
add_filter('wp_check_filetype_and_ext', function ($wp_check_filetype_and_ext, $file, $filename, $mimes, $real_mime) {
    if (!$wp_check_filetype_and_ext['type']) {
        $check_filetype  = wp_check_filetype($filename, $mimes);
        $ext             = $check_filetype['ext'];
        $type            = $check_filetype['type'];
        $proper_filename = $filename;

        if ($type && strpos($type, 'image/') === 0 && $ext !== 'svg') {
            $ext  = false;
            $type = false;
        }

        $wp_check_filetype_and_ext = compact('ext', 'type', 'proper_filename');
    }

    return $wp_check_filetype_and_ext;
}, 10, 5);

// Proper display of SVG files in the admin panel
add_action('admin_head', function () {
    echo '<style>
        .attachment-266x266, .thumbnail img[src$=".svg"] {
            width: 100% !important;
            height: auto !important;
        }
    </style>';
});