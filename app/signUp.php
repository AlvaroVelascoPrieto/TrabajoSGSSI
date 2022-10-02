<?php
echo "  
<head>
    <title>HyperLAND-SignUp</title>
    <link rel='stylesheet' href='styles/stylesSignUp.css'>

</head>
    <body class='bg'>
        <img src='images/AloBG.jpg' style='max-width: 100%; height: auto;'>
        <div class='boxCentradoSobreImagen'>
            <script defer src='comprobar.js'></script>

            <form id='SignUp' action='signUpPost.php' method='post'>
                <h1>Sign Up</h1>
                <h2>Nombre y Apellidos</h2>
                        <input class='usernameinput' id='NombreAp' name='NombreAp' placeholder='Pedro Martinez De La Rosa' align='center' required>
                        <br>
                        <label for='NombreAp' id='NombreApError' class='error'></label>
                <h2>DNI</h2>
                        <input name='DNI' id='DNI' placeholder='11111111X' required>
                        <br>
                        <label for='DNI'id ='DNIerror' class='error'></label>
                <h2>Teléfono</h2>
                        <input name='telefono' id='telefono' placeholder='(+34) 678901234' required>
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
                <br>
                <br>
                <button type='submit'>Registrar</button>
            </form>
        </div> 
    </body>
";
?>
