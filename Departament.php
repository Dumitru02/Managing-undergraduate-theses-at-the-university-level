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
		  
		 
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		  <!--icons bara de meniu -->
		  <link rel="stylesheet" href="Lucrari.css">
		  
		  
		  
		  
		  
       <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
  
</head> 
<body>

    <div id="color">
 

	   
			<div class="navbar" >
				<a class="active" href="home.php"><i class="fa fa-fw fa-home"></i> Acasă</a> 
                <a href="#" id='sign-out'><i class="fa fa-fw fa-sign-out"></i>Iesi din cont</a> 
			</div><br><br>

			 <!--- distanta titlu si departament 1  -->
             
             <span  <?php session_start(); echo $_SESSION["department"]; ?></span><br><br><br>
			
			
  
<div id="cauta"><input id='search_term' class="form-control" type="text" placeholder="Căutare dupa titlu" aria-label="Search">

<button type='button' class="btn btn-primary btn-lg" id='search_bttn' style="positon:ablosute;margin-top:-58px;margin-left:250px;">Cauta</button></div>

					
				 
				 


<div class="table-wrapper-scroll-y my-custom-scrollbar">
  <table id='tabledata' class="table table-bordered table-striped mb-0">
   
    <thead class="thead-dark">
      <tr>
	    
        <th scope="col">Șterge</th>
        <th scope="col">Publicație </th>
        <th scope="col">Volum</th>
        <th scope="col">Data publicări</th>
        <th scope="col">Titlu</th>
        <th scope="col">Autori</th>
        <th scope="col">Editură</th>
        <th scope="col">ISSN/ISBN</th>
        <th scope="col">Site</th>
        <th scope="col">Țară</th>
        <th scope="col">Tip</th>
	
		
      </tr>
    </thead>
    <tbody>
      <?php
        include "db.php";

        if (isset($_GET['search_term'])) {
            $term = '%' . $_GET['search_term'] . '%';
            $query = "SELECT id, publication, volume, uploaded_at, title,
                      authors, publisher, pages, website, country, type 
                      FROM papers 
                      INNER JOIN users ON papers.user_id = users .user_id
                      WHERE users.user_id = ? && title LIKE ?";
        }
        else
            $query = "SELECT id, publication, volume, uploaded_at, title,
                      authors, publisher, pages, website, country, type 
                      FROM papers 
                      INNER JOIN users ON papers.user_id = users .user_id
                      WHERE users.user_id = ?";

        if ($stmt = $con->prepare($query)) {
            if (isset($_GET['search_term'])) 
                $stmt->bind_param("is", $_SESSION['user_id'], $term);
            else
                $stmt->bind_param("i", $_SESSION['user_id']);
            $stmt->execute();
            $stmt->bind_result($paper_id, $publication, $volume, $uploaded_at, $title,
              $authors, $publisher, $pages, $website, $country, $type);
            while ($stmt->fetch()) {
            
                //inside database date format is 'year-month-day'
                //we want to display 'day/month/year' format
                $uploaded_at = date("d/m/Y", strtotime($uploaded_at));
                echo "
                      <tr id='$paper_id'>
                        <td class='delete'> 
                          <button name='delete' class='btn btn-danger btn-sm rounded-0' type='button' 
                          data-toggle='tooltip' data-placement='top' title='Delete'>
                            <i class='fa fa-trash'></i>
                          </button>
                        </td> 
                        <td class='publication'>
                          <p>$publication</p>
                        </td>
                        <td class='volume'>
                          <p>$volume</p>
                        </td>
                        <td class='uploaded_at'>

                            <input id='datepicker$paper_id' data-provide='datepicker' data-date-format='dd/mm/yyyy'>
                            <i class='fa fa-calendar'></i>

                            <script>
                            $('#datepicker$paper_id').datepicker('update', '$uploaded_at');
                            </script>

                        </td>
                        <td class='title'>
                          <p>$title</p>
                        </td>
                        <td class='authors'>
                          <p>$authors</p>
                        </td>
                        <td class='publisher'>
                          <p>$publisher<p>
                        </td>
                        <td class='pages'>
                          <p>$pages</p>
                        </td>
                        <td class='website'>
                          <a href='$website'>
                            <span class='glyphicon glyphicon-share'></span> 
                          </a>
                        </td>
                        <td class='country'>
                          <p>$country</p>
                        </td>
                        <td class='type'>
							<select class='select'>";
                                if ($type === 'articol')
                                    echo "<option selected>articol</option>
                                          <option>carte</option></select></td></tr>";
                                else
                                    echo "<option>articol</option>
                                          <option selected>carte</option></select></td></tr>";
			}
            $stmt->close();
        }
      ?>


    </tbody>
  </table>
  
