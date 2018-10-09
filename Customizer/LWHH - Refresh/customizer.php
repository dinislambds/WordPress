<?php
/**
 * @link LWHH Episode 28
 * @source https://developer.wordpress.org/themes/customize-api/customizer-objects/
 */

function cust_customizer_settings( $wp_customizer ) {
	$wp_customizer->add_section( 'cust_services', array(
		'title'    => __( 'Services', 'customizer' ),
		'priority' => '30'
	) );


	/**
	 * Type : Text
	 */

	$wp_customizer->add_setting( 'cust_services_heading', array(
		'default'   => "Mission Statement",
		'transport' => 'refresh', //postMessage
//		'type'=>'option' //theme_mod or option
	) );

	$wp_customizer->add_control( 'cust_services_heading_ctrl', array(
		'label'    => __( 'Services Heading', 'customizer' ),
		'section'  => 'cust_services',
		'settings' => 'cust_services_heading',
		'type'     => 'text'
	) );


	// Implementation ?>
	<h1 class="heading">
		<?php
		echo esc_html( get_theme_mod( 'cust_services_heading', __( 'Our Mission Statement', 'customizer' ) ) );
		//echo esc_html( get_option( 'cust_services_heading', __( 'Our Mission Statement', 'customizer' ) ) );
		?>
    </h1> 
    <?php // Implementation *******************************************//


    /**
	 * Type : Textarea
	 */

	$wp_customizer->add_setting( 'cust_services_subheading', array(
		'transport' => 'refresh', //postMessage
//		'type'=>'option' //theme_mod or option
	) );

	$wp_customizer->add_control( 'cust_services_subheading_ctrl', array(
		'label'    => __( 'Services Description', 'customizer' ),
		'section'  => 'cust_services',
		'settings' => 'cust_services_subheading',
		'type'     => 'textarea'
	) );

	// Implementation ?>
	<p class="subheading">
		<?php
		echo esc_html( get_theme_mod( 'cust_services_subheading' ), __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet animi dolorem eveniet
                harum ipsum necessitatibus nihil, pariatur praesentium quia voluptate.', 'customizer' ) );
		?>
    </p> 
    <?php // Implementation *******************************************//




    /**
	 * Type : Checkbox
	 */

	$wp_customizer->add_setting( 'cust_services_display_subheading', array(
		'default'   => 1,
		'transport' => 'refresh', //postMessage
	) );
	$wp_customizer->add_control( 'cust_services_display_subheading_ctrl', array(
		'label'    => __( 'Display Subheading', 'customizer' ),
		'section'  => 'cust_services',
		'settings' => 'cust_services_display_subheading',
		'type'     => 'checkbox'
	) );


	// Implementation 
	if ( get_theme_mod( 'cust_services_display_subheading', 1 ) ):
		?>
        <p class="subheading">
			<?php
			echo esc_html( get_theme_mod( 'cust_services_subheading' ), __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet animi dolorem eveniet
                    harum ipsum necessitatibus nihil, pariatur praesentium quia voluptate.', 'customizer' ) );
			?>
        </p>
	<?php
	endif; 
	 // Implementation *******************************************//


	/**
	 * Type : Color
	 */
	$wp_customizer->add_setting( 'cust_services_icon_color', array(
		'default'   => '#dd2d6a',
		'transport' => 'refresh'
	) );

	$wp_customizer->add_control( new WP_Customize_Color_Control( $wp_customizer, 'cust_icon_color_ctrl', array(
		'label'    => __( 'Icon Coolor', 'customizer' ),
		'section'  => 'cust_services',
		'settings' => 'cust_services_icon_color'
	) ) );

	// Implementation on function.php 
	function cust_assets(){
	wp_enqueue_style('cust-main',get_stylesheet_uri(),null,time());

	$services_icon_color = get_theme_mod('cust_services_icon_color','#dd2d6a');
	$services_style =<<<EOD
.service i {
    color: {$services_icon_color};
}
EOD;

	wp_add_inline_style('cust-main',$services_style);

}
add_action('wp_enqueue_scripts','cust_assets'); 
	 // Implementation *******************************************//



	$wp_customizer->add_setting( 'cust_services_number_of_items', array(
		'default'   => '4',
		'transport' => 'refresh'
	) );
	$wp_customizer->add_control( 'cust_services_number_of_items_ctrl', array(
		'label'    => __( 'Number of Items', 'customizer' ),
		'section'  => 'cust_services',
		'settings' => 'cust_services_number_of_items',
		'type'     => 'select',
		'choices'=>array(
			'4'=>'3 in Each Row',
			'6'=>'2 in Each Row'
		)
	) );




	/**
	 * About Page
	 * This section wil show only when the customer is on about page 
	 */

	$wp_customizer->add_section( 'cust_about', array(
		'title'           => __( 'About Page', 'customizer' ),
		'priority'        => '40',
		'active_callback' => function () {
			/*if(is_page_template('page-templates/about.php')){
				return true;
			}
			return false;*/

			return is_page_template('page-templates/about.php');
		}
	) );

	$wp_customizer->add_setting( 'cust_about_heading', array(
		'default'   => "About Page Heading",
		'transport' => 'refresh', //postMessage
//		'type'=>'option' //theme_mod or option
	) );

	$wp_customizer->add_control( 'cust_about_heading_ctrl', array(
		'label'    => __( 'About Page Heading', 'customizer' ),
		'section'  => 'cust_about',
		'settings' => 'cust_about_heading',
		'type'     => 'text'
	) );



	/**
	 * Special Controls
	 * @link https://developer.wordpress.org/themes/customize-api/customizer-objects/
	 */
	$wp_customizer->add_section( 'image_and_upload', array(
		'title'           => __( 'Image and Upload', 'customizer' ),
		'priority'        => '40',
	) );
	$wp_customizer->add_setting( 'test_image', array(
		'default'   => "Upload Image",
		'transport' => 'refresh',
	) );

	$wp_customizer->add_control(
		new WP_Customize_Image_Control(
			$wp_customizer,
			'test_logo',
			array(
				'label'      => __( 'Upload an Image', 'theme_name' ),
				'section'    => 'image_and_upload',
				'settings'   => 'test_image',
			)
		)
	);

	/*
	* Implement
	*/
	$attachment_id = attachment_url_to_postid(get_theme_mod("test_image"));
    echo wp_get_attachment_image($attachment_id);
    /*
	* Implement Done
	*/
                    

	$wp_customizer->add_setting( 'test_image2', array(
		'default'   => "Upload Image",
		'transport' => 'refresh',
	) );

	$wp_customizer->add_control(
		new WP_Customize_Media_Control(
			$wp_customizer,
			'test_image2',
			array(
				'label'      => __( 'Upload an Image', 'theme_name' ),
				'section'    => 'image_and_upload',
			)
		)
	);

	/*
	* Implement
	*/
	$attachment_id = get_theme_mod("test_image2");
	echo $attachment_id;
    /*
	* Implement Done
	*/

	$wp_customizer->add_setting( 'test_file1', array(
		'default'   => "Upload Image",
		'transport' => 'refresh',
	) );

	$wp_customizer->add_control(
		new WP_Customize_Upload_Control(
			$wp_customizer,
			'test_file1',
			array(
				'label'      => __( 'Upload a File', 'theme_name' ),
				'section'    => 'image_and_upload',
			)
		)
	);

	/*
	* Implement
	*/
	$attachment_id = get_theme_mod("test_file1");
	echo $attachment_id;
    /*
	* Implement Done
	*/

	$wp_customizer->add_setting( 'test_image3', array(
		'default'   => "Upload Image",
		'transport' => 'refresh',
	) );

	$wp_customizer->add_control(
		new WP_Customize_Cropped_Image_Control(
			$wp_customizer,
			'test_image3',
			array(
				'label'      => __( 'Upload a File', 'theme_name' ),
				'section'    => 'image_and_upload',
				'height'=>600,
				'width'=>800
			)
		)
	);
	/*
	* Implement
	*/
	$attachment_id = get_theme_mod("test_image3");
    /*
	* Implement Done
	*/




	/**
	 * Other Controls
	 */
	$wp_customizer->add_section( 'cust_others', array(
		'title'    => __( 'Other Controls', 'customizer' ),
		'priority' => '40'
	) );
	$wp_customizer->add_setting( 'cust_others_demo_radio', array(
		'default'   => 'choice3',
		'transport' => 'refresh', //postMessage
	) );
	$wp_customizer->add_control( 'cust_others_demo_radio_ctrl', array(
		'label'    => __( 'Radio Button', 'customizer' ),
		'section'  => 'cust_others',
		'settings' => 'cust_others_demo_radio',
		'type'     => 'radio',
		'choices'  => array(
			'choice1' => __( 'Choice One', 'customizer' ),
			'choice2' => __( 'Choice Two', 'customizer' ),
			'choice3' => __( 'Choice Three', 'customizer' ),
			'choice4' => __( 'Choice Four', 'customizer' ),
		)
	) );

	$wp_customizer->add_setting( 'cust_others_demo_select', array(
		'default'   => 'choice3',
		'transport' => 'refresh', //postMessage
	) );
	$wp_customizer->add_control( 'cust_others_demo_select_ctrl', array(
		'label'    => __( 'Dropdown', 'customizer' ),
		'section'  => 'cust_others',
		'settings' => 'cust_others_demo_select',
		'type'     => 'select',
		'choices'  => array(
			'choice1' => __( 'Choice One', 'customizer' ),
			'choice2' => __( 'Choice Two', 'customizer' ),
			'choice3' => __( 'Choice Three', 'customizer' ),
			'choice4' => __( 'Choice Four', 'customizer' ),
		)
	) );

	$wp_customizer->add_setting( 'cust_others_demo_pages', array(
		'default'   => 'choice3',
		'transport' => 'refresh', //postMessage
	) );
	$wp_customizer->add_control( 'cust_others_demo_pages_ctrl', array(
		'label'          => __( 'Available Pages', 'customizer' ),
		'section'        => 'cust_others',
		'settings'       => 'cust_others_demo_pages',
		'type'           => 'dropdown-pages',
		'allow_addition' => true
	) );

	$wp_customizer->add_setting( 'cust_others_html5_number', array(
		'default'   => '10',
		'transport' => 'refresh', //postMessage
	) );
	$wp_customizer->add_control( 'cust_others_html5_number_ctrl', array(
		'label'       => __( 'Number Field', 'customizer' ),
		'section'     => 'cust_others',
		'settings'    => 'cust_others_html5_number',
		'type'        => 'number',
		'input_attrs' => array(
			'min'  => 10,
			'max'  => 20,
			'step' => 2
		)
	) );

	$wp_customizer->add_setting( 'cust_others_html5_range', array(
		'default'   => '10',
		'transport' => 'refresh', //postMessage
	) );
	$wp_customizer->add_control( 'cust_others_html5_range_ctrl', array(
		'label'       => __( 'Range Field', 'customizer' ),
		'section'     => 'cust_others',
		'settings'    => 'cust_others_html5_range',
		'type'        => 'range',
		'input_attrs' => array(
			'min'  => 10,
			'max'  => 20,
			'step' => 2
		)
	) );

	$wp_customizer->add_setting( 'cust_others_html5_date', array(
		'transport' => 'refresh', //postMessage
	) );
	$wp_customizer->add_control( 'cust_others_html5_date_ctrl', array(
		'label'       => __( 'Date Field', 'customizer' ),
		'section'     => 'cust_others',
		'settings'    => 'cust_others_html5_date',
		'type'        => 'date',
		'input_attrs' => array(
			'min'  => 10,
			'max'  => 20,
			'step' => 2
		)
	) );

	$wp_customizer->add_setting( 'cust_others_html5_week', array(
		'transport' => 'refresh', //postMessage
	) );
	$wp_customizer->add_control( 'cust_others_html5_week_ctrl', array(
		'label'       => __( 'Week Field', 'customizer' ),
		'section'     => 'cust_others',
		'settings'    => 'cust_others_html5_week',
		'type'        => 'week',
		'input_attrs' => array(
			'min'  => 10,
			'max'  => 20,
			'step' => 2
		)
	) );


}

add_action( 'customize_register', 'cust_customizer_settings' );