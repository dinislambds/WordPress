<?php 

// functions.php

//basename = get full directory

function launcher_assets() {

    //echo basename(get_page_template());
    //die();

    if(is_page()){
        $launcher_template_name = basename(get_page_template());  
        if($launcher_template_name == "launcher.php"){
            wp_enqueue_style( "animate-css", get_theme_file_uri( "/assets/css/animate.css" ) );
            wp_enqueue_style( "icomoon-css", get_theme_file_uri( "/assets/css/icomoon.css" ) );
            wp_enqueue_style( "bootstrap-css", get_theme_file_uri( "/assets/css/bootstrap.css" ) );
            wp_enqueue_style( "style-css", get_theme_file_uri( "/assets/css/style.css" ) );
            wp_enqueue_style( "launcher", get_stylesheet_uri(), null, "0.1" );

            wp_enqueue_script( "easing-jquery-js", get_theme_file_uri( "/assets/js/jquery.easing.1.3.js" ), array( "jquery" ), null, true );
            wp_enqueue_script( "bootstrap-jquery-js", get_theme_file_uri( "/assets/js/bootstrap.min.js" ), array( "jquery" ), null, true );
            wp_enqueue_script( "waypoint-jquery-js", get_theme_file_uri( "/assets/js/jquery.waypoints.min.js" ), array( "jquery" ), null, true );
            wp_enqueue_script( "countdown-jquery-js", get_theme_file_uri( "/assets/js/simplyCountdown.js" ), array( "jquery" ), null, true );
            wp_enqueue_script( "main-jquery-js", get_theme_file_uri( "/assets/js/main.js" ), array( "jquery" ), time(), true );

            $launcher_year  = get_post_meta( get_the_ID(), "year", true );
            $launcher_month = get_post_meta( get_the_ID(), "month", true );
            $launcher_day   = get_post_meta( get_the_ID(), "day", true );

            wp_localize_script( "main-jquery-js", "datedata", array(
                "year"  => $launcher_year,
                "month" => $launcher_month,
                "day"   => $launcher_day,
            ) );
        }else {
            wp_enqueue_style( "bootstrap-css", get_theme_file_uri( "/assets/css/bootstrap.css" ) );
            wp_enqueue_style( "launcher", get_stylesheet_uri(), null, "0.1" );

        }
    }


}

add_action( "wp_enqueue_scripts", "launcher_assets" );