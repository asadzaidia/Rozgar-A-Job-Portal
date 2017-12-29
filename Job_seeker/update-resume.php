
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
	$query9="select job_seeker_resume from job_seeker_profile  where Job_seeker_id='$j_id'";
	$run9=mysqli_query($conn,$query9);
	while($row9=mysqli_fetch_array($run9)){
		 $cv=$row9['job_seeker_resume'];
	}

?>
<div class="col-md-9">
<h2 class="page-header">Update Resume</h2>


<a href="job_seeker_cvs/<?php echo $cv;?>" download><h3>Your Resume</h3></a>
<p id="res" style="color:red;"></p>
<form method="post" action="" enctype="multipart/form-data">
<div class="form-group">
<label>Upload Updated Resume</label>
<input type="file" name="u_cv" class="form-control" accept=".doc,.docx" required>
</div>
<button type="submit" class="btn btn-success" name="update_cv">Upload</button>
</form>
</div>




<?php

}

?>

<?php
if(isset($_POST['update_cv'])){
	 $maxsize=2097152;
	 $u_cv = $_FILES['u_cv']['name'];
	 $temp_cv = $_FILES['u_cv']['tmp_name'];
	 $target_cv="job_seeker_cvs/".$u_cv;
	 // cv size
 
       if(($_FILES['u_cv']['size']>$maxsize)|| ($_FILES["u_cv"]["size"] == 0)){
        	   echo "<script>document.getElementById('res').innerHTML='Cv size not greater than 2MB';</script>";

        }
        //exists cv
         elseif(file_exists($target_cv)==true){
               echo "<script>document.getElementById('res').innerHTML='Cv with That Name Already Exists';</script>";
        }
        else{
        	$query10="update job_seeker_profile set job_seeker_resume='$u_cv' where Job_seeker_id='$j_id'";
        	$run10=mysqli_query($conn,$query10);
        	 move_uploaded_file($temp_cv,$target_cv);
        	if($run10)
        	{
        			 echo "<script>window.open('Job_seeker_profile.php','_self')</script>";
        	}
        }


}

?>