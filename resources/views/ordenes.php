<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="/" target="_top">
    <link rel="stylesheet" href="css/myWebIoT.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.4.1.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script language="JavaScript" src="js/ajaxShop.js"></script>

    <title> Órdenes de MyWebIoT</title>


</head>
<body>

<?php include "com/cabecera.php"; ?>

<nav id="vertical">
    <ul>
        <li><a  href="shopAdmin">Productos</a></li>
        <li><a class="active" href="shopAdmin/ordenes">Órdenes</a></li>
        <li><a href="shopAdmin/transacciones">Transacciones</a></li>
    </ul>
</nav>

<section class="mainshop">

    <header class="encabezado">
        <p>Órdenes de MyIoT Shop:</p>
    </header>

    <article class="articulo" id="adminLista">

        <header>
            <h1>Listado de órdenes:</h1>
        </header>


        <div id="productoAdmin">
            <table>
                <thead>
                <tr>
                    <th>Id Orden</th>
                    <th>Cliente</th>
                    <th>Precio Total (€)</th>
                    <th>Estado Orden</th>
                </tr>
                </thead>
                <tbody>

                <?php
                if (isset($ordenes)) {
                foreach ($ordenes as $orden){
                    ?>
                    <tr>
                        <td><?php echo $orden->id ?></td>
                        <td><?php echo $orden->id_cliente ?></td>
                        <td><?php echo $orden->precioTotal?></td>
                        <td><?php echo $orden->estadoOrden?></td>
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
