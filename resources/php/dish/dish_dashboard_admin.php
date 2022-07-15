<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Conexion con Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- Conexion con la hoja de estilo estilo-->
    <link type="text/css" rel="stylesheet" href="../../css/estilo.css">
    <title>UTARICO Productos Tienda Admi</title>

    <?php
        //Verificamos que estamos conectados a la base de datos
		session_start();
		include("../conexion.php");

        //Obtenemos la id de la sesión del admin
		$ID= $_SESSION["id"];

        //Obtenemos la id de la ubicación a través de la url
        $idUbicacion = $_GET["id"];

        //Realizamos la consulta para obtener la tienda
        $nombre_tienda = "SELECT nombreTienda, descripcionTienda FROM ubicaciones WHERE id = $idUbicacion";
        $tienda = $conn->query($nombre_tienda);
        foreach ($tienda as $datos_tienda){}

        //Realizamos la consulta para obtener todos los platos de esa tienda
        $mostrar_todo = "SELECT idPlato, nombrePlato, descripcionPlato, precioPlato, imagenPlato FROM proyecto.platos WHERE idUbicaciones = $idUbicacion ";
        $platos = $conn->query($mostrar_todo);
    ?>
</head>

<body>
    <header>
        <nav class="navbar navbar-dark bg-primary navbar-expand-md col-12">
            <div class="container">      
                <a href="../admin/admin_main_dashboard.php" class="navbar-brand">
                  <strong>UTARICO</strong>
                </a>
                  <button type="button" class="navbar-toggler" data-toggle="collapse"
                  data-target="#menu-principal" aria-controls="menu-principal" aria-expanded="false"
                  aria-label="Desplegar menú de navegación">
                  <span class="navbar-toggler-icon"></span>
                </button>
          
                <div class="collapse navbar-collapse" id="menu-principal">
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="../admin/admin_vendor_dashboard.php" class="nav-link">Ver Tiendas</a></li>
                    <li class="nav-item"><a href="../vendor/vendor_register_form.php?id='<?php echo $ID; ?>'" class="nav-link">Agregar Tienda</a></li>
                    <li class="nav-item"><a href="../admin/admin_logout.php" class="nav-link">Cerrar Sesión</a></li>
                  </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <section class="container mt-3">
        <div class="row">
        <div class="text-center col-12">
                <h2><?php echo $datos_tienda['nombreTienda'];?></h2>
                <p class="hint-text"><?php echo $datos_tienda['descripcionTienda'];?></p>
            </div>
            <!--Procedemos a mostrar los platos-->
            <?php foreach ($platos as $plato) { ?>
            <div class="col-12 col-md-6">
                    <div class="card mb-3">
                        <div class="d-flex bd-highlight">
                            <div class="p-3 w-100 bd-highlight">
                                <div class="d-flex flex-column bd-highlight ">
                                    <div class="d-flex bd-highlight title-card"><?php echo $plato['nombrePlato']; ?></div>
                                    <div class="d-flex bd-highlight desc-card mb-3"><?php echo $plato['descripcionPlato']; ?></div>
                                    <div class="d-flex bd-highlight prec-card">$<?php echo $plato['precioPlato']; ?></div>
                                    <div class="d-flex bd-highlight ml-auto">
                                        <a href="dish_edit_form.php?id=<?php echo $plato['idPlato']; ?>" class="btn btn-warning btn-sm ml-1">Editar</a>
                                        <a data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm ml-1">Eliminar</a>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center bd-highlight">
                                <img class="img-card rounded" src="../../../img/<?php echo $plato['imagenPlato']; ?>" alt="Imagen del Plato">
                            </div>
                        </div>
                    </div>
                    <!-- Modal para eliminar-->
                    <div class="modal fade" id="confirm-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">		
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Plato</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                <div class="modal-body">
                                    ¿Esta seguro de eliminar este plato?
                                </div>
                                
                                <div class="modal-footer">
                                    <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</a>
                                    <a name='id' type="submit" method="POST" class="btn btn-danger" href="dish_delete_trigger.php?id=<?php echo $plato['idPlato']; ?>">Eliminar</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <?php } ?>
        </div> 
    </section>
    <?php 
    //Cerramos la conexión
    $conn->close(); 
    ?>
    <!-- Uso del footer -->
    <footer class="text-center text-white bg-primary">
        <div class="container p-4 pb-0">
            <section class="">
                <p class="d-flex justify-content-center align-items-center">
                <span class="me-3">Registrate!</span>
                <a href="../../html/user/user_register.html" class="btn btn-outline-light rounded-pill ml-2">
                    Registro
                </a>
                </p>
            </section>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2022 Copyright: UTARICO
        </div>
    </footer>

    <!-- Conexion con jQuery y Bootstrap Bundle (incluido Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

</body>
</html>