<?
/**
 * @package WordPress
 * @subpackage Theme_Compat
 * @deprecated 3.0
 *
 * This file is here for Backwards compatibility with old themes and will be removed in a future version
 *
 */
_deprecated_file( sprintf( __( 'Theme without %1$s' ), basename(__FILE__) ), '3.0', null, sprintf( __('Please include a %1$s template in your theme.'), basename(__FILE__) ) );
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <? language_attributes(); ?>>
<head>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<meta http-equiv="Content-Type" content="<? bloginfo('html_type'); ?>; charset=<? bloginfo('charset'); ?>" />

<title><? wp_title('&laquo;', true, 'right'); ?> <? bloginfo('name'); ?></title>

<link rel="stylesheet" href="<? bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<? bloginfo('pingback_url'); ?>" />

<style type="text/css" media="screen">

<?
// Checks to see whether it needs a sidebar
if ( empty($withcomments) && !is_single() ) {
?>
	#page { background: url("<? bloginfo('stylesheet_directory'); ?>/images/kubrickbg-<? bloginfo('text_direction'); ?>.jpg") repeat-y top; border: none; }
<? } else { // No sidebar ?>
	#page { background: url("<? bloginfo('stylesheet_directory'); ?>/images/kubrickbgwide.jpg") repeat-y top; border: none; }
<? } ?>

</style>

<? if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<? wp_head(); ?>
</head>
<body <? body_class(); ?>>
<div id="page">

<div id="header" role="banner">
	<div id="headerimg">
		<h1><a href="<? echo home_url(); ?>/"><? bloginfo('name'); ?></a></h1>
		<div class="description"><? bloginfo('description'); ?></div>
	</div>
</div>
<hr />
