<?
$arr_post = (array) $post;

$gender = CardHelpers::get_gender($arr_post);

/* @var Cards $MCard */

$MCard = new $gender($arr_post);

$meta = $MCard->get_meta();

$props = $MCard::$props;
?>

<form id="main-form" method="post">
<input type="hidden" name="gender" value="<?= $gender == 'male' ? 0 : 1 ?>">

<div id="mf-options">
<fieldset>
	<legend>פרטים בסיסיים</legend>
	<div class="row">
		<div class="label-top w33">
			<label for="cf-first-name">שם פרטי</label>
			<input id="cf-first-name" type="text" name="title" value="<? the_title() ?>" required>
		</div>
		<div class="label-top w33">
			<label for="cf-birthday">תאריך לידה</label>
			<input id="cf-birthday" type="text" name="birthday"
				   value="<?= date('d/m/Y', strtotime($meta['birthday'])) ?>" required>
		</div>
		<div class="label-top w16">
			<label for="cf-status">מצב משפחתי</label>
			<select id="cf-status" class="toggle-trigger show-hide-trigger" name="status"
					data-toggle-key="children" required>
				<? Matchrepo::listOptions($props['status']['options'], $meta['status']) ?>
			</select>
		</div>
		<div class="label-top w16 toggle-affected show-hide-affected"
			 data-affected="children"<?= $meta['status'] ? '' : ' style="display: none"' ?>>
			<label for="cf-children">מספר ילדים</label>
			<select id="cf-children" name="children">
				<? Matchrepo::listOptions(range(0, 20), $meta['children']) ?>
			</select>
		</div>
	</div>
</fieldset>
<fieldset>
	<legend>מקום מגורים</legend>
	<div class="row">
		<div class="label-top w33">
			<label for="cf-country">ארץ</label>
			<select id="cf-country" name="country" class="toggle-trigger zone-trigger" required>
				<? Matchrepo::listOptions($props['country']['options'], $meta['country'], true) ?>
			</select>
		</div>
		<? $style = $meta['country'] == 'ישראל' ? : 'style="display: none"' ?>
		<div class="label-top w33 toggle-affected zone-affected"<?= $style ?>>
			<label for="cf-zone">איזור מגורים</label>
			<select id="cf-zone" name="zone" required>
				<? Matchrepo::listOptions($props['zone']['options'], $meta['zone'], true) ?>
			</select>
		</div>
	</div>
</fieldset>
<fieldset>
	<legend>מוצא</legend>
	<div class="row">
		<div class="label-top w33">
			<label for="cf-community">מוצא עדתי</label>
			<select id="cf-community" name="community" required>
				<? Matchrepo::listOptions($props['community']['options'], $meta['community']) ?>
			</select>
		</div>
		<div class="label-top w33">
			<label for="cf-conception">השקפה</label>
			<select id="cf-conception" class="toggle-trigger hasidism-trigger" name="conception" required>
				<? Matchrepo::listOptions($props['conception']['options'], $meta['conception']) ?>
			</select>
		</div>
		<div
			class="label-top w33 toggle-affected hasidism-affected"<?= $meta['conception'] != 2 ? ' style="display: none"' : '' ?>>
			<label for="cf-hasidism">חסידות</label>
			<select id="cf-hasidism" name="hasidism" required<?= $meta['conception'] != 2 ? ' disabled' : '' ?>>

				<? Matchrepo::listOptions($props['hasidism']['options'], $meta['hasidism'], true) ?>
			</select>
		</div>
	</div>
</fieldset>
<fieldset>
	<legend>משפחה</legend>
	<div class="row">
		<div class="label-top w33">
			<label for="cf-father_community">מוצא האב</label>
			<select id="cf-father_community" name="father_community">
				<option></option>
				<? Matchrepo::listOptions(Male::$props['community']['options'], $meta['father_community']) ?>
			</select>
		</div>
		<div class="label-top w33">
			<label for="cf-mother_community">מוצא האם</label>
			<select id="cf-mother_community" name="mother_community">
				<option></option>
				<? Matchrepo::listOptions(Female::$props['community']['options'], $meta['mother_community']) ?>
			</select>
		</div>
	</div>
