<?php
/**
 * PToys back compat functionality
 */

/**
 * Prevent switching to PToys on old versions of WordPress.
 */
function ptoys_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'ptoys_upgrade_notice' );
}
add_action( 'after_switch_theme', 'ptoys_switch_theme' );


/**
 * Adds a message for unsuccessful theme switch.
 */
function ptoys_upgrade_notice() {
	$message = sprintf( __( 'PToys requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'ptoys' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}


/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.4.
 */
function ptoys_customize() {
	wp_die( sprintf( __( 'PToys requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'ptoys' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'ptoys_customize' );


/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.4.
 */
function ptoys_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'PToys requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'ptoys' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'ptoys_preview' );
