<?php 
// Event start date - Month and day
function simpleEvent_day_month() {
	$date = get_field('event_start');
	$date_day = date("j", strtotime($date));
	$date_month = date_i18n("m", strtotime($date));
	$date_month_print = date_i18n("F", strtotime($date));

	// End
	$date_end = get_field('event_slut');
	$date_day_end = date("j", strtotime($date_end));
	$date_month_end = date_i18n("m", strtotime($date_end));
	$date_month_end_print = date_i18n("F", strtotime($date_end));

	// Samme dag og samme måned
	if ($date_month == $date_month_end && $date_day_end == $date_day) {
		echo '<div class="event-short-day">' . $date_day . '</div>';
		echo '<div class="event-short-month">' .$date_month_print . '</div>';
	}
	// Forskellige dage og samme måned
	if ($date_month == $date_month_end && $date_day <  $date_day_end) {
		echo '<div class="event-short-day">' . $date_day . ' - ' . $date_day_end . '</div>';
		echo '<div class="event-short-month">' .$date_month_print . '</div>';
	}
	// Forskellige dage og forskellig måned
	if ($date_month < $date_month_end) {
	 	 
		echo '<div class="event-short-day">' . $date_day . '</div>';
		echo '<div class="event-short-month">' .$date_month_print . '</div>';
		echo '<div class="event-short-day">' . $date_day_end . '</div>';
		echo '<div class="event-short-month">' .$date_month_end_print . '</div>';
	}
}

// VIGTIGT - virker ikke når event går på tværs af to år ... skal fixes