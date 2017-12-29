<?php
session_start();
include("conn/conn.php");
include("function/functions.php");

?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/2068589c33.js"></script>
    <link rel="stylesheet" href="styles/style.css">
    <title>Sign In As Job Seeker</title>
    <style>

    </style>
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
            <div class="collapse navbar-collapse navbar-right" id="myNavbar">
                <ul class="nav navbar-nav">

                    <li><a href="index.php">Home</a></li>
                    <!-- <li><a href="Employer/employerarea.php">My Profile</a></li> -->
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

            </div>
            <!-- <form>
                <input type="text" name="search" placeholder="Search JOBs ..">
            </form> -->
        </div>
    </nav>
    <!-- navbar end here -->

    <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-4">
               <h2 class="page-header">Log in As Job Seeker</h2>
                <p style="color:red;font-weight:bold;" id="login_fail"></p>
                <form action="" method="post">
                   
                     <div class="form-group">
                     <label for="">Email:</label><br> <input type="email" class="form-control" name="j_email" required>
                     </div>
                     <div class="form-group">
                     <label for="">Password:</label><br> <input type="password" class="form-control" name="j_pass"><br>
                     </div>
                     <button type="submit" name="j_login" class="btn btn-info">Log in</button>

                   </form>
                
            </div>
        </div>

    </div>
    <br><br><br><br><br><br>
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

<?php
function test_input($data) {

             $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
            }

        if(isset($_POST['j_login'])){
         $j_email = test_input($_POST['j_email']);

         $j_pass = test_input($_POST['j_pass']);
        
         $encrypted_pass = encrypt_decrypt('encrypt', $j_pass);

        $sel_seeker="select * from job_seeker where Job_seeker_email='$j_email' AND job_seeker_password='$encrypted_pass'";

        $run_q=mysqli_query($conn,$sel_seeker);

        $sel_seeker=mysqli_num_rows($run_q);
        
        if($sel_seeker==0){ 
echo "<script> 
        var error=document.getElementById('login_fail');
        error.innerHTML='Wrong Email or Password';
        </script>" ;

        exit();

        }
else{

     $_SESSION['Job_seeker_email']=$j_email;

            echo 
            "<script>window.open('Job_seeker/job_seeker_profile.php','_self')</script>";
        
        
        

        
    }
        


}

?>