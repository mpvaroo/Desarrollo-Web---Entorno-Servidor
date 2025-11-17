<?php

try {
    $opciones = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_LOWER
    ];

    $conex = new PDO(
        "mysql:host=localhost;dbname=encriptacion;charset=utf8mb4",
        "dwes",
        "abc123.",
        $opciones
    );
} catch (PDOException $ex) {
    echo "Fallo al crear la conexión: " . $ex->getMessage();
    exit;
}

// 👉 Primero, si has pulsado "Registrarme", redirigimos
if (isset($_POST['Registrarme'])) {
    header("Location: registro.php");
    exit;
}

if (isset($_POST['Acceder'])) {

    try {

        $result = $conex->query("SELECT * FROM usuarios WHERE email = '$_POST[email]'");

        if ($result->rowCount() == 0) {
            $error_mail = "El email introducido no existe en la base de datos";
        } else {

            $datos = $result->fetchObject();

            if (password_verify($_POST['pass'], $datos->pass)) {

                setcookie("dni", $datos->dni);
                setcookie("nombre", $datos->nombre);
                setcookie("apellidos", $datos->apellido);
                setcookie("correo", $datos->email);
                setcookie("contraseña", $datos->pass);

                if (isset($_POST['recuerdame'])) {
                    setcookie("rec_email", $_POST['email'], time() + 60 * 10);
                    setcookie("rec_pass",  $_POST['pass'],  time() + 60 * 10);
                    setcookie("rec_check", "1",             time() + 60 * 10);
                } else {
                    setcookie("rec_email", "", time() - 3600);
                    setcookie("rec_pass",  "", time() - 3600);
                    setcookie("rec_check", "", time() - 3600);
                }

                header("Location: index.php");
                exit;
            } else {
                $error_pass = "La contraseña introducida no es la correcta";
            }
        }
    } catch (PDOException $ex) {
        echo "Fallo: " . $ex->getMessage();
    }
}

?>

<form action="" method="POST">
    <br>Email:
    <input type="text" name="email" value="<?php
    if (!empty($_COOKIE['rec_email'])) {
        echo $_COOKIE['rec_email'];
    } elseif (!empty($_POST['email'])) {
        echo $_POST['email'];
    }
    ?>">

    <br>Contraseña:
    <input type="text" name="pass" value="<?php
    if (!empty($_COOKIE['rec_pass'])) {
        echo $_COOKIE['rec_pass'];
    } elseif (!empty($_POST['pass'])) {
        echo $_POST['pass'];
    }
    ?>">

    <br><label>
        <input type="checkbox" name="recuerdame" <?php
        if (!empty($_COOKIE['rec_check']) || !empty($_POST['recuerdame'])) {
            echo 'checked';
        }
        ?>>
        Recuérdame
    </label><br>

    <br><input type="submit" name="Acceder" value="Acceder">
    <input type="submit" name="Registrarme" value="Registro">
</form>

<?php
if (!empty($error_mail)) {
    echo "<p style='color:red;'>$error_mail</p>";
}

if (!empty($error_pass)) {
    echo "<p style='color:red;'>$error_pass</p>";
}

if (isset($_GET['msg']) && $_GET['msg'] === "ok"){
    echo "<p style=color:green>Usuario registrado correctamente</p>";
}
?>