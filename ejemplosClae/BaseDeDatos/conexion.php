<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    /*
    $driver = new mysqli_driver();
    $driver->report_mode = 1;
    echo "Gestión de errores " . $driver->report_mode;
    if ($conex->connect_errno) {
        echo "Error: " . $conex->connect_errno . "-" . $conex->connect_error;
        die("Chao chao chao");
    }
    $conex->query("INSERT INTO datos (DNI,nombre,apellido,salario) VALUES ('11111111A','PEPE','LOPEZ',2500)");
    echo "<br> filas" . $conex->affected_rows;
*/
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "dwes");
        $conex->set_charset("utf8mb4");
        
    ?>
</body>
</html>