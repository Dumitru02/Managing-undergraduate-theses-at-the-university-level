<!DOCTYPE html>
<html lang="en">
<head>
		  <title>Director-Raport</title>
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
  
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
		  
		  <!-------------------- --------------------------------->
		  
		  <link rel="stylesheet" href="director_raport_tot.css">
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   
   

 
	

</head>
 

   
<body>

		
			

			 <!--- distanta titlu si departament 1  --->
          
  <div id="dep1_muta">
 <div id="departament3"><span id="dep">Articole publicate </span></div>
 
<div class="table-wrapper-scroll-y my-custom-scrollbar">

  <table class="table table-bordered table-striped mb-0">
   
    <thead class="thead-dark">
      <tr>
       
	   <th scope="col">Numar</th>
	    <th scope="col">Autor</th>
        <th scope="col">Titlu</th>
        <th scope="col">Volum</th>
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

        
            $query = "SELECT title, volume, 
                      uploaded_at,authors 
                      FROM papers 
                      INNER JOIN users ON papers.user_id = users .user_id
                      && type = 'articol' 
                      && YEAR(uploaded_at) >= ? 
                      && YEAR(uploaded_at) <= ?
                      && users.department = ?
                    ";

            if ($stmt = $con->prepare($query)) {
                $stmt->bind_param("sss", $from_year, $to_year, $_SESSION['department']);
                $stmt->execute();
                $stmt->bind_result($title, $volume, $uploaded_at,$authors);
                $i = 0;
                while ($stmt->fetch()) {
                    $i++;
                    echo "<tr>
                            <th scope='row'>$i</th>
                            <td>$authors</td>
                            <td>$title</td>
                            <td>$volume</td>
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


	<span id="proff">Profesorii </span>
 

	<div id="tot">
	
	<div class="table-wrapper-scroll-y my-custom-scrollbar">

  <table class="table table-bordered table-striped mb-0">
   
    <thead class="thead-dark">
      <tr>
        <th scope="col">Numar</th>
       
        <th scope="col">Nume</th>
        <th scope="col">Prenume</th>
        <th scope="col">Dată</th>
       
      </tr>
    </thead>
    <tbody>
      <?php
            
            include 'db.php';

            //if there is no from_year selected we retrieve rows 
            //from the smallest posible year 
            if ($_GET['from_year'] === '---')
                $from_year = '1900';
            else
                $from_year = $_GET['from_year'];

            //if there is no to_year selected we retrieve rows 
            //to the biggest posible year 
            if ($_GET['to_year'] === '---')
                $to_year = '9999';
            else
                $to_year = $_GET['to_year'];
        
            $query = "SELECT first_name, last_name, registered_at 
                      FROM users 
                      WHERE YEAR(registered_at) >= ? 
                      && YEAR(registered_at) <= ?
                      && users.department = ?
                    ";

            if ($stmt = $con->prepare($query)) {
                $stmt->bind_param("sss", $from_year, $to_year, $_SESSION['department']);
                $stmt->execute();
                $stmt->bind_result($first_name, $last_name, $registered_at);
                $i = 0;
                while ($stmt->fetch()) {
                    $i++;
                    echo "<tr>
                            <th scope='row'>$i</th>
                            <td>$last_name</td>
                            <td>$first_name</td>
                            <td>$registered_at</td>
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
 <span id="dep">Carti publicate </span>
 
<div class="table-wrapper-scroll-y my-custom-scrollbar">

  <table class="table table-bordered table-striped mb-0">
   
    <thead class="thead-dark">
      <tr>
        <th scope="col">Numar</th>
        <th scope="col">Autor</th>
        <th scope="col">Titlu</th>
        <th scope="col">Volum</th>
        <th scope="col">Dată</th>
       
      </tr>
    </thead>
    <tbody>
      <?php
            
            include 'db.php';

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

        
            $query = "SELECT title, volume, 
                      uploaded_at,authors 
                      FROM papers 
                      INNER JOIN users ON papers.user_id = users .user_id
                      && type = 'carte' 
                      && YEAR(uploaded_at) >= ? 
                      && YEAR(uploaded_at) <= ?
                      && users.department = ?
                    ";

            if ($stmt = $con->prepare($query)) {
                $stmt->bind_param("sss", $from_year, $to_year, $_SESSION['department']);
                $stmt->execute();
                $stmt->bind_result($title, $volume, $uploaded_at,$authors);
                $i = 0;
                while ($stmt->fetch()) {
                    $i++;
                    echo "<tr>
                            <th scope='row'>$i</th>
                            <td>$authors</td>
                            <td>$title</td>
                            <td>$volume</td>
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
 
<div id="poza"><img src="director1.jpg" alt=""><div/>

 
 

  
</form>



</body>
</html>
 
