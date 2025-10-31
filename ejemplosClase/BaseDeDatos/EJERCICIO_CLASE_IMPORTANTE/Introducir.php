<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Jugadores</title>
</head>
<body>

<?php
$errores = [];

if (isset($_POST['insertar'])) {
    // Nombre: no vacío y solo letras
    if (empty($_POST['nombredeljugador'])) {
        $errores['nombredeljugador'] = "El nombre no puede estar vacío.";
    } else {
        if (!preg_match('/^[A-Za-z]+$/', $_POST['nombredeljugador'])) {
            $errores['nombredeljugador'] = "El nombre solo puede contener letras.";
        }
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
                $conex = new mysqli("localhost", "dwes", "abc123.", "jugadores_db");
                $conex->set_charset("utf8mb4");

                $consulta = $conex->query("SELECT dni FROM datos WHERE dni = '$_POST[dni]'");
                
                if ($consulta && $consulta->num_rows > 0) {
                    $errores['dni'] = "El DNI ya existe en otro jugador.";
                }

            } catch (mysqli_sql_exception $e) {
                die("<p style='color:red;'><b>Error de conexión:</b> " . $e->getMessage() . "</p>");
            }
        }
    }

    // Dorsal: obligatorio, entre 1 y 11
    if (!isset($_POST['dorsal']) || $_POST['dorsal'] === '') {
        $errores['dorsal'] = "Selecciona un dorsal.";
    }

    // Posición: al menos una
    if (empty($_POST['posicion']) || !is_array($_POST['posicion'])) {
        $errores['posicion'] = "Selecciona al menos una posición.";
    }

    // Equipo: no vacío
    if (empty($_POST['equipo'])) {
        $errores['equipo'] = "El equipo no puede estar vacío.";
    }

    // Número de goles: no vacío y numérico
    if ($_POST['numerodegoles'] === '') {
        $errores['numerodegoles'] = "El número de goles no puede estar vacío.";
    } else if (!is_numeric($_POST['numerodegoles'])) {
        $errores['numerodegoles'] = "El número de goles solo puede contener números.";
    }

    // Si no hay errores → Insertar
    if (empty($errores)) {
        try {
            $posicion = implode(",", $_POST['posicion']);
            $conex->query("INSERT INTO datos VALUES('$_POST[nombredeljugador]','$_POST[dni]','$_POST[dorsal]','$posicion','$_POST[equipo]','$_POST[numerodegoles]')");
            echo "<p style='color:green;'>Jugador insertado correctamente.</p>";
        } catch (mysqli_sql_exception $e) {
            die("<p style='color:red;'><b>Error de inserción:</b> " . $e->getMessage() . "</p>");
        }
    }
}
?>

