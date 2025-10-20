<html>
    <head>
        <meta charset="UTF-8">
        <title>Sumna Numeros Oares</title>
    </head>
    <body>
        <?php
        $suma = 0;

        for ($num = 0; $num <= 100; $num++) {

            if ($num % 2 == 0){
                 $suma += $num; 
            }
        }

        echo $suma . " es la suma de todos los numeros pares del 1 al 100";
        ?>
    </body>
</html>
