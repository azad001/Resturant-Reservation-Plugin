<?php
/*
Plugin Name: Restaurant Reservation System
Plugin URI: http://rapidthemes.net/wp/restaurant-reservation
Description: Online restaurant table bookings and reservation system.
Author: eSoft
Version: 1.0
Author URI: http://www.esoftarena.com/
Text Domain: esoftreservation
*/ 


if ( ! class_exists( 'eSoftRestaurantReservation' ) ) {
	
	class eSoftRestaurantReservation{

		public $plugins_page;

		function eSoftRestaurantReservation()
		{
			$this->defineConstant();
			$this->loadDependencies();
			$this->plugin_name = plugin_basename( __FILE__ );

			register_activation_hook( $this->plugin_name, array( $this, 'activation' ) );
			register_deactivation_hook( $this->plugin_name, array( $this, 'deactivation' ) );
			register_uninstall_hook( $this->plugin_name, array( $this, 'uninstall' ) );
			add_action( 'plugins_loaded', array( $this, 'start_plugin' ) );
		}


		function defineConstant()
		{
			define( "PLUGINSFOLDER", plugin_basename( dirname( __FILE__ ) ) );
			define( 'PLUGINS_URLPATH', trailingslashit( plugins_url() . '/' . plugin_basename( dirname(__FILE__) ) ) );
		}


		function loadDependencies()
		{
			require_once ( dirname( __FILE__) .'/admin/core.php' );
			if ( is_admin() ) {
				require_once ( dirname( __FILE__ ) . '/admin/admin.php' );
				$this->reservationAdminPanel = new reservationAdminPanel();
			}else{

			}
		}


		function activation()
		{
			include_once( dirname( __FILE__ ) .'/admin/install.php');
			reservationActivate();
		}

		function deactivation()
		{
			include_once( dirname( __FILE__ ) .'/admin/install.php');
			reservationDeactivate();
		}

		function uninstall()
		{
			include_once( dirname( __FILE__ ) .'/admin/install.php');
			reservationUninstall();
		}

		function start_plugin()
		{
			$this->plugins_page = $_GET['page']; 

			if ( $this->plugins_page == 'esoft-restaurant-reservations' || $this->plugins_page == 'create-table' || $this->plugins_page == 'create-branch' || $this->plugins_page == 'create-purpose' ) {
				
				wp_enqueue_style( 'reservation-bootstrap', PLUGINS_URLPATH . 'admin/assets/css/bootstrap.min.css' );

				wp_enqueue_style( 'jquery-style', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css' );

				wp_enqueue_script( 'reservation-popper.min', PLUGINS_URLPATH . 'admin/assets/js/popper.min.js', array( 'jquery' ), '4.1.0', false );
				wp_enqueue_script( 'reservation-bootstrap.min', PLUGINS_URLPATH . 'admin/assets/js/bootstrap.min.js', array( 'jquery' ), '4.1.0', false );
				wp_enqueue_script( 'reservation-main', plugins_url( 'admin/assets/js/reservation-main.js', __FILE__ ), array('jquery', 'jquery-ui-datepicker'), '1.0.0', false );
			}
		}
	}


	global $eSoftReservation;

	$eSoftReservation = new eSoftRestaurantReservation();

}