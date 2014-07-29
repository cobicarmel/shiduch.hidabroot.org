<?

wp_register_style('sidebar', get_stylesheet_directory_uri() . '/css/sidebar.css');

wp_enqueue_style('sidebar');

$site_url = get_site_url();

$site_name = get_option('blogname');
?>
<div id="secondary" class="widget-area" role="complementary">

	<aside id="logo">
		<a href="<?= $site_url ?>">
			<img alt="<?= $site_name ?>" title="<?= $site_name ?>" src="<?= WP_CONTENT_URL ?>/uploads/images/logo.png">
		</a>
	</aside>

		<span id="cards-count">
				<? printf(__('%d cards in repository', THEME_NAME), wp_count_posts('card')->publish) ?>
			</span>

	<aside id="side-login">
		<? if (is_user_logged_in()) :

			global $current_user, $wpdb;

			$id = $current_user -> ID;

			$user_meta = get_user_meta($id);

			$posts_count = $wpdb -> get_var('SELECT COUNT(ID) FROM ' . $wpdb -> prefix . "posts WHERE post_author = '$id' AND post_type = 'card' AND post_status = 'publish'");
			?>
			<div id="user-logged-in">
				<h3>
					<?
					printf(
						__('Hello %s', THEME_NAME) . ',',
						$user_meta['nickname'][0]
					);
					?>
					<a id="logout" href="<?= wp_logout_url(home_url()) ?>"><? _e('Log out &raquo;') ?></a>
				</h3>
				<div id="user-published-count">
					<?
					printf(
						__('%d cards was published in your account', THEME_NAME),
						$posts_count
					);
					?>
				</div>
				<?
					$page = get_page_by_title('החשבון שלי');
					$link = get_page_link($page -> ID);
				?>
				<a href="<?= $link ?>">
					<button>לעריכת הכרטיסים בחשבונך</button>
				</a>
			</div>
		<? else : ?>
			<div class="side-box decorative-box">
				<h3>
					<span class="title-deco"></span>
					<? _e('Enter', THEME_NAME) ?>
				</h3>
				<?

				$args = [
					'label_username' => __('Username') . ':',
					'label_password' => __('Password') . ':',
					'label_log_in' => __('Login', THEME_NAME),
					'redirect' => site_url(),
					'value_remember' => true
				];

				wp_login_form($args); ?>
			</div>
		<? endif ?>
	</aside>

	<aside id="quick-search">
		<div class="side-box decorative-box">
			<h3>
				<span class="title-deco"></span>
				<? _e('Quick Search', THEME_NAME) ?>
			</h3>
			<?
			Cards::quick_search();
			?>
		</div>
	</aside>

	<? dynamic_sidebar('Right Sidebar') ?>

</div><!-- #secondary -->
