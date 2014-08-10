<?

abstract class MR_actions {

	static function html_headers(){
		return 'text/html';
	}

	static function manage_users_columns($columns){

		unset($columns['posts']);

		$columns['cards'] = 'כרטיסים';

		return $columns;
	}

	static function manage_users_custom_column($value, $column_name, $user_id){

		if($column_name != 'cards')
			return $value;

		global $wpdb;

		$value = "<a href='edit.php?author=$user_id&post_type=card' title='הצג כרטיסים של משתמש זה'>";

		$value .= $wpdb ->get_var('SELECT COUNT(ID) FROM ' . $wpdb ->prefix . "posts WHERE post_author = '$user_id' AND post_type = 'card' AND post_status = 'publish'");

		$value .= '<a>';

		return $value;
	}

	static function manage_card_columns($columns){

		$columns['title'] = 'שם המועמד/ת';

		return $columns;
	}

	static function restrict_admin(){
		if(!current_user_can('manage_options')){
			wp_redirect(site_url());
			exit;
		}
	}

	static function remove_admin_bar(){
		if(!current_user_can('manage_options'))
			show_admin_bar(false);
	}

	static function login_logo() { ?>
		<style type="text/css">
			#login h1 a {
				background-image: url(<?= WP_CONTENT_URL ?>/uploads/images/logo-footer.png);
				width: 100%;
				padding-bottom: 10px;
				background-size: 100%;
			}
		</style>
	<? }

	static function page_excerpt_support(){
		add_post_type_support('page', 'excerpt');
	}

	static function send_smtp_email( $phpmailer ) {

		$phpmailer->isSMTP();

		$phpmailer->Host = "smtp.gmail.com";

		$phpmailer->SMTPAuth = true;

		$phpmailer->Port = 587;

		$phpmailer->Username = "jzaltzberg";

		$phpmailer->Password = "1712Hgec";

		$phpmailer->SMTPSecure = "tls";

		$phpmailer->From = "jzaltzberg@gmail.com";

		$phpmailer->FromName = "Cobi";
	}

	static function register_sources(){

		wp_register_style('main-form', get_stylesheet_directory_uri() . '/css/main-form.css');

		wp_register_style('add-card', get_stylesheet_directory_uri() . '/css/add-card.css');

		wp_register_style('register', get_stylesheet_directory_uri() . '/register/register.css');

		wp_register_style('jquery-ui', get_stylesheet_directory_uri() . '/css/jquery-ui-1.10.4.custom.min.css');

		wp_enqueue_style('style', get_stylesheet_uri());

		wp_register_script('main-script', get_template_directory_uri() . '/js/script.js', [], '', true);

		wp_register_script('main-form', get_template_directory_uri() . '/js/main-form.js', [], '', true);

		wp_register_script('add-card', get_template_directory_uri() . '/js/add-card.js', [], '', true);

		wp_register_script('advanced-search', get_template_directory_uri() . '/js/advanced-search.js', [], '', true);

		wp_register_script('register', get_stylesheet_directory_uri() . '/register/register.js', [], '', true);

		wp_enqueue_script('jquery');

		wp_enqueue_script('main-script');
	}

	static function remove_default_widgets() {

		$defaultWidgets = [
			'WP_Widget_Pages',
			'WP_Widget_Calendar',
			'WP_Widget_Archives',
			'WP_Widget_Links',
			'WP_Widget_Meta',
			'WP_Widget_Search',
			'WP_Widget_Text',
			'WP_Widget_Categories',
			'WP_Widget_Recent_Posts',
			'WP_Widget_Recent_Comments',
			'WP_Widget_RSS',
			'WP_Widget_Tag_Cloud',
			'WP_Nav_Menu_Widget'
		];

		foreach($defaultWidgets as $widget)
			unregister_widget($widget);
	}

	static function retrieve_password_message($message, $key){

		$message =
			'<div dir="rtl">' .
			sprintf('שלום, התקבלה בקשה לאיפוס סיסמה עבור המשתמש %s.', $_POST['user_login']) .
			'<br><br>' .
			'בכדי לאפס את הסיסמה, אנא ' .
			'<a href="' .
			network_site_url("wp-login.php?action=rp&key=$key&login=" .
				rawurlencode($_POST['user_login']), 'login') .
			'">' .
			'לחצ/י כאן.' .
			'</a>' .
			'</div>'
		;

		return $message;
	}

	static function theme_setup(){

		register_nav_menus(array(
			'primary' => __('Primary Menu', THEME_NAME),
			'footer' => __('Footer Menu', THEME_NAME)
		));

		add_theme_support('html5', array(
			'search-form',
			'gallery',
			'caption',
		));

		add_theme_support('post-thumbnails');
	}
}

/* Global actions */

add_action('after_setup_theme', 'MR_actions::theme_setup');

add_action('wp_enqueue_scripts', 'MR_actions::register_sources');

/* removing default wp widgets */

add_action('widgets_init', 'MR_actions::remove_default_widgets');

/* Admin actions */

add_action('admin_init', 'MR_actions::restrict_admin');

add_action('after_setup_theme', 'MR_actions::remove_admin_bar');

/* Login actions */

add_action( 'login_enqueue_scripts', 'MR_actions::login_logo');

/* Mail actions */

if(is_local())
	add_action('phpmailer_init','MR_actions::send_smtp_email');

add_filter('wp_mail_content_type', 'MR_actions::html_headers');

/* adding excerpt support for pages */

add_action('init', 'MR_actions::page_excerpt_support');

if(is_admin()){

	/* change users columns */

	add_filter('manage_users_columns', 'MR_actions::manage_users_columns');

	add_action('manage_users_custom_column', 'MR_actions::manage_users_custom_column', 10, 3);

	/* change cards columns */

	add_filter('manage_edit-card_columns', 'MR_actions::manage_card_columns');
}

add_filter('retrieve_password_message', 'MR_actions::retrieve_password_message', 10, 2);