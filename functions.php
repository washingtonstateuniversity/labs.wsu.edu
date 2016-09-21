<?php

add_filter( 'spine_child_theme_version', 'wsu_labs_theme_script_version' );
/**
 * Filter the version number used to enqueue scripts.
 *
 * @return string
 */
function wsu_labs_theme_script_version() {
	return '0.0.3';
}

add_action( 'wp_enqueue_scripts', 'wsu_labs_theme_enqueue_scripts', 11 );
/**
 * Enqueue custom Javascript
 */
function wsu_labs_theme_enqueue_scripts() {
	wp_enqueue_script( 'wsu-labs-theme', get_stylesheet_directory_uri() . '/js/labs.js', array( 'jquery' ), spine_get_child_version(), true );
}
