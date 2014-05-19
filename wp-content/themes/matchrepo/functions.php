<?

define('THEME_NAME', 'Matchrepo');

if(!function_exists('Matchrepo_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function Matchrepo_setup(){

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Matchrepo, use a find and replace
		 * to change THEME_NAME to the name of your theme in all the template files
		 */
		load_theme_textdomain(THEME_NAME, get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		//add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'primary' => __('Primary Menu', THEME_NAME),
		));

		// Enable support for Post Formats.
		add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));

		// Setup the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('Matchrepo_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		// Enable support for HTML5 markup.
		add_theme_support('html5', array(
			'comment-list',
			'search-form',
			'comment-form',
			'gallery',
			'caption',
		));
	}
endif; // Matchrepo_setup
add_action('after_setup_theme', 'Matchrepo_setup');

/**
 * Enqueue scripts and styles.
 */
function Matchrepo_scripts(){
	wp_enqueue_style('Matchrepo-style', get_stylesheet_uri());

	wp_enqueue_script('Matchrepo-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true);

	wp_enqueue_script('Matchrepo-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true);

	if(is_singular() && comments_open() && get_option('thread_comments')){
		wp_enqueue_script('comment-reply');
	}
}

add_action('wp_enqueue_scripts', 'Matchrepo_scripts');

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

require get_template_directory() . '/widgets/banner.php';

require get_template_directory() . '/cards/manager.php';

require get_template_directory() . '/init/register.php';

require get_template_directory() . '/init/sidebars.php';