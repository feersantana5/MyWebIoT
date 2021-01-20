<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="/" target="_top">
    <link rel="stylesheet" href="css/myWebIoT.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.4.1.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script language="JavaScript" src="js/ajaxShop.js"></script>

    <title> Perfil MyIoT Social</title>

</head>
<body>

<?php include "com/cabecera.php"; ?>

<?php
$usuario = \App\Usuario::where('id', session("user"))->first();
?>

<nav id="vertical">
    <ul>
        <li><a href="social/socialMiembros">Miembros</a></li>
        <li><a href="social/socialAmigos">Amigos</a></li>
        <li><a href="social/socialMensajes">Mensajes</a></li>
        <li><a href="social/socialCanales">Canales</a></li>
        <li><a class="active" href="social/socialPerfil">Perfil</a></li>
    </ul>
</nav>

<section class="mainshop">

    <header class="encabezado">
        <p>Perfil de MyIoT Social:</p>
    </header>

    <article class="articulo" id="adminLista">

        <header>
            <h1>Perfil del usuario: <?php echo $usuario->nombre; ?></h1>
        </header>

        <hgroup>
            <p style="display: inline-block; font-weight: bold">Nombre Usuario: <p style="display: inline-block"></p><?php echo $usuario->nombre; ?> <p></p>
            <p style="display: inline-block; font-weight: bold">Estado:<p style="display: inline-block"><?php echo $usuario->estado; ?></p></p>
            <p style="display: inline-block; font-weight: bold">Foto: <img style="margin-left: 1em" src="<?php if(file_exists("perfiles/".session('nombre').".jpg")){ echo "perfiles/".session('nombre').".jpg"; }else{ echo "\"perfiles/user.png\"";} ?>" alt=" No tienes foto de perfil"> </p>
        </hgroup>

    </article>

    <article class="articulo" id="adminLista">

        <form method="post" action="procesar_estado_editado">
            <?= csrf_field() ?>
            <fieldset>
                <legend>Actualice su estado</legend>
                <p>
                    <label> Estado:
                        <input type="text" name="estado" value="<?php echo $usuario->estado?>" required/>
                    </label>
                </p>
                <input type="hidden" name="idUsuario" value="<?php echo $usuario->id ?>">
                <input type="reset" value="Borrar"/>
                <input type="submit" value="Actualizar"/>
            </fieldset>
        </form>

    </article>

    <article class="articulo" id="adminLista">

        <form method="post" action="procesar_imagen_editado" enctype="multipart/form-data" data-ajax='false' >
            <?= csrf_field() ?>

            <fieldset>
                <legend>Actualice su foto de perfil</legend>
                <p>
                    <label> Imagen:
                        <img style="width: 10vw; height: auto;" src="<?php if(file_exists("perfiles/".session('nombre').".jpg")){ echo "perfiles/".session('nombre').".jpg"; }else{ echo "\"perfiles/user.png\"";} ?>">

                        <input type="file" id="image" name="image" required/>
                    </label>
                </p>

                <input type="hidden" name="idUsuario" value="<?php echo $usuario->id ?>">
                <input type="reset" value="Borrar"/>
                <input type="submit" value="Actualizar"/>
            </fieldset>
        </form>

    </article>

</section>


<?php include "com/footer.php"  ?>

</body>
</html>
