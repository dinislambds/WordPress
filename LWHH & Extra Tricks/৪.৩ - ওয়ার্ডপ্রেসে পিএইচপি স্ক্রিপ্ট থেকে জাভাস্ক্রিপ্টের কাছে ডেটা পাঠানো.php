<?php 

//https://developer.wordpress.org/reference/functions/wp_localize_script/

// functions.php
function launcher_assets() {

	$launcher_year  = get_post_meta( get_the_ID(), "year", true );
    $launcher_month = get_post_meta( get_the_ID(), "month", true );
    $launcher_day   = get_post_meta( get_the_ID(), "day", true );

	wp_localize_script( "main-jquery-js", "datedata", array(
                "year"  => $launcher_year,
                "month" => $launcher_month,
                "day"   => $launcher_day,
            ) );
 }

add_action( "wp_enqueue_scripts", "launcher_assets" );


// Now on JS file


;(function ($) {

var countDown = function() {

		console.log(datedata);
		simplyCountdown('.simply-countdown-one', {
			year: datedata.year,
			month: datedata.month,
			day: datedata.day
		});

	};
}