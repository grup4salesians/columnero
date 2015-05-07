@extends('layouts.master')
@section('title')
Perfil Usuari
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
        width: 160px;  
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
                <h4 class="page-head-line">Perfil Usuari -<?php echo $userdata[0]->nick ?>-</h4>
            </div>
        </div>


        <div id="PerfilUsuari_Dades">
            <div class="row">
                <div class="labelperfil">Nom</div>  
                <input type="text" class="inputperfil form-control" value="<?php echo $userdata[0]->nom ?>" disabled="disabled">
            </div>
            <div class="row">
                <div class="labelperfil">Cognom</div>
                <input type="text" class="inputperfil form-control" value="<?php echo $userdata[0]->cognom; ?>" disabled="disabled">
            </div>
            <div class="row">
                <div class="labelperfil">Nick</div> 
                <input type="text" class="inputperfil form-control" value="<?php echo $userdata[0]->nick; ?>" disabled="disabled">
            </div>
            <div class="row">
                <div class="labelperfil">Email</div> 
                <input type="text" class="inputperfil form-control" value="<?php echo $userdata[0]->email; ?>" disabled="disabled">
            </div>
            <div class="row">
                <div class="labelperfil">Nº de posts</div> 
                <input type="text" class="inputperfil form-control" value=" <?php
                       $querypost = Post::where('usuari_id', $userdata[0]->id)->select();
                       echo count($querypost->get());
                       ?>" disabled="disabled">    
            </div>
        </div>
    </div>
</div>

@stop
