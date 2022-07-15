<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
    <!-- Fin Boostrap -->
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
		include("../conexion.php");

        //Obtenemos la id de la ubicación a través de la url
        $idUbicacion = $_GET["id"];
        
        //Realizamos la consulta para obtener todos los platos de esa tienda
        $mostrar_todo = "SELECT idPlato, nombrePlato, descripcionPlato, precioPlato, imagenPlato FROM proyecto.platos WHERE idUbicaciones = $idUbicacion ";
        $platos = $conn->query($mostrar_todo);
    ?>
</head>

<body>
    <header>
        <nav class="navbar navbar-dark bg-primary navbar-expand-md col-12">
            <div class="container">      
                <a href="../main.php" class="navbar-brand">
                  <strong>UTARICO</strong>
                </a>
                  <button type="button" class="navbar-toggler" data-toggle="collapse"
                  data-target="#menu-principal" aria-controls="menu-principal" aria-expanded="false"
                  aria-label="Desplegar menú de navegación">
                  <span class="navbar-toggler-icon"></span>
                </button>
          
                <div class="collapse navbar-collapse" id="menu-principal">
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="../../html/user/user_register.html" class="nav-link">Registrarse</a></li>
                    <li class="nav-item"><a href="../../html/user/user_login.html" class="nav-link">Iniciar Sesión</a></li>
                  </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <div class="principal">
        <div class="row">
            <div class="col-12 col-md-6">
                <!--Procedemos a mostrar los platos-->
                <?php foreach ($platos as $plato) { ?>
                    <div class="card mb-3">
                        <div class="row no-gutters">
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
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div> 
    </div>
    <?php 
    //Cerramos la conexión
    $conn->close(); 
    
    ?>
    <footer>
        <nav class="navbar navbar-dark bg-primary justify-content-end">
            <a class="navbar-brand" href="../main.php"> Página Principal</a>
        </nav>
    </footer>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <!-- Fin Boostrap -->

</body>
</html>