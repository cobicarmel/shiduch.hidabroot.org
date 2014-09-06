<?

/*
Template Name: עריכת כרטיס
*/

use Matchrepo\QueryResponse;

$post_id = $_GET['id'];

if(! current_user_can('edit_post', $post_id))
	wp_die('אין לך הרשאות לערוך את הכרטיס הזה.', 'הגישה נדחתה');

Matchrepo::mainFormHeader();

Matchrepo::cardFormHeader();

if($_POST) {

	$isCorrect = Cards::validateCardData($_POST);

	if($isCorrect === true) {

		$args = [
			'ID' => $post_id,
			'post_title' => $_POST['title'],
			'post_content' => $_POST['content'],
			'post_status' => $_POST['privacy'] ? 'private' : 'publish'
		];

		wp_update_post($args);

		unset($_POST['title'], $_POST['content']);

		$_POST['birthday'] = Matchrepo::textToDBDate($_POST['birthday']);

		$cardTerms = Cards::getTerms();

		foreach($cardTerms as $term)
			update_post_meta($post_id, $term, @$_POST[$term]);
	}

	QueryResponse::addResponse('card_saved', !! $isCorrect);

	QueryResponse::sendResponse(get_permalink( $post_id ));
}

get_header();

$args = [
	'post_type' => 'card',
	'posts_per_page' => 1,
	'post__in' => [$post_id]
];

query_posts($args);

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="background-area">
				<?

				while(have_posts()) :

					the_post();

					get_template_part('content', 'edit');

				endwhile;

				?>
			</div>
		</main>
		<!-- #main -->
	</div><!-- #primary -->

<? get_sidebar() ?>
<? get_footer() ?>