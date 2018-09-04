<?php  

//http://demo.lwhh.com = demo website url
if ( site_url() == "http://demo.lwhh.com" ) {
    define( "VERSION", time() );
} else {  // for live server
    define( "VERSION", wp_get_theme()->get( "Version" ) );
}

// Now use the version like below
function alpha_assets() {
    wp_enqueue_style( "alpha", get_stylesheet_uri(), null, VERSION );

    wp_enqueue_script( "alpha-main", get_theme_file_uri( "/assets/js/main.js" ), array(
        "jquery",
        "featherlight-js"
    ), VERSION, true );
}

add_action( "wp_enqueue_scripts", "alpha_assets" );