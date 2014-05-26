<?

/*
Template Name: החשבון שלי
*/

wp_register_style('my_account', get_stylesheet_directory_uri() . '/css/my_account.css');

wp_enqueue_style('my_account');

get_header();

if(!$paged = get_query_var('paged'))
	$paged = 1;

$args = array(
	'author' => $current_user->ID,
	'post_type' => 'card',
	'orderby' => 'post_date',
	'order' => 'DESC',
	'posts_per_page' => 4,
	'paged' => $paged
);

query_posts($args);

?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div id="user-managing">
			<button><? _e('Account Managing', THEME_NAME) ?></button>
			<button><? _e('Email Notifications Settings', THEME_NAME) ?></button>
		</div>
		<div id="user-crumbs">
			<?
			printf(
				__('Hello %s, there are %d cards in your account', THEME_NAME),
				$current_user ->data ->display_name,
				$wp_query ->found_posts
			)
			?>
		</div>
		<div class="background-area">
			<?

			while(have_posts()) : the_post(); ?>

				<? get_template_part('content', 'account'); ?>

			<? endwhile ?>

			<div id="page-navigation">
				<?

				$big = 9999999;

				$args = array(
					'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
					'format' => '?paged=%#%',
					'current' => $paged,
					'total' => $wp_query->max_num_pages,
					'prev_text'    => '<',
					'next_text'    => '>',
				);

				echo paginate_links($args);
				?>
			</div>
		</div>
	</main>
	<!-- #main -->
</div><!-- #primary -->

<? get_sidebar() ?>
<? get_footer() ?>
