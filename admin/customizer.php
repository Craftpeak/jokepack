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

	// Tilt
	$wp_customize->add_setting(
		'jokepack_tilt',
		array(
			'sanitize_callback' => 'jokepack_sanitize_checkbox',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'jokepack_tilt',
		array(
			'label'   => __( 'Tilt', 'jokepack' ),
			'section' => 'select_jokes',
			'type'    => 'checkbox',
		)
	);

	// Cursor Cat
	$wp_customize->add_setting(
		'jokepack_cat',
		array(
			'sanitize_callback' => 'jokepack_sanitize_checkbox',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'jokepack_cat',
		array(
			'label'   => __( 'Cursor Cat', 'jokepack' ),
			'section' => 'select_jokes',
			'type'    => 'checkbox',
		)
	);

	// Sing a long
	$wp_customize->add_setting(
		'jokepack_sing',
		array(
			'sanitize_callback' => 'jokepack_sanitize_checkbox',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'jokepack_sing',
		array(
			'label'   => __( 'Sing - a - long', 'jokepack' ),
			'section' => 'select_jokes',
			'type'    => 'checkbox',
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