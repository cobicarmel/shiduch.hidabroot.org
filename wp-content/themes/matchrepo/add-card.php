<?

/*
Template Name: הוספת כרטיס
*/

Matchrepo::redirect_not_logged();

Matchrepo::mainFormHeader();

$level = 1;

if(isset($_POST['gender'])){
	$level = 2;
	$gender = $_POST['gender'];

	add_action('wp_enqueue_scripts', function(){
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('add-card');
		wp_enqueue_style('jquery-ui');
	});
}

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

	<? if($level == 1) : ?>

		<h2 id="main-title">פתיחת כרטיס אישי</h2>
		<form id="main-form" method="post">
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

	<? elseif($level == 2) : ?>

		<div id="main-form-background">
			<h2 id="main-title">הוספת כרטיס למאגר</h2>

			<form id="main-form" method="post">

				<div id="as-options">
					<div class="label-top">
						<label for="nc-first-name"></label>
						<input id="nc-first-name" type="text" name="first_name" required>
					</div>
					<div class="label-top">
						<label for="nc-birthday"></label>
						<input id="nc-birthday" type="text" name="birthday" required>
					</div>
					<div class="label-top">
						<label for="nc-status">מצב משפחתי</label>
						<select id="nc-status" name="status" required>

						</select>
					</div>


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
								<?
								$zones = Cards::$props['zone']['options'];
								$itemsPerLine = 3;
								$itemsCounter = 0;

								foreach($zones as $i => $zone){
									?>

									<input name="zone[]" type="checkbox" id="as-zone<?= $i ?>" value="<?= $zone ?>">
									<label for="as-zone<?= $i ?>"><?= $zone ?></label>
									<?
									if(++$itemsCounter == $itemsPerLine){
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

								foreach($communities as $i => $community){
									?>
									<input name="community[]" type="checkbox" id="as-community<?= $i ?>"
										   value="<?= $i ?>">
									<label for="as-community<?= $i ?>"><?= $community ?></label>
								<? } ?>
						</span>
					</p>
					<h4>השקפה</h4>

					<p>
						<input type="checkbox" id="as-concept-all" class="toggle-trigger select-all"
							   data-toggle-key="concept">
						<label for="as-concept-all">הכל</label>
						<span class="toggle-affected-group" data-check-group="concept" data-labels="gender"
							  data-labels-group="concept">
							<?
							$concepts = Cards::$props['conception']['options'];

							foreach($concepts as $i => $concept){
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
							<? foreach(range(120, 210) as $height){ ?>
								<option><?= $height ?></option>
							<? } ?>
						</select>
						<label for="as-max-height">מקסימום</label>
						<select name="max_height" id="as-max-height">
							<option></option>
							<? foreach(range(120, 210) as $height){ ?>
								<option><?= $height ?></option>
							<? } ?>
						</select>
					</p>
					<div class="toggle-affected-group" data-show="female" data-hide="male"
						 style="display: none">
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
		</div>
	<? endif ?>
	</main>
	<!-- #main -->
</div><!-- #primary -->

<? get_sidebar() ?>
<? get_footer() ?>