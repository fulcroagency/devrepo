<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// get options
$options = devops_security_performance_options();

// Prevent enumeration
function devops_prevent_user_enumeration() {
    if (isset($_GET['author']) && is_numeric($_GET['author'])) {
        wp_redirect(home_url()); // Redirect to home
        exit;
    }
}
// add function if option is enabled
if (($options['users_security']['enumeration'] ?? 0) == 1) {
    add_action('init', 'devops_prevent_user_enumeration', 20);
}


// Disable author pages
function devops_disable_author_pages() {
    if (is_author()) {
        wp_redirect(home_url()); // Redirect to home
        exit;
    }
}
// add function if option is enabled
if (($options['users_security']['disable_pages'] ?? 0) == 1) {
    add_action('template_redirect', 'devops_disable_author_pages');
}


// Remove users from sitemap
function devops_remove_users_sitemap($args) {
    return ['include' => [0]]; // force an empty users list
}
// add function if option is enabled
if (($options['users_security']['remove_sitemap'] ?? 0) == 1) {
    add_filter('wp_sitemaps_users_query_args', 'devops_remove_users_sitemap');
}


// Disable REST API user endpoints
function devops_restrict_rest_api_users_endpoints($endpoints) {
    
    if (!is_user_logged_in()) {
        if (isset($endpoints['/wp/v2/users'])) {
            unset($endpoints['/wp/v2/users']);
        }
        if (isset($endpoints['/wp/v2/users/(?P<id>[\\d]+)'])) {
            unset($endpoints['/wp/v2/users/(?P<id>[\\d]+)']);
        }
    }
    return $endpoints;
}
// add function if option is enabled
if (($options['users_security']['restrict_rest_api'] ?? 0) == 1) {
    add_filter('rest_endpoints', 'devops_restrict_rest_api_users_endpoints');
}
