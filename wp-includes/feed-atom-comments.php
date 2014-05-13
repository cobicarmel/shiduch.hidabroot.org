<?
/**
 * Atom Feed Template for displaying Atom Comments feed.
 *
 * @package WordPress
 */

header('Content-Type: ' . feed_content_type('atom') . '; charset=' . get_option('blog_charset'), true);
echo '<?xml version="1.0" encoding="' . get_option('blog_charset') . '" ?' . '>';
?>
<feed
	xmlns="http://www.w3.org/2005/Atom"
	xml:lang="<? bloginfo_rss( 'language' ); ?>"
	xmlns:thr="http://purl.org/syndication/thread/1.0"
	<?
		/** This action is documented in wp-includes/feed-atom.php */
		do_action( 'atom_ns' ); 
		
		/**
		 * Fires inside the feed tag in the Atom comment feed.
		 *
		 * @since 2.8.0
		 */
		do_action( 'atom_comments_ns' );
	?>
>
	<title type="text"><?
		if ( is_singular() )
			printf( ent2ncr( __( 'Comments on %s' ) ), get_the_title_rss() );
		elseif ( is_search() )
			printf( ent2ncr( __( 'Comments for %1$s searching on %2$s' ) ), get_bloginfo_rss( 'name' ), get_search_query() );
		else
			printf( ent2ncr( __( 'Comments for %s' ) ), get_bloginfo_rss( 'name' ) . get_wp_title_rss() );
	?></title>
	<subtitle type="text"><? bloginfo_rss('description'); ?></subtitle>

	<updated><? echo mysql2date('Y-m-d\TH:i:s\Z', get_lastcommentmodified('GMT'), false); ?></updated>

<? if ( is_singular() ) { ?>
	<link rel="alternate" type="<? bloginfo_rss('html_type'); ?>" href="<? comments_link_feed(); ?>" />
	<link rel="self" type="application/atom+xml" href="<? echo esc_url( get_post_comments_feed_link('', 'atom') ); ?>" />
	<id><? echo esc_url( get_post_comments_feed_link('', 'atom') ); ?></id>
<? } elseif(is_search()) { ?>
	<link rel="alternate" type="<? bloginfo_rss('html_type'); ?>" href="<? echo home_url() . '?s=' . get_search_query(); ?>" />
	<link rel="self" type="application/atom+xml" href="<? echo get_search_comments_feed_link('', 'atom'); ?>" />
	<id><? echo get_search_comments_feed_link('', 'atom'); ?></id>
<? } else { ?>
	<link rel="alternate" type="<? bloginfo_rss('html_type'); ?>" href="<? bloginfo_rss('url'); ?>" />
	<link rel="self" type="application/atom+xml" href="<? bloginfo_rss('comments_atom_url'); ?>" />
	<id><? bloginfo_rss('comments_atom_url'); ?></id>
<? } ?>
<?
	/**
	 * Fires at the end of the Atom comment feed header.
	 *
	 * @since 2.8.0
	 */
	do_action( 'comments_atom_head' );
?>
<?
if ( have_comments() ) : while ( have_comments() ) : the_comment();
	$comment_post = $GLOBALS['post'] = get_post( $comment->comment_post_ID );
?>
	<entry>
		<title><?
			if ( !is_singular() ) {
				$title = get_the_title($comment_post->ID);
				/** This filter is documented in wp-includes/feed.php */
				$title = apply_filters( 'the_title_rss', $title );
				printf(ent2ncr(__('Comment on %1$s by %2$s')), $title, get_comment_author_rss());
			} else {
				printf(ent2ncr(__('By: %s')), get_comment_author_rss());
			}
		?></title>
		<link rel="alternate" href="<? comment_link(); ?>" type="<? bloginfo_rss('html_type'); ?>" />

		<author>
			<name><? comment_author_rss(); ?></name>
			<? if (get_comment_author_url()) echo '<uri>' . get_comment_author_url() . '</uri>'; ?>

		</author>

		<id><? comment_guid(); ?></id>
		<updated><? echo mysql2date('Y-m-d\TH:i:s\Z', get_comment_time('Y-m-d H:i:s', true, false), false); ?></updated>
		<published><? echo mysql2date('Y-m-d\TH:i:s\Z', get_comment_time('Y-m-d H:i:s', true, false), false); ?></published>
<? if ( post_password_required($comment_post) ) : ?>
		<content type="html" xml:base="<? comment_link(); ?>"><![CDATA[<? echo get_the_password_form(); ?>]]></content>
<? else : // post pass ?>
		<content type="html" xml:base="<? comment_link(); ?>"><![CDATA[<? comment_text(); ?>]]></content>
<? endif; // post pass
	// Return comment threading information (http://www.ietf.org/rfc/rfc4685.txt)
	if ( $comment->comment_parent == 0 ) : // This comment is top level ?>
		<thr:in-reply-to ref="<? the_guid(); ?>" href="<? the_permalink_rss() ?>" type="<? bloginfo_rss('html_type'); ?>" />
<? else : // This comment is in reply to another comment
	$parent_comment = get_comment($comment->comment_parent);
	// The rel attribute below and the id tag above should be GUIDs, but WP doesn't create them for comments (unlike posts). Either way, it's more important that they both use the same system
?>
		<thr:in-reply-to ref="<? comment_guid($parent_comment) ?>" href="<? echo get_comment_link($parent_comment) ?>" type="<? bloginfo_rss('html_type'); ?>" />
<? endif;
	/**
	 * Fires at the end of each Atom comment feed item.
	 *
	 * @since 2.2.0
	 *
	 * @param int $comment_id      ID of the current comment.
	 * @param int $comment_post_id ID of the post the current comment is connected to.
	 */
	do_action( 'comment_atom_entry', $comment->comment_ID, $comment_post->ID );
?>
	</entry>
<? endwhile; endif; ?>
</feed>
