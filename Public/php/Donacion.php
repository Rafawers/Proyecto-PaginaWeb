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
    $nombre = $_POST["nombre"];
    $fecha = $_POST["fecha"];
    $monto = $_POST["monto"];

    $correoUsuario = $_SESSION['usuario'];

    $query = "INSERT INTO donaciones (nombre, fecha, monto, correo_usuario) VALUES ('$nombre', '$fecha', $monto, '$correoUsuario')";
    $resultado = mysqli_query($conexion, $query);

    if ($resultado) {
        echo '
            <script>
                alert("Donación exitosa");
                window.location = "Donaciones.php"
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Donación fallida");
                window.location = "Donaciones.php"
            </script>
        ';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/StyleDonacion.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <title>Donanciones</title>
</head>

<body>
    <nav>
        <h2>
            Realiza una donación
        </h2>
    </nav>
    <section class="form-container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>
            </div>

            <div class="form-group">
                <label for="monto">Monto:</label>
                <input type="number" id="monto" name="monto" step="0.01" required>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Enviar Donación">
            </div>
        </form>
    </section>

    <footer>
        <a href="Donaciones.php"><i class="bi bi-arrow-90deg-left"></i></a>
        <a href="cerrar_sesion.php"><i class="bi bi-box-arrow-in-left"></i></a>
    </footer>
</body>

</html>
