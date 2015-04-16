<?php
/**
 * Change the cursor to a rainbow cat... because why the hell not?
 */

define( 'RAINBOWCAT_DIR', JOKEPACK_URL.'/includes/rainbow_cat' );

class JokePack_RainbowCat{

  function __construct(){
    add_action( 'jokepack_init', array( $this, 'init') );
  }

  function init(){
    add_filter( 'wp_footer', array( $this, 'add_audio_html' ), 9999 );
    add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
  }

  function enqueue_scripts() {
    wp_enqueue_style( 'rainbow-cat', RAINBOWCAT_DIR.'/rainbow_cat.css');
    wp_enqueue_script( 'rainbow-cat', RAINBOWCAT_DIR.'/rainbow_cat.js', array('jquery'), '6.6.6', TRUE );
  }

  function add_audio_html() {
    echo '<audio autoplay>
      <source src="'. RAINBOWCAT_DIR . '/rainbow_cat.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>';
  }
}

new JokePack_RainbowCat();