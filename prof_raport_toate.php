<!DOCTYPE html>
<html lang="en">
<head>
		  <title>Licentă-Profesor</title>
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
  
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
		  
		  <!-------------------- --------------------------------->
		  
		  <link rel="stylesheet" href="prof_raport_tot.css">
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   
   

 
	

</head>
 

   
<body>

		
			

  <div id="dep1_muta">
 <span id="dep_1">Articole publicate </span>
 
<div class="table-wrapper-scroll-y my-custom-scrollbar">

  <table class="table table-bordered table-striped mb-0">
   
    <thead class="thead-dark">
      <tr>
        <th scope="col">Numar</th>
        <th scope="col">Titlu</th>
        <th scope="col">Volum</th> 
		<th scope="col">Titular	</th>
		<th scope="col">Dată</th>
       
      </tr>
    </thead>
    <tbody>
      <?php
            
            include 'db.php';
            session_start();

             //Intervalul de ani în ca se poate face statistica
            //De la 1970  
            if ($_GET['from_year'] === '---')
                $from_year = '1970';
            else
                $from_year = $_GET['from_year'];

            
            //Până la anul 99999 
            if ($_GET['to_year'] === '---')
                $to_year = '9999';
            else
                $to_year = $_GET['to_year'];
        
            $query = "SELECT title, volume, first_name, last_name,
                      uploaded_at 
                      FROM papers 
                      INNER JOIN users ON papers.user_id = users .user_id
                      WHERE users.user_id = ? 
                      && type = 'articol' 
                      && YEAR(uploaded_at) >= ? 
                      && YEAR(uploaded_at) <= ?
                    ";

            if ($stmt = $con->prepare($query)) {
                $stmt->bind_param("iss", $_SESSION['user_id'], $from_year, $to_year);
                $stmt->execute();
                $stmt->bind_result($title, $volume, $f_name, $l_name, $uploaded_at);
                $i = 0;
                while ($stmt->fetch()) {
                    $i++;
                    $full_name = $f_name . ' ' . $l_name;
                    echo "<tr>
                            <th scope='row'>$i</th>
                            <td>$title</td>
                            <td>$volume</td>
                            <td>$full_name</td>
                            <td>$uploaded_at</td>
                          </tr>";
                }
                $stmt->close();
            }
      ?>
    </tbody>
  </table>
    
</div>


 </div>


	
	
	
	
	
	
	
 



<!---------------------------------------->


 


 
 <div id="dep2_muta">
 <span id="dep">Carți publicate </span>
 
<div class="table-wrapper-scroll-y my-custom-scrollbar">

  <table class="table table-bordered table-striped mb-0">
   
    <thead class="thead-dark">
      <tr>
        <th scope="col">Numar</th>
        <th scope="col">Titlu</th>
        <th scope="col">Volum</th>
        <th scope="col">Autor</th> 
		<th scope="col">Dată</th>
       
      </tr>
    </thead>
    <tbody>
      <?php
            //if there is no from_year selected we retrieve rows 
            //from the smallest posible year 
            if ($_GET['from_year'] === '---')
                $from_year = '1970';
            else
                $from_year = $_GET['from_year'];

            //if there is no to_year selected we retrieve rows 
            //to the biggest posible year 
            if ($_GET['to_year'] === '---')
                $to_year = '9999';
            else
                $to_year = $_GET['to_year'];
        
            $query = "SELECT title, volume, first_name, last_name,
                      uploaded_at 
                      FROM papers 
                      INNER JOIN users ON papers.user_id = users .user_id
                      WHERE users.user_id = ? 
                      && type = 'carte' 
                      && YEAR(uploaded_at) >= ? 
                      && YEAR(uploaded_at) <= ?
                    ";

            if ($stmt = $con->prepare($query)) {
                $stmt->bind_param("iss", $_SESSION['user_id'], $from_year, $to_year);
                $stmt->execute();
                $stmt->bind_result($title, $volume, $f_name, $l_name, $uploaded_at);
                $i = 0;
                while ($stmt->fetch()) {
                    $i++;
                    $full_name = $f_name . ' ' . $l_name;
                    echo "<tr>
                            <th scope='row'>$i</th>
                            <td>$title</td>
                            <td>$volume</td>
                            <td>$full_name</td>
                            <td>$uploaded_at</td>
                          </tr>";
                }
                $stmt->close();
            }
            $con->close();
      ?>
    </tbody>
  </table>
    
</div>


 </div>
 
	 
     
 </div> <!---div  care inchide color background--->
 
<div id="poza"><img src="raport.jpg" alt="Licenta"><div/>
<div id="poza2"><img src="raport2.jpg" alt="Licenta"><div/>
  
 
 

  
</form>



</body>
</html>
