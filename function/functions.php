<?php
function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'RozgaarUbitIpsixth';
    $secret_iv = 'TheSecretSix';
    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

function getJobs(){
    include("conn/conn.php");
 $get_jobs="select * from job_post order by rand() LIMIT 0,6";

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
                <a href='details.php?jobpost_id=$Job_post_id'><img src='Employer/employer_images/$e_logo' alt='jobs'>&nbsp $Job_description </a><br><hr>


         ";
    }

}
}

?>

