
<header>
    <nav>
        <ul class="navbar">
            <li><img src="Imagenes/logoulpgc.png" height="50" width="100" alt="logo ulpgc"/></li>
            <li><a href="/"> MyWebIoT</a></li>
            <li><a href="canales"> Canales </a></li>
            <li><a href="ayuda"> Ayuda</a></li>
            <li><a href="contacto"> Contacto</a></li>
            <li><a href="shop"> MyIoT Shop</a></li>

            <?php
            if(session("nombre") == "admin" ){?>
                <li><a href="shopAdmin"> MyIoT Shop Admin</a></li>
            <?php } ?>


            <?php if(session()->has("user") == true){  ?>
                <li><a href="social"> MyIoT Social</a></li>

                <li style="float: right"> <a href="misCanales"><?php echo session("nombre")?></a></li>
                <li style="float: right"> <a href="cerrar_session"> Cerrar Sesión </a></li>
            <?php }else{  ?>
                <li style="float: right"><a href="login"> Login</a></li>
                <li style="float: right"><a href="register"> Register</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>
