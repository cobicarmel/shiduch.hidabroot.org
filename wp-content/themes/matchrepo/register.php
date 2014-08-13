<?

/*
Template Name: הרשמה
*/

use Matchrepo\QueryResponse;

$isRegister = false;

$registerSuccess = false;

$blog_name = get_bloginfo();

function new_user_notify($user_data){

	global $blog_name;

	$message = '<div style="direction: rtl">';

	$message .= sprintf('שלום %s ותודה שנרשמת ל%s.', $user_data['display_name'], $blog_name);

	$message .= '<br><br>';

	$message .= 'להלן פרטי ההתחברות לחשבון שלך:';

	$message .= '<br><br>';

	$message .= sprintf("&emsp;שם משתמש: %s", $user_data['user_login']);

	$message .= '<br>';

	$message .= sprintf("&emsp;סיסמה: %s", $user_data['user_pass']);

	$message .= '<br><br>';

	$message .= sprintf('לאחר ההתחברות אפשר לשנות את הסיסמה ב-%s.', '<a href="' . get_permalink(get_page_by_title('ניהול חשבון')) . '">דף ניהול החשבון שלך</a>');

	$message  .= '<br><br>';

	$message .= 'בברכה,';

	$message .= '<br>';

	$message .= sprintf('&emsp;צוות %s.', '<a href="' . get_site_url() . '">' . $blog_name . '</a>');

	$message .= '</div>';

	wp_mail(
		$user_data['user_email'],
		get_bloginfo(),
		$message
	);
}

if($_POST){

	$isRegister = true;

	extract($_POST);

	$errorMsg = [];

	if(empty($agree) || count($agree) < 2)
		$errorMsg[] = '<strong>שגיאה:</strong> יש להסכים לכל תנאי השימוש באתר.';
	else {
		$args = [
			'user_login' => $user_login,
			'user_email' => $user_email,
			'user_pass' => wp_generate_password(12, false),
			'display_name' => $display_name
		];

		$newUser = wp_insert_user($args);

		if(is_wp_error($newUser)){
			foreach($newUser -> errors as $error)
				$errorMsg[] = $error[0];
		}
		else{
			$registerSuccess = true;

			new_user_notify($args);

			$metaTerms = ['user_type', 'user_phone', 'user_country', 'user_zone'];

			foreach($metaTerms as $term)
				update_user_meta($newUser, $term, $$term);
		}
	}

	$errorMsg = QueryResponse::prepareList($errorMsg);
}

Matchrepo::mainFormHeader();

Matchrepo::registerHeader();

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
				<? if(! empty($errorMsg)){ ?>
					<div id="response-error" class="query-response"><?= $errorMsg ?></div>
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
							<input type="text" id="username" name="user_login" value="<?= @$user_login ?>" required>
						</div>
						<div class="label-top">
							<label for="display_name">שם פרטי</label>
							<input type="text" id="display_name" name="display_name" value="<?= @$display_name ?>" required>
						</div>
						<div class="label-top">
							<label for="user-phone">טלפון</label>
							<input type="tel" id="user-phone" name="user_phone" value="<?= @$user_phone ?>" required>
						</div>
						<div class="label-top">
							<label for="user-email">מייל</label>
							<input type="email" id="user-email" name="user_email" value="<?= @$user_email ?>" required>
						</div>
						<div class="label-top">
							<label for="user-country">מדינה</label>
							<select id="user-country" name="user_country" required>
								<? Matchrepo::listOptions(Cards::$props['country']['options'], 'ישראל', true)?>
							</select>
						</div>
						<div class="label-top" id="user-zone-wrapper">
							<label for="user-zone">אזור פעילות</label>
							<select id="user-zone" name="user_zone" required>
								<option>הכל</option>
								<?
								$zones = Cards::$props['zone']['options'];

								foreach($zones as $zone){
									$selected = isset($user_zone) && $user_zone == $zone ? ' selected' : '';
									?>
									<option<?= $selected ?>><?= $zone ?></option>
								<? }?>
							</select>
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