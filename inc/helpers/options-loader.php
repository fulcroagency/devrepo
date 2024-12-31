<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Function to get General options
function devops_general_options() {
    static $options = null;

    if ($options === null) {
        $options = get_option('dev_options_general', []); // Fetch General options from the database
    }

    return $options;
}

// Function to get Security/Performance options
function devops_security_performance_options() {
    static $options = null;

    if ($options === null) {
        $options = get_option('dev_options_security_performance', []); // Fetch Security/Performance options from the database
    }

    return $options;
}

// Function to get Other options
function devops_other_options() {
    static $options = null;

    if ($options === null) {
        $options = get_option('dev_options_other', []); // Fetch Other options from the database
    }

    return $options;
}

// Function to get SEO/Marketing options
function devops_seo_marketing_options() {
    static $options = null;

    if ($options === null) {
        $options = get_option('dev_options_seo_marketing', []); // Fetch Other options from the database
    }

    return $options;
}

// Function to get Plugins options
function devops_plugins_options() {
    static $options = null;

    if ($options === null) {
        $options = get_option('dev_options_plugins', []); // Fetch Plugins options from the database
    }

    return $options;
}