<?
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package matchrepo
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<? if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'matchrepo' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'matchrepo' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'matchrepo' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'matchrepo' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'matchrepo' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'matchrepo' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'matchrepo' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'matchrepo');

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'matchrepo');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'matchrepo' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'matchrepo' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'matchrepo' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'matchrepo' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'matchrepo' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'matchrepo' );

						else :
							_e( 'Archives', 'matchrepo' );

						endif;
					?>
				</h1>
				<?
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .page-header -->

			<? /* Start the Loop */ ?>
			<? while ( have_posts() ) : the_post(); ?>

				<?
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<? endwhile; ?>

			<? matchrepo_paging_nav(); ?>

		<? else : ?>

			<? get_template_part( 'content', 'none' ); ?>

		<? endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<? get_sidebar(); ?>
<? get_footer(); ?>
