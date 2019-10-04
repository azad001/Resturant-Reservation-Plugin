<?php 

/*
* Create Reservation Table Functions
*
*/


function createTable()
{ 

	global $wpdb;
	$tbl_branch  = $wpdb->prefix . "esoft_rrs_branch";
	$tbl_purpose = $wpdb->prefix . "esoft_rrs_purpose";
	$tbl_table   = $wpdb->prefix . "esoft_rrs_table";

?>

<div class="wrap">

	<!-- Update Table -->
	<?php 

		if ( isset( $_GET['tableId'] ) ) { 
			$tableId = $_GET['tableId'];
			
		if ( isset( $_REQUEST['update_branch'] ) ) {
			$branch = $_POST['branch'];
			$update_query = "UPDATE ".$tbl." SET branch = '".$branch."' WHERE table_id = '" .$tableId."'";
			$update_result = $wpdb->query( $update_query );
			if ($update_result) {
				$umessage = '<h6 class="alert alert-success">Branch Updated Successfully</h6>';
			}else{
				$umessage = '<h6 class="alert alert-danger">Something went wrong!</h6>';
			}
		}

	?>

	<h4>Manage Table</h4><br>
	<div class="container">
		<div class="row">
			<div class="col">
				<form action="" method="post">
				  <div class="form-group row">
				    <label for="table_title" class="col-sm-1 col-form-label">Title</label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" name="table_title" id="table_title" placeholder="Enter title">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="branch" class="col-sm-1 col-form-label">Branch</label>
				    <div class="col-sm-5">
				    	<select class="form-control" name="branch" id="branch">
					    	<option value="">Select Branch</option>
					    	<option value="">Branch</option>
					    </select>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="person" class="col-sm-1 col-form-label">Person</label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" name="person" id="person" placeholder="Enter person">
				    </div>
				  </div>
				  
				  <div class="form-group row">
				    <label for="status" class="col-sm-1 col-form-label">Status</label>
				    <div class="col-sm-5">
				    	<select class="form-control" name="status" id="status">
					    	<option value="">Select Status</option>
					    	<option value="">Available</option>
					    	<option value="">Unavailable</option>
					    </select>
				    </div>
				  </div>

				  <div class="form-group row">
				  	  <div class="col-sm-1"></div>
				  	  <div class="col-sm-5">
					  	<button type="submit" class="btn btn-primary">Update Table</button>
					  </div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php }else{ ?>

	<!-- Create Table -->

	<h4>Create Reservation Table</h4><br>
	<?php
		if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
			$table_title = $_POST['table_title'];
			$branch      = $_POST['branch'];
			$person      = $_POST['person'];
			$purpose     = $_POST['purpose'];

			if ( empty( $branch ) || empty( $table_title ) || empty( $person ) || empty( $purpose ) ) {
				$message = '<h6 class="alert alert-danger">Field must not be empty</h6>';
			}else{
				$sql = "INSERT INTO " . $tbl_table . "( branch_id, purpose_id, table_title, person ) VALUES( '$branch', '$purpose', '$table_title', '$person' )";
				$result = $wpdb->query( $sql );
				if ($result) {
					$tmessage = '<h6 class="alert alert-success">Table Created Successfully</h6>';
				}else{
					$tmessage = '<h6 class="alert alert-danger">Something went wrong!</h6>';
				}
			}
		} 

		if ( isset( $tmessage ) ) {
			echo $tmessage;
		}
	?>
	<div class="container">
		<div class="row">
			<div class="col">
				<form action="" method="post">
				  <div class="form-group row">
				    <label for="table_title" class="col-sm-1 col-form-label">Title</label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" name="table_title" id="table_title" placeholder="Enter title">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="branch" class="col-sm-1 col-form-label">Branch</label>
				    <div class="col-sm-5">
				    	<select class="form-control" name="branch" id="branch">
					    	<option value="">Select Branch</option>
					    	<?php 
					    		$get_branch = "SELECT * FROM " . $tbl_branch . " ORDER BY branch_id DESC";
								$all_branch = $wpdb->get_results($get_branch, ARRAY_A);
								if ($all_branch) {
								for ($i=0; $i < count( $all_branch ); $i++) { 
					    	?>
					    	<option value="<?php echo $all_branch[$i]['branch_id']; ?>"><?php echo $all_branch[$i]['branch']; ?></option>
					    	<?php } } ?>
					    </select>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="person" class="col-sm-1 col-form-label">Person</label>
				    <div class="col-sm-5">
				      <input type="text" class="form-control" name="person" id="person" placeholder="Enter person">
				    </div>
				  </div>
				  <div class="form-group row">
				  	  <div class="col-sm-1"></div>
				  	  <div class="col-sm-5">
					  	<button type="submit" class="btn btn-primary">Create Table</button>
					  </div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php } ?> <!-- End update table checking -->

	<!-- All Branch List -->

	<?php 
		$get_query = "SELECT * FROM " . $tbl_table . " LEFT JOIN " . $tbl_branch . " ON " . $tbl_table . ".branch_id = " . $tbl_branch . ".branch_id ORDER BY " . $tbl_table . ".table_id DESC";
		$get_result = $wpdb->get_results($get_query, ARRAY_A);

		if ($get_result) {
	?>

	<br>
	<h4>Table List</h4><br>
	<div class="container">
		<div class="row">
			<div class="col">	
				<table class="table table-striped table-bordered">
				  <thead>
				    <tr>
				      <th>#</th>
				      <th>Title</th>
				      <th>Branch</th>
				      <th>Person</th>
				      <th>Date</th>
				      <th>Time</th>
				      <th>Status</th>
				      <th>Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 
				  		for ($i=0; $i < count( $get_result ); $i++) { 
				  	?>
				    <tr>
				      <th><?php echo $i+1; ?></th>
				      <td><?php echo $get_result[$i]['table_title']; ?></td>
				      <td><?php echo $get_result[$i]['branch']; ?></td>
				      <td><?php echo $get_result[$i]['person']; ?></td>
				      <td>13/09/2019</td>
				      <td>07:00 PM</td>
				      <td>Active</td>
				      <td><a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=create-table&tableId=<?php echo $get_result[$i]['table_id']; ?>">Manage</a> || <a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=create-table&delTableId=<?php echo $get_result[$i]['table_id']; ?>">Delete</a></td>
				    </tr>
					<?php } ?>
				  </tbody>
				</table>
			</div>
		</div>
	</div>
	<?php } ?> <!-- check query -->

</div> <!-- End Wrapper -->
	
<?php }