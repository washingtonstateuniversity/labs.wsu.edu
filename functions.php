<?php

/**
 * Provide a cache breaking script version for the theme.
 *
 * @return string Current script version
 */
function wsu_labs_theme_script_version() {
	return spine_get_script_version() . '0.0.1';
}

add_action( 'wp_enqueue_scripts', 'wsu_labs_theme_enqueue_scripts', 11 );
/**
 * Enqueue custom Javascript
 */
function wsu_labs_theme_enqueue_scripts() {
	wp_enqueue_script( 'wsu-labs-theme', get_stylesheet_directory_uri() . '/js/labs.js', array( 'jquery' ), spine_get_script_version(), true );
}
