<?php 

// Below code will add a table row add the last of phpmyadmin "wp_options" database named as "category_new"

function beginning_category_page( $category_title ) {
    if ( "New" == $category_title ) {
        $visit_count = get_option( "category_new" );
        $visit_count = $visit_count ? $visit_count : 0;
        $visit_count ++;
        update_option( "category_new", $visit_count );
    }
}

add_action( "philosphy_category_page", "beginning_category_page" );


// the function "philosphy_category_page" was do action on category.php like below-
do_action('philosphy_category_page');

 ?>