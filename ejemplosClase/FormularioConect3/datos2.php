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
    ?>

     <form action="confirmar.php" method="POST">
       Nº Matricula: <input type="text" name="matricula"><br>
       Curso: <input type="text" name="curso"><br>
       Precio: <input type="text" name="precio"><br>

        <input type="hidden" name="nombre" value="<?php echo $_POST['nombre']; ?>">
        <input type="hidden" name="apellido" value="<?php echo $_POST['apellido']; ?>">
        <input type="hidden" name="idiomas" value="<?php echo $_POST['idiomas']; ?>">
         <input type="submit" name="enviar" value="Siguiente">
    </form>
    <?php
 }else{
    echo "no has enviado nada";
 }
    ?>
</body>
</html>