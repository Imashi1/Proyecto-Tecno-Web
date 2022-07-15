<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UTARICO Agregar Tiendas</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js"></script>
    <!-- Conexion con Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- Conexion con la hoja de estilo estilo-->
    <link type="text/css" rel="stylesheet" href="../../css/estilo.css">
</head>

<body>
    <?php
        //Obtenemos el id del administrador
        session_start();
        include("../conexion.php");
        $id = $_GET['id'];
        $ID= $_SESSION["id"];
    ?>
    <!-- SECCION NAVEGACIÓN-->
    <!--Header-->
    <header>
        <nav class="navbar navbar-dark bg-primary navbar-expand-md col-12">
            <div class="container">      
                <a href="../admin/admin_main_dashboard.php" class="navbar-brand">
                  <strong>UTARICO</strong>
                </a>
                  <button type="button" class="navbar-toggler" data-toggle="collapse"
                  data-target="#menu-principal" aria-controls="menu-principal" aria-expanded="false"
                  aria-label="Desplegar menú de navegación">
                  <span class="navbar-toggler-icon"></span>
                </button>
          
                <div class="collapse navbar-collapse" id="menu-principal">
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="../admin/admin_vendor_dashboard.php" class="nav-link">Ver Tiendas</a></li>
                    <li class="nav-item"><a href="../vendor/vendor_register_form.php?id='<?php echo $ID; ?>'" class="nav-link">Agregar Tienda</a></li>
                    <li class="nav-item"><a href="../admin/admin_logout.php" class="nav-link">Cerrar Sesión</a></li>
                  </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- Divimos la sección en dos partes -->
    <section class="container mt-3">
        <div class="row">
            <!--La primera que contiene el formulario para agregar una nueva tienda-->
            <div class="col-12 col-md-6">
                <!--Action que dirige los datos insertados al registro-->
                <form action="vendor_register_trigger.php" method="POST" enctype="multipart/form-data" class="bg-light my-3 p-3 border rounded">
                    <div class="text-center">
                        <h2>Agregar Tienda</h2>
                        <p class="hint-text">Agrega un nombre y una descripcion breve</p>
                    </div>
                    <div class="form-group">
                        <label for="nombreTienda">Nombre</label>
                        <input type="text" class="form-control" name="nombreTienda" id="nombreTienda" placeholder="Nombre de la Tienda" required>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" name="descripcion" id="descripcion" placeholder="Descripción" required></textarea>
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
            <!--Y la segunda parte, será el mapa donde podremos darle click y obtener las coordenadas para la ubicación de la tienda-->
            <div class="col-12 col-md-6">
                <br><br><br><br><br>
                <br>
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

                            var lat = 0.0;
                            var lng = 0.0;
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

                            map.on('click', function(e) {
                                var coordinates = e.lngLat;
                                var lat = coordinates.lat;
                                var lng = e.lngLat.lng;
                                document.getElementById("latitud").value = lat;
                                document.getElementById("longitud").value = lng;
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