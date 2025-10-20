<html>
    <head>
        <meta charset="UTF-8">
        <title>Tabla hasta el 35</title>
    </head>
    <body>
        <?php
        $num = 1;
        $i = 0;

        echo "<table border='1'>";
        do {
            $j = 0;
            echo "<tr>";
            do {
                echo "<td>$num</td>";
                $num++;
                $j++;
            } while ($j < 7);
            echo "</tr>";
            $i++;
        } while ($i < 5);

        echo "</table>";
        ?>
    </body>
</html>
