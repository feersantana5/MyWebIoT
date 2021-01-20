<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/myWebIoT.css">
    <title> Canales en myWebIoT</title>
</head>
<body>

<?php include "com/cabecera.php"; ?>

<section class="maincentrado">
    <?php
    $usuario = session('nombre');
    if(isset($usuario)) {
        echo '<a href="crearCanal"><button class="boton">Nuevo Canal</button></a>';
    }
    ?>

    <header class="encabezado">
        <p>Listado de todos los Canales dado de alta en MyWebIoT:</p>
    </header>

    <?php
       if (isset($canales,$usuarios)){
    foreach ($canales as $canal){
        foreach ($usuarios as $usuario){

            $id_user = $canal->id_user;
            $id = $usuario->id;
             if($id_user == $id){

            ?>

    <article class="articulo">
        <hgroup>
            <h2>Información sobre el canal: <?php echo $canal->nombreCanal ?></h2>
            <h3>Autor: <?php echo $usuario->nombre ?></h3>
            <h3>Descripción: <?php echo $canal->descripcion ?></h3>
            <h3>Fecha:  <?php echo $canal->fecha ?></h3>
            <h3>Enlace URL: <?php echo '<a href="/graficaCanal/' . $canal->id  . '">  Enlace al canal</a>' ?></h3>
        </hgroup>
    </article>

    <?php }}}} ?>

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
