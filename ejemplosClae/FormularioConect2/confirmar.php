<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <?php
    if (isset($_POST['enviar'])) {
        echo "datos recibidos<br>";
        echo "Nombre: " . $_POST['nombre'] . "<br>";
        echo "Apellido: " . $_POST['apellido'] . "<br>";
        echo "Dirección: " . $_POST['direccion'] . "<br>";
        echo "Nº Tarjeta: " . $_POST['tarjeta'] . "<br>";

        } else {
        echo "No has enviado el formulario<br>";
        echo "<a href= datos.php>Datos</a><br>";
    }


    ?>
     <form action="datos.php" method="POST">
        <input type="hidden" name="nombre" value="<?php echo $_POST['nombre']; ?>">
        <input type="hidden" name="apellido" value="<?php echo $_POST['apellido']; ?>">
        <input type="hidden" name="direccion" value="<?php echo $_POST['direccion']; ?>">
        <input type="hidden" name="tarjeta" value="<?php echo $_POST['tarjeta']; ?>">
        <input type="submit" name="enviar" value="Cancelar">
    </form>

       <form action="datos.php" method="POST">

        <input type="submit" name="enviar" value="Confirmar">
    </form>

 
</body>
</html>