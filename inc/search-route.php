<?php

add_action('rest_api_init', 'offgridRegisterSearch');

function offgridRegisterSearch() {
    register_rest_route('offgrid/v1', 'search', array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'offgridSearchResults'
    ));
}

function offgridSearchResults($data) {
    $mainQuery = new WP_Query(array(
        'post_type' => array('post', 'page', 'news', 'events'),
        's' => sanitize_text_field($data['term'])
    ));

    $results = array(
        'generalInfo' => array(),
        'news' => array(),
        'events' => array()
    );

    while($mainQuery->have_posts()) {
        $mainQuery->the_post();

        if (get_post_type() == 'post' OR get_post_type() == 'page') {
            array_push($results['generalInfo'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'postType' => get_post_type(),
            ));
        }

        if (get_post_type() == 'news') {
            array_push($results['news'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'postType' => get_post_type(),
                'postedOn' => get_the_date('M d, Y'),
                'authorName' => get_the_author(),
                'image' => get_the_post_thumbnail_url(0, 'news-square'),
                'description' => wp_trim_words(get_the_content(), 50)
            ));
        }

        if (get_post_type() == 'events') {
            $eventDate = new DateTime(get_field('event_date'));

            array_push($results['events'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'postType' => get_post_type(),
                'month' => $eventDate->format('M'),
                'day' => $eventDate->format('d'),
                'year' => $eventDate->format('Y'),
                'image' => get_the_post_thumbnail_url(0, 'news-square'),
                'description' => wp_trim_words(get_the_content(), 50)
            ));
        }
    }

    return $results;
}