<form action="" method="POST">

    Nombre del Jugador:
    <input type="text" name="nombredeljugador" value="<?php echo isset($_POST['nombredeljugador']) ? $_POST['nombredeljugador'] : ''; ?>">
    <?php if (isset($errores['nombredeljugador'])) { ?>
        <span style="color:red"><?php echo $errores['nombredeljugador']; ?></span>
    <?php } ?>
    <br>

    DNI:
    <input type="text" name="dni" value="<?php echo isset($_POST['dni']) ? $_POST['dni'] : ''; ?>">
    <?php if (isset($errores['dni'])) { ?>
        <span style="color:red"><?php echo $errores['dni']; ?></span>
    <?php } ?>
    <br>

    Dorsal:
    <select name="dorsal">
        <option hidden value="">Selecciona</option>
        <?php
        for ($i = 1; $i <= 11; $i++) {
            $sel = (isset($_POST['dorsal']) && $_POST['dorsal'] == $i) ? 'selected' : '';
            echo "<option value=\"$i\" $sel>$i</option>";
        }
        ?>
    </select>
    <?php if (isset($errores['dorsal'])) { ?>
        <span style="color:red"><?php echo $errores['dorsal']; ?></span>
    <?php } ?>
    <br>

    Posición:
    <select multiple name="posicion[]">
        <?php
        $opciones = [
            'portero' => 'Portero',
            'defensa' => 'Defensa',
            'centrocampista' => 'Centro Campista',
            'delantero' => 'Delantero'
        ];
        foreach ($opciones as $valor => $texto) {
            $sel = (isset($_POST['posicion']) && is_array($_POST['posicion']) && in_array($valor, $_POST['posicion'])) ? 'selected' : '';
            echo "<option value=\"$valor\" $sel>$texto</option>";
        }
        ?>
    </select>
    <?php if (isset($errores['posicion'])) { ?>
        <span style="color:red"><?php echo $errores['posicion']; ?></span>
    <?php } ?>
    <br>

    Equipo:
    <input type="text" name="equipo" value="<?php echo isset($_POST['equipo']) ? $_POST['equipo'] : ''; ?>">
    <?php if (isset($errores['equipo'])) { ?>
        <span style="color:red"><?php echo $errores['equipo']; ?></span>
    <?php } ?>
    <br>

    Número de goles:
    <input type="text" name="numerodegoles" value="<?php echo isset($_POST['numerodegoles']) ? $_POST['numerodegoles'] : ''; ?>">
    <?php if (isset($errores['numerodegoles'])) { ?>
        <span style="color:red"><?php echo $errores['numerodegoles']; ?></span>
    <?php } ?>
    <br>

    <input type="submit" name="insertar" value="Insertar">
    <input type="button" value="Menu" onclick="location.href='Principal.php'">

</form>
<style>
  /* === ESTILOS GLOBALES === */
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  body {
    font-family: "Segoe UI", Roboto, Arial, sans-serif;
    background: linear-gradient(135deg, #0f172a, #1e3a8a);
    color: #f8fafc;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px;
  }

  form {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 16px;
    padding: 40px 30px;
    max-width: 420px;
    width: 100%;
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.35);
    backdrop-filter: blur(10px);
  }

  form input[type="text"],
  form select {
    width: 100%;
    padding: 10px 12px;
    margin: 8px 0 15px;
    border-radius: 8px;
    border: none;
    outline: none;
    background: rgba(255, 255, 255, 0.15);
    color: #f8fafc;
    font-size: 0.95rem;
    transition: background 0.2s;
  }

  form input[type="text"]:focus,
  form select:focus {
    background: rgba(255, 255, 255, 0.25);
  }

 select {
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  background-color: rgba(255, 255, 255, 0.15);
  color: #f8fafc;
  border: none;
  border-radius: 8px;
  padding: 10px 12px;
  font-size: 0.95rem;
  cursor: pointer;
  width: 100%;
}

select:focus {
  outline: 2px solid #60a5fa;
  background-color: rgba(255, 255, 255, 0.25);
}

/* === OPCIONES DENTRO DEL SELECT === */
option {
  background-color: #1e293b;   /* gris azulado oscuro */
  color: #f8fafc;              /* texto claro */
  padding: 8px;
}

/* Evitar que la opción “Selecciona” se vea igual al resto */
option[hidden] {
  color: #94a3b8;
}
  label,
  form span {
    font-size: 0.9rem;
  }

  form span {
    color: #f87171;
    margin-left: 5px;
  }

  form input[type="submit"] {
    background: #2563eb;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.15s ease;
  }

  form input[type="submit"]:hover {
    background: #1d4ed8;
    transform: translateY(-2px);
  }

   form input[type="button"] {
    background: #2563eb;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.15s ease;
  }

  form input[type="button"]:hover {
    background: #1d4ed8;
    transform: translateY(-2px);
  }


  p {
    text-align: center;
    margin-bottom: 20px;
    color: #22c55e;
    font-weight: bold;
  }

  h1 {
    text-align: center;
    margin-bottom: 20px;
  }

  /* === RESPONSIVE === */
  @media (max-width: 600px) {
    form {
      padding: 25px 20px;
    }

    form input[type="text"],
    form select {
      font-size: 0.85rem;
    }

    form input[type="submit"] {
      width: 100%;
      font-size: 0.9rem;
    }
  }
</style>

</body>
</html>
