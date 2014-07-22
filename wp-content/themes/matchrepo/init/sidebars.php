<?

function register_theme_sidebars(){

	register_sidebar(array(
		'name' => __('Right Sidebar', THEME_NAME),
		'id' => 'right-sidebar',
		'description' => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>'
	));
}

add_action('widgets_init', 'register_theme_sidebars');