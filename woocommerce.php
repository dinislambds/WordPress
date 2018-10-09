<?php

//https://docs.woocommerce.com/document/tutorial-customising-checkout-fields-using-actions-and-filters/

// Show all products in SHOP page

add_filter( 'loop_shop_per_page', 'so_show_all_products' );
function so_31843880_show_all_products($per_page){
    if( is_taxonomy('product_cat') ){
        $per_page = -1;
    }
    return $per_page;
}



//Changes the "No products were found matching your selection." Text.
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

 function remove_loop_button(){
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    }
 add_action('init','remove_loop_button');
    

/*STEP 2 -ADD NEW BUTTON THAT LINKS TO PRODUCT PAGE FOR EACH PRODUCT */

add_action('woocommerce_after_shop_loop_item','replace_add_to_cart');
function replace_add_to_cart() {
    global $product;
    $link = $product->get_permalink();

    echo '<p style="text-align:center;margin-top:10px;">';
        echo do_shortcode('<a  href="'.$link.'" class="button product_type_variable add_to_cart_button">Product Details</a>');
    echo '</p>';
}




//Changes the "Return To Shop" button URL in the cart.

function wc_empty_cart_redirect_url() {
	return 'http://plerwear.com/';
}
add_filter( 'woocommerce_return_to_shop_redirect', 'wc_empty_cart_redirect_url' );


//Changes the "Return To Shop" button Text.
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

function mm_override_default_address_fields( $address_fields ) {
     $address_fields['state']['required'] = false;

     return $address_fields;
}
add_filter( 'woocommerce_default_address_fields' , 'mm_override_default_address_fields' );




// Woocommerce sorting on shop/archieve page

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


/**
* Text change
*/
function ieatwp_text_strings_messages($translation, $text, $domain) {
    if ($domain == 'woocommerce') {
        if ($text == 'Cart updated.') {
            $translation = 'Shopping bag updated.';
        }
        if ($text == 'Cart totals') {
            $translation = 'Totals';
        }

        if ($text == 'Update cart') {
            $translation = 'Update Shopping Bag';
        }

        if ($text == 'Your cart is currently empty.') {
            $translation = 'Your shopping bag is currently empty.';
        }

        if ($text == 'View cart') {
            $translation = 'View shopping bag';
        }
        if ($text == 'added to your cart.') {
            $translation = 'added to your shopping bag.';
        }
    }

    return $translation;
}
add_filter('gettext', 'ieatwp_text_strings_messages', 10, 3);


/**
* Product has been added to cart - text change
*/

add_filter( 'wc_add_to_cart_message', 'ieatwp_add_to_cart_function', 10, 2 ); 

function ieatwp_add_to_cart_function( $message, $product_id ) { 
    $added_text = sprintf(esc_html__(' "%s" has been added by to your shopping bag.','woocommerce'), get_the_title( $product_id ) );

    $message = sprintf( '%s <a href="%s" class="button">%s</a>',
              esc_html( $added_text ),
              esc_url( wc_get_page_permalink( 'cart' ) ),
              esc_html__( 'View Shopping Bag', 'woocommerce' ));

    return $message; 
}



/**
* Order confirmation email template for customer
*/

add_action('woocommerce_checkout_subscription_created', 'extends_update_status', 100, 3);
 
function extends_update_status($subscription, $order, $cart) {


$to = $subscription->get_billing_email();
$subject = 'Il tuo piano All Inclusive Business è attivo';
$body = '

<p>&nbsp;</p>
<p><img src="https://subscribe.allinclusivebusiness.com/wp-content/uploads/2018/09/logo-allinclusivebusiness.png" alt="" width="220px" /></p>
<p>&nbsp;</p>
<h1><span class="_5yl5"> Il tuo piano All Inclusive &egrave; attivo!</span></h1>
<p>&nbsp;</p>
<p style="font-size: 16px;">Il tuo piano All Inclusive Business è adesso attivo e si rinnoverà automaticamente al termine del periodo di validità in base al piano che hai scelto: annuale o mensile.
Grazie per aver sottoscritto l\'abbonamento!</p>
<p style="font-size: 16px;">Per qualsiasi domanda, se hai bisogno di aiuto o vuoi dare un feedback non esitare a contattarci all\'indirizzo info@allinclusivebusiness.com.</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p style="font-size: 16px;">A presto,</p>
<p style="font-size: 16px;">Il Team All Inclusive Business</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
';


$headers[] = 'From: Allinclusive Business <info@allinclusivebusiness.com>';
$headers[] = 'Content-Type: text/html; charset=UTF-8';


wp_mail( $to, $subject, $body, $headers );


}
