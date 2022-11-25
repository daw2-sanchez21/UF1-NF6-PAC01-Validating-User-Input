<?php 
$emailErr ="";
$email="";
 if (empty($_POST['email'])) {
    $emailErr = "Email is required";
    echo $emailErr;
  } else {
    $email = $_POST['email'];
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      echo $emailErr;
    }else{
    	echo "Email verified";
    }}


  
?>