<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Creacion de elementos y acceso</title>
</head>
<body>

<?php
$colores = array("rojo", "verde" , "azul" , "amarillo");

echo "El primer color es ".$colores[0]. " y el tercer color es ".$colores[2] ;


array_push($colores, "naranja");

echo "<br> </br>";

echo "Tus colores ahora son: ";
foreach ($colores as $color) {
   echo $color." ";
}
?>
</body>
</html>

