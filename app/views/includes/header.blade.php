<header>
    <div class='header_login' style="text-align:center;"> 
        <?php if (Auth::check()) { //COMPRUEBA SI HAY USUARIO CONECTADO, SI LO HAY, INDICA UN MENÚ NUEVO Y UN CERRAR SESIÓN?> 

            <section class="menu-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="navbar-collapse collapse ">
                                <ul id="menu-top" class="nav navbar-nav navbar-right">
                                    <li><a id="index" href="../public">Index</a></li>
                                    <li><a id="novanota" href="novanota">Nova nota</a></li>
                                    <li><a href="preferits">Preferits</a></li>
                                    <li><a href="mevesnotes">Les meves notes</a></li>
                                    <li><a href="perfil" title="<?php echo Auth::user()->nick; ?>">Perfil</a></li>
                                    <li><a href="publiques">Notes públiques</a></li>
                                    <li><a href="logout">Tancar sessió</a></li>      
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        <?php } else {  //NO HAY USUARIO POR LO QUE INDICA EL MENÚ NORMAL, REGISTRO & INICIAR SESSIÓN?>
        <section class="menu-section">   
        <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="navbar-collapse collapse ">
                            <ul id="menu-top" class="nav navbar-nav navbar-right">
                                <li><a id="novanota" href="registro">Registrarse</a></li>
                                <li><a href="login">Login</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            </section> 
        <?php } ?>

    </div>
</header>