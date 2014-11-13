<?php get_header(); ?>

	<main>

		<?php

		get_template_part('parts/headers');

		?>
		<section class="single wide gutter padded-ends">
			<div class="column one">
				<h1>Labs at Washington State University</h1>
			</div>
		</section>
		<?php
		$labs_sites = labs_theme_get_sites();
		$hc = 0; // horizontal count
		$hc_class = array( 'one', 'two', 'three' );
		$bg_class = array( 'palette-a', 'palette-b', 'palette-c', 'palette-d' );

		foreach ( $labs_sites as $lab_site ) {
			if ( 0 === $hc ) {
				?><section class="row thirds gutter"><?php
			}

			$p = rand( 0, 3 );
			?><div class="column <?php echo $hc_class[ $hc ]; ?> block-lab-site <?php echo $bg_class[ $p ]; ?>">
				<a href="<?php echo esc_url( $lab_site['site_url'] ); ?>">
					<div class="column-internal">
					<h3><?php echo $lab_site['site_name']; ?></h3>
					</div>
				</a>
			</div><?php

			if ( 2 === $hc ) {
				$hc = 0;
				echo '</section>';
			} else {
				$hc++;
			}
		}

		// Close off remaining columns
		if ( 0 !== $hc ) {
			while ( $hc <= 2 ) {
				echo '<div class="column ' . $hc_class[ $hc ] . ' block-lab-site palette-0"></div>';
				$hc++;
			}
			echo '</section>';
		}

		?>
	</main>

<?php get_footer();