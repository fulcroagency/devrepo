<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Email Encoder
function email_encoder_callback() {
    // get options
    $options = devops_security_performance_options();
    $enabled = $options['email_encoder']['enabled'] ?? ''; // default disable
    $shortcode = $options['email_encoder']['shortcode'] ?? ''; // default disable

    // Checkbox dla włączenia kodowania emaili
    echo '<label>';
        echo '<input type="checkbox" id="email-encoder" name="dev_options_security_performance[email_encoder][enabled]" value="1" ' . checked(1, $enabled, false) . ' data-toggle="email-encoder-options"> Enable';
    echo '</label><br>';

    // Checkbox dla włączenia shortcode
    echo '<div id="email-encoder-options" class="additional-options not-child">';
        echo '<label>';
            echo '<input type="checkbox" id="email-encoder-shortcode" name="dev_options_security_performance[email_encoder][shortcode]" value="1" ' . checked(1, $shortcode, false) . '> Add Shortcode - [encode]';
        echo '</label>';
    echo '</div>';
}


// Disable XML-RPC
function disable_xmlrpc_callback() {
    $options = devops_security_performance_options(); // get options 
    $value = $options['disable_xmlrpc'] ?? ''; // default to empty if not set
    
    echo '<label>';
        echo '<input type="checkbox" id="disable-xmlrpc" name="dev_options_security_performance[disable_xmlrpc]" value="1"' . checked(1, $value, false) . '/> Enable';
    echo '</label>';
}

// Remove WP Head Links
function remove_wp_head_links_callback() {
    $options = devops_security_performance_options(); // get options

    // Main options
    $enabled = $options['remove_wp_head_links']['enabled'] ?? ''; // default to empty if not set
    $config = $options['remove_wp_head_links']['config'] ?? 'all'; // default option 'all' if not set

    // Custom options - default to empty if not set
    $rsd_link = $options['remove_wp_head_links']['rsd_link'] ?? '';
    $wp_generator = $options['remove_wp_head_links']['wp_generator'] ?? '';
    $wlwmanifest = $options['remove_wp_head_links']['wlwmanifest'] ?? '';
    $feed_links = $options['remove_wp_head_links']['feed_links'] ?? '';
    $shortlink = $options['remove_wp_head_links']['shortlink'] ?? '';

    // Enable
    echo '<label>';
        echo '<input type="checkbox" id="remove-wp-head-links" name="dev_options_security_performance[remove_wp_head_links][enabled]" value="1" ' . checked(1, $enabled, false) . ' data-toggle="remove-wp-head-links-options"> Enable';
    echo '</label>';

    // Additional options
    echo '<fieldset id="remove-wp-head-links-options" class="additional-options" style="margin-left: 20px;">';

    // All options / Custom options toggle
    echo '<label>';
        echo '<input type="radio" id="remove-wp-head-links-all" name="dev_options_security_performance[remove_wp_head_links][config]" value="all" ' . checked('all', $config, false) . ' data-toggle="remove-wp-head-links-custom-options"> All Options';
    echo '</label>';

    echo '<label>';
        echo '<input type="radio" id="remove-wp-head-links-custom" name="dev_options_security_performance[remove_wp_head_links][config]" value="custom" ' . checked('custom', $config, false) . ' data-toggle="remove-wp-head-links-custom-options"> Customize';
    echo '</label>';

    // Custom options
    echo '<fieldset id="remove-wp-head-links-custom-options" class="additional-options">';
    
        // Remove RSD Link
        echo '<label>';
            echo '<input type="checkbox" id="remove-rsd-link" name="dev_options_security_performance[remove_wp_head_links][rsd_link]" value="1" ' . checked(1, $rsd_link, false) . '> Remove RSD Link';
        echo '</label>';

        // Remove WP Generator
        echo '<label>';
            echo '<input type="checkbox" id="remove-wp-generator" name="dev_options_security_performance[remove_wp_head_links][wp_generator]" value="1" ' . checked(1, $wp_generator, false) . '> Remove WP Generator Tag';
        echo '</label>';

        // Remove WLWManifest
        echo '<label>';
            echo '<input type="checkbox" id="remove-wlwmanifest" name="dev_options_security_performance[remove_wp_head_links][wlwmanifest]" value="1" ' . checked(1, $wlwmanifest, false) . '> Remove WLWManifest Link';
        echo '</label>';

        // Remove Feed Links
        echo '<label>';
            echo '<input type="checkbox" id="remove-feed-links" name="dev_options_security_performance[remove_wp_head_links][feed_links]" value="1" ' . checked(1, $feed_links, false) . '> Remove Feed Links';
        echo '</label>';

        // Remove Shortlink
        echo '<label>';
            echo '<input type="checkbox" id="remove-shortlink" name="dev_options_security_performance[remove_wp_head_links][shortlink]" value="1" ' . checked(1, $shortlink, false) . '> Remove Shortlink';
        echo '</label>';

    echo '</fieldset>'; // custom options end

    echo '</fieldset>';
}


