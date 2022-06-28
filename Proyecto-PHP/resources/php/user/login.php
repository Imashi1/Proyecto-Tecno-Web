<?php
    session_start();
    if(isset($_POST['guardar']))
    {
        extract($_POST);
        include("../conexion.php");
        $buscar=mysqli_query($conn,"SELECT * FROM usuarios where correo='$correo' and contrasena='$contra'");
        $row  = mysqli_fetch_array($buscar);
        if(is_array($row))
        {
            $_SESSION["id"] = $row['id'];
            $_SESSION["correo"]=$row['correo'];
            $_SESSION["nombre"]=$row['nombre'];
            $_SESSION["apellido"]=$row['apellido']; 
            header("Location: dashboard.php"); 
        }
        else
        {
            echo "Invalid Email ID/Password";
        }
    }
?>