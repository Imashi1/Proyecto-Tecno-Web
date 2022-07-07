<?php
    extract($_POST);
    include("../conexion.php");
    echo $idUbicacion;

    $imagen = (isset($_FILES['imagenPlato']['name'])) ? $_FILES['imagenPlato']['name'] : "";
    $fecha = new DateTime();
    $nombreArchivo = ($imagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["imagenPlato"]["name"] : "notfound.jpg";
    $tmpImagen = $_FILES["imagenPlato"]["tmp_name"];

    if ($tmpImagen != "") {
        //Si la imagen no es vacía, procedemos a subir la imagen con nombre $nombreArchivo
        move_uploaded_file($tmpImagen, "../../../img/" . $nombreArchivo);
    }
    $insertar = "INSERT INTO platos (nombrePlato, descripcionPlato, imagenPlato, precioPlato, idUbicaciones) 
    VALUES ('$nombrePlato', '$descripcionPlato', '$nombreArchivo', $precioPlato,  $idUbicacion)";

    //Verificamos que se haya realizado la inserción
    if ($conn->query($insertar) === TRUE) {
    //Redireccionamos a login.php
        header("Location: ../../html/user/login.html");
    } else {
        echo "Error: " . $insertar . "<br>" . $conn->error;
    }
?>