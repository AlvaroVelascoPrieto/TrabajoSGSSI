<?php
  if(isset($_POST['EditarDatos'])){
    header("Location:ModificarTablas.php");
    exit;
  }

  echo '<head>
        <title>HyperLAND</title>
        <link rel="stylesheet" href="styles/styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Roboto:wght@500&display=swap" rel="stylesheet">
    </head>';
    
  // phpinfo();
  $hostname = "db";
  $username = "admin";
  $password = "test";
  $db = "database";

  $conn = mysqli_connect($hostname,$username,$password,$db);
  if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
  }



$query = mysqli_query($conn, "SELECT nombreAp FROM usuarios")
   or die (mysqli_error($conn));
$query2 = mysqli_query($conn, "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_NAME`='carros';")
   or die (mysqli_error($conn));
$query3 = mysqli_query($conn, "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_NAME`='carros';")
   or die (mysqli_error($conn));
   


   echo "<body>
        <nav>
            <ul class='topnav' id='dropdownClick'>
                <li><a href='#home'>Home</a></li>
                <li><a href='#news'>News</a></li>
                <li><a href='#contact'>Contact</a></li>
                <li><a href='#about'>About</a></li>
                <li class='topnav-right'><a href='signUp.php'>Sign Up</a></li>
                <li class='topnav-right'><a href='signIn.php'>Sign In</a></li>
                <li class='dropdownicon' onclick='dropdownMenu()'><a href='script.js:void(0)'>  
&#9776;</a></li>
            </ul>
        </nav>
        
        <h1 class='galerytitle'>MONOPLAZAS</h1>
        <form action='' method='post'>
        <div class='containerSeleccion'>
            <div class='formSeleccion'>
                <h2>Selecciona 2 datos a visualizar:</h2>
            </div>  
            <div class='formSeleccion'>
                <select name='Dato1'>
                
        ";


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
               <div class='formSeleccion'>
                 <input type='submit' name='EditarDatos' value ='Editar Datos' class='EditarDatos'>
               </div>
        </div>
        </form>
        <div class='container'>";

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

                     
echo "</div>
        <br>
        <br>
        <footer>
            <div class='container'>
                <div>
                    <h2>Compan</h2>
                    <ul class='company'>
                        <li>About</li>
                        <li>Blogs</li>
                        <li>Careers</li>
                    </ul>
                </div>
                <div>
                    <h2>About</h2>
                    <ul class='about'>
                        <li>About</li>
                        <li>Blogs</li>
                        <li>Careers</li>
                    </ul>
                </div>
                <div>
                    <h2>Product</h2>
                    <ul class='products'>
                        <li>About</li>
                        <li>Blogs</li>
                        <li>Careers</li>
                    </ul>
                </div>
                
            </div>
        </footer>
        
        
        
    
    </body>";


?>
