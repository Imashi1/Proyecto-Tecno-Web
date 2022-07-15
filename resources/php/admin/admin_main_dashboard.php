<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UTARICO Datos Usuarios</title>
    <!-- Conexion con Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- Conexion con la hoja de estilo estilo-->
    <link type="text/css" rel="stylesheet" href="../../css/estilo.css">
    <?php
    //Verificamos que estamos conectados a la base de datos
		session_start();
		include("../conexion.php");
		$ID= $_SESSION["id"];
		$sql=mysqli_query($conn,"SELECT * FROM proyecto.administradores where id='$ID' ");
		$row  = mysqli_fetch_array($sql);

        //Consulta para obtener todos los usuarios registrados
        $mostrar_todo = "SELECT id, nombre, apellido, correo, fecha_creacion FROM proyecto.usuarios";
        $usuarios = $conn->query($mostrar_todo);
    ?>
</head>

<body>
    <!--Header-->
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
                <div class="my-3 p-3">
                    <h2 class="text-center">Bienvenido <?php echo $_SESSION["nombre"] ?> <?php echo $_SESSION["apellido"] ?></h2>
                    <div class="table table-responsive">
                        <table class="table table-bordered my-3">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Fecha Creacion</th>
                                <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!--Prodecemos a mostrar los usuarios-->
                        <?php foreach ($usuarios as $usuario) { ?>
                            <tr>

                                <td><?php echo $usuario['nombre']; ?></td>
                                <td><?php echo $usuario['apellido']; ?></td>
                                <td><?php echo $usuario['correo']; ?></td>
                                <td><?php echo $usuario['fecha_creacion']; ?></td>
                                <td>
                                    <a name='id' class="btn btn-info" href="admin_user_edit_form.php?id='<?php echo $usuario['id']; ?>'">Editar</a>
                                    <a name='id' type="submit" method="POST" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete" >Eliminar</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    </div> 
                </div>
            </div>
        </div>

    </section>
    <!-- Modal para eliminar-->
    <div class="modal fade" id="confirm-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">		
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    ¿Desea eliminar este usuario?
                </div>
                
                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</a>
                    <a name='id' type="submit" method="POST" class="btn btn-danger" href="../user/user_delete_trigger.php?id='<?php echo $usuario['id']; ?>'">Eliminar</a>
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