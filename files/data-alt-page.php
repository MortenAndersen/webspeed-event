<?php
add_shortcode('eventdata', 'mother_event_data');
function mother_event_data($atts) {
  global $post;
  ob_start();

  // define attributes and their defaults
    extract(shortcode_atts(array('type' => 'kalender' ), $atts));


    /* ------------------------------------------------------------------
    Dato i dag
------------------------------------------------------------------ */

$i_dag = new DateTime(null, new DateTimeZone('Europe/Copenhagen'));
$i_dag = $i_dag->modify( '-1 day' );
$today = $i_dag->format('Y-m-d H:i:s');


   $loop = new WP_Query( array(
  'post_type' => 'event',
  'posts_per_page' => -1,
  'orderby' => 'meta_value',
  'meta_key' => 'event_start',
  'meta_type' => 'DATETIME',
  'order' => 'ASC',
  'tax_query' => array(
        array (
            'taxonomy' => 'event_types',
            'field' => 'slug',
            'terms' => $type,
        )
    ),

  'meta_query' => array(
    'relation' => 'OR',
      array(
        'key' => 'event_slut' ,
        'compare' => '>=',
        'value' => $today,
        'type' => 'date'
      ),
     array(
       'key' => 'event_start' ,
       'compare' => '>=',
       'value' => $today,
       'type' => 'date'
      ),
    )
    )
);


if ( $loop->have_posts() ) {
	echo '<div class="grid-con g3 event-data-con">';
	while ( $loop->have_posts() ) : $loop->the_post();
		$event_option = get_field('event_options');
 		if( $event_option && in_array('Skjul tid', $event_option) ):
			echo '<div class="event hide-all-time">';
		elseif( $event_option && in_array('Skjul sluttid', $event_option) ):
  		echo '<div class="event hide-end-time">';
		else :
			echo '<div class="event">';
		endif;
				simpleEvent_showdate();
			echo '</div>';
			echo '<div>';
				simleEvent_label();
			echo '</div>';
			echo '<div>';
				simpleEvent_payLink();
			echo '</div>';
	endwhile; wp_reset_query();
	echo '</div>';
}

$myvariable = ob_get_clean();
	return $myvariable;
}
