<?
/**
 * The template used for displaying page content in page.php
 *
 * @package matchrepo
 */
?>

<article id="post-<? the_ID(); ?>" <? post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><? the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<? the_content(); ?>
		<?
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'matchrepo' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<? edit_post_link( __( 'Edit', 'matchrepo' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
