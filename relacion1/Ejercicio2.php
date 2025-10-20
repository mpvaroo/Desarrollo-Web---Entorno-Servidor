<html>
    <head>
        <meta charset="UTF-8">
        <title>Tabla de Impares</title>
    </head>
    <body>
        <?php
        $num = rand(1, 100);

        if ($num % 2 == 0) {
            $num += 1;
        }

        echo "<table border='1'>";
        for ($i = 0; $i < 10; $i++) {
            echo "<tr>";
            for ($j = 0; $j < 10; $j++) {
                echo "<td>$num</td>";
                $num += 2;
            }
            echo "</tr>";
        }
        echo "</table>";

        ?>
    </body>
</html>
