<?php
    //Comprobamos conexión a la base de datos
    include("../conexion.php");

    //Obtención de la id de usuario por medio del url
    $idUser = $_GET['idUser'];

    //Consulta para obtener los nombres de los platos y la cantidad
    $consulta_plato = "SELECT platos.nombrePlato, COUNT(usuarioplato.idPlato) AS conteoPlato
                FROM usuarioplato JOIN platos ON platos.idPlato = usuarioplato.idPlato 
                WHERE usuarioplato.idUser = $idUser
                GROUP BY platos.nombrePlato
                ORDER BY COUNT(usuarioplato.idPlato) DESC";

    //Aplicamos la consulta
    $rows = $conn->query($consulta_plato);

    //Inicialización de dos arrays
    $platos = array();
    $conteo_plato = array();
    foreach($rows as $row){
        //Añadimos el resultado de la columna a su respectivo array
        $platos[] = $row['nombrePlato'];
        $conteo_plato[] = $row['conteoPlato'];
    }
    $rows->close();

    //Consulta para obtener los nombres de las ubicaciones y su cantidad 
    $consulta_ubicaciones = "SELECT ubicaciones.nombreTienda, COUNT(usuarioubicacion.idUbicacion) AS conteoUbicacion
                FROM usuarioubicacion JOIN ubicaciones ON ubicaciones.id = usuarioubicacion.idUbicacion
                WHERE usuarioubicacion.idUser = $idUser
                GROUP BY ubicaciones.nombreTienda
                ORDER BY COUNT(usuarioubicacion.idUbicacion) DESC";
    
    //Aplicamos la consulta
    $filas = $conn->query($consulta_ubicaciones);

    //Inicialización de dos arrays
    $ubicaciones = array();
    $conteo_ubicacion = array();
    foreach($filas as $fila){
        //Añadimos el resultado de la columna a su respectivo array
        $ubicaciones[] = $fila['nombreTienda'];
        $conteo_ubicacion[] = $fila['conteoUbicacion'];
    }
    $filas->close();
    $conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Conexion con Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- Conexion con la hoja de estilo estilo-->
    <link type="text/css" rel="stylesheet" href="../../css/estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Clase principal (hijo de contenedor) */
        .principal {
            /* margin-top: 50px; */
            background-color: white;
            padding: 20px;
            /* Siempre tomara el mismo ancho que el contenedor */
            width: 100%;
        }
    </style>    
</head>
<body>
    <!--Header-->
    <nav class="navbar navbar-dark bg-primary navbar-expand-md col-12">
        <div class="container">
            <a href="user_main_dashboard.php" class="navbar-brand">
                <strong>UTARICO</strong>
            </a>

            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu-principal" aria-controls="menu-principal" aria-expanded="false" aria-label="Desplegar menú de navegación">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu-principal">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="user_stats.php?idUser=<?php echo $ID ?>" class="nav-link">Estadísticas</a></li>
                    <li class="nav-item"><a href="user_logout.php" class="nav-link">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="principal">
        <div class="row">
            <div class="col-12 col-md-6">
                <!--Gráfico que mostrará los 3 platos más consumidos por el usuario-->
                <div class="chartBox">
                    <canvas id="myChart"></canvas>
                </div>
                <div class="card">
                    <!--Mostrará el plato más pedido del usuario-->
                    <div class="card-body"> El plato más pedido es: <?php echo $platos['0'] ?? "No hay datos" ;?> </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <!--Gráfico que mostrará los vendedores más visitados por el usuario-->
                <div class="chartBox">
                    <canvas id="myChart2"></canvas>
                </div>   
            </div>
        </div>

    </section>
    <script>
        //Bloque setup
        //Transformamos en json para que sea utilizable por el gráfico
        const plato_json = <?php echo json_encode($platos);?>;
        const conteo_json = <?php echo json_encode($conteo_plato);?>;
        const data = {
            labels: plato_json,
            datasets: [{
                label: '# de Platos registrados',
                data: conteo_json,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        };
        //Bloque de configuración
        const config = {
            type: 'bar',
            data,
            options: {}
        };
        //Bloque renderizado
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
    <script>
        //Bloque setup
        //Transformamos en json para que sea utilizable por el gráfico
        const ubicacion_json = <?php echo json_encode($ubicaciones);?>;
        const conteo_ubicacion_json = <?php echo json_encode($conteo_ubicacion);?>;
        const datapie = {
            labels: ubicacion_json,
            datasets: [{
                label: '# de tiendas registradas',
                data: conteo_ubicacion_json,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        };
        //Bloque de configuración
        const config2 = {
            type: 'pie',
            data: datapie,
            options: {}
        };
        //Bloque Renderizado
        const myChart2 = new Chart(
            document.getElementById('myChart2'),
            config2
        );
    </script>
    <!--Footer-->
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
