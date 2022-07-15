<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>UTARICO</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js"></script>
    <!-- Conexion con Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- Conexion con la hoja de estilo estilo-->
    <link type="text/css" rel="stylesheet" href="../css/estilo.css">
</head>

<body>
    <?php
        include("conexion.php");
        //Consulta para obtener todas las tiendas
        $mostrar_todo = "SELECT id, nombreTienda, descripcionTienda, imagen, latitud, longitud FROM proyecto.ubicaciones";
        $ubicaciones = $conn->query($mostrar_todo); 
    ?>
    <!-- SECCION NAVEGACIÓN-->
    <nav class="navbar navbar-dark bg-primary navbar-expand-md col-12">
        <div class="container">
            <a href="main.php" class="navbar-brand">
                <strong>UTARICO</strong>
            </a>

            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu-principal" aria-controls="menu-principal" aria-expanded="false" aria-label="Desplegar menú de navegación">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu-principal">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="../html/user/user_register.html" class="nav-link">Registrarse</a></li>
                    <li class="nav-item"><a href="../html/user/user_login.html" class="nav-link">Iniciar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Sección dividida en dos partes -->
    <section class="container mt-3">
        <div class="row">
            <!--Primero parte izquierda, donde se muestran las tiendas-->
            <div class="col-12 col-md-6">
                <!--Muestreo de las ubicaciones-->
                <?php foreach ($ubicaciones as $ubicacion) { ?>
                    <div class="card mb-3">
                        <div class="d-flex bd-highlight">
                            <div class="d-flex align-items-center bd-highlight">
                                <img class="img-card rounded" src="../../img/<?php echo $ubicacion['imagen']; ?>" alt="Imagen Tienda">
                            </div>
                            <div class="p-3 w-100 bd-highlight">
                                <div class="d-flex flex-column bd-highlight ">
                                    <dic class="d-flex bd-highlight title-card"><?php echo $ubicacion['nombreTienda'];?></dic>
                                    <div class="d-flex bd-highlight desc-card mb-3"><?php echo $ubicacion['descripcionTienda'];  ?></div>
                                    <div class="d-flex bd-highlight ml-auto ">
                                        <a href="dish/dish_dashboard_main.php?id='<?php echo $ubicacion['id']; ?>'" class="btn btn-sm btn-primary stretched-link">Ver Platos</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-12 col-md-6">
                <!--Segunda parte derecha, mapa con las marcadores de las tiendas-->
                <div id="map">
                    <script>
                        mapboxgl.accessToken = 'pk.eyJ1IjoiaW1hc2hpMSIsImEiOiJjbDMwemhrcmkwNHVuM2Nvd2loM28xMm84In0.i0qnFzBwR_QT8BCpVDyDeg';
                        const map = new mapboxgl.Map({
                            container: 'map', // Contenedor del mapa
                            style: 'mapbox://styles/mapbox/streets-v11',
                            center: [-70.29613247361456, -18.489965686232765], // Posición inicial [lng, lat]
                            zoom: 16.5,
                            maxZoom: 16.5,
                            minZoom: 16.5,
                            dragPan: false, //Evitamos que se pueda mover el mapa
                            dragRotate: false //Evitamos que se pueda rotar el mapa
                        });
                        map.on('style.load', () => {
                            map.addSource('maine', {
                                'type': 'geojson',
                                'data': {
                                    'type': 'Feature',
                                    'geometry': {
                                        'type': 'Polygon',
                                        // Coordenadas para formar el polígono
                                        'coordinates': [
                                            [
                                                [-70.29690440097548, -18.492926142805615],
                                                [-70.2955483136489, -18.49072481249017],
                                                [-70.29542132587987, -18.490383861094912],
                                                [-70.29527134115399, -18.4901468377754],
                                                [-70.29370156704957, -18.487887300902628],
                                                [-70.29514799460064, -18.487437223197645],
                                                [-70.29597352136626, -18.488672123595705],
                                                [-70.29615295163443, -18.488513442885363],
                                                [-70.29702788842533, -18.487999473119203],
                                                [-70.29740661698017, -18.488545883534357],
                                                [-70.29687712901543, -18.488898149004825],
                                                [-70.29685196354502, -18.488930295491286],
                                                [-70.29684802015491, -18.488970658283037],
                                                [-70.29685427612625, -18.489021529671405],
                                                [-70.29696003587661, -18.489223974507055],
                                                [-70.29686935143332, -18.48943515334254],
                                                [-70.29658192922938, -18.489517010369497],
                                                [-70.2982495182399, -18.4919225701955],
                                                [-70.29754116122665, -18.49244568419533]
                                            ]
                                        ]
                                    }
                                }
                            });
                            // Capa de visualización del polígono
                            map.addLayer({
                                'id': 'maine',
                                'type': 'fill',
                                'source': 'maine',
                                'layout': {},
                                'paint': {
                                    'fill-color': '#0080ff', // Relleno de color
                                    'fill-opacity': 0.5
                                }
                            });
                            // Línea exterior de polígono
                            map.addLayer({
                                'id': 'outline',
                                'type': 'line',
                                'source': 'maine',
                                'layout': {},
                                'paint': {
                                    'line-color': '#000',
                                    'line-width': 3
                                }
                            });
                        });
                        //Procedemos a colocar marcdores usando las ubicaciones guardadas.
                        <?php foreach ($ubicaciones as $ubicacion) { ?>
                            var marker1 = new mapboxgl.Marker()
                                .setLngLat([<?php echo $ubicacion['longitud'];?>, <?php echo $ubicacion['latitud'];?>])
                                .addTo(map);
                        <?php } ?>
                    </script>
                    
                </div>
            </div>
        </div>
    </section>
    <?php $conn->close(); ?>
    <!-- Uso del footer -->
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