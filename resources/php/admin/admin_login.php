<?php
    //Autenticación del administrador
    session_start();
    if(isset($_POST['guardar']))
    {
        extract($_POST);
        include("../conexion.php");
        //Verificacón de autenticación con datos de la base
        $buscar=mysqli_query($conn,"SELECT * FROM administradores where correo='$correo' and contrasena='$contra'");
        $row  = mysqli_fetch_array($buscar);
        //Si encuentra los datos
        if(is_array($row))
        {
            $_SESSION["id"] = $row['id'];
            $_SESSION["correo"]=$row['correo'];
            $_SESSION["nombre"]=$row['nombre'];
            $_SESSION["apellido"]=$row['apellido']; 
            header("Location: admin_main_dashboard.php"); 
        }
        //Si no encuentra los datos
        else
        {
            header("Location: ../../html/admin/admin_error_login.html");
        }
        $conn->close();
    }
?>