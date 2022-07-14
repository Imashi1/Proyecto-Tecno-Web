<?php
    //Verficación de conexión a la base de datos
    include("../conexion.php");

    //Obtencios de la id del usuario y del plato por medio de la url
    $idUser = $_GET['user'];
    $idPlato = $_GET['id'];

    //Verificamos que no se haya registrado el plato anteriormente
    $sql=mysqli_query($conn,"SELECT * FROM usuarioplato where idUser=$idUser AND idPlato = $idPlato");
    if(mysqli_num_rows($sql)>0){
        //En el caso de que si haya registro anterior,
        //Se extrae los datos con la última repetición que se hizo
        //Para luego sumar una repetición más y luego insertar los datos 
        //Con esa nueva repetición
        $nueva_entrada=mysqli_query($conn,"SELECT idUser, idPlato, MAX(repPlato) FROM usuarioplato where idUser=$idUser AND idPlato = $idPlato");
        $resultado = mysqli_fetch_array($nueva_entrada);
        $idPlato = $resultado['1'];
        $idUser = $resultado['0'];
        $repPlato = $resultado['2'];
        $repPlato = $repPlato + 1;

        $insertar = "INSERT INTO usuarioplato (idUser, idPlato, repPlato) 
        VALUES ($idUser, $idPlato, $repPlato)";

        if ($conn->query($insertar) === TRUE) {
            //Redireccionamos al dashboard del usuario
            header("Location: ../user/user_main_dashboard.php");
        } else {
            echo "Error: " . $insertar . "<br>" . $conn->error;
        }
    }
    else{
        //Caso contrario, se inserta la primera repetición
        $insertar = "INSERT INTO usuarioplato (idUser, idPlato, repPlato) 
        VALUES ($idUser, $idPlato, 1)";

        //Verificamos que se haya realizado la inserción
        if ($conn->query($insertar) === TRUE) {
        //Redireccionamos al dashboard del usuario
            header("Location: ../user/user_main_dashboard.php");
        } else {
            echo "Error: " . $insertar . "<br>" . $conn->error;
        }
    }
    //Cerramos la conexión
    $conn->close();
?>