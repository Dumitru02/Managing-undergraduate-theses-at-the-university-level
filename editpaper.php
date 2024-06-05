<?php
    include "db.php";
    session_start();
    $id = $_POST["row_id"];
    $column = $_POST["column"];
    $value = $_POST["value"];
    
    if ($column === 'uploaded_at')
        $query = "UPDATE papers SET $column=STR_TO_DATE(?, '%d/%m/%Y') WHERE id=?";
    else
        $query = "UPDATE papers SET $column=? WHERE id=?";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("si" , $value, $id);
        $stmt->execute();
        $stmt->close();
    }
    $con->close();
    echo "success";
    exit();
?>


