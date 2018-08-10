<?php

function offgrid_network_files() {
    wp_enqueue_style('offgrid_network_main_styles', get_stylesheet_uri());
    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Cabin+Sketch:400,700|Lato:400,700');
    wp_enqueue_style('flickity-slider-styles', '//unpkg.com/flickity@2/dist/flickity.min.css');
    wp_enqueue_script('flickity-slider-script', '//unpkg.com/flickity@2/dist/flickity.pkgd.min.js');
    wp_enqueue_script('offgrid_network_main-js', get_theme_file_uri('/js/main.js'), NULL, microtime(), true);
    wp_enqueue_script('font-awesome', '//use.fontawesome.com/releases/v5.0.9/js/all.js');
    wp_enqueue_script('jquery', '//code.jquery.com/jquery-3.3.1.min.js');
}
    
add_action('wp_enqueue_scripts', 'offgrid_network_files');

function offgrid_network_features() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'offgrid_network_features');
?>