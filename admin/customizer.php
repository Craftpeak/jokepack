<?php
/**
 * Jokepack Customizer
 */

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
function jokepack_customizer_settings( $wp_customize ) {
	
	// register the jokes section
	$wp_customize->add_section(
		'select_jokes',
		array(
			'title'       => __( 'Select Jokes', 'jokepack' ),
			'description' => __( 'Check a box, and watch ...', 'jokepack' ),
			'priority'    => 1
		)
	);

	// The infamous jokepack filter
	$jokes = apply_filters( 'jokepack_joke', array() );

	foreach ( $jokes as $slug => $joke ) {

		// add customizer setting
		$wp_customize->add_setting(
			'jokepack_settings['.$slug.'][enabled]',
			array(
				'type'              => 'option',
				'sanitize_callback' => 'jokepack_sanitize_checkbox',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'jokepack_settings['.$slug.'][enabled]',
			array(
				'label'   => $joke['title'],
				'section' => 'select_jokes',
				'type'    => 'checkbox',
			)
		);

	} // end each joke customizer checkbox

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
    if ( is_numeric( $input ) ) {
        return intval( $input );
    }
}

/**
 * Sanitize Checkboxes
 */
function jokepack_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}