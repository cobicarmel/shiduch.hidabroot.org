<?
/**
 * Themes administration panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once( dirname( __FILE__ ) . '/admin.php' );

if ( !current_user_can('switch_themes') && !current_user_can('edit_theme_options') )
	wp_die( __( 'Cheatin&#8217; uh?' ) );

if ( current_user_can( 'switch_themes' ) && isset($_GET['action'] ) ) {
	if ( 'activate' == $_GET['action'] ) {
		check_admin_referer('switch-theme_' . $_GET['stylesheet']);
		$theme = wp_get_theme( $_GET['stylesheet'] );
		if ( ! $theme->exists() || ! $theme->is_allowed() )
			wp_die( __( 'Cheatin&#8217; uh?' ) );
		switch_theme( $theme->get_stylesheet() );
		wp_redirect( admin_url('themes.php?activated=true') );
		exit;
	} elseif ( 'delete' == $_GET['action'] ) {
		check_admin_referer('delete-theme_' . $_GET['stylesheet']);
		$theme = wp_get_theme( $_GET['stylesheet'] );
		if ( !current_user_can('delete_themes') || ! $theme->exists() )
			wp_die( __( 'Cheatin&#8217; uh?' ) );
		delete_theme($_GET['stylesheet']);
		wp_redirect( admin_url('themes.php?deleted=true') );
		exit;
	}
}

$title = __('Manage Themes');
$parent_file = 'themes.php';

// Help tab: Overview
if ( current_user_can( 'switch_themes' ) ) {
	$help_overview  = '<p>' . __( 'This screen is used for managing your installed themes. Aside from the default theme(s) included with your WordPress installation, themes are designed and developed by third parties.' ) . '</p>' .
		'<p>' . __( 'From this screen you can:' ) . '</p>' .
		'<ul><li>' . __( 'Hover or tap to see Activate and Live Preview buttons' ) . '</li>' .
		'<li>' . __( 'Click on the theme to see the theme name, version, author, description, tags, and the Delete link' ) . '</li>' .
		'<li>' . __( 'Click Customize for the current theme or Live Preview for any other theme to see a live preview' ) . '</li></ul>' .
		'<p>' . __( 'The current theme is displayed highlighted as the first theme.' ) . '</p>';

	get_current_screen()->add_help_tab( array(
		'id'      => 'overview',
		'title'   => __( 'Overview' ),
		'content' => $help_overview
	) );
} // switch_themes

// Help tab: Adding Themes
if ( current_user_can( 'install_themes' ) ) {
	if ( is_multisite() ) {
		$help_install = '<p>' . __('Installing themes on Multisite can only be done from the Network Admin section.') . '</p>';
	} else {
		$help_install = '<p>' . sprintf( __('If you would like to see more themes to choose from, click on the &#8220;Add New&#8221; button and you will be able to browse or search for additional themes from the <a href="%s" target="_blank">WordPress.org Theme Directory</a>. Themes in the WordPress.org Theme Directory are designed and developed by third parties, and are compatible with the license WordPress uses. Oh, and they&#8217;re free!'), 'https://wordpress.org/themes/' ) . '</p>';
	}

	get_current_screen()->add_help_tab( array(
		'id'      => 'adding-themes',
		'title'   => __('Adding Themes'),
		'content' => $help_install
	) );
} // install_themes

// Help tab: Previewing and Customizing
if ( current_user_can( 'edit_theme_options' ) ) {
	$help_customize =
		'<p>' . __( 'Tap or hover on any theme then click the Live Preview button to see a live preview of that theme and change theme options in a separate, full-screen view. You can also find a Live Preview button at the bottom of the theme details screen. Any installed theme can be previewed and customized in this way.' ) . '</p>'.
		'<p>' . __( 'The theme being previewed is fully interactive &mdash; navigate to different pages to see how the theme handles posts, archives, and other page templates. The settings may differ depending on what theme features the theme being previewed supports. To accept the new settings and activate the theme all in one step, click the Save &amp; Activate button above the menu.' ) . '</p>' .
		'<p>' . __( 'When previewing on smaller monitors, you can use the collapse icon at the bottom of the left-hand pane. This will hide the pane, giving you more room to preview your site in the new theme. To bring the pane back, click on the collapse icon again.' ) . '</p>';

	get_current_screen()->add_help_tab( array(
		'id'		=> 'customize-preview-themes',
		'title'		=> __( 'Previewing and Customizing' ),
		'content'	=> $help_customize
	) );
} // edit_theme_options

get_current_screen()->set_help_sidebar(
	'<p><strong>' . __( 'For more information:' ) . '</strong></p>' .
	'<p>' . __( '<a href="http://codex.wordpress.org/Using_Themes" target="_blank">Documentation on Using Themes</a>' ) . '</p>' .
	'<p>' . __( '<a href="https://wordpress.org/support/" target="_blank">Support Forums</a>' ) . '</p>'
);

if ( current_user_can( 'switch_themes' ) ) {
	$themes = wp_prepare_themes_for_js();
} else {
	$themes = wp_prepare_themes_for_js( array( wp_get_theme() ) );
}
wp_reset_vars( array( 'theme', 'search' ) );

wp_localize_script( 'theme', '_wpThemeSettings', array(
	'themes'   => $themes,
	'settings' => array(
		'canInstall'    => ( ! is_multisite() && current_user_can( 'install_themes' ) ),
		'installURI'    => ( ! is_multisite() && current_user_can( 'install_themes' ) ) ? admin_url( 'theme-install.php' ) : null,
		'confirmDelete' => __( "Are you sure you want to delete this theme?\n\nClick 'Cancel' to go back, 'OK' to confirm the delete." ),
		'adminUrl'      => parse_url( admin_url(), PHP_URL_PATH ),
	),
 	'l10n' => array(
 		'addNew' => __( 'Add New Theme' ),
 		'search'  => __( 'Search Installed Themes' ),
 		'searchPlaceholder' => __( 'Search installed themes...' ), // placeholder (no ellipsis)
  	),
) );

add_thickbox();
wp_enqueue_script( 'theme' );
wp_enqueue_script( 'customize-loader' );

require_once( ABSPATH . 'wp-admin/admin-header.php' );
?>

<div class="wrap">
	<h2><? esc_html_e( 'Themes' ); ?>
		<span class="theme-count"><? echo count( $themes ); ?></span>
	<? if ( ! is_multisite() && current_user_can( 'install_themes' ) ) : ?>
		<a href="<? echo admin_url( 'theme-install.php' ); ?>" class="hide-if-no-js add-new-h2"><? echo esc_html( _x( 'Add New', 'Add new theme' ) ); ?></a>
	<? endif; ?>
	</h2>
<?
if ( ! validate_current_theme() || isset( $_GET['broken'] ) ) : ?>
<div id="message1" class="updated"><p><? _e('The active theme is broken. Reverting to the default theme.'); ?></p></div>
<? elseif ( isset($_GET['activated']) ) :
		if ( isset( $_GET['previewed'] ) ) { ?>
		<div id="message2" class="updated"><p><? printf( __( 'Settings saved and theme activated. <a href="%s">Visit site</a>' ), home_url( '/' ) ); ?></p></div>
		<? } else { ?>
<div id="message2" class="updated"><p><? printf( __( 'New theme activated. <a href="%s">Visit site</a>' ), home_url( '/' ) ); ?></p></div><?
		}
	elseif ( isset($_GET['deleted']) ) : ?>
<div id="message3" class="updated"><p><? _e('Theme deleted.') ?></p></div>
<?
endif;

$ct = wp_get_theme();

if ( $ct->errors() && ( ! is_multisite() || current_user_can( 'manage_network_themes' ) ) ) {
	echo '<div class="error"><p>' . sprintf( __( 'ERROR: %s' ), $ct->errors()->get_error_message() ) . '</p></div>';
}

/*
// Certain error codes are less fatal than others. We can still display theme information in most cases.
if ( ! $ct->errors() || ( 1 == count( $ct->errors()->get_error_codes() )
	&& in_array( $ct->errors()->get_error_code(), array( 'theme_no_parent', 'theme_parent_invalid', 'theme_no_index' ) ) ) ) : ?>
*/

	// Pretend you didn't see this.
	$current_theme_actions = array();
	if ( is_array( $submenu ) && isset( $submenu['themes.php'] ) ) {
		foreach ( (array) $submenu['themes.php'] as $item) {
			$class = '';
			if ( 'themes.php' == $item[2] || 'theme-editor.php' == $item[2] || 'customize.php' == $item[2] )
				continue;
			// 0 = name, 1 = capability, 2 = file
			if ( ( strcmp($self, $item[2]) == 0 && empty($parent_file)) || ($parent_file && ($item[2] == $parent_file)) )
				$class = ' class="current"';
			if ( !empty($submenu[$item[2]]) ) {
				$submenu[$item[2]] = array_values($submenu[$item[2]]); // Re-index.
				$menu_hook = get_plugin_page_hook($submenu[$item[2]][0][2], $item[2]);
				if ( file_exists(WP_PLUGIN_DIR . "/{$submenu[$item[2]][0][2]}") || !empty($menu_hook))
					$current_theme_actions[] = "<a class='button button-secondary' href='admin.php?page={$submenu[$item[2]][0][2]}'$class>{$item[0]}</a>";
				else
					$current_theme_actions[] = "<a class='button button-secondary' href='{$submenu[$item[2]][0][2]}'$class>{$item[0]}</a>";
			} else if ( current_user_can($item[1]) ) {
				$menu_file = $item[2];
				if ( false !== ( $pos = strpos( $menu_file, '?' ) ) )
					$menu_file = substr( $menu_file, 0, $pos );
				if ( file_exists( ABSPATH . "wp-admin/$menu_file" ) ) {
					$current_theme_actions[] = "<a class='button button-secondary' href='{$item[2]}'$class>{$item[0]}</a>";
				} else {
					$current_theme_actions[] = "<a class='button button-secondary' href='themes.php?page={$item[2]}'$class>{$item[0]}</a>";
				}
			}
		}
	}

