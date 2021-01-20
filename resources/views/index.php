<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/myWebIoT.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.4.1.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script language="JavaScript" src="js/ajax.js"></script>
    <script language="JavaScript" src="js/mostrarGraficaCanal.js"></script>


    <title> Plataforma Web para IoT</title>

</head>
<body>

<?php include "com/cabecera.php"; ?>

<aside id="lateral">
    <article>
        <h1>Información actualizada en tiempo real:</h1>
        <p>Número de usuarios:
        <p id="usuarios">
            <script>
                setTimeout(numero_usuario,1000);
            </script>
        </p>
        </p>
        <p> Canales:
        <p id="canales">
            <script>
                setTimeout(numero_canales,1000);
            </script>
        </p>
        </p>
        <p> Sensores:</p>
        <p id="sensores">
            <script>
                setTimeout(numero_sensores,1000);
            </script>
        </p>
        </p>
        <p> Bytes/MB almacenados:</p>
        <p id="capacidad">
            <script>
                setTimeout(capacidad_datos,1000);
            </script>
        </p>
        </p>
    </article>
</aside>


<section class="mainindex">
    <article class="articulo">
        <h1>MyWebIoT</h1>
        <p>WebIoT es una plataforma web analitica de Internet de las Cosas que permite agregar, visualizar y analizar en
            vivo datos en la nube. Puede enviar datos a WebIoT desde sus dispositivos, crear visualizacion de datos en
            vivo y enviar alertas. </p>

        <?php
        $usuario = session('nombre');
        if(isset($usuario)) {
            echo '<a href="misCanales"> <button class="boton" id="botoncentro">Ver mis canales</button></a>';
        } else {
            echo '<a href="login"> <button class="boton" id="botoncentro">Empieza YA</button></a>';
        }
        ?>


    </article>
    <article class="articulo">
        <h1>Últimos canales</h1>
        <div class="graficas">

        <div class="grafica">
          <canvas id="graficaPenultima"></canvas>
            <script>
                $.get('ultimosCanales', function (data) {
                    mostrarGraficaCanal("graficaPenultima", data[1].id);
                });
            </script>
        </div>

            <div class="grafica">
                <canvas id="graficaUltima"></canvas>
                <script>
                    $.get('ultimosCanales', function (data) {
                        mostrarGraficaCanal("graficaUltima", data[0].id);
                    });
                </script>
            </div>
        </div>
    </article>
</section>

<?php include "com/footer.php"  ?>

</body>
</html>

