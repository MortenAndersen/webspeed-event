<?php

// Dato i dag
function simpleEvent_idag(){
	$i_dag = new DateTime(null, new DateTimeZone('Europe/Copenhagen'));
	$today = $i_dag->format('Y-m-d H:i:s');
}

// Event image
function simpleEvent_img() {
	$content = get_the_content();
	$link = get_field('event_alternativ_landing_page');

		if(!empty($content) && empty($link)) {
			echo '<a href="' . get_the_permalink() . '">';
			echo '<div class="event-img">';
				the_post_thumbnail('large');
			echo '</div>';
			echo '</a>';
		} else if(!empty($link)) {
			echo '<a href="' . esc_url( $link ) . '">';
			echo '<div class="event-img">';
				the_post_thumbnail('large');
			echo '</div>';
			echo '</a>';
		}
		else {
			echo '<div class="event-img">';
				the_post_thumbnail('large');
			echo '</div>';
		}
}

// Event title
function simpleEvent_title(){
	echo '<p class="event-title">' . get_web_title(); '</p>';
}

// Event link
function simpleEvent_eventLink(){
	$content = get_the_content();
	$link = get_field('event_alternativ_landing_page');

		if(!empty($content) && empty($link)) {
  		echo '<div class="event-read-more"><a href="' . get_the_permalink() . '">' . __( 'Read More', 'webspeed-domain' ) . '</a></div>';
		}
		if(!empty($link)) {
			echo '<div class="event-read-more"><a href="' . esc_url( $link ) . '">' . __( 'Read More', 'webspeed-domain' ) . '</a></div>';
		}
}

// Event kort beskrivelse
function simpleEvent_kortBeskrivelse(){
	if( get_field('event_kort_beskrivelse') ) {
  	echo '<div class="event-kort-tekst">' . get_field('event_kort_beskrivelse') . '</div>';
	}
}

// Event betalingslink
function simpleEvent_payLink(){
	if( get_field('event_billetlink') ) {
		echo '<div class="event-buy-link"><a href="' . get_field('event_billetlink') . '" target="_blank">' . get_field('event_billetlink_tekst') . '</a></div>';
	}
}

// Event edit.link
function simpleEvent_editLink(){
	edit_post_link( __( 'Edit', 'webspeed-domain' ));
}

if ( ! function_exists ( 'simpleEvent_showdate' ) ) {
	function simpleEvent_showdate() {

			// Event dato start
		$date_start = get_field('event_start', false, false);
		$temp_event_start_date = date_i18n('d. F Y', strtotime($date_start));
		$temp_event_start_day = date_i18n('d', strtotime($date_start));
		$temp_event_start_day_month = date_i18n('d.m', strtotime($date_start));
		$temp_event_start_time = date_i18n('H:i', strtotime($date_start));

		// Event dato slut
		$date_slut = get_field('event_slut', false, false);
		$temp_event_slut_date = date_i18n('d. F Y', strtotime($date_slut));
		$temp_event_slut_day = date_i18n('d', strtotime($date_slut));
		$temp_event_slut_day_month = date_i18n('d.m', strtotime($date_slut));
		$temp_event_slut_time = date_i18n('H:i', strtotime($date_slut));


			echo '<div class="event-date-time">';
		if ($temp_event_start_day === $temp_event_slut_day) :
		  echo '<span class="event-start-day">' . $temp_event_start_day_month . ' </span> <span class="event-klokken"><img src="' . get_template_directory_uri() . '/assets/images/time.svg" alt="time" /></span> <span class="event-start-time">' . $temp_event_start_time . '</span>';
		  echo ' <span class="event-til evnet-til-ens-start-end"> - </span> ';
		  echo '<span class="event-end-time">' . $temp_event_slut_time . '</span>';
		else :
		  echo '<span class="event-start-day">' . $temp_event_start_day_month . ' </span> <span class="event-klokken"><img src="' . get_template_directory_uri() . '/assets/images/time.svg" alt="time" /></span> <span class="event-start-time">' . $temp_event_start_time . '</span>';
		  echo ' <span class="event-til"> - </span> ';
		  echo '<span class="event-end-day">' . $temp_event_slut_day_month . ' </span> <span class="event-klokken end-time"><img src="' . get_template_directory_uri() . '/assets/images/time.svg" alt="time" /></span> <span class="event-end-time">' . $temp_event_slut_time . '</span>';
		endif;
		echo '</div>';
	}
}

