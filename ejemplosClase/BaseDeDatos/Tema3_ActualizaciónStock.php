<?php
/*
====================================================================
TIENDA · Versión con PDO — CÓDIGO COMENTADO PASO A PASO
====================================================================
Este programa en PHP permite mostrar y actualizar el stock de productos
en diferentes tiendas. Usa una base de datos MySQL llamada "dwes".

Se usa PDO (PHP Data Objects), que es la forma moderna y segura
de conectarse y trabajar con bases de datos en PHP.
====================================================================
*/

try {
    // -----------------------------
    // 🔹 1) CREAR LA CONEXIÓN A LA BASE DE DATOS CON PDO
    // -----------------------------
    // $dsn (Data Source Name) indica el tipo de base de datos (mysql),
    // el servidor (localhost), la base de datos (dwes)
    // y el conjunto de caracteres (utf8mb4).
    $dsn = "mysql:host=localhost;dbname=dwes;charset=utf8mb4";

    // $opciones define cómo se comportará el objeto PDO.
    $opciones = [
        // PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        // ⚙️ Indica que, si ocurre un error, PDO lanzará una excepción (error controlado)
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

        // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        // ⚙️ Indica que, al obtener resultados de una consulta,
        // cada fila se devolverá como un "objeto" (en lugar de array).
        // Ejemplo: $fila->nombre en lugar de $fila['nombre']
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,

        // PDO::ATTR_EMULATE_PREPARES => false
        // ⚙️ Desactiva la “emulación” de sentencias preparadas y usa
        // las reales del motor MySQL. Es más seguro frente a inyecciones SQL.
        PDO::ATTR_EMULATE_PREPARES => false
    ];

    // 🔹 Creamos el objeto de conexión ($conex)
    // $conex es una instancia (objeto) de la clase PDO.
    // Sus parámetros son:
    // 1. $dsn → la información del servidor y base de datos
    // 2. usuario → "dwes"
    // 3. contraseña → "abc123."
    // 4. $opciones → configuración extra
    $conex = new PDO($dsn, "dwes", "abc123.", $opciones);

    // Si llega aquí, la conexión ha sido exitosa.
} catch (PDOException $e) {
    // Si falla la conexión, se captura la excepción y se muestra el error.
    die("<p style='color:red;'><b>Error de conexión:</b> " . $e->getMessage() . "</p>");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda</title>
    <!-- Enlace a la hoja de estilos (opcional) -->
    <link href="dwes.css" rel="stylesheet">
</head>
<body>

<div id="encabezado">
    <h1>Tienda</h1>

    <!-- ==========================
         FORMULARIO PRINCIPAL
         ==========================
         Muestra un menú desplegable (select) con los productos.
         Cuando se elige uno y se pulsa “Mostrar”, se envía el formulario.
    -->
    <form method="post">
        <select name="productos" required>
            <option value="" hidden>Selecciona un producto</option>
            <?php
            try {
                // 🔹 Consulta SQL para obtener todos los productos (código y nombre corto)
                // $conex->query() ejecuta la consulta directamente.
                // → Devuelve un objeto de tipo PDOStatement.
                $productos = $conex->query("SELECT cod, nombre_corto FROM producto ORDER BY nombre_corto")->fetchAll();
                // 🔹 fetchAll() → recoge TODAS las filas del resultado en un array.
                // Cada fila será un OBJETO porque definimos PDO::FETCH_OBJ antes.
                // Por eso podemos acceder a sus propiedades como $p->cod o $p->nombre_corto.

                // 🔹 Recorremos cada producto con un bucle foreach.
                foreach ($productos as $p) {
                    // $p es un OBJETO que representa una fila de la tabla "producto".
                    // Ejemplo de acceso: $p->cod obtiene el código de producto.

                    // Comprobamos si el producto fue seleccionado anteriormente.
                    $selected = (isset($_POST['productos']) && $_POST['productos'] === $p->cod) ? 'selected' : '';

                    // Creamos cada opción del <select>.
                    // value → el código del producto (ej. "3DSNG")
                    // texto → el nombre corto visible (ej. "Nintendo 3DS")
                    echo "<option value='".$p->cod."' $selected>".$p->nombre_corto."</option>";
                }
            } catch (PDOException $e) {
                // Si hay error en la consulta, se muestra un mensaje.
                echo "<option disabled>Error al cargar productos</option>";
                echo "<p style='color:red;'>" . $e->getMessage() . "</p>";
            }
            ?>
        </select>

        <!-- Botón que envía el formulario -->
        <input type="submit" name="mostrar" value="Mostrar">
    </form>
</div>

<div id="contenido">
<?php
/*
====================================================================
3️⃣ ACTUALIZAR STOCK
====================================================================
Este bloque se ejecuta cuando se pulsa el botón “Actualizar”.
Cada formulario de tienda envía:
  - nuevo_stock (el número introducido)
  - tienda (el código de la tienda)
  - producto (el código del producto)
====================================================================
*/
if (isset($_POST['actualizar'])) {
    try {
        // 🔹 Creamos una consulta preparada con 3 placeholders (?)
        // Los ? se sustituirán luego por valores reales de forma segura.
        $stmt = $conex->prepare("
            UPDATE stock 
            SET unidades = ? 
            WHERE tienda = ? 
              AND producto = ?
        ");
        // 🔹 $stmt es un objeto PDOStatement, representa la sentencia preparada.
        // prepare() no ejecuta la consulta todavía, solo la “prepara”.

        // 🔹 execute([...]) → ejecuta la sentencia reemplazando los ? por los valores del array.
        // Orden:
        // 1. nuevo_stock (convertido a entero)
        // 2. tienda
        // 3. producto
        $stmt->execute([(int)$_POST['nuevo_stock'], $_POST['tienda'], $_POST['producto']]);

        // 🔹 Si no ocurre ningún error, mostramos mensaje de confirmación.
        echo "<p><b>Stock actualizado correctamente.</b></p>";

        // 🔹 Después de actualizar, queremos volver a mostrar los resultados.
        // Cambiamos los valores de $_POST para que se ejecute el bloque “mostrar”.
        $_POST['mostrar']   = true;
        $_POST['productos'] = $_POST['producto'];
    } catch (PDOException $e) {
        // Si algo falla (por ejemplo, error de SQL o conexión),
        // se muestra un mensaje de error en pantalla.
        echo "<p style='color:red;'><b>Error al actualizar stock:</b> " . $e->getMessage() . "</p>";
    }
}

/*
====================================================================
4️⃣ MOSTRAR STOCK DEL PRODUCTO SELECCIONADO
====================================================================
Este bloque muestra las tiendas que tienen el producto elegido
y sus respectivas unidades (stock disponible).
====================================================================
*/
if (isset($_POST['mostrar'])) {
    try {
        // 🔹 Creamos la sentencia SELECT con un marcador (?) para el producto.
        $stmt = $conex->prepare("
            SELECT t.cod, t.nombre, s.unidades
            FROM tienda t
            INNER JOIN stock s ON t.cod = s.tienda
            WHERE s.producto = ?
            ORDER BY t.nombre
        ");

        // 🔹 Ejecutamos la consulta sustituyendo el ? por el valor de $_POST['productos']
        $stmt->execute([$_POST['productos']]);

        // 🔹 fetchAll(PDO::FETCH_OBJ) obtiene todas las filas y las devuelve como un array de objetos.
        // Cada objeto ($fila) tiene 3 propiedades: ->cod, ->nombre, ->unidades
        $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);

        // 🔹 Si el array está vacío, el producto no tiene stock en ninguna tienda.
        if (!$resultados) {
            echo "No hay stock para este producto.";
        } else {
            // 🔹 Recorremos cada tienda y mostramos un pequeño formulario para modificar su stock.
            foreach ($resultados as $fila) {
                // $fila->nombre  → nombre de la tienda
                // $fila->unidades → unidades disponibles
                // $fila->cod     → código de la tienda

                echo "
                <form method='post' style='margin:8px 0;'>
                    <b>Tienda:</b> ".$fila->nombre." — 
                    <label><b>Stock:</b></label>
                    <!-- Campo para escribir el nuevo número de unidades -->
                    <input type='number' name='nuevo_stock' value='".(int)$fila->unidades."' style='width:60px;' min='0'>

                    <!-- Datos ocultos que identifican el producto y la tienda -->
                    <input type='hidden' name='producto' value='".$_POST['productos']."'>
                    <input type='hidden' name='tienda' value='".$fila->cod."'>

                    <!-- Botón que envía el formulario (ejecutará el bloque de actualización arriba) -->
                    <input type='submit' name='actualizar' value='Actualizar'>
                </form>";
            }
        }
    } catch (PDOException $e) {
        // Si hay un error en la consulta SELECT, se muestra en pantalla.
        echo "<p style='color:red;'><b>Error al mostrar datos:</b> " . $e->getMessage() . "</p>";
    }
}
?>
</div>

<div id="pie">
    <!-- Pie de página (texto fijo al final) -->
    <p>Aplicación Tienda DWES</p>
</div>

</body>
</html>
