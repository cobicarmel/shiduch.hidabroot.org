<?

/*
Template Name: ניהול חשבון
*/

global $current_user;

if($_POST) {

	extract($_POST);

	$user_terms = ['user_email', 'display_name'];

	$metaTerms = ['user_type', 'user_phone', 'user_zone'];

	$errorMsg = [];

	if(! empty($pass1) xor ! empty($pass2))
		$errorMsg[] = 'הסיסמאות שהוזנו אינן תואמות.';
	elseif(! empty($pass1)) {
		if($pass1 != $pass2)
			$errorMsg[] = 'הסיסמאות שהוזנו אינן תואמות.';
		else{
			$user_terms[] = 'user_pass';
			$user_pass = $pass1;
		}
	}

	$terms_to_update = ['ID' => $current_user->ID];

	foreach($user_terms as $term)
		$terms_to_update[$term] = @$$term;

	if(! $errorMsg){
		$update = wp_update_user($terms_to_update);

		if(is_wp_error($update)){
			foreach($update -> errors as $error)
				$errorMsg[] = $error[0];
		}
	}

	if(! $errorMsg){

		if(isset($user_type))
			$user_type = $user_type[0];

		foreach($metaTerms as $term)
			update_user_meta($current_user ->ID, $term, @$$term);
	}

	if($errorMsg)
		$errorMsg = implode('<br>', $errorMsg);
	else{
		wp_redirect(add_query_arg(['account_saved' => 1], get_permalink(get_page_by_title('ניהול חשבון'))));
		exit;
	}
}

$user_meta = get_user_meta($current_user->ID);

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
				<h2 id="main-title">ניהול חשבון</h2>

				<div id="register-wrapper">
					<? if(isset($errorMsg)) { ?>
						<div id="response-error" class="query-response"><?= $errorMsg ?></div>
					<? } ?>
					<? Matchrepo::listQueryResponse() ?>
					<form id="register" method="post">
						<fieldset>
							<legend>אני</legend>
							<?

							$args = [
								'echo' => false,
								'name' => 'user_type',
								'id' => 'user_type',
								'compare' => @$user_meta['user_type'],
								'type' => 'radio',
								'wrapTag' => ''
							];

							$options = Matchrepo::listCheckboxes($userTypes, $args);

							echo implode('<br>', array_map(function ($i){

								return implode('', $i);
							}, array_chunk($options, 3)));

							?>
						</fieldset>
						<fieldset>
							<div class="label-top">
								<label for="display_name">שם פרטי</label>
								<input type="text" id="display_name" name="display_name"
									   value="<?= $current_user -> display_name ?>" required>
							</div>
							<div class="label-top">
								<label for="user-phone">טלפון</label>
								<input type="tel" id="user-phone" name="user_phone"
									   value="<?= @$user_meta['user_phone'][0] ?>" required>
							</div>
							<div class="label-top">
								<label for="user-email">מייל</label>
								<input type="email" id="user-email" name="user_email"
									   value="<?= $current_user -> user_email ?>" required>
							</div>
							<div class="label-top">
								<label for="user-country">מדינה</label>
								<select id="user-country" required>
									<? Matchrepo::listOptions(Cards::$props['country']['options'], @$user_meta['user_country'][0], true) ?>
								</select>
							</div>
							<? $style = @$user_meta['user_country'][0] == 'ישראל'? : 'style="display: none"'?>
							<div class="label-top" id="user-zone-wrapper"<?= $style ?>>
								<label for="user-zone">אזור פעילות</label>
								<select id="user-zone" name="user_zone" required>
									<? Matchrepo::listOptions(Cards::$props['zone']['options'], @$user_meta['user_zone'][0], true); ?>
								</select>
							</div>
						</fieldset>
						<fieldset>
							<legend>שינוי סיסמה:</legend>
							<div class="label-top">
								<label for="pass1">סיסמה חדשה:</label>
								<input id="pass1" name="pass1" type="password">
							</div>
							<div class="label-top">
								<label for="pass2">אישור סיסמה חדשה:</label>
								<input id="pass2" name="pass2" type="password">
							</div>
						</fieldset>
						<button>עדכון פרטים</button>
					</form>
				</div>
			</div>
		</main>
	</div>

<? get_sidebar() ?>
<? get_footer() ?>