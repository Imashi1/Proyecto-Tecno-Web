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
</head>

<body>
    <header>
        <nav class="navbar navbar-dark bg-primary justify-content-start">
            <a class="navbar-brand" href="main.html"> Página Principal</a>
        </nav>
    </header>
    <?php
    //Verificamos que estamos conectados a la base de datos
		session_start();
		include("../conexion.php");
		$ID= $_SESSION["id"];
		$sql=mysqli_query($conn,"SELECT * FROM proyecto.administradores where id='$ID' ");
		$row  = mysqli_fetch_array($sql);

        //Realizamos la consulta para obtener todas las filas de la tabla productos
        $mostrar_todo = "SELECT nombre, apellido, correo, fecha_creacion FROM proyecto.usuarios";
        $usuarios = $conn->query($mostrar_todo);
    ?>
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
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($usuarios as $usuario) { ?>
                                <tr>
                                    <td><?php echo $usuario['nombre']; ?></td>
                                    <td><?php echo $usuario['apellido']; ?></td>
                                    <td><?php echo $usuario['correo']; ?></td>
                                    <td><?php echo $usuario['fecha_creacion']; ?></td>
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
            <a class="navbar-brand" href="main.html"> Página Principal</a>
        </nav>
    </footer>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <!-- Fin Boostrap -->

</body>
</html>