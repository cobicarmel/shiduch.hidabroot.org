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
		'not_found' => __('Not found', THEME_NAME),
		'not_found_in_trash' => __('Not found in Trash', THEME_NAME),
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

function register_card_taxonomy(){

	$labels = [
		'name' => 'עדות',
		'singular_name' => 'עדה',
		'search_items' => 'חיפוש עדות',
		'all_items' => 'כל העדות',
		'edit_item' => 'עריכת עדה',
		'update_item' => 'עדכון עדה',
		'add_new_item' => 'הוספת עדה חדשה',
		'new_item_name' => 'שם עדה',
		'menu_name' => 'עדות',
	];

	$args = [
		'hierarchical' => true,
		'show_admin_column' => true,
		'labels' => $labels
	];

	register_taxonomy('origins', 'card', $args);
}

function manage_caps(){

	$capsGroups = [
		'administrator' => [
			'edit_cards' => true,
			'edit_others_cards' => true,
			'edit_private_cards' => true,
			'delete_cards' => true,
			'delete_others_cards' => true,
			'delete_private_cards' => true,
			'read_private_cards' => true,
			'edit_published_cards' => true,
			'delete_published_cards' => true,
			'publish_cards' => true
		],
		'editor' => [
			'edit_cards' => true,
			'edit_others_cards' => false,
			'edit_private_cards' => true,
			'delete_cards' => true,
			'delete_others_cards' => false,
			'delete_private_cards' => true,
			'read_private_cards' => true,
			'delete_others_pages' => false,
			'delete_others_posts' => false,
			'delete_pages' => false,
			'delete_posts' => false,
			'delete_private_pages' => false,
			'delete_private_posts' => false,
			'delete_published_pages' => false,
			'delete_published_posts' => false,
			'edit_others_pages' => false,
			'edit_others_posts' => false,
			'edit_pages' => false,
			'edit_posts' => false,
			'edit_private_pages' => false,
			'edit_private_posts' => false,
			'edit_published_pages' => false,
			'edit_published_posts' => false,
			'manage_categories' => false,
			'manage_links' => false,
			'moderate_comments' => false,
			'publish_pages' => false,
			'publish_posts' => false,
			'read_private_pages' => false,
			'read_private_posts' => false,
			'unfiltered_html' => false,
			'upload_files' => false,
			'edit_published_cards' => true,
			'delete_published_cards' => true
		],
		'contributor' => [
			'edit_cards' => true,
			'edit_others_cards' => false,
			'edit_private_cards' => true,
			'edit_published_cards' => true,
			'delete_cards' => true,
			'delete_published_cards' => true,
			'delete_others_cards' => false,
			'delete_private_cards' => true,
			'read_private_cards' => false,
			'delete_posts' => false,
			'edit_posts' => false
		]
	];

	foreach($capsGroups as $roleName => $caps) {

		$role = get_role($roleName);

		foreach($caps as $capName => $grant)
			$role->add_cap($capName, $grant);
	}
}

add_action('init', 'register_card', 0);

add_action('init', 'register_card_taxonomy', 0);

add_action('admin_init', 'manage_caps', 0);