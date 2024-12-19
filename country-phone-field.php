<?php
/*
Plugin Name: Bd Country Flags Contact Form 7
Description: Adds a custom phone input field with country flags to Contact Form 7.
Version: 2.0
Author: Barış Dayak
Author URI: https://barisdayak.com
Plugin URI: https://github.com/barisdayak/CF7-Country-Phone-Field/tree/main
*/


if (!defined('ABSPATH')) exit; 

// Style and Script Loading
function cpf_enqueue_scripts() {
    // Adding the CSS file
    wp_enqueue_style('cpf-style', plugin_dir_url(__FILE__) . 'assets/css/phone-country-style.css');
    
    // Adding the JavaScript file
    wp_enqueue_script('cpf-script', plugin_dir_url(__FILE__) . 'assets/js/phone-country-script.js', array('jquery'), null, true);
    
    // Adding the Iconify library
    wp_enqueue_script('iconify', 'https://code.iconify.design/3/3.1.0/iconify.min.js', [], null, true);
}
add_action('wp_enqueue_scripts', 'cpf_enqueue_scripts');


// Contact Form 7 Short Code Registration
function cpf_phone_shortcode_handler($tag) {
    $html = '
    <div class="select-box">
        <div class="selected-option">
            <div>
                <span class="iconify" data-icon="flag:gb-4x3"></span>
                <strong>+44</strong>
            </div>
            <input type="tel" name="' . esc_attr($tag['name']) . '" placeholder="Phone Number">
        </div>
        <div class="options">
            <input type="text" class="search-box" placeholder="Search Country Name">
            <ol></ol>
        </div>
    </div>';
    return $html;
}
add_action('wpcf7_init', function() {
    wpcf7_add_form_tag('country_phone', 'cpf_phone_shortcode_handler');
});

function allow_svg_in_wp_kses($data, $context) {
    if ($context === 'post') {
        $data['svg'] = [];
        $data['g'] = [];
        $data['path'] = [];
    }
    return $data;
}
add_filter('wp_kses_allowed_html', 'allow_svg_in_wp_kses', 10, 2);


remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');
remove_filter('content_save_pre', 'wp_filter_post_kses');
remove_filter('content_filtered_save_pre', 'wp_filter_post_kses');
