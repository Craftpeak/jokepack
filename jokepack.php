<?php

/**
 * Plugin Name: Jokepack
 * Description: It's like jetpack, but funny.
 * Version: 45.0.7
 */

class JokePack {

	function __construct(){
		add_action('plugins_loaded', array( $this, 'jokepack_init' ) );
	}

	function jokepack_init(){
		do_action('jokepack_init');
	}
}

new JokePack();
