<?php
/**
 * Provide a callback to help sort a list of labs by their names.
 *
 * @param WP_Site $a First site to compare.
 * @param WP_Site $b Second site to compare.
 *
 * @return int
 */
function sort_labs_sites( $a, $b ) {
	return strcmp( $a->blogname, $b->blogname );
}

get_header();

?>

	<main>

		<?php

		get_template_part('parts/headers');

		?><section class="row side-right gutter padded-ends">
			<div class="column one">
		<?php
		if ( have_posts() ) : the_post(); the_content(); endif;
		?>
			</div>
			<div class="column two"></div>
		</section>
		<?php
		$labs_sites = get_sites( array( 'network_id' => get_current_network_id(), 'number' => 0 ) );

		usort( $labs_sites, 'sort_labs_sites' );
		?>
		<section class="row side-right gutter padded-ends">
			<div class="column one labs-list">
				<h3>Labs at Washington State University</h3>
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

			?><li><a href="<?php echo esc_url( $lab_site->home ); ?>"><?php echo esc_html( $lab_site->blogname ); ?></a></li><?php
		}
		?>
				</ul>
			</div>
			<div class="column two">

			</div>
		</section>
	</main>

<?php get_footer();