// Remove WP Version
function remove_wp_version_callback() {
    $options = devops_security_performance_options(); // get options 
    $value = $options['remove_wp_version'] ?? ''; // default to empty if not set
    
    echo '<label>';
        echo '<input type="checkbox" id="remove-wp-version" name="dev_options_security_performance[remove_wp_version]" value="1"' . checked(1, $value, false) . '/> Enable';
    echo '</label>';
}

// Disable REST API
function disable_rest_api_callback() {
    $options = devops_security_performance_options(); // get options 
    $value = $options['disable_rest_api'] ?? ''; // default to empty if not set
    
    echo '<label>';
        echo '<input type="checkbox" id="disable-rest-api" name="dev_options_security_performance[disable_rest_api]" value="1" ' . checked(1, $value, false) . '> Enable';
    echo '</label>';
}

// Users Security
function users_security_callback() {
    $options = devops_security_performance_options(); // get options

    // Main options
    $enabled = $options['users_security']['enabled'] ?? ''; // default to empty if not set
    $config = $options['users_security']['config'] ?? 'all'; // default option 'all'

    // Custom options - default to empty if not set
    $enumeration = $options['users_security']['enumeration'] ?? '';
    $restrict_rest_api = $options['users_security']['restrict_rest_api'] ?? '';
    $disable_pages = $options['users_security']['disable_author_pages'] ?? '';
    $disable_links = $options['users_security']['remove_author_links'] ?? '';
    $remove_emails = $options['users_security']['remove_author_emails'] ?? '';
    $remove_names = $options['users_security']['remove_author_names'] ?? '';

    // Enable
    echo '<label>';
        echo '<input type="checkbox" id="users-security" name="dev_options_security_performance[users_security][enabled]" value="1" ' . checked(1, $enabled, false) . ' data-toggle="users-security-options"> Enable';
    echo '</label>';

    // Additional options
    echo '<fieldset id="users-security-options" class="additional-options">';

    // All options / Custom options toggle
        echo '<label>';
            echo '<input type="radio" id="users-security-config-all" name="dev_options_security_performance[users_security][config]" value="all" ' . checked('all', $config, false) . ' data-toggle="custom-options"> All Options';
        echo '</label>';

        echo '<label>';
            echo '<input type="radio" id="users-security-config-custom" name="dev_options_security_performance[users_security][config]" value="custom" ' . checked('custom', $config, false) . ' data-toggle="users-security-custom-options"> Customize';
        echo '</label>';

        // Custom Options
        echo '<fieldset id="users-security-custom-options" class="additional-options">';

            // Disable User Enumeration
            echo '<label>';
                echo '<input type="checkbox" id="users-security-enumeration" name="dev_options_security_performance[users_security][enumeration]" value="1" ' . checked(1, $enumeration, false) . '> Disable User Enumeration';
            echo '</label>';

            // Restrict REST API for Users
            echo '<label>';
                echo '<input type="checkbox" id="users-security-restrict-rest-api" name="dev_options_security_performance[users_security][restrict_rest_api]" value="1" ' . checked(1, $restrict_rest_api, false) . '> Restrict REST API Users Endpoints';
            echo '</label>';

            // Disable Author Pages
            echo '<label>';
                echo '<input type="checkbox" id="users-security-disable-pages" name="dev_options_security_performance[users_security][disable_author_pages]" value="1" ' . checked(1, $disable_pages, false) . '> Disable Author Pages';
            echo '</label>';

            // Remove Author Links
            echo '<label>';
                echo '<input type="checkbox" id="users-security-disable-links" name="dev_options_security_performance[users_security][remove_author_links]" value="1" ' . checked(1, $disable_links, false) . '> Remove Links to Author Pages (frontend + sitemap)';
            echo '</label>';

            // Remove Author Emails
            echo '<label>';
                echo '<input type="checkbox" id="users-security-remove-emails" name="dev_options_security_performance[users_security][remove_author_emails]" value="1" ' . checked(1, $remove_emails, false) . '> Remove Author Emails';
            echo '</label>';

            // Remove Author Names
            echo '<label>';
                echo '<input type="checkbox" id="users-security-remove-names" name="dev_options_security_performance[users_security][remove_author_names]" value="1" ' . checked(1, $remove_names, false) . '> Remove Author Names';
            echo '</label>';

        echo '</fieldset>'; // custom options end
    echo '</fieldset>';
}

