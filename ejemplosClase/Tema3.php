<?php

try {
    $bd = "mysql:host=localhost;dbname=dwes;charset=utf8mb4";
    $opciones = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_CASE => PDO::CASE_LOWER);
    $conex = new PDO($bd, 'dwes', 'abc123.', $opciones);
    $conex->beginTransaction();
    $reg1 = $conex->exec("UPDATE stock set unidades= 200 WHERE producto = '3DSNG'");
    $reg2 = $conex->exec("UPDATE stock set unidades= 500 WHERE producto = 'ACERAX3950'");
    if ($reg1 === 0) echo "noooooooooooooooooooooooooooooooooooo";
    if ($reg2 === 0) echo "no";
    $conex->commit();
} catch (PDOException $ex) {
    $conex->rollback();
    echo $ex->getMessage();
    print_r($ex->errorInfo);
}

