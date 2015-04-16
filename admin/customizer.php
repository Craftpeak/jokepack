<?php
/**
 * Jokepack Customizer
 */

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
function jokepack_customizer_settings( $wp_customize ) {


	/**
	 * Jokepack Panel Registration
	 */
	$wp_customize->add_panel( 
		'jokepack_settings', 
		array(
		    'priority'    => 1,
		    'title'       => __( 'Jokes', 'jokepack' ),
		    'description' => __( 'Select some weird jokes', 'jokepack' ),
		) 
	);

    $wp_customize->add_section(
        'select_jokes',
        array(
            'title' 	  => __( 'Select Jokes', 'jokepack' ),
            'description' => __( 'Check a box, and watch ...', 'jokepack' ),
            'panel' 	  => 'jokepack_settings',
            'priority'    => 1
        )
    );

	// contact title
	$wp_customize->add_setting(
		'jokes',
		array(
			'sanitize_callback' => 'jokepack_sanitize_text',
			'transport' 		=> 'postMessage',
		)
	);
	$wp_customize->add_control(
		'jokes',
		array(
			'label' 	=> __( 'Select Jokes', 'jokepack' ),
			'section' 	=> 'select_jokes',
			'type' 		=> 'checkbox',
		)
	);

}
add_action( 'customize_register', 'jokepack_customizer_settings' );

/**
 * Sanitize Text Fields
 */
function jokepack_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Sanitize Email Address
 */
function jokepack_sanitize_email( $input ) {
    return wp_kses_post( sanitize_email( $input ) );
}

/**
 * Sanitize URL
 */
function jokepack_sanitize_url( $input ) {
    return wp_kses_post( esc_url_raw( $input ) );
}

/**
 * Sanitize Integers
 */
function jokepack_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}
