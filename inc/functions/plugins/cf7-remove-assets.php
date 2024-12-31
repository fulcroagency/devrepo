<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;


function devops_cf7_remove_assets() {
    // remove default cf7 styles and scripts
    add_filter('wpcf7_load_css', '__return_false');
    add_filter('wpcf7_load_js', '__return_false');
    
    // recaptcha scripts status removal default as false
    static $recaptcha_removed = false;
    
    add_action('wp_loaded', function() use (&$recaptcha_removed) {
        // checks if action exist and get priority
        $priority = has_action('wp_enqueue_scripts', 'wpcf7_recaptcha_enqueue_scripts');
        
        // remove if exist
        if (false !== $priority) {
            remove_action('wp_enqueue_scripts', 'wpcf7_recaptcha_enqueue_scripts', $priority);
            $recaptcha_removed = true; // set removal status as true
        }
    });

    add_filter('pre_do_shortcode_tag', function ($output, $shortcode) use (&$recaptcha_removed) {
        
        // check for cf7 shortcode on page
        if ('contact-form-7' == $shortcode) {
            
            // check if recaptcha scripts was removed
            if ($recaptcha_removed) {
                wpcf7_recaptcha_enqueue_scripts(); // add recaptcha scripts if they were removed
            }
            // add default cf7 styles and scripts
            wpcf7_enqueue_scripts();
            wpcf7_enqueue_styles();
        }
        return $output;
    }, 10, 2);
}

devops_cf7_remove_assets();