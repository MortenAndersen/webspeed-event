<?php 

if ( ! function_exists ( 'simpleEvent_showdate' ) ) {
	function simpleEvent_showdate() {

			// Event dato start
		$date_start = get_field('event_start', false, false);
		$temp_event_start_date = date_i18n('j. F Y', strtotime($date_start));
		$temp_event_start_day = date_i18n('j', strtotime($date_start));
		$temp_event_start_day_month = date_i18n('j/n', strtotime($date_start));
		$temp_event_start_time = date_i18n('H:i', strtotime($date_start));

		// Event dato slut
		$date_slut = get_field('event_slut', false, false);
		$temp_event_slut_date = date_i18n('j. F Y', strtotime($date_slut));
		$temp_event_slut_day = date_i18n('j', strtotime($date_slut));
		$temp_event_slut_day_month = date_i18n('j/n', strtotime($date_slut));
		$temp_event_slut_time = date_i18n('H:i', strtotime($date_slut));
echo '<div class="eve-icon-con grid">';
	event_calendar_icon();

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
	echo '</div>';
	}
}