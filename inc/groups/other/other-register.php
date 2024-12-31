<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/* Register Settings */
add_action('admin_init', function () {
    
    // Register "Other Settings" group
    register_setting('dev_options_group', 'dev_options_other');
    
    // Add "Other Settings" section
    add_settings_section(
        'other_settings', // Section ID
        'Other Settings', // Section title
        function () {
            echo '<p>Settings related to other functions and configurations.</p>'; // Section description
        },
        'dev_options_other' // Page where section will be displayed
    );
    
    /* Settings Fields */
    
    // Add Slug as Body Class
    add_settings_field(
        'slug_as_body_class', // Field ID
        'Add Slug as Body Class', // Field label
        'slug_as_body_class_callback', // Callback to render field
        'dev_options_other', // Page where field will be displayed
        'other_settings' // Field section ID
    );
});