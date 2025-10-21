<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario</title>
</head>
<body>
    <form action="Procesa.php" method="POST">
        
        Nombre: <input type="text" name="nombre"> <br>
        Apellido: <input type="text" name="apellido"> <br>
        Modulos: <br>
        <input type="checkbox" name="Modulos[]" value="DWES">Desarrollo web entorno servidor<br>
        <input type="checkbox" name="Modulos[]" value="DWEI">Desarrollo web entorno cliente<br>
        <input type="checkbox" name="Modulos[]" value="DIW">Desarrollo interfaces web<br>
        <input type="submit" name="enviar" value="Enviar">
        
        
        
        <a href="opciones.php?n=1">Opcion 1</a><br>
        <a href="opciones.php?n=2">Opcion 2</a><br>
        <a href="opciones.php?n=3">Opcion 3</a><br>

        <?php
        
        ?>
    </form>
 

</body>
</html>
