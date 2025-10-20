<html>
    <head>
        <meta charset="UTF-8">
        <title>Tabla hasta el 35</title>
    </head>
    <body>
        <?php
        $num = 1;
        $suma = 0;

        for ($i = 0; $i <= 99; $i++) {
            $suma += $num;
            $num++;
        }

        echo $suma . " es la suma de todos los numeros enteros del 1 al 100";
        ?>
    </body>
</html>
