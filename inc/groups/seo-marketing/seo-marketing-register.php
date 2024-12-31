<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/* Register Settings */
add_action('admin_init', function () {
    
    // register general settings group
    register_setting('dev_options_group', 'dev_options_seo_marketing');
    
    // general setting section
    add_settings_section(
        'seo_marketing_settings', // section ID
        'SEO / Marketing Settings', // section title
        function () {
            echo '<p>Settings related to SEO and marketing tools and configurations.</p>'; // section description
        },
        'dev_options_seo_marketing' // page where section will be displayed
    );
    
    /* Settings Fields */
    
    // Sanitize Filenames
    add_settings_field(
        'noindex_admin_bar_notify', // field ID
        'Noindex Admin Bar Notify', // field label
        'noindex_admin_bar_notify_callback', // callback to render field
        'dev_options_seo_marketing', // page where field will be displayed
        'seo_marketing_settings' // field section ID
    );

});