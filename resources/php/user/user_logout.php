<?php   
    //Cierre de sesión usuario
    session_start(); 
    session_destroy(); 
    header("Location: ../../html/user/user_login.html"); 
    exit();
?>