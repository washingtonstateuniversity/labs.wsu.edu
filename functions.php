<?php
/**
 * Provide a callback to help sort a list of labs by their names.
 *
 * @param WP_Site $a First site to compare.
 * @param WP_Site $b Second site to compare.
 *
 * @return int
 */
function wsu_labs_sort_sites( $a, $b ) {
	return strcmp( $a->blogname, $b->blogname );
}

add_shortcode( 'labs_list', 'wsu_labs_display_site_list' );
/**
 * Displays an unordered list of sites on the network.
 */
function wsu_labs_display_site_list() {
	$labs_sites = get_sites( array( 'network_id' => get_current_network_id(), 'number' => 0 ) );

	usort( $labs_sites, 'wsu_labs_sort_sites' );
	ob_start();

	?>
	<ul>
		<?php
		foreach ( $labs_sites as $lab_site ) {
			// Skip the main network site.
			if ( 'labs.wp.wsu.edu' === $lab_site->domain ) {
				continue;
			}

			// Skip the main labs site.
			if ( 'labs.wsu.edu' === $lab_site->domain && '/' === $lab_site->path ) {
				continue;
			}

			// Sites without names don't display so well in this list.
			if ( empty( $lab_site->blogname ) ) {
				continue;
			}

			switch_to_blog( $lab_site->id );
			$page_count = wp_count_posts( 'page' );
			restore_current_blog();

			// Only display lab sites that have more than one post and/or more than 2 pages.
			if ( 1 >= $lab_site->post_count && 2 >= $page_count->publish ) {
				continue;
			}

			?><li><a href="<?php echo esc_url( $lab_site->home ); ?>"><?php echo esc_html( $lab_site->blogname ); ?></a></li><?php
		}
		?>
	</ul>
	<?php

	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}
