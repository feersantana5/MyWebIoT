<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="/" target="_top">
    <link rel="stylesheet" href="css/myWebIoT.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.4.1.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script language="JavaScript" src="js/ajaxShop.js"></script>

    <title> Transacciones de MyWebIoT</title>


</head>
<body>

<?php include "com/cabecera.php"; ?>

<nav id="vertical">
    <ul>
        <li><a  href="shopAdmin">Productos</a></li>
        <li><a href="shopAdmin/ordenes">Órdenes</a></li>
        <li><a class="active" href="shopAdmin/transacciones">Transacciones</a></li>
    </ul>
</nav>

<section class="mainshop">

    <header class="encabezado">
        <p>Transacciones de MyIoT Shop:</p>
    </header>

    <article class="articulo" id="adminLista">

        <header>
            <h1>Listado de Transacciones:</h1>
        </header>

        <div id="productoAdmin" >
            <table style="text-align: center">
                <thead>
                <tr>
                    <th>Id Transacción</th>
                    <th>Id Orden</th>
                    <th>Cliente</th>
                    <th>Total (€)</th>
                    <th>Id Pago</th>
                    <th>Email</th>
                    <th>Fecha</th>

                </tr>
                </thead>
                <tbody>

                <?php
                if (isset($transacciones)) {
                foreach ($transacciones as $transaccion){
                    ?>
                    <tr>
                        <td><?php echo $transaccion->id ?></td>
                        <td><?php echo $transaccion->orderId ?></td>
                        <td><?php echo $transaccion->payerId ?></td>
                        <td><?php echo $transaccion->amount ?></td>
                        <td><?php echo $transaccion->paymentId ?></td>
                        <td><?php echo $transaccion->email ?></td>
                        <td><?php echo $transaccion->created_at ?></td>
                    </tr>
                <?php }} ?>
                <tbody>
            </table>
        </div>



    </article>
</section>


<?php include "com/footer.php"  ?>

</body>
</html>
