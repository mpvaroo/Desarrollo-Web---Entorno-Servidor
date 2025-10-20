<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $dia = date("l");

        switch ($dia) {
            case 1;
                $d = "Lunes";
                break;
            case 2;
                $d = "Martes";
                break;
            case 3;
                $d = "Miercoles";
                break;
            case 4;
                $d = "Jueves";
                break;
            case 5;
                $d = "Viernes";
                break;
            case 6;
                $d = "Sabado";
                break;
            case 7;
                $d = "Domingo";
                break;
        }

        $mes = date("m");

        switch ($mes) {
            case 1;
                $m = "Enero";
                break;
            case 2;
                $m = "Febrero";
                break;
            case 3;
                $m = "Marzo";
                break;
            case 4;
                $m = "Abril";
                break;
            case 5;
                $m = "Mayo";
                break;
            case 6;
                $m = "Junio";
                break;
            case 7;
                $m = "Julio";
                break;
            case 8;
                $m = "Agosto";
                break;
            case 9;
                $m = "Septiembre";
                break;
            case 10;
                $m = "Octubre";
                break;
            case 11;
                $m = "Noviembre";
                break;
            case 12;
                $m = "Diciembre";
                break;
        }

        ?>
    </body>
</html>
