	<!DOCTYPE html>
<html lang="en">
<head>
		  <title>Licentă Director</title>
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
  
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
		  
		  <!-------------------- --------------------------------->
		  
		  <link rel="stylesheet" href="Director.css">
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  
   
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   
   
   
   
       <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>



<!-- data need for the graph in the right -->
<?php
    
    include 'db.php';
    session_start();
    
    $query = "SELECT COUNT(*) 
              FROM papers 
              INNER JOIN users ON papers.user_id = users.user_id 
              && department = 1
            ";
    $arr = array();

    if ($stmt = $con->prepare($query)) {
        $stmt->execute();
        $stmt->bind_result($papersnr_1);
        while($stmt->fetch()) 
            $arr['papersnr_1'] = $papersnr_1;
        if ($stmt->error)
            echo $stmt->error;
        $stmt->close();
    }

    $query = "SELECT COUNT(*) 
              FROM papers 
              INNER JOIN users ON papers.user_id = users.user_id 
              && department = 2
            ";

    if ($stmt = $con->prepare($query)) {
        $stmt->execute();
        $stmt->bind_result($papersnr_2);
        while ($stmt->fetch())
            $arr['papersnr_2'] = $papersnr_2;
        $stmt->close();
    }
    
    $con->close();
?>    

   

   <script>
	var numar_docum_dep1= <?php echo $arr['papersnr_1']; ?>;
	var numar_docum_dep2= <?php echo $arr['papersnr_2']; ?>;
	
	</script>
	
    <script   type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
	  
      function drawChart() {

      var data = new google.visualization.DataTable();
            data.addColumn('string', 'Departament');
            data.addColumn('number', 'Documente');
            data.addRows([
              ['Departamentul 1', numar_docum_dep1],
              ['Departamentul 2', numar_docum_dep2],
            ]);
    
        var options = {
          titleTextStyle: {
            fontSize: 20,
          },
          title: ' Total încărcări între departamente'
        };
	        

        var chart = new google.visualization.PieChart(document.getElementById('graf'));

        chart.draw(data, options);
		
		
		
		
		
		
      }
	  
    </script type="text/javascript">
	
	
	
	
	
	
	<!-- grafic pentru lucrari-->
	
	
	<script  >
	var numarLucariDepartament1=3;
	var numarLucariDepartament2=2;
	
	
	</script>
	
	 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <div id="chart_div"></div>
      
	
	<script   type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
	  
	 
		
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Nume departament', 'numar de articole'],
          ['2010',  numarLucariDepartament1],
          ['2012',  numarLucariDepartament2] 
		 
         
        ]);

        var options = {
          titleTextStyle: {
            fontSize: 20, // 12, 18 whatever you want (don't specify px)
          },
          title: ' Analiză articole / cărți'
        };
		
	

        var chart = new google.visualization.ColumnChart(document.getElementById('graf_2'));

        chart.draw(data, options);
		
		
		
      }
	  
    </script type="text/javascript">
	
	
	
	
	
	
	
	

</head>
 

   
<body>

    
			<div class="navbar" >
			   <a class="active" href="director.php"><i class="fa fa-fw fa-home"></i> Acasă</a> 
			   <a href="#" id='sign-out'><i class="fa fa-fw fa-sign-out"></i>Ieși din cont</a> 
			 
			  
			</div>
 
 
	   
			

             <h1 >Bine ați venit !</h1>		 
			

			 <!--- distanta titlu si departament 1  --->
             <div id="dist_0"></div>
             <span  <?php echo $_SESSION['department']; ?> </span>
			
<div id="cauta"><input id='search_term' class="form-control" type="text" placeholder="Căutare dupa titlu" aria-label="Search"></div>

<button type='button' id='search_bttn' class="btn btn-primary btn-lg" style="postion:absolute;margin-left:270px;margin-top:-52px;" >Caută</button>
<div class="table-wrapper-scroll-y my-custom-scrollbar papers">


  <table id='tabledata_papers' class="table table-bordered table-striped mb-0">
   
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


<div id="analiza_dep1"><button type="button" id="chooser" class="btn btn-primary btn-lg"> <i class="fa fa-line-chart" aria-hidden="true"> 	
Statistică</button></div></i>



					
					 
					 <div class="container text-center">


								 
								
								 <input id='to_year_papers' class="date-own form-control" style="width: 200px;postion:absolute; margin-top:-9%;margin-left:30%;" type="text" placeholder=" Până">


							  <script type="text/javascript">

								  $('.date-own').datepicker({

									 minViewMode: 2,

									 format: 'yyyy'

								   });

							  </script>


						</div>
					 
					 
					 
					  
					 <div class="container text-center">


								 
								 
								 <input id='from_year_papers' class="date-own form-control" style="width: 200px;  postion:absolute; margin-top:-9%;margin-left:9%;" type="text" placeholder=" Din">


							  <script type="text/javascript">

								  $('.date-own').datepicker({

									 minViewMode: 2,

									 format: 'yyyy'

								   });

							  </script>


						</div>
					 
				 

