<?php
// Event Shortcode - vis alle event som IKKE er aholdt endnu

add_shortcode('event', 'webspeed_event');

function webspeed_event($atts) {
  global $post;
  ob_start();

// define attributes
  extract(shortcode_atts(array(
    'event_type' => 'nye', 
    'type' => 'kalender',
    'grid' => '2',
    'gap' => '2',
    'hide_pay' => 'nej',
    'order' => 'ASC',
), $atts));


require get_parent_theme_file_path('/inc/grid-gap.php');

/* ------------------------------------------------------------------
    Nye eller gamle events defineres i shorcode
------------------------------------------------------------------ */

if ($event_type == 'gamle') {
    $compare = '<';
    $relation = 'AND';
} else {
    $compare = '>=';
    $relation = 'OR';
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

$args = array(
  'post_type' => 'event',
  'posts_per_page' => -1,
  'orderby' => 'meta_value',
  'meta_key' => 'event_start',
  'meta_type' => 'DATETIME',
  'order' => $order,
  'tax_query' => array(
        array (
            'taxonomy' => 'event_types',
            'field' => 'slug',
            'terms' => $type,
        )
    ),

    'meta_query' => array(
    'relation' => $relation,
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
$i = 0;
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
    if ( $i > 0 ) {
      echo '</div>';
    }
    echo '<h3 class="event-month ' . $i . '">' .$current_header. '</h3>';
    echo '<div class="event-month-con grid' . $grid_class . $gap_class . '">';
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
if( $event_option && in_array('Skjul tid', $event_option) ) {
    $hide_time = ' hide-all-time';
} elseif( $event_option && in_array('Skjul sluttid', $event_option) ) {
  $hide_time = ' hide-end-time';
} else {
    $hide_time = ' viser-alle-tider';
}

// slut på tjek

echo '<div class="event' . $hide_time . '">';

// Billede
event_img();

echo '<div class="event-txt">';
// Vis titel på event
simpleEvent_title();

// Vis datoer på event
if( have_rows('alternative_datoer') ) {
    event_alt_dato();
} else {
    simpleEvent_showdate();
}

// Event label
simleEvent_label();

// Event location
simpleEvent_location();



// Kkort beskrivelse
simpleEvent_kortBeskrivelse();

// Link til event
simpleEvent_eventLink();

// Link til betaling / tilmelding
if ($hide_pay > 'ja') {
    simpleEvent_payLink();
}

// Edit link til event
simpleEvent_editLink();

echo '</div>';


echo '</div>';
$i++;
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