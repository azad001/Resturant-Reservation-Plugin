<?php 

/*
* Manage Reservation Tables Functions
*
*/


function createBranch()
{
	global $wpdb;
	$tbl = $wpdb->prefix . "esoft_rrs_branch";
?>

<div class="wrap">

	<!-- Update Branch -->
	<?php 

		if ( isset( $_GET['branchId'] ) ) { 
			$branchId = $_GET['branchId'];
			
		if ( isset( $_REQUEST['update_branch'] ) ) {
			$branch = $_POST['branch'];

			$update_query = "UPDATE ".$tbl." SET branch = '".$branch."' WHERE branch_id = '" .$branchId."'";

			$update_result = $wpdb->query( $update_query );

			if ($update_result) {
				$umessage = '<h6 class="alert alert-success">Branch Updated Successfully</h6>';
			}else{
				$umessage = '<h6 class="alert alert-danger">Something went wrong!</h6>';
			}
		}

	?>

	<!-- Select Branch For Update -->
	<?php 
		
		$query = "SELECT * FROM " . $tbl . " WHERE branch_id=" . $branchId. " ";
		$result = $wpdb->get_results($query, ARRAY_A);
		for ($i=0; $i < count( $result ); $i++) { 

		?>

			<h4>Update Branch</h4><br>
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
					    <label for="branch" class="col-sm-2 col-form-label">Branch Name</label>
					    <div class="col-sm-5">
					      <input type="text" class="form-control-plaintext" name="branch" id="branch" value="<?php echo $result[$i]['branch']; ?>">
					    </div>
					  </div>
					  <div class="form-group row">
					  	  <div class="col-sm-2"></div>
					  	  <div class="col-sm-5">
						  	<button type="submit" name="update_branch" class="btn btn-primary">Update</button>
						  </div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php } ?> <!-- Endo Update For Loop-->
		<?php }else{
	?>
	<h4>Add Branch</h4><br>
	<?php
		if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
			$branch = $_POST['branch'];

			$cquery = "SELECT * FROM " . $tbl . " WHERE branch = " . $branch. " ";
			$cresult = $wpdb->get_results($cquery, ARRAY_A);

			if ( empty( $branch ) ) {
				$imessage = '<h6 class="alert alert-danger">Field must not be empty</h6>';
			}else{
				if ( $cresult > 0 ) {
					$imessage = '<h6 class="alert alert-danger">Branch already exists</h6>';
				}else{
					$sql = "INSERT INTO " . $tbl . "( branch ) VALUES( '$branch' )";
					$result = $wpdb->query( $sql );
					if ($result) {
						$imessage = '<h6 class="alert alert-success">Branch Added Successfully</h6>';
					}else{
						$imessage = '<h6 class="alert alert-danger">Something went wrong!</h6>';
					}
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
				    <label for="branch" class="col-sm-2 col-form-label">Branch Name</label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control-plaintext" name="branch" id="branch" placeholder="Enter Branch">
				    </div>
				  </div>
				  <div class="form-group row">
				  	  <div class="col-sm-2"></div>
				  	  <div class="col-sm-5">
					  	<button type="submit" name="create_branch" class="btn btn-primary">Create</button>
					  </div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php } ?> <!-- end update branch checking -->

	<!-- Delete Branch -->

	<?php 
	if ( isset( $_GET['delbranchId'] ) ) { 
		$delbranchId = $_GET['delbranchId'];
		$del_query = "DELETE FROM " . $tbl . " WHERE branch_id=" . $delbranchId. " ";
		$del_result = $wpdb->query( $del_query);
		if ($del_result) {
			$dmessage = '<h6 class="alert alert-success">Brnach Deleted Successfully</h6>';
		}else{
			$dmessage = '<h6 class="alert alert-danger">Something went wrong!</h6>';
		}
	}
	?>


	<!-- All Branch List -->

	<?php 
		$query = "SELECT * FROM " . $tbl . " ORDER BY branch_id DESC";
		$result = $wpdb->get_results($query, ARRAY_A);

		if ($result) {
	?>

	<h4>Branch List</h4><br>
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
				      <td><?php echo $result[$i]['branch']; ?></td>
				      <td><a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=create-branch&branchId=<?php echo $result[$i]['branch_id']; ?>">Update</a> || <a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=create-branch&delbranchId=<?php echo $result[$i]['branch_id']; ?>">Delete</a></td>
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