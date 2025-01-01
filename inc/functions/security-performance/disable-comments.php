<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Disable support for comments and trackbacks in post types
function devops_disable_comments_support() {
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'devops_disable_comments_support');

// Remove comments page in admin menu
function devops_disable_comments_menu_page() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'devops_disable_comments_menu_page');

// Remove comments link in admin bar
function devops_disable_comments_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'devops_disable_comments_admin_bar');

// Remove comments metabox from dashboard
function devops_disable_comments_dashboard_metabox() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'devops_disable_comments_dashboard_metabox');

// Redirect from comments page to admin dashboard
function devops_disable_comments_page_redirect() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url('options-general.php?page=dev-options#security-performance'));
        exit;
    }
}
add_action('admin_init', 'devops_disable_comments_page_redirect');