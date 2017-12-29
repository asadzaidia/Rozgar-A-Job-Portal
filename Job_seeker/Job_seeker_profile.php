<?php
include("conn/conn.php");
session_start();
 if(isset($_SESSION['Job_seeker_email'])){
$aa=$_SESSION['Job_seeker_email'];
    // echo $aa;

$query="select 	Job_seeker_id from job_seeker where Job_seeker_email='$aa'";

$run_q1=mysqli_query($conn,$query);
 while($row=mysqli_fetch_array($run_q1)){
         $j_id=$row['Job_seeker_id'];
    }
    //getting its logo
    $getting_image="select 	job_seeker_image from job_seeker_profile where Job_seeker_id='$j_id'";
    $run_image=mysqli_query($conn,$getting_image);
     while($row_image=mysqli_fetch_array($run_image)){
         $image=$row_image['job_seeker_image'];
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
    <title>Job Seeker</title>
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
                          include('conn/conn.php');
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

    
<div class="row">
	<div class="col-md-12 col-md-3" style="margin-top: 30px;">
	<div id="employer_image" style="margin-bottom: 10px;">
        <center><img src="jobseeker_images/<?php echo $image;?>" class="img-responsive img-rounded" height="10" ></center>
    </div>
				<ul class="nav nav-pills nav-stacked">
				<?php
					$query4="select checking from job_seeker_profile where Job_seeker_id='$j_id'";
					 //checking whether Profile Completed
   				 $run_test=mysqli_query($conn,$query4);
     $check=mysqli_num_rows($run_test);
    	if(!$check>0){
    		echo "<li role='presentation'><a href='Job_seeker_profile.php?complete_profile'>Complete Profile</a></li>";
    	}

				?>	

			
				<li role="presentation"><a href="Job_seeker_profile.php?update-profile">Update Profile</a></li>
				<li role="presentation"><a href="Job_seeker_profile.php?update-resume">Update Resume</a></li>
				<li role="presentation"><a href="Job_seeker_profile.php?update-image">Update Image</a></li>
			
				</ul>

			</div>

			<div class="col-md-12 col-md-9" >

				<?php
				function checker($data) {

             $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
            }

					include("conn/conn.php");

					if(isset($_GET['complete_profile'])){

						include("complete_profile.php");

					}

					if(isset($_GET['update-profile'])){

						include("update-profile.php");
					}
					if(isset($_GET['update-resume'])){

						include("update-resume.php");
					}
					if(isset($_GET['update-image'])){

						include("update-image.php");
					}
					


				?>


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
    

</body>

    </html>


 <?php
}
 
 else{

 	 echo "<script>window.open('../login_menu.php','_self')</script>";
 }


?>