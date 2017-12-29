<?php
include("conn/conn.php");
$query8="select checking from job_seeker_profile where Job_seeker_id='$j_id'";
$run8=mysqli_query($conn,$query8);
$checking3=mysqli_num_rows($run8);

if(!$checking3>0){
	echo "<div class='alert alert-warning alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <strong>Kindly Complete Your Profile First!</strong> 
</div>";
        }
 
else{
	$query11="select job_seeker_image from job_seeker_profile  where Job_seeker_id='$j_id'";
	$run11=mysqli_query($conn,$query11);
	while($row11=mysqli_fetch_array($run11)){
		 $Image=$row11['job_seeker_image'];
	}

?>
<div class="col-md-9">

<h2 class="page-header">Update Image</h2>
<p id="res" style="color:red;"></p>
<form method="post" action="" enctype="multipart/form-data">
<div class="form-group">
<label>Upload Updated Image</label>
<input type="file" name="u_img" class="form-control" accept="image/jpg,image/jpeg,image/png" required>
</div>
<button type="submit" class="btn btn-success" name="update_image">Upload</button>
</form>
</div>

<?php

}
?>
<?php

if(isset($_POST['update_image'])){
	$j_img = $_FILES['u_img']['name'];
     $temp_img = $_FILES['u_img']['tmp_name'];
	 
	  $target_image="jobseeker_images/".$temp_img;
       $target="jobseeker_images/".$j_img;
$maxsize=2097152;
	 
        //already Exists
        if(file_exists($target)==true){
               echo "<script>document.getElementById('res').innerHTML='Image Already Exists';</script>";
        }
        //image size
        elseif(($_FILES['u_img']['size']>$maxsize)|| ($_FILES["u_img"]["size"] == 0)){
           
             echo "<script>document.getElementById('res').innerHTML='Image Size not greater than 2MB';</script>";
        }
        else{
        	move_uploaded_file($temp_img,$target);
        	$query12="update job_seeker_profile set job_seeker_image='$j_img' where Job_seeker_id='$j_id'";
        	$run12=mysqli_query($conn,$query12);
        	 
        	if($run12)
        	{
        			 echo "<script>window.open('Job_seeker_profile.php','_self')</script>";
        	}
        }
}

?>