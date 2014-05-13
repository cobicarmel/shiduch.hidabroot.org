<!DOCTYPE html>
<html <? language_attributes(); ?>>
<head>
	<meta charset="<? bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><? wp_title('|', true, 'right'); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<? bloginfo('pingback_url'); ?>">

	<? wp_head(); ?>
</head>

<body <? body_class(); ?>>
<nav id="site-navigation" class="main-navigation" role="navigation">
	<?

	$navParams = array(
		'theme_location'  => 'primary',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => '',
		'container_id'    => '',
		'menu_class'      => 'menu auto-center',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '<div class="divider"></div>',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
	);

	wp_nav_menu($navParams);
	?>
</nav>
<div id="page-background"></div>
<div id="page" class="hfeed site auto-center">
	<header id="masthead" class="site-header" role="banner">
		<div id="top-banner"></div>
		<div class="site-branding">
			<h1 class="site-title">
				<a href="<? echo esc_url(home_url('/')); ?>" rel="home"><? bloginfo('name'); ?></a>
			</h1>

			<h2 class="site-description"><? bloginfo('description'); ?></h2>
		</div>
	</header>
	<!-- #masthead -->

	<div id="content" class="site-content">
