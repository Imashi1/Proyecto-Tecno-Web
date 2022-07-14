<?php   
    //Cierre de sesión administrador
    session_start(); 
    session_destroy(); 
    header("Location: ../../html/admin/admin_login.html"); 
    exit();
?>