</div>
		
		
		<div class="container">
				  <div class="vertical-center">
					<div ><a href="adauga.php?pagina=departament"> <button type="button" class="btn btn-primary btn-lg" style="positon:ablosute;margin-top:70%;margin-left:50px;"> 
				Adaugă</button></div></a>
				  </div>
				  
				  
				   
					 <button  id='bttn_stats' class="btn btn-primary btn-lg"> 
				Statistică</button>
				 
              
		</div>

	

                       <div class="container text-center">
 
								
								 <input id='from_year_input' class="date-own form-control" style="width: 150px;postion:absolute; margin-top:-4%;margin-left:10%;" type="text" placeholder=" Din">


							  <script type="text/javascript">

								  $('.date-own').datepicker({

									 minViewMode: 2,

									 format: 'yyyy'

								   });

							  </script>


						</div>
					 
					 
					 
					 
					 <div class="container text-center">
								 
							
								 <input id='to_year_input' class="date-own form-control" style="width: 150px;postion:absolute; margin-top:-4%;margin-left:28%;" type="text" placeholder=" Până">


							  <script type="text/javascript">

								  $('.date-own').datepicker({

									 minViewMode: 2,

									 format: 'yyyy'

								   });

							  </script>


						</div>
				 
				 
				 
				  <br><br><br><br>
					<div id="cat">
					<span id="de-la">Categori </span>
					 <div class="form-group">
						
						<select class="form-control" id="chooser">
						  <option>---</option>
						  <option value='articol'>Listă articole</option>
						  <option value='carte'>Listă cărti </option>
						  <option value='toate'>Toate categorile </option>
						 
						  
							
						</select>
					  </div>
					 </div> 
				 
				 
    
 </div> <!-- div  care inchide color background -->
 

  <!--Adauga lucrari-->
 
<form id="sendpaper_form" method="post"><br>

						  
  
