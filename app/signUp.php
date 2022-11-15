<?php
ini_set('display_errors','off');
//Se restaura la sesion anterior
session_start();
if (!isset($_SESSION['token'])) {
$_SESSION['token'] = bin2hex(random_bytes(24));
}

//Se definen todos los datos necesarios para conectarse con la base de datos
$hostname = "db";
$username = "admin";
$password = "test";
$db = "database";

//Se establece conexion con la base de datos
$conn = mysqli_connect($hostname,$username,$password,$db);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

//Se comprueba si se ha pulsado el boton de registrar se comprueba si el email no esta ya registrado y se hacen los cambios necesarios en la base de datos
if(isset($_POST['Registrar'])) {

    $user = $_POST['email'];
    $pass = $_POST['pw'];
 
    $emailQuery = mysqli_query($conn, "SELECT * FROM `usuarios` WHERE email = '$_POST[email]'")
    or die (mysqli_error($conn));
    if (mysqli_num_rows($emailQuery) > 0) {

        echo "<script> alert('El email que ha introducido ya está registrado'); </script>";

    }else{

        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        
        $nombreAp = $_POST['NombreAp'];
        $DNI = $_POST['DNI'];
        $telf = $_POST['telefono'];
        $fechaN = $_POST['fechaN'];
        $email = $user;
        
        $stmt = $conn->prepare("INSERT INTO usuarios(nombreAp, DNI, telf, fechaN, email, pass) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisss",$nombreAp, $DNI, $telf, $fechaN, $email, $pass);
    
       
       
    
       /* ejecuta sentencias prepradas */
       $stmt->execute();
    
    
       /* cierra sentencia y conexión */
       $stmt->close();
    
       /* cierra la conexión */
       $conn->close();
    
        header("Location:index.php");
        exit;
    }
}


//Se genera el formulario en el que el usuario define los datos a introducir y se define el archivo de javascript que realiza las comprobaciones de los campos
echo "  
<head>
    <title>Sing Up</title>
    <link rel='stylesheet' href='styles/stylesSignUp.css'>
    <link rel='icon' href='images/F1Sprite.png'>
    
</head>
    <body class='bg'>
        <img src='images/AloBG.jpg' style='max-width: 100%; height: auto;'>
        <div class='boxCentradoSobreImagen'>
            <script defer src='scripts/comprobar.js'></script>

            <form id='SignUp' method='post'>
                <h1>Sign Up</h1>
                <h2>Nombre y Apellidos</h2>
                        <input class='usernameinput' id='NombreAp' name='NombreAp' placeholder='Ej: Pedro De La Rosa' align='center' required>
                        <br>
                        <label for='NombreAp' id='NombreApError' class='error'></label>
                <h2>DNI</h2>
                        <input name='DNI' id='DNI' placeholder='Ej: 11111111X' required>
                        <br>
                        <label for='DNI'id ='DNIerror' class='error'></label>
                <h2>Teléfono</h2>
                        <input name='telefono' id='telefono' placeholder='Ej: 678901234' required>
                        <br>
                        <label for='telefono' id ='telfError' class='error'></label>
                <h2>Fecha de nacimiento</h2>
                        <input name='fechaN' id='fechaN' type='date' required>
                        <br>
                        <label for=''id =''></label>
                <h2>E-Mail</h2>
                        <input name='email' id='email' type='text' placeholder='ejemplo@servidor.extension' required>
                        <br>

                        <label for='email' id ='emailError' class='error'></label>
                <h2>Contraseña</h2>
                        <input type='password' placeholder='Mínimo 8 caracteres' id='pw' name='pw' required>
                        <br>
                        <br>
                        <input type='password' placeholder='Repita la contraseña' id='pw2' name='pw2' required>
                        <br>
                        <label for='pw2' class='error' id='pwError'></label>
                <br>
                <label  for='pw2' id='error' class='error'></label>
                <br>
                <br>
                <br>
                
                <label id='errores'></label>
                <input type='submit' class='tag' name='Registrar' value='Registrar'/>
            </form>
        </div> 
    </body>
";


?>

