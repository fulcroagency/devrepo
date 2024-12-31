<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// add setting page to dashboard
add_action('admin_menu', function () {
    add_options_page('Dev Options', 'Dev Options', 'manage_options', 'dev-options', 'dev_options_settings_page');
});

// settings page
function dev_options_settings_page() {
    ?>
    
    <script src="<?php echo DEV_OPTIONS_URL . 'assets/settings-page.js'; ?>"></script>
    <link  rel="stylesheet" href="<?php echo DEV_OPTIONS_URL . 'assets/settings-page.css?ver=0.01'; ?>">
    
    <div class="wrap">
        <h2>Dev Options</h2>
        <h2 class="nav-tab-wrapper">
            <a href="#general" class="nav-tab nav-tab-active" onclick="openTab(event, 'general')">General</a>
            <a href="#security-performance" class="nav-tab" onclick="openTab(event, 'security-performance')">Security / Performance</a>
            <a href="#other" class="nav-tab" onclick="openTab(event, 'other')">Other</a>
            <a href="#seo-marketing" class="nav-tab" onclick="openTab(event, 'seo-marketing')">SEO / Marketing</a>
            <a href="#plugins" class="nav-tab" onclick="openTab(event, 'plugins')">Plugins</a>
        </h2>

        <form method="post" action="options.php">
            <?php settings_fields('dev_options_group'); ?>
            
            <!-- Tabs -->
            <div id="general" class="tabcontent" style="display: block;">
                <?php do_settings_sections('dev_options_general'); ?>
            </div>
            <div id="security-performance" class="tabcontent" style="display: none;">
                <?php do_settings_sections('dev_options_security_performance'); ?>
            </div>
            <div id="other" class="tabcontent" style="display: none;">
                <?php do_settings_sections('dev_options_other'); ?>
            </div>
            <div id="seo-marketing" class="tabcontent" style="display: none;">
                <?php do_settings_sections('dev_options_seo_marketing'); ?>
            </div>
            <div id="plugins" class="tabcontent" style="display: none;">
                <?php do_settings_sections('dev_options_plugins'); ?>
            </div>

            <?php submit_button(); ?>
        </form>
    </div>
    
    <style>
        /*.settings_page_dev-options .form-table td {
            vertical-align: top;
            padding-top: 20px;
        }
        
        .settings_page_dev-options .form-table td label {
            vertical-align: top;
        }
        
        .settings_page_dev-options .additional-options {
            margin: 7px 0 7px 20px;
            display: flex;
            flex-direction: column;
            row-gap: 3px;
        }
        
        .tabcontent {
            display: none;
            padding: 20px 0;
        }
        .nav-tab-active {
            font-weight: bold;
        }*/
        </style>
    <?php
}
