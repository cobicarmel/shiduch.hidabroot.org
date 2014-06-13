<?

abstract class Matchrepo{

	static function multiCardsHeader(){
		wp_register_style('multi-cards', get_stylesheet_directory_uri() . '/css/multi-cards.css');
		wp_enqueue_style('multi-cards');
	}

	static function multiCardsNavigation(){

		global $wp_query;

		$big = 9999999;

		if(!$paged = get_query_var('paged'))
			$paged = 1;

		$args = array(
			'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format' => '?paged=%#%',
			'current' => $paged,
			'total' => $wp_query->max_num_pages,
			'prev_text' => '<',
			'next_text' => '>',
		);

		echo '<div id="page-navigation">' . paginate_links($args) . '</div>';
	}
} 