// Show date med år
if ( ! function_exists ( 'simpleEvent_showdate_year' ) ) {
	function simpleEvent_showdate_year() {

			// Event dato start
		$date_start = get_field('event_start', false, false);
		$temp_event_start_date = date_i18n('d. F Y', strtotime($date_start));
		$temp_event_start_day = date_i18n('d', strtotime($date_start));
		$temp_event_start_day_month = date_i18n('d.m', strtotime($date_start));
		$temp_event_start_time = date_i18n('H:i', strtotime($date_start));
		$temp_event_start_year = date_i18n('Y', strtotime($date_start));

		// Event dato slut
		$date_slut = get_field('event_slut', false, false);
		$temp_event_slut_date = date_i18n('d. F Y', strtotime($date_slut));
		$temp_event_slut_day = date_i18n('d', strtotime($date_slut));
		$temp_event_slut_day_month = date_i18n('d.m', strtotime($date_slut));
		$temp_event_slut_time = date_i18n('H:i', strtotime($date_slut));


			echo '<div class="event-date-time">';
		if ($temp_event_start_day === $temp_event_slut_day) :
		  echo '<span class="event-start-day">' . $temp_event_start_day_month . ' </span> <span class="event-klokken"><img src="' . get_template_directory_uri() . '/assets/images/time.svg" alt="time" /></span> <span class="event-start-time">' . $temp_event_start_time . '</span>';

		  echo ' <span class="event-til evnet-til-ens-start-end"> - </span> ';
		  echo '<span class="event-end-time">' . $temp_event_slut_time . '</span>';
		  echo '<span class="event-start-year"> - (' . $temp_event_start_year . ')</span>';
		else :
		  echo '<span class="event-start-day">' . $temp_event_start_day_month . ' </span> <span class="event-klokken"><img src="' . get_template_directory_uri() . '/assets/images/time.svg" alt="time" /></span> <span class="event-start-time">' . $temp_event_start_time . '</span>';
		  echo ' <span class="event-til"> - </span> ';
		  echo '<span class="event-end-day">' . $temp_event_slut_day_month . ' </span> <span class="event-klokken end-time"><img src="' . get_template_directory_uri() . '/assets/images/time.svg" alt="time" /></span> <span class="event-end-time">' . $temp_event_slut_time . '</span>';
		  echo '<span class="event-start-year"> - (' . $temp_event_start_year . ')</span>';
		endif;
		echo '</div>';
	}
}

// Event label
function simleEvent_label(){
	if( get_field('event_label') ) {
		echo '<div class="event-label small-font"><em>' . get_field('event_label') . '</em></div>';
	}
}

// Event start date - Month and day
function simpleEvent_day_month() {
	$date = get_field('event_start');
	$date_day = date("d", strtotime($date));
	$date_month = date_i18n("F", strtotime($date));

	// End
	$date_end = get_field('event_slut');
	$date_day_end = date("d", strtotime($date_end));

	if ( $date_day_end > $date_day) {
		echo '<div class="event-short-day">' . $date_day . '-' . $date_day_end . '</div>';
	} else {
		echo '<div class="event-short-day">' . $date_day . '</div>';
	}


 		echo '<div class="event-short-month">' .$date_month . '</div>';

}

// Event start date - Month and day
function simpleEvent_day_month_end() {
	$date = get_field('event_slut');
	$date_day = date("d", strtotime($date));
	$date_month = date_i18n("F", strtotime($date));

		echo '<div class="event-short-day">' . $date_day . '</div>';

 }