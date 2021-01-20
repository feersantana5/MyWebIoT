<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/myWebIoT.css?v=<?php echo time(); ?>">

    <script src="https://code.jquery.com/jquery-3.4.1.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script language="JavaScript" src="js/ajaxShop.js"></script>

    <title> Administración de MyIoT</title>

</head>
<body>

<?php include "com/cabecera.php"; ?>


<nav id="vertical">
    <ul>
        <li><a class="active" href="shopAdmin">Productos</a></li>
        <li><a href="shopAdmin/ordenes">Órdenes</a></li>
        <li><a href="shopAdmin/transacciones">Transacciones</a></li>
    </ul>
</nav>

<section class="mainshop">

    <header class="encabezado">
        <p>Administración de MyIoT Shop:</p>
    </header>

    <article class="articulo" id="adminLista">

        <header>
            <h1>Administración de productos:</h1>
        </header>

        <a href="/shopAdmin/crearProducto"><button class="botonAddTienda">Añadir Producto</button></a>

        <div id="productoAdmin">
            <table>
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Producto</th>
                    <th>Descripción</th>
                    <th>Precio (€)</th>
                    <th>Stock</th>
                    <th>Consultar</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>

                <?php
                if (isset($productos)) {
                foreach ($productos as $producto){
                    ?>
                    <tr>

                        <td><?php echo $producto->id ?></td>
                        <td><?php echo $producto->nombreProducto ?></td>
                        <td><?php echo $producto->descripcionProducto ?></td>
                        <td><?php echo $producto->precioProducto ?></td>
                        <td><?php echo $producto->stockProducto ?></td>

                        <form method="get">
                            <input type="hidden" name="idProducto" value="<?php echo $producto->id ?>">
                            <td>
                                <button class="basura" type="submit" formaction="shopAdmin/consultarProducto">
                                    <img src="imagenes/lupa.png" alt="consultar" height="20" width="20">
                                </button>
                            </td>
                            <td>
                                <button class="basura" type="submit" formaction="shopAdmin/actualizarProducto">
                                    <img src="imagenes/editar.png" alt="editar" height="20" width="20">
                                </button>
                            </td>
                            <td>
                                <button class="basura" type="submit" formaction="shopAdmin/eliminarProducto">
                                    <img src="imagenes/basura.png" alt="eliminar" height="20" width="20" >
                                </button>
                            </td>
                        </form>
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
