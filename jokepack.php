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

/*
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
*/