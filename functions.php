<?php
/**
 * 
 *  Functions.php - to child themes Twenty Twenty
 * 
 */

// Add custom style css to theme parent and custom style

function add_twentytwenty_child_style() {
    // Include parent style
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
    // Include custom style
    wp_enqueue_style( 'child-custom-style', get_stylesheet_directory_uri().'/assets/css/custom.css' );
}

add_action( 'wp_enqueue_scripts', 'add_twentytwenty_child_style' );
