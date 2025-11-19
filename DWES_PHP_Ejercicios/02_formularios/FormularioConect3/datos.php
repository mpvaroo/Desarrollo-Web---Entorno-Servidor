<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    ?>
    <form action="datos2.php" method="POST">
        Nombre: <input type="text" name="nombre" value="<?= isset($_POST['nombre']) ? $_POST['nombre'] : '' ?>"><br>
        Apellido: <input type="text" name="apellido" value="<?= isset($_POST['apellido']) ? $_POST['apellido'] : '' ?>"><br>
        Idiomas:
        <br>
        <label><input type="checkbox" name="idiomas[]" value="Cine" <?= isset($_POST['idiomas']) && in_array('Ingles', (array) $_POST['aficiones']) ? 'checked' : '' ?>> Ingles</label><br>
        <label><input type="checkbox" name="idiomas[]" value="Lectura" <?= isset($_POST['idiomas']) && in_array('Frances', (array) $_POST['aficiones']) ? 'checked' : '' ?>> Frances</label><br>
        <label><input type="checkbox" name="idiomas[]" value="TV" <?= isset($_POST['idiomas']) && in_array('Aleman', (array) $_POST['aficiones']) ? 'checked' : '' ?>> Aleman</label><br>
        <label><input type="checkbox" name="idiomas[]" value="Deporte" <?= isset($_POST['idiomas']) && in_array('Ruso', (array) $_POST['aficiones']) ? 'checked' : '' ?>> Ruso</label><br>
        <input type="hidden" name="direccion" value="<?= isset($_POST['direccion']) ? $_POST['direccion'] : '' ?>"><br>
        <input type="hidden" name="tarjeta" value="<?= isset($_POST['tarjeta']) ? $_POST['tarjeta'] : '' ?>"><br>
        <input type="submit" name="enviar" value="Siguiente">
    </form>
</body>

</html>