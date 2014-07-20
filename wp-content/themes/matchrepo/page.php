<?

wp_register_style('page', get_stylesheet_directory_uri() . '/css/page.css');

wp_enqueue_style('page');

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<? while ( have_posts() ) : the_post(); ?>

				<? get_template_part( 'content', 'page' ); ?>

			<? endwhile ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<? get_sidebar(); ?>
<? get_footer(); ?>