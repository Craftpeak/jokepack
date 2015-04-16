<?php
/**
 * this is where jokes begin!
 */

// Add a stupid joke class to the mother fuckin body
add_filter( 'body_class', 'jokepack_title_body_class' );
function jokepack_title_body_class( $classes ) {
	
	$classes[] = 'jokepack-tilt';
	
	return $classes;
}

/**
 * Jokepack Title Enqueue Scripts
 */
function jokepack_tilt_enqueue() {

	wp_enqueue_style( 'jokepack-tilt', plugins_url( 'js/jokepack-tilt.css', JOKEPACK_DIR, array(), null  );

}
add_action( 'wp_enqueue_scripts', 'jokepack_tilt_enqueue' );