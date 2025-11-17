<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<?php
$errores = [];

if (isset($_POST['registrar'])) {

    // Nombre: no vacío y solo letras
    if (empty($_POST['nombre'])) {
        $errores['nombre'] = "El nombre no puede estar vacío.";
    } else {
        if (!preg_match('/^[A-Za-z]+$/', $_POST['nombre'])) {
            $errores['nombre'] = "El nombre solo puede contener letras.";
        }
    }

    // Apellido: no vacío y solo letras
    if (empty($_POST['apellido'])) {
        $errores['apellido'] = "El apellido no puede estar vacío.";
    } else {
        if (!preg_match('/^[A-Za-z]+$/', $_POST['apellido'])) {
            $errores['apellido'] = "El apellido solo puede contener letras.";
        }
    }

    // Contraseña: no vacía
    if (empty($_POST['pass'])) {
        $errores['pass'] = "La contraseña no puede estar vacía.";
    }

    // Correo: no vacío y formato válido
    if (empty($_POST['email'])) {
        $errores['email'] = "El correo no puede estar vacío.";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = "El correo no coincide con el formato.";
    }

    // DNI: 8 números + 1 letra
    if (empty($_POST['dni'])) {
        $errores['dni'] = "El DNI no puede estar vacío.";
    } else {
        if (!preg_match('/^[0-9]{8}[A-Za-z]$/', $_POST['dni'])) {
            $errores['dni'] = "El DNI debe tener 8 números y una letra (ej: 12345678A).";
        } else {
            // Comprobación en la base de datos: ¿ya existe el DNI?
            try {
                $conex = new mysqli("localhost", "dwes", "abc123.", "encriptacion");
                $conex->set_charset("utf8mb4");

                $consulta = $conex->query("SELECT dni FROM usuarios WHERE dni = '$_POST[dni]'");
                
                if ($consulta && $consulta->num_rows > 0) {
                    $errores['dni'] = "El DNI ya existe en otro jugador.";
                }

            } catch (mysqli_sql_exception $e) {
                die("<p style='color:red;'><b>Error de conexión:</b> " . $e->getMessage() . "</p>");
            }
        }
    }

    // Si no hay errores → Insertar
    if (empty($errores)) {
        try {
            $passwordBcrypt = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $result=$conex->query("INSERT INTO usuarios VALUES('$_POST[dni]','$_POST[nombre]','$_POST[apellido]','$_POST[email]','$passwordBcrypt')");

            header("Location: login.php?msg=ok");
            
        } catch (mysqli_sql_exception $e) {
            die("<p style='color:red;'><b>Error de inserción:</b> " . $e->getMessage() . "</p>");
        }
    }
}
?>

<form action="" method="POST">

    DNI:
    <input type="text" name="dni" value="<?php echo isset($_POST['dni']) ? $_POST['dni'] : ''; ?>">
    <?php if (isset($errores['dni'])) { ?>
        <span style="color:red"><?php echo $errores['dni']; ?></span>
    <?php } ?>
    <br>

    Nombre:
    <input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>">
    <?php if (isset($errores['nombre'])) { ?>
        <span style="color:red"><?php echo $errores['nombre']; ?></span>
    <?php } ?>
    <br>

    Apellidos:
    <input type="text" name="apellido" value="<?php echo isset($_POST['apellido']) ? $_POST['apellido'] : ''; ?>">
    <?php if (isset($errores['apellido'])) { ?>
        <span style="color:red"><?php echo $errores['apellido']; ?></span>
    <?php } ?>
    <br>

    Correo:
    <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
    <?php if (isset($errores['email'])) { ?>
        <span style="color:red"><?php echo $errores['email']; ?></span>
    <?php } ?>
    <br>

    Contraseña:
    <input type="text" name="pass" value="<?php echo isset($_POST['pass']) ? $_POST['pass'] : ''; ?>">
    <?php if (isset($errores['pass'])) { ?>
        <span style="color:red"><?php echo $errores['pass']; ?></span>
    <?php } ?>
    <br>

    <input type="submit" name="registrar" value="Registrar">
    <input type="button" value="Login" onclick="location.href='login.php'">

</form>

</body>
</html>
