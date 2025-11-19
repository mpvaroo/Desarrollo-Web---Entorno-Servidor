<?php


if (!isset($_COOKIE['intentos'])) {
    setcookie("intentos", 3, time() + 3600, "/");
}


try {
    $opciones = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_LOWER
    ];

    $conex = new PDO(
        "mysql:host=localhost;dbname=tema4_logueo;charset=utf8mb4",
        "dwes",
        "abc123.",
        $opciones
    );
} catch (PDOException $ex) {
    echo "Fallo al crear la conexión: " . $ex->getMessage();
    exit;
}


if (isset($_POST['registro'])) {
    header("Location: registro.php");
    exit;
}


if (isset($_POST['login'])) {


    if ($_COOKIE['intentos'] <= 0) {
        header("Location: intentos.php"); 
        exit;
    }

    try {

        $result = $conex->query("SELECT * FROM perfil_usuario WHERE user = '$_POST[user]'");


        if ($result->rowCount() == 0) {

            $error_user = "El user introducido no existe en la base de datos";


            $resta = $_COOKIE['intentos'] - 1;
            setcookie("intentos", $resta, time() + 3600, "/");

        } else {

            $datos = $result->fetchObject();


            if (password_verify($_POST['pass'], $datos->pass)) {

                session_start();

                $_SESSION['nombre'] = $datos->nombre;
                $_SESSION['apellidos'] = $datos->apellidos;
                $_SESSION['direccion'] = $datos->direccion;
                $_SESSION['localidad'] = $datos->localidad;
                $_SESSION['user'] = $datos->user;
                $_SESSION["pass"] =  $datos->pass;
                $_SESSION['color_letra'] = $datos->color_letra;
                $_SESSION['color_fondo'] = $datos->color_fondo;
                $_SESSION['tipo_letra'] = $datos->tipo_letra;
                $_SESSION['tam_letra'] = $datos->tam_letra;

                
                setcookie("intentos", 3, time() + 3600, "/");

                header("Location: inicio.php");
                exit;

            } else {

                
                $error_pass = "La contraseña introducida no es la correcta";

                $resta = $_COOKIE['intentos'] - 1;
                setcookie("intentos", $resta, time() + 3600, "/");
            }
        }

    } catch (PDOException $ex) {
        echo "Fallo: " . $ex->getMessage();
    }
}

?>



<form action="" method="POST">

    <br>Intentos disponibles -> <?= $_COOKIE['intentos'] ?>

    <br>Usuario:
    <input type="text" name="user" value="<?= isset($_POST['user']) ? $_POST['user'] : '' ?>">

    <br>Clave:
    <input type="password" name="pass" value="">

    <br><input type="submit" name="login" value="login">
    <input type="submit" name="registro" value="registro">

</form>

<?php
if (!empty($error_user)) {
    echo "<p style='color:red;'>$error_user</p>";
}

if (!empty($error_pass)) {
    echo "<p style='color:red;'>$error_pass</p>";
}

if (isset($_GET['msg']) && $_GET['msg'] === "ok") {
    echo "<p style=color:green>Usuario registrado correctamente</p>";
}
?>
