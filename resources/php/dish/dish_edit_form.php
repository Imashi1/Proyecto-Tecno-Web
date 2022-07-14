<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <title>Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assests/css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>

<body>
    <header>
        <nav class="navbar navbar-dark bg-primary justify-content-start">
            <a class="navbar-brand" href="../admin/admin_main_dashboard.php"> Página Principal</a>
        </nav>
    </header>
    <?php
        //Verificamos que estamos conectados a la base de datos
        include("../conexion.php");

        //Obtenemos la id de la sesión del admin
        $id= $_GET['id'];

        //Realizamos la consulta para obtener los datos del plato a editar
        $mostrar_plato = "SELECT idPlato, nombrePlato, descripcionPlato, imagenPlato, precioPlato FROM proyecto.platos WHERE idPlato = $id";

        //Ejecutamos la consulta
        $platos = $conn->query($mostrar_plato);
        foreach ($platos as $plato_array) {
        }
    ?>
    <div class="container">
            <h2>Editar Plato: <?php echo $plato_array['nombrePlato']?></h2>
            <p class="hint-text">Información del Plato</p>
        <!--Action representa hacia donde se dirigirán los datos-->
        <form action="dish_edit_trigger.php" class="bg-light my-3 p-3 border rounded" method="post" enctype="multipart/form-data">
            <!--Colocamos los datos actuales del plato-->

            <div class="form-group">
                <label for="nombrePlato">Nombre Plato:</label>
                <input type="text" class="form-control" name="nombrePlato" id="nombrePlato" placeholder="Nombre de la Tienda" value="<?php echo $plato_array['nombrePlato']?>" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción del Plato:</label>
                <input type="textarea" class="form-control" name="descripcionPlato" id="descripcionPlato" placeholder="Descripción del Plato" value="<?php echo $plato_array['descripcionPlato']?>" required>
            </div>

            <div class="form-group">
                <label for="nombreTienda">Precio:</label>
                <input type="text" class="form-control" name="precioPlato" id="precioPlato" placeholder="Precio del Plato" value="<?php echo $plato_array['precioPlato']?>" required>
            </div>

            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <input type="file" class="form-control" name="imagenPlato" id="imagenPlato"/>
            </div>

            <!--Input extra escondido para obtener el id y con el, poder utilizarlo en la edición del plato-->
            <input type="hidden" class="form-control" value="<?php echo $plato_array['idPlato']; ?>" name="idPlato">
            

            <button type="submit" name="accion" value="editar" class="btn btn-primary">Editar</button>
        </form>
    </div>
    <footer>
        <nav class="navbar navbar-dark bg-primary justify-content-end">
            <a class="navbar-brand" href="../admin/admin_main_dashboard.php"> Página Principal</a>
        </nav>
    </footer>
    <?php 
        //Cerramos la conexión
        $conn->close();
    ?>
</body>

</html>