<? get_header() ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<? while ( have_posts() ) : the_post(); ?>

				<? get_template_part( 'content', 'page' ); ?>

				<?
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<? endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<? get_sidebar() ?>
<? get_footer() ?>
