<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contacto</title>
    <link rel="stylesheet" href="css/myWebIoT.css">
</head>
<body>

<?php  include "com/cabecera.php"; ?>

<section class="maincentrado">
    <header class="encabezado">
        <p>Información de contacto de la página:</p>
    </header>
    <article id="contacto">
        <span class="infoContacto">
            <h1>Correo de contacto</h1>
            <img src="imagenes/icono_email.png" height="75" width="70" alt="Icono email">
           <p>En caso de tener alguna duda sobre el uso, utilización de la página web, puede contactar con el administrador de la página mediante email.</p>
            <button class="boton" onclick="window.location.href='mailto:fernando.santana112@ulpgc.es'">Contactar</button>
        </span>

        <span class="infoContacto">
            <h1>Ubicación</h1>
            <img src="imagenes/mapa_icono.png" height="75" width="70" alt="Icono email">
            <p>En caso de que prefiera una consulta presencial, puede acercarse a nuestra oficina. </p>
            <button class="boton" onclick="window.location.href='https://goo.gl/maps/HKFQpDj2FjSxieej7'">Visitar</button>

        </span>

    </article>
</section>

<?php  include "com/footer.php"  ?>

</body>
</html>
