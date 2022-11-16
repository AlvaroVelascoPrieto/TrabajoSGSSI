<?php
session_start();
if (!isset($_SESSION['token'])) {
$_SESSION['token'] = bin2hex(random_bytes(24));
}
//Se definen los datos para establecer conexion con base de datos
  $hostname = "db";
  $username = "admin";
  $password = "test";
  $db = "database";

//Se establece conexion con la basede datos
  $conn = mysqli_connect($hostname,$username,$password,$db);
  if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
  }
  
  //Se define la query para poblar el desplegable de modelos de coches a editar
  $query = mysqli_query($conn, "SELECT Modelo FROM carros") or die (mysqli_error($conn));
  
  //SE comprueba si alguno de los botones de aplicar se ha presionado y se realiza el cambio correspondiente en la base de datos
   if(isset($_POST['AplicarVictorias'])){
   	$victorias = '$_POST[NVictorias]';
   	$Dato1 = '$_POST[Dato1]';
	$query2 = $conn -> prepare( "UPDATE carros SET Victorias=? WHERE Modelo=?") ;
	$query2 -> bindParam('ss', $victorias , $dato1);
        $query2 -> execute();
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
  
  if ($_POST["token"] == $_SESSION["token"]) {

  //SE genera el formulario para editar los datos y en el bucle se rellena el desplegable con los datos de los coches de la base de datos
  echo "  
<head>
    <title>Sing Up</title>
    <link rel='stylesheet' href='styles/styles.css'>
    <link rel='icon' href='images/F1Sprite.png'>

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
    </body>";    }
	else{echo "Session token does not match, session invalid";}
?>
