<?

abstract class Matchrepo {

	static $checkboxLists = 0;

	static function cardFormHeader(){

		add_action('wp_enqueue_scripts', function (){

			wp_enqueue_style('add-card');
			wp_enqueue_script('jquery-ui-datepicker');
			wp_enqueue_script('add-card');
			wp_enqueue_style('jquery-ui');
		});
	}

	static function listCheckboxes($params, $options = []){

		self::$checkboxLists++;

		$defaultOptions = [
			'echo' => true,
			'name' => '',
			'id' => '',
			'compare' => null,
			'type' => 'checkbox',
			'valueByText' => false,
			'wrapTag' => 'div'
		];

		$options = array_merge($defaultOptions, $options);

		if(! $options['id']){
			if($options['name'])
				$options['id'] = $options['name'];
			else
				$options['id'] = 'checkbox_';

			$options['id'] .= self::$checkboxLists;
		}

		$count = 1;

		$list = [];

		foreach($params as $value => $text) {

			if($options['valueByText'])
				$value = $text;

			$checked = '';

			if($options['compare'] !== null && $options['compare'] != '') {

				if(is_array($options['compare'])) {
					if(in_array($value, $options['compare']))
						$checked = ' checked';
				}
				elseif($options['compare'] == $value)
					$checked = ' checked';
			}

			if($count == 1 && ! $options['compare'] && $options['type'] == 'radio')
				$checked = ' checked';

			$option = '';

			$value = " value='$value'";

			if($options['wrapTag'])
				$option .= "<$options[wrapTag]>";

			$option .= "<input type='$options[type]' id='$options[id]$count' name='$options[name][]'$value$checked>";
			$option .= "<label for='$options[id]$count'>$text</label>";

			if($options['wrapTag'])
				$option .= "</$options[wrapTag]>";

			$list[] = $option;

			$count++;
		}

		if($options['echo'])
			echo implode('', $list);

		return $list;
	}

	static function listOptions($options, $compare = null, $byText = false){

		foreach($options as $value => $text) {

			if($byText)
				$value = $text;

			$selected = $compare !== null && $compare == $value ? ' selected' : '';

			$attrValue = $byText ? '' : ' value="' . $value . '"';

			echo "<option$attrValue$selected>$text</option>";
		}
	}

	static function mainFormHeader(){

		add_action('wp_enqueue_scripts', function (){

			wp_enqueue_style('main-form');
			wp_enqueue_script('main-form');
		});
	}

	static function multiCardsHeader(){

		wp_register_style('multi-cards', get_stylesheet_directory_uri() . '/css/multi-cards.css');
		wp_enqueue_style('multi-cards');
	}

	static function multiCardsNavigation(){

		global $wp_query;

		$big = 9999999;

		if(! $paged = get_query_var('paged'))
			$paged = 1;

		$args = array(
			'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format' => '?paged=%#%',
			'current' => $paged,
			'total' => $wp_query->max_num_pages,
			'prev_text' => '<',
			'next_text' => '>',
		);

		echo '<div id="page-navigation">' . paginate_links($args) . '</div>';
	}

	/**
	 * @return void
	 */

	static function redirect_not_logged(){

		if(! is_user_logged_in()) {
			wp_redirect(self::get_register_url());
			exit;
		}
	}

	static function registerHeader(){

		add_action('wp_enqueue_scripts', function (){

			wp_enqueue_style('register');
			wp_enqueue_script('register');
		});
	}

	/**
	 * @return string
	 */

	static function get_register_url(){

		return get_permalink(get_page_by_title('הרשמה'));
	}

	static function textToDBDate($dateText){

		if(! $date = DateTime::createFromFormat('d/m/Y', $dateText))
			return false;

		return $date->format('Y-m-d');
	}

	/**
	 * @param string $phone
	 * @return string
	 */
	static function phone_format($phone){

		$phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);

		$splitAt = $phone[1] == 5 ? 3 : 2;

		$area = substr($phone, 0, $splitAt);

		$number = substr($phone, $splitAt);

		return $area . '-' . $number;
	}
} 