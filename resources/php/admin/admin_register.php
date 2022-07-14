<?php
    //Registro del administrador
    include("../conexion.php");
    
    //Obtencion de datos del administrador por medio del form.
    extract($_POST);
    
    //Verficación de que el email no existe
    $sql=mysqli_query($conn,"SELECT * FROM administradores where correo='$email'");
    if(mysqli_num_rows($sql)>0){
        header("Location: ../../html/admin/admin_error_identical_email.html");
    }
    else{
        //Insertamos los datos con los obtenidos del form.
        $fecha = date("Y/m/d");
        $insertar = "INSERT INTO proyecto.administradores (nombre, apellido, correo, contrasena, fecha_creacion) 
        VALUES ('$nombre', '$apellido', '$email', '$contra', '$fecha')";

        //Verificamos que se haya realizado la inserción
        if ($conn->query($insertar) === TRUE) {
        //Redireccionamos a login.php del admin
            header("Location: ../../html/admin/admin_login.html");
        } else {
            echo "Error: " . $insertar . "<br>" . $conn->error;
        }
    }
?>