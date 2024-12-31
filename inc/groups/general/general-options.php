<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;


add_action('init', function () {
    $options = devops_general_options(); // get options
    if (!is_array($options)) {
        return;
    }

    // Sanitize Filenames
    if (($options['sanitize_filenames'] ?? 0) == 1) {
        require_once DEV_OPTIONS_FUNC . 'general/sanitize-filenames.php';
    }
    
    // SVG Upload
    if (($options['svg_upload'] ?? 0) == 1) {
        require_once DEV_OPTIONS_FUNC . 'general/svg-upload.php';
    }
});