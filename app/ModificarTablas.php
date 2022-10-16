<?php
  $hostname = "db";
  $username = "admin";
  $password = "test";
  $db = "database";

  $conn = mysqli_connect($hostname,$username,$password,$db);
  if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
  }
  
  $query = mysqli_query($conn, "SELECT Modelo FROM carros") or die (mysqli_error($conn));
  
   if(isset($_POST['AplicarVictorias'])){
	$query2 = mysqli_query($conn, "UPDATE carros SET Victorias='$_POST[NVictorias]' WHERE Modelo='$_POST[Dato1]'") or die (mysqli_error($conn));
  }
  else if(isset($_POST['AplicarPoles'])){
	$query3 = mysqli_query($conn, "UPDATE carros SET Pole_positions='$_POST[Poles]' WHERE Modelo='$_POST[Dato1]'") or die (mysqli_error($conn));
  }
  else if(isset($_POST['AplicarPiloto'])){
	$query4 = mysqli_query($conn, "UPDATE carros SET Primer_piloto='$_POST[piloto]' WHERE Modelo='$_POST[Dato1]'") or die (mysqli_error($conn));
  }
  else if(isset($_POST['AplicarAnno'])){
	$query5 = mysqli_query($conn, "UPDATE carros SET Anno='$_POST[Anno]' WHERE Modelo='$_POST[Dato1]'") or die (mysqli_error($conn));
  }
  echo "  
<head>
    <title>Sing Up</title>
    <link rel='stylesheet' href='styles/styles.css'>
    <script defer src='scripts/comprobar.js'>

</head>
    <body class='bg'>
        <img src='https://upload.wikimedia.org/wikipedia/commons/8/88/Lotus97T.jpg' style='width: 100%; height: auto;'>
        <div class='boxCentradoSobreImagen'>
        	<form id='ModificarDatos' method='post'>
        	<div class='formSeleccion'>
                	<select name='Dato1'>";
                
        


while ($option = mysqli_fetch_array($query)) {
    echo "<option value='{$option[0]}'>{$option[0]}</option>";
}

	echo "  	</select>
    		</div>
        	<div class='containerSeleccion'>
				<div class='formSeleccion'>
					<h3>Victorias</h3>
				</div>
				<div class='formSeleccion'>
					<input class='usernameinput' id='NVictorias' name='NVictorias' placeholder='Ej: 5' align='center'>
				</div>
				<div class='formSeleccion'>
					<input type='submit' class='tag' name='AplicarVictorias' value='Aplicar'/>
				</div>
        	</div>
        	<div class='containerSeleccion'>
				<div class='formSeleccion'>
					<h3>Pole Positions</h3>
				</div>
				<div class='formSeleccion'>
					<input name='Poles' id='Poles' placeholder='Ej: 11'>
				</div>
				<div class='formSeleccion'>
					<input type='submit' class='tag' name='AplicarPoles' value='Aplicar'/>
				</div>
        	</div>
        	<div class='containerSeleccion'>
				<div class='formSeleccion'>
					<h3>Primer Piloto</h3>
				</div>
				<div class='formSeleccion'>
					<input name='piloto' id='piloto' placeholder='Ej: Fernando Alonso'>
				</div>
				<div class='formSeleccion'>
					<input type='submit' class='tag' name='AplicarPiloto' value='Aplicar'/>
				</div>
        	</div>
        	<div class='containerSeleccion'>
				<div class='formSeleccion'>
					<h3>Año</h3>
				</div>
				<div class='formSeleccion'>
					<input name='Anno' id='Anno' placeholder='2002'>
				</div>
				<div class='formSeleccion'>
					<input type='submit' class='tag' name='AplicarAnno' value='Aplicar'/>
				</div>
        	</div>
        	</form>
        </div>
    </body>";    
?>
