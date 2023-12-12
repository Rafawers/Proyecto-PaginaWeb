<?php 

    session_start();

    include 'conexion.php';

    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $contrasena = hash('sha512', $contrasena);

    $validar = mysqli_query($conexion, "SELECT * FROM usuarios 
    WHERE correo='$correo' and contrasena='$contrasena'");
     
     if(mysqli_num_rows($validar) > 0){
        $_SESSION['usuario'] = $correo;
        header("location: Donaciones.php");
        exit;
     }else{
        echo '
            <script>
                alert("Usuario no existente");
                window.location = "/Beach/Login.php";
            </script>
        ';
     };
     exit;
?>