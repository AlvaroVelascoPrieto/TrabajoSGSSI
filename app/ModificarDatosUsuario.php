<?php

	session_start();
	
  $hostname = "db";
  $username = "admin";
  $password = "test";
  $db = "database";
	$email = $_SESSION['user'];

  $conn = mysqli_connect($hostname,$username,$password,$db);
  if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
  }
  
  $query = mysqli_query($conn, "SELECT Modelo FROM carros") or die (mysqli_error($conn));
  
   if(isset($_POST['AplicarNombre'])){
	$query2 = mysqli_query($conn, "UPDATE usuarios SET nombreAp='$_POST[NombreAp]' WHERE email='$email'") or die (mysqli_error($conn));
  }
  else if(isset($_POST['AplicarDNI'])){
	$query3 = mysqli_query($conn, "UPDATE usuarios SET DNI='$_POST[DNI]' WHERE email='$email'") or die (mysqli_error($conn));
  }
  else if(isset($_POST['AplicarTelefono'])){
	$query4 = mysqli_query($conn, "UPDATE usuarios SET telf='$_POST[telefono]' WHERE email='$email'") or die (mysqli_error($conn));
  }
  else if(isset($_POST['AplicarFechaNac'])){
	$query5 = mysqli_query($conn, "UPDATE usuarios SET fechaN='$_POST[fechaN]' WHERE email='$email'") or die (mysqli_error($conn));
  }
  else if(isset($_POST['AplicarEMail'])){
  	$emailQuery = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE email = '$_POST[email]'")
    or die (mysqli_error($conn));
    	if (mysqli_num_rows($emailQuery) > 0) {
    	    echo "<script> alert('El email que ha introducido ya está registrado'); </script>";
    	}else{
	$query6 = mysqli_query($conn, "UPDATE usuarios SET email='$_POST[email]' WHERE email='$email'") or die (mysqli_error($conn));
	$_SESSION['user'] = $_POST['email'];
	$email = $_SESSION['email'];
	}
  }
  else if(isset($_POST['AplicarContra'])){
	$query7 = mysqli_query($conn, "UPDATE usuarios SET pass='$_POST[pw]' WHERE email='$email'") or die (mysqli_error($conn));
  }

  echo "  
<head>
    <title>Modificar datos</title>
    <link rel='stylesheet' href='styles/styles.css'>
		<link rel='icon' href='images/F1Sprite.png'>

</head>
    <body class='bg'>
        <img src='https://upload.wikimedia.org/wikipedia/commons/8/88/Lotus97T.jpg' style='width: 100%; height: auto;'>
        <div class='boxCentradoSobreImagen'>
        <script defer src='scripts/comprobar.js'></script>

        <form id='SignUp' method='post'>
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
        	</div>

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
        	</div>

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
        	</div>
        	
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
        	</div>
        	
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
        	</div>
        	</form>
        </div>
    </body>";    
?>