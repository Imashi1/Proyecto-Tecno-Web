<?php
    //Registro del usuario
    include("../conexion.php");
    //Obtencion de datos del usuario por medio del form.
    extract($_POST);
    
    //Verificación de que el email no existe
    $sql=mysqli_query($conn,"SELECT * FROM usuarios where correo='$email'");
    if(mysqli_num_rows($sql)>0){
        Header("Location: ../../html/user/user_error_identical_email.html");
    }
    else{
        //Insertamos los datos con los obtenidos del form.
        $fecha = date("Y/m/d");
        $insertar = "INSERT INTO proyecto.usuarios (nombre, apellido, correo, contrasena, fecha_creacion) 
        VALUES ('$nombre', '$apellido', '$email', '$contra', '$fecha')";

        //Verificamos que se haya realizado la inserción
        if ($conn->query($insertar) === TRUE) {
        //Redireccionamos a login.php del usuario
            header("Location: ../../html/user/user_login.html");
        } else {
            echo "Error: " . $insertar . "<br>" . $conn->error;
        }
    }
?>