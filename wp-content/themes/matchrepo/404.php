<?

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><? _e( 'Oops! That page can&rsquo;t be found.', THEME_NAME ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><? _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', THEME_NAME ); ?></p>

					<? get_search_form(); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
<? get_sidebar() ?>
<? get_footer(); ?>