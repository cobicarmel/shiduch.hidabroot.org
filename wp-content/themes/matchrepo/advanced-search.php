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
	<main id="main" class="site-main decorative-border" role="main">
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
			<option value="">הכל</option>
			<? foreach(range(18, 99) as $age) { ?>
				<option><?= $age ?></option>
			<? } ?>
		</select>
		<label for="as-max-age">עד גיל</label>
		<select name="max_age" id="as-max-age">
			<option value="">הכל</option>
			<? foreach(range(18, 99) as $age) { ?>
				<option><?= $age ?></option>
			<? } ?>
		</select>
	</p>
	<h4>מצב משפחתי</h4>

	<p id="as-status">
		<input type="checkbox" id="as-status-all" class="toggle-trigger select-all"
			   data-toggle-key="status" checked>
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
	<h4>ארץ</h4>

	<p>
		<select name="country" class="toggle-trigger switch-trigger" data-compare="in" data-toggle-key="zone"
				data-param="ישראל">
			<option value="">הכל</option>
			<? Matchrepo::listOptions(Cards::$props['country']['options'], null, true) ?>
		</select>
	</p>
	<div class="toggle-affected-group switch-affected" data-affected="zone" style="display: none">
		<h4>אזור מגורים</h4>

		<p>
			<input type="checkbox" id="as-zone-all" class="toggle-trigger select-all"
				   data-toggle-key="zone" checked>
			<label for="as-zone-all">הכל</label>
			<span class="toggle-affected-group" data-check-group="zone">
			<?
			$args = [
				'echo' => false,
				'name' => 'zone',
				'wrapTag' => '',
				'valueByText' => true
			];

			$options = Matchrepo::listCheckboxes(Cards::$props['zone']['options'], $args);

			echo implode('<br>', array_map(function ($i){

				return implode('', $i);
			}, array_chunk($options, 3)));
			?>
			</span>
		</p>
	</div>

	<h4>מוצא עדתי</h4>

	<p>
		<input type="checkbox" id="as-community-all" class="toggle-trigger select-all"
			   data-toggle-key="community" checked>
		<label for="as-community-all">הכל</label>
		<span class="toggle-affected-group" data-check-group="community" data-labels="gender"
			  data-labels-group="community">
			<? Matchrepo::listCheckboxes(Cards::$props['community']['options'], [
				'wrapTag' => '',
				'name' => 'community'
			]) ?>
		</span>
	</p>
	<h4>השקפה</h4>

	<p>
		<input type="checkbox" id="as-concept-all" class="toggle-trigger select-all"
			   data-toggle-key="conception" checked>
		<label for="as-concept-all">הכל</label>
		<span class="toggle-affected-group" data-check-group="conception" data-labels="gender"
			  data-labels-group="conception">
			<? Matchrepo::listCheckboxes(Male::$props['conception']['options'], [
				'wrapTag' => '',
				'name' => 'conception'
			]) ?>
		</span>
	</p>

	<div class="toggle-affected-group" data-show="male" data-hide="female">
		<h4>עיסוק</h4>

		<p>
			<input type="checkbox" id="as-practice-all" class="toggle-trigger select-all"
				   data-toggle-key="practice" checked>
			<label for="as-practice-all">הכל</label>
		<span class="toggle-affected-group" data-check-group="practice">
			<? Matchrepo::listCheckboxes(Male::$props['practice']['options'], [
				'wrapTag' => '',
				'name' => 'practice'
			]) ?>
		</span>
		</p>
	</div>
	<h4>מראה כללי</h4>

	<p>
		<input type="checkbox" id="as-look-all" class="toggle-trigger select-all"
			   data-toggle-key="look" checked>
		<label for="as-look-all">הכל</label>
		<span class="toggle-affected-group" data-check-group="look">
			<? Matchrepo::listCheckboxes(Cards::$props['look']['options'], ['wrapTag' => '', 'name' => 'look']) ?>
		</span>
	</p>
	<h4>גוון עור</h4>

	<p>
		<input type="checkbox" id="as-skin-all" class="toggle-trigger select-all"
			   data-toggle-key="skin" checked>
		<label for="as-skin-all">הכל</label>
		<span class="toggle-affected-group" data-check-group="skin">
			<? Matchrepo::listCheckboxes(Cards::$props['skin']['options'], ['wrapTag' => '', 'name' => 'skin']) ?>
		</span>
	</p>

	<div class="toggle-affected-group" data-show="male" data-hide="female">
		<h4>זקן</h4>

		<p>
			<input type="checkbox" id="as-beard-all" class="toggle-trigger select-all"
				   data-toggle-key="beard" checked>
			<label for="as-beard-all">הכל</label>
			<span class="toggle-affected-group" data-check-group="beard">
				<? Matchrepo::listCheckboxes(Male::$props['beard']['options'], ['wrapTag' => '', 'name' => 'beard']) ?>
			</span>
		</p>
	</div>
	<div class="toggle-affected-group" data-show="male" data-hide="female">
		<h4>מעוניין ב-</h4>

		<p>
			<label for="cf-looking_for_cover">כיסוי ראש</label>
			<select id="cf-looking_for_cover" name="looking_for_cover">
				<option></option>
				<? Matchrepo::listOptions(Male::$props['looking_for_cover']['options']) ?>
			</select>
		</p>
	</div>
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
				   data-toggle-key="cover" checked>
			<label for="as-cover-all">הכל</label>
			<span class="toggle-affected-group" data-check-group="cover">
				<? Matchrepo::listCheckboxes(Female::$props['cover']['options'], [
					'wrapTag' => '',
					'name' => 'cover'
				]) ?>
			</span>
		</p>
	</div>
	<div class="toggle-affected-group" data-show="male" data-hide="female">
		<h4>עישון</h4>

		<p>
			<input name="smoke" id="as-smoke" type="checkbox" value="0">
			<label for="as-smoke">לא מעשן</label>
		</p>
	</div>
	<div>
		<h4>
			<label for="cf-healthy">מצב בריאותי</label>
		</h4>

		<p>
			<select id="cf-healthy" class="toggle-trigger switch-trigger" data-toggle-key="healthy"
					name="healthy" data-compare="!=" data-param="0">
				<option value="">הכל</option>
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
			<? Matchrepo::listCheckboxes(Cards::$props['disability_details']['options'], [
				'wrapTag' => 'span',
				'name' => 'disability_details'
			]) ?>
		</p>
	</div>

	<? if(is_user_logged_in()) { ?>
		<div>
			<h4>
				<label for="cf-ns">מרחב חיפוש</label>
			</h4>

			<p>
				<select id="cf-ns" name="search-ns">
					<option value="0">כל הכרטיסים</option>
					<option value="1">כרטיסים שלי</option>
				</select>
			</p>
		</div>
	<? } ?>
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