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

	while ( $pages->have_posts() ) : $pages->the_post();

		global $post;

		$page_type 	= get_post_meta( $post->ID, 'onepage_type', true );
		$no_title 	= get_post_meta( $post->ID, 'onepage_disable_title', true );
		$alt_title 	= get_post_meta( $post->ID, 'onepage_alt_title', true );
		$subtitle 	= get_post_meta( $post->ID, 'onepage_subtitle', true );
		$bg_color 	= get_post_meta( $post->ID, 'onepage_section_bg', true );
		$bg_img	= get_post_meta( $post->ID, 'onepage_url_bg', true ); ?>


		<section class="onepage_page" style="background-color: <?php echo $bg_color ?>;">
			<div class="container">
				<h2 class="onepage_title"><?php  the_title(); ?></h2>

				<?php the_content(); ?>
			</div>
		</section>

	<?php endwhile; ?>