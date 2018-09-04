<?php 
// on body put extra class using array
// Same on post class
?>
<body <?php body_class(array("first_class","second_class")); ?>>

<div <?php post_class(array("first_class","second_class")); ?>>



<?php
// Add class or unset class using functions.php

function alpha_body_class($classes){
    unset($classes[array_search("custom-background", $classes)]); // removing a class
    unset($classes[array_search("single-format-audio", $classes)]);
    $classes[] = "newclass"; // Adding class
    return $classes;
}
add_filter("body_class","alpha_body_class");


function alpha_post_class($classes){
    unset($classes[array_search("format-audio", $classes)]);
    return $classes;
}
add_filter("post_class","alpha_post_class");