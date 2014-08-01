<?

wp_enqueue_style('404', get_stylesheet_directory_uri() . '/css/404.css');

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<div><? _e( 'Oops! That page can&rsquo;t be found.', THEME_NAME ); ?></div>
				</header>
			</section>

		</main>
	</div>
<? get_sidebar() ?>
<? get_footer(); ?>