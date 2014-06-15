<?

/*
Template Name: עריכת כרטיס
*/

if(! current_user_can('edit_posts', $_GET['id']))
	wp_die('לך הביתה, פעם אחרונה שאתה עושה כאלו שטויות!');

get_header();

$args = array(
	'post_type' => 'card',
	'posts_per_page' => 1,
	'post__in' => [$_GET['id']]
);

query_posts($args);

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="background-area">
			<?

			while(have_posts()) : the_post(); ?>

				<? get_template_part('content', 'edit'); ?>

			<? endwhile ?>
		</div>
	</main>
	<!-- #main -->
</div><!-- #primary -->

<? get_sidebar() ?>
<? get_footer() ?>