<?php 

//********** Initial Theme Support ***********//
//*******************************************//

function ieatwp_functions(){

	load_theme_textdomain('ieatwp', get_template_directory().'/languages');

	add_theme_support('automatic_feed_links');

	// Title of the website
	add_theme_support('title-tag');

	// Featured image support for post and pages
	add_theme_support('post-thumbnails');

	// HTML5 support for certain places
	add_theme_support('html5', array('comment-form','comment-list','gallery', 'caption'));

	//Post formats in Post page
	add_theme_support('post-formats', array('aside','image','video','quote','link','gallery','audio'));

	// Editor Style CSS (Mandatory as per Envato)
	add_editor_style( "/assets/css/editor-style.css" );

	// Menu register
	register_nav_menus(array(
		'primary' => __('Primary Menu', 'ieatwp')
	));




	//Optional
	//Place shortcode in Widget text field
	add_filter( 'widget_text', 'do_shortcode');

	// Custom header
	add_theme_support( 'custom-header' );

	// Custom Logo
	add_theme_support( 'custom-logo' );

	// Custom Background
	add_theme_support( 'custom-background' );


}
add_action('after_setup_theme','ieatwp_functions');




//******** Enqueue Style & Scripts ***********//
//*******************************************//

function ieatwp_style_scripts(){

	//**Enqueue Styles**//
	wp_enqueue_style('ieatwp-bootstrap-theme', get_template_directory_uri().'/css/bootstrap-theme.css');
	/*Fonts*/
	wp_enqueue_style('OpenSans', '//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600italic,600,700,700italic,800,800italic');
	/*Stylesheet*/
	wp_enqueue_style('stylesheet', get_stylesheet_uri() );


	//**Enqueue Scripts**//
	
	wp_enqueue_script('jQuery');
	/*Bootstrap JS*/
	wp_enqueue_script('bootstrap-js', get_template_directory_uri().'/js/bootstrap.min.js');
	/*Contact Form*/
	wp_enqueue_script('contactform', get_template_directory_uri().'/js/contactform.js');

}
add_action('wp_enqueue_scripts', 'ieatwp_style_scripts');




//******** Register Taxonomy/Category ********//
//*******************************************//

add_action( 'init', 'create_book_tax' );

function create_book_tax() {
	register_taxonomy(
		'portflio-cat',
		'portflio',
		array(
			'label' => __( 'Portfolio Cats', 'ieatwp' ),
			'rewrite' => array( 'slug' => 'portfolio-category' ),
			'hierarchical' => true,
		)
	);
}




//Register Custom Post Type

//Register Sidebar/Widget

//Register Custom Metabox

//Register Shotcode



