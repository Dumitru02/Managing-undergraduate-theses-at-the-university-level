<?php
    include "db.php";
    session_start();
    $id = $_POST['row_id']; 
    $query = "DELETE FROM papers WHERE id=$id";
    if ($stmt = $con->prepare($query)) {
        $stmt->execute();
        if ($stmt->error) {
            echo "Stergerea nu s-a efectuat! [Cod 3210]";
            exit();
        }
        $stmt->close();
    }
    $con->close();
    echo "success";
    exit();
?>


