<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Producto</title>
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
        <p>Detalles del Producto: <?php echo $producto->nombreProducto?> </p>
    </header>

    <a class="basura" id="back" href="/shop/#productos" >
        <img src="imagenes/flechaatras.png" alt="back" height="20" width="20" />
    </a>


    <div class="wrapper">
        <div class="product-img">
            <img src="imagenes/<?php echo $producto->nombreProducto ?>.jpg" alt="<?php echo $producto->nombreProducto ?>" height="420" width="327">
        </div>

        <div class="product-info">
            <div class="product-text">
                <h1 style="text-transform: uppercase"><?php echo $producto->nombreProducto ?></h1>

                <?php if($producto->stockProducto > 0){ ?>
                    <h2>Quedan <strong> <?php echo $producto->stockProducto ?></strong> en stock</h2>
                <?php } ?>
                <?php if($producto->stockProducto == 0){ ?>
                    <h2 style="color: red"> <strong>No hay stock actual</strong></h2>
                <?php } ?>

                <p><?php echo $producto->descripcionProducto ?> </p>
                <h2 style="text-align: center">Id del producto:<?php echo $producto->id ?></h2>

            </div>
            <div class="product-price-btn">
                <h2 style="text-align: center"><div><?php echo $producto->precioProducto ?> </div>€</h2>
            </div>
        </div>
    </div>
    <?php } ?>



</section>

<?php include "com/footer.php" ?>

</body>
</html>


