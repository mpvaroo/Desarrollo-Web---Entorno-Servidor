<?php 
session_start();
if(isset($_SESSION['nombre'])){
    echo $_SESSION['nombre'];
}
?>

<input type="button" value="Login" onclick="location.href='datos.php'">