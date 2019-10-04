<?php 

/*
* Manage Reservation Tables Functions
*
*/


function createPurpose()
{
	global $wpdb;
	$tbl = $wpdb->prefix . "esoft_rrs_purpose";
?>

<div class="wrap">

	<!-- Update Purpose -->
	<?php 

		if ( isset( $_GET['purposeId'] ) ) { 
			$purposeId = $_GET['purposeId'];
			
		if ( isset( $_REQUEST['update_purpose'] ) ) {
			$purpose = $_POST['purpose'];
			$update_query = "UPDATE ".$tbl." SET purpose = '".$purpose."' WHERE purpose_id = '" .$purposeId."'";
			$update_result = $wpdb->query( $update_query );
			if ($update_result) {
				$umessage = '<h6 class="alert alert-success">Purpose Updated Successfully</h6>';
			}else{
				$umessage = '<h6 class="alert alert-danger">Something went wrong!</h6>';
			}
		}

	?>

	<!-- Select Purpose For Update -->
	<?php 
		
		$query = "SELECT * FROM " . $tbl . " WHERE purpose_id=" . $purposeId. " ";
		$result = $wpdb->get_results($query, ARRAY_A);
		for ($i=0; $i < count( $result ); $i++) { 

		?>

			<h4>Update Purpose</h4><br>
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
					    <label for="purpose" class="col-sm-2 col-form-label">Purpose Name</label>
					    <div class="col-sm-5">
					      <input type="text" class="form-control-plaintext" name="purpose" id="purpose" value="<?php echo $result[$i]['purpose']; ?>">
					    </div>
					  </div>
					  <div class="form-group row">
					  	  <div class="col-sm-2"></div>
					  	  <div class="col-sm-5">
						  	<button type="submit" name="update_purpose" class="btn btn-primary">Update</button>
						  </div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php } ?> <!-- Endo Update For Loog-->
		<?php }else{
	?>
	<h4>Add Purpose</h4><br>
	<?php
		if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
			$purpose = $_POST['purpose'];

			if ( empty( $purpose ) ) {
				$message = '<h6 class="alert alert-danger">Field must not be empty</h6>';
			}else{
				$sql = "INSERT INTO " . $tbl . "( purpose ) VALUES( '$purpose' )";
				$result = $wpdb->query( $sql );
				if ($result) {
					$imessage = '<h6 class="alert alert-success">Purpose Added Successfully</h6>';
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
				    <label for="purpose" class="col-sm-2 col-form-label">Purpose Name</label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control-plaintext" name="purpose" id="purpose" placeholder="Enter Purpose">
				    </div>
				  </div>
				  <div class="form-group row">
				  	  <div class="col-sm-2"></div>
				  	  <div class="col-sm-5">
					  	<button type="submit" name="create_purpose" class="btn btn-primary">Create</button>
					  </div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php } ?> <!-- end update purpose checking -->

	<!-- Delete Purpose -->

	<?php 
	if ( isset( $_GET['delpurposeId'] ) ) { 
		$delpurposeId = $_GET['delpurposeId'];
		$del_query = "DELETE FROM " . $tbl . " WHERE purpose_id=" . $delpurposeId. " ";
		$del_result = $wpdb->query( $del_query);
		if ($del_result) {
			$dmessage = '<h6 class="alert alert-success">Brnach Deleted Successfully</h6>';
		}else{
			$dmessage = '<h6 class="alert alert-danger">Something went wrong!</h6>';
		}
	}
	?>


	<!-- All Purpose List -->

	<?php 
		$query = "SELECT * FROM " . $tbl . " ORDER BY purpose_id DESC";
		$result = $wpdb->get_results($query, ARRAY_A);

		if ($result) {
	?>

	<h4>Purpose List</h4><br>
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
				      <td><?php echo $result[$i]['purpose']; ?></td>
				      <td><a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=create-purpose&purposeId=<?php echo $result[$i]['purpose_id']; ?>">Update</a> || <a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=create-purpose&delpurposeId=<?php echo $result[$i]['purpose_id']; ?>">Delete</a></td>
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