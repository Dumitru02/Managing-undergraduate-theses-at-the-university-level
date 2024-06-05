<?php 
require '../db.php'; 

$pw = $_POST["password"];
$pw_check = $_POST["password_check"];
$code = $_POST['code'];

if (empty($pw) || empty($pw_check)) {  
    echo " Completeaza toate campurile!";
    exit();
}

if($pw != $pw_check){
    echo "Parolele introduse nu coincid!";
    exit();
}

if (empty($code)) {
	exit("Nu exista cod de verificare pentru schimbarea parolei!"); 
}

    $getCodequery = mysqli_query($con, "SELECT * FROM resetPasswords WHERE code = '$code'"); 
    if (mysqli_num_rows($getCodequery) == 0) {
        exit("Codul de verificare este incorect!"); 
    }

    $pw = password_hash($pw, PASSWORD_BCRYPT);
	$row = mysqli_fetch_array($getCodequery); 
	$email = $row['email']; 
	$query = mysqli_query($con, "UPDATE users SET password = '$pw' WHERE email = '$email'");

	if ($query) {
	 	$query = mysqli_query($con, "DELETE FROM resetPasswords WHERE code ='$code'"); 
	 	exit('reset_success'); 	
 	 }else {
 	 	exit('Eroare la procesarea formularului!'); 	
 	 } 	 


?>
