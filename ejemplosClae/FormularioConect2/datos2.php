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

    ?>

     <form action="confirmar.php" method="POST">
       Dirección: <input type="text" name="direccion" value="<?= isset($_POST['direccion']) ? $_POST['direccion'] : '' ?>"><br>
       Nº Tarjeta: <input type="text" name="tarjeta" value="<?= isset($_POST['tarjeta']) ? $_POST['tarjeta'] : '' ?>"><br>

        <input type="hidden" name="nombre" value="<?php echo $_POST['nombre']; ?>">
        <input type="hidden" name="apellido" value="<?php echo $_POST['apellido']; ?>">
         <input type="submit" name="enviar" value="Siguiente">
    </form>

    <form action="datos.php" method="POST">
        <input type="hidden" name="nombre" value="<?php echo $_POST['nombre']; ?>">
        <input type="hidden" name="apellido" value="<?php echo $_POST['apellido']; ?>">
         <input type="submit" name="enviar" value="Atras">
    </form>
    <?php
 }else{
    echo "no has enviado nada";
 }
    ?>
</body>
</html>