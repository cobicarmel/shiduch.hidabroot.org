<?

/*
Template Name: עריכת כרטיס
*/

$post_id = $_GET['id'];

if(! current_user_can('edit_posts', $post_id))
	wp_die('לך הביתה, פעם אחרונה שאתה עושה כאלו שטויות!');

Matchrepo::mainFormHeader();

Matchrepo::cardFormHeader();

if($_POST) {

	$isCorrect = Cards::validateCardData($_POST);

	if($isCorrect === true) {

		wp_update_post([
			'ID' => $post_id,
			'post_title' => $_POST['title'],
			'post_content' => $_POST['content']
		]);

		unset($_POST['title'], $_POST['content']);

		$_POST['birthday'] = Matchrepo::textToDBDate($_POST['birthday']);

		$cardTerms = Cards::getTerms();

		foreach($cardTerms as $term)
			update_post_meta($post_id, $term, isset($_POST[$term]) ? $_POST[$term] : '');

		wp_redirect(get_permalink( $post_id ));
	}

	exit;
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