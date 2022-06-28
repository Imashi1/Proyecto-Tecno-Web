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
		$sql=mysqli_query($conn,"SELECT * FROM proyecto.usuarios where id='$ID' ");
		$row  = mysqli_fetch_array($sql);

    //Realizamos la consulta para obtener todas las filas de la tabla productos
        $mostrar_todo = "SELECT id, nombre, imagen, precio, descripcion FROM lab04.productos";
        $productos = $conn->query($mostrar_todo);
    ?>
    <h1>Bienvenido <?php echo $_SESSION["nombre"] ?> <?php echo $_SESSION["apellido"] ?></p></h1>
    <div class="container">
        <div class="row">
            <!--Procedemos a mostrar cada fila obtenida en la consulta-->
            <?php foreach ($productos as $producto) { ?>
                <!-- Contenido arriba de la carta -->
                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="producto-card one">
                        <div class="card-img top" style="  background: url('./Fotos/<?php echo $producto['imagen']; ?> ') no-repeat;">
                            <div class="card-img-overlay contenido">
                                <span class="card-title texto"><?php echo $producto['nombre']; ?></span>
                            </div>
                        </div>

                        <div class="card-body bottom">
                            <div class="contenido">
                                <ul class="valores_producto">
                                    <li>
                                        <span class="nombre_valor">Precio: </span>
                                        <span class="valor_item align-middle float-right">
                                            <span class="card-text texto mt-2 align-top">$ <?php echo $producto['precio']; ?></span>
                                        </span>
                                    </li>

                                    <li>
                                        <span class="date">Descripcion: </span>
                                        <span class=" card-text texto mt-2 align-top align-middle float-right">
                                            <?php echo $producto['descripcion']; ?></span>
                                    </li>
                                </ul>

                                <ul class="mt-3">
                                    <a class="btn btn-primary" href="Ver.php?id=' <?php echo $producto['id']; ?>'">Ver Más</a>
                                    <a name='id' class="btn btn-info" href="formularioEditar.php?id='<?php echo $producto['id']; ?>'">Editar</a>
                                    <a type="submit" method="POST" class="btn btn-danger" href="Eliminar.php?id='<?php echo $producto['id']; ?>'">Eliminar</a>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            <!--Terminamos el ciclo-->
            <?php } ?>
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