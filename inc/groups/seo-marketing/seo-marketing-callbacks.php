<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Discourage search engines from indexing notify in admin bar
function noindex_admin_bar_notify_callback() {
    $options = devops_seo_marketing_options(); // get options
    $value = $options['noindex_admin_bar_notify'] ?? '';
    
    echo '<label>';
        echo '<input type="checkbox" id="noindex-admin-bar-notify" name="dev_options_seo_marketing[noindex_admin_bar_notify]" value="1" ' . checked(1, $value, false) . '> Enable';
    echo '</label>';
}

// Redirect 404 to Home
function redirect_404_callback() {
    // get options
    $options = devops_seo_marketing_options();
    $enabled = $options['redirect_404']['enabled'] ?? '';
    $redirect_type = $options['redirect_404']['type'] ?? '301'; // Default to 301 if not set

    // Enable
    echo '<label>';
        echo '<input type="checkbox" id="redirect-404" name="dev_options_seo_marketing[redirect_404][enabled]" value="1" ' . 
         checked(1, $enabled, false) . ' data-toggle="redirect-404-options"> Enable';
    echo '</label>';

    // Additional options
    echo '<fieldset id="redirect-404-options" class="additional-options">';

        // Radio buttons
        echo '<label>';
            echo '<input type="radio" id="redirect-404-type-301" name="dev_options_seo_marketing[redirect_404][type]" value="301" ' . 
         checked('301', $redirect_type, false) . '> 301 - Permanent ';
        echo '</label>';
        echo '<label>';
            echo '<input type="radio" id="redirect-404-type-302" name="dev_options_seo_marketing[redirect_404][type]" value="302" ' . 
         checked('302', $redirect_type, false) . '> 302 - Temporary';
        echo '</label>';
    
    echo '</fieldset>';

}


// Disable Scheam
function disable_schema_callback() {
    
    // Check if GeneratePress theme is active
    if (is_generatepress_inactive()) {
        return; // show notice and stop function
    }
    
    $options = devops_seo_marketing_options(); // get options
    $value = $options['disable_schema'] ?? '';
    
    echo '<label>';
        echo '<input type="checkbox" id="disable-schema" name="dev_options_seo_marketing[disable_schema]" value="1" ' . checked(1, $value, false) . (is_generatepress_active() ? '' : ' disabled') . '> Enable';
    echo '</label>';
}
