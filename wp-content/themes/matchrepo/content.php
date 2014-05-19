<?
/**
 * @package Matchrepo
 */
?>

<article id="post-<? the_ID(); ?>" <? post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<? the_permalink(); ?>" rel="bookmark"><? the_title(); ?></a></h1>

		<? if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<? Matchrepo_posted_on(); ?>
		</div><!-- .entry-meta -->
		<? endif; ?>
	</header><!-- .entry-header -->

	<? if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<? the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<? else : ?>
	<div class="entry-content">
		<? the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', THEME_NAME ) ); ?>
		<?
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', THEME_NAME ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<? endif; ?>

	<footer class="entry-footer">
		<? if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', THEME_NAME ) );
				if ( $categories_list && Matchrepo_categorized_blog() ) :
			?>
			<span class="cat-links">
				<? printf( __( 'Posted in %1$s', THEME_NAME ), $categories_list ); ?>
			</span>
			<? endif; // End if categories ?>

			<?
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', THEME_NAME ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<? printf( __( 'Tagged %1$s', THEME_NAME ), $tags_list ); ?>
			</span>
			<? endif; // End if $tags_list ?>
		<? endif; // End if 'post' == get_post_type() ?>

		<? if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><? comments_popup_link( __( 'Leave a comment', THEME_NAME ), __( '1 Comment', THEME_NAME ), __( '% Comments', THEME_NAME ) ); ?></span>
		<? endif; ?>

		<? edit_post_link( __( 'Edit', THEME_NAME ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
