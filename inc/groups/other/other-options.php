<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;


add_action('init', function () {
    $options = devops_other_options();
    if (!is_array($options)) {
        return;
    }
    
    // Add Slug as Body Class
    if (($options['slug_as_body_class'] ?? 0) == 1) {
        require_once DEV_OPTIONS_FUNC . 'other/slug-as-body-class.php';
    }


});