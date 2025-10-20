<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Arrays Multidimensionales</title>
    </head>
    <body>

        <?php
        $productos = array(
            "producto1" => array("nombre" => "Pastillas", "precio" => 25, "cantidad" => 21),
            "producto2" => array("nombre" => "Iphone", "precio" => 1230, "cantidad" => 1),
            "producto3" => array("nombre" => "Nissan Skyline", "precio" => 500000, "cantidad" => 2)
        );

        echo "El segundo producto es un "
        . $productos["producto2"]["nombre"] . " y su precio son "
        . $productos["producto2"]["precio"] . " euros";

        echo "<br></br>";

        foreach ($productos as $codigo => $producto) {
            echo "<strong>Producto</strong>: $codigo <br>";
            foreach ($producto as $atributo => $valor) {
                echo "$atributo: $valor <br>";
            }
            echo "<br>";
        }
        ?>


    </body>
</html>

