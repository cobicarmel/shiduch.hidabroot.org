<?

function lost_password_link(){
	$url = wp_lostpassword_url();

	$lost_label = __('Lost Password');

	return "<a href='$url' class='login-lost-password'>$lost_label</a>";
}

function register_link(){
	$url = Matchrepo::get_register_url();
	$label =  __('Register');

	return "<a class='login-register' href='$url'><input type='button' value='$label'></a>";
}

add_filter('login_form_middle', 'lost_password_link');

add_filter('login_form_bottom', 'register_link');
