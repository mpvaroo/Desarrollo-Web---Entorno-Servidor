<form action="" method="POST">
    Nombre del Jugador: <input type="text" name="nombredeljugador"><br>
    DNI: <input type="text" name="dni"><br>
    Dorsal: <input type="text" name="dorsal"><br>
    <select multiple="" name="posicion[]">
        <option value="portero">Portero</option>
        <option value="defensa">Defensa</option>
        <option value="centrocampista">Centro Campista</option>
        <option value="delantero">Delantero</option>
    </select><br>
    Equipo: <input type="text" name="equipo"><br>
    Numero de goles: <input type="text" name="numerodegoles"><br>
    <input type="submit" name="insertar" value="Insertar">
</form>

<?php
 $errores = [];
 // Validaciones
  if ($datos['nombredeljugador'] === '') {
        $errores['nombredeljugador'] = "El nombre no puede estar vacío.";
    } elseif (!preg_match('/^[a-zA-Z]+$/', $datos['nombredeljugador'])) {
        $errores['nombredeljugador'] = "El nombre solo puede contener letras.";
    }

if (isset($_POST['insertar'])) {
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "jugadores_db");
        $conex->set_charset("utf8mb4");
        $posicion = implode(",", $_POST['posicion']);
        $conex->query("INSERT INTO datos VALUES('$_POST[nombredeljugador]','$_POST[dni]','$_POST[dorsal]','$posicion','$_POST[equipo]','$_POST[numerodegoles]')");
    } catch (mysqli_sql_exception $e) {
        die("<p style='color:red;'><b>Error de conexión:</b> " . $e->getMessage() . "</p>");
    }
}
