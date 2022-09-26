<?php
  echo '<head>
        <title>HyperLAND</title>
        <link rel="stylesheet" href="styles.css">
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



$query = mysqli_query($conn, "SELECT * FROM usuarios")
   or die (mysqli_error($conn));


   echo "<body>
        <nav>
            <ul class='topnav' id='dropdownClick'>
                <li><a href='#home'>Home</a></li>
                <li><a href='#news'>News</a></li>
                <li><a href='#contact'>Contact</a></li>
                <li><a href='#about'>About</a></li>
                <li class='topnav-right'><a href='#singup'>Sign Up</a></li>
                <li class='topnav-right'><a href='#signin'>Sign In</a></li>
                <li class='dropdownicon' onclick='dropdownMenu()'><a href='script.js:void(0)'>	
&#9776;</a></li>
            </ul>
        </nav>
        <div class='container'>
            <div class='logincontainer'>
                <h1>F1 content - made for fans</h1>
                <h2>Username</h2>
                <input class='usernameinput' type='password' placeholder='Username'>
                <h2>Password</h2>
                <input class='passwordinput' type='password' placeholder='Password'>
                <br>
                <br>
                <button class='submitbutton'>Submit</button>
                <script type='text/javascript' src='script.js'></script>
            </div>
            <div class='videocontainer'>
                <iframe width='560' height='315' src='https://www.youtube.com/embed/kpHJxA-wnXg' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
            </div>
        </div>
        <h1 class='galerytitle'>Ultimos articulos</h1>
        <div class='container'>";

while ($row = mysqli_fetch_array($query)) {
 
  echo "<div class='box'>
                <div class='icon'>
                    <img class='alpinelogo' src='Alo_logo.png'>
                </div>
                <br>
                <label>{$row['nombre']}</label>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.  
                </p>
            </div>";
   
             
}
                     
echo "</div>
        <br>
        <br>
        <footer>
            <div class='container'>
                <div>
                    <h2>Company</h2>
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
                    <h2>Products</h2>
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
