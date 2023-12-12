<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleModificarMonto.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <title>Modificar Monto</title>
</head>

<body>
    <nav>
    <h2>Modificar Monto</h2>
    </nav>
    <div class="container">
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idDonacion = $_POST['id_donacion'];
            $nuevoMonto = $_POST['nuevo_monto'];

            $consultaCorreoUsuarioDonacion = mysqli_query($conexion, "SELECT correo_usuario FROM donaciones WHERE id = $idDonacion");
            $filaCorreoUsuarioDonacion = mysqli_fetch_assoc($consultaCorreoUsuarioDonacion);
            $correoUsuarioDonacion = $filaCorreoUsuarioDonacion['correo_usuario'];

            if ($_SESSION['usuario'] == $correoUsuarioDonacion) {
                $query = "UPDATE donaciones SET monto = $nuevoMonto WHERE id = $idDonacion";
                $resultado = mysqli_query($conexion, $query);

                if ($resultado) {
                    echo '
                        <script>
                            alert("Monto modificado exitosamente");
                            window.location = "Donaciones.php";
                        </script>
                    ';
                } else {
                    echo "<p>Error al modificar el monto. Inténtalo de nuevo.</p>";
                }
            } else {
                echo "<p>No tienes permiso para modificar el monto de esta donación.</p>";
            }
        } elseif (isset($_GET['id'])) {
            $idDonacion = $_GET['id'];

            $consultaDonacion = mysqli_query($conexion, "SELECT * FROM donaciones WHERE id = $idDonacion");

            if ($filaDonacion = mysqli_fetch_assoc($consultaDonacion)) {
                echo "<p>Nombre: {$filaDonacion['nombre']}</p>";
                echo "<p>Fecha: {$filaDonacion['fecha']}</p>";
                echo "<p>Monto Actual: {$filaDonacion['monto']}</p>";

                echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
                echo '<input type="hidden" name="id_donacion" value="' . $filaDonacion['id'] . '">';
                echo '<label for="nuevo_monto">Nuevo Monto:</label>';
                echo '<input type="number" id="nuevo_monto" name="nuevo_monto" step="0.01" required>';
                echo '<input type="submit" value="Modificar Monto">';
                echo '</form>';
            } else {
                echo "<p>Donación no encontrada.</p>";
            }
        } else {
            echo "<p>ID de donación no proporcionado.</p>";
        }
        ?>
    </div>

    <footer class="footer">
        <a href="Donaciones.php"><i class="bi bi-arrow-90deg-left"></i></a>
        <a href="cerrar_sesion.php"><i class="bi bi-box-arrow-in-left"></i></a>
    </footer>
</body>

</html>
