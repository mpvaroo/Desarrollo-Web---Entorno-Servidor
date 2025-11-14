<?php
setcookie("micookie", "antonio", time() + 60);
if (isset($_COOKIE["micookie"])) {
    echo $_COOKIE['micookie'];
}

?>

<a href="Ejercicio1.php">Volver atras</a>