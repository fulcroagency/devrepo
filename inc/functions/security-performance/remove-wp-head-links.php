<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;


function devops_remove_wp_head_links() {
    // get options
    $options = devops_security_performance_options();
    $config = $options['remove_wp_head_links']['config'] ?? 'all'; // default to "all" if not set

    // enable all options
    if ($config === 'all') {
        remove_action('wp_head', 'rsd_link', 10);
        remove_action('wp_head', 'wp_generator', 10);
        remove_action('wp_head', 'wlwmanifest_link', 10);
        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'feed_links_extra', 3);
        remove_action('wp_head', 'wp_shortlink_wp_head', 10);
        return;
    }

    // enable selected custom options
    if ($config === 'custom') {
        if (($options['remove_wp_head_links']['rsd_link'] ?? 0) == '1') {
            remove_action('wp_head', 'rsd_link', 10);
        }

        if (($options['remove_wp_head_links']['wp_generator'] ?? 0) == '1') {
            remove_action('wp_head', 'wp_generator', 10);
        }

        if (($options['remove_wp_head_links']['wlwmanifest'] ?? 0) == '1') {
            remove_action('wp_head', 'wlwmanifest_link', 10);
        }

        if (($options['remove_wp_head_links']['feed_links'] ?? 0) == '1') {
            remove_action('wp_head', 'feed_links', 2);
            remove_action('wp_head', 'feed_links_extra', 3);
        }

        if (($options['remove_wp_head_links']['shortlink'] ?? 0) == '1') {
            remove_action('wp_head', 'wp_shortlink_wp_head', 10);
        }
    }
}
add_action('init', 'devops_remove_wp_head_links', 20);
