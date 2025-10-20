<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contar Elementos de un Array</title>
</head>
<body>

<?php
$animales = array("gato", "perro" , "elefante" , "jirafa");

echo "Tus animales al principio son: ";
var_dump(count($animales));


array_push($animales, "puma", "pantera");

echo "<br> </br>";
echo "Tus animales ahora son: ";
var_dump(count($animales));

?>
</body>
</html>

