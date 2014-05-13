<?
/**
 * General settings administration panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once( dirname( __FILE__ ) . '/admin.php' );

if ( ! current_user_can( 'manage_options' ) )
	wp_die( __( 'You do not have sufficient permissions to manage options for this site.' ) );

$title = __('General Settings');
$parent_file = 'options-general.php';
/* translators: date and time format for exact current time, mainly about timezones, see http://php.net/date */
$timezone_format = _x('Y-m-d G:i:s', 'timezone date format');

/**
 * Display JavaScript on the page.
 *
 * @since 3.5.0
 */
function options_general_add_js() {
?>
<script type="text/javascript">
//<![CDATA[
	jQuery(document).ready(function($){
		$("input[name='date_format']").click(function(){
			if ( "date_format_custom_radio" != $(this).attr("id") )
				$("input[name='date_format_custom']").val( $(this).val() ).siblings('.example').text( $(this).siblings('span').text() );
		});
		$("input[name='date_format_custom']").focus(function(){
			$( '#date_format_custom_radio' ).prop( 'checked', true );
		});

		$("input[name='time_format']").click(function(){
			if ( "time_format_custom_radio" != $(this).attr("id") )
				$("input[name='time_format_custom']").val( $(this).val() ).siblings('.example').text( $(this).siblings('span').text() );
		});
		$("input[name='time_format_custom']").focus(function(){
			$( '#time_format_custom_radio' ).prop( 'checked', true );
		});
		$("input[name='date_format_custom'], input[name='time_format_custom']").change( function() {
			var format = $(this);
			format.siblings('.spinner').css('display', 'inline-block'); // show(); can't be used here
			$.post(ajaxurl, {
					action: 'date_format_custom' == format.attr('name') ? 'date_format' : 'time_format',
					date : format.val()
				}, function(d) { format.siblings('.spinner').hide(); format.siblings('.example').text(d); } );
		});
	});
//]]>
</script>
<?
}
add_action('admin_head', 'options_general_add_js');

$options_help = '<p>' . __('The fields on this screen determine some of the basics of your site setup.') . '</p>' .
	'<p>' . __('Most themes display the site title at the top of every page, in the title bar of the browser, and as the identifying name for syndicated feeds. The tagline is also displayed by many themes.') . '</p>';

if ( ! is_multisite() ) {
	$options_help .= '<p>' . __('The WordPress URL and the Site URL can be the same (example.com) or different; for example, having the WordPress core files (example.com/wordpress) in a subdirectory instead of the root directory.') . '</p>' .
		'<p>' . __('If you want site visitors to be able to register themselves, as opposed to by the site administrator, check the membership box. A default user role can be set for all new users, whether self-registered or registered by the site admin.') . '</p>';
}

$options_help .= '<p>' . __('UTC means Coordinated Universal Time.') . '</p>' .
	'<p>' . __( 'You must click the Save Changes button at the bottom of the screen for new settings to take effect.' ) . '</p>';

get_current_screen()->add_help_tab( array(
	'id'      => 'overview',
	'title'   => __('Overview'),
	'content' => $options_help,
) );

get_current_screen()->set_help_sidebar(
	'<p><strong>' . __('For more information:') . '</strong></p>' .
	'<p>' . __('<a href="http://codex.wordpress.org/Settings_General_Screen" target="_blank">Documentation on General Settings</a>') . '</p>' .
	'<p>' . __('<a href="https://wordpress.org/support/" target="_blank">Support Forums</a>') . '</p>'
);

include( ABSPATH . 'wp-admin/admin-header.php' );
?>

<div class="wrap">
<h2><? echo esc_html( $title ); ?></h2>

<form method="post" action="options.php">
<? settings_fields('general'); ?>

