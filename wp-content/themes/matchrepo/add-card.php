<?

/*
Template Name: הוספת כרטיס
*/

Matchrepo::redirect_not_logged();

Matchrepo::mainFormHeader();

$level = 1;

if(isset($_POST['from_level']))
	$level = $_POST['from_level'] + 1;

if($level > 1)
	Matchrepo::cardFormHeader();

if($level == 2) {
	$gender = $_POST['gender'];

	$props = $gender ? Female::$props : Male::$props;

	$labels = $gender ? Female::$labels : Male::$labels;
}

if($level == 3) {

	$register_successful = false;

	$isCorrect = Cards::validateCardData($_POST);

	$post_status = $_POST['privacy'] ? 'private' : 'pending';

	$params = array(
		'post_type' => 'card',
		'post_title' => $_POST['title'],
		'post_status' => $post_status,
		'post_content' => $_POST['content']
	);

	unset($_POST['title'], $_POST['content']);

	if($isCorrect === true) {

		$post = wp_insert_post($params);

		if(is_integer($post)) { // post inserted successfully

			$_POST['birthday'] = Matchrepo::textToDBDate($_POST['birthday']);

			$cardTerms = Cards::getTerms();

			foreach($cardTerms as $term){

				if(! isset($_POST[$term])){
					update_post_meta($post, $term, null);
					continue;
				}

				if(is_array($_POST[$term])){

					foreach($_POST[$term] as $item)
						add_post_meta($post, $term, $item);
				}
				else
					update_post_meta($post, $term, $_POST[$term]);
			}

			$register_successful = true;
		}
	}
}