<a href="adauga.php?pagina=director"><div id="Adauga_3"><button type="button" class="btn btn-primary btn-lg"> 
 Încarcă</button></div></a>




 
<div id="dist1"></div>





 


 
 
 
 <div id="graf"></div>


 <div id="graf_2"></div>

 <div id="raport_1"><button type="button" id="chooser_gf1" class="btn btn-primary btn-lg"> 
Raport</button> <span id='percentdiff' style="font-size: 25px; color:black;"></span></div>

   
					<div id="data_1"> <div class="container text-center"> 
								 
								 <input id='from_year_gf1' class="date-own form-control" style="width: 150px; " type="text" placeholder=" Din">


							  <script type="text/javascript">

								  $('.date-own').datepicker({

									 minViewMode: 2,

									 format: 'yyyy'

								   });

							  </script>


						</div>
						</div>
						  
					 <div id="data_2"><div class="container text-center">


								 
								 
								 <input id='to_year_gf1' class="date-own form-control" style="width: 150px; " type="text" placeholder=" Până">


							  <script type="text/javascript">

								  $('.date-own').datepicker({

									 minViewMode: 2,

									 format: 'yyyy'

								   });

							  </script>


						</div>
					 </div>
					
					 
					 
					 
					
 
 

	
					<div id="categori_2">
					 <div class="form-group">
						<span id="ani">Categori </span>
						<select id='user_type_select' class="form-control">
						  <option>---</option>
						  <option value='articol'>Listă articole</option>
						  <option value='carte'>Listă cărti</option>
						  <option value='toate'>Toate categorile</option>
						  
							
						</select>
					  </div>
					 </div> 
	
	
					<div id="graf-1">
					<span id="de-la">Categori </span>
					 <div class="form-group">
						
						<select id='raport_type_select' class="form-control">
						  <option>---</option>
						  <option value='articol'>Articole</option>
						  <option value='carte'> Carti </option>
						 
						 
						  
							
						</select>
					  </div>
					 </div> 







 
 <!------ distant 3 - tabel2 si tabel 3----------->
 <div id="dist3"></div>
 
 

 </div>
  <div id="piechart" style="width: 900px; height: 500px;"></div>
	 <div id="dist_bd"></div>
	 
	 
	 
	 
	
	 <!--distanta intre departament3 si baza de date-->
<div id="baza_date">

	<span id="cont_titlu">Profesorii</span><br><br><br>
	
	<div id="cauta_prof"><input name='search_teachers' class="form-control" type="text" placeholder="Căutare dupa nume" aria-label="Search"></div>
	
	<div id="muta_tabel"><div class="table-wrapper-scroll-y my-custom-scrollbar teachers">

  <table id='tabledata_teachers' class="table table-bordered table-striped mb-0" ">
   
    <thead class="thead-dark">
      <tr>
        <th scope="col">Șterge cont</th>
        <th scope="col">Nume</th>
        <th scope="col">Prenume</th> 
		<th scope="col">E-mail</th> 
		
		
       
      </tr>
    </thead>
    <tbody id='teachers_table_body'>
      <?php
       include "db.php";
        $query = "SELECT user_id, first_name, last_name, email 
                  FROM users
                  WHERE users.department = ?";
        if ($stmt = $con->prepare($query)) {
            $stmt->bind_param("i", $_SESSION['department']);
            $stmt->execute();
            $stmt->bind_result($user_id, $first_name, $last_name, $email);
            while ($stmt->fetch()) 
                echo "
                      <tr id='$user_id'>
                        <td class='delete'> 
                          <button name='delete' class='btn btn-danger btn-sm rounded-0' type='button' 
                          data-toggle='tooltip' data-placement='top' title='Delete'>
                            <i class='fa fa-trash'></i>
                          </button>
                        </td> 
                        <td class='first_name'>
                          $first_name
                        </td>
                        <td class='last_name'>
                          $last_name
                        </td>
                        <td class='email'>
                          $email
                        </td>
                      </tr>
                            ";
            $stmt->close();
        }
      ?>
    </tbody>
  </table>
 </div>   
</div>
<div>
 
 

 <div id="raport"><button type="butt3" id="chooser_teachers" class="btn btn-primary btn-lg"> <i class="fa fa-line-chart" aria-hidden="true"></i>
