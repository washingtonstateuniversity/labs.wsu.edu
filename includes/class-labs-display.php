<?php

class Labs_Front_Display {
	public function __construct() {
	}

	public function get_sites() {
		if ( $sites = wp_cache_get( 'wsu_lab_sites' ) ) {
			return $sites;
		}
		$sites = wp_get_sites( array( 'network_id' => wsuwp_get_current_network()->id ) );

		foreach ( $sites as $k => $site ) {
			switch_to_blog( $site['blog_id'] );
			$sites[ $k ]['site_name'] = get_option( 'blogname' );
			$sites[ $k ]['site_url'] = home_url();
			restore_current_blog();
		}

		wp_cache_add( 'wsu_lab_sites', $sites, '', 3600 );

		return $sites;
	}
}
global $labs_front_display;
$labs_front_display = new Labs_Front_Display();

function labs_theme_get_sites() {
	global $labs_front_display;
	return $labs_front_display->get_sites();
}