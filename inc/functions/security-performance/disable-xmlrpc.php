<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

function devops_disable_xmlrpc() {
    // Disable XML-RPC
    add_filter( 'xmlrpc_enabled', '__return_false' );
}
add_action('init', 'devops_disable_xmlrpc', 20);

