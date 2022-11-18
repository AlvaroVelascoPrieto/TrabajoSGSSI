<?php
ini_set('display_errors','off');
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_domain','localhost:81');
session_set_cookie_params($httponly= true, $samesite='Strict');
session_start();
require_once 'utils.php';

$token = createToken();

  if(isset($_POST['EditarDatos'])){			//Se comprueba si se ha hecho click en editar datos para efectuar la redireccion
    if(validateToken($_POST['csrf_token'])) {
        header("Location:ModificarTablas.php");	//Se redirecciona
    }	
    exit;
  }
    
    echo '<head>
        <title>HyperLAND</title>
        <link rel="icon" href="images/F1Sprite.png">
        <link rel="stylesheet" href="styles/styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Roboto:wght@500&display=swap" rel="stylesheet">
    </head>';		//Cabecera HTML que define el icono de la pagina y las fuentes
    
    
  // phpinfo();
  $hostname = "db";		//Se definen los datos de acceso a la base de datos
  $username = "admin";
  $password = "test";
  $db = "database";

  //Conexión con la base de datos, que, en caso de dar error, lanza un mensaje con el error
  $conn = mysqli_connect($hostname,$username,$password,$db);
  if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
  }


//Querys que luego se emplearan para poblar los desplegables
$query = mysqli_query($conn, "SELECT nombreAp FROM usuarios")
   or die (mysqli_error($conn));
$query2 = mysqli_query($conn, "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_NAME`='carros';")
   or die (mysqli_error($conn));
$query3 = mysqli_query($conn, "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_NAME`='carros';")
   or die (mysqli_error($conn));
   
//If para comprobar si hay una sesión iniciada, que cambiaría el HTML de la página
if(!isset($_SESSION['user']) and !isset($_SESSION['pw'])) {
    echo "<body>
        <nav>
        <ul class='topnav' id='dropdownClick'>
        <li><a href='#Top'>Home</a></li>
        <li><a href='https://github.com/AlbertoArostegui/TrabajoSGSSI'>About Us</a></li>
        <li><a href='#Tablas'>Monoplazas</a></li>
        <li class='topnav-right'><a href='signUp.php'>Sign Up</a></li>
        <li class='topnav-right'><a href='signIn.php'>Sign In</a></li>
        <li class='dropdownicon' onclick='dropdownMenu()'><a href='script.js:void(0)'>  
        &#9776;</a></li>
        </ul>
        </nav>";
    }else{
    echo "<body>
        <nav>
        <ul class='topnav' id='dropdownClick'>
        <li><a href='#Top'>Home</a></li>
        <li><a href='https://github.com/AlbertoArostegui/TrabajoSGSSI'>About Us</a></li>
        <li><a href='#Tablas'>Monoplazas</a></li>
        <li class='topnav-right'><a href='logout.php'>Log out</a></li>
        <li class='topnav-right'><a href='ModificarDatosUsuario.php'>Editar Datos Personales</a></li>
        <li class='dropdownicon' onclick='dropdownMenu()'><a href='script.js:void(0)'>  
        &#9776;</a></li>
        </ul>
        </nav>";

        }

//Se definen diferentes divs que contienen un titulo y un video
    echo "
        <div class='intro'>
            <div class='titlecontainer'>
                <h1>F1 content<br>
                Made for fans</h1>
            </div>
            <div class='videocontainer'>
                <iframe width='560' height='315' src='https://www.youtube.com/embed/kpHJxA-wnXg' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
            </div>
        </div>
        

<div class='wave'>
    <svg data-name='Layer 1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'>
        <path d='M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z' opacity='.25' class='shape-fill'></path>
        <path d='M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z' opacity='.5' class='shape-fill'></path>
        <path d='M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z' class='shape-fill'></path>
    </svg>
</div>
        <h1 class='galerytitle' id='Tablas'>MONOPLAZAS</h1>
        <form action='' method='post'>
        <div class='containerSeleccion'>
        <div class='formSeleccion'>
                <h2>Selecciona 2 datos a visualizar:</h2>
            </div>  
            <div class='formSeleccion'>
                <select name='Dato1'>
                
        ";

//Se rellenan los desplegables con los datos de la basede datos
while ($option = mysqli_fetch_array($query2)) {
    echo "<option value='{$option['COLUMN_NAME']}'>{$option['COLUMN_NAME']}</option>";
}

echo "  </select> 
    </div>  
    
    
    ";      

echo "    <div class='formSeleccion'>
                <select name='Dato2'>
                
        ";


while ($option2 = mysqli_fetch_array($query3)) {
    echo "<option value='{$option2['COLUMN_NAME']}'>{$option2['COLUMN_NAME']}</option>";
}

echo "  </select> 
    </div>  
    
    ";      
        
echo"              
                <div class='formSeleccion'>
                <input type='submit' name='Buscar' value ='Buscar'>
                </div>  
                <input type='hidden' name='csrf_token' value='"; 
                echo $token;
                echo "'>
               <div class='formSeleccion'>
                 <input type='submit' name='EditarDatos' value ='Editar Datos' class='EditarDatos'>
               </div>
        </div>
        
        </form>
        <div class='container'>";
//Se comprueba si se ha hecho click en buscar y si los desplegables estan seleccionados y se rellena la galeria con los datos de la base de datos
if(isset($_POST['Dato1']) && isset($_POST['Dato2']) && isset($_POST['Buscar'])){
    $dato1= $_POST['Dato1'];
    $dato2= $_POST['Dato2'];
    $query =mysqli_query($conn, "SELECT {$dato1}, {$dato2}, foto FROM carros;")
   or die (mysqli_error($conn));
   while($row = mysqli_fetch_array($query)){
    echo "
        <div class='box'>
                
                <img class='imagenCarro' src='{$row[2]}'>
                <h2 class='galeria'>$dato1:</h2>
                <p class='galeria'>{$row[0]}</p>
                <h2 class='galeria'>$dato2:</h2>
                <p class='galeria'>{$row[1]}</p>
        </div>";
      
    }
    
}

//Se cierran las divs que contienen las tablas y se genera el codigo html del footer           
echo "</div>
        <br>
        <br>
        <footer>
            <div class='container'>
                <div>
                    <h2>About</h2>
                    <ul class='about'>
                        <li><a href='https://github.com/AlbertoArostegui/TrabajoSGSSI'>Sobre Nosotros</a></li>
                        <li><a href='#Tablas'>Monoplazas</a></li>
                        <li><a href='#Top'>Home</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </body>";


?>
