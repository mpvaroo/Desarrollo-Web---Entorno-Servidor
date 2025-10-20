
<html>
    <head>
        <meta charset="UTF-8">
        <title>Años bisisestos</title>
    </head>
    <body>
        <?php
        $anio = 2028;

        if ($anio % 4 == 0 && ($anio % 100 != 0 || $anio % 400 == 0)){
            echo "$anio es un año bisiesto<br>";
            
        }else{
            echo "$anio no es un año bisiesto<br>";
        }
        ?>
    </body>
</html>

