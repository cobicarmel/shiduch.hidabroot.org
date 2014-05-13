<?

/*
*  Meta box - options
*
*  This template file is used when editing a field group and creates the interface for editing options.
*
*  @type	template
*  @date	23/06/12
*/


// global
global $post;

	
// vars
$options = apply_filters('acf/field_group/get_options', array(), $post->ID);
	

?>
<table class="acf_input widefat" id="acf_options">
	<tr>
		<td class="label">
			<label for=""><? _e("Order No.",'acf'); ?></label>
			<p class="description"><? _e("Field groups are created in order <br />from lowest to highest",'acf'); ?></p>
		</td>
		<td>
			<?
			
			do_action('acf/create_field', array(
				'type'	=>	'number',
				'name'	=>	'menu_order',
				'value'	=>	$post->menu_order,
			));
			
			?>
		</td>
	</tr>
	<tr>
		<td class="label">
			<label for=""><? _e("Position",'acf'); ?></label>
		</td>
		<td>
			<?
			
			do_action('acf/create_field', array(
				'type'	=>	'select',
				'name'	=>	'options[position]',
				'value'	=>	$options['position'],
				'choices' => array(
					'acf_after_title'	=>	__("High (after title)",'acf'),
					'normal'			=>	__("Normal (after content)",'acf'),
					'side'				=>	__("Side",'acf'),
				),
				'default_value' => 'normal'
			));

			?>
		</td>
	</tr>
	<tr>
		<td class="label">
			<label for="post_type"><? _e("Style",'acf'); ?></label>
		</td>
		<td>
			<?
			
			do_action('acf/create_field', array(
				'type'	=>	'select',
				'name'	=>	'options[layout]',
				'value'	=>	$options['layout'],
				'choices' => array(
					'no_box'			=>	__("Seamless (no metabox)",'acf'),
					'default'			=>	__("Standard (WP metabox)",'acf'),
				)
			));
			
			?>
		</td>
	</tr>
	<tr id="hide-on-screen">
		<td class="label">
			<label for="post_type"><? _e("Hide on screen",'acf'); ?></label>
			<p class="description"><? _e("<b>Select</b> items to <b>hide</b> them from the edit screen",'acf'); ?></p>
			<p class="description"><? _e("If multiple field groups appear on an edit screen, the first field group's options will be used. (the one with the lowest order number)",'acf'); ?></p>
		</td>
		<td>
			<?
			
			do_action('acf/create_field', array(
				'type'	=>	'checkbox',
				'name'	=>	'options[hide_on_screen]',
				'value'	=>	$options['hide_on_screen'],
				'choices' => array(
					'permalink'			=>	__("Permalink", 'acf'),
					'the_content'		=>	__("Content Editor",'acf'),
					'excerpt'			=>	__("Excerpt", 'acf'),
					'custom_fields'		=>	__("Custom Fields", 'acf'),
					'discussion'		=>	__("Discussion", 'acf'),
					'comments'			=>	__("Comments", 'acf'),
					'revisions'			=>	__("Revisions", 'acf'),
					'slug'				=>	__("Slug", 'acf'),
					'author'			=>	__("Author", 'acf'),
					'format'			=>	__("Format", 'acf'),
					'featured_image'	=>	__("Featured Image", 'acf'),
					'categories'		=>	__("Categories", 'acf'),
					'tags'				=>	__("Tags", 'acf'),
					'send-trackbacks'	=>	__("Send Trackbacks", 'acf'),
				)
			));
			
			?>
		</td>
	</tr>
</table>