<?php

if (!isset($_COOKIE['dni'])) {
    echo "<p>No hay sesión iniciada.</p>";
    exit;
}

$cookieUltimo = $_COOKIE['dni'];

if (!isset($_COOKIE[$cookieUltimo])) {

    echo "<p>Bienvenido, es la 1ª vez que accedes a este lugar "
        . $_COOKIE['nombre'] . " "
        . $_COOKIE['apellidos'] . "</p>";
} else {

    echo "<p>Bienvenido "
        . $_COOKIE['nombre'] . " "
        . $_COOKIE['apellidos']
        . ", tu última sesión fue el "
        . date("d/m/Y H:i:s", $_COOKIE[$cookieUltimo])
        . "</p>";
}


setcookie($_COOKIE['dni'], time(), time() + (3600 * 24 * 30)); 

?>
<input type="button" value="Login" onclick="location.href='login.php'">