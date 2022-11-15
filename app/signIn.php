<?php
ini_set('display_errors','off');
//Se de restaura la sesion anterior
session_start();
if (!isset($_SESSION['token'])) {
$_SESSION['token'] = bin2hex(random_bytes(24));
}
?>
<?php
//Se definen los datos necesarios para establecer conexion con la base de datos
// phpinfo();
$hostname = "db";
$username = "admin";
$password = "test";
$db = "database";

//Se establece conexion con la base de datos
$conn = mysqli_connect($hostname,$username,$password,$db);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

//Se comprueba si se ha pulsado en iniciar sesion y se comprueba que la contraseña introducida coincida con la que el usuario tiene en la base de datos
if(isset($_POST['IniciarSesion'])) {
	$dato1= $_POST['email'];
    $query = mysqli_query($conn, "SELECT pass FROM usuarios WHERE email = '$_POST[email]';")
    or die (mysqli_error($conn));
    $contra = mysqli_fetch_array($query);
    if(strcmp($contra[0],$_POST['password'])==0){
        $_SESSION['user'] = $dato1;
        $_SESSION['pw'] = $_POST['password'];
//Se redirecciona al usuario a la pagina principal
    	header("Location:index.php");
    	exit;
    }
  }

//Se genera el formulario que recoge todos los datos del usuario
echo "  
<head>
    <title>HyperLAND-SignUp</title>
    <link rel='stylesheet' href='styles/stylesSignUp.css'>
    <link rel='icon' href='images/F1Sprite.png'>
</head>
    <body class='bg'>
        <img src='images/AloBG.jpg' style='max-width: 100%; height: auto;'>
        <div class='boxCentradoSobreImagen'>
            <form id='SignIn' method='post'>
            <input type='hidden' name='token' value="; 
        
                $_SESSION['token'];
                
                echo ">
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

