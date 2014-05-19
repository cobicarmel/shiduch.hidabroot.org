<?
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Matchrepo
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><? _e( 'Nothing Found', THEME_NAME ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<? if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><? printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', THEME_NAME ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<? elseif ( is_search() ) : ?>

			<p><? _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', THEME_NAME ); ?></p>
			<? get_search_form(); ?>

		<? else : ?>

			<p><? _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', THEME_NAME ); ?></p>
			<? get_search_form(); ?>

		<? endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
