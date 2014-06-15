<?

abstract class Cards{

	protected $card;

	protected $id;

	protected $name;

	protected $meta;

	protected static $formsCount = 0;

	static $props;

	public $myAccountItems = [
		'age',
		'status',
		'college',
		'height',
		'zone',
		'conception',
		'work',
		'look'
	];

	protected $indexItems = ['status', 'community', 'conception', 'look', 'smoke', 'healthy'];

	protected $labeledItems = ['age' => 'גיל'];

	function __construct(array $card){
		$this -> card = $card;
		$this -> id = $card['ID'];
		$this -> name = $card['post_title'];
		$this -> get_meta();
		$this -> set_age();
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

		foreach($params as $param){

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
			switch($props['type']){

				case 'text':
					$value = $hasSearch ? " value='$searchValue'" : '';
					echo "<input type='text' name='$param'$value>";
					break;

				case 'select':

					echo "<select name='$param'>";

					echo "<option></option>";

					foreach($props['options'] as $value => $text){

						if(isset($props['termByValue']) && $props['termByValue'])
							$value = $text;

						$selected = $hasSearch && $searchValue == $value ? " selected='true'" : '';

						echo "<option value='$value'$selected>$text</option>";
					}

					echo '</select>';

					break;

				case 'radio':
					$i = 0;

					foreach($props['options'] as $key => $value){

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

	protected function get_meta(){
		$this -> meta = get_fields($this -> id);
	}

	protected function set_age(){

		$oldTime = DateTime::createFromFormat('Y-m-d', $this -> meta['birthday']) -> getTimestamp();

		$rangeMS = time() - $oldTime;

		$years = $rangeMS / 3600 / 24 / 365;

		$this -> meta['age'] = floor($years);
	}

	function get_excerpt(){

		$excerpt_items = ['age', 'city', 'status'];

		$items = $this -> prepare_display($excerpt_items, false);

		$items['community'] = 'מוצא ' . Cards::$props['community']['options'][$this -> meta['community']];

		return $this -> name . ', ' . implode(', ', $items);
	}

	function list_meta($items = null){

		$meta = $this -> prepare_display($items);

		echo '<ul>';

		foreach($meta as $label => $param){

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
			'action' => get_page_link($actionPage -> ID),
			'class' => 'search-form',
			'get_search_params' => true
		];

		self::build_form($args, $options);
	}

	private function prepare_display($items = null, $withLabels = true){

		$meta = $this -> meta;

		unset($meta['birthday'], $meta['gender']);

		$keys = $items ? $items : array_keys($meta);

		$itemsStack = [];

		foreach($keys as $key){

			if(isset($this -> labeledItems[$key]))
				$label = $this -> labeledItems[$key];
			else
				$label = get_field_object($key)['label'];

			$param = in_array($key, $this -> indexItems) ? $this::$props[$key]['options'][$meta[$key]] : $meta[$key];

			if(is_array($param))
				$param = implode('<br>', $param);

			if($withLabels)
				$itemsStack[$label] = $param;
			else
				$itemsStack[$key] = $param;
		}

		return $itemsStack;
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
}

class Male extends Cards{

	static $labels;

	static $props;

	public $images = [
		'recent_cards' => 'male.png'
	];
}

class Female extends Cards{

	static $labels;

	static $props;

	public $images = [
		'recent_cards' => 'female.png'
	];

}