Statistică</button></div>




	  
					 <div id="data_3"><div class="container text-center">


								 
								 
								 <input id='from_year_teachers' class="date-own form-control" style="width: 150px; " type="text" placeholder=" Din">


							  <script type="text/javascript">

								  $('.date-own').datepicker({

									 minViewMode: 2,

									 format: 'yyyy'

								   });

							  </script>


						</div>
					 </div>
					 
					 <div id="data_4"><div class="container text-center">

								 
								 
								 <input id='to_year_teachers' class="date-own form-control" style="width: 150px; " type="text" placeholder="   Până">


							  <script type="text/javascript">

								  $('.date-own').datepicker({

									 minViewMode: 2,

									 format: 'yyyy'

								   });

							  </script>


						</div>
					 </div>
					

					 
					 
					 
 
					 
					
					<div id="categori_raport">
					 <div class="form-group">
						<span id="ani">Categori </span>
						<select id='teachers_type_select' class="form-control">
						  <option>---</option>
						  <option value='articol'>Listă articole</option>
						  <option value='carte'>Listă cărti</option>
						  <option value='profi'>Listă profesorii</option>
						  <option value='toate'>Toate categorile</option>
						  
							
						</select>
					  </div>
					 </div> 

     
 </div> <!---div  care inchide color background--->
 

  
 

  
