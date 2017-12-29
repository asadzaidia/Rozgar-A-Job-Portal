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
    <title>Sign In As Employer</title>
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
    <br><br><br>
    <!-- navbar end here -->

    <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-4">
               <h2 class="page-header">Log in As Employer</h2>
               <p style="color:red;font-weight:bold;" id="login_fail"></p>
                <form action="" method="post">
                    <div class="form-group">
                     <label for="">  Email:</label><br> <input type="email" class="form-control" name="e_email" required>
                     </div>
                     
                     <div class="form-group">
                    <label for=""> Password:</label><br> <input type="password" class="form-control" name="e_pass" required><br>
                    </div>
                     <button type="submit" name="e_login" class="btn">Log in</button>

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

        if(isset($_POST['e_login'])){
         $e_email = test_input($_POST['e_email']);

         $e_pass = test_input($_POST['e_pass']);
        
         $encrypted_pass = encrypt_decrypt('encrypt', $e_pass);

        $sel_employer="select * from employer where e_email='$e_email' AND e_password='$encrypted_pass'";

        $run_q=mysqli_query($conn,$sel_employer);

        $check_employer=mysqli_num_rows($run_q);
        
        if($check_employer==0){ 
echo "<script> 
        var error=document.getElementById('login_fail');
        error.innerHTML='Wrong Email or Password';
        </script>" ;

        exit();

        }
else{

    $query2="select e_username from employer where e_email='$e_email'";
    $runq_2=mysqli_query($conn,$query2);
      while($row=mysqli_fetch_array($runq_2)){

         $user=$row['e_username'];
      }

     $_SESSION['e_username']=$user;

            echo 
            "<script>window.open('Employer/employerarea.php','_self')</script>";
        
        
        

        
    }
        


}

?>