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

// Disable Scheam
function disable_schema_callback() {
    $options = devops_seo_marketing_options(); // get options
    $value = $options['disable_schema'] ?? '';
    echo '<label>';
    echo '<input type="checkbox" id="disable-schema" name="dev_options_seo_marketing[disable_schema]" value="1" ' . checked(1, $value, false) . (is_generatepress() ? '' : ' disabled') . '> Enable';
    echo '</label>';
    // Show info that some options are available only when the GeneratePress theme is inactive
    is_generatepress_inactive();
}
