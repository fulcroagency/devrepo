<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Core settings page
require_once DEV_OPTIONS_DIR . 'inc/settings-page.php';

// register options and settings fields
require_once DEV_OPTIONS_GROUPS . 'general/general-register.php';
require_once DEV_OPTIONS_GROUPS . 'security-performance/security-performance-register.php';
require_once DEV_OPTIONS_GROUPS . 'other/other-register.php';
require_once DEV_OPTIONS_GROUPS . 'seo-marketing/seo-marketing-register.php';
require_once DEV_OPTIONS_GROUPS . 'plugins/plugins-register.php';

// Load options
require_once DEV_OPTIONS_HELPERS . 'options-loader.php';
// Theme and plugins checks
require_once DEV_OPTIONS_HELPERS . 'theme-plugins-checks.php';

// include callbacks for all settings fields
require_once DEV_OPTIONS_GROUPS . 'general/general-callbacks.php';
require_once DEV_OPTIONS_GROUPS . 'security-performance/security-performance-callbacks.php';
require_once DEV_OPTIONS_GROUPS . 'other/other-callbacks.php';
require_once DEV_OPTIONS_GROUPS . 'seo-marketing/seo-marketing-callbacks.php';
require_once DEV_OPTIONS_GROUPS . 'plugins/plugins-callbacks.php';

// Load option actions
require_once DEV_OPTIONS_GROUPS . 'general/general-options.php';
require_once DEV_OPTIONS_GROUPS . 'security-performance/security-performance-options.php';
require_once DEV_OPTIONS_GROUPS . 'other/other-options.php';
require_once DEV_OPTIONS_GROUPS . 'seo-marketing/seo-marketing-options.php';
require_once DEV_OPTIONS_GROUPS . 'plugins/plugins-options.php';

// Check for updates
require_once DEV_OPTIONS_HELPERS . 'updates.php';