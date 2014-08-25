<?

abstract class Cards {

	protected $card;

	protected $id;

	protected $name;

	protected $meta;

	protected static $formsCount = 0;

	static $props;

	private static $orderTerms = [
		'gender',
		'last_name',
		'age',
		'birthday',
		'status',
		'children',
		'country',
		'zone',
		'community',
		'conception',
		'hasidism',
		'father_name',
		'mother_name',
		'father_community',
		'mother_community',
		'father_work',
		'mother_work',
		'yeshiva_k',
		'yeshiva_g',
		'college',
		'practice',
		'work',
		'height',
		'look',
		'skin',
		'beard',
		'healthy',
		'disability_details',
		'other_disability',
		'smoke',
		'license',
		'cover'
	];

	private static $requiredTerms = [
		'gender',
		'birthday',
		'status',
		'country',
		'community',
		'conception',
		'father_community',
		'mother_community',
		'work',
		'father_work',
		'mother_work',
		'height',
		'look',
		'skin',
		'healthy'
	];

	private static $optionalTerms = [
		'children',
		'smoke',
		'license',
		'cover',
		'beard',
		'yeshiva_k',
		'yeshiva_g',
		'practice',
		'college',
		'disability_details',
		'other_disability',
		'hasidism',
		'zone',
		'last_name',
		'father_name',
		'mother_name'
	];

	public static $user_types = [
		'שדכנית',
		'שדכנית מצווה',
		'הורה',
		'רב',
		'רבנית',
		'בן משפחה של המועמד/ת'
	];

	public $myAccountItems = [
		'age',
		'status',
		'college',
		'height',
		'country',
		'zone',
		'conception',
		'look'
	];

	protected $indexItems = [
		'status',
		'community',
		'conception',
		'father_community',
		'mother_community',
		'look',
		'skin',
		'beard',
		'practice',
		'smoke',
		'license',
		'healthy',
		'disability_details',
		'cover'
	];

	protected $labeledItems = ['age' => 'גיל'];

	function __construct(array $card){

		$this ->card = $card;
		$this ->id = $card['ID'];
		$this ->name = $card['post_title'];
		$this ->getMetaFromDB();
		$this ->set_age();
	}

	protected static function build_form($params, $options = null){

		$defaults = [
			'id' => 'form-' . ++Cards::$formsCount,
			'class' => '',
			'action' => '',
			'method' => 'get',
			'get_search_params' => false
		];

		$options = $options ? array_merge($defaults, $options) : $defaults;

		echo "<form method='$options[method]' action='$options[action]' id='$options[id]' class='$options[class]'>";

		foreach($params as $param) {

			$props = self::$props[$param];

			$searchValue = null;

			if(isset($_GET[$param]))
				$searchValue = $_GET[$param];

			$hasSearch = $searchValue || $searchValue == '0';
			?>

		<div class="form-field form-field-<?= $param ?>">
			<div class="form-label">
				<label><?= $props['label'] ?>:</label>
			</div>
			<div class="form-input">

			<?
			switch($props['type']) {

				case 'text':
					$value = $hasSearch ? " value='$searchValue'" : '';
					echo "<input type='text' name='$param'$value>";
					break;

				case 'select':

					echo "<select name='$param'>";

					echo '<option value="">הכל</option>';

					foreach($props['options'] as $value => $text) {

						if(! empty($props['termByValue']))
							$value = $text;

						$selected = $hasSearch && $searchValue == $value ? " selected='true'" : '';

						echo "<option value='$value'$selected>$text</option>";
					}

					echo '</select>';

					break;

				case 'radio':
					$i = 0;

					foreach($props['options'] as $key => $value) {

						$checked = '';

						if(isset($props['termByValue']) && $props['termByValue'])
							$key = $value;

						if(! $i++ || ($hasSearch && $searchValue == $key))
							$checked = 'checked="checked"';

						echo "<label><input type='radio' name='$param' value='$key' $checked>$value</label>";
					}
			}

			echo '</div></div>';
		}

		echo '<input type="submit" value="' . __('Submit') . '">';

		echo '</form>';
	}

	protected function getMetaFromDB(){

		$stack = [];

		$meta = get_post_meta($this ->id);

		$terms = Cards::getTerms();

		foreach($terms as $term)
			$stack[$term] = isset($meta[$term]) ? maybe_unserialize($meta[$term][0]) : '';

		$this ->meta = $stack;
	}

	protected function set_age(){

		$oldTime = DateTime::createFromFormat('Y-m-d', $this ->meta['birthday']) ->getTimestamp();

		$rangeMS = time() - $oldTime;

		$years = $rangeMS / 3600 / 24 / 365;

		$this ->meta['age'] = floor($years);
	}

