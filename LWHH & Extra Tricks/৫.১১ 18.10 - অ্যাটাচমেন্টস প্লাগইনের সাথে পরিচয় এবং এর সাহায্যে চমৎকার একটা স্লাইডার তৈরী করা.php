<?php
/* 
 ai file ta theme functions.php te akbar require_once korte hbe like below:
 require_once( get_theme_file_path( '/inc/attachments.php' ) ); 
*/

// Admin panel theke title off kora
define( 'ATTACHMENTS_SETTINGS_SCREEN', false );
// defauls post field remove kora
add_filter( 'attachments_default_instance', '__return_false' );


// Specific post type er jonne fileds create kora - ekhane "Gallery" post type er jonne filed creatr kora hoyeche
function philosophy_attachments( $attachments ) {
    $post_id = null;
    if ( isset( $_REQUEST['post'] ) || isset( $_REQUEST['post_ID'] ) ) {
        $post_id = empty( $_REQUEST['post_ID'] ) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
    }
    if ( ! $post_id || get_post_format( $post_id ) != "gallery" ) {
        return;
    }

    $fields = array(
        array(
            'name'  => 'title',
            'type'  => 'text',
            'label' => __( 'Title', 'philosophy' ),
        ),
    );

    $args = array(

        'label'       => 'Gallery',
        'post_type'   => array( 'post' ),
        'filetype'    => array( "image" ),
        'note'        => 'Add Gallery Images',
        'button_text' => __( 'Attach Image', 'philosophy' ),
        'fields'      => $fields,
    );

    $attachments->register( 'gallery', $args );
}

add_action( 'attachments_register', 'philosophy_attachments' );



// oporer image filed ke akta post type page e use kora hoyeche
// amader khetre post-gallery.php te like below

while ( $attachment = $attachments->get() ):
    ?>
    <div class="slider__slide">
        <?php echo $attachments->image("philosophy-home-square"); ?>
    </div>
<?php
endwhile;


//for details: https://github.com/jchristopher/attachments/blob/master/docs/usage.md