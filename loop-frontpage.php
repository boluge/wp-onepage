<?php

	$args = array(
		'post_type' => 'page',
		'post_status' => 'publish',
		'orderby' => 'menu_order',
		'meta_key'   => 'onepage_new_page',
		'meta_query' => array(
			array(
				'key'     => 'onepage_new_page',
				'compare' => 'EXISTS',
			),
		),
	);
	$pages = new WP_Query($args);

	// Tableau qui va stocker les id des section qui utilisent l'effets parallax
	$parallaxId = array();

	while ( $pages->have_posts() ) : $pages->the_post();

		global $post;

		$page_type 	= get_post_meta( $post->ID, 'onepage_type', true );
		$no_title 	= get_post_meta( $post->ID, 'onepage_disable_title', true );
		$alt_title 	= get_post_meta( $post->ID, 'onepage_alt_title', true );
		$subtitle 	= get_post_meta( $post->ID, 'onepage_subtitle', true );
		$bg_color 	= get_post_meta( $post->ID, 'onepage_section_bg', true );
		if( empty( $bg_color) ){ $bg_color= '#f4f5f6'; }
		$bg_img	= get_post_meta( $post->ID, 'onepage_url_bg', true );
		//echo $page_type;
	?>

		<?php if ( $page_type == 'standard' ): ?>
			<section class="onepage_page" style="background-color: <?php echo $bg_color ?>;">
				<div class="container">
					<?php if($no_title != 'on'): ?>
						<?php if($alt_title): ?>
							<h2 class="onepage_title"><?php  echo $alt_title; ?></h2>
						<?php else: ?>
							<h2 class="onepage_title"><?php  the_title(); ?></h2>
						<?php endif; ?>

						<?php if($subtitle): ?>
							<h3 class="onepage_title"><?php  echo $subtitle; ?></h3>
						<?php endif; ?>
					<?php endif; ?>

					<?php the_content(); ?>
				</div>
			</section>
		<?php elseif ($page_type == 'parallax'): ?>
			<section class="parallax parallax-image onepage_page" style="background-color: <?php echo $bg_color ?>; background-image:url('<?php if(isset($bg_img)) echo $bg_img;?>');">
				<div class="container">
					<?php if($no_title != 'on'): ?>
						<?php if($alt_title): ?>
							<h2 class="onepage_title"><?php  echo $alt_title; ?></h2>
						<?php else: ?>
							<h2 class="onepage_title"><?php  the_title(); ?></h2>
						<?php endif; ?>

						<?php if($subtitle): ?>
							<h3 class="onepage_title"><?php  echo $subtitle; ?></h3>
						<?php endif; ?>
					<?php endif; ?>

					<?php the_content(); ?>
				</div>
			</section>
		<?php endif ?>


	<?php endwhile; ?>