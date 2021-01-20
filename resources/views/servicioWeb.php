
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/myWebIoT.css">
    <title> Servicio Web</title>
</head>
<body>

<?php include "com/cabecera.php"; ?>

<section class="maincentrado">
    <header class="encabezado">
        <p>Información del sensor:</p>
    </header>

    <article id="contacto">


    <?php

    if($_SERVER["REQUEST_METHOD"]=="GET") {
        if (isset($_GET["idSensor"]) && isset($_GET["fechaDesde"]) && isset($_GET["fechaHasta"])) {

            $id = $_GET['idSensor'];
            $desde = $_GET['fechaDesde'];
            $hasta = $_GET['fechaHasta'];
        }

        $request = "http://laboratorio.test/servicioWebFechas/" . $id . "/" . $desde . "/" . $hasta;
        $http = curl_init($request);
        curl_setopt($http, CURLOPT_HEADER, false);
        curl_setopt($http, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($http);
        $status_code = curl_getinfo($http, CURLINFO_HTTP_CODE);
        curl_close($http);
        if ($status_code == 200) {
            $datos = json_decode($response);

            echo '<table><tr><th>ID del Canal</th><th>Valor del dato</th><th>Fecha de la toma</th></tr>';

            if (json_last_error() == JSON_ERROR_NONE) {
                foreach ($datos as $sensor) {

                    echo '<tr>';
                    echo '<td>' . $sensor->id_canal . '</td>';
                    echo '<td>' . $sensor->dato . '</td>';
                    echo '<td>' . $sensor->fecha . '</td>';
                    echo '</tr>';
                }
            }
            echo '</table>';
        } else {
            echo "Falló la llamada al Servicio Web. Error: " . $status_code;
        }
    }
    ?>

    </article>
</section>

<?php  include "com/footer.php"  ?>

</body>
</html>
