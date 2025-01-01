<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Sanitize Filenames
function sanitize_filenames_callback() {
    $options = devops_general_options(); // get options
    $value = $options['sanitize_filenames'] ?? '';
    
    echo '<label>';
        echo '<input type="checkbox" id="sanitize-filenames" name="dev_options_general[sanitize_filenames]" value="1" ' . checked(1, $value, false) . '> Enable';
    echo '</label>';
}

// SVG Upload
function svg_upload_callback() {
    $options = devops_general_options(); // Get options
    $svg_upload = $options['svg_upload'] ?? '';
    $svg_upload_capability = !empty($options['svg_upload_capability']) ? (array)$options['svg_upload_capability'] : ['manage_options']; // Default to manage_options

    // Enable SVG upload
    echo '<label>';
        echo '<input type="checkbox" id="svg_upload" name="dev_options_general[svg_upload]" value="1" ' . checked(1, $svg_upload, false) . ' data-toggle="svg-upload-capability"> Enable';
    echo '</label>';

    // Additional capability selection
    echo '<fieldset id="svg-upload-capability" class="additional-options">';

        // Option: Administrators (manage_options capability)
        echo '<label>';
            echo '<input type="radio" id="svg-upload-capability-administrator" name="dev_options_general[svg_upload_capability][]" value="manage_options" ' . checked(in_array('manage_options', $svg_upload_capability), true, false) . '> Administrator';
        echo '</label>';

        // Option: Editors (edit_others_posts capability)
        echo '<label>';
            echo '<input type="radio" id="svg-upload-capability-editor" name="dev_options_general[svg_upload_capability][]" value="edit_others_posts" ' . checked(in_array('edit_others_posts', $svg_upload_capability), true, false) . '> Editor + higher roles';
        echo '</label>';

        // Option: Authors (publish_posts capability)
        echo '<label>';
            echo '<input type="radio" id="svg-upload-capability-author" name="dev_options_general[svg_upload_capability][]" value="publish_posts" ' . checked(in_array('publish_posts', $svg_upload_capability), true, false) . '> Author + higher roles';
        echo '</label>';

    // Check if WooCommerce is active
    $is_woocommerce_active = class_exists('WooCommerce');

    // Option: Store Manager (WooCommerce - manage_woocommerce capability)
    if ($is_woocommerce_active) {
        echo '<label>';
        echo '<input type="checkbox" id="svg-upload-capability-shop-manager" name="dev_options_general[svg_upload_capability][]" value="manage_woocommerce" ' . checked(in_array('manage_woocommerce', $svg_upload_capability), true, false) . '> + Store Manager';
        echo '</label>';
    }

    echo '</fieldset>';
}


// GTM


// GTM Code Insert Callback
function gtm_insert_callback() {
    // Pobierz opcje z bazy danych
    $options = devops_general_options();
    $gtm_insert_enable = $options['gtm_insert_enable'] ?? 0; // Default to disabled
    $gtm_insert_type = $options['gtm_insert_type'] ?? 'default'; // Default to "default"
    $gtm_default_id = $options['gtm_default_id'] ?? ''; // Default empty
    $gtm_custom_head = $options['gtm_custom_head'] ?? ''; // Default empty
    $gtm_custom_body = $options['gtm_custom_body'] ?? ''; // Default empty

    // Enable GTM Code Insert
    echo '<label>';
    echo '<input type="checkbox" id="gtm_insert_enable" name="dev_options_general[gtm_insert_enable]" value="1" ' . checked(1, $gtm_insert_enable, false) . ' data-toggle="gtm-insert-options"> Enable GTM Code Insert';
    echo '</label>';

    // Additional fields
    echo '<div id="gtm-insert-options" class="additional-options">';

    // Default code radio option
    echo '<div class="flex-row align-center">';
    echo '<label>';
    echo '<input type="radio" id="gtm-insert-type-default" name="dev_options_general[gtm_insert_type]" value="default" ' . checked('default', $gtm_insert_type, false) . ' data-toggle="gtm-insert-default"> Default code';
    echo '</label>';
    echo '<div id="gtm-insert-default" class="additional-field">';
    echo '<input type="text" id="gtm-default-id" name="dev_options_general[gtm_default_id]" value="' . esc_attr($gtm_default_id) . '" placeholder="Enter GTM ID (e.g., GTM-XXXXXX)" style="width: 300px;">';
    echo '</div>';
    echo '</div>';


    // Custom code radio option
    echo '<div class="flex-column">';
    echo '<label>';
    echo '<input type="radio" id="gtm-insert-type-custom" name="dev_options_general[gtm_insert_type]" value="custom" ' . checked('custom', $gtm_insert_type, false) . ' data-toggle="gtm-insert-custom"> Custom code';
    echo '</label>';
    echo '<div id="gtm-insert-custom" class="additional-field flex-row" style=" ' . ($gtm_insert_type === 'custom' ? '' : 'display:none;') . '">';
    echo '<textarea id="gtm-custom-head" class="width-1-2" name="dev_options_general[gtm_custom_head]" placeholder="Enter custom GTM head code" style="height: 100px;">' . esc_textarea($gtm_custom_head) . '</textarea>';
    echo '<textarea id="gtm-custom-body" class="width-1-2" name="dev_options_general[gtm_custom_body]" placeholder="Enter custom GTM body code" style="height: 100px;">' . esc_textarea($gtm_custom_body) . '</textarea>';
    echo '</div>';
    echo '</div>';

    echo '</div>';

    // Inline JS for dynamic toggling
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const enableCheckbox = document.getElementById('gtm_insert_enable');
            const optionsContainer = document.getElementById('gtm-insert-options');
            const defaultRadio = document.getElementById('gtm-insert-type-default');
            const customRadio = document.getElementById('gtm-insert-type-custom');
            const defaultField = document.getElementById('gtm-insert-default');
            const customField = document.getElementById('gtm-insert-custom');

            // Toggle additional fields based on enable checkbox
            enableCheckbox.addEventListener('change', function () {
                optionsContainer.style.display = this.checked ? 'flex' : 'none';
            });

            // Toggle between default and custom options
            [defaultRadio, customRadio].forEach(function (radio) {
                radio.addEventListener('change', function () {
                    defaultField.style.display = defaultRadio.checked ? 'flex' : 'none';
                    customField.style.display = customRadio.checked ? 'flex' : 'none';
                });
            });
        });
    </script>
    <?php
}