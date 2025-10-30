<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda</title>
    <link href="dwes.css" rel="stylesheet">
</head>
<body>

<?php
// Conexión a la base de datos
$conex = new mysqli("localhost", "dwes", "abc123.", "dwes");
$conex->set_charset("utf8mb4");
?>

<div id="encabezado">
    <h1>Tienda</h1>
    <!-- Formulario principal -->
    <form method="post">
        <select name="productos">
            <option hidden>Selecciona un producto</option>
            <?php
            $productos = $conex->query("SELECT * FROM producto");
            while ($p = $productos->fetch_object()) {
                echo "<option value='$p->cod'>$p->nombre_corto</option>";
            }
            ?>
        </select>
        <input type="submit" name="mostrar" value="Mostrar">
    </form>
</div>

<div id="contenido">
<?php
// --- Si se ha pulsado "Actualizar" ---
if (isset($_POST['actualizar'])) {
    $producto = $_POST['producto'];
    $tienda   = $_POST['tienda'];
    $nuevoStock = (int)$_POST['nuevo_stock'];

    $conex->query("UPDATE stock 
                   SET unidades = $nuevoStock 
                   WHERE tienda = '$tienda' AND producto = '$producto'");

    echo "<p><b>Stock actualizado correctamente.</b></p>";
    $_POST['mostrar'] = true; // para volver a mostrar automáticamente
}

// --- Si se ha pulsado "Mostrar" ---
if (isset($_POST['mostrar'])) {
    $producto = $_POST['productos'];
    $resultados = $conex->query("
        SELECT tienda.cod, tienda.nombre, stock.unidades
        FROM tienda, stock
        WHERE tienda.cod = stock.tienda 
          AND stock.producto = '$producto'
    ");

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
}
?>
</div>

<div id="pie">
    <p>Aplicación Tienda DWES</p>
</div>

</body>
</html>
