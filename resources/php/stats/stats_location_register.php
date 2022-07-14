<?php
    //Verficación de conexión a la base de datos
    include("../conexion.php");
    
    //Obtencios de la id del usuario y de la ubicación por medio de la url
    $idUser = $_GET['user'];
    $idUbicacion = $_GET['id'];

    //Verificamos que no se haya registrado la ubicación anteriormente
    $sql=mysqli_query($conn,"SELECT * FROM usuarioubicacion where idUser=$idUser AND idUbicacion = $idUbicacion");
    if(mysqli_num_rows($sql)>0){
        //En el caso de que si haya registro anterior,
        //Se extrae los datos con la última repetición que se hizo
        //Para luego sumar una repetición más y luego insertar los datos 
        //Con esa nueva repetición
        $nueva_entrada=mysqli_query($conn,"SELECT idUser, idUbicacion, MAX(repUbicacion) FROM usuarioubicacion where idUser=$idUser AND idUbicacion = $idUbicacion");
        $resultado = mysqli_fetch_array($nueva_entrada);
        $idUbicacion = $resultado['1'];
        $idUser = $resultado['0'];
        $repUbicacion = $resultado['2'];
        $repUbicacion = $repUbicacion + 1;
        
        $insertar = "INSERT INTO usuarioubicacion (idUser, idUbicacion, repUbicacion) 
        VALUES ($idUser, $idUbicacion, $repUbicacion)";

        if ($conn->query($insertar) === TRUE) {
            //Redireccionamos a la lista de platos de esa tienda
            header("Location: ../dish/dish_dashboard_user.php?id=".$idUbicacion);
        } else {
            echo "Error: " . $insertar . "<br>" . $conn->error;
        }
    }
    else{
        //Caso contrario se inserta la primera repetición
        $insertar = "INSERT INTO usuarioubicacion (idUser, idUbicacion, repUbicacion) 
        VALUES ($idUser, $idUbicacion, 1)";

        //Verificamos que se haya realizado la inserción
        if ($conn->query($insertar) === TRUE) {
        //Redireccionamos a la lista de platos de esa tienda
            header("Location: ../dish/dish_dashboard_user.php?id=".$idUbicacion);
        } else {
            echo "Error: " . $insertar . "<br>" . $conn->error;
        }
    }
?>