<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Eliminar Elementos Array</title>
    </head>
    <body>

        <?php
        echo "El array original es: ";
        $paises = array("España", "Francia",
            "Italia", "Alemania", "Portugal");
        foreach ($paises as $pais) {
            echo $pais . ", ";
        }

        echo "<br></br>";
        echo "El nuevo array con Italia eliminada: ";
        unset($paises[2]);
        foreach ($paises as $pais) {
            echo $pais . ", ";
        }

        echo "<br></br>";
        echo "El nuevo array con el ultimo pais eliminado: ";
        array_pop($paises);
        foreach ($paises as $pais) {
            echo $pais . ", ";
        }
        ?>


    </body>
</html>

