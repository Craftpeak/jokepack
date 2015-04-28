<?php

/**
 * Plugin Name: Jokepack
 * Plugin URI:
 * Description: It's like jetpack, but funny.
 * Version: 45.0.7
 * Author:
 * Author URI:
 * Requires at least: 4.0
 * Tested up to: 4.2
 */

define( 'JOKEPACK_DIR', dirname(  __FILE__ ) );
define( 'JOKEPACK_URL', plugins_url( '', __FILE__ ) );

class JokePack {

	private $default_settings = array();
	private $settings = array();

	/**
	 * Initialize our plugin, and hook it into WordPress
	 */
	function __construct() {
		add_action( 'plugins_loaded', array( $this, 'jokepack_init' ) );
		add_action( 'customize_register', array( $this, 'customizer_settings' ) );

		$this->load_core_jokes();

	}

	/**
	 * Get jokepack settings
	 *
	 * @return array
	 */
	function get_settings(){
		// if we've done this before, no need to do it again
		if ( ! empty( $this->settings ) ){
			return $this->settings;
		}

		// get the saved settings
		$option_value = get_option('jokepack_settings', array());

		// merge them with default settings
		$this->settings = wp_parse_args( $option_value, $this->default_settings );

		return $this->settings;
	}

	/**
	 * Load all jokes provided by Jokepack core
	 */
	function load_core_jokes(){
		include_once JOKEPACK_DIR . '/includes/ascii-art.php';
		include_once JOKEPACK_DIR . '/includes/magnet.php';
		include_once JOKEPACK_DIR . '/includes/rainbow_cat.php';
		include_once JOKEPACK_DIR . '/includes/sing-a-long.php';
		include_once JOKEPACK_DIR . '/includes/tilt.php';
		include_once JOKEPACK_DIR . '/includes/true-anchor.php';
	}

	/**
	 * Initialize each enabled joke
	 */
	function jokepack_init() {
		$jokepack_settings = $this->get_settings();

		// by default, jokes are disabled. therefore we use the settings
		// array to find jokes that should be executed
		foreach ($jokepack_settings as $slug => $joke ){
			if ( $joke['enabled'] ) {

				// each joke has its own custom init action, allowing even
				// further extensibility
				do_action( "jokepack_{$slug}_init" );
			}
		}
	}

	/**
	 * Use the customizer as a pseudo "settings" page this is where we
	 *  'apply_filters' to gather the jokes
	 *
	 * @param $wp_customize
	 */
	function customizer_settings( $wp_customize ) {

		// The infamous jokepack filter
		$jokes = apply_filters( 'jokepack_joke', array() );

		// register the jokes section
		$wp_customize->add_section(
			'select_jokes',
			array(
				'title'       => __( 'Select Jokes', 'jokepack' ),
				'description' => __( 'Check a box, and watch ...', 'jokepack' ),
				'priority'    => 1
			)
		);

		// loop through all registered jokes, and create a checkbox for enabling
		foreach ( $jokes as $slug => $joke ) {

			// add customizer setting
			$wp_customize->add_setting(
				'jokepack_settings['.$slug.'][enabled]',
				array(
					'type'              => 'option',
					'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				'jokepack_settings['.$slug.'][enabled]',
				array(
					'label'   => $joke['title'],
					'section' => 'select_jokes',
					'type'    => 'checkbox',
				)
			);

		} // end each joke customizer checkbox
	}

	/**
	 * Sanitize Checkboxes
	 *
	 * @param $input
	 * @return mixed
	 */
	function sanitize_checkbox( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}
}

new JokePack();