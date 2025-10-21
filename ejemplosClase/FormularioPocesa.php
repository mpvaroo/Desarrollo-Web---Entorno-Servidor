<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Formulario Procesa</title>
    </head>
    <body>
        <?php

// Helper para escapar salida
        function e($str) {
            return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
        }

        if (!isset($_POST['enviar'])): // Mostrar formulario si NO se envió aún
            ?>
            <form action="<?= e($_SERVER['PHP_SELF']) ?>" method="POST">
                Nombre:   <input type="text" name="nombre"> <br>
                Apellido: <input type="text" name="apellido"> <br>

                Módulos: <br>
                <label><input type="checkbox" name="modulos[]" value="DWES"> Desarrollo web entorno servidor</label><br>
                <label><input type="checkbox" name="modulos[]" value="DWEI"> Desarrollo web entorno cliente</label><br>
                <label><input type="checkbox" name="modulos[]" value="DIW"> Desarrollo interfaces web</label><br>

                <input type="submit" name="enviar" value="Enviar">

                <br><br>
                <a href="opciones.php?n=1">Opción 1</a><br>
                <a href="opciones.php?n=2">Opción 2</a><br>
                <a href="opciones.php?n=3">Opción 3</a><br>
            </form>

            <?php
        else: // Procesar envío
            $nom = $_POST['nombre'] ?? '';
            $apell = $_POST['apellido'] ?? '';
            $mods = $_POST['modulos'] ?? []; // ojo: sin corchetes al leer

            if ($nom === '' || $apell === '') {
                echo "Faltan datos obligatorios (nombre y apellido).<br>";
                echo '<a href="' . e($_SERVER['PHP_SELF']) . '">Volver al formulario</a>';
            } else {
                echo "Datos recibidos<br><br>";
                echo "Nombre: " . e($nom) . "<br>";
                echo "Apellido: " . e($apell) . "<br>";

                if (!empty($mods)) {
                    echo "Módulos seleccionados:<br>";
                    foreach ($mods as $valor) {
                        echo "- " . e($valor) . "<br>";
                    }
                } else {
                    echo "No seleccionaste módulos.<br>";
                }
            }
        endif;
        ?>
    </body>
</html>
