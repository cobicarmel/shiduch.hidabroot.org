<?

/*
Template Name: חיפוש מתקדם
*/

wp_register_style('advanced-search', get_stylesheet_directory_uri() . '/css/advanced-search.css');

wp_enqueue_style('advanced-search');

wp_register_script('advanced-search', get_stylesheet_directory_uri() . '/js/advanced-search.js', ['main-script'], '', true);

wp_enqueue_script('advanced-search');

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<form id="advanced-search" class="search-form" action="<?= get_page_link(get_page_by_title('תוצאות חיפוש') ->ID) ?>">
				<div id="choose-gender" class="toggle-trigger labels-replace-trigger" data-toggle-key="gender">
					<div>
						<img src="<?= get_stylesheet_directory_uri() . '/media/male-main.png' ?>">
						<input name="gender" value="male" type="radio" id="option-male"
							   class="toggle-trigger show-hide-trigger" data-toggle-key="male" checked>
						<label for="option-male">חיפוש גבר</label>
					</div>
					<div>
						<img src="<?= get_stylesheet_directory_uri() . '/media/female-main.png' ?>">
						<input name="gender" value="female" type="radio" id="option-female"
							   class="toggle-trigger show-hide-trigger" data-toggle-key="female">
						<label for="option-female">חיפוש אישה</label>
					</div>
				</div>
				<div id="as-options">
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
							<? foreach(range(0, 20) as $number){ ?>
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
							<input name="zone[]" type="checkbox" id="as-zone1" value="1">
							<label for="as-zone1">אזור הצפון</label>
							<input name="zone[]" type="checkbox" id="as-zone2" value="2">
							<label for="as-zone2">אזור המרכז</label>
							<input name="zone[]" type="checkbox" id="as-zone3" value="3">
							<label for="as-zone3">אזור השרון והשפלה</label>
							<input name="zone[]" type="checkbox" id="as-zone4" value="4">
							<label for="as-zone4">ירושלים והסביבה</label>
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
						<input name="community[]" type="checkbox" id="as-community0">
						<label for="as-community0">אשכנזי</label>
						<input name="community[]" type="checkbox" id="as-community1">
						<label for="as-community1">ספרדי</label>
						<input name="community[]" type="checkbox" id="as-community2">
						<label for="as-community2">תימני</label>
					</span>
					</p>
					<h4>השקפה</h4>

					<p>
						<input type="checkbox" id="as-concept-all" class="toggle-trigger select-all"
							   data-toggle-key="concept">
						<label for="as-concept-all">הכל</label>
					<span class="toggle-affected-group" data-check-group="concept" data-labels="gender"
						  data-labels-group="concept">
						<input name="concept[]" type="checkbox" id="as-concept0">
						<label for="as-concept0">אשכנזית</label>
						<input name="concept[]" type="checkbox" id="as-concept1">
						<label for="as-concept1">ספרדית</label>
						<input name="concept[]" type="checkbox" id="as-concept2">
						<label for="as-concept2">חסידית</label>
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
						<input name="look[]" type="checkbox" id="as-look2"  value="2">
						<label for="as-look2">מבנה מלא</label>
					</span>
					</p>
					<h4>גובה</h4>
					<p>
						<label for="as-min-height">מינימום</label>
						<select name="min-height" id="as-min-height">
							<option></option>
							<? foreach(range(120, 210) as $height){ ?>
								<option><?= $height ?></option>
							<? } ?>
						</select>
						<label for="as-max-height">מקסימום</label>
						<select name="max-height" id="as-max-height">
							<option></option>
							<? foreach(range(120, 210) as $height){ ?>
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
				</div>
				<div style="text-align: center">
					<input type="submit" value="<? _e('Search') ?>">
				</div>
			</form>
		</main>
		<!-- #main -->
	</div><!-- #primary -->

<? get_sidebar(); ?>
<? get_footer(); ?>