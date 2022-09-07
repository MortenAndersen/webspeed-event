<?php 

function event_alt_dato() {

if( have_rows('alternative_datoer') ) {
	echo '<div class="event-date-time">';
    // Loop through rows.
    while( have_rows('alternative_datoer') ) : the_row();

        // Load sub field value.
        $sub_value = get_sub_field('dato');
        // Do something...
        echo '<div class="eve-icon-con grid alt-date">';
				event_calendar_icon();
			echo '<div class="eve-alt-txt">';
        		echo $sub_value;
        	echo '</div>';
        echo '</div>';

    // End loop.
    endwhile;
 echo '</div>';
}

}