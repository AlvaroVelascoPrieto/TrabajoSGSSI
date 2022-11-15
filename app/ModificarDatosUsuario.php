<?php

session_start(); //Se recupera la sesion
if (!isset($_SESSION['token'])) {
$_SESSION['token'] = bin2hex(random_bytes(24));
}
?>
<?php
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
      $usuario = '$_POST[NombreAp]';
      $query2 = $conn -> prepare("UPDATE usuarios SET nombreAp=? WHERE email=?");
      $query2 = bindParam('ss', $usuario, $email);
      $query2 = execute();
  }
  else if(isset($_POST['AplicarDNI'])){
      $DNI = '$_POST[DNI]';
      $query3 = $conn -> prepare("UPDATE usuarios SET DNI=? WHERE email=?");
      $query3 = bindParam('ss', $DNI, $email);
      $query3 = execute();
  }
  else if(isset($_POST['AplicarTelefono'])){
      $telf = '$_POST[telf]';
      $query4 = $conn -> prepare("UPDATE usuarios SET telf=$telf WHERE email = ?");
      $query4 = bindParam('ss', $telf, $email);
      $query4 = execute();
  }
  else if(isset($_POST['AplicarFechaNac'])){
      $fechaN = '$_POST[fechaN]';
      $query5 = $conn -> prepare("UPDATE usuarios SET fechaN = ? WHERE email = ? ");
      $query5 = bindParam('ss', $fechaN, $email);
      $query5 = execute();
  }
  else if(isset($_POST['AplicarEMail'])){ //En esta opcion se checkea que el email introducido no se encuentreregistrado en la base de datos
  	$stmt = $conn -> prepare("SELECT pass FROM usuarios WHERE email = ?");
        $stmt -> bind_param('s', $dato1);
        $stmt -> execute();
        $result = $stmt->get_result();
        $contra = mysqli_fetch_array($result);
    	if (mysqli_num_rows($contra) > 0) {
    	    echo "<script> alert('El email que ha introducido ya está registrado'); </script>";
    	}else{
	$query6 = $conn -> prepare("UPDATE usuarios SET email=? WHERE email=?") or die (mysqli_error($conn));
	$query6 = bindParam('ss', $email, $email);
        $query6 = execute();
	$_SESSION['user'] = $_POST['email'];
	$email = $_SESSION['email'];
	}
  }
  else if(isset($_POST['AplicarContra'])){
  	$pw = '$_POST[pw]';
	$query7 = $conn -> prepare("UPDATE usuarios SET pass=? WHERE email=?");
	$query7 = bindParam('ss', $py, $email);
        $query7 = execute();
	
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
