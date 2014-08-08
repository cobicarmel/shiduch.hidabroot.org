<?
/*
Template Name: כרטיסים
 */

Matchrepo::multiCardsHeader();

$args = [
	'post_type' => 'card',
	'posts_per_page' => 10,
	'paged' => get_query_var('paged', 1),
	'post_status' => 'publish'
];

query_posts($args);

global $posts;

get_header();

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
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