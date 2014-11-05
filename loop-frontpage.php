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

	$numPage= 0;

	$pages = new WP_Query($args);

	// Tableau qui va stocker les id des section qui utilisent l'effets parallax
	$parallaxId = array();

	while ( $pages->have_posts() ) : $pages->the_post();

		global $post;

		$page_type 		= get_post_meta( $post->ID, 'onepage_type', true );
		$scroll_speed 		= get_post_meta( $post->ID, 'onepage_speed', true );
		$img_parallax 		= get_post_meta( $post->ID, 'onepage_fullscreen', true );
		$no_title 		= get_post_meta( $post->ID, 'onepage_disable_title', true );
		$alt_title 		= get_post_meta( $post->ID, 'onepage_alt_title', true );
		$subtitle 		= get_post_meta( $post->ID, 'onepage_subtitle', true );
		$bg_color 		= get_post_meta( $post->ID, 'onepage_section_bg', true );
		$bg_img		= get_post_meta( $post->ID, 'onepage_url_bg', true );
		$img_standard		= get_post_meta( $post->ID, 'onepage_img_standard', true );
		$nav_page		= get_post_meta( $post->ID, 'onepage_navigation_page', true );

		var_dump($nav_page);


		if( empty( $bg_color) ){ $bg_color= '#f4f5f6'; }
	?>

		<?php if ( $page_type == 'standard' ): ?>
			<?php	$numPage++;  ?>

				<?php if (empty($bg_img)): ?>
					<article id="<?php echo $post->post_name; ?>" class="onepage_page onepage_<?php echo $post->post_name ?>" style="background-color: <?php echo $bg_color ?>;">
				<?php else: ?>
					<article id="<?php echo $post->post_name; ?>" class="onepage_img onepage_page onepage_<?php echo $img_standard; ?> onepage_<?php echo $post->post_name ?>" style="background-color: <?php echo $bg_color ?>; background-image:url('<?php if(isset($bg_img)) echo $bg_img;?>');">
				<?php endif; ?>


				<div class="container">
					<?php if($no_title != 'on'): ?>

						<?php if ($numPage == 1) : ?>
							<?php if($alt_title): ?>
								<h1 class="onepage_title"><?php  echo $alt_title; ?></h2>
							<?php else: ?>
								<h1 class="onepage_title"><?php  the_title(); ?></h2>
							<?php endif; ?>
						<?php else: ?>
							<?php if($alt_title): ?>
								<h2 class="onepage_title"><?php  echo $alt_title; ?></h2>
							<?php else: ?>
								<h2 class="onepage_title"><?php  the_title(); ?></h2>
							<?php endif; ?>
						<?php endif; ?>

						<?php if($subtitle): ?>
							<h3 class="onepage_title"><?php  echo $subtitle; ?></h3>
						<?php endif; ?>
					<?php endif; ?>

					<?php the_content(); ?>
				</div>
			</article>
		<?php elseif ($page_type == 'parallax'): ?>
			<?php array_push($parallaxId,  '$("#'.$post->post_name.'").parallax("50%", '. $scroll_speed .');'); ?>
			<?php
				list($width, $height, $type, $attr) = getimagesize($bg_img);
			?>
			<article data-img-width="<?php echo $width; ?>" data-img-height="<?php echo $height; ?>" id="<?php echo $post->post_name; ?>" class="parallax onepage_page <?php echo $img_parallax; ?> onepage_<?php echo $post->post_name ?>" style="background-color: <?php echo $bg_color ?>; background-image:url('<?php if(isset($bg_img)) echo $bg_img;?>');">
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
			</article>
		<?php endif ?>
	<?php endwhile; ?>
	<?php wp_reset_query(); ?>

	<?php
		if( !empty( $parallaxId ) && is_array($parallaxId) ) {
	 		$output ='';
	 		$output .='<script type="text/javascript">';
	 		$output .='jQuery(document).ready(function($) {';
			$output .='$(window).load(function(){';
			$output .= "$('.nav ul').localScroll({
           target:'body'
        });";

			foreach( $parallaxId as $parallax ) {
				$output .= $parallax;
			}

			$output .='})';
			$output .='})';
			$output .='</script>';
			echo $output;
		}
	?>