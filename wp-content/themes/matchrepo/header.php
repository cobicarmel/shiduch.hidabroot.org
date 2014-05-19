<!DOCTYPE html>
<html <? language_attributes(); ?>>
<head>
	<meta charset="<? bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><? wp_title('|', true, 'right'); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<? bloginfo('pingback_url'); ?>">
	<link rel="shortcut icon" href="<?= WP_CONTENT_URL ?>/uploads/images/icon.ico">

	<? wp_head(); ?>
</head>

<body <? body_class(); ?>>
<nav id="site-navigation" class="main-navigation" role="navigation">
	<?

	$navParams = array(
		'theme_location' => 'primary',
		'menu' => '',
		'container' => 'div',
		'container_class' => '',
		'container_id' => '',
		'menu_class' => 'menu auto-center',
		'menu_id' => '',
		'echo' => true,
		'fallback_cb' => 'wp_page_menu',
		'before' => '',
		'after' => '<div class="divider"></div>',
		'link_before' => '',
		'link_after' => '',
		'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth' => 0,
		'walker' => ''
	);

	wp_nav_menu($navParams);
	?>
</nav>
<div id="side-sticky-icons">
	<img src="<?= WP_CONTENT_URL ?>/uploads/images/7brachot-icon.png">
	<img src="<?= WP_CONTENT_URL ?>/uploads/images/hidabroot-icon.png">
</div>
<div id="page" class="hfeed site">
	<div id="header-wrapper">
		<header id="masthead" class="site-header" role="banner">
			<? dynamic_sidebar('Top Sidebar') ?>
		</header>
	</div>
	<div id="content-wrapper">
		<div id="content" class="site-content">
