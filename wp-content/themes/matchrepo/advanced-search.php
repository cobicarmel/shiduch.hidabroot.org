<?

/*
Template Name: חיפוש מתקדם
*/

Matchrepo::mainFormHeader();

add_action('wp_enqueue_scripts', function (){

	wp_enqueue_script('advanced-search');
});

get_header();
?>

	<div id="primary" class="content-area decorative">
	<main id="main" class="site-main" role="main">
	<h2 id="main-title">חיפוש מתקדם</h2>

	<form id="main-form" class="search-form"
		  action="<?= get_page_link(get_page_by_title('תוצאות חיפוש')) ?>">
	<div id="choose-gender" class="toggle-trigger labels-replace-trigger" data-toggle-key="gender">
		<div>
			<img src="<?= get_stylesheet_directory_uri() . '/media/male-main.png' ?>">
			<input name="gender" value="0" type="radio" id="option-male"
				   class="toggle-trigger show-hide-trigger" data-toggle-key="male" checked>
			<label for="option-male">חיפוש גבר</label>
		</div>
		<div>
			<img src="<?= get_stylesheet_directory_uri() . '/media/female-main.png' ?>">
			<input name="gender" value="1" type="radio" id="option-female"
				   class="toggle-trigger show-hide-trigger" data-toggle-key="female">
			<label for="option-female">חיפוש אישה</label>
		</div>
	</div>
	<div id="mf-options">
	<h4>טווח גילאים</h4>

	<p>
		<label for="as-min-age">מגיל</label>
		<select name="min_age" id="as-min-age">
			<option></option>
			<? foreach(range(18, 99) as $age) { ?>
				<option><?= $age ?></option>
			<? } ?>
		</select>
		<label for="as-max-age">עד גיל</label>
		<select name="max_age" id="as-max-age">
			<option></option>
			<? foreach(range(18, 99) as $age) { ?>
				<option><?= $age ?></option>
			<? } ?>
		</select>
	</p>
	<h4>מצב משפחתי</h4>

	<p id="as-status">
		<input type="checkbox" id="as-status-all" class="toggle-trigger select-all"
			   data-toggle-key="status">
		<label for="as-status-all">הכל</label>
					<span class="toggle-affected-group" data-check-group="status" data-labels="gender"
						  data-labels-group="status">
						<input name="status[]" type="checkbox" id="as-single" value="0">
						<label for="as-single">רווק</label>
						<input name="status[]" type="checkbox" id="as-divorcee" class="maybe-children" value="1">
						<label for="as-divorcee">גרוש</label>
						<br>
						<input name="status[]" type="checkbox" id="as-widow" class="maybe-children" value="2">
						<label for="as-widow">אלמן</label>
					</span>
					<span id="as-children-container" style="display: none">
						<label for="as-children">מקסימום ילדים</label>
						<select id="as-children" name="children" disabled>
							<? foreach(range(0, 20) as $number) { ?>
								<option><?= $number ?></option>
							<? } ?>
						</select>
					</span>
	</p>
	<h4>אזור מגורים</h4>

	<p>
		<input type="checkbox" id="as-zone-all" class="toggle-trigger select-all"
			   data-toggle-key="zone">
		<label for="as-zone-all">הכל</label>
					<span class="toggle-affected-group" data-check-group="zone">
						<input type="checkbox" id="as-zone-il" class="toggle-trigger select-all"
							   data-toggle-key="israel">
						<label for="as-zone-il">ישראל</label>
						<input type="checkbox" id="as-zone-os">
						<label for="as-zone-os">חו"ל</label>
						<br>
						<span class="toggle-affected-group" data-check-group="israel">
							<?
							$zones = Cards::$props['zone']['options'];
							$itemsPerLine = 3;
							$itemsCounter = 0;

							foreach($zones as $i => $zone) {
								?>

								<input name="zone[]" type="checkbox" id="as-zone<?= $i ?>" value="<?= $zone ?>">
								<label for="as-zone<?= $i ?>"><?= $zone ?></label>
								<?
								if(++$itemsCounter == $itemsPerLine) {
									echo '<br>';
									$itemsCounter = 0;
								}
							}?>
						</span>
					</span>
	</p>
	<h4>מוצא עדתי</h4>

	<p>
		<input type="checkbox" id="as-community-all" class="toggle-trigger select-all"
			   data-toggle-key="community">
		<label for="as-community-all">הכל</label>
					<span class="toggle-affected-group" data-check-group="community" data-labels="gender"
						  data-labels-group="community">
							<?
							$communities = Cards::$props['community']['options'];

							foreach($communities as $i => $community) {
								?>
								<input name="community[]" type="checkbox" id="as-community<?= $i ?>" value="<?= $i ?>">
								<label for="as-community<?= $i ?>"><?= $community ?></label>
							<? } ?>
					</span>
	</p>
	<h4>השקפה</h4>

	<p>
		<input type="checkbox" id="as-concept-all" class="toggle-trigger select-all"
			   data-toggle-key="conception">
		<label for="as-concept-all">הכל</label>
					<span class="toggle-affected-group" data-check-group="conception" data-labels="gender"
						  data-labels-group="conception">
						<?
						$concepts = Cards::$props['conception']['options'];

						foreach($concepts as $i => $concept) {
							?>
							<input name="conception[]" type="checkbox" id="as-concept<?= $i ?>" value="<?= $i ?>">
							<label for="as-concept<?= $i ?>"><?= $concept ?></label>
						<? } ?>
					</span>
	</p>
	<h4>מראה כללי</h4>

	<p>
		<input type="checkbox" id="as-look-all" class="toggle-trigger select-all"
			   data-toggle-key="look">
		<label for="as-look-all">הכל</label>
					<span class="toggle-affected-group" data-check-group="look">
						<input name="look[]" type="checkbox" id="as-look0" value="0">
						<label for="as-look0">מבנה רזה</label>
						<input name="look[]" type="checkbox" id="as-look1" value="1">
						<label for="as-look1">מבנה בינוני</label>
						<input name="look[]" type="checkbox" id="as-look2" value="2">
						<label for="as-look2">מבנה מלא</label>
					</span>
	</p>
	<h4>גובה</h4>

	<p>
		<label for="as-min-height">מינימום</label>
		<select name="min_height" id="as-min-height">
			<option></option>
			<? foreach(range(120, 210) as $height) { ?>
				<option><?= $height ?></option>
			<? } ?>
		</select>
		<label for="as-max-height">מקסימום</label>
		<select name="max_height" id="as-max-height">
			<option></option>
			<? foreach(range(120, 210) as $height) { ?>
				<option><?= $height ?></option>
			<? } ?>
		</select>
	</p>
	<div class="toggle-affected-group" data-show="female" data-hide="male" style="display: none">
		<h4>כיסוי ראש</h4>

		<p>
			<input type="checkbox" id="as-cover-all" class="toggle-trigger select-all"
				   data-toggle-key="cover">
			<label for="as-cover-all">הכל</label>
						<span class="toggle-affected-group" data-check-group="cover">
							<input name="cover[]" type="checkbox" id="as-cover0">
							<label for="as-cover0">מטפחת</label>
							<input name="cover[]" type="checkbox" id="as-cover1">
							<label for="as-cover1">פאה</label>
							<input name="cover[]" type="checkbox" id="as-cover2">
							<label for="as-cover2">פאה רק בשבתות ואירועים</label>
						</span>
		</p>
	</div>
	<div class="toggle-affected-group" data-show="male" data-hide="female">
		<h4>עישון</h4>

		<p>
			<input name="smoke" id="as-smoke" type="checkbox">
			<label for="as-smoke">לא מעשן</label>
		</p>
	</div>
	<div>
		<h4>
			<label for="cf-healthy">מצב בריאותי</label>
		</h4>

		<p>
			<select id="cf-healthy" class="toggle-trigger switch-trigger" data-toggle-key="healthy"
					name="healthy">
				<option></option>
				<? foreach(Cards::$props['healthy']['options'] as $i => $healthy) { ?>
					<option value="<?= $i ?>"><?= $healthy ?></option>
				<? } ?>
			</select>
		</p>
	</div>

	<div id="cf-disability" class="toggle-affected-group switch-affected" data-affected="healthy"
		 style="display: none">
		<h4>פירוט מוגבלות</h4>

		<p>
			<? foreach(Cards::$props['disability_details']['options'] as $i => $disability) { ?>
				<span>
					<input type="checkbox" name="disability_details[]" id="cf-disability<?= $i ?>"
						   value="<?= $i ?>">
					<label for="cf-disability<?= $i ?>"><?= $disability ?></label>
				</span>
			<? } ?>
		</p>
	</div>
	</div>
	<div id="submit">
		<input type="submit" value="<? _e('Search') ?>">
	</div>
	</form>
	</main>
	<!-- #main -->
	</div><!-- #primary -->

<? get_sidebar(); ?>
<? get_footer(); ?>