<!DOCTYPE html>
	
<html lang="en">
<head>
  <title>Licentă</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
  
  
  
  <!--new-->
	
  <link rel="stylesheet" href="meniu.css">
  <link rel="stylesheet" href="body.css"> 
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
	
	

</head>
	
<body>
 
	<ul >
	 
 

	  <li>

          <?php
            session_start();
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] === 'admin')
                    echo "<a href='Admin.php'> <i class='fa fa-book' aria-hidden='true'></i>Panou admin</a>";
                if ($_SESSION['role'] === 'director')
                    echo "<a href='director.php'> <i class='fa fa-book' aria-hidden='true'></i>Panou director</a>";
                if ($_SESSION['role'] === 'prof')
                    echo "<a href='Departament.php'> <i class='fa fa-book' aria-hidden='true'></i>Panou departament</a>";
            }
          ?>
      </li>

    <?php
        if (isset($_SESSION['role'])) 
            if ($_SESSION['role'] === 'director' || $_SESSION['role'] === 'prof')
	            echo "<li><a href='Contact/contact.php'> <i class='fa fa-envelope' aria-hidden='true'></i>" .
	  "Contact</a></li>";
    ?>

	  
	</ul>

	<div class="p-3 mb-2 bg-info text-white">
				  <!-- culoare de background--> 
					    
							<h1 class="ml1">
							<center class="text"> Sistem informatic pentru gestiunea la nivel individual și la nivel de departament al universității a lucrărilor științifice publicate</center></h1><br>	


					   
					   <img src="Imagini/a.png" alt="Bec" >
					   <a href="https://www.youtube.com/watch?v=M4yMYF80CFI">
				<div class="video">
							<video  width="700" height="495" autoplay loop muted>
								<source src="clip.mp4" type="video/mp4"></video> 
						</a>
							
				</div>
			
					<div><br><p class="ak">Cercetătorul este omul practic, aventurierul, iscoditorul, cel care crede în cercetare, cel care pune întrebări, 
							 cel care refuză să creadă că a fost atinsă perfecţiunea (Henry R. Harrover). Sistem expert oferă utilizatorilor de a își publica lucrările științifice dar si de a obtine o analiză grafică a lucrilor deja publicate</p><br>
							
							
					</div><br>	
							
					  
				

    </div>
              	
	
			  
     
		
		

</body>

</html>
