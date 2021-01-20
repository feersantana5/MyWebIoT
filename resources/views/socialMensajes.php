<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="/" target="_top">
    <link rel="stylesheet" href="css/myWebIoT.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.4.1.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script language="JavaScript" src="js/ajaxShop.js"></script>

    <title> Mensajes MyIoT Social</title>

</head>
<body>

<?php include "com/cabecera.php"; ?>


<nav id="vertical">
    <ul>
        <li><a href="social/socialMiembros">Miembros</a></li>
        <li><a href="social/socialAmigos">Amigos</a></li>
        <li><a class="active" href="social/socialMensajes">Mensajes</a></li>
        <li><a href="social/socialCanales">Canales</a></li>
        <li><a href="social/socialPerfil">Perfil</a></li>
    </ul>
</nav>

<section class="mainshop">

    <header class="encabezado">
        <p>Mensajes de MyIoT Social:</p>
    </header>

    <article class="articulo" id="adminLista">

        <header>
            <h1>Envía mensaje a un Amigo:</h1>
        </header>

        <form method="post" action="procesar_mensaje_usuario">
            <?= csrf_field() ?>
            <fieldset>
                <legend>Elija el tipo de mensaje</legend>

                <input type="hidden" name="idEmisor" value="<?php echo session('user') ?>">

                <input type='radio' name='pm' id='publico' value='0' checked='checked'>
                <label for="public">Publico</label>

                <input type='radio' name='pm' id='privado' value='1'>
                <label for="private">Privado</label>

                <p> Destinatario:

                <select name="idDestinatario">
                    <?php if(isset ($usuarios,$amigos)){
                        foreach ($amigos as $amigo) {
                            if ($amigo->id_user == session('user')) {
                                foreach ($usuarios as $usuario){
                                    if ($amigo->id_follower == $usuario->id){ ?>


                    <option value="<?php echo $usuario->id?>"> <?php echo $usuario->nombre?> </option>

                    <?php }}}}} ?>

                </select>
                </p>

                <textarea name='mensaje' placeholder="Escriba su mensaje"></textarea>

                <input type="reset" value="Cancelar"/>
                <input type="submit" value="Enviar"/>
            </fieldset>
        </form>

    </article>

    <article class="articulo" id="adminLista">

        <header>
            <h1>Publica un mensaje en al Muro:</h1>
        </header>


        <form method="post" action="procesar_mensaje_muro">
            <?= csrf_field() ?>
            <fieldset>
                <legend>Mensajes públicos, cuidado lo que escribes</legend>

                <input type="hidden" name="idEmisor" value="<?php echo session('user') ?>">
                <textarea name='mensaje' placeholder="Escriba su mensaje"></textarea>

                <input type="reset" value="Cancelar"/>
                <input type="submit" value="Enviar"/>
            </fieldset>
        </form>

    </article>

    <article class="articulo" id="adminLista">

        <header>
            <h1>Mensajes Realizados:</h1>
        </header>


        <?php
        if (isset($amigos,$usuarios,$mensajes)){
            foreach ($mensajes as $mensaje){
                if ($mensaje->id_emisor == session('user')) {
                    $fecha = $mensaje->created_at;
                    $fechaComoEntero = strtotime($fecha);
                    $dia = date("Y-m-d", $fechaComoEntero);
                    $tiempo = date("H:i:s", $fechaComoEntero);

                    if($mensaje->id_emisor == $mensaje->id_receptor){ ?>

                        <article style='display: block; size: 20px;'> Mensaje en el muro: <?php echo $mensaje->mensaje; ?>.  <p style='display:inline-block; font-style: italic';> Enviado a las <?php echo $tiempo; ?> el día <?php echo $dia; ?> </p>  </article>


                    <?php  }else{
                        $usuario = \App\Usuario::where('id',$mensaje->id_receptor)->first();
                        if($mensaje->pm == 0){ ?>

                            <article> Mensaje a <?php echo $usuario->nombre; ?> de forma pública: <?php echo $mensaje->mensaje; ?>. <p style='display:inline-block; font-style: italic';> Enviado a las <?php echo $tiempo; ?> el día <?php echo $dia; ?> </p>  </article>

                        <?php  }else{?>

                            <article> Mensaje a <?php echo $usuario->nombre; ?> de forma privada: <?php echo $mensaje->mensaje; ?>. <p style='display:inline-block; font-style: italic';> Enviado a las <?php echo $tiempo; ?> el día <?php echo $dia; ?> </p>  </article>

                        <?php }}}}} ?>


        <header>
            <h1>Mensajes Recibidos:</h1>
        </header>
        <?php
        if (isset($amigos,$usuarios,$mensajes)){
            foreach ($mensajes as $mensaje){
                if ($mensaje->id_receptor == session('user') && $mensaje->id_emisor != session('user') ) {
                    $fecha = $mensaje->created_at;
                    $fechaComoEntero = strtotime($fecha);
                    $dia = date("Y-m-d", $fechaComoEntero);
                    $tiempo = date("H:i:s", $fechaComoEntero);
                    $usuario = \App\Usuario::where('id',$mensaje->id_emisor)->first();
                    $nombreEmisor = $usuario->nombre;
                    if($mensaje->pm == 0){
                    ?>

                        <article> Mensaje por <?php echo $nombreEmisor; ?> de forma pública: <?php echo $mensaje->mensaje; ?>. <p style='display:inline-block; font-style: italic';> Enviado a las <?php echo $tiempo; ?> el día <?php echo $dia; ?> </p>  </article>

                        <?php }else{ ?>

                        <article> Mensaje por <?php echo $nombreEmisor; ?> de forma privada: <?php echo $mensaje->mensaje; ?>. <p style='display:inline-block; font-style: italic';> Enviado a las <?php echo $tiempo; ?> el día <?php echo $dia; ?> </p>  </article>


        <?php }}}} ?>


    </article>
</section>


<?php include "com/footer.php"  ?>

</body>
</html>
