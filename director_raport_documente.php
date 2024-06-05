<!-- displays all papers of type 'carte' or type 'lucrare' uploaded between years -->

<!DOCTYPE html>
<html lang="en">
<head>
		  <title>Licentă-Director</title>
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
  
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
		  
		  <!-------------------- --------------------------------->
		  
		  <link rel="stylesheet" href="prof_raport_categori.css">
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   
   

 
	

</head>
 

   
<body>

		
			

			 <!--- distanta titlu si departament 1  --->
          
  

	
	
	
	
	
	
	
 



<!---------------------------------------->


 


 
 <div id="dep2_muta">
 <div id="departament3"><span id="dep"> 
Listă <?php if ($_GET['type'] === 'articol') echo "articole"; else echo "cărți";?> </span></div><br><br>
 
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
            
            include 'db.php';
            session_start();

            //if there is no from_year selected we retrieve rows 
            //from the smallest posible year 
            if ($_GET['from_year'] === '')
                $from_year = '1970';
            else
                $from_year = $_GET['from_year'];

            //if there is no to_year selected we retrieve rows 
            //to the biggest posible year 
            if ($_GET['to_year'] === '')
                $to_year = '9999';
            else
                $to_year = $_GET['to_year'];

        
            $query = "SELECT title, volume, first_name, last_name,
                      uploaded_at 
                      FROM papers 
                      INNER JOIN users ON papers.user_id = users .user_id
                      && type = ?
                      && YEAR(uploaded_at) >= ? 
                      && YEAR(uploaded_at) <= ?
                      && users.department = ?
                    ";

            if ($stmt = $con->prepare($query)) {
                $stmt->bind_param("ssss", $_GET['type'], $from_year, $to_year, $_SESSION['department']);
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
 
	 
     
 </div> <!---div  care inchide color background--->
 

  
 
 

  
</form>



</body>
</html>

