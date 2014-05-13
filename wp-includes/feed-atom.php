<?
/**
 * Atom Feed Template for displaying Atom Posts feed.
 *
 * @package WordPress
 */

header('Content-Type: ' . feed_content_type('atom') . '; charset=' . get_option('blog_charset'), true);
$more = 1;

echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>'; ?>
<feed
  xmlns="http://www.w3.org/2005/Atom"
  xmlns:thr="http://purl.org/syndication/thread/1.0"
  xml:lang="<? bloginfo_rss( 'language' ); ?>"
  xml:base="<? bloginfo_rss('url') ?>/wp-atom.php"
  <?
  /**
   * Fires at end of the Atom feed root to add namespaces.
   *
   * @since 2.0.0
   */
  do_action( 'atom_ns' );
  ?>
 >
	<title type="text"><? bloginfo_rss('name'); wp_title_rss(); ?></title>
	<subtitle type="text"><? bloginfo_rss("description") ?></subtitle>

	<updated><? echo mysql2date('Y-m-d\TH:i:s\Z', get_lastpostmodified('GMT'), false); ?></updated>

	<link rel="alternate" type="<? bloginfo_rss('html_type'); ?>" href="<? bloginfo_rss('url') ?>" />
	<id><? bloginfo('atom_url'); ?></id>
	<link rel="self" type="application/atom+xml" href="<? self_link(); ?>" />

	<?
	/**
	 * Fires just before the first Atom feed entry.
	 *
	 * @since 2.0.0
	 */
	do_action( 'atom_head' );

	while ( have_posts() ) : the_post();
	?>
	<entry>
		<author>
			<name><? the_author() ?></name>
			<? $author_url = get_the_author_meta('url'); if ( !empty($author_url) ) : ?>
			<uri><? the_author_meta('url')?></uri>
			<? endif;

			/**
			 * Fires at the end of each Atom feed author entry.
			 *
			 * @since 3.2.0
			 */
			do_action( 'atom_author' );
		?>
		</author>
		<title type="<? html_type_rss(); ?>"><![CDATA[<? the_title_rss() ?>]]></title>
		<link rel="alternate" type="<? bloginfo_rss('html_type'); ?>" href="<? the_permalink_rss() ?>" />
		<id><? the_guid() ; ?></id>
		<updated><? echo get_post_modified_time('Y-m-d\TH:i:s\Z', true); ?></updated>
		<published><? echo get_post_time('Y-m-d\TH:i:s\Z', true); ?></published>
		<? the_category_rss('atom') ?>
		<summary type="<? html_type_rss(); ?>"><![CDATA[<? the_excerpt_rss(); ?>]]></summary>
<? if ( !get_option('rss_use_excerpt') ) : ?>
		<content type="<? html_type_rss(); ?>" xml:base="<? the_permalink_rss() ?>"><![CDATA[<? the_content_feed('atom') ?>]]></content>
<? endif; ?>
	<? atom_enclosure();
	/**
	 * Fires at the end of each Atom feed item.
	 *
	 * @since 2.0.0
	 */
	do_action( 'atom_entry' );
		?>
		<link rel="replies" type="<? bloginfo_rss('html_type'); ?>" href="<? the_permalink_rss() ?>#comments" thr:count="<? echo get_comments_number()?>"/>
		<link rel="replies" type="application/atom+xml" href="<? echo esc_url( get_post_comments_feed_link(0, 'atom') ); ?>" thr:count="<? echo get_comments_number()?>"/>
		<thr:total><? echo get_comments_number()?></thr:total>
	</entry>
	<? endwhile ; ?>
</feed>
