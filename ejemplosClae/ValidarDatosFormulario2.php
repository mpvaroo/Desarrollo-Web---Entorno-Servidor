<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Validar Datos Formulario (Modelo basado en esquema)</title>
    </head>
    <body>

        <?php
// Paso 1: ¿Se ha enviado el formulario?
        if (isset($_POST['enviar'])) {

            // Paso 2: Validar datos

            if (empty($_POST['nombre'])) {
                $errores['nombre'] = "El nombre no puede estar vacío.";
            }

            if (empty($_POST['apellido'])) {
                $errores['apellido'] = "El apellido no puede estar vacío.";
            }

            if (empty($_POST['modulos'])) {
                $errores['modulos'] = "Debes seleccionar al menos un módulo.";
            }

            // Paso 3: Si NO hay errores → procesar formulario
            if (empty($errores)) {
                echo "<h2>Datos del formulario</h2>";
                echo "Nombre: " . $_POST['nombre'] . "<br>";
                echo "Apellidos: " . $_POST['apellido'] . "<br>";
                echo "Módulos:<br>";
                foreach ($_POST['modulos'] as $modulo) {
                    echo $modulo . "<br>";
                }
                echo '<br><a href="">Volver al formulario</a>';

                // Paso 4: Si hay errores → mostrar formulario con datos corregidos
            } else {
                mostrarFormulario($_POST, $errores);
            }

// Paso 5: Si no se ha enviado → mostrar formulario en blanco
        } else {
            mostrarFormulario();
        }

// ---- Función para mostrar el formulario ---- //
        function mostrarFormulario($datos = [], $errores = []) {
            ?>
            <form action="" method="POST">
                Nombre:
                <input type="text" name="nombre" value="<?= isset($datos['nombre']) ? $datos['nombre'] : '' ?>">
                <?php if (isset($errores['nombre'])) echo "<span style='color:red'> {$errores['nombre']} </span>"; ?>
                <br><br>

                Apellido:
                <input type="text" name="apellido" value="<?= isset($datos['apellido']) ? $datos['apellido'] : '' ?>">
                <?php if (isset($errores['apellido'])) echo "<span style='color:red'> {$errores['apellido']} </span>"; ?>
                <br><br>

                Módulos:
                <?php if (isset($errores['modulos'])) echo "<span style='color:red'> {$errores['modulos']} </span>"; ?>
                <br>

                <label><input type="checkbox" name="modulos[]" value="DWES" <?= isset($datos['modulos']) && in_array("DWES", $datos['modulos']) ? "checked" : "" ?>> Desarrollo web entorno servidor</label><br>
                <label><input type="checkbox" name="modulos[]" value="DWEI" <?= isset($datos['modulos']) && in_array("DWEI", $datos['modulos']) ? "checked" : "" ?>> Desarrollo web entorno cliente</label><br>
                <label><input type="checkbox" name="modulos[]" value="DIW" <?= isset($datos['modulos']) && in_array("DIW", $datos['modulos']) ? "checked" : "" ?>> Desarrollo interfaces web</label><br><br>

                <input type="submit" name="enviar" value="Enviar">
            </form>
            <?php
        }
        ?>

    </body>
</html>
