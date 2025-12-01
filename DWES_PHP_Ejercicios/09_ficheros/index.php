<?php

if (isset($_POST["enviar"])) {
    var_dump($_FILES["foto"]);
    echo "Nombre original:". $_FILES['foto']['name']."<br>";
    echo "Nombre temporal:". $_FILES['foto']['tmp_name']."<br>";
    echo "Tamaño:". $_FILES['foto']['size']."<br>";
    echo "Tipo:". $_FILES['foto']['type']."<br>";
    echo "Error:". $_FILES['foto']['error']."<br>";

    if (is_uploaded_file($_FILES['foto']['tmp_name'])){ //controla si se ha subido el fichero o no 
        echo "Hola";
    }else{
        echo "ERROR:" . $_FILES['foto']['error'];
        if($_FILES['foto']['error'] == 0){
            echo "<br>El fichero supera el limite permitido";
        }
    }

}


?>

<form action="" method="POST" enctype="multipart/form-data">
    Nombre: <input type="text" name="nombre"><br>
    Imagen: <input type="file" name="foto"><br>
    <input type="submit" name="enviar" value="Enviar">
    <input type="submit" name="mostrar" value="Mostrar">
</form>