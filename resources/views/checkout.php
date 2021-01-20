<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="/" target="_top">
    <link rel="stylesheet" href="css/myWebIoT.css?v=<?php echo time(); ?>">

    <script src="https://code.jquery.com/jquery-3.4.1.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script language="JavaScript" src="js/ajaxShop.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <title> Checkout de MyIoT Shop</title>

    <script>

        function numero_carrito(){
            $("#miCarrito2").load("numero_carrito");
            setTimeout(numero_carrito,1000); //2 segundos
        }

    </script>

</head>
<body>

<?php include "com/cabecera.php"; ?>


<section class="maincentrado">

    <header class="encabezado">
        <p>Introduzca sus datos:</p>
    </header>

    <article class="articulo">

        <header>
            <h1>Proceda a finalizar su Compra:</h1>
        </header>

        <hr>

        <form class="form50" method='get' action='shop/vaciarCarrito'>
            <input id="carform" type='submit' value='Vaciar Carrito'>
        </form>

        <header>
            <h1 id="adminLista">Resumen del Carrito:</h1>
        </header>


        <?php
        if (isset($productos)) {

        $productPriceFinal = 0;
        $precioTotal = 0;?>

        <div class="row">
            <div class="col-75">
                <div class="col-25">
                    <div class="container">

                        <h2 style="text-align: center">Carrito:                                 <p class="fa fa-shopping-cart"> <p id="miCarrito2">
                                    <script>
                                        setTimeout(numero_carrito,1000);
                                    </script>
                                </p></p>  </h2>



                        <?php foreach ($productos as $producto) {
                            if(session()->has('PROD-'.$producto->id)){
                                $unidades = session('PROD-'.$producto->id);
                                $precioProducto = $unidades*($producto->precioProducto);
                                $precioTotal = $precioTotal+$precioProducto;
                                ?>

                                <p class="producto">Producto: <?php echo $producto->nombreProducto ?> x <?php echo $unidades  ?> <p class="money"><?php echo $precioProducto." €"   ?></p></p>



                            <?php }}}?>

                        <hr>
                        <h2 class="producto">Precio Total Carrito:  <h2 class="money" id="total" ><?php echo $precioTotal." €";  session(['total' => $precioTotal])?> </h2> </h2>

                    </div>
                </div>
            </div>
        </div>

        <hr>

        <header>
            <h1 id="adminLista">Finalice su compra:</h1>
        </header>

        <?php if (session()->has("user") == true & $precioTotal!=0 ){ ?>

        <form style="text-align: center" method="get" action="shop/pagoPaypal">
            <input type="hidden" name="precioTotal" value="<?php echo $precioTotal ?>">
            <button style="text-align: center" id="checkout">
                <input type="image" src="https://www.paypalobjects.com/es_XC/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal.">
                <img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
            </button>
        </form>

        <?php  } ?>

    </article>
</section>


<?php include "com/footer.php"  ?>

</body>
</html>


