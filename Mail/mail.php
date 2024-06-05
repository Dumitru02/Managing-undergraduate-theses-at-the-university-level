<!DOCTYPE html>
<html>
<title>Sistem Expert-Autentificare</title>
    <head>
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
		   
   
			<link rel="stylesheet" href="mail.css">
			  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

			
			
			
    </head>

    <body>
	
  
    
		
	<div class="blog">
		
		<form id='reset_form' method='post'>
		 
		<h1 class="titlu">Resetează parola</h1><br>	
		
			 
			  <div class="form-group">
				<label for="exampleInputPassword1"> Alege o parolă sigură</label>
				<input name='password' type="password" class="form-control form-control-lg" id="P1" >
			  </div>
			  
			  <div class="form-group">
				<label for="exampleInputPassword1">Confrimă parola</label>
				<input name='password_check' type="password" class="form-control form-control-lg" id="P2" >
			  </div>
			  
              <button type="submit" class="btn btn-primary">Reseteaza</button>
			  
		</form>
		
	</div>
		
		
		
		
		
	</body>

    <footer>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
      <script>
        $("#reset_form").on("submit",function(event){
                event.preventDefault();
                $.ajax({
                    url : "reset.php",
                    method : "POST",
                    data : $("#reset_form").serialize() + "&code=" +"<?php echo $_GET['code']; ?>", 
                    success : function(data){
                        if (data == "reset_success") {
                            Swal.fire({
                                    'title': 'Resetare',
                                    'type': 'success',
                                    'html': 
                                          '<p>Parola a fost resetata cu succes!</p>' +
                                           "<a href='/Licenta/index.php'>Inapoi la autentificare</a>"
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
      </script>
    </footer>

	
	</html>
