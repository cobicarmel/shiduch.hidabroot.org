<?

abstract class Cards{

	static $props;

	protected $card;

	protected $id;

	protected $name;

	protected $meta = [];

	function __construct($card){
		$this ->card = $card;
		$this ->id = $card['ID'];
		$this ->name = $card['post_title'];
		$this ->get_meta();
		$this ->set_age();
	}

	protected function get_meta(){
		$meta = get_post_meta($this ->id);

		foreach(self::$props as $name => $data)
			$this ->meta[$name] = $meta[$name][0];
	}

	protected function set_age(){

		$oldTime = DateTime::createFromFormat('d/m/Y', $this -> meta['birthday']) -> getTimestamp();

		$rangeMS = time() - $oldTime;

		$years = $rangeMS / 3600 / 24 / 365;

		$this -> meta['age'] = floor($years);
	}

	function get_excerpt(){

		$excerpt_items = ['age', 'city', 'status', 'community'];
		$index_items = ['status', 'community'];
		$items = [];

		foreach($excerpt_items as $item){

			if(in_array($item, $index_items)){
				$index = $this ->meta[$item];
				$items[$item] = Cards::$props[$item]['options'][$index];
			}
			else
				$items[$item] = $this -> meta[$item];
		}

		$items['community'] = 'מוצא ' . $items['community'];

		return $this ->name . ', ' . implode(', ', $items);
	}

}

class Male extends Cards{

	public $images = [
		'recent_cards' => 'male.png'
	];
}

class Female extends Cards{

	public $images = [
		'recent_cards' => 'female.png'
	];

}