function devops_enqueue_tom_select() {
    wp_enqueue_script('tom-select-js', 'https://cdn.jsdelivr.net/npm/tom-select@2.4.1/dist/js/tom-select.complete.min.js', array( 'jquery' ), '2.4.1', true);
    wp_enqueue_style('tom-select-css', 'https://cdn.jsdelivr.net/npm/tom-select@2.4.1/dist/css/tom-select.min.css', array(), '2.4.1');
}

add_action('admin_enqueue_scripts', 'devops_enqueue_tom_select');

// Restrict Dashboard Access
function restrict_dashboard_callback() {
    $options = devops_security_performance_options(); // get options

    $enabled = $options['restrict_dashboard']['enabled'] ?? ''; // default disabled
    $config = $options['restrict_dashboard']['config'] ?? 'admin'; // default value to "admin" if not set
    $roles = $options['restrict_dashboard']['roles'] ?? []; // default empty array

    // get roles
    $user_roles = get_editable_roles();
    unset($user_roles['administrator']); // remove admin from list
    
    $role_options = array();
    foreach ($user_roles as $role => $role_details) {
        $selected = is_array($roles) && in_array($role, $roles) ? 'selected' : ''; // Use $roles to check if the role is selected
        $role_options[$role] = '<option value="' . esc_attr($role) . '" ' . $selected . '>' . translate_user_role($role_details['name']) . '</option>';
    }
    
    // enable
    echo '<label>';
        echo '<input type="checkbox" id="disable-dashboard" name="dev_options_security_performance[restrict_dashboard][enabled]" value="1" ' . checked(1, $enabled, false) . ' data-toggle="disable-dashboard-options"> Enable';
    echo '</label>';

    echo '<fieldset id="disable-dashboard-options" class="additional-options">';
        // radio - administrator + hide more
        echo '<label>';
            echo '<input type="radio" id="disable-dashboard-admin" class="hide-more" name="dev_options_security_performance[restrict_dashboard][config]" value="admin" ' . checked('admin', $config, false) . '> Allow Administrators Only';
        echo '</label>';
    
        // radio - selected options + show more
        echo '<label>';
            echo '<input type="radio" id="disable-dashboard-selected-roles" class="show-more" name="dev_options_security_performance[restrict_dashboard][config]" value="selected" ' . checked('selected', $config, false) . '> Restrict Selected Roles';
        echo '</label>';
    

        // show more
        echo '<div class="more-field" style="display: none">';
    
        // select roles
        echo '<select class="tom-select" id="disable-dashboard-roles" name="dev_options_security_performance[restrict_dashboard][roles][]" multiple>';
            foreach ($role_options as $select_option) {
                echo $select_option; // write roles from array
            }
        echo '</select>';
    
        echo '</div>'; // show more end
    
    echo '</fieldset>';
}

// Disable Emoji's
function disable_emojis_callback() {
    $options = devops_security_performance_options(); // get options 
    $value = $options['disable_emojis'] ?? ''; // default to empty if not set
    
    echo '<label>';
        echo '<input type="checkbox" id="disable-emojis" name="dev_options_security_performance[disable_emojis]" value="1" ' . checked(1, $value, false) . '> Enable';
    echo '</label>';
}

// Disable Comments
function disable_comments_callback() {
    $options = devops_security_performance_options(); // get options 
    $value = $options['disable_comments'] ?? ''; // default to empty if not set
    
    echo '<label>';
        echo '<input type="checkbox" id="disable-comments" name="dev_options_security_performance[disable_comments]" value="1" ' . checked(1, $value, false) . '> Enable';
    echo '</label>';
}