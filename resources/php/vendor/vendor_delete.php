<?php
//Verificamos que estamos conectados a la base de datos
include("../conexion.php");

//Obtenemos el id de la tienda a borrar a través del url
$id = $_GET['id'];

//Se borra la fila con el id asociado
$borrar_fila = "DELETE FROM proyecto.ubicaciones WHERE id= $id";

//Verificamos que se borró la fila
if ($conn->query($borrar_fila) === TRUE) {
    //Redireccionamos al dasboard del admin de los vendedores
    header("Location: ../admin/admin_vendor_dashboard.php");
    
} else {
    echo "Error deleting record: " . $conn->error;
}

//Cerramos la conexión
$conn->close();
