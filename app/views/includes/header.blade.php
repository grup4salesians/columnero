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

<style>
    .iconosHeader{
        font-size:30px;
        display:block;  
         text-decoration: none;
         color: black;
    }
    .iconosHeader:hover{
        color:white;
    }

    #registrarse a,#iniciarsessio a,#usuario a,#cerrarsession a{
        color:black;
        text-decoration:none;
    }
     #registrarse a:hover,#iniciarsessio a:hover,#usuario a:hover,#cerrarsession a:hover{
        color:white;
    }
   

    ul, ol {
        list-style:none;
    }

    .nav {
        width:200px; /*Le establecemos un ancho*/
        display:block;
        margin:0 auto; /*Centramos automaticamente*/
        margin-right:20px;
    }

    .nav > li {
        float:left;
        border:1px solid black;
        display:block;
    }


    .nav li a {
        background-color:rgba(240, 85, 85, 0.95);
        color:#fff;
        text-decoration:none;
        width:200px;
        padding:5px 7px;
        display:block;
    }

    .nav li a:hover {
        background-color:red;
    }
    .nav li ul {
        display:none;
        position:absolute;
        min-width:140px;
    }

</style>
    <script>
        function show_sidebar(){
            document.getElementById("sidebar").style.display = "block";
           
        }
        function hide_sidebar(){
            document.getElementById("sidebar").style.display = "none";
        }
   </script>

<div class='header_login' style="text-align:center;"> 
    <?php if (Auth::check()) { //COMPRUEBA SI HAY USUARIO CONECTADO, SI LO HAY, INDICA UN MENÚ NUEVO Y UN CERRAR SESIÓN?> 
   
            <div id='cerrarsession'>
                   <a tabindex="-1" href="<?php echo Config::get('constants.BaseUrl') ?>public/logout"> 
                  <span class="glyphicon glyphicon-lock iconosHeader">
             
                    </span>
                    Tancar Sessió
                </a>

            </div>
    
     <div id='usuario' onMouseOver="show_sidebar()" onMouseOut="hide_sidebar()">
         
        
                <a id="dLabel" href="#" data-toggle="dropdown" aria-haspopup="true" role="button" style="float:right;display: inline-block;">
                   <span class="glyphicon glyphicon-user iconosHeader"></span>

                    <?php echo Auth::user()->nick; ?> <span class="caret"></span>
                </a>
         <div id="sidebar" style="display:none">
             
        
                    <ul class="nav">
                        <li><a href="novanota">Nova nota</a></li>
                        <li><a href="preferits">Preferits</a></li>
                        <li><a href="mevesnotes">Les meves notes</a></li>
                        <li><a href="perfil">Perfil</a></li>
                    </ul>
        </div>      
         
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