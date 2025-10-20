<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ordenacion de arrays</title>
</head>
<body>

<?php
$numeros = array(3,1,4,1,5);

sort($numeros);

print_r($numeros);

echo "<br> </br>";

rsort($numeros);
print_r($numeros);
?>
</body>
</html>

