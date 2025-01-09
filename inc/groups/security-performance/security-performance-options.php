<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;


add_action('init', function () {
    $options = devops_security_performance_options();
    if (!is_array($options)) {
        return;
    }
    
    // Remove WP Head Links
    if (($options['email_encoder']['enabled'] ?? 0) == 1) {
        require_once DEV_OPTIONS_FUNC . 'security-performance/email-encoder.php';
    }
    
    // Disable XML-RPC
    if (($options['disable_xmlrpc'] ?? 0) == 1) {
        require_once DEV_OPTIONS_FUNC . 'security-performance/disable-xmlrpc.php';
    }

    // Remove WP Head Links
    if (($options['remove_wp_head_links']['enabled'] ?? 0) == 1) {
        require_once DEV_OPTIONS_FUNC . 'security-performance/remove-wp-head-links.php';
    }
    
    // Remove WP Version
    if (($options['remove_wp_version'] ?? 0) == 1) {
        require_once DEV_OPTIONS_FUNC . 'security-performance/remove-wp-version.php';
    }
    
    // Users security
    if (($options['users_security']['enabled'] ?? 0) == 1) {
        require_once DEV_OPTIONS_FUNC . 'security-performance/users-security.php';
    }
    
    // Users security
    if (($options['restrict_dashboard']['enabled'] ?? 0) == 1) {
        require_once DEV_OPTIONS_FUNC . 'security-performance/restrict-dashboard-access.php';
    }

    // Disable Emojis
    if (($options['disable_emojis'] ?? 0) == 1) {
        require_once DEV_OPTIONS_FUNC . 'security-performance/disable-emojis.php';
    }
    
    // Disable Comments
    if (($options['disable_comments'] ?? 0) == 1) {
        require_once DEV_OPTIONS_FUNC . 'security-performance/disable-comments.php';
    }
});