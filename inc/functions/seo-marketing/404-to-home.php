<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

function devops_404_to_home() {
    if (is_404()) {
        $options = devops_seo_marketing_options();
        $allowed_types = [301, 302];

        // Używając operatora null coalescing, aby ustawiać domyślny typ przekierowania na 302
        $redirect_type = $options['redirect_404']['type'] ?? 301;

        // check if redirect type is allowed
        if (!in_array($redirect_type, $allowed_types)) {
            $redirect_type = 301; // if not allowed set as default
        }

        wp_redirect(home_url(), $redirect_type);
        exit;
    }
}
add_action('template_redirect', 'devops_404_to_home');

