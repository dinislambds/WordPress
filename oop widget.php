<?php

/**
*  Widget developemnt
*/
class ClassName extends WP_Widget
{
	
	public function __construct(argument)
	{
		parent __construct('ClassName', __('Widget Name', 'textdomain'), array(
			'description' => __('Hello This is a desctiption', 'textdomain') , 
		);)
	}
}