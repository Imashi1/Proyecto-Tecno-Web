<?php
    //Verificamos que estamos conectados a la base de datos
    include("../conexion.php");

    //Obtención de datos del plato por medio del form.
    extract($_POST);
    
    //Procedimiento para añadir una imagen
    $imagen = (isset($_FILES['imagenPlato']['name'])) ? $_FILES['imagenPlato']['name'] : "";
    $fecha = new DateTime();
    $nombreArchivo = ($imagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["imagenPlato"]["name"] : "notfound.jpg";
    $tmpImagen = $_FILES["imagenPlato"]["tmp_name"];

    if ($tmpImagen != "") {
        //Si la imagen no es vacía, procedemos a subir la imagen con nombre $nombreArchivo
        move_uploaded_file($tmpImagen, "../../../img/" . $nombreArchivo);
    }

    //Insertamos el nuevo plato en el vendedor
    $insertar = "INSERT INTO platos (nombrePlato, descripcionPlato, imagenPlato, precioPlato, idUbicaciones) 
    VALUES ('$nombrePlato', '$descripcionPlato', '$nombreArchivo', $precioPlato,  $idUbicacion)";

    //Verificamos que se haya realizado la inserción
    if ($conn->query($insertar) === TRUE) {
    //Redireccionamos al dashboard del administrador para los vendedores.
        header("Location: ../admin/admin_vendor_dashboard.php");
    } else {
        echo "Error: " . $insertar . "<br>" . $conn->error;
    }
?>