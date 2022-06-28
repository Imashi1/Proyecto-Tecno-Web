<?php
//Establecemos las variables para ingresar a la conexión
$servidor = "localhost:3306";
$basedatos = "proyecto";
$usuario = "root";
$contrasena = "";

//Establecemos la conexión con la base de datos
$conn = new mysqli($servidor, $usuario, $contrasena, $basedatos);
if ($conn->connect_error){ 
    //Arroja error si es que llegase a fallar la conexión
    die("Falló conexión". $conn->connect_error);
}

?>