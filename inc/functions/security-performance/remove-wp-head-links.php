<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;


function devops_remove_wp_head_links() {
    // get options
    $options = devops_security_performance_options();
    
    if (($options['remove_wp_head_links']['rsd_link'] ?? 0) == '1') {
        // Remove RSD link to "xml-rpc.php" file
        remove_action('wp_head', 'rsd_link');
    }

    if (($options['remove_wp_head_links']['wp_generator'] ?? 0) == '1') {
        // remove WP version from meta
        remove_action('wp_head', 'wp_generator');
    }

    if (($options['remove_wp_head_links']['wlwmanifest'] ?? 0) == '1') {
        // remove windows live writer link
        remove_action('wp_head', 'wlwmanifest_link');
    }

    if (($options['remove_wp_head_links']['feed_links'] ?? 0) == '1') {
        // remove feed links
        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'feed_links_extra', 3);
    }
    
    if (($options['remove_wp_head_links']['shortlink'] ?? 0) == '1') {
        // remove shortlinks
        remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    }
}
add_action('init', 'devops_remove_wp_head_links', 20);