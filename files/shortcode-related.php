<?php
// Event Shortcode - vis alle event som IKKE er aholdt endnu

add_shortcode('event-related', 'webspeed_event_related');

function webspeed_event_related($atts) {
  global $post;
  ob_start();

// define attributes
  extract(shortcode_atts(array('event_type' => 'nye', 'antal' => '3'), $atts));



/* ------------------------------------------------------------------
    Nye eller gamle events defineres i shorcode
------------------------------------------------------------------ */

if ($event_type == 'gamle') {
    $compare = '<';
} else {
    $compare = '>=';
}

/* ------------------------------------------------------------------
    Dato i dag
------------------------------------------------------------------ */

$i_dag = new DateTime(null, new DateTimeZone('Europe/Copenhagen'));
$i_dag = $i_dag->modify( '-1 day' );
$today = $i_dag->format('Y-m-d H:i:s');


/* ------------------------------------------------------------------
    Dato flow
------------------------------------------------------------------ */
$event_related_tax = wp_get_object_terms( $post->ID, 'event_types', array('fields' => 'ids') );

$args = array(
  'post_type' => 'event',
  'posts_per_page' => -1,
  'orderby' => 'meta_value',
  'meta_key' => 'event_start',
  'meta_type' => 'DATETIME',
  'order' => 'ASC',
  'posts_per_page' => $antal,
  'post__not_in' => array($post->ID),
  'tax_query' => array(
        array (
            'taxonomy' => 'event_types',
            'field' => 'ids',
            'terms' => $event_related_tax,
        )
    ),

    'meta_query' => array(
    'relation' => 'OR',
      array(
        'key' => 'event_slut' ,
        'compare' => $compare,
        'value' => $today,
        'type' => 'date'
      ),
     array(
       'key' => 'event_start' ,
       'compare' => $compare,
       'value' => $today,
       'type' => 'date'
      ),
    )
);

/* ------------------------------------------------------------------
    HTML begynder
------------------------------------------------------------------ */

$shows = get_posts($args );
$current_header = '';

echo '<div class="event-con">';
foreach ($shows as $post ) : setup_postdata($post);

/* ------------------------------------------------------------------
    Dato formater - bruges til output og if check
------------------------------------------------------------------ */

// Event dato start
$date_start = get_field('event_start', false, false);


// Måneds inddeling -> dato
$temp_header = date_i18n('F Y', strtotime($date_start));

if ( $temp_header != $current_header ) {
    $current_header = $temp_header;
    //echo '<h3 class="event-month">' .$current_header. '</h3>';
}

/* ------------------------------------------------------------------
    Skjul dato
------------------------------------------------------------------ */

  $event_option = get_field('event_options');

  // Skjul tid
  // Skjul sluttid

/* ------------------------------------------------------------------
    HTML - events
------------------------------------------------------------------ */

// tjek om tid skal sklules
if( $event_option && in_array('Skjul tid', $event_option) ):
echo '<div class="event hide-all-time">';
elseif( $event_option && in_array('Skjul sluttid', $event_option) ):
  echo '<div class="event hide-end-time">';
else :
echo '<div class="event">';
endif;
// slut på tjek

// Vis billede
//the_post_thumbnail('event_small');
simpleEvent_img();

// Vis titel på event
simpleEvent_title();

// Vis datoer på event
simpleEvent_showdate();

// Event label
simleEvent_label();

// Kkort beskrivelse
simpleEvent_kortBeskrivelse();

// Link til event
simpleEvent_eventLink();

// Link til betaling / tilmelding
// simpleEvent_payLink();

// Edit link til event
simpleEvent_editLink();



echo '</div>';

endforeach;
echo '</div>';
wp_reset_postdata();

/* ------------------------------------------------------------------
    HTML slutter
------------------------------------------------------------------ */


/* ------------------------------------------------------------------
    Shortcode END
------------------------------------------------------------------ */

  $myvariable = ob_get_clean();
  return $myvariable;
}