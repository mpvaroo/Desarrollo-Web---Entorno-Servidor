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
          if (!empty($_POST['idiomas'])) {
                    echo "Idiomas:<br>";
                    foreach ($_POST['idiomas'] as $a) {
                        echo $a . "<br>";
                    }
                }
        echo "Nº matricula: " . $_POST['matricula'] . "<br>";
        echo "Curso: " . $_POST['curso'] . "<br>";
        echo "Precio: " . $_POST['precio'] . "<br>";

        } else {
        echo "No has enviado el formulario<br>";
        echo "<a href= datos.php>Datos</a><br>";
    }


    ?>
     <form action="datos.php" method="POST">
        <input type="hidden" name="nombre" value="<?php echo $_POST['nombre']; ?>">
        <input type="hidden" name="apellido" value="<?php echo $_POST['apellido']; ?>">
        <input type="hidden" name="idiomas" value="<?php echo $_POST['idiomas']; ?>">
        <input type="hidden" name="matricula" value="<?php echo $_POST['matricula']; ?>">
        <input type="hidden" name="curso" value="<?php echo $_POST['curso']; ?>">
        <input type="hidden" name="precio" value="<?php echo $_POST['precio']; ?>">
        <input type="submit" name="enviar" value="Cancelar">
    </form>

       <form action="datos.php" method="POST">

        <input type="submit" name="enviar" value="Confirmar">
    </form>

 
</body>
</html>