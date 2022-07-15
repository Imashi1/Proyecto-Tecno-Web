<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <title>Registro</title>
    <!-- Conexion con Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- Conexion con la hoja de estilo estilo-->
    <link type="text/css" rel="stylesheet" href="../../css/estilo.css">
</head>

<body>
    <?php
        session_start();
        include("../conexion.php");
        $ID = $_SESSION['id'];
        $id= $_GET['id'];
        $mostrar_plato = "SELECT idPlato, nombrePlato, descripcionPlato, imagenPlato, precioPlato FROM proyecto.platos WHERE idPlato = $id";
        $platos = $conn->query($mostrar_plato);
        foreach ($platos as $plato_array) {
        }
    ?>
    <!-- SECCION NAVEGACIÓN-->
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

    <section class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-12">   
                <form action="dish_edit_trigger.php" class="form-signin bg-light my-3 p-3 border rounded" method="post" enctype="multipart/form-data">
                    <div class="text-center">    
                        <h2>Editar <?php echo $plato_array['nombrePlato']?></h2>
                        <p class="hint-text">Información del Plato</p>
                    </div>
                    <div class="form-group">
                        <label for="nombrePlato">Nombre Plato</label>
                        <input type="text" class="form-control" name="nombrePlato" id="nombrePlato" placeholder="Nombre de la Tienda" value="<?php echo $plato_array['nombrePlato']?>" required>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción del Plato</label>
                        <input type="textarea" class="form-control" name="descripcionPlato" id="descripcionPlato" placeholder="Descripción del Plato" value="<?php echo $plato_array['descripcionPlato']?>" required>
                    </div>

                    <div class="form-group">
                        <label for="nombreTienda">Precio</label>
                        <input type="text" class="form-control" name="precioPlato" id="precioPlato" placeholder="Precio del Plato" value="<?php echo $plato_array['precioPlato']?>" required>
                    </div>

                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" class="form-control-file" name="imagenPlato" id="imagenPlato"/>
                    </div>

                    <!--Input extra escondido para obtener el id y con el, poder utilizarlo en editar.php-->
                    <input type="hidden" class="form-control" value="<?php echo $plato_array['idPlato']; ?>" name="idPlato">
                    

                    <button type="submit" name="accion" value="editar" class="btn btn-primary">Editar</button>
                </form>
            </div>
        </div>
    </section>
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