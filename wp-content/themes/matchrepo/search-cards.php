<?
/*
Template Name: תוצאות חיפוש
 */

Matchrepo::multiCardsHeader();

$props = Cards::$props;

$metaArgs = [];

foreach($_GET as $key => $value){

	if(! isset($props[$key]) || (is_string($value) && trim($value) == ''))
		continue;

	/*if(is_array($value))
		$value = implode(',', $value);*/

	if(isset($props[$key])){

		$compare = isset($props[$key]['compare']) ? $props[$key]['compare'] : '=';

		$metaArgs[] = [
			'key' => $key,
			'value' => $value,
			'compare' => $compare
		];
	}
}

$args = [
	'post_type' => 'card',
	'meta_query' => $metaArgs
];

query_posts($args);

get_header();

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div id="user-crumbs">
			<?
			printf(
				__('Found %d Cards For Search', THEME_NAME),
				$wp_query ->found_posts
			)
			?>
		</div>
		<div class="background-area">
			<?

			while(have_posts()) : the_post(); ?>

				<? get_template_part('content', 'account'); ?>

			<? endwhile ?>

			<? Matchrepo::multiCardsNavigation() ?>
		</div>
	</main>
	<!-- #main -->
</div><!-- #primary -->

<? get_sidebar() ?>
<? get_footer() ?>
