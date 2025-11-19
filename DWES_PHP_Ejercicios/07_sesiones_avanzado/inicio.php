<?php
session_start();
if (isset($_SESSION['user'])) {
    echo "<p>Hola "
        . $_SESSION['nombre'] . " "
        . $_SESSION['apellidos'];
}

if (isset($_POST["verDatos"])) {
    header("Location: datos.php");
    exit;
}


setcookie('PHPSESSID', $_COOKIE['PHPSESSID'], time() + 3600, "/");
if (isset($_POST["salir"])) {
    setcookie(session_name(), "", time() - 3600, "/");
    session_destroy();
    header("Location: index.php");
    exit;
}




?>
<form action="" method="POST">
    <br><input type="submit" name="modificarDatos" value="modificarDatos">
    <input type="submit" name="verDatos" value="verDatos">
    <input type="submit" name="salir" value="salir">
</form>