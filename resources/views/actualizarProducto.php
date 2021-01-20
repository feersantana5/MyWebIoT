<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editor de Productos</title>
    <base href="/" target="_top">
    <link rel="stylesheet" href="css/myWebIoT.css">
</head>
<body>

<?php include "com/cabecera.php"; ?>

<?php
if (isset($id)) {
$producto = \App\Producto::where('id', $id)->first();
?>

<section class="maincentrado">

    <header class="encabezado">
        <p>Actualice el producto: <?php echo $producto->nombreProducto?> </p>
    </header>

    <form method="post" action="procesar_producto_actualizado">
        <?= csrf_field() ?>
        <fieldset>
            <legend>Actualizar los datos del producto</legend>
            <p>
                <label> Nombre del producto:
                    <input type="text" name="nombreProducto" value="<?php echo $producto->nombreProducto?>" required/>
                </label>
            </p>
            <p>
                <label>Descripción del Producto:
                    <textarea rows="3" name="descripcionProducto" required><?php echo $producto->descripcionProducto;?></textarea>
                </label>
            </p>
            <p>
                <label>Precio (€):
                    <input type="number" name="precioProducto" value="<?php echo $producto->precioProducto;?>" required/>
                </label>
            </p>
            <p>
                <label>Stock Actual:
                    <input type="number" name="stockProducto" value="<?php echo $producto->stockProducto?>" required/>
                </label>
            </p>
            <input type="hidden" name="idProducto" value="<?php echo $producto->id ?>">

            <?php } ?>

            <input type="reset"/>
            <input type="submit" value="Actualizar"/>
        </fieldset>
    </form>
</section>

<?php include "com/footer.php" ?>

</body>
</html>

