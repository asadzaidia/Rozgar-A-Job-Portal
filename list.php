<?php
@session_start();
 $type_id=$_GET['type_id'];
 include('conn/conn.php');
	
	
	
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
    <style>
      
    </style>
    <title>Rozgarr.pk</title>
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
      <a class="navbar-brand" href="index.php">ROZGAR.<span style="font-size:10px;">com</span></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">

                    <li><a href="index.php">Home</a></li>
                    <?php
                       if(isset($_SESSION['e_username'])){
                        echo "<li><a href='Employer/employerarea.php'>My Profile</a></li>";
                       } 
                 elseif(isset($_SESSION['Job_seeker_email'])){
                         echo "<li><a href='Job_seeker/Job_seeker_profile.php'>My Profile</a></li>";
                       } 
                       else{
                         echo "<li><a href='Job_seeker/Job_seeker_profile.php'>My Profile</a></li>";
                       }
                    ?> 
                    
                    
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
                      <li><a href='list.php?type_id=$company_id'>$company_type_name</a></li>
                              ";

                            }

                          ?>
                           
                           
                            
                        </ul>
                    </li>
                    <li><a href="#do">About us</a></li>
                </ul>
               
                
                <ul class="nav navbar-nav navbar-right">
                    <li style="padding:4px;"><form>
                <input type="text" name="search" placeholder="Search jobs ..">
            </form></li>
                <li class="dropdown"><a  style="color:#534c4c" class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Sign up</a>
                        <ul class="dropdown-menu hel">
                            <li><a href="employer_signup.php">Sign Up As Employer</a></li>
                            <li><a href="job_seekeer_signup.php">Sign Up As Job Seeker</a></li>
                           
                        </ul>
                    </li>

                    <?php
                    if(isset($_SESSION['e_username']) OR (isset($_SESSION['Job_seeker_email']))){
                        echo"
                     <li>
                        <a href='logout.php' class='btn'>LOGOUT <span><i class='fa fa-sign-out' aria-hidden='true'></i></span></a></li> ";
                }
               
                    else{

                        echo " 
                        <li class='dropdown'><a  style='color:#534c4c' class='dropdown-toggle' data-toggle='dropdown' href='#'><span class='glyphicon glyphicon-user'></span> Log in</a>
                        <ul class='dropdown-menu hel'>
                            <li><a href='employer_login.php'>Log in As Employer</a></li>
                            <li><a href='job_seeker_login.php'>Log in As Job Seeker</a></li>
                           
                        </ul>
                    </li> ";


                    }
                ?>
                   
                </ul><!-- navbar right end-->
            </div>
           
        </div>
    </nav>

    <div class="container">
    	<div class="row">
    	<div class="col-md-12">
    	<?php
    		include("conn/conn.php");
 $get_jobs="select * from job_post where job_type_id='$type_id'";

          $run_q=mysqli_query($conn,$get_jobs);

          while($row_products=mysqli_fetch_array($run_q)){
            $Job_post_id=$row_products['Job_post_id'];
            $emoplyer_id=$row_products['emoplyer_id'];
              $Job_description=$row_products['Job_description'];
              //getting employer logo
            $get_image="select emp_logo from employer_profile where emp_id='$emoplyer_id'";
            $runq2=mysqli_query($conn,$get_image);
    while($row=mysqli_fetch_array($runq2)){
         $e_logo=$row['emp_logo'];

         echo "  
               
        
         <img src='Employer/employer_images/$e_logo' alt='jobs'/>
         <br>
    	<a href='details.php?jobpost_id=$Job_post_id'>&nbsp $Job_description </a><br>
    	<hr style='height:1px;border:none;color:#333;background-color:#333;'/>



         ";
    }


}
?>
    	</div>
    	
    	</div>

    </div>
    
        
                    <br>
                    <footer class="footerBack" id="do">
                    <div class="container">
                        <div class="row">
                        <div class="col-md-3">
                       <ul> 
                           <li><h3>About Us</h3>
                        <p>We're Job providers based company Our moto is that everybody update recent jobs</p>
                        </li>
                        </ul>
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
                        <ul>

                        <li><h3>Follow Us:</h3>
                        <p><a href="#"> <i class="fa fa-facebook" aria-hidden="true"></i></a>&nbsp
                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a> &nbsp
                        <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        </ul>
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


