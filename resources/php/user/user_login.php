<?php
    //Autenticación del usuario
    session_start();
    if(isset($_POST['guardar']))
    {
        extract($_POST);
        include("../conexion.php");
        //Verificación de autenticación con datos de la base
        $buscar=mysqli_query($conn,"SELECT * FROM usuarios where correo='$correo' and contrasena='$contra'");
        $row  = mysqli_fetch_array($buscar);
        //Si encuentra los datos en la base de datos
        if(is_array($row))
        {
            $_SESSION["id"] = $row['id'];
            $_SESSION["correo"]=$row['correo'];
            $_SESSION["nombre"]=$row['nombre'];
            $_SESSION["apellido"]=$row['apellido']; 
            header("Location: user_main_dashboard.php"); 
        }
        //Si no los encuentra
        else
        {
            header("Location:  ../../html/user/user_error_login.html"); 
        }
    }
?>