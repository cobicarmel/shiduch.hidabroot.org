<?

function register_theme_sidebars(){

	register_sidebar(array(
		'name' => __('Right Sidebar', THEME_NAME),
		'id' => 'right-sidebar',
		'description' => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>'
	));

	register_sidebar(array(
		'name' => __('Top Sidebar', THEME_NAME),
		'id' => 'top-sidebar',
		'before_widget' => '<div id="%1$s" class="%2$s widget-area">',
		'after_widget' => '</div>'
	));

	register_sidebar(array(
		'name' => __('Home Content', THEME_NAME),
		'id' => 'home-sidebar',
		'before_widget' => '<div id="%1$s" class="%2$s widget-area">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3></div>'
	));
}

add_action('widgets_init', 'register_theme_sidebars');