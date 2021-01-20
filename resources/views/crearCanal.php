<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cree su canal IoT</title>
    <link rel="stylesheet" href="css/myWebIoT.css">
</head>
<body>
<?php include "com/cabecera.php"; ?>
<section class="maincentrado">
    <header class="encabezado">
        <p>Creación de canales</p>
    </header>
    <form method="post" action="procesar_canal">
        <?= csrf_field() ?>
        <fieldset>
            <legend>Introduzca los datos del sensor</legend>
            <p>
                <label> Nombre del Canal:
                    <input type="text" name="nombreCanal" placeholder="Introduzca el nombre del canal" required/>
                </label>
            </p>
            <?php
            if(isset($canalExistente)) {
                echo "<script>window.alert('Canal existente, introduzca un nuevo nombre.')</script>";
            }
            ?>
            <p>
                <label>Descripción del Canal:
                    <textarea rows="3" name="descripcion" required> </textarea>
                </label>
            </p>
            <p>
                <label>Longitud:
                    <input type="number" name="longitud" placeholder="Introduzca la longitud del sensor" required/>
                </label>
            </p>
            <p>
                <label>Latitud:
                    <input type="number" name="latitud" placeholder="Introduzca la latitud del sensor" required/>
                </label>
            </p>
            <p>
                <label> Nombre del sensor:
                    <input type="text" name="nombresensor" placeholder="Introduzca el nombre del sensor" required/>
                </label>
            </p>
            <input type="reset"/>
            <input type="submit" value="Crear"/>
        </fieldset>
    </form>
</section>
<?php include "com/footer.php" ?>
</body>
</html>
