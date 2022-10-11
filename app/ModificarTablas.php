<?php
  echo "  
<head>
    <title>Sing Up</title>
    <link rel='stylesheet' href='styles/styles.css'>

</head>
    <body class='bg'>
        <img src='https://upload.wikimedia.org/wikipedia/commons/8/88/Lotus97T.jpg' style='width: 100%; height: auto;'>
        <div class='boxCentradoSobreImagen'>
        	<div class='containerSeleccion'>
        		<form id='ModificarNombre' method='post'>
				<div class='formSeleccion'>
					<h3>Nombre y Apellidos</h3>
				</div>
				<div class='formSeleccion'>
					<input class='usernameinput' id='NombreAp' name='NombreAp' placeholder='Ej: Pedro De La Rosa' align='center' required>
				</div>
				<div class='formSeleccion'>
					<input type='submit' class='tag' name='AplicarNombre' value='Aplicar'/>
				</div>
			</form>
        	</div>
        	<div class='containerSeleccion'>
        		<form id='ModificarDNI' method='post'>
				<div class='formSeleccion'>
					<h3>DNI</h3>
				</div>
				<div class='formSeleccion'>
					<input name='DNI' id='DNI' placeholder='Ej: 11111111X' required>
				</div>
				<div class='formSeleccion'>
					<input type='submit' class='tag' name='AplicarDNI' value='Aplicar'/>
				</div>
			</form>
        	</div>
        	<div class='containerSeleccion'>
        		<form id='ModificarTelefono' method='post'>
				<div class='formSeleccion'>
					<h3>Telefono</h3>
				</div>
				<div class='formSeleccion'>
					<input name='telefono' id='telefono' placeholder='Ej: 678901234' required>
				</div>
				<div class='formSeleccion'>
					<input type='submit' class='tag' name='AplicarTelefono' value='Aplicar'/>
				</div>
			</form>
        	</div>
        	<div class='containerSeleccion'>
        		<form id='ModificarFechaNac' method='post'>
				<div class='formSeleccion'>
					<h3>Fecha de nacimiento</h3>
				</div>
				<div class='formSeleccion'>
					<input name='fechaN' id='fechaN' type='date' required>
				</div>
				<div class='formSeleccion'>
					<input type='submit' class='tag' name='AplicarFechaNac' value='Aplicar'/>
				</div>
			</form>
        	</div>
        	<div class='containerSeleccion'>
        		<form id='ModificarEMail' method='post'>
				<div class='formSeleccion'>
					<h3>E-Mail</h3>
				</div>
				<div class='formSeleccion'>
					<input name='email' id='email' type='text' placeholder='ejemplo@servidor.extension' required>
				</div>
				<div class='formSeleccion'>
					<input type='submit' class='tag' name='AplicarEMail' value='Aplicar'/>
				</div>
			</form>
        	</div>
        	<div class='containerSeleccion'>
        		<form id='ModificarContra' method='post'>
				<div class='formSeleccion'>
					<h3>Contrasena</h3>
				</div>
				<div class='formSeleccion'>
					<input type='password' placeholder='Mínimo 8 caracteres' id='pw' name='pw' required>
				</div>
				<div class='formSeleccion'>
					<input type='password' placeholder='Repita la contraseña' id='pw2' name='pw2' required>
				</div>
				<div class='formSeleccion'>
					<input type='submit' class='tag' name='AplicarContra' value='Aplicar'/>
				</div>
			</form>
        	</div>
        </div>
    </body>";    
?>
