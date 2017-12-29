<?php
session_start();
 if(isset($_SESSION['e_username'])){
    
    
    
    include("../conn/conn.php");
     $e_userName=$_SESSION['e_username'];
    $query1="select Employer_id from employer where e_username='$e_userName'";
    //getting emp id
    $runq1=mysqli_query($conn,$query1);
    while($row=mysqli_fetch_array($runq1)){
         $e_id=$row['Employer_id'];
    }

    //getting its logo
    $getting_image="select emp_logo from employer_profile where emp_id='$e_id'";
    $run_image=mysqli_query($conn,$getting_image);
     while($row_image=mysqli_fetch_array($run_image)){
         $image=$row_image['emp_logo'];
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://use.fontawesome.com/2068589c33.js"></script>
    <title>Employee Panel</title>
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
                <a class="navbar-brand" href="../index.php">ROZGAR.<span style="font-size:10px;">com</span></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">

                   <li><a href="../index.php">Home</a></li>
                  
                        <li><a href='employerarea.php'>My Profile</a></li>
                     
                    <li><a href="#">Blogs</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">All jobs <span class="caret"></span></a>

                        <ul class="dropdown-menu">
                          <?php
                          
                            $query="select * from company_type WHERE 1";
                            $run_query=mysqli_query($conn,$query);
                            while($row=mysqli_fetch_array($run_query)){
                              $company_id=$row['company_type_id'];
                              $company_type_name=$row['company_type_name'];

                              echo "
                      <li><a href='../list.php?type_id=$company_id'>$company_type_name</a></li>
                              ";

                            }

                          ?>
                           
                           
                            
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if(isset($_SESSION['e_username']) OR (isset($_SESSION['Job_seeker_email']))){
                        echo"
                     <li>
                        <a href='../logout.php' class='btn'>LOGOUT <span><i class='fa fa-sign-out' aria-hidden='true'></i></span></a></li> ";
                }
               
                    else{

                        echo " 
                        <li class='dropdown'><a  style='color:#FFFFFF' class='dropdown-toggle' data-toggle='dropdown' href='#'><span class='glyphicon glyphicon-user'></span> Log in</a>
                        <ul class='dropdown-menu hel'>
                            <li><a href='../employer_login.php'>Log in As Employer</a></li>
                            <li><a href='../job_seeker_login.php'>Log in As Job Seeker</a></li>
                           
                        </ul>
                    </li> ";


                    }
                ?> 

                </ul>
            </div>
            <!-- <form>
                <input type="text" name="search" placeholder="Search JOBs ..">
            </form> -->
        </div>
    </nav>
   
    <div class="forlist">
        <div class="container">

            <div class="row">
     
                <div class="col-md-3">
                        <!--Employer Image-->
    <div id="employer_image">
        <center><img src="employer_images/<?php echo $image;?>" class="img-responsive" height="10" alt="Kindly Complete Your Profile"></center>
    </div>
    <br />
            <ul class="nav">
                <li class="active"><a data-toggle="tab" href="#homec">Post A Job</a></li>
                <li><a data-toggle="tab" href="#menu11">My All Jobs</a></li>
                <li><a data-toggle="tab" href="#menu22">Update Company Profile</a></li>
                <li><a data-toggle="tab" href="#menu33">Complete Company Profile</a></li>
                <!-- <li><a data-toggle="tab" href="#menu44">Update Company Logo</a></li> -->
            </ul>
        </div>

        <!--Post a Job -->
            <div class="col-md-8">
            <div class="tab-content">
                <div id="homec" class="tab-pane fade in active">
                    
                    
                        
                    <form action="" method="post">
                 <div class="form-group">
                     <label for="Select">Job Type:</label>
                    <select name="job_type" class="form-control" id="sel1">
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
                        <label>Job Last Date:</label>
                        <input type="date" class="form-control" name="l_date" required>
                        </div>

                        <div class="form-group">
                        <label>Your Complete Location:</label>
                        <input type="text" class="form-control" name="job_location"required>
                        </div>

                        <div class="form-group">
                            <label>Job Description:</label>
                            <textarea class="form-control" name="job_des"rows="5" required></textarea>
                        </div>

                        <button type="submit" name="job_post" class="btn btn-default">Submit</button>
                    </form>
                </div>
 <!--My All Jobs-->               
                <div id="menu11" class="tab-pane fade">
                       <h2 class="page-header">My Jobs:</h1>
    
          <div class="table-responsive">          
  <table class="table table-hover">
    <thead>
      <tr class="success">
        <th>Job Type</th>
        <th>Job Post Date</th>
        <th >Job Last Date</th>
        <th >Job Description</th>
    
        <th >Job Location</th>
        <th>Job Edit</th>
        <th>Job Delete</th>
      </tr>
    </thead>
<!--Quering Jobs -->
<?php

$query3="select * from job_post where emoplyer_id='$e_id'";
$runq3=mysqli_query($conn,$query3);
$check=mysqli_num_rows($runq3);
if($check>0){
while($row2=mysqli_fetch_array($runq3)){
    $Job_post_id=$row2['Job_post_id'];
   $job_type_id=$row2['job_type_id'];
    $Job_post_date=$row2['Job_post_date'];
  $Job_last_date=$row2['Job_last_date'];
    $job_location=$row2['job_location']; 
    $Job_description=$row2['Job_description'];


   //getting type title
  $geting_type_title="select company_type_name from company_type where company_type_id='$job_type_id'";
  $q=mysqli_query($conn,$geting_type_title);
  while($row3=mysqli_fetch_array($q)){
     $type_name=$row3['company_type_name'];
  }
  


   echo"<tbody>
     <tr>
        <td>$type_name</td>
        <td>$Job_post_date</td>
        <td>$Job_last_date</td>
        <td>$Job_description</td>
        <td>$job_location</td>

        <td><a href='edit_job.php?edit_job=$Job_post_id' class='btn btn-info'>Edit</a></td>
        <td><a href='deletejob.php?del_job=$Job_post_id' class='btn btn-danger'>Delete</a></td>
      </tr>
    </tbody>";
}



}
else{
    echo"
    <tbody>
    <div class='alert alert-success alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Your Have Not Posted Any Job Yet!</strong>
</div>

    </tbody>


    ";

}


?>


    <tbody>

  
    </tbody>

    
  </table>
  

    </div>

                </div>

                <!-- Update Company Profile-->
                <div id="menu22" class="tab-pane fade">
                        <?php
                        include("../conn/conn.php");
                        $query8="select * from employer_profile where emp_id='$e_id'";
                        $run8=mysqli_query($conn,$query8);
                        $row_edit=mysqli_fetch_array($run8);
                        $emp_com_type=$row_edit['emp_com_type'];
                        $emp_profile_description=$row_edit['emp_profile_description'];
                        $emp_company_url=$row_edit['emp_company_url'];
                        $City=$row_edit['City'];
                        $emp_company_name=$row_edit['emp_company_name'];
                        $emp_address=$row_edit['emp_address'];


   //getting type title
  $geting_type_title2="select company_type_name from company_type where company_type_id='$emp_com_type'";
  $q2=mysqli_query($conn,$geting_type_title2);
  while($rowt=mysqli_fetch_array($q2)){
    $type_namee=$rowt['company_type_name'];
  }
  



                        ?>


                      <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                                <label >Employer Company Type:</label>
                                 <select name="u_employer_type" class="form-control" >
                  <?php 

                    if(!$type_namee==''){
                         echo "<option value='$emp_com_type'> $type_namee </option";

                    }
                    ?>

                  
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
                                <label >Profile_description</label>
                                <textarea class="form-control" name="u_p_des" value=><?php echo $emp_profile_description;?></textarea>  
                        </div>
                        <div class="form-group">
                                <label >Company Website url</label>
                                <input type="text" class="form-control" name="u_url" value="<?php echo $emp_company_url;?>">
                        </div>
                        <div class="form-group">
                                <label >City</label>
                                <input type="text" class="form-control" name="u_city" value="<?php echo $City;?>" >
                        </div>
                        <div class="form-group">
                                <label >Company Name</label>
                                <input type="text" class="form-control" name="u_company_name"  value="<?php echo $emp_company_name;?>" >
                        </div>
                    
                        <div class="form-group">
                                <label >Company Address</label>
                                <input type="text" class="form-control" name="u_company_address" value="<?php echo $emp_address;?>">
                        </div>
                     
                       
                        <button type="submit" name="update_profile" class="btn btn-success">Update</button>
                    </form>  
                   
                </div>



                <!-- Insert Company Profile-->
                <div id="menu33" class="tab-pane fade">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                                <label >Employer Company Type:</label>
                                 <select name="employer_type" class="form-control" id="sel1">
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
                                <label >Profile_description</label>
                                <textarea class="form-control" name="p_des"required></textarea>  
                        </div>
                        <div class="form-group">
                                <label >Company Website url</label>
                                <input type="text" class="form-control" name="url" required >
                        </div>
                        <div class="form-group">
                                <label >City</label>
                                <input type="text" class="form-control" name="city" required >
                        </div>
                        <div class="form-group">
                                <label >Company Name</label>
                                <input type="text" class="form-control" name="company_name"  required>
                        </div>
                    
                        <div class="form-group">
                                <label >Company Address</label>
                                <input type="text" class="form-control" name="company_address"  required>
                        </div>
                        <div class="form-group">
                                <label >Apply at:</label>
                                <input type="text" class="form-control" name="apply_at"  required>
                        </div>
                        <div class="form-group">
                        <label for="eimg">Employer Company Image</label>
                    <input type="file" class="form-control" name="e_img" placeholder="" id="eimg">
                    </div>
                       
                        <button type="submit" name="insert_profile" class="btn btn-success">Submit</button>
                    </form>
                </div>

                <!-- Updating Employer Logo-->
               <!--  <div id="menu44" class="tab-pane fade">

                <form action="" method="post" enctype="multipart/form-data">
                 <label for="uimg">Employer Company Image</label>
                    <div class="form-group">
                    <input type="file" class="form-control" name="u_img" placeholder="Update Your Company's Logo" id="uimg">
                    </div>
                    <button type="submit" name="update_logo" class="btn btn-success">Update Logo</button>
                    </form>

                    </div>
 -->

                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<br>
                    <footer class="footerBack">
                    <div class="container">
                        <div class="row">
                        <div class="col-md-3">
                        <h3>About Us</h3>
                        <p>We're Job providers based company Our moto is that everybody update recent jobs</p>
                      
                        </div>

                        <div class="col-md-3">
                        
                        <ul>
                        <li><h3>Jobs</h3></li>
                        <li> <a href="#">Information Technology</a></li>
                        <li> <a href="#">Banking</a></li>
                        <li> <a href="#">Government</a></li>
                        <li> <a href="#">Services</a></li>
                        <li> <a href="#" style="color:#fff; font-size:15px;">See All ></a></li>
                        
                        </ul>
                        </div>
                        <div class="col-md-3">
                        <h3>Follow Us:</h3>
                        <p><a href="#"> <i class="fa fa-facebook" aria-hidden="true"></i></a>&nbsp
                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a> &nbsp
                        <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                    </p>
                        
                        </div>
                        <div class="col-md-3">
                        <ul>   
                       <li><h3>Contact Info</h3></li>
                            
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp&nbsp<a href="#"> Dcs-UBIT,UoK Pakistan</a></li>
                                <li><i class="fa fa-phone" aria-hidden="true"></i>&nbsp<a href="#"> +92-3448302</a></li>
                                <li><i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp<a href="#"> info@rozgaar.com</a></li>
                                </ul>

                        </div>
                        </div>
                    </div>
                    
                    </footer>
                    <center class="Copyright">
                        CopyRight<sup>&copy</sup> Reserved 2018
                    </center>
    

    <script>
        $(document).ready(function () {
            $(".nav-tabs a").click(function () {
                $(this).tab('show');
            });
        });
    </script>

</body>

</html>



<?php
function checker($data) {

             $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
            }

  //for job posting          

if(isset($_POST['job_post'])){

     $job_type=checker($_POST['job_type']);
     $l_date=checker($_POST['l_date']);
     $job_location=checker($_POST['job_location']);
     $job_des=checker($_POST['job_des']);
     

     $query2="insert into job_post(job_type_id,emoplyer_id,Job_post_date,Job_last_date,  job_location,Job_description) values('$job_type','$e_id',now(),'$l_date','$job_location','$job_des')";

     $runq2=mysqli_query($conn,$query2);
     if($runq2){
        echo "<div class='alert alert-success alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <strong>Your Job has been Posted!</strong> Thanks for your posting.
</div>";
 sleep(4);
                    echo "<script>window.open('employerarea.php','_self')</script>";


     }
    
}


//for completing Profile
if(isset($_POST['insert_profile'])){

    $employer_type=checker($_POST['employer_type']);
     $p_des=checker($_POST['p_des']);
     $url=$_POST['url'];
     $city=checker($_POST['city']);
     $apply_at=checker($_POST['apply_at']);
     $company_name=checker($_POST['company_name']);
      $company_address=checker($_POST['company_address']);

        //image name
       $e_img = $_FILES['e_img']['name'];
        //getting file type
       $imageFileType = pathinfo($e_img,PATHINFO_EXTENSION);
        //Image temp names
        $temp_img = $_FILES['e_img']['tmp_name'];
        //Image Size
        // echo $size=$_FILES['e_img']['size'];
        $maxsize=2097152;

        

        //checking its already exists or not
        $target_image="employer_images/".$temp_img;
        $target="employer_images/".$e_img;
        if(filter_var($url,FILTER_VALIDATE_URL)==false){
            echo "<div class='alert alert-warning alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <strong>Not a valid Url</strong> 
</div>";
        }
        //already Exists
        elseif(file_exists($target)==true){
                    echo "<div class='alert alert-warning alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <strong> Image Already Exists Kindly Rename it to unique name</strong> 
</div>";
        }
        //image size
        elseif(($_FILES['e_img']['size']>$maxsize) || ($_FILES["e_img"]["size"] == 0)){
           
         echo "<div class='alert alert-warning alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <strong>File Size is not greater than 2Mb</strong> 
</div>";
        }
        //image types
        elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){
           
            echo "<div class='alert alert-warning alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <strong>Only Jpg,Jpeg and Png Images are allowed</strong> 
</div>";
        }
        else{
            include("../conn/conn.php");
            move_uploaded_file($temp_img,$target);
            $query_pro="insert into employer_profile(emp_id,emp_com_type,emp_profile_description,emp_company_url,City,emp_logo,emp_company_name,emp_address,apply_at) values('$e_id','$employer_type','$p_des','$url','$city','$e_img','$company_name','$company_address','$apply_at')";
            $run_query_pro=mysqli_query($conn,$query_pro);
            if($run_query_pro){
                echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Thanks for Completing your profile!</strong> 
</div>';
            sleep(4);
                    echo "<script>window.open('employerarea.php','_self')</script>";
            }
        }
}

//update_profile
if(isset($_POST['update_profile'])){
 $u_employer_type=$_POST['u_employer_type'];
 $u_p_des=$_POST['u_p_des'];
 $u_url=$_POST['u_url'];
 $u_city=$_POST['u_city'];
 $u_company_name=$_POST['u_company_name'];
 $u_company_address=$_POST['u_company_address'];

if(filter_var($u_url,FILTER_VALIDATE_URL)==false){
            echo "<div class='alert alert-warning alert-dismissible' role='alert'>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
  <strong>Not a valid Url</strong> 
</div>";
        }
    else{
$update_query_pro="update employer_profile set emp_com_type='$u_employer_type',emp_profile_description='$u_p_des',emp_company_url='$u_url',City='$u_city',emp_company_name='$u_company_name',emp_address='$u_company_address' where emp_id='$e_id'";

    $run_update_pro=mysqli_query($conn,$update_query_pro);
    if($run_update_pro){
        echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Profile Updated Successfully!</strong> 
</div>';
            sleep(4);
                    echo "<script>window.open('employerarea.php','_self')</script>";
    }
        }


} 

 }
 else{
    echo "<script>window.open('../login_menu.php','_self')</script>";
 }


?>