<table class="form-table">
<tr>
<th scope="row"><label for="blogname"><? _e('Site Title') ?></label></th>
<td><input name="blogname" type="text" id="blogname" value="<? form_option('blogname'); ?>" class="regular-text" /></td>
</tr>
<tr>
<th scope="row"><label for="blogdescription"><? _e('Tagline') ?></label></th>
<td><input name="blogdescription" type="text" id="blogdescription" value="<? form_option('blogdescription'); ?>" class="regular-text" />
<p class="description"><? _e('In a few words, explain what this site is about.') ?></p></td>
</tr>
<? if ( !is_multisite() ) { ?>
<tr>
<th scope="row"><label for="siteurl"><? _e('WordPress Address (URL)') ?></label></th>
<td><input name="siteurl" type="text" id="siteurl" value="<? form_option('siteurl'); ?>"<? disabled( defined( 'WP_SITEURL' ) ); ?> class="regular-text code<? if ( defined( 'WP_SITEURL' ) ) echo ' disabled' ?>" /></td>
</tr>
<tr>
<th scope="row"><label for="home"><? _e('Site Address (URL)') ?></label></th>
<td><input name="home" type="text" id="home" value="<? form_option('home'); ?>"<? disabled( defined( 'WP_HOME' ) ); ?> class="regular-text code<? if ( defined( 'WP_HOME' ) ) echo ' disabled' ?>" />
<p class="description"><? _e('Enter the address here if you want your site homepage <a href="http://codex.wordpress.org/Giving_WordPress_Its_Own_Directory">to be different from the directory</a> you installed WordPress.'); ?></p></td>
</tr>
<tr>
<th scope="row"><label for="admin_email"><? _e('E-mail Address') ?> </label></th>
<td><input name="admin_email" type="text" id="admin_email" value="<? form_option('admin_email'); ?>" class="regular-text ltr" />
<p class="description"><? _e('This address is used for admin purposes, like new user notification.') ?></p></td>
</tr>
<tr>
<th scope="row"><? _e('Membership') ?></th>
<td> <fieldset><legend class="screen-reader-text"><span><? _e('Membership') ?></span></legend><label for="users_can_register">
<input name="users_can_register" type="checkbox" id="users_can_register" value="1" <? checked('1', get_option('users_can_register')); ?> />
<? _e('Anyone can register') ?></label>
</fieldset></td>
</tr>
<tr>
<th scope="row"><label for="default_role"><? _e('New User Default Role') ?></label></th>
<td>
<select name="default_role" id="default_role"><? wp_dropdown_roles( get_option('default_role') ); ?></select>
</td>
</tr>
<? } else { ?>
<tr>
<th scope="row"><label for="new_admin_email"><? _e('E-mail Address') ?> </label></th>
<td><input name="new_admin_email" type="text" id="new_admin_email" value="<? form_option('admin_email'); ?>" class="regular-text ltr" />
<p class="description"><? _e('This address is used for admin purposes. If you change this we will send you an e-mail at your new address to confirm it. <strong>The new address will not become active until confirmed.</strong>') ?></p>
<?
$new_admin_email = get_option( 'new_admin_email' );
if ( $new_admin_email && $new_admin_email != get_option('admin_email') ) : ?>
<div class="updated inline">
<p><? printf( __('There is a pending change of the admin e-mail to <code>%1$s</code>. <a href="%2$s">Cancel</a>'), esc_html( $new_admin_email ), esc_url( admin_url( 'options.php?dismiss=new_admin_email' ) ) ); ?></p>
</div>
<? endif; ?>
</td>
</tr>
<? } ?>
<tr>
<?
$current_offset = get_option('gmt_offset');
$tzstring = get_option('timezone_string');

$check_zone_info = true;

// Remove old Etc mappings. Fallback to gmt_offset.
if ( false !== strpos($tzstring,'Etc/GMT') )
	$tzstring = '';

if ( empty($tzstring) ) { // Create a UTC+- zone if no timezone string exists
	$check_zone_info = false;
	if ( 0 == $current_offset )
		$tzstring = 'UTC+0';
	elseif ($current_offset < 0)
		$tzstring = 'UTC' . $current_offset;
	else
		$tzstring = 'UTC+' . $current_offset;
}

?>
<th scope="row"><label for="timezone_string"><? _e('Timezone') ?></label></th>
<td>

<select id="timezone_string" name="timezone_string">
<? echo wp_timezone_choice($tzstring); ?>
</select>

	<span id="utc-time"><? printf(__('<abbr title="Coordinated Universal Time">UTC</abbr> time is <code>%s</code>'), date_i18n($timezone_format, false, 'gmt')); ?></span>
<? if ( get_option('timezone_string') || !empty($current_offset) ) : ?>
	<span id="local-time"><? printf(__('Local time is <code>%1$s</code>'), date_i18n($timezone_format)); ?></span>
<? endif; ?>
<p class="description"><? _e('Choose a city in the same timezone as you.'); ?></p>
<? if ($check_zone_info && $tzstring) : ?>
<br />
<span>
	<?
	// Set TZ so localtime works.
	date_default_timezone_set($tzstring);
	$now = localtime(time(), true);
	if ( $now['tm_isdst'] )
		_e('This timezone is currently in daylight saving time.');
	else
		_e('This timezone is currently in standard time.');
	?>
	<br />
	<?
	$allowed_zones = timezone_identifiers_list();

	if ( in_array( $tzstring, $allowed_zones) ) {
		$found = false;
		$date_time_zone_selected = new DateTimeZone($tzstring);
		$tz_offset = timezone_offset_get($date_time_zone_selected, date_create());
		$right_now = time();
		foreach ( timezone_transitions_get($date_time_zone_selected) as $tr) {
			if ( $tr['ts'] > $right_now ) {
			    $found = true;
				break;
			}
		}

		if ( $found ) {
			echo ' ';
			$message = $tr['isdst'] ?
				__('Daylight saving time begins on: <code>%s</code>.') :
				__('Standard time begins on: <code>%s</code>.');
			// Add the difference between the current offset and the new offset to ts to get the correct transition time from date_i18n().
			printf( $message, date_i18n(get_option('date_format') . ' ' . get_option('time_format'), $tr['ts'] + ($tz_offset - $tr['offset']) ) );
		} else {
			_e('This timezone does not observe daylight saving time.');
		}
	}
	// Set back to UTC.
	date_default_timezone_set('UTC');
	?>
	</span>
