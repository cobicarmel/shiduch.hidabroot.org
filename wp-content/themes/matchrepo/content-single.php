<?

/** @var WP_Post $post */

use Matchrepo\QueryResponse;

$arr_post = (array) $post;

$gender = CardHelpers::get_gender($arr_post);

$MCard = new $gender($arr_post);

$id = get_the_ID();

$contact = get_user_by('id', $post ->post_author);

$contact_meta = get_user_meta($post ->post_author);

$contactItems = ['user_type', 'user_phone'];

foreach($contactItems as $item)
	$$item = ! empty($contact_meta[$item][0]) ? $contact_meta[$item][0] : null;

$cardManager = get_the_author();

if(! empty(Cards::$user_types[$user_type]))
	$cardManager .= ', ' . Cards::$user_types[$user_type];

?>

<article id="post-<?= $id ?>" class="background-area">
	<? QueryResponse::listResponse() ?>
	<div class="card-details">
		<div class="card-meta">
			<? $MCard ->list_meta() ?>
			<div class="card-content">
				<h2><?= $MCard::$labels['Little_About_The_Candidate'] ?></h2>
				<? the_content() ?>
			</div>
		</div>
		<div class="card-side">
			<? $MCard -> getAvatar() ?>
			<div class="card-side-box">
				<div class="title"><?= stripslashes(__('This Card Managed By', THEME_NAME)) ?></div>
				<div id="card-manager" class="cdb-content"><?= $cardManager ?></div>
			</div>
			<div class="card-side-box">
				<div class="title"><? _e('Contact Details', THEME_NAME) ?></div>
				<div class="cdb-content">
					<? if($user_phone) { ?>
						<div class="row">
							<div class="label">טלפון:</div>
							<div class="term">
								<? $phone = Matchrepo::phone_format($user_phone) ?>
								<a href="tel:<?= $phone ?>"><?= $phone ?></a>
							</div>
						</div>
					<? } ?>
					<div class="row">
						<div class="label">דוא"ל:</div>
						<div class="term">
							<a target="_blank"
							   href="mailto:<?= $contact ->user_email ?>"><?= $contact ->user_email ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="treat-card">
		<?
		if(current_user_can('delete_post', $id)) {
			?>

			<div>
				<a href="?trash"
				   onclick="return confirm('האם למחוק את הכרטיס של <?= the_title() ?>?')"><?= __('Delete', THEME_NAME) ?></a>
			</div>
		<?
		}
		if(current_user_can('edit_post', $id)) {
			$editLink = get_permalink(get_page_by_title('עריכת כרטיס'));

			$args = [
				'id' => $id
			];

			$link = add_query_arg($args, $editLink);
			?>
			<div>
				<a href="<?= $link ?>"><? _e('Edit') ?></a>
			</div>
		<?
		}
		?>
	</div>
	<div id="card-id"><? printf('כרטיס מספר %d', $id) ?></div>
</article>