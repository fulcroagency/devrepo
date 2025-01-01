<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;


add_action('init', function () {
    $options = devops_plugins_options();
    if (!is_array($options)) {
        return;
    }

    // CF7 Syntax Highlighting
    if (($options['cf7_remove_assets'] ?? 0) == 1 && is_cf7_active()) {
        require_once DEV_OPTIONS_FUNC . 'plugins/cf7-remove-assets.php';
    }
    
    // CF7 Syntax Highlighting
    if (($options['cf7_syntax_highlighting']['enable'] ?? '') == '1' && is_cf7_active()) {
        require_once DEV_OPTIONS_FUNC . 'plugins/cf7-syntax-highlighting.php';
    }

});