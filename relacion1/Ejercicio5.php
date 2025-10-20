<html>
    <head>
        <meta charset="UTF-8">
        <title>Tabla hasta el 35</title>
    </head>
    <body>
    <?php
    $num = 1;

    echo "<table border='1'>";
        $i = 0;
    while ($i < 5) { 
        echo "<tr>";
         $j = 0;
        while ( $j < 7) { 
            echo "<td>$num</td>";
            $num++;
            $j++;
        }
        echo "</tr>";
            $i++;
    }

    echo "</table>";
    ?>
    </body>
</html>
