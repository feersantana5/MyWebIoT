
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/myWebIoT.css">
    <title> Servicio Web</title>
</head>
<body>

<?php include "com/cabecera.php"; ?>

<section class="maincentrado">
    <header class="encabezado">
        <p>Datos del sensor entre las fechas indicadas:</p>
    </header>

    <article id="contacto">
        <form  method="get" action="servicioWeb">
            <fieldset>
                <legend>Introduzca el id del sensor y dos fechas</legend>
                <p>
                    <label>Id sensor:
                        <input type="number" name="idSensor" required/>
                   </label>
                </p>
                <p>
                    <label>Desde:
                        <input type="date" name="fechaDesde" required/>
                    </label>
                </p>
                <p>
                    <label>Hasta:
                        <input type="date" name="fechaHasta" required/>
                    </label>
                </p>
                <input type="reset" value="Borrar campos"/>
                <input type="submit" value="Enviar fechas"/>
            </fieldset>
        </form>

</section>

<?php  include "com/footer.php"  ?>

</body>
</html>
