<?php

/**
 * Plugin Name: Jokepack
 * Description: It's like jetpack, but funny.
 * Version: 45.0.7
 */

class JokePack {

	function __construct(){
		add_action( 'plugins_loaded', array( $this, 'jokepack_init' ) );

		$base = dirname(__FILE__) .'/includes/';
		$dir = new DirectoryIterator( $base );
		foreach ( $dir as $file ) {
			if ( !$file->isDot() ) {
				include_once $base . $file->getFilename();
			}
		}
	}

	function jokepack_init(){
		do_action('jokepack_init');
	}
}

new JokePack();
