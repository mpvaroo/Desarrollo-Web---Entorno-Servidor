<form action="" method="POST">
    DNI: <input type="text" name="dni"><br>
    Nombre: <input type="text" name="nombre"><br>
    Apellidos: <input type="text" name="apellidos"><br>
    Salario: <input type="text" name="sal"><br>
    Idiomas:<br>
    <input type="checkbox" name="idiomas[]" value="1">Español<br>
    <input type="checkbox" name="idiomas[]" value="2">Inglés<br>
    <input type="checkbox" name="idiomas[]" value="4">Alemán<br>
    <input type="checkbox" name="idiomas[]" value="8">Chino<br>
    <select multiple="" name="estudios[]">
        <option value="eso">ESO</option>
        <option value="bachillerato">Bachillerato</option>
        <option value="cfgm">CFGM</option>
        <option value="cfgs">CFGS</option>
    </select><br>
    Usuario: <input type="text" name="usu"><br>
    Claves: <input type="text" name="pass"><br>
    <input type="submit" name="insertar" value="Insertar">
    <input type="submit" name="recuperar" value="Recuperar">
</form>

<?php
if (isset($_POST['insertar'])) {
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "empleados");
        $conex->set_charset("utf8mb4");
        $idio = 0;

        foreach ($_POST["idiomas"] as $value) {
            $idio += $value;
        }
        $estudios = implode(",", $_POST["estudios"]);
        $conex->query("INSERT INTO datos VALUES('$_POST[dni]','$_POST[nombre]', '$_POST[apellidos]',$_POST[sal],$idio,'$estudios', '$_POST[usu]', '$_POST[pass]')");
    } catch (mysqli_sql_exception $exc) {
        $msg = "Fallo en la conexión";
        $error = true;
        echo $exc->getMessage();
    }
}

if (isset($_POST['recuperar'])) {
    try {
        $conex = new mysqli("localhost", "dwes", "abc123.", "empleados");
        $conex->set_charset("utf8mb4");
        $idio = 0;

        $result = $conex->query("SELECT * FROM datos");

        if ($result->num_rows) {
            while ($fila = $result->fetch_object()) {
                echo "DNI:" . $fila->DNI . "<br>";
                echo "Nombre:" . $fila->Nombre. "<br>";
                echo "Apellidos:" . $fila->Apellido. "<br>";
                echo "Salario:" . $fila->Salario. "<br>";
                echo "Idomas:" . $fila->idiomas. "<br>";
                echo "Estudios:" . $fila->estudios. "<br>";
                echo "Usuario:" . $fila->usuario. "<br>";
                echo "Password:" . $fila->password. "<br>" . "<br>";    

            }

        } else {
            echo "No hay na";
        }
    } catch (mysqli_sql_exception $exc) {
        echo $exc->getMessage();
    }
}


?>