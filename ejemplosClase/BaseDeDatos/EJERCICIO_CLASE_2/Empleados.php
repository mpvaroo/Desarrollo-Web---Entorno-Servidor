<form action="" method="POST">
    usuario: <input type="text" name="usu"><br>
    Contraseña: <input type="text" name="pass"><br>
    <input type="submit" name="entrar" value="Entrar"><br>
</form>
<?php
if (isset($_POST['entrar'])) {
    /* try {
        $conex = new mysqli('localhost', 'dwes', 'abc123.', 'empleados');
        $conex->set_charset('utf8mb4');
        $resultados=$conex->query("SELECT * FROM datos WHERE usuario=BINARY'$_POST[usu]' AND password=BINARY'$_POST[pass]'");
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    if($resultados->num_rows){
        echo "Has entrado con exito";
    }else{
        echo "CREDENCIALES INCORRECTAS";
    } */


    try {
        $conex = new mysqli('localhost', 'dwes', 'abc123.', 'empleados');
        $conex->set_charset('utf8mb4');

        $stmt = $conex->prepare(
            "SELECT * 
             FROM datos 
             WHERE usuario = BINARY ? 
               AND password = BINARY ?"
        );

        $stmt->bind_param('ss', $_POST['usu'], $_POST['pass']);

        $stmt->execute();

        $res = $stmt->get_result();

        if ($res->num_rows) {
            echo "Has entrado con éxito";
        } else {
            echo "CREDENCIALES INCORRECTAS";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>