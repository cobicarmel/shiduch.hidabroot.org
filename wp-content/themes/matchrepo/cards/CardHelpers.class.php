<?

abstract class CardHelpers {

	static function get_gender($card){
		return get_post_meta($card['ID'], 'gender', true);
	}
}