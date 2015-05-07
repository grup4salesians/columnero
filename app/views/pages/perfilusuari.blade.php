@extends('layouts.master')
@section('title')
Perfil Usuari
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
        width:50px;
    }
    .margin{
        margin-bottom:30px;
    }
</style>
<div id="contingut_home">


    <div id="Bloque_inside_perfil"><br>
        <div class="row margin">
            <div class="col-md-12">
                <h4 class="page-head-line">Perfil Usuari -<?php echo $userdata[0]->nick ?>-</h4>
            </div>
        </div>
        <div class="row margin">
            <span class="labelperfil">Nom</span> 
            <input type="text" class="inputperfil" value="<?php echo $userdata[0]->nom ?>" disabled="disabled">
        </div>
        <div class="row margin"><span class="labelperfil">Cognom</span>
            <input type="text" class="inputperfil" value="<?php echo $userdata[0]->cognom; ?>" disabled="disabled"></div>

        <div class="row margin"><span class="labelperfil">Nick</span> 
            <input type="text" class="inputperfil" value="<?php echo $userdata[0]->nick; ?>" disabled="disabled"></div>

        <div class="row margin"> <span class="labelperfil">Email</span> 
            <input type="text" class="inputperfil" value="<?php echo $userdata[0]->email; ?>" disabled="disabled"></div>

        <div class="row margin"> <span class="labelperfil">Nº de posts</span> 
            <input type="text" class="inputperfil" value=" <?php
                   $querypost = Post::where('usuari_id', $userdata[0]->id)->select();
                   echo count($querypost->get());
                   ?>" disabled="disabled">  </div>

    </div>
</div>

@stop
