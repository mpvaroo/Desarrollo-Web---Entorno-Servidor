<html>
    <head>
        <meta charset="UTF-8">
        <title>Suma Numeros Cuadrados</title>
    </head>
    <body>
        <?php
        $suma = 0;

        for ($num = 0; $num <= 100; $num++) {

            $suma += $num * $num;
        }

        echo $suma . " es la suma de todos los numeros enteros del 1 al 100 cuadrados ";
        ?>
    </body>
</html>

