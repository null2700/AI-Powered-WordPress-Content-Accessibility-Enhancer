<?php
/**
 * Plugin Name: AI Accessibility Enhancer
 * Description: Scan and improve WordPress content accessibility using AI.
 * Version: 1.0
 * Author: Soham Gurav
 */

add_action('admin_menu', 'accessibility_enhancer_menu');
function accessibility_enhancer_menu() {
    add_menu_page('Accessibility Enhancer', 'Accessibility Enhancer', 'manage_options', 'accessibility-enhancer', 'accessibility_enhancer_page');
}

function accessibility_enhancer_page() {
    echo '<div class="wrap">';
    echo '<h1>Accessibility Enhancer</h1>';
    include plugin_dir_path(__FILE__) . 'templates/scan-form.php';
    echo '</div>';
}

add_action('admin_enqueue_scripts', 'accessibility_enhancer_scripts');
function accessibility_enhancer_scripts() {
    wp_enqueue_style('accessibility-style', plugin_dir_url(__FILE__) . 'css/style.css');
    wp_enqueue_script('accessibility-script', plugin_dir_url(__FILE__) . 'js/accessibility.js', ['jquery'], null, true);
    wp_localize_script('accessibility-script', 'accessibility_ajax', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);
}

add_action('wp_ajax_check_accessibility', 'check_accessibility_callback');
function check_accessibility_callback() {
    $content = sanitize_text_field($_POST['html']);
    $response = wp_remote_post('http://127.0.0.1:5000/analyze-accessibility', [
        'body' => json_encode(['html' => $content]),
        'headers' => ['Content-Type' => 'application/json'],
    ]);

    wp_send_json(json_decode(wp_remote_retrieve_body($response)));
}
?>
