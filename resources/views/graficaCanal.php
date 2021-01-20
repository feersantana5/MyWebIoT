<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Grafica Canal</title>
    <base href="/" target="_top">
    <link rel="stylesheet" href="css/myWebIoT.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script language="JavaScript" src="js/mostrarGraficaCanal.js"> </script>

</head>
<body>

<?php  include "com/cabecera.php"; ?>


<section class="maincentrado">
    <header class="encabezado">
        <?php
        $canal = \App\Canal::where('id', $id)->first();
        $usuario = \App\Usuario::where('id', $canal->id_user)->first();
        $sensor = \App\Sensor::where('id', $canal->id)->first();
        ?>

        <p>Gráfica del canal: <?php echo $canal->nombreCanal ?></p>
    </header>

    <article id="latGrafica">
        <hgroup>
            <h3>Autor: <?php echo $usuario->nombre ?></h3>
            <h3>Descripción: <?php echo $canal->descripcion ?></h3>
            <h3>Fecha de creación:  <?php echo $canal->fecha ?></h3>
            <h3>Nombre del sensor: <?php echo $canal->nombreSensor?></h3>
            <h3>Datos del sensor: <?php echo '<a href="/datosSWSensor">enlace al servicio web </a>' ?> </h3>
        </hgroup>
    </article>



    <div class="graficas">
    <div class="graficaGrande">
        <canvas id="graficaCanal"></canvas>
        <script>
            mostrarGraficaCanal("graficaCanal", <?php echo $canal->id ?>);
        </script>
    </div>
    </div>
</section>


<?php  include "com/footer.php"  ?>

</body>
</html>

