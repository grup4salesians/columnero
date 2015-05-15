@extends('layouts.master-footerespecial')
@section('title')
Perfil
@stop
@section('content')
<style>
    .inputperfil{
        width:65%;
        font-size:20px;
        text-align:center;
    }
    .labelperfil{
        font-size:20px;
        text-align:left;
        width: 185px; 
        float: left;
    }
    #PerfilUsuari_Dades{
        width: 58%;
        margin: auto;
    }
    .row{  
        margin-bottom: 7px;
        margin-left: 0;
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
  
        {{ Form::open(array('url' => '/cambiarpass','method' => 'post')) }}

        <div id="PerfilUsuari_Dades">
            <div class="row">
                <div class="labelperfil">Nom</div>  
                <input type="text" class="inputperfil form-control" value="<?php echo Auth::user()->nom; ?>" disabled="disabled">
            </div>
            <div class="row">
                <div class="labelperfil">Cognom</div>
                <input type="text" class="inputperfil form-control" value="<?php echo Auth::user()->cognom; ?>" disabled="disabled">
            </div>
            <div class="row">
                <div class="labelperfil">Nick</div> 
                <input type="text" class="inputperfil form-control" value="<?php echo Auth::user()->nick; ?>" disabled="disabled">
            </div>
            <div class="row">
                <div class="labelperfil">Email</div> 
                <input type="text" class="inputperfil form-control" value="<?php echo Auth::user()->email; ?>" disabled="disabled">
            </div>
            <div class="row">
                <div class="labelperfil">Nº de posts</div> 
                <input type="text" class="inputperfil form-control" value=" <?php
                $querypost = Post::where('usuari_id', Auth::user()->id)->select();
                echo count($querypost->get());
                ?>" disabled="disabled">    
            </div>



            <input type="button" class="btn btn-primary" id="butoncambiarpass" value="Cambiar contrasenya" onclick="showdivcontrasenya()"><br>
            <div id="cambiarpass" style="display:none;">
                <br>
                <div class="row">
                    <div class="labelperfil">Contrasenya actual</div>
                    {{ Form::password('passactual',array('class' => 'inputperfil form-control')); }}
                </div>
                <div class="row">
                    <div class="labelperfil">Contrasenya nova</div>
                    {{ Form::password('passnueva',array('class' => 'inputperfil form-control')); }}
                </div>
                <div class="row"> 
                    <div class="labelperfil">Confirmar contrasenya nova</div>
                    {{ Form::password('contrasenya_confirm',array('class' => 'inputperfil form-control')); }}<br>
                    {{ Form::submit('Confirmar', array('class' => 'btn btn-success'))}}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    function showdivcontrasenya() {
        if (document.getElementById("cambiarpass").style.display == "none") {
            document.getElementById("cambiarpass").style.display = "block";

        } else if (document.getElementById("cambiarpass").style.display == "block") {
            document.getElementById("cambiarpass").style.display = "none";
        }
    }
</script>

@stop
