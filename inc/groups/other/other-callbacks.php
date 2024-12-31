<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;


// Add Slug as Body Class
function slug_as_body_class_callback() {
    $options = devops_other_options(); // get options
    $value = $options['slug_as_body_class'] ?? '';
    echo '<label>';
    echo '<input type="checkbox" id="slug_as_body_class" name="dev_options_other[slug_as_body_class]" value="1" ' . checked(1, $value, false) . '> Enable';
    echo '</label>';
}
