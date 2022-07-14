<?php
    //Verificamos la conexión
    include("../conexion.php");

    //Obtención de datos del plato por medio del form.
    extract($_POST);
    
    //Procedimiento de subir una imagen
    $imagen = (isset($_FILES['imagenPlato']['name'])) ? $_FILES['imagenPlato']['name'] : "";
    $fecha = new DateTime();
    $nombreArchivo = ($imagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["imagenPlato"]["name"] : "notfoung.jpg";
    $tmpImagen = $_FILES["imagenPlato"]["tmp_name"];

    if ($tmpImagen != "") {

        //Se sube la imagen en la carpeta destinada
        move_uploaded_file($tmpImagen, "../../../img/" . $nombreArchivo);
    
        //Se realiza consulta para saber si existe una imagen en ese id
        $consulta = "SELECT imagenPlato FROM proyecto.platos WHERE idPlato = $idPlato";
        $resultado = $conn->query($consulta);
        $imagenVerificar = $resultado->fetch_array(MYSQLI_ASSOC)['imagenPlato'];
    
        //Si llegase a existir una nueva entrada de imagen, se reemplaza
        //la imagen y se elimina la imagen anterior
        if (isset($imagenVerificar) && ($imagenVerificar != "notfound.jpg")) {
    
            if (file_exists("../../../img/" . $imagenVerificar)) {
    
                unlink("../../../img/" . $imagenVerificar);
            }
        }
    
        //Se actualiza la imagen
        $img_actualizar = "UPDATE proyecto.platos SET imagenPlato = '$nombreArchivo'   WHERE idPlato = $idPlato";
        $conn->query($img_actualizar);
    }
    $actualizar = "UPDATE proyecto.platos SET nombrePlato = '$nombrePlato', descripcionPlato = '$descripcionPlato', precioPlato = '$precioPlato' WHERE idPlato = $idPlato";

    //Verificamos que se haya realizado la inserción
    if ($conn->query($actualizar) === TRUE) {
    //Redireccionamos a al dashboard de las tiendas del admin
        header("Location: ../admin/admin_vendor_dashboard.php");
    } 
    else {
        echo "Error: " . $actualizar . "<br>" . $conn->error;
    }
?>