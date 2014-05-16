<?
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<? if ( get_header_image() ) : ?>
	<a href="<? echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<? header_image(); ?>" width="<? echo get_custom_header()->width; ?>" height="<? echo get_custom_header()->height; ?>" alt="">
	</a>
	<? endif; // End header image check. ?>

 *
 * @package Matchrepo
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses Matchrepo_header_style()
 * @uses Matchrepo_admin_header_style()
 * @uses Matchrepo_admin_header_image()
 */
function Matchrepo_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'Matchrepo_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'Matchrepo_header_style',
		'admin-head-callback'    => 'Matchrepo_admin_header_style',
		'admin-preview-callback' => 'Matchrepo_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'Matchrepo_custom_header_setup' );

if ( ! function_exists( 'Matchrepo_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see Matchrepo_custom_header_setup().
 */
function Matchrepo_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<? echo $header_text_color; ?>;
		}
	<? endif; ?>
	</style>
	<?
}
endif; // Matchrepo_header_style

if ( ! function_exists( 'Matchrepo_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see Matchrepo_custom_header_setup().
 */
function Matchrepo_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?
}
endif; // Matchrepo_admin_header_style

if ( ! function_exists( 'Matchrepo_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see Matchrepo_custom_header_setup().
 */
function Matchrepo_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<h1 class="displaying-header-text"><a id="name"<? echo $style; ?> onclick="return false;" href="<? echo esc_url( home_url( '/' ) ); ?>"><? bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"<? echo $style; ?>><? bloginfo( 'description' ); ?></div>
		<? if ( get_header_image() ) : ?>
		<img src="<? header_image(); ?>" alt="">
		<? endif; ?>
	</div>
<?
}
endif; // Matchrepo_admin_header_image
