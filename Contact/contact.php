<!DOCTYPE html>
<html>
<title>Contact</title>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<link rel="stylesheet" href="contact.css">

</head>
<body>


<div class="bor">
<div class="container">

  <form id='send_msgmail' method='post'>
			  <center><h1>CONTACT</h1></center>
				<div class="fo">
					<div class="mx-auto" style="width: 300px;margin: 6px 0;">
					<label for="Nume">Nume:</label>
					<input name='last_name' class="form-control" type="text" placeholder="Nume">
					
			   <label for="lname">Prenume:</label>
			   <input name='first_name' class="form-control" type="text" placeholder="Prenume">
			   
			   <label for="lname">Telefon:</label>
			   <input name='phone' class="form-control" type="text" placeholder="072454624">

			   
			  <div class="form-group">
					<label for="exampleFormControlTextarea1">Subiect:</label>
					<textarea name='content' class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
			  </div>
			  
			  </div>
				
					<button class="btn btn-primary" type="submit">Trimite</button>
				
			 </div>
  </form>
</div>
</div>
</body>

<footer>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
      <script>
        $("#send_msgmail").on("submit",function(event){
                event.preventDefault();
                console.log('pressed');
                $.ajax({
                    url : "send_msg_mail.php",
                    method : "POST",
                    data : $("#send_msgmail").serialize(),
                    success : function(data){
                        if (data == "mail_sent") {
                            Swal.fire({
                                    'title': 'OK',
                                    'text': 'Mesajul a fost trimis!',
                                    'type': 'success'
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
