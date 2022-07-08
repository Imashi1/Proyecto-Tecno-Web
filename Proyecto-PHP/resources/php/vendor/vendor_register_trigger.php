<?php
    extract($_POST);
    $imagen = (isset($_FILES['imagen']['name'])) ? $_FILES['imagen']['name'] : "";
    $fecha = new DateTime();
    $nombreArchivo = ($imagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["imagen"]["name"] : "notfound.jpg";
    $tmpImagen = $_FILES["imagen"]["tmp_name"];

    if ($tmpImagen != "") {
        //Si la imagen no es vacía, procedemos a subir la imagen con nombre $nombreArchivo
        move_uploaded_file($tmpImagen, "../../../img/" . $nombreArchivo);
    }
    include("../conexion.php");
    $insertar = "INSERT INTO proyecto.ubicaciones (nombreTienda, descripcionTienda, imagen, latitud, longitud, id_administradores) 
    VALUES ('$nombreTienda', '$descripcion','$nombreArchivo', '$latitud', '$longitud', $id)";

    //Verificamos que se haya realizado la inserción
    if ($conn->query($insertar) === TRUE) {
    //Redireccionamos a login.php
        header("Location: ../admin/admin_vendor_dashboard.php");
    } else {
        echo "Error: " . $insertar . "<br>" . $conn->error;
    }
?>