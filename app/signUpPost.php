<html>
<head>
    <title>HyperLAND-SignUp</title>
    <link rel='stylesheet' href='styles/stylesSignUp.css'>

</head>
	<body class='bg'>
	<img src='images/AloBG.jpg' class='fondo'>
	<div class="boxCentradoSobreImagen">
		<script defer src="comprobarPassword.js"></script>
		<form id="formPW" action="index.php" method="post">
			<h1>Establezca una contraseña</h1>
				<input type="password" placeholder="Mínimo 8 caracteres" id="pw" name="pw" required>
				<br>
				<br>
				<input type="password" placeholder="Repita la contraseña" id="pw2" name="pw2" required>
				<br>
				<br>
			<button type="submit">Aceptar</button>

		</form>
	</div>
</body>
<?php

// phpinfo();
$hostname = "db";
$username = "admin";
$password = "test";
$db = "database";


$conn = mysqli_connect($hostname,$username,$password,$db);
if ($conn->connect_error) {
	die("Database connection failed: " . $conn->connect_error);
}

$query = mysqli_query($conn, "INSERT INTO 
	usuarios(nombreAp, DNI, telf, fechaN, email)
	VALUES('$_POST[NombreAp]', 
		'$_POST[DNI]', 
		'$_POST[telefono]', 
		'$_POST[fechaN]', 
		'$_POST[email]')")
   	or die (mysqli_error($conn));

?>

</body>
</html>