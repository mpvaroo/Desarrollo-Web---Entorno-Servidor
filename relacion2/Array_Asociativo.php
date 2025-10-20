<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Array Asociativo</title>
</head>
<body>

<?php
$persona = array(
        "Nombre" => "Juan",
        "Edad" => 25,
        "Ciudad" => "Madrid"
    );

echo "El nombre de esta persona es: ".$persona["Nombre"]. " y vive en: ".$persona["Ciudad"] ;

$persona["Profesion"] = "Ingeniero";

echo "<br> </br>";

echo "<table border='1' cellspacing='0' cellpadding='5'>";

foreach ($persona as $clave => $valor) {
        echo "<tr>";
        echo "<td><strong>$clave</strong></td>";
        echo "<td>$valor</td>";
        echo "</tr>";
    }
    
    echo "</table>";

?>
</body>
</html>


