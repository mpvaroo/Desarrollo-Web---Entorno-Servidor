<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_POST['enviar2'])) {
        echo "datos recibidos<br>";
        echo "Nombre: " . $_POST['nombre'] . "<br>";
        echo "Apellido: " . $_POST['apellido'] . "<br>";
        echo "Nº matricula: " . $_POST['matricula'] . "<br>";
        echo "Curso: " . $_POST['curso'] . "<br>";
        echo "Precio: " . $_POST['precio'] . "<br>";
    } elseif (isset($_POST['enviar'])) {
        ?>

        <form action="" method="POST">
            Nº Matricula: <input type="text" name="matricula"><br>
            Curso: <input type="text" name="curso"><br>
            Precio: <input type="text" name="precio"><br>

            <input type="hidden" name="nombre" value="<?php echo $_POST['nombre']; ?>">
            <input type="hidden" name="apellido" value="<?php echo $_POST['apellido']; ?>">
            <input type="submit" name="enviar2" value="Siguiente">
        </form>
        <?php
    } else {
        ?>
        <form action="" method="POST">
            Nombre: <input type="text" name="nombre"><br>
            Apellido: <input type="text" name="apellido"><br>
            <input type="submit" name="enviar" value="Siguiente">
        </form>

        <?php
    }
    ?>


</body>

</html>