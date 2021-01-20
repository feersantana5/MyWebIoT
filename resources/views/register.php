<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/myWebIoT.css"
    <script src="js/registroVerify.js"></script>
    <title> Register</title>
</head>
<body>
<?php
include "com/cabecera.php";
?>
<section class="maincentrado">
    <header class="encabezado">
        <p>Cree su cuenta</p>
    </header>
    <form  method="post" action="procesar_registro">
        <?= csrf_field() ?>
        <fieldset>
            <legend>Introduzca sus datos</legend>
            <p>
                <label> Nombre de Usuario:
                    <input type="text" name="nombre" placeholder="Introduzca su nombre de usuario" required/>
                </label>
            </p>
            <?php
            if(isset($usernameExistente)) {
                echo "<script>window.alert('Usuario existente, intente con otro.')</script>";
            }
            ?>
            <p>
                <label>Fecha de nacimiento:
                <input type="date" name="fechaNacim" required/>
                </label>
            </p>
            <p>
                <label>Estado:
                    <input type="text" name="estado" required/>
                </label>
            </p>

            <p>
                <label>Email:
                <input type="email" name="email" placeholder="Introduzca su email" required/>
                </label>
            </p>
            <?php
            if(isset($emailExistente)) {
                echo "<script>window.alert('Email existente, regístrese en la ventana de Login.')</script>";
            }
            ?>
            <p>
                <label>Contraseña:
                <input type="password" name="contra1"  placeholder="Introduzca su contraseña" required/>
                </label>
            </p>
            <p>
                <label>Repetir contraseña:
                <input type="password" name="contra2" placeholder="Repita su contraseña" required/>
                </label>
            </p>
            <?php
            if(isset($contraseñaIncorrecta)) {
                echo "<script>window.alert('Las contraseñas no coinciden, inténtelo de nuevo.')</script>";
            }
            ?>
            <input type="reset" value="Borrar campos"/>
            <input type="submit" value="Crear cuenta"/>

        </fieldset>
    </form>
</section>
<?php
include "com/footer.php"
?>
</body>
</html>
