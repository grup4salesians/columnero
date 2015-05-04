    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <strong class="hoverguay">DawColumner - El teu espai per descobrir i compartir!</strong>
                </div>
            </div>
        </div>
    </header>
<div class='header_login' style="text-align:center;"> 
     <div id='registrarse'  onclick="location.href='../public/registro'"> <span class="glyphicon glyphicon-user" style="font-size:30px;display:block;"></span> Registrarse </div> 
     <div id='iniciarsessio' onclick="location.href='../public/login'"><span class="glyphicon glyphicon-lock" style="font-size:30px;display:block;"></span> Iniciar sessió</div>
   
            <div id='cerrarsession'>
                   <a tabindex="-1" href="<?php echo Config::get('constants.BaseUrl') ?>public/logout"> 
                  <span class="glyphicon glyphicon-lock iconosHeader">
             
                    </span>
                    Tancar Sessió
                </a>

            </div>
    
     <div id='usuario'> 
         
        
                <a id="dLabel" href="#" data-toggle="dropdown" aria-haspopup="true" role="button" style="float:right;display: inline-block;">
                   <span class="glyphicon glyphicon-user iconosHeader"></span>
                    <?php echo Auth::user()->getFullNameAttribute(); ?> <span class="caret"></span>
                    <div class="hidden_area"> 
                    <ul>
                        <li>Hola</li>
                        <li>Halop</li>
                        <li>Hailop</li>
                    </ul>
                        </div>
                </a>
           
        </div>
        
    <?php } else {  //NO HAY USUARIO POR LO QUE INDICA EL MENÚ NORMAL, REGISTRO & INICIAR SESSIÓN?>
        <div id='registrarse'> 
            <a tabindex="-1" href="<?php echo Config::get('constants.BaseUrl') ?>public/registro">
                <span class="glyphicon glyphicon-user iconosHeader"></span>
                Registre
            </a>
        </div>
        <div id='iniciarsessio'> 
            <a tabindex="-1" href="<?php echo Config::get('constants.BaseUrl') ?>public/login">
                <span class="glyphicon glyphicon-lock iconosHeader"></span>
                Iniciar Sessió
            </a>
        </div>
    <?php } ?>

</div>