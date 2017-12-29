<?php
$query5="select * from job_seeker_profile where Job_seeker_id='$j_id'";
$run5=mysqli_query($conn,$query5);
$checking2=mysqli_num_rows($run5);
while($row5=mysqli_fetch_array($run5)){
	$fname=$row5['firstname'];
	$lname=$row5['lastname'];
	$country=$row5['country'];
	$city=$row5['city'];
	$zip=$row5['zip'];
	$skill_set=$row5['skill_set'];
	$address=$row5['address'];
	 $com_y_of_edu=$row5['com_y_of_edu'];
}

if(!$checking2>0){
	echo "<div class='alert alert-warning alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <strong>Kindly Complete Your Profile First!</strong> 
</div>";
        }
 
else{

?>



<div class="container">
<h2 class="page-header">Update Your Profile</h2>

<div class="col-md-9">
<p id="res" style="color:red;"></p>
	<form method="post" >

		<div class="form-group">
			<label for="ufname">First Name</label>
			<input type="text" class="form-control" name="ufname" id="ufname" required value='<?php echo $fname;?>'>
		</div>

		<div class="form-group">
			<label for="ulname">Last Name</label>
			<input type="text" class="form-control" name="ulname" id="ulname"  value='<?php echo $lname;?>'>
		</div>

		<div class="form-group">
			<label for="ucountry">Country</label>
			<input type="text" class="form-control" name="ucountry" id="ucountry" value='<?php echo $country;?>'>
		</div>
		<div class="form-group">
			<label for="ucity">City</label>
			<input type="text" class="form-control" name="ucity" id="ucity"  value='<?php echo $city;?>'>
		</div>
		<div class="form-group">
			<label for="uzip">Area Code</label>
			<input type="text" class="form-control" name="uzip" id="uzip"  value='<?php echo $zip;?>'>
		</div>
		<div class="form-group">
			<label for="uss">Skill Set<span style="color:blue;"> eg:Database,Php,Mysql.</span></label>
			<input type="text" class="form-control" name="uss" id="uss"  value='<?php echo $skill_set;?>'>
		</div>
		<div class="form-group">
			<label for="uaddress">Address</label>
			<input type="text" class="form-control" name="uaddress" id="uaddress" value='<?php echo $address;?>'>
		</div>
		<div class="form-group">
			<label for="ucyoe">Your Complete Year of Education:</label>
			<input type="text" class="form-control" name="ucyoe" id="ucyoe" value='<?php echo $com_y_of_edu;?>'>
		</div>
		
		<button type="submit" class="btn btn-success" name="update_profile" >Update Profile</button>
		
	</form>
</div>
</div>
<?php 
	}
?>
<?php
include("conn/conn.php");
if(isset($_POST['update_profile'])){
	$firstname=checker($_POST['ufname']);
	$lastname=checker($_POST['ulname']);
	$country=checker($_POST['ucountry']);
	$city=checker($_POST['ucity']);
	$zip=checker($_POST['uzip']);
	$skill_set=checker($_POST['uss']);
	$address=checker($_POST['uaddress']);
	$com_y_of_edu=checker($_POST['ucyoe']);

	$query7="update job_seeker_profile set firstname='$firstname',	lastname='$lastname',country='$country',city='$city',zip='$zip',skill_set='$skill_set',address='$address',com_y_of_edu='$com_y_of_edu' where Job_seeker_id='$j_id'";
	$run7=mysqli_query($conn,$query7);
	if($run7){
		echo "<script>window.open('Job_seeker_profile.php','_self')</script>";
	}
}


?>