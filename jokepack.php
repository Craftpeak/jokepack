<?php

/**
 * Plugin Name: Jokepack
 * Description: It's like jetpack, but funny.
 * Version: 45.0.7
 */

define( 'JOKEPACK_DIR', dirname(  __FILE__ ) );
define( 'JOKEPACK_URL', plugins_url( '', __FILE__ ) );

class JokePack {

	function __construct(){
		add_action( 'plugins_loaded', array( $this, 'jokepack_init' ) );

		if ( is_admin() ) {
			require_once( JOKEPACK_DIR . '/admin/customizer.php' );
		}

		$base = dirname(__FILE__) .'/includes/';
		$dir = new DirectoryIterator( $base );
		foreach ( $dir as $file ) {
			if ( !$file->isDot() && !$file->isDir() ) {
				include_once $base . $file->getFilename();
			}
		}
	}

	function jokepack_init(){
		do_action('jokepack_init');
	}

}

new JokePack();
