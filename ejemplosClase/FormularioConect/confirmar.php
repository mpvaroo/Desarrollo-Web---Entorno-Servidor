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
        echo "Nº matricula: " . $_POST['matricula'] . "<br>";
        echo "Curso: " . $_POST['curso'] . "<br>";
        echo "Precio: " . $_POST['precio'] . "<br>";
    } else {
        echo "No has enviado el formulario<br>";
        echo "<a href= datos.php>Datos</a><br>";
    }




    ?>
</body>
</html>