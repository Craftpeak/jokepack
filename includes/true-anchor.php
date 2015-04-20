<?php
/**
 * True Anchor
 */

class JokePack_True_Anchor {

	// Build up the Tilt
	function __construct() {

		add_filter( 'jokepack_joke', array( $this, 'make_joke' ) );
		add_action( 'jokepack_true_anchor_init', array( $this, 'true_anchor_init' ) );

	}

	/**
	 * Make this joke to yourself or other people
	 * @param $jokes
	 * @return array
	 */
	function make_joke( $jokes ){
		$jokes['true_anchor'] = array(
			'title'       => __( 'True Anchor' ),
			'description' => '',
		);
		return $jokes;
	}

	/**
	 * Make that anchor drop! ...by adding a script
	 */
	function true_anchor_init() {
		// Add a stupid joke class to the mother fuckin body
		add_action( 'wp_enqueue_scripts', array( $this, 'jokepack_tilt_enqueue' ) );
	}

	/**
	 * Jokepack Title Enqueue Scripts
	 */
	function jokepack_tilt_enqueue() {

		wp_enqueue_script( 'jokepack-true-anchor', JOKEPACK_URL . '/includes/true-anchor/true-anchor.js', array( 'jquery' ), true );

	}

}

new JokePack_True_Anchor();