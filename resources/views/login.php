<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/myWebIoT.css">
</head>
<body>
<?php
include "com/cabecera.php";
?>
<section class="maincentrado">
    <header class="encabezado">
        <p>Inicie Sesión</p>
    </header>
    <form method="post" action="procesar_login">
        <?= csrf_field() ?>
        <fieldset>
            <legend>Introduzca sus credenciales</legend>
            <p>
                <label> Nombre de Usuario:
                    <input type="text" name="nombre" required/>
                </label>
            </p>
            <?php
            if(isset($usuarioInexistente)) {
                echo "<script>window.alert('Usuario inexistente, inténtelo de nuevo.')</script>";
            }
            ?>
            <p>
                <label>Contraseña:
                    <input type="password" name="contra1" required/>
                </label>
            </p>
            <?php
            if(isset($contraseñaIncorrecta)) {
                echo "<script>window.alert('Contraseña incorrecta, inténtelo de nuevo.')</script>";
            }
            ?>
            <input type="reset"/>
            <input type="submit" value="Iniciar sesión"/>
            <p>No estas registrado? <a href="register">Registrate aquí</a></p>
        </fieldset>
    </form>
</section>
<?php
include "com/footer.php"
?>
</body>
</html>