?>

<div class="theme-browser">
	<div class="themes">

<?
/*
 * This PHP is synchronized with the tmpl-theme template below!
 */

foreach ( $themes as $theme ) :
	$aria_action = esc_attr( $theme['id'] . '-action' );
	$aria_name   = esc_attr( $theme['id'] . '-name' );
	?>
<div class="theme<? if ( $theme['active'] ) echo ' active'; ?>" tabindex="0" aria-describedby="<? echo $aria_action . ' ' . $aria_name; ?>">
	<? if ( ! empty( $theme['screenshot'][0] ) ) { ?>
		<div class="theme-screenshot">
			<img src="<? echo $theme['screenshot'][0]; ?>" alt="" />
		</div>
	<? } else { ?>
		<div class="theme-screenshot blank"></div>
	<? } ?>
	<span class="more-details" id="<? echo $aria_action; ?>"><? _e( 'Theme Details' ); ?></span>
	<div class="theme-author"><? printf( __( 'By %s' ), $theme['author'] ); ?></div>

	<? if ( $theme['active'] ) { ?>
		<h3 class="theme-name" id="<? echo $aria_name; ?>"><span><? _ex( 'Active:', 'theme' ); ?></span> <? echo $theme['name']; ?></h3>
	<? } else { ?>
		<h3 class="theme-name" id="<? echo $aria_name; ?>"><? echo $theme['name']; ?></h3>
	<? } ?>

	<div class="theme-actions">

	<? if ( $theme['active'] ) { ?>
		<? if ( $theme['actions']['customize'] ) { ?>
			<a class="button button-primary customize load-customize hide-if-no-customize" href="<? echo $theme['actions']['customize']; ?>"><? _e( 'Customize' ); ?></a>
		<? } ?>
	<? } else { ?>
		<a class="button button-primary activate" href="<? echo $theme['actions']['activate']; ?>"><? _e( 'Activate' ); ?></a>
		<a class="button button-secondary load-customize hide-if-no-customize" href="<? echo $theme['actions']['customize']; ?>"><? _e( 'Live Preview' ); ?></a>
		<a class="button button-secondary hide-if-customize" href="<? echo $theme['actions']['preview']; ?>"><? _e( 'Preview' ); ?></a>
	<? } ?>

	</div>

	<? if ( $theme['hasUpdate'] ) { ?>
		<div class="theme-update"><? _e( 'Update Available' ); ?></div>
	<? } ?>
