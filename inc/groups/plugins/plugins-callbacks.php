<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;


// Contact Form 7 Remove assets
function cf7_remove_assets_callback() {
    // Check if Contact Form 7 plugin is active
    if (is_cf7_inactive()) {
        return; // show notice and stop function
    }
    
    // get options
    $options = devops_plugins_options();
    $value = $options['cf7_remove_assets'] ?? '';
    echo '<label>';
    echo '<input type="checkbox" id="cf7-remove-assets" name="dev_options_plugins[cf7_remove_assets]" value="1" ' . checked(1, $value, false) . '> Enable';
    echo '</label>';
}


// Contact Form 7 Syntax Highlighting
function cf7_syntax_highlighting_callback() {
    // Check if Contact Form 7 plugin is active
    if (is_cf7_inactive()) {
        return; // show notice and stop function
    }

    // get options
    $options = devops_plugins_options();
    $cf7_syntax_highlighting = $options['cf7_syntax_highlighting']['enable'] ?? '';
    $form_body = $options['cf7_syntax_highlighting']['form_body'] ?? '';
    $mail_body = $options['cf7_syntax_highlighting']['mail_body'] ?? '';


    // Enable function
    echo '<label>';
        echo '<input type="checkbox" id="cf7-syntax-highlighting" name="dev_options_plugins[cf7_syntax_highlighting][enable]" value="1" ' . checked(1, $cf7_syntax_highlighting, false) . ' data-toggle="cf7-syntax-highlighting-option"> Enable';
    echo '</label>';

    // Additional options
    echo '<fieldset id="cf7-syntax-highlighting-option" class="additional-options">';

        // Option: Form Body
        echo '<label>';
            echo '<input type="checkbox" id="cf7-syntax-highlighting-form-body" name="dev_options_plugins[cf7_syntax_highlighting][form_body]" value="1" ' . checked(1, $form_body, false) . '> Form Body';
        echo '</label>';

        // Option: Mail Body
        echo '<label>';
            echo '<input type="checkbox" id="cf7-syntax-highlighting-mail-body" name="dev_options_plugins[cf7_syntax_highlighting][mail_body]" value="1" ' . checked(1, $mail_body, false) . '> Mail Body';
        echo '</label>';

    echo '</fieldset>';
}
