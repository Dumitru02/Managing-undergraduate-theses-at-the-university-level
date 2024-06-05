<?php
    include "db.php";
    session_start();
    $id = $_POST['user_id']; 
    $query = "UPDATE users SET role='prof' WHERE user_id=$id";
    if ($stmt = $con->prepare($query)) {
        $stmt->execute();
        if ($stmt->error) {
            echo "Actualizarea nu s-a efectuat! [Cod 3210]";
            exit();
        }
        $stmt->close();
    }
    $con->close();
    echo "success";
    exit();
?>

