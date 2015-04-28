<?php

define( 'MAGNET_DIR', JOKEPACK_URL.'/includes/magnet' );

class JokePack_Magnet {

  function __construct() {
    // register the joke
    add_filter( 'jokepack_joke', array( $this, 'make_joke' ) );

    // execute the joke, if it is enabled
    add_action( 'jokepack_magnet_init', array( $this, 'init' ) );
  }

  function init() {
    add_filter( 'the_content', array( $this, 'wrap_content' ), 9999 );
    // add_filter( 'body_class', array( $this, 'magnet_body_class'), 9999 );
    add_action('wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
  }

  function make_joke( $jokes ) {
    $jokes['magnet'] = array(
      'title' => __('Magnet'),
      'description' => 'Turn the cursor into a magnet',
    );
    return $jokes;
  }

  function enqueue_scripts() {
    wp_enqueue_style( 'jokepack-magnet', MAGNET_DIR.'/magnet.css');
    wp_enqueue_script( 'jokepack-magnet', MAGNET_DIR.'/magnet.js', array('jquery'), '200.0.0', TRUE );
  }

  // function magnet_body_class( $classes ) {
  //   $classes[] = 'jokepack-magnet';
  //   return $classes;
  // }

  function wrap_content( $content ) {
    return '<div id="magnet">
      '. $content .'
    </div>
    <div id="stuckWords"></div>';
  }
}

new JokePack_Magnet();