</form>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
      <script>
        if (document.cookie.split(';').filter((item) => item.includes('papersent=1')).length) {
            Swal.fire({
                'title': 'OK',
                'type': 'success',
                'html': '<p>Lucrarea a fost adaugata cu succes!</p>' 
            });
            document.cookie="papersent=0";
        }

        if (document.cookie.split(';').filter((item) => item.includes('paperedit=1')).length) {
            Swal.fire({
                'title': 'OK',
                'type': 'success',
                'html': '<p>Lucrarea a fost actualizata cu succes!</p>' 
            });
            document.cookie="paperedit=0";
        }

        if (document.cookie.split(';').filter((item) => item.includes('paperdeleted=1')).length) {
            Swal.fire({
                'title': 'OK',
                'type': 'success',
                'html': '<p>Lucrarea a fost stearsa cu succes!</p>' 
            });
            document.cookie="paperdeleted=0";
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
        
        $("#sendpaper_form").on("submit",function(event){
                event.preventDefault();
                $.ajax({
                    url : "sendpaper.php",
                    method : "POST",
                    data: $("#sendpaper_form").serialize(),
                    success : function(data){
                                if (data == "success") {
                                    location = 'Departament.php';
                                    document.cookie="papersent=1";
                                }
                                else{
                                    Swal.fire({
                                            'title': 'Eroare',
                                            'text': 'Toate campurile trebuiesc completate!',
                                            'type': 'error'
                                            });
                                }
                            }
                        
                });
        });

        function revert() {
            $("#tabledata .editfield").each(function () {
                var $td = $(this).closest('td');
                $td.empty();
                $td.append('<p>' + $td.data('oldText') + '</p>');

                $td.data('editing', false);

                // canceled            
                console.log('Edit canceled.');
            });
        }

        function save($input) {
            let val = $input.val().trim(),
            row_id = $input.closest('tr').attr('id'),
            column = $input.attr('id');         
            var $td = $input.closest('td');
            $td.empty();
            $td.append('<p>' + val + '</p>');
            $td.data('editing', false);

            // send json or whatever
            console.log('Value changed');
            console.log("X" + val + "X");

            $.ajax({
                url : "editpaper.php",
                method : "POST",
                data: { 'row_id' : row_id, 'column': column, 'value' : val },
                success : function(data){
                            if (data == "success") {
                                location = 'Departament.php';
                                document.cookie="paperedit=1";
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
            
        }
		
		$('.table-wrapper-scroll-y.my-custom-scrollbar').on('change', '.select', function () {
			
			let row_id = $(this).closest('tr').attr('id');
			let val = $(this).find('option:selected').text();
			let column = 'type';
			
			$.ajax({
                url : "editpaper.php",
                method : "POST",
                data: { 'row_id' : row_id, 'column': column, 'value' : val },
                success : function(data){
                            if (data == "success") {
                                location = 'Departament.php';
                                document.cookie="paperedit=1";
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
			


        $('.table-wrapper-scroll-y.my-custom-scrollbar').on('keyup', '.editfield', function (e) {
            console.log($(this).closest('tr').attr('id'));
            console.log($(this).attr('id'));
            console.log("here");
			
            if (e.which == 13) {
                // save
                $input = $(e.target);
                save($input);
            } else if (e.which == 27) {
                // revert
                revert();
            }
        });

        $(".table-wrapper-scroll-y.my-custom-scrollbar").on('click', '#tabledata td p', function (e) {
			console.log("p pressed!");

            // consuem event
            e.preventDefault();
            e.stopImmediatePropagation();

            $p = $(this);
            $td = $p.parent();

            //the id is the table column name
            let id = $td.attr('class');
        
            //volume, title and authors column content will be 
            //maximized on hover

            // if already editing, do nothing.
            if ($td.data('editing')) return;
            // mark as editing
            $td.data('editing', true);

            // get old text
            var txt = $p.text();

            // store old text
            $td.data('oldText', txt);
			
            var $input = $('<input type="text" class="editfield" id="' + id + '">');
            $input.val(txt.trim());
            $td.empty();
            $td.append($input);
            
        });

        
        
        $("#search_bttn").click(function() {
            location = 'Departament.php' + '?search_term=' + $("#search_term").val();           
        });
 

        $(".table-wrapper-scroll-y.my-custom-scrollbar").on('click', "button[name='delete']", function (e) {
            console.log("delete button pressed");
            //get the id of row which to be deleted
            let id = ($(this).closest('tr').attr('id'));

            $.ajax({
                url : "deletepaper.php",
                method : "POST",
                data: { 'row_id' : id },
                success : function(data){
                    if (data == "success") {
                        document.cookie = 'paperdeleted=1';
                        location = 'Departament.php';
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

        $(".table-wrapper-scroll-y.my-custom-scrollbar").on('change', 'td.uploaded_at input', function() {
            console.log("datepicker changed");
			let row_id = $(this).closest('tr').attr('id');
			let val = $(this).val().trim();

			$.ajax({
                url : "editpaper.php",
                method : "POST",
                data: { 'row_id' : row_id, 'column': 'uploaded_at', 'value' : val },
                success : function(data){
                            if (data == "success") {
                                location = 'Departament.php';
                                document.cookie="paperedit=1";
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

        $(".table-wrapper-scroll-y.my-custom-scrollbar").on('click', 'td.website a', function() {
            location = this.href;
        });

        $("#bttn_stats").on('click', function() {
            console.log('change occured');
            let from_year = $("#from_year_input").val();
            let to_year = $("#to_year_input").val();
        
            //Eroare daca nu sa selectat cel putin un an 
            if (to_year === '' && from_year === '')
              Swal.fire({
                'title': 'Atentie',
                'text': 'Trebuie selectat cel putin un an!',
                'type': 'error'
              });
            else {
                let type = $("#chooser").val(); 
                
                //statistica doar pe un tip (articol sau carte) 
                if (type === 'articol' || type === 'carte')
                    location = 'prof_raport_documente.php?' + 'from_year=' + from_year + '&to_year=' + to_year + '&type=' + type;
                
                //statistica pe toate categorile
                else
                    location = 'prof_raport_toate.php?' + 'from_year=' + from_year + '&to_year=' + to_year;
            }

        });

        
        
            
     </script>
<script src="buton.js"></script>
