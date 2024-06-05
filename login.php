<?php
include "db.php";

session_start();

$arr = array();
$arr[0] = 'login_failed';


if (!isset($_POST["email"])) {
    $arr[1] = "Nu ai completat emailul!";
    echo json_encode($arr);
    exit();
}
else if (!isset($_POST["password"])) {
    $arr[1] = "Campul parola nu a fost completat!";
    echo json_encode($arr);
    exit();
}
else if(isset($_POST["email"]) && isset($_POST["password"])) {
	$email = mysqli_real_escape_string($con, $_POST["email"]);
	$password = $_POST["password"];
	$sql = "SELECT * FROM users WHERE email = '$email'";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	$row = mysqli_fetch_array($run_query);
        
	//if user record is available in database then $count will be equal to 1
	if($count == 1 && password_verify($password, $row['password'])){
			   
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["f_name"] = $row["first_name"];
            $_SESSION["l_name"] = $row["last_name"];
            $_SESSION["department"] = $row["department"];
            $_SESSION["role"] = $row["role"];
            $_SESSION['email'] = $row['email'];

            $arr[0] = "success";
            $arr[1] = $row["role"];

            echo json_encode($arr);
            exit();
    }
    else {
        $arr[1] = "Datele de autentificare nu sunt corecte!";
        echo json_encode($arr);
    }
}



?>
