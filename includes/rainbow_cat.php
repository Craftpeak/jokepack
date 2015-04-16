<?php
/**
 * Change the cursor to a rainbow cat... because why the hell not?
 */

class JokePack_RainbowCat{

  function __construct(){
    add_action('jokepack_init', array( $this, 'init') );
  }

  function init(){
    add_action( 'wp_enqueue_scripts', array( $this, 'load_rainbow_cat_style' ) );
  }

  function load_rainbow_cat_style() {
    wp_enqueue_style( 'rainbow-cat', JOKEPACK_URL.'/includes/rainbow_cat/rainbow_cat.css');
  }
}

new JokePack_RainbowCat();