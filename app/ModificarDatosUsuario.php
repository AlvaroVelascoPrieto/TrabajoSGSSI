<?php
ini_set('display_errors','off');
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_domain','localhost:81');
session_set_cookie_params($httponly= true, $samesite='Strict');
session_start();
require_once 'utils.php';

//Se definen los datos	para registrarse en la base de datos
  $hostname = "db";
  $username = "admin";
  $password = "test";
  $db = "database";
$email = $_SESSION['user']; //Se define el email del usuario que ha iniciado sesion
//Se establece conexion con la base de datos
  $conn = mysqli_connect($hostname,$username,$password,$db);
  if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
  }
  
//Se mira si alguno de los botones de aplicar han sido presionado y se actualiza el datos correspondiente en la base de datos
   if(isset($_POST['AplicarNombre'])){
	
	$nombre = $_POST['NombreAp'];
	
 	$stmt = $conn -> prepare("UPDATE usuarios SET nombreAp=? WHERE email=?") ;
	if ($stmt === false) {
		trigger_error($this->mysqli->error, E_USER_ERROR);
	}
 	$stmt -> bind_param('ss', $nombre , $email);
	$status = $stmt -> execute();
	if ($status === false) {
		trigger_error($stmt->error, E_USER_ERROR);
	}
	$stmt -> close();

}
  else if(isset($_POST['AplicarDNI'])){
	$DNI = $_POST['DNI'];
	
	$stmt = $conn -> prepare("UPDATE usuarios SET DNI=? WHERE email=?") ;
   if ($stmt === false) {
	   trigger_error($this->mysqli->error, E_USER_ERROR);
   }
	$stmt -> bind_param('ss', $DNI , $email);
   $status = $stmt -> execute();
   if ($status === false) {
	   trigger_error($stmt->error, E_USER_ERROR);
   }
   $stmt -> close();

	}
  else if(isset($_POST['AplicarTelefono'])){
	$telefono = $_POST['telefono'];
	
 	$stmt = $conn -> prepare("UPDATE usuarios SET telf=? WHERE email=?") ;
	if ($stmt === false) {
		trigger_error($this->mysqli->error, E_USER_ERROR);
	}
 	$stmt -> bind_param('is', $telefono , $email);
	$status = $stmt -> execute();
	if ($status === false) {
		trigger_error($stmt->error, E_USER_ERROR);
	}
	$stmt -> close();	

	}
  else if(isset($_POST['AplicarFechaNac'])){
	$fecha = $_POST['fechaN'];
	
 	$stmt = $conn -> prepare("UPDATE usuarios SET fechaN=? WHERE email=?") ;
	if ($stmt === false) {
		trigger_error($this->mysqli->error, E_USER_ERROR);
	}
 	$stmt -> bind_param('ss', $fecha , $email);
	$status = $stmt -> execute();
	if ($status === false) {
		trigger_error($stmt->error, E_USER_ERROR);
	}
	$stmt -> close();
  }
  else if(isset($_POST['AplicarEMail'])){ //En esta opcion se checkea que el email introducido no se encuentreregistrado en la base de datos
  	
	$emailQuery = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE email = '$_POST[email]'")
    or die (mysqli_error($conn));
    	if (mysqli_num_rows($emailQuery) > 0) {
    	    echo "<script> alert('El email que ha introducido ya está registrado'); </script>";
    	}else{
			$emailP = $_POST['email'];
	
			$stmt = $conn -> prepare("UPDATE usuarios SET email=? WHERE email=?") ;
		   if ($stmt === false) {
			   trigger_error($this->mysqli->error, E_USER_ERROR);
		   }
			$stmt -> bind_param('ss', $emailP , $email);
		   $status = $stmt -> execute();
		   if ($status === false) {
			   trigger_error($stmt->error, E_USER_ERROR);
		   }
		   $_SESSION['email'] = $emailP;
		   $stmt -> close();
	$email = $_SESSION['email'];
	}
  }
  else if(isset($_POST['AplicarContra'])){
	$contra = $_POST['pw'];
	
 	$stmt = $conn -> prepare("UPDATE usuarios SET pass=? WHERE email=?");
	if ($stmt === false) {
		trigger_error($this->mysqli->error, E_USER_ERROR);
	}
 	$stmt -> bind_param('ss', $contra , $email);
	$status = $stmt -> execute();
	if ($status === false) {
		trigger_error($stmt->error, E_USER_ERROR);
	}
	$stmt -> close();	
}
//Se crea el formulario para editar las tablas
  echo "  
