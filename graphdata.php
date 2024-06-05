<?php
    
    include 'db.php';
    session_start();

    //if there is no from_year selected we retrieve rows 
    //from the smallest posible year 
    if ($_POST['from_year'] === '')
        $from_year = '1000';
    else
        $from_year = $_POST['from_year'];

    //if there is no to_year selected we retrieve rows 
    //to the biggest posible year 
    if ($_POST['to_year'] === '')
        $to_year = '9999';
    else
        $to_year = $_POST['to_year'];

    $type = $_POST['type'];
    $arr = array();
    
	
	//for each year compute number of papers uploaded
    for ($i = $from_year; $i <= $to_year; $i++) {
        $query = "SELECT COUNT(*) 
                  FROM papers 
                  INNER JOIN users ON papers.user_id = users.user_id 
                  WHERE YEAR(uploaded_at) = $i 
                  && type= ?
                  && department = ?
                ";

        if ($stmt = $con->prepare($query)) {
            $stmt->bind_param("si", $type, $_SESSION['department']);
            $stmt->execute();
            $stmt->bind_result($count);
            while($stmt->fetch()) 
                $arr[$i] = $count;
            if ($stmt->error)
                echo $stmt->error;
            $stmt->close();
        }
    }
	
	 
	
	//începe căutarea de la anul selectat
    $query = "SELECT COUNT(*) 
              FROM papers 
              INNER JOIN users ON papers.user_id = users.user_id 
              WHERE YEAR(uploaded_at) = ? 
              && type= ?
              && department = ?
            ";

    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("ssi", $from_year, $type, $_SESSION['department']);
        $stmt->execute();
        $stmt->bind_result($papersnr_1);
        while($stmt->fetch()) 
            $arr['cntpapers_from'] = $papersnr_1;
        if ($stmt->error)
            echo $stmt->error;
        $stmt->close();
    }
	
	//find number of papers uploaded in the year 'to_year' 
    $query = "SELECT COUNT(*) 
              FROM papers 
              INNER JOIN users ON papers.user_id = users.user_id 
              WHERE YEAR(uploaded_at) = ? 
              && type= ?
              && department = ?
            ";

    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("ssi", $to_year, $type, $_SESSION['department']);
        $stmt->execute();
        $stmt->bind_result($papersnr_2);
        while($stmt->fetch()) 
            $arr['cntpapers_to'] = $papersnr_2;
        if ($stmt->error)
            echo $stmt->error;
        $stmt->close();
    }
	
	
    $arr['success'] = 1;
    echo json_encode($arr);
    exit();