	function get_excerpt(){

		$excerpt_items = ['age', 'status'];

		$items = $this ->prepare_display($excerpt_items, false);

		$items['community'] = 'מוצא ' . Cards::$props['community']['options'][$this ->meta['community']];

		return $this ->name . ', ' . implode(', ', $items);
	}

	function list_meta($items = null){

		$meta = $this ->prepare_display($items);

		echo '<ul>';

		foreach($meta as $label => $param) {

			if(! $label)
				continue;

			echo '<li>';

			echo "<span class='meta-label'>$label:</span>";

			echo "<span class='meta-value'>$param</span>";

			echo '</li>';
		}

		echo '</ul>';
	}

	static function quick_search(){

		$args = [
			'gender',
			'min_age',
			'max_age',
			'zone',
			'conception',
			'status'
		];

		$actionPage = get_page_by_title('תוצאות חיפוש');

		$options = [
			'action' => get_page_link($actionPage ->ID),
			'class' => 'search-form',
			'get_search_params' => true
		];

		self::build_form($args, $options);
	}

	function prepare_display($items = null, $withLabels = true){

		$meta = $this ->meta;

		unset($meta['birthday'], $meta['gender']);

		/* preparing optional terms */

		if($meta['conception'] != 2)
			unset($meta['hasidism']);

		if($meta['healthy'] == 0)
			unset($meta['disability_details']);

		if($meta['status'] == 0)
			unset($meta['children']);

		if($meta['country'] != 'ישראל')
			unset($meta['zone']);

		$unsortedKeys = $items ? $items : array_keys($meta);

		$itemsStack = [];

		foreach(self::$orderTerms as $term){
			if(in_array($term, $unsortedKeys))
				$keys[] = $term;
		}

		foreach($keys as $key) {

			if(empty($this::$props[$key]) || ! isset($meta[$key]))
				continue;

			if(! isset($this::$props[$key]['label'])) {
				die($key . ' is incorrect');
			}

			if(isset($this ->labeledItems[$key]))
				$label = $this ->labeledItems[$key];
			else
				$label = $this::$props[$key]['label'];

			$param = null;

			if(in_array($key, $this ->indexItems)) {

				if(is_array($meta[$key])) {

					$param = [];

					foreach($meta[$key] as $k) {
						if(isset($this::$props[$key]['options'][$k]))
							$param[] = $this::$props[$key]['options'][$k];
					}

					if($key == 'disability_details' && ! empty($meta['other_disability']))
						$param[] = $meta['other_disability'];
				}
				elseif($meta[$key] !== '')
					$param = $this::$props[$key]['options'][$meta[$key]];
				else
					$param = current($this::$props[$key]['options']);
			}
			else
				$param = $meta[$key];

			if(is_array($param))
				$param = implode(', ', $param);

			if($withLabels)
				$itemsStack[$label] = $param;
			else
				$itemsStack[$key] = $param;
		}

		return $itemsStack;
	}

	static function validateCardData($data){

		$errors = [
			'empty' => [],
			'incorrect' => []
		];

		$props = self::$props;

		$required = self::$requiredTerms;

		$optionals = self::$optionalTerms;

		array_push($required, 'title', 'content');

		if(! $data['gender'])
			$optionals[] = 'smoke';
		else
			$required[] = 'cover';

		$allTerms = array_merge($required, $optionals);

		foreach($required as $term) {
			if(! isset($data[$term]) || $data[$term] == '')
				$errors['empty'][] = $term;
		}

		foreach($allTerms as $term) {

			if(empty($props[$term]) || ! isset($data[$term]) || in_array($term, $errors['empty']))
				continue;

			$isCorrect = true;

			$prop = $props[$term];

			if(! empty($prop['pattern'])) {
				if(is_callable($prop['pattern']))
					$isCorrect = call_user_func($prop['pattern'], $data[$term]);
				else
					$isCorrect = preg_match($prop['pattern'], $data[$term]);
			}

			if(! $isCorrect)
				$errors['incorrect'][] = $term;
		}

		return $errors['empty'] || $errors['incorrect'] ? $errors : true;
	}

	function advancedSearch(){

		$args = [
			'min_age',
			'max_age',
			'status',
			'children',
			'zone',
			'community',
			'cover',
			'look',
			'healthy'
		];

		self::build_form($args);
	}

	function get_meta(){

		return $this ->meta;
	}

	static function getTerms(){

		return self::$orderTerms;
	}
}

class Male extends Cards {

	static $labels;

	static $props;

	public $images = [
		'recent_cards' => 'male.png'
	];

}

class Female extends Cards {

	static $labels;

	static $props;

	public $images = [
		'recent_cards' => 'female.png'
	];

}