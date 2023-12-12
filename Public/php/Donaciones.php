<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Style_Donaciones.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Listado de Donantes</title>
</head>

<body>
    <nav>
        <div class="navbar-left">
            <a href="/Beach/Index.html"><i class="bi bi-house"></i></a>
        </div>
        <div class="navbar-center">
            <a href="Donacion.php">Realizar una Donación</a>
        </div>
        <div class="navbar-right">
            <a href="cerrar_sesion.php"><i class="bi bi-box-arrow-in-left"></i></a>
        </div>
    </nav>

    <h2>Listado de Donaciones</h2>

    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Monto</th>
            <th>Acciones</th>
        </tr>

        <?php
        session_start();

        if (!isset($_SESSION['usuario'])) {
            echo '
                <script>
                    alert("Por favor, inicia sesión");
                    window.location = "/Beach/Login.php";
                </script>
            ';
            session_destroy();
            die();
        }

        $conexion = mysqli_connect("localhost:8889", "padrino", "cafesito", "cleaninbeaches");

        $consulta = mysqli_query($conexion, "SELECT * FROM donaciones");

        while ($fila = mysqli_fetch_assoc($consulta)) {
            echo "<tr>";
            echo "<td>{$fila['nombre']}</td>";
            echo "<td>{$fila['fecha']}</td>";
            echo "<td>{$fila['monto']}</td>";
            echo '<td class="actions">';
            echo '<a href="cancelar_donacion.php?id=' . $fila['id'] . '"><i class="bi bi-x-circle-fill"></i></a> | '; 
            echo '<a href="modificar_monto.php?id=' . $fila['id'] . '"><i class="bi bi-pen-fill"></i></a>';
            echo '</td>';
            echo "</tr>";
        }
        ?>
    </table>

    <footer>
        <div class="container">
            <i class="bi bi-beach"></i>
            <p>&copy; 2023 Cleanin Beaches. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>

</html>
