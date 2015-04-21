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

		// todo - move to joke
		add_action( 'wp_head', array( $this, 'jokepack_ascii_art' ) );
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
	 * Simple automatic way to load all jokes provided by Jokepack core
	 */
	function load_core_jokes(){
		// load the jokes
		$base = dirname(__FILE__) .'/includes/';
		$dir = new DirectoryIterator( $base );
		foreach ( $dir as $file ) {
			if ( !$file->isDot() && !$file->isDir() )
			{
				include_once $base . $file->getFilename();
			}
		}
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

	function jokepack_ascii_art() {
		$art = "
<!--


          JJJJJJJJJJJ               kkkkkkkk                                                                                     kkkkkkkk
          J:::::::::J               k::::::k                                                                                     k::::::k
          J:::::::::J               k::::::k                                                                                     k::::::k
          JJ:::::::JJ               k::::::k                                                                                     k::::::k
            J:::::J   ooooooooooo    k:::::k    kkkkkkk eeeeeeeeeeee    ppppp   ppppppppp     aaaaaaaaaaaaa      cccccccccccccccc k:::::k    kkkkkkk
            J:::::J oo:::::::::::oo  k:::::k   k:::::kee::::::::::::ee  p::::ppp:::::::::p    a::::::::::::a   cc:::::::::::::::c k:::::k   k:::::k
            J:::::Jo:::::::::::::::o k:::::k  k:::::ke::::::eeeee:::::eep:::::::::::::::::p   aaaaaaaaa:::::a c:::::::::::::::::c k:::::k  k:::::k
            J:::::jo:::::ooooo:::::o k:::::k k:::::ke::::::e     e:::::epp::::::ppppp::::::p           a::::ac:::::::cccccc:::::c k:::::k k:::::k
            J:::::Jo::::o     o::::o k::::::k:::::k e:::::::eeeee::::::e p:::::p     p:::::p    aaaaaaa:::::ac::::::c     ccccccc k::::::k:::::k
JJJJJJJ     J:::::Jo::::o     o::::o k:::::::::::k  e:::::::::::::::::e  p:::::p     p:::::p  aa::::::::::::ac:::::c              k:::::::::::k
J:::::J     J:::::Jo::::o     o::::o k:::::::::::k  e::::::eeeeeeeeeee   p:::::p     p:::::p a::::aaaa::::::ac:::::c              k:::::::::::k
J::::::J   J::::::Jo::::o     o::::o k::::::k:::::k e:::::::e            p:::::p    p::::::pa::::a    a:::::ac::::::c     ccccccc k::::::k:::::k
J:::::::JJJ:::::::Jo:::::ooooo:::::ok::::::k k:::::ke::::::::e           p:::::ppppp:::::::pa::::a    a:::::ac:::::::cccccc:::::ck::::::k k:::::k
 JJ:::::::::::::JJ o:::::::::::::::ok::::::k  k:::::ke::::::::eeeeeeee   p::::::::::::::::p a:::::aaaa::::::a c:::::::::::::::::ck::::::k  k:::::k
   JJ:::::::::JJ    oo:::::::::::oo k::::::k   k:::::kee:::::::::::::e   p::::::::::::::pp   a::::::::::aa:::a cc:::::::::::::::ck::::::k   k:::::k
     JJJJJJJJJ        ooooooooooo   kkkkkkkk    kkkkkkk eeeeeeeeeeeeee   p::::::pppppppp      aaaaaaaaaa  aaaa   cccccccccccccccckkkkkkkk    kkkkkkk
                                                                         p:::::p
                                                                         p:::::p
                                                                        p:::::::p
                                                                        p:::::::p
                                                                        p:::::::p
                                                                        ppppppppp


                                                          (you've been hacked ... just kidding)


		-->";

		// echo the art
		echo $art;
	}
}

new JokePack();