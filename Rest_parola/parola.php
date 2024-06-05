<!DOCTYPE html>
<html>
<title>Resetare parolă</title>
    <head>
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
		   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
   
			<link rel="stylesheet" href="parola.css">
				
			
	</head>
<body>

		
	<form id='sendmail_form' method="post">
		
	
	    <h2>Resetarea parolei</h2>
		
		<!-- img-lacat--->
		<h1><i class="fa fa-lock fa-4x"></i></h1>
		
			<div class="form-group">
				<label for="exampleInputEmail1"> Email </label>
				<input name="email" class="form-control form-control-lg" type="text" placeholder="Ex:marianpopescu23@yahoo.com">
			    <button type="submit" class="btn btn-primary btn-lg">Trimite</button>
		
			</div>
			
	</form>
		
	
</body>	

    <footer>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
      <script>
        $("#sendmail_form").on("submit",function(event){
                event.preventDefault();
                $.ajax({
                    url : "sendmail.php",
                    method : "POST",
                    data : $("#sendmail_form").serialize(),
                    success : function(data){
                        if (data === "mail_sent") {
                            Swal.fire({
                                    'title': 'Resetare',
                                    'text': 'Mail-ul de resetare a parolei a fost trimis',
                                    'type': 'success'
                                    });
						} else {
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
