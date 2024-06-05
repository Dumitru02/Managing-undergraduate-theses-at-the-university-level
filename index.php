<?php
  session_start();
  
  //if user is signed in move to page
  if (isset($_SESSION['user_id'])) {
    //header('Location: index_utilizator.php');
    //die();
  }
?>
 
<!DOCTYPE html>
<html>
<title>Licentă-Autentificare</title>
    <head>
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
		   
   
			<link rel="stylesheet" href="login.css">
			  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

			
		<script>
		$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});
			</script>
			
			
			
    </head>

    <body>
	
 
    
	
	<div class="treg"><h1>Înregistrează-te</h1><br></div>

    <!--Autentificare-->
	<div class="blog">
		
		<form id='login_form' method='post'>
		
		<h1 class="titlu">Autentificare</h1>	
		
			  <div class="form-group">
				<label for="email"> Email </label>
				<input class="form-control form-control-lg" name='email' id='email' type="text">
				
			  </div>
			  
			  <div class="form-group">
				<label for="password">Parolă</label>
				 <div class="input-group" id="show_hide_password">

				<input type="password" name='password' class="form-control form-control-lg" id="password">
				<a href="">
				<i class="fa fa-eye-slash" aria-hidden="true"></i></a>
				
				  
    </div>
			  </div>
			  
			  
			  
			  <div>
				<a href="Rest_parola/parola.php"><label>Ați uitat parola?</label></a>
			  </div>
              
              <input class="btn btn-primary" type="submit" Value="Autentificare">
			  
		</form>
		
	</div>
		
		
    <!--Inregistrare-->
	<form id='register_form' method="post">
	
	
	<div class="sep"></div>
	  <div class="reg">
	
          <div class="form-group">
            <label for="last_name"> Nume </label>
            <input class="form-control" name='last_name' 
              id='last_name' type="text">
          </div>

          <div class="form-group">
            <label for="first_name"> Prenume </label>
            <input class="form-control" name='first_name' 
              id='first_name' type="text">
          </div>
          
          <div class="form-group">
            <label for="email"> Email </label>
            <input class="form-control form-control-lg" name="email" 
              id='email' type="text">
          </div>

				   <div class="form-group">
    <label for="exampleFormControlSelect1">Selectati departamentul</label>
    <select name="department" class="form-control" id="exampleFormControlSelect1">
      <option value="1">Departament 1</option>
      <option value="2">Departament 2</option>
    </select>
  </div>
                    
          
          <div class="form-group">
            <label for="password">Parolă</label>
            <input type="password" name='password' 
              class="form-control form-control-lg" id="password">
          </div>
      
          <div class="form-group">
            <label for="password_check">Reintroduce-ți parola</label>
			<div class="input-group" id="show_hide_password">
            <input type="password" name="password_check" class="form-control form-control-lg" id="password_check">
          </div>
        
          <button type="submit" class="btn btn-primary">Înregistrează-te</button>


         </div>

	  </div>	
	
	</form>
	
		
		
	</body>

    <footer>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
      <script>
        $("#register_form").on("submit",function(event){
                event.preventDefault();
                $.ajax({
                    url : "register.php",
                    method : "POST",
                    data : $("#register_form").serialize(),
                    success : function(data){
                        if (data == "register_success") {
                            Swal.fire({
                                    'title': 'OK',
                                    'type': 'success',
                                    'html': '<p>Te-ai inregistrat cu succes!</p>' 
                                    });
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

        $("#login_form").on("submit",function(event){
                event.preventDefault();
                $.ajax({
                    url	:	"login.php",
                    method:	"POST",
                    data	: $("#login_form").serialize(),
                    success	: function(response) {
                                data = JSON.parse(response);
                                if(data[0] == "success"){
                                    location = "Home.php";
                                } 
                                else {
                                  Swal.fire({
                                    'title': 'Eroare',
                                    'text': data[1],
                                    'type': 'error'
                                  });
                                }
                              }
                 });
         });

      </script>
    </footer>

</html>