</div>
<? endforeach; ?>
	<br class="clear" />
	</div>
</div>
<div class="theme-overlay"></div>

<?
// List broken themes, if any.
if ( ! is_multisite() && current_user_can('edit_themes') && $broken_themes = wp_get_themes( array( 'errors' => true ) ) ) {
?>

<div class="broken-themes">
<h3><? _e('Broken Themes'); ?></h3>
<p><? _e('The following themes are installed but incomplete. Themes must have a stylesheet and a template.'); ?></p>

<table>
	<tr>
		<th><? _ex('Name', 'theme name'); ?></th>
		<th><? _e('Description'); ?></th>
	</tr>
<?
	foreach ( $broken_themes as $broken_theme ) {
		echo "
		<tr>
			 <td>" . ( $broken_theme->get( 'Name' ) ? $broken_theme->get( 'Name' ) : $broken_theme->get_stylesheet() ) . "</td>
			 <td>" . $broken_theme->errors()->get_error_message() . "</td>
		</tr>";
	}
?>
</table>
</div>

<?
}
?>
</div><!-- .wrap -->

<?
/*
 * The tmpl-theme template is synchronized with PHP above!
 */
?>
<script id="tmpl-theme" type="text/template">
	<# if ( data.screenshot[0] ) { #>
		<div class="theme-screenshot">
			<img src="{{ data.screenshot[0] }}" alt="" />
		</div>
	<# } else { #>
		<div class="theme-screenshot blank"></div>
	<# } #>
	<span class="more-details" id="{{ data.id }}-action"><? _e( 'Theme Details' ); ?></span>
	<div class="theme-author"><? printf( __( 'By %s' ), '{{{ data.author }}}' ); ?></div>

	<# if ( data.active ) { #>
		<h3 class="theme-name" id="{{ data.id }}-name"><span><? _ex( 'Active:', 'theme' ); ?></span> {{{ data.name }}}</h3>
	<# } else { #>
		<h3 class="theme-name" id="{{ data.id }}-name">{{{ data.name }}}</h3>
	<# } #>

	<div class="theme-actions">

	<# if ( data.active ) { #>
		<# if ( data.actions.customize ) { #>
			<a class="button button-primary customize load-customize hide-if-no-customize" href="{{ data.actions.customize }}"><? _e( 'Customize' ); ?></a>
		<# } #>
	<# } else { #>
		<a class="button button-primary activate" href="{{{ data.actions.activate }}}"><? _e( 'Activate' ); ?></a>
		<a class="button button-secondary load-customize hide-if-no-customize" href="{{{ data.actions.customize }}}"><? _e( 'Live Preview' ); ?></a>
		<a class="button button-secondary hide-if-customize" href="{{{ data.actions.preview }}}"><? _e( 'Preview' ); ?></a>
	<# } #>

	</div>

	<# if ( data.hasUpdate ) { #>
		<div class="theme-update"><? _e( 'Update Available' ); ?></div>
	<# } #>
