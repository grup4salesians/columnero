<header>
    <div class='header_login' style="text-align:center;"> 
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="fa fa-bars"></span>
            </button>
        </div>

    </div>
    <?php if (Auth::check()) { //COMPRUEBA SI HAY USUARIO CONECTADO, SI LO HAY, INDICA UN MENÚ NUEVO Y UN CERRAR SESIÓN?> 

        <section class="menu-section">
            <div class="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="navbar-collapse collapse ">
                            <ul id="menu-top" class="nav navbar-nav navbar-right">
                                <li><a id="index" class="cl-menu-index" href="<?php echo Config::get('constants.BaseUrl'); ?>public">Inici</a></li>
                                <li><a id="novanota" class="cl-menu-novanota" href="<?php echo Config::get('constants.BaseUrl'); ?>public/novanota">Nova nota</a></li>
                                <li><a class="cl-menu-preferits" href="<?php echo Config::get('constants.BaseUrl'); ?>public/preferits">Preferits</a></li>
                                <li><a class="cl-menu-publiques" href="<?php echo Config::get('constants.BaseUrl'); ?>public/publiques">Notes públiques</a></li>
                                <li><a class="cl-menu-mevesnotes" href="<?php echo Config::get('constants.BaseUrl'); ?>public/mevesnotes">Les meves notes</a></li>
                                <li><a class="cl-menu-perfil" href="<?php echo Config::get('constants.BaseUrl'); ?>public/perfil" title="<?php echo Auth::user()->nick; ?>">Perfil</a></li>
                                <li><a class="cl-menu-logout" href="<?php echo Config::get('constants.BaseUrl'); ?>public/logout">Tancar sessió</a></li>      
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
                                <li><a class="cl-menu-registre" href="registro">Registrar-se</a></li>
                                <li><a class="cl-menu-login" href="login">Iniciar sessió</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section> 
    <?php } ?>
</header>