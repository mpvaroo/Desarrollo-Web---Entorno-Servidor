<html>
    <head>
        <meta charset="UTF-8">
        <title>Valor Máximo</title>
    </head>
    <body>
        <?php
        $num1 = 24;
        $num2 = 25;
        $num3 = 1234;

        if ($num1 > $num2) {
            $numMax = $num1;
        } else {
            $numMax = $num2;
        }


        if ($num3 > $numMax) {
            $numMax = $num3;
        }


        echo $numMax . " es el número máximo";
        ?>
    </body>
</html>
