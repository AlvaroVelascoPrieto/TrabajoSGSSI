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

if(isset($_POST['pwSubmit'])) {
	$query2 = mysqli_query($conn, 
		"UPDATE usuarios 
		SET pass='$_POST[pw]' 
		WHERE email='$_POST[email]';")
	or die(mysqli_error($conn));
	header("Location:index.php");
    exit;
	
}

echo "

<html>
<head>
    <title>HyperLAND-SignUp</title>
    <link rel='stylesheet' href='styles/stylesSignUp.css'>

</head>
	<body class='bg'>
	<img src='images/AloBG.jpg' class='fondo'>
	<div class='boxCentradoSobreImagen'>
		<script defer src='scripts/comprobarPassword.js'></script>
		

		<form id='formPW' action='' method='post'>
			<h1>Establezca una contraseña</h1>
				<input type='password' placeholder='Mínimo 8 caracteres' id='pw' name='pw' required>
				<br>
				<br>
				<input type='password' placeholder='Repita la contraseña' id='pw2' name='pw2' required>
				<br>
				<label  for='pw2' id='error' class='error'></label>
				<br>";

echo "<h1>aaaaa</h1>";

echo "
				<br>
			<input type='submit' name='pwSubmit' value='Aceptar'/>
		</form>		
	</div>
</body>
</html>";

?>
