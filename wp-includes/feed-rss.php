<?
/**
 * RSS 0.92 Feed Template for displaying RSS 0.92 Posts feed.
 *
 * @package WordPress
 */

header('Content-Type: ' . feed_content_type('rss-http') . '; charset=' . get_option('blog_charset'), true);
$more = 1;

echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>'; ?>
<rss version="0.92">
<channel>
	<title><? bloginfo_rss('name'); wp_title_rss(); ?></title>
	<link><? bloginfo_rss('url') ?></link>
	<description><? bloginfo_rss('description') ?></description>
	<lastBuildDate><? echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
	<docs>http://backend.userland.com/rss092</docs>
	<language><? bloginfo_rss( 'language' ); ?></language>

	<?
	/**
	 * Fires at the end of the RSS Feed Header.
	 *
	 * @since 2.0.0
	 */
	do_action( 'rss_head' );
	?>

<? while (have_posts()) : the_post(); ?>
	<item>
		<title><? the_title_rss() ?></title>
		<description><![CDATA[<? the_excerpt_rss() ?>]]></description>
		<link><? the_permalink_rss() ?></link>
		<?
		/**
		 * Fires at the end of each RSS feed item.
		 *
		 * @since 2.0.0
		 */
		do_action( 'rss_item' );
		?>
	</item>
<? endwhile; ?>
</channel>
</rss>
