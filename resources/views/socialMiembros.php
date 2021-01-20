<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="/" target="_top">
    <link rel="stylesheet" href="css/myWebIoT.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.4.1.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script language="JavaScript" src="js/ajaxShop.js"></script>

    <title> Miembros MyIoT Social</title>

</head>
<body>

<?php include "com/cabecera.php"; ?>


<nav id="vertical">
    <ul>
        <li><a class="active" href="social/socialMiembros">Miembros</a></li>
        <li><a href="social/socialAmigos">Amigos</a></li>
        <li><a href="social/socialMensajes">Mensajes</a></li>
        <li><a href="social/socialCanales">Canales</a></li>
        <li><a href="social/socialPerfil">Perfil</a></li>
    </ul>
</nav>

<section class="mainshop">

    <header class="encabezado">
        <p>Miembros de MyIoT Social:</p>
    </header>


    <article class="articulo" >
        <header>
            <h1>Todos los Usuarios de MyIoT Social:</h1>
        </header>

        <?php  if(isset ($usuarios)){
        foreach ($usuarios as $usuario) {
        if (session('user') != $usuario->id) {  ?>


        <div style="display: block">
            <p style="display: inline-flex">Usuario: <?php echo $usuario->nombre ?> </p>


            <?php  if(\App\Http\Controllers\SocialController::comprobarSiTeSigo($usuario->id) == true){  ?>

            <form style="display: inline-flex" action="unfollow/<?php echo $usuario->id ?>" method="post">
                <?= csrf_field() ?>

                <input id="btnUnfollow" type="submit" value="Unfollow"/>
            </form>

            <?php }else {  ?>

            <form style="display: inline-flex" action="follow/<?php echo $usuario->id ?>" method="post">
                <?= csrf_field() ?>
                <input id="btnFollow" type="submit" value="Follow"/>
            </form>

            <?php  }?>

            <?php if(\App\Http\Controllers\SocialController::meSiguen($usuario->id) == true) {   ?>

            <p style="display: inline-flex"> &rarr; Te sigue </p>

            <?php }else{ ?>

            <p style="display: inline-flex"> &rarr; No te sigue </p>

            <?php }?>
            <?php    }else{  ?>

                <p style="font-weight: bold">Tu: <?php echo $usuario->nombre ?> </p>


            <?php  }}}?>

                </div>





    </article>
</section>

<?php include "com/footer.php"  ?>

</body>
</html>

