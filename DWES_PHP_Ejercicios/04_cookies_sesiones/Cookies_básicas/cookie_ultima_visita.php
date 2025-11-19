<?php
date_default_timezone_set("Europe/Madrid"); // ✅ Asegura la hora correcta

setcookie("micookie", time(), time() + (3600 * 24 * 30));

if (!isset($_COOKIE["micookie"])) {
    echo "Bienvenido a tu primera vez en esta página";
} else {
    $ultimaVisita = date("d/m/Y H:i:s", $_COOKIE['micookie']);
    echo "La última vez que entraste en esta página fue el $ultimaVisita";
}
?>
