<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Matriz</title>
</head>
<body>

<?php
$array = array(
    "Ventas" => array(
        "Nombre" => "Maria",
        "Apellido" => "Martinez",
        "Salario" => 1600,
        "Edad" => 25
    ),
    "Marketing" => array(
        "Nombre" => "Juan",
        "Apellido" => "Martinez",
        "Salario" => 1630,
        "Edad" => 35
    ),
    "Dirección" => array(
        "Nombre" => "Pedro",
        "Apellido" => "Porro",
        "Salario" => 1800,
        "Edad" => 45
    ),
    "Contabilidad" => array(
        "Nombre" => "Pablo",
        "Apellido" => "Barrios",
        "Salario" => 1452,
        "Edad" => 55
    ),
    "Informática" => array(
        "Nombre" => "Laura",
        "Apellido" => "Lopezca",
        "Salario" => 1425,
        "Edad" => 28
    )
);

// Crear tabla
echo "<table border='1' cellspacing='0' cellpadding='5'>";

// Encabezados
echo "<tr>";
echo "<th>Departamento</th>";
foreach ($array["Ventas"] as $indice => $valor) {
    echo "<th>$indice</th>";
}
echo "</tr>";

// Filas
foreach ($array as $departamento => $fila) {
    echo "<tr>";
    echo "<td><b>$departamento</b></td>";
    foreach ($fila as $valor) {
        echo "<td>$valor</td>";
    }
    echo "</tr>";
}

echo "</table>";
?>

</body>
</html>