</fieldset>
<fieldset>
	<legend>מראה</legend>
	<div class="row">
		<div class="label-top w16">
			<label for="cf-height">גובה</label>
			<select id="cf-height" name="height" required>

				<? Matchrepo::listOptions(range(120, 210), $meta['height'], true) ?>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="label-top w33">
			<label for="cf-look">מראה כללי</label>
			<select id="cf-look" name="look">

				<? Matchrepo::listOptions($props['look']['options'], $meta['look']) ?>
			</select>
		</div>
		<div class="label-top w33">
			<label for="cf-skin">גוון עור</label>
			<select id="cf-skin" name="skin">
				<? Matchrepo::listOptions($props['skin']['options'], $meta['skin']) ?>
			</select>
		</div>
		<? if($gender == 'male') { ?>
			<div class="label-top w25">
				<label for="cf-beard">זקן</label>
				<select id="cf-beard" name="beard" required>
					<option></option>
					<? Matchrepo::listOptions($props['beard']['options'], $meta['beard']) ?>
				</select>
			</div>
		<? } ?>
	</div>
</fieldset>
<fieldset>
	<legend>מצב בריאותי</legend>
	<div class="row">
		<div class="label-top w33">
			<label for="cf-healthy">מצב בריאותי</label>
			<select id="cf-healthy" class="toggle-trigger show-hide-trigger" data-toggle-key="healthy"
					name="healthy">

				<? Matchrepo::listOptions($props['healthy']['options'], $meta['healthy']) ?>
			</select>
		</div>
	</div>
	<div class="row">
		<div id="cf-disability" class="toggle-affected show-hide-affected"
			 data-affected="healthy"<?= $meta['healthy'] ? : ' style="display: none"' ?>>
			<div>פירוט מוגבלות</div>
			<?

			$options = [
				'id' => 'cf-disability',
				'name' => 'disability_details',
				'compare' => $meta['disability_details']
			];

			Matchrepo::listCheckboxes($props['disability_details']['options'], $options);

			?>
			<div>
				<label for="cf-disability-other">אחר - נא לפרט:</label>
				<textarea id="cf-disability-other"
						  name="other_disability"><?= $meta['other_disability'] ?></textarea>
			</div>
		</div>
	</div>
</fieldset>
<?
if($gender == 'male') {
	?>
	<fieldset>
		<legend>מעוניין ב-</legend>
		<div class="row">
			<div class="label-top">
				<label for="cf-looking_for_cover">כיסוי ראש</label>
				<select id="cf-looking_for_cover" name="looking_for_cover">
					<option></option>
					<? Matchrepo::listOptions($props['looking_for_cover']['options'], $meta['looking_for_cover']) ?>
				</select>
			</div>
		</div>
	</fieldset>
<?
}
?>
<fieldset>
	<legend>שונות</legend>
	<div>
		<? if($gender == 'female') { ?>
			<div class="label-top w25">
				<label for="cf-cover">כיסוי ראש</label>
				<select id="cf-cover" name="cover">

					<? Matchrepo::listOptions($props['cover']['options'], $meta['cover']) ?>
				</select>
			</div>
		<?
		}
		else {
			?>
			<div>
				<input type="checkbox" id="cf-smoke" name="smoke" value="1" <? checked($meta['smoke']) ?>>
				<label for="cf-smoke">מעשן</label>
			</div>
			<div>
				<input type="checkbox" id="cf-license" name="license" value="1" <? checked($meta['license']) ?>>
				<label for="cf-license">בעל רשיון נהיגה</label>
			</div>
		<? } ?>
	</div>
</fieldset>
<div class="row">
	<label for="cf-content"><?= $MCard::$labels['Little_About_The_Candidate'] ?>:</label>
	<textarea id="cf-content" name="content" required><?= strip_tags(get_the_content()) ?></textarea>
