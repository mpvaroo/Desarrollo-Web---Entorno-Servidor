<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Empleados: Datos e Idiomas</title>
</head>
<body>
  <h2>Empleado</h2>
  <form method="post">
    <label>DNI:</label>
    <input type="text" name="dni">

    <br><label>Nombre:</label>
    <input type="text" name="nombre">

    <br><label>Apellidos:</label>
    <input type="text" name="apellidos">

    <br><label>Salario (€):</label>
    <input type="number" name="salario" step="0.01">

    <h3>Idiomas:</h3>
    <label><input type="checkbox" name="idiomas[]" value="Ingles"> Inglés</label><br>
    <label><input type="checkbox" name="idiomas[]" value="Frances"> Francés</label><br>
    <label><input type="checkbox" name="idiomas[]" value="Aleman"> Alemán</label><br>
    <label><input type="checkbox" name="idiomas[]" value="Chino"> Chino</label><br>
    <label><input type="checkbox" name="idiomas[]" value="Portuges"> Portugués</label><br>

    <br><br>
    <button type="submit" name="accion" value="anadir">Añadir</button>
    <button type="submit" name="accion" value="buscar">Buscar</button>
  </form>
  <hr>

<?php
try {

    $conex = new mysqli('localhost', 'dwes', 'abc123.', 'empleados');
    $conex->set_charset('utf8mb4');

    if (!isset($_POST['accion'])) {
        exit;
    }

    $dni       = trim($_POST['dni'] ?? '');
    $nombre    = trim($_POST['nombre'] ?? '');
    $apellidos = trim($_POST['apellidos'] ?? '');
    $salario   = $_POST['salario'] ?? '';

    if ($dni === '') {
        echo "<p style='color:red'>DNI obligatorio.</p>";
        exit;
    }

    if ($_POST['accion'] === 'anadir') {
        $conex->autocommit(false);
        try {
            $stmt = $conex->prepare("INSERT INTO datos(dni, nombre, apellidos, salario) VALUES (?,?,?,?)");
            
            $stmt->bind_param("sssi", $dni, $nombre, $apellidos, $salario);
            $stmt->execute();
            $stmt->close();

            if (!empty($_POST['idiomas']) && is_array($_POST['idiomas'])) {
                $stmt = $conex->prepare("INSERT INTO idiomas(dni, idioma) VALUES (?, ?)");
                foreach ($_POST['idiomas'] as $idiomaSeleccionado) {
                    $idioma = trim($idiomaSeleccionado);
                    if ($idioma === '') continue;
                    $stmt->bind_param("ss", $dni, $idioma);
                    $stmt->execute();
                }
                $stmt->close();
            }
            $conex->commit();
            $conex->autocommit(true);

            echo "<p style='color:green'>Empleado e idiomas añadidos correctamente.</p>";

        } catch (Exception $e) {
            $conex->rollback();
            $conex->autocommit(true);
            throw $e;
        }

    } elseif ($_POST['accion'] === 'buscar') {
        $stmt = $conex->prepare("SELECT dni, nombre, apellidos, salario FROM datos WHERE dni = ?");
        $stmt->bind_param("s", $dni);
        $stmt->execute();
        $stmt->bind_result($dniDB, $nombreDB, $apellidosDB, $salarioDB);

        if ($stmt->fetch()) {
            echo "<h3>Datos del empleado</h3>";
            echo "DNI: " . htmlspecialchars($dniDB) . "<br>";
            echo "Nombre: " . htmlspecialchars($nombreDB) . "<br>";
            echo "Apellidos: " . htmlspecialchars($apellidosDB) . "<br>";
            echo "Salario: " . htmlspecialchars($salarioDB) . " €<br>";
        } else {
            echo "<p style='color:orange'>No se encontró el DNI.</p>";
        }
        $stmt->close();

        // 2) Idiomas del empleado
        $stmt = $conex->prepare("SELECT idioma FROM idiomas WHERE dni = ?");
        $stmt->bind_param("s", $dni);
        $stmt->execute();
        $stmt->bind_result($idiomaDB);

        $hayIdiomas = false;
        while ($stmt->fetch()) {
            if (!$hayIdiomas) {
                echo "<h4>Idiomas</h4>";
                echo "<table border='1'><tr><th>Idioma</th></tr>";
                $hayIdiomas = true;
            }
            echo "<tr><td>" . htmlspecialchars($idiomaDB) . "</td></tr>";
        }
        if ($hayIdiomas) echo "</table>";
        else echo "Sin idiomas registrados.";
        $stmt->close();
    }

} catch (Exception $e) {
    echo "<p style='color:red'><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
</body>
</html> 
