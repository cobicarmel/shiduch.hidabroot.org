<?
/**
 * RSS2 Feed Template for displaying RSS2 Posts feed.
 *
 * @package WordPress
 */

header('Content-Type: ' . feed_content_type('rss-http') . '; charset=' . get_option('blog_charset'), true);
$more = 1;

echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>'; ?>

<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	<?
	/**
	 * Fires at the end of the RSS root to add namespaces.
	 *
	 * @since 2.0.0
	 */
	do_action( 'rss2_ns' );
	?>
>

<channel>
	<title><? bloginfo_rss('name'); wp_title_rss(); ?></title>
	<atom:link href="<? self_link(); ?>" rel="self" type="application/rss+xml" />
	<link><? bloginfo_rss('url') ?></link>
	<description><? bloginfo_rss("description") ?></description>
	<lastBuildDate><? echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
	<language><? bloginfo_rss( 'language' ); ?></language>
	<?
	$duration = 'hourly';
	/**
	 * Filter how often to update the RSS feed.
	 *
	 * @since 2.1.0
	 *
	 * @param string $duration The update period.
	 *                         Default 'hourly'. Accepts 'hourly', 'daily', 'weekly', 'monthly', 'yearly'.
	 */
	?>
	<sy:updatePeriod><? echo apply_filters( 'rss_update_period', $duration ); ?></sy:updatePeriod>
	<?
	$frequency = '1';
	/**
	 * Filter the RSS update frequency.
	 *
	 * @since 2.1.0
	 *
	 * @param string $frequency An integer passed as a string representing the frequency
	 *                          of RSS updates within the update period. Default '1'.
	 */
	?>
	<sy:updateFrequency><? echo apply_filters( 'rss_update_frequency', $frequency ); ?></sy:updateFrequency>
	<?
	/**
	 * Fires at the end of the RSS2 Feed Header.
	 *
	 * @since 2.0.0
	 */
	do_action( 'rss2_head');

	while( have_posts()) : the_post();
	?>
	<item>
		<title><? the_title_rss() ?></title>
		<link><? the_permalink_rss() ?></link>
		<comments><? comments_link_feed(); ?></comments>
		<pubDate><? echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
		<dc:creator><![CDATA[<? the_author() ?>]]></dc:creator>
		<? the_category_rss('rss2') ?>

		<guid isPermaLink="false"><? the_guid(); ?></guid>
<? if (get_option('rss_use_excerpt')) : ?>
		<description><![CDATA[<? the_excerpt_rss(); ?>]]></description>
<? else : ?>
		<description><![CDATA[<? the_excerpt_rss(); ?>]]></description>
	<? $content = get_the_content_feed('rss2'); ?>
	<? if ( strlen( $content ) > 0 ) : ?>
		<content:encoded><![CDATA[<? echo $content; ?>]]></content:encoded>
	<? else : ?>
		<content:encoded><![CDATA[<? the_excerpt_rss(); ?>]]></content:encoded>
	<? endif; ?>
<? endif; ?>
		<wfw:commentRss><? echo esc_url( get_post_comments_feed_link(null, 'rss2') ); ?></wfw:commentRss>
		<slash:comments><? echo get_comments_number(); ?></slash:comments>
<? rss_enclosure(); ?>
	<?
	/**
	 * Fires at the end of each RSS2 feed item.
	 *
	 * @since 2.0.0
	 */
	do_action( 'rss2_item' );
	?>
	</item>
	<? endwhile; ?>
</channel>
</rss>
