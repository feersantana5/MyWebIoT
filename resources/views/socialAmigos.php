<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="/" target="_top">
    <link rel="stylesheet" href="css/myWebIoT.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.4.1.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script language="JavaScript" src="js/ajaxShop.js"></script>

    <title> Amigos MyIoT Social</title>

</head>
<body>

<?php include "com/cabecera.php"; ?>


<nav id="vertical">
    <ul>
        <li><a href="social/socialMiembros">Miembros</a></li>
        <li><a class="active" href="social/socialAmigos">Amigos</a></li>
        <li><a href="social/socialMensajes">Mensajes</a></li>
        <li><a href="social/socialCanales">Canales</a></li>
        <li><a href="social/socialPerfil">Perfil</a></li>
    </ul>
</nav>

<section class="mainshop">

    <header class="encabezado">
        <p>Amigos de MyIoT Social:</p>
    </header>

    <article class="articulo">
        <header>
            <h1>Siguiendo:</h1>
        </header>

        <?php
        if (isset($amigos,$usuarios)){
            foreach ($amigos as $amigo) {
                if ($amigo->id_user == session('user')) {
                    foreach ($usuarios as $usuario){
                        if ($amigo->id_follower == $usuario->id) {
                        ?>

                        <p> <?php echo $usuario->nombre; ?></p>

                    <?php }}}}} ?>

    </article>

    <article class="articulo">
        <header>
            <h1>Followers:</h1>
        </header>

        <?php
        if (isset($amigos,$usuarios)){
        foreach ($amigos as $amigo) {
            if ($amigo->id_follower == session('user')) {
                foreach ($usuarios as $usuario){
                    if ($amigo->id_user == $usuario->id) {
                        ?>

                        <p> <?php echo $usuario->nombre; ?></p>

                    <?php }}}}} ?>

    </article>
</section>


<?php include "com/footer.php"  ?>

</body>
</html>
