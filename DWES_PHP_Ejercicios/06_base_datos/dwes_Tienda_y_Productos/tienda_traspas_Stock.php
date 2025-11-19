<?php
try {
    $conex = new mysqli("localhost", "dwes", "abc123.", "dwes");
    $conex->set_charset("utf8mb4");
    if (isset($_POST["boton"])) {
        if (!empty($_POST["origen"]) && !empty($_POST["destino"]) && !empty($_POST["codProd"]) && !empty($_POST["uds"])) {
            //$stock = $conex->query("SELECT p.nombre, x.unidades, x.nombre FROM producto p JOIN (SELECT * FROM stock s JOIN tienda t ON s.tienda=t.cod WHERE t.nombre='$origen') x ON p.cod=x.producto WHERE p.cod='$codProd'");
            //$stock = $stock->fetch_assoc();
            //$stock = $stock["unidades"];
            $stockOrigen = $conex->query("SELECT t1.unidades FROM producto p JOIN (SELECT * FROM stock s JOIN tienda t ON s.tienda=t.cod WHERE t.nombre='" . $_POST["origen"] . "') t1 ON p.cod=t1.producto WHERE p.cod='" . $_POST["codProd"] . "'")->fetch_assoc()["unidades"] ?? 0;
            $stockDestino = $conex->query("SELECT t1.unidades FROM producto p JOIN (SELECT * FROM stock s JOIN tienda t ON s.tienda=t.cod WHERE t.nombre='" . $_POST["destino"] . "') t1 ON p.cod=t1.producto WHERE p.cod='" . $_POST["codProd"] . "'")->fetch_assoc()["unidades"] ?? 0;
            $codigos = $conex->query("SELECT t1.cod FROM tienda t JOIN (SELECT s.tienda,p.cod FROM stock s JOIN producto p ON s.producto=p.cod) t1 ON t.cod=t1.tienda WHERE t.nombre='" . $_POST["origen"] . "'")->fetch_all(MYSQLI_ASSOC);
            $codEncontrado = false;
            foreach ($codigos as $fila) {
                if ($_POST["codProd"] == $fila['cod']) {
                    $codEncontrado = true;
                    break;
                }
            }
            if ($_POST["origen"] != $_POST["destino"] && $codEncontrado && is_numeric($_POST["uds"]) && $_POST["uds"] <= $stockOrigen && $stockDestino != 0) {
                $conex->query("UPDATE stock s JOIN tienda t ON s.tienda=t.cod SET s.unidades = s.unidades - " . $_POST["uds"] . " WHERE s.producto = '" . $_POST["codProd"] . "' AND t.nombre = '" . $_POST["origen"] . "'");
                $conex->query("UPDATE stock s JOIN tienda t ON s.tienda=t.cod SET s.unidades = s.unidades + " . $_POST["uds"] . " WHERE s.producto = '" . $_POST["codProd"] . "' AND t.nombre = '" . $_POST["destino"] . "'");
                echo "<h3 style=color:green>TRASPASO REALIZADO CORRECTAMENTE<h3>";
            } else if ($_POST["origen"] != $_POST["destino"] && $codEncontrado && is_numeric($_POST["uds"]) && $_POST["uds"] <= $stockOrigen && $stockDestino == 0) {
                $conex->query("UPDATE stock s JOIN tienda t ON s.tienda=t.cod SET s.unidades = s.unidades - " . $_POST["uds"] . " WHERE s.producto = '" . $_POST["codProd"] . "' AND t.nombre = '" . $_POST["origen"] . "'");
                $conex->query("INSERT INTO stock VALUES ('" . $_POST["codProd"] . "', (SELECT cod FROM tienda WHERE nombre='" . $_POST["destino"] . "'), " . $_POST["uds"] . ")");
                echo "<h3 style=color:green>TRASPASO REALIZADO CORRECTAMENTE<h3>";
            } else {
                echo "<h3 style=color:red>NO SE HA PODIDO COMPLETAR EL TRASPASO<h3>";
            }
        }
    }
    ?>
    <h3>TRASPASO STOCK</h3>
    <form action="" method="POST">
        Tienda Origen:
        <select name="origen">
            <option value="">Selecciona una tienda de origen</option>
            <option value="CENTRAL">CENTRAL</option>
            <option value="SUCURSAL1">SUCURSAL1</option>
            <option value="SUCURSAL2">SUCURSAL2</option>
        </select><br><br>
        Tienda Destino:
        <select name="destino">
            <option value="">Selecciona una tienda de destino</option>
            <option value="CENTRAL">CENTRAL</option>
            <option value="SUCURSAL1">SUCURSAL1</option>
            <option value="SUCURSAL2">SUCURSAL2</option>
        </select><br><br>
        Código producto: <input type="text" name="codProd"><br><br>
        Unidades: <input type="text" name="uds"><br><br>
        <input type="submit" name="boton" value="Traspasar">
    </form>
    <?php
} catch (mysqli_sql_exception $ex) {
    echo "<br>Código: " . $ex->getcode() . " Error: " . $ex->getMessage() . "<br>";
    //die("ERROR EN LA CONEXIÓN");
}
$conex->close();
?>