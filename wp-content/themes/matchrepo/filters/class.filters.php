<?

class MR_filters {

	static function login_logo_url(){
		return home_url();
	}

	static function login_logo_title() {
		return get_bloginfo();
	}
}

/* Login filters */

add_filter('login_headerurl', 'MR_filters::login_logo_url');

add_filter('login_headertitle', 'MR_filters::login_logo_title');