<?

abstract class CardHelpers {

	static function get_gender($card){
		$gender = get_post_meta($card['ID'], 'gender', true);

		return $gender ? 'female' : 'male';
	}
}

