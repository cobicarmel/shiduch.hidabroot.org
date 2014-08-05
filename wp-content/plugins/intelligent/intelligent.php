<?

/*
Plugin Name: Intelligent
Description: setup an intelligent agent that will listen for your favorites, according to your choices
Version: 0.1
Author: Cobi Carmel
*/

class Intelligent {

	private $version = 0.1;

	private $name;

	private $table_name;

	function __construct(){

		global $wpdb;

		$this -> name = get_class();

		$this -> table_name = $wpdb -> prefix .  $this -> name;

		register_activation_hook(__FILE__, [$this, 'install']);
	}

	function install(){

		global $wpdb;

		$charset_collate = '';

		if(! empty($wpdb->charset))
			$charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";

		if(! empty($wpdb->collate))
			$charset_collate .= " COLLATE {$wpdb->collate}";

		$sql = "CREATE TABLE {$this -> table_name}  (
			id SMALLINT AUTO_INCREMENT,
			user_id SMALLINT,
			options text,
			UNIQUE KEY id (id)
		) $charset_collate;";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		dbDelta($sql);

		add_option($this -> name . '_db_version', $this -> version);
	}
}

new Intelligent;