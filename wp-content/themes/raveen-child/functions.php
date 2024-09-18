<?php

add_action( 'wp_enqueue_scripts', 'raveen_child_enqueue_styles', 11 );
function raveen_child_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( 'rivax-theme-style' ), 
        wp_get_theme()->get('Version') // this only works if you have Version in the style header
    );
	
	if ( is_rtl() ) {
		wp_enqueue_style( 'style-rtl', get_template_directory_uri() . '/rtl.css', array('rivax-theme-style') );
	}
}