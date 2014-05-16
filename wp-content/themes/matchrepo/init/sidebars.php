<?

register_sidebar(array(
	'name' => __('Sidebar', 'Matchrepo'),
	'id' => 'sidebar-1',
	'description' => '',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h1 class="widget-title">',
	'after_title' => '</h1>',
));

register_sidebar(array(
	'name' => __('top_banner', 'Matchrepo'),
	'id' => 'top_banner',
	'before_widget' => '<div id="%1$s" class="%2$s widget-area">',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-title"><h3>',
	'after_title' => '</h3></div>'
));