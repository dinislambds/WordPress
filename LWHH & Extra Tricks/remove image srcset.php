<?php 

//put below code in functions.php

function alpha_image_srcset(){
    return null;
}
add_filter("wp_calculate_image_srcset","alpha_image_srcset");


// Simple and Easy is below!

add_filter("wp_calculate_image_srcset","__return_null");


// Echo date

if(!function_exists("alpha_todays_date")) {
    function alpha_todays_date() {
        echo date( "d/m/y" );
    }
}