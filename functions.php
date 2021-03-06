<?php

namespace WSU\Theme\Labs;

add_shortcode( 'labs_list', 'WSU\Theme\Labs\display_labs_list_shortcode' );

/**
 * Provide a callback to help sort a list of labs by their names.
 *
 * @since 0.0.6
 *
 * @param \WP_Site $a First site to compare.
 * @param \WP_Site $b Second site to compare.
 *
 * @return int
 */
function sort_sites( $a, $b ) {
	return strcmp( $a->blogname, $b->blogname );
}

/**
 * Displays an unordered list of sites on the network.
 *
 * @since 0.0.6
 */
function display_labs_list_shortcode() {
	$content = wp_cache_get( 'wsu:labs:list' );
	if ( $content ) {
		return $content;
	}

	$labs_sites = get_sites( array(
		'network_id' => 0,
		'number' => 0,
		'domain__in' => array(
			'labs.wsu.edu',
			'genomics.wsu.edu',
			'kessler.wsu.edu',
			'ssl.wsu.edu',
			'lcme.wsu.edu',
			'skinner.wsu.edu',
			'genomicnursing.wsu.edu',
			'hydrogen.wsu.edu',
		),
	) );

	usort( $labs_sites, 'WSU\Theme\Labs\sort_sites' );
	ob_start();

	?>
	<ul>
		<?php
		foreach ( $labs_sites as $lab_site ) {
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

			// Skip sites that do not have more than one post and/or more than 2 pages.
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

	// Cache list for 30 minutes.
	wp_cache_set( 'wsu:labs:list', $content, '', 1800 );

	return $content;
}
