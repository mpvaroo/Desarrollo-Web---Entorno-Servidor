<?php 
session_name('sessionVaro');
session_start();
echo $_SESSION['nombre'];
$_SESSION['nombre'] = "Antonio";
session_unset();
session_destroy();
setcookie('admin');
?>

<input type="button" value="Atras" onclick="location.href='sesion.php'">