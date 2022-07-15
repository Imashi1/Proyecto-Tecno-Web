<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Conexion con Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- Conexion con la hoja de estilo estilo-->
    <link type="text/css" rel="stylesheet" href="../../css/estilo.css">
    <title>UTARICO Editar usuario</title>
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
    //de la forma $datosUser['nombreColumna'];
    $datosUser = $resultado->fetch_array(MYSQLI_ASSOC);

    ?>
    <header>
        <nav class="navbar navbar-dark bg-primary justify-content-start">
            <a class="navbar-brand" href="main.html"> Página Principal</a>
        </nav>
    </header>

    <div class="container">
        <!-- Procedemos a mostrar los datos-->
        <!-- junto con los datos actualmente en la base de datos-->
        <!-- action representa hacia donde van los datos del form -->
        <form action="../user/edit_user_trigger.php" class="bg-light my-3 p-3 border rounded" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" value="<?php echo $datosUser['nombre']; ?>" name="nombre" id="nombre" required>
            </div>

            <div class="form-group">
                <label for="apelido">Apellido:</label>
                <input type="text" class="form-control" value="<?php echo $datosUser['apellido']; ?>" name="apellido" id="apellido" required>
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" class="form-control" value="<?php echo $datosUser['correo']; ?>" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="pass">Contraseña:</label>
                <input type="password" class="form-control" value="<?php echo $datosUser['contrasena']; ?>" name="pass" id="pass" required>
            </div>

            <!--Input extra escondido para obtener el id y con el, poder utilizarlo en editar.php-->
            <input type="hidden" class="form-control" value="<?php echo $datosUser['id']; ?>" name="id">

            <button type="submit" name="accion" value="editar" class="btn btn-primary">Editar</button>
        </form>
    </div>
    <?php
    //Se libera la memoria para no causar problemas de rendimiento
    mysqli_free_result($resultado);

    //Cerramos conexión
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