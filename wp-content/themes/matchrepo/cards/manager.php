<?

load_theme_textdomain(THEME_NAME, get_template_directory() . '/languages');

require __DIR__ . '/cards.class.php';

require __DIR__ . '/cardHelpers.class.php';

require __DIR__ . '/register.php';

add_action('init', function(){

	require __DIR__ . '/properties.php';

	require STYLESHEETPATH . '/acf/fields.php';
});