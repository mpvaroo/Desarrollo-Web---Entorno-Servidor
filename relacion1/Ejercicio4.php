<html>
<head>
    <meta charset="UTF-8">
    <title>Tabla hasta el 35</title>
</head>
<body>
    <?php
    $num = 1;

    echo "<table border='1'>";

    for ($i = 0; $i < 5; $i++) { 
        echo "<tr>";
        for ($j = 0; $j < 7; $j++) { 
            echo "<td>$num</td>";
            $num++;
        }
        echo "</tr>";
    }

    echo "</table>";
    ?>
</body>
</html>