get_header();
?>

	<div id="primary" class="content-area<?= $level != 1 ? : ' decorative' ?>">
	<main id="main" class="site-main" role="main">

	<? if($level == 1) : ?>
		<h2 id="main-title">פתיחת כרטיס אישי</h2>
		<form id="main-form" method="post">
			<input type="hidden" name="from_level" value="1">

			<div id="choose-gender">
				<div>
					<img src="<?= get_stylesheet_directory_uri() . '/media/male-main.png' ?>">
					<input name="gender" value="0" type="radio" id="option-male" checked>
					<label for="option-male">פתיחת כרטיס לגבר</label>
				</div>
				<div>
					<img src="<?= get_stylesheet_directory_uri() . '/media/female-main.png' ?>">
					<input name="gender" value="1" type="radio" id="option-female">
					<label for="option-female">פתיחת כרטיס לאישה</label>
				</div>
			</div>
			<div id="submit">
				<input type="submit" value="המשך">
			</div>
		</form>

	<? else : ?>
		<div id="main-form-background">
		<h2 id="main-title">הוספת כרטיס למאגר</h2>
		<? if($level == 2) : ?>
			<img id="avatar"
				 src="<?= get_stylesheet_directory_uri() . '/media/' . ($gender ? 'female' : 'male') . '-new-card.png' ?>">

			<form id="main-form" method="post">
			<input type="hidden" name="gender" value="<?= $_POST['gender'] ?>">
			<input type="hidden" name="from_level" value="2">

			<div id="mf-options">
			<fieldset>
				<legend>פרטים בסיסיים</legend>
				<div class="label-top w33">
					<label for="cf-first-name">שם פרטי</label>
					<input id="cf-first-name" type="text" name="title" required>
				</div>
				<div class="label-top w33">
					<label for="cf-birthday">תאריך לידה</label>
					<input id="cf-birthday" type="text" name="birthday" required>
				</div>
			</fieldset>
			<fieldset>
				<legend>מצב משפחתי</legend>
				<div class="label-top w16">
					<label for="cf-status">מצב משפחתי</label>
					<select id="cf-status" class="toggle-trigger show-hide-trigger" name="status"
							data-toggle-key="children" required>
						<option></option>
						<option value="0"><?= $props['status']['options'][0] ?></option>
						<option value="1"><?= $props['status']['options'][1] ?></option>
						<option value="2"><?= $props['status']['options'][2] ?></option>
					</select>
				</div>
				<div class="label-top w16 toggle-affected show-hide-affected" data-affected="children"
					 style="display: none">
					<label for="cf-children">מספר ילדים</label>
					<select id="cf-children" name="children" disabled>
						<? foreach(range(0, 20) as $number) { ?>
							<option><?= $number ?></option>
						<? } ?>
					</select>
				</div>
			</fieldset>
			<fieldset>
				<legend>מקום מגורים</legend>
				<div class="label-top w33">
					<label for="cf-country">ארץ</label>
					<select id="cf-country" name="country" class="toggle-trigger zone-trigger" required>
						<option></option>
						<? Matchrepo::listOptions($props['country']['options'], null, true) ?>
					</select>
				</div>
				<div class="label-top w33 toggle-affected zone-affected" style="display: none">
					<label for="cf-zone">איזור מגורים</label>
					<select id="cf-zone" name="zone" required>
						<option></option>
						<? foreach($props['zone']['options'] as $zone) { ?>
							<option><?= $zone ?></option>
						<? } ?>
					</select>
				</div>
			</fieldset>
			<fieldset>
				<legend>מוצא</legend>
				<div class="row">
					<div class="label-top w33">
						<label for="cf-community">מוצא עדתי</label>
						<select id="cf-community" name="community" required>
							<option></option>
							<? Matchrepo::listOptions($props['community']['options']) ?>
						</select>
					</div>
					<div class="label-top w33">
						<label for="cf-conception">השקפה</label>
						<select id="cf-conception" class="toggle-trigger hasidism-trigger" name="conception"
								required>
							<option></option>
							<? Matchrepo::listOptions($props['conception']['options']) ?>
						</select>
					</div>
					<div class="label-top w33 toggle-affected hasidism-affected" style="display: none">
						<label for="cf-hasidism">חסידות</label>
						<select id="cf-hasidism" name="hasidism" required disabled>
							<option></option>
							<? foreach($props['hasidism']['options'] as $hasidut) { ?>
								<option><?= $hasidut ?></option>
							<? } ?>
						</select>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>לימודים</legend>
				<div class="row">
					<label for="cf-college_type"><?= $props['college_type']['label'] ?></label>
					<? Matchrepo::listCheckboxes($props['college_type']['options'], [
						'name' => 'college_type'
					])?>
				</div>
			</fieldset>
			<fieldset>
				<legend>משפחה</legend>
				<div class="row">
					<div class="label-top w33">
						<label for="cf-father_community">מוצא האב</label>
						<select id="cf-father_community" name="father_community" required>
							<option></option>
							<? Matchrepo::listOptions(Male::$props['community']['options']) ?>
						</select>
					</div>
					<div class="label-top w33">
						<label for="cf-mother_community">מוצא האם</label>
						<select id="cf-mother_community" name="mother_community" required>
							<option></option>
							<? Matchrepo::listOptions(Female::$props['community']['options']) ?>
						</select>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>מראה</legend>
				<div class="label-top w16">
					<label for="cf-height">גובה</label>
					<select id="cf-height" name="height" required>
						<option></option>
						<? foreach(range(120, 210) as $height) { ?>
							<option><?= $height ?></option>
						<? } ?>
					</select>
				</div>
				<div class="label-top w33">
					<label for="cf-look">מראה כללי</label>
					<select id="cf-look" name="look" required>
						<option></option>
						<? Matchrepo::listOptions($props['look']['options']) ?>
					</select>
				</div>
				<div class="label-top w25">
					<label for="cf-skin">גוון עור</label>
					<select id="cf-skin" name="skin" required>
						<option></option>
						<? Matchrepo::listOptions($props['skin']['options']) ?>
					</select>
				</div>
				<? if(! $gender) { ?>
					<div class="label-top w25">
						<label for="cf-beard">זקן</label>
						<select id="cf-beard" name="beard" required>
							<option></option>
							<? Matchrepo::listOptions($props['beard']['options']) ?>
						</select>
					</div>
				<? } ?>
			</fieldset>
			<fieldset>
				<legend>מצב בריאותי</legend>
				<div class="row">
					<div class="label-top w33">
						<label for="cf-healthy">מצב בריאותי</label>
						<select id="cf-healthy" class="toggle-trigger show-hide-trigger" data-toggle-key="healthy"
								name="healthy" required>
							<option></option>
							<? foreach($props['healthy']['options'] as $i => $healthy) { ?>
								<option value="<?= $i ?>"><?= $healthy ?></option>
							<? } ?>
						</select>
					</div>
				</div>
				<div class="row">
					<div id="cf-disability" class="toggle-affected show-hide-affected" data-affected="healthy"
						 style="display: none">
						<div>פירוט מוגבלות</div>
						<? foreach($props['disability_details']['options'] as $i => $disability) { ?>
							<div>
								<input type="checkbox" name="disability_details[]" id="cf-disability<?= $i ?>"
									   value="<?= $i ?>">
								<label for="cf-disability<?= $i ?>"><?= $disability ?></label>
							</div>
						<? } ?>
						<div
						<label for="cf-disability-other">אחר - נא לפרט:</label>
						<textarea id="cf-disability-other" name="other_disability"></textarea>
					</div>
				</div>
			</fieldset>
			<?
			if(! $gender) {
				?>
				<fieldset>
					<legend>מעוניין ב-</legend>
					<div class="row">
						<div class="label-top">
							<label for="cf-looking_for_cover">כיסוי ראש</label>
							<select id="cf-looking_for_cover" name="looking_for_cover">
								<option></option>
								<? Matchrepo::listOptions($props['looking_for_cover']['options']) ?>
							</select>
						</div>
					</div>
				</fieldset>
			<?
			}
			?>
			<fieldset>
				<legend>שונות</legend>
				<? if($gender) { ?>
					<div class="label-top w25">
						<label for="cf-cover">כיסוי ראש</label>
						<select id="cf-cover" name="cover">
							<option></option>
							<? Matchrepo::listOptions($props['cover']['options']) ?>
						</select>
					</div>
				<?
				}
				else {
					?>
					<div class="w33">
						<input type="checkbox" id="cf-smoke" name="smoke" value="1">
						<label for="cf-smoke">מעשן</label>
					</div>
					<div class="w33">
						<input type="checkbox" id="cf-license" name="license" value="1">
						<label for="cf-license">בעל רשיון נהיגה</label>
					</div>
				<? } ?>
			</fieldset>
			<fieldset>
				<legend><?= $labels['Little_About_The_Candidate'] ?></legend>
				<textarea id="cf-content" name="content" required></textarea>
			</fieldset>
			<div id="private-area">
				<h2>אזור אישי</h2>
				<h5>הפרטים שלהלן יהיו גלויים רק לך ולצוות האתר:</h5>
				<fieldset>
					<legend>משפחה</legend>
					<div class="row">
						<div class="label-top w33">
							<label for="cf-last-name">שם משפחה</label>
							<input id="cf-last-name" type="text" name="last_name">
						</div>
						<div class="label-top w25">
							<label for="cf-family-children">מספר ילדים במשפחה</label>
							<input id="cf-family-children" type="number" min="0" max="20" name="family_children">
						</div>
					</div>
					<div class="row">
						<div class="label-top w33">
							<label for="cf-father-name">שם האב</label>
							<input id="cf-father-name" type="text" name="father_name">
						</div>
						<div class="label-top w33">
							<label for="cf-mother-name">שם האם</label>
							<input id="cf-mother-name" type="text" name="mother_name">
						</div>
					</div>
					<div class="row">
						<div class="label-top w33">
							<label for="cf-father-work">עיסוק האב</label>
							<input id="cf-father-work" type="text" name="father_work">
						</div>
						<div class="label-top w33">
							<label for="cf-mother-work">עיסוק האם</label>
							<input id="cf-mother-work" type="text" name="mother_work">
						</div>
					</div>
					<div class="row">
						<div class="label-top w33">
							<label for="cf-origins">עדה</label>
							<select id="cf-origins" name="origins">
								<option></option>
								<? Matchrepo::listOptions($props['origins']['options'], null, true) ?>
							</select>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<legend>לימודים</legend>
					<? if($gender) { ?>
						<div class="label-top w33">
							<label for="cf-college">סמינר</label>
							<input id="cf-college" type="text" name="college">
						</div>
					<?
					}
					else {
						?>
						<div class="label-top w33">
							<label for="cf-yeshiva_k">ישיבה קטנה</label>
							<input id="cf-yeshiva_k" type="text" name="yeshiva_k">
						</div>
						<div class="label-top w33">
							<label for="cf-yeshiva_g">ישיבה גדולה</label>
							<input id="cf-yeshiva_g" type="text" name="yeshiva_g">
						</div>
					<? } ?>
				</fieldset>
				<fieldset>
					<legend>עיסוק</legend>
					<div class="row">
						<? if(! $gender) { ?>
							<div class="label-top w33">
								<label for="cf-practice">עיסוק</label>
								<select id="cf-practice" name="practice">
									<option></option>
									<? Matchrepo::listOptions($props['practice']['options']) ?>
								</select>
							</div>
						<? } ?>
						<div class="label-top w33">
							<label for="cf-work">מקום לימודים/עיסוק כיום</label>
							<input id="cf-work" type="text" name="work">
						</div>
					</div>
				</fieldset>
				<fieldset>
					<legend>בירורים</legend>
					<? for($i = 0; $i < 5; $i++) { ?>
						<div class="row">
							<div class="label-top w33">
								<label for="inquiries-name-<?= $i ?>">שם</label>
								<input id="inquiries-name-<?= $i ?>" type="text" name="inquiries[<?= $i ?>][name]">
							</div>
							<div class="label-top w33">
								<label for="inquiries-phone-<?= $i ?>">טלפון</label>
								<input id="inquiries-phone-<?= $i ?>" type="tel" name="inquiries[<?= $i ?>][phone]">
							</div>
							<div class="label-top w33">
								<label for="inquiries-notes-<?= $i ?>">הערות</label>
								<input id="inquiries-notes-<?= $i ?>" type="text" name="inquiries[<?= $i ?>][notes]">
							</div>
						</div>
					<? } ?>
				</fieldset>
				<fieldset>
					<legend>מידע נוסף</legend>
					<textarea id="cf-more" name="more_details" placeholder="טקסט חופשי"></textarea>
				</fieldset>
			</div>
			<fieldset>
				<legend>פרטיות</legend>
				<select name="privacy" id="privacy">
					<option value="0">הכרטיס גלוי לכולם</option>
					<option value="1">הכרטיס גלוי רק לי ולצוות האתר</option>
				</select>
			</fieldset>
			</div>
			<div id="submit">
				<input type="submit" value="הוספת כרטיס">
			</div>
			</form>
		<? elseif($level == 3) : ?>
			<div id="register-complete">
				<? if($register_successful) : ?>
					<div id="register-success">
						<h3>הכרטיס נרשם בהצלחה!</h3>

						<p><?
							$future = $post_status == 'pending' ? ' והוא יופיע בחשבונך לאחר אישורו על ידי צוות האתר' : '. הכרטיס יהיה גלוי רק לך ולצוות האתר.';

							printf('הכרטיס של %s נכנס למערכת%s', $params['post_title'], $future);
							?></p>
					</div>
				<?
				else :
					$props = Cards::$props;

					foreach(['male', 'female'] as $class) {
						foreach($class::$props as $term => $prop) {
							if(! isset($props[$term]))
								$props[$term] = $prop;
						}
					}
					?>
					<div id="response-error" class="query-response">
						<h3>הוספת הכרטיס נכשלה</h3>
						<? if($isCorrect['empty']) { ?>
							<div>הפרטים שלהלן חסרים:</div>
							<ul>
								<? foreach($isCorrect['empty'] as $term) {
									if(empty($props[$term]))
										continue;
									?>
									<li><?= $props[$term]['label'] ?></li>
								<? } ?>
							</ul>
						<? } ?>
						<? if($isCorrect['incorrect']) { ?>
							<div>הפרטים שלהלן אינם תקינים:</div>
							<ul>
								<? foreach($isCorrect['incorrect'] as $term) {
									if(empty($props[$term]))
										continue;
									?>
									<li><?= $props[$term]['label'] ?></li>
								<? } ?>
							</ul>
						<? } ?>
					</div>
				<? endif ?>
			</div>
		<? endif ?>
		</div>
	<? endif ?>
	</main>
	<!-- #main -->
	</div><!-- #primary -->

<? get_sidebar() ?>
<? get_footer() ?>