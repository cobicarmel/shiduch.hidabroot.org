<?
/**
 * Edit tag form for inclusion in administration panels.
 *
 * @package WordPress
 * @subpackage Administration
 */

// don't load directly
if ( !defined('ABSPATH') )
	die('-1');

if ( empty($tag_ID) ) { ?>
	<div id="message" class="updated"><p><strong><? _e( 'You did not select an item for editing.' ); ?></strong></p></div>
<?
	return;
}

// Back compat hooks
if ( 'category' == $taxonomy ) {
	/**
 	 * Fires before the Edit Category form.
	 *
	 * @since 2.1.0
	 * @deprecated 3.0.0 Use {$taxonomy}_pre_edit_form instead.
	 *
	 * @param object $tag Current category term object.
	 */
	do_action( 'edit_category_form_pre', $tag );
} elseif ( 'link_category' == $taxonomy ) {
	/**
	 * Fires before the Edit Link Category form.
	 *
	 * @since 2.3.0
	 * @deprecated 3.0.0 Use {$taxonomy}_pre_edit_form instead.
	 *
	 * @param object $tag Current link category term object.
	 */
	do_action( 'edit_link_category_form_pre', $tag );
} else {
	/**
	 * Fires before the Edit Tag form.
	 *
	 * @since 2.5.0
	 * @deprecated 3.0.0 Use {$taxonomy}_pre_edit_form instead.
	 *
	 * @param object $tag Current tag term object.
	 */
	do_action( 'edit_tag_form_pre', $tag );
}
/**
 * Fires before the Edit Term form for all taxonomies.
 *
 * The dynamic portion of the hook name, $taxonomy, refers to
 * the taxonomy slug.
 *
 * @since 3.0.0
 *
 * @param object $tag      Current taxonomy term object.
 * @param string $taxonomy Current $taxonomy slug.
 */
do_action( "{$taxonomy}_pre_edit_form", $tag, $taxonomy ); ?>

<div class="wrap">
<h2><? echo $tax->labels->edit_item; ?></h2>
<div id="ajax-response"></div>
<?
/**
 * Fires inside the Edit Term form tag.
 *
 * The dynamic portion of the hook name, $taxonomy, refers to
 * the taxonomy slug.
 *
 * @since 3.7.0
 */
?>
<form name="edittag" id="edittag" method="post" action="edit-tags.php" class="validate"<? do_action( "{$taxonomy}_term_edit_form_tag" ); ?>>
<input type="hidden" name="action" value="editedtag" />
<input type="hidden" name="tag_ID" value="<? echo esc_attr($tag->term_id) ?>" />
<input type="hidden" name="taxonomy" value="<? echo esc_attr($taxonomy) ?>" />
<? wp_original_referer_field(true, 'previous'); wp_nonce_field('update-tag_' . $tag_ID); ?>
	<table class="form-table">
		<tr class="form-field form-required">
			<th scope="row"><label for="name"><? _ex('Name', 'Taxonomy Name'); ?></label></th>
			<td><input name="name" id="name" type="text" value="<? if ( isset( $tag->name ) ) echo esc_attr($tag->name); ?>" size="40" aria-required="true" />
			<p class="description"><? _e('The name is how it appears on your site.'); ?></p></td>
		</tr>
<? if ( !global_terms_enabled() ) { ?>
		<tr class="form-field">
			<th scope="row"><label for="slug"><? _ex('Slug', 'Taxonomy Slug'); ?></label></th>
			<?
			/**
			 * Filter the editable term slug.
			 *
			 * @since 2.6.0
			 *
			 * @param string $slug The current term slug.
			 */
			?>
			<td><input name="slug" id="slug" type="text" value="<? if ( isset( $tag->slug ) ) echo esc_attr( apply_filters( 'editable_slug', $tag->slug ) ); ?>" size="40" />
			<p class="description"><? _e('The &#8220;slug&#8221; is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.'); ?></p></td>
		</tr>
<? } ?>
<? if ( is_taxonomy_hierarchical($taxonomy) ) : ?>
		<tr class="form-field">
			<th scope="row"><label for="parent"><? _ex('Parent', 'Taxonomy Parent'); ?></label></th>
			<td>
				<? wp_dropdown_categories(array('hide_empty' => 0, 'hide_if_empty' => false, 'name' => 'parent', 'orderby' => 'name', 'taxonomy' => $taxonomy, 'selected' => $tag->parent, 'exclude_tree' => $tag->term_id, 'hierarchical' => true, 'show_option_none' => __('None'))); ?>
				<? if ( 'category' == $taxonomy ) : ?>
				<p class="description"><? _e('Categories, unlike tags, can have a hierarchy. You might have a Jazz category, and under that have children categories for Bebop and Big Band. Totally optional.'); ?></p>
				<? endif; ?>
			</td>
		</tr>
