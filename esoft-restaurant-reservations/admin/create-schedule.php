<?php 

/*
* Manage Reservation Tables Functions
*
*/


function createSchedule()
{
	global $wpdb;
	$tbl = $wpdb->prefix . "esoft_rrs_schedule";
?>

<div class="wrap">

	<!-- Update Schedule -->
	<?php 

		if ( isset( $_GET['scheduleId'] ) ) { 
			$scheduleId = $_GET['scheduleId'];
			
		if ( isset( $_REQUEST['update_schedule'] ) ) {
			$schedule = $_POST['schedule'];
			$update_query = "UPDATE ".$tbl." SET schedule = '".$schedule."' WHERE schedule_id = '" .$scheduleId."'";
			$update_result = $wpdb->query( $update_query );
			if ($update_result) {
				$umessage = '<h6 class="alert alert-success">Schedule Updated Successfully</h6>';
			}else{
				$umessage = '<h6 class="alert alert-danger">Something went wrong!</h6>';
			}
		}

	?>

	<!-- Select Schedule For Update -->
	<?php 
		
		$query = "SELECT * FROM " . $tbl . " WHERE schedule_id=" . $scheduleId. " ";
		$result = $wpdb->get_results($query, ARRAY_A);
		for ($i=0; $i < count( $result ); $i++) { 

		?>

			<h4>Update Schedule</h4><br>
			<?php 
				if ( isset( $umessage ) ) {
					echo $umessage;
				}
			?>
			<div class="container">
			<div class="row align-items-start">
				
				<div class="col">
					<form action="" method="post">
					  <div class="form-group row">
					    <label for="schedule" class="col-sm-2 col-form-label">Schedule Name</label>
					    <div class="col-sm-5">
					      <input type="text" class="form-control-plaintext" name="schedule" id="schedule" value="<?php echo $result[$i]['schedule']; ?>">
					    </div>
					  </div>
					  <div class="form-group row">
					  	  <div class="col-sm-2"></div>
					  	  <div class="col-sm-5">
						  	<button type="submit" name="update_schedule" class="btn btn-primary">Update</button>
						  </div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php } ?> <!-- Endo Update For Loop-->
		<?php }else{
	?>
	<h4>Add Schedule</h4><br>
	<?php
		if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
			$schedule = $_POST['schedule'];

			if ( empty( $schedule ) ) {
				$message = '<h6 class="alert alert-danger">Field must not be empty</h6>';
			}else{
				$sql = "INSERT INTO " . $tbl . "( schedule ) VALUES( '$schedule' )";
				$result = $wpdb->query( $sql );
				if ($result) {
					$imessage = '<h6 class="alert alert-success">Schedule Added Successfully</h6>';
				}else{
					$imessage = '<h6 class="alert alert-danger">Something went wrong!</h6>';
				}
			}
		} 

		if ( isset( $imessage ) ) {
			echo $imessage;
		}
	?>
	<div class="container">
		<div class="row align-items-start">
			
			<div class="col">
				<form action="" method="post">
				  <div class="form-group row">
				    <label for="schedule" class="col-sm-2 col-form-label">Schedule Name</label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control-plaintext" name="schedule" id="schedule" placeholder="Enter Schedule">
				    </div>
				  </div>
				  <div class="form-group row">
				  	  <div class="col-sm-2"></div>
				  	  <div class="col-sm-5">
					  	<button type="submit" name="create_schedule" class="btn btn-primary">Create</button>
					  </div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php } ?> <!-- end update schedule checking -->

	<!-- Delete Schedule -->

	<?php 
	if ( isset( $_GET['delscheduleId'] ) ) { 
		$delscheduleId = $_GET['delscheduleId'];
		$del_query = "DELETE FROM " . $tbl . " WHERE schedule_id=" . $delscheduleId. " ";
		$del_result = $wpdb->query( $del_query);
		if ($del_result) {
			$dmessage = '<h6 class="alert alert-success">Brnach Deleted Successfully</h6>';
		}else{
			$dmessage = '<h6 class="alert alert-danger">Something went wrong!</h6>';
		}
	}
	?>


	<!-- All Schedule List -->

	<?php 
		$query = "SELECT * FROM " . $tbl . " ORDER BY schedule_id DESC";
		$result = $wpdb->get_results($query, ARRAY_A);

		if ($result) {
	?>

	<h4>Schedule List</h4><br>
	<?php 
		if ( isset( $dmessage ) ) {
			echo $dmessage;
		}
	?>
	<div class="container">
		<div class="row">
			<div class="col-lg-7">	
				<table class="table table-striped table-bordered">
				  <thead>
				    <tr>
				      <th>#</th>
				      <th>Name</th>
				      <th>Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 
				  		for ($i=0; $i < count( $result ); $i++) { 
				  	?>
				    <tr>
				      <th><?php echo $i+1; ?></th>
				      <td><?php echo $result[$i]['schedule']; ?></td>
				      <td><a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=create-schedule&scheduleId=<?php echo $result[$i]['schedule_id']; ?>">Update</a> || <a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=create-schedule&delscheduleId=<?php echo $result[$i]['schedule_id']; ?>">Delete</a></td>
				    </tr>
					<?php } ?>
				  </tbody>
				</table>
			</div>
		</div>
	</div>
	<?php } ?> <!-- check query -->

</div>
<?php }