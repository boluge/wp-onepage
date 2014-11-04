<?php get_header(); ?>
<div class="container">
	<?php get_sidebar(); ?>

		<main class="<?php bootblank_main_class(); ?>" role="main">
			<!-- section -->
			<section itemscope itemtype="http://schema.org/Blog">
				<h2>Front page</h2>
				<h1><?php _e( 'Latest Posts', 'bootblank' ); ?></h1>

				<?php get_template_part('loop-frontpage'); ?>

				<?php get_template_part('pagination'); ?>

			</section>
			<!-- /section -->
		</main>

	<?php get_sidebar('right'); ?>
</div>

<?php get_footer(); ?>
