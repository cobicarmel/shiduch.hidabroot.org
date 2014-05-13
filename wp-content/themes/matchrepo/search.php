<?
/**
 * The template for displaying Search Results pages.
 *
 * @package matchrepo
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<? if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><? printf( __( 'Search Results for: %s', 'matchrepo' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<? /* Start the Loop */ ?>
			<? while ( have_posts() ) : the_post(); ?>

				<? get_template_part( 'content', 'search' ); ?>

			<? endwhile; ?>

			<? matchrepo_paging_nav(); ?>

		<? else : ?>

			<? get_template_part( 'content', 'none' ); ?>

		<? endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<? get_sidebar(); ?>
<? get_footer(); ?>
