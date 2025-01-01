<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

function disable_xmlrpc_callback() {
    $options = devops_security_performance_options(); // get options 
    $value = $options['disable_xmlrpc'] ?? ''; // default to empty if not set
    
    echo '<label>';
    echo '<input type="checkbox" id="disable-xmlrpc" name="dev_options_security_performance[disable_xmlrpc]" value="1"' . checked(1, $value, false) . '/> Enable';
    echo '</label>';
}


function remove_wp_head_links_callback() {
    $options = devops_security_performance_options(); // get options 
    // default to empty if not set
    $enable = $options['remove_wp_head_links']['enable'] ?? '';
    $rsd_link = $options['remove_wp_head_links']['rsd_link'] ?? '';
    $wp_generator = $options['remove_wp_head_links']['wp_generator'] ?? '';
    $wlwmanifest = $options['remove_wp_head_links']['wlwmanifest'] ?? '';
    $feed_links = $options['remove_wp_head_links']['feed_links'] ?? '';
    $shortlink = $options['remove_wp_head_links']['shortlink'] ?? '';

    echo '<label>';
    echo '<input type="checkbox" id="remove-wp-head-links" name="dev_options_security_performance[remove_wp_head_links][enable]" value="1"' . checked(1, $enable, false) . ' data-toggle="remove-wp-head-links-options""> Enable';
    echo '</label>';

    echo '<div id="remove-wp-head-links-options" class="additional-options" style="margin-left: 20px;">';
    
    echo '<label>';
    echo '<input type="checkbox" id="remove-rsd-link" name="dev_options_security_performance[remove_wp_head_links][rsd_link]" value="1"' . checked(1, $rsd_link, false) . '> Remove RSD Link';
    echo '</label>';

    echo '<label>';
    echo '<input type="checkbox" id="remove-wp-generator" name="dev_options_security_performance[remove_wp_head_links][wp_generator]" value="1"' . checked(1, $wp_generator, false) . '> Remove WP Generator Tag';
    echo '</label>';

    echo '<label>';
    echo '<input type="checkbox" id="remove-wlwmanifest" name="dev_options_security_performance[remove_wp_head_links][wlwmanifest]" value="1"' . checked(1, $wlwmanifest, false) . '> Remove WLWManifest Link';
    echo '</label>';

    echo '<label>';
    echo '<input type="checkbox" id="remove-feed-links" name="dev_options_security_performance[remove_wp_head_links][feed_links]" value="1"' . checked(1, $feed_links, false) . '> Remove Feed Links';
    echo '</label>';
    
    echo '<label>';
    echo '<input type="checkbox" id="remove-shortlink" name="dev_options_security_performance[remove_wp_head_links][shortlink]" value="1"' . checked(1, $shortlink, false) . '> Remove Shortlink';
    echo '</label>';

    echo '</div>';
}

// Remove WP Version
function remove_wp_version_callback() {
    $options = devops_security_performance_options(); // get options 
    $value = $options['remove_wp_version'] ?? ''; // default to empty if not set
    
    echo '<label>';
    echo '<input type="checkbox" id="remove-wp-version" name="dev_options_security_performance[remove_wp_version]" value="1"' . checked(1, $value, false) . '/> Enable';
    echo '</label>';
}

// Disable REST API
function disable_rest_api_callback() {
    $options = devops_security_performance_options(); // get options 
    $value = $options['disable_rest_api'] ?? ''; // default to empty if not set
    
    echo '<label>';
    echo '<input type="checkbox" id="disable-rest-api" name="dev_options_security_performance[disable_rest_api]" value="1" ' . checked(1, $value, false) . '> Enable';
    echo '</label>';
}


function users_security_callback() {
    $options = devops_security_performance_options(); // get options 
    // default to empty if not set
    $enable = $options['users_security']['enable'] ?? '';
    $enumeration = $options['users_security']['enumeration'] ?? '';
    $disable_pages = $options['users_security']['disable_pages'] ?? '';
    $remove_sitemap = $options['users_security']['remove_sitemap'] ?? '';
    $restrict_rest_api = $options['users_security']['restrict_rest_api'] ?? '';
    $remove_links = $options['users_security']['remove_links'] ?? '';

    // Enable
    echo '<label>';
    echo '<input type="checkbox" id="users-security" name="dev_options_security_performance[users_security][enable]" value="1" ' . checked(1, $enable, false) . ' data-toggle="users-security-options"> Enable';
    echo '</label>';

    // Additional options
    echo '<div id="users-security-options" class="additional-options">';

    // Enumeration
    echo '<label>';
    echo '<input type="checkbox" id="users-security-enumeration" name="dev_options_security_performance[users_security][enumeration]" value="1" ' . checked(1, $enumeration, false) . '> Disable User Enumeration';
    echo '</label>';
    
    // Disable Author Pages
    echo '<label>';
    echo '<input type="checkbox" id="users-security-disable-pages" name="dev_options_security_performance[users_security][disable_pages]" value="1" ' . checked(1, $disable_pages, false) . '> Disable Author Pages';
    echo '</label>';
    
    // Remove Authors from Sitemap
    echo '<label>';
    echo '<input type="checkbox" id="users-security-remove-sitemap" name="dev_options_security_performance[users_security][remove_sitemap]" value="1" ' . checked(1, $remove_sitemap, false) . '> Remove Authors from Sitemap';
    echo '</label>';
    
    // Disable REST API for Users
    echo '<label>';
    echo '<input type="checkbox" id="users-security-restrict-rest-api" name="dev_options_security_performance[users_security][restrict_rest_api]" value="1" ' . checked(1, $restrict_rest_api, false) . '> Restrict REST API Users Endpoints';
    echo '</label>';
    
    echo '<label>';
    echo '<input type="checkbox" id="users-security-remove-links" name="dev_options_security_performance[users_security][remove_links]" value="1" ' . checked(1, $remove_links, false) . (is_generatepress() ? '' : ' disabled') . '> Remove Links to Author Pages';
    echo '</label>';

    echo '</div>';
    // Show info that some options are available only when the GeneratePress theme is inactive
    is_generatepress_inactive();
    
}


// Disable Emoji's
function disable_emojis_callback() {
    $options = devops_security_performance_options(); // get options 
    $value = $options['disable_emojis'] ?? ''; // default to empty if not set
    echo '<label>';
    echo '<input type="checkbox" id="disable-emojis" name="dev_options_security_performance[disable_emojis]" value="1" ' . checked(1, $value, false) . '> Enable';
    echo '</label>';
}

// Disable Comments
function disable_comments_callback() {
    $options = devops_security_performance_options(); // get options 
    $value = $options['disable_comments'] ?? ''; // default to empty if not set
    echo '<label>';
    echo '<input type="checkbox" id="disable-comments" name="dev_options_security_performance[disable_comments]" value="1" ' . checked(1, $value, false) . '> Enable';
    echo '</label>';
}