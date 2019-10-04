<?php 

/*
*
*
*/

// Activation functions
function reservationActivate()
{
	global $wpdb;
		
		if ( !current_user_can('activate_plugins') ) 
			return;
			
		if(!defined('DB_CHARSET') || !($db_charset = DB_CHARSET))
			$db_charset = 'utf8';
		$db_charset = "CHARACTER SET ".$db_charset;
		if(defined('DB_COLLATE') && $db_collate = DB_COLLATE) 
			$db_collate = "COLLATE ".$db_collate;
			
		//Branch table
		$table_name = $wpdb->prefix . "esoft_rrs_branch";
		if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
			$sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (
					`branch_id` bigint(20) NOT NULL AUTO_INCREMENT,
					`branch` varchar(100) NOT NULL,
					 PRIMARY KEY  (`branch_id`)
				  )  {$db_charset} {$db_collate};";
			
			$results = $wpdb->query( $sql );
		}


		//Purpose table
		$table_name_2 = $wpdb->prefix . "esoft_rrs_purpose";
		if($wpdb->get_var("SHOW TABLES LIKE '$table_name_2'") != $table_name_2) {
			$sql = "CREATE TABLE IF NOT EXISTS " . $table_name_2 . " (
					`purpose_id` bigint(20) NOT NULL AUTO_INCREMENT,
					`purpose` varchar(100) NOT NULL,
					 PRIMARY KEY  (`purpose_id`)
				  )  {$db_charset} {$db_collate};";
			
			$results = $wpdb->query( $sql );
		}


		//Table Creae table
		$table_name_3 = $wpdb->prefix . "esoft_rrs_table";
		if($wpdb->get_var("SHOW TABLES LIKE '$table_name_3'") != $table_name_3) {
			$sql = "CREATE TABLE IF NOT EXISTS " . $table_name_3 . " (
					`table_id` bigint(20) NOT NULL AUTO_INCREMENT,
					`branch_id` bigint(20) NOT NULL,
					`approved_status` varchar(20) NOT NULL DEFAULT 'approved',
					`table_title` text NOT NULL,
					`person` varchar(50) NOT NULL,
					 PRIMARY KEY  (`table_id`)
				  )  {$db_charset} {$db_collate};";
			
			$results = $wpdb->query( $sql );
		}


		//Schedule table
		$table_name_4 = $wpdb->prefix . "esoft_rrs_schedule";
		if($wpdb->get_var("SHOW TABLES LIKE '$table_name_4'") != $table_name_4) {
			$sql = "CREATE TABLE IF NOT EXISTS " . $table_name_4 . " (
					`schedule_id` bigint(20) NOT NULL AUTO_INCREMENT,
					`table_id` bigint(20) NOT NULL,
					`schedule_date` varchar(20) NOT NULL,
					`schedule_time` varchar(20) NOT NULL,
					 PRIMARY KEY  (`schedule_id`)
				  )  {$db_charset} {$db_collate};";
			
			$results = $wpdb->query( $sql );
		}
		
}


// Deactivation functions
function reservationDeactivate()
{
	global $wpdb;
    
}


// Uninstall functions
function reservationUninstall()
{
	global $wpdb;
	$table_name = $wpdb->prefix."esoft_rrs_branch";
   	$wpdb->query("DROP TABLE IF EXISTS $table_name");	
   
   	$table_name_2 = $wpdb->prefix."esoft_rrs_purpose";
   	$wpdb->query("DROP TABLE IF EXISTS $table_name_2");

   	$table_name_3 = $wpdb->prefix."esoft_rrs_table";
   	$wpdb->query("DROP TABLE IF EXISTS $table_name_3");

   	$table_name_4 = $wpdb->prefix."esoft_rrs_schedule";
   	$wpdb->query("DROP TABLE IF EXISTS $table_name_4");
}


