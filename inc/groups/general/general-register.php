<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/* Register Settings */
add_action('admin_init', function () {
    
    // register general settings group
    register_setting('dev_options_group', 'dev_options_general');
    
    // general setting section
    add_settings_section(
        'general_settings', // section ID
        'General Settings', // section title
        function () {
            echo '<p>Settings related to general-purpose functions.</p>'; // section description
        },
        'dev_options_general' // page where section will be displayed
    );
    
    /* Settings Fields */
    
    // Sanitize Filenames
    add_settings_field(
        'sanitize_filenames', // field ID
        'Sanitize Filenames', // field label
        'sanitize_filenames_callback', // callback to render field
        'dev_options_general', // page where field will be displayed
        'general_settings' // field section ID
    );
    
    // SVG Upload
    add_settings_field(
        'svg_upload', // field ID
        'SVG Upload', // field label
        'svg_upload_callback', // callback to render field
        'dev_options_general', // page where field will be displayed
        'general_settings' // field section ID
    );
    
    // GTM Code Insert
    add_settings_field(
        'gtm_insert', // field ID
        'GTM Code Insert', // field label
        'gtm_insert_callback', // callback to render field
        'dev_options_general', // page where field will be displayed
        'general_settings' // field section ID
    );
});