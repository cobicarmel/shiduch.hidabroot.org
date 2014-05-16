<?

wp_register_style('sidebar', get_stylesheet_directory_uri() . '/css/sidebar.css');

wp_enqueue_style('sidebar');

function test_filter($link){

}

?>
<div id="secondary" class="widget-area" role="complementary">
	<? if(!dynamic_sidebar('sidebar-1')) : ?>

		<aside id="logo">
			<img src="<?= WP_CONTENT_URL ?>/themes/matchrepo/media/logo.png">
		</aside>

		<span id="cards-count">
				<? printf(__('%d cards in repository', 'Matchrepo'), wp_count_posts()->publish) ?>
			</span>

		<aside id="side-login">
			<div class="side-box">
				<h1 class="side-box-title"><? _e('login', 'Matchrepo') ?></h1>
				<?

				$args = [
					'label_username' => __('Username') . ':',
					'label_password' => __('Password') . ':'
				];

				wp_login_form($args);
				?>
			</div>
		</aside>

		<aside id="quick-search">

		</aside>

	<? endif; // end sidebar widget area ?>
</div><!-- #secondary -->
