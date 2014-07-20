<article>
	<h1><? the_title() ?></h1>

	<div id="excerpt"><? the_excerpt() ?></div>
	<div id="main-image">
		<? the_post_thumbnail('medium') ?>
	</div>
	<div id="article-content">
		<? the_content(); ?>
	</div>
</article>