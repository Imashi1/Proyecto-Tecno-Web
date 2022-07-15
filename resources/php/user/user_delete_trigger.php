<!-- PHP para eliminar un usuario -->
<?php
//Verificamos que estamos conectados a la base de datos
include("../conexion.php");

//Obtenemos el id de la fila a ver a través del url
$id = $_GET['id'];

//Se borra la fila con el id asociado
$borrar_fila = "DELETE FROM proyecto.usuarios WHERE id= $id";

//Verificamos que se borró la fila
if ($conn->query($borrar_fila) === TRUE) {
    //Redireccionamos a la pagina donde se muestra todas las filas
    header("Location: ../admin/admin_main_dashboard.php");
    
} else {
    echo "Error deleting record: " . $conn->error;
}

//Cerramos la conexión
$conn->close();