</script>

<script id="tmpl-theme-single" type="text/template">
	<div class="theme-backdrop"></div>
	<div class="theme-wrap">
		<div class="theme-header">
			<button class="left dashicons dashicons-no"><span class="screen-reader-text"><? _e( 'Show previous theme' ); ?></span></button>
			<button class="right dashicons dashicons-no"><span class="screen-reader-text"><? _e( 'Show next theme' ); ?></span></button>
			<button class="close dashicons dashicons-no"><span class="screen-reader-text"><? _e( 'Close overlay' ); ?></span></button>
		</div>
		<div class="theme-about">
			<div class="theme-screenshots">
			<# if ( data.screenshot[0] ) { #>
				<div class="screenshot"><img src="{{ data.screenshot[0] }}" alt="" /></div>
			<# } else { #>
				<div class="screenshot blank"></div>
			<# } #>
			</div>

			<div class="theme-info">
				<# if ( data.active ) { #>
					<span class="current-label"><? _e( 'Current Theme' ); ?></span>
				<# } #>
				<h3 class="theme-name">{{{ data.name }}}<span class="theme-version"><? printf( __( 'Version: %s' ), '{{{ data.version }}}' ); ?></span></h3>
				<h4 class="theme-author"><? printf( __( 'By %s' ), '{{{ data.authorAndUri }}}' ); ?></h4>

				<# if ( data.hasUpdate ) { #>
				<div class="theme-update-message">
					<h4 class="theme-update"><? _e( 'Update Available' ); ?></h4>
					{{{ data.update }}}
				</div>
				<# } #>
				<p class="theme-description">{{{ data.description }}}</p>

				<# if ( data.parent ) { #>
					<p class="parent-theme"><? printf( __( 'This is a child theme of %s.' ), '<strong>{{{ data.parent }}}</strong>' ); ?></p>
				<# } #>

				<# if ( data.tags ) { #>
					<p class="theme-tags"><span><? _e( 'Tags:' ); ?></span> {{{ data.tags }}}</p>
				<# } #>
			</div>
		</div>

		<div class="theme-actions">
			<div class="active-theme">
				<a href="{{{ data.actions.customize }}}" class="button button-primary customize load-customize hide-if-no-customize"><? _e( 'Customize' ); ?></a>
				<? echo implode( ' ', $current_theme_actions ); ?>
			</div>
			<div class="inactive-theme">
				<# if ( data.actions.activate ) { #>
					<a href="{{{ data.actions.activate }}}" class="button button-primary activate"><? _e( 'Activate' ); ?></a>
				<# } #>
				<a href="{{{ data.actions.customize }}}" class="button button-secondary load-customize hide-if-no-customize"><? _e( 'Live Preview' ); ?></a>
				<a href="{{{ data.actions.preview }}}" class="button button-secondary hide-if-customize"><? _e( 'Preview' ); ?></a>
			</div>

			<# if ( ! data.active && data.actions['delete'] ) { #>
				<a href="{{{ data.actions['delete'] }}}" class="button button-secondary delete-theme"><? _e( 'Delete' ); ?></a>
			<# } #>
		</div>
	</div>
</script>

<? require( ABSPATH . 'wp-admin/admin-footer.php' ); ?>
