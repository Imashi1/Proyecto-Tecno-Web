<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>dashboard</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        
        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
            height: 95%;
        }
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
    <!-- SECCION NAVEGACIÓN-->
    <nav class="navbar navbar-dark bg-primary navbar-expand-md col-12">
        <div class="container">
            <a href="../user/dashboard.php" class="navbar-brand">
                <strong>UTARICO</strong>
            </a>

            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu-principal" aria-controls="menu-principal" aria-expanded="false" aria-label="Desplegar menú de navegación">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu-principal">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="estadistica.html" class="nav-link">Estadísticas</a></li>
                    <li class="nav-item"><a href="main.html" class="nav-link">Mi Cuenta</a></li>
                    <li class="nav-item"><a href="login.html" class="nav-link">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Seccion principal donde se encuentran los articulos -->
    <section class="principal">
        <div class="row">
            <div class="col-12 col-md-6">
                <?php
                    session_start();
                    include("../conexion.php");
                    $mostrar_todo = "SELECT id,nombreTienda, descripcionTienda, imagen, latitud, longitud FROM proyecto.ubicaciones";
                    $ubicaciones = $conn->query($mostrar_todo); 
                ?>
                <?php foreach ($ubicaciones as $ubicacion) { ?>
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-3">
                                <img src="../../../img/<?php echo $ubicacion['imagen']; ?>" alt="...">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $ubicacion['nombreTienda'];?></h5>
                                    <p class="card-text"><?php echo $ubicacion['descripcionTienda']; ?>, <?php echo $ubicacion['latitud']; ?>, <?php echo $ubicacion['longitud']; ?></p>
                                    <a href="../dish/dish_dashboard_user.php?id='<?php echo $ubicacion['id']; ?>'" class="btn btn-primary">Ver Mas</a>
                                   
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-12 col-md-6">
                <div id="map">
                    <script>
                        mapboxgl.accessToken = 'pk.eyJ1IjoiaW1hc2hpMSIsImEiOiJjbDMwemhrcmkwNHVuM2Nvd2loM28xMm84In0.i0qnFzBwR_QT8BCpVDyDeg';
                        const map = new mapboxgl.Map({
                            container: 'map', // container ID
                            style: 'mapbox://styles/mapbox/streets-v11', // style URL
                            center: [-70.29613247361456, -18.489965686232765], // starting position [lng, lat]
                            zoom: 16.5, // starting zoom
                            maxZoom: 16.5,
                            minZoom: 16.5,
                            dragPan: false,
                            dragRotate: false
                        });

                        var lat = 0.0;
                        var lng = 0.0;
                        map.on('style.load', () => {
                            // Add a data source containing GeoJSON data.


                            map.addSource('maine', {
                                'type': 'geojson',
                                'data': {
                                    'type': 'Feature',
                                    'geometry': {
                                        'type': 'Polygon',
                                        // These coordinates outline Maine.
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
                            // Add a new layer to visualize the polygon.
                            map.addLayer({
                                'id': 'maine',
                                'type': 'fill',
                                'source': 'maine', // reference the data source
                                'layout': {},
                                'paint': {
                                    'fill-color': '#0080ff', // blue color fill
                                    'fill-opacity': 0.5
                                }
                            });
                            // Add a black outline around the polygon.
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
                            /*
                            map.on('click', function(e) {
                                var coordinates = e.lngLat;
                                var lat = coordinates.lat;
                                var lng = e.lngLat.lng;
                                document.getElementById("latitud").value = lat;
                                document.getElementById("longitud").value = lng;
                                new mapboxgl.Popup()
                                    .setLngLat(coordinates)
                                    .setHTML('you clicked here: <br/>' + coordinates)
                                    .addTo(map);
                            });
                            */
                        });
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
    <!-- Uso del aside -->

    <!-- Uso del footer -->
    <footer class="pie-de-pagina text-center text-md-right bg-primary fixed-bottom text-white">
        <div class="container">
            <p class="m-0 py-3">UTARICO © </p>
        </div>
    </footer>

</body>

</html>