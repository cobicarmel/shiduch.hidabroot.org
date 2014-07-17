<?

/*
Template Name: הרשמה
*/

$isRegister = false;

$registerSuccess = false;

if($_POST){

	$isRegister = true;

	extract($_POST);

	$errorMsg = [];

	if(empty($agree) || count($agree) < 2)
		$errorMsg[] = '<strong>שגיאה:</strong> יש להסכים לכל תנאי השימוש באתר.';
	else {
		$newUser = register_new_user($user_login, $user_email);

		if(is_wp_error($newUser)){
			foreach($newUser -> errors as $error)
				$errorMsg[] = $error[0];
		}
		else{
			$registerSuccess = true;

			$metaTerms = ['nickname', 'user_type', 'user_phone', 'user_zone'];

			foreach($metaTerms as $term)
				update_user_meta($newUser, $term, $$term);
		}
	}

	$errorMsg = implode('<br>', $errorMsg);
}

Matchrepo::mainFormHeader();

wp_enqueue_style('register', get_stylesheet_directory_uri() . '/register/register.css');

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
		<div id="main-form-background">
			<h2 id="main-title">הרשמה</h2>
			<div id="register-wrapper">
				<? if(isset($errorMsg)){ ?>
					<div id="register-error"><?= $errorMsg ?></div>
				<?
				} if($registerSuccess) : ?>
				<div id="register-success">
					<h3>ההרשמה הושלמה בהצלחה!</h3>
					<p>שם המשתמש והסיסמה שלך נשלחו לכתובת <?= $user_email ?>.</p>
				</div>
				<? else : ?>
				<form id="register" method="post">
					<fieldset>
						<legend>אני</legend>
						<?
						$itemsPerLine = 3;
						$itemsCounter = 0;

						foreach($userTypes as $i => $type){
							$checked = isset($user_type) ? $user_type == $i ? ' checked' : '' : $i == 0 ? 'checked': '';
							?>
							<input name="user_type" type="radio" id="user-type-<?= $i ?>" value="<?= $i ?>"<?= $checked ?>>
							<label for="user-type-<?= $i ?>"><?= $type ?></label>
							<?
							if(++$itemsCounter == $itemsPerLine){
								echo '<br>';
								$itemsCounter = 0;
							}
						} ?>
					</fieldset>
					<fieldset>
						<div class="label-top">
							<label for="username">שם משתמש (באנגלית בלבד)</label>
							<input type="text" id="username" name="user_login" value="<?= isset($user_login) ? $user_login : '' ?>" required>
						</div>
						<div class="label-top">
							<label for="nickname">שם פרטי</label>
							<input type="text" id="nickname" name="nickname" value="<?= isset($nickname) ? $nickname : '' ?>" required>
						</div>
						<div class="label-top">
							<label for="user-phone">טלפון</label>
							<input type="tel" id="user-phone" name="user_phone" value="<?= isset($user_phone) ? $user_phone : '' ?>" required>
						</div>
						<div class="label-top">
							<label for="user-email">מייל</label>
							<input type="email" id="user-email" name="user_email" value="<?= isset($user_email) ? $user_email : '' ?>" required>
						</div>
						<div class="label-top">
							<label for="user-zone">אזור פעילות</label>
							<select id="user-zone" name="user_zone" required>
								<option></option>
								<?
								$zones = Cards::$props['zone']['options'];

								foreach($zones as $zone){
									$selected = isset($user_zone) && $user_zone == $zone ? ' selected' : '';
									?>
									<option<?= $selected ?>><?= $zone ?></option>
								<? }?>
							</select>
						</div>
						<div class="label-top">
							<label for="user-country">מדינה</label>
							<select id="user-country"></select>
						</div>
					</fieldset>
					<fieldset id="user-agree">
						<div>
							<input type="checkbox" id="agree0" name="agree[]" required>
							<label for="agree0">אני מתחייב/ת למלא כרטיסים בעלי פרטים נכונים ומאומתים בלבד.</label>
						</div>
						<div>
							<input type="checkbox" id="agree1" name="agree[]" required>
							<label for="agree1">אני מתחייב/ת כי במידה ובעז"ה אחד המועמדים שרשמתי יגיע לחופה עם משודכ/ת אחר/ת מהמאגר, ישולם להידברות סך של 1,000 ש"ח.</label>
						</div>
					</fieldset>
					<button>סיום הרשמה</button>
				</form>
				<? endif; ?>
			</div>
		</div>
	</main>
</div>

<? get_sidebar() ?>
<? get_footer() ?>
