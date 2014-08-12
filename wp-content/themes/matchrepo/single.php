<?

use Matchrepo\QueryResponse;

/* @var WP_post $post*/

if(isset($_GET['trash']) && current_user_can('delete_post', $post->ID)){

	QueryResponse::addResponse('card_trashed', !! wp_trash_post());

	QueryResponse::sendResponse(get_permalink(get_page_by_title('החשבון שלי')));
}

wp_register_style('single', get_stylesheet_directory_uri() . '/css/single.css');
wp_enqueue_style('single');

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<? while ( have_posts() ) : the_post(); ?>

			<? get_template_part( 'content', 'single' ); ?>

		<? endwhile ?>

		</main>
	</div>

<? get_sidebar(); ?>
<? get_footer(); ?>