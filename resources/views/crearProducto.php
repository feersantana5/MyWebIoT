<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cree su producto en MyShop.</title>
    <base href="/" target="_top">
    <link rel="stylesheet" href="css/myWebIoT.css">
</head>
<body>

<?php include "com/cabecera.php"; ?>
<section class="maincentrado">

    <header class="encabezado">
        <p>Creación de producto</p>
    </header>

    <a class="basura" id="back" href="/shopAdmin" >
        <img src="imagenes/flechaatras.png" alt="back" height="20" width="20" />
    </a>

    <form method="post" action="procesar_producto" >
        <?= csrf_field() ?>
        <fieldset>
            <legend>Introduzca los datos del producto</legend>
            <p>
                <label> Nombre del producto:
                    <input type="text" name="nombreProducto" placeholder="Introduzca el nombre del producto" required/>
                </label>
            </p>
            <p>
                <label>Descripción del Producto:
                    <textarea rows="3" name="descripcionProducto" required> </textarea>
                </label>
            </p>
            <p>
                <label>Precio(€):
                    <input type="number" name="precioProducto" placeholder="Introduzca el precio del producto" required/>
                </label>
            </p>
            <p>
                <label>Stock Actual:
                    <input type="number" name="stockProducto" placeholder="Introduzca el stock del producto" required/>
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


