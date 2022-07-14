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

        //Obtenemos la id de la ubicación a través de la url
        $id= $_GET['id'];

        //Consulta para obtener la id y tienda de la tienda a la cual se agregará el plato
        $mostrar_vendedor = "SELECT id, nombreTienda FROM proyecto.ubicaciones WHERE  id = $id";

        //Ejecutamos la consulta
        $vendedor = $conn->query($mostrar_vendedor);
        foreach ($vendedor as $vend_array) {
        }
    ?>
    <div class="principal ">
        
        <div class="signup-form">
            <!--Action que envía los datos para el registro-->
            <form action="dish_register_trigger.php" method="post" enctype="multipart/form-data" class="bg-light my-3 p-3 border rounded">
                <h2>Añadir Plato para vendedor <?php echo $vend_array['nombreTienda']?></h2>
                <!--Se agregan los campos para añadir un plato-->
                <p class="hint-text">Información del Plato</p>

                <div class="form-group">
                    <label for="nombreTienda">Nombre Plato</label>
                    <input type="text" class="form-control" name="nombrePlato" id="nombrePlato" placeholder="Nombre del PLato" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción del Plato</label>
                    <input type="textarea" class="form-control" name="descripcionPlato" id="descripcionPlato" placeholder="Descripción del Plato" required>
                </div>

                <div class="form-group">
                    <label for="nombreTienda">Precio</label>
                    <input type="text" class="form-control" name="precioPlato" id="precioPlato" placeholder="Precio del Plato" required>
                </div>

                <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input type="file" class="form-control-file" name="imagenPlato" id="imagenPlato"/>
                </div>



                <!--Input extra escondido para obtener el id y con el, poder utilizarlo en editar.php-->
                <input type="hidden" class="form-control" value="<?php echo $id; ?>" name="idUbicacion">
                

                <button type="submit" name="accion" value="editar" class="btn btn-primary">Añadir</button>
            </form>
        </div>
    </div>
    <footer>
        <nav class="navbar navbar-dark bg-primary justify-content-end">
            <a class="navbar-brand" href="../admin/admin_main_dashboard.php"> Página Principal</a>
        </nav>
    </footer>
</body>

</html>