<?php
session_start();
include "db.php";

$f_name = $_POST["first_name"];
$l_name = $_POST["last_name"];
$email = $_POST['email'];
$department = $_POST['department'];
$password = $_POST['password'];
$repassword = $_POST['password_check'];
$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";

if (empty($f_name) || empty($l_name) || 
    empty($email) || empty($password) ||
    empty($password) || empty($repassword)) {
    echo " Completeaza toate campurile!";
    exit();
}

if(!preg_match($emailValidation,$email)){
    echo "$email nu este un email valid!";
    exit();
}

if(strlen($password) < 3 ){
    echo "Parola aleasa e prea scurta!";
    exit();
}

if($password != $repassword){
    echo "Parolele introduse nu coincid!";
    exit();
}

//existing email address in our database
$sql = "SELECT user_id FROM users WHERE email = '$email' LIMIT 1" ;
$check_query = mysqli_query($con, $sql);
$count_email = mysqli_num_rows($check_query);

if($count_email > 0){
    echo "Email-ul exista in baza de date!";
    exit();
} else {
    
    $pw = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO `users` 
    (`first_name`, `last_name`, `email`, 
    `password`, `role`, `department`) 
    VALUES ('$f_name', '$l_name', '$email', '$pw', 'prof', $department)";

    if(mysqli_query($con,$sql)){
        echo "register_success";
        exit();
    }
		
  }
?>
