<?

class acf_field_google_map extends acf_field
{
	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function __construct()
	{
		// vars
		$this->name = 'google_map';
		$this->label = __("Google Map",'acf');
		$this->category = __("jQuery",'acf');
		$this->defaults = array(
			'height'		=> '',
			'center_lat'	=> '',
			'center_lng'	=> '',
			'zoom'			=> ''
		);
		$this->default_values = array(
			'height'		=> '400',
			'center_lat'	=> '-37.81411',
			'center_lng'	=> '144.96328',
			'zoom'			=> '14'
		);
		$this->l10n = array(
			'locating'			=>	__("Locating",'acf'),
			'browser_support'	=>	__("Sorry, this browser does not support geolocation",'acf'),
		);
		
		
		// do not delete!
    	parent::__construct();
	}
	
	
	/*
	*  create_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field - an array holding all the field's data
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function create_field( $field )
	{
		// require the googlemaps JS ( this script is now lazy loaded via JS )
		//wp_enqueue_script('acf-googlemaps');
		
		
		// default value
		if( !is_array($field['value']) )
		{
			$field['value'] = array();
		}
		
		$field['value'] = wp_parse_args($field['value'], array(
			'address'	=> '',
			'lat'		=> '',
			'lng'		=> ''
		));
		
		
		// default options
		foreach( $this->default_values as $k => $v )
		{
			if( ! $field[ $k ] )
			{
				$field[ $k ] = $v;
			}	
		}
		
		
		// vars
		$o = array(
			'class'		=>	'',
		);
		
		if( $field['value']['address'] )
		{
			$o['class'] = 'active';
		}
		
		
		$atts = '';
		$keys = array( 
			'data-id'	=> 'id', 
			'data-lat'	=> 'center_lat',
			'data-lng'	=> 'center_lng',
			'data-zoom'	=> 'zoom'
		);
		
		foreach( $keys as $k => $v )
		{
			$atts .= ' ' . $k . '="' . esc_attr( $field[ $v ] ) . '"';	
		}
		
		?>
		<div class="acf-google-map <? echo $o['class']; ?>" <? echo $atts; ?>>
			
			<div style="display:none;">
				<? foreach( $field['value'] as $k => $v ): ?>
					<input type="hidden" class="input-<? echo $k; ?>" name="<? echo esc_attr($field['name']); ?>[<? echo $k; ?>]" value="<? echo esc_attr( $v ); ?>" />
				<? endforeach; ?>
			</div>
			
			<div class="title">
				
				<div class="has-value">
					<a href="#" class="acf-sprite-remove ir" title="<? _e("Clear location",'acf'); ?>">Remove</a>
					<h4><? echo $field['value']['address']; ?></h4>
				</div>
				
				<div class="no-value">
					<a href="#" class="acf-sprite-locate ir" title="<? _e("Find current location",'acf'); ?>">Locate</a>
					<input type="text" placeholder="<? _e("Search for address...",'acf'); ?>" class="search" />
				</div>
				
			</div>
			
			<div class="canvas" style="height: <? echo $field['height']; ?>px">
				
			</div>
			
		</div>
		<?
	}
	
	
	
	/*
	*  create_options()
	*
	*  Create extra options for your field. This is rendered when editing a field.
	*  The value of $field['name'] can be used (like bellow) to save extra data to the $field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field	- an array holding all the field's data
	*/
	
	function create_options( $field )
	{
		// vars
		$key = $field['name'];
		
		?>
<tr class="field_option field_option_<? echo $this->name; ?>">
	<td class="label">
		<label><? _e("Center",'acf'); ?></label>
		<p class="description"><? _e('Center the initial map','acf'); ?></p>
	</td>
	<td>
		<ul class="hl clearfix">
			<li style="width:48%;">
				<?
			
				do_action('acf/create_field', array(
					'type'			=> 'text',
					'name'			=> 'fields['.$key.'][center_lat]',
					'value'			=> $field['center_lat'],
					'prepend'		=> 'lat',
					'placeholder'	=> $this->default_values['center_lat']
				));
				
				?>
			</li>
			<li style="width:48%; margin-left:4%;">
				<?
			
				do_action('acf/create_field', array(
					'type'			=> 'text',
					'name'			=> 'fields['.$key.'][center_lng]',
					'value'			=> $field['center_lng'],
					'prepend'		=> 'lng',
					'placeholder'	=> $this->default_values['center_lng']
				));
				
				?>
			</li>
		</ul>
		
	</td>
</tr>
<tr class="field_option field_option_<? echo $this->name; ?>">
	<td class="label">
		<label><? _e("Zoom",'acf'); ?></label>
		<p class="description"><? _e('Set the initial zoom level','acf'); ?></p>
	</td>
	<td>
		<?
		
		do_action('acf/create_field', array(
			'type'			=> 'number',
			'name'			=> 'fields['.$key.'][zoom]',
			'value'			=> $field['zoom'],
			'placeholder'	=> $this->default_values['zoom']
		));
		
		?>
	</td>
</tr>
<tr class="field_option field_option_<? echo $this->name; ?>">
	<td class="label">
		<label><? _e("Height",'acf'); ?></label>
		<p class="description"><? _e('Customise the map height','acf'); ?></p>
	</td>
	<td>
		<?
		
		do_action('acf/create_field', array(
			'type'			=> 'number',
			'name'			=> 'fields['.$key.'][height]',
			'value'			=> $field['height'],
			'append'		=> 'px',
			'placeholder'	=> $this->default_values['height']
		));
		
		?>
	</td>
</tr>
		<?
		
	}
}

new acf_field_google_map();

?>