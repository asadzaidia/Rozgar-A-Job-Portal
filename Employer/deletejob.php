<?php
include("../conn/conn.php");
$del_id=$_GET['del_job'];


?>

<!DOCTYPE html>
<html>
	
<head>
 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://use.fontawesome.com/2068589c33.js"></script>
	<title>Edit Job</title>

</head>
<body>
	<h2 class='page-header'><center>Delete Job</center></h2
	<div style='margin-top: 60px;'>
	<div class="container">
		<div class="row">
		<div class="col-md-6">

				
		<h2 style="color:red; font-weight: bold;">Are you Sure ?</h2>
		<form action="" method="post">
			
			<div class="form-group">
				<button type="submit" class ="btn btn-danger" name="yes" value="yes">Yes</button>
				<button type="submit" class ="btn btn-info" name="no" value="n">No</button>
			</div>

		</form>

</div>
</div>
</div>
</body>







<?php

	if(isset($_POST['yes'])){

	$delete_q="delete from job_post where Job_post_id='$del_id'";
	$delete_run=mysqli_query($conn,$delete_q);
	if($delete_run){


		echo "<script>window.open('employerarea.php','_self')</script>";
	}
}

if(isset($_POST['no'])){
echo "<script>window.open('employerarea.php','_self')</script>";

}



 ?>