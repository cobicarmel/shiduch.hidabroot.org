<?

/*
Template Name: הרשמה
*/

$userTypes = [
	'שדכנית',
	'שדכנית מצווה',
	'הורה',
	'רב',
	'רבנית',
	'בן משפחה של המועמד/ת'
];

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div id="register-background">
			<h2 id="main-title">הרשמה</h2>

			<form id="register" method="post">
				<fieldset>
					<legend>אני</legend>
					<?
					$itemsPerLine = 3;
					$itemsCounter = 0;

					foreach($userTypes as $i => $type){
						?>
						<input name="user-type" type="radio" id="user-type-<?= $i ?>" value="<?= $i ?>">
						<label for="user-type-<?= $i ?>"><?= $type ?></label>
						<?
						if(++$itemsCounter == $itemsPerLine){
							echo '<br>';
							$itemsCounter = 0;
						}
					} ?>
				</fieldset>
				<fieldset>
					<label for="username">שם</label>
					<input type="text" id="username">
					<label for="user-phone">טלפון</label>
					<input type="tel" id="user-phone">
					<label for="user-email">מייל</label>
					<input type="email" id="user-email">
				</fieldset>
			</form>
		</div>
	</main>
</div>

<? get_sidebar() ?>
<? get_footer() ?>