<? endif; // is_taxonomy_hierarchical() ?>
		<tr class="form-field">
			<th scope="row"><label for="description"><? _ex('Description', 'Taxonomy Description'); ?></label></th>
			<td><textarea name="description" id="description" rows="5" cols="50" class="large-text"><? echo $tag->description; // textarea_escaped ?></textarea><br />
			<span class="description"><? _e('The description is not prominent by default; however, some themes may show it.'); ?></span></td>
		</tr>
		<?
		// Back compat hooks
		if ( 'category' == $taxonomy ) {
			/**
			 * Fires after the Edit Category form fields are displayed.
			 *
			 * @since 2.9.0
			 * @deprecated 3.0.0 Use {$taxonomy}_edit_form_fields instead.
			 *
			 * @param object $tag Current category term object.
			 */
			do_action( 'edit_category_form_fields', $tag );
		} elseif ( 'link_category' == $taxonomy ) {
			/**
			 * Fires after the Edit Link Category form fields are displayed.
			 *
			 * @since 2.9.0
			 * @deprecated 3.0.0 Use {$taxonomy}_edit_form_fields instead.
			 *
			 * @param object $tag Current link category term object.
			 */
			do_action( 'edit_link_category_form_fields', $tag );
		} else {
			/**
			 * Fires after the Edit Tag form fields are displayed.
			 *
			 * @since 2.9.0
			 * @deprecated 3.0.0 Use {$taxonomy}_edit_form_fields instead.
			 *
			 * @param object $tag Current tag term object.
			 */
			do_action( 'edit_tag_form_fields', $tag );
		}
		/**
		 * Fires after the Edit Term form fields are displayed.
		 *
		 * The dynamic portion of the hook name, $taxonomy, refers to
		 * the taxonomy slug.
		 *
		 * @since 3.0.0
		 *
		 * @param object $tag      Current taxonomy term object.
		 * @param string $taxonomy Current taxonomy slug.
		 */
		do_action( "{$taxonomy}_edit_form_fields", $tag, $taxonomy );
		?>
	</table>
<?
// Back compat hooks
if ( 'category' == $taxonomy ) {
	/** This action is documented in wp-admin/edit-tags.php */
	do_action( 'edit_category_form', $tag );
} elseif ( 'link_category' == $taxonomy ) {
	/** This action is documented in wp-admin/edit-tags.php */
	do_action( 'edit_link_category_form', $tag );
} else {
	/**
	 * Fires at the end of the Edit Term form.
	 *
	 * @since 2.5.0
	 * @deprecated 3.0.0 Use {$taxonomy}_edit_form instead.
	 *
	 * @param object $tag Current taxonomy term object.
	 */
	do_action( 'edit_tag_form', $tag );
}
/**
 * Fires at the end of the Edit Term form for all taxonomies.
 *
 * The dynamic portion of the hook name, $taxonomy, refers to the taxonomy slug.
 *
 * @since 3.0.0
 *
 * @param object $tag      Current taxonomy term object.
 * @param string $taxonomy Current taxonomy slug.
 */
do_action( "{$taxonomy}_edit_form", $tag, $taxonomy );

submit_button( __('Update') );
?>
</form>
</div>
<script type="text/javascript">
try{document.forms.edittag.name.focus();}catch(e){}
</script>
