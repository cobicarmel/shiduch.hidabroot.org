<?
wp_register_style('single', get_stylesheet_directory_uri() . '/css/single.css');
wp_enqueue_style('single');

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<? while ( have_posts() ) : the_post(); ?>

			<? get_template_part( 'content', 'single' ); ?>

		<? endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<? get_sidebar(); ?>
<? get_footer(); ?>