<?php
/*
Plugin Name: Dev Options
Description: A plugin for custom development options including security, performance, and more.
Version: 0.1
Author: Fulcro
Author URI: http://fulcro.pl/
*/

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Define constants
if (!defined('DEV_OPTIONS_FILE')) {
    define('DEV_OPTIONS_FILE', __FILE__);
}
if (!defined('DEV_OPTIONS_DIR')) {
    define('DEV_OPTIONS_DIR', plugin_dir_path(__FILE__));
}
if (!defined('DEV_OPTIONS_HELPERS')) {
    define('DEV_OPTIONS_HELPERS', plugin_dir_path(__FILE__) . 'inc/helpers/');
}
if (!defined('DEV_OPTIONS_GROUPS')) {
    define('DEV_OPTIONS_GROUPS', plugin_dir_path(__FILE__) . 'inc/groups/');
}
if (!defined('DEV_OPTIONS_FUNC')) {
    define('DEV_OPTIONS_FUNC', plugin_dir_path(__FILE__) . 'inc/functions/');
}
if (!defined('DEV_OPTIONS_URL')) {
    define('DEV_OPTIONS_URL', plugin_dir_url(__FILE__));
}

// Init
require_once DEV_OPTIONS_DIR . 'inc/init.php';