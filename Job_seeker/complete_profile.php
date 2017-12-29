



<div class="container">
<h2 class="page-header">Complete Your Profile</h2>

<div class="col-md-9">
<p id="res" style="color:red;"></p>
	<form method="post" enctype="multipart/form-data">

		<div class="form-group">
			<label for="fname">First Name</label>
			<input type="text" class="form-control" name="fname" id="fname" required>
		</div>

		<div class="form-group">
			<label for="lname">Last Name</label>
			<input type="text" class="form-control" name="lname" id="lname" required>
		</div>

		<div class="form-group">
			<label for="country">Country</label>
			<input type="text" class="form-control" name="country" id="country" required>
		</div>
		<div class="form-group">
			<label for="city">City</label>
			<input type="text" class="form-control" name="city" id="city" required>
		</div>
		<div class="form-group">
			<label for="zip">Area Code</label>
			<input type="text" class="form-control" name="zip" id="zip" required>
		</div>
		<div class="form-group">
			<label for="ss">Skill Set<span style="color:blue;"> eg:Database,Php,Mysql.</span></label>
			<input type="text" class="form-control" name="ss" id="ss" required>
		</div>
		<div class="form-group">
			<label for="address">Address</label>
			<input type="text" class="form-control" name="address" id="address" required>
		</div>
		<div class="form-group">
			<label for="cyoe">Your Complete Year of Education:</label>
			<input type="text" class="form-control" name="cyoe" id="cyoe" required>
		</div>
		<div class="form-group">
			<label for="image">Your Image:</label>
			<input type="file" class="form-control" name="j_image" id="image"  accept="image/jpg,image/jpeg,image/png" required>
		</div>
		<div class="form-group">
			<label for="cv">Your Resume:</label>
			<input type="file" class="form-control" name="cv" id="cv" accept=".doc,.docx" required>
		</div>
		<button type="submit" class="btn btn-success" name="create_profile" >Create Profile</button>
		
	</form>
</div>
</div>

<?php


if(isset($_POST['create_profile'])){
	include("conn/conn.php");
	 $firstname=checker($_POST['fname']);
	$lastname=checker($_POST['lname']);
	 $country=checker($_POST['country']);
	 $city=checker($_POST['city']);
	 $zip=checker($_POST['zip']);
	 $skillSet=checker($_POST['ss']);
	 $cyoe=checker($_POST['cyoe']);
	 $address=checker($_POST['address']);
	$maxsize=2097152;

	  $j_cv = $_FILES['cv']['name'];
	 $temp_cv = $_FILES['cv']['tmp_name'];
	 $target_cv="job_seeker_cvs/".$j_cv;


	  $j_img = $_FILES['j_image']['name'];
     $temp_img = $_FILES['j_image']['tmp_name'];
	 
	  $target_image="jobseeker_images/".$temp_img;
       $target="jobseeker_images/".$j_img;

	 
        //already Exists
        if(file_exists($target)==true){
               echo "<script>document.getElementById('res').innerHTML='Image Already Exists';</script>";
        }
        //image size
        elseif(($_FILES['j_image']['size']>$maxsize)|| ($_FILES["j_image"]["size"] == 0)){
           
             echo "<script>document.getElementById('res').innerHTML='Image Size not greater than 2MB';</script>";
        }
        // cv size
 
        elseif(($_FILES['cv']['size']>$maxsize)|| ($_FILES["cv"]["size"] == 0)){
        	   echo "<script>document.getElementById('res').innerHTML='Cv size not greater than 2MB';</script>";

        }
        //exists cv
         elseif(file_exists($target_cv)==true){
               echo "<script>document.getElementById('res').innerHTML='Cv with That Name Already Exists';</script>";
        }
        else{
        	 move_uploaded_file($temp_img,$target);
        	 move_uploaded_file($temp_cv,$target_cv);

        	 $query3="insert into job_seeker_profile(Job_seeker_id,firstname,lastname,country,city,zip,skill_set,address,com_y_of_edu,job_seeker_image,job_seeker_resume,checking) values('$j_id','$firstname','$lastname','$country','$city','$zip','$skillSet','$address','$cyoe','$j_img','$j_cv','1')";
        	 $rq3=mysqli_query($conn,$query3);

        	 if($rq3){
        	 	 echo "<script>window.open('Job_seeker_profile.php','_self')</script>";
        	 }

        }

	  
	
}

?>