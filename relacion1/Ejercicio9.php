<html>
    <head>
        <meta charset="UTF-8">
        <title>Ordenar tres números</title>
    </head>
    <body>
        <?php
        $num1 = 254;
        $num2 = 78;
        $num3 = 505;
        if ($num1 < $num2) {
            $aux = $num1;
            $num1 = $num2;
            $num2 = $aux;
        }


        if ($num1 < $num3) {
            $aux = $num1;
            $num1 = $num3;
            $num3 = $aux;
        }


        if ($num2 < $num3) {
            $aux = $num2;
            $num2 = $num3;
            $num3 = $aux;
        }


        echo "Los números ordenados de mayor a menor son: $num1, $num2, $num3";
        ?>
    </body>
</html>
