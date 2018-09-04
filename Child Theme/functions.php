<?php

function alpha_child_assets(){
    wp_enqueue_style("parent-style",get_parent_theme_file_uri("/style.css"));
}
add_action("wp_enqueue_scripts","alpha_child_assets");

function alpha_child_assets_dequeue(){
    wp_dequeue_style("alpha-style");
    wp_deregister_style("alpha-style");
    wp_enqueue_style("alpha-style",get_theme_file_uri("/assets/css/alpha.css"));
}
add_action("wp_enqueue_scripts","alpha_child_assets_dequeue",14);

function alpha_child_bootstrap_ed(){
    wp_dequeue_style("bootstrap");
    wp_deregister_style("bootstrap");
    wp_enqueue_style("bootstrap","//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap-grid.css");
}
add_action("wp_enqueue_scripts","alpha_child_bootstrap_ed",11);

function alpha_todays_date(){
    echo date("d-m-Y");
}