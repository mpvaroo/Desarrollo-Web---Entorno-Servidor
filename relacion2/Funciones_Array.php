<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Funciones Array</title>
    </head>
    <body>

        <?php
        echo "El array original es: ";
        $nombres = array("Ana", "Luis", "Carlos", "Maria");
        print_r($nombres);

        echo "<br></br>";
        $inverso = array_reverse($nombres);

        echo "El array inverso es: ";
        print_r($inverso);

        echo "<br></br>";

        if (in_array("Carlos", $nombres)) {
            echo "Sí, Carlos estan en el array";
        } else {
            echo "No, Carlos no se encuentra en el array";
        }

        echo "<br></br>";

        array_push($nombres, "Juan");
        echo " El array con el nuevo nombre es: "
        ;
        foreach ($nombres as $nombre) {
            echo $nombre . ", ";
        }
        ?>


    </body>
</html>

