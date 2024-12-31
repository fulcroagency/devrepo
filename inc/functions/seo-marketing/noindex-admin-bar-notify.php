<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/* Search engine visibility notify in admin bar */

function devops_noindex_admin_bar_notify($bar)
    {
        if (get_option('blog_public') == 0) {
            $icon = '"\f530"';
            $icon_color = 'red';
        } else {
            $icon = '"\f177"';
            $icon_color = 'green';
        }
        echo
            '<style>#wpadminbar #wp-admin-bar-noindex-notify .ab-icon:before {content: ' . $icon . '; color: ' . $icon_color . ';}</style>';
        $bar->add_menu(array(
            'id' => 'noindex-notify',
            'title' => '<span class="ab-icon"></span>',
            'href' => 'options-reading.php',
            'meta' => array(
                'target' => '_self',
                'title' => 'Discourage search engines from indexing this site',
            ),
        ));
    }
add_action('admin_bar_menu', 'devops_noindex_admin_bar_notify', 999);