<?php
include 'conexion.php';

$nombre_completo = $_POST['nombre_completo'];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
$contrasena = hash('sha512', $contrasena);

if (empty($nombre_completo) || empty($correo) || empty($usuario) || empty($contrasena)) {
    echo '
        <script>
            alert("Todos los campos son obligatorios");
            window.location = "/Beach/Login.php";
        </script>
    ';
    exit();
}




$verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$correo' ");

if (mysqli_num_rows($verificar_correo) > 0) {
    echo '
        <script>
            alert("Este correo ya está registrado");
            window.location = "/Beach/Login.php";
        </script>
    ';
    exit();
}


$verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario' ");

if (mysqli_num_rows($verificar_usuario) > 0) {
    echo '
        <script>
            alert("Este usuario ya está registrado");
            window.location = "/Beach/Login.php";
        </script>
    ';
    exit();
}

$query = "INSERT INTO usuarios(nombre_completo, correo, usuario, contrasena) 
            VALUES ('$nombre_completo', '$correo', '$usuario', '$contrasena')";

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    echo '
        <script>
            alert("Usuario almacenado exitosamente");
            window.location = "/Beach/Login.php";
        </script>
    ';
} else {
    echo '
        <script>
        alert("Error al almacenar el usuario: ' . mysqli_error($conexion) . '");
            window.location = "/Beach/Login.php";
        </script>
    ';
}

mysqli_close($conexion);
?>
