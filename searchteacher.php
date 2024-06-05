<?php
    include "db.php";
    session_start();
    $term = '%' . $_POST['value'] . '%';
    $query = "SELECT user_id, first_name, last_name, email
              FROM users
              WHERE users.department = ?
              && users.last_name LIKE ?";

    $arr = array();

    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param('is', $_SESSION['department'], $term);
        $stmt->execute();
        $stmt->bind_result($user_id, $first_name, $last_name, $email);
        while ($stmt->fetch()) 
            array_push($arr, $user_id, $first_name, $last_name, $email);
        if ($stmt->error) {
            $arr['error'] = 1;
            $arr['message'] = $stmt->error;
            echo json_encode($arr);
            exit();
        }

        $stmt->close();
    }
    $con->close();
    echo json_encode($arr);


            
            

