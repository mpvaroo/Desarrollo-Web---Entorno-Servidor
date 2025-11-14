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

if (isset($_POST['Entrar'])) {

    // Encriptar la contraseña introducida
    $password = md5($_POST['pass']);

    try {

        // ⚠ IMPORTANTE: las comillas del email
        $result = $conex->query("SELECT * FROM usuarios WHERE email = '$_POST[email]'");

        // Si no existe el email
        if ($result->rowCount() == 0) {
            $error_mail = "El email introducido no existe en la base de datos";
        } 
        else {
            // Sacar el registro
            $datos = $result->fetchObject();

            // Comparar contraseñas
            if ($datos->pass == $password) {
            setcookie("dni", $datos->dni);
            setcookie("Nombre", $datos->nombre);
            setcookie("Apellidos", $datos->apellido);
            setcookie("Correo", $datos->email);
            setcookie("Contraseña", $datos->pass);

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
    <input type="text" name="email" value="<?php echo $_POST['email'] ?? '' ?>">

    <br>Contraseña: 
    <input type="text" name="pass" value="<?php echo $_POST['pass'] ?? '' ?>">

    <br><input type="submit" name="Entrar" value="Entrar">
</form>


<?php
// Mostrar errores si los hay
if (!empty($error_mail)) {
    echo "<p style='color:red;'>$error_mail</p>";
}

if (!empty($error_pass)) {
    echo "<p style='color:red;'>$error_pass</p>";
}
?>
