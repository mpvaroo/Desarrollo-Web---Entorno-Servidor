<html>
    <head>
        <meta charset="UTF-8">
        <title>Suma de los 100</title>
    </head>
    <body>
        <?php
        $num= 1;
        $suma = 0;

        do {
           $suma += $num;
           
           $num++;
        } while ($num <= 100);

        echo $suma . " es la suma de todos los numeros enteros del 1 al 100";
        ?>
    </body>
</html>
