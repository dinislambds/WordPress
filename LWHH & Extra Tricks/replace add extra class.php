<?php 
$philosophy_menu = wp_nav_menu( array(
        'theme_location' => 'topmenu', 
        'menu_id' => 'topmenu',
        'menu_class' => 'header__nav',
        'echo' => false
    ) );

$philosophy_menu = str_replace( 'menu-item-has-children', 'menu-item-has-children has-children', $philosophy_menu);
echo $philosophy_menu;
 ?>