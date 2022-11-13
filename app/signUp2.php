<html>
<?php

    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

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
        
    
        $query = mysqli_query($conn, "INSERT INTO 
        usuarios(nombreAp, DNI, telf, fechaN, email, pass)
        VALUES('$_POST[NombreAp]', 
            '$_POST[DNI]', 
            '$_POST[telefono]', 
            '$_POST[fechaN]', 
            '$user',
            '$pass')")
        or die (mysqli_error($conn));
        exit;
    
        
        }
    }
?>

<head>
    <title>HyperLAND</title>
    <link rel="icon" href="images/F1Sprite.png">
    <link rel="stylesheet" href="styles/styleSignUp2.css">
    <script defer src='scripts/comprobar.js'></script>
</head>
<div id="menu">
    <div id="menu-items">
        
        <form id="SignUp" method="post">
            <input class="usernameinput" id="NombreAp" name="NombreAp" placeholder="Ej: Pedro De La Rosa" required>
            <label id="nap">Nombre y apellidos</label><br>
            <input name='DNI' id='DNI' placeholder='Ej: 11111111X' required>
            <label>DNI</label><br>
            <input name='telefono' id='telefono' placeholder='Ej: 678901234' required>
            <label>Teléfono</label><br>
            <input name='fechaN' id='fechaN' type='date' required>
            <label>Fecha de nacimiento</label><br>
            <input name='email' id='email' type='text' placeholder='ejemplo@servidor.extension' required>
            <label>E-mail</label><br>
            <input type='password' placeholder='Mínimo 8 caracteres' id='pw' name='pw' required>
            <label>Contraseña</label><br>
            <input type='password' placeholder='Repita la contraseña' id='pw2' name='pw2' required>
            <label>Repita la contraseña</label><br><br><br>
            <div id="Registrar">
                <input type='submit' class='tag' name='Registrar' value='Registrar'/>
                <a href="/index2.php">
                    <input type="button" name="Cancelar" value="Cancelar" href="/index2.php"/>
                </a>
            </div>
        </form>
        
        
    </div>
    <div id="menu-background-pattern"></div>
    <div id="menu-background-image"></div>
</div>    
</html>
