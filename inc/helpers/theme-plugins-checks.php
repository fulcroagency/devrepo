<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Check if GeneratePress theme or its child theme is active
function is_generatepress_active() {
    $active_theme = wp_get_theme();
    return $active_theme->get('Template') === 'generatepress' || $active_theme->get('Name') === 'GeneratePress';
}
// Show info that some options are available only when the GeneratePress theme is inactive
function is_generatepress_inactive() {
    if (!is_generatepress_active()) {
        echo '<span class="inactive-theme">Disabled options are available only when the "GeneratePress" theme or its child theme is active.</span>';
        return true;
    }
    return false;
}

// Check if Contact From 7 plugin is active
function is_cf7_active() {
    return class_exists('WPCF7');
}
// Show info that plugin must be installed and active to configure these options
function is_cf7_inactive() {
    if (!is_cf7_active()) {
        echo '<span class="inactive-plugin">"Contact Form 7" plugin must be installed and active to configure these options.</span>';
        return true;
    }
    return false;
}