<?
$arr_post = (array) $post;
$gender = CardHelpers::get_gender($arr_post);
$MCard = new $gender($arr_post);
?>

<article id="post-<? the_ID(); ?>" <? post_class(); ?>>
	<div id="card-meta">
		<? $MCard -> list_meta() ?>
		<div id="card-content">
			<h2><?= $MCard::$labels['Little_About_The_Candidate'] ?></h2>
			<? the_content() ?>
		</div>
	</div>
	<div id="card-side">
		<div id="card-avatar">
			<div id="card-title" class="title"><? the_title() ?></div>
			<div id="card-image">
				<img src="<?= WP_CONTENT_URL ?>/themes/matchrepo/media/<?= $MCard ->images['recent_cards'] ?>">
			</div>
		</div>
		<div class="card-side-box">
			<div class="title"><?= stripslashes(__('This Card Managed By', THEME_NAME)) ?></div>
			<div class="cdb-content"></div>
		</div>
		<div class="card-side-box">
			<div class="title"><? _e('Contact Details', THEME_NAME) ?></div>
			<div class="cdb-content"></div>
		</div>
	</div>

	<footer class="entry-footer">
		<?
		/* translators: used between list items, there is a space after the comma */
		$category_list = get_the_category_list(__(', ', THEME_NAME));

		/* translators: used between list items, there is a space after the comma */
		$tag_list = get_the_tag_list('', __(', ', THEME_NAME));

		if(!Matchrepo_categorized_blog()){
			// This blog only has 1 category so we just need to worry about tags in the meta text
			if('' != $tag_list){
				$meta_text = __('This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', THEME_NAME);
			}
			else{
				$meta_text = __('Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', THEME_NAME);
			}

		}
		else{
			// But this blog has loads of categories so we should probably display them here
			if('' != $tag_list){
				$meta_text = __('This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', THEME_NAME);
			}
			else{
				$meta_text = __('This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', THEME_NAME);
			}

		} // end check for categories on this blog

		printf(
			$meta_text,
			$category_list,
			$tag_list,
			get_permalink()
		);
		?>

		<? edit_post_link(__('Edit', THEME_NAME), '<span class="edit-link">', '</span>'); ?>
	</footer>
	<!-- .entry-footer -->
</article><!-- #post-## -->
