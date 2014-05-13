<?
/**
 * @package TinyMCE
 * @author Moxiecode
 * @copyright Copyright © 2005-2006, Moxiecode Systems AB, All rights reserved.
 */

/** @ignore */
require_once( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/wp-load.php' );
header('Content-Type: text/html; charset=' . get_bloginfo('charset'));
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <? language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<? bloginfo('html_type'); ?>; charset=<? echo get_option('blog_charset'); ?>" />
<title><? _e('Keyboard Shortcuts'); ?></title>

<? wp_admin_css( 'wp-admin', true ); ?>
<style type="text/css">

	html {
		background: #fcfcfc;
		overflow: hidden;
	}

	body {
		min-width: 0;
	}

	.wrap {
		background-color: #fff;
		border-top: 1px solid #ddd;
		height: 390px;
		margin: 0;
		overflow: auto;
		padding: 10px 16px;
	}

	th {
		text-align: center;
	}

	.top th {
		text-decoration: underline;
	}

	.top .key {
		text-align: center;
		width: 5em;
	}

	.keys {
		border: 0 none;
		margin-bottom: 15px;
		width: 100%;
	}

	.keys p {
		display: inline-block;
		margin: 0px;
		padding: 0px;
	}

	.keys .left {
		text-align: left;
	}

	.keys .center {
		text-align: center;
	}

	.keys .right {
		text-align: right;
	}

	.macos .win,
	.windows .mac {
		display: none;
	}

</style>
<? if ( is_rtl() ) : ?>
<style type="text/css">

	.keys .left {
		text-align: right;
	}

	.keys .right {
		text-align: left;
	}

</style>
<? endif; ?>
</head>
<body class="windows wp-core-ui">
<script type="text/javascript">
var win = window.dialogArguments || opener || parent || top;

if ( win && win.tinymce && win.tinymce.isMac ) {
	document.body.className = document.body.className.replace(/windows/, 'macos');
}
</script>

<div class="wrap">

<div>
	<p><? _e('Rather than reaching for your mouse to click on the toolbar, use these access keys. Windows and Linux use Ctrl + letter. Macintosh uses Command + letter.'); ?></p>

	<table class="keys">
		<tr class="top"><th class="key center"><? _e('Letter'); ?></th><th class="left"><? _e('Action'); ?></th><th class="key center"><? _e('Letter'); ?></th><th class="left"><? _e('Action'); ?></th></tr>
		<tr><th>c</th><td><? _e('Copy'); ?></td><th>v</th><td><? _e('Paste'); ?></td></tr>
		<tr><th>a</th><td><? _e('Select all'); ?></td><th>x</th><td><? _e('Cut'); ?></td></tr>
		<tr><th>z</th><td><? _e('Undo'); ?></td><th>y</th><td><? _e('Redo'); ?></td></tr>
		<tr><th>b</th><td><? _e('Bold'); ?></td><th>i</th><td><? _e('Italic'); ?></td></tr>
		<tr><th>u</th><td><? _e('Underline'); ?></td><th>1</th><td><? _e('Heading 1'); ?></td></tr>
		<tr><th>2</th><td><? _e('Heading 2'); ?></td><th>3</th><td><? _e('Heading 3'); ?></td></tr>
		<tr><th>4</th><td><? _e('Heading 4'); ?></td><th>5</th><td><? _e('Heading 5'); ?></td></tr>
		<tr><th>6</th><td><? _e('Heading 6'); ?></td><th>9</th><td><? _e('Address'); ?></td></tr>
		<tr><th>k</th><td><? _e('Insert/edit link'); ?></td><th> </th><td>&nbsp;</td></tr>
	</table>

	<p><? _e('The following shortcuts use different access keys: Alt + Shift + letter.'); ?></p>
	<table class="keys">
		<tr class="top"><th class="key center"><? _e('Letter'); ?></th><th class="left"><? _e('Action'); ?></th><th class="key center"><? _e('Letter'); ?></th><th class="left"><? _e('Action'); ?></th></tr>
		<tr><th>n</th><td><? _e('Check Spelling'); ?></td><th>l</th><td><? _e('Align Left'); ?></td></tr>
		<tr><th>j</th><td><? _e('Justify Text'); ?></td><th>c</th><td><? _e('Align Center'); ?></td></tr>
		<tr><th>d</th><td><span style="text-decoration: line-through;"><? _e('Strikethrough'); ?></span></td><th>r</th><td><? _e('Align Right'); ?></td></tr>
		<tr><th>u</th><td><strong>&bull;</strong> <? _e('List'); ?></td><th>a</th><td><? _e('Insert link'); ?></td></tr>
		<tr><th>o</th><td>1. <? _e('List'); ?></td><th>s</th><td><? _e('Remove link'); ?></td></tr>
		<tr><th>q</th><td><? _e('Quote'); ?></td><th>m</th><td><? _e('Insert Image'); ?></td></tr>
		<tr><th>w</th><td><? _e('Distraction Free Writing mode'); ?></td><th>t</th><td><? _e('Insert More Tag'); ?></td></tr>
		<tr><th>p</th><td><? _e('Insert Page Break tag'); ?></td><th>h</th><td><? _e('Help'); ?></td></tr>
		<tr><th>x</th><td><? _e('Add/remove code tag'); ?></td><th> </th><td>&nbsp;</td></tr>
	</table>

	<p style="padding: 15px 10px 10px;"><? _e('Editor width in Distraction Free Writing mode:'); ?></p>
	<table class="keys">
		<tr><th><span class="win">Alt +</span><span class="mac">Ctrl +</span></th><td><? _e('Wider'); ?></td>
			<th><span class="win">Alt -</span><span class="mac">Ctrl -</span></th><td><? _e('Narrower'); ?></td></tr>
		<tr><th><span class="win">Alt 0</span><span class="mac">Ctrl 0</span></th><td><? _e('Default width'); ?></td><th></th><td></td></tr>
	</table>
</div>

</div>
</body>
</html>
