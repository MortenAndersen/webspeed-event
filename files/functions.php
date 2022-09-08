<?php

// Dato i dag
function simpleEvent_idag(){
	$i_dag = new DateTime(null, new DateTimeZone('Europe/Copenhagen'));
	$today = $i_dag->format('Y-m-d H:i:s');
}

// Event loaction
function simpleEvent_location(){
	$loaction = get_field('location');
	if ($loaction) {
		echo '<div class="eve-icon-con grid">';
				event_location_icon();
			echo '<div class="eve-log-txt">';
				echo $loaction;
			echo '</div>';
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

  	echo '<div class="eve-icon-con grid">';
  		event_info_icon();
			echo '<div class="eve-kort-txt">';
  		echo get_field('event_kort_beskrivelse');
  		echo '</div>';
  	echo '</div>';
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



// Show date med år
if ( ! function_exists ( 'simpleEvent_showdate_year' ) ) {
	function simpleEvent_showdate_year() {

			// Event dato start
		$date_start = get_field('event_start', false, false);
		$temp_event_start_date = date_i18n('j. F Y', strtotime($date_start));
		$temp_event_start_day = date_i18n('j', strtotime($date_start));
		$temp_event_start_day_month = date_i18n('j/n', strtotime($date_start));
		$temp_event_start_time = date_i18n('H:i', strtotime($date_start));
		$temp_event_start_year = date_i18n('Y', strtotime($date_start));

		// Event dato slut
		$date_slut = get_field('event_slut', false, false);
		$temp_event_slut_date = date_i18n('d. F Y', strtotime($date_slut));
		$temp_event_slut_day = date_i18n('d', strtotime($date_slut));
		$temp_event_slut_day_month = date_i18n('j.n', strtotime($date_slut));
		$temp_event_slut_time = date_i18n('H:i', strtotime($date_slut));


			echo '<div class="event-date-time eve-icon-con grid">';
			
				event_calendar_icon();

echo '<div class="eve-time-con">';


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
function simpleEvent_day_month_end() {
	$date = get_field('event_slut');
	$date_day = date("d", strtotime($date));
	$date_month = date_i18n("F", strtotime($date));

		echo '<div class="event-short-day">' . $date_day . '</div>';

 }