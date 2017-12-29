<?php
session_start();
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
    <title>Employer SIGNUP</title>
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
               <h2 class="page-header">Sign Up As Employer</h2>
               <br />
               <p style="color:red;font-weight:bold;" id="result"></p>
                <form action="" method="post" >
                   <div class="form-group">
                   	<label for="User">UserName:</label>
                     <input type="text" class="form-control" name="e_username" id="User" required>
                     </div>

                     <div class="form-group">
                     <label for="em">Email:</label>
                      <input type="email" name="e_email" class="form-control"id="em" required>
                     </div>

                     <div class="form-group">
                     <label for="pas">Password:</label>
                      <input type="password" name="e_pass" class="form-control" id="pas" required>
                      </div>
                      
                      <div class="form-group">
                      <label for="cp">Confirm Password:</label>
                     <input type="password" name="e_confirmpass" class="form-control" id="cp" required>
                     </div>
                     <button type="submit" name="e_signup_submit" class="btn">Sign Up</button>

                   </form>
                
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


<?php
//for employer signup
include("conn/conn.php");
include("function/functions.php");
$err='';
	function checker($data) {

 			 $data = trim($data);
  			$data = stripslashes($data);
 	 		$data = htmlspecialchars($data);
  			return $data;
			}
if(isset($_POST['e_signup_submit'])){
  $username=checker($_POST['e_username']);
   $email=checker($_POST['e_email']);
   $pass=checker($_POST['e_pass']);
  $confirmpass=checker($_POST['e_confirmpass']);

  if($username==' '){

	$err='User Name is Required';
	  echo "<script>var error=document.getElementById('result');
    error.innerHTML='$err';</script>";
}

  elseif(!ctype_alnum($username)){
	$err="Username Can only contain letter and digits";
	  echo "<script>var error=document.getElementById('result');
    error.innerHTML='$err';</script>";
}

   elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   $err = "Invalid email";
     echo "<script>var error=document.getElementById('result');
    error.innerHTML='$err';</script>"; 
}

elseif($email==' '){

	$err='Email is Required';
	 echo "<script>var error=document.getElementById('result');
    error.innerHTML='$err';</script>";
}
elseif($pass==' '){

	$err='Password is Required';
	echo "<script>var error=document.getElementById('result');
    error.innerHTML='$err';</script>";
}
elseif(!ctype_alnum($pass)){
	$err="Password Can only contain letter and digits";
	echo "<script>var error=document.getElementById('result');
    error.innerHTML='$err';</script>";
}
elseif($pass!==$confirmpass){

	$err='Password does not match';
	 echo "<script>var error=document.getElementById('result');
    error.innerHTML='$err';</script>";
}
else{
	//encrypting Password
	$encrypted_txt = encrypt_decrypt('encrypt', $pass);
	 // $dec_txt = encrypt_decrypt('decrypt', $encrypted_txt);
	$query1="select * from employer where e_username='$username'";
	$runq_1=mysqli_query($conn,$query1);
	$check1=mysqli_num_rows($runq_1);
	$query2="select * from employer where e_email='$email'";
	$runq_2=mysqli_query($conn,$query2);
	$check2=mysqli_num_rows($runq_2);
	if($check1>0 AND $check2==0){
		$err='UserName Already Exist';
		echo "<script>var error=document.getElementById('result');
    error.innerHTML='$err';</script>";
	}
	if($check1==0 AND $check2>0){
		$err='Email Already Exist';
		echo "<script>var error=document.getElementById('result');
    error.innerHTML='$err';</script>";
	}
	if($check1==0 AND $check2==0){
     //creating session for employee alright
     $_SESSION['e_username']=$username;
		$query3="insert into employer(e_password,e_email,e_username,testing) values('$encrypted_txt','$email','$username','$pass')";


		$runq_3=mysqli_query($conn,$query3);

		if($runq_3){
			echo "<script>window.open('Employer/employerarea.php','_self')</script>";
		}
	}



}



}


?>