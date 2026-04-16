<?php
/**
 * Plugin Name: Custom Tabs Plugin
 * Description: A shortcode-based custom tabs component.
 * Version: 1.0.0
 * Author: Eric Feldman
 */

if (!defined('ABSPATH')) {
    exit;
}

define('CTP_PLUGIN_URL', plugin_dir_url(__FILE__));
define('CTP_PLUGIN_PATH', plugin_dir_path(__FILE__));

function ctp_enqueue_assets() {
    wp_enqueue_style(
        'ctp-styles',
        CTP_PLUGIN_URL . 'assets/css/custom-tabs.css',
        array(),
        '1.0.0'
    );

    wp_enqueue_script(
        'ctp-scripts',
        CTP_PLUGIN_URL . 'assets/js/custom-tabs.js',
        array(),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'ctp_enqueue_assets');

function ctp_render_tabs_shortcode() {
    ob_start();
    ?>
    <div class="ctp-tabs">
        <div class="ctp-tabs__nav">
            <button class="ctp-tab is-active" type="button" data-tab="0">Retail</button>
            <button class="ctp-tab" type="button" data-tab="1">Luxury fashion</button>
            <button class="ctp-tab" type="button" data-tab="2">Digital goods</button>
        </div>

        <div class="ctp-tabs__panels">
            <div class="ctp-panel is-active" data-panel="0">
                <p>Retail content goes here.</p>
            </div>
            <div class="ctp-panel" data-panel="1">
                <p>Luxury fashion content goes here.</p>
            </div>
            <div class="ctp-panel" data-panel="2">
                <p>Digital goods content goes here.</p>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('custom_tabs', 'ctp_render_tabs_shortcode');