</form>
</body>

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

        if (document.cookie.split(';').filter((item) => item.includes('teacherdeleted=1')).length) {
            Swal.fire({
                'title': 'OK',
                'type': 'success',
                'html': '<p>Utilizatorul a fost sters cu succes!</p>' 
            });
            document.cookie="teacherdeleted=0";
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


        function drawChart(from_year, to_year, data, type) {
          
          //make plural
          if (type === 'articol')
            type = 'Articole';
          else
            type = 'Carti';

          let is_column = false;
          let chardata = [];
          chardata.push(['An', type, { role: 'style' } ]);
          for (let i = from_year; i <= to_year; i++) {
            let temp = [];
           
            //add to graph 
            //if in the year i there was at least one paper uploaded
            if (data[i]) {
                is_column = true;
                temp.push(i);
                temp.push(data[i]);
                temp.push('color: blue');
                chardata.push(temp);
            }
          }

          //if there are no papers uploaded show something
          if (is_column === false) {
            let t = [];
            t.push(1000);
            t.push(0);
            t.push('color: gray'); 
            chardata.push(t);
          }
        
          let msg = '';
          if (type === 'carte')
             msg = 'Analiza carti incarcate intre ' + from_year + ' si ' + to_year;
          else
             msg = 'Analiza articole incarcate intre ' + from_year + ' si ' + to_year;

          var options = {
            titleTextStyle: {
              fontSize: 12, // 12, 18 whatever you want (don't specify px)
            },
            title: msg 
          };

          var chart = new google.visualization.ColumnChart(document.getElementById('graf_2'));
          chart.draw(google.visualization.arrayToDataTable(chardata), options);
        }

        $("#chooser_gf1").on('click', function() {
            console.log('change occured');
            let from_year = $("#from_year_gf1").val();
            let to_year = $("#to_year_gf1").val();
			let type = $("select#raport_type_select").val(); 
        
            //if both years are not selected there is nothing to show
            if (to_year === '' && from_year === '')
              Swal.fire({
                'title': 'Atentie',
                'text': 'Trebuie selectat cel putin un an!',
                'type': 'error'
              });
            else {
                
                
                $.ajax({
                    url : "graphdata.php",
                    method : "POST",
                    data: { 'from_year' : from_year, 'to_year': to_year, 'type': type },
                    success : function(data){
                        data = JSON.parse(data);
                        if (data["success"]) {

                            //update the graph with data from server
                            google.charts.load('current', {'packages':['corechart']});
                            google.charts.setOnLoadCallback(drawChart(from_year, to_year, data, type));


                           
                           let hundred_percent = data['cntpapers_from'] + data['cntpapers_to'];
                           let diff = 0;
                           if (data['cntpapers_from'] > data['cntpapers_to'])
                                diff = data['cntpapers_from'] - data['cntpapers_to'];
                           else
                                diff = data['cntpapers_to'] - data['cntpapers_from'];
                            
                           let diff_percentage = (Math.round(diff * 100)/hundred_percent).toFixed(2); 
                           
                         
                           
                             

                        }else{
                            Swal.fire({
                                    'title': 'Eroare',
                                    'text': data,
                                    'type': 'error'
                                    });
                        }
                    }
                        
                });

            }

        });
        
        //revert
        function revert() {
            $("#tabledatapapers .editfield").each(function () {
                var $td = $(this).closest('td');
                $td.empty();
                $td.append('<p>' + $td.data('oldText') + '</p>');

                $td.data('editing', false);

                // canceled            
                console.log('Edit canceled.');
            });
        }

        //send modified column to database
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
                                location = 'director.php';
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


        //save modified column values
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

        //make column values editable, make them input
        $(".table-wrapper-scroll-y.my-custom-scrollbar").on('click', '#tabledata_papers td p', function (e) {

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
                                location = 'director.php';
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

        //update the datepicker change
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
                                location = 'director.php';
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


        $("#search_bttn").click(function() {
            location = 'director.php' + '?search_term=' + $("#search_term").val();           
        });
        

        $("input[name='search_teachers']").change(function() {
            let value = $(this).val().trim();

            $.ajax({
                url : "searchteacher.php",
                method : "POST",
                data: { 'value' : value },
                beforeSend: function() { 
                            console.log('ajax started'); 
                            },
                success : function(data){
                            data = JSON.parse(data);
                            if (data['error']){
                                Swal.fire({
                                        'title': 'Eroare',
                                        'text': data['message'],
                                        'type': 'error'
                                        });
                            }
                           else {
                               
                               //if search found at least one table entry 
                               if (data.length > 0) {
                                   html = '';

                                   //each iteration builds a table row
                                   for (i = 0; i < data.length; i = i + 4) 
                                       html += "<tr id='" + data[i] + 
                                                "'><td class='delete'><button class='btn btn-danger btn-sm" +
                                                "rounded-0' name='delete' type='button'" +
                                                "data-toggle='tooltip' data-placement='top' title='Delete'>" +
                                                "<i class='fa fa-trash'></i>" +
                                                "</button></td><td class='f_name'>" + data[i + 1] + 
                                                "</td><td class='l_name'>" + data[i + 2] + 
                                                "</td><td class='email'>" + data[i + 3] + 
                                                "</td>" +
                                                "</tr>";
                                   $("tbody#teachers_table_body").html(html);
                              }
                              
                              //if search didn't find any rows
                              else
                                  Swal.fire({
                                          'title': 'Cautare',
                                          'text': 'Nu s-au gasit intrari dupa termenul introdus!',
                                          'type': 'question'
                                          });
                                
                           }
                        }
                                
            });
        });
    
        $("#chooser").on('click', function() {
            console.log('change occured');
            let from_year = $("#from_year_papers").val();
            let to_year = $("#to_year_papers").val();
			let type = $("select#user_type_select").val(); 
        
            //if both years are not selected there is nothing to show
            if (to_year === '' && from_year === '')
              Swal.fire({
                'title': 'Atentie',
                'text': 'Trebuie selectat cel putin un an!',
                'type': 'error'
              });
            else {
                
                //if I wanna show one type of papers 
                if (type === 'articol' || type === 'carte')
                    location = 'prof_raport_documente.php?' + 'from_year=' + from_year + '&to_year=' + to_year + '&type=' + type;
                
                //if I wanna show all type of papers
                else
                    location = 'prof_raport_toate.php?' + 'from_year=' + from_year + '&to_year=' + to_year;
            }

        });

        $(".table-wrapper-scroll-y.my-custom-scrollbar.papers").on('click', "button[name='delete']", function (e) {
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
                        location = 'director.php';
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

        $(".table-wrapper-scroll-y.my-custom-scrollbar.teachers").on('click', "button[name='delete']", function (e) {
            console.log("delete button pressed");
            //get the id of row which to be deleted
            let id = ($(this).closest('tr').attr('id'));

            $.ajax({
                url : "deleteteacher.php",
                method : "POST",
                data: { 'row_id' : id },
                success : function(data){
                    if (data == "success") {
                        document.cookie = 'teacherdeleted=1';
                        location = 'director.php';
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

        $("#chooser_teachers").on('click', function() {
            console.log('change occured');
            let from_year = $("#from_year_teachers").val();
            let to_year = $("#to_year_teachers").val();
			let type = $("select#teachers_type_select").val();
        
            //if both years are not selected there is nothing to show
            if (to_year === '' && from_year === '')
              Swal.fire({
                'title': 'Atentie',
                'text': 'Trebuie selectat cel putin un an!',
                'type': 'error'
              });
            else {
                
                //if I wanna show one type of papers 
                if (type === 'articol' || type === 'carte')
                    location = 'director_raport_documente.php?' + 'from_year=' + from_year + '&to_year=' + to_year + '&type=' + type;
                else if (type === 'profi')
                    location = 'director_raport_profi.php?' + 'from_year=' + from_year + '&to_year=' + to_year;
                
                //if I wanna show all type of papers
                else
                    location = 'director_raport_tot.php?' + 'from_year=' + from_year + '&to_year=' + to_year;
            }

        });
    </script>

</html>


