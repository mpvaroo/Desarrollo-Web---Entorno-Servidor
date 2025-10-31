<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscar Jugador</title>

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

        h1 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 1.8rem;
        }

        select,
        input[type="text"] {
            width: 100%;
            padding: 10px 12px;
            margin: 10px 0 18px;
            border-radius: 8px;
            border: none;
            outline: none;
            background: rgba(255, 255, 255, 0.15);
            color: #f8fafc;
            font-size: 0.95rem;
            transition: background 0.2s;
        }

        select:focus,
        input[type="text"]:focus {
            background: rgba(255, 255, 255, 0.25);
        }

        option {
            background-color: #1e293b;
            color: #f8fafc;
        }

        input[type="submit"],
        input[type="button"] {
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.15s ease;
            margin-right: 6px;
        }

        input[type="submit"]:hover,
        input[type="button"]:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
        }

        .resultado {
            margin-top: 25px;
            padding: 25px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.25);
        }

        .resultado hr {
            border: 0;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            margin: 10px 0;
        }

        p {
            color: #f87171;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Buscar Jugador</h1>
        <form action="" method="POST">
            Busqueda por:
            <select name="busqueda">
                <option value="equipo">Equipo</option>
                <option value="posicion">Posicion</option>
                <option value="dni">DNI</option>
            </select><br>
            Valor a buscar :
            <input type="text" name="buscar"><br>
            <?php
            $error = false;
            if (isset($_POST['buscar'])) {
                try {
                    $conex = new mysqli("localhost", "dwes", "abc123.", "jugadores_db");
                    $conex->set_charset("utf8mb4");
                    if ($_POST['busqueda'] == "posicion") {
                        $result = $conex->query("SELECT  * FROM datos WHERE $_POST[busqueda] LIKE '%$_POST[buscar]%'  ");
                    } else {
                        $result = $conex->query("SELECT  * FROM datos WHERE $_POST[busqueda] = '$_POST[buscar]'  ");
                    }
                    if ($result->num_rows) {
                        while ($fila = $result->fetch_object()) {
                            echo "<br>Nombre: " . $fila->nombredeljugador . "<br>";
                            echo "DNI: " . $fila->dni . "<br>";
                            echo "Dorsal: " . $fila->dorsal . "<br>";
                            echo "Posicion: " . $fila->posicion . "<br>";
                            echo "Equipo: " . $fila->equipo . "<br>";
                            echo "Numero de goles: " . $fila->numerodegoles . "<br>";
                            echo "<br>";
                        }
                    } else {
                        echo "No hay jugadores para tus especificaciones";
                    }
                } catch (mysqli_sql_exception $exc) {
                    echo "<p style='color:red'>Error en la conexión: " . $exc->getMessage() . "</p>";
                    $error = true;
                }
            }
            ?>
            <input type="submit" value="Buscar">
            <input type="button" class="button" value="Menú" onclick="window.location.href='paginaPrincipal.php'">
        </form>
    </div>
</body>

</html>

</html>