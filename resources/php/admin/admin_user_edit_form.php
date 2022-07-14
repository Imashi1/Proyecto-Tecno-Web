<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous" />
    <!-- Fin Boostrap -->
    <title>Document</title>
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
        <nav class="navbar navbar-dark bg-primary justify-content-start">
            <a class="navbar-brand" href="admin_main_dashboard.php"> Página Principal</a>
        </nav>
    </header>

    <div class="container">
        <!-- Procedemos a mostrar los datos-->
        <!-- junto con los datos actualmente en la base de datos-->
        <!-- action representa hacia donde van los datos del form -->
        <form action="admin_user_edit_trigger.php" class="bg-light my-3 p-3 border rounded" method="POST" enctype="multipart/form-data">

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

            <button type="submit" name="accion" value="editar" class="btn btn-primary">Editar</button>
        </form>
    </div>
    <?php
    //Se libera la memoria para no causar problemas de rendimiento
    mysqli_free_result($resultado);

    //Cerramos conexión
    $conn->close();
    ?>
    <footer>
        <nav class="navbar navbar-dark bg-primary justify-content-end">
            <a class="navbar-brand" href="admin_main_dashboard.php"> Página Principal</a>
        </nav>
    </footer>

</body>

</html>