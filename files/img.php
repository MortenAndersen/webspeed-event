<?php 

// Event image
function simpleEvent_img() {
	$content = get_the_content();
	$link = get_field('event_alternativ_landing_page');

		if(!empty($content) && empty($link)) {
			echo '<a href="' . get_the_permalink() . '">';
			echo '<div class="event-img">';
				the_post_thumbnail('event-img');
			echo '</div>';
			echo '</a>';
		} else if(!empty($link)) {
			echo '<a href="' . esc_url( $link ) . '" target="_blank">';
			echo '<div class="event-img">';
				the_post_thumbnail('event-img');
			echo '</div>';
			echo '</a>';
		}
		else {
			echo '<div class="event-img">';
				the_post_thumbnail('event-img');
			echo '</div>';
		}
}

function event_img() {
if ( has_post_thumbnail() ) {
    echo '<div class="img-zoom">';
    echo '<div class="overflow">';
      simpleEvent_img();
      echo '<div class="event-day-month">';
        simpleEvent_day_month();
      echo '</div>';
    echo '</div>';
    echo '</div>';
}
}