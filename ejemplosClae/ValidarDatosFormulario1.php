<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Formulario Procesa</title>
    </head>
    <body>
        <?php
        if (isset($_POST['enviar'])) {
            if (!empty($_POST['nombre'] && !empty($_POST['apellido'] && !empty($_POST['modulos'])))) {
                echo "Nombre: " . $_POST['nombre'] . "<br>";
                echo "Apellidos: " . $_POST['apellido'] . "<br>";
                echo "Modulos:<br>";
                foreach ($_POST['modulos'] as $valor) {
                    echo $valor . "<br>";
                }
                echo '<br> <a href="">Volver al formulario</a>';
            } else {
                ?>
                <form action="" method="POST">
                    Nombre: <input type="text" name="nombre" value="<?php if (!empty($_POST['nombre'])) echo $_POST['nombre']; ?>"><?php if (empty($_POST['nombre'])) echo"<span style= color:red>El nombre no puede estar vacio</span>"; ?>
                    <br>
                    Apellido: <input type="text" name="apellido" value="<?php if (!empty($_POST['apellido'])) echo $_POST['apellido']; ?>"><?php if (empty($_POST['apellido'])) echo"<span style= color:red>El apellido no puede estar vacio</span>"; ?>
                    <br>
                    Modulos: <?php if (empty($_POST['modulos'])) echo"<span style= color:red>Debes seleccionar al menos un modulo</span>"; ?><br>

                    <label><input type="checkbox" name="modulos[]" value="DWES"<?php if (isset($_POST['modulos']) && in_array("DWES", $_POST['modulos'])) echo "checked" ?>> Desarrollo web entorno servidor</label><br>
                    <label><input type="checkbox" name="modulos[]" value="DWEI" <?php if (isset($_POST['modulos']) && in_array("DWEI", $_POST['modulos'])) echo "checked" ?>> Desarrollo web entorno cliente</label><br>
                    <label><input type="checkbox" name="modulos[]" value="DIW" <?php if (isset($_POST['modulos']) && in_array("DIW", $_POST['modulos'])) echo "checked" ?>> Desarrollo interfaces web</label><br>

                    <input type="submit" name="enviar" value="Enviar">
                </form>
                <?php
            }
        } else {
            ?>

            <form action="" method="POST">
                Nombre:   <input type="text" name="nombre"><br>
                Apellido: <input type="text" name="apellido"><br>

                Módulos: <?php if (empty($_POST['modulos']))  ?>
                <br>

                <label><input type="checkbox" name="modulos[]" value="DWES"> Desarrollo web entorno servidor</label><br>
                <label><input type="checkbox" name="modulos[]" value="DWEI"> Desarrollo web entorno cliente</label><br>
                <label><input type="checkbox" name="modulos[]" value="DIW"> Desarrollo interfaces web</label><br>

                <input type="submit" name="enviar" value="Enviar">
            </form>

            <?php
        } // cierre del else principal
        ?>
    </body>
</html>