</div>
<div id="private-area">
	<h2>אזור אישי</h2>
	<h5>הפרטים שלהלן יהיו גלויים רק לך ולצוות האתר:</h5>
	<fieldset>
		<legend>משפחה</legend>
		<div class="row">
			<div class="label-top w33">
				<label for="cf-last-name">שם משפחה</label>
				<input id="cf-last-name" type="text" name="last_name" value="<?= $meta['last_name'] ?>">
			</div>
		</div>
		<div class="row">
			<div class="label-top w33">
				<label for="cf-family-children">מספר ילדים במשפחה</label>
				<input id="cf-family-children" type="number" min="0" max="20" name="family_children"
					   value="<?= $meta['family_children'] ?>">
			</div>
		</div>
		<div class="row">
			<div class="label-top w33">
				<label for="cf-father-name">שם האב</label>
				<input id="cf-father-name" type="text" name="father_name" value="<?= $meta['father_name'] ?>">
			</div>
			<div class="label-top w33">
				<label for="cf-mother-name">שם האם</label>
				<input id="cf-mother-name" type="text" name="mother_name" value="<?= $meta['mother_name'] ?>">
			</div>
		</div>
		<div class="row">
			<div class="label-top w33">
				<label for="cf-father-work">עיסוק האב</label>
				<input id="cf-father-work" type="text" name="father_work" value="<?= $meta['father_work'] ?>">
			</div>
			<div class="label-top w33">
				<label for="cf-mother-work">עיסוק האם</label>
				<input id="cf-mother-work" type="text" name="mother_work" value="<?= $meta['mother_work'] ?>">
			</div>
		</div>
	</fieldset>
	<fieldset>
		<legend>לימודים</legend>
		<div class="row">
			<? if($gender == 'female') { ?>
				<div class="label-top w33">
					<label for="cf-college">סמינר</label>
					<input id="cf-college" type="text" name="college" value="<?= $meta['college'] ?>">
				</div>
			<?
			}
			else {
				?>
				<div class="label-top w33">
					<label for="cf-yeshiva_k">ישיבה קטנה</label>
					<input id="cf-yeshiva_k" type="text" name="yeshiva_k" value="<?= $meta['yeshiva_k'] ?>">
				</div>
				<div class="label-top w33">
					<label for="cf-yeshiva_g">ישיבה גדולה</label>
					<input id="cf-yeshiva_g" type="text" name="yeshiva_g" value="<?= $meta['yeshiva_g'] ?>">
				</div>
			<? } ?>
		</div>
	</fieldset>
	<fieldset>
		<legend>עיסוק</legend>
		<div class="row">
			<? if($gender == 'male') { ?>
				<div class="label-top w33">
					<label for="cf-practice">עיסוק</label>
					<select id="cf-practice" name="practice" required>
						<option></option>
						<? Matchrepo::listOptions($props['practice']['options'], $meta['practice']) ?>
					</select>
				</div>
			<? } ?>
			<div class="label-top w33">
				<label for="cf-work">מקום לימודים/עיסוק כיום</label>
				<input id="cf-work" type="text" name="work" value="<?= $meta['work'] ?>">
			</div>
		</div>
	</fieldset>

	<fieldset>
		<legend>בירורים</legend>
		<? for($i = 0; $i < 5; $i++) {
			$nameValue = ! empty($meta['inquiries'][$i]['name']) ? ' value="' . $meta['inquiries'][$i]['name'] . '"' : null;
			$phoneValue = ! empty($meta['inquiries'][$i]['phone']) ? ' value="' . $meta['inquiries'][$i]['phone'] . '"' : null;
			$notesValue = ! empty($meta['inquiries'][$i]['notes']) ? ' value="' . $meta['inquiries'][$i]['notes'] . '"' : null;
			?>
			<div class="row">
				<div class="label-top w33">
					<label for="inquiries-name-<?= $i ?>">שם</label>
					<input id="inquiries-name-<?= $i ?>" type="text" name="inquiries[<?= $i ?>][name]"<?= $nameValue ?>>
				</div>
				<div class="label-top w33">
					<label for="inquiries-phone-<?= $i ?>">טלפון</label>
					<input id="inquiries-phone-<?= $i ?>" type="tel" name="inquiries[<?= $i ?>][phone]"<?= $phoneValue ?>>
				</div>
				<div class="label-top w33">
					<label for="inquiries-notes-<?= $i ?>">הערות</label>
					<input id="inquiries-notes-<?= $i ?>" type="text" name="inquiries[<?= $i ?>][notes]"<?= $notesValue ?>>
				</div>
			</div>
		<? } ?>
	</fieldset>
</div>

<fieldset>
	<legend>פרטיות</legend>
	<select name="privacy" id="privacy">
		<?
		$options = [
			'הכרטיס גלוי לכולם',
			'הכרטיס גלוי רק לי ולצוות האתר'
		];

		Matchrepo::listOptions($options, $meta['privacy']);
		?>
	</select>
</fieldset>
</div>
<div id="submit">
	<input type="submit" value="שמירת שינויים">
</div>
</form>