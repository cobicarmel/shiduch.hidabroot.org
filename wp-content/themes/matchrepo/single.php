<?
wp_register_style('single', get_stylesheet_directory_uri() . '/css/single.css');
wp_enqueue_style('single');

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<? while ( have_posts() ) : the_post(); ?>

			<? get_template_part( 'content', 'single' ); ?>

			<? Matchrepo_post_nav(); ?>

			<?
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<? endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<? get_sidebar(); ?>
<? get_footer(); ?>