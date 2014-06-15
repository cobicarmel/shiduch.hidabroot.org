<?
$arr_post = (array) $post;
$gender = CardHelpers::get_gender($arr_post);
$MCard = new $gender($arr_post);
?>

<article id="post-<? the_ID(); ?>">
	<div class="card-details">
		<div class="card-meta">
			<? $MCard -> list_meta($MCard -> myAccountItems) ?>
			<div class="card-content">
				<h2><?= $MCard::$labels['Little_About_The_Candidate'] ?>:</h2>
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
		</div>
		<div class="to-full-card">
			<a href="<? the_permalink() ?>"><? _e('To Full Card', THEME_NAME) ?></a>
		</div>
	</div>
</article>