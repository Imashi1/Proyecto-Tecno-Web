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
    <title>UH TA' RICO</title>
    <style>
        .principal {
            /* margin-top: 50px; */
            background-color: white;
            padding: 20px;
            /* Siempre tomara el mismo ancho que el contenedor */
            width: 100%;
        }

    </style>
    <?php
    //Verificamos que estamos conectados a la base de datos
		session_start();
		include("../conexion.php");
		$ID= $_SESSION["id"];
        $idUbicacion = $_GET["id"];
		$sql=mysqli_query($conn,"SELECT * FROM proyecto.usuarios where id='$ID' ");
		$row  = mysqli_fetch_array($sql);

        //Realizamos la consulta para obtener todas las filas de la tabla productos
        $mostrar_todo = "SELECT idPlato, nombrePlato, descripcionPlato, precioPlato, imagenPlato FROM proyecto.platos WHERE idUbicaciones = $idUbicacion ";
        $platos = $conn->query($mostrar_todo);
    ?>
</head>

<body>
    <header>
        <nav class="navbar navbar-dark bg-primary navbar-expand-md col-12">
            <div class="container">      
                <a href="../user/user_main_dashboard.php" class="navbar-brand">
                  <strong>UTARICO</strong>
                </a>
                  <button type="button" class="navbar-toggler" data-toggle="collapse"
                  data-target="#menu-principal" aria-controls="menu-principal" aria-expanded="false"
                  aria-label="Desplegar menú de navegación">
                  <span class="navbar-toggler-icon"></span>
                </button>
          
                <div class="collapse navbar-collapse" id="menu-principal">
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="estadistica.html" class="nav-link">Estadísticas</a></li>
                    <li class="nav-item"><a href="../user/user_main_dashboard.php" class="nav-link">Ver Tiendas</a></li>
                    <li class="nav-item"><a href="../user/user_logout.php" class="nav-link">Cerrar Sesión</a></li>
                  </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <div class="principal">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <?php foreach ($platos as $plato) { ?>
                            <div class="col-md-3">
                            <img class="card-img-top" src="../../../img/<?php echo $plato['imagenPlato']; ?>" alt="Imagen del Plato">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                <h5 class="card-title"><?php echo $plato['nombrePlato']; ?></h5>
                                <p class="card-text"><?php echo $plato['descripcionPlato']; ?></p>
                                <p class="card-text"><?php echo $plato['precioPlato']; ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <?php 
    //Cerramos la conexión
    $conn->close(); 
    
    ?>
    <footer class="text-center text-white bg-primary">
        <div class="container p-4 pb-0">
            <section class="">
                <p class="d-flex justify-content-center align-items-center">
                <span class="me-3">Registrate!</span>
                <button type="button" class="btn btn-outline-light rounded-pill ml-2">
                    Resgistro
                </button>
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