<?php get_header(); ?>

	<main>

		<?php

		get_template_part('parts/headers');

		?>
		<section class="single wide gutter block-lab-site labs-title-section palette-0">
			<div class="column one">
				<h1>Labs at Washington State University</h1>
			</div>
		</section>
		<?php
		$labs_sites = get_sites( array( 'network_id' => get_current_network_id() ) );
		$hc = 0; // horizontal count
		$hc_class = array( 'one', 'two', 'three' );
		$bg_class = array( 'palette-a', 'palette-b', 'palette-c', 'palette-d', 'palette-e', 'palette-f' );
		$max_rand = 5;

		foreach ( $labs_sites as $lab_site ) {
			if ( 0 === $hc ) {
				?><section class="row thirds gutter"><?php
			}

			$p = rand( 0, $max_rand );

			?><div class="column <?php echo $hc_class[ $hc ]; ?> block-lab-site <?php echo $bg_class[ $p ]; ?>">
				<a href="<?php echo esc_url( $lab_site->home ); ?>">
					<div class="column-internal">
					<h3><?php echo $lab_site->blogname; ?></h3>
					</div>
				</a>
			</div><?php

			if ( 2 === $hc ) {
				$hc = 0;
				echo '</section>';
			} else {
				$hc++;
			}

			// Only use grey once. ;)
			if ( 5 === $p ) {
				unset( $bg_class[ 5 ] );
				$max_rand = 4;
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
