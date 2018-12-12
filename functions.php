<?php

function offgrid_network_files() {
    wp_enqueue_style('offgrid_network_main_styles', get_stylesheet_uri());
    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Cabin+Sketch:400,700|Lato:400,700');
    wp_enqueue_style('flickity-slider-styles', '//unpkg.com/flickity@2/dist/flickity.min.css');
    wp_enqueue_style('font-awesome', '//use.fontawesome.com/releases/v5.2.0/css/all.css');
    wp_enqueue_script('flickity-slider-script', '//unpkg.com/flickity@2/dist/flickity.pkgd.min.js');
    //wp_enqueue_script('font-awesome', '//use.fontawesome.com/releases/v5.0.9/js/all.js'); //doesn't work with FA style-link...
    wp_register_script('custom-js', get_template_directory_uri() . '/assets/js/scripts-bundled.js', array('jquery'), '1.0.0', true); 
    wp_enqueue_script('custom-js');
}
    
add_action('wp_enqueue_scripts', 'offgrid_network_files');

function offgrid_network_features() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('news-large', 600, 400);
    add_image_size('news-medium', 450, 300);
    add_image_size('news-square', 400, 9999, true);
}

add_action('after_setup_theme', 'offgrid_network_features');

function offgrid_network_adjust_queries ($query) {
    if (!is_admin() AND is_post_type_archive('events') AND $query->is_main_query()) {
        $today = date('Ymd');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query',  array(
            array(
              'key' => 'event_date',
              'compare' => '>=',
              'value' => $today,
              'type' => 'numeric'    
            )
            ));
        $query->set('posts_per_page', 6);
    }
}

add_action('pre_get_posts', 'offgrid_network_adjust_queries');


// add_filter( 'query_vars', function ( $vars ) {
// 	$vars[] = 'events'; // whatever query param you're using
// 	return $vars;
// } );

?>