<?php
    
    include 'db.php';
    
    $query = "SELECT COUNT(*) 
              FROM papers 
              INNER JOIN users ON papers.user_id = users.user_id 
              && department = 1
            ";

    if ($stmt = $con->prepare($query)) {
        $stmt->execute();
        $stmt->bind_result($papersnr_1);
        while($stmt->fetch()) 
            $arr['papersnr_1'] = $papersnr_1;
        if ($stmt->error)
            echo $stmt->error;
        $stmt->close();
    }

    $query = "SELECT COUNT(*) 
              FROM papers 
              INNER JOIN users ON papers.user_id = users.user_id 
              && department = 2
            ";

    if ($stmt = $con->prepare($query)) {
        $stmt->execute();
        $stmt->bind_result($papersnr_2);
        while ($stmt->fetch())
            $arr['papersnr_2'] = $papersnr_2;
        $stmt->close();
    }
    
    $con->close();
    
    $arr = array();
    $arr['success'] = 1;
    $arr['papersnr_1'] = $papersnr_1;
    $arr['papersnr_2'] = $papersnr_2;
    echo json_encode($arr);
    exit();










