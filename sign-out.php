<?php
session_start();
unset(
    $_SESSION['user_id'], 
    $_SESSION['f_name'], 
    $_SESSION['l_name'],
    $_SESSION['department'],
    $_SESSION['role'],
    $_SESSION['email']
    

);
echo "success";
exit();
?>

