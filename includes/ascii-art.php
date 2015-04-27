<?php

class Jokepack_Ascii_Art {

	function __construct(){
		// register the joke
		add_filter( 'jokepack_joke', array( $this, 'make_joke' ) );

		// execute the joke, if it is enabled
		add_action( 'jokepack_ascii_art_init', array( $this, 'init' ) );
	}

	/**
	 * Register the joke
	 * @param $jokes
	 */
	function make_joke( $jokes ){
		$jokes['ascii_art'] = array(
			'title' => __('Ascii Art'),
			'description' => 'Add ascii art to the site head',
		);
		return $jokes;
	}

	/**
	 * Initialize the joke
	 */
	function init(){
		add_action( 'wp_head', array( $this, 'do_ascii_art' ) );
	}

	/**
	 * Output the ascii art
	 */
	function do_ascii_art() {
		$art = <<<EOF
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
-->
EOF;

		// echo the art
		echo $art;
	}
}

new Jokepack_Ascii_Art();