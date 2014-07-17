<?
$arr_post = (array) $post;

$gender = CardHelpers::get_gender($arr_post);

/* @var Cards $MCard */

$MCard = new $gender($arr_post);

$meta = $MCard -> get_meta();
?>

<form id="main-form" method="post">

	<div id="mf-options">
		<div class="row">
			<div class="label-top w33">
				<label for="cf-first-name">שם פרטי</label>
				<input id="cf-first-name" type="text" name="title" value="<? the_title() ?>" required>
			</div>
			<div class="label-top w33">
				<label for="cf-birthday">תאריך לידה</label>
				<input id="cf-birthday" type="text" name="birthday" value="<?= $meta['birthday'] ?>" required>
			</div>
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
				<select id="cf-children" name="children">
					<? foreach(range(0, 20) as $number){ ?>
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
					<? foreach($props['zone']['options'] as $zone){ ?>
						<option><?= $zone ?></option>
					<? } ?>
				</select>
			</div>
			<div class="label-top w33">
				<label for="cf-city">עיר מגורים</label>
				<select id="cf-city" name="city" required>
					<option></option>
					<? foreach($props['city']['options'] as $city){ ?>
						<option><?= $city ?></option>
					<? } ?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="label-top w25">
				<label for="cf-community">מוצא עדתי</label>
				<select id="cf-community" name="community" required>
					<option></option>
					<? $communities = $props['community']['options']; ?>
					<option value="0"><?= $communities[0] ?></option>
					<option value="1"><?= $communities[1] ?></option>
					<option value="2"><?= $communities[2] ?></option>
				</select>
			</div>
			<div class="label-top w25">
				<label for="cf-conception">השקפה</label>
				<select id="cf-conception" class="toggle-trigger hasidism-trigger" name="conception" required>
					<option></option>
					<? $conceptions = $props['conception']['options']; ?>
					<option value="0"><?= $conceptions[0] ?></option>
					<option value="1"><?= $conceptions[1] ?></option>
					<option value="2"><?= $conceptions[2] ?></option>
				</select>
			</div>
			<div class="label-top w25 toggle-affected hasidism-affected" style="display: none">
				<label for="cf-hasidism">חסידות</label>
				<select id="cf-hasidism" name="hasidism" required>
					<option></option>
					<? foreach($props['hasidism']['options'] as $hasidut){ ?>
						<option><?= $hasidut ?></option>
					<? } ?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="label-top w33">
				<label for="cf-work">מקום לימודים/עיסוק כיום</label>
				<input id="cf-work" type="text" name="work" required>
			</div>
			<div class="label-top w33">
				<label for="cf-college">לימודים בעבר</label>
				<input id="cf-college" type="text" name="college" required>
			</div>
		</div>
		<div class="row">
			<div class="label-top w33">
				<label for="cf-father-work">עיסוק האב</label>
				<input id="cf-father-work" type="text" name="father_work" required>
			</div>
			<div class="label-top w33">
				<label for="cf-mother-work">עיסוק האם</label>
				<input id="cf-mother-work" type="text" name="mother_work" required>
			</div>
		</div>
		<div class="row">
			<div class="label-top w16">
				<label for="cf-height">גובה</label>
				<select id="cf-height" name="height" required>
					<option></option>
					<? foreach(range(120, 210) as $height){ ?>
						<option><?= $height ?></option>
					<? } ?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="label-top w33">
				<label for="cf-look">מראה כללי</label>
				<select id="cf-look" name="look">
					<option></option>
					<? foreach($props['look']['options'] as $i => $look){ ?>
						<option value="<?= $i ?>"><?= $look ?></option>
					<? } ?>
				</select>
			</div>
		</div>
		<div class="row">
			<? if($gender){ ?>
				<div class="label-top w25">
					<label for="cf-cover">כיסוי ראש</label>
					<select id="cf-cover" name="cover">
						<option></option>
						<? foreach($props['cover']['options'] as $i => $cover){ ?>
							<option value="<?= $i ?>"><?= $cover ?></option>
						<? } ?>
					</select>
				</div>
			<?
			}
			else{
				?>
				<div class="w25">
					<input type="checkbox" id="cf-smoke" name="smoke">
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
					<? foreach($props['healthy']['options'] as $i => $healthy){ ?>
						<option value="<?= $i ?>"><?= $healthy ?></option>
					<? } ?>
				</select>
			</div>
		</div>
		<div class="row">
			<div id="cf-disability" class="toggle-affected show-hide-affected" data-affected="healthy">
				<div>פירוט מוגבלות</div>
				<? foreach($props['disability_details']['options'] as $i => $disability){ ?>
					<div>
						<input type="checkbox" name="disability_details[]" id="cf-disability<?= $i ?>"
							   value="<?= $i ?>">
						<label for="cf-disability<?= $i ?>"><?= $disability ?></label>
					</div>
				<? } ?>
				<div>
					<input type="checkbox" id="cf-disability-other">
					<label for="cf-disability-other">אחר - נא לפרט:</label>
					<textarea name="disability_details[]"></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<label for="cf-content"><?= $labels['Little_About_The_Candidate'] ?>:</label>
			<textarea id="cf-content" name="content" required></textarea>
		</div>
	</div>
	<div id="submit">
		<input type="submit" value="הוספת כרטיס">
	</div>
</form>