<?php
session_start();
if (isset($_SESSION['user'])) {
    echo "<p>Hola "
        . $_SESSION['nombre'] . " "
        . $_SESSION['apellidos'];


    echo "<p> Tus datos son: <br>".
    "Nombre: ".$_SESSION['nombre'] . "<br>".
    "Apellidos: ".$_SESSION['apellidos'] . "<br>".
    "Direccion: ".$_SESSION['direccion'] . "<br>".
    "Localidad: ".$_SESSION['localidad'] . "<br>".
    "Correo: ".$_SESSION['user'] . "<br>".
    "Contraseña Encriptada: ".$_SESSION["pass"] . "<br>".
    "Color de letra: ".$_SESSION['color_letra'] . "<br>".
    "Color de fondo: ".$_SESSION['color_fondo'] . "<br>".
    "Tipo de letra: ".$_SESSION['tipo_letra'] . "<br>".
    "Tamaño de letra: ".$_SESSION['tam_letra'] . "<br>";
}

if (isset($_POST["volver"])) {
    header("Location: inicio.php");
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
    <br>
    <input type="submit" name="volver" value="volver">
    <input type="submit" name="salir" value="salir">
</form>