<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">




<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <link rel="stylesheet" href="adauga.css">
 
 
 
 
 
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<!--
<script type="text/javascript" src= "https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>

</head>


 
<body>

 

<form id="sendpaper_form" method="post"><br>
  <div class="container">
    <center><h1>Adaugați articol sau carte </h1></center>
  
        <hr>
						<label for="exampleFormControlSelect1">Alegeți tipul</label>
					<select name='type' class="form-control" id="">
						  <option value='articol'>Articol</option>
						  <option value='carte'>Carte</option>
						 
					</select>

				<label for="exampleFormControlInput1">Titlu</label>
				<input name="title" class="form-control" type="text" placeholder="">
				
				<label for="exampleFormControlInput1">Autori</label>
				<input name="authors" class="form-control" type="text" placeholder="">
		  
				  <label for="exampleFormControlInput1">Publicație</label>
				 <input name="publication" class="form-control" type="text" placeholder=" ">
		  
				  <label for="exampleFormControlInput1">Volum</label>
				 <input name="volume" class="form-control" type="text" placeholder="">
				 
				 <label for="exampleFormControlInput1">Editura</label>
				 <input name="publisher" class="form-control" type="text" placeholder="">
				 
				
				
				  <label for="exampleFormControlInput1">Data publicări</label>
				 <div id="cont">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                    <input name='uploaded_at' type="text" 
                      class="form-control datetimepicker-input" data-target="#datetimepicker4"/>
                    <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
				 
				
				 
				 <label for="exampleFormControlInput1">ISSN/ISBN</label>
				 <input name="pages" class="form-control" type="text" placeholder="">
				  
				 <label for="exampleFormControlInput1">Site</label>
				 <input name="website" class="form-control" type="text" placeholder=" Ex:https://www.google.com/">
				 
				  
				 <label for="exampleFormControlInput1">Țară</label>
				 <input name="country" class="form-control" type="text" placeholder="">
		  
		  
		  <button type="submit" class="registerbtn">Încarcă</button>
        
        <hr>
  </div>
  
  
</form>

</body>

<script type="text/javascript">
                $('#datetimepicker4').datepicker({
                    format: 'dd/mm/yyyy'
                });
        </script>
  
  
  
  
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script>
        $("#sendpaper_form").on("submit",function(event){
                event.preventDefault();
                console.log($("#sendpaper_form").serialize());
                $.ajax({
                    url : "sendpaper.php",
                    method : "POST",
                    data: $("#sendpaper_form").serialize(),
                    success : function(data){
                                if (data == "success") {
                                    document.cookie="papersent=1" ;
                                    location = 
                                    '<?php echo ($_GET['pagina'] === 'director') ? 'director.php' : 'Departament.php'; ?>';
                                }
                                else{
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

