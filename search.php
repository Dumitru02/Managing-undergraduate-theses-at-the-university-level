<?php
    include "db.php";
    session_start();
    $term = '%' . $_POST['value'] . '%';
    $query = "SELECT id, publication, volume, uploaded_at, title,
              authors, publisher, pages, website, country, type 
              FROM papers 
              INNER JOIN users ON papers.user_id = users .user_id
              WHERE users.user_id = ? && publication LIKE ?";
    $arr = array();
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param('is', $_SESSION['user_id'], $term);
        $stmt->execute();
        $stmt->bind_result($paper_id, $publication, $volume, $uploaded_at, 
            $title, $authors, $publisher, $pages, $website, $country, $type);
        
        //for every row(entry) we get from database table we add it to array
        while ($stmt->fetch()) 
            array_push($arr, $paper_id, $publication, $volume, $date("d/m/Y", strtotime($uploaded_at)), 
              $title, $authors, $publisher, $pages, $website, $country, $type);

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


            
            
