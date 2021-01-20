<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/myWebIoT.css?v=<?php echo time(); ?>">

    <script src="https://code.jquery.com/jquery-3.4.1.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script language="JavaScript" src="js/ajaxShop.js"></script>

    <title> MyIoT Shop</title>

</head>
<body>

<?php include "com/cabecera.php"; ?>


<script>

    function numero_carrito(){
        $("#miCarrito").load("numero_carrito");
        setTimeout(numero_carrito,1000); //2 segundos
    }

</script>

<?php if(session('error') != null){?>
    <div class="ventanaDanger">
        <p class="closebtn" onclick="this.parentElement.style.display='none';">&times;</p>
        <?php echo session('error') ?>
    </div>
<?php } ?>

<?php if(session('exito') != null){?>
    <div class="ventanaExito">
        <p class="closebtn" onclick="this.parentElement.style.display='none';">&times;</p>
        <?php echo session('exito') ?>
    </div>
<?php } ?>

<aside id="lateral">
    <article id="shop">

        <div style="display: inline-flex">
        <button class="carrito" onclick="window.location.href='shop/miCarrito'"><img src="Imagenes/cart.png" alt="carrito" height="20" width="20" ></button>

        <p id="miCarrito">
          <script>
                setTimeout(numero_carrito,1000);
            </script>
        </p>

        </div>

        <?php if (session()->has("user") == true) { ?>

        <button id="checkout" onclick="window.location.href='shop/checkout/'"><input type="image" src="https://www.paypalobjects.com/es_XC/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal.">
            <img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
        </button>
        <?php  } ?>

    </article>
</aside>

<section class="mainindex">
    <article class="articulo">
        <h1>Bienvenidos a la tienda virtual de MyWebIoT</h1>
        <p>En MyIoT Shop puede comprar todo tipo de productos relacionados con MyWebIoT.</p>

    </article>
</section>

<section>
<article class="articulo" id="productos">
    <h1>Productos</h1>

    <?php
    $productos = \Illuminate\Support\Facades\DB::table('productos')
        ->select('productos.*')
        ->paginate(4);

    foreach ($productos as $product){
    ?>

<div class="card">
    <p hidden><?php echo $product->id ?></p>
    <h1 style="text-transform: uppercase"><?php echo $product->nombreProducto ?></h1>
    <img src="imagenes/<?php echo $product->nombreProducto ?>.jpg" alt="<?php echo $product->nombreProducto ?>" height="250" width="250">
    <p class="price"> <?php echo $product->precioProducto ?>€</p>
    <p style="text-transform: capitalize"><?php echo $product->descripcionProducto ?></p>

    <?php if($product->stockProducto > 0){ ?>
        <p>Quedan <strong> <?php echo $product->stockProducto ?></strong> en stock</p>
    <?php } ?>

    <?php if($product->stockProducto == 0){ ?>
    <p style="color: red"><strong>No hay stock actual</strong></p>
    <?php } ?>


    <form method="get" action="shop/consultarProducto" >
        <input type="hidden" name="idProducto" value="<?php echo $product->id ?>">
        <input type="submit" value="Más info">
    </form>


    <form method="post" action="shop/addCarrito">
        <?= csrf_field() ?>

        <input type="hidden" name="idProducto" value="<?php echo $product->id ?>">
        <?php if($product->stockProducto > 0){ ?>
        <input id="derecha" class="add-to-cart" type="submit"  value="Añadir al carrito">
        <input id="izq" type="number" name="cantidad" min="1" value="1">


        <?php }  if($product->stockProducto == 0) { ?>
            <input id="derecha" type="submit" style="color: gray" value="Añadir al carrito" disabled>
            <input id="izq" type="number" name="cantidad" min="1" value="1">
        <?php } ?>

    </form>
</div>

    <?php } ?>

    <div class="paginate">
        <a href="<?php echo $productos->previousPageUrl()?>"> &laquo; Anterior</a>
        <a href="<?php echo $productos->nextPageUrl() ?>" >Siguiente &raquo;</a>
    </div>

</article>
</section>

<?php include "com/footer.php"  ?>

</body>
</html>



