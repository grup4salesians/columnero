@extends('layouts.master')
@section('title')
Perfil
@stop
@section('content')
<style>
    .inputperfil{
        width:30%;
        font-size:20px;
        text-align:center;

    }
    .labelperfil{
        font-size:20px;
        text-align:left;
    }
</style>
<div id="contingut_home">
   
       
        <div id="Bloque_inside_perfil"><br>
             <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Perfil</h4>
            </div>
        </div>
             @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            {{ $error }}<br>        
            @endforeach
        </div>
        @endif
        @if(Session::has('mensaje_error'))
                    <div class="alert alert-info">{{ Session::get('mensaje_error') }}</div>
                @endif
            {{ Form::open(array('url' => '/cambiarpass','method' => 'post')) }}
                <span class="labelperfil">Nom</span>  <br>
                <input type="text" class="inputperfil" value="<?php echo Auth::user()->nom; ?>" disabled="disabled"><br>
                <span class="labelperfil">Cognom</span><br>
                <input type="text" class="inputperfil" value="<?php echo Auth::user()->cognom; ?>" disabled="disabled"><br>
                <span class="labelperfil">Nick</span> <br>
                <input type="text" class="inputperfil" value="<?php echo Auth::user()->nick; ?>" disabled="disabled"><br>
                <span class="labelperfil">Email</span> <br>
                <input type="text" class="inputperfil" value="<?php echo Auth::user()->email; ?>" disabled="disabled"><br>
                <span class="labelperfil">Nº de posts</span> <br>
                <input type="text" class="inputperfil" value=" <?php $querypost = Post::where('usuari_id',Auth::user()->id)->select();
                echo count($querypost->get());
                ?>" disabled="disabled"><br><br>
                <input type="button" class="btn btn-primary" id="butoncambiarpass" value="Cambiar contrasenya" onclick="showdivcontrasenya()"><br>
                <div id="cambiarpass" style="display:none;">
                    <br>
                    
                    <span  class="labelperfil">Contrasenya actual</span> <br>
                     {{ Form::password('passactual',array('class' => 'inputperfil')); }}<br>
                    <span class="labelperfil">Contrasenya nova</span><br>
                    {{ Form::password('passnueva',array('class' => 'inputperfil')); }}<br>
                     <span class="labelperfil">Confirmar contrasenya nova</span><br>
                     {{ Form::password('contrasenya_confirm',array('class' => 'inputperfil')); }}<br><br>
                      {{ Form::submit('Confirmar', array('class' => 'btn btn-success'))}}
                     {{ Form::close() }}
                </div>
            
        </div>
   
</div>
<script>
    function showdivcontrasenya() {
        if (document.getElementById("cambiarpass").style.display == "none") {
            document.getElementById("cambiarpass").style.display = "block";
           
        }else if( document.getElementById("cambiarpass").style.display == "block"){
          document.getElementById("cambiarpass").style.display = "none";
        }
    }
</script>

@stop
