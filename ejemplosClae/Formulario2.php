<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Validar Datos Formulario 2</title>
    </head>
    <body>

        <?php
        // Si se ha enviado el formulario
        if (isset($_POST['enviar'])) {

            // Validar datos
            $errores = [];

            if (empty($_POST['nombre'])) {
                $errores['nombre'] = "El nombre no puede estar vacío.";
            }

            if (empty($_POST['apellido'])) {
                $errores['apellido'] = "El apellido no puede estar vacío.";
            }

            if (empty($_POST['sexo'])) {
                $errores['sexo'] = "Debes seleccionar un sexo.";
            }

            if (empty($_POST['estado'])) {
                $errores['estado'] = "Debes seleccionar un estado civil.";
            }

            // Validar edad
            if (!isset($_POST['edad']) || $_POST['edad'] === '') {
                $errores['edad'] = "Debes introducir tu edad.";
            } else {
                if (!is_numeric($_POST['edad']) || intval($_POST['edad']) != $_POST['edad']) {
                    $errores['edad'] = "La edad debe ser un número entero.";
                } else {
                    if ((int) $_POST['edad'] < 18) {
                        $errores['edad'] = "Debes ser mayor de edad.";
                    }
                    if ((int) $_POST['edad'] > 120) {
                        $errores['edad'] = "Edad no válida.";
                    }
                }
            }

            if (empty($_POST['aficiones'])) {
                $errores['aficiones'] = "Debes seleccionar al menos una afición.";
            }

            if (empty($_POST['estudios'])) {
                $errores['estudios'] = "Debes seleccionar tu nivel de estudios.";
            }

            if (empty($_POST['provincia'])) {
                $errores['provincia'] = "Debes seleccionar una provincia.";
            }

            // Si no hay errores, procesar formulario
            if (empty($errores)) {

                echo "<h2>Datos del formulario</h2>";
                echo "Nombre: " . $_POST['nombre'] . "<br>";
                echo "Apellidos: " . $_POST['apellido'] . "<br>";
                echo "Sexo: " . $_POST['sexo'] . "<br>";
                echo "Estado Civil: " . $_POST['estado'] . "<br>";

                if (!empty($_POST['estudios'])) {
                    echo "Estudios:<br>";
                    foreach ($_POST['estudios'] as $a) {
                        echo $a . "<br>";
                    }
                }

                echo "Edad: " . $_POST['edad'] . "<br>";
                echo "Provincia: " . $_POST['provincia'] . "<br>";

                if (!empty($_POST['aficiones'])) {
                    echo "Aficiones:<br>";
                    foreach ($_POST['aficiones'] as $a) {
                        echo $a . "<br>";
                    }
                }

                echo '<br><a href="">Volver al formulario</a>';
            }
        }

        // Mostrar el formulario solo si NO se ha enviado o hay errores
        if (!isset($_POST['enviar']) || !empty($errores)) {
            ?>

            <form action="" method="POST">

                Nombre:
                <input type="text" name="nombre" value="<?= isset($_POST['nombre']) ? $_POST['nombre'] : '' ?>">
                <?php if (isset($errores['nombre'])) echo "<span style='color:red'>" . $errores['nombre'] . "</span>"; ?>
                <br><br>

                Apellido:
                <input type="text" name="apellido" value="<?= isset($_POST['apellido']) ? $_POST['apellido'] : '' ?>">
                <?php if (isset($errores['apellido'])) echo "<span style='color:red'>" . $errores['apellido'] . "</span>"; ?>
                <br><br>

                Sexo:
                <label><input type="radio" name="sexo" value="Hombre" <?= isset($_POST['sexo']) && $_POST['sexo'] === 'Hombre' ? 'checked' : '' ?>> Hombre</label>
                <label><input type="radio" name="sexo" value="Mujer" <?= isset($_POST['sexo']) && $_POST['sexo'] === 'Mujer' ? 'checked' : '' ?>> Mujer</label>
                <?php if (isset($errores['sexo'])) echo "<span style='color:red'>" . $errores['sexo'] . "</span>"; ?>
                <br><br>

                Estado Civil:
                <label><input type="radio" name="estado" value="Soltero" <?= isset($_POST['estado']) && $_POST['estado'] === 'Soltero' ? 'checked' : '' ?>> Soltero</label>
                <label><input type="radio" name="estado" value="Casado" <?= isset($_POST['estado']) && $_POST['estado'] === 'Casado' ? 'checked' : '' ?>> Casado</label>
                <label><input type="radio" name="estado" value="Otro" <?= isset($_POST['estado']) && $_POST['estado'] === 'Otro' ? 'checked' : '' ?>> Otro</label>
                <?php if (isset($errores['estado'])) echo "<span style='color:red'>" . $errores['estado'] . "</span>"; ?>
                <br><br>

                Edad:
                <input type="number" name="edad" value="<?= isset($_POST['edad']) ? $_POST['edad'] : '' ?>">
                <?php if (isset($errores['edad'])) echo "<span style='color:red'>" . $errores['edad'] . "</span>"; ?>
                <br><br>

                Aficiones:
                <?php if (isset($errores['aficiones'])) echo "<span style='color:red'>" . $errores['aficiones'] . "</span>"; ?>
                <br>
                <label><input type="checkbox" name="aficiones[]" value="Cine" <?= isset($_POST['aficiones']) && in_array('Cine', (array) $_POST['aficiones']) ? 'checked' : '' ?>> Cine</label>
                <label><input type="checkbox" name="aficiones[]" value="Lectura" <?= isset($_POST['aficiones']) && in_array('Lectura', (array) $_POST['aficiones']) ? 'checked' : '' ?>> Lectura</label>
                <label><input type="checkbox" name="aficiones[]" value="TV" <?= isset($_POST['aficiones']) && in_array('TV', (array) $_POST['aficiones']) ? 'checked' : '' ?>> TV</label><br>
                <label><input type="checkbox" name="aficiones[]" value="Deporte" <?= isset($_POST['aficiones']) && in_array('Deporte', (array) $_POST['aficiones']) ? 'checked' : '' ?>> Deporte</label>
                <label><input type="checkbox" name="aficiones[]" value="Música" <?= isset($_POST['aficiones']) && in_array('Música', (array) $_POST['aficiones']) ? 'checked' : '' ?>> Música</label>
                <br><br>

                Estudios:
                <select name="estudios[]" multiple size="5">
                    <option value="ESO" <?= isset($_POST['estudios']) && in_array('ESO', (array) $_POST['estudios']) ? 'selected' : '' ?>>ESO</option>
                    <option value="Bachillerato" <?= isset($_POST['estudios']) && in_array('Bachillerato', (array) $_POST['estudios']) ? 'selected' : '' ?>>Bachillerato</option>
                    <option value="C.F.G.M." <?= isset($_POST['estudios']) && in_array('C.F.G.M.', (array) $_POST['estudios']) ? 'selected' : '' ?>>C.F.G.M.</option>
                    <option value="C.F.G.S." <?= isset($_POST['estudios']) && in_array('C.F.G.S.', (array) $_POST['estudios']) ? 'selected' : '' ?>>C.F.G.S.</option>
                    <option value="Universidad" <?= isset($_POST['estudios']) && in_array('Universidad', (array) $_POST['estudios']) ? 'selected' : '' ?>>Universidad</option>
                </select>
                <?php if (isset($errores['estudios'])) echo "<span style='color:red'>" . $errores['estudios'] . "</span>"; ?>
                <br><br>

                Provincia:
                <select name="provincia">
                    <option value="">-- Selecciona tu provincia --</option>
                    <option value="Almería" <?= isset($_POST['provincia']) && $_POST['provincia'] === 'Almería' ? 'selected' : '' ?>>Almería</option>
                    <option value="Cádiz" <?= isset($_POST['provincia']) && $_POST['provincia'] === 'Cádiz' ? 'selected' : '' ?>>Cádiz</option>
                    <option value="Córdoba" <?= isset($_POST['provincia']) && $_POST['provincia'] === 'Córdoba' ? 'selected' : '' ?>>Córdoba</option>
                    <option value="Granada" <?= isset($_POST['provincia']) && $_POST['provincia'] === 'Granada' ? 'selected' : '' ?>>Granada</option>
                    <option value="Huelva" <?= isset($_POST['provincia']) && $_POST['provincia'] === 'Huelva' ? 'selected' : '' ?>>Huelva</option>
                    <option value="Jaén" <?= isset($_POST['provincia']) && $_POST['provincia'] === 'Jaén' ? 'selected' : '' ?>>Jaén</option>
                    <option value="Málaga" <?= isset($_POST['provincia']) && $_POST['provincia'] === 'Málaga' ? 'selected' : '' ?>>Málaga</option>
                    <option value="Sevilla" <?= isset($_POST['provincia']) && $_POST['provincia'] === 'Sevilla' ? 'selected' : '' ?>>Sevilla</option>
                </select>
                <?php if (isset($errores['provincia'])) echo "<span style='color:red'>" . $errores['provincia'] . "</span>"; ?>
                <br><br>

                <input type="submit" name="enviar" value="Enviar">
            </form>

            <?php
        }
        ?>

    </body>
</html>
