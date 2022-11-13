<html>
<?php
    if(session_status() == 0) {
        session_start();
    }
    
?>

<head>
    <title>HyperLAND</title>
    <link rel="icon" href="images/F1Sprite.png">
    <link rel="stylesheet" href="styles/styleIndex2.css">
    <script defer src='scripts/index2.js'></script>
</head>
<div id="menu">
    <div id="menu-items">
        <a href="/" class="menu-item">Home</a>
        <a href="/" class="menu-item">About Us</a>
        <a href="/" class="menu-item">Single-Seaters</a>
        <a href="/signUp2.php" class="menu-item">Login</a>

    </div>
    <div id="menu-background-pattern"></div>
    <div id="menu-background-image"></div>
</div>    
</html>
