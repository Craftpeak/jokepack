<?php
/**
 * Change the cursor to a rainbow cat... because why the hell not?
 */

define( 'RAINBOWCAT_DIR', JOKEPACK_URL.'/includes/rainbow_cat' );

class JokePack_RainbowCat{

  function __construct(){
    add_filter( 'wp_footer', array( $this, 'add_audio_html' ), 9999 );
    add_action( 'jokepack_init', array( $this, 'init') );
  }

  function init(){
    add_action( 'wp_enqueue_scripts', array( $this, 'load_rainbow_cat_style' ) );
  }

  function load_rainbow_cat_style() {
    wp_enqueue_style( 'rainbow-cat', RAINBOWCAT_DIR.'/rainbow_cat.css');
  }

  function add_audio_html() {
    echo '<audio autoplay>
      <source src="'. RAINBOWCAT_DIR . '/rainbow_cat.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>';
  }
}

new JokePack_RainbowCat();