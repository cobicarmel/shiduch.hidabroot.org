<?

function register_card(){

	$labels = array(
		'name' => _x('Cards', 'Post Type General Name', THEME_NAME),
		'singular_name' => _x('Card', 'Post Type Singular Name', THEME_NAME),
		'menu_name' => __('Cards', THEME_NAME),
		'parent_item_colon' => __('Parent Item:', THEME_NAME),
		'all_items' => __('All Cards', THEME_NAME),
		'view_item' => __('View Card', THEME_NAME),
		'add_new_item' => __('Add New Card', THEME_NAME),
		'add_new' => __('Add New', THEME_NAME),
		'edit_item' => __('Edit Card', THEME_NAME),
		'update_item' => __('Update Card', THEME_NAME),
		'search_items' => __('Search Card', THEME_NAME),
		'not_found' => __('Not found'),
		'not_found_in_trash' => __('Not found in Trash'),
	);

	$args = array(
		'label' => __('card', THEME_NAME),
		'description' => __('Post Type Description', THEME_NAME),
		'labels' => $labels,
		'supports' => array('title', 'editor', 'author'),
		'taxonomies' => array(),
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-tablet',
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'card',
		'map_meta_cap' => true
	);

	register_post_type('card', $args);
}

add_action('init', 'register_card', 0);