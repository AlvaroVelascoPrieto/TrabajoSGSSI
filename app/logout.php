<?php
ini_set('display_errors','off');
session_set_cookie_params($httponly= true, $samesite='Strict');
session_start(); //asegurar que se esta usando la misma sesion
session_destroy(); //destruirla sesion
header("location:index.php"); //readirigir de vuelta a index.php
exit();
?>
