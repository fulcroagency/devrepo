<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;


/* Register Settings */
add_action('admin_init', function () {
    
    // Register "Plugin Settings" group
    register_setting('dev_options_group', 'dev_options_plugins');
    
    // Add "Plugin Settings" section
    add_settings_section(
        'plugin_settings', // Section ID
        'Plugin Settings', // Section title
        function () {
            echo '<p>Settings related to plugin-specific tools and integrations.</p>'; // Section description
        },
        'dev_options_plugins' // Page where section will be displayed
    );
    
    /* Settings Fields */
    
    // CF7 Remove Assets
    add_settings_field(
        'cf7_remove_assets', // Field ID
        'CF7 Remove Assets', // Field label
        'cf7_remove_assets_callback', // Callback to render field
        'dev_options_plugins', // Page where field will be displayed
        'plugin_settings' // Field section ID
    );
    
    // CF7 Syntax Highlighting
    add_settings_field(
        'cf7_syntax_highlighting', // Field ID
        'CF7 Syntax Highlighting', // Field label
        'cf7_syntax_highlighting_callback', // Callback to render field
        'dev_options_plugins', // Page where field will be displayed
        'plugin_settings' // Field section ID
    );
});