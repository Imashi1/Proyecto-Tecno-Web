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
    <?php
    //Verificamos que estamos conectados a la base de datos
		session_start();
		include("../conexion.php");
		$ID= $_SESSION["id"];
		$sql=mysqli_query($conn,"SELECT * FROM proyecto.administradores where id='$ID' ");
		$row  = mysqli_fetch_array($sql);

        //Realizamos la consulta para obtener todas las filas de la tabla productos
        $mostrar_todo = "SELECT id, nombre, apellido, correo, fecha_creacion FROM proyecto.usuarios";
        $usuarios = $conn->query($mostrar_todo);
    ?>
</head>

<body>
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
                    <li class="nav-item"><a href="estadistica.html" class="nav-link">Estadísticas</a></li>
                    <li class="nav-item"><a href="admin_vendor_dashboard.php" class="nav-link">Ver Tiendas</a></li>
                    <li class="nav-item"><a href="../vendor/vendor_register_form.php?id='<?php echo $ID; ?>'" class="nav-link">Agregar Tienda</a></li>
                    <li class="nav-item"><a href="admin_logout.php" class="nav-link">Cerrar Sesión</a></li>
                  </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <h1>Bienvenido <?php echo $_SESSION["nombre"] ?> <?php echo $_SESSION["apellido"] ?></p></h1>
    <div class="container">
        <div class="row">
            <div class="container mt-3">
                <div class="card text-center">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>apellido</th>
                                    <th>Correo</th>
                                    <th>Fecha Creacion</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($usuarios as $usuario) { ?>
                                <tr>

                                    <td><?php echo $usuario['nombre']; ?></td>
                                    <td><?php echo $usuario['apellido']; ?></td>
                                    <td><?php echo $usuario['correo']; ?></td>
                                    <td><?php echo $usuario['fecha_creacion']; ?></td>
                                    <td>
                                        <a name='id' class="btn btn-info" href="admin_user_edit_form.php?id='<?php echo $usuario['id']; ?>'">Editar</a>
                                        <a name='id' type="submit" method="POST" class="btn btn-danger" href="../user/user_delete.php?id='<?php echo $usuario['id']; ?>'">Eliminar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 
    //Cerramos la conexión
    $conn->close(); 
    
    ?>
    <footer>
        <nav class="navbar navbar-dark bg-primary justify-content-end">
            <a class="navbar-brand" href="admin_main_dashboard.php"> Página Principal</a>
        </nav>
    </footer>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <!-- Fin Boostrap -->

</body>
</html>