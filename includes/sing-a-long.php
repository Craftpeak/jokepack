<?php

class JokePack_SingAlong{


	function __construct(){
		add_filter( 'jokepack_joke', array( $this, 'make_joke' ) );
	}

	function init(){
		add_filter( 'the_content', array( $this, 'wrap_content' ), 9999 );
		add_action('wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	function make_joke( $jokes ){
		$jokes['sing_a_long'] = array(
			'title' => __('Sing A Long'),
			'description' => 'la lala lala lal aa badda bum',
		);
		return $jokes;
	}

	function enqueue_scripts(){
		wp_enqueue_script('jokepack-sing-a-long', JOKEPACK_URL . '/includes/sing-a-long/sing-a-long.js', array('jquery') );
	}

	function wrap_content( $content ){
		return "<div id='sing-a-long'>".$content."</div>";
	}
}

new JokePack_SingAlong();
