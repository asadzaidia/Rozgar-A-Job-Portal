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
    <div class="container-fluid">
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
                    <li><a href="Employer/employerarea.php">My Profile</a></li>
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
                </ul>
               
   
                <ul class="nav navbar-nav navbar-right">
                <li class="dropdown"><a  style="color:#FFFFFF" class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Sign up</a>
                        <ul class="dropdown-menu hel">
                            <li><a href="employer_signup.php">Sign Up As Employer</a></li>
                            <li><a href="job_seekeer_signup.php">Sign Up As Job Seeker</a></li>
                           
                        </ul>
                    </li>

                    <?php
                    if(isset($_SESSION['e_username']) OR (isset($_SESSION['Job_seeker_email']))){
                        echo"
                     <li>
                        <a href='logout.php' class='btn btn-default'>LOGOUT <span><i class='fa fa-sign-out' aria-hidden='true'></i></span></a></li> ";
                }
               
                    else{

                        echo " 
                        <li class='dropdown'><a  style='color:#FFFFFF' class='dropdown-toggle' data-toggle='dropdown' href='#'><span class='glyphicon glyphicon-user'></span> Log in</a>
                        <ul class='dropdown-menu hel'>
                            <li><a href='employer_login.php'>Log in As Employer</a></li>
                            <li><a href='job_seeker_login.php'>Log in As Job Seeker</a></li>
                           
                        </ul>
                    </li> ";


                    }
                ?>
                   
                </ul><!-- navbar right end-->
            </div>
            <form>
                <input type="text" name="search" placeholder="Search JOBs ..">
            </form>
        </div>
    </nav>
    <div class="container">
        <center style="font-size: 50px;font-weight: bold;">Kindly Login Or Register Yourself!</center>
    </div>

    
    </body>
    </html>
