    <header>
        <div class="container">
            <div class="row">
                
                 <div class="col-md-12">
                     <div class="logo">
                   {{ HTML::image('images/DC_Logo.png', 'Logo', array('class' => 'logo')) }}
                  
                    </div>
                    <strong class="hoverguay">DawColumner - El teu espai per descobrir i compartir!</strong>
                </div>
                
                
            </div>
        </div>
    </header>
<div class='header_login' style="text-align:center;"> 
        <?php if (Auth::check()) { //COMPRUEBA SI HAY USUARIO CONECTADO, SI LO HAY, INDICA UN MENÚ NUEVO Y UN CERRAR SESIÓN?> 
                    <li role="presentation" class="dropdown">
                        <a id="dLabel" href="#" data-toggle="dropdown" aria-haspopup="true" role="button" style="color:white;">
                            <?php echo Auth::user()->getFullNameAttribute(); ?> <span class="caret"></span>
                        </a>
                        

                    </li>
     <div id='iniciarsessio' onclick="location.href='../public/logout'"><span class="glyphicon glyphicon-lock" style="font-size:30px;display:block;"></span> Tancar Sessió</div>

                <?php }else{  //NO HAY USUARIO POR LO QUE INDICA EL MENÚ NORMAL, REGISTRO & INICIAR SESSIÓN?>
     <div id='registrarse'  onclick="location.href='../public/registro'"> <span class="glyphicon glyphicon-user" style="font-size:30px;display:block;"></span> Registrarse </div> 
     <div id='iniciarsessio' onclick="location.href='../public/login'"><span class="glyphicon glyphicon-lock" style="font-size:30px;display:block;"></span> Iniciar sessió</div>
               <?php }?>
   
</div>