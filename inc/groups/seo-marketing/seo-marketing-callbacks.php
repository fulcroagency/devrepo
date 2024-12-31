<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Sanitize Filenames
function noindex_admin_bar_notify_callback() {
    $options = devops_seo_marketing_options(); // get options
    $value = $options['noindex_admin_bar_notify'] ?? '';
    echo '<label>';
    echo '<input type="checkbox" id="noindex-admin-bar-notify" name="dev_options_seo_marketing[noindex_admin_bar_notify]" value="1" ' . checked(1, $value, false) . '> Enable';
    echo '</label>';
}
