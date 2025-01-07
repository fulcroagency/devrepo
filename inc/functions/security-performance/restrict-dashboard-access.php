<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

function devops_disable_dashboard() {
    // get options
    $options = devops_security_performance_options();
    $config = $options['restrict_dashboard']['config'] ?? 'admin'; // default to "admin" if not set
    $roles = $options['restrict_dashboard']['roles'] ?? []; // empty array if not set
    
    // redirect from admin if user is not administrator
    if ($config === 'admin') {
        if (!current_user_can('administrator') && is_admin()) {
            wp_redirect(home_url());
            exit;
        }
    }
    
    // redirect from admin for selected roles
    if ($config === 'selected') {
        $current_user_roles = wp_get_current_user()->roles;
        $restricted_roles = count(array_intersect($current_user_roles, $roles)) > 0;
        if ($restricted_roles) {
            wp_redirect(home_url());
            exit;
        }
    }
}
add_action('admin_init', 'devops_disable_dashboard');


function devops_hide_admin_bar() {
    // get options
    $options = devops_security_performance_options();
    $config = $options['restrict_dashboard']['config'] ?? 'admin'; // default to "admin" if not set
    $roles = $options['restrict_dashboard']['roles'] ?? []; // empty array if not set
    
    // hide admin bar if user is not administrator
    if ($config === 'admin') {
        if (!current_user_can('administrator')) {
            show_admin_bar(false);
        }
    }
    
    // hide admin bar for selected roles
    if ($config === 'selected') {  
        $current_user_roles = wp_get_current_user()->roles;
        $restricted_roles = count(array_intersect($current_user_roles, $roles)) > 0;
        $no_roles = empty($current_user_roles);
        if ($restricted_roles || $no_roles) {
            show_admin_bar(false);
        }
    }
}
add_action('init', 'devops_hide_admin_bar', 20);