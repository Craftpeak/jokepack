<?php
/**
 * this is where jokes begin!
 */

class JokePack_Tilt {

	// Build up the Tilt
	function __construct() {

		add_filter( 'jokepack_joke', array( $this, 'make_joke' ) );
		add_action( 'jokepack_tilt_init', array( $this, 'title_init' ) );

	}

	/**
	 * Make this joke to yourself or other people
	 * @param $jokes
	 * @return mixed
	 */
	function make_joke( $jokes ){
		$jokes['tilt'] = array(
			'title' => __('Tilt'),
			'description' => '',
		);
		return $jokes;
	}

	/**
	 * Make shit init
	 */
	function title_init() {
		// Add a stupid joke class to the mother fuckin body
		add_filter( 'body_class', array( $this, 'jokepack_title_body_class' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'jokepack_tilt_enqueue' ) );
	}

	/**
	 * Filter the Body Classes and add a jokepack tilt class
	 * @param $classes
	 * @return array
	 */
	function jokepack_title_body_class( $classes ) {

		$classes[] = 'jokepack-tilt';

		return $classes;
	}

	/**
	 * Jokepack Title Enqueue Scripts
	 */
	function jokepack_tilt_enqueue() {

		wp_enqueue_style( 'jokepack-tilt',
			JOKEPACK_URL . '/includes/tilt/jokepack-tilt.css',
			array(),
			NULL );

	}

}

new JokePack_Tilt();