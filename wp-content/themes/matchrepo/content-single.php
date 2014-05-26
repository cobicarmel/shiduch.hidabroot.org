<?
$arr_post = (array) $post;
$gender = CardHelpers::get_gender($arr_post);
$MCard = new $gender($arr_post);
?>

<article id="post-<? the_ID(); ?>" class="background-area">
	<div class="card-details">
		<div class="card-meta">
			<? $MCard -> list_meta() ?>
			<div class="card-content">
				<h2><?= $MCard::$labels['Little_About_The_Candidate'] ?></h2>
				<? the_content() ?>
			</div>
		</div>
		<div class="card-side">
			<div class="card-avatar">
				<div class="card-title title"><? the_title() ?></div>
				<div class="card-image">
					<img src="<?= WP_CONTENT_URL ?>/themes/matchrepo/media/<?= $MCard ->images['recent_cards'] ?>">
				</div>
			</div>
			<div class="card-side-box">
				<div class="title"><?= stripslashes(__('This Card Managed By', THEME_NAME)) ?></div>
				<div class="cdb-content"></div>
			</div>
			<div class="card-side-box">
				<div class="title"><? _e('Contact Details', THEME_NAME) ?></div>
				<div class="cdb-content"></div>
			</div>
		</div>
	</div>
	<div id="treat-card">
		<?
		if($url = get_delete_post_link($post -> ID))
			echo "<div><a href='$url'>" . __('Delete', THEME_NAME)  . "</a></div>";

		edit_post_link(__('Edit'), '<div>', '</div>');
		?>
	</div>
</article><!-- #post-## -->
