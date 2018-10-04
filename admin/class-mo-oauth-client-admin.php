<?php

require('partials/class-mo-oauth-client-admin-menu.php');
class Mo_OAuth_Client_Admin {

	
	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/admin.js', array( 'jquery' ), $this->version, false );
	}

	public function admin_menu() {

		$page = add_menu_page( 'MO OAuth Settings ' . __( 'Configure OAuth', 'mo_oauth_settings' ), 'miniOrange OAuth', 'administrator', 'mo_oauth_settings', array( $this, 'menu_options' ) ,plugin_dir_url(__FILE__) . 'images/miniorange.png');
		
		$page = add_submenu_page( 'mo_oauth_settings', 'MO Login ' . __('Advanced EVE Online Settings'), __('Advanced EVE Online Settings'), 'administrator', 'mo_oauth_eve_online_setup', 'mo_eve_online_config' );

		global $submenu;
		if(is_array($submenu) && isset($submenu['mo_oauth_settings'])){
			$submenu['mo_oauth_settings'][0][0] = __( 'Configure OAuth', 'mo_oauth_login' );
		}	
	}
		
	function menu_options () {
		global $wpdb;
		update_option( 'host_name', 'https://auth.miniorange.com' );
		$customerRegistered = mo_oauth_is_customer_registered();
		mo_oauth_client_main_menu();
	}
}
