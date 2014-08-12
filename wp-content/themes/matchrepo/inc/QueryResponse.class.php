<?

namespace Matchrepo;

abstract class QueryResponse {

	private static $responses = [];

	private static $responsesList = [
		'account_saved' => [
			1 => 'השינויים נשמרו.'
		],
		'card_saved' => [
			1 => 'הכרטיס עודכן בהצלחה.'
		],
		'card_trashed' => [
			1 => 'הכרטיס נמחק.'
		],
		'pass_changed' => [
			1 => 'סיסמת החשבון שונתה.'
		]
	];

	public static function prepareList($response){

		$paragraphs = array_map(function($res){
			return '<p>' . $res . '</p>';
		}, $response);

		return implode('', $paragraphs);
	}

	public static function addResponse($key, $value){

		self::$responses[$key] = $value;
	}

	public static function listResponse(){

		if(! $_GET)
			return;

		$response = [];

		foreach($_GET as $key => $value) {
			if(! empty(self::$responsesList[$key][$value]))
				$response[] = self::$responsesList[$key][$value];
		}

		if($response) {
			echo '<div class="query-response">';

			echo self::prepareList($response);

			echo '</div>';
		}
	}

	public static function sendResponse($url){

		$link = add_query_arg(self::$responses, $url);

		wp_redirect($link);

		exit;
	}
} 