<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;


add_action('init', function () {
    $options = devops_seo_marketing_options(); // get options
    if (!is_array($options)) {
        return;
    }

    // Discourage search engines from indexing notify in admin bar
    if (($options['noindex_admin_bar_notify'] ?? 0) == 1) {
        require_once DEV_OPTIONS_FUNC . 'seo-marketing/noindex-admin-bar-notify.php';
    }
    
    // Disable schema
    if (($options['disable_schema'] ?? 0) == 1) {
        require_once DEV_OPTIONS_FUNC . 'seo-marketing/disable-schema.php';
    }
    
});