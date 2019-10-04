<?php
/**
 * Restaurant Reservation - Admin Section
 * 
 */


class reservationAdminPanel{

	var $user_lavel = "manage_options";

	function reservationAdminPanel()
	{
		add_action( 'admin_menu', array( $this, 'add_menu' ) );
	}


	function add_menu()
	{
		add_menu_page( __( 'Reservation', 'esoftreservation' ), __( 'Reservation', 'esoftreservation' ), $this->user_lavel, PLUGINSFOLDER, array( $this, 'show_menu' ), 'dashicons-calendar-alt', 21 );

		add_submenu_page( PLUGINSFOLDER, __( 'Add Table', 'esoftreservation' ), __( 'Create Table', 'esoftreservation' ), $this->user_lavel, 'create-table', array( $this, 'show_menu' ) );
		add_submenu_page( PLUGINSFOLDER, __( 'Add Branch', 'esoftreservation' ), __( 'Add Branch', 'esoftreservation' ), $this->user_lavel, 'create-branch', array( $this, 'show_menu' ) );
		add_submenu_page( PLUGINSFOLDER, __( 'Add Purpose', 'esoftreservation' ), __( 'Add Purpose', 'esoftreservation' ), $this->user_lavel, 'create-purpose', array( $this, 'show_menu' ) );
		add_submenu_page( PLUGINSFOLDER, __( 'Schedule', 'esoftreservation' ), __( 'Schedule', 'esoftreservation' ), $this->user_lavel, 'create-schedule', array( $this, 'show_menu' ) );
		
	}

	function show_menu()
	{
		switch ( $_GET['page'] ) {
			case 'create-table':
				 include_once ( dirname( __FILE__ ) . "/create-table.php" );
				 createTable();
				break;
			case 'create-branch':
				include_once ( dirname( __FILE__ ) . "/create-branch.php" );
				createBranch();
				break;
			case 'create-purpose':
				include_once ( dirname( __FILE__ ) . "/create-purpose.php" );
				createPurpose();
				break;
			case 'create-schedule':
				include_once ( dirname( __FILE__ ) . "/create-schedule.php" );
				createSchedule();
				break;
			default:
				include_once ( dirname( __FILE__ ) . "/reservations.php" );
				Reservations();
				break;
		}
	}

}



