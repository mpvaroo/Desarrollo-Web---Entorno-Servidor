<?php

echo "Estas en opciones<br>";
if($_GET["n"]== 1){
    echo "Estas en la opcion 1";
}elseif ($_GET["n"]== 2){
    echo "Estas en la opcion 2";
} else {
echo "Estas en la opcion 3";    
}

?>