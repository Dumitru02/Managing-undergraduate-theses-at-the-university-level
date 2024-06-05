<?php
    include "db.php";
    session_start();
    $id = $_POST['user_id']; 
	
    $query = "UPDATE users SET role='director' WHERE user_id=?";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("i", $id);
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


