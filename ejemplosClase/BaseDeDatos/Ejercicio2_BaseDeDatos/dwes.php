<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      body{font-family:Arial, sans-serif; margin:20px}
      table{border-collapse:collapse; margin-top:16px}
      th, td{border:1px solid #ccc; padding:8px 10px}
      th{background:#f5f5f5}
    </style>
</head>
<body>
    <?php
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "dwes");
        $conex->set_charset("utf8mb4");

        // Cargamos los nombres cortos para el select (tal y como tenías)
        $resultado = $conex->query("SELECT nombre_corto FROM producto")->fetch_all(MYSQLI_ASSOC);
        ?>

        <h1>Ejercicio: Conjunto de resultados en MySQLi</h1>

        <form action="" method="POST">
            Producto:
            <select name="origen">
                <?php
                // Si ya enviaron algo, lo recordamos
                $seleccion = isset($_POST['origen']) ? $_POST['origen'] : '';
                foreach ($resultado as $fila) {
                    $valor = $fila['nombre_corto'];
                    $sel = ($seleccion === $valor) ? "selected" : "";
                    echo "<option value='" . htmlspecialchars($valor, ENT_QUOTES, 'UTF-8') . "' $sel>" .
                          htmlspecialchars($valor, ENT_QUOTES, 'UTF-8') . "</option>";
                }
                ?>
            </select>
            <input type="submit" name="boton" value="Mostrar stock">
        </form>

        <h2>Stock del producto en las tiendas:</h2>

        <?php
        if (isset($_POST["boton"])) {
            // 1) Tomamos el producto elegido (nombre_corto)
            $productoElegido = $conex->real_escape_string($_POST['origen']);

            // 2) Consulta simple: todas las tiendas y unidades del producto elegido.
            //    Usamos LEFT JOIN para que salgan también tiendas con 0.
            $sql = "
                SELECT 
                    t.cod   AS cod_tienda,
                    t.nombre AS tienda,
                    COALESCE(s.unidades, 0) AS unidades
                FROM tienda t
                LEFT JOIN stock s 
                    ON s.tienda = t.cod
                LEFT JOIN producto p
                    ON p.cod = s.producto
                   AND p.nombre_corto = '$productoElegido'
                ORDER BY t.nombre
            ";

            $resStock = $conex->query($sql);

            if ($resStock && $resStock->num_rows > 0) {
                echo "<p><strong>Producto:</strong> " . htmlspecialchars($productoElegido, ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<table>";
                echo "<tr><th>Código tienda</th><th>Tienda</th><th>Unidades</th></tr>";
                while ($fila = $resStock->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($fila['cod_tienda'], ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>" . htmlspecialchars($fila['tienda'], ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>" . (int)$fila['unidades'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No hay datos de tiendas o de stock.</p>";
            }
        }
        ?>

        <?php
    } catch (mysqli_sql_exception $ex) {
        echo "<br>Código: " . $ex->getcode() . " Error: " . $ex->getMessage() . "<br>";
    }
    if (isset($conex)) { $conex->close(); }
    ?>
</body>
</html>