<head>
    <title>Modificar datos</title>
    <link rel='stylesheet' href='styles/styles.css'>
		<link rel='icon' href='images/F1Sprite.png'>
		<script defer src='scripts/comprobarCambiarDatos.js'></script>

</head>
    <body class='bg'>
        <img src='https://upload.wikimedia.org/wikipedia/commons/8/88/Lotus97T.jpg' style='width: 100%; height: auto;'>
        <div class='boxCentradoSobreImagen'>
        

        <form id='ModificarNombre' method='post'>
        	<div class='containerSeleccion'>
				<div class='formSeleccion'>
					<h3>Nombre y Apellidos</h3>
				</div>
				<div class='formSeleccion'>
					<input class='usernameinput' id='NombreAp' name='NombreAp' placeholder='Ej: Pedro De La Rosa' align='center'>		
				</div>
				<div class='formSeleccion'>
					<input type='submit' class='tag' name='AplicarNombre' value='Aplicar'/>
				</div>
				<div><label for='NombreAp' id='NombreApError' class='error'></label></div>
        	</div>
			<input type='hidden' name='token' value="; 
        
        $_SESSION['token'];
        
        echo ">
        	</form>

        <form id='ModificarDNI' method='post'>
        	<div class='containerSeleccion'>
				<div class='formSeleccion'>
					<h3>DNI</h3>
				</div>
				<div class='formSeleccion'>
					<input name='DNI' id='DNI' placeholder='Ej: 11111111X'>
				</div>
				<div class='formSeleccion'>
					<input type='submit' class='tag' name='AplicarDNI' value='Aplicar'/>
					
        </div>
        <div><label for='DNI' id='DNIerror' class='error'></label></div>
        	</div>
			<input type='hidden' name='token' value="; 
        
        $_SESSION['token'];
        
        echo ">
        </form>

        <form id='ModificarTelf' method='post'>
        	<div class='containerSeleccion'>
				<div class='formSeleccion'>
					<h3>Telefono</h3>
				</div>
				<div class='formSeleccion'>
					<input name='telefono' id='telefono' placeholder='Ej: 678901234'>
				</div>
				<div class='formSeleccion'>
					<input type='submit' class='tag' name='AplicarTelefono' value='Aplicar'/>
					
				</div>
				<div><label for='telefono' id='telfError' class='error'></label></div>
        	</div>
			<input type='hidden' name='token' value="; 
        
        $_SESSION['token'];
        
        echo ">
        </form>

        	<div class='containerSeleccion'>
				<div class='formSeleccion'>
					<h3>Fecha de nacimiento</h3>
				</div>
				<div class='formSeleccion'>
					<input name='fechaN' id='fechaN' type='date'>
				</div>
				<div class='formSeleccion'>
					<input type='submit' class='tag' name='AplicarFechaNac' value='Aplicar'/>
					
				</div>
				<div><label for='fechaN' id='' class='error'></label></div>
        	</div>
        	
        <form id='ModificarEmail' method='post'>
        	<div class='containerSeleccion'>
				<div class='formSeleccion'>
					<h3>E-Mail</h3>
				</div>
				<div class='formSeleccion'>
					<input name='email' id='email' type='text' placeholder='ejemplo@servidor.extension'>
				</div>
				<div class='formSeleccion'>
					<input type='submit' class='tag' name='AplicarEMail' value='Aplicar'/>
					
				</div>
				<div><label for='email' id='emailError' class='error'></label></div>
        	</div>
			<input type='hidden' name='token' value="; 
        
        $_SESSION['token'];
        
        echo ">
        </form>
        	
        <form id='ModificarPw' method='post'>
        	<div class='containerSeleccion'>
				<div class='formSeleccion'>
					<h3>Contrasena</h3>
				</div>
				<div class='formSeleccion'>
					<input type='password' placeholder='Mínimo 8 caracteres' id='pw' name='pw'>
				</div>
				<div class='formSeleccion'>
					<input type='password' placeholder='Repita la contraseña' id='pw2' name='pw2'>
				</div>
				<div class='formSeleccion'>
					<input type='submit' class='tag' name='AplicarContra' value='Aplicar'/>
					
				</div>
				<div><label for='pw' id='pwError' class='error'></label></div>
        	</div>
			<input type='hidden' name='token' value="; 
        
        $_SESSION['token'];
        
        echo ">
        	</form>
        	<div>
        	<li class='topnav-right'><a href='index.php'>Volver</a></li>
        </div>
        </div>

    </body>";    
?>