<? endif; ?>
</td>

</tr>
<tr>
<th scope="row"><? _e('Date Format') ?></th>
<td>
	<fieldset><legend class="screen-reader-text"><span><? _e('Date Format') ?></span></legend>
<?
	/**
	* Filter the default date formats.
	*
	* @since 2.7.0
	*
	* @param array $default_date_formats Array of default date formats.
	*/
	$date_formats = array_unique( apply_filters( 'date_formats', array( __( 'F j, Y' ), 'Y/m/d', 'm/d/Y', 'd/m/Y' ) ) );

	$custom = true;

	foreach ( $date_formats as $format ) {
		echo "\t<label title='" . esc_attr($format) . "'><input type='radio' name='date_format' value='" . esc_attr($format) . "'";
		if ( get_option('date_format') === $format ) { // checked() uses "==" rather than "==="
			echo " checked='checked'";
			$custom = false;
		}
		echo ' /> <span>' . date_i18n( $format ) . "</span></label><br />\n";
	}

	echo '	<label><input type="radio" name="date_format" id="date_format_custom_radio" value="\c\u\s\t\o\m"';
	checked( $custom );
	echo '/> ' . __('Custom:') . ' </label><input type="text" name="date_format_custom" value="' . esc_attr( get_option('date_format') ) . '" class="small-text" /> <span class="example"> ' . date_i18n( get_option('date_format') ) . "</span> <span class='spinner'></span>\n";

	echo "\t<p>" . __('<a href="http://codex.wordpress.org/Formatting_Date_and_Time">Documentation on date and time formatting</a>.') . "</p>\n";
?>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row"><? _e('Time Format') ?></th>
<td>
	<fieldset><legend class="screen-reader-text"><span><? _e('Time Format') ?></span></legend>
<?
	/**
	* Filter the default time formats.
	*
	* @since 2.7.0
	*
	* @param array $default_time_formats Array of default time formats.
	*/
	$time_formats = array_unique( apply_filters( 'time_formats', array( __( 'g:i a' ), 'g:i A', 'H:i' ) ) );

	$custom = true;

	foreach ( $time_formats as $format ) {
		echo "\t<label title='" . esc_attr($format) . "'><input type='radio' name='time_format' value='" . esc_attr($format) . "'";
		if ( get_option('time_format') === $format ) { // checked() uses "==" rather than "==="
			echo " checked='checked'";
			$custom = false;
		}
		echo ' /> <span>' . date_i18n( $format ) . "</span></label><br />\n";
	}

	echo '	<label><input type="radio" name="time_format" id="time_format_custom_radio" value="\c\u\s\t\o\m"';
	checked( $custom );
	echo '/> ' . __('Custom:') . ' </label><input type="text" name="time_format_custom" value="' . esc_attr( get_option('time_format') ) . '" class="small-text" /> <span class="example"> ' . date_i18n( get_option('time_format') ) . "</span> <span class='spinner'></span>\n";
	;
?>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row"><label for="start_of_week"><? _e('Week Starts On') ?></label></th>
<td><select name="start_of_week" id="start_of_week">
<?
for ($day_index = 0; $day_index <= 6; $day_index++) :
	$selected = (get_option('start_of_week') == $day_index) ? 'selected="selected"' : '';
	echo "\n\t<option value='" . esc_attr($day_index) . "' $selected>" . $wp_locale->get_weekday($day_index) . '</option>';
endfor;
?>
</select></td>
</tr>
<? do_settings_fields('general', 'default'); ?>
<?
	$languages = get_available_languages();
	if ( is_multisite() && !empty( $languages ) ):
?>
	<tr>
		<th width="33%" scope="row"><? _e('Site Language') ?></th>
		<td>
			<select name="WPLANG" id="WPLANG">
				<? mu_dropdown_languages( $languages, get_option('WPLANG') ); ?>
			</select>
		</td>
	</tr>
<?
	endif;
?>
</table>

<? do_settings_sections('general'); ?>

<? submit_button(); ?>
</form>

</div>

<? include( ABSPATH . 'wp-admin/admin-footer.php' ); ?>
