<?
/*
Template Name: תוצאות חיפוש
 */

Matchrepo::multiCardsHeader();

$props = (int) $_GET['gender'] ? Female::$props : Male::$props;

$metaArgs = [];

$compareAfter = ['disability_details'];

foreach($_GET as $key => $value){

	if(
		! isset($props[$key]) ||
		(is_string($value) && trim($value) == '') ||
		in_array($key, $compareAfter)
	)
		continue;

	$tempArgs = [];

	if(isset($props[$key])){

		if(isset($props[$key]['queryValue']))
			$value = call_user_func($props[$key]['queryValue'], $value);

		$tempArgs = [
			'key' => isset($props[$key]['queryKey']) ? $props[$key]['queryKey'] : $key,
			'value' => $value,
			'compare' => isset($props[$key]['compare']) ? $props[$key]['compare'] : '='
		];

		if(isset($props[$key]['queryType']))
			$tempArgs['type'] = $props[$key]['queryType'];

		$metaArgs[] = $tempArgs;
	}
}

$args = [
	'post_type' => 'card',
	'meta_query' => $metaArgs,
	'posts_per_page' => 4,
	'paged' => get_query_var('paged', 1),
	'post_status' => 'publish'
];

query_posts($args);

global $posts;



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
</div>

<? get_sidebar() ?>
<? get_footer() ?>
