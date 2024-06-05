<?php
    include "db.php";
    session_start();

    $user_id = $_SESSION["user_id"];
    $volume = $_POST['volume'];
    $publication = $_POST['publication'];
    $type = $_POST['type'];
    $uploaded_at = $_POST['uploaded_at'];
    $title = $_POST['title'];
    $authors = $_POST['authors'];
    $publisher = $_POST['publisher'];
    $pages = $_POST['pages'];
    $website = $_POST['website'];
    $country = $_POST['country'];
    
	if (empty($volume) || empty($publication) || empty($type)
        || empty($uploaded_at) || empty($title) || empty($authors) 
        || empty($publisher) || empty($pages) || empty($website) 
        || empty($country) ) {
		echo 'Completeaza toate campurile!';
		exit();
	}
    
    $query = "INSERT INTO papers(user_id, volume, publication, type, uploaded_at,
                title, authors, publisher, pages, website, country)
              VALUES(?, ?, ?, ?, 
              STR_TO_DATE(?, '%d/%m/%Y'), ?, ?, ?, ?, ?, ?)";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("issssssssss", $user_id, $volume, $publication, $type, 
          $uploaded_at, $title, $authors, $publisher, $pages, $website, $country);
        $stmt->execute();
        $stmt->close();
    }
    $con->close();
    echo "success";
    exit();
?>

