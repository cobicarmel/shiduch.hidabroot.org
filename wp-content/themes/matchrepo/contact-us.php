<?

/*
Template Name: צור קשר
*/

wp_register_style('contact-us', get_stylesheet_directory_uri() . '/css/contact-us.css');

wp_enqueue_style('contact-us');

add_filter('wpcf7_load_js', '__return_true');

add_filter('wpcf7_load_css', '__return_true');

wpcf7_enqueue_scripts();

wpcf7_enqueue_styles();

get_header();

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?= do_shortcode('[contact-form-7 id="140" title="Contact Form"]') ?>
		</main>
		<!-- #main -->
	</div><!-- #primary -->

<? get_sidebar(); ?>
<? get_footer(); ?>