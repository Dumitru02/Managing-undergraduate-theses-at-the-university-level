<!DOCTYPE html>
<html>
<title>Licentă</title>
    <head>
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
		   
   
			
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="Admin.css">
			
			
			
    </head>

    <body >
	   
			<div class="navbar" >
				
                <a href="#" id='sign-out'><i class="fa fa-fw fa-sign-out"></i>Ieși din cont</a> 
			</div><br><br><br><br><br>
	
    <h1 id="titlu">Admin </h1>
    
	
	
    
	
	<div id="treg"><h1>Creează noi conturi</h1><br></div>
	
	
		
		<!--Crează noi conturi Admin-->
	    
	<form id='register_form' method='post'>
	
	
	
	  <div id="reg">
	  <div id="bor">
	 <div id="color">
	
				  <div class="form-group">
				  
				    <label for="exampleInputEmail1"> Nume </label>
					<input name='last_name' class="form-control form-control-lg" type="text" placeholder="Nume">
					<label for="exampleInputEmail1"> Prenume </label>
					<input name='first_name' class="form-control form-control-lg" type="text" placeholder="Prenume">
				  
				  </div>
				  
				  
				  <div class="form-group">
							<label for="exampleInputEmail1"> Email </label>
							<input name='email' class="form-control form-control-lg" type="text"   placeholder="Ex:  dumitrucristache11@yahoo.com">
							
				  </div>
				  
				  
				   <div class="form-group">
							<label for="exampleFormControlSelect1">Selectati departamentul</label>
						 <select name='department' class="form-control" id="exampleFormControlSelect1">
							  <option value='1'>Dep 1</option>
							  <option value='2'>Dep 2</option>
							
							
							</select>
					</div>
				  
				  <div class="form-group">
					<label for="exampleInputPassword1">Parolă</label>
					<input type="password" name='password' class="form-control form-control-lg" id="Pw3" placeholder="Parolă">
			   </div>
			  
				<div class="form-group">
					<label for="exampleInputPassword1">Reintroduce-ți parola</label>
					<input type="password" name='password_check' class="form-control form-control-lg" id="pw4" placeholder="">
				</div>
				
		       
				<center><button type="submit" class="btn btn-primary btn-lg">Înregistrează</button></center>
	
	
	</form>
	</div>
	</div>
	</div>
	
	<!-- Baza de date pentru  asocierea de drepturi de departament-->	
	
	<div id="color1">
 	
	
	<div class="table-wrapper-scroll-y my-custom-scrollbar">


  <table class="table table-bordered table-striped mb-0">
   
    <thead class="thead-dark">
      <tr>
	    
        
        <th scope="col">Nume</th>
        <th scope="col">Prenume</th>
        <th scope="col">Departament</th>
        <th scope="col">Rol</th> 
		<th scope="col">Aplică</th>
		<th scope="col">Retrage</th>
        
      </tr>
    </thead>
    <tbody>
        <?php
            
            include 'db.php';
            $query = "SELECT user_id, first_name, last_name, department, role
                      FROM users 
                      WHERE department IS NOT NULL
                    ";

            if ($stmt = $con->prepare($query)) {
                $stmt->execute();
                $stmt->bind_result($user_id, $first_name, $last_name, $department, $role);
                $i = 0;
                while ($stmt->fetch()) {
                    $i++;
                    echo "<tr id='$user_id'>
                            <td>$last_name</td>
                            <td>$first_name</td>
                            <td>$department</td>
                            <td>$role</td>
                            <td><button type='button' class='add btn btn-primary btn-lg'>Aplică</button></td>
                            <td><button type='button' class='delete btn btn-danger btn-lg'>Retrage</button></td>
                          </tr>";
                }
                $stmt->close();
            }
        ?>
    </tbody>
  </table>
  </div>
  

</div>

	<h2>Oferă rolul de director pe departament</h2>

	
	</div>	
		
	</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>	
        if (document.cookie.split(';').filter((item) => item.includes('roledeleted=1')).length) {
            Swal.fire({
                'title': 'OK',
                'type': 'success',
                'html': '<p>Utilizatorul este acum profesor!</p>' 
            });
            document.cookie="roledeleted=0";
        }
        if (document.cookie.split(';').filter((item) => item.includes('registered=1')).length) {
            Swal.fire({
                'title': 'OK',
                'type': 'success',
                'html': '<p>Utilizatorul a fost inregistrat!</p>' 
            });
            document.cookie="registered=0";
        }
        if (document.cookie.split(';').filter((item) => item.includes('roleadded=1')).length) {
            Swal.fire({
                'title': 'OK',
                'type': 'success',
                'html': '<p>Utilizatorul este acum director!</p>' 
            });
            document.cookie="roleadded=0";
        }
        $("#sign-out").on("click",function(event){
                event.preventDefault();
                $.ajax({
                    url : "sign-out.php",
                    method : "POST",
                    success : function(data){
                        if (data == "success") {
                            window.location.href = 'index.php';
                        }else{
                            Swal.fire({
                                    'title': 'Eroare',
                                    'text': data,
                                    'type': 'error'
                                    });
					    }
                    }
                        
                });
        });

        $("tr").on("click", "button.delete", function(event){
            let user_id = $(this).closest('tr').attr('id');
                $.ajax({
                    url : "delete_role.php",
                    method : "POST",
                    data: { 'user_id': user_id },
                    success : function(data){
                        if (data == "success") {
                            document.cookie = 'roledeleted=1';
                            window.location.href = 'Admin.php';
                        }else{
                            Swal.fire({
                                    'title': 'Eroare',
                                    'text': data,
                                    'type': 'error'
                                    });
					    }
                    }
                        
                });
    
       });

        $("tr").on("click", "button.add", function(event){
            console.log('button pressed');
            let user_id = $(this).closest('tr').attr('id');
                $.ajax({
                    url : "add_role.php",
                    method : "POST",
                    data: { 'user_id': user_id },
                    success : function(data){
                        if (data == "success") {
                            document.cookie = 'roleadded=1';
                            location = 'Admin.php';
                        }else{
                            Swal.fire({
                                    'title': 'Eroare',
                                    'text': data,
                                    'type': 'error'
                                    });
					    }
                    }
                        
                });
    
       });

        $("#register_form").on("submit",function(event){
                event.preventDefault();
                $.ajax({
                    url : "register.php",
                    method : "POST",
                    data : $("#register_form").serialize(),
                    success : function(data){
                        if (data == "register_success") {
                            document.cookie = 'registered=1';
                            location = 'Admin.php';
                        }else{
                            Swal.fire({
                                    'title': 'Eroare',
                                    'text': data,
                                    'type': 'error'
                                    });
					    }
                    }
                        
                });
        });



</script>
	</html>

