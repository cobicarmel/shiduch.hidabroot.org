<?
/* Template Name: עמוד ראשי */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div id="main-image">
			<?
			$mainImage = get_field('main_image');
			echo "<img src='$mainImage[url]' title='$mainImage[title]' alt='$mainImage[alt]'>";
			?>
		</div>

	</main><!-- #main -->
</div><!-- #primary -->

<? get_sidebar(); ?>
<? get_footer(); ?>