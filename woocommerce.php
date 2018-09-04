<?php

//https://docs.woocommerce.com/document/tutorial-customising-checkout-fields-using-actions-and-filters/

// Show all products in SHOP page
# ============================================

add_filter( 'loop_shop_per_page', 'so_show_all_products' );
function so_31843880_show_all_products($per_page){
    if( is_taxonomy('product_cat') ){
        $per_page = -1;
    }
    return $per_page;
}



//Changes the "No products were found matching your selection." Text.
# ============================================

function change_woocommerce_no_products_found_text( $translated_text, $text, $domain ) {
       switch ( $translated_text ) {
                      case 'No products were found matching your selection.' :
   $translated_text = __( 'Sorry, no products were found at the moment.', 'woocommerce' );
   break;
  }
 return $translated_text; 
}
add_filter( 'gettext', 'change_woocommerce_no_products_found_text', 20, 3 );



/*STEP 1 - REMOVE ADD TO CART BUTTON ON PRODUCT ARCHIVE (SHOP) */
# ============================================

 function remove_loop_button(){
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    }
 add_action('init','remove_loop_button');
    

/*STEP 2 -ADD NEW BUTTON THAT LINKS TO PRODUCT PAGE FOR EACH PRODUCT */
# ============================================

add_action('woocommerce_after_shop_loop_item','replace_add_to_cart');
function replace_add_to_cart() {
    global $product;
    $link = $product->get_permalink();

    echo '<p style="text-align:center;margin-top:10px;">';
        echo do_shortcode('<a  href="'.$link.'" class="button product_type_variable add_to_cart_button">Product Details</a>');
    echo '</p>';
}




//Changes the "Return To Shop" button URL in the cart.
# ============================================

function wc_empty_cart_redirect_url() {
	return 'http://plerwear.com/';
}
add_filter( 'woocommerce_return_to_shop_redirect', 'wc_empty_cart_redirect_url' );


//Changes the "Return To Shop" button Text.
# ============================================

add_filter( 'gettext', 'change_woocommerce_return_to_shop_text', 20, 3 );
function change_woocommerce_return_to_shop_text( $translated_text, $text, $domain ) {
       switch ( $translated_text ) {
                      case 'Return to shop' :
   $translated_text = __( 'Return to homepage', 'woocommerce' );
   break;
  }
 return $translated_text; 
}


//Changes the "No products were found matching your selection." Text.
# ============================================

function change_woocommerce_no_products_found_text( $translated_text, $text, $domain ) {
       switch ( $translated_text ) {
                      case 'No products were found matching your selection.' :
   $translated_text = __( 'Sorry, no products were found at the moment.', 'woocommerce' );
   break;
  }
 return $translated_text; 
}
add_filter( 'gettext', 'change_woocommerce_no_products_found_text', 20, 3 );



// Checkput state/county option input
# ============================================

function mm_override_default_address_fields( $address_fields ) {
     $address_fields['state']['required'] = false;

     return $address_fields;
}
add_filter( 'woocommerce_default_address_fields' , 'mm_override_default_address_fields' );




// Woocommerce sorting on shop/archieve page
# ============================================

add_filter('woocommerce_catalog_orderby', 'wc_customize_product_sorting');

function wc_customize_product_sorting($sorting_options){
    $sorting_options = array(
        'menu_order' => __( 'Sorting', 'woocommerce' ),
        'popularity' => __( 'Sort by popularity', 'woocommerce' ),
        'rating'     => __( 'Sort by average rating', 'woocommerce' ),
        'date'       => __( 'Sort by newness', 'woocommerce' ),
        'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
        'price-desc' => __( 'Sort by price: high to low', 'woocommerce' ),
    );

    return $sorting_options;
}


// Search result only product
# ============================================

add_action( 'pre_get_posts', 'wpse223576_search_woocommerce_only' );

function wpse223576_search_woocommerce_only( $query ) {
  if( ! is_admin() && is_search() && $query->is_main_query() ) {
    $query->set( 'post_type', 'product' );
  }
}



// Add action under Single product featured img

function skyverge_add_below_featured_image() {
    echo '<h4 style="text-align:center;margin-top:10px;">Click to Enlarge</h4>';
}
add_action( 'woocommerce_product_thumbnails' , 'skyverge_add_below_featured_image', 9 );
