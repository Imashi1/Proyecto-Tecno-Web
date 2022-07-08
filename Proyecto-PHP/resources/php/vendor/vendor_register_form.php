<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Display a map on a webpage</title>
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
            height: 80%;
        }
                /* Clase principal (hijo de contenedor) */
        .principal{
            /* margin-top: 50px; */
            background-color: white;
            padding: 20px;
            /* Siempre tomara el mismo ancho que el contenedor */
            width: 100%;
        }
    </style>
</head>

<body>
    <?php
    //Obtenemos el id de la fila a ver a través del url
    $id = $_GET['id'];
    ?>
    <!-- SECCION NAVEGACIÓN-->
    <nav class="navbar navbar-dark bg-primary navbar-expand-md col-12">
        <div class="container">
            <a href="../admin/admin_main_dashboard.php" class="navbar-brand">
                <strong>UTARICO</strong>
            </a>

            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu-principal" aria-controls="menu-principal" aria-expanded="false" aria-label="Desplegar menú de navegación">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu-principal">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="estadistica.html" class="nav-link">Estadísticas</a></li>
                    <li class="nav-item"><a href="../admin/admin_logout.php" class="nav-link">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Seccion principal donde se encuentran los articulos -->
    <section class="principal">
        <div class="row">
            <div class="col-12 col-md-6">


                <form action="vendor_register_trigger.php" method="POST" enctype="multipart/form-data" class="bg-light my-3 p-3 border rounded">

                    <div class="form-group">
                        <label for="nombreTienda">Nombre</label>
                        <input type="text" class="form-control" name="nombreTienda" id="nombreTienda" placeholder="Nombre de la Tienda" required>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="textarea" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción" required>
                    </div>

                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" class="form-control-file" name="imagen" id="imagen" />
                    </div>

                    <div class="form-group">
                        <label for="latitud">Latitud</label>
                        <input type="text" class="form-control" name="latitud" id="latitud" readonly required>
                    </div>

                    <div class="form-group">
                        <label for="longitud">Longitud</label>
                        <input type="text" class="form-control" name="longitud" id="longitud" readonly required>
                    </div>

                    <!--Input extra escondido para obtener el id y con el, poder utilizarlo en editar.php-->
                    <input type="hidden" class="form-control" value="<?php echo $id; ?>" name="id">
                    

                    <button type="submit" name="accion" value="editar" class="btn btn-success">Agregar</button>
                </form>
            </div>
            <div class="col-12 col-md-6">
                <div id="map">
                    <script>
                        mapboxgl.accessToken = 'pk.eyJ1IjoiaW1hc2hpMSIsImEiOiJjbDMwemhrcmkwNHVuM2Nvd2loM28xMm84In0.i0qnFzBwR_QT8BCpVDyDeg';
                        const map = new mapboxgl.Map({
                            container: 'map', // container ID
                            style: 'mapbox://styles/mapbox/streets-v11', // style URL
                            center: [-70.29613247361456, -18.489965686232765], // starting position [lng, lat]
                            zoom: 16.8, // starting zoom
                            maxZoom: 16.8,
                            minZoom: 16.8,
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

                            function sourceRefresh(e) {
                                var data = draw.getAll();
                                map.getSource('fields').setData(data);
                            };
                        });
                    </script>
                </div>
            </div>
        </div>
    </section>
    <!-- Uso del aside -->

    <!-- Uso del footer -->
    <footer>
        <nav class="navbar navbar-dark bg-primary justify-content-end">
            <a class="navbar-brand" href="../admin/admin_main_dashboard.php"> Página Principal</a>
        </nav>
    </footer>


</body>

</html>