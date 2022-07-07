<?php
//Verificamos que estamos conectados a la base de datos
include("../conexion.php");

//Obtenemos el id de la fila a ver a través del url
$id = $_GET['id'];

$imagen = "SELECT imagenPlato FROM proyecto.platos where idPlato = $id";

//Proceso para eliminar la imagen de la carpeta /Fotos/
if (isset($imagen) && ($imagen != "notfound.jpg")) {

    //Si existe el archivo con nombre $imagen en carpeta /Fotos/
    if (file_exists("../../../img/" . $imagen)) {

        //Se borra la imagen
        unlink("../../../img/" . $imagen);
    }
}

//Se borra la fila con el id asociado
$borrar_fila = "DELETE FROM proyecto.platos WHERE idPlato= $id";

//Verificamos que se borró la fila
if ($conn->query($borrar_fila) === TRUE) {
    //Redireccionamos a la pagina donde se muestra todas las filas
    header("Location: dish_dashboard.php");
    
} else {
    echo "Error deleting record: " . $conn->error;
}

//Cerramos la conexión
$conn->close();
