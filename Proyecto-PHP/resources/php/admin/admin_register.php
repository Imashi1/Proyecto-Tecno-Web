<?php
    extract($_POST);
    include("../conexion.php");
    $sql=mysqli_query($conn,"SELECT * FROM administradores where correo='$email'");
    if(mysqli_num_rows($sql)>0){
        echo "Ya Existe un email"; 
	    exit;
    }
    else{
        $fecha = date("Y/m/d");
        $insertar = "INSERT INTO proyecto.administradores (nombre, apellido, correo, contrasena, fecha_creacion) 
        VALUES ('$nombre', '$apellido', '$email', '$contra', '$fecha')";

        //Verificamos que se haya realizado la inserción
        if ($conn->query($insertar) === TRUE) {
        //Redireccionamos a login.php
            header("Location: ../../html/admin/admin_login.html");
        } else {
            echo "Error: " . $insertar . "<br>" . $conn->error;
        }
    }
?>