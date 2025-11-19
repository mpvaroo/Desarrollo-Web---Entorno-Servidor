<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Tienda</title>
    <link href="dwes.css" rel="stylesheet">
</head>

<body>

    <?php
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "dwes");
        $conex->set_charset("utf8mb4");
    } catch (mysqli_sql_exception $e) {
        die("<p style='color:red;'><b>Error de conexión:</b> " . $e->getMessage() . "</p>");
    }
    ?>

    <div id="encabezado">
        <h1>Tienda</h1>
        <!-- Formulario principal -->
        <form method="post">
            <select name="productos">
                <option hidden>Selecciona un producto</option>
                <?php
                try {
                    $productos = $conex->query("SELECT * FROM producto");
                    while ($p = $productos->fetch_object()) {
                        echo "<option value='$p->cod'>$p->nombre_corto</option>";
                    }
                } catch (mysqli_sql_exception $e) {
                    echo "<option disabled>Error al cargar productos</option>";
                    echo "<p style='color:red;'>" . $e->getMessage() . "</p>";
                }
                ?>
            </select>
            <input type="submit" name="mostrar" value="Mostrar">
        </form>
    </div>

    <div id="contenido">
        <?php
        if (isset($_POST['actualizar'])) {
            try {
                $producto   = $_POST['producto'];
                $tienda     = $_POST['tienda'];
                $nuevoStock = (int)$_POST['nuevo_stock'];

                $stmt = $conex->prepare("UPDATE stock SET unidades = ? WHERE tienda = ? AND producto = ?");
                $stmt->bind_param("iss", $nuevoStock, $tienda, $producto);
                $stmt->execute();

                echo "<p><b>Stock actualizado correctamente.</b></p>";
                $_POST['mostrar'] = true; // mostrar de nuevo
            } catch (mysqli_sql_exception $e) {
                echo "<p style='color:red;'><b>Error al actualizar stock:</b> " . $e->getMessage() . "</p>";
            }
        }

        // --- Mostrar stock del producto seleccionado ---
        if (isset($_POST['mostrar'])) {
            try {
                $producto = $_POST['productos'];

                $stmt = $conex->prepare("
            SELECT tienda.cod, tienda.nombre, stock.unidades
            FROM tienda, stock
            WHERE tienda.cod = stock.tienda 
            AND stock.producto = ?
        ");
                $stmt->bind_param("s", $producto);
                $stmt->execute();
                $resultados = $stmt->get_result();

                if ($resultados->num_rows == 0) {
                    echo "No hay stock para este producto.";
                } else {
                    while ($fila = $resultados->fetch_object()) {
                        echo "
                <form method='post' style='margin:8px 0;'>
                    <b>Tienda:</b> $fila->nombre — 
                    <label><b>Stock:</b></label>
                    <input type='number' name='nuevo_stock' value='$fila->unidades' style='width:60px;'>
                    <input type='hidden' name='producto' value='$producto'>
                    <input type='hidden' name='tienda' value='$fila->cod'>
                    <input type='submit' name='actualizar' value='Actualizar'>
                </form>";
                    }
                }
            } catch (mysqli_sql_exception $e) {
                echo "<p style='color:red;'><b>Error al mostrar datos:</b> " . $e->getMessage() . "</p>";
            }
        }
        ?>
    </div>

    <div id="pie">
        <p>Aplicación Tienda DWES</p>
    </div>

</body>

</html>