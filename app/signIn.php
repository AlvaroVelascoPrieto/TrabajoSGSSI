<?php
//ini_set('display_errors','off');
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_domain','localhost:81');
session_set_cookie_params($httponly= true, $samesite='Strict');
session_start();
require_once 'utils.php';

$token = createToken();

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
    if (validateToken($_POST['csrf_token'])) {
        $email = $_POST['email'];
    
        $stmt = $conn -> prepare("SELECT pass FROM usuarios WHERE email = ?");
        $stmt -> bind_param('s', $email);
        $stmt -> execute();
        $result = $stmt->get_result();
        $contra = mysqli_fetch_array($result);

        if(password_verify($_POST['password'], $contra[0])) {
       
            $_SESSION['user'] = $email;
        
            //Se redirecciona al usuario a la pagina principal
            header("Location:index.php");
            exit;
        }
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
                <h1>Sign In</h1>
                <h2>E-mail</h2>
                        <input type='text' name='email' placeholder='ejemplo@servidor.extension' required>
                <h2>Contraseña</h2>
                        <input name='password' type='password' required>
                <p id=placeholder></p>
                <input type='hidden' name='csrf_token' value='";
                echo $token;
                echo "'>
                <br>
                <input type='submit' value='Iniciar Sesion' name='IniciarSesion'> 
                
            </form>
        </div> 
    </body>
";


?>

