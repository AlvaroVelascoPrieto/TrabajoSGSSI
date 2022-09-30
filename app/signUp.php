<?php
  echo "  
<head>
        <title>HyperLAND-SignUp</title>
        <link rel='stylesheet' href='styles/stylesSignUp.cs'>
        
    </head>
    <body class='bg'>
        <script>
            function comprobar() {
                
                var nombreAp = document.getElementById('NombreAp').value;
                var DNI = document.getElementById('DNI').value;
                var telf = document.getElementById('telefono').value;
                var fechaN = document.getElementById('fechaN').value;
                var email = document.getElementById('email').value;
                document.getElementById('placeholder').innerHTML = nombreAp;

            }
        </script>
            <div class='boxCentrado'>
                <form name=Sign Up>
                    <h1>Sign Up</h1>
                    <h2>Nombre y Apellidos</h2>
                            <input class='usernameinput' id='NombreAp' placeholder='Pedro Martinez De La Rosa' required>
                    <h2>DNI</h2>
                            <input class='passwordinput' id='DNI' type='password' placeholder='11111111X' required>
                    <h2>Telefono</h2>
                            <input class='passwordinput' id='telefono' type='password' placeholder='Numero 9 digitos' required>
                     <h2>Fecha de nacimiento</h2>
                            <input class='passwordinput' id='fechaN' type='date' placeholder='Numero 9 digitos'>
                    <h2>E-Mail</h2>
                            <input class='passwordinput' id='email' type='text' placeholder='E-Mail' required>
                    <p id=placeholder>123</p>
                    <br>
                    <br>
                    <input type='button' value='Registrar' onclick='comprobar()'>                </form>
            </div>
        
</body>";
?>
