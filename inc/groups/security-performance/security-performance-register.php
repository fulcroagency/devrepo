<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;


/* Register Settings */
add_action('admin_init', function () {
    
    // register security / performance settings group
    register_setting('dev_options_group', 'dev_options_security_performance', 'sanitize_callback');
    
    // security / performance section
    add_settings_section(
        'security_performance_settings', // section ID
        'Security / Performance Settings', // section title
        function () {
            echo '<p>Settings related to security improvments and performance enhancements.</p>'; // Section description
        },
        'dev_options_security_performance' // page where section will be displayed
    );
    
    /* Settings Fields */
    
    // Disable XML-RPC
    add_settings_field(
        'disable_xmlrpc', // field ID
        'Disable XML-RPC', // field label
        'disable_xmlrpc_callback', // callback to render field
        'dev_options_security_performance', // page where field will be displayed
        'security_performance_settings' // field section ID
    );
    
    // Remove Links from Head
    add_settings_field(
        'remove_wp_head_links', // field ID
        'Remove WP Head Links', // field label
        'remove_wp_head_links_callback', // callback to render field
        'dev_options_security_performance', // page where field will be displayed
        'security_performance_settings' // field section ID
    );
    
    // Remove WP Version
    add_settings_field(
        'remove_wp_version', // field ID
        'Remove WP Version', // field label
        'remove_wp_version_callback', // callback to render field
        'dev_options_security_performance', // page where field will be displayed
        'security_performance_settings' // field section ID
    );
    
    // Disable REST API
    add_settings_field(
        'disable_rest_api', // field ID
        'Disable REST API', // field label
        'disable_rest_api_callback', // callback to render field
        'dev_options_security_performance', // page where field will be displayed
        'security_performance_settings' // field section ID
    );
    
    // Users Security
    add_settings_field(
        'users_security', // field ID
        'Users / Authors Security', // field label
        'users_security_callback', // callback to render field
        'dev_options_security_performance', // page where field will be displayed
        'security_performance_settings' // field section ID
    );
    
    // Disable Emojis
    add_settings_field(
        'disable_emojis', // field ID
        'Disable Emojis', // field label
        'disable_emojis_callback', // callback to render field
        'dev_options_security_performance', // page where field will be displayed
        'security_performance_settings' // field section ID
    );
});
