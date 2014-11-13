<?php get_header(); ?>

	<main>

		<?php

		get_template_part('parts/headers');

		$labs_sites = labs_theme_get_sites();
		$hc = 0; // horizontal count
		$hc_class = array( 'one', 'two', 'three' );

		foreach ( $labs_sites as $lab_site ) {
			if ( 0 === $hc ) {
				?><section class="row thirds gutter marginalize-ends"><?php
			}

			?><div class="column <?php echo $hc_class[ $hc ]; ?>">
				<?php echo $lab_site['path']; ?>
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
				echo '<div class="column ' . $hc_class[ $hc ] . '"></div>';
				$hc++;
			}
			echo '</section>';
		}

		?>
	</main>

<?php get_footer();