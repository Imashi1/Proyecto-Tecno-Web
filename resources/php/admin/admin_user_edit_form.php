<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UTARICO Editar usuario</title>
    <!-- Conexion con Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- Conexion con la hoja de estilo estilo-->
    <link type="text/css" rel="stylesheet" href="../../css/estilo.css">
</head>

<body>
    <?php
    //Verificamos que estamos conectados a la base de datos
    include("../conexion.php");

    //Obtenemos el id de la fila a ver a través del url
    $id = $_GET['id'];

    //Realizamos la consulta para obtener los datos del id
    $consulta = "SELECT * FROM proyecto.usuarios WHERE id = $id";
    $resultado = $conn->query($consulta);

    //Obtenemos un array la cual es más trabajable para nosotros
    //de la forma '$datosAdmin['nombreColumna'];
    $datosAdmin = $resultado->fetch_array(MYSQLI_ASSOC);

    ?>
    <header>
        <nav class="navbar navbar-dark bg-primary navbar-expand-md col-12">
            <div class="container">      
                <a href="admin_main_dashboard.php" class="navbar-brand">
                  <strong>UTARICO</strong>
                </a>
                  <button type="button" class="navbar-toggler" data-toggle="collapse"
                  data-target="#menu-principal" aria-controls="menu-principal" aria-expanded="false"
                  aria-label="Desplegar menú de navegación">
                  <span class="navbar-toggler-icon"></span>
                </button>
          
                <div class="collapse navbar-collapse" id="menu-principal">
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="admin_vendor_dashboard.php" class="nav-link">Ver Tiendas</a></li>
                    <li class="nav-item"><a href="../vendor/vendor_register_form.php?id='<?php echo $ID; ?>'" class="nav-link">Agregar Tienda</a></li>
                    <li class="nav-item"><a href="admin_logout.php" class="nav-link">Cerrar Sesión</a></li>
                  </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- Procedemos a mostrar los datos-->
                <!-- junto con los datos actualmente en la base de datos-->
                <!-- action representa hacia donde van los datos del form -->
                <form action="admin_user_edit_trigger.php" class="form-signin bg-light my-3 p-3 border rounded" method="POST" enctype="multipart/form-data">
                    <div class="text-center">
                        <h2>Actualizar Usuario</h2>
                        <p class="hint-text">Cambia los datos que sean necesarios</p>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" value="<?php echo $datosAdmin['nombre']; ?>" name="nombre" id="nombre" required>
                    </div>

                    <div class="form-group">
                        <label for="apelido">Apellido:</label>
                        <input type="text" class="form-control" value="<?php echo $datosAdmin['apellido']; ?>" name="apellido" id="apellido" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" class="form-control" value="<?php echo $datosAdmin['correo']; ?>" name="email" id="email" required>
                    </div>

                    <div class="form-group">
                        <label for="pass">Contraseña:</label>
                        <input type="password" class="form-control" value="<?php echo $datosAdmin['contrasena']; ?>" name="pass" id="pass" required>
                    </div>

                    <!--Input extra escondido para obtener el id y con el, poder utilizarlo en la edición del usuario-->
                    <input type="hidden" class="form-control" value="<?php echo $datosAdmin['id']; ?>" name="id">
                    <button type="submit" name="accion" value="editar" href="admin_main_dashboard.php" class="btn btn-secondary">Volver</button>
                    <button type="submit" name="accion" value="editar" class="btn btn-primary">Editar</button>
                </form>
            </div>
        </div>
    </section>
    <?php
    //Se libera la memoria para no causar problemas de rendimiento
    mysqli_free_result($resultado);

    //Cerramos conexión
    $conn->close();
    ?>
    <!-- Uso del footer -->
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