<?php

function webspeed_events_create_posttype() {
    register_post_type('event',
    	array('labels' => array(
    		'name' => __('Event', 'webspeed-domain'),
    		'singular_name' => __('Event', 'webspeed-domain')
    	),
    	'public' => true,
    	'menu_icon' => 'dashicons-calendar-alt',
    	//'taxonomies' => array('category'),
    	'has_archive' => true,
        'show_in_rest' => true,
    	'supports' => array(
    		'title',
    		'editor',
    		'excerpt',
    		'thumbnail'
    	),
    	'rewrite' => array(
    		'slug' => 'event'
    	),
    ));
}
add_action('init', 'webspeed_events_create_posttype');