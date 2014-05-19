<?

wp_register_style('sidebar', get_stylesheet_directory_uri() . '/css/sidebar.css');

wp_enqueue_style('sidebar');

?>
<div id="secondary" class="widget-area" role="complementary">
	<? if(!dynamic_sidebar('sidebar-1')) : ?>

		<aside id="logo">
			<img src="<?= WP_CONTENT_URL ?>/uploads/images/logo.png">
		</aside>

		<span id="cards-count">
				<? printf(__('%d cards in repository', THEME_NAME), wp_count_posts('card')->publish) ?>
			</span>

		<aside id="side-login">
			<div class="side-box">
				<h3 class="side-box-title">
					<span class="title-deco"></span>
					<? _e('Enter', THEME_NAME) ?>
				</h3>
				<?

				$args = [
					'label_username' => __('Username') . ':',
					'label_password' => __('Password') . ':',
					'label_log_in' => __('Login', THEME_NAME),
					'value_remember' => true
				];

				wp_login_form($args);
				?>
			</div>
		</aside>

		<aside id="quick-search">
			<div class="side-box">
				<h3 class="side-box-title">
					<span class="title-deco"></span>
					<? _e('Quick Search', THEME_NAME) ?>
				</h3>
			</div>
		</aside>

		<? dynamic_sidebar('Right Sidebar') ?>

	<? endif; // end sidebar widget area ?>
</div><!-- #secondary -->
