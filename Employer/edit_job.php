
<?php
session_start();
include("../conn/conn.php");
 $edit_id=$_GET['edit_job'];

    $query2="select * from job_post where Job_post_id='$edit_id'";
                        $run=mysqli_query($conn,$query2);
                        $row_edit=mysqli_fetch_array($run);
                        $job_type_id=$row_edit['job_type_id'];
                        $Job_last_date=$row_edit['Job_last_date'];
                        $job_location=$row_edit['job_location'];
                        $Job_description=$row_edit['Job_description'];

                         //getting type title
  $geting_type_title2="select company_type_name from company_type where company_type_id='$job_type_id'";
  $q2=mysqli_query($conn,$geting_type_title2);
  while($rowt=mysqli_fetch_array($q2)){
    $type_namee=$rowt['company_type_name'];
  }
  



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
	<h2 class='page-header'><center>Edit Your Job</center></h2
	<div style='margin-top: 60px;'>
	<div class="container">
		<div class="row">
		<div class="col-md-6">
				     <form action="" method="post">
                 <div class="form-group">
                     <label for="Select">Job Type:</label>
                    <select name="job_type" class="form-control" id="sel1">
                    <option value="<?php echo $job_type_id;?>"><?php echo $type_namee;?></option>
         <?php
        $get_job_type="select * from company_type";
        $run_job_type=mysqli_query($conn,$get_job_type);

        while($row=mysqli_fetch_array($run_job_type)){

          $companyType_id=$row['company_type_id'];
          $companyType_name=$row['company_type_name'];

                echo "<option value='$companyType_id'>$companyType_name</option>";
      }

                 ?>
                         </select>
                        </div>

                        <div class="form-group">
                        <label>Job Last Date:<span style="color:red"
                        >Select Last Date Compulsary </span></label>
                        <input type="date" class="form-control" name="l_date" value="<?phpecho $Job_last_date;?>" required>
                        </div>

                        <div class="form-group">
                        <label>Your Complete Location:</label>
                        <input type="text" class="form-control" name="job_location" value="<?php echo $job_location;?>" >
                        </div>

                        <div class="form-group">
                            <label>Job Description:</label>
                            <textarea class="form-control" name="job_des"rows="5" ><?php echo $Job_description?></textarea>
                        </div>

                        <button type="submit" name="job_post_update" class="btn btn-default">Update Job</button>
                    </form>

			</div>

		</div>

	</div>
	</div>

</body>
</html>
<?php
function checker($data) {

             $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
            }
if(isset($_POST['job_post_update'])){
	 $u_job_type=checker($_POST['job_type']);
     $u_l_date=checker($_POST['l_date']);
     $u_job_location=checker($_POST['job_location']);
     $u_job_des=checker($_POST['job_des']);

     $query_edit="update job_post set job_type_id='$u_job_type',	Job_last_date='$u_l_date',job_location='$u_job_location',Job_description=' $u_job_des' where Job_post_id='$edit_id'";
     $run_edit_query=mysqli_query($conn,$query_edit);
     if($run_edit_query){
     	echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Job Updated Successfully!</strong> 
</div>';
            sleep(4);
                    echo "<script>window.open('employerarea.php','_self')</script>";
     }

}
?>