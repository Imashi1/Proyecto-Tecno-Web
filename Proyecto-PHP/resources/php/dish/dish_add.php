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
            <a class="navbar-brand" href="main.html"> Página Principal</a>
        </nav>
    </header>
    <?php
        include("../conexion.php");
        $id= $_GET['id'];
        $mostrar_vendedor = "SELECT id, nombreTienda FROM proyecto.ubicaciones WHERE  id = $id";
        $vendedor = $conn->query($mostrar_vendedor);
        foreach ($vendedor as $vend_array) {
        }
    ?>
    <div class="signup-form">
            <h2>Añadir Plato para vendedor <?php echo $vend_array['nombreTienda']?></h2>
            <p class="hint-text">Información del Plato</p>
        <form action="dish_add_trigger.php" method="post" enctype="multipart/form-data">
            

            <div class="form-group">
                <label for="nombreTienda">Nombre Plato:</label>
                <input type="text" class="form-control" name="nombrePlato" id="nombrePlato" placeholder="Nombre de la Tienda" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción del Plato:</label>
                <input type="textarea" class="form-control" name="descripcionPlato" id="descripcionPlato" placeholder="Descripción del Plato" required>
            </div>

            <div class="form-group">
                <label for="nombreTienda">Precio:</label>
                <input type="text" class="form-control" name="precioPlato" id="precioPlato" placeholder="Precio del Plato" required>
            </div>

            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <input type="file" class="form-control" name="imagenPlato" id="imagenPlato"/>
            </div>



            <!--Input extra escondido para obtener el id y con el, poder utilizarlo en editar.php-->
            <input type="hidden" class="form-control" value="<?php echo $id; ?>" name="idUbicacion">
            

            <button type="submit" name="accion" value="editar" class="btn btn-primary">Añadir</button>
        </form>
    </div>
    <footer>
        <nav class="navbar navbar-dark bg-primary justify-content-end">
            <a class="navbar-brand" href="main.html"> Página Principal</a>
        </nav>
    </footer>
</body>

</html>