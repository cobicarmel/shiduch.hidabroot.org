<?

class Banner extends WP_Widget{

	function __construct(){
		parent::__construct(get_class($this), __('Banner', THEME_NAME));
	}

	function widget($args, $instance){

		echo $args['before_widget'];

		?>
		<a href="<?= $instance['target'] ?>">
			<img src="<?= $instance['url'] ?>">
		</a>
		<?

		echo $args['after_widget'];
	}

	function form($instance){
		$url_id = $this->get_field_id('url');
		$url_name = $this->get_field_name('url');
		$instance_url = isset($instance['url']) ? $instance['url'] : '';
	?>
		<p>
			<label for="<?= $url_id ?>"><? _e('Banner URL', THEME_NAME) ?></label>
			<input type="text" id="<?= $url_id ?>" class="widefat" name="<?= $url_name ?>" value="<?= $instance_url?>">
		</p>
	<?
		$target_id = $this->get_field_id('target');
		$target_name = $this->get_field_name('target');
		$instance_target = isset($instance['target']) ? $instance['target'] : '';
	?>
		<p>
			<label for="<?= $target_id ?>"><? _e('Banner target', THEME_NAME) ?></label>
			<input type="text" id="<?= $target_id ?>" class="widefat" name="<?= $target_name ?>" value="<?= $instance_target?>">
		</p>
	<?
	}

}

add_action('widgets_init', function(){
	register_widget('Banner');
});
