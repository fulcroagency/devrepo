<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Check if GeneratePress theme or its child theme is active
function is_generatepress() {
    $active_theme = wp_get_theme();
    return $active_theme->get('Template') === 'generatepress' || $active_theme->get('Name') === 'GeneratePress';
}

// Check if Contact From 7 plugin is active
function is_cf7_active() {
    return class_exists('WPCF7');
}
function is_cf7_inactive() {
    if (!is_cf7_active()) {
        echo '<span class="inactive-plugin">"Contact Form 7" plugin must be installed and active to configure these options.</span>';
        return true;
    }
    return false;
}