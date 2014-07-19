<?

abstract class MR_actions {

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

		wp_register_style('jquery-ui', get_stylesheet_directory_uri() . '/css/jquery-ui-1.10.4.custom.min.css');

		wp_enqueue_style('style', get_stylesheet_uri());

		wp_register_script('main-script', get_template_directory_uri() . '/js/script.js', array(), '', true);

		wp_register_script('main-form', get_template_directory_uri() . '/js/main-form.js', array(), '', true);

		wp_register_script('add-card', get_template_directory_uri() . '/js/add-card.js', array(), '', true);

		wp_register_script('advanced-search', get_template_directory_uri() . '/js/advanced-search.js', array(), '', true);

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

	static function theme_setup(){

		load_theme_textdomain(THEME_NAME, get_template_directory() . '/languages');

		register_nav_menus(array(
			'primary' => __('Primary Menu', THEME_NAME),
			'footer' => __('Footer Menu', THEME_NAME)
		));

		add_theme_support('post-formats', array('aside', 'image', 'link'));

		add_theme_support('html5', array(
			'search-form',
			'gallery',
			'caption',
		));
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

add_action('phpmailer_init','MR_actions::send_smtp_email');