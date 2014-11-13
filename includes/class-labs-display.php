<?php

class Labs_Front_Display {
	public function __construct() {
	}

	public function get_sites() {
		return wp_get_sites( array( 'network_id' => wsuwp_get_current_network()->id ) );
	}
}
global $labs_front_display;
$labs_front_display = new Labs_Front_Display();

function labs_theme_get_sites() {
	global $labs_front_display;
	return $labs_front_display->get_sites();
}