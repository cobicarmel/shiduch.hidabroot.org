<?

abstract class CardHelpers {

	static function list_age_options(){
		for($age = 18; $age < 100; $age++)
			echo "<option>$age</option>";
	}
}