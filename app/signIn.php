<?php

session_start();

// phpinfo();
$hostname = "db";
$username = "admin";
$password = "test";
$db = "database";


$conn = mysqli_connect($hostname,$username,$password,$db);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if(isset($_POST['IniciarSesion'])) {
	$dato1= $_POST['email'];
    $query = mysqli_query($conn, "SELECT pass FROM usuarios WHERE email = '$_POST[email]';")
    or die (mysqli_error($conn));
    $contra = mysqli_fetch_array($query);
    if(strcmp($contra[0],$_POST['password'])==0){
        $_SESSION['user'] = $dato1;
        $_SESSION['pw'] = $_POST['password'];

    	header("Location:index.php");
    	exit;
    }
  }

echo "  
<head>
    <title>HyperLAND-SignUp</title>
    <link rel='stylesheet' href='styles/stylesSignUp.css'>
</head>
    <body class='bg'>
        <img src='images/AloBG.jpg' style='max-width: 100%; height: auto;'>
        <div class='boxCentradoSobreImagen'>
            <form id='SignIp' method='post'>
                <h1>Sign In</h1>
                <h2>E-mail</h2>
                        <input type='text' name='email' placeholder='ejemplo@servidor.extension' required>
                <h2>Contraseña</h2>
                        <input name='password' type='password' required>
                <p id=placeholder></p>
                <br>
                <input type='submit' value='Iniciar Sesion' name='IniciarSesion'> 
            </form>
        </div> 
    </body>
";


?>

