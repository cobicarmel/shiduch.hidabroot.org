<?
$arr_post = (array) $post;

$gender = CardHelpers::get_gender($arr_post);

/* @var Cards $MCard */

$MCard = new $gender($arr_post);

$meta = $MCard ->get_meta();

$props = $gender::$props;
?>

<form id="main-form" method="post">
	<input type="hidden" name="gender" value="<?= $gender == 'male' ? 0 : 1 ?>">

	<div id="mf-options">
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
					<option></option>
					<? Matchrepo::listOptions($props['status']['options'], $meta['status']) ?>
				</select>
			</div>
			<div class="label-top w16 toggle-affected show-hide-affected"
				 data-affected="children"<?= $meta['status'] ? '' : ' style="display: none"' ?>>
				<label for="cf-children">מספר ילדים</label>
				<select id="cf-children" name="children">
					<? foreach(range(0, 20) as $number) { ?>
						<option><?= $number ?></option>
					<? } ?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="label-top w33">
				<label for="cf-country">ארץ</label>
				<select id="cf-country" name="country" required>
					<option>ישראל</option>
				</select>
			</div>
			<div class="label-top w33">
				<label for="cf-zone">איזור מגורים</label>
				<select id="cf-zone" name="zone" required>
					<option></option>
					<? Matchrepo::listOptions($props['zone']['options'], $meta['zone'], true) ?>
				</select>
			</div>
			<div class="label-top w33">
				<label for="cf-city">עיר מגורים</label>
				<select id="cf-city" name="city" required>
					<option></option>
					<? Matchrepo::listOptions($props['city']['options'], $meta['city'], true) ?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="label-top w25">
				<label for="cf-community">מוצא עדתי</label>
				<select id="cf-community" name="community" required>
					<option></option>
					<? Matchrepo::listOptions($props['community']['options'], $meta['community']) ?>
				</select>
			</div>
			<div class="label-top w25">
				<label for="cf-conception">השקפה</label>
				<select id="cf-conception" class="toggle-trigger hasidism-trigger" name="conception" required>
					<option></option>
					<? Matchrepo::listOptions($props['conception']['options'], $meta['conception']) ?>
				</select>
			</div>
			<div
				class="label-top w25 toggle-affected hasidism-affected"<?= $meta['conception'] != 2 ? ' style="display: none"' : '' ?>>
				<label for="cf-hasidism">חסידות</label>
				<select id="cf-hasidism" name="hasidism" required<?= $meta['conception'] != 2 ? ' disabled' : '' ?>>
					<option></option>
					<? Matchrepo::listOptions($props['hasidism']['options'], $meta['hasidism'], true) ?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="label-top w33">
				<label for="cf-work">מקום לימודים/עיסוק כיום</label>
				<input id="cf-work" type="text" name="work" value="<?= $meta['work'] ?>" required>
			</div>
			<div class="label-top w33">
				<label for="cf-college">לימודים בעבר</label>
				<input id="cf-college" type="text" name="college" value="<?= $meta['college'] ?>" required>
			</div>
		</div>
		<div class="row">
			<div class="label-top w33">
				<label for="cf-father-work">עיסוק האב</label>
				<input id="cf-father-work" type="text" name="father_work" value="<?= $meta['father_work'] ?>" required>
			</div>
			<div class="label-top w33">
				<label for="cf-mother-work">עיסוק האם</label>
				<input id="cf-mother-work" type="text" name="mother_work" value="<?= $meta['mother_work'] ?>" required>
			</div>
		</div>
		<div class="row">
			<div class="label-top w16">
				<label for="cf-height">גובה</label>
				<select id="cf-height" name="height" required>
					<option></option>
					<? Matchrepo::listOptions(range(120, 210), $meta['height'], true) ?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="label-top w33">
				<label for="cf-look">מראה כללי</label>
				<select id="cf-look" name="look">
					<option></option>
					<? Matchrepo::listOptions($props['look']['options'], $meta['look']) ?>
				</select>
			</div>
		</div>
		<div class="row">
			<? if($gender == 'female') { ?>
				<div class="label-top w25">
					<label for="cf-cover">כיסוי ראש</label>
					<select id="cf-cover" name="cover">
						<option></option>
						<? Matchrepo::listOptions($props['cover']['options'], $meta['cover']) ?>
					</select>
				</div>
			<?
			}
			else {
				?>
				<div class="w25">
					<input type="checkbox" id="cf-smoke" name="smoke" value="1" <? checked($meta['smoke']) ?>>
					<label for="cf-smoke">מעשן</label>
				</div>
			<? } ?>
		</div>
		<div class="row">
			<div class="label-top w33">
				<label for="cf-healthy">מצב בריאותי</label>
				<select id="cf-healthy" class="toggle-trigger show-hide-trigger" data-toggle-key="healthy"
						name="healthy">
					<option></option>
					<? Matchrepo::listOptions($props['healthy']['options'], $meta['healthy']) ?>
				</select>
			</div>
		</div>
		<div class="row">
			<div id="cf-disability" class="toggle-affected show-hide-affected"
				 data-affected="healthy"<?= $meta['healthy'] ? : ' style="display: none"' ?>>
				<div>פירוט מוגבלות</div>
				<?

				$options = ['id' => 'cf-disability', 'name' => 'disability_details', 'compare' => $meta['disability_details']];

				Matchrepo::listCheckboxes($props['disability_details']['options'], $options);

				?>
				<div>
					<input type="checkbox" id="cf-disability-other">
					<label for="cf-disability-other">אחר - נא לפרט:</label>
					<textarea id="cf-disability-other"
							  name="other_disability"><?= $meta['other_disability'] ?></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<label for="cf-content"><?= $MCard::$labels['Little_About_The_Candidate'] ?>:</label>
			<textarea id="cf-content" name="content" required><?= strip_tags(get_the_content()) ?></textarea>
		</div>
	</div>
	<div id="submit">
		<input type="submit" value="שמירת שינויים">
	</div>
</form>