<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="/" target="_top">
    <link rel="stylesheet" href="css/myWebIoT.css?v=<?php echo time(); ?>">

    <script src="https://code.jquery.com/jquery-3.4.1.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script language="JavaScript" src="js/ajaxShop.js"></script>

    <title> Carrito de MyIoT Shop</title>

</head>
<body>

<?php include "com/cabecera.php"; ?>


<section class="maincentrado">

    <header class="encabezado">
        <p>Mi Carrito de MyIoT Shop:</p>
    </header>

    <article class="articulo">

        <header id="adminLista">
            <h1>Productos en el Carrito:</h1>
        </header>


        <?php
        if (isset($productos)) {

        $productPriceFinal = 0;
        $precioTotal = 0;?>

        <div class="row">
            <div class="col-75">
                <div class="col-25">
                    <div class="container">

                        <h2>Carrito:   <i class="fa fa-shopping-cart"></i>  </h2>


        <?php foreach ($productos as $producto) {
        if(session()->has('PROD-'.$producto->id)){
            $unidades = session('PROD-'.$producto->id);
            $precioProducto = $unidades*($producto->precioProducto);
            $precioTotal = $precioTotal+$precioProducto;
            ?>

            <form style="display: inline-block" method="get" action="eliminarProductoCarrito">

                <input type='hidden' name='idProducto' value='<?php echo $producto->id ?>'>
                <button type="submit" style="background-color: firebrick; color: #cccccc">-</button></li>
            </form>
                    <p class="producto">Producto: <?php echo $producto->nombreProducto ?> x <?php echo $unidades  ?> <p class="money"><?php echo $precioProducto." €"   ?></p></p>



        <?php }}}?>

                    <hr>
                    <h2 class="producto">Precio Total Carrito:  <h2 class="money" id="total" ><?php echo $precioTotal." €";?> </h2> </h2>

                    </div>
                </div>
            </div>
        </div>

        <hr><form method='get' action='shop/vaciarCarrito'>
            <input id="carform"  type='submit' value='Vaciar Carrito'>
            </form>

        <hr><form method='get' action='shop/checkout'>
        <input id="carform2" type='submit' value='Checkout'>
        </form>

    </article>
</section>


<?php include "com/footer.php"  ?>

</body>
</html>

