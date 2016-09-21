<?php get_header(); ?>

	<main>

		<?php

		get_template_part('parts/headers');

		$labs_sites = get_sites( array( 'network_id' => get_current_network_id() ) );
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
