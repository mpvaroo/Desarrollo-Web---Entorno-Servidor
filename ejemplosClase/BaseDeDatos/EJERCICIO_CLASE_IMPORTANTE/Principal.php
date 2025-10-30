<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel Principal · Gestión de Empleados</title>
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
      flex-direction: column;
    }

    /* === CABECERA === */
    header {
      text-align: center;
      padding: 40px 20px 20px;
      background: rgba(255, 255, 255, 0.05);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    header h1 {
      font-size: 2rem;
      letter-spacing: 0.5px;
    }

    header p {
      color: #94a3b8;
      margin-top: 8px;
      font-size: 1rem;
    }

    /* === CONTENIDO PRINCIPAL === */
    main {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px 20px;
    }

    .menu {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      max-width: 900px;
      width: 100%;
    }

    /* === TARJETAS === */
    .card {
      display: block;
      text-align: center;
      padding: 30px 20px;
      border-radius: 16px;
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.15);
      text-decoration: none;
      color: #f8fafc;
      transition: all 0.25s ease;
      backdrop-filter: blur(8px);
    }

    .card h2 {
      font-size: 1.3rem;
      margin-bottom: 8px;
    }

    .card p {
      font-size: 0.95rem;
      color: #cbd5e1;
    }

    .card:hover {
      transform: translateY(-5px);
      background: rgba(255, 255, 255, 0.15);
      border-color: #60a5fa;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
    }

    /* === PIE DE PÁGINA === */
    footer {
      text-align: center;
      padding: 20px;
      font-size: 0.9rem;
      color: #94a3b8;
      background: rgba(255, 255, 255, 0.05);
      border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* === RESPONSIVE === */
    @media (max-width: 600px) {
      header h1 {
        font-size: 1.6rem;
      }

      .card h2 {
        font-size: 1.1rem;
      }

      .card p {
        font-size: 0.85rem;
      }
    }
  </style>
</head>
<body>
  <header>
    <h1>Gestión de Empleados</h1>
    <p>Selecciona una acción para continuar</p>
  </header>

  <main>
    <div class="menu">
      <a href="Introducir.php" class="card">
        <h2>➕ Insertar</h2>
        <p>Agregar un nuevo empleado</p>
      </a>
      <a href="Mostrar.php" class="card">
        <h2>📋 Mostrar</h2>
        <p>Ver listado de empleados</p>
      </a>
      <a href="Buscar.php" class="card">
        <h2>🔎 Buscar</h2>
        <p>Localizar un empleado</p>
      </a>
      <a href="Borrar.php" class="card">
        <h2>🗑️ Borrar</h2>
        <p>Eliminar un registro</p>
      </a>
      <a href="Modificar.php" class="card">
        <h2>✏️ Modificar</h2>
        <p>Editar los datos de un empleado</p>
      </a>
    </div>
  </main>

  <footer>
    <p>© 2025 Gestión de Empleados · Proyecto DWES</p>
  </footer>
</body>
</html>
