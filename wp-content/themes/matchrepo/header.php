<!DOCTYPE html>
<html <? language_attributes(); ?>>
<head>
	<meta charset="<? bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><? wp_title('|', true, 'right'); ?>  <? bloginfo(); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<? bloginfo('pingback_url'); ?>">
	<link rel="shortcut icon" href="<?= WP_CONTENT_URL ?>/uploads/images/icon.ico">
	<? wp_head() ?>
</head>

<body <? body_class(); ?>>
<nav id="site-navigation" class="main-navigation" role="navigation">
	<?

	$navParams = array(
		'theme_location' => 'primary',
		'menu_class' => 'menu auto-center'
	);

	wp_nav_menu($navParams);
	?>
</nav>
<div id="side-sticky-icons">
	<a href="http://www.7brachot.co.il">
		<img src="<?= WP_CONTENT_URL ?>/uploads/images/7brachot-icon.png">
	</a>
	<a href="http://www.hidabroot.org">
		<img src="<?= WP_CONTENT_URL ?>/uploads/images/hidabroot-icon.png">
	</a>
</div>
<div id="page" class="hfeed site">
	<div id="header-wrapper">
		<header id="masthead" class="site-header" role="banner">
			<? dynamic_sidebar('Top Sidebar') ?>
		</header>
	</div>
	<div id="content-wrapper">
		<div id="content" class="site-content">
