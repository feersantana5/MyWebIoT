<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="/" target="_top">
    <link rel="stylesheet" href="css/myWebIoT.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.4.1.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script language="JavaScript" src="js/ajaxShop.js"></script>

    <title> Canales MyIoT Social</title>

</head>
<body>

<?php include "com/cabecera.php"; ?>


<nav id="vertical">
    <ul>
        <li><a  href="social/socialMiembros">Miembros</a></li>
        <li><a href="social/socialAmigos">Amigos</a></li>
        <li><a href="social/socialMensajes">Mensajes</a></li>
        <li><a class="active" href="social/socialCanales">Canales</a></li>
        <li><a href="social/socialPerfil">Perfil</a></li>
    </ul>
</nav>

<section class="mainshop">

    <header class="encabezado">
        <p>Canales de MyIoT Social:</p>
    </header>

    <article class="articulo">

        <header>
            <h1>Canales del usuario:</h1>
        </header>

        <?php
        if(session()->has("user") == true){
            if (isset($canales)){
                foreach ($canales as $canal){
                    if($canal->id_user == session('user')){ ?>

                    <article class="articulo">

                        <hgroup>
                            <h2>Nombre del canal: <?php echo $canal->nombreCanal ?></h2>
                            <h3>Autor: <?php echo session("nombre") ?></h3>
                            <h3>Descripción: <?php echo $canal->descripcion ?></h3>
                            <h3>Fecha:  <?php echo $canal->fecha ?></h3>
                            <h3>Enlace URL: <?php echo '<a href="/graficaCanal/' . $canal->id  . '">Enlace al canal</a>' ?></h3>

                        </hgroup>
                    </article>

                <?php  }}}}?>

    </article>


    <article class="articulo">

        <header>
            <h1>Canales de Usuarios Seguidos:</h1>
        </header>

        <?php
        if (isset($canales,$usuarios,$amigos)){
            foreach ($canales as $canal) {
                    foreach ($amigos as $amigo){
                            if ($amigo->id_user == session('user')) {
                                if($amigo->id_follower == $canal->id_user)
                                    foreach ($usuarios as $usuario) {
                                        if($canal->id_user == $usuario->id){
        ?>
                            <h2 id="adminLista">Usuario: <?php echo $usuario->nombre ?></h2>


                        <article class="articulo">
                            <hgroup>
                                <h3>Nombre del Canal: <?php echo $canal->nombreCanal ?></h3>
                                <h3>Descripción: <?php echo $canal->descripcion ?></h3>
                                <h3>Fecha:  <?php echo $canal->fecha ?></h3>
                                <h3>Enlace URL: <?php echo '<a href="/graficaCanal/' . $canal->id  . '">  Enlace al canal</a>' ?></h3>
                            </hgroup>
                        </article>

                    <?php }}}}}}?>
    </article>

</section>


<?php include "com/footer.php"  ?>

</body>
</html>
