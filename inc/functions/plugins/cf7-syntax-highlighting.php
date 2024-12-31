<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

function devops_cf7_syntax_highlighting() {
    $options = devops_plugins_options(); // get options
    $form_body = $options['cf7_syntax_highlighting']['form_body'] ?? '';
    $mail_body = $options['cf7_syntax_highlighting']['mail_body'] ?? '';

    // check if enabled
    if ($form_body != '1' && $mail_body != '1') {
        // end function if both options are disabled
        return false;
    }
    
    global $pagenow;

    // Load only on Contact Form 7 pages
    if ($pagenow === 'admin.php' && isset($_GET['page']) && $_GET['page'] === 'wpcf7') {
        // Enqueue CodeMirror scripts and styles
        
        // Basic scripts and styles
        wp_enqueue_script('codemirror', '//cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.0/codemirror.min.js', array(), '5.65.0', true);
        wp_enqueue_style('codemirror', '//cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.0/codemirror.min.css');

        // Styles for HTML/CSS/JS
        wp_enqueue_script('codemirror-mode-xml', '//cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.0/mode/xml/xml.min.js', array('codemirror'), '5.65.0', true);
        wp_enqueue_script('codemirror-mode-javascript', '//cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.0/mode/javascript/javascript.min.js', array('codemirror'), '5.65.0', true);
        wp_enqueue_script('codemirror-mode-css', '//cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.0/mode/css/css.min.js', array('codemirror'), '5.65.0', true);
        wp_enqueue_script('codemirror-mode-htmlmixed', '//cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.0/mode/htmlmixed/htmlmixed.min.js', array('codemirror'), '5.65.0', true);

        // Addons
        wp_enqueue_script('codemirror-addon-closetags', '//cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.0/addon/edit/closetag.min.js', array('codemirror'), '5.65.0', true);
        wp_enqueue_script('codemirror-addon-xml-fold', '//cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.0/addon/fold/xml-fold.min.js', array('codemirror'), '5.65.0', true);
        wp_enqueue_script('codemirror-addon-matchtags', '//cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.0/addon/edit/matchtags.min.js', array('codemirror'), '5.65.0', true);

        // Theme
        wp_enqueue_style('codemirror-theme', '//cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.0/theme/material.min.css');

        // Add inline JavaScript using admin_print_footer_scripts hook
        add_action('admin_print_footer_scripts', 'devops_cf7_syntax_highlighting_init_script', 100);
        add_action('admin_print_footer_scripts', 'devops_cf7_syntax_highlighting_style', 100);
    }
}
add_action('admin_enqueue_scripts', 'devops_cf7_syntax_highlighting');

function devops_cf7_syntax_highlighting_init_script() {
    // Get options
    $options = devops_plugins_options();
    $form_body = $options['cf7_syntax_highlighting']['form_body'] ?? '';
    $mail_body = $options['cf7_syntax_highlighting']['mail_body'] ?? '';
    ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var formEditor, mailBodyEditor, mail2BodyEditor;

        function initializeCodeMirror(textareaId) {
            var textarea = document.getElementById(textareaId);
            if (textarea) {
                var editor = CodeMirror.fromTextArea(textarea, {
                    lineNumbers: true,
                    mode: 'htmlmixed',
                    theme: 'material',
                    autoCloseTags: {
                        whenClosing: false,
                        whenOpening: true,
                        indentTags: []
                    },
                    matchTags: { bothTags: true },
                    extraKeys: { "Ctrl-J": "toMatchingTag" },
                    lineWrapping: true
                });
                return editor;
            }
        }

        <?php if ($form_body == '1'): ?>
        // Init form editor syntax highlighting if the form_body option is active
        formEditor = initializeCodeMirror('wpcf7-form');

        // Handle form tab click
        document.getElementById('form-panel-tab').addEventListener('click', function() {
            setTimeout(function() {
                if (formEditor) {
                    formEditor.refresh();
                }
            }, 100);
        });
        <?php endif; ?>

        <?php if ($mail_body == '1'): ?>
        // Init form editor syntax highlighting if the mail_body option is active
        mailBodyEditor = initializeCodeMirror('wpcf7-mail-body');
        mail2BodyEditor = initializeCodeMirror('wpcf7-mail-2-body');

        // Handle mail tab click
        document.getElementById('mail-panel-tab').addEventListener('click', function() {
            setTimeout(function() {
                if (mailBodyEditor) {
                    mailBodyEditor.refresh();
                }
                if (mail2BodyEditor) {
                    mail2BodyEditor.refresh();
                }
            }, 100);
        });
        
        // Handle "use (2) email" click
        document.getElementById('wpcf7-mail-2-active').addEventListener('click', function() {
            setTimeout(function() {
                if (mail2BodyEditor) {
                    mail2BodyEditor.refresh();
                }
            }, 100);
        });
        
        <?php endif; ?>
    });
</script>
<?php
}

// Allow vertical resize textarea field
function devops_cf7_syntax_highlighting_style() {
    echo '<style>.CodeMirror {resize: vertical;}</style>';
}
?>