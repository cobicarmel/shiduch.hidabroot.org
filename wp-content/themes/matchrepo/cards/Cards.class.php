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

	protected $indexItems = ['status', 'community'];

	protected $labeledItems = ['age' => 'גיל'];

	function __construct(array $card){
		$this -> card = $card;
		$this -> id = $card['ID'];
		$this -> name = $card['post_title'];
		$this -> get_meta();
		$this -> set_age();
	}

	protected static function build_form($params){

		$id = 'form-' . ++self::$formsCount;

		echo "<form id='$id'>";

		foreach($params as $param){

			$props = self::$props[$param]; ?>

			<div class="form-field form-field-<?= $param ?>">
				<div class="form-label">
					<label><?= $props['label'] ?>:</label>
				</div>
				<div class="form-input">

			<?
			switch($props['type']){

				case 'text':
					echo "<input type='text' name='$param'>";
					break;

				case 'select':

					echo "<select name='$param'>";

					echo "<option></option>";

					foreach($props['options'] as $value => $text)
						echo "<option value='$value'>$text</option>";

					echo '</select>';

					break;

				case 'radio':
					foreach($props['options'] as $key => $value){

						$checked = '';

						if(! $key)
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

	protected function get_parsed_meta($items){

		$itemsStack = [];

		foreach($items as $item)
			$itemsStack[$item] = $this -> meta[$item];

		return $itemsStack;
	}

	protected function set_age(){

		$oldTime = DateTime::createFromFormat('d/m/Y', $this -> meta['birthday']) -> getTimestamp();

		$rangeMS = time() - $oldTime;

		$years = $rangeMS / 3600 / 24 / 365;

		$this -> meta['age'] = floor($years);
	}

	function get_excerpt(){

		$excerpt_items = ['age', 'city', 'status', 'community'];

		$items = $this -> get_parsed_meta($excerpt_items);

		$items['community'] = 'מוצא ' . $items['community'];

		return $this ->name . ', ' . implode(', ', $items);
	}

	function list_meta($items = null){

		$meta = $this -> prepare_display($items);

		echo '<ul>';

		foreach($meta as $label => $param){

			echo '<li>';

			echo "<div class='meta-label'>$label:</div>";

			echo "<div class='meta-value'>$param</div>";

			echo '</li>';
		}

		echo '</ul>';
	}

	static function quick_search(){

		self::build_form(['gender', 'min_age', 'max_age', 'zone', 'conception', 'status']);
//		acf_form([
//			'post_id' => 'new',
//			'field_groups' => [75],
//			'submit_value' => __('Search')
//		]);
	}

	private function prepare_display($items = null){

		$meta = $this -> meta;

		unset($meta['birthday'], $meta['gender']);

		$keys = $items ? $items : array_keys($meta);

		$itemsStack = [];

		foreach($keys as $key){

			if(isset($this -> labeledItems[$key]))
				$label = $this -> labeledItems[$key];
			else
				$label = get_field_object($key)['label'];

			$param = $meta[$key];

			if(gettype($param) == 'array')
				$param = implode('<br>', $param);

			$itemsStack[$label] = $param;
		}

		return $itemsStack;
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