<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Matriz $_SERVER</title>
</head>
<body>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th style="color: red;">Indice</th>
        <th style="color: red;">Columna</th>
    </tr>

    <?php
    foreach ($_SERVER as $ind => $valor) {
        echo "<tr>";
        echo "<td style='color:red;'><strong>$ind</strong></td>";
        echo "<td>$valor</td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>
