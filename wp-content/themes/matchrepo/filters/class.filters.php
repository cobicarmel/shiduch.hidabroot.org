<?

class MR_filters {

	static function login_logo_url(){
		return home_url();
	}

	static function login_logo_title() {
		return get_bloginfo();
	}

	static function private_title_format(){
		return '%s';
	}

	static function custom_mail_from(){

		$from = preg_replace('/^https?:\/\/(www\.)?/', '', site_url());

		return 'admin@' . str_replace('/', '.', $from);
	}

	static function custom_mail_from_name(){

		return get_bloginfo();
	}


}

/* Login filters */

add_filter('login_headerurl', 'MR_filters::login_logo_url');

add_filter('login_headertitle', 'MR_filters::login_logo_title');

/* Mail filters */

add_filter('wp_mail_from', 'MR_filters::custom_mail_from');

add_filter('wp_mail_from_name', 'MR_filters::custom_mail_from_name');

/* Post title filters */

add_filter('private_title_format', 'MR_filters::private_title_format');