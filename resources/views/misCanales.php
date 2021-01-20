<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mis Canales</title>
    <link rel="stylesheet" href="css/myWebIoT.css">
</head>
<body>

<?php include "com/cabecera.php"; ?>


<section class="maincentrado">
    <a href="crearCanal"><button class="boton">Nuevo Canal</button></a>
    <header class="encabezado">
        <p>Listado de todos los Canales dados de alta del usuario:</p>
    </header>

    <?php
    if(session()->has("user") == true){
    if (isset($canales)){
    foreach ($canales as $canal){
    ?>

    <article class="articulo">

        <button class="basura" onclick="window.location.href='misCanales/<?php echo $canal->id ?>'"><img src="Imagenes/basura.png" alt="eliminar" height="20" width="20" ></button>

        <hgroup>
            <h2>Información sobre el canal: <?php echo $canal->nombreCanal ?></h2>
            <h3>Autor: <?php echo session("nombre") ?></h3>
            <h3>Descripción: <?php echo $canal->descripcion ?></h3>
            <h3>Fecha:  <?php echo $canal->fecha ?></h3>
            <h3>Enlace URL: <?php echo '<a href="/graficaCanal/' . $canal->id  . '">Enlace al canal</a>' ?></h3>

        </hgroup>
    </article>

    <?php  }} }?>

</section>

<nav id="navnumeros">
    <ul>
        <li class="navcanales"><a href="#"><</a></li>
        <li class="navcanales"><a href="#">1</a></li>
        <li class="navcanales"><a href="#">2</a></li>
        <li class="navcanales"><a href="#">3</a></li>
        <li class="navcanales"><a href="#">></a></li>
    </ul>
</nav>

<?php include "com/footer.php" ?>
</body>
</html>
