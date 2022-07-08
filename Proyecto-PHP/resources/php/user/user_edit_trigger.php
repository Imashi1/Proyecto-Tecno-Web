<?php
    extract($_POST);
    include("../conexion.php");
    $actualizar = "UPDATE proyecto.usuarios SET nombre = '$nombre', apellido = '$apellido', correo = '$email', contrasena = '$pass' WHERE id = $id";

    //Verificamos que se haya realizado la inserción
    if ($conn->query($actualizar) === TRUE) {
    //Redireccionamos a login.php
        header("Location: ../user/user_main_dashboard.php");
    } else {
        echo "Error: " . $actualizar . "<br>" . $conn->error;
    }
?>