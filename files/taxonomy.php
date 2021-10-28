<?php
// Let us create Taxonomy for Custom Post Type
add_action( 'init', 'simple_events_create_events_custom_taxonomy', 0 );

//create a custom taxonomy name it "type" for your posts
function simple_events_create_events_custom_taxonomy() {

  $labels = array(
    'name' => _x( 'Event Typer', 'taxonomy general name' ),
    'singular_name' => _x( 'Event Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Søg Event Types' ),
    'all_items' => __( 'Alle Event Typer' ),
    'parent_item' => __( 'Parent Event Type' ),
    'parent_item_colon' => __( 'Parent Event Type:' ),
    'edit_item' => __( 'Ret Event Type' ),
    'update_item' => __( 'Updater Event Type' ),
    'add_new_item' => __( 'Tilføj ny Event Type' ),
    'new_item_name' => __( 'Ny Event Type navn' ),
    'menu_name' => __( 'Typer' ),
  );

  register_taxonomy('event_types',array('event'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => false,
    'rewrite' => array( 'slug' => 'type' ),
  ));

}