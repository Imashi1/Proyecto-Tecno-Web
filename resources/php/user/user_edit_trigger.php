<?php
    //Edicion de un usuario por medio del mismo
    include("../conexion.php");

    //Obtención de datos por medio del form
    extract($_POST);
    
    //Establecemos la consulta para actualizar
    $actualizar = "UPDATE proyecto.usuarios SET nombre = '$nombre', apellido = '$apellido', correo = '$email', contrasena = '$pass' WHERE id = $id";

    //Verificamos que se haya realizado la actualización
    if ($conn->query($actualizar) === TRUE) {
    //Redireccionamos al dashboard del usuario
        header("Location: ../user/user_main_dashboard.php");
    } else {
        echo "Error: " . $actualizar . "<br>" . $conn->error;
    }
?>