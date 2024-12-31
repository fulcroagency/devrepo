<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;


add_action('init', function () {
    $options = devops_security_performance_options();
    if (!is_array($options)) {
        return;
    }
    
    // Disable XML-RPC
    if (($options['disable_xmlrpc'] ?? 0) == 1) {
        require_once DEV_OPTIONS_FUNC . 'security-performance/disable-xmlrpc.php';
    }

    // Remove WP Head Links
    if (($options['remove_wp_head_links']['enable'] ?? 0) == 1) {
        require_once DEV_OPTIONS_FUNC . 'security-performance/remove-wp-head-links.php';
    }
    
    // Remove WP Version
    if (($options['remove_wp_version'] ?? 0) == 1) {
        require_once DEV_OPTIONS_FUNC . 'security-performance/remove-wp-version.php';
    }
    
    // Users security
    if (($options['users_security']['enable'] ?? 0) == 1) {
        require_once DEV_OPTIONS_FUNC . 'security-performance/users-security.php';
    }

    // Disable Emojis
    if (($options['disable_emojis'] ?? 0) == 1) {
        require_once DEV_OPTIONS_FUNC . 'security-performance/disable-emojis.php';
    }
});