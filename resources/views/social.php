<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/myWebIoT.css?v=<?php echo time(); ?>">

    <script src="https://code.jquery.com/jquery-3.4.1.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <title> MyIoT Social</title>

    <script>
        function mensajes_muro(){
            $("#mensajes").load("mensajes_muro");
            setTimeout(mensajes_muro,1000); //1 segundo
        }
    </script>

</head>
<body>

<?php include "com/cabecera.php"; ?>

<section id="iniSocial">
    <article class="articulo">
        <h1>Bienvenidos a la red social de MyWebIoT</h1>
        <p>En MyIoT Social puede ponerse en contacto con los miembros que forman la comunidad MyWebIoT, comunicarse con sus compañeros y actualizar su perfil.</p>
    </article>
</section>

<?php $usuario = \App\Usuario::where('id', session("user"))->first(); ?>


<section id="izqSocial">
    <article class="articulo">
        <h1>Mi Perfil</h1>

        <div style="border: 1px; display: inline-block; width: 100%; margin: auto; text-align: left;">
        <div class="columna50" style="text-align: center">
            <img src=<?php if(file_exists("perfiles/".session('nombre').".jpg")){ echo "perfiles/".session('nombre').".jpg"; }else{ echo "\"perfiles/user.png\"";} ?> alt="No tienes foto de Perfil" width="100" height="100"/>
        </div>

        <div class="columna50" style="float: right">
            <h3>Mi Estado </h3>
            <p><?php echo $usuario->estado; ?>  </p>
        </div>

        </div>

    </article>
</section>

<section id="derechaSocial">
    <article class="articulo">
        <h1>Opciones</h1>
        <div>
<div class="btn2">
            <button class="btnSocial" id="btnMiembros" onclick="location.href = 'social/socialMiembros'">Miembros</button>
            <button class="btnSocial" id="btnAmigos" onclick="location.href = 'social/socialAmigos'">Amigos</button>
</div>
 <div class="btn3">
            <button class="btnSocial" id="btnMensajes" onclick="location.href = 'social/socialMensajes'">Mensajes</button>
            <button class="btnSocial" id="btnCanales" onclick="location.href = 'social/socialCanales'">Canales</button>
            <button class="btnSocial" id="btnPerfil" onclick="location.href = 'social/socialPerfil'">Perfil</button>
</div>

        </div>
    </article>
</section>

<section id="ultSocial">
    <article class="articulo">
        <h1>Muro de MyWebIoT</h1>
        <p id="mensajes">
            <script>
                setTimeout(mensajes_muro);
            </script>
        </p>
    </article>
</section>

<?php include "com/footer.php"  ?>

</body